<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/nos-bureaux-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>




<div class="contain container-1">
    <div class="row-content">
        <span class="space space-50"></span>
        <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-000000 tt-custom"><?= $theEntry->model->seo->h1?></h1>
        <span class="space space-40"></span>
       <div class="galeries-slider bullet-dynamic">
                <div class="swiper-wrapper">
                    <? if(!empty($theEntry->photosArray['galery'])) {
                            foreach ($theEntry->photosArray['galery'] as $key => $v) : ?>
                    <div class="swiper-slide">
                        <img alt="<?= $v->description?>"
                                    data-src="<?=$v->image?>" 
                                    data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                    data-sizes="auto"
                                    class="img-responsive lazyload" />
                        <span class="fil-background"></span>
                        <div class="text">
                            <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-align-center tt-sub-custom"><?= $v->model->caption?></p>
                        </div>
                    </div>
                <? endforeach;
                    }else{ ?>
                     <div class="swiper-slide">
                         <img class="img-responsive" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination.jpg"/>
                        <span class="fil-background"></span>
                        <div class="text">
                            <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-align-center tt-sub-custom">Dan le rue Hanoi</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img class="img-responsive" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination.jpg"/>
                        <span class="fil-background"></span>
                        <div class="text">
                            <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-align-center tt-sub-custom">Dan le rue Hanoi</p>
                        </div>
                    </div>
                    <? } ?>
                </div>
                <div class="swiper-pagination swiper-pagination-office"></div>
        </div>
    </div>
</div>    
<div class="contain container-2 tt-latolatin-regular tt-fontsize-28">
    <div class="column contain-background-ededed">
        <span class="space space-50"></span>
        <ul>
            <li class="address"><span><?= $theEntry->data->adresse?></span></li>
            <span class="space space-20"></span>
            <li class="tel"><span><?= $theEntry->data->tel?></span></li>
            <span class="space space-20"></span>
            <li class="cal"><span><?= str_replace('|', '<br>', $theEntry->data->time)?></span></li>
        </ul>
        <span class="space space-50"></span>
    </div>
</div>    
<div class="contain container-3">
    <div class="column">
      <span class="space space-50"></span> 
     <iframe id="get-map" class="lazyload" width="" height="" frameborder="0" style="border:0" data-src="https://www.google.com/maps/embed/v1/place?q=<?= $theEntry->data->googlemap ?>&key=AIzaSyC_ywNEeFiqs9YVlH9WhpSBa7GfyAk1LI8" allowfullscreen></iframe> 
    <span class="space space-30"></span>
    </div>
</div>  
<div class="contain container-5">
    <div class="column">
     <?= $theEntry->model->description?>
    </div>
</div>  
<div class="contain container-4">
    <div class="column">
        
        <span class="space space-60"></span>
        
        <div class="rows row-2">
            <!-- Option Envies -->
            <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-000000 tt-custom tt-responsive">Découvrir nos bureaux à :</h2>
           <span class="space space-40"></span>
            <div class="exclusive-slider">
                    <div class="swiper-wrapper">

                        <?
                        $cnt = 0;
                        foreach ($otherOffice as $value) {
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

                                    <h3 class="tt-title tt-fontsize-32 tt-latolatin-bold tt-color-black tt-custom"><?= $value->model->sub_title ?></h3>
                                </a>
                            </div>

                        <?


                        } ?>


                    </div>
                </div>
            <span class="space space-80"></span>
            

           <!-- End Option Envies --> 
        </div>
        
    </div>
</div> 



<? 
$uri = '/'.URI;

$js = <<< JS
$(function() {
var galeriesSlider = new Swiper('.galeries-slider', {
        slidesPerView: 2,
        paginationClickable: true,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
        breakpoints: {
            567: {
              slidesPerView: 1
            },
           
          }
    });  
    var exclusiveSwiper = new Swiper('.exclusive-slider', {
        slidesPerView: 2.1,
        paginationClickable: true,
        spaceBetween: 20,
        loop: true,
        breakpoints: {
            567: {
              slidesPerView: 1.1
            },
           
        }
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