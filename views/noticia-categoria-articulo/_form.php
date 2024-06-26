<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NoticiaCategoriaArticulo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-categoria-articulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idnoticias')->textInput() ?>

    <?= $form->field($model, 'idarticulo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
