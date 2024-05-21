<?php

use app\models\Categoria;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /*echo $form->field($model, 'idcategoria')->textInput() */?>
    <?php
        $categoria = ArrayHelper::map(Categoria::find()->all(), 'idcategoria', 'nombre');
        echo $form->field($model, 'idcategoria')->dropDownList($categoria, ['prompt' => 'Seleccione Uno']);
    ?>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
