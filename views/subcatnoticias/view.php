<?php


/* @var $this yii\web\View */

/* @var $model app\models\Subcatnoticias */

use kartik\detail\DetailView;
use yii\helpers\Html;

$this->title = 'Sub: ' . $model->idsubcategoria;
$this->params['breadcrumbs'][] = ['label' => '/Subcat-noticias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <p>
        <?= Html::a('Actualizar', ['update', 'idsubcategoria' => $model->idsubcategoria, 'idnoticia' => $model->idnoticia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'idsubcategoria' => $model->idsubcategoria, 'idnoticia' => $model->idnoticia], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idsubcategoria',
            [
                'format' => 'raw',
                'label'=>'SubCategoria noticia',
                'value' => Html::a($model->subcategoria->nombre, ['subnoticias/view', 'id' => $model->subcategoria->idsubnoticias])
            ],
            'idnoticia',
            [
                'format' => 'raw',
                'label'=>'Noticia',
                'value' => Html::a($model->noticia->titulo, ['noticias/view', 'id' => $model->noticia->idnoticias])
            ],
        ],
    ]) ?>

</div>
