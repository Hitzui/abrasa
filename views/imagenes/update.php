<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Imagenes */

$this->title = 'Actualizar Imagenes: ' . $model->idimagenes;
$this->params['breadcrumbs'][] = ['label' => '/Imagenes/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idimagenes, 'url' => ['view', 'id' => $model->idimagenes]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="imagenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'noticias' => $noticias,
        'multiple'=>$multiple
    ]) ?>

</div>
