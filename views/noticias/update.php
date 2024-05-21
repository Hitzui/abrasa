<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'Actualizar Noticia: ' . $model->idnoticias;
$this->params['breadcrumbs'][] = ['label' => '/Noticias/', 'url' => ['alls']];
$this->params['breadcrumbs'][] = ['label' => $model->idnoticias, 'url' => ['view', 'id' => $model->idnoticias]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="noticias-update">

    <?= $this->render('_form', [
        'model' => $model,
        'catnoticias'=>$catnoticias
    ]) ?>

</div>
