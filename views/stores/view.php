<?php

use kartik\detail\DetailView;
use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */

$this->title = 'Tienda-' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '/ Tiendas /', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿seguro desea eliminar la tienda? Esta acción no se puede revertir.',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'condensed' => true,
                'hover' => true,
                'attributes' => [
                    'id',
                    'storeName',
                    'phoneFormatted',
                    'address',
                    'city',
                    'postalCode',
                    'latitude',
                    'longitude',
                    'email:email',
                    'cobertura:ntext',
                    'ejecutivo',
                    [
                        'format' => 'raw',
                        'label' => 'Imagen',
                        'value' => \yii\bootstrap5\Html::img($model->imagen, ['style' => 'height:125px'])
                    ]
                ],
            ]) ?>
        </div>
    </div>
</div>
