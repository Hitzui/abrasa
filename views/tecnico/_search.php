<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TecnicoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tecnico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idtecnico') ?>

    <?= $form->field($model, 'idcattecnico') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'sucursal') ?>

    <?= $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'correo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
