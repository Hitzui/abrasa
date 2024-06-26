<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NoticiaCategoriaArticulo */

$this->title = 'Create Noticia Categoria Articulo';
$this->params['breadcrumbs'][] = ['label' => 'Noticia Categoria Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-categoria-articulo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
