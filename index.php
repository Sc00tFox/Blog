<?php 
    ini_set('display_errors', 1);
    
    date_default_timezone_set(date_default_timezone_get());

    include_once($_SERVER["DOCUMENT_ROOT"] . "/system/modules/configuration.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/posts.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/Michelf/MarkdownExtra.inc.php");
    
    use Michelf\MarkdownExtra;

    $md = new MarkdownExtra();
    $posts = new Posts();
    $PostCollector = new PostsCollector();

    $dir = "./posts";
    $postsList = $posts->preparePosts($PostCollector->getPosts($dir));

    $postsMode = $postsList[0];
    unset($postsList[0]);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?=BLOG_DESCRIPTION;?>">
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
        <div class="posts-background">
            <?php if (count($postsList) < 1):?>
                <h1><?=getConfigByConstant("POST_NONE");?></h1>
            <?php else:?>
                <?php if ($postsMode == "single"):?>
                    <?php foreach ($postsList as $post):?>
                        <?php 
                            $postArray = $posts->readPost($post);
                            $postUrl = str_replace("./posts/", "", $post);
                            $postUrl = str_replace(".md", "", $postUrl);
                            $postText = $posts->getPostText($md, $postArray, $postUrl);
                        ?>
                        <div class="post-body">
                            <span class="post-title"><a class="post-title-link" href="/post?url=<?=$postUrl;?>" draggable="false"><?=$posts->getPostTitle($postArray);?></a></span>
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
                <?php elseif ($postsMode == "multiple"):?>
                    <?php foreach ($postsList[1] as $post):?>
                        <?php
                            $postArray = $posts->readPost($post);
                            $postUrl = str_replace("./posts/", "", $post);
                            $postUrl = str_replace(".md", "", $postUrl);
                            $postText = $posts->getPostText($md, $postArray, $postUrl);
                        ?>
                        <div class="post-body">
                            <span class="post-title"><a class="post-title-link" href="/post?url=<?=$postUrl;?>" draggable="false"><?=$posts->getPostTitle($postArray);?></a></span>
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
            <?php endif;?>
        </div>
        <?php if ($postsMode == "multiple"):?>
            <div class="page-navigation-button"><a href="/page?n=2"><?=getConfigByConstant("NEXT_PAGE");?></a></div>
        <?php endif;?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/footer.php");?>
    </body>
</html>