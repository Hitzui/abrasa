<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Articulo;
use app\models\Familia;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\FamiliaArticulo */
/* @var $familias app\models\Familia */
/* @var $articulos app\models\Articulo */
/* @var $subcategorias app\models\Subcategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familia-articulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php    
    echo $form->field($model, 'idfamilia')->widget(Select2::class, [
        'data' => $familias,
        'options' => ['placeholder' => 'Seleccione una familia'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
	<?php    
    echo $form->field($model, 'idarticulo')->widget(Select2::class, [
        'data' => $articulos,
        'options' => ['placeholder' => 'Seleccione un articulo'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?php
    echo $form->field($model, 'idsubcategoria')->widget(Select2::class, [
        'data' => $subcategorias,
        'options' => ['placeholder' => 'Seleccione una subcategoria'],
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
