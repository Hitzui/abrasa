<?php

use app\models\Articulo;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var Articulo $model */

?>
<div class="container-fluid" id="articulos">
    <!-- grid -->
    <div class="row justify-content-center">
        <?php
        foreach ($model as $articulo) {
            if (empty($articulo->rutaimg) || strlen($articulo->rutaimg) <= 5) {
                $articulo->rutaimg = 'uploads/logo.png';
            }
            ?>
            <!-- Grid item -->
            <div class="col-md-4">
                <div class="min_producto_2 rounded shadow border border-success">
                    <div class="nombre_producto text-center rounded shadow">
                        <?= $articulo->descripcion ?>
                    </div>
                    <a href="<?= Url::base(true) ?>/<?= $articulo->rutaimg ?>"
                       data-toggle="lightbox" data-caption="<?= $articulo->descripcion ?>"
                       data-gallery="articulo-gallery"
                       style="display: flex; justify-content: center;align-items: center;margin-top:20px;height: 350px">
                        <div>
                            <img class="img-fluid" src="/<?= $articulo->rutaimg ?>" alt="<?= $articulo->descripcion ?>" style="max-height: 350px"/>
                        </div>
                    </a>
                    <div style="text-align: right;overflow: hidden;padding:5px">
                        <a href="<?= Url::to(["producto/view", 'idarticulo' => $articulo->idarticulo]) ?>">
                            <div class="btn_ver_producto">
                                <?php
                                if (strlen($articulo->ficha) >= 4) {
                                    ?>
                                    <span>ver ficha</span>
                                    <?php
                                } else {
                                    ?>
                                    <span>ver más...</span>
                                    <?php
                                }
                                ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <?php
            /** @var Pagination $pagination */
            // display pagination
            ?>
            <nav aria-label="Page navigation">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'linkOptions' => ['class' => 'page-link'],
                    'disabledPageCssClass' => 'disabled',
                    /*'firstPageCssClass'=>'page-item',
                    'prevPageCssClass'=>'page-item',
                    'nextPageCssClass'=>'page-item',
                    'lastPageCssClass'=>'page-item',*/
                    'activePageCssClass' => 'active',
                    'pageCssClass' => 'page-item'
                ]) ?>
            </nav>
        </div>
    </div>
</div>