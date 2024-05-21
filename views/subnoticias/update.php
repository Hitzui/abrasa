<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subnoticias */

$this->title = 'Actualizar Sub-noticias: ' . $model->idsubnoticias;
$this->params['breadcrumbs'][] = ['label' => '/SubCategoria-noticias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsubnoticias, 'url' => ['view', 'id' => $model->idsubnoticias]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="container">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
