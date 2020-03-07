<?php

use yii\helpers\Url;

?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Archive Catagory & View Options -->
            <div class="archive-catagory-view mb-50 d-flex align-items-center justify-content-between">
                <!-- Catagory -->
                <div class="archive-catagory">
                    <a class="post-cata cata-sm cata-success" style="background-color: <?= $category['color'] ?>"><?= $category['name']?></a>
                    <h4>Posts</h4>
                </div>
            </div>
            <!-- Single Post Area -->
            <?php foreach ($category['posts'] as $post): ?>
            <div class="single-post-area style-2">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <!-- Post Thumbnail -->
                        <a href="../../../backend/web/index.php">
                            <img src="<?= 'http://yii-application-admin.loc/' . $post['src'] ?>" alt="">
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Post Content -->
                        <div class="post-content mt-0">
                            <a href="<?= Url::toRoute(['posts/view', 'id' => $post['id']])?>" class="post-title mb-2"><?= $post['name'] ?></a>
                        </div>
                    </div>
                </div>
            </div><?php endforeach; ?>
        </div>
    </div>
</div>
