<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/head.php");?>
        <title><?=BLOG_NAME;?> – <?=POST_NOT_FOUND;?></title>
    </head>
    <body>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/system/themes/" . BLOG_THEME . "/styles.php");?>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/header.php");?>
        <div class="posts-background">
            <div class="post-body">
                <div class="page-error"><?=POST_NOT_FOUND;?></div>
            </div>
        </div>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/system/modules/page_parts/footer.php");?>
    </body>
</html>