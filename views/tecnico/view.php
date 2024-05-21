<?php

use kartik\detail\DetailView;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Tecnico */

$this->title = 'Tecnico: ' . $model->idtecnico;
$this->params['breadcrumbs'][] = ['label' => '/Tecnicos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idtecnico], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idtecnico], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idtecnico',
            [
                'format' => 'raw',
                'attribute' => 'idcattecnico',
                'value' => Html::a($model->cattecnico->nombre, ['cattecnico/view', 'id' => $model->idcattecnico])
            ],
            'nombre:ntext',
            'sucursal:ntext',
            'telefono:ntext',
            'correo:ntext',
            'area:ntext',
            'posicion',
            [
                'format' => 'raw',
                'attribute' => 'imagen',
                'value' => Html::img(Url::base(true) . '/' . $model->imagen, ["height" => 250])
            ],
        ],
    ]) ?>

</div>
