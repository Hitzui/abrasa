<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Detafamilia */

$this->title = 'Crear Deta-familia';
$this->params['breadcrumbs'][] = ['label' => '/Deta-familias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="detafamilia-create">
				
				<?= $this->render('_form', [
					'model' => $model,
					'familias' => $familias,
					'subcategorias' => $subcategorias,
				]) ?>

			</div>
		</div>
	</div>
</div>
