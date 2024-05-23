<?php

/* @var $this yii\web\View */

/* @var $categoriaTecnicos array */

use app\models\Tecnico;
use yii\base\InvalidConfigException;
use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\helpers\Url;

$this->title = "ABRASA - Quienes Somsos";
try {
    $this->registerCssFile(Url::base(true) . '/assets/vendor/icofont/icofont.min.css');
    $this->registerCssFile(Url::base(true) . '/assets/vendor/icomoon-icons/style.css');
    $this->registerCssFile(Url::base(true) . '/assets/vendor/boxicons/css/boxicons.min.css');
    $this->registerCssFile(Url::base(true) . '/assets/vendor/owl.carousel/assets/owl.carousel.min.css');
    $this->registerCssFile(Url::base(true) . '/assets/vendor/venobox/venobox.css');
    $this->registerCssFile(Url::base(true) . '/assets/css/style.css');
    $this->registerCssFile('https://unpkg.com/swiper@7/swiper-bundle.min.css');
    $this->registerCssFile(Url::base(true) . '/assets/css/perfil.css');
    $this->registerJsFile(Url::base(true) . '/assets/js/glightbox.js', ['depends' => [JqueryAsset::class]]);
    $this->registerJsFile('https://unpkg.com/swiper@7/swiper-bundle.min.js');
    $this->registerJsFile(Url::base(true) . '/assets/vendor/jquery.easing/jquery.easing.min.js', ['depends' => [AssetBundle::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/vendor/venobox/venobox.min.js', ['depends' => [AssetBundle::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/vendor/isotope-layout/isotope.pkgd.min.js', ['depends' => [AssetBundle::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/js/main.js', ['depends' => [AssetBundle::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/js/perfil.js', ['depends' => [AssetBundle::class]]);
    $this->registerCssFile(Url::base(true) . '/assets/css/mdb.min.css', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/vendor/bootstrap/js/bootstrap.bundle.js', ['depends' => [BootstrapAsset::class]]);
    $this->registerJsFile(Url::base(true) . '/assets/js/mdb.min.js', ['depends' => [BootstrapAsset::class]]);
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>
<br>
<section id="perfil" class="" data-aos="fade-up">
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
<section class="features-three">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="features-three__image clearfix">
                    <img class="img-fluid"
                         height="600px"
                         src="<?=Url::base(true)?>/assets/images/resources/quienes_somos_01.jpg"
                         alt="">
                    <div class="features-three__image__caption">
                        <i class="icon-growth"></i>
                        <h3>Líderes profesionales en Agricultura</h3>
                    </div><!-- /.features-three__image__caption -->
                </div><!-- /.features-three__image -->
            </div><!-- /.col-xl-6 -->
            <div class="col-xl-6">
                <div class="features-three__content">
                    <div class="sec-title text-left">
                        <div class="icon">
                            <img src="<?= Url::base(true)?>/assets/images/resources/sec-title-icon1.png" alt="">
                        </div>
                        <span class="sec-title__tagline">Beneficios que ofrecemos</span>
                        <h2 class="sec-title__title">
                            ¿Por qué escoger ABRASA?
                        </h2>
                    </div>
                    <ul class="list-unstyled features-three__list">
                        <li>
                            <i class="fa fa-check"></i>
                            <div class="features-three__list__content">
                                <h3>Agropecuaria Bravo S.A.</h3>
                                <p>Soluciones para grandes y pequeñas empresas.</p>
                            </div><!-- /.features-three__list__content -->
                        </li>
                        <li>
                            <i class="fa fa-check"></i>
                            <div class="features-three__list__content">
                                <h3>100% Satisfacción</h3>
                                <p>Satisfacción, calidad y garantia en nuestros productos.</p>
                            </div><!-- /.features-three__list__content -->
                        </li>
                        <li>
                            <i class="fa fa-check"></i>
                            <div class="features-three__list__content">
                                <h3>Personal capacitado</h3>
                                <p>Nuestros expertos le proporcionarán servicios de asesoría técnica de
                                    nutrición vegetal para todo tipo de cultivos,
                                    métodos de fertilización y suelos.</p>
                            </div><!-- /.features-three__list__content -->
                        </li>
                    </ul><!-- /.list-unstyle -->
                </div><!-- /.features-three__content -->
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.features-three -->

<br>
<section id="ventas" class="ventas perfil features-two" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="3500">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="text-white" data-aos="fade-up">Departamento de Ventas</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <?php
            foreach ($categoriaTecnicos as $key => $value):
                ?>
                <!--Start Single Features One-->
                <div class="col-sm-1 col-md-4 wow fadeInLeft" >
                    <div class="features-two__single" style="min-height: 400px">
                        <div class="features-two__single-top">
                            <div class="icon">
                                <img style="height: 200px"
                                     src="<?= $value->imagen ?>" alt="<?= $value->nombre ?>"
                                     class="shadow-sm"
                                     data-aos="fade-in">
                            </div>
                            <div class="count-box"></div>
                        </div>
                        <div class="features-two__single-title">
                            <h3><a href="#"><?= $value->nombre ?></a></h3>
                            <a href="<?= Url::to(['about/equipo', 'activo' => $key]) ?>"
                               class="btn btn-primary"
                               data-aos="fade-up">
                                Ver más sobre nuestro Equipo
                            </a>
                        </div>
                    </div>
                </div>
                <!--End Single Features One-->
            <?php
            endforeach;
            ?>
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
    <section class="bar no-mb rounded border container" data-aos="fade-right" style="margin: auto !important;">
        <div class="container">
            <div class="row showcase text-center">
                <div class="col-md-4 col-sm-6">
                    <div class="item text-white">
                        <div class="icon-outlined">
                            <!--<em class="fa fa-align-justify"></em>-->
                            <img src="<?= Url::base(true) ?>/assets/images/resources/clientes.png"
                                 alt="Abrasa" class="img-fluid" />
                        </div>
                        <h4>+<span class="h1 counter">1600</span><br>Clientes</h4>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item text-white">
                        <div class="icon-outlined">
                            <!--<em class="fa fa-users"></em>-->
                            <img src="<?= Url::base(true) ?>/assets/images/resources/vendedor.png"
                                 alt="Abrasa" class="img-fluid" />
                        </div>
                        <h4>+<span class="h1 counter">30</span><br>Vendedores</h4>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item text-white">
                        <div class="icon-outlined">
                            <!--<em class="fa fa-copy"></em>-->
                            <img src="<?= Url::base(true) ?>/assets/images/resources/imagen-de-marca.png"
                                 alt="Abrasa" class="img-fluid" />
                        </div>
                        <h4>+<span class="h1 counter">32</span><br>Marcas Representadas</h4>
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