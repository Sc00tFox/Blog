<div class="footer">
    <div class="footer-item">&copy;</div>
    <div class="footer-item"><?=getConfigByConstant("BLOG_AUTHOR_NAME");?></div>
    <?php if (getConfigByConstant("BLOG_CREATE_YEAR") == date("Y") || getConfigByConstant("BLOG_CREATE_YEAR") > date("Y")):?>
        <iv class="footer-item"><?=getConfigByConstant("BLOG_CREATE_YEAR");?></div>
    <?php else:?>
        <iv class="footer-item"><?=getConfigByConstant("BLOG_CREATE_YEAR");?> – <?=date("Y");?></div>
    <?php endif;?>
</div>