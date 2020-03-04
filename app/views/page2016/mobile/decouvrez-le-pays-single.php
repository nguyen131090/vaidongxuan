<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/decouvrez-le-pays-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>




<div class="contain container-1">
    <div class="row-content">
        <span class="space space-50"></span>
        <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925"><?= $this->context->pageT; ?></h1>
        <span class="space space-10"></span>
        <div class="entry-content tt-latolatin-regular tt-fontsize-32">
            <?= str_replace(['<br />','<h2',' src="'], ['<span class="fix-space-caption"></span>','<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom"',' data-src="'], $theEntry->model->description)?>
        </div>
        <span class="space space-60"></span>
    </div>
</div>    
<div class="contain container-7">
    <div class="column">
        
        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom">Reportages récents</h2>
        <span class="space space-50"></span>
        
        
        <div class="exclusive-slider">
            <div class="swiper-wrapper">

                <?
                $cnt = 0;
                foreach ($theRand_thrre as $value) {
                    $cnt++;

//var_dump($value->photos);exit;

                        $image_banner = null;
                        if(isset($value->photos) && !empty($value->photos)){
                            foreach ($value->photos as $img) {
                              //  var_dump($img);exit;
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
                                    data-srcset="/thumb/600/400/1/80<?=$image_banner['image']?> 450w"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />
                            <?}else{?>
                               <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>

                            <?}?>    

                            <h3 class="tt-title tt-fontsize-32 tt-latolatin-bold tt-align-left tt-color-black tt-custom"><?= $value->title ?></h3>
                        </a>
                    </div>

                <?


                } ?>


            </div>
        </div>

        <span class="space space-60"></span>    
    </div>
</div>  


<?php
    include(dirname(__FILE__).'/_inc_back_button.php');
?>

<? 
$uri = '/'.URI;

$js = <<< JS
        
$(window).bind('load',function(){
    $('.entry-content img').parent().css({'text-align' : 'center'});
   });        
        
$(function() {
var galeriesSlider = new Swiper('.galeries-slider', {
        slidesPerView: 2,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
         nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    });  
    var testiSwiper = new Swiper('.exclusive-slider', {
        
        slidesPerView: 'auto',
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        initialSlide: 0,
        loop: false,
        
        onReachBeginning: function(swiper){
        //console.log(swiper.slides.length);    
            swiper.params.centeredSlides = false;
            swiper.params.initialSlide = 0;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.params.initialSlide = 0;
            swiper.update();
        },
        onReachEnd: function(swiper){
      //  console.log(swiper.activeIndex);    
            swiper.params.centeredSlides = false;
            swiper.params.initialSlide = swiper.slides.length - 1;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },


       
//        onSlideChangeEnd: function (swiper) {
//          
//     
//         if (swiper.activeIndex == 1 ) {
//           
//                    swiper.params.slidesPerView = 'auto';
//                    swiper.params.centeredSlides = true;
//                    swiper.params.paginationClickable = true;
//                    swiper.params.spaceBetween = 20;
//                    swiper.params.initialSlide = 1;
//                    swiper.params.loop = false;
//                    swiper.init();
//                    
//                    
//            }
//        if (swiper.activeIndex == 0 ) {
//                    
//                    swiper.params.slidesPerView = 'auto';
//                    swiper.params.centeredSlides = false;
//                    swiper.params.paginationClickable = true;
//                    swiper.params.spaceBetween = 20;
//                    swiper.params.initialSlide = 0;
//                    swiper.params.loop = false;
//                    swiper.init();
//                    
//            }
//          if (swiper.activeIndex == 2 ) {
//                    swiper.params.slidesPerView = 'auto';
//                    swiper.params.centeredSlides = false;
//                    swiper.params.paginationClickable = true;
//                    swiper.params.spaceBetween = 20;
//                    swiper.params.initialSlide = swiper.slides.length - 1;
//                    swiper.params.loop = false;
//                    swiper.init();
//                //$(".exclusive-slider .swiper-wrapper").css({'transform' : 'translate3d(-412px, 0px, 0px)'});   
//                    
//            }  
//            
//            
//        },
        
       
        
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