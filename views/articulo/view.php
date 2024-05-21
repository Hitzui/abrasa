<?php

use app\models\Detaproveedor;
use app\models\Familia;
use app\models\FamiliaArticulo;
use app\models\Proveedor;
use app\models\Subcategoria;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\web\YiiAsset;


/* @var $this yii\web\View */
/* @var $model app\models\Articulo */

$this->title = 'Articulo-' . $model->idarticulo;
$this->params['breadcrumbs'][] = ['label' => '/Articulos/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

$familia = FamiliaArticulo::find()->where(['idarticulo' => $model->idarticulo])->all();
$familias = "";
foreach ($familia as $item) {
    $fam = Familia::findOne($item->idfamilia);
    $familias .= ' ' . Html::a($fam->nombre, ['familia/view', 'id' => $fam->idfamilia]);
}
$divfamilia = Html::tag('div', $familias);
$detaprov = Detaproveedor::find()->where(['idarticulo' => $model->idarticulo])->all();
$prov = "";
foreach ($detaprov as $item) {
    $p = Proveedor::findOne($item->idproveedor);
    $prov .= ' ' . Html::a($p->nombre, ['proveedor/view', 'id' => $p->idproveedor]);
}
$divProveedor = Html::tag('div', $prov);
$sub = Subcategoria::findOne($model->idsubcategoria);
if (isset($sub)) {
    $divSub = Html::a($sub->nombre, ['subcategoria/view', 'id' => $sub->idsubcategoria]);
} else {
    $divSub = '<a href="#"></a>';
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="articulo-view">
                <p>
                    <?php
                    // display success message
                    if (Yii::$app->session->hasFlash('save')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-save"></i> Guardar</h4>
                    <?= Yii::$app->session->getFlash('save') ?>
                </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('ficha_e')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Error!</h4>
                        <?= Yii::$app->session->getFlash('ficha_e') ?>
                    </div>
                <?php endif; ?>
                <?= Html::a('Actualizar', ['update', 'id' => $model->idarticulo], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $model->idarticulo], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Esta seguro de elminar el articulo seleccionado? Esta acción no se puede revertir',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Eliminar Ficha Tecnica', ['ficha', 'id' => $model->idarticulo], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Seguro desea quitar la ficha técnica del articulo seleccionado?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Eliminar Hoja De Seguridad', ['hoja', 'id' => $model->idarticulo], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Seguro desea quitar la hoja de seguridad del articulo seleccionado?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Eliminar Imagen', ['imagen', 'id' => $model->idarticulo], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Seguro desea quitar la imagen asignada al articulo seleccionado?',
                        'method' => 'post',
                    ],
                ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'condensed' => true,
                    'hover' => true,
                    'mode' => DetailView::MODE_VIEW,
                    'attributes' => [
                        'idarticulo',
                        [
                            'format' => 'raw',
                            'attribute' => 'descripcion'
                        ],
                        'presentacion',
                        [
                            'format' => 'raw',
                            'attribute' => 'inicio',
                            'value' => $model->inicio == 0 ? '<span>No</span>' : '<span>Si</span>'
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'caracteristicas'
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'keyword'
                        ],
                        //'rutaimg',
                        [
                            'label' => 'Imagen',
                            'attribute' => 'rutaimg',
                            'value' => '/' . $model->rutaimg,
                            'format' => ['image', ['width' => '40%', 'alt' => $model->descripcion]],
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Ficha Tecnica',
                            'attribute' => 'ficha',
                            'value' => Html::a($model->ficha, ['/' . $model->ficha], ['target' => '_blank'])
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Hoja de Seguridad',
                            'attribute' => 'hoja',
                            'value' => Html::a($model->hoja, ['/' . $model->hoja], ['target' => '_blank'])
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Familia',
                            'value' => $divfamilia
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Proveedor',
                            'value' => $divProveedor
                        ],
                        [
                            'format' => 'raw',
                            'label' => 'Subcategoria',
                            'value' => $divSub
                        ]
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
