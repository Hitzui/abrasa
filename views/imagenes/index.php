<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagenesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imagenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="imagenes-index">
                <p>
                    <?= Html::a('Subir Imagenes', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?php try {
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'idimagenes',
                            //'ruta',
                            [
                                'format' => 'raw',
                                'attribute' => 'ruta',
                                'value' => function ($data) {
                                    return Html::img('/' . $data->ruta, ['style' => 'width:50%','alt'=>'ABRASA']);
                                }
                            ],
                            'idnoticia',
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