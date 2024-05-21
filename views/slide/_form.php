<?php

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Slide */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="slide-form">
                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Saved!</h4>
                        <?= Yii::$app->session->getFlash('error') ?>
                    </div>
                <?php endif; ?>
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'titulo') ?>
                <?= $form->field($model, 'descripcion') ?>

                <?php try {
                    echo $form->field($model, 'imageFiles')->widget(FileInput::class, [
                        'options' => [
                            //'multiple' => $multiple,
                        ],
                    ]);
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">'.$e->getMessage().'</div>';
                } ?>
                <?= $form->field($model, 'ruta') ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
