 <section class="contact-area mb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-8">
                    <!-- Section Heading -->
                    <div class="section-heading style-2">
                        <h4>Contact</h4>
                        <div class="line"></div>
                    </div>

                    <h5>Send us a message</h5>

                    <!-- Contact Form Area -->
                    <div class="contact-form-area mt-50">
                    <?php use yii\helpers\Html;
                    use yii\widgets\ActiveForm;

                    $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['contact/send'],
                    ]); ?>
                        <div class="form-group">
                            <?= $form->field($model, 'name')->textInput()->label('Name') ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'email')->input('email')->label('Email') ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'message')->input('text')->label('Message') ?>
                            </div>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-4">
                    <div class="sidebar-area">
                        <!-- ***** Single Widget ***** -->
                        <div class="single-widget newsletter-widget mb-50">
                            <!-- Section Heading -->
                            <div class="section-heading style-2 mb-30">
                                <h4>Newsletter</h4>
                                <div class="line"></div>
                            </div>
                            <p>Subscribe our newsletter gor get notification about new updates, information discount, etc.</p>
                            <!-- Newsletter Form -->
                            <div class="newsletter-form">
                                <form action="#" method="post">
                                    <input type="email" name="nl-email" class="form-control mb-15" id="emailnl" placeholder="Enter your email">
                                    <button type="submit" class="btn vizew-btn w-100">Subscribe</button>
                                </form>
                            </div>
                        </div>

                        <!-- ***** Single Widget ***** -->
                        <div class="single-widget add-widget">
                            <a href="#"><img src="img/bg-img/add.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
