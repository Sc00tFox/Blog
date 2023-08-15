<?php
    date_default_timezone_set(date_default_timezone_get());

    include_once($_SERVER["DOCUMENT_ROOT"] . "/system/modules/configuration.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/system/modules/posts.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/Michelf/MarkdownExtra.inc.php");

    $results = [];
    $searchPage = 1;

    $error = false;

    if (isset($_POST['search_value']) && isset($_POST['search_page'])) {
        $search_value = trim($_POST['search_value']);
        $search_value = strip_tags($search_value);
        $search_value = stripslashes($search_value);
        $search_value = htmlspecialchars($search_value, ENT_QUOTES);
        $search_value = mb_strtolower($search_value);

        $pageNumber = trim($_POST['search_page']);
        $pageNumber = strip_tags($pageNumber);
        $pageNumber = stripslashes($pageNumber);
        $pageNumber = htmlspecialchars($pageNumber, ENT_QUOTES);

        if (!is_numeric($pageNumber)) {
            $error = true;
        }
    
        if ($error == false) {
            if ($pageNumber < 1) {
                $pageNumber = 1;
            }
    
            $previousPageNumber = $pageNumber - 1;
            $nextPageNumber = $pageNumber + 1;
    
            $basePath = $_SERVER["DOCUMENT_ROOT"] . "/posts";
    
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basePath));
    
            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'md') {
                    $content = mb_strtolower(file_get_contents($file->getPathname()), 'UTF-8');
                    if (stripos($content, $search_value) !== false) {
                        array_push($results, $file->getPathname());
                    }
                }
            }
            sort($results);
        }
    }
?>

<?php
    // Проверка на недопустимый аргумент текущей страницы поиска
    $posts = new Posts();
    $checkPostsList = $posts->preparePosts($results);
    if ($checkPostsList[0] == "multiple") {
        unset($checkPostsList[0]);
    }

    if ($pageNumber > count($checkPostsList)) {
        unset($posts);
        unset($checkPostsList);

        $error = true;
    }

    unset($posts);
    unset($checkPostsList);
?>
<?php if ($error == false):?>
    <?php if (count($results) > 0):?>
        <?php require("search_body.php");?>
    <?php else:?>
        <?php require("search_body_none.php");?>
    <?php endif;?>
<?php else:?>
    <?php require("search_body_none.php");?>
<?php endif;?>