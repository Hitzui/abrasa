<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Slide */

$this->title = 'Imagen ' . $model->idslide;
$this->params['breadcrumbs'][] = ['label' => '/Slides/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="slide-view">
                <p>
                    <?= Html::a('Actualizar', ['update', 'id' => $model->idslide], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->idslide], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Seguro desea eliminar la imagen seleccionada? Esta acción no se puede revertir',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?php try {
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'idslide',
                            'titulo',
                            'descripcion',
                            'ruta',
                        ],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                } ?>

            </div>

        </div>
    </div>
</div>