<?php

use app\models\Color;
use app\models\Subcategoria;
use app\utility\Utility;
use kartik\color\ColorInput;
use kartik\editors\Summernote;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Articulo */
/* @var $modelColors app\models\Color */
/* @var $form ActiveForm */

?>

<div class="articulo-form container-fluid">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'idarticulo') ?>

    <div class="form-group-lg">
        <?php
        try {
            echo $form->field($model, 'descripcion');
        } catch (Exception $e) {
            echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
        }
        ?>
    </div>

    <?php
    try {
        echo $form->field($model, 'caracteristicas')->widget(Summernote::class, [
            'useKrajeePresets' => true,
            // other widget settings
        ]);
    } catch (Exception $e) {
        echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
    }
    ?>
    <?php /*= $form->field($model, 'descripcion')->textarea(['rows' => 6]) */ ?>
    <?php /*= $form->field($model, 'caracteristicas')->textarea(['rows' => 6]) */ ?>
    <?= $form->field($model, 'inicio')->checkbox() ?>

    <?= $form->field($model, 'keyword')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'uso')->textarea(['rows' => 6]) ?>

    <?php
    try {
        echo $form->field($model, 'presentacion')->widget(Summernote::class, [
            'useKrajeePresets' => true,
            // other widget settings
        ]);
    } catch (Exception $e) {
        echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
    }
    ?>
    <?php
    $subcategoria = Utility::subCategorias();

    try {
        echo $form->field($model, 'idsubcategoria')->widget(Select2::class, [
            'data' => $subcategoria,
            'options' => ['placeholder' => 'Seleccione una subcategoria'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    }
    ?>

    <?= $form->field($model, 'rutaimg')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]) ?>
    <div class="box-simple box-white same-height">
        <?= $form->field($model, 'ficha')->widget(FileInput::class, [
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ]
        ]) ?>

    </div>

    <div class="box-simple box-white same-height">
        <?= $form->field($model, 'hoja')->widget(FileInput::class, [
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ]
        ]) ?>
    </div>
    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php
    $modelColor = new Color();
    ?>
    <div class="panel panel-default">
        <div class="panel-body container-items"><!-- widgetContainer -->
            <div class="item panel panel-default"><!-- widgetBody -->
                <div class="panel-heading">
                    <i class="fas fa-palette"></i> Colores
                </div>
                <div class="panel-body">
                    <?php
                    echo $form->field($model, 'colores')->widget(MultipleInput::class, [
                        'max' => 6,
                        'min' => 0, // should be at least 2 rows
                        'allowEmptyList' => true,
                        'enableGuessTitle' => true,
                        'columns' => [
                            [
                                'name' => 'codigo',
                                'type' => ColorInput::class,
                                'title' => 'Color',
                            ]
                        ],
                        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
                    ])
                        ->label(false);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
