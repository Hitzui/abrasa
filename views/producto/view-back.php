<?php

use app\models\Familia;
use app\models\FamiliaArticulo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var FamiliaArticulo $detaFamilia */
/** @var \app\models\Subcategoria $subcategoria */
/** @var Familia $family */
/** @var \app\models\Categoria $category */
/** @var \app\models\Articulo $find */

$this->title = 'ABRASA - VER FICHA';
if (empty($find->rutaimg)) {
    $find->rutaimg = 'uploads/logo.png';
}
$css = <<<CSS
.fila_titulo {
    font-weight: 500;
    text-transform: uppercase;
    background-color: #42754e;
    color: white;
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
$this->registerCssFile(Url::base(true) . '/assets/css/splide.min.css', [
    'depends' => [AppAsset::class],
]);

$this->registerJsFile(
    Url::base(true) . '/assets/js/splide.js',
    ['depends' => [JqueryAsset::class]]
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

$this->registerJs($js, View::POS_END);

if($familias !== null){
    $linkFamilias="";
    foreach($familias as $f){
        $linkFamilias.=Html::a($f->nombre, ['producto/familia', 'idfamilia' => $f->idfamilia], ['class' => 'text-warning']);
        if (count($familias)>0)
            $linkFamilias.='-';
    }
    $header = Html::a($category->nombre, ['producto/categoria', 'id' => $category->idcategoria], ['class' => 'text-warning']) . ' / '.$linkFamilias.' / ' . Html::a($subcategoria->nombre,['producto/find','id'=>$subcategoria->idsubcategoria,'idfamilia'=>'0'],['class'=>'text-warning']);
}else {
    $header = Html::a($category->nombre, ['producto/categoria', 'id' => $category->idcategoria], ['class' => 'text-warning']) . ' / ' . Html::a($subcategoria->nombre,['producto/find','id'=>$subcategoria->idsubcategoria,'idfamilia'=>'0'],['class'=>'text-warning']);
}
?>
<p>&nbsp;&nbsp;</p>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include('_sidebar.php') ?>
        </div>
        <div class="col-md-9" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 bg-success header_familia">
                        <div class="text-white">
                            <?= $header ?>
                        </div>
                    </div>
                </div>
                <div class="row" id="articulos">
                    <div class="col-md-4">
                        <a href="#" data-toggle="modal" data-target="#viewImage">
                            <figure class="figure">
                            <img src="/<?= $find->rutaimg ?>" alt="<?= $find->descripcion ?>"
                                 class="img-fluid img-thumbnail rounded"/>
                                <figcaption class="figure-caption text-right">Click para ver la imagen.</figcaption>
                            </figure>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="viewImage" tabindex="-1" role="dialog" aria-labelledby="viewImage" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewImage"><?= $find->descripcion?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="/<?= $find->rutaimg ?>" alt="<?= $find->descripcion ?>"
                                             class="img-fluid"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>&nbsp;</p>
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
                        <p style="text-justify: "><?= Html::decode($find->caracteristicas) ?></p>
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
                        if (strlen($find->ficha) > 3 || strlen($find->hoja) > 3){
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