<?php

/* @var $this yii\web\View */
/** @var Sort $sort */

use app\models\Articulo;
use app\models\Subcategoria;
use yii\bootstrap5\ButtonDropdown;
use yii\data\Sort;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\LinkPager;

$this->title = 'ABRASA - Productos';

if(count($model)<=2){
	$this->registerJs("$('.gallery-wrapper').left='10%;'",View::POS_READY);
}

?>
<p>&nbsp;</p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('_sidebar.php'); ?>
        </div>
        <div class="col-md-9">
            <div class="header_familia" style="background-color: #42754e">
                <div class="row">
                    <div class="col-md-9">
                        Productos
                    </div>
                    <div class="col-md-3">
                        <?=
                        ButtonDropdown::widget([
                            'label' => 'Ordenar..',
                            'dropdown' => [
                                'items' => [
                                    ['label' => 'Ascendente', 'url' => $sort->createUrl('ascendente')],
                                    ['label' => 'Descendente', 'url' => $sort->createUrl('descendente')],
                                ],
                            ],
                            'buttonOptions' => ['class' => 'btn-outline-success text-white']
                        ])
                        ?>
                    </div>
                </div>
            </div>
            <?php include '_datos.php'; ?>
        </div>
    </div>
</div>