<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Categoria;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Familia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput() ?>
    
	<?php
        $categoria = ArrayHelper::map(Categoria::find()->all(), 'idcategoria', 'nombre');
        echo $form->field($model, 'idcategoria')->dropDownList($categoria, ['prompt' => 'Seleccione Uno']);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
