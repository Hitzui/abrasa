<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = 'Create Proveedor';
$this->params['breadcrumbs'][] = ['label' => '/ Proveedors /', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="proveedor-create">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
