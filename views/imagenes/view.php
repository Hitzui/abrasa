<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Imagenes */

$this->title = 'Imagen: '.$model->idimagenes;
$this->params['breadcrumbs'][] = ['label' => '/Imagenes/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="imagenes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idimagenes], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idimagenes], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro desea elminar la imagen seleccionada?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idimagenes',
            'nombre',
            'ruta',
            'fecha',
            'titulo',
            'idnoticia',
        ],
    ]) ?>

</div>
