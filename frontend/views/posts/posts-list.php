<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="container">
        <div class="row">
            <div class="col">
<!--                <div>-->
<!--                    @if(session()->has('message'))-->
<!--                        <div>{{session('message')}}</div>-->
<!--                    @endif-->
<!--                </div>-->
                <!-- Archive Catagory & View Options -->
                <div class="archive-catagory-view mb-50 d-flex align-items-center justify-content-between">
                    <!-- Catagory -->
                    <div class="archive-catagory">
                        <h4>All News </h4>
                    </div>
                </div>
                <!-- Single Post Area -->
                <?php foreach ($posts as $post){ ?>
                    <div class="single-post-area style-2">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <!-- Post Thumbnail -->
                                    <a href="<?=Url::toRoute(['posts/view', 'id' => $post['id']])?>">
                                        <div>dsfffffffffffdsfsds</div>
                                        <img src="/<?=$post['src']?>" alt="">
                                    </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <!-- Post Content -->
                                <div class="post-content mt-0">
                                    <?php foreach ($post['categories'] as $category){ ?>
                                        <a href="#" class="post-cata cata-sm cata-success" style="background-color: <?=$category['color']?>"><?=$category['name']?></a>
                                    <?php }?>
                                    <a href="<?=Url::toRoute(['posts/view', 'id' => $post['id']])?>" class="post-title mb-2"><?=$post['name']?></a>
                                    <div class="post-meta d-flex align-items-center mb-2">
                                        <a href="#" class="post-date"><?= $post['created_at'] ?></a>
                                    </div>
                                    <div class="mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <!-- Pagination -->
                <nav class="mt-50">
                    <ul class="pagination justify-content-center">
                       <?= LinkPager::widget([
                           'pagination' => $pages,
                       ]);?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
