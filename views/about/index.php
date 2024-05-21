<?php

use app\models\ContactForm;
use kartik\form\ActiveForm;
use yii\base\InvalidConfigException;
use yii\bootstrap5\BootstrapAsset;
use yii\captcha\Captcha;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/** @var ContactForm $model */
/** @var \app\models\Stores $stores */

$this->title = 'ABRASA - CONTACTENOS';
$this->registerJs('
if (window.navigator.geolocation) {
 window.navigator.geolocation
  .getCurrentPosition(showPosition);
}

function showPosition(position) {
  console.log("Latitude: " + position.coords.latitude +  " Longitude: " + position.coords.longitude);
}
', View::POS_END);
try {
    $this->registerJsFile(Url::base(true) . '/assets/vendor/bootstrap/js/bootstrap.bundle.js', ['depends' => [BootstrapAsset::class]]);
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>
<p>&nbsp;</p>

<div id="content">
    <div id="contact" class="container">
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        Gracias por contactarnos. Responderesmos su mensaje a la brevedad posible.
                        Para envair otro correo dir&iacute;jase a la p&aacute;gina de contacto nuevamente.
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-8">
                    <section class="bar">
                        <div class="heading">
                            <h2>Estamos aqu&iacute; para ayudarte!</h2>
                        </div>
                        <p class="lead">¿Tienes curiosidad por algo? ¿Tiene algún problema con nuestros productos?
                            Quiere m&aacute;s informaci&oacute;n sobre nuestros productos, escribanos en el siguiente
                            formulario, con gusto responderemos sus dudas.</p>
                        <hr/>
                        <p class="text-sm">No dude en contactarnos.</p>
                        <div class="heading">
                            <h3>Formulario de contacto:</h3>
                        </div>
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'lastname')->textInput() ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'email') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'subject') ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?= $form->field($model, 'body')->textarea(['rows' => 8]) ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php try {
                                    echo $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                    ]);
                                } catch (Exception $e) {
                                    echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
                                } ?>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" id="contact-button" name="contact-button"
                                        class="btn btn-template-outlined">
                                    <i class="far fa-envelope"></i> Enviar Mensaje
                                </button>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </section>
                </div>
                <div class="col-lg-4">
                    <section class="bar mb-0">
                        <h3 class="text-uppercase">Dirección:</h3>
                        <p class="text-sm">Km 2 1/2<br/>Frente a Talleres Noguera<br/>Carretera norte<br/><strong>Managua,
                                Nicaragua</strong></p>
                        <h3 class="text-uppercase">Números telefónicos</h3>
                        <p class="text-muted text-sm">Estos números son válidos para Nicaragua, de otra forma use el
                            correo electrónico</p>
                        <?php
                        foreach ($stores as $store):
                            ?>
                            <p><b><?= $store->storeName ?>:</b> <?= $store->phoneFormatted ?></p>
                        <?php
                        endforeach;
                        ?>
                        <h3 class="text-uppercase">Correos Electrónicos</h3>
                        <p class="text-muted text-sm">No dude en escribirnos un correo electrónico.</p>
                        <ul class="text-sm list-unstyled">
                            <?php
                            foreach ($stores as $store):
                                ?>
                                <li>
                                    <b style="font-size: 1.2em"><?= $store->storeName ?>:</b>
                                    <strong><?= Yii::$app->formatter->asEmail($store->email) ?></strong>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </section>
                    <section class="bar">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="/assets/img/Publicidad02.jpeg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="/assets/img/Publicidad03.jpeg" alt="Third slide">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div id="map" class="container">
        <div class="row">
            <div class="col-md-12" style="min-height: 250px">
                <iframe width="100%" height="100%"
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1950.202747587344!2d-86.251052!3d12.152773!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xadcbd51f731fd9b5!2sAgropecuaria%20Bravo%20S.A%20(ABRASA)!5e0!3m2!1sen!2sus!4v1626062769218!5m2!1sen!2sus"
                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>