<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/fondation-thongnong.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>




<div class="contain container-1">
    <div class="row-content">
        <span class="space space-50"></span>
        <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-align-center tt-custom">
         <?php if(SEG3 == 'thong-nong-vietnam'){ ?>
            <img class="logo-projets" alt=""  data-src="<?=DIR?>assets/img/page2016/logo_thongnong_new_66_64.png" />
            <?php } ?>
         <br>   
         <?= $this->context->pageT; ?>
        </h1>
        <span class="space space-50"></span>
        
    </div>
</div>    
<div class="container-info">
    <ul class="info-content">
               
            <li class="location"><span class="fix">Location</span><?= $theEntry_info->data->adresse?></li>
            <li class="year"><span class="fix">Début du projet</span><?= $theEntry_info->data->date?></li>
    </ul>
    <span class="space space-20"></span>
    
</div>
<div class="contain container-entry-body">
    <div class="row-content">
        <div class="content content-fix-color-link-e65925 tt-latolatin-regular tt-fontsize-32">
            <?= str_replace(' src="', ' data-src="', $theEntry->model->content) ?>
        </div>
    </div>
</div>    
<div class="contain container-2">
    <div class="column">
        <span class="space space-50"></span>
        <!-- Tour Voyage -->
        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold">Les voyages incluant <?= $location[$theEntry_info->data->location[0]]?></h2>
        <span class="space space-40"></span>
        <div class="secret-home item-tour-voyage">
            
            <div class="secrets-slider swiper-container full-width">
                <div class="swiper-wrapper">
                    <?
                $cnt = 0;
                foreach ($theList_tour as $value) {

                    $cnt++;
                    ?>
                        <div class="swiper-slide item-slide item-slide-<?= $cnt ?>">
                            
                            <a href="<?=DIR.$value->slug ?>">
                                 <?
                                 if(!empty($value->photos)){
                                    foreach ($value->photos as $img) {
                                        if($img->model->type == 'summary'){
                                            echo '<img style="" alt="'.$img->description.'" class="img-lazy img-responsive" data-src="'.$img->image.'">';
                                        }
                                    }
                                }else{?>
                                   <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination.jpg"/>
                                     
                                <?}?>    
<!--                                <span class="fil-background"></span>-->
<!--                                <div class="text">
                                    <h3 class="tt-title tt-fontsize-32 tt-latolatin-semibold tt-uppercase tt-color-white tt-custom"><?//=$value->title?></h3>
                                    <span class="space space-10"></span>
                                    <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-sub-custom"><?//=$value->sub_title?></p>
                                </div>-->
                                 <span class="space space-50"></span>
                                <h3 class="tt-title tt-fontsize-32 tt-latolatin-bold tt-custom"><?=$value->title?></h3>
                            </a>
                        </div>

                    <? } ?>
                    
                </div>
                
            </div>
            <!-- If we need navigation buttons -->
<!--                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>-->
        </div>
        <!-- End Tour Voyage -->
    </div>
    <span class="space space-60"></span>
</div>

<?php
    include(dirname(__FILE__).'/_inc_back_button.php');
?>
<? 
$uri = '/'.URI;

$js =<<<JS
$(function() {

//var menuSwiper = new Swiper('.menu-slider', {
//        scrollbar: '.swiper-scrollbar',
//        scrollbarHide: false,
//        slidesPerView: 'auto',
//        centeredSlides: false,
//        spaceBetween: 30,
//        grabCursor: true,
//        initialSlide: 1
//    });         
        
var secreSwiper = new Swiper('.secrets-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        //preventClicks: false,
//        breakpoints: {
//            
//            320: {
//            slidesPerView: 1,
//            spaceBetween: 10
//            },
//            414: {
//            slidesPerView: 1,
//            spaceBetween: 10
//            },
//            // when window width is <= 480px
//            480: {
//              slidesPerView: 2,
//              spaceBetween: 10
//            },
//            568: {
//              slidesPerView: 2,
//              spaceBetween: 10,
//              
//            },
//            // when window width is <= 640px
//            667: {
//              slidesPerView: 2,
//              spaceBetween: 10
//            },
//            736: {
//              slidesPerView: 2,
//              spaceBetween: 10
//            }
//        }
    });
        
        
    var testiSwiper = new Swiper('.exclusive-slider', {
        slidesPerView: 'auto',
        centeredSlides: true,
        paginationClickable: true,
        spaceBetween: 20,
        
        loop: true
         
    });       
});
        
         // xu ly Ajax nut see-more
        $(document).on("click", ".ajax-see-more", function(event){    
           
            var pr = $(this).data('get');
           // $('#getcontent').load("/vietnam/informations-pratiques?see-more=6 #ajaxseemore");
          //  $('#getcontent').load('$uri?' + pr + ' #getcontent'); 
            var pagesize = $(this).data('value');
            var url = window.location.pathname + '?' + pr;

               $.ajax({
                    type: "GET",
                    url: window.location.pathname,
                    data: pr,
                    beforeSend: function() {
                        $('.getcontent').append('<div class="backgroundwhite"></div>');
                        $('.getcontent').css({'position':'relative'});
                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                    },
                    success: function(data){
                       
                    var datanew = $($.parseHTML(data)).find(".getcontent");
                    $('.ajaxfilter').html(datanew);
                    
//                    $('.img-lazy').lazy({
//                        scrollDirection: 'vertical',
//                        effect: 'fadeIn',
//                        effectTime: 1000,
//                        visibleOnly: true,
//                        onError: function(element) {
//                            console.log('error loading ' + element.data('src'));
//                        }
//                    });  

                   
                   // fixHeightColumnsItems();     
                    },
                    complete: function(data) {
                       
                    },
               }); 
                  
        });
        
    // end ajax see-more
      $(window).on('orientationchange resize', function(event) {

        if(event.orientation == 'landscape') {
            
            $('.all-aticle').each(function(e){
                var maxheight = 0;
                var height = 0;
                $(this).children('li').each(function(index){

                    
                    height = $(this).children().children('.text').outerHeight();
                    
                    if(height > maxheight){
                        maxheight = height;
                    }
                   // alert(maxheight);
                  //  e.find('li a .text').css({'min-height' : maxheight + 'px'});
                });
                $(this).children('li').children('a').children('.text').css({'min-height' : maxheight + 'px'});

            });    
        }
     });   
    
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>