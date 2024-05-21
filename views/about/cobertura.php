<?php

/* @var $this yii\web\View */

use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\web\JqueryAsset;

//use yii\helpers\Html;

$this->title = 'ABRASA - COBERTURA';
$url = Url::to();
$urls = explode("/", $url);
$this->registerCss('
.jumbotron{background-color:transparent !important}
.info {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white;
    background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
}
.info h4 {
    margin: 0 0 5px;
    color: #777;
}
.leaflet-top{
	position:static !important;
}
.leaflet-bottom{
	display:none;
}
');
try {
    $this->registerCssFile("https://unpkg.com/leaflet@1.7.1/dist/leaflet.css");
    $this->registerJsFile("https://unpkg.com/leaflet@1.7.1/dist/leaflet.js");
    $this->registerJsFile("/js/map.js", ['depends' => [JqueryAsset::class]]);
    $this->registerJsFile("/assets/js/nicaragua.js");
} catch (InvalidConfigException $e) {
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="map" style="position: relative; min-height: 600px"></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>