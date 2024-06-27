<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $noticias array */


?>


<!--Inicio Carousel de noticias-->
<section id="image-carousel" class="splide" aria-label="Noticias sobre abrasa">
    <div class="splide__track">
        <ul class="splide__list">
            <?php
            if (count($noticias) > 0) {
                foreach ($noticias as $noticia) {
                    /* @var $noticia app\models\Noticias */
                    $imagen = "";
                    if (strlen($noticia->imagen) === 0) {
                        $imagen = Url::base(true) . '/assets/img/logo.png';
                    } else {
                        $imagen = $noticia->imagen;
                    }
                    $extension = getUrlType($imagen);
                    echo '<li class="splide__slide" style="margin:25px">';
                    if ($extension == 'Video') { ?>
                        <video width="100%" height="500px" autoplay muted loop
                               style="width: 100%; height: auto">
                            <source src="<?= $imagen ?>" type="video/mp4" controls="false">
                            Your browser does not support the video tag.
                        </video>
                    <?php } else if ($extension == 'Imagen') {?>
                        <img src="<?=$imagen?>" alt="Noticias ABRASA" />
                    <?php } else { ?>
                        <div class="contenedor-responsivo">
                            <iframe class="mi-iframe"
                                    src="<?= $imagen ?>"
                                    title="Videos de Abrasa Nicaragua" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen></iframe>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="mx-4 mt-minus position-relative bg-themes p-3 p-lg-5 rounded border-bottom shadow-lrb-lg">
                        <!--post title-->
                        <h4 class="h2 h1-md display-4-lg">
                            <a href="<?= Url::to(['noticias/find', 'id' => $noticia->idnoticias]) ?>">
                                <?= $noticia->titulo ?>
                            </a>
                        </h4>
                        <!--post date-->
                        <div class="text-muted small mb-2">
                            <!--author-->
                            <span class="fw-bold d-none d-sm-inline me-1">
								                        <a href="http://www.abrasa.com.ni/" title="Posts by ABRASA"
                                                           rel="author">ABRASA</a>
                                                </span>
                            <time class="news-date"
                                  datetime="<?= $noticia->fecha ?>"><?= $noticia->fecha ?></time>
                        </div>
                        <!--description-->
                        <p class="card-text"><?= $noticia->contenido_pe ?></p>
                        <a href="<?= Url::to(['noticias/find', 'id' => $noticia->idnoticias]) ?>">Ver
                            más</a>
                    </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</section>
<!--Final Carousel de noticias-->

