<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */

$this->title = 'Actualizar Subcategoria: ' . $model->idsubcategoria;
$this->params['breadcrumbs'][] = ['label' => '/ Subcategorias / ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsubcategoria, 'url' => ['view', 'id' => $model->idsubcategoria]];
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 justify-content-center">
            <div class="subcategoria-update">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
