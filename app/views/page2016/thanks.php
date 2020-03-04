<?php $this->registerCssFile('/assets/css/page2016/nos-destinations.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/thanks.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]) ?>
<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/swiper-slider-3-item.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
     <? if(!empty($theEntry->photosArray['banner'][0])) : 
        $banner = $theEntry->photosArray['banner'][0];
        ?>
    <img style="width: 100%;" alt="<?=$banner->description; ?>" class="img-lazy" data-src='<?=$banner->image; ?>'>
    <? endif; ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
</div>

<div class="contain container-2 ">
    <div class="amc-column mt-60 row-content-1">
        <div class="top-thank position-relative text-center mb-40">
            <h1 class="tt mt-txt-40 mb-0 d-inline-block tt-fontsize-28 tt-latolatin-bold tt-color-e65925">Merci<?//=Yii::$app->session->get('sex') ? ' '.Yii::$app->session->get('sex') : '' ?><?=Yii::$app->session->get('name') ? ' '.Yii::$app->session->get('name') : '' ?> !</h1>
            <div class="content-thank mt-txt-25"><?=$theEntry->model->text ?></div>
            <? if(!empty($theEntry->photosArray['icon'])) : 
                $illus = $theEntry->photosArray['icon'][0];
                ?>
                <img class="position-absolute" data-src="<?=$illus->image ?>" alt="<?=$illus->description ?>"/>
            <? endif; ?>
        </div>
        <div class="text-notification text-center mt-60 mw-720 mb-txt-40">
            <p class="tt tt-fontsize-24 tt-latolatin-bold mb-txt-25"><?=$fields['notification']->title ?></p>
            <p class="text"><?=$theEntry->data->notification ?></p>
        </div>
        <div class="countrie-items d-inline-flex">
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
            <div class="item item-<?=$cnt?> item-<?=$value->slug?> mt-0 mb-0">
                <a href="<?=DIR.$value->slug?>/informations-pratiques">
                    <div class="image img-zoom-span">
                        <?if(!empty($image_summary)){?>
                        <img height="" alt="<?= $image_summary['description']?>" class="img-lazy img-zoom img-responsive lazyload" data-src="<?=$image_summary['image']?>" data-analytics="on" data-analytics-category="thankyou_page" data-analytics-action="country_section" data-analytics-label="c_infos_card_<?=$value->category_id ?>">
                        <?}else{?>
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-demo-vietnam-destination.jpg">
                        <?}?>
                        
                            <span class="effect" style="background-image: url(<?= isset($image_icon_map['image']) ? $image_icon_map['image'] : ''?>);"><?= $value->title ?></span>
                    </div>
                    <h2 class="tt mt-txt-25 mb-txt-60 tt-latolatin-regular" data-analytics="on" data-analytics-category="thankyou_page" data-analytics-action="country_section" data-analytics-label="c_infos_card_t_<?=$value->category_id ?>"><?= $value->title ?></h2>
                </a>    
            </div>
        <? } ?>
        </div>
    </div>
</div>
<? 
$imgPort = '';
if(!empty($theEntry->photosArray['banner'][1])){
    $imgPort = $theEntry->photosArray['banner'][1];
}
?>
<div class="contain container-fluid excl-container mb-60" <?=$imgPort ? "style='background-image: url($imgPort->image)'" : ''?>>
    <div class="container column text-left amc-column">
        <div class="block-excl p-25 d-inline-block position-relative">
            <h2 class="tt mb-20 mt-0"><?=!empty($fields['contact']) ? $fields['contact']->title : '' ?></h2>
            <p class="mt-0 mb-20"><?=!empty($theEntry->data->contact) ? $theEntry->data->contact : '' ?></p>
            <? if(!empty($theEntry->data->contactbutton)) : ?>
            <a class="btn-amica-basic-1 btn-amica-basic float-right" target="_blank" href="<?=$theEntry->data->contactbutton ?>" data-analytics="on" data-analytics-category="thankyou_page" data-analytics-action="social_section" data-analytics-label="link_facebokgroup" ><?=$fields['contactbutton']->title; ?></a>
            <? endif; ?>
            <div class="caption d-inline-flex align-items-center tt-color-white tt-latolatin-bold tt-fontsize-13-5 position-absolute"><img class="mr-10 img-lazy" data-src="/assets/img/fb.png"> <?=$imgPort->model->caption ?></div>
        </div>
    </div>
</div>
<div class="contain">
    <div class="amc-column row p-0 no-gutters">
        <? if(!empty($theEntry->photosArray['custom'])) : ?>
            <? foreach ($theEntry->photosArray['custom'] as $k => $v) :?>
                <div class="item-custom col-sm-6 position-relative <?=$k ? 'pl-20' : 'pr-20'?>">
                    <img class="img-lazy w-100" data-src="<?=$v->image ?>" alt="<?=$v->description?>"/>
                    <div class="text-on-image position-absolute text-right">
                    <p class="caption tt-fontsize-18 tt-latolatin-bold tt-color-white "><?=$v->description ?></p>
                    <a class="btn-amica-basic-1 btn-amica-basic float-right text-uppercase tt-color-white" href="<?=$v->model->caption ?>" data-analytics="on" data-analytics-category="thankyou_page" data-analytics-action="qui_section" data-analytics-label="<?=$k ? 'link_confiance' : 'link_tourisme' ?>">en savoir plus</a>
                    </div>
                </div>
            <? endforeach; ?>
        <? endif; ?>
    </div>
</div>
<div class="contain mt-60 mb-40 journey">
    <div class="amc-column">
        <p class="tt tt-fontsize-24 tt-latolatin-bold text-center mb-txt-40"><?=$fields['journey']->title;?></p>
        <div class="content-journey">
            <?=$theEntry->data->journey ?>
        </div>
    </div>
</div>

<?
$js=<<<JS
$('.secret-slider').bxSlider({
      minSlides: 3,
      maxSlides: 3,
      moveSlides: 1,
      slideWidth: 300,
       // pager: false,
      slideMargin: 20,
      infiniteLoop: false,
      hideControlOnEnd: true,
        responsive: true,
    });          
        
    $(document).on('mouseover', '.bx-wrapper li .item-img', function(){
        $('.bx-wrapper li .item-img .text-slide').removeClass('active');
        $(this).find('img').addClass('active');    
        $(this).find('.text-slide').addClass('active');
        $(this).find('.text-on-img').hide();
    });
$(document).on('mouseleave', '.bx-wrapper li .item-img', function(){
    $('.bx-wrapper li .item-img img').removeClass('active');  
    $('.bx-wrapper li .item-img .text-slide').removeClass('active');  
     $(this).find('.text-on-img').fadeIn(500);  
});   
        

        
$(document).on('mouseover', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');
    $(this).find('img').addClass('active');    
    $(this).find('.text-slide').addClass('active');
    $(this).find('.text-on-img').hide();
});
$(document).on('mouseleave', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
    $('.custom-slides-swiper-3-item .swiper-slide .item-img img').removeClass('active');  
    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');  
     $(this).find('.text-on-img').fadeIn(500);  
});
   
var swiper = new Swiper('.custom-slides-swiper', {
      slidesPerView: 3,
        
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
         nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        pagination: '.swiper-pagination',
    });      
                  
        
JS;
$this->registerJs($js);
?>