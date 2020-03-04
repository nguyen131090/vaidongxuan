<div class="menu-slider swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide <?= !SEG2 ? 'active' : '' ?>" data-index="0"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_country">Voyage au <?=ucfirst(SEG1)?></a></div>
        <div class="swiper-slide <?= SEG2 == 'itineraire' ? 'active' : '' ?>" data-index="1"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></div>
        <? if(SEG1 != 'birmanie'){?>
        <div class="swiper-slide <?= SEG2 == 'formules' ? 'active' : '' ?>" data-index="2"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></div>
        <? } ?>
        <div  class="swiper-slide <?= SEG2 == 'visiter' || Yii::$app->controller->action->id ==  'nos-destinations-detaile' ? 'active' : '' || Yii::$app->controller->action->id ==  'nos-destinations-envies' ? 'active' : '' ?>" data-index="3"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></div>

        <div class="swiper-slide <?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>" data-index="4"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></div>

        <div class="swiper-slide <?= SEG2 == 'guide' ? 'active' : '' ?>" data-index="5"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></div>
    </div>
    <div class="button-slider menu-swiper-button-prev swiper-button-prev"></div>
    <div class="button-slider menu-swiper-button-next swiper-button-next"></div>
<!--    <div class="swiper-scrollbar"></div>-->
</div>
 <?php $this->registerCssFile('/assets/css/mobile/menu-all-page-destinations.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<? 
$uri = '/'.URI;

$js = <<< JS

$(function() {

$(window).on('scroll', function() {
        if($(window).scrollTop() > 30){
        $('.menu-slider').addClass('fixed-header');
        }
        else{
        $('.menu-slider').removeClass('fixed-header');
        }
    });           

var index = $('.menu-slider .swiper-slide.active').data('index');      
var menuSwiper = new Swiper('.menu-slider', {
//        scrollbar: '.swiper-scrollbar',
//        scrollbarHide: false,
//        nextButton: '.menu-swiper-button-next',
//        prevButton: '.menu-swiper-button-prev',
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 30,
        grabCursor: true,
        initialSlide: index,
//        scrollbar: {
//            el: '.swiper-scrollbar',
//            draggable: true,
//        }        
        navigation: {
            nextEl: '.menu-swiper-button-next',
            prevEl: '.menu-swiper-button-prev',
          },
    }); 
  
        
});
        
$(window).on('orientationchange resize', function(event) {

    window.setTimeout(function() {
    $(function() {
        var indexx = $('.menu-slider .swiper-slide.active').data('index');   

        var menuSwiper = new Swiper('.menu-slider', {
            scrollbar: '.swiper-scrollbar',
            scrollbarHide: false,
            slidesPerView: 'auto',
            centeredSlides: false,
            spaceBetween: 30,
            grabCursor: true,
            initialSlide: indexx,

        }); 


    });
           
    }, 500);   
  
        
});               
        
//$(window).bind('load',function(){
//     // var w = $(".menu-slider .swiper-wrapper").outerWidth();
//     //   alert(w);
//   // var left = 0 - $('.menu-slider .swiper-wrapper .swiper-slide.active').offset().left;
//   // $(".menu-slider .swiper-wrapper").css({'transform' : 'translate3d(' + (left) + 'px, 0px, 0px)'});
//  //  $(".menu-slider .swiper-scrollbar-drag").css({'transform' : 'translate3d(100%, 0px, 0px)'});    
//    //  alert(left);
//        
//});
        
    
    
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>