<?php

use app\models\Articulo;
use app\models\Detaproveedor;
use app\models\Proveedor;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;


$this->title='Articulo por Proveedores';
$this->params['breadcrumbs'][] = ['label' => '/Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::a('Asociar Articulo-Proveedor', ['proveedor'], ['class' => 'btn btn-info']) ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // Simple columns defined by the data contained in $dataProvider.
                    // Data from the model's column will be used.
					'idproveedor',
					'idarticulo',
                    [
						'format'=>'raw',
                        'label'=>'Articulo',						
                        'attribute'=>'articulo',						                                                
                        'value'=>function($data){
							return Html::a(Articulo::findOne(['idarticulo'=>$data->idarticulo])->descripcion
										  ,['articulo/view','id'=>$data->idarticulo]);
						},
                    ],
                    [
						'format'=>'raw',
                        'label'=>'Proveedor',
                        'attribute'=>'proveedor',
                        //'value'=>'proveedor.nombre',
                        'value'=>function($data){
							$prov =Proveedor::findOne(['idproveedor'=>$data->idproveedor]);
							return Html::a(''.$prov->nombre,
										   ['proveedor/view','id'=>$data->idproveedor]);
						},
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template'=>'{view}',
                        'urlCreator' => function( $action, $model, $key, $index ){
                            if ($action == "view") {
                                return Url::to(['viewproveedor', 'idproveedor' => $model->idproveedor,'idarticulo'=>$model->idarticulo]);
                            }
        
                        }
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
