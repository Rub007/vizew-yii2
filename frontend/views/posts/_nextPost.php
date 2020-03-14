<?php
?>
<div class="vizew-pager-next">
    <p>NEXT ARTICLE</p>
    <!-- Single Feature Post -->
    <div class="single-feature-post video-post bg-img pager-article"
         style="background-image: url(<?='/'.$next->src ?>);    ">
        <!-- Post Content -->
        <div class="post-content">
            <?php foreach ($next->categories as $category): ?>
                <a href="" class="post-cata cata-sm cata-success"
                   style="background-color:<?= $category->color ?>"><?= $category->name ?></a>
            <?php endforeach; ?>
            <a href="<?=$next->getViewUrl()?>"
               class="post-title"><?= $next->name ?></a>
        </div>
        <!-- Video Duration -->
    </div>
</div>
