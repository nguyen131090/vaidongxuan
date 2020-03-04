
<? use yii\widgets\Pjax; 
    use yii\helpers\Html;
?>
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/mobile/associations-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-3">
    <div class="column">
        <span class="space space-50"></span>
        <div class="amc-rr r1">
             
            
            <?php
               $img = false;
                if(!empty($theEntry->photos) && $theEntry->photos != ''){

                    foreach ($theEntry->photos as $v) {

                        if($v->model->type == 'icon'){
                            $img = true;
             ?>
            <div class="icon-logo <?= $img == false ? 'hide' : '' ?>">
                <img style="" class="img-left" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
            </div>
            <?php
                    break;
            
                    }
                }

             }

           ?>
           
          
           <div class="amc-text-title">
               <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-black"><?= $this->context->pageT; ?></h1>
               
           </div>
        </div>
        <? if($theEntry->model->sub_title != ''){ ?>
        <span class="space <?= $img == false ? 'space-20' : 'space-40' ?>"></span>    
        <div class="amc-rr r2">
        
            <p class="tt-custom tt-fontsize-32 tt-latolatin-regular tt-sub-title"><?= $theEntry->model->sub_title?></p>
        </div>
        <? } ?>
        <span class="space space-40"></span>
        <ul class="amc-area-info-detail">
            <li class="tt-latolatin-bold tt-fontsize-32">Création <span class="tt-latolatin-regular"><?= $theEntry->data->date?></span></li>
            <li class="tt-latolatin-bold tt-fontsize-32">Adresse <span class="tt-latolatin-regular"><?= $theEntry->data->adresse?></span></li>
            <?php if($theEntry->data->website != ''){ ?>
            <li class="tt-latolatin-bold tt-fontsize-32">Site internet <span><a class="tt-latolatin-regular" href="<?= $theEntry->data->website?>" target="_blank" rel="noopener" >Voir le site</a></span></li>
            <?php } ?>
        </ul>
        <span class="space space-20"></span>
        <div class="amc-entry-body tt-latolatin-regular tt-fontsize-32">
            <?= str_replace(' src="', ' data-src="', $theEntry->model->description);?>
        </div>
        <? if(!empty($theEntry->photosArray['galery'])) { ?>
        <span class="space space-40"></span>
        <div class="area-gallery">
        <!-- Include Gallery Image -->
            <? include_once '_inc_gallery.php'; ?>
        <!-- End Include Gallery Image -->
        </div>
        <span class="space space-80"></span>
        <? } ?>
        <span class="space space-40"></span>
        
        <div class="area area-2 mt-25">
            <img class="img-responsive" data-src="<?= DIR?>assets/img/mobile/img_fontda_sg_new_btn.jpg">
            <p class="tt-area-2 tt-latolatin-bold tt-fontsize-32">Tourisme solidaire et<br>responsable par Amica</p>
            <a href="<?= DIR.'tourisme-solidaire' ?>" class="btn tt-latolatin-bold tt-fontsize-32">En savoir plus</a>
        </div>
        <span class="space space-80"></span>
        <div class="area area-1">
            <p class="tt-area-1">En collaboration avec...</p>
            <ul>
                <?php
                    foreach ($theEntries as $v) : ?>
                        <li><a href="<?=DIR.$v->slug?>">
                        <?php
                            $image = FALSE;
                              if(!empty($v->photos)){
                                  foreach ($v->photos as $value) {
                                      if($value->type == 'summary'){
                                          $image = TRUE;  
                                          echo '<img style="" alt="'.$value->description.'" class="" data-src="'.DIR.'thumb/40/40/1/80'.$value->image.'">';
                                      }
                                  }
                              }


                          ?>




                        <span><?=$v->title ?></span>
                    </a></li>
                    <? endforeach;?>

            </ul>


        </div>
        <span class="space space-80"></span>
    </div>
</div>   

 
<? 
$uri = '/'.URI;

$js = <<< JS
$(function() {

//var menuSwiper = new Swiper('.menu-slider', {
//        scrollbar: '.swiper-scrollbar',
//        scrollbarHide: false,
//        slidesPerView: 'auto',
//        centeredSlides: false,
//        spaceBetween: 30,
//        grabCursor: true,
//        initialSlide: 5,
//    });         
 
var galeriesSlider = new Swiper('.galeries-slider', {
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
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
 

});


 
     
    
   function delayremoveclass(text){
      setTimeout(function()
        {
           // text.removeClass('active');
           // text.parent().removeClass('active');
            //text.addClass('active');
            text.slideDown(500);
        }, 500);
};        
        
    $('.area-text-control').click(function(){
        var hClass = $(this).hasClass('active');
        $('.area-text-control').removeClass('active');
        $('.area-text-control').parent().children('.sub-article').removeClass('active');
        //$('.area-text-control').parent().children('.sub-article').slideUp(500);
        if(hClass){
            $(this).removeClass('active');
            $(this).parent().children('.sub-article').removeClass('active');
           // $(this).parent().children('.sub-article').slideUp(500);
        }else{
            $(this).addClass('active');
           // delayremoveclass($(this).parent().children('.sub-article'));
            $(this).parent().children('.sub-article').addClass('active');
           // $(this).parent().children('.sub-article').slideDown(500);
        }
        
        $('body, html').animate({
            scrollTop: $(this).offset().top - 70
        }, 0);
        
    });    
    
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>