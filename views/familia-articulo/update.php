<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FamiliaArticulo */
/** @var \app\models\Articulo $articulos */
/** @var \app\models\Familia $familias */
/** @var \app\models\Subcategoria $subcategorias */

$this->title = 'Actualizar: ' . $model->idfamilia;
$this->params['breadcrumbs'][] = ['label' => '/Familia-Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'ID-'.$model->idfamilia, 'url' => ['view', 'idfamilia' => $model->idfamilia, 'idarticulo' => $model->idarticulo]];
$this->params['breadcrumbs'][] = '/Actualizar';
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="familia-articulo-update">

                <?=
                $this->render('_form', [
					'model' => $model,
					'articulos' => $articulos,
					'familias' => $familias,
					'subcategorias'=>$subcategorias,
				]) ?>

			</div>
		</div>
	</div>
</div>
