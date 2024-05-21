<?php

/* @var $this yii\web\View */

/* @var $model app\models\Subnoticias */

use kartik\detail\DetailView;
use yii\bootstrap5\Html;

$this->title = 'Sub-noticia: ' . $model->idsubnoticias;
$this->params['breadcrumbs'][] = ['label' => '/Subnoticias/', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idsubnoticias], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idsubnoticias], [
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
            'idsubnoticias',
            'idcategoria',
            [
                'format' => 'raw',
                'label'=>'Categoria Noticia',
                'value' => Html::a($model->categoria->descripcion, ['catnoticias/view', 'id' => $model->categoria->idcatnoticias])
            ],
            'nombre:ntext',
            'imagen:ntext',
            [
                'format' => 'raw',
                'attribute'=>'imagen',
                'value' => Html::img($model->imagen,['alt'=>'Abrasa','width'=>125])
            ],
        ],
    ]) ?>

</div>
