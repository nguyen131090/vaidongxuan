<?php 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country-ideel.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/mobile/thanks.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2 container-filter">
    <div class="column">

        <div class="area-filter fix-banner-top no-padding">
          <? if(!empty($theEntry->photosArray['banner'])) :
            $v = $theEntry->photosArray['banner'][0]; ?>
                <img class="image-banner img-responsive lazyload" alt="<?= $v->description; ?>" data-sizes="auto" data-src='<?= $v->image ?>' data-srcset="/thumb/600/400/1/80<?= $v->image?> 450w, /thumb/900/0/1/80<?= $v->image?>">
                
                <? else : ?>
                    <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                <? endif; ?>    
            
            
            <span class="fil-background"></span>
                <h1 style="bottom: 2rem;" class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom">Merci<?//=Yii::$app->session->get('sex') ? ' '.Yii::$app->session->get('sex') : '' ?><?=Yii::$app->session->get('name') ? ' '.Yii::$app->session->get('name') : '' ?> !</h1>
        </div>
    </div>
</div>

<div class="contain container-1">
    <div class="row-content pay-home">
      <span class="space space-80"></span>
        <div class="content-thank mt-0"><?=$theEntry->model->text ?></div>
        <span class="space space-50"></span>
    </div>
    
    <!-- Tour Voyage -->
    
    <div class="countrie-items column">
        <div class="text-notification  mt-60 mw-720 mb-80">
            <p class="tt tt-fontsize-40 tt-latolatin-bold m-0"><?=$fields['notification']->title ?></p>
           
            <div class="text m-0"><?=$theEntry->data->notification ?></div>
        </div>
        <div class="blogs countries-slider swiper-container">
            <div class="swiper-wrapper">
        <? 
        $cnt = 0;
        foreach ($countries as $key => $value){ 
            
        $cnt++;    
          $image_summary = [];  
          $image_icon_map = [] ;
         if(isset($value->photos)) {
            foreach ($value->photos as $image) {
                
                if($image->type == 'summary'){
                    $image_summary = [
                        'image' => $image->image,
                        'description' => $image->description,
                        'caption' => $image->caption,
                    ];
                    
                }
                if($image->type == 'map'){
                    $image_icon_map = [
                        'image' => $image->image,
                        'description' => $image->description,
                        'caption' => $image->caption,
                    ];
                    
                }
                
            } 
        }
        ?>
        
            <div class="item item-<?=$cnt?> item-<?=$value->slug?> mt-0 mb-0 swiper-slide swiper-slide-80 pb-0">
                <a href="<?=DIR.$value->slug?>/informations-pratiques">
                    <div class="image img-zoom-span">
                        <?if(!empty($image_summary)){?>
                        <img height="" alt="<?= $image_summary['description']?>" class="img-lazy img-zoom img-responsive lazyload" data-src="<?=$image_summary['image']?>">
                        <?}else{?>
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-demo-vietnam-destination.jpg">
                        <?}?>
                        
                            <span class="effect" style="background-image: url(<?= isset($image_icon_map['image']) ? $image_icon_map['image'] : ''?>);"><?= $value->title ?></span>
                    </div>
                    <h2 class="tt mt-txt-25 mb-txt-60 tt-latolatin-regular tt-fontsize-40"><?= $value->title ?></h2>
                </a>    
            </div>
        
        <? } ?>
            </div>
        </div>
        <span class="space space-80"></span>
        </div>
    
    <!-- End Tour Voyage -->
    
    <!-- Tour Secret exclusive -->
    <? 
$imgPort = '';
if(!empty($theEntry->photosArray['banner'][1])){
    $imgPort = $theEntry->photosArray['banner'][1];
}
?>
<div class="column portrait bg-f7 no-padding mt-0">
    <div class="img">
    <img class="w-100 focus-center my-0 no-padding focus-center" data-src="<?=$imgPort ? "/thumb/1100/440/1/80$imgPort->image" : '/thumb/1100/440/1/80/assets/img/tour/bg-portrait.jpg'?>">
    <div class="caption d-inline-flex align-items-center tt-color-white tt-latolatin-bold tt-fontsize-13-5 position-absolute"><img class="mr-10 img-lazy" data-src="/assets/img/fb.png"> <?=$imgPort->model->caption ?></div>
    </div>
    <div class="block-excl p-25 d-inline-block">
        
        <h2 class="tt mb-0 mt-25 tt-fontsize-40 tt-latolatin-bold"><?=!empty($fields['contact']) ? $fields['contact']->title : '' ?></h2>
        
        <div class="mt-0 mb-0"><?=!empty($theEntry->data->contact) ? $theEntry->data->contact : '' ?></div>
        <span class="space space-20"></span>
        <a class="btn-amica-basic-1 btn-amica-basic float-right  button-devis mt-0" target='_blank' href="<?=$theEntry->data->contactbutton ?>" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" ><?=$fields['contactbutton']->title; ?></a>

    </div>
    <span class="space space-80"></span>
</div>
    <!-- End Tour Secret exclusive -->
    
    <!-- History -->
    <div class="contain">
    <div class="amc-column row p-0 no-gutters">
        <? if(!empty($theEntry->photosArray['custom'])) : ?>
            <? foreach ($theEntry->photosArray['custom'] as $k => $v) :?>
                <a href="<?=$v->model->caption ?>" >
                <div class="item-custom position-relative p-0 <?=!$k ? 'mb-50' : 'mb-80' ?>">
                    <img class="img-lazy w-100" data-src="<?=$v->image ?>" alt="<?=$v->description?>"/>
                    <div class="text-on-image position-absolute text-right">
                    <p class="caption tt-fontsize-32 tt-latolatin-bold tt-color-white "><?=$v->description ?></p>
                    </div>
                </div>
                </a>
            <? endforeach; ?>
        <? endif; ?>
    </div>
</div>
    <!-- End History -->
    <div class="contain mt-60 mb-40 journey">
    <div class="amc-column">
        <p class="tt tt-fontsize-40 tt-latolatin-bold  m-0"><?=$fields['journey']->title;?></p>
        <div class="content-journey">
            <?=$theEntry->data->journey ?>
        </div>
    </div>
</div>
</div>  

<?
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');

$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile('/assets/js/mobile/popupvideo.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$js=<<<JS
$(function() {
    
    var secreSwiper = new Swiper('.secrets-slider', {
        slidesPerView: 1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 10,
        loop: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        //preventClicks: false,
        breakpoints: {
            
            320: {
            slidesPerView: 1,
            spaceBetween: 10
            },
            414: {
            slidesPerView: 1,
            spaceBetween: 10
            },
            // when window width is <= 480px
            480: {
              slidesPerView: 2,
              spaceBetween: 10
            },
            568: {
              slidesPerView: 2,
              spaceBetween: 10,
              
            },
            // when window width is <= 640px
            667: {
              slidesPerView: 2,
              spaceBetween: 10
            },
            736: {
              slidesPerView: 2,
              spaceBetween: 10
            }
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
     var testiSwiper = new Swiper('.exclusive-slider', {
        slidesPerView: 'auto',
        centeredSlides: true,
        paginationClickable: true,
        spaceBetween: 20,
        
        loop: true
         
    });   
    
});
        
      
JS;
$this->registerJs($js,  yii\web\View::POS_END);
?>