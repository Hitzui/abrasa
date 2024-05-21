<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = "Categoria " . $model->idcategoria;
$this->params['breadcrumbs'][] = ['label' => '/Categorias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="categoria-view">
                <p>
                    <?= Html::a('Actualizar', ['update', 'id' => $model->idcategoria], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Eliminar', ['delete', 'id' => $model->idcategoria], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Esta seguro que desea eliminar la categoria seleccionada?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?php try {
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'idcategoria',
                            'nombre',
                            'imagen',
                            [
                                'format' => 'raw',
                                'attribute' => 'imagen',
                                'value' => Html::img('/' . $model->imagen,["style"=>"background-color:".$model->color])
                            ],
                            'color',
                            'posicion'
                        ],
                    ]);
                } catch (Exception $e) {
                    echo '<div class="alert-danger">' . $e->getMessage() . '</div>';
                } ?>

            </div>
        </div>
    </div>
</div>
