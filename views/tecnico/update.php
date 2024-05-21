<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tecnico */

$this->title = 'Actualizar Tecnico: ' . $model->idtecnico;
$this->params['breadcrumbs'][] = ['label' => '/Tecnicos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtecnico, 'url' => ['view', 'id' => $model->idtecnico]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="container-fluid">

    <?= $this->render('_form', [
        'model' => $model,
        'cattecnicos' => $cattecnicos,
    ]) ?>

</div>
