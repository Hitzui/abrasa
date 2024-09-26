<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://use.typekit.net/clp5cuf.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
        'https://fonts.googleapis.com/css?family=Roboto:300,400,700',
        'assets/vendor/bootstrap-select/css/bootstrap-select.min.css',
        'assets/vendor/owl.carousel/assets/owl.carousel.css',
        'assets/vendor/owl.carousel/assets/owl.theme.default.css',
        'assets/css/style.green.css',
        'assets/css/custom.css',
        'assets/css/agriox.css',
        'assets/vendor/icomoon-icons/style.css?wz2umg',
        'https://unpkg.com/swiper/swiper-bundle.min.css',
    ];

    public $js = [
        //'assets/vendor/jquery/jquery.min.js',
        'assets/vendor/popper.js/umd/popper.min.js',
        /*'assets/vendor/bootstrap/js/bootstrap.bundle.js',
        'assets/vendor/bootstrap/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',*/
        'assets/vendor/jquery.cookie/jquery.cookie.js',
        'assets/vendor/waypoints/jquery.waypoints.min.js',
        'assets/vendor/counterup/counterup.min.js',
        'assets/js/bootstrap-hover-dropdown.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jssor-slider/28.0.0/jssor.slider.min.js',
        'assets/vendor/owl.carousel/owl.carousel.min.js',
        'assets/js/agriox.js',
        'assets/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js',
        'assets/js/jquery.parallax-1.1.3.js',
        'assets/vendor/bootstrap-select/js/bootstrap-select.min.js',
        'assets/vendor/jquery.scrollto/jquery.scrollTo.min.js',
        'https://unpkg.com/imagesloaded@4.1.4/imagesloaded.pkgd.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js',
        'https://unpkg.com/swiper/swiper-bundle.min.js',
        'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
        'assets/js/front.js',
        //'https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
		'yii\web\JqueryAsset'
    ];
}
