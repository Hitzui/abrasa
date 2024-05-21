<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subcatnoticias */

$this->title = 'Actualizar Subcat-noticias: ' . $model->idsubcategoria;
$this->params['breadcrumbs'][] = ['label' => '/Subcatnoticias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsubcategoria, 'url' => ['view', 'idsubcategoria' => $model->idsubcategoria, 'idnoticia' => $model->idnoticia]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="container">

    <?= $this->render('_form', [
        'model' => $model,
        'subcategoria' => $subcategoria,
        'noticias' => $noticias,
    ]) ?>

</div>
