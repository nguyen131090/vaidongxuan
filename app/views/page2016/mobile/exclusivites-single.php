<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/mobile/exclusivites-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<? 
use \yii\helpers\ArrayHelper;
$tourImages = $theEntry->photosArray; 
$fields = $theEntry->model->category->fields; 
$fields = ArrayHelper::map($fields, 'name', function($e){
    return $e;
});
?>
<div class="contain container-2 non-area-form ">
    <div class="column">
        <div class="row-content top-tour mb-80">
            <h1 class="title main-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925"><?= str_replace('|', '',$this->context->pageT)?></h1>
            <ul class="features-tour">
                <? 
               
                $w = 'width: 48%;';
                $f_right = 'float: right;';
                if(!empty($theEntry->data->rate)) { 
                $w = NULL;
                $f_right = NULL;
                ?>
                <li class="calendar tt-latolatin-bold">
                    <div class="rate-icon position-relative">
                        <img data-src="/assets/img/classement_new_1.png" alt="">
<!--                        <span class="number-rate"><?//=array_keys($fields['rate']->options, $theEntry->data->rate)[0] + 1?></span>-->
                    </div>
                    <p class="rate-title m-0"><?=isset($theEntry->data->rate) ? $theEntry->data->rate : '' ?></p>
                </li>
                <? } ?>
                <? if(isset($theEntry->data->city)) :?>
                <li class="posi countries" style="<?= $w ?>">
                        <img data-src="/assets/img/page2016/posi-big.png" alt="">
                        <span>
                        <? if(isset($theEntry->data->city)) : ?>
                                    <? $city  = json_decode($theEntry->data->city); ?>
                                    <? if($city) :?>
                                    <? foreach ($city as $key => $value){
                                        $title = $value->stitle ? $value->stitle : $value->title;
                                       if($value->status == 1){
                                        echo "<a  href='/".$value->slug."' data-analytics='on' data-analytics-category='secret_single' data-analytics-action='subintro_section' data-analytics-label='link_city' >".$title."</a>, ";
                                       } else{
                                            echo $title.', ';   
                                       } 
                                    } ?>
                                    <? else: ?>
                                    <? echo  $theEntry->data->city.', ';?>
                                    <? endif; ?>
                                <? endif; ?>
                                <a href="/<?=SEG1 ?>" data-analytics='on' data-analytics-category='secret_single' data-analytics-action='subintro_section' data-analytics-label='link_country'><?=ucfirst(SEG1)?></a>
                        </span>
                    </li>
                <? endif; ?>
                
                    <li class="tour-type tt-<?= $theEntry->cat->category_id ?> tt-latolatin-bold" style="<?= $w ?><?= $f_right ?>">
                        <? if($theEntry->cat->photosArray['icon-banner']) : 
                            $iconCat = $theEntry->cat->photosArray['icon-banner'][0];    
                            ?>
                        <img data-src="<?=$iconCat->image?>" alt="">
                        <? endif ?>
                         <a href="<?=DIR.SEG1.'/'.$theParent->slug?>" data-analytics='on' data-analytics-category='secret_single' data-analytics-action='subintro_section' data-analytics-label='link_secrets_inspi_itineraries'>
                            <?= $theParent->title?>
                        </a>
                </li>
            </ul>

            
            <!-- Include Gallery Image -->
            <? include_once '_inc_gallery.php'; ?>
            <!-- End Include Gallery Image -->
            
            <div class="no-margin text spirit tt-fontsize-32 tt-latolatin-regular">
                <?= $theEntry->model->spirit?>
            </div>
            <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-devis tt-latolatin-bold tt-fontsize-32 pugjd mb-0" data-analytics="on" data-analytics-category="secret_single" data-analytics-action="subintro_section" data-analytics-label="cta_devis">Contactez-nous pour plus de détails*</button>
        </div>
<? if(!empty($theEntry->data->hostdes)) : ?>
    <div class="row-content container-hostdes amc-column  mb-80">
        <p class="host-tt tt-latolatin-bold tt-fontsize-40 mt-50 mb-0 tt-line-height-1-2"><?=$fields['hostdes']->title;?></p>
        <div class="host-content">
            <?= $theEntry->data->hostdes;?>
        </div>
    </div>
<? endif; ?>
</div>
    
  <? include_once '_inc_video_page.php'; ?>  
    
</div>
        <div class="row-content tour-body mt-0">
            <?// if(!empty($theEntry->data->video)) : ?>
<!--                <div class="amc-column video-col container position-relative mt-80 mb-80">-->
                    <?// if(isset($theEntry->data->video)) : ?>
                        <?//=$theEntry->data->video ?>
                    <?// endif; ?>
<!--                </div>-->
            <?// endif; ?>
         <div class="container content-container amc-column py-40 position-relative mt-0">
            <div class="map">
                        <img alt="" data-src="<?=isset($theEntry->photosArray['map']) ? $theEntry->photosArray['map'][0]->image : ''?>"/>
                    </div>
            <div class="content-col entry-body entry-content">
            <?=$theEntry->description; ?>
            </div>
            
        </div> 
        <? if(!empty($theEntry->data->note)) : ?>
        <p class="container mt-80 mb-0"  align="center">
            <i class="tt-fontsize-28">
            <?=$theEntry->data->note ?>
            </i>
        </p>  
        <? endif; ?>
        
</div>

<? if($theProgram) : ?>
    <div class="item-tour-content pt-50  mt-txt-80 mb-txt-80" id="formules-options">
        <div class="amc-column">
            <p class="sub-title-page tt-latolatin-bold tt-fontsize-40 mt-0 amc-fix-mt-25-0 tt-line-height-1-2">Les voyages pouvant inclure cette formule</p>
            <div class="secret-slider">
                <div class="swiper-wrapper">
                    <? foreach ($theProgram as $key => $value) : ?>
                    <div class="swiper-slide">
                    <a href="/<?=$value->slug ?>">
                    <? if(isset($value->photosArray['banner'])) : 
                    $v = $value->photosArray['banner'][0]; ?>
                        <img alt="<?= $v->description?>"
                                data-src="<?=$v->image?>" 
                                data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                data-sizes="auto"
                                class="banner-img lazyload"  data-analytics="on" data-analytics-category="secret_single" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$value->model->item_id ?>"/>
                    <? endif; ?>
                    <p class="title tt-latolatin-bold tt-fontsize-32" data-analytics="on" data-analytics-category="secret_single" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?=$value->model->item_id ?>"><?= isset($value->model->title) ? str_replace('|','',$value->model->title) : ''?></p>
                        </a>
                    </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>        
    </div>
 
<? endif; ?>
    
        
<button class="btn-devis tt-latolatin-bold tt-fontsize-32 ui-link ui-footer-fixed" data-position='fixed' data-ajax="false">
    <span data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-bottom-form-call pugjd" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_devis">Contactez-nous pour plus de détails*</span>
    <a href="tel:+33619081572" class="btn-bottom-form-call btn-phone" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_call">Call</a>
</button>


<!-- load ajax for formules page -->
<div data-role="page" class="menu-page formules-page" id="formules-page" data-url="formules-page" data-theme="b">
</div>
<? 
$country = SEG1;
$uri = URI;
$url = DIR.URI;
$dir_uri = DIR.URI;
$js = <<< JS

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
var menuSwiper = new Swiper('.menu-slider', {
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 20,
        grabCursor: true,
        initialSlide: 0,
    }); 
$('.menu-swiper-button-next').click(function(){
    menuSwiper.slideNext();
});
$('.menu-swiper-button-prev').click(function(){
    menuSwiper.slidePrev();
});
$(window).bind("load", function(){
    $('#tour-detail .tab-children:first-of-type').addClass('active');
    $('#tour-detail .tab-children .entry-content').each(function(index){
        $('.notes #' + (index + 1) ).clone().appendTo(this);
    });
});  

// $('#tour-detail .tab-children .first-jour').click(function(){
//     // $('#tour-detail .tab-children').removeClass('active');
//     $(this).parent().toggleClass('active');
//     var top = $(this).offset().top - 80;
//     $('html, body').animate({
//         scrollTop: top
//     }, 200);

// })
var secretSwiper = new Swiper('.secret-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });

$('.menu-slider .swiper-slide span').off().click(function(){
    var id = '#'+$(this).data('scroll');
    var index = $(this).parent().index();
    var top = $(id).offset().top - 60;
    $('.menu-slider .swiper-slide').removeClass('active');
    $(this).parent().addClass('active');
    $('html, body').animate({
        scrollTop: top
    }, 200);
    menuSwiper.slideTo(index);
})

var curPage = $.mobile.activePage.attr("id");
var lastScrollTop = 0;
scrollMenu();
var tourContent = [];
function scrollMenu(){
    $(window).on('scroll', function() {
        var curPage = $.mobile.activePage.attr("id");
        var st = $(this).scrollTop();
        var menuTop = $('.tour-body').offset().top;
        if(curPage == 'page1'){

               if (st > lastScrollTop){
                   if(st > (menuTop + 20)){
                        $('.menu-content').addClass('ui-header-fixed').attr('data-position', 'fixed');
                    }
               } 
                if(st < (menuTop + 20)){
                        $('.menu-content').removeClass('ui-header-fixed').attr('data-position', '');
                    } 
                    if(st > ($('.top-tour .btn-devis').offset().top + 20)){
                        $('.btn-devis.ui-footer-fixed').addClass('active');  
                    } else $('.btn-devis.ui-footer-fixed').removeClass('active');  
                }
                $('.item-tour-content').each(function(){
                    tourContent[$('.item-tour-content').index(this)] = $(this).offset().top + 20;
                })
                if(st < tourContent[1]) {
                    menuSwiper.slideTo(0);
                    $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(0)').addClass('active');
                } else if(st >= tourContent[1] && st < tourContent[2]) {
                   menuSwiper.slideTo(1);
                   $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(1)').addClass('active');
                } else if(st >= tourContent[2] && st < tourContent[3]){
                    menuSwiper.slideTo(2);
                    $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(2)').addClass('active');
                } else if(st >= tourContent[3] && st < tourContent[4]){
                    menuSwiper.slideTo(3);
                    $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(3)').addClass('active');
                } else if(st > tourContent[4]){
                    menuSwiper.slideTo(4);
                    $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(4)').addClass('active');
                }
        lastScrollTop = st;
    }); 
}

$(document).on("pagechange", function(toPage) {
    scrollMenu();
});

JS;
$this->registerJs($js); 
$css = <<<CSS
.content-col ul {
    padding-left: 0;
}
.content-col ul li {
    list-style: none;
    background: url(/assets/img/page2016/bg-list.png) left 7px no-repeat transparent;
    padding-left: 15px;
    margin-bottom: 0;
}
CSS;
$this->registerCss($css);
?>