<?php
/* @var $this yii\web\View */
/* @var $categoria Catnoticias */

/* @var $categoriart array */

use app\models\Catnoticias;
use app\models\Noticias;
use app\models\Subcatnoticias;
use app\models\Subnoticias;
use yii\base\InvalidConfigException;
use yii\bootstrap5\BootstrapAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = ['label' => 'Categoria Noticias', 'url' => ['noticias/index']];
$this->params['breadcrumbs'][] = 'Noticias';
try {
    $this->registerCssFile(Url::base(true) . '/assets/css/noticias.css');
    $this->registerCssFile('https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/vendor/bootstrap/js/bootstrap.bundle.js');
    $this->registerJsFile('https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', ['position' => View::POS_END]);
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
    $js = <<<JS
  document.addEventListener( 'DOMContentLoaded', function () {
    new Splide( '#image-carousel',{
        type       : 'loop',
        padding    : '5rem',
        perPage    : 2,
		breakpoints: {
			640: {
				perPage: 1,
			},
		},
		video: {
            loop         : true,
            mute         : true
          }
    } ).mount()
  } );
JS;
    $this->registerJs($js, View::POS_END);

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

} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>
<div id="heading-breadcrumbs">
    <div class="container-fluid">
        <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
                <?php
                if (count($subcategoria) > 0) {
                    ?>
                    <h3 style="font-family: 'Lora','sans-serif'">Categoria de
                        noticias: <?= $categoria->descripcion ?></h3>
                    <?php
                } else {
                    ?>
                    <h3 style="font-family: 'Lora','sans-serif'">Sección: <?= $categoria->descripcion ?></h3>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-5">
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Yii::t('yii', 'Inicio'),
                        'url' => Yii::$app->homeUrl,
                    ],
                    'links' => $this->params['breadcrumbs'] ?? [],
                ]) ?>
            </div>
        </div>
    </div>
</div>
<div class="">
    <?php
    if (count($subcategoria) > 0) {
        ?>
        <p>&nbsp;</p>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="block-area">
                        <div class="block-title-13">
                            <h4 class="h5 title-box-dot">
                                <span class="text-black">Ultimos Eventos</span>
                            </h4>
                            <div class="dot-line"></div>
                        </div>
                        <?php
                        foreach ($subcategoria as $item) {
                            /* @var $item Subnoticias */
                            ?>
                            <div class="center-block">
                                <h2 class="card-title text-center"> <?= $item->nombre ?></h2>
                            </div>
                            <?php
                            $subcatnoticias = Subcatnoticias::find()
                                ->where(['idsubcategoria' => $item->idsubnoticias])
                                ->select('idnoticia');
                            $noticias = Noticias::find()->where(['in', 'idnoticias', $subcatnoticias])->all();
                            if (count($noticias) > 0) {
                                include('index-2.php');
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                include('_aside.php')
                ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="block-area">
                        <div class="block-title-13">
                            <h4 class="h5 title-box-dot">
                                <span class="text-black">Ultimos Eventos</span>
                            </h4>
                            <div class="dot-line"></div>
                        </div>
                        <?php include('index-2.php'); ?>
                    </div>
                </div>
                <?php include('_aside.php'); ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
