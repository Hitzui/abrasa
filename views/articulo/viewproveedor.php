<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $articulo \app\models\Articulo */
/* @var $proveedor \app\models\Proveedor */

$this->title = 'Articulo-'.$articulo->idarticulo;
$this->params['breadcrumbs'][] = ['label' => '/Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '/Articulo-Proveedor/', 'url' => ['articulo/proveedores']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="articulo-view">
                <p>
                    <?= Html::a('Actualizar', 
                        [
                            'updateprov', 'idproveedor' => $proveedor->idproveedor,'idarticulo'=>$articulo->idarticulo
                        ], 
                        [
                            'class' => 'btn btn-primary'
                        ]
                    ) ?>
                    <?= Html::a('Eliminar',  ['#'],
                    [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'toggle' => 'modal',
                            'target' => '#eliminar',
                        ],
                    ]) ?>                    
                    <?= Html::a('Volver a la lista', ['articulo/proveedores'], ['class' => 'btn btn-info']) ?>
                </p>
<!-- Modal -->
<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="eliminar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminar">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Seguro desea eliminar la asociación de articulo-proveedor? Esta acción no se puede revertir.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <!-- <button type="button" class="btn btn-primary">Aceptar</button> -->
        <?= Html::a('Aceptar', 
                        [
                            'deleteprov', 'idproveedor' => $proveedor->idproveedor,'idarticulo'=>$articulo->idarticulo
                        ], 
                        [
                            'class' => 'btn btn-primary'
                        ]
                    ) ?>
      </div>
    </div>
  </div>
</div>
                <?= DetailView::widget([
                    'model' => $articulo,
                    'attributes' => [
                        [
							'format'=>'raw',
							'label'=>'Id Articulo',
							'attribute'=>'idarticulo',
							'value'=>function($data){								
								return Html::a(''.$data->idarticulo,['articulo/update','id'=>$data->idarticulo]);
							},
						],
                        'descripcion:ntext',
                        'caracteristicas:ntext',
                        'idsubcategoria',
                        //'rutaimg',
                        [
                            'attribute'=>'rutaimg',
                            'value'=>('/'.$articulo->rutaimg),
                            'format' => ['image',['width'=>'60%','alt'=>$articulo->descripcion]],
                        ],
                        [
							'format'=>'raw',
							'label'=>'Ficha Tecnica',
							'attribute'=>'ficha',
							'value'=>function($data){								
								return Html::a(''.$data->ficha,['/'.$data->ficha]);
							},
						],
						[
							'format'=>'raw',
							'label'=>'Hoja de Seguridad',
							'attribute'=>'hoja',
							'value'=>function($data){								
								return Html::a(''.$data->hoja,['/'.$data->hoja]);
							},
						],
                    ],
                ]) ?>
                <hr />
                <?= DetailView::widget([
                    'model' => $proveedor,
                    'attributes' => [
                        'idproveedor',
                        'nombre',
                        //'imagen',
						[
                            'attribute'=>'imagen',
                            'value'=>('/'.$proveedor->imagen),
                            'format' => ['image',['width'=>'230','height'=>'200']],
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
