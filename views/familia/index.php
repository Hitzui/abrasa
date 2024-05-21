<?php

use app\models\Categoria;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FamiliaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familias';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="familia-index">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Crear Familia', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?php try {
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'idfamilia',
                            'nombre:ntext',
                            //'idcategoria',
                            [
                                'format' => 'raw',
                                'label' => 'Categoria',
                                'attribute' => 'categoria',
                                'value' => function ($data) {
                                    $categoria = Categoria::findOne(['idcategoria' => $data->idcategoria]);
                                    if(isset($categoria)){
                                        return Html::a($categoria->nombre, ['categoria/view', 'id' => $categoria->idcategoria]);
                                    }else{
                                        return '';
                                    }
                                },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update}',
                            ],
                        ],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                } ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>
