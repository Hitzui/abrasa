<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Presentacion */
/* @var $articulos app\models\Articulo */
/* @var $form yii\widgets\ActiveForm */
?>

<section>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?=
    $form->field($model, 'idarticulo')->widget(Select2::class, [
        'data' => $articulos,
        'options' => ['placeholder' => 'Seleccione un articulo'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?php try {
        echo $form->field($model, 'ruta')->widget(FileInput::class, [
            'options' => ['accept' => 'image/*'],
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    } ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</section>
