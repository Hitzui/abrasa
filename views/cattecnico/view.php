<?php

use kartik\detail\DetailView;
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Cattecnico */

$this->title = 'Categoria ' . $model->idcattecnico;
$this->params['breadcrumbs'][] = ['label' => '/Categoria tecnicos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idcattecnico], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idcattecnico], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    try {
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idcattecnico',
                'nombre:ntext',
                'imagen',
                [
                    'format' => 'raw',
                    'attribute' => 'imagen',
                    'value' => Html::img($model->imagen, ['alt' => $model->nombre,'width'=>'150'])
                ],
            ],
        ]);
    } catch (Throwable $e) {
        echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
    }
    ?>
    <div>
        <hr/>
        <h2>Tecnicos asociados a esta categoria</h2>
    </div>
    <?php
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nombre:ntext',
                'sucursal:ntext',
                'telefono:ntext',
                'correo:ntext',
                'area:ntext',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}{update}',
                    'header' => 'Actions',
                    'headerOptions' => ['style' => 'color:#337ab7'],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'Ver datos'),
                            ]);
                        },

                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Actualizar'),
                            ]);
                        },

                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['tecnico/view', 'id' => $model->idtecnico]);
                            return $url;
                        }

                        if ($action === 'update') {
                            $url = Url::to(['tecnico/update', 'id' => $model->idtecnico]);
                            return $url;
                        }

                    }
                ],
            ]
        ]);
    } catch (Throwable $e) {
        echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
    } ?>

</div>
