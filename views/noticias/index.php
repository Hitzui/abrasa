<?php

use app\models\Catnoticias;
use yii\base\InvalidConfigException;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'ABRASA - BLOG';

try {
    $this->registerCssFile(Url::base(true) . '/assets/css/noticias.css');
    $this->registerJsFile(Url::base(true) . '/assets/js/lodash.min.js');
    $this->registerJsFile(Url::base(true) . '/assets/vendor/bootstrap/js/bootstrap.bundle.js');
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}

?>
<p>&nbsp;</p>
<div class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 content">
                <div class="block-area text-center">
                    <div class="block-title-1 animate__animated animate__bounce">
                        <h1>
                            Explora nuestro Blog
                        </h1>
                        <div class="dot-line">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <?php
                            foreach ($categorias as $k => $cat) {
                                /* @var $cat Catnoticias */
                                ?>
                                <div class="col-md-3 col-sm-6 card">
                                    <div class="meet-farmers-one__single animate__animated animate__fadeInDown">
                                        <div class="meet-farmers-one__single-img">
                                            <img src="<?= $cat->imagen ?>" alt="Abrasa" />
                                        </div>
                                        <div class="meet-farmers-one__single-title text-center">
                                            <p>ABRASA</p>
                                            <h2>
                                                <a href="<?=Url::to(['noticias/categoria', 'id' => $cat->idcatnoticias],true)?>">
                                                    <?= $cat->descripcion ?>
                                                </a>
                                            </h2>
                                        </div>
                                    </div>

                                    <!--<div class="card mb-3 caja" data-aos="fade-left">
                                        <img src="<?php /*= $cat->imagen */?>" class="card-img-top" alt="Wild Landscape"/>
                                        <div class="card-body">
                                            <h5 class="card-title text-center"> <?php /*= $cat->descripcion */?></h5>
                                            <p class="card-text">
                                                <?php /*= Html::a('Ver más', ['noticias/categoria', 'id' => $cat->idcatnoticias], ['class' => 'btn btn-info']) */?>
                                            </p>
                                        </div>
                                    </div>-->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('_aside.php') ?>
        </div>
    </div>
</div>