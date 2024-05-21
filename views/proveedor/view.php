<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = $model->idproveedor;
$this->params['breadcrumbs'][] = ['label' => '/ Proveedors /', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="proveedor-view">
                <p>
                    <?= Html::a('Actualizar', ['update', 'id' => $model->idproveedor], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->idproveedor], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Seguro desea eliminar el proveedor? Esta acción no se puede revertir',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'idproveedor',
                        'nombre',
                        'orden',
                        //'imagen',
						[
                            'attribute'=>'imagen',
                            'value'=>('/'.$model->imagen),
                            'format' => ['image',['width'=>'230','height'=>'200']],
                        ],
                    ],
                ]) ?>

            </div>

        </div>
    </div>
</div>