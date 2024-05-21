<div id="accordionTwo" role="tablist">
	<?php
	use app\models\Subcategoria;	
	use yii\helpers\Url;	
	foreach ($categorias as $categoria) {
		/** @var \app\models\Categoria $cat */
		if ($categoria->idcategoria === $cat->idcategoria) {
			$show = 'show';
		} else {
			$show = '';
		}
		?>
		<div class="card">
			<div id="heading-<?= $categoria->idcategoria ?>" role="tab" class="card-header">
				<h5 class="mb-0">
					<a data-toggle="collapse" href="#collapse-<?= $categoria->idcategoria ?>"
					   aria-expanded="true" aria-controls="collapse-<?= $categoria->idcategoria ?>">
						<?= $categoria->nombre ?></a>
				</h5>
			</div>
			<div id="collapse-<?= $categoria->idcategoria ?>" role="tabpanel"
				 aria-labelledby="heading-<?= $categoria->idcategoria ?>" data-parent="#accordionTwo"
				 class="collapse <?= $show ?>">
				<div class="card-body">
					<ul class="list-group list-group-flush" style="margin: -20px">
						<?php
						$subcategorias = Subcategoria::find()
							->where(['idcategoria' => $categoria->idcategoria])
							->orderBy(['nombre'=> SORT_ASC])->all();
						foreach ($subcategorias as $subcategoria) {
							/** @var Subcategoria $sub */
							if ($sub->idsubcategoria === $subcategoria->idsubcategoria) {
								$active = 'active';
							} else {
								$active = '';
							}
							?>
							<li class="list-group-item <?= $active ?>">
								<a href="<?= Url::to(['producto/find', 'id' => $subcategoria->idsubcategoria]) ?>">
									<?= $subcategoria->nombre ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}//fin de categorias
	?>
</div>