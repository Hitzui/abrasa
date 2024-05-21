<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use app\models\Presentacion;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresentacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presentaciones';
$this->params['breadcrumbs'][] = '/'.$this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Presentacion de producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'idpresentacion',
                'idarticulo',
                [
                    'format' => 'raw',
                    'attribute' => 'item',
                    'label' => 'Articulo',
                    'value' => function ($data) {
                        /** @var $data Presentacion */
                        return Html::a($data->articulo->descripcion, ['articulo/view', 'id' => $data->idarticulo]);
                    }
                ],
                'ruta',
                [
                    'format' => 'raw',
                    'attribute' => 'ruta',
                    'value' => function ($data) {
                        /** @var $data Presentacion */
                        return Html::img($data->ruta, ['style' => 'height:125px','alt'=>'Abrasa']);
                    }
                ],
                'descripcion:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    } catch (Throwable $e) {
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    } ?>

    <?php Pjax::end(); ?>

</div>
