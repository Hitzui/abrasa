<?php

/* @var $this yii\web\View */
/* @var $cat Categoria */
/* @var $sub Subcategoria */
/** @var Sort $sort */
/* @var $model Articulo */
/** @var Familia $family */

use app\models\Articulo;
use app\models\Categoria;
use app\models\Familia;
use app\models\Subcategoria;
use kartik\bs5dropdown\ButtonDropdown;
use yii\data\Sort;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'ABRASA - Productos';

if ($family !== null) {
    Url::remember(['producto/find','id'=>$sub->idsubcategoria,'idfamilia'=>$family->idfamilia,'sort'=>'asc']);
    $nombreFamilia = ' / ' . Html::a($family->nombre, ['producto/familia', 'idfamilia' => $family->idfamilia,'sort'=>'asc'], ['class' => 'text-warning']);
} else {
    Url::remember(['producto/find','id'=>$sub->idsubcategoria,'idfamilia'=>0,'sort'=>'ascendente']);
    $nombreFamilia = "";
}
/*if ($sub->idsubcategoria == 63) {
    $model = $model->orderBy($sort->orders)->all();
} else {
    $model = $model->all();
}*/
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
                        Categoria: <?= Html::a($cat->nombre, ['producto/categoria', 'id' => $cat->idcategoria,'sort'=>'asc'], ['class' => 'text-warning']) ?><?= $nombreFamilia ?>
                        / <?= $sub->nombre ?>
                    </div>
                    <div class="col-md-3">
                        <?=
                        ButtonDropdown::widget([
                            'label' => 'Ordenar..',
                            'dropdown' => [
                                'items' => [
                                    ['label' => 'Ascendente', 'url' => Url::to(['producto/find','id'=>$sub->idsubcategoria,'idfamilia'=>$family->idfamilia,'sort'=>'asc'])],
                                    ['label' => 'Descendente', 'url' => Url::to(['producto/find','id'=>$sub->idsubcategoria,'idfamilia'=>$family->idfamilia,'sort'=>'desc'])],
                                ],
                            ],
                            'buttonOptions' => ['class' => 'btn-outline-success text-white']
                        ])
                        ?>
                    </div>
                </div>

            </div>
            <div>

            </div>
            <?php include '_datos.php'; ?>
        </div>
    </div>
</div>