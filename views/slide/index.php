<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SlideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Slides';
$this->params['breadcrumbs'][] = '/'.$this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="slide-index">
                <p>
                    <?= Html::a('Subir Imagenes', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'ruta',
                        [
                            'format' => 'raw',
                            'label'=>'Imagen',
                            'attribute' => 'ruta',
                            'value' => function ($data) {
                                return Html::img( $data->ruta,['style'=>'width:60%']);
                            }
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>

        </div>
    </div>
</div>