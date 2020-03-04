
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <div class="row-content pay-home">
        <span class="space space-50"></span>
        <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-uppercase tt-color-e65925">nos destinations</h1>
        <span class="space space-40"></span>
        <div class="item-pay">
            <a href="<?=DIR?>vietnam">
                <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/mobile/home/vietnam-pays.jpg">
                <h2 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-uppercase tt-color-1f1f1f tt-custom">vietnam</h2>
            </a>
        </div>
        <span class="space space-50"></span>
        <div class="item-pay">
            <a href="<?=DIR?>cambodge">
                <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/mobile/home/cambodge-pays.jpg">
                <h2 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-uppercase tt-color-1f1f1f tt-custom">cambodge</h2>
            </a>
        </div>
        <span class="space space-50"></span>
        <div class="item-pay">
            <a href="<?=DIR?>laos">
                <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/mobile/home/laos-pays.jpg">
                <h2 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-uppercase tt-color-1f1f1f tt-custom">laos</h2>
            </a>
        </div>
        <span class="space space-50"></span>
        <div class="item-pay">
            <a href="<?=DIR?>birmanie">
                <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/mobile/home/birmanie-pays.jpg">
                <h2 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-uppercase tt-color-1f1f1f tt-custom">birmanie</h2>
            </a>
        </div>
    </div>
    
    <!-- Tour Voyage -->
    
    <div class="row-content tour-voyage">
        <span class="space space-80"></span>
        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-uppercase tt-color-e65925">DÉCOUVRIR <br>NOS idées de voyage</h2>
        <span class="space space-40"></span>
        <div class="secret-home item-tour-voyage">
            
            <div class="secrets-slider swiper-container">
                <div class="swiper-wrapper">
                    <? 
                        $cnt = 0;
                        foreach($voyage as $key=> $value) { 
                            //var_dump($value->photosMobile);exit;
                        $cnt++;
                         
                        $image_summary = [];  
                        if(isset($value->photosMobile)) {
                            
                           foreach ($value->photosMobile as $image) {

                               if($image->type == 'banner-mobile'){
//                                   exit;
                                   $image_summary = [
                                       'image' => $image->image,
                                       'description' => $image->description,
                                      // 'caption' => $image->caption,
                                   ];
                                   break;
                               }
                           } 
                       }
                       
                        
                    ?>
                        <div class="swiper-slide item-slide item-slide-<?= $cnt ?>">
                            
                            <a href="<?=DIR.$value->slug ?>">
                                 <?if(!empty($image_summary)){?>
                                <img alt="<?= $image_summary['description'] ?>"
                                    data-src="<?=$image_summary['image']?>" 
                                    data-srcset="/thumb/660/440/1/80<?=$image_summary['image']?> 450w, <?=$image_summary['image']?>"
                                    data-sizes="auto"
                                    class="lazyload" />
                                <?}else{?>
                                <img class="lazyload" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination.jpg"/>
                                     
                                <?}?>    
                                <span class="fill-background"></span>
                                <h3 class="tt-title tt-fontsize-32 tt-latolatin-semibold tt-uppercase tt-color-white tt-custom"><?=$value->title?></h3>
                            </a>
                        </div>
<!--                    <div class="swiper-slide item-slide item-slide-2">
                        <a href="#">
                            
                            <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination.jpg" class=""/>
                            <p class="tt-title tt-fontsize-32 tt-latolatin-semibold tt-uppercase tt-color-white tt-custom">Ethnies et sites insolites</p>
                        </a>
                        </div>
                    <div class="swiper-slide item-slide item-slide-3">
                        <a href="#">
                            
                            <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination.jpg" class=""/>
                            <p class="tt-title tt-fontsize-32 tt-latolatin-semibold tt-uppercase tt-color-white tt-custom">Ethnies et sites insolites</p>
                        </a>
                        </div>-->
                    <? } ?>
                    
                </div>
                
            </div>
            <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
        </div>
        <span class="space space-50"></span>
        <a class="btn-button tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white tt-custom" href="<?=DIR?>devis">Demander un devis</a>
        <span class="space space-80"></span>
    </div>
    
    <!-- End Tour Voyage -->
    
    <!-- Tour Secret exclusive -->
    <? if(isset($modules_exclusive->data->exclusives[0])){?>
    <?
        

        $tt = explode('-', $modules_exclusive->model->title);


    ?>
    <div class="row-content tour-exclusive">
        
        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-uppercase tt-color-e65925"><?= isset($tt[0]) ? $tt[0] : ''?><br><?= isset($tt[1]) ? $tt[1] : ''?></h2>
        <span class="space space-20"></span>
        <div class="text-sumary">
            <?= $modules_exclusive->model->description ?>
        </div>
        <span class="space space-30"></span>
        <div class="item-tour-exclusive">
        
            <div class="exclusive-slider">
                <div class="swiper-wrapper">

                    <?
                        $cnt = 0;
                        foreach ($modules_exclusive->data->exclusives as $value) {

                        $cnt++;  
                        $exclu = \app\modules\exclusives\api\Catalog::get($value);
                        //var_dump($exclu->photos);exit;
                         $image_summary = [];  
                            if(isset($modules_exclusive->photosMobile) && !empty($modules_exclusive->photosMobile)) {
                              // foreach ($modules_exclusive->photos[$cnt - 1] as $image) {

                                //   if($image->type == 'summary'){
                                       $image_summary = [
                                           'image' => $modules_exclusive->photosMobile[count($modules_exclusive->data->exclusives) - $cnt]->image,
                                           'description' => $modules_exclusive->photosMobile[count($modules_exclusive->data->exclusives) - $cnt]->description,
                                          // 'caption' => $image->caption,
                                       ];
                                   //    break;
                                  // }
                              // } 
                           }
                    
                    ?>    
                       <div class="swiper-slide item-slide item-slide-<?= $cnt ?>">
                            <a href="<?= $exclu->slug?>">
                                <?if(!empty($image_summary)){?>
                                <img class="lazyload" height="" alt="<?= $image_summary['description']?>" data-src="<?=$image_summary['image']?>">
                                <?}else{?>
                                   <img class="lazyload" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>
                                     
                                <?}?>    
  
                                <h3 class="tt-title tt-fontsize-32 tt-latolatin-regular tt-color-black tt-custom"><?= $exclu->model->title ?></h3>
                            </a>
                        </div>
<!--                        <div class="swiper-slide item-slide item-slide-1">
                            <a href="#">

                                <img alt="" data-src="<?//=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>
                                <p class="tt-title tt-fontsize-40 tt-latolatin-regular tt-color-black tt-custom">Bouillon d’histoire et de culture</p>
                            </a>
                        </div>
                        <div class="swiper-slide item-slide item-slide-1">
                            <a href="#">

                                <img alt="" data-src="<?//=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>
                                <p class="tt-title tt-fontsize-40 tt-latolatin-regular tt-color-black tt-custom">Bouillon d’histoire et de culture</p>
                            </a>
                        </div>-->
                    <? } ?>

                </div>
            </div>
        </div>   
        <span class="space space-80"></span>
    </div>    
    <? } ?>
    <!-- End Tour Secret exclusive -->
    
    <!-- History -->
    <div class="row-content area-history">
        
<!--        <p class="tt-title tt-fontsize-40 tt-latolatin-bold tt-uppercase tt-color-e65925">l’histoire des 10 ans</p>
        <span class="space space-40"></span>-->
        <div class="video-history">
            <span class="space space-80"></span>
            <div class="text-sumary">
                <? $text_video = explode('<hr />', $theEntry->text); ?>
                <?php 
                    $body = preg_replace('/<p>/', '<p class="tt-title tt-fontsize-40 tt-latolatin-bold tt-uppercase tt-color-e65925">', $text_video[0], 1); 
                    $body = preg_replace('/<p>/', '<span class="space space-20"></span><p>', $body, 2); 
                ?>
                <?= $body ?>
    <!--            <p>
                    10 années d'existence tournées vers la promotion d'une Indochine méconnue et le désir de l'ouvrir de la meilleure façon qui soit, sur le monde
                </p>-->
            </div>
            <span class="space space-30"></span>
    <!--        <img class="img-responsive" alt="amica-travel" data-src="<?//=DIR?>assets/img/mobile/img-destination-video-580-400.jpg">-->
            <a href="#popupVideo" data-rel="popup" data-position-to="window" data-role="button" data-theme="b" data-inline="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" aria-haspopup="true" aria-owns="#popupVideo" class="btn-video-ytb">
    <!--            <img class="img-responsive" alt="amica-travel" data-src="<?//=DIR?>assets/img/mobile/img-destination-video-580-400.jpg">-->
                <?= str_replace(['<p>','</p>'], '', $text_video[1])?>
            </a>
            <span class="space space-80"></span>
        </div>    
        <span class="space space-80"></span>
        
        <?
            $item_left = \app\modules\whoarewe\api\Catalog::cat(20);
            $item_right = \app\modules\whoarewe\api\Catalog::cat(11);
            $item_left_image_custom = [];  
            $item_left_tt = NULL;
            if(isset($item_left->model->photos)) {
               foreach ($item_left->model->photos as $image) {

                   if($image->type == 'custom'){
                       $item_left_image_custom = [
                           'image' => $image->image,
                           'description' => $image->description,
                           'caption' => $image->caption,
                       ];
                       $item_left_tt = explode('-', $item_left_image_custom['caption']);
                       break;
                   }
               } 
           }
           
           
           
           
           
           $item_right_image_custom = [];  
           $item_right_tt = NULL;
            if(isset($item_right->model->photos)) {
               foreach ($item_right->model->photos as $image) {

                   if($image->type == 'custom'){
                       $item_right_image_custom = [
                           'image' => $image->image,
                           'description' => $image->description,
                           'caption' => $image->caption,
                       ];
                       $item_right_tt = explode('-', $item_right_image_custom['caption']);
                       break;
                   }
               } 
           }
           
        ?>
        
        
        <div class="area-button-link area-2" style="background-image: url(<?= !empty($item_left_image_custom) ? $item_left_image_custom['image'] : '/assets/img/mobile/img-destination-579-267.jpg' ?>);">
            <a href="<?=DIR.$item_left->slug?>">
<!--                <img class="img-responsive" alt="amica-travel" data-src="<?//=DIR?>assets/img/mobile/img-destination-579-267.jpg">-->
<!--                <span class="background-fill"></span>-->
<!--                <p class="tt-title tt-fontsize-32 tt-uppercase tt-latolatin-bold tt-color-white tt-custom">Notre demarche <br>du voyage solidaire</p>-->
                <p class="tt-title tt-fontsize-32 tt-uppercase tt-latolatin-bold tt-color-white tt-custom"><?= isset($item_left_tt[0]) ? $item_left_tt[0] : 'notre démarche' ?><br><?= isset($item_left_tt[1]) ? $item_left_tt[1] : 'du voyage solidaire' ?></p>
                    
            </a>
        </div>
        <span class="space space-80 space-xoayngang"></span>
        <div class="area-button-link area-3" style="background-image: url(<?= !empty($item_right_image_custom) ? $item_right_image_custom['image'] : '/assets/img/mobile/img-destination-579-267-2.jpg' ?>);">
            <a href="<?=DIR.$item_right->slug?>">
<!--                <img class="img-responsive" alt="amica-travel" data-src="<?//=DIR?>assets/img/mobile/img-destination-579-267-2.jpg">-->
<!--                <span class="background-fill"></span>-->
<!--                <p class="tt-title tt-fontsize-32 tt-uppercase tt-latolatin-bold tt-color-white tt-custom">Ils nous ont fait confiance</p>-->
                <p class="tt-title tt-fontsize-32 tt-uppercase tt-latolatin-bold tt-color-white tt-custom"><?= isset($item_right_tt[0]) ? $item_right_tt[0] : '' ?><br><?= isset($item_right_tt[1]) ? $item_right_tt[1] : 'fait confiance' ?></p>
                    
            </a>
        </div>
        <span class="space space-80"></span>
    </div>
    <!-- End History -->
    
</div>  
<!--<div data-role="popup" id="popupVideo" data-overlay-theme="a" data-theme="d" data-tolerance="15,15" class="ui-content">
    <?//= str_replace(['<p>','</p>'], '', $text_video[1])?>
      <iframe data-src="https://www.youtube.com/embed/b9orgCwGUoU" width="497" height="298" seamless></iframe>  
</div>-->
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