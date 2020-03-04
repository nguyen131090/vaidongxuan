
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $data_analytics_category = SEG2 == 'guide' ? 'guide_single' : 'info_single'; ?>
<div class="contain no-padding">
    <div class="column">
        <? include('_inc_menu_all_page_destinations.php'); ?>
    </div>
</div>    
<div class="contain container-2 non-area-form">
    <div class="column">
            
        <div class="row-content top-lieu">
            
            <!-- subMenu on tablet -->
            <div class="responsive-submenu area area-1 menu-right <?= SEG1?>">
                <span class="text-def-select">Sélectionner</span>
                <ul>
                    <?
                    if(Yii::$app->request->get('url') != NULL){
                        $uri = Yii::$app->request->get('url');
                        $hClass = 'get-ajax-submenu';
                    }else{
                        if(SEG4){
                            $uri = DIR.SEG1.'/'.SEG2.'/'.SEG3;
                        }else{
                           $uri = DIR.URI; 
                        }

                        $hClass = NULL;
                    } 
                    ?>
                    
                    <? foreach ($children as $key => $value) { ?>
                            <? if($value->depth == 2 && ($value->rgt - $value->lft) == 1){ ?>
                                <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent ' : ''?> <?= DIR.$value->slug == $uri ? $hClass : '' ?> <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                    <a href="<?=DIR.$value->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $value->category_id ?>"><?=$value->title?></a><span class="arrow-down-up <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">arrow</span>
                                <? 


                                if($value->items && DIR.$value->slug == $uri) { ?>
                                    <ul class="items <?= DIR.$value->slug == $uri ? 'active' : ''?>">
                                        <? foreach ($value->items as $ki => $vi) : ?>
                                            <? if($vi['status'] == 1) {?>
                                            <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a href="<?=DIR.$vi->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $vi->item_id ?>"><?=$vi->title?></a></li>
                                            <? } ?>
                                        <? endforeach; ?>
                                    </ul>
                                <? } ?>
                                </li>
                            <? }else if($value->depth == 2 && ($value->rgt - $value->lft) > 1){ ?>
                                <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent ' : 'parent'?> <?= DIR.$value->slug == $uri ? $hClass : '' ?> <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                    <a href="<?=DIR.$value->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $value->category_id ?>"><?=$value->title?></a><span class="arrow-down-up <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">arrow</span>
                                <? 


                                if(DIR.$value->slug == $uri) { ?>
                                    <ul class="items <?= DIR.$value->slug == $uri ? 'active' : ''?>">
                                        <? 
                                        $j = 0;
                                        foreach ($children as $klist => $vlist) {
                                           $j++;  
                                           if($value->lft < $vlist->lft && $value->rgt > $vlist->rgt){                                     
                                            echo '<li class="name-group">'.$vlist->title.'</li>';                                
                                            foreach ($vlist->items as $ki => $vi) { ?>
                                               
                                                <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a href="<?=DIR.$vi->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $vi->item_id ?>"><?=$vi->title?></a></li>
                                            <?  } ?>
                                        <? }} ?>
                                    </ul>
                                <? } ?>
                                </li>
                            <? } ?>
                        <? } ?>
                    
                    
                </ul>
            </div>
            <!-- End subMenu on tablet -->
            
            <h1 class="title-row"><?=$theEntry->model->seo->h1 ?></h1>
            <div class="text-row tt-latolatin-regular tt-fontsize-32">
                <?=isset($theEntry->description) ? $theEntry->description : $theEntry->model->content; ?>
            </div>
        </div>

        <div class="row-content visiter-related">
            <h3 class="title-row">Lire aussi</h3>
            <div class="visiter-related-slider">
                <div class="swiper-wrapper">
                             <? 
                            foreach ($top3 as $key => $value) : ?>
                                <div class="swiper-slide">
                                    <a href="<?= DIR . $value->slug ?>"">
                                        <? 
                                        $v = '';
                                        if(isset($value->photosArray['summary'])) : 
                                            $v= $value->photosArray['summary'][0];
                                        ?>
                                        <img alt="<?= $v->description?>"
                                            data-src="<?=$v->image?>" 
                                            data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                            data-sizes="auto"
                                            class="banner-img lazyload" />
                                        <? endif; ?>
                                        <h4 class="tt-latolatin-bold tt-fontsize-32"><?= str_replace('|','',$value->title); ?></h4>
                                    </a>
                                </div>
                             <? endforeach ?>
                </div>
            </div>
        </div>

        <div class="row-content tours-lieu">
            <h3 class="title-row">Découvrir <?=SEG1=='birmanie' ? 'la' : 'le' ?> <?= ucfirst(SEG1) ?></h3>
            <div class="tours-lieu-slider">
                <div class="swiper-wrapper">
                <?  foreach ($theEntries as $k => $value) : ?>
                <div class="swiper-slide">
                            <a href="<?= DIR.$value->slug?>">    
                                <? 
                                $v = '';
                                if(!empty($value->photosArray['summary'])){
                                    $v= $value->photosArray['summary'][0];
                                }?>
                                 <img alt="<?= $v->description?>"
                                    data-src="<?=$v->image?>" 
                                    data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />
                                <div class="text-on-img">
                                    <h4 class="no-margin tt-latolatin-bold tt-fontsize-32"><?= str_replace('|','',$value->title); ?></h4>
                                    <p class="sub-title tt-fontsize-28"><?= $value->model->sub_title ?></p>
                                </div>
                            </a>
                        </div>
                <? endforeach; ?>
            </div>
            </div>
        </div>
</div>
</div>
<!-- Start of second page -->

<? 
$country = SEG1;
$uri = URI;

$js = <<< JS

$('.region .region-item .tx-1').click(function(){
   
    $(this).parent().siblings().removeClass('active');
    $(this).parent().toggleClass('active');
     $.mobile.silentScroll($(this).parent().position().top - 60);
})
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

var tourSlider = new Swiper('.tours-lieu-slider', {
        slidesPerView: 1.1,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false
    }); 


var relatedSwiper = new Swiper('.visiter-related-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });



$("#search-destination").on('change', function(){
    window.location.href = '/'+this.value;
    return false;
});
$('.quick-search .select2-search__field').on('keyup', function(){
    if($(this).val()){
        $('.visiter-search.select2-dropdown').show();
        if($('.quick-search .reset-input').length < 1)
            $(this).parent().prepend('<span class="reset-input">&#215;</span>');
    } else{
        $('.quick-search .reset-input').remove();
    }
})

$(window).on('scroll', function () {
        if($(window).scrollTop() > 30){
            $('.menu-slider').addClass('fixed-header');
        }
        else{
            $('.menu-slider').removeClass('fixed-header');
        }
    });
$('.quick-search').on('click', '.reset-input', function(){
    $('.quick-search .select2-search__field').val('');
    $(this).remove();
})
var menuSwiper = new Swiper('.menu-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 30,
        grabCursor: true,
        initialSlide: 3
    }); 

        
$('.menu-right .parent > .arrow-down-up').click(function(){
        $(this).parent().find('.items').toggleClass('active');
		$(this).toggleClass('active');
	var target = $(this);
        var hItem = $(this).parent().find('.items');
        
        var hclassact = $(this).hasClass('get-sub-ajax');
        
        
        if(!hclassact){
            $(this).addClass('get-sub-ajax');
            if(hItem.length == 0){
                var url = $(this).parent().children('a').attr('href');

                $.ajax({
                    type: "GET",
                    url: window.location.pathname,
                    data: "url=" + url,
                    beforeSend: function() {
                    },
                    success: function(data){

                        var datanew = $($.parseHTML(data)).find(".get-ajax-submenu").children('.items');
                        
                        target.parent().append(datanew);
                        

                    },
                    complete: function(data) {
                        target.addClass('active');
                        
                    },
               });
            }
        }else{
            
        }
        
        
    return false;      
    });
$('.text-def-select').click(function(){
    $(this).toggleClass('active');
    $(this).parent().children('ul').toggleClass('active');    
});                

JS;
$this->registerJs($js); 
$css = <<<CSS
.swiper-container-horizontal{
    position: relative;
}
.visiter-related-slider .swiper-slide{
    width: 80%;
}
.top-lieu .text-row > h2{
    font-family: 'LatoLatin-Bold',sans-serif;
    color: #e65925;
    margin: 1.3rem 0;
    background-size: 4rem;
    font-size: 2rem;
}
.top-lieu .text-row > h3{
    font-size: 1.6rem; 
    font-family: 'LatoLatin-Bold',sans-serif;    
}
.top-lieu .text-row ul{
    padding: 0;
}
.top-lieu .text-row ul li{
    list-style: none;
}
.top-lieu .text-row ul li::before {
  content: "• ";
  color: #e65925; /* or whatever color you prefer */
  display: inline-block;padding: 
  font-size: 2rem;
  margin-right: 1rem;
}
.galeries-slider{
    margin-bottom: 2.5rem;
}
.galeries-slider .swiper-button-prev{
    background-color: transparent;
    background-size: 2rem;
    left: -0.5rem;
}
.galeries-slider .swiper-button-next{
    background-color: transparent;
    background-size: 2rem;
    right: -0.5rem;
}
.tours-lieu-slider .text-on-img {
    position: absolute;
    z-index: 9999;
    bottom: 0;
    color: #fff;
    display: block;
    width: 100%;
    text-align: center;
    background: linear-gradient(to top,rgba(0,0,0,0.5),rgba(0,0,0,0));
        padding: 0 1.25rem;
}
.tours-lieu-slider .text-on-img h4 {
    margin-bottom: 2rem;
    margin: 0;
}
.tours-lieu-slider .text-on-img p{
    margin: 0.5rem 0 2rem;
}
.top-lieu .text-row p{
    margin: 0 0 1rem;
}
.top-lieu .text-row p:last-of-type{
    margin: 0;
}
.list-envies{
    margin-bottom: 2.5rem;
    margin-top: 0;
    display: inline-block;
}
.list-envies li{
    float: left;
    background: #e4e4e4;
    border-radius: 1rem;
    margin-right: 1rem;
    padding: 0.5rem 1rem;
    font: 1.3rem LatoLatin-Regular,sans-serif;
}
.list-envies li img{
    margin-right: 0.5rem;
}
.visiter-related-slider .swiper-slide:first-of-type {
      justify-content: center;
      margin: 0 auto;
    }
.tours-lieu-slider{
    margin-bottom: 4rem;
}
.top-lieu .text-row hr{
    display: none;
}
.top-lieu .text-row img{
    margin: 1.3rem 0 2rem;
        width: 100% !important;
    height: auto !important;
}
.visiter-related-slider  .swiper-slide h4{
    margin-bottom: 0;
}        
@media only screen and (orientation:landscape){
    .visiter-related-slider .swiper-slide{
        width: 45%;
    }
}
CSS;
$this->registerCss($css);
?>