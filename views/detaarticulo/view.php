<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Detaarticulo */

$this->title = $model->idsubcategoria;
$this->params['breadcrumbs'][] = ['label' => '/ Detaarticulos /', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<div class="detaarticulo-view">

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Update', ['update', 'idsubcategoria' => $model->idsubcategoria, 'idarticulo' => $model->idarticulo], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'idsubcategoria' => $model->idsubcategoria, 'idarticulo' => $model->idarticulo], [
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
        'idarticulo',
    ],
]) ?>

</div>
        </div>
    </div>
</div>