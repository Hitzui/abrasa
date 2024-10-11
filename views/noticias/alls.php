<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = '/' . $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="noticias-index col-md-12">

            <p>
                <?= Html::a('Crear Noticia', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php
            if ( Yii::$app->session->hasFlash('error') ) {
                echo Yii::$app->session->getFlash('error');
            }
            try {
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'format' => 'raw',
                            'attribute' => 'titulo'
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'contenido_pe'
                        ],
                        'contenido_gr:ntext',
                        'imagen',
                        [
                            'format' => 'raw',
                            'label' => 'Imagen',
                            'attribute' => 'imagen',
                            'value' => function ($data) {
                                $img = $data->imagen;
                                if (strlen($img) < 3) {
                                    $img = Url::base(true).'/uploads/logo.png';
                                }
                                return Html::img( $img, ['style' => 'max-width:35%', 'alt' => 'Abrasa']);
                            },
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
            } catch (Throwable $e) {
                echo $e->getMessage();
            } ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
