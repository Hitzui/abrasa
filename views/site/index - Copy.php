<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\web\View;

$this->title = 'ABRASA - INICIO';

$this->registerJs(
    "jssor_1_slider_init();",
    View::POS_READY,
    'my-button-handler'
);
$this->registerCss('.jumbotron{background-color:transparent !important');
?>
<section style="background: url('<?=Url::to('@web')?>/assets/img/carousel/AGROINSUMOS-1-2.jpg') center center repeat; background-size: cover;" class="relative-positioned">
        <!-- Carousel Start-->
        <div class="home-carousel">
          <div class="dark-mask mask-primary"></div>
          <div class="container">
            <div class="homepage owl-carousel">
              <div class="item">
                <div class="row">
                  <div class="col-md-5 text-right">
                    <p><img src="img/logo.png" alt="" class="ml-auto"></p>
                    <h1>Multipurpose responsive theme</h1>
                    <p>Business. Corporate. Agency.<br>Portfolio. Blog. E-commerce.</p>
                  </div>
                  <div class="col-md-7"><img src="<?=Url::to('@web')?>/assets/img/carousel/HERRADURA-1-1.jpg" alt="" class="img-fluid" /></div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-12 text-center">
					  <img src="<?=Url::to('@web')?>/assets/img/carousel/AGROINSUMOS-1-1.png" alt="" class="img-fluid" />
					</div>
                  <!--<div class="col-md-5">
                    <h2>46 HTML pages full of features</h2>
                    <ul class="list-unstyled">
                      <li>Sliders and carousels</li>
                      <li>4 Header variations</li>
                      <li>Google maps, Forms, Megamenu, CSS3 Animations and much more</li>
                      <li>+ 11 extra pages showing template features</li>
                    </ul>
                  </div>-->
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-5 text-right">
                    <h1>Design</h1>
                    <ul class="list-unstyled">
                      <li>Clean and elegant design</li>
                      <li>Full width and boxed mode</li>
                      <li>Easily readable Roboto font and awesome icons</li>
                      <li>7 preprepared colour variations</li>
                    </ul>
                  </div>
                  <div class="col-md-7">
					  <img src="<?=Url::to('@web')?>/assets/img/carousel/AGROINSUMOS-1-3.jpg" alt="" class="img-fluid" />
					</div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-7">
					  <img src="<?=Url::to('@web')?>/assets/img/carousel/GANADO-1-1.jpg" alt="Ganado Nicaragua" class="img-fluid" />
					</div>
                  <div class="col-md-5">
                    <h1>Easy to customize</h1>
                    <ul class="list-unstyled">
                      <li>7 preprepared colour variations.</li>
                      <li>Easily to change fonts</li>
                    </ul>
                  </div>
                </div>
              </div>
				<div class="item">
                <div class="row">
                  <div class="col-md-12">
					  <img src="<?=Url::to('@web')?>/assets/img/carousel/MAQUINARIA-1-1.jpg" alt="Ganado Nicaragua" class="img-fluid" />
					</div>
                  <!--<div class="col-md-5">
                    <h1>Easy to customize</h1>
                    <ul class="list-unstyled">
                      <li>7 preprepared colour variations.</li>
                      <li>Easily to change fonts</li>
                    </ul>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Carousel End-->
      </section>
      <section class="bar">
        <div class="container text-center">
          <div class="col-md-12">
            <div class="heading text-center">
              <h2>Categor&iacute;a de productos</h2>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-6">
                <div class="box-simple" style="">
					<div class="hover hover-3 text-white rounded" style="background-color: #2364AA">
						<img src="<?=Url::to('@web')?>/assets/img/categorias/especialidades01.png" alt="" class="img-fluid" />
						<div class="hover-overlay"></div>
						<div class="hover-3-content px-5 py-4">
							<h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
								<!--<span class="font-weight-light">Image </span><-->
								<a href="" class="text-white"> Especialidades</a>
							</h3>							
						</div>
					</div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="box-simple">
                  <div class="hover hover-3 text-white rounded">
						<img src="<?=Url::to('@web')?>/assets/img/categorias/ferreteria01.png" alt="" class="img-fluid" />
						<div class="hover-overlay"></div>
						<div class="hover-3-content px-5 py-4">
							<h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
								<!--<span class="font-weight-light">Image </span><-->
								<a href="" class="text-white"> Ferreteria</a>
							</h3>							
						</div>
					</div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="box-simple" style="">
					<div class="hover hover-3 text-white rounded">
						<img src="<?=Url::to('@web')?>/assets/img/categorias/fertilizante01.png" alt="" class="img-fluid" />
						<div class="hover-overlay"></div>
						<div class="hover-3-content px-5 py-4">
							<h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
								<!--<span class="font-weight-light">Image </span><-->
								<a href="" class="text-white">Fertilizante</a>
							</h3>							
						</div>
					</div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-6">
                <div class="box-simple" style="">
					<div class="hover hover-3 text-white rounded">
						<img src="<?=Url::to('@web')?>/assets/img/categorias/semillas01.png" alt="" class="img-fluid" />
						<div class="hover-overlay"></div>
						<div class="hover-3-content px-5 py-4">
							<h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
								<!--<span class="font-weight-light">Image </span><-->
								<a href="" class="text-white"> Semillas</a>
							</h3>							
						</div>
					</div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="box-simple" style="">
					<div class="hover hover-3 text-white rounded">
						<img src="<?=Url::to('@web')?>/assets/img/categorias/maquinaria01.png" alt="" class="img-fluid" />
						<div class="hover-overlay"></div>
						<div class="hover-3-content px-5 py-4">
							<h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
								<!--<span class="font-weight-light">Image </span><-->
								<a href="" class="text-white"> Maquinaria</a>
							</h3>							
						</div>
					</div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="box-simple" style="">
					<div class="hover hover-3 text-white rounded">
						<img src="<?=Url::to('@web')?>/assets/img/categorias/fitosanitarios01.png" alt="" class="img-fluid" />
						<div class="hover-overlay"></div>
						<div class="hover-3-content px-5 py-4">
							<h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
								<!--<span class="font-weight-light">Image </span><-->
								<a href="" class="text-white"> Fitosanitario</a>
							</h3>							
						</div>
					</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
<section class="bar">
	 <!-- DEMO 5 -->
  <div class="py-5">
    <div class="heading text-center">
              <h2>Categor&iacute;a de productos</h2>
            </div>
    <div class="row">
      <!-- DEMO 5 Item-->
      <div class="col-lg-2 mb-3 mb-lg-0">
        <div class="hover hover-5 text-white rounded" style="background-color: #2364AA">
			<img src="<?=Url::to('@web')?>/assets/img/categorias/fitosanitarios.png" alt="" width="50px" style="width: 120px; left: 20%;"/>
          <div class="hover-overlay"></div>
          <div class="hover-5-content">
            <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
				<!--Image <strong class="font-weight-bold text-white">Caption--> </strong><span>Fitosanitario</span></h3>
          </div>
        </div>
      </div>
		<!-- DEMO 5 Item-->
      <div class="col-lg-2 mb-3 mb-lg-0">
        <div class="hover hover-5 text-white rounded" style="background-color: #3DA5D9">
			<img src="<?=Url::to('@web')?>/assets/img/categorias/ferreteria.png" alt="" width="50px" style="width: 120px; left: 20%;"/>
          <div class="hover-overlay"></div>
          <div class="hover-5-content">
            <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
				<!--Image <strong class="font-weight-bold text-white">Caption--> </strong><span>Ferreteria</span></h3>
          </div>
        </div>
      </div>
	<!-- DEMO 5 Item-->
      <div class="col-lg-2 mb-3 mb-lg-0">
        <div class="hover hover-5 text-white rounded" style="background-color:#73BFB8">
			<img src="<?=Url::to('@web')?>/assets/img/categorias/semillas.png" alt="" width="50px" style="width: 120px; left: 20%;"/>
          <div class="hover-overlay"></div>
          <div class="hover-5-content">
            <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
				<!--Image <strong class="font-weight-bold text-white">Caption--> </strong><span><a href="#">Semillas</a></span>
			  </h3>
          </div>
        </div>
      </div>
<!-- DEMO 5 Item-->
      <div class="col-lg-2 mb-3 mb-lg-0">
        <div class="hover hover-5 text-white rounded" style="background-color:#FEC601">
			<img src="<?=Url::to('@web')?>/assets/img/categorias/especialidades.png" alt="" width="50px" style="width: 120px; left: 20%;"/>
          <div class="hover-overlay"></div>
          <div class="hover-5-content">
            <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
				<!--Image <strong class="font-weight-bold text-white">Caption--> </strong><span>Especialidades</span></h3>
          </div>
        </div>
      </div>
<!-- DEMO 5 Item-->
      <div class="col-lg-2 mb-3 mb-lg-0">
        <div class="hover hover-5 text-white rounded" style="background-color:#EA7317">
			<img src="<?=Url::to('@web')?>/assets/img/categorias/fertblend.png" alt="" width="50px" style="width: 120px; left: 20%;"/>
          <div class="hover-overlay"></div>
          <div class="hover-5-content">
            <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
				<!--Image <strong class="font-weight-bold text-white">Caption--> </strong><span>Fertblend</span></h3>
          </div>
        </div>
      </div>
<!-- DEMO 5 Item-->
      <div class="col-lg-2 mb-3 mb-lg-0">
        <div class="hover hover-5 text-white rounded" style="background-color: #D7B9D5">
			<img src="<?=Url::to('@web')?>/assets/img/categorias/maquinaria.png" alt="" width="50px" style="width: 120px; left: 20%;"/>
			<div class="hover-overlay"></div>
          	<div class="hover-5-content">			  
			  <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
				<span><a href="#">Maquinaria</a></span>
			  </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
      <section class="bar background-pentagon no-mb">
        <div class="container">
          <div class="row showcase text-center">
            <div class="col-md-3 col-sm-6">
              <div class="item">
                <div class="icon-outlined icon-sm icon-thin"><i class="fa fa-align-justify"></i></div>
                <h4><span class="h1 counter">580</span><br> Websites</h4>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="item">
                <div class="icon-outlined icon-sm icon-thin"><i class="fa fa-users"></i></div>
                <h4><span class="h1 counter">100</span><br>Satisfied Clients</h4>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="item">
                <div class="icon-outlined icon-sm icon-thin"><i class="fa fa-copy"></i></div>
                <h4><span class="h1 counter">320</span><br>Projects</h4>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="item">
                <div class="icon-outlined icon-sm icon-thin"><i class="fa fa-font"></i></div>
                <h4><span class="h1 counter">923</span><br>Magazines and Brochures</h4>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="bar background-white no-mb">
        <div data-animate="fadeInUpBig" class="container"> 
          <div class="row">
            <div class="col-md-12">
              <div class="heading text-center">
                <h2>Latest works from our portfolio</h2>
              </div>
              <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris </p>
              <div class="row portfolio text-center color-white">
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="img/portfolio-1.jpg" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="portfolio-detail.html" class="color-white">Portfolio item</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-sm-none">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
                            <p class="buttons"><a href="portfolio-detail.html" class="btn btn-template-outlined-white">View</a><a href="#" class="btn btn-template-outlined-white">Website</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="img/portfolio-2.jpg" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="portfolio-detail.html" class="color-white">Portfolio item</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-sm-none">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
                            <p class="buttons"><a href="portfolio-detail.html" class="btn btn-template-outlined-white">View</a><a href="#" class="btn btn-template-outlined-white">Website</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="img/portfolio-3.jpg" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="portfolio-detail.html" class="color-white">Portfolio item</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-sm-none">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
                            <p class="buttons"><a href="portfolio-detail.html" class="btn btn-template-outlined-white">View</a><a href="#" class="btn btn-template-outlined-white">Website</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="see-more text-center">
                <p>Do you want to see more?</p><a href="portfolio-4.html" class="btn btn-template-outlined">See more of our work</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="bar bg-gray no-mb">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="heading text-center">
                <h3>Our Clients</h3>
              </div>
              <ul class="list-unstyled owl-carousel customers no-mb">
                <li class="item"><img src="img/customer-1.png" alt="" class="img-fluid"></li>
                <li class="item"><img src="img/customer-2.png" alt="" class="img-fluid"></li>
                <li class="item"><img src="img/customer-3.png" alt="" class="img-fluid"></li>
                <li class="item"><img src="img/customer-4.png" alt="" class="img-fluid"></li>
                <li class="item"><img src="img/customer-5.png" alt="" class="img-fluid"></li>
                <li class="item"><img src="img/customer-6.png" alt="" class="img-fluid"></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="bar background-white no-mb">
        <div class="container">
          <div class="col-md-12">
            <div class="heading text-center">
              <h2>From our blog</h2>
            </div>
            <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="blog.html">Check our blog!</a></p>
            <div class="row">
              <div class="col-lg-3">
                <div class="home-blog-post">
                  <div class="image"><img src="img/portfolio-4.jpg" alt="..." class="img-fluid">
                    <div class="overlay d-flex align-items-center justify-content-center"><a href="#" class="btn btn-template-outlined-white"><i class="fa fa-chain"> </i> Read More</a></div>
                  </div>
                  <div class="text">
                    <h4><a href="#">Fashion Now </a></h4>
                    <p class="author-category">By <a href="#">John Snow</a> in <a href="blog.html">Webdesign</a></p>
                    <p class="intro">Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p><a href="#" class="btn btn-template-outlined">Continue Reading</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="home-blog-post">
                  <div class="image"><img src="img/portfolio-3.jpg" alt="..." class="img-fluid">
                    <div class="overlay d-flex align-items-center justify-content-center"><a href="#" class="btn btn-template-outlined-white"><i class="fa fa-chain"> </i> Read More</a></div>
                  </div>
                  <div class="text">
                    <h4><a href="#">What to do</a></h4>
                    <p class="author-category">By <a href="#">John Snow</a> in <a href="blog.html">Webdesign</a></p>
                    <p class="intro">Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p><a href="#" class="btn btn-template-outlined">Continue Reading</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="home-blog-post">
                  <div class="image"><img src="img/portfolio-5.jpg" alt="..." class="img-fluid">
                    <div class="overlay d-flex align-items-center justify-content-center"><a href="#" class="btn btn-template-outlined-white"><i class="fa fa-chain"> </i> Read More</a></div>
                  </div>
                  <div class="text">
                    <h4><a href="#">5 ways to look awesome</a></h4>
                    <p class="author-category">By <a href="#">John Snow</a> in <a href="blog.html">Webdesign</a></p>
                    <p class="intro">Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p><a href="#" class="btn btn-template-outlined">Continue Reading</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="home-blog-post">
                  <div class="image"><img src="img/portfolio-6.jpg" alt="..." class="img-fluid">
                    <div class="overlay d-flex align-items-center justify-content-center"><a href="#" class="btn btn-template-outlined-white"><i class="fa fa-chain"> </i> Read More</a></div>
                  </div>
                  <div class="text">
                    <h4><a href="#">Fashion Now </a></h4>
                    <p class="author-category">By <a href="#">John Snow</a> in <a href="blog.html">Webdesign</a></p>
                    <p class="intro">Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p><a href="#" class="btn btn-template-outlined">Continue Reading</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

<div class="row">
            <div class="col-md-2">
                <div class="box-simple" style="">
                    <div class="hover hover-3 text-white rounded" style="background-color: #F5A65B">
                        <img src="/assets/img/categorias/especialidades.png" alt=""
                             class="img-fluid"/>
                        <div class="hover-overlay"></div>
                        <div class="hover-3-content px-5 py-4 text-center">
                            <h4 class="hover-3-title font-weight-bold mb-1">
                                <a href="#" class="text-white" style="margin-left: -10px">Especialidades</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box-simple">
                    <div class="hover hover-3 text-white rounded" style="background-color: #6A66A3">
                        <img src="/assets/img/categorias/ferreteria.png" alt=""
                             class="img-fluid"/>
                        <div class="hover-overlay"></div>
                        <div class="hover-3-content px-5 py-4">
                            <h4 class="hover-3-title font-weight-bold mb-1">
                                <!--<span class="font-weight-light">Image </span><-->
                                <a href="" class="text-white">Ferreteria</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box-simple" style="">
                    <div class="hover hover-3 text-white rounded" style="background-color: #1e7e34">
                        <img src="/assets/img/categorias/Fertilizantes.png" alt=""
                             class="img-fluid"/>
                        <div class="hover-overlay"></div>
                        <div class="hover-3-content px-5 py-4">
                            <h4 class="hover-3-title font-weight-bold mb-1">
                                <!--<span class="font-weight-light">Image </span><-->
                                <a href="" class="text-white">Fertilizante</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box-simple" style="">
                    <div class="hover hover-3 text-white rounded" style="background-color: #6CAE75">
                        <img src="/assets/img/categorias/Semillas.png" alt=""
                             class="img-fluid"/>
                        <div class="hover-overlay"></div>
                        <div class="hover-3-content px-5 py-4">
                            <h4 class="hover-3-title font-weight-bold mb-1">
                                <!--<span class="font-weight-light">Image </span><-->
                                <a href="" class="text-white"> Semillas</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box-simple" style="">
                    <div class="hover hover-3 text-white rounded" style="background-color: #6CAE75">
                        <img src="/assets/img/categorias/veterinaria.png" alt=""
                             class="img-fluid"/>
                        <div class="hover-overlay"></div>
                        <div class="hover-3-content px-5 py-4">
                            <h4 class="hover-3-title font-weight-bold mb-1">
                                <!--<span class="font-weight-light">Image </span><-->
                                <a href="" class="text-white"> Veterinaria</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box-simple" style="">
                    <div class="hover hover-3 text-white rounded" style="background-color: #8B9474">
                        <img src="/assets/img/categorias/maquinaria.png" alt=""
                             class="img-fluid"/>
                        <div class="hover-overlay"></div>
                        <div class="hover-3-content px-5 py-4">
                            <h4 class="hover-3-title font-weight-bold mb-1">
                                <!--<span class="font-weight-light">Image </span><-->
                                <a href="" class="text-white"> Maquinaria</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>