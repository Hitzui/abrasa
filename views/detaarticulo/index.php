<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetaArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategoria-Articulo';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="detaarticulo-index">
                <p>
                    <?= Html::a('Asociar Articulo-Subcategoria', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'idsubcategoria',
                        'idarticulo',
                        [
                            'label' => 'Articulo',
                            'attribute' => 'articulo',
                            'value' => 'articulo.descripcion',
                        ],
                        [
                            'label' => 'Sub-Categoria',
                            'attribute' => 'subcategoria',
                            'value' => 'subcategoria.nombre',
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>