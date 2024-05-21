<?php

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tecnico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    try {
        echo $form->field($model, 'idcattecnico')->widget(Select2::class, [
            'data' => $cattecnicos,
            'options' => ['placeholder' => 'Seleccione una categoria'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    } catch (Exception $e) {
        echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
    }
    ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'sucursal') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'correo') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'posicion')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'imagen')->widget(FileInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
