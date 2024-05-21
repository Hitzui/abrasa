<?php

use yii\helpers\Html;

/** @var \app\models\Proveedor $proveedores */
$this->title = "ABRASA - ARTICULOS POR PROVEEDOR";
?>
<p>&nbsp;</p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include('_sidebar.php') ?>
        </div>
        <div class="col-md-9">
            <div class="header_familia" style="background-color: #42754e">
                <span>ARTICULOS FILTRADOS POR: <b><?= $proveedores->nombre ?></b></span>
                <span class="float-right"><?= Html::a('Ir a Proveedores', ['about/proveedores'], ['class' => 'text-warning']) ?></span>
            </div>
            <?php include('_datos.php'); ?>
        </div>
    </div>
</div>