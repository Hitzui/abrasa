<?php

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'Crear Noticias';
$this->params['breadcrumbs'][] = ['label' => '/ Noticias /', 'url' => ['alls']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'catnoticias'=>$catnoticias
]) ?>
