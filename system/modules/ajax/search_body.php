<?php
    use Michelf\MarkdownExtra;

    $md = new MarkdownExtra();
    $posts = new Posts();
    $postsList = $posts->preparePosts($results);

    $postsMode = $postsList[0];
    unset($postsList[0]);
?>
<?php if ($postsMode == "multiple"):?>
    <?php if ($previousPageNumber == 1):?>
        <div class="page-navigation-button"><a href="/search?q=<?=urlencode($search_value);?>"><?=PREVIOUS_PAGE;?></a></div>
    <?php elseif ($previousPageNumber > 1):?>
        <div class="page-navigation-button"><a href="/search?q=<?=urlencode($search_value);?>&n=<?=$previousPageNumber;?>"><?=PREVIOUS_PAGE;?></a></div>
    <?php endif;?>
<?php endif;?>
<div class="posts-background">
    <?php if ($postsMode == "single"):?>
        <?php foreach ($postsList as $post):?>
            <?php 
                $postArray = $posts->readPost($post);
                $postUrl = str_replace($_SERVER['DOCUMENT_ROOT'] . "/posts/", "", $post);
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
                <?php
                    $post = str_replace($_SERVER['DOCUMENT_ROOT'] . "/posts/", "", $post);
                ?>
                <span class="post-date"><?=$posts->getPostDate($post);?></span>
            </div>
            <?php 
                unset($postArray);
            ?>
        <?php endforeach;?>
    <?php elseif ($postsMode == "multiple"):?>
        <?php foreach ($postsList[$pageNumber] as $post):?>
            <?php
                $postArray = $posts->readPost($post);
                $postUrl = str_replace($_SERVER['DOCUMENT_ROOT'] . "/posts/", "", $post);
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
                <?php
                    $post = str_replace($_SERVER['DOCUMENT_ROOT'] . "/posts/", "", $post);
                ?>
                <span class="post-date"><?=$posts->getPostDate($post);?></span>
            </div>
            <?php 
                unset($postArray);
            ?>
        <?php endforeach;?>
    <?php endif;?>
</div>
<?php if ($postsMode == "multiple"):?>
    <?php if ($nextPageNumber <= count($postsList)):?>
        <div class="page-navigation-button"><a href="/search?q=<?=urlencode($search_value);?>&n=<?=$nextPageNumber;?>"><?=NEXT_PAGE;?></a></div>
    <?php endif;?>
<?php endif;?>