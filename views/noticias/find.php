<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $noticia app\models\Noticias */
/* @var $imagenes array */
/* @var $imagen app\models\Imagenes */
$this->title = 'ABRASA - EVENTOS';

$this->registerCssFile('/assets/css/noticias.css');
$css = <<<CSS
.contenedor-responsivo {
    position: relative;
    overflow: hidden;
    padding-top: 56.25%;
}
.mi-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

CSS;
$this->registerCss($css);
function isYouTubeUrl($url)
{
    $patterns = [
        '/youtube\.com\/\?v=[^&]+/',  // URLs de YouTube estándar
        '/youtu\.be\/[^?]+/'              // URLs cortas de YouTube
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url)) {
            return true;
        }
    }
    return false;
}

function getUrlType($url)
{
    // Comprobar si es un video de YouTube
    if (isYouTubeUrl($url)) {
        return 'YouTube';
    }

    // Obtener la extensión del archivo
    $path = parse_url($url, PHP_URL_PATH);
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    // Comprobar si es un archivo MP4
    if ($extension === 'mp4') {
        return 'Video';
    }

    // Comprobar si es una imagen
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
    if (in_array($extension, $imageExtensions)) {
        return 'Imagen';
    }

    // Obtener los headers del contenido para verificar el tipo MIME
    $headers = get_headers($url, 1);
    if (isset($headers['Content-Type'])) {
        $contentType = is_array($headers['Content-Type']) ? $headers['Content-Type'][0] : $headers['Content-Type'];
        if (strpos($contentType, 'image/') === 0) {
            return 'Imagen';
        } elseif (strpos($contentType, 'video/') === 0) {
            return 'Video';
        }
    }

    return 'Unknown';
}

?>
<p>&nbsp;</p>
<div class="container">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= Url::to(['index']) ?>">Noticias</a></li>
                <li class="breadcrumb-item active"
                    aria-current="<?= Url::to(['noticias']) ?>"><?= $noticia->fecha ?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <article
                    class="post-66 post type-post status-publish format-standard has-post-thumbnail hentry category-fashion category-music tag-fashion tag-style"
                    id="<?= $noticia->idnoticias ?>">

                <header class="entry-header post-title">
                    <h1 class="entry-title display-4 display-2-lg mt-2"><?= Html::decode($noticia->titulo) ?></h1>
                </header><!-- .entry-header -->
                <div class="entry-content post-content">
                    <figure class="image-single-wrapper">
                        <div id="carouselImagenes" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                foreach ($imagenes as $i => $imagen) { ?>
                                    <li data-target="#carouselImagenes" data-slide-to="<?= $i ?>"></li>
                                    <?php
                                }
                                ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                                foreach ($imagenes as $k => $imagen) {
                                    $path = "";
                                    if (strlen($imagen->ruta) === 0) {
                                        $path = Url::base(true) . '/assets/img/logo.png';
                                    } else {
                                        $path = $imagen->ruta;
                                    }
                                    $extension = getUrlType($path);
                                    ?>
                                    <div class="carousel-item <?php echo ($k == 0) ? 'active' : '' ?>">
                                        <?php
                                        if ($extension == 'Video') { ?>
                                            <video width="100%" height="500px" autoplay muted loop
                                                   style="width: 100%; height: auto">
                                                <source src="<?= $path ?>" type="video/mp4" controls="false">
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php } else if ($extension == 'Imagen') { ?>
                                            <img src="<?= $path ?>" alt="Noticias ABRASA"/>
                                        <?php } else { ?>
                                            <div class="contenedor-responsivo">
                                                <iframe class="mi-iframe"
                                                        src="<?= $path ?>"
                                                        title="Videos de Abrasa Nicaragua" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                        referrerpolicy="strict-origin-when-cross-origin"
                                                        allowfullscreen></iframe>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselImagenes" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselImagenes" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>


                        <figcaption class="bg-themes">ABRASA</figcaption>
                    </figure>
                    <div class="text-justify">
                        <?= $noticia->contenido_gr ?>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->
            <hr/>
            <!--social share-->

            <div class="social-share mb-3">
                <!-- share via email -->
                <a class="btn btn-light btn-sm"
                   href="mailto:?subject=Noticias&nbsp;Abrasa&amp;body=Lea&nbsp;el&nbsp;articulo&nbsp;completo&nbsp;aqui&nbsp;http://abrasa.com.ni<?= Url::to(['noticias/find', 'id' => $noticia->idnoticias]) ?>"
                   target="_blank" rel="noopener" title="Compartir por Email">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"></path>
                    </svg>
                    <span class="d-none d-sm-inline text-primary">Compartir por Email</span>
                </a>
            </div>
            <hr>

        </div>
        <?php include('_aside.php') ?>
    </div>
</div>