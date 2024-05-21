<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'imagen')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>

    <?= $form->field($model, 'color')->widget(ColorInput::class, [
        'options' => ['placeholder' => 'Select color ...'],
    ]) ?>
    <?= $form->field($model,'posicion')->textInput(['type'=>'number'])?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
