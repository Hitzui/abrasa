<?php

use app\models\Detafamilia;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetafamiliaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detafamilias';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Crear Detafamilia', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'idfamilia',
                        'idsubcategoria',
                        [
                            'format' => 'raw',
                            'label' => 'Sub-Categoria',
                            'attribute' => 'subcategoria',
                            'value' => function ($data) {
                                /* @var $data Detafamilia */
                                $familia = $data->getSubcategoria()->where($data->idsubcategoria)->one();
                                return Html::a($familia->nombre, ['subcategoria/view', 'id' => $data->idsubcategoria]);
                            },
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Familia',
                            'attribute' => 'familia',
                            'value' => function ($data) {
                                /* @var $data Detafamilia */
                                $familia = $data->getFamilia()->where($data->idfamilia)->one();
                                return Html::a($familia->nombre, ['familia/view', 'id' => $data->idfamilia]);
                            },
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>
