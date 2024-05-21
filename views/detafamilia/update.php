<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detafamilia */

$this->title = 'Actualizar Deta-familia: ' . $model->idfamilia;
$this->params['breadcrumbs'][] = ['label' => '/Detafamilias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'ID-'.$model->idfamilia, 'url' => ['view', 'idfamilia' => $model->idfamilia, 'idsubcategoria' => $model->idsubcategoria]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="detafamilia-update">
				<?= $this->render('_form', [
					'model' => $model,
					'familias' => $familias,
					'subcategorias' => $subcategorias,
				]) ?>

			</div>
		</div>
	</div>
</div>
