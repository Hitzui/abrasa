<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Articulo */
/* @var $modelColors app\models\Color */

$this->title = 'Create Articulo';
$this->params['breadcrumbs'][] = ['label' => '/Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="articulo-create">

                <?= $this->render('_form', [
                    'model' => $model,
                    'modelColors' => $modelColors,
                ]) ?>

            </div>
        </div>
    </div>
</div>
