<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NoticiaCategoriaArticulo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-categoria-articulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'idnoticias')->widget(Select2::class, [
        'data' => $catnoticias,
        'options' => ['placeholder' => 'Seleccione una categoria...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?php
    echo $form->field($model, 'idcatarticulo')->widget(Select2::class, [
        'data' => $categorias,
        'options' => ['placeholder' => 'Seleccione una categoria...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
