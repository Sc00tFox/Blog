<?php
    date_default_timezone_set(date_default_timezone_get());

    include_once($_SERVER["DOCUMENT_ROOT"] . "/system/modules/configuration.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/posts.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/Michelf/MarkdownExtra.inc.php");

    use Michelf\MarkdownExtra;

    $md = new MarkdownExtra();
    $posts = new Posts();

    $postUrl = $_GET['url'];
    $post = $postUrl;
    $postUrl = $_SERVER['DOCUMENT_ROOT'] . "/posts/" . $postUrl . ".md";
    $postArray = $posts->readPost($postUrl);

    if ($postArray == NULL) {
        header("HTTP/1.0 404 Not Found");
        include($_SERVER['DOCUMENT_ROOT'] . "/system/errors/404.php");
        die;
    }

    $usePostTitleAsDescription = false;
    $postLen = count($postArray);

    if ($postLen >= 2) {
        $charLimit = 150;
        $firstLineLen = strlen($postArray[1]);
        $postDescription = NULL;

        if ($firstLineLen >= $charLimit) {
            $postDescription = substr($postArray[1], 0,  $firstLineLen / 2);
        } else {
            $postDescription = $postArray[0] . " " . mb_strtolower($postArray[1]);
        }
        unset($charLimit);
        unset($firstLineLen);
    } else if ($postLen <= 1) {
        $usePostTitleAsDescription = true;
    } else {
        $usePostTitleAsDescription = true;
    }
    unset($postLen);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php if ($usePostTitleAsDescription):?>
            <meta name="description" content="<?=htmlspecialchars(stripslashes(strip_tags(trim($postArray[0]))));?>">
        <?php else:?>
            <meta name="description" content="<?=htmlspecialchars(stripslashes(strip_tags(trim($postArray[0] . $posts->getPostFullText($md, $postDescription)))));?>">
        <?php endif;?>
        <?php 
            unset($usePostTitleAsDescription);
            unset($postDescription);
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/head.php");?>
        <?php if (getConfigByConstant("BLOG_USE_HTTPS") == true):?>
            <script defer src="https://<?=$_SERVER['SERVER_NAME'];?>/system/assets/js/main.js"></script>
        <?php else:?>
            <script defer src="http://<?=$_SERVER['SERVER_NAME'];?>/system/assets/js/main.js"></script>
        <?php endif;?>
        <title><?=$posts->getPostTitle($postArray);?></title>
    </head>
    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/system/themes/" . getConfigByConstant("BLOG_THEME") . "/styles.php");?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/header.php");?>
        <div class="posts-background">
            <div class="post-body">
                <?php if ($postArray != NULL):?>
                    <span class="post-title-static"><?=$posts->getPostTitle($postArray);?></span>
                    <div class="post-text"><?=$posts->getPostFullText($md, $postArray);?></div>
                    <span class="post-date"><?=$posts->getPostDate($post);?></span>
                <?php else:?>
                    <div class="page-error"><?=getConfigByConstant("POST_NOT_FOUND");?></div>
                <?php endif;?>
            </div>
            <?php 
                unset($postArray);
            ?>
        </div>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/footer.php");?>
    </body>
</html>