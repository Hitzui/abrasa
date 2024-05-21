<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Slide */

$this->title = 'Actualizar Imagen: ' . $model->idslide;
$this->params['breadcrumbs'][] = ['label' => '/Slides/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idslide, 'url' => ['view', 'id' => $model->idslide]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
                'multiple' => false
            ]) ?>
        </div>
    </div>
</div>
