<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = 'Crear Categoria';
$this->params['breadcrumbs'][] = ['label' => '/Categorias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="categoria-create">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>
