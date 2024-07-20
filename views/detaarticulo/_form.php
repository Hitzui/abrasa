<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Articulo;
use app\models\Categoria;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
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
if (empty($model->idsubcategoria)) {
    $id = 0;
} else {
    $id = $model->idsubcategoria;
}
if ($id > 0) {
    $sub = Subcategoria::find()->where(['idsubcategoria' => $id])->one();
    $this->registerJs("
    var data = [
        {
            id: " . $id . ",
            text: '" . $sub->nombre . "'
        }
        ];
        $('.data-subcategoria').select2({
            data:data
          });
    ");
}
?>

<div class="detaarticulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <label for="idsubcategoria">
                Seleccione una Categoria
                <select class="data-categoria custom-select" id="idcategoria" style="min-width: 600px;"></select>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="idsubcategoria">
                Seleccione Subcategoria
                <select name="Detaarticulo[idsubcategoria]" class="data-subcategoria custom-select" id="idsubcategoria"
                        style="min-width: 600px;"></select>
            </label>
        </div>
    </div>

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
