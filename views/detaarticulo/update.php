<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detaarticulo */

$this->title = 'Actualizar: ' . $model->idsubcategoria;
$this->params['breadcrumbs'][] = ['label' => '/ Detaarticulos /', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsubcategoria, 'url' => ['view', 'idsubcategoria' => $model->idsubcategoria, 'idarticulo' => $model->idarticulo]];
$this->params['breadcrumbs'][] = '/ Actualizar';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="detaarticulo-update">            
            <?= $this->render('_form', [
                'subcateogria'=>$categoriaNoticia,
                'model' => $model,
            ]) ?>

            </div>            
        </div>
    </div>
</div>