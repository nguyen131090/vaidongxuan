
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?// $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-envies.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain no-padding container-2">
    <div class="column">
       

         <!-- Menu Ngang -->
        <? include '_inc_menu_all_page_destinations.php'; ?>
        <!-- End Menu Ngang -->
        
        
        <div class="area-filter fix-banner-top">
            <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
               
<!--                    <img class="image-banner" alt="<?//= $banner->description; ?>" data-src='<?//= $banner->image ?>'>-->
                <img alt="<?= $banner->description ?>" class="image-banner img-responsive lazyload" data-sizes= 'auto' data-src="<?= $banner->image; ?>" data-srcset='/thumb/640/440/1/80<?= $banner->image?> 450w, <?= $banner->image?>'>
               
            <?php }else{ ?>
                <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
            <?php } ?>    
            
            
            <span class="fil-background"></span>
            <p class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $titleBanner ?></p>
             <?// if($theEntry->model->seo != NULL){ ?>
<!--                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-uppercase tt-color-white tt-custom"><?//= $theEntry->model->seo->h1 ?></h1>-->
            <?// }else{ ?>
<!--                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-uppercase tt-color-white tt-custom"><?//= $theEntry->title ?></h1>-->
            <?// } ?>    
            <div class="fix-popup">   
                <div class="tt-custom-btn-filter">
                    <div class="options">
                        <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-list-active-custom"><?=$theEntry->title ?></span>
                        <ul class="list-options">
                            <? foreach(\app\modules\destinations\api\Catalog::cat(SEG1.'/envies')->items() as $kde => $vde) : ?>
                                <? if(URI != $vde->slug) {?>
                                <li data-option="" data-value="">
                                    
                                    <a href="<?=DIR.$vde->slug?>" class="tt-title tt-fontsize-32 <?= URI == $vde->slug ? 'tt-latolatin-bold' : 'tt-latolatin-regular' ?> tt-list-custom"><?=$vde->title ?></a>
                                   
                                </li>
                                 <? } ?>
                            <? endforeach ?>
                        </ul>
                    </div>    
                </div>
            </div>    
            
        </div>
    </div>
    
       
</div>
<div class="contain container-1">
    <div class="row-content">
        
        
        <span class="space space-70"></span>
        <div class="text-sumary">
             
            <h1 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom"><?= $this->context->pageT; ?></h1>
            
             <?=
             $theEntry->model->description;
           // isset($theEntry->model->contentsMobile) ? $theEntry->model->contentsMobile[0]['description'] : '';
           
            ?>
            <p>
                L’intérêt du voyage au Vietnam c’est que les combinaisons sont nombreuses. Vous avez à votre disposition une palette de sites, d’hébergements, d’activités pour y piocher au gré des envies.
            </p>
        </div>
        <span class="space space-70"></span>
        <?
        
           if (Yii::$app->request->get('see-more') == NULL) {
                if (Yii::$app->request->get('page') != NULL) {
                    $seemore = Yii::$app->request->get('page') * 4;
                }else{
                    $seemore = 4;
                }

            } else {
                $seemore = Yii::$app->request->get('see-more');
            }
            if (Yii::$app->request->get('page') == NULL) {
                $page = $pagesize / 4;
            } else {
                $page = Yii::$app->request->get('page');
            }

            if (Yii::$app->request->get('before-page') == NULL) {
                $page = $seemore / 4;
            } else {
                $page = Yii::$app->request->get('before-page');
            }
            
        ?>
        <div class="all-tour ajaxfilter">
            <div class="getcontent">
            <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                <div class="text-center see-more-prev mb-80 mt-0">
                    <span class="btn-see-more-prev tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white tt-custom ajax-see-more-prev" data-get="" data-seemore="<?= (($page + 1) * 12) ?>" data-value='' data-page="<?= $page - 1 ?>">Lieux précédents</span>
                </div>
            <? } ?>     
            <?php
                $cnt = 0;
                $count = count($envies);
                
                foreach ($envies as $v) {
                    
                $cnt ++;
                $class_xoayngang = NULL;
                
                if($cnt % 2 != 0){    
                   $class_xoayngang = 'space-horizontal'; 
                   echo '<div class="clearfix clear-fix">' ;
                }
            ?>
            
            <div class="item item-<?= $cnt ?>">
                
                <a href="<?= DIR.$v->slug ?>">
                    <?php
                        if(isset($v->photos) && !empty($v->photos)) {

                            foreach ($v->photos as $value) {

                                if ($value->model->type == 'summary') {
                                    ?>
                                    <img style="" class="img-lazy img-responsive" alt="<?= $value->model->description ?>" data-src="<?= $value->image ?>">
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <img alt="" class="img-responsive" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                    <?php } ?>
                    
                    <span class="fil-background"></span>
                    <div class="title">
                        <span class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-white tt-custom"><?= str_replace('|', '', $v->title) ?></span>
                        
                        <?if($v->model->sub_title != NULL){?>
                        <span class="space space-10"></span>
                        <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-custom-sub-tt"><?= $v->model->sub_title ?></p>
                        <? } ?>
                    </div>
                </a>
               
                
                
                
                
            </div>
            <? if($cnt < $count){ ?>
            <span class="space space-50 <?= $class_xoayngang ?>"></span>
            <? } ?>
            <?
                if($cnt % 2 == 0 || $count == $cnt){    
                   echo '</div>' ;
                }
            ?>
            <? } ?>
            
            <?
        
                if (Yii::$app->request->get('page') == NULL) {
                    $page = $pagesize / 12;
                } else {
                    $page = Yii::$app->request->get('page');
                }

            ?>
            
            <? if ($totalCount > $pagesize && ($totalCount / 12) > $page ){ ?>
            
            <div class="amc-area-detaile-number-items">
                <span class="space space-80"></span>        
                <? if($totalCount < 2){ ?>
                    <span class="amc-text">Vous avez vu le seul lieu <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
                <? }else{ ?>
                    <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> lieux sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
                <? } ?>
                <span class="space space-40"></span>
                <div class="amc-progress mt-txt-25">
                    <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
                </div>

            </div>    
            
                <span class="space space-50"></span>
                <div class="see-more">
                    <span class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="" data-seemore="<?= ($page + 1)*12 ?>" data-value="" data-page="<?= $page + 1 ?>">Plus de lieux</span>

                </div>
            <? } ?>
            
            
            </div>
            
        
        </div>
        
        <span class="space space-80"></span>
    </div>
</div>    
<? if($this->context->seoContent != NULL) : ?>
            <div id="text-content" class="iti">
                <span class="tt tt-seo">En savoir plus sur "<?= $theEntry->title?>"</span>
                <div class="text-sumary">
                <?php
                    $subtext = explode('</p>', $this->context->seoContent);
                    unset($subtext[count($subtext) - 1]);
                    
                   //echo $subtext[0]. ' <span class="view-more tt-color-e65925">Lire la suite</span></p>';
                    $cnt = 0;
                    foreach ($subtext as $sub) {
                        $cnt++;
                        if($cnt == 1 && $cnt == count($subtext)){
                            echo $sub. '</p>';
                        }else if($cnt == 1 && $cnt < count($subtext)){
                            echo $sub. ' </p><p class="view-more tt-color-e65925 mb-0">Lire la suite</p>';
                            echo '<div class="full-text" style="display: none;">';
                        }else if($cnt > 1 && $cnt < count($subtext)){
                            
                                echo $sub.'</p>';
                        }else if($cnt == count($subtext)){
                                echo $sub. '</p><p><span class="close-text tt-color-e65925">Réduire</span></p>';
                                echo '</div>';
                            
                            
                        }
                        
                    }
                ?></div>
            </div>
            <? endif; ?>

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
//        initialSlide: 1
//    }); 
var tourSwiper = new Swiper('.tour-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 2,
        slidesPerColumn: 2,
        paginationClickable: true,
        spaceBetween: 30,
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    });
var secretSwiper = new Swiper('.secrets-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 3,
        slidesPerColumn: 3,
        paginationClickable: true,
        spaceBetween: 30,
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    });
});
        
        // xu ly Ajax nut see-more
//        $(document).on("click", ".ajax-see-more", function(event){    
//           
//            var pr = $(this).data('get');
//            
//            var pagesize = $(this).data('value');
//            var url = window.location.pathname + '?' + pr;
//
//               $.ajax({
//                    type: "GET",
//                    url: window.location.pathname,
//                    data: pr,
//                    beforeSend: function() {
//                        $('.getcontent').append('<div class="backgroundwhite"></div>');
//                        $('.getcontent').css({'position':'relative'});
//                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
//                    },
//                    success: function(data){
//                       
//                    var datanew = $($.parseHTML(data)).find(".getcontent");
//                    $('.ajaxfilter').html(datanew);
//                    
//                     
//                    
//        
//                    },
//                    complete: function(data) {
//                       
//                    },
//               }); 
//                  
//        });
        
    // end ajax see-more
function delayremoveclass(text){
      setTimeout(function()
        {
            text.removeClass('active');
            text.parent().removeClass('active');
        }, 500);
};        
 $('.tt-custom-btn-filter .options .btn-filter').click(function(){
        var hClass = $(this).hasClass('active');
        if(hClass){
            var text = $(this).parent().parent();
            $(this).removeClass('active');
            
            delayremoveclass(text);
            //$(this).parent().parent().parent().removeClass('active');
            $(this).parent().children('.list-options').slideUp(500);
            $('html').removeClass('no-scroll-page');
            $('body').removeClass('no-scroll-page');
            
        }else{
            $(this).addClass('active');
            var windowheight = $(window).height();
            $(this).parent().parent().addClass('active');
            $(this).parent().parent().parent().addClass('active');
            $(this).parent().children('.list-options').css({'height' : windowheight - 67 + 'px' , 'overflow' : 'scroll'});
            $(this).parent().children('.list-options').slideDown(500);
            $('html').addClass('no-scroll-page');
            $('body').addClass('no-scroll-page');

        }
    
   });  
        
// Jquery lock scroll page

	var test = $('body').hasClass('no-scroll-page');	
    if(test){
        var defaultPrevent=function(e){e.preventDefault();};
        document.body.parentElement.addEventListener("touchstart", defaultPrevent);
        document.body.parentElement.addEventListener("touchmove" , defaultPrevent);
        document.body.addEventListener("touchstart", defaultPrevent);
        document.body.addEventListener("touchmove" , defaultPrevent);
        //target the entire page, and listen for touch events
        $('html, body').on('touchstart touchmove', function(e){ 
             //prevent native touch activity like scrolling
             e.preventDefault(); 
        });

    }

 

 
 // end
    
        
    $(window).on('orientationchange resize', function(event) {
        
        if(event.orientation == 'portrait') {
            var windowheightportrait = $(window).width();
           
            $('.tt-custom-btn-filter .options .btn-filter').parent().children('.list-options').css({'height' : windowheightportrait - 67 + 'px' , 'overflow' : 'scroll'});
            
        }
        else if(event.orientation == 'landscape') {
           
            var windowheightlandscape = $(window).width();
            
            $('.tt-custom-btn-filter .options .btn-filter').parent().children('.list-options').css({'height' : windowheightlandscape - 67 + 'px' , 'overflow' : 'scroll'});
        }
    });   
$('.text-sumary .view-more').click(function(){
        
        $('.full-text').show();
        $(this).hide();
   });    
        
    $('.text-sumary .close-text').click(function(){
        $('.view-more').show();
        $('.full-text').hide();
   });          
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>