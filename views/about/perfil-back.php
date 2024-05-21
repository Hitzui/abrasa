<?php

use yii\web\View;
use yii\helpers\Url;

$this->title = "ABRASA - Perfil Empresarial";

$this->registerCssFile(Url::home() . 'assets/vendor/icofont/icofont.min.css');
$this->registerCssFile(Url::home() . 'assets/vendor/boxicons/css/boxicons.min.css');
$this->registerCssFile(Url::home() . 'assets/vendor/owl.carousel/assets/owl.carousel.min.css');
$this->registerCssFile(Url::home() . 'assets/vendor/venobox/venobox.css');
$this->registerCssFile(Url::home() . 'assets/css/style.css');
$this->registerCssFile('https://unpkg.com/swiper@7/swiper-bundle.min.css');
$this->registerCssFile(Url::home() . 'assets/css/perfil.css');
$this->registerJsFile(Url::home() . 'assets/js/glightbox.js', ['depends' => [\yii\web\AssetBundle::class]]);
$this->registerJsFile('https://bootstrapmade.com/demo/templates/Medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js');
$this->registerJsFile('https://unpkg.com/swiper@7/swiper-bundle.min.js');
$this->registerJsFile(Url::home() . 'assets/vendor/jquery.easing/jquery.easing.min.js', ['depends' => [\yii\web\AssetBundle::class]]);
$this->registerJsFile(Url::home() . 'assets/vendor/venobox/venobox.min.js', ['depends' => [\yii\web\AssetBundle::class]]);
$this->registerJsFile(Url::home() . 'assets/vendor/isotope-layout/isotope.pkgd.min.js', ['depends' => [\yii\web\AssetBundle::class]]);
$this->registerJsFile(Url::home() . 'assets/js/main.js', ['depends' => [\yii\web\AssetBundle::class]]);
$this->registerJsFile(Url::home() . 'assets/js/perfil.js', ['depends' => [\yii\web\AssetBundle::class]]);
?>
<!-- ======= Header ======= -->
<header id="header" class="d-flex justify-content-center align-items-center">

    <nav class="nav-menu d-none d-lg-block">
        <ul>
            <li><a href="#perfil">Perfil</a></li>
            <li><a href="#ventas">Ventas</a></li>
            <li><a href="#sucursales">Sucursales</a></li>
            <li><a href="#proveedores">Proveedores</a></li>
            <!--<li><a href="#contact">Contacto</a></li>-->
        </ul>
    </nav><!-- .nav-menu -->

</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <h1>ABRASA</h1>
        <h2>Agropecuaria Bravo, S.A.</h2>
        <a href="#perfil" class="btn-scroll scrollto" title="Scroll Down"><em class="bx bx-chevron-down"></em></a>
    </div>
</section><!-- End Hero -->

<section id="perfil" class="sucursales perfil" data-aos="fade-up">
    <div class="container">
        <div class="section-title">
            <h2 class="text-success">Perfil Empresarial</h2>
            <hr/>
            <p class="text-justify">AGROPECUARIA BRAVO S.A (ABRASA), fue fundada en Agosto de 1999 con el propósito de
                distribuir productos veterinarios, agrícolas y otros productos orientados hacia el sector agropecuario
                en general. ABRASA forma parte del grupo de Empresas Bravo Flores, conformadas por: DIINSA
                (Distribuidora Internacional S.A), MAYON (Mayoreo del Norte Bravo y Brenes S.A).</p>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                    <li class="nav-item">
                        <a class="nav-link show active" data-bs-toggle="tab" href="#tab-1" style="font-size: 20px;">
                            Misi&oacute;n
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-2" style="font-size: 20px;">
                            Visi&oacute;n
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab-1">
                        <div class="row">
                            <div class="col-lg-12 details">
                                <h3 class="text-success">Misi&oacute;n</h3>
                                <p style="font-size: 18px;">
                                    En ABRASA comercializamos productos destinados al sector agropecuario en todo el
                                    territorio nacional a través de un personal calificado y motivado, buscando siempre
                                    eficiencia en el servicio.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 details order-2 order-lg-1">
                                <p style="font-size: 18px;">Nuestro compromiso de servicio permite una relación
                                    comercial estable y duradera con nuestros proveedores y clientes. Identificamos
                                    oportunidades para el desarrollo de productos y marcas que representamos, lo que
                                    contribuye a obtener los resultados financieros que garantizan el crecimiento de la
                                    empresa para el beneficio y satisfacción del consumidor final, clientes,
                                    Proveedores, empleados y accionistas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-2">
                        <div class="row">
                            <div class="col-lg-12 details">
                                <h3 class="text-success">Visi&oacute;n</h3>
                                <p style="font-size: 18px;">Ser una empresa líder en la comercialización de productos
                                    agropecuarios, en continua búsqueda de excelencia en el servicio, basado en el
                                    desarrollo del recurso humano.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="ventas" class="ventas perfil" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="3500">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="text-success">Departamento de Ventas</h2>
                    <hr>
                </div>
                <span>El departamento de ventas consta de once (11) vendedores y doce (12) técnicos que atienden todo el territorio nacional, distribuidos de la siguiente forma.</span>
            </div>
            <div class="col-md-8">
                <ul class="list-group list-group-flush">
                    <!--<li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Vendedores para Managua (productos Purina)</span>
                        <span class="badge badge-primary badge-pill">2</span>
                    </li>-->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Vendedores para la zona del Pacifico.</span>
                        <span class="badge badge-primary badge-pill">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Vendedores para la zona norte</span>
                        <span class="badge badge-primary badge-pill">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Vendedor para la zona de las Segovia</span>
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Vendedores para la zona central</span>
                        <span class="badge badge-primary badge-pill">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Vendedor para la zona RAAN (Región  Autónoma Atlántico Norte)</span>
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Vendedor para la zona RAAS (Región  Autónoma Atlántico Sur). </span>
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Técnicos distribuidos por zona para la línea agrícola, exclusivamente para clientes productores en la zona de producción de Arroz, Melón, Tabaco, Maní, Hortalizas y Granos Básicos</span>
                        <span class="badge badge-primary badge-pill">9</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-black">Técnicos a nivel nacional exclusivamente para cultivos de Frijol y Café</span>
                        <span class="badge badge-primary badge-pill">3</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="sucursales" class="perfil" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="text-success">Sucursales</h2>
                    <hr>
                </div>
                <?php include('sucursales.php') ?>
                <p>&nbsp;</p>
                <h2 class="section-title text-success">Oficina Central</h2>
                <p>Está ubicada en una de las principales vías de comunicación de la capital, carretera Norte. Contamos
                    con un área de 876 metros cuadrados de almacén.
                    Desde la oficina central se realiza la distribución a los clientes del área metropolitana así como
                    el reabastecimiento a las distintas sucursales desde donde se atienden los clientes de la zona.
                </p>
            </div>
        </div>
    </div>
    <hr>
    <section class="bar bg-primary no-mb" data-aos="fade-right">
        <div class="container">
            <div class="row showcase text-center">
                <div class="col-md-4 col-sm-6">
                    <div class="item text-white">
                        <div class="icon-outlined icon-sm icon-thin"><em class="fa fa-align-justify"></em></div>
                        <h4><span class="h1 counter">34<</span><br> Técnicos/Vendedores</h4>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item text-white">
                        <div class="icon-outlined icon-sm icon-thin"><em class="fa fa-users"></em></div>
                        <h4><span class="h1 counter">1072</span><br>+Clientes</h4>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item text-white">
                        <div class="icon-outlined icon-sm icon-thin"><em class="fa fa-copy"></em></div>
                        <h4><span class="h1 counter">31</span><br>+Marcas Representadas</h4>
                    </div>
                </div>
                <!--<div class="col-md-3 col-sm-6">
                  <div class="item text-white">
                    <div class="icon-outlined icon-sm icon-thin"><em class="fa fa-font"></em></div>
                    <h4><span class="h1 counter">876</span><br>m<sup>2</sup> de almacen Oficina Central</h4>
                  </div>
              </div>-->
            </div>
        </div>
    </section>
</section>
<section id="proveedores" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="text-success">Nuestros proveedores</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <ol class="list-unstyled owl-carousel customers no-mb">
                    <?php foreach ($proveedores as $proveedor) {
                        if (!empty($proveedor->imagen)) {
                            ?>
                            <li class="item">
                                <a href="<?= Url::to(['producto/proveedor', 'id' => $proveedor->idproveedor]) ?>">
                                    <img src="/<?= $proveedor->imagen ?>" alt="<?= $proveedor->nombre ?>"
                                         class="img-fluid">
                                </a>
                            </li>
                            <?php
                        }
                    } ?>
                </ol>
            </div>
        </div>
    </div>
</section>
<a href="#" class="back-to-top"><em class="icofont-simple-up"></em></a>