<div class="header">
    <div class="logo-title-block">
        <div class="logo-title">
            <?php if (file_exists($_SERVER['DOCUMENT_ROOT'] . getConfigByConstant("BLOG_LOGO_PATH"))):?>
                <?php if (getConfigByConstant("BLOG_USE_HTTPS") == true):?>
                    <img class="blog-logo" src="https://<?=$_SERVER['SERVER_NAME'];?><?=getConfigByConstant("BLOG_LOGO_PATH");?>" draggable="false"/>
                <?php else:?>
                    <img class="blog-logo" src="http://<?=$_SERVER['SERVER_NAME'];?><?=getConfigByConstant("BLOG_LOGO_PATH");?>" draggable="false"/>
                <?php endif;?>
            <?php else:?>
                <img class="blog-logo" src="./system/assets/images/default_logo.png" draggable="false"/>
            <?php endif;?>
            <span class="blog-title"><a class="blog-title-link" href="/" draggable="false"><?=getConfigByConstant("BLOG_NAME");?></a></span>
        </div>
        <div class="sub-title"><?=getConfigByConstant("BLOG_SUBTITLE");?></div>
    </div>
    <a class="search-button" href="/search" draggable="false"><?=getConfigByConstant("SEARCH_BUTTON_VALUE");?></a>
</div>