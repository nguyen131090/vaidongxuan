<?php 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country-ideel.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/mobile/host.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2 container-filter">
    <div class="column">

        <div class="area-filter fix-banner-top no-padding">
          <? if(!empty($theEntry->photosArray['banner'])) :
            $v = $theEntry->photosArray['banner'][0]; ?>
                    <img class="image-banner img-responsive lazyload" alt="<?= $v->description; ?>" data-sizes="auto" data-src='<?= $v->image ?>' data-srcset="/thumb/600/400/1/80<?= $v->image?> 450w, /thumb/900/0/1/80<?= $v->image?>">
                
                <? else : ?>
                    <img class="image-banner" alt="" src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                <? endif; ?>    
            
            
            <span class="fil-background"></span>
             <? if($theEntry->model->seo != NULL){ ?>
                <h1 style="bottom: 2rem;" class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 style="bottom: 2rem;" class="tt-title tt-fontsize-45 tt-latolatin-bold  tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
        </div>
    </div>
</div>
<div class="contain  top-tours  mb-80">
    <p class="tt-s mt-txt-80">
                <?= $theEntry->model->summary?>
            </p>
    <div class="intro px-0 col text-left float-right w-540 col-lg-auto pt-40">
            <div class="des-icon no-gutters m-0">
                <div class="amc-col col-sm location text-center p-0">
                    <img class="mb-1" data-src="/assets/img/page2016/posi-big.png" alt="" src="/assets/img/page2016/posi-big.png">
                    <p class="d-block w-100 tt-latolatin-bold mb-0"><?=$fields['location']->title ?></p>
                    <div class="posi-link">
                            <? if(!empty($theEntry->data->location)) : 
                                $des = \app\modules\destinations\api\Catalog::get($theEntry->data->location[0]);
                                ?>
                                <a class="color-6b" href="/<?=$des->slug ?>"><?=$des->title; ?></a>
                            <? endif; ?>
                    </div>
                </div>
                <div class="amc-col col-sm timebegin  text-center p-0">
                    <img class="mb-1" data-src="/assets/img/page2016/house-icon.png" alt="" src="/assets/img/page2016/posi-big.png">
                    <p class="d-block w-100 tt-latolatin-bold mb-0"><?=$fields['timebegin']->title ?></p>
                    <span class="text color-6b">
                        <?=!empty($theEntry->data->timebegin) ? $theEntry->data->timebegin : ''?>
                    </span>
                </div>
                <div class="amc-col col-sm when  text-center p-0">
                    <img class="mb-1" data-src="/assets/img/page2016/icon_time_big.png" alt="" src="/assets/img/page2016/posi-big.png">
                    <p class="d-block w-100 tt-latolatin-bold mb-0"><?=$fields['when']->title ?></p>
                    <span class="text color-6b">
                        <?=!empty($theEntry->data->when) ? $theEntry->data->when : ''?>
                    </span>
                    </div>
            </div>
        </div>        
</div>
<div class="column story-fluid contain">
    <div class="img  d-flex align-items-center justify-content-center full-width bg-white">
      <? if(!empty($theEntry->photosArray['custom'])) :
        $illu = $theEntry->photosArray['custom'][0];
       ?>
       <img class="w-100" data-src="<?=$illu->image ?>" alt="<?=$illu->description?>">
     <? endif; ?>
    </div>
    <div class="story">
      <div class="text text-justify mt-50">
        <h2 class="tt tt-fontsize-40 tt-latolatin-bold mt-0 mb-txt-40"><?=$fields['story']->title ?></h2>
        <?=!empty($theEntry->data->story) ?  $theEntry->data->story : '' ?>
      </div>
    </div>
    
</div>
<? if(!empty($theEntry->data->spirit)) : 
  ?>
<div class="column text-left mb-0 contain">
        <? if(!empty($theEntry->data->video)) : ?>
            <div class="amc-column video-col  position-relative mt-0">
            <?=$theEntry->data->video ?>
        </div>
        <? endif; ?>
        <div class="main-content p-0 mt-50 mb-0 text-justify">
            <? if(!empty($theEntry->data->spirit)) : ?>
                <h2 class="tt-latolatin-bold tt-fontsize-40 mb-50 mt-0"><?=$fields['spirit']->title ?></h2>
              <? if(!empty($theEntry->photosArray['custom'][1])) :
                $img = $theEntry->photosArray['custom'][1];?>
                <img class="float-right ml-20 mb-50 full-width" data-src="/thumb/660/440/1/80<?=$img->image ?>" alt="<?=$img->description ?>">
                <? endif; ?>
              <?=$theEntry->data->spirit; ?>
              
            <? endif; ?>
        </div>
    </div>
    <? if(!empty($theEntry->data->des)) : ?>
    <div class="amc-column text-left mb-80 contain">
        <h2 class="tt-fontsize-40 tt-latolatin-bold mb-50"><?=$fields['des']->title ?></h2>
        <div class="content-des  w-720 mx-auto">
          <?=$theEntry->data->des  ?>
        </div>
    </div>
    <? endif; ?>
<? endif; ?>
<div class="galeries-slider bullet-dynamic">
                <div class="swiper-wrapper">
                    <? if(!empty($theEntry->photosArray['galery'])) :
                            foreach ($theEntry->photosArray['galery'] as $key => $v) : ?>
                    <div class="swiper-slide">
                        <img alt="<?= $v->description?>"
                                    data-src="<?=$v->image?>" 
                                    data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />
                        <div  class="text-on-image">
                            <p align="center" class="no-margin tt-color-white tt-latolatin-regular tt-fontsize-28"><?=$v->model->caption ?></p>
                        </div>
                    </div>
                <? endforeach;
                endif; ?>
                </div>
                <div class="swiper-pagination"></div>
</div>
<? if(!empty($theEntry->data->activity)) : ?>
<div class="column mx-auto text-left contain">
      <h2 class="tt tt-fontsize-40 tt-latolatin-bold text-left mt-0 mb-40"><?=$fields['activity']->title ?></h2>
      <div class="content-acti w-720 mx-auto text-left mb-50">
        <?=$theEntry->data->activity ?>
      </div>
      <? if($icons) : ?>
      <div class="icon-acti mx-0 px-0 d-flex align-items-center flex-wrap">
        <? foreach ($icons as $key => $v) : ?>
         <div class="amc-col col-sm d-flex align-items-center mb-40 <?=$key ? 'mt-40' : 'mt-0' ?>">
            <? if(!empty($v->photosArray['icon'])) : 
              $icon = $v->photosArray['icon'][0];
              ?>
              <div class="img text-center">
              <img class="mr-20" data-src="<?=$icon->image ?>" alt="<?=$icon->description ?>"/>
          </div>
            <? endif; ?>
            <div class="d-flex align-items-center flex-wrap">
              <p class="tt-fontsize-32 tt-latolatin-bold mb-1 w-100"><?=$v->title; ?></p>
              <p class="m-0 mb-0 w-100"><?=$v->model->summary; ?></p>
            </div>
          </div>
        <? endforeach; ?>
      </div>
      <? endif;?>
    </div>
<? endif; ?>
<div class="contain">
<button data-title="<?= base64_encode('/nous-contacter') ?>" class="btn-devis tt-latolatin-bold tt-fontsize-32  pugjd" data-position='fixed' data-ajax="false">
    <span>Contactez nous </span>
</button>
</div>

    <? if(!empty($theEntry->data->excl)) : ?>
    <div class="amc-column container text-left d-flex justify-content-center mt-50 mb-50">
        <a href="/<?=$excl[0]->slug ?>" class="tt-latolatin-bold tt-fontsize-32"><img class="mr-2" data-src="/assets/img/eye-icon.png">En savoir plus sur la formule</a>
    </div>
    <? endif; ?>


<? 
$uri = '/'.URI;
$js = <<< JS
$(function() {
    var galeriesSlider = new Swiper('.galeries-slider', {
        slidesPerView: 2,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    });
var tourSwiper = new Swiper('.countries-slider', {
       slidesPerView: 'auto',
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        onReachBeginning: function(swiper){
             swiper.params.centeredSlides = false;
            swiper.params.initialSlide = 0;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
        onReachEnd: function(swiper){
             swiper.params.centeredSlides = false;
             swiper.params.initialSlide = swiper.slides.length - 1;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
    });
    var testiSwiper = new Swiper('.testi-slider', {
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 30,
        lazyLoading: false,
        loop: false
         
    });
});

JS;
$this->registerJs($js, yii\web\View::POS_END); 

$css=<<<CSS
    .des-icon .col p {
        margin-top: 0.5rem;
    }  
CSS;
$this->registerCss($css); 
?>