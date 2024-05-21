<?php

/* @var $this yii\web\View */

use app\models\Articulo;
use app\models\Categoria;
use app\models\Slide;
use yii\base\InvalidConfigException;
use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

$this->title = 'Agropecuaria Bravo, S.A. - ABRASA';
/** @var Articulo $model */
/** @var Articulo $articulos */
/** @var Categoria $categorias */
/** @var Slide $slide */
$css = <<<CSS
.splide__slide img {
  width: 100%;
  height: 100%;
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
CSS;
$js = <<<JS
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 10,    
    loop: true,
    loopFillGroupWithBlank: false,
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 50,
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
      video: {
        loop         : true,
        mute         : true,
        autoplay     : true,
        volume:0.6
      }
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
    $this->registerCssFile(Url::base(true) . '/assets/css/mdb.min.css', ['depends' => [BootstrapAsset::class]]);
    $this->registerCssFile(Url::base(true) . '/assets/css/splide.min.css', [
        'depends' => [JqueryAsset::class],
    ]);

    $this->registerJsFile(
        Url::base(true) . '/assets/js/splide.js',
        ['depends' => [JqueryAsset::class]]
    );
    $this->registerCssFile('https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-video@0.8.0/dist/css/splide-extension-video.min.css', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/admin/vendor/bootstrap/js/bootstrap.bundle.js', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/js/mdb.min.js', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile('https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-video@0.8.0/dist/js/splide-extension-video.min.js', ['depends' => [JqueryAsset::class]]);
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>

<section
        style="background: url('/assets/img/carousel/AGROINSUMOS-1-2.jpg') center center repeat; background-size: cover;"
        class="relative-positioned">
    <div class="splide">
        <div class="splide__slider">
            <div class="splide__track">
                <ul class="splide__list" style="max-height: 720px">
                    <?php
                    foreach ($slide as $key => $value) {
                        $urlArchivo = $value->ruta;
                        $info = new SplFileInfo($urlArchivo);
                        if (strcmp($info->getExtension(), 'jpg') == 0 ||
                            strcmp($info->getExtension(), 'jpeg') == 0 ||
                            strcmp($info->getExtension(), 'png') == 0) {
                            ?>
                            <li class="splide__slide">
                                <div class="splide__slide__container">
                                    <img src="<?= $urlArchivo ?>" alt="<?= $value->titulo ?>">
                                </div>
                                <div class="carousel-caption d-none d-md-block">
                                    <h2 class="title"><?= $value->titulo?></h2>
                                    <p>
                                        <?= $value->descripcion?>
                                    </p>
                                </div>
                            </li>
                            <?php
                        } else if (strcmp($info->getExtension(), 'mp4') == 0) { ?>
                            <li class="splide__slide" data-splide-html-video="<?= $urlArchivo ?>">
                                <img src="/assets/img/carousel/AGROINSUMOS-1-2.jpg" alt="">
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="splide__slide" data-splide-youtube="<?= $urlArchivo ?>">
                                <img src="/assets/img/carousel/AGROINSUMOS-1-2.jpg" alt="">
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
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
<section style="background: url(/assets/img/FONDO-1-1.jpg) center top no-repeat; background-size: cover;"
         class="bar no-mb text-center bg-fixed relative-positioned animate animate__fadeInLeft" data-aos="fade-up">
    <div class="cuadro_superior_productos_home">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="heading text-center">
                        <h2>productos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                foreach ($articulos as $articulo) {
                    if (empty($articulo->rutaimg) || strlen($articulo->rutaimg) <= 5) {
                        $articulo->rutaimg = 'uploads/logo.png';
                    }
                    ?>
                    <div class="swiper-slide">
                        <div class="min_producto_2 rounded shadow">
                            <div class="nombre_producto text-center rounded shadow" style="min-height: 50px">
                                <span><?= $articulo->descripcion ?></span>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#modal-<?= $articulo->idarticulo ?>">
                                <div class="imagen_producto centro-abs" style="max-height: 250px;max-width: 250px">
                                    <img src="/<?= $articulo->rutaimg ?>" alt="Abrasa" class="img-fluid"/>
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