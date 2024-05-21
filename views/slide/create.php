<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Slide */

$this->title = 'Subir Imagenes';
$this->params['breadcrumbs'][] = ['label' => '/Slides/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
                'multiple' => true
            ]) ?>
        </div>
    </div>

</div>
