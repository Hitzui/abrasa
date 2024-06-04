<?php

use app\assets\AppAsset;
use app\models\Articulo;
use app\models\Categoria;
use app\models\Familia;
use app\models\FamiliaArticulo;
use app\models\Presentacion;
use app\models\Subcategoria;
use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

/** @var FamiliaArticulo $detaFamilia */
/** @var Subcategoria $subcategoria */
/** @var Familia $family */
/** @var Familia $familias */
/** @var Categoria $category */
/** @var Articulo $find */
/** @var Presentacion $presentaciones */

$this->title = 'ABRASA - VER FICHA';
if (empty($find->rutaimg)) {
    $find->rutaimg = 'uploads/logo.png';
}
$css = <<<CSS
.fila_titulo {
    font-weight: 500;
    text-transform: uppercase;
    background-color: #42754e;
    color: #ffc107;
}
.articulo_nombre {
    font-size: 24px;
    font-weight: 500;
    text-transform: uppercase;
    color: grey;
}
.box_file {
    padding: 7px;
    border: 1px solid lightgrey;
    border-radius: 4px;
    transition: .3s;
    cursor: pointer;
    color: black;
}
.box_file img{
 width:35px;
}
.bg-success{
background-color: #023C2C !important;
}
CSS;
$this->registerCss($css);
if (empty($find->rutaimg) || strlen($find->rutaimg) <= 5) {
    $find->rutaimg = 'uploads/logo.png';
}
$this->registerCssFile('https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', [
    'depends' => [AppAsset::class],
]);

$this->registerJsFile(
    Url::base(true) . '/assets/js/splide.js',
    ['depends' => [AppAsset::class]]
);
$this->registerJsFile(
    'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
    ['depends' => [AppAsset::class]]
);
$js = <<<JS
document.addEventListener( 'DOMContentLoaded', function () {
  var main = new Splide( '#main-carousel', {
    type      : 'fade',
    rewind    : true,
    pagination: false,
    arrows    : false
  } );


  var thumbnails = new Splide( '#thumbnail-carousel', {
    fixedWidth  : 100,
    fixedHeight : 60,
    gap         : 10,
    rewind      : true,
    pagination  : false,
    isNavigation: true,
    breakpoints : {
      600: {
        fixedWidth : 60,
        fixedHeight: 44,
      },
    },
  } );


  main.sync( thumbnails );
  main.mount();
  thumbnails.mount();
} );
JS;

$this->registerJs($js, View::POS_HEAD);

if ($familias !== null) {
    $linkFamilias = "";
    foreach ($familias as $f) {
        $linkFamilias .= Html::a($f->nombre, ['producto/familia', 'idfamilia' => $f->idfamilia], ['class' => 'text-warning']);
        if (count($familias) > 0)
            $linkFamilias .= '-';
    }
    $header = Html::a($category->nombre, ['producto/categoria', 'id' => $category->idcategoria], ['class' => 'text-warning']) . ' / ' . $linkFamilias . ' / ' . Html::a($subcategoria->nombre, ['producto/find', 'id' => $subcategoria->idsubcategoria, 'idfamilia' => '0'], ['class' => 'text-warning']);
} else {
    $header = Html::a($category->nombre, ['producto/categoria', 'id' => $category->idcategoria], ['class' => 'text-warning']) . ' / ' . Html::a($subcategoria->nombre, ['producto/find', 'id' => $subcategoria->idsubcategoria, 'idfamilia' => '0'], ['class' => 'text-warning']);
}
?>
<p>&nbsp;&nbsp;</p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('_sidebar.php') ?>
        </div>
        <div class="col-md-9">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 bg-success header_familia">
                        <div class="text-white">
                            <?= $header ?>
                        </div>
                    </div>
                </div>
                <div class="row" id="articulos">
                    <div class="col-md-4">
                        <section id="main-carousel" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li class="splide__slide">
                                        <a href="<?= Url::base(true) ?>/<?= $find->rutaimg ?>"
                                           data-toggle="lightbox"
                                           data-caption="<?= $find->descripcion ?>"
                                           data-gallery="view-gallery">
                                            <img src="<?= Url::base(true).'/' . $find->rutaimg ?>"
                                                 alt="<?= $find->descripcion ?>"
                                                 class="img-fluid img-thumbnail rounded"/>
                                        </a>
                                    </li>
                                    <?php
                                    foreach ($presentaciones as $value):
                                        ?>
                                        <li class="splide__slide">
                                            <a href="<?= $value->ruta ?>" data-toggle="lightbox"
                                               data-caption="<?= $value->descripcion ?>" data-gallery="view-gallery">
                                                <img src="<?= $value->ruta ?>" alt=""
                                                     class="img-fluid img-thumbnail rounded"/>
                                            </a>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        </section>
                        <p>&nbsp;</p>
                        <section
                                id="thumbnail-carousel"
                                class="splide"
                                aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel."
                        >
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li class="splide__slide">
                                        <img src="<?= Url::base(true).'/'. $find->rutaimg ?>"
                                             alt="<?= $find->descripcion ?>"
                                             class="img-fluid"/>
                                    </li>
                                    <?php
                                    foreach ($presentaciones as $value):
                                        ?>
                                        <li class="splide__slide">
                                            <img src="<?=  $value->ruta ?>" alt=""
                                                 class="img-fluid">
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        </section>
                        <a href="<?= Url::previous() ?>" style="font-size: 20px;">
                            <i class="fas fa-long-arrow-alt-left"></i> Regresar
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9">
                                    <h2><strong><?= Html::decode($find->descripcion) ?></strong></h2>
                                </div>
                                <div class="col-md-3">
                                    <a href="<?= Url::previous() ?>">Volver atras</a>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h4>Descripci&oacute;n</h4>
                        <div><?= Html::decode($find->caracteristicas) ?></div>
                        <table class="table table-striped tabla_producto">
                            <tbody>
                            <tr>
                                <td class="fila_titulo" style="width: 40%"><span>Proveedor:</span></td>
                                <td class="fila_texto" style="width: 60%">
                                    <?php
                                    /** @var \app\models\Proveedor $proveedor */

                                    foreach ($proveedor as $prov) {
                                        ?>
                                        <a href="<?= Url::to(['producto/proveedor', 'id' => $prov->idproveedor]) ?>">
                                            <?= $prov->nombre ?><?php if (count($proveedor) > 1) echo ' | '; ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fila_titulo" style="width: 40%"><span>Presentación:</span></td>
                                <td class="fila_texto" style="width: 60%">
										<span>
											<?php if (empty($find->presentacion)) {
                                                echo $find->uso;
                                            } else {
                                                echo $find->presentacion;
                                            } ?>
										</span>
                                </td>
                            </tr>
                            <!--<tr>
									<td style="width: 40%"><span>Uso:</span></td>
									<td style="width: 60%"><span><?= $find->uso ?></span></td>
								</tr>-->
                            </tbody>
                        </table>
                        <?php
                        if (strlen($find->ficha) > 3 || strlen($find->hoja) > 3) {
                            ?>
                            <div class="container">
                                <div class="articulo_nombre">Documentación técnica</div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-12">Click para descargar</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (strlen($find->ficha) > 3) { ?>
                                            <a class="box_file" href="/<?= $find->ficha ?>" target="_blank">
                                                <img src="/assets/img/pdf.png" alt="">
                                                <span>Ficha T&eacute;cnica</span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if (strlen($find->hoja) > 3) { ?>
                                            <a class="box_file" href="/<?= $find->hoja ?>" target="_blank">
                                                <img src="/assets/img/pdf.png" alt="">
                                                <span>Hoja de Seguridad</span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>