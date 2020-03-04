
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
                         <img data-src="/assets/img/page2016/posi.png" alt="">
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
                     <a class="tt-latolatin-bold" id="tour-type" href="<?=DIR.str_replace('voyage', SEG1.'/'.SEG2, $theEntry->cat->slug)?>">
                        <? if(isset($theEntry->cat->photosArray['icon-banner'])) : 
                            $v = $theEntry->cat->photosArray['icon-banner'][0];
                            ?>
                        <img data-src="<?=$v->image ?>" alt="" />
                        <? endif; ?>
                            <?= $theEntry->cat->title?>
                        </a>
                </li>
            </ul>

            <!-- Include Gallery Image -->
            <? include_once '_inc_gallery.php'; ?>
            <!-- End Include Gallery Image -->
            
            <div class="no-margin text spirit tt-fontsize-32 tt-latolatin-regular">
                <?= $theEntry->model->spirit?>
            </div>
            <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-devis tt-latolatin-bold tt-fontsize-32 pugjd">Contactez-nous pour plus de détails*</button>
        </div>

        <div class="row-content tour-body">
            <div id="itineraire" class="item-tour-content">
                    <h2 class=" no-margin sub-title-page tt-fontsize-40 tt-latolatin-bold tt-color-e65925">Les étapes du voyage</h2>
                    <a class="map-tour" href="#maps-popup"  data-rel="popup" data-position-to="window" data-transition="fade">
                            <img class="lazyload" alt="<?= !empty($tourImages['map']) ? $tourImages['map'][0]->description : 'Amica Travel' ?>"  data-srcset="<?= '/thumb/500/636/1/80'.$tourImages['map'][0]->image.'&a=t' ?>" data-sizes='auto'>
                    </a>
                    <div data-role="popup" id="maps-popup">
                        <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                        <img class="lazyload" alt="<?= !empty($tourImages['map']) ? $tourImages['map'][0]->description : 'Amica Travel' ?>"  data-srcset="<?= $tourImages['map'][0]->image ?>" data-sizes='auto'>
                    </div>
                    <p align="center" class="destination-tour tt-latolatin-bold tt-fontsize-28 no-margin">    
                        <? if(isset($theEntry->data->itinerary)) : ?>
                            <? $itinerary  = json_decode($theEntry->data->itinerary); ?>
                            <? if($itinerary) :?>
                            <? foreach ($itinerary as $key => $value){
                                if($key && substr($value->title, 0, 1) != '(' && substr($value->stitle, 0, 1) != '(') echo ' - '; else echo ' ';
                                $title = $value->stitle ? $value->stitle : $value->title;
                               if($value->status == 1){
                                echo $title;
                               } else{
                                    echo $title;   
                               } 
                            } ?>
                            <? else: ?>
                            <? echo  $theEntry->data->itinerary;?>
                            <? endif; ?>
                        <? endif; ?>
                    </p>
                </div>
                <div id="esprit" class="text points entry-body item-tour-content">
                       <? $points = $theEntry->description;
                            echo $points;
                        ?>
                </div>
            
                <? if(!empty($theEntry->data->folder)) {  ?>
               
                <div id="folder" class="text points entry-content entry-body item-tour-content mt-0">
                        <p class="title-price sub-title-page tt-latolatin-bold tt-fontsize-40 tt-color-e65925">Bibliographie</p>
                        <?= $theEntry->data->folder ?>
                </div>
                <? } ?>
            
                <div class="item-tour-content" id="comment-combien">
                    <img alt="" data-src="/thumb/225/164/1/80/assets/img/page2016/img_special_all.png&a=t">
                </div>

        </div>

    </div>
</div>

<button class="btn-devis tt-latolatin-bold tt-fontsize-32 ui-link ui-footer-fixed" data-position='fixed' data-ajax="false">
    <span data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-bottom-form-call pugjd">Contactez-nous pour plus de détails*</span>
    <a href="tel:+33619081572" class="btn-bottom-form-call btn-phone">Call</a>
</button>
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
#esprit hr{
    display: none;
}
CSS;
$this->registerCss($css);
?>