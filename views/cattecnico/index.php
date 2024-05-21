<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CattecnicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categoria tecnicos';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear categoria tecnico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php try {
        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'idcattecnico',
                'nombre:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    } catch (Throwable $e) {
        echo '<div class="alert-danger">'.$e->getMessage().'</div>';
    }  ?>

    <?php Pjax::end(); ?>

</div>
