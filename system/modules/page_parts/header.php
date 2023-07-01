<div class="header">
    <div class="logo-title-block">
        <div class="logo-title">
            <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . BLOG_LOGO_PATH)):?>
                <?php if (BLOG_USE_HTTPS == true):?>
                    <img class="blog-logo" src="https://<?=$_SERVER['SERVER_NAME'];?><?=BLOG_LOGO_PATH;?>" draggable="false"/>
                <?php else:?>
                    <img class="blog-logo" src="http://<?=$_SERVER['SERVER_NAME'];?><?=BLOG_LOGO_PATH;?>" draggable="false"/>
                <?php endif;?>
            <?php else:?>
                <img class="blog-logo" src="./system/assets/images/default_logo.png" draggable="false"/>
            <?php endif;?>
            <span class="blog-title"><a class="blog-title-link" href="/" draggable="false"><?=BLOG_NAME;?></a></span>
        </div>
        <div class="sub-title"><?=BLOG_SUBTITLE;?></div>
    </div>
    <a class="search-button" href="/search"><?=SEARCH_BUTTON_VALUE;?></a>
</div>