<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = 'Actualizar Categoria: ' . $model->idcategoria;
$this->params['breadcrumbs'][] = ['label' => '/Categorias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcategoria, 'url' => ['view', 'id' => $model->idcategoria]];
?>
<div class="container">
    <div class="col-md-12">
        <div class="categoria-update">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
