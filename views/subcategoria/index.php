<?php

use app\models\Categoria;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubCategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub-Categorias';
$this->params['breadcrumbs'][] = ' / ' . $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="subcategoria-index">

                <p>
                    <?= Html::a('Crear Subcategoria', ['create'], ['class' => 'btn btn-info']) ?>
                </p>

                <?php /*= $this->render('_search', ['model' => $searchModel]) */ ?>

                <?php try {
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'idsubcategoria',
                            //'idcategoria',
                            [
                                'format' => 'raw',
                                'label' => 'Categoria',
                                'attribute' => 'categoria',
                                'value' => function ($data) {
                                    $categoriaFind = Categoria::findOne(['idcategoria' => $data->idcategoria]);
                                    if (isset($categoriaFind)) {
                                        return Html::a($categoriaFind->nombre, ['categoria/view', 'id' => $categoriaFind->idcategoria]);
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                            'nombre',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                } ?>


            </div>
        </div>
    </div>
</div>
