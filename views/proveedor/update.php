<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = 'Update Proveedor: ' . $model->idproveedor;
$this->params['breadcrumbs'][] = ['label' => '/ Proveedors /', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Codigo '.$model->idproveedor, 'url' => ['view', 'id' => $model->idproveedor]];
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		
			<div class="proveedor-update">

				<h1><?= Html::encode($this->title) ?></h1>

				<?= $this->render('_form', [
					'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
</div>
