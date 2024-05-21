<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Presentacion */

$this->title = 'Crear Presentacion';
$this->params['breadcrumbs'][] = ['label' => '/Presentaciones/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">


    <?= $this->render('_form', [
        'model' => $model,
        'articulos' => $articulos,
    ]) ?>

</div>
