<div class="footer">
    <div class="footer-item">&copy;</div>
    <div class="footer-item"><?=BLOG_AUTHOR_NAME;?></div>
    <?php if (BLOG_CREATE_YEAR == date("Y") || BLOG_CREATE_YEAR > date("Y")):?>
        <iv class="footer-item"><?=BLOG_CREATE_YEAR;?></div>
    <?php else:?>
        <iv class="footer-item"><?=BLOG_CREATE_YEAR;?> – <?=date("Y");?></div>
    <?php endif;?>
</div>