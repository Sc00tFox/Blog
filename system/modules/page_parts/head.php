<?php if (BLOG_USE_CUSTOM_FAVICON == false):?>
    <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . BLOG_LOGO_PATH)):?>
        <?php if (BLOG_USE_HTTPS == true):?>
            <link rel="shortcut icon" href="https://<?=$_SERVER['SERVER_NAME'];?><?=BLOG_LOGO_PATH;?>" type="image/x-icon">
        <?php else:?>
            <link rel="shortcut icon" href="http://<?=$_SERVER['SERVER_NAME'];?><?=BLOG_LOGO_PATH;?>" type="image/x-icon">
        <?php endif;?>
    <?php else:?>
        <?php if (BLOG_USE_HTTPS == true):?>
            <link rel="shortcut icon" href="https://<?=$_SERVER['SERVER_NAME'];?>/system/assets/images/default_logo.png" type="image/x-icon">
        <?php else:?>
            <link rel="shortcut icon" href="http://<?=$_SERVER['SERVER_NAME'];?>/system/assets/images/default_logo.png" type="image/x-icon">
        <?php endif;?>
    <?php endif;?>
<?php else:?>
    <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . BLOG_CUSTUM_FAVICON_PATH) && BLOG_CUSTUM_FAVICON_PATH !== ""):?>
        <?php if (BLOG_USE_HTTPS == true):?>
            <link rel="shortcut icon" href="https://<?=$_SERVER['SERVER_NAME'];?><?=BLOG_CUSTUM_FAVICON_PATH;?>" type="image/x-icon">
        <?php else:?>
            <link rel="shortcut icon" href="http://<?=$_SERVER['SERVER_NAME'];?><?=BLOG_CUSTUM_FAVICON_PATH;?>" type="image/x-icon">
        <?php endif;?>
    <?php else:?>
        <?php if (BLOG_USE_HTTPS == true):?>
            <link rel="shortcut icon" href="https://<?=$_SERVER['SERVER_NAME'];?>/system/assets/images/default_logo.png" type="image/x-icon">
        <?php else:?>
            <link rel="shortcut icon" href="http://<?=$_SERVER['SERVER_NAME'];?>/system/assets/images/default_logo.png" type="image/x-icon">
        <?php endif;?>
    <?php endif;?>
<?php endif;?>