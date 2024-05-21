<?php

/* @var $this yii\web\View */
/* @var $model app\models\Articulo */

$this->title = 'Update Articulo: ' . $model->idarticulo;
$this->params['breadcrumbs'][] = ['label' => '/Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idarticulo, 'url' => ['view', 'id' => $model->idarticulo]];
$this->params['breadcrumbs'][] = '/Update';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
        </div>
    </div>
</div>
