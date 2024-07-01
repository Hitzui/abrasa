<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Imagenes */
/* @var $noticias app\models\Noticias */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="imagenes-form">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'ruta')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'imageFiles[]')->widget(FileInput::class, [
                    'options' => [
                        'multiple' => $multiple,
                    ]
                ]) ?>
                <?= $form->field($model, 'ruta') ?>
                <?= $form->field($model, 'idnoticia')->widget(Select2::class, [
                    'data' => $noticias,
                    'options' => ['placeholder' => 'Seleccione una noticia'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>