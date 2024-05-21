<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NoticiasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idnoticias') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'contenido_pe') ?>

    <?= $form->field($model, 'contenido_gr') ?>

    <?= $form->field($model, 'imagen') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'idcategoria') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
