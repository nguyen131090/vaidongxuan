<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/decouvrez-le-pays.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain no-padding container-2 container-filter">
    <div class="column">
       

        
        
        
        <div class="area-filter fix-banner-top">
            <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
               
                <img class="image-banner img-responsive lazyload" alt="<?= $banner->description; ?>" data-sizes="auto" data-src='<?= $banner->image ?>' data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>">
                
            <?php }else{ ?>
                <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
            <?php } ?>    
            
            
            
            <span class="fil-background"></span>
             <? if($theEntry->model->seo != NULL){ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
                
        </div>
    </div>
    
       
</div>
<div class="contain container-3 tt-latolatin-regular tt-fontsize-32">
    <div class="column">
        <?php
            $content = explode('<hr />', $theEntry->model->content);
        ?>
        <span class="space space-80"></span>
        <div class="rows row-1">
                <?= str_replace('<h2', '<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom"', preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $content[0], -1 ))?>
        </div>
        <span class="space space-50"></span>
        <div class="rows row-2">
             <?= str_replace(['<h5>','</h5>','<h3>'], ['<p>','</p>','<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom">'], preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $content[1], -1 ))?>
        </div> 
        <span class="space space-30"></span>
    </div>
</div>    
<div class="contain container-4 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        <div class="roww row-1">
            <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom"><?= $theReport->title?></h2>
            <span class="space space-20"></span>
            <?= preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $theReport->model->content, -1 )?>
        </div>    
        <span class="space space-30"></span>
        <div class="rows row-2">
            
            <div class="exclusive-slider">
                    <div class="swiper-wrapper">

                        <?
                        $cnt = 0;
                        foreach ($theEntries_m as $value) {
                            $cnt++;



                                $image_banner = null;
                                if(isset($value->photos) && !empty($value->photos)){
                                    foreach ($value->photos as $img) {

                                        if($img->model->type == 'summary'){
                                            $image_banner = [
                                                'image'=>$img->image,
                                                'description' => $img->description,
                                                'caption' => $img->description,
                                            ];
                                            break;
                                        }
                                    }
                                }


                            ?>
                           <div class="swiper-slide item-slide item-slide-<?= $cnt ?>">
                                <a href="<?=DIR.$value->slug?>">
                                    <?if(!empty($image_banner)){?>
    <!--                                   <img height="" alt="<?//= $image_banner['description']?>" data-src="<?//=$image_banner['image']?>">-->
                                        <img
                                            alt="<?= $image_banner['description']?>"
                                            data-src="<?=$image_banner['image']?>" 
                                            data-srcset="/thumb/600/400/1/80<?=$image_banner['image']?> 450w, /thumb/900/0/1/80<?=$image_banner['image']?>"
                                            data-sizes="auto"
                                            class="banner-img lazyload" />
                                    <?}else{?>
                                       <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>

                                    <?}?>    

                                    <p class="tt-title tt-fontsize-32 tt-latolatin-bold tt-color-black tt-custom"><?= $value->title ?></p>
                                </a>
                            </div>

                        <?


                        } ?>


                    </div>
                </div>
            
        </div>
        <span class="space space-50"></span>
        <a data-ajax="false" class="amc-btn-link tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom" href="<?=DIR?>explorateurs/reportages">Voir tous les reportages</a>
        <span class="space space-50"></span>
        
    </div>
</div>    

<div class="contain container-5 tt-latolatin-regular tt-fontsize-32">
    <div class="column">
        <span class="space space-50"></span>
        
        <?= str_replace(['<h5', '</h5>' ,'<h2'], ['<p','</p>','<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom"'], preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $content[2], -1 ))?>
        
    </div>
</div>  
<div class="contain container-6">
    <div class="column">
        <span class="space space-50"></span>
                <div class="galeries-slider">
                        <div class="swiper-wrapper">
                            <? foreach ($theEntry->photosArray['galery'] as $k=>$v) : ?>
                            <div class="swiper-slide">
                                <img alt="<?= $v->description ?>"
                                            data-src="<?=$v->image;?>" 
                                            data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                            data-sizes="auto"
                                            class="img-responsive lazyload" />
                                <span class="fil-background"></span>
                                <div class="text">
                                    <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-align-center tt-sub-custom"><?= $v->model->caption?></p>
                                </div>
                            </div>
                        <? endforeach; ?>
                        </div>
                </div>

    <span class="space space-50"></span>    
    </div>
</div>
<div class="contain container-7 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>    
        <p class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom"><?= $theParent_Exclu->title?></p>
        <span class="space space-50"></span>
        
        
        <div class="exclusive-slider-suggest">
            <div class="swiper-wrapper">

                <?
                $cnt = 0;
                foreach ($theSix_Exclu as $value) {
                    $cnt++;



                        $image_banner = null;
                        if(isset($value->photos) && !empty($value->photos)){
                            foreach ($value->photos as $img) {

                                if($img->type == 'summary'){
                                    $image_banner = [
                                        'image'=>$img->image,
                                        'description' => $img->description,
                                        'caption' => $img->description,
                                    ];
                                }
                            }
                        }


                    ?>
                   <div class="swiper-slide item-slide item-slide-<?= $cnt ?>">
                        <a href="<?=DIR.$value->slug?>">
                            <?if(!empty($image_banner)){?>
<!--                                   <img height="" alt="<?//= $image_banner['description']?>" data-src="<?//=$image_banner['image']?>">-->
<!--                                <img
                                    alt="<?//= $image_banner['description']?>"
                                    data-src="<?//=$image_banner['image']?>" 
                                    data-srcset="/thumb/600/400/1/80<?//=$image_banner['image']?> 450w, /thumb/900/0/1/80<?//=$image_banner['image']?>"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />-->
                            <img alt="" class="banner-img lazyload" alt="<?= $image_banner['description'] ?>" data-src="/thumb/205/205/1/80/<?= $image_banner['image'] ?>" class=""/>
                            <?}else{?>
                               <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>

                            <?}?>    

                            <p class="tt-title tt-fontsize-32 tt-latolatin-bold tt-align-center tt-color-black tt-custom"><?= $value->title ?></p>
                        </a>
                    </div>

                <?


                } ?>


            </div>
        </div>
        <span class="space space-50"></span>    
        <a data-ajax="false" class="amc-btn-link tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom" href="<?=DIR?>formules/itineraire">Voir toutes nos formules</a>
        <span class="space space-50"></span>    
    </div>
</div>  
<span class="space space-80"></span>    

<? 
$uri = '/'.URI;

$js = <<< JS
$(function() {
var galeriesSlider = new Swiper('.galeries-slider', {
        slidesPerView: 1.1,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });  
    var testiSwiper = new Swiper('.exclusive-slider', {
        
        slidesPerView: 2.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        initialSlide: 0,
        loop: false,
        breakpoints: {
            568: {
              slidesPerView: 1.1,
            },
        }
    });  
    var suggestSwiper = new Swiper('.exclusive-slider-suggest', {
        
        slidesPerView: 2.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        initialSlide: 0,
        loop: false,
    });  
 
    
        
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
});
    // Jquery Fixed Menu 
 
//        var iScrollPos = 0;
//        var positionMenu = $('.tt-custom-btn-form').position();
//        
//         $(document).on('scrollstart', function(event) {
//            
//          $(document).on('scrollstop', function(event) {
//            if ($(document).scrollTop() > positionMenu.top) {
//                var iCurScrollPos = $(document).scrollTop();
//                
//                if (iCurScrollPos > iScrollPos) {
//                  //   $('.tt-custom-btn-form').addClass('fixed-bottom');
//                    
//                } else {
//                  //  $('.tt-custom-btn-form').addClass('fixed-bottom');
//                    
//                }
//                iScrollPos = iCurScrollPos;
//           
//            } else {
//              //  $('.tt-custom-btn-form').removeClass('fixed-bottom');
//                
//            }
//          }); 
//
//    });
     
// End Fixed Menu
        
 
$(window).bind('load',function(){
    var iScrollPos = 0;
var positionMenu = $('.tt-custom-btn-form').position();

$(document).on('scrollstart', function(event) {
  
  $(document).on('scroll scrollstop', function(event) {
    
    if ($(document).scrollTop() > positionMenu.top + 100) {
        var iCurScrollPos = $(document).scrollTop();

        if (iCurScrollPos > iScrollPos) {
            
            
            $('.tt-custom-btn-form').removeClass('fixed-bottom');
            $('.fix-height').removeClass('active');

        } else {
           
            $('.tt-custom-btn-form').addClass('fixed-bottom');

            $('.fix-height').addClass('active');
        }
        iScrollPos = iCurScrollPos;

    } else {
        
        $('.tt-custom-btn-form').removeClass('fixed-bottom');
        $('.fix-height').removeClass('active')
    }
  });
});

        
//        $('a').filter(function(e){
//        return $(this).attr('href').match(/\.(pdf|doc|docx|ppt|pptx|xls|slxs|epub|odp|ods|txt|rtf)$/i);
//      }).css('color', 'red')
});



 $('.btn-form').click(function(){
    $('.area-form').show();
    $(this).removeClass('fixed-bottom');    
    $('.non-area-form').hide();
    $('.row-footer').hide();    
   // $('div.row-footer, .btn-bottom').removeClass('hidden');
    //$('#wrapper').removeClass('wrapper-mobile');
  
         $('html, body').animate({
            
            scrollTop: $('html').offset().top
            
        }, 0);
});      
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>