<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cattecnico */

$this->title = 'Actualizar Categoria: ' . $model->idcattecnico;
$this->params['breadcrumbs'][] = ['label' => '/Categoria tecnicos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Categoria ' . $model->idcattecnico, 'url' => ['view', 'id' => $model->idcattecnico]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
