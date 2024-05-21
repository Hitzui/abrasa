<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticuloSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articulo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idarticulo') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'caracteristicas') ?>

    <?= $form->field($model, 'idsubcategoria') ?>

    <?= $form->field($model, 'rutaimg') ?>

    <?php // echo $form->field($model, 'ficha') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
