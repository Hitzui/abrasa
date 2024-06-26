<?php

use yii\base\InvalidConfigException;
use yii\bootstrap4\LinkPager;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */

try {
    $this->registerCssFile('/assets/css/noticias.css');
    $this->registerJsFile('/assets/js/lodash.min.js');
} catch (InvalidConfigException $e) {
    echo $e->getMessage();
}
?>
<div class="">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-8">
                <?php
                if (count($categoriart)>0){?>
                    <br />
                    <div class="container">
                        <div class="row">
                            <?php
                            foreach ($categoriart as $value):
                                /* @var $value \app\models\Categoria */
                                ?>
                                <div class="col-md col-sm-12">
                                    <div class="box-simple animate__animated animate__bounce" data-aos="fade-right">
                                        <div class="hover hover-3 text-white rounded"
                                             style="background-color: <?= $value->color ?>">
                                            <img src="/<?= $value->imagen ?>" alt="<?= $value->nombre ?>" class="img-fluid"/>
                                            <div class="hover-overlay"></div>
                                            <div class="hover-3-content px-5 py-4 text-center">
                                                <h4 class="hover-3-title font-weight-bold mb-1">
                                                    <a href="<?= Url::to(['producto/categoria', 'id' => $value->idcategoria]) ?>"
                                                       class="text-white" style="margin-left: -10px">
                                                        <?= $value->nombre ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
				<div class="block-area">
					<div class="block-title-13">
						<h4 class="h5 title-box-dot">
						<span class="text-black">Ultimos Eventos</span>
						</h4><div class="dot-line">
						</div>
					</div>		
					<!--output-->           
					<?php
					foreach($noticias as $noticia){
					?>
					<article class="card card-full mb-5 mb-md-6 hover-a text-center" data-aos="fade-up">
						<!-- thumbnail -->
						<div class="ratio_single image-wrapper">
							<a href="<?= Url::to(['noticias/find','id'=>$noticia->idnoticias])?>">
								<img width="1100" src="/<?= $noticia->imagen?>" sizes="(max-width: 1500px) 100vw, 1500px" data-was-processed="true">							
							</a>
						</div>
						<div class="mx-4 mt-minus position-relative bg-themes p-3 p-lg-5 rounded border-bottom shadow-lrb-lg">
							<!--post title-->
							<h4 class="h2 h1-md display-4-lg">
								<a href="<?= Url::to(['noticias/find','id'=>$noticia->idnoticias])?>">
									<?= $noticia->titulo?>
								</a>
							</h4>
							<!--post date-->
							<div class="text-muted small mb-2">
							<!--author-->
							<span class="fw-bold d-none d-sm-inline me-1">
								<a href="http://www.abrasa.com.ni/" title="Posts by ABRASA" rel="author">ABRASA</a>			
							</span>
							<time class="news-date" datetime="<?= $noticia->fecha?>"><?= $noticia->fecha?></time>
						</div>
						<!--description-->
						<p class="card-text"><?= $noticia->contenido_pe?></p>
							<a href="<?= Url::to(['noticias/find','id'=>$noticia->idnoticias])?>">Ver más</a>
					</div>
				</article>					            	            								
			<?php } ?>			            	                                            
				</div>
			</div>
		<?php include('_aside.php') ?>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <?php
            /** @var Pagination $pagination */
            // display pagination
            ?>
            <nav aria-label="Page navigation">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'linkOptions' => ['class' => 'page-link'],
                    'disabledPageCssClass' => 'disabled',
                    /*'firstPageCssClass'=>'page-item',
                    'prevPageCssClass'=>'page-item',
                    'nextPageCssClass'=>'page-item',
                    'lastPageCssClass'=>'page-item',*/
                    'activePageCssClass' => 'active',
                    'pageCssClass' => 'page-item'
                ]) ?>
            </nav>
        </div>
    </div>
</div>