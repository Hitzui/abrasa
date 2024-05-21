<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cattecnico */

$this->title = 'Crear Categoria tecnico';
$this->params['breadcrumbs'][] = ['label' => '/Categoria tecnicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = '/'.$this->title;
?>
<div class="container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
