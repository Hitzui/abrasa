<?php

use app\models\Catnoticias;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subnoticias */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(Catnoticias::find()->all(), 'idcatnoticias', 'descripcion');
?>

<div class="subnoticias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'idcategoria')->widget(Select2::class, [
        'data' => $data,
        'options' => ['placeholder' => 'Seleccciona una categoria de noticia'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'imagen')->widget(FileInput::class) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
