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
        private function stringPostProccessing($string, $postUrl) {
            include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/mobile/mobile_detect.php");

            $mobileDetect = new Mobile_Detect;
            
            if (preg_match("/~~(.*?)~~/", $string)) {
                return preg_replace("/~~(.*?)~~/", "<del>$1</del>", $string);
            } elseif (preg_match("/!video\[(.*?)\]\((.*?)\)/", $string)) {
                if (getConfigByConstant("USE_VIDEO_PREVIEW")) {
                    return preg_replace("/!video\[(.*?)\]\((.*?)\)/", "<img src=\"" . getConfigByConstant("VIDEO_PREVIEW_PATH") . "\" style=\"width: 100%; cursor: pointer;\" onclick=\"location.href='/post?url=" . $postUrl . "'\"/>", $string);
                } else {
                    return "<span>". getConfigByConstant("VIDEO_PREVIEW_TEXT") . "</span>";
                }
            } elseif (preg_match("/!audio\[(.*?)\]\((.*?)\)/", $string)) {
                if (getConfigByConstant("USE_AUDIO_PREVIEW")) {
                    return preg_replace("/!audio\[(.*?)\]\((.*?)\)/", "<img src=\"" . getConfigByConstant("AUDIO_PREVIEW_PATH") . "\" style=\"width: 100%; cursor: pointer;\" onclick=\"location.href='/post?url=" . $postUrl . "'\"/>", $string);
                } else {
                    return "<span>". getConfigByConstant("AUDIO_PREVIEW_TEXT") . "</span>";
                }
            } else {
                return $string;
            }
        }

        /**
         * Determines whether a string is a URL address on the internet or not.
         */
        private function isURL($string) {
            $pattern = '/^(https?:\/\/)?(www\.)?[a-zA-Z0-9_-]+\.[a-zA-Z]{2,6}[a-zA-Z0-9?=&\/._-]*$/';
            if (preg_match($pattern, $string)) {
                return true;
            } else {
                return false;
            }
        }        

        /**
         * Converts a string to markdown for Full Post Text
         */
        private function stringPostProccessingFull($string) {
            include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/mobile/mobile_detect.php");

            $mobileDetect = new Mobile_Detect;
            
            if (preg_match("/~~(.*?)~~/", $string)) {
                return preg_replace("/~~(.*?)~~/", "<del>$1</del>", $string);
            } elseif (preg_match("/!video\[(.*?)\]\((.*?)\)/", $string)) {
                // return preg_replace("/!video\[(.*?)\]\((.*?)\)/", "<iframe height=\"500\" src=\"$2\" title=\"$1\" autoplay=\"0\" frameborder=\"0\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"></iframe>", $string);
                $videoTagString = "/\((.*?)\)/";
                preg_match($videoTagString, $string, $srcMatches);
                $videoSrcString = $srcMatches[1];

                if ($this->isURL($videoSrcString)) {
                    return preg_replace("/!video\[(.*?)\]\((.*?)\)/", "<iframe height=\"500\" src=\"$2\" title=\"$1\" autoplay=\"0\" frameborder=\"0\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"></iframe>", $string);
                } else {
                    return preg_replace("/!video\[(.*?)\]\((.*?)\)/", "<video height=\"500\" controls=\"\" src=\"$2\" title=\"$1\" autoplay=\"0\" frameborder=\"0\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"></video>", $string);
                    // return preg_replace("/!video\[(.*?)\]\((.*?)\)/", "<iframe height=\"500\" src=\"$2\" title=\"$1\" autoplay=\"0\" frameborder=\"0\" allow=\"accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"></iframe>", $string);
                }
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
    
            if (count($array) > getConfigByConstant("MAX_POSTS_PER_PAGE")) {
                $array = array_reverse($array);
                $pages_array = array_chunk($array, getConfigByConstant("MAX_POSTS_PER_PAGE"));
    
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
            try{
                $file = fopen($filePath, "r");
            } catch (Exception $e) {
                return NULL;
            }

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
                $array[$index] = $this->stringPostProccessing($value, $postUrl);
            }

            $sliceIndex = NULL;
            $hasOverflow = false;

            /** 
             * If there are more characters in the first line of the post preview than the overflow limit, 
             * the number of preview lines decreases from the one specified in the config to one, 
             * and the size of this line is reduced to the value equal to the overflow limit divided by 2. 
             */
            if (iconv_strlen($array[1], "UTF-8") > getConfigByConstant("PREVIEW_OVERFLOW_LIMIT") && getConfigByConstant("PREVIEW_OVERFLOW_LIMIT") > 0) {
                if (getConfigByConstant("PREVIEW_ROWS_LIMIT") > 0 && count($array) >= getConfigByConstant("PREVIEW_ROWS_LIMIT")) {
                    $hasOverflow = true;
                    $sliceIndex = 1;
                }
            } else {
                foreach ($array as $index => $row) {
                    if (getConfigByConstant("PREVIEW_ROWS_LIMIT") > 0 && count($array) > getConfigByConstant("PREVIEW_ROWS_LIMIT")) {
                        if ($index >= getConfigByConstant("PREVIEW_ROWS_LIMIT")) {
                            $sliceIndex = $index;
                            break;
                        }
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

            $length = (int) getConfigByConstant("PREVIEW_OVERFLOW_LIMIT") / 2;

            if ($hasOverflow && count($array) == 1) {
                $array[0] = mb_substr($array[0], 0, $length);
                $array[0] .= "...";
            } 

            /** It triggers if the total length of all lines 
             * in the post preview exceeds the overflow limit. 
             */
            if (getConfigByConstant("PREVIEW_ROWS_LIMIT") > 0 && getConfigByConstant("PREVIEW_OVERFLOW_LIMIT") > 0) {
                if (count($array) == 1) {
                    $array[0] = mb_substr($array[0], 0, $length);
                }

                /** 
                 * If there are more than one posts, then the next post after the first one, 
                 * whose size will exceed the overflow limit, will become the last post in the feed.
                 */ 
                if (count($array) > 1) {
                    $maxLen = 0;
                    $maxLenIndex = -1;
    
                    foreach ($array as $index => $row) {
                        if (iconv_strlen($row, "UTF-8") >= getConfigByConstant("PREVIEW_OVERFLOW_LIMIT") && iconv_strlen($row, "UTF-8") > $maxLen) {
                            $maxLen = iconv_strlen($row, "UTF-8");
                            $maxLenIndex = $index;
                        }
                    }
    
                    if ($maxLenIndex != -1) {
                        $array[$maxLenIndex] = mb_substr($array[$maxLenIndex], 0, $length);
                        $array[$maxLenIndex] .= "...";
    
                        $array = array_slice($array, 0, $maxLenIndex + 1);
                        $hasOverflow = true;
                    }
    
                    unset($maxLen);
                    unset($maxLenIndex);
    
                    /**
                     * If the number of lines is two, then the last one will simply be cut in half.
                     */
                    if (count($array) == 2) {
                        $totalLen = 0;
                        $cropIndex = -1;
                        $overflowed = false;
    
                        foreach ($array as $index => $row) {
                            $totalLen = $totalLen + iconv_strlen($row, "UTF-8");
                            $cropIndex = $index;
    
                            if ($totalLen >= getConfigByConstant("PREVIEW_OVERFLOW_LIMIT")) {
                                $overflowed = true;
                                break;
                            }
                        }
    
                        /**
                         *  But if the next line may contain hints of markdown formatting at its beginning, 
                         * it will be simply deleted rather than shortened.
                         */ 
                        if ($overflowed) {
                            $firstChar = $array[$cropIndex][0];
                            if ($firstChar == "[" ||
                                $firstChar == "!" ||
                                $firstChar == "*" ||
                                $firstChar == "~" ||
                                $firstChar == "`") {
                                    $array = array_slice($array, 0, $cropIndex - 1);
                                    $hasOverflow = true;
                                } else {
                                    $array[$cropIndex] = mb_substr($array[$cropIndex], 0, (int) iconv_strlen($array[$cropIndex], "UTF-8") / 2);
                                    $array[$cropIndex] .= "...";
                                    $hasOverflow = true;
                                }
                        }
                        unset($totalLen);
                        unset($removeIndex);
                        unset($overflowed);
                    } else {
                        /** 
                         * If the number of rows is greater than two, 
                         * then the row and all rows following it will be removed 
                         * if the sum of its length and the lengths of the previous rows 
                         * is greater than or equal to the overflow limit.
                         */ 
                        $totalLen = 0;
                        $removeIndex = 0;
                        $overflowed = false;
    
                        foreach ($array as $index => $row) {
                            $totalLen = $totalLen + iconv_strlen($row, "UTF-8");
    
                            if ($totalLen >= getConfigByConstant("PREVIEW_OVERFLOW_LIMIT")) {
                                $overflowed = true;
                                break;
                            }

                            $removeIndex += 1;
                        }
    
                        if ($overflowed) {
                            $array = array_slice($array, 0, $removeIndex);
                            $hasOverflow = true;
                        }
    
                        unset($totalLen);
                        unset($removeIndex);
                        unset($overflowed);
                    }
                }
            }

            $codeTagCount = 0;

            /** Check Code Blocks */
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

            if ($sliceIndex != NULL || $hasOverflow) {
                array_push($resultArray, "<a href=\"/post?url=$postUrl\" draggable=\"false\">" . getConfigByConstant("POST_PREVIEW_READMORE_TITLE") . "</a>");
            }
            return $resultArray;
        }
    
        /**
         * Gets the full text of the post in the form of Markdown markup
         */
        public function getPostFullText($parser, $array) {
            unset($array[0]);

            foreach ($array as $index => $value) {
                $array[$index] = $this->stringPostProccessingFull($value);
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

        /**
         * Gets the text of the pinned post in the form of Markdown markup
         */
        public function getPinnedText($parser, $array) {
            foreach ($array as $index => $value) {
                $array[$index] = $this->stringPostProccessingFull($value);
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