<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Presentacion */

$this->title = 'Id: '.$model->idpresentacion;
$this->params['breadcrumbs'][] = ['label' => '/Presentaciones/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idpresentacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idpresentacion], [
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
            'idpresentacion',
            'idarticulo',
            'ruta',
            'descripcion:ntext',
        ],
    ]) ?>

</div>
