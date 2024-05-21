<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subcatnoticias */

$this->title = 'Crear Subcatnoticias';
$this->params['breadcrumbs'][] = ['label' => '/Subcat-noticias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">


    <?= $this->render('_form', [
        'model' => $model,
        'subcategoria' => $subcategoria,
        'noticias' => $noticias,
    ]) ?>

</div>
