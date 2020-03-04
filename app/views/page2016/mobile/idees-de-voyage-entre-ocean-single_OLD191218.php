<? if(Yii::$app->request->isAjax) : ?>
    <? if($type == 'combien') : ?>
        <!-- start comment and combien page -->
        <? include('_comment-combien.php') ?>
        <!-- END -->

    <? endif; ?>
<? else : ?>   
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<? $tourImages = $theEntry->photosArray;  ?>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content top-tour">
            <h1 class="title main-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925"><?= str_replace('|', '',$this->context->pageT)?></h1>
            <p class="tt-s no-margin"><?= $theEntry->model->sub_title?></p>
            <ul class="features-tour">
                <? if(isset($theEntry->data->countries)) :?>
                    <li class="posi countries">
                         <img src="/assets/img/page2016/posi.png" alt="">
                         <span>
                         <?php
                            $i= 0;
                            if(is_array($theEntry->data->countries)){
                                foreach ($theEntry->data->countries as $value) {
                                    $i ++;
                                     echo '<a class="tt-latolatin-bold" href="'.DIR.$value.'">'.ucfirst($value).'</a>';
                                    if($i < count($theEntry->data->countries)){
                                        echo ', ';
                                    }
                                }
                            }else{
                               echo $theEntry->data->countries;
                            }
                        ?>
                        </span>
                    </li>
                <? endif; ?>
                <li class="tour-type tt-<?= $theEntry->cat->category_id?> tt-latolatin-bold">
                     <a class="tt-latolatin-bold" id="tour-type" href="<?=DIR.SEG1.'/'.SEG2.'/'.explode('/', $theEntry->cat->slug)[1]?>">
                        <? if(isset($theEntry->cat->photosArray['icon-banner'])) : 
                            $v = $theEntry->cat->photosArray['icon-banner'][0];
                            ?>
                        <img src="<?=$v->image ?>" alt="" />
                        <? endif; ?>
                            <?= $theEntry->cat->title?>
                        </a>
                </li>
            </ul>

            <div class="galeries-slider">
                <div class="swiper-wrapper">
                    <? if(!empty($tourImages['galery'])) :
                            foreach ($tourImages['galery'] as $key => $v) : ?>
                    <div class="swiper-slide">
                        <img alt="<?= $v->description?>"
                                    data-src="<?=$v->image?>" 
                                    data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />
                        <div  class="text-on-image">
                            <p align="center" class="no-margin tt-color-white tt-latolatin-regular tt-fontsize-28"><?=$v->model->caption ?></p>
                        </div>
                    </div>
                <? endforeach;
                endif; ?>
                </div>
                <div class="button-slider swiper-button-prev"></div>
                <div class="button-slider swiper-button-next"></div>
            </div>
            <div class="no-margin text spirit tt-fontsize-32 tt-latolatin-regular">
                <?= $theEntry->model->spirit?>
            </div>
            <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-devis tt-latolatin-bold tt-fontsize-32 pugjd">Contactez-nous<br>pour plus de détails</button>
        </div>

        <div class="row-content tour-body">
                <div id="esprit" class="text points entry-body item-tour-content">
                       <? $points = $theEntry->description;
                            echo $points;
                        ?>
                </div>
                <div class="item-tour-content" id="comment-combien">
                    <img alt="" src="/thumb/225/164/1/80/assets/img/page2016/img_special_all.png&a=t">
                </div>

        </div>

    </div>
</div>

<button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-devis tt-latolatin-bold tt-fontsize-32 ui-link ui-footer-fixed pugjd" data-position='fixed' data-ajax="false"><span>Contactez-nous<br>pour plus de détails</span></button>
<? 
$country = SEG1;
$uri = URI;
$url = DIR.URI;
$js = <<< JS

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

var curPage = $.mobile.activePage.attr("id");
var lastScrollTop = 0;
$(window).on('scroll', function() {
    if(curPage == 'page1'){
        var st = $(this).scrollTop();
           
              
                if($(window).scrollTop() > ($('.top-tour .btn-devis').offset().top + 20)){
                    $('.btn-devis.ui-footer-fixed').addClass('active');  
                } else $('.btn-devis.ui-footer-fixed').removeClass('active');  
              
           lastScrollTop = st;
    }
}); 
$('#comment-combien').click(function(){
    $.post("$url", {type : 'combien'}, function(data){
        if($('#comment-combien-page').length < 1){
            $('#page1').after(data);
        }
    });
    
    $(document).ajaxStop(function () {
        var newPage = $('#comment-combien-page');
        newPage.appendTo($.mobile.pageContainer);
        $.mobile.changePage( '#comment-combien-page', {
            transition: 'slide'
        }); 
        var menuCommentSwiper = new Swiper('#comment-combien-page .menu-comment-combien-slider', {
        scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        loop: false,
        spaceBetween: 20,
        freeMode: false
    });
    $('#comment-combien-page .item').each(function( index ) {
      $(this).find('.tab-children:eq(0)').addClass('active');
    });
    $('.menu-comment-combien-slider .swiper-slide').click(function(){

        var index = $(this).index();
        $('.menu-comment-combien-slider .swiper-slide').removeClass('active');
        $(this).addClass('active');
        $('#comment-combien-page .item').removeClass('active');
        $('#comment-combien-page .item-'+index).addClass('active');
        menuCommentSwiper.slideTo(index);
    });
    
    var curPage = $.mobile.activePage.attr('id');
    $(window).on('scroll', function() {
        if(curPage == 'comment-combien-page'){
                if($(document).scrollTop() > 30){
                    $('#comment-combien-page .header').attr('data-position','').removeClass('ui-header-fixed');
                    $('#comment-combien-page .menu-content-secret').data('position', 'fixed').addClass('ui-header-fixed');
                    $('#comment-combien-page .back-menu').data('position', '').removeClass('ui-header-fixed');
                }
                var st = $(this).scrollTop();
                   if (st <= lastScrollTop){
                        if($(document).scrollTop() > 30){
                            $('#comment-combien-page .menu-content-secret').data('position', '').removeClass('ui-header-fixed');
                            $('#comment-combien-page .header').attr('data-position','fixed').addClass('ui-header-fixed');
                        } else{
                             $('#comment-combien-page .header').attr('data-position','').removeClass('ui-header-fixed');
                        }
                   }
                   lastScrollTop = st;
        }
    });

    $('#comment-combien-page .tab-children .first-jour').click(function(){
        $(this).parent().toggleClass('active');
        var top = $(this).offset().top - 80;
        $('html, body').animate({
            scrollTop: top
        }, 200);
    })    
    });
    
});
JS;
$this->registerJs($js); 
$css = <<<CSS
.top-tour .features-tour{
    width: 100%;
}
.top-tour .features-tour li{
    width: 48%;
    margin-right: 4%;
}
.btn-devis{
    text-align: center;
}
#esprit h2:first-of-type{
    margin-top: 0;
}
CSS;
$this->registerCss($css);
?>
<? endif; ?>