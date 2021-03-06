<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\components\CategoriesWidget;
$categories  = CategoriesWidget::categories();
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>

<body>
<!-- Preloader -->
<div class="preloader d-flex align-items-center justify-content-center">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<!-- Top Header Area -->
<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Navbar Area -->
    <div class="vizew-main-menu" id="sticker">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">

                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="vizewNav">

                    <!-- Nav brand -->
                    <a href="" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <div class="classy-menu">
                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/posts') ?>">News</a></li>
                                <li class="cn-dropdown-item has-down"><a href="#">Categories</a>
                                    <ul class="dropdown">
                                        <?php
                                            foreach ($categories as $category):
                                        ?>
                                        <li><a href="<?=Url::toRoute(['/categories','id' => $category['id']]) ?>"><?=$category['name']?></a></li>
                                        <?php
                                            endforeach;
                                        ?>
                                    </ul>
                                    <span class="dd-trigger"></span></li>
                                <li><a href="<?= \yii\helpers\Url::to('/contact') ?>">Contact</a></li>
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->
<?php
    echo $content
?>
<!-- ##### Footer Area Start ##### -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <!-- Footer Widget Area -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget mb-70">
                    <!-- Logo -->
                    <a href="{{route('home')}}" class="foo-logo d-block mb-4"><img src="img/core-img/logo2.png" alt=""></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>
                    <!-- Footer Newsletter Area -->
                    <div class="footer-nl-area">
                        <form action="#" method="post">
                            <input type="email" name="nl-email" class="form-control" id="nlEmail" placeholder="Your email">
                            <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer Widget Area -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget mb-70">
                    <h6 class="widget-title">Latest Twister</h6>
                    <!-- Twitter Slides -->
                    <div class="twitter-slides owl-carousel">

                        <!-- Single Twitter Slide -->
                        <div class="single--twitter-slide">
                            <!-- Single Twit -->
                            <div class="single-twit">
                                <p><i class="fa fa-twitter"></i> <span>@Leonard</span> I am so happy because I found this magazine, and it just made Vizeweasier. Thanks for sharing</p>
                            </div>
                            <!-- Single Twit -->
                            <div class="single-twit">
                                <p><i class="fa fa-twitter"></i> <span>@Leonard</span> I am so happy because I found this magazine, and it just made Vizeweasier. Thanks for sharing</p>
                            </div>
                        </div>

                        <!-- Single Twitter Slide -->
                        <div class="single--twitter-slide">
                            <!-- Single Twit -->
                            <div class="single-twit">
                                <p><i class="fa fa-twitter"></i> <span>@Colorlib</span> I am so happy because I found this magazine, and it just made Vizeweasier. Thanks for sharing</p>
                            </div>
                            <!-- Single Twit -->
                            <div class="single-twit">
                                <p><i class="fa fa-twitter"></i> <span>@Colorlib</span> I am so happy because I found this magazine, and it just made Vizeweasier. Thanks for sharing</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer Widget Area -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget mb-70">
                    <h6 class="widget-title">Sport Videos</h6>

                    <!-- Single Blog Post -->
                    <div class="single-blog-post d-flex">
                        <div class="post-thumbnail">
                            <img src="img/bg-img/1.jpg" alt="">
                        </div>
                        <div class="post-content">
                            <a href="single-post.html" class="post-title">DC Shoes: gymkhana the</a>
                            <div class="post-meta d-flex justify-content-between">
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Blog Post -->
                    <div class="single-blog-post d-flex">
                        <div class="post-thumbnail">
                            <img src="img/bg-img/2.jpg" alt="">
                        </div>
                        <div class="post-content">
                            <a href="single-post.html" class="post-title">Sweet Yummy Chocolatea Tea</a>
                            <div class="post-meta d-flex justify-content-between">
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 14</a>
                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 34</a>
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 84</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer Widget Area -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget mb-70">
                    <h6 class="widget-title">Our Address</h6>
                    <!-- Contact Address -->
                    <div class="contact-address">
                        <p>101 E 129th St, East Chicago, <br>IN 46312, US</p>
                        <p>Phone: 001-1234-88888</p>
                        <p>Email: info.colorlib@gmail.com</p>
                    </div>
                    <!-- Footer Social Area -->
                    <div class="footer-social-area">
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copywrite Area -->
    <div class="copywrite-area">
        <div class="container">
            <div class="row align-items-center">
                <!-- Copywrite Text -->
                <div class="col-12 col-sm-6">
                    <p class="copywrite-text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
                <div class="col-12 col-sm-6">
                    <nav class="footer-nav">
                        <ul>
                            <li><a href="#">Advertise</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Disclaimer</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
