<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tecnico */

$this->title = 'Crear Tecnico';
$this->params['breadcrumbs'][] = ['label' => '/Tecnicos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <?= $this->render('_form', [
        'model' => $model,
        'cattecnicos' => $cattecnicos,
    ]) ?>

</div>
