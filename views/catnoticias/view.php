<?php /** @noinspection PhpMultipleClassDeclarationsInspection */


/* @var $this yii\web\View */

/* @var $model app\models\Catnoticias */

use kartik\detail\DetailView;
use yii\bootstrap5\Html;

$this->title = 'Categoria: ' . $model->idcatnoticias;
$this->params['breadcrumbs'][] = ['label' => '/Categoria de noticias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idcatnoticias], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idcatnoticias], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro desea eliminar el item seleccionado?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php try {
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idcatnoticias',
                'descripcion',
                'imagen:ntext',
                [
                    'format' => 'raw',
                    'attribute' => 'principal',
                    'value' => Html::checkbox('', $model->principal, ['disabled' => 'disabled'])
                ],
                [
                    'format' => 'raw',
                    'attribute' => 'imagen',
                    'value' => Html::img($model->imagen, ['alt' => $model->descripcion, 'width' => '200'])
                ]
            ],
        ]);
    } catch (Throwable $e) {
        echo '<div class="alert alert-danger">'.$e->getMessage().'</div>';
    } ?>

</div>
