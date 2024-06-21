<?php

/* @var $this View */

/* @var $content string */

use app\assets\AppAsset;
use app\models\Categoria;
use app\models\Detafamilia;
use app\models\Familia;
use app\models\Subcategoria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
$remember = Url::remember();

$url = Url::to();
$urls = explode("/", $url);
if (strlen($urls[1]) <= 0) {
    $urls[1] = "site";
}
/*$this->registerJs("
  var element = document.getElementById('" . $urls[1] . "');
  element.classList.add('active');
", View::POS_READY);*/
$categorias = Categoria::find()->orderBy('nombre')->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
    <?php $this->head() ?>
    <style>
        .hover-underline-animation {
            display: inline-block;
            position: relative;
            color: #0087ca;
        }

        .hover-underline-animation:after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #0087ca;
            transform-origin: bottom right;
            transition: transform 0.5s ease-out;
        }

        .hover-underline-animation:hover:after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }

        .dropdown-submenu a::after {
            transform: rotate(-90deg);
            right: 3px;
            top: 40%;
        }

        .dropdown-submenu:hover .dropdown-menu,
        .dropdown-submenu:focus .dropdown-menu {
            display: block;
            margin-top: -1px;
            margin-left: -1px;
            top: 0;
            left: 100%;
            min-height: 100%;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 3px;
            border-left: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        ::-webkit-scrollbar-track {
            background: none;
        }

        ::-webkit-scrollbar-thumb {
            background: #519461;
            border-radius: 0;
        }
    </style>
</head>
<body>
<!--<div id="loading"></div>-->
<?php $this->beginBody() ?>
<div id="all">
    <!-- Top bar-->
    <div class="top-bar">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 d-md-block d-none">
                    <p>Contactenos <i class="fa fa-phone"></i> +505 2249 7239 -- <i class="fa fa-envelope"></i>
                        informacion@abrasa.com.ni</p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end justify-content-between">
                        <ul class="list-inline contact-info d-block d-md-none">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                        <div class="searchbar">
                            <!--suppress HtmlFormInputWithoutLabel -->
                            <input class="search_input" type="text" name="buscar" id="buscar" placeholder="Buscar..."/>
                            <a href="#" class="search_icon"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar Start-->
    <header class="nav-holder make-sticky">
        <nav id="navbar" role="navigation" class="navbar navbar-expand-lg " style="box-shadow: 1px 10px 16px -12px rgba(5,5,5,0.75);
-webkit-box-shadow: 1px 10px 16px -12px rgba(5,5,5,0.75);
-moz-box-shadow: 1px 10px 16px -12px rgba(5,5,5,0.75);">
            <div class="container effect-2">
                <a href="<?= Url::to(['site/index']) ?>" class="navbar-brand home" style="padding: 0px;margin: 0px">
                    <img src="<?= Url::base(true) ?>/assets/img/logo.png" alt="Logo Abrasa"
                         class="d-none d-md-inline-block" height="74"/>
                    <img src="<?= Url::base(true) ?>/assets/img/logo-small.png" alt="Logo Abrasa"
                         class="d-inline-block d-md-none"/>
                    <span class="sr-only">Abrasa - Ir a inicio</span>
                </a>
                <button type="button" data-bs-toggle="collapse" data-bs-target="#navigation"
                        class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i
                            class="fa fa-align-justify"></i></button>
                <div id="navigation" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav" style="margin-left: auto !important;">
                        <li class="nav-item dropdown hover-underline-animation" id="site">
                            <a href="<?= Url::home(true) ?>">Inicio</a>
                        </li>
                        <li class="nav-item dropdown hover-underline-animation" id="product">
                            <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">
                                Productos <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                foreach ($categorias as $categoria) {
                                    ?>
                                    <li class="dropdown-item dropdown-submenu">
                                        <a id="nav-<?= $categoria->idcategoria ?>" data-bs-toggle="dropdown"
                                           href="<?= Url::to(['producto/categoria', 'id' => $categoria->idcategoria]) ?>"
                                           class="nav-link dropdown-toggle">
                                            <?= $categoria->nombre ?>
                                        </a>
                                        <ul aria-labelledby="nav-<?= $categoria->idcategoria ?>"
                                            class="dropdown-menu pre-scrollable"
                                            style="overflow-x: hidden; max-height: 250px;">
                                            <?php
                                            $familias = Familia::find()->where(['idcategoria' => $categoria->idcategoria])->orderBy(['nombre' => SORT_ASC])->all();
                                            $detaFamilia = Detafamilia::find()->where(['idfamilia' => $familias])->all();
                                            $subcategorias = Subcategoria::find()
                                                ->where(['idcategoria' => $categoria->idcategoria])
                                                ->andWhere(['not in', 'idsubcategoria', $detaFamilia])
                                                ->orderBy(['nombre' => SORT_ASC])
                                                ->all();
                                            if (count($subcategorias) > 0):
                                                foreach ($subcategorias as $subcategoria) {
                                                    ?>
                                                    <li class="dropdown-item">
                                                        <a href="<?= Url::to(['producto/find', 'id' => $subcategoria->idsubcategoria, 'idfamilia' => 0]) ?>"
                                                           class="nav-link">
                                                            <?= $subcategoria->nombre ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            endif;
                                            foreach ($familias as $item):
                                                ?>
                                                <li class="dropdown-item">
                                                    <a href="<?= Url::to(['producto/familia', 'idfamilia' => $item->idfamilia]) ?>"
                                                       class="nav-link">
                                                        <?= $item->nombre ?>
                                                    </a>
                                                </li>
                                            <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hover-underline-animation" id="about">
                            <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">Sobre Nosotros <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                    <a href="<?= Url::to(['about/sucursales']) ?>" class="nav-link">Sucursales y
                                        Cobertura</a>
                                </li>
                                <!--<li class="dropdown-item">
                                    <a href="<?= Url::to(['about/sucursales']) ?>" class="nav-link">Sucursales</a>
                                </li>-->
                                <li class="dropdown-item">
                                    <a href="<?= Url::to(['about/proveedores']) ?>" class="nav-link">Nuestros
                                        proveedores</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?= Url::to(['about/equipo']) ?>" class="nav-link">Equipo t&eacute;cnico y
                                        Ventas</a>
                                </li>
                                <!--<li class="dropdown-item">
                                    <a href="<?php /*= Url::to(['about/quienes-somos']) */ ?>" class="nav-link">Qui&eacute;nes
                                        Somos</a>
                                </li>-->
                                <li class="dropdown-item">
                                    <a href="<?= Url::to(['about/perfil']) ?>" class="nav-link">Quienes Somos</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown hover-underline-animation" id="site">
                            <a href="<?= Url::to(['noticias/index']) ?>">Blog</a>
                        </li>
                        <li class="nav-item dropdown hover-underline-animation">
                            <a href="<?= Url::to(['about/index']) ?>" id="contactenos">Contactenos</a>
                        </li>
                        <!-- ========== Contact dropdown end ==================-->
                    </ul>
                </div>
                <div id="search" class="collapse clearfix">
                    <form role="search" class="navbar-form">
                        <div class="input-group">
                            <input type="text" placeholder="Search" class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-template-main"><i
                                            class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navbar End-->
    <div class="wrapper">
        <?= $content ?>
    </div>
    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <hr/>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="<?= Url::to(['site/index']) ?>" class="">Ir a Inicio</a></li>
                        <li class="nav-item"><a href="<?= Url::to(['about/quienes-somos']) ?>" class="">Sobre
                                nosotros</a></li>
                        <li class="nav-item"><a href="<?= Url::to(['producto/index']) ?>" class="">Catalogo de
                                Productos</a></li>
                        <li class="nav-item"><a href="<?= Url::to(['about/sucursales']) ?>" class="">Sucursales</a></li>
                        <li class="nav-item"><a href="<?= Url::to(['noticias/index']) ?>" class="">Blog</a></li>
                    </ul>
                    <div>
                        <a href="https://www.facebook.com/abrasanicaragua/" target="_blank" style="font-size: 2em"><i
                                    class="fab fa-facebook-square"></i></a>
                        <a href="https://www.instagram.com/abrasa.agropecuariabravo/?hl=es" target="_blank"
                           style="font-size: 2em"><i class="fab fa-instagram-square"></i></a>
                    </div>
                    <hr/>
                </div>
                <div class="col-md-4 col-sm-12">
                    <hr/>
                    <h4 class="h6">Contactenos</h4>
                    <p class="text-uppercase text-white"><strong>ABRASA.</strong><br>KM, 2 1/2 C, NORTE<br/> FRENTE AL
                        TALLER
                        NOGUERA <br><strong>Managua, Nicaragua</strong></p>
                    <p class="text-white">Telefono: <i class="fa fa-phone"></i> +505 2249 7239</p>
                    <p class="text-white">
                        E-mail: <i class="fa fa-envelope"></i>
                        <?= Yii::$app->formatter->asEmail('informacion@abrasa.com.ni') ?>
                    </p>
                    <a href="<?= Url::to(['about/sucursales']) ?>" class="btn btn-template-main">Ir a pagina de
                        sucursales</a>
                    <p>&nbsp;</p>
                    <a href="<?= Url::to(['about/index']) ?>" class="btn btn-template-main">Ir a pagina de contacto</a>
                    <hr class="d-block d-lg-none">
                </div>
                <div class="col-md-4 col-sm-12">
                    <iframe width="100%" height="100%"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1950.202747587344!2d-86.251052!3d12.152773!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xadcbd51f731fd9b5!2sAgropecuaria%20Bravo%20S.A%20(ABRASA)!5e0!3m2!1sen!2sus!4v1626062769218!5m2!1sen!2sus"
                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
        <br/>
    </footer>
</div>
<?php $this->endBody() ?>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"
        type="application/javascript"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    /*$(document).ready(function(){
		var preloader = document.getElementById('loading');
		preloader.classList.add('animate__animated', 'animate__fadeOut');
		preloader.style.setProperty('--animate-duration', '5s');
		preloader.addEventListener('animationend', () => {
			preloader.style.display ="none";
		});
	});*/

    // window.addEventListener('load', function(){
    // 	preloader.style.display = 'none';
    // 	})

    function myFunction() {
        preloader.style.display = 'none';
    };
    /*    $(function () {
            // ------------------------------------------------------- //
            // Multi Level dropdowns
            // ------------------------------------------------------ //
            $.getJSON('http://ip-api.com/json', function (data) {
                console.log(JSON.stringify(data, null, 2));
            });
        });*/
    $(function () {

        // Initate masonry grid
        var $grid = $('.gallery-wrapper').masonry({
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            horizontalOrder: true, // new!
            percentPosition: true,
        });

        // Initate imagesLoaded
        $grid.imagesLoaded().progress(function () {
            $grid.masonry('layout');
        });

        $('.search_icon').click(function (e) {
            window.location.replace("<?=Url::to(["producto/index"])?>?search=" + $("#buscar").val());
        });
        $('#buscar').keypress(function (event) {
            if (event.keyCode === 13) {
                window.location.replace("<?=Url::to(["producto/index"])?>?search=" + $("#buscar").val());
            }
        });
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
