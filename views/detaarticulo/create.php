<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detaarticulo */

$this->title = 'Asociar Subcategoria-Articulo';
$this->params['breadcrumbs'][] = ['label' => '/ Detaarticulos /', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="detaarticulo-create">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

            </div>
        </div>
    </div>
</div>