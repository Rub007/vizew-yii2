<?php
?>
<div class="vizew-pager-prev">
    <p>PREVIOUS ARTICLE</p>
    <!-- Single Feature Post -->
    <div class="single-feature-post video-post bg-img pager-article"
         style="background-image: url(<?='/'.$previous->src ?>); ">
        <!-- Post Content -->
        <div class="post-content">
            <?php foreach ($previous->categories as $category): ?>
                <a href="" class="post-cata cata-sm cata-success"
                   style="background-color:<?= $category->color ?>"><?= $category->name?></a>
            <?php endforeach; ?>
            <a href="<?=$previous->getViewUrl()?>"
               class="post-title"><?= $previous->name?></a>
        </div>
    </div>
</div>

