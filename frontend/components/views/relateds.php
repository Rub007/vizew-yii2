<?php use yii\helpers\Url;?>
<h1><?= $title?></h1>
<?php
foreach($relateds as $related):?>
    <div class="col-12 col-md-6">
        <div class="single-post-area mb-50">
            <!-- Post Thumbnail -->
            <div class="post-thumbnail">
                <img src="<?='/'.$related['src'] ?>" alt="">
                <!-- Video Duration -->
            </div>
            <!-- Post Content -->
            <div class="post-content">
                <?php foreach ($related['categories'] as $category) :?>
                    <a href="#" class="post-cata cata-sm cata-success"
                       style="background-color: <?=$category['color']?>"><?=$category['name']?></a>
                <?php endforeach; ?>
                <a href="<?=$related->getViewUrl()?>"
                   class="post-title"><?= $related['name']?></a>
                <div class="post-meta d-flex">
                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i>
                        22</a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 16</a>
                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>15</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>
