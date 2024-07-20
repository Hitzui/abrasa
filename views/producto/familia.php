<?php

/* @var $this yii\web\View */
/** @var \app\models\Categoria $category */

/** @var \app\models\Familia $family */

use kartik\bs5dropdown\ButtonDropdown;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'ABRASA - Productos';
?>
<p>&nbsp;</p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('_sidebar.php') ?>
        </div>
        <div class="col-md-9">
            <div class="header_familia" style="background-color: #42754e">
                <div class="row">
                    <div class="col-md-9">
                        Categoria: <?=
                        Html::a($category->nombre, ['producto/categoria', 'id' => $category->idcategoria,'sort'=>'ascendente'], ['class' => 'text-warning']) ?>
                        / <?= $family->nombre ?>
                    </div>
                    <div class="col-md-3">
                        <?=
                        /** @var \yii\data\Sort $sort */
                        ButtonDropdown::widget([
                            'label' => 'Ordenar..',
                            'dropdown' => [
                                'items' => [
                                    ['label' => 'Ascendente', 'url' => Url::to(['producto/familia','idfamilia'=>$family->idfamilia,'sort'=>'asc'])],
                                    ['label' => 'Descendente', 'url' => Url::to(['producto/familia','idfamilia'=>$family->idfamilia,'sort'=>'desc'])],
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