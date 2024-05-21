<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubnoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub-categoria noticias';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container">

    <p>
        <?= Html::a('Crear Sub-categoria noticias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'idsubnoticias',
                'idcategoria',
                [
                    'format' => 'raw',
                    'attribute' => 'categoria',
                    'value' => function ($data) {
                        return Html::a($data->categoria->descripcion, ['catnoticias/view', 'id' => $data->categoria->idcatnoticias]);
                    }
                ],
                'nombre:ntext',
                'imagen:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    } catch (Throwable $e) {
        echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
    } ?>

    <?php Pjax::end(); ?>

</div>
