<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FamiliaArticulo */

$this->title = 'ID-'.$model->idfamilia;
$this->params['breadcrumbs'][] = ['label' => '/Familia-Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="familia-articulo-view">

				<h1>Detalle:</h1>

				<p>
					<?= Html::a('Actualizar', ['update', 'idfamilia' => $model->idfamilia, 'idarticulo' => $model->idarticulo], ['class' => 'btn btn-primary']) ?>
					<?= Html::a('Eliminar', ['delete', 'idfamilia' => $model->idfamilia, 'idarticulo' => $model->idarticulo], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => '¿Esta seguro de eliminar la asociación? Esta acción no se puede revertir.',
							'method' => 'post',
						],
					]) ?>
				</p>

				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'idfamilia',
						'idarticulo',
                        'idsubcategoria',
                        [
                            'format'=>'raw',
                            'label'=>'Articulo',
                            'value'=>function($data){
                                return Html::a($data->articulo->descripcion, ['articulo/view', 'id' => $data->articulo->idarticulo], ['class' => 'profile-link']);
                            }
                        ],
                        [
                            'format'=>'raw',
                            'label'=>'Sub-categoria',
                            'value'=>function($data){
                                return Html::a($data->subcategoria->nombre, ['subcategoria/view', 'id' => $data->subcategoria->idsubcategoria], ['class' => 'profile-link']);
                            }
                        ],
                        [
                            'format'=>'raw',
                            'label'=>'Familia',
                            'value'=>function($data){
                                return Html::a($data->familia->nombre, ['familia/view', 'id' => $data->familia->idfamilia], ['class' => 'profile-link']);
                            }
                        ]
					],
				]) ?>

			</div>

		</div>
	</div>
</div>