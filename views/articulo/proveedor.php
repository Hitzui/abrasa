<?php

use app\models\Articulo;
use app\models\Proveedor;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Detaproveedor */
/* @var $form ActiveForm */

$this->title='Asociar';
$this->params['breadcrumbs'][] = ['label' => '/Lista A-P/', 'url' => ['articulo/proveedores']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="articulo-proveedor">

                <?php $form = ActiveForm::begin(); ?>

                <?php
                $proveedores = ArrayHelper::map(Proveedor::find()->all(), 'idproveedor', 'nombre');
                echo $form->field($model, 'idproveedor')->widget(Select2::class, [
                    'data' => $proveedores,
                    'options' => ['placeholder' => 'Seleccione un articulo...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);

                $articulos = ArrayHelper::map(Articulo::find()->all(), 'idarticulo', 'descripcion');
                echo $form->field($model, 'idarticulo')->widget(Select2::class, [
                    'data' => $articulos,
                    'options' => ['placeholder' => 'Seleccione un articulo...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div><!-- articulo-proveedor -->
        </div>
    </div>
</div>
