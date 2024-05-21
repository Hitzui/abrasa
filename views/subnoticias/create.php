<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subnoticias */

$this->title = 'Crear Subcategoria-noticias';
$this->params['breadcrumbs'][] = ['label' => '/Subnoticias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
