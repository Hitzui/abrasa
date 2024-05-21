<?php

use app\models\Subcategoria;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Articulo;
use app\models\Familia;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FamiliaArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familia Articulos';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="familia-articulo-index">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Asociar Familia-Articulo', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?php try {
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'idfamilia',
                            'idarticulo',
                            [
                                'format' => 'raw',
                                'label' => 'Articulo',
                                'attribute' => 'articulo',
                                'value' => function ($data) {
                                    return Html::a(Articulo::findOne(['idarticulo' => $data->idarticulo])->descripcion
                                        , ['articulo/view', 'id' => $data->idarticulo]);
                                },
                            ],
                            [
                                'format' => 'raw',
                                'label' => 'Familia',
                                'attribute' => 'familia',
                                //'value'=>'proveedor.nombre',
                                'value' => function ($data) {
                                    $prov = Familia::findOne(['idfamilia' => $data->idfamilia]);
                                    return Html::a($prov->nombre, ['familia/view', 'id' => $data->idfamilia]);
                                },
                            ],
                            [
                                'format' => 'raw',
                                'label' => 'Sub-Categoria',
                                'attribute' => 'subcategoria',
//'value'=>'proveedor.nombre',
                                'value' => function ($data) {
                                    $prov = Subcategoria::findOne(['idsubcategoria' => $data->idsubcategoria]);
                                    return Html::a($prov->nombre, ['subcategoria/view', 'id' => $data->idsubcategoria]);
                                },
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                } ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>