<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familia */

$this->title = 'Crear Familia';
$this->params['breadcrumbs'][] = ['label' => '/Familias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="familia-create">

				<h1><?= Html::encode($this->title) ?></h1>

				<?= $this->render('_form', [
					'model' => $model,
				]) ?>

			</div>
		</div>
	</div>
</div>
