<?php

/* @var $this yii\web\View */

use app\models\Articulo;
use app\models\Categoria;
use app\models\Noticias;
use app\models\Slide;
use yii\base\InvalidConfigException;
use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

$this->title = 'Agropecuaria Bravo, S.A. - ABRASA';
/** @var Articulo $model */
/** @var Categoria $categorias */
/** @var Slide $slide */
$css = <<<CSS
.video-container {
            /*position: relative;
            padding-bottom: 56.25%;*/ /* 16:9 ratio */
            height: 750px;
            overflow: hidden;
            max-width: 100%;
            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
.efecto img {
  --s: 15px;  /* size of the frame */
  --b: 2px;   /* border thickness */
  --w: 200px; /* width of the image */
  --c: #7B3B3B;
  
  width: var(--w);
  aspect-ratio: 1;
  object-fit: cover;
  padding: calc(2*var(--s));
  --_g: var(--c) var(--b),#0000 0 calc(100% - var(--b)),var(--c) 0;
  background:
    linear-gradient(      var(--_g)) 50%/100% var(--_i,100%) no-repeat,
    linear-gradient(90deg,var(--_g)) 50%/var(--_i,100%) 100% no-repeat;
  outline: calc(var(--w)/2) solid #0009;
  outline-offset: calc(var(--w)/-2 - 2*var(--s));
  transition: .4s;
  cursor: pointer;
}
.efecto img:hover {
  outline: var(--b) solid var(--c);
  outline-offset: calc(var(--s)/-2);
  --_i: calc(100% - 2*var(--s));
}
.sec-title {
  font-size: 50px;
  line-height: 1em;
  font-weight: 700;
  text-transform: none;
  letter-spacing: -0.04em;
}
.splide__slide img {
  width: 100%;
  max-height: 750px;
  object-fit: cover;
}
@media screen and (max-width: 767px){   
    #main-img{      
        height:150px;
    } 
    .video-y{
    height: 350px;
    }
}

@media screen and (min-width: 768px) {      
    #main-img{      
       height:250px;
     } 
     .video-y{
    height: 600px;
    }
} 
@media (min-width: 992px){      
      #main-img{        
          height:300px; 
      } 
      .video-y{
    height: 750px;
    }
}
@media (min-width: 1200px) {    
     #main-img{         
        height:380px;
     } 
     .video-y{
    height: 750px;
    }
}
#loading {
    position: fixed;    
    width: 100%;
    height: 100vh;        
    z-index: 100;
}
.jumbotron{background-color:transparent !important;}
.title_home_productos {
    background-color: #F59D00;
    color: white;
    text-transform: uppercase;
    font-size: 24px;
    padding: 20px;
    margin-top: 30px;
    margin-bottom: 25px;
}
.swiper-pagination{
    position:inherit;
}
.swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
/*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/

.video-background-holder {
  position: relative;
  background-color: black;
  height: calc(100vh - 72px);
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
}

.video-background-holder video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

.video-background-content {
  position: relative;
  z-index: 2;
}

.video-background-overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.5;
  z-index: 1;
}
CSS;
$js = <<<JS
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 0,    
    loop: true,
    loopFillGroupWithBlank: false,
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 0,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 0,
        },
    },
    autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    }
  });
  
/*  new Splide( '.splide', {
      type     : 'loop',
      autoplay: 'pause',
      video: {
        loop         : true
      }
    });*/
  var splide=new Splide( ".splide", {
      type     : 'loop',
      autoplay: true,
      perPage    : 3,
      breakpoints: {
			640: {
				perPage: 2,
			},
		},
    } ).mount( window.splide.Extensions );
splide.on( 'active', function(e) {  
    const element = document.querySelectorAll('.title');
    element[e.index].classList.add('animate__animated', 'animate__fadeInRight');
});

splide.on( 'inactive', function(e) {    
    const element = document.querySelectorAll('.title');
    element[e.index].classList.remove('animate__animated', 'animate__fadeInRight');  
});
JS;

$this->registerCss($css);
$this->registerJs($js, View::POS_END);
try {

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

    $this->registerCssFile(Url::base(true) . '/assets/css/mdb.min.css', ['depends' => [BootstrapAsset::class]]);
    //$this->registerCssFile(Url::base(true) . '/assets/css/agriox.css', ['depends' => [BootstrapAsset::class]]);
    $this->registerCssFile(Url::base(true) . '/assets/css/splide.min.css', ['depends' => [JqueryAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/js/splide.js', ['depends' => [BootstrapAsset::class]]);
    $this->registerCssFile('https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-video@0.8.0/dist/css/splide-extension-video.min.css', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/admin/vendor/bootstrap/js/bootstrap.bundle.js', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/js/mdb.min.js', ['depends' => [BootstrapAsset::class]]);
    //$this->registerJsFile(Url::base(true) . '/assets/js/agriox.js', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile('https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-video@0.8.0/dist/js/splide-extension-video.min.js', ['depends' => [JqueryAsset::class]]);
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>

<!-- Carousel wrapper -->
<div style="max-height: 750px" id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel"
     data-mdb-carousel-init>
    <!-- Indicators -->
    <div class="carousel-indicators">
        <?php
        foreach ($slide as $i => $item):
            /* @var $item Slide */
            ?>
            <button
                    type="button"
                    data-mdb-target="#carouselBasicExample"
                    data-mdb-slide-to="<?= $i ?>"
                    class="<?= ($i === 0) ? 'active' : '' ?>"
                    aria-current="true"
                    aria-label="Slide <?= $i ?>"
            ></button>
        <?php
        endforeach;
        ?>
    </div>

    <!-- Inner -->
    <div class="carousel-inner">
        <?php
        foreach ($slide as $i => $item):
            /* @var $item Slide */
            $info = new SplFileInfo($item->ruta);
            ?>
            <!-- Single item -->
            <div class="carousel-item <?= ($i === 0) ? 'active' : '' ?>">
                <?php
                if ($item->video) {
                    if (strcmp($info->getExtension(), 'mp4') == 0) { ?>
                        <div class="" style="max-height: 720px">
                            <video style="
                                    height: auto;
                                    width: 100%;
                                    margin: 0 auto;
                                    background: url(<?= Url::base(true) ?>/assets/images/backgrounds/video-one-bg.jpg) no-repeat;
                                    background-size: cover;
                                    overflow: hidden;" autoplay loop muted>
                                <source class="h-100" src="<?= $item->ruta ?>" type="video/mp4"/>
                            </video>
                        </div>
                        <?php
                    } else if (strpos($item->ruta, 'http') !== false) {
                        echo '<div class="video-container">';
                        echo '<iframe src="' . $item->ruta . '?autoplay=1&mute=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        echo '</div>';
                    }
                } else {
                    ?>
                    <img src="<?= $item->ruta ?>" class="d-block w-100"
                         alt="<?= $item->titulo ?>"/>
                    <?php
                }
                ?>
                <div class="carousel-caption d-none d-md-block">
                    <h1 style="color: white"><b><?= $item->titulo ?></b></h1>
                    <p><?= $item->descripcion ?></p>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
    <!-- Inner -->

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!--Inicio Categoria-->
<section class="bar">
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="heading text-center">
                    <h2>Categor&iacute;a de productos</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            foreach ($categorias as $key => $categoria) {
                ?>
                <div class="col-md col-sm-12">
                    <div class="box-simple animate__animated animate__bounce" data-aos="fade-right">
                        <div class="hover hover-3 text-white rounded"
                             style="background-color: <?= $categoria->color ?>">
                            <img src="/<?= $categoria->imagen ?>" alt="<?= $categoria->nombre ?>" class="img-fluid"/>
                            <div class="hover-overlay"></div>
                            <div class="hover-3-content px-5 py-4 text-center">
                                <h4 class="hover-3-title font-weight-bold mb-1">
                                    <a href="<?= Url::to(['producto/categoria', 'id' => $categoria->idcategoria]) ?>"
                                       class="text-white" style="margin-left: -10px">
                                        <?= $categoria->nombre ?>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($key == 4) {
                    echo '</div><div class="row justify-content-center">';
                }
            } ?>
        </div>
    </div>
</section>
<!--Fin Categoria-->
<!--Inicio Proveedores-->
<section class="bar no-mb" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading text-center">
                    <h2>Nuestros Proveedores</h2>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <ol class="list-unstyled owl-carousel customers">
                    <?php /** @var \app\models\Proveedor $proveedores */
                    foreach ($proveedores as $proveedor) {
                        if (!empty($proveedor->imagen)) {
                            ?>
                            <li class="item centro-abs">
                                <a href="<?= Url::to(['producto/proveedor', 'id' => $proveedor->idproveedor]) ?>">
                                    <img src="/<?= $proveedor->imagen ?>" alt="<?= $proveedor->nombre ?>">
                                </a>
                            </li>
                            <?php
                        }
                    } ?>
                </ol>
            </div>
        </div>
        <div class="row text-center">
            <div class="col">
                <a href="<?= Url::to(['about/proveedores']) ?>" class="btn color-white btn-template-outlined bg-info">
                    <em class="fas fa-address-book"></em> Ver Todos los Proveedores
                </a>
            </div>
        </div>
    </div>
</section>
<!--Fin Proveedores-->
<!--Inicio Productos-->
<section
        class="bar no-mb text-center bg-fixed relative-positioned animate animate__fadeInLeft"
        data-aos="fade-up">
    <div class="cuadro_superior_productos_home">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="heading text-center">
                        <h2>Productos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="services-one services-one--has-top-bg">
    <div class="container-flex ">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                foreach ($articulos as $articulo) {
                    /* @var $articulo Articulo */
                    if (empty($articulo->rutaimg) || strlen($articulo->rutaimg) <= 5) {
                        $articulo->rutaimg = Url::home(true) . 'uploads/logo.png';
                    }
                    ?>
                    <div class="swiper-slide">
                        <div class="min_producto_2 rounded shadow" style="background-color: white">
                            <div class="nombre_producto text-center rounded shadow" style="min-height: 50px">
                                <span><?= $articulo->descripcion ?></span>
                            </div>
                            <div class="imagen_producto">
                                <img src="<?= $articulo->rutaimg ?>" alt="Abrasa" style="object-fit: contain" />
                            </div>
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
                    <?php
                }
                ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="row text-center">
            <div class="col">
                <a href="<?= Url::to('producto/index') ?>" class="btn color-white btn-template-outlined bg-success">
                    <em class="fas fa-parachute-box"></em> Ver más productos
                </a>
            </div>
        </div>
    </div>
</section>
<!--Fin Productos-->
<!--Section de blog o noticias-->
<section class="blog-two">
    <div class="" style="max-width: 85%; margin:0 auto">
        <div class="row">
            <!--Start Blog Two Left-->
            <div class="col-3">
                <div class="blog-two__left">
                    <div class="blog-two__left-bg"></div>
                    <div class="sec-title">
                        <div class="icon">
                            <img src="https://abrasa.com.ni/assets/img/logo.png" height="120px" alt="">
                        </div>
                        <span class="sec-title__tagline">ABRASA</span>
                        <h2 class="sec-title__title">Últimas Noticias y Eventos</h2>
                    </div>
                    <p class="blog-two__left-text">Comprometidos con nuestros clientes,
                        <br>innovamos cada día en facilitar la labor, <br>innovando en tecnologia..</p>
                    <div>
                        <a class="thm-btn" href="<?= Url::to('noticias/index') ?>">
                            Vea nuestro Blog...
                        </a>
                    </div>
                    <div class="blog-two__carousel__custom-nav">
                        <a href="#" class="left-btn"><span class="fas fa-arrow-circle-right"></span></a>
                        <a href="#" class="right-btn"><span class="fas fa-arrow-circle-right"></span></a>
                    </div><!-- /.blog-two__carousel__custom-nav -->
                </div>
            </div>
            <!--End Blog Two Left-->

            <!--Start Blog Two Right-->
            <div class="col-9">
                <div class="blog-two__right">
                    <div class="blog-two__carousel owl-carousel owl-theme">
                        <!--Start Single Blog One-->
                        <?php
                        foreach ($noticias as $item) {
                            /* @var $item Noticias */
                            $path = "";
                            if (strlen($item->imagen) === 0) {
                                $path = Url::base(true) . '/assets/img/logo.png';
                            } else {
                                $path = $item->imagen;
                            }
                            $extension = getUrlType($path);
                            ?>
                            <div class="blog-one__single">
                                <div class="blog-one__single-img">
                                    <?php
                                    if ($extension == 'Video') { ?>
                                        <video width="100%" height="225px" autoplay muted loop
                                               style="width: 100%; height: auto">
                                            <source src="<?= $path ?>" type="video/mp4" controls="false">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php } else if ($extension == 'Imagen') { ?>
                                        <img src="<?= $path ?>" alt="Noticias ABRASA" style="height: 225px"/>
                                    <?php } else { ?>
                                        <div class="contenedor-responsivo">
                                            <iframe height="225px" width="100%"
                                                    src="<?= $path ?>"
                                                    title="Videos de Abrasa Nicaragua" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    referrerpolicy="strict-origin-when-cross-origin"
                                                    allowfullscreen></iframe>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="date-box">
                                        <span><?= $item->fecha ?></span>
                                    </div>
                                    <div class="overlay-icon">
                                        <a href="<?= Url::to(['noticias/find', 'id' => $item->idnoticias]) ?>">
                                            <span class="icon-eye"></span>.
                                        </a>
                                    </div>
                                </div>

                                <div class="blog-one__single-content">
                                    <ul class="meta-info">
                                        <li>
                                            <a href="#">
                                                <i class="far fa-user-circle"></i> Abrasa
                                            </a>
                                        </li>
                                    </ul>
                                    <h2><a href="<?= Url::to(['noticias/find', 'id' => $item->idnoticias]) ?>"
                                           style="display: -webkit-box;
                                            -webkit-line-clamp: 3;
                                            -webkit-box-orient: vertical;
                                            max-width: 300px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            height:65px;">
                                            <?= $item->titulo ?>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <!--End Single Blog One-->
                    </div>
                </div>
            </div>
            <!--End Blog Two Right-->
        </div>
    </div>
</section>
<!--Blog Two End-->