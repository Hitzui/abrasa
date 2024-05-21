<?php

/* @var $this yii\web\View */

use app\models\Articulo;
use app\models\Subcategoria;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\LinkPager;

$this->title = 'ABRASA - Productos';
$css = <<<CSS
.header_familia{
		padding: 7px;
		font-size: 18px;
		font-weight: 400;
		margin-bottom: 15px;
		color: white;
	}
/*######################## MINIATURA DEL PRODUCTO #########################*/
@media(max-width: 990px){
	.min_producto{
		margin: 2px !important;
		padding: 5px !important;

	}
	.min_producto .nombre_producto {
		font-size: 12px !important;
		padding-left: 5px !important;
		padding-right: 5px !important;
		margin-bottom: 0px !important;
		line-height: 120% !important;
	}
	.min_producto .imagen_producto{
		height: 115px !important;
	}
	.min_producto .modelo_producto {
        font-size: 11px !important;
    }
    .min_producto .desc_producto{
    	font-size: 11px !important;
    	margin-bottom: 5px !important;
    	min-height: 50px !important;
    }
    .btn_ver_producto{
    	padding: 3px !important;
    	font-size: 11px !important;
    }
}


.min_producto_2{
    margin: 5px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.16);
    background-color: #ededed;
    position: relative;
}
.min_producto_2 .box_oferta{
    background-color: #627681;
    color: white;
    position: absolute;
    top: 71px;
    left: -2px;
    padding: 7px;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 15px;
    padding-left: 10px;
    padding-right: 10px;
    z-index: 20;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.3);
}
.min_producto_2 .nombre_producto{
    color: white;
    font-weight: 600;    
    font-size: 15px;
    background-color: #6aae7a;
    padding: 15px;    
    text-transform: uppercase;
    min-height: 75px;
    /*display: flex;*/
    align-items: center;
}
.min_producto_2 .imagen_producto{
    height: 220px;
    background-size: cover;
    background-position: center;
    margin: 8px;
    position: relative;
}
.min_producto_2 .imagen_producto img{
    width: 100%;
}
.min_producto_2 .modelo_producto{
    margin: 5px;
    border-top: .7px solid grey;
    padding-top: 5px;
    padding-left: 3px;
    padding-right: 3px;
}
.min_producto_2 .modelo_producto strong{
    text-transform: uppercase;
}
.min_producto_2 .desc_producto{
    text-transform: uppercase;
    font-size: 13px;
    color: grey;
    padding: 7px;
    line-height: 110%;
    text-align: justify;
}
.min_producto_2 .btn_ver_producto{
    background-color: #0e5b9f;
    margin-bottom: 7px;
    margin-right: 7px;
    border-radius: 4px;
}
.min_producto_2 .btn_ver_producto:hover{
    background-color: #0d487d;
}

.min_producto_2 .btn_opcion_min{
    float: left;
    width: 25px !important;
    cursor: pointer;
    transition: .3s;
    border-radius: 4px;
}
.min_producto_2 .btn_opcion_min:hover{
    background-color: lightgrey;
}

.min_producto_2 .descuento{
    margin-left: 12px;
    color: white;
    /*background-color: #627681;*/
    background-color: #88b244;
    font-size: 12px;
    font-weight: bold;
    opacity: .7;
    text-transform: uppercase;
    transition: .3s;
    z-index: 40;
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 100%;
    flex-direction: column;
    line-height: 50%;
    right: 2px;
    bottom: 52px;
}
.min_producto_2:hover .descuento{
    opacity: 1;
}
/*####################################################################*/

.min_producto{
    border: 1px solid grey;
    border-radius: 6px;
    padding: 10px;
    margin: 5px;
}
.min_producto .nombre_producto{
    text-transform: uppercase;
    font-size: 15px;
    color: black;
    padding-left: 10px;
    padding-right: 10px;
    min-height: 40px;
    margin-bottom: 10px;
}
.min_producto .modelo_producto{
    font-size: 13px;
}
.min_producto .modelo_producto strong{
    text-transform: uppercase;
}
.min_producto .desc_producto{
    text-align: justify;
    font-size: 13px;
    text-transform: uppercase;
    line-height: 110%;
    margin-top: 5px;
    margin-bottom: 15px;
}
.min_producto .imagen_producto{
    position: relative;
    padding: 3px;
    height: 170px;
    overflow: hidden;
    background-size: cover;
    background-position: center;
    margin-bottom: 12px;
}

.min_producto_2 .imagen_producto .overlay_negro{
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,.3);
    opacity: 0;
    transition: .5s;
    cursor: pointer;
}
.min_producto_2 .imagen_producto .btn_vista_rapida{
    color: white;
    font-size: 20px;
    position: absolute;
    z-index: 5;
    opacity: 0;
    transition: .5s;
    cursor: pointer;
        left: 45%;
    top: 45%;
}
.min_producto_2 .imagen_producto:hover .btn_vista_rapida{
    opacity: .7;
}
.min_producto_2 .imagen_producto .btn_vista_rapida:hover{
    opacity: 1;
}

.min_producto_2 .imagen_producto:hover .overlay_negro{
    opacity: 1;

}
.min_producto .imagen_producto .logo_marca{
    position: absolute;
    bottom: 0px;
    left: 0px;
    opacity: 0;
    transition: .3s;
    width: 70px;
}
.min_producto:hover .imagen_producto .logo_marca{
    opacity: 1;
}
.btn_ver_producto{
    display: inline-block;
    background-color: #6c9922;
    color: white;
    text-transform: uppercase;
    padding: 6px;
    padding-left: 20px;
    padding-right: 20px;
    font-size: 13px;
    transition: .3s;
}
.btn_ver_producto:hover{
    background-color: #55781c;
}
/*#########################################################################*/

.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #42754e;
    border-color: #42754e;
}
.list-group-item.active a{
    color: white;
}
.prev span, .next span{
    padding: 0.5rem 0.75rem;
    line-height: 1.25;
    color: #6aae7a;
    background-color: #fff;
    border: 1px solid #dee2e6;
    display:block;
}
CSS;
$this->registerCss($css);
if(count($model)<=2){
	$this->registerJs("$('.gallery-wrapper').style.left='10%';",View::POS_END);
}
?>
<p>&nbsp;</p>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include('_sidebar.php') ?>
        </div>
        <div class="col-md-9">
            <div class="header_familia" style="background-color: #42754e">
                <span><?= $nombre ?></span>
            </div>
			<div class="container text-center">
            <!-- Masonry grid -->
            <div class="gallery-wrapper">
                <!-- Grid sizer -->
                <div class="grid-sizer col-lg-4 col-md-6"></div>
                <?php /** @var Articulo $model */
                foreach ($model as $articulo) { 
                    if (empty($articulo->rutaimg)) {
                        $articulo->rutaimg = 'uploads/logo.png';
                    }
                    ?>
				<!-- Grid item -->
                    <div class="col-lg-4 col-md-6 grid-item">
                        <div class="min_producto_2">
                            <div class="nombre_producto text-center">
                                <span><?= $articulo->descripcion ?></span>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#modal-<?= $articulo->idarticulo ?>">
                                <div class="imagen_producto centro-abs">
                                    <img src="/<?= $articulo->rutaimg ?>" alt="<?= $articulo->descripcion ?>"/>
                                    <div class="overlay_negro overlay_vista_vista centro-abs"
                                         id_producto="<?= $articulo->idarticulo ?>">
                                        <div id_producto="<?= $articulo->idarticulo ?>" class="btn_vista_rapida">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="modal-<?= $articulo->idarticulo ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="modal-<?= $articulo->idarticulo ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="exampleModalLabel"><?= $articulo->descripcion ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="/<?= $articulo->rutaimg ?>" class="img-fluid"
                                                 alt="<?= $articulo->descripcion ?>"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right;overflow: hidden;padding:5px">
                                <a href="<?= Url::to(["producto/view",'idarticulo'=>$articulo->idarticulo])?>">
                                    <div class="btn_ver_producto">
                                        <span>ver ficha</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
			</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <?php
                            /** @var \yii\data\Pagination $pagination */
                        // display pagination
                         ?>
                        <nav aria-label="Page navigation">
                        <?=LinkPager::widget([
                            'pagination' => $pagination,
                            'linkOptions'=>['class'=>'page-link'],
                            'disabledPageCssClass'=>'disabled',
                            /*'firstPageCssClass'=>'page-item',
                            'prevPageCssClass'=>'page-item',
                            'nextPageCssClass'=>'page-item',
                            'lastPageCssClass'=>'page-item',*/
                            'activePageCssClass'=>'active',
                            'pageCssClass'=>'page-item'
                        ])?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>