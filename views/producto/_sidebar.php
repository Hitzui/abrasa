<?php

use app\models\Categoria;
use app\models\Detafamilia;
use app\models\Familia;
use app\models\FamiliaArticulo;
use app\models\Subcategoria;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $categorias app\models\Categoria */
/* @var $sub app\models\Subcategoria */
/** @var Categoria $cat */
/** @var Categoria $category */
/** @var Familia $family */
Yii::$app->view->registerJs('
$("#familia-' . $family->idfamilia . '").addClass("show");
$("#heading-1-' . $family->idfamilia . '").removeClass("bg-white");
$("#heading-1-' . $family->idfamilia . '").addClass("active");
$("#heading-1-' . $family->idfamilia . ' h5 a").addClass("text-light");
$("#collapse-' . $category->idcategoria . '").addClass("show");
');

$css = <<<CSS
.active{
 background-color: #28a745;
}
.card-header{

}
CSS;


Yii::$app->view->registerCss($css);
?>
<div id="accordionTwo" role="tablist">
    <?php
    foreach ($categorias as $categoria) {
        if ($categoria->idcategoria === $cat->idcategoria) {
            $show = 'show';
        } else {
            $show = '';
        }
        ?>
        <div class="card">
            <div id="heading-<?= $categoria->idcategoria ?>" role="tab" class="card-header"
                 style="background-color: #F39200;">
                <h5 class="mb-0">
<!-- Se ocultó la siguiente propiedad data-bs-toggle="collapse"-->
                    <a
                       href="<?= Url::toRoute(['producto/categoria', 'id'=>$categoria->idcategoria])?>"
                       aria-expanded="true" aria-controls="collapse-<?= $categoria->idcategoria ?>"
                       class="text-white">
                        <?= $categoria->nombre ?>
                    </a>
                </h5>
            </div>
            <div id="collapse-<?= $categoria->idcategoria ?>" role="tabpanel"
                 aria-labelledby="heading-<?= $categoria->idcategoria ?>" data-parent="#accordionTwo"
                 class="collapse <?= $show ?>">
                <div id="accordion-1">
                    <?php
                    $familias = Familia::find()->where(['idcategoria' => $categoria->idcategoria])->orderBy(['nombre' => SORT_ASC])->all();
                    $detaFamilia = Detafamilia::find()->where(['idfamilia' => $familias])->all();
                    //Tratamos de filtrar las subcategorias que no tengan asociadas una familia
                    /*es muy importante asociar la familia con la subcategoria, si es que tiene asociación*/
                    $subcategorias = Subcategoria::find()
                        ->where(['idcategoria' => $categoria->idcategoria])
                        ->andWhere(['not in', 'idsubcategoria', $detaFamilia])
                        ->orderBy(['nombre' => SORT_ASC])
                        ->all();
                    if (count($subcategorias) > 0):?>
                        <div class="card-body">
                            <ul class="list-group list-group-flush" style="margin: -20px">
                                <?php
                                //Mostramos las subcategorias en el panel lateral
                                foreach ($subcategorias as $subcategoria) {
                                    /** @var Subcategoria $sub */
                                    if ($sub->idsubcategoria === $subcategoria->idsubcategoria) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    ?>
                                    <li class="list-group-item <?= $active ?>">
                                        <?php
                                        if ($subcategoria->idsubcategoria == 63) {
                                            ?>
                                            <a href="<?= Url::to(['producto/find', 'id' => $subcategoria->idsubcategoria, 'idfamilia' => 0]) ?>">
                                                <?= $subcategoria->nombre ?>
                                            </a>
                                            <?php
                                        } else { ?>
                                            <a href="<?= Url::to(['producto/find', 'id' => $subcategoria->idsubcategoria, 'idfamilia' => 0, 'sort' => 'ascendente']) ?>">
                                                <?= $subcategoria->nombre ?>
                                            </a>
                                            <?php
                                        }
                                        ?>

                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php
                    endif;
                    //mostramos las familias en el panel lateral
                    foreach ($familias as $item):
                        Yii::$app->view->registerJs('
                        $("#familia-' . $item->idfamilia . '").on("shown.bs.collapse", function () {
                        window.location.href = "' . Url::to(['producto/familia', 'idfamilia' => $item->idfamilia, 'sort' => 'ascendente']) . '";
                        });
                        ');
                        ?>
                        <div class="card">
                            <div class="card-header bg-white" id="heading-1-<?= $item->idfamilia ?>">
                                <h5 class="mb-0">
                                    <a class="collapsed text-info" role="button" data-bs-toggle="collapse"
                                       href="#familia-<?= $item->idfamilia ?>"
                                       aria-expanded="false" aria-controls="familia-<?= $item->idfamilia ?>">
                                        <?= $item->nombre ?>
                                    </a>
                                </h5>
                            </div>
                            <div id="familia-<?= $item->idfamilia ?>" class="collapse" data-parent="#accordion-1"
                                 aria-labelledby="heading-1-<?= $item->idfamilia ?>">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush" style="margin: -20px">
                                        <?php
                                        $deta = Detafamilia::find()->where(['idfamilia' => $item->idfamilia])->all();
                                        $subcategorias = Subcategoria::find()
                                            ->where(['idsubcategoria' => $deta])
                                            ->orderBy(['nombre' => SORT_ASC])
                                            ->all();
                                        foreach ($subcategorias as $subcategoria):
                                            if ($sub->idsubcategoria === $subcategoria->idsubcategoria) {
                                                $active = 'active';
                                            } else {
                                                $active = '';
                                            }
                                            ?>
                                            <li class="list-group-item <?= $active ?>">
                                                <?= Html::a($subcategoria->nombre, ['producto/find', 'id' => $subcategoria->idsubcategoria, 'idfamilia' => $item->idfamilia, 'sort' => 'ascendente'], ['class' => 'profile-link']) ?>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }//fin de categorias
    ?>
</div>