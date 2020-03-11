<?php
/* @var $this yii\web\View */

use yii\helpers\Url; ?>
<!-- ##### Hero Area Start ##### -->
<section class="hero--area section-padding-80">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-12 col-md-7 col-lg-12">
                <div class="tab-content">
                    <div class="tab-pane show active" id="post-1" role="tabpanel" aria-labelledby="post-1-tab">
                        <!-- Single Feature Post -->
                        <div class="single-feature-post video-post bg-img"
                             style="background-image:url(<?= '/' . $firstPost['src'] ?>)">
                            <!-- Post Content -->
                            <div class="post-content">
                                <?php foreach($firstPost['categories'] as $category):?>
                                <a style="background-color:<?= $category['color'] ?>" class="post-cata"
                                   href="#"><?= $category['name'] ?></a>
                                <?php endforeach; ?>
                                <a href="<?= Url::toRoute(['posts/view', 'id' => $firstPost['id']])?>"
                                   class="post-title"><?= $firstPost['name'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Hero Area End ##### -->

<!-- ##### Trending Posts Area Start ##### -->
<section class="trending-posts-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Heading -->
                <div class="section-heading">
                    <h4>Trending Videos</h4>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($trendingPosts as $trendingPost): ?>
            <!-- Single Blog Post -->
            <div class="col-12 col-md-4">
                <div class="single-post-area mb-80">
                    <!-- Post Thumbnail -->
                    <div class="post-thumbnail">
                        <img src="<?='/' . $trendingPost['src']?>" alt="">
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <?php foreach($trendingPost['categories'] as $category): ?>
                        <a href="#" style="background-color: <?= $category['color'] ?>"
                           class="post-cata cata-sm cata-success"><?= $category['name']?></a>
                        <?php endforeach; ?>
                        <a href="<?=Url::toRoute(['posts/view', 'id' => $trendingPost['id']])?>"
                           class="post-title"><?= $trendingPost['name'] ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<!-- ##### Trending Posts Area End ##### -->

<!-- ##### Vizew Post Area Start ##### -->
<section class="vizew-post-area mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="all-posts-area">
                    <!-- Section Heading -->
                    <div class="section-heading style-2">
                        <h4>Featured Videos</h4>
                        <div class="line"></div>
                    </div>
                    <!-- Featured Post Slides -->
                    <div class="featured-post-slides owl-carousel mb-30">
                        <!-- Single Feature Post -->
                        <?php foreach($featuredPosts as $featuredPost ): ?>
                        <div class="single-feature-post video-post bg-img"
                             style="background-image: url('<?='/' . $featuredPost['src']?>')">
                            <!-- Post Content -->
                            <div class="post-content">
                                <?php foreach($featuredPost['categories'] as $category): ?>
                                <a href="#" class="post-cata my-category"
                                   style="background-color:<?= $category['color'] ?>"><?= $category['name'] ?></a>
                                <?php endforeach; ?>
                                <a href="<?=Url::toRoute(['posts/view', 'id' => $featuredPost['id']])?>"
                                   class="post-title"><?= $featuredPost['name'] ?></a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="row">
                    <?php foreach($popularCategories as $category):?>
                    <div class="col-12 col-lg-6">
                        <!-- Section Heading -->
                        <div class="section-heading style-2">
                            <h4><?= $category['name'] ?></h4>
                            <div class="line"></div>
                        </div>

                        <!-- Business Video Slides -->
                        <div class="business-video-slides owl-carousel mb-50">
                            <?php foreach($category['posts'] as $post): ?>
                            <!-- Single Blog Post -->
                            <div class="single-post-area my-area single-feature-post video-post"
                                 style="background-image: url('<?='/' . $post['src']?>'); background-repeat: no-repeat">
                                <a href="{{route('single.post',$topic)}}" class="btn play-btn"><i
                                            class="fa fa-play" aria-hidden="true"></i></a>

                                <!-- Post Content -->
                                <div class="post-content">
                                    <a href="#" style="background-color:<?= $category['color'] ?>"
                                       class="post-cata cata-sm cata-primary"><?= $category['name'] ?></a>
                                    <a href="<?=Url::toRoute(['posts/view', 'id' => $post['id']])?>"
                                       class="post-title my-title"><?= $post['name'] ?></a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
                <div class="section-heading style-2">
                    <h4>News You May Like</h4>
                    <div class="line"></div>
                </div>
                <?php foreach($randomPosts as $randomPost): ?>
                <!-- Single Post Area -->
                <div class="single-post-area mb-30">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="<?='/' . $randomPost['src']?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <!-- Post Content -->
                            <div class="post-content mt-0">
                                <?php foreach($randomPost['categories'] as $category) : ?>
                                <a href="#" class="post-cata cata-sm cata-success"
                                   style="background-color:<?= $category['color'] ?>"><?= $category['name'] ?></a>
                                <?php endforeach; ?>
                                <a href="<?=Url::toRoute(['posts/view', 'id' => $randomPost['id']])?>"
                                   class="post-title mb-2"><?= $randomPost['name'] ?></a>
                                <div class="post-meta d-flex align-items-center mb-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Section Heading -->
            </div>
            <div class="col-12 col-md-5 col-lg-4">
                <div class="sidebar-area">
                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget followers-widget mb-50">
                        <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span
                                    class="counter">198</span><span>Fan</span></a>
                        <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span
                                    class="counter">220</span><span>Followers</span></a>
                        <a href="#" class="google"><i class="fa fa-google" aria-hidden="true"></i><span
                                    class="counter">140</span><span>Subscribe</span></a>
                    </div>
                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget latest-video-widget mb-50">
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Latest Videos</h4>
                            <div class="line"></div>
                        </div>

                        <!-- Single Blog Post -->
                        <div class="single-post-area mb-30">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <img src="<?='/' . $firstPost['src']?>" alt="">
                            </div>

                            <!-- Post Content -->
                            <div class="post-content">
                                <?php foreach($firstPost['categories'] as $category): ?>

                                <a href="#" class="post-cata cata-sm cata-success"
                                   style=" background-color: <?= $category['color'] ?>"><?= $category['name'] ?></a>
                                <?php endforeach; ?>
                                <a href="<?=Url::toRoute(['posts/view', 'id' => $firstPost['id']])?>"
                                   class="post-title"><?= $firstPost['name'] ?></a>
                            </div>
                        </div>
                    </div>

                    <!-- ***** Single Widget ***** -->
                    <div class="single-widget newsletter-widget mb-50">
                        <!-- Section Heading -->
                        <div class="section-heading style-2 mb-30">
                            <h4>Newsletter</h4>
                            <div class="line"></div>
                        </div>
                        <p>Subscribe our newsletter gor get notification about new updates, information discount,
                            etc.</p>
                        <!-- Newsletter Form -->
                        <div class="newsletter-form">
                            <form action="#" method="post">
                                <input type="email" name="nl-email" class="form-control mb-15" id="emailnl"
                                       placeholder="Enter your email">
                                <button type="submit" class="btn vizew-btn w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- ##### Vizew Psot Area End ##### -->
