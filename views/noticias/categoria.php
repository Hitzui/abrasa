<?php
/* @var $this yii\web\View */
/* @var $categoria Catnoticias */
/* @var $categoriart array */

use app\models\Catnoticias;
use app\models\Noticias;
use app\models\Subnoticias;
use yii\base\InvalidConfigException;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = ['label' => 'Categoria Noticias', 'url' => ['noticias/index']];
$this->params['breadcrumbs'][] = 'Noticias';
try {
    $this->registerCssFile(Url::base(true) . '/assets/css/noticias.css');
    $this->registerJsFile(Url::base(true) . '/assets/js/lodash.min.js');
    $this->registerJsFile(Url::base(true) . '/assets/vendor/bootstrap/js/bootstrap.bundle.js');
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <?php
                if (count($subcategoria) > 0) {
                ?>
                <h3 style="font-family: 'Lora','sans-serif'">Categoria de noticias: <?= $categoria->descripcion?></h3>
                <?php
                }else{
                    ?>
                    <h3 style="font-family: 'Lora','sans-serif'">Noticias</h3>
                <?php
                }
                ?>
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
<div class="">
    <?php
    if (count($categoriart)>0){?>
        <div class="container">
            <div class="row">
                <?php
                foreach ($categoriart as $value):
                    /* @var $value \app\models\Categoria */
                ?>
                    <div class="col-md col-sm-12">
                        <div class="box-simple animate__animated animate__bounce" data-aos="fade-right">
                            <div class="hover hover-3 text-white rounded"
                                 style="background-color: <?= $categoria->color ?>">
                                <img src="/<?= $value->imagen ?>" alt="<?= $value->nombre ?>" class="img-fluid"/>
                                <div class="hover-overlay"></div>
                                <div class="hover-3-content px-5 py-4 text-center">
                                    <h4 class="hover-3-title font-weight-bold mb-1">
                                        <a href="<?= Url::to(['producto/categoria', 'id' => $value->idcategoria]) ?>"
                                           class="text-white" style="margin-left: -10px">
                                            <?= $value->nombre ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    <?php
    }
    if (count($subcategoria) > 0) {
        ?>
            <p>&nbsp;</p>
        <div class="container">
            <div class="row">
                <?php
                foreach ($subcategoria as $item) {
                    /* @var $item Subnoticias */
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="card mb-3 caja">
                            <img src="<?= $item->imagen ?>" class="card-img-top" alt="ABRASA"/>
                            <div class="card-body">
                                <h5 class="card-title text-center"> <?= $item->nombre ?></h5>
                                <p class="card-text">
                                    <?= Html::a('Ver más...', ['noticias/subcategoria', 'id' => $item->idsubnoticias], ['class' => 'btn btn-info']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }else{
        include 'index-2.php';
    }
    ?>
</div>
