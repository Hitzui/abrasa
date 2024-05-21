<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Noticias;

$rows = Noticias::find()
    ->limit(10)
    ->all();
?>
<aside class="col-md-4 widget-area end-sidebar-lg bg-white" id="right-sidebar" style="position: relative;">

    <div class="" style="position: static; left: auto; width: 390px;">
        <aside id="search-2" class="widget widget_search">
            <form method="get" id="searchform" action="<?= Url::to(['noticias/search']) ?>" role="search">
                <label class="visually-hidden" for="s">Buscar</label>
                <div class="input-group">
                    <input class="field form-control" id="search" name="search" type="text" placeholder="Buscar …"
                           value=""/>
                    <span class="input-group-append">
                        <input class="submit btn btn-primary" type="submit" value="Buscar">
                    </span>
                </div>
            </form>
        </aside>
        <aside id="bootnews_custompost-2" class="widget widget_categories widget_categories_custom">
            <div class="block-title-13">
                <h4 class="h5 title-box-dot">
                    <span class="text-black">Noticias</span>
                </h4>
                <div class="dot-line"></div>
            </div>
            <!--style 1-->
            <div class="small-post">
                <!--post list-->
                <?php
                foreach ($rows as $noticia) {
                    /**@var $noticia Noticias */
                    ?>
                    <article class="card card-full hover-a mb-4">
                        <div class="row">
                            <div class="col-3 col-md-4 pe-2 pe-md-0">
                                <!--thumbnail-->
                                <div class="ratio_110-77 image-wrapper">
                                    <a href="<?= Url::to(['noticias/find', 'id' => $noticia->idnoticias]) ?>">
                                        <img width="110" height="77" src="<?= $noticia->imagen ?>"
                                             class="img-fluid lazy wp-post-image loaded"
                                             alt="Abrasa noticia" loading="lazy"
                                             data-src="<?= $noticia->imagen ?>"
                                             sizes="(max-width: 110px) 100vw, 110px"
                                             data-was-processed="true">
                                        <!-- post type -->
                                    </a>
                                </div>
                            </div>
                            <div class="col-9 col-md-8">
                                <div class="card-body pt-0">
                                    <!--title-->
                                    <h3 class="card-title h6 h5-sm h6-md">
                                        <a href="<?= Url::to(['noticias/find', 'id' => $noticia->idnoticias]) ?>"><?= $noticia->titulo ?></a>
                                    </h3>
                                    <!--date-->
                                    <div class="card-text small text-muted">
                                        <time class="news-date" datetime="<?= $noticia->fecha ?>">
                                            <?= $noticia->fecha ?>
                                        </time>
                                    </div>
                                    <a href="<?= Url::to(['noticias/find', 'id' => $noticia->idnoticias]) ?>">Ver
                                        más</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!--End post list-->
                <?php } ?>
            </div>
            <div class="gap-0"></div>
        </aside>
    </div>
</aside>