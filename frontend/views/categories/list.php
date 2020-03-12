<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\widgets\ListView;

?>
<div class="container">
        <div class="row">
            <div class="col">
            <!-- Archive Catagory & View Options -->
            <div class="archive-catagory-view mb-50 d-flex align-items-center justify-content-between">
                <!-- Catagory -->
            <div class="single-post-area style-2">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <!-- Post Thumbnail -->
                        <a href="../../../backend/web/index.php">
                            <img src="<?= '/' . $model->src ?>" alt="">
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Post Content -->
                        <div class="post-content mt-0">
                            <a href="<?= Url::toRoute(['posts/view', 'id' => $model['id']])?>" class="post-title mb-2"><?= $model['name'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
