<?php

use kartik\editors\Summernote;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */
/* @var $form yii\widgets\ActiveForm */
try {
    $this->registerJsFile('/admin/js/file.js');
} catch (InvalidConfigException $e) {
}
$this->registerJs('$("#noticias-fecha").datepicker({format: "yyyy-mm-dd",})', View::POS_END);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="noticias-form">

                <?php $form = ActiveForm::begin();
                try {
                    echo '<div class="form-group-lg">';
                    echo $form->field($model, 'titulo')->widget(Summernote::class, [
                        'useKrajeePresets' => true,
                        // other widget settings
                    ]);
                    echo '</div>';
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                }

                try {
                    echo '<div class="form-group-lg">';
                    echo $form->field($model, 'contenido_pe')->widget(Summernote::class, [
                        'useKrajeePresets' => true,
                        // other widget settings
                    ]);
                    echo '</div>';
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                }

                try {
                    echo '<div class="form-group-lg">';
                    echo $form->field($model, 'contenido_gr')->widget(Summernote::class, [
                        'useKrajeePresets' => true,
                        // other widget settings
                    ]);
                    echo '</div>';
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                }
                try {
                    echo $form->field($model, 'imagen')->widget(FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                    ]);
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                } ?>

                <?= $form->field($model, 'fecha') ?>

                <?php
                try {
                    echo $form->field($model, 'idcategoria')->widget(Select2::class, [
                        'data' => $catnoticias,
                        'options' => ['placeholder' => 'Seleccione una categoria'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                }
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
