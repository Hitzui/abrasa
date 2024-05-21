<?php

/* @var $this yii\web\View */
/* @var $model app\models\Catnoticias */

$this->title = 'Crear Categoria noticia';
$this->params['breadcrumbs'][] = ['label' => '/Categoria noticia/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
