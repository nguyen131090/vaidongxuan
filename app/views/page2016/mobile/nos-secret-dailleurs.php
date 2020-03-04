<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/mobile/confiance.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner full-width">
            <? if(isset($theEntry->photosArray['banner'])){
                    $v = $theEntry->photosArray['banner'][0];
                    
             ?>
             <img
                 alt=""
    data-src="<?= $v->image?>" 
    data-srcset="/thumb/600/400/1/80<?= $v->image?> 450w, /thumb/900/0/1/80<?= $v->image?>"
    data-sizes="auto"
    class="banner-img lazyload" />
                <? } ?>
            <div class="text-on-banner">
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white"><?= $this->context->pageT ? $this->context->pageT : $theEntry->title; ?></h1>
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32 tt-latolatin-regular">
             <?=isset($theEntry->model->content) ? $theEntry->model->content :  $theEntry->description?>
        </div>
        <div class="row-content local-house full-width">
          <h2 class="tt tt-latolatin-bold tt-fontsize-40 tt-color-e65925"><?= !empty($theEntry->data->host) ? $theEntry->data->host : ''?></h2>
          <div class="house-slider">
            <div class="swiper-wrapper">
             <?php

             foreach ($theEntries as $kp => $v) {
               if($v != NULL){
                ?>

                <div class="slide swiper-slide">
                 <a href="<?=DIR.$v->slug?>">
                   <? if(!empty($v->photosArray['summary'])) :
                                $img = $v->photosArray['summary'][0];
                             ?>
                         <img alt="<?= $img->description?>" class="" data-src="<?=DIR?>timthumb.php?src=<?= $img->image?>&w=140&h=140&zc=1">
                        <? endif; ?>
                         <h3 class="title tt-fontsize-32 tt-latolatin-bold"><?= !empty($v->model->sub_title) ? $v->model->sub_title : $v->title;?></h3>
                         <h4 class="no-margin destination tt-fontsize-28 tt-latolatin-regular "><? if(!empty($v->data->location)) : 
                                $des = \app\modules\destinations\api\Catalog::get($v->data->location[0]);
                                ?>
                                <?=!empty($des->model->summary_title) ? $des->model->summary_title : $des->title; ?></br><?=ucfirst(explode('/',$des->slug)[0])?> </h4>
                       


                     
                   <? endif; ?>
                   </a>
                   </div>
                     <?php } ?>   
                     <?php } ?>
            </div>
          </div>
           <a class="tt-latolatin-bold tt-color-e65925 d-block btn-amica-basic-1 btn-amica-basic mx-auto mt-50 button-devis" href="/formules/chez-habitant">Voir toutes les formules</a>
        </div>
    </div>
</div>
<!-- Start of second page -->
<?
$css = <<<CSS
.content-page{
    margin-bottom: 1.5rem;
    display: inline-block;
    position: relative;
    width: 100%;
    text-align: left !important;
    margin-top: 1.5rem;
}
.content-page img{
  width: 100% !important;
  height: auto !important;
  margin-top: 1.5rem;
}
.content-page p, .content-page ul li{
  text-align: left !important;
}
.content-page > p:first-of-type, .content-page h2{
  font: 2rem LatoLatin-Bold,sans-serif;
  color: #e65925;
  text-align: left !important;
  margin: 2.5rem 0;
  line-height: 100%;
}

.content-page h4{
    font-family: LatoLatin-Bold,sans-serif
}
.content-page ul {
    padding: 0;
    margin: 0;
}
.content-page ul li {
    list-style: none;
    margin: 1rem 0;
}
.content-page ul li::before {
    content: "• ";
    color: #e65925;
    display: inline-block;
    font-size: 2rem;
    margin-right: 1rem;
}
.content-page .row-1 h2{
    margin: 0 0 2.5rem;
}
.house-slider .swiper-slide{
  width: 140px;
  text-align: center;
}
.house-slider .swiper-slide img{
  border-radius: 100%;
  width: 100%;
}
.local-house{
  background: #ededed;
  padding: 0 4vmin;
      display: inline-block;
    width: 100VW;
}
.local-house .tt{
  margin: 2.5rem 0 1.5rem;
}
.house-slider{
      margin-bottom: 0;
    margin-top: 2.5rem;
}
.house-slider h3{
  margin: 1.5rem 0 0rem;
}
.content-page table{
  display: block !important;
}
.button-devis {
    display: block;
    text-align: center;
    border-radius: 0.5rem;
    border: 0.1rem solid #e65925;
    line-height: 4.7rem;
    height: 4.7rem;
    width: 100%;
    display: inline-block;
    text-align: center;
    margin-top: 2.5rem;
    margin-bottom: 4rem;
    color: #e65925;
    font-family: LatoLatin-Bold,sans-serif;
}
CSS;
$this->registerCss($css);
$js = <<<JS
var houseSwiper = new Swiper('.house-slider', {
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
JS;
$this->registerJs($js);
?>