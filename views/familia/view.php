<?php


/* @var $this yii\web\View */

/* @var $model app\models\Familia */

use app\models\Categoria;
use app\models\Familia;
use kartik\detail\DetailView;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;

$this->title = 'Familia: ' . $model->idfamilia;
$this->params['breadcrumbs'][] = ['label' => '/Familias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ID-' . $this->title;

?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="familia-view">

                <div>
                    <?= Html::a('Actualizar', ['update', 'id' => $model->idfamilia], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->idfamilia], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Esta seguro de eliminar la familia? Esta acción no se puede revertir.',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idfamilia',
                    'nombre:ntext',
                    'idcategoria',
                    [
                        'format' => 'raw',
                        'label' => 'Categoria',
                        'value' => Html::a($model->categoria->nombre, ['categoria/view', 'id' => $model->categoria->idcategoria])
                    ]
                ],
            ]) ?>


        </div>
    </div>
</div>
