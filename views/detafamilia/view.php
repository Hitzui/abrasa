<?php


/* @var $this yii\web\View */

/* @var $model app\models\Detafamilia */

use kartik\detail\DetailView;
use yii\bootstrap5\Html;
use yii\web\YiiAsset;

$this->title = 'DetaFamilia Id: '.$model->idfamilia;
$this->params['breadcrumbs'][] = ['label' => '/Detafamilias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
$familia = $model->getFamilia()->where($model->idfamilia)->one();
$sub = $model->getSubcategoria()->where($model->idsubcategoria)->one();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="detafamilia-view">

                <p>
                    <?= Html::a('Actualizar', ['update', 'idfamilia' => $model->idfamilia, 'idsubcategoria' => $model->idsubcategoria], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'idfamilia' => $model->idfamilia, 'idsubcategoria' => $model->idsubcategoria], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿seguro desea eliminar el valor seleccionado?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'idfamilia',
                        'idsubcategoria',
                        [
                            'format' => 'raw',
                            'label'=>'Familia:',
                            'value'=>Html::a($familia->nombre,['familia/view','id'=>$model->idfamilia])
                        ],
                        [
                            'format' => 'raw',
                            'label'=>'Sub-categoria:',
                            'value'=>Html::a($sub->nombre,['subcategoria/view','id'=>$model->idsubcategoria])
                        ]
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
