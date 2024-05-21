<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TecnicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tecnicos';
$this->params['breadcrumbs'][] = '/'.$this->title;
?>
<div class="container-fluid">

    <p>
        <?= Html::a('Ingresar Tecnico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'raw',
                'attribute' => 'cattecnico',
                'label' => 'Categoria Tecnico',
                'value' => function ($data) {
                    return Html::a($data->cattecnico->nombre, ['cattecnico/view', 'id' => $data->idcattecnico]);
                }
            ],
            'nombre:ntext',
            'sucursal:ntext',
            'correo:ntext',
            'area:ntext',
            'posicion',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
