<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form kartik\form\ActiveForm */
$dispOptions = ['class' => 'form-control kv-monospace'];

$saveOptions = [
    'type' => 'text',
    'label'=>'<label>Saved Value: </label>',
    'class' => 'kv-saved',
    'readonly' => true,
    'tabindex' => 1000
];
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /*= $form->field($model, 'idproveedor')->textInput() */?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orden')->textInput(['type' => 'number']) ?>

	<?php try {
        echo $form->field($model, 'imagen')->widget(FileInput::class, [
            'options' => ['accept' => 'image/*'],
        ]);
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">'.$e->getMessage().'</div>';
    } ?>
	
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
