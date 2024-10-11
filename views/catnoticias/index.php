<?php


use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatnoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categoria de noticias';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container-fluid">

    <p>
        <?= Html::a('Crear Categoria de noticia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if ( Yii::$app->session->hasFlash('error') ) {
        echo Yii::$app->session->getFlash('error');
    }
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'idcatnoticias',
                'descripcion',
                'imagen:ntext',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    } catch (Throwable $e) {
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    } ?>

    <?php Pjax::end(); ?>

</div>
