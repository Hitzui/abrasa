<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

$this->title = 'ABRASA - EVENTOS';

$this->registerCssFile('/assets/css/noticias.css');
$this->registerJsFile('/assets/js/lodash.min.js');

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
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="block-area">
					<div class="block-title-13">
						<h4 class="h5 title-box-dot">
						<span class="text-black">Ultimos Eventos</span>
						</h4><div class="dot-line">
						</div>
					</div>		
					<!--output-->           
					<?php
					foreach($noticias as $noticia){
					?>
					<article class="card card-full mb-5 mb-md-6 hover-a text-center" data-aos="fade-up">
						<!-- thumbnail -->
						<div class="ratio_single image-wrapper">
							<a href="<?= Url::to(['noticias/find','id'=>$noticia->idnoticias])?>">
								<img width="1100" src="/<?= $noticia->imagen?>" sizes="(max-width: 1500px) 100vw, 1500px" data-was-processed="true">							
							</a>
						</div>
						<div class="mx-4 mt-minus position-relative bg-themes p-3 p-lg-5 rounded border-bottom shadow-lrb-lg">
							<!--post title-->
							<h4 class="h2 h1-md display-4-lg">
								<a href="<?= Url::to(['noticias/find','id'=>$noticia->idnoticias])?>">
									<?= $noticia->titulo?>
								</a>
							</h4>
							<!--post date-->
							<div class="text-muted small mb-2">
							<!--author-->
							<span class="fw-bold d-none d-sm-inline me-1">
								<a href="http://www.abrasa.com.ni/" title="Posts by ABRASA" rel="author">ABRASA</a>			
							</span>
							<time class="news-date" datetime="<?= $noticia->fecha?>"><?= $noticia->fecha?></time>
						</div>
						<!--description-->
						<p class="card-text"><?= $noticia->contenido_pe?></p>
							<a href="<?= Url::to(['noticias/find','id'=>$noticia->idnoticias])?>">Ver más</a>
					</div>
				</article>					            	            								
			<?php } ?>			            	                                            
				</div>
			</div>
		<?php include('_aside.php') ?>
		</div>
	</div>
</div>