<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familia */

$this->title = 'Update Familia: ' . $model->idfamilia;
$this->params['breadcrumbs'][] = ['label' => '/Familias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Id-'.$model->idfamilia, 'url' => ['view', 'id' => $model->idfamilia]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="familia-update">

				<h1><?= Html::encode($this->title) ?></h1>

				<?= $this->render('_form', [
					'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
</div>
