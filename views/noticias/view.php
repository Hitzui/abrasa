<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'Noticia ' . $model->idnoticias;
$this->params['breadcrumbs'][] = ['label' => '/ Noticias /', 'url' => ['alls']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
$css = <<<CSS
img{
width: 40%;
display: block;
}
CSS;

$this->registerCss($css);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="noticias-view">

                <p>
                    <?= Html::a('Actualizar', ['update', 'id' => $model->idnoticias], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->idnoticias], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿seguro desea elminar la noticia seleccionada? Esta acción no se puede revertir',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'idnoticias',
                        [
                            'format' => 'raw',
                            'attribute' => 'titulo'
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'contenido_pe'
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'contenido_gr'
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'imagen',
                            'label'=>'Imagen de presentación:',
                            'value' => function ($data) {
                                return Html::img($data->imagen, ['width' => '50%']);
                            }
                        ],
                        [
                                'attribute'=>'imagen',
                            'label'=>'Ruta de la imagen:'
                        ],
                        'fecha',
                        //'idcategoria',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>