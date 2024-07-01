<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Imagenes */
/* @var $noticias array */
/* @var $multiple boolean */

$this->title = 'Create Imagenes';
$this->params['breadcrumbs'][] = ['label' => 'Imagenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagenes-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Yii::$app->session->getFlash('error'); ?>
    <?= $this->render('_form', [
        'model' => $model,
        'noticias'=>$noticias,
        'multiple'=>$multiple
    ]) ?>

</div>
