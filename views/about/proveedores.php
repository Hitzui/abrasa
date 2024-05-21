<?php

use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'ABRASA - CONTACTENOS';
/**@var $proveedores app\models\Proveedor */

$js = <<<JS
$("#txtsearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    console.log(value);
  $.ajax({
        type: "GET",
        url: "/about/filter",
        data:{param:value},
        success: function (data) {            
            var filter = $("#filter");
            filter.html("");
            filter.append(data);            
        },
        errors: function (errors) {
            console.log(errors);
        }
    });
});
JS;

$this->registerJs($js, View::POS_READY);
$this->registerJsFile(Url::base(true) . '/assets/vendor/bootstrap/js/bootstrap.bundle.js', ['depends' => [BootstrapAsset::class]]);
?>
<p>&nbsp;</p>

<div class="container">
    <section class="bar">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Nuestro Proveedores</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtsearch" class="sr-only">Filtrar Proveedor:</label>
                    <input type="text" class="form-control" id="txtsearch" placeholder="Proveedor"
                           aria-describedby="searchHelp"/>
                    <small id="searchHelp" class="form-text text-muted">Filtrar Proveedor por nombre.</small>
                </div>
            </div>
        </div>
        <div id="filter">
            <?php include '_filter.php' ?>
        </div>
    </section>
</div>