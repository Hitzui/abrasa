<?php

use kartik\file\FileInput;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cattecnico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container-fluid">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'imagen')->widget(FileInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
