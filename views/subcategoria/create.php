<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */

$this->title = 'Crear Subcategoria';
$this->params['breadcrumbs'][] = ['label' => '/ Subcategorias / ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="subcategoria-create">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
