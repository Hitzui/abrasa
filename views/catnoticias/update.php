<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Catnoticias */

$this->title = 'Actualizar Categoria: ' . $model->idcatnoticias;
$this->params['breadcrumbs'][] = ['label' => '/Categoria de noticia/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Categoria: '.$model->idcatnoticias, 'url' => ['view', 'id' => $model->idcatnoticias]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="container">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
