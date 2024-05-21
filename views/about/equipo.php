<?php

/* @var $this yii\web\View */

/* @var $categoriaTecnicos Cattecnico */

use app\models\Cattecnico;
use app\models\Tecnico;
use yii\base\InvalidConfigException;
use yii\bootstrap5\BootstrapAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->title = 'ABRASA - EQUIPO TECNICO';
$this->params['breadcrumbs'][] = ['label' => 'Sobre Nosotros', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = 'Equipo Técnico';
$css = <<<CSS
.ourTeam-hedding p{
    color: #979797;
}
.ourTeam-hedding strong{
    color: black;
}
.ourTeam-hedding{
    margin-bottom: 50px;
}
.ourTeam-hedding h1{
    font-size: 25px;
    font-weight: bold;
    color: #145889;
}
.ourTeam-box{
    border-radius: 2px;
    border-top: 6px solid #5DDDD3;
    margin: 0px;
    background-color: #FFFFFF;
    margin-bottom: 30px;
}
.section1{
    padding: 30px 0px 30px 0px;
}
.section1 img{
    border-radius: 4%;
    height: 200px;
    width: 200px;
}
.section2 p{
    font-weight: bold;
    color: #5DDDD3;
    letter-spacing: 1px;
}
.section2 span{
    color: #979597;
}
.section3{
    background-color: #3AA935;
}
.section3 i{
    color: #ffffff !important;
    padding: 15px;
    font-size: 15px;
}
.section3 p{
padding: 15px;
}
.section-info{
    border-top: 6px solid #6aae7a;
}
.section-info p{
    color: #6aae7a;
}
.section-info .section3{
    background-color: #6aae7a;
}
CSS;

$this->registerCss($css);
try {
    $this->registerCssFile(Url::base(true) . '/assets/css/mdb.min.css', ['depends' => BootstrapAsset::class]);
    $this->registerJsFile(Url::base(true) . '/admin/vendor/bootstrap/js/bootstrap.bundle.js', ['depends' => JqueryAsset::class]);
    $this->registerJsFile(Url::base(true) . '/assets/js/mdb.min.js', ['depends' => BootstrapAsset::class]);
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>

<div class="container-fluid">
    <!--<p>&nbsp;</p>
    <div class="row">
        <div class="col-md-12">
            <div class="heading text-center">
                <hr data-content="Conozca a nuestro Equipo" class="hr-text" />
            </div>
        </div>
    </div>
    <p>&nbsp;</p>-->
    <div id="heading-breadcrumbs">
        <div class="container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-md-7">
                    <h3 style="font-family: 'Lora','sans-serif'">Conozca a nuestro Equipo</h3>
                </div>
                <div class="col-md-5">
                    <?= Breadcrumbs::widget([
                        'homeLink' => [
                            'label' => Yii::t('yii', 'Inicio'),
                            'url' => Yii::$app->homeUrl,
                        ],
                        'links' => $this->params['breadcrumbs'] ?? [],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <ul id="pills-tab" role="tablist" class="nav nav-tabs nav-pills nav-justified">
        <?php
        foreach ($categoriaTecnicos as $key => $value):
            ?>
            <li class="nav-item" role="presentation">
                <a id="pills-<?= $key ?>-tab"
                   data-bs-toggle="pill"
                   href="#pills-<?= $key ?>"
                   role="tab"
                   aria-controls="pills-<?= $key ?>"
                   aria-selected="true"
                   class="nav-link <?= ($key == $activo) ? 'active' : '' ?>">
                    <?= $value->nombre ?>
                </a>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
    <div id="pills-tab-content" class="tab-content">
        <?php foreach ($categoriaTecnicos as $key => $value): ?>
            <div id="pills-<?= $key ?>" role="tabpanel" aria-labelledby="pills-<?= $key ?>-tab"
                 class="tab-pane fade <?= ($key == $activo) ? 'active show' : '' ?>">
                <div class="container">
                    <div class="row text-center" data-aos="fade-left">
                        <!-- Team item -->
                        <?php
                        $tecnicos = Tecnico::find()->where(['idcattecnico' => $value->idcattecnico])->orderBy(['posicion' => SORT_ASC])->all();
                        foreach ($tecnicos as $index => $item):
                            ?>
                            <div class="col-xl-4 col-sm-6 mb-5">
                                <div class="bg-white rounded shadow-sm py-5 px-4 section1">
                                    <img src="<?= Url::base(true) ?>/<?= $item->imagen ?>" alt="<?= $item->nombre ?>"
                                         class="img-fluid shadow-sm"/>
                                    <h5 class="mb-0"><?= $item->nombre ?></h5>
                                    <span class="small text-uppercase text-muted"><?= $item->area ?></span>
                                </div>
                                <div class="col-md-12 section3">
                                    <p class="text-white">Sucursal: <b><?= $item->sucursal ?></b></p>
                                </div>
                            </div>
                            <!-- End -->
                        <?php endforeach; ?>
                        <!-- Team item -->
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>