<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\web\View;

//use yii\helpers\Html;

$this->title = 'ABRASA - COBERTURA';
$url = Url::to();
$urls = explode("/", $url);
$this->registerCss("
.marker {
	border: none;
	cursor: pointer;
	height: 36px;
	width: 32px;
	background-image: url('http://www.abrasa.com.ni/assets/img/marker.png');
	background-repeat: no-repeat;
	background-size: 100% 100%;
	background-color: rgba(0, 0, 0, 0);
  }

      .sidebar {
        position: absolute;
        top: 0;
        bottom: 15%;
        left: 0;
        display: block;
        /*border-right: 1px solid rgba(0, 0, 0, 0.25);*/
        z-index:10000;
      }
      .pad2 {
        padding: 20px;
      }	  
      .map {
	  	min-height:550px;
		width:100%;
        top: 0;
        bottom: 0;
      }
  .listings {
        height: 100%;
        overflow: auto;
        padding-bottom: 60px;
      }

      .listings .item {
        display: block;
        border-bottom: 1px solid #eee;
        padding: 10px;
        text-decoration: none;
      }

      .listings .item:last-child {
        border-bottom: none;
      }
      .listings .item .title {
        display: block;
        color: #6c5ce7;
        font-weight: 700;
      }

      .listings .item .title small {
        font-weight: 400;
      }
      .listings .item.active .title,
      .listings .item .title:hover {
        color: #8cc63f;
      }
      .listings .item.active {
        background-color: #f8f8f8;
      }
      ::-webkit-scrollbar {
        width: 3px;
        height: 3px;
        border-left: 0;
        background: rgba(0, 0, 0, 0.1);
      }
      ::-webkit-scrollbar-track {
        background: none;
      }
      ::-webkit-scrollbar-thumb {
        background: #6c5ce7;
        border-radius: 0;
      }

");
$this->registerCssFile('https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.css');
$this->registerJsFile("https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js");
$this->registerJsFile("https://api.tiles.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.js");
$this->registerJsFile("/assets/js/custom.js",[View::POS_END]);
?>
<p>&nbsp;</p>
<div class="container-fluid" style="min-height: 500px">
    <div class="row">
		<div class="col-md-4">
			<div class="sidebar">
				<div class="heading">
					<h1>Nuestras sucursales</h1>
				</div>
				<div id="listings" class="listings h-100"></div>
			</div>			
		</div>
		<div class="col-md-8">
			<div id="map" class="map"></div>	
		</div>
    </div>
</div>