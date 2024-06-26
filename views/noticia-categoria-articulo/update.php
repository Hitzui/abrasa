<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NoticiaCategoriaArticulo */

$this->title = 'Update Noticia Categoria Articulo: ' . $model->idnoticiacategoriaarticulo;
$this->params['breadcrumbs'][] = ['label' => 'Noticia Categoria Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnoticiacategoriaarticulo, 'url' => ['view', 'id' => $model->idnoticiacategoriaarticulo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="noticia-categoria-articulo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
