<?php
    /**
     * Posts class
     */
    class Posts {
        /**
         * Splits an array of numbers into numbers that are close to each other
         */
        private function splitArrayByCloseNumbers($array) {
            $result = array();
            $temp = array($array[0]);
          
            for ($i = 1; $i < count($array); $i++) {
              if ($array[$i] - $array[$i-1] == 1) {
                array_push($temp, $array[$i]);
              } else {
                array_push($result, $temp);
                $temp = array($array[$i]);
              }
            }
            array_push($result, $temp);
          
            return $result;
        }

        /**
         * Converts a string to markdown
         */
        private function stringPostProccessing($string) {
            include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/mobile/mobile_detect.php");

            $mobileDetect = new Mobile_Detect;
            
            if (preg_match("/~~(.*?)~~/", $string)) {
                return preg_replace("/~~(.*?)~~/", "<del>$1</del>", $string);
            } elseif (preg_match("/!video\[(.*?)\]\((.*?)\)/", $string)) {
                return preg_replace("/!video\[(.*?)\]\((.*?)\)/", "<iframe height=\"500\" src=\"$2\" title=\"$1\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"></iframe>", $string);
            } elseif (preg_match("/!audio\[(.*?)\]\((.*?)\)/", $string)) {
                if ($mobileDetect->isiOS()) {
                    return preg_replace("/!audio\[(.*?)\]\((.*?)\)/", "<audio controls=\"controls\" style=\"margin-bottom: 2em\" $1><source src=\"$2\"></audio>", $string);
                } else {
                    return preg_replace("/!audio\[(.*?)\]\((.*?)\)/", "<audio controls=\"controls\" $1><source src=\"$2\"></audio>", $string);
                }
            } else {
                return $string;
            }
        }

        /**
         * Collects records depending on their number: 
         * on one page or on several pages, 
         * taking into account the setting of the number of entries per page
         */
        public function preparePosts($array) {
            $mode = NULL;
    
            if (count($array) > POST_MAX_POST_PER_PAGE) {
                $array = array_reverse($array);
                $pages_array = array_chunk($array, POST_MAX_POST_PER_PAGE);
    
                $mode = "multiple";
    
                array_unshift($pages_array, $mode);
    
                return $pages_array;
            } else {
                $array = array_reverse($array);
                $mode = "single";
    
                array_unshift($array, $mode);
    
                return $array;
            }
        }

        /**
         * Reads a post from a file
         */
        public function readPost($filePath) {
            $file = fopen($filePath, "r");
            $resultArray = array();
    
            if ($file) {
                while (($line = fgets($file)) !== false) { 
                    $resultArray[] = $line;
                }
                fclose($file);
    
            } else {
                $resultArray = NULL;
            }
            return $resultArray;
        }

        /**
         * Gets the date of the post from the path to the file
         */
        public function getPostDate($postFilePath) {
            $fileName = basename($postFilePath);
            $fileName = str_replace(".md", "", $fileName);
            $fileName = str_replace("_", ":", $fileName);
    
            $pathWithOutName = str_replace($fileName, '', $postFilePath);
    
            $date = str_replace("./posts/", "", $pathWithOutName);
            $date_array = explode("/", $date);
    
            return $date_array[0] . "-" . $date_array[1] . "-" . $date_array[2] . " " . $fileName;
        }
    
        /**
         * Gets the shortened text of the post in the Markdown markup for preview in the feed
         */
        public function getPostText($parser, $array, $postUrl) {
            unset($array[0]);

            foreach ($array as $index => $value) {
                $array[$index] = $this->stringPostProccessing($value);
            }

            $sliceIndex = NULL;

            foreach ($array as $index => $row) {
                if (POST_PREVEW_ROW_LIMIT >= 0 && count($array) > POST_PREVEW_ROW_LIMIT) {
                    if ($index > POST_PREVEW_ROW_LIMIT) {
                        $sliceIndex = $index;
                        break;
                    }
                }
            }

            if ($sliceIndex != NULL) {
                if (strpos($array[$sliceIndex], '|') !== false) {
                    $nextSliceIndex = $sliceIndex + 1;
                    if ($nextSliceIndex > count($array)) {
                        $sliceIndex = NULL;
                    } else {
                        $sliceIndex = $nextSliceIndex;
                    }
                }
            }

            if ($sliceIndex != NULL) {
                $array = array_slice($array, 0, $sliceIndex);
            }

            $codeTagCount = 0;

            // Check Code Blocks
            foreach ($array as $row) {
                if (strpos($row, '```') !== false) {
                    $codeTagCount++;
                }
            }
    
            $table_indexes = array();
            foreach ($array as $index => $row) {
                if (strpos($row, '|') !== false) {
                    array_push($table_indexes, $index);
                }
            }
    
            if (count($table_indexes) > 1) {
                $table_indexes = $this->splitArrayByCloseNumbers($table_indexes);
                foreach ($table_indexes as $group) {
                    $head_item = $group[0];
                    unset($group[0]);
    
                    foreach ($group as $in_group_index) {
                        $array[$head_item] .= $array[$in_group_index];
                        unset($array[$in_group_index]);
                    }
                }
            }

            if ($codeTagCount % 2 != 0) {
                array_push($array, "```");
            }
    
            $text = implode("\n", $array);

            $resultArray = array();
            $resultBuffer = $parser->defaultTransform($text);
    
            array_push($resultArray, $resultBuffer);

            if ($sliceIndex != NULL) {
                array_push($resultArray, "<a href=\"/post?url=$postUrl\" draggable=\"false\">" . POST_PRIVEW_READMORE_TITLE . "</a>");
            }
            return $resultArray;
        }
    
        /**
         * Gets the full text of the post in the form of Markdown markup
         */
        public function getPostFullText($parser, $array) {
            unset($array[0]);

            foreach ($array as $index => $value) {
                $array[$index] = $this->stringPostProccessing($value);
            }
    
            $table_indexes = array();
            foreach ($array as $index => $row) {
                if (strpos($row, '|') !== false) {
                    array_push($table_indexes, $index);
                }
            }
    
            if (count($table_indexes) > 1) {
                $table_indexes = $this->splitArrayByCloseNumbers($table_indexes);
                foreach ($table_indexes as $group) {
                    $head_item = $group[0];
                    unset($group[0]);
    
                    foreach ($group as $in_group_index) {
                        $array[$head_item] .= $array[$in_group_index];
                        unset($array[$in_group_index]);
                    }
                }
            }
    
            $text = implode("\n", $array);
    
            return $parser->defaultTransform($text);
        }

        /**
         * Gets the title of the post from the first line of the file
         */
        public function getPostTitle($array) {
            $post_title = $array[0];
    
            unset($array);
    
            return $post_title;
        }
    }

    /**
     * Post Collector class
     */
    class PostsCollector {
        private $privatePostsList = array();

        /**
         * Gets all posts from files with the extension .md 
         * from the directory and subdirectories
         */
        public function getPosts($dir) {
            $files = scandir($dir);
    
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                
                $path = $dir . DIRECTORY_SEPARATOR . $file;
    
                if (is_dir($path)) {
                    $this->getPosts($path);
                } else {
                    $extension = pathinfo($path, PATHINFO_EXTENSION);
    
                    if ($extension === 'md') {
                        $relativePath = $dir . DIRECTORY_SEPARATOR . basename($path);
                        array_push($this->privatePostsList, $relativePath);
                    }
                }
            }
            
            return $this->privatePostsList;
        }
    }
?>