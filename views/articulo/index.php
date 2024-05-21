<?php

use app\models\Subcategoria;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $familias app\models\Familia */
/* @var $subcategorias app\models\Subcategoria */
/* @var $articulos app\models\Articulo */

$this->title = 'Articulos';
$this->params['breadcrumbs'][] = '/' . $this->title;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <p>
                            <?= Html::a('Crear Articulo', ['create'], ['class' => 'btn btn-success']) ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <?= Html::a('Asociar Articulo-Proveedor', ['proveedor'], ['class' => 'btn btn-info']) ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <?= Html::a('Asociar Articulo-Familia', ['familia-articulo/index'], ['class' => 'btn btn-warning']) ?>
                    </div>
                </div>
            </div>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'idarticulo',
                    [
                        'format' => 'raw',
                        'attribute' => 'descripcion'
                    ],
                    //'caracteristicas:ntext',
                    //'idsubcategoria',
                    [
                        'format' => 'raw',
                        'label' => 'Sub-Categoria',
                        'attribute' => 'subcategoria',
                        'value' => function ($data) {
                            $subcategoria = Subcategoria::findOne(['idsubcategoria' => $data->idsubcategoria]);
                            if (isset($subcategoria)) {
                                return Html::a($subcategoria->nombre, ['subcategoria/view', 'id' => $subcategoria->idsubcategoria]);
                            } else {
                                return '';
                            }
                        },
                    ],
                    //'rutaimg',
                    [
                        'format' => 'raw',
                        'label' => 'Imagen',
                        'attribute' => 'rutaimg',
                        //'value'=>'proveedor.nombre',
                        'value' => function ($data) {
                            $img = $data->rutaimg;
                            if (strlen($img) < 3) {
                                $img = 'uploads/logo.png';
                            }
                            return Html::img('/' . $img, ['style' => 'max-width:35%', 'alt' => 'Abrasa']);
                        },
                    ],
                    //'ficha',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>