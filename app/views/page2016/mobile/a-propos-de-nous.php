<?php
use yii\helpers\Markdown;
 $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/a-propos-de-nous.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>




<div class="contain container-1">
    <div class="row-content">
        <span class="space space-50"></span>
        <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-000000 tt-custom"><?= $this->context->pageT; ?></h1>
        <span class="space space-40"></span>
       
        
    </div>
</div>  
<div class="contain container-2">
    <div class="row-content">
        
        <div class="row-1">
            <?
               $content = str_replace(['class="col col-','src="'], ['class="amc-col amc-col-','data-src="'], $mot_du_fondateur['content']);
               preg_match_all('%(<p[^>]*>.*?</p>)%i', $content, $sub);
               
            ?>
            <div class="two-col sub-content">
                <div class="amc-col amc-col-2">
                    <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-align-left tt-color-black tt-custom"><?= $mot_du_fondateur['title'] ?></h2>
               <?
               echo $sub[0][0];
               echo str_replace('</p>','<span class="full-show" data-control="full-content"> Lire la suite</span></p>',$sub[0][1]);
              // echo $sub_content[1] . '</p>';
              // echo isset($sub_content[2]) ? $sub_content[2] . '<span class="full-show" data-control="full-content"> Lire la suite</span></p>' : '' ;
               ?>
                </div>
                <?= explode('</div>', $content)[0] . '</div>' ?>
            </div>
            <div class="two-col full-content">
                <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-align-left tt-color-black tt-custom"><?= $mot_du_fondateur['title'] ?></h2>
                <?= $content ?>
            </div>
        </div>
       
       
        <span class="space space-80"></span>
        <div class="all-tour ajaxfilter">
            <div class="getcontent">
               
            <?php
                  $cnt = 0;
                foreach ($theMenu as $v) {
                    $cnt++;
                    
                   if($cnt <= 4){
            ?>
            
                
            <div class="item item-<?= $cnt ?>">
                <div class="amc-col col-left">
                    
                    <a href="<?= DIR.$v->slug ?>">
                        
                        <?php
                            $title_sum = Null;
                            if(isset($v->photos) && !empty($v->photos)) {
                                
                                foreach ($v->photos as $value) {
                                    
                                    if ($value->type == 'summary') {
                                        $title_sum = $value->description;
                                        ?>
                                        
                                        <img
                                        alt="<?= $value->description ?>"
                                        data-src="<?= $value->image ?>" 
                                        data-srcset="/thumb/600/400/1/80<?= $value->image ?> 450w, /thumb/600/0/1/80<?= $value->image ?>"
                                        data-sizes="auto"
                                        class="banner-img lazyload" />
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <img alt="" class="img-responsive" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                        <?php } ?>

                        <span class="fil-background"></span>
                        
                    </a>
                </div>
                <div class="amc-col col-right">
                    
                     <div class="title">
                        <a href="<?= DIR.$v->slug ?>">  
                        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-align-center tt-color-white tt-custom"><?= $v->sub_title == '' ? $v->title : $v->sub_title ?></h2>
                       </a>
                    </div>
                    
                </div>
            </div>
            <? if($cnt < count($theMenu)){ ?>
            <span class="space space-50 <?= ($cnt % 2) != 0 ? 'space-horizontal' : ''?>"></span>
            <? } ?>
            
            <? 
                }
            } 
            ?>
            
            
            
            
            
            </div>
            
        
        </div>
        
        
    </div>
</div>    
 
<div class="contain container-3">
    <div class="row-content">
        <?php
            $cnt = 0;
          foreach ($theMenu as $v) {
              $cnt++;

             if($cnt > 4){
       ?>
        <div class="item item-<?= $cnt ?>">
            <div class="amc-col col-left">
                    
                <a href="<?= DIR.$v->slug ?>">

                    <?php
                    $title_sum = Null;
                        if(isset($v->photos) && !empty($v->photos)) {

                            foreach ($v->photos as $value) {

                                if ($value->type == 'summary') {
                                    $title_sum = $value->description;
                                    ?>
                                    
                                    <img
                                        alt="<?= $value->description ?>"
                                        data-src="<?= $value->image ?>" 
                                        data-srcset="/thumb/212/212/1/80<?= $value->image ?> 450w, /thumb/212/212/1/80<?= $value->image ?>"
                                        data-sizes="auto"
                                        class="banner-img lazyload" />
                                    
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <img alt="" class="img-responsive" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                    <?php } ?>

                    

                </a>
            </div>
            <div class="amc-col col-right">

                 <div class="title">
                      
                     <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-align-left tt-color-black tt-custom"><a class="tt-line-height-1-2" href="<?= DIR.$v->slug ?>"><?= $v->sub_title ?></a></h2>
                    
                </div>

            </div>
        </div>    
        <span class="space space-50"></span>
            
        <? }
        }
        ?>
        
        
    </div>
</div>    

<div class="contain container-4 contain-background-ededed container-video-ytb">
    <div class="column">
        <h2 class="mt-txt-80 tt mb-txt-50"><?=strip_tags(Markdown::process($video->title), '<strong>'); ?></h2>
        <p class="summary mt-0 mb-0"><?=$video->model->summary; ?></p>
        <span class="space space-50"></span>
        <div class="videoWrapper">
        <iframe class="videotype videoytb my-0 w-100" scrolling="no" data-src="<?=$video->model->sub_title; ?>" autoplay allowfullscreen="allowfullscreen"  frameborder="0"></iframe>
        </div>
        <span class="space space-50"></span>
    </div>
</div>
<div class="row-content excl-container">
        <img class="w-100 focus-center my-0" data-src="/assets/img/mobile/bg-chez-qsn.jpg">
        <div class="contain block-excl">
        <h2 class="tt  mt-txt-50 mb-txt-50">Chez l’habitant <span>en Indochine</span></h2>
            <p class="mt-0 mb-txt-50 summary"><?=$entryChez->model->summary;?></p>
            <a class="btn-excl btn-amica-basic-1 btn-amica-basic float-righ mt-0" href="<?=DIR.$entryChez->slug;?>">Découvrez nos hôtes</a>
        </div>
</div> 
<div class="contain raisons mt-80">
    <h3 class="tt">Pourquoi choisir Amica Travel ?</h3>
    <div class="raisons-slider">
            <div class="swiper-wrapper">
                <? foreach ($theRaisons_list as $k => $v) : ?>
                <div class="swiper-slide">
                        <?php
                                
                        if(!empty($v->photos)){
                            $j = 0;
                            foreach ($v->photos as $value) {
                                $j++;
                                if($value->model->type == 'summary'){
                     ?>
                            <img class="img-lazy" alt="<?= $value->model->description?>" data-src='<?=DIR?>timthumb.php?src=<?= $value->model->image?>&w=165&h=165&zc=1'>
                                <?php
                                        }
                                    }
                                 }else{
                               ?>
                            <img alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img-qui-sommes-nous-2.png">
                         <?php } ?>
                    
                        <div class="info-testi">
                        <?php
                        
                        if($v->model->sub_title != ''){
                            $tt = explode('-', $v->model->sub_title);
                             echo '<p class="tt-1">'.$tt[0].'</p>';
                             echo '<p class="tt-2">'.ucfirst(trim($tt[1])).'</p>';
                        }
                     ?>
                        </div>
                </div>
                <? endforeach; ?>
            </div>
            <div class="swiper-pagination">
            </div>
        </div>
</div>
<div class="contain container-6 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        <p class="tt-custom">Pour aller plus loin</p>
        <span class="space space-50"></span>
        <a href="/explorateurs" class="btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925 ui-link" data-ajax="false"><span>Parcourez le pays avec ceux qui y sont nés</span></a>
        <span class="space space-50"></span>
        <a href="/voyage" class="btn-link btn-link-2 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925"><span>Bougez selon votre humeur du moment</span></a>
        <span class="space space-80"></span>
    </div>
</div>
<? 
$uri = '/'.URI;

$js = <<< JS
$(function() {
    var raisonsSwiper = new Swiper('.raisons-slider', {
    pagination: '.swiper-pagination',
        slidesPerView: 2.1,
        slidesPerGroup: 2,
        paginationClickable: true,
        spaceBetween: 20,
        lazyLoading: true,
        loop: false
    }); 
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
        
 
//$(window).bind('load',function(){
//    var iScrollPos = 0;
//var positionMenu = $('.tt-custom-btn-form').position();
//
//$(document).on('scrollstart', function(event) {
//  
//  $(document).on('scroll scrollstop', function(event) {
//    
//    if ($(document).scrollTop() > positionMenu.top + 100) {
//        var iCurScrollPos = $(document).scrollTop();
//
//        if (iCurScrollPos > iScrollPos) {
//            
//            
//            $('.tt-custom-btn-form').removeClass('fixed-bottom');
//            $('.fix-height').removeClass('active');
//
//        } else {
//           
//            $('.tt-custom-btn-form').addClass('fixed-bottom');
//
//            $('.fix-height').addClass('active');
//        }
//        iScrollPos = iCurScrollPos;
//
//    } else {
//        
//        $('.tt-custom-btn-form').removeClass('fixed-bottom');
//        $('.fix-height').removeClass('active')
//    }
//  });
//});

        
//        $('a').filter(function(e){
//        return $(this).attr('href').match(/\.(pdf|doc|docx|ppt|pptx|xls|slxs|epub|odp|ods|txt|rtf)$/i);
//      }).css('color', 'red')
//});



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
 
$(window).bind('load',function(){
    $('.full-content .amc-col-2 p:last-of-type').append('<span class="sub-show" data-control="sub-content"> Réduire</span>');
});   
        
$('.full-show').click(function(){
    var control = $(this).data('control');
    $('.sub-content').addClass('hide');
    $('.sub-content').removeClass('active');    
    $('.' + control).addClass('active');   
    $('.' + control).removeClass('hide'); 
});  

$(document).on('click', '.sub-show', function(event) {
     var control = $(this).data('control');
    $('.full-content').addClass('hide');
    $('.full-content').removeClass('active');    
    $('.' + control).addClass('active');   
    $('.' + control).removeClass('hide');
});   
        
     
        
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>