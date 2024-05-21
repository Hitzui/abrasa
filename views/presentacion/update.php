<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Presentacion */

$this->title = 'Actualizar Presentacion: ' . $model->idpresentacion;
$this->params['breadcrumbs'][] = ['label' => '/Presentaciones/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Id: '.$model->idpresentacion, 'url' => ['view', 'id' => $model->idpresentacion]];
$this->params['breadcrumbs'][] = 'Actualziar';
?>
<div class="container">


    <?= $this->render('_form', [
        'model' => $model,
        'articulos' => $articulos,
    ]) ?>

</div>
