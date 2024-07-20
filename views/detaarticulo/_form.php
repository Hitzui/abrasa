<?php

use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Articulo;
use app\models\Categoria;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\web\JqueryAsset;
use app\models\Subcategoria;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Detaarticulo */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile("/js/detaarticulo.js", ['depends' => [JqueryAsset::class]]);
$this->registerCss('
.select2-selection{
    min-width:250px;
');
$categorias = ArrayHelper::map(Categoria::find()->all(), 'idcategoria', 'nombre');
?>

<div class="detaarticulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Parent
    echo $form->field($model, 'idcategoria')->dropDownList($categorias, ['id'=>'cat-id']);

    // Child # 1
    echo $form->field($model, 'idsubcategoria')->widget(DepDrop::class, [
        'options'=>['id'=>'subcat-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/subcategoria/subcat'])
        ]
    ]);
    ?>

    <?php
    $articulos = ArrayHelper::map(Articulo::find()->all(), 'idarticulo', 'descripcion');
    echo $form->field($model, 'idarticulo')->widget(Select2::class, [
        'data' => $articulos,
        'options' => ['placeholder' => 'Seleccione un articulo'],
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
