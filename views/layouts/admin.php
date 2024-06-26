<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Breadcrumbs;

AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/admin/css/bootstrap-glyphicons.css"/>
    <?php $this->head() ?>
    <style>
        .breadcrumb {
            background-color: transparent !important;
        }

        .breadcrumb a, .breadcrumb li {
            color: white;
        }

        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.eot');
            src: url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'),
            url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.woff2') format('woff2'),
            url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.woff') format('woff'),
            url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.ttf') format('truetype'),
            url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular') format('svg');
        }

        .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font: normal normal 16px/1 'Glyphicons Halflings';
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            margin-right: 4px;
        }

        /* Add icons you will be using below */
        .glyphicon-fire:before {
            content: '\e104';
        }

        .glyphicon-eye-open:before {
            content: '\e105';
        }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Side Navbar -->
<div class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center">
                <img src="/assets/img/logo-small.png" alt="person" class="img-fluid">
                <h2 class="h5">Administrador</h2>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo">
                <a href="<?= Url::to(['categoria/index']) ?>" class="brand-small text-center"> <strong>A</strong><strong
                            class="text-primary">B</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li><a href="<?= Url::to(['slide/index']) ?>"><i class="fas fa-image"></i> Imagenes Principales</a></li>
                <li><a href="<?= Url::to(['stores/index']) ?>"><i class="fas fa-store-alt"></i> Tiendas</a></li>
                <li>
                    <a href="#noticias" aria-expanded="false" data-bs-toggle="collapse">
                        <i class="icon-interface-windows"></i>Noticias
                    </a>
                    <ul id="noticias" class="collapse list-unstyled ">
                        <li><a href="<?= Url::to(['noticias/alls']) ?>">Todos</a></li>
                        <li><a href="<?= Url::to(['catnoticias/index']) ?>">Categoria Noticias</a></li>
                        <li><a href="<?= Url::to(['subnoticias/index']) ?>">Sub-Categoria Noticias</a></li>
                        <li><a href="<?= Url::to(['subcatnoticias/index']) ?>">Subcategoria-Categoria</a></li>
                        <li><a href="<?= Url::to(['noticia-categoria-articulo/index']) ?>">Categoria Articulo-Noticia</a></li>
                        <li><a href="<?= Url::to(['noticias/create']) ?>">Crear</a></li>
                        <li><a href="<?= Url::to(['imagenes/index']) ?>">Imagenes</a></li>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['categoria/index']) ?>"><i class="far fa-object-group"></i> Categoria</a></li>
                <li><a href="<?= Url::to(['subcategoria/index']) ?>"> <i class="icon-form"></i>Sub-Categoria</a></li>
                <li><a href="<?= Url::to(['proveedor/index']) ?>"> <i class="icon-grid"></i>Proveedor</a></li>
                <li>
                    <a href="#tecnicos" aria-expanded="false" data-bs-toggle="collapse">
                        <i class="fa-solid fa-user-group"></i> Administrar Tecnicos
                    </a>
                    <ul id="tecnicos" class="collapse list-unstyled ">
                        <li><a href="<?= Url::to(['cattecnico/index']) ?>">Categoria</a></li>
                        <li><a href="<?= Url::to(['tecnico/index']) ?>">Tecnicos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#familia" aria-expanded="false" data-bs-toggle="collapse">
                        <i class="fas fa-layer-group"></i> Familias
                    </a>
                    <ul id="familia" class="collapse list-unstyled ">
                        <li><a href="<?= Url::to(['familia/index']) ?>">Todos</a></li>
                        <li><a href="<?= Url::to(['familia-articulo/index']) ?>">Familia-Articulo</a></li>
                        <li><a href="<?= Url::to(['detafamilia/index']) ?>">Familia-Subcategoria</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#articulo" aria-expanded="false" data-bs-toggle="collapse">
                        <i class="icon-interface-windows"></i>Articulo
                    </a>
                    <ul id="articulo" class="collapse list-unstyled ">
                        <li><a href="<?= Url::to(['articulo/index']) ?>">Todos</a></li>
                        <li><a href="<?= Url::to(['presentacion/index']) ?>">Presentacion</a></li>
                        <li><a href="<?= Url::to(['articulo/proveedores']) ?>">Articulos por Proveedor</a></li>
                        <li><a href="<?= Url::to(['articulo/proveedor']) ?>">Asociar Proveedor</a></li>
                        <li><a href="<?= Url::to(['familia-articulo/index']) ?>">Asociar Familia</a></li>
                        <li><a href="<?= Url::to(['detaarticulo/index']) ?>">Articulo/Sub-Categoria</a></li>
                        <li><a href="<?= Url::to(['articulo/create']) ?>">Crear</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-interface-windows"></i> P&aacute;gina Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page">
    <!-- navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header">
                        <a id="toggle-btn" href="#" class="menu-btn">
                            <i class="icon-bars"> </i>
                        </a>
                        <a href="/articulo/index" class="navbar-brand">
                            <div class="brand-text d-none d-md-inline-block">
                                <strong class="text-primary">ABRASA - Dashboard</strong>
                            </div>
                        </a>
                    </div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Log out-->
                        <li class="nav-item">
                            <?php
                            $isGuest = Yii::$app->user->isGuest;
                            if ($isGuest == 1) { ?>
                                <a href="<?= Url::to(['site/login']) ?>" class="nav-link logout">
                                    <span class="d-none d-sm-inline-block">Login</span><i
                                            class="fas fa-sign-in-alt"></i></i>
                                </a>
                            <?php } else {
                                $identity = Yii::$app->user->identity;
                                ?>
                                <a href="<?= Url::to(['site/logout']) ?>" class="nav-link logout" data-method="post">
                                    <?= $isGuest ?> <?= $identity->username ?> <span class="d-none d-sm-inline-block">Logout</span>
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <div class="heading-breadcrumbs">
            <div class="container-fluid bg-success">
                <div class="row d-flex align-items-center flex-wrap">
                    <div class="col-md-8">
                        <h1 class="text-white"><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="col-md-4">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => 'breadcrumb d-flex justify-content-end'],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <?= $content ?>
    </div>
    <!-- FOOTER -->
</div>
<?php $this->endBody() ?>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?= Url::base(true) ?>/admin/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
<?php $this->endPage() ?>
