<?php


/* @var $this yii\web\View */
/* @var $model app\models\Catnoticias */

/* @var $form yii\widgets\ActiveForm */

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\bootstrap5\Html;

?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'descripcion') ?>

<?php
try {
    echo $form->field($model, 'imagen')->widget(FileInput::class);
    echo $form->field($model, 'principal')->checkbox();
} catch (Exception $e) {
    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
}
?>

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

