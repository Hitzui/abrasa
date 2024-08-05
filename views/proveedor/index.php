<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedors';
$this->params['breadcrumbs'][] = '/ '.$this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="proveedor-index">

                <p>
                    <?= Html::a('Crear Proveedor', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin();?>

                <?php try {
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'idproveedor',
                            'nombre',
                            'imagen',
                            [
                                'format' => 'raw',
                                'attribute' => 'imagen',
                                'value' => function ($data) {
                                    return Html::img('/' . $data->imagen, ['height' => '200px']);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update}'
                            ],
                        ],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                } ?>
				<?php Pjax::begin(); ?>

            </div>
        </div>
    </div>
</div>