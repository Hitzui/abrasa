<?php

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'storeName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phoneFormatted')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'postalCode')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'ejecutivo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-sm-12">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'cobertura')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imagen')->widget(FileInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
