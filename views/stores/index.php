<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tiendas';
$this->params['breadcrumbs'][] = '/ '.$this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::a('Crear Tienda', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'storeName',
                    'phoneFormatted',
                    'address',
                    'city',
                    'ejecutivo',
                    //'postalCode',
                    //'latitude',
                    //'longitude',
                    //'email:email',
                    //'cobertura:ntext',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
