<?php

use app\models\Categoria;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategoria */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => '/ Subcategorias /', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="subcategoria-view">

                <p>
                    <?= Html::a('Actualizar', ['update', 'id' => $model->idsubcategoria], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->idsubcategoria], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Seguro desea elminar la subcategoria seleccionada? Esta acción no se puede revertir',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'idsubcategoria',
                        'idcategoria',
                        [
                            'format' => 'raw',
                            'attribute' => 'idcategoria',
                            'label'=>'Categoria:',
                            'value' => function ($data) {
                                $cat = Categoria::findOne($data->idcategoria);
                                return Html::a($cat->nombre, ['categoria/view', 'id' => $cat->idcategoria]);
                            }
                        ],
                        'nombre',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
