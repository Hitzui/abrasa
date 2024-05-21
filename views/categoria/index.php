<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = '/'.$this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="categoria-index">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Crear Categoria', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <p>
                    <?= /** @var String $isGuest */
                    $isGuest ?>
                </p>

                <?php
                // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'idcategoria',
                        'nombre',
                        [
                            'format' => 'raw',
                            'attribute' => 'imagen',
                            'value' => function ($data) {
                                return Html::img('/' . $data->imagen,['class'=>'img-fluid']);
                            }
                        ],
                        'posicion',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>
        </div>
    </div>
</div>
