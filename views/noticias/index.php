<?php

use app\models\Catnoticias;
use yii\base\InvalidConfigException;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'ABRASA - BLOG';

try {
    $this->registerCssFile(Url::base(true) . '/assets/css/noticias.css');
    $this->registerJsFile(Url::base(true) . '/assets/js/lodash.min.js');
    $this->registerJsFile(Url::base(true) . '/assets/vendor/bootstrap/js/bootstrap.bundle.js');
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
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
<div class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 content">
                <div class="block-area text-center">
                    <div class="block-title-1 animate__animated animate__bounce">
                        <h1>
                            Explora nuestro Blog
                        </h1>
                        <div class="dot-line">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <?php
                            foreach ($categorias as $k => $cat) {
                                /* @var $cat Catnoticias */
                                ?>
                                <div class="col-md-3 col-sm-6 card">
                                    <div class="meet-farmers-one__single animate__animated animate__fadeInDown">
                                        <div class="meet-farmers-one__single-img">
                                            <img src="<?= $cat->imagen ?>" alt="Abrasa" />
                                        </div>
                                        <div class="meet-farmers-one__single-title text-center">
                                            <p>ABRASA</p>
                                            <h2>
                                                <a href="<?=Url::to(['noticias/categoria', 'id' => $cat->idcatnoticias],true)?>">
                                                    <?= $cat->descripcion ?>
                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('_aside.php') ?>
        </div>
    </div>
</div>