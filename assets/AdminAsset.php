<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'https://fonts.googleapis.com/css?family=Montserrat:400,700,200',
        //'admin/vendor/font-awesome/css/font-awesome.css',
        //'admin/vendor/bootstrap/css/bootstrap.min.css',
        'admin/css/fontastic.css',
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700',
        'admin/css/grasp_mobile_progress_circle-1.0.0.min.css',
        'admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
        'admin/css/style.red.css',
        'admin/css/custom.css',
        'assets/css/all.css',
        'admin/css/bootstrap-datepicker.css',
    ];
    public $js = [
        //'admin/vendor/jquery/jquery.js',
        //'admin/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'admin/js/grasp_mobile_progress_circle-1.0.0.min.js',
        'admin/vendor/jquery.cookie/jquery.cookie.js',
        'admin/vendor/chart.js/Chart.min.js',
        'admin/vendor/jquery-validation/jquery.validate.min.js',
        'admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
        'admin/js/charts-home.js',
        'admin/js/front.js',
        'admin/js/bootstrap-datepicker.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
