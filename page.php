<?php
    date_default_timezone_set(date_default_timezone_get());

    include_once($_SERVER["DOCUMENT_ROOT"] . "/system/modules/configuration.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/posts.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/location.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/Michelf/MarkdownExtra.inc.php");

    use Michelf\MarkdownExtra;

    $md = new MarkdownExtra();
    $posts = new Posts();
    $PostCollector = new PostsCollector();

    if (!isset($_GET['n'])) {
        header("HTTP/1.0 404 Not Found");
        include($_SERVER['DOCUMENT_ROOT'] . "/system/errors/404.php");
        die;
    }

    $pageNumber = $_GET['n'];

    if (!is_numeric($pageNumber)) {
        header("HTTP/1.0 404 Not Found");
        include($_SERVER['DOCUMENT_ROOT'] . "/system/errors/404.php");
        die;
    }

    if ($pageNumber <= 1) {
        locationTo("");
        die;
    }

    $dir = "./posts";
    $postsList = $posts->preparePosts($PostCollector->getPosts($dir));

    $postsMode = $postsList[0];

    if ($postsMode == "single") {
        locationTo("");
        die;
    }

    unset($postsList[0]);

    if ($pageNumber > count($postsList)) {
        header("HTTP/1.0 404 Not Found");
        include($_SERVER['DOCUMENT_ROOT'] . "/system/errors/404.php");
        die;
    }

    $previousPageNumber = $pageNumber - 1;
    $nextPageNumber = $pageNumber + 1;

    $pinned = "./pinned.md";
    $hasPinnedPost = false;
    
    if (file_exists($pinned)) {
        $hasPinnedPost = true;
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?=getConfigByConstant("BLOG_DESCRIPTION");?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/head.php");?>
        <?php if (getConfigByConstant("BLOG_USE_HTTPS") == true):?>
            <script defer src="https://<?=$_SERVER['SERVER_NAME'];?>/system/assets/js/main.js"></script>
        <?php else:?>
            <script defer src="http://<?=$_SERVER['SERVER_NAME'];?>/system/assets/js/main.js"></script>
        <?php endif;?>
        <title><?=getConfigByConstant("BLOG_NAME");?></title>
    </head>
    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/system/themes/" . getConfigByConstant("BLOG_THEME") . "/styles.php");?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/header.php");?>
        <?php if ($previousPageNumber <= 1):?>
            <div class="page-navigation-button"><a href="/"><?=getConfigByConstant("PREVIOUS_PAGE");?></a></div>
        <?php else:?>
            <div class="page-navigation-button"><a href="/page?n=<?=$previousPageNumber;?>"><?=getConfigByConstant("PREVIOUS_PAGE");?></a></div>
        <?php endif;?>
        <?php if ($hasPinnedPost):?>
            <div class="pinned-background">
                <?php 
                    $pinnedArray = $posts->readPost($pinned);
                    $pinnedText = $posts->getPinedText($md, $pinnedArray);
                    unset($pinnedArray);
                    unset($hasPinnedPost);
                ?>
                <div class="pinned-text"><?=$pinnedText;?></div>
            </div>
        <?php endif;?>
        <div class="posts-background">
            <?php if (count($postsList) < 1):?>
                <?php locationTo("");?>
                <?php die;?>
            <?php else:?>
                <?php foreach ($postsList[$pageNumber] as $post):?>
                    <?php
                        $postArray = $posts->readPost($post);
                        $postUrl = str_replace("./posts/", "", $post);
                        $postUrl = str_replace(".md", "", $postUrl);
                        $postText = $posts->getPostText($md, $postArray, $postUrl);
                    ?>
                    <div class="post-body">
                        <span class="post-title"><a class="post-title-link" href="/post?url=<?=$postUrl;?>"><?=$posts->getPostTitle($postArray);?></a></span>
                        <?php if (count($postText) > 1):?>
                            <div class="post-text"><?=$postText[0];?><?=$postText[1];?></div>
                        <?php else:?>
                            <div class="post-text"><?=$postText[0];?></div>
                        <?php endif;?>
                        <span class="post-date"><?=$posts->getPostDate($post);?></span>
                    </div>
                    <?php 
                        unset($postArray);
                    ?>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        <?php if ($nextPageNumber <= count($postsList)):?>
            <div class="page-navigation-button"><a href="/page?n=<?=$nextPageNumber;?>"><?=getConfigByConstant("NEXT_PAGE");?></a></div>
        <?php endif;?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/footer.php");?>
    </body>
</html>