<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImagenesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagenes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idimagenes') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'ruta') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'titulo') ?>

    <?php // echo $form->field($model, 'idnoticia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
