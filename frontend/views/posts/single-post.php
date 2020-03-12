<!-- ##### Pager Area Start ##### -->
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="vizew-pager-area">
    <?php if ($previous) : ?>
        <div class="vizew-pager-prev">
            <p>PREVIOUS ARTICLE</p>
            <!-- Single Feature Post -->
            <div class="single-feature-post video-post bg-img pager-article"
                 style="background-image: url(<?='/'.$previous['src'] ?>);">
                <!-- Post Content -->
                <div class="post-content">
                    <?php foreach ($previous['categories'] as $category): ?>
                        <a href="" class="post-cata cata-sm cata-success"
                           style="background-color:<?= $category['color'] ?>"><?= $category['name'] ?></a>
                    <?php endforeach; ?>
                    <a href="<?= Url::toRoute(['posts/view', 'id' => $previous['id']]) ?>"
                       class="post-title"><?= $previous['name'] ?></a>
                </div>
            </div>
        </div>

    <?php endif; ?>
    <?php if ($next): ?>
        <div class="vizew-pager-next">
            <p>NEXT ARTICLE</p>
            <!-- Single Feature Post -->
            <div class="single-feature-post video-post bg-img pager-article"
                 style="background-image: url(<?='/'.$next['src'] ?>);   ">
                <!-- Post Content -->
                <div class="post-content">
                    <?php foreach ($next['categories'] as $category): ?>
                        <a href="" class="post-cata cata-sm cata-success"
                           style="background-color:<?= $category['color'] ?>"><?= $category['name'] ?></a>
                    <?php endforeach; ?>
                    <a href="<?= Url::toRoute(['posts/view', 'id' => $next['id']]) ?>"
                       class="post-title"><?= $next['name'] ?></a>
                </div>
                <!-- Video Duration -->
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- ##### Pager Area End ##### -->

<!-- ##### Post Details Area Start ##### -->
<section class="post-details-area mb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">

            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Post Details Content Area -->
            <div class="col-12 col-lg-8 col-xl-7">
                <div class="post-details-content">
                    <!-- Blog Content -->
                    <div class="blog-content">

                        <!-- Post Content -->
                        <div class="post-content mt-0">
                            <?php foreach ($post['categories'] as $category):?>
                                <a href="#" style="background-color: <?= $category['color'] ?>"
                                   class="post-cata cata-sm cata-danger"><?= $category['name']?></a>
                            <?php endforeach;?>
                            <a href="<?= Url::toRoute(['posts/view', 'id' => $post['id']]) ?>"
                               class="post-title mb-2"><?= $post['name'] ?></a>
                            <div class="post-details-thumb mb-50">
                                <img src="/<?=$post['src']?>" alt="">
                            </div>
                            <div class="d-flex justify-content-between mb-30">
                                <div class="post-meta d-flex align-items-center">
                                    <a href="#" class="post-date"><?= $post['created_at'] ?></a>
                                </div>
                                <div class="post-meta d-flex">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 32</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 42</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 7</a>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                foreach($post->getBehavior('galleryBehavior')->getImages() as $image) {
                                    echo Html::img($image->getUrl('medium'));
                                }
                                ?>
                            </div>
                        </div>
                        <div><?= Html::decode($post['description']) ?></div>
                        <!-- Post Author -->
                        <div class="related-post-area mt-5">
                            <!-- Section Title -->
                            <div class="section-heading style-2">
                                <h4>Related Post</h4>
                                <div class="line"></div>
                            </div>

                            <div class="row">
                                <!-- Single Blog Post -->
                                <?php foreach($relateds as $related):?>
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
                                            <a href="<?= Url::toRoute(['posts/view', 'id' => $related['id']])?>"
                                               class="post-title"><?= $related['name'] ?></a>
                                            <div class="post-meta d-flex">
                                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i>
                                                    22</a>
                                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 16</a>
                                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                    15</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>

                        <!-- Comment Area Start -->
                        <div class="comment_area clearfix mb-50">

                            <!-- Section Title -->
                            <div class="section-heading style-2">
                                <h4>Comments</h4>
                                <div class="line"></div>
                            </div>

                            <ul>
                                <!-- Single Comment Area -->
                                <?php foreach ($comments as $oneComment): ?>
                                <li class="single_comment_area">
                                    <!-- Comment Content -->
                                    <div class="comment-content d-flex">
                                        <!-- Comment Meta -->
                                        <div class="comment-meta">
                                            <a href="#" class="comment-date"><?=$oneComment['created_at']?></a>
                                            <h6><?=$oneComment['name']?></h6>
                                            <h6><?=$oneComment['email']?></h6>
                                            <p><?=$oneComment['message']?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Post A Comment Area -->
                        <div class="post-a-comment-area">


                            <!-- Section Title -->
                            <div class="section-heading style-2">
                                <h4>Leave a Comment</h4>
                                <div class="line"></div>
                            </div>

                            <!-- Reply Form -->
                            <div class="contact-form-area">
                                <?php
                                $form = ActiveForm::begin([
                                    'method' => 'post',
                                    'action' => ['comments/add?id='.$post['id']],
                                ]); ?>
                                <div class="form-group">
                                    <?= $form->field($comment, 'name')->textInput()->label('Name') ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($comment, 'email')->input('email')->label('Email') ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($comment, 'message')->input('text')->label('Message') ?>
                                </div>
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Sidebar Widget -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="sidebar-area">

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget share-post-widget mb-50">
                        <p>Share This Post</p>
                        <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                        <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                        <a href="#" class="google"><i class="fa fa-google" aria-hidden="true"></i> Google+</a>
                    </div>
                    <!-- ***** Single Widget ***** -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Post Details Area End ##### -->
