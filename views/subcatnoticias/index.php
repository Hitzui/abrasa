<?php

use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubcatnoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategoria Noticias';
$this->params['breadcrumbs'][] = '/'.$this->title;
?>
<div class="container">

    <p>
        <?= Html::a('Crear SubCategoria-Noticias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idsubcategoria',
            'idnoticia',
            [
                'format' => 'raw',
                'attribute' => 'subcategoria',
                'label'=>'Subcategoria Noticia',
                'value' => function ($data) {
                    return Html::a($data->subcategoria->nombre, ['subnoticias/view', 'id' => $data->idsubcategoria]);
                }
            ],
            [
                'format' => 'raw',
                'attribute' => 'noticia',
                'value' => function ($data) {
                    return Html::a($data->noticia->titulo, ['noticias/view', 'id' => $data->idnoticia]);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
