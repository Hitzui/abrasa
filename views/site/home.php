<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\web\View;

$this->title = 'Agropecuaria Bravo, S.A. - ABRASA';

$this->registerCss('
#loading {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 132px;
    height: 132px;
    /* 1/2 of the height and width of the actual gif */
    margin: -16px 0 0 -16px;
    z-index: 100;
}
.jumbotron{background-color:transparent !important;}
.title_home_productos {
    background-color: #F59D00;
    color: white;
    text-transform: uppercase;
    font-size: 24px;
    padding: 20px;
    margin-top: 30px;
    margin-bottom: 25px;
}
.swiper-pagination{
    position:inherit;
}
.swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
');
$this->registerJs('
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 10,
    slidesPerGroup: 4,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  
');
$this->registerJs('
console.log("Ready");
',[View::POS_LOAD]);
?>
