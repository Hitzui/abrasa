<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subcatnoticias */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'idsubcategoria')->widget(Select2::class, [
    'data' => $subcategoria,
    'options' => ['placeholder' => 'Selecciona una subcategoria de noticias'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>

<?= $form->field($model, 'idnoticia')->widget(Select2::class, [
    'data' => $noticias,
    'options' => ['placeholder' => 'Selecciona una noticias'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

