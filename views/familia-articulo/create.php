<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FamiliaArticulo */
/* @var $articulos app\models\Articulo */
/* @var $subcategorias app\models\Subcategoria */
/* @var $familias app\models\Familia */

$this->title = 'Asociar';
$this->params['breadcrumbs'][] = ['label' => '/Familia-Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="familia-articulo-create">

				<?= $this->render('_form', [
					'model' => $model,
					'articulos'=>$articulos,
					'familias'=>$familias,
					'subcategorias'=>$subcategorias,
				]) ?>

			</div>
		</div>
	</div>
</div>
