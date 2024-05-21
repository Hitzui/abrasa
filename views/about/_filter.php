<?php
use yii\helpers\Url;

/** @var \app\models\Proveedor $proveedores */

?>
<div class="row portfolio text-center justify-content-center">
    <?php
    foreach($proveedores as $proveedor){
        if(!empty($proveedor->imagen)){
            ?>
            <div class="col-md-3 col-sm-6" id="xdata">
                <div class="box-image" style="height: 250px">
                    <div class="image centro-abs" style="min-height: 250px;">
                        <img style="max-width: 70%" src="/<?= $proveedor->imagen?>" alt="<?= $proveedor->nombre?>" class="img-fluid"/>
                        <div class="overlay d-flex align-items-center justify-content-center">
                            <div class="content">
                                <div class="name">
                                    <h3>
                                        <a href="<?= Url::to(['producto/proveedor','id'=>$proveedor->idproveedor])?>" class="color-white">
                                            <?= $proveedor->nombre?>
                                        </a>
                                    </h3>
                                </div>
                                <div class="text">
                                    <!-- <p class="d-none d-sm-block">Pellentesque habitant morbi tristique senectus et netus et malesuada</p> -->
                                    <p class="buttons">
                                        <a href="<?= Url::to(['producto/proveedor','id'=>$proveedor->idproveedor])?>" class="btn btn-template-outlined-white">
                                            Ver productos
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
