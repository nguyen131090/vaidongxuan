<?php $this->registerCssFile(DIR . 'assets/css/page2016/fix-banner-top.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR . 'assets/js/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/nos-destinations-country-informations-pratiques.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile(DIR . 'assets/css/page2016/swiper-slider-3-item.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <? if (isset($theEntry->model->photos)) : ?>
        <?
        $banner = '';
        foreach ($theEntry->model->photos as $key => $value) {
            if ($value->type == 'banner')
                $banner = $value;
        }
        ?>
        <img style="width: 100%;" alt="<?= $banner->description; ?>" class="img-lazy" data-src='<?= $banner->image ?>'>
    <? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    <div class="column row-2 mb-txt-40">
        <? if($theEntry->model->seo != NULL){?>
            <h1 class="title mb-0"><?= $theEntry->model->seo->h1 ?></h1>
        <? } ?>
    </div>
</div>
<div class="container-2 amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="column">
            <ul>
                <li class="<?= !SEG2 ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="infos_page" data-analytics-action="submenu_section" data-analytics-label="link_country" href="<?=DIR.SEG1 ?>"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="infos_page" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries" href="<?=DIR.SEG1 ?>/itineraire">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="infos_page" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets" href="<?=DIR.SEG1 ?>/formules">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="infos_page" data-analytics-action="submenu_section" data-analytics-label="link_c_cities" href="<?=DIR.SEG1.'/visiter' ?>">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="infos_page" data-analytics-action="submenu_section" data-analytics-label="link_c_infos" href="<?=DIR.SEG1 ?>/informations-pratiques">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="infos_page" data-analytics-action="submenu_section" data-analytics-label="link_c_guide" href="<?=DIR.SEG1 ?>/guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>
<div class="contain container-3">

    <div class="column">
        <div class="text-summary mt-40 pt-5 mb-txt-40">
            
                <?= $theEntry->model->content; ?>
            <!--    <h2>PRÉPARER VOTRE VOYAGE AU VIETNAM</h2>
                <p>Lorsque vous voyagez avec Amica Travel, votre voyage est bien encadré et fait l’objet d’un suivi permanent de notre part. Les guides accompagnateurs ainsi que notre service clientèle sont à vos côtés pour régler toute difficulté qui pourrait survenir.</p>

                <p>C’est pourquoi, à la différence des guides de voyage, nous n’avons pas l’intention de vous livrer ici tous les conseils pratiques que vous pouvez demander à tout moment à nos agents. Nous nous contentons de présenter simplement quelques informations qui sont, à nos yeux, fondamentales pour vous permettre un voyage agréable et sans souci ; les conseils relatifs à la préparation du voyage vous étant donnés avant votre arrivée au Vietnam.</p>
            -->
        </div>
    </div>
</div>
<? if(!empty($infos_all_childrent)){ ?>
<div class="contain container-4 responsive-entry-body">

    <div class="column">
        <div class="group-on-top">
            <? 
                $cnt = 0;
                foreach ($infos_all_childrent as $value) {                    
                    $cnt++;     
                    if($value['on_top'] >= 1 && $value['status'] == 1){
                        
                        $image_icon = null;
                        $image_summary = null;
                        if(!empty($value->photos)){
                            foreach ($value->photos as $img) {
                                if($img->type == 'icon'){
                                    $image_icon = $img->image;
                                }
                                if($img->type == 'custom'){
                                    $image_summary = [
                                    'image'=>$img->image,
                                    'description' => $img->description,
                                    'caption' => $img->description,
                                    ];
                                }
                            }
                        }
                
                    
            ?>
            
            <div class="item item-<?= $cnt ?> ">
                <a href="<?=DIR.$value->slug?>">
                    <div class="image" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="infos_section" data-analytics-label="info_card_<?= $value->category_id ?>">
                        <? if($image_summary != Null){?>
                        <img alt="<?= $image_summary['description']?>" class="img-zoom img-lazy img-responsive" data-src="<?= $image_summary['image'] ?>" >
                        <?}else{?>
                        <img alt="" class="img-zoom img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-1-country-info.jpg" >
                        <?}?>
                        <p class="icon <?=SEG1?>" style="<?= $image_icon != Null ? 'background-image: url('.$image_icon.');' : '' ?>">icon</p>
                    </div>
                    <h3 class="tt mt-25 mb-txt-25" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="infos_section" data-analytics-label="info_card_t_<?= $value->category_id ?>"><?= $value->title ?></h3>
                </a>    
                <p class="summary m-0"><?= $value->summary ?></p>
            </div>
           
            <? 
            
                }else{
                    
                    break;
                    
                }
            
            } ?>
            
        </div>
        
    </div>
</div>
<? } ?>

<? if(!empty($infos_all_childrent)){ ?>
<div class="contain container-5 mt-40 mb-20">

    <div class="column">
        <ul class="all-aticle m-0">
            <?
                $cnt = 0;
                foreach ($infos_all_childrent as $value) {
                  $cnt++;  
                  if($value['on_top'] == NULL && $value['status'] == 1){
                    $image_icon = null;
                    
                    if(!empty($value->photos)){
                        foreach ($value->photos as $img) {
                            if($img->type == 'icon'){
                                $image_icon =['image' => $img->image,
                                        'description' => $img->description,
                                        'caption' => $img->caption,
                                        ];
                            }
                            
                        }
                    }
            ?>
            <li class="mt-0 mb-40">
                <a href="<?= DIR.$value->slug ?>" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="infos_section" data-analytics-label="info_icon_<?= $value->category_id ?>">
                    <? if($image_icon != null){ ?>
                    <img alt="<? $image_icon['description'] ?>" class="icon <?=SEG1?>" data-src="<?=$image_icon['image']?>">
                    <? }else{ ?>
                    <img alt="" class="icon <?=SEG1?>" data-src="<?=DIR?>assets/img/page2016/test_icon.png">
                    <? } ?>
                    <span><?= $value->title ?></span>
                </a>
            </li>
                  <? }} ?>
            
          
        </ul>
        
    </div>
</div>
<? } ?>
<? if($voyage != NULL){ ?>
<div class="responsive-entry-body">
<div class="contain container-6 <?= SEG1 ?> secrets responsive-swiper-slider-3-item">
    
    <div class="column">
        <h2 class="tt-big mt-0 mb-txt-40">Inspirez-vous nos idées de voyage au <?= ucwords(SEG1)?></h2>
        
        <!-- Slider main container -->
        <div class="area-slider-swiper area-slider-swiper-3-item">    
            <div class="swiper-container custom-slides-swiper custom-slides-swiper-3-item">

                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?
                            $cnt = 0;
                            foreach ($voyage as $value) {

                            $cnt++;    
                            $image_summary = null;

                                if(!empty($value->model->photos)){
                                    foreach ($value->model->photos as $img) {
                                        if($img->type == 'summary'){
                                            $image_summary =['image' => $img->image,
                                                    'description' => $img->description,
                                                    'caption' => $img->caption,
                                                    ];
                                        }

                                    }
                                }
                        ?>
                        <div class="swiper-slide">
                            <div class="item item-<?= $cnt?> text-left">
                                <a href="<?=DIR.$value->slug?>">
                                    <div class="image" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?= $value->model->item_id ?>">
                                        <? if($image_summary != null){ ?>
<!--                                        <img width="" height="" alt="<?//= $image_summary['description']?>" class="img-lazy img-responsive lazyload" data-src="<?//=DIR?>timthumb.php?src=<?//=$image_summary['image']?>&w=300&h=200&zc=1" />-->
                                        <img width="" height="" alt="<?= $image_summary['description']?>" class="img-lazy img-responsive lazyload" data-src="<?=$image_summary['image']?>" />
                                        <? } ?>
                                    </div>
                                    <h3 class="tt mt-25 mb-txt-25" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $value->model->item_id ?>"><?= $value->model->title ?></h3>
                                </a>
                                <div class="summary"><?= $value->model->summary ?></div>
                                
                            </div>
                        </div>    
                    <? } ?>
        
                </div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev" style="top: 25%;" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="tours_section" data-analytics-label="control_left"></div>
            <div class="swiper-button-next" style="top: 25%;" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="tours_section" data-analytics-label="control_right"></div>   
        </div>
        <a class="btn-link-voyage p-0 mt-txt-20 mb-txt-60" href="<?=DIR.SEG1?>/itineraire" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="tours_section" data-analytics-label="link_c_itineraries">Voir tous nos circuits</a>
        
    </div>
</div>
</div> 
<? } ?>
<div class="contain container-7 pb-25 mb-60 responsive-search-form-ngang">
    
    <div class="column">
        <p class="tt-big tt-search-form mt-txt-25"><?='Retrouvez nos suggestions de circuits '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></p>
        <div class="search-form quick-search">
            <form class="form-search horizontal search-prog-form">
                <div class="cs-select destination search-destination" style="display: none;">
                    <span class="cs-placeholder"><span class="icon-left"></span> <span class="input-text">Destination(s)</span><span class="icon-right"></span></span>
                        <div class="cs-options">
                            <ul>
                                <li data-option="" data-value="vietnam"><span class="icon-check"></span><span class="text-option">Vietnam</span></li>
                                <li data-option="" data-value="laos"><span class="icon-check"></span><span class="text-option">Laos</span></li>
                                <li data-option="" data-value="cambodge"><span class="icon-check"></span><span class="text-option">Cambodge</span></li>
                                <li data-option="" data-value="birmanie"><span class="icon-check"></span><span class="text-option">Birmanie</span></li>
                            </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <li class="<?= SEG1 == 'vietnam' ? 'active' : ''?>" data-value="vietnam">Vietnam<span></span></li>
                                <li class="<?= SEG1 == 'laos' ? 'active' : ''?>" data-value="laos">Laos<span></span></li>
                                <li class="<?= SEG1 == 'cambodge' ? 'active' : ''?>" data-value="cambodge">Cambodge<span></span></li>
                                <li class="<?= SEG1 == 'birmanie' ? 'active' : ''?>" data-value="birmanie">Birmanie<span></span></li>
                            </ul>     
                        </div>

                </div>
               
                 <div class="cs-select type-de-voyage search-type">
                     <span class="cs-placeholder" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="sugg_section" data-analytics-label="select_type"><span class="icon-left"></span> <span class="input-text">Type de voyage</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                                <ul>
                                     <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                               <li data-option="" data-value="<?=$value->category_id ?>"><span class="icon-check"></span><span class="text-option"><?=$value->title ?></span></li>
                                               <? endforeach ?>
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                             <? foreach ($type as $key => $value) : ?>
                                               <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                                            <? endforeach ?>
                            </ul>    
                        </div>

                </div>
                 <div class="cs-select une-envie search-length">
                    <span class="cs-placeholder" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="sugg_section" data-analytics-label="select_duration"><span class="icon-left"></span> <span class="input-text">Durée</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                            <ul>
                                <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) { ?>
                                <li data-option="" data-value="<?= $key ?>"><span class="icon-check"></span><span class="text-option"><?= $value ?></span></li>
                                    
                                <? } ?>
                                
                            </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) { ?>
                                <li data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>    
                                <? } ?>
                               
                            </ul>  
                        </div>

                </div>
                <div class="cs-select submit quick-search-submit btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="infos_page" data-analytics-action="sugg_section" data-analytics-label="btn_itineraries">
                     <?=$this->context->countTour ?> Voyages
                </div>
            </form>
       </div>     
    </div>
</div>  

<?// if(SEG1 == 'birmanie'){?>
<!--<div class="contain mb-60">
<?
 //       include '_inc_guide_book.php';
?>
</div>-->
<?// } ?>
<!--  Include Blogs -->
<?
        include '_inc_data_blogs.php';
?>
<!-- End Include Blogs -->
<!-- BACK BUTTON -->
<?// include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
<?php
$url = DIR . URI;
$js = <<<JS
        
$('.secret-slider').bxSlider({
      minSlides: 3,
      maxSlides: 3,
      moveSlides: 1,
      slideWidth: 300,
        pager: true,
      slideMargin: 20,
      infiniteLoop: false,
        onSlideBefore: function(slideElement, oldIndex, newIndex){
            //var lazy = slideElement.find('.lazy');
            //var load = lazy.attr('data-src');
            //lazy.attr('src', load).removeClass('lazy');
           
        }
});
$(document).on('mouseover', '.bx-wrapper li .item-img', function(){
        $('.bx-wrapper li .item-img .text-slide').removeClass('active');
        $(this).find('img').addClass('active');    
        $(this).find('.text-slide').addClass('active');
        $(this).find('.text-on-img').hide();
    });
$(document).on('mouseleave', '.bx-wrapper li .item-img', function(){
    $('.bx-wrapper li .item-img img').removeClass('active');  
    $('.bx-wrapper li .item-img .text-slide').removeClass('active');  
     $(this).find('.text-on-img').fadeIn(500);  
});
        
function fixContent(){
    $('.clear-fix').each(function(index) {
        var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
        var subttleft = $(this).children('.it-l').children('a').children('.sub-tt').outerHeight();

        var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
        var subttright = $(this).children('.it-r').children('a').children('.sub-tt').outerHeight();
        if (htleft > htright){
            $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
        }  
        if (htright > htleft){
            $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
        }

        if (subttleft > subttright){
            $(this).children('.it-r').children('a').children('.sub-tt').css('min-height', subttleft);
        }  
        if (subttright > subttleft){
            $(this).children('.it-l').children('a').children('.sub-tt').css('min-height', subttright);
        }


        // fix height summary

        var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
        var summaryright = $(this).children('.it-r').children('.summary').outerHeight();

        if (summaryleft > summaryright){
            $(this).children('.it-r').children('.summary').css('min-height', summaryleft);
        }  
         if (summaryright > summaryleft){
            $(this).children('.it-l').children('.summary').css('min-height', summaryright);
        }       
  });
}	  

$(window).bind("load", function() { 
       fixContent(); 
});
        
// JS Load page phan trang        

    $(document).on("click",".pagination-prog .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $('html, body').animate({scrollTop: $('.getcontent').offset().top - 200}, 1000);
        $.post(url, { pagi: 'prog' }, function(data){ 
           //$('#programes-load').html(data);
		   
			var datanew = $($.parseHTML(data)).find(".getcontent"); 
			$('.ajaxfilter').html(datanew);
			
            fixContent(); 
            return false;

        });
        return false;
     });

        
// End load page phan trang
        
        
        //$('.destination .cs-options ul li').click(function(){
    $(document).on('click','.destination .cs-options ul li',function(){
       
       var array = [];
        
        $('.destination .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
               
                
                var text = $(this).children('.text-option').text();
                array.push($(this).children('.text-option').text()); //Replace with this and it will get the text from clicked li only.

               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').text('');
               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').append(text);
            }
        });
       //console.log(array.join(', '));
        var more = '';
        if(array.join(', ').length > 16){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Destination(s)';
        }
            var text = array.join(', ').substring(0,16) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });    
    
   
    //$('.une-envie .cs-options ul li').click(function(){
    $(document).on('click','.une-envie .cs-options ul li',function(){   
       var array = [];
        
        $('.une-envie .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
                
                var text = $(this).children('.text-option').text();
                array.push($(this).children('.text-option').text()); //Replace with this and it will get the text from clicked li only.

               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').text('');
               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').append(text);
            }
        });
        //console.log(array.toString().length);
        var more = '';
        if(array.join(', ').length > 28){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Durée';
        }
            var text = array.join(', ').substring(0,28) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });        
        
    //$('.type-de-voyage .cs-options ul li').click(function(){
    $(document).on('click','.type-de-voyage .cs-options ul li',function(){      
       var array = [];
        
        $('.type-de-voyage .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
                
                var text = $(this).children('.text-option').text();
                array.push($(this).children('.text-option').text()); //Replace with this and it will get the text from clicked li only.

               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').text('');
               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').append(text);
            }
        });
        //console.log(array.toString().length);
        var more = '';
        if(array.join(', ').length > 40){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Type de voyage';
        }
            var text = array.join(', ').substring(0,40) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });    
   
        
        
        $('#download-guide-form .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          
        }else{
            $('#download-guide-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#download-guide-form .error-email').hide();
        } 
});         
$('#download-guide-form .submit-email').click(function(){
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          return false;
        } 
        $.post(url, { email: $('#download-guide-form .email').val(), type: 'guide' }, function(data){ 
                if(data){
                $('#download-guide-form .submit-email').text('Merci'); 
                $('#download-guide-form .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'}); 
                $('#download-guide-form .submit-email').addClass('submited'); 
                window.open($('#download-guide-form input').data('pdf'),'_blank');
                }else{ 
                    return false;
                }
            });
    }else{
        return false;
    }
});
    
   
$(window).bind("load", function() { 


  $('.secret-slider .item').each(function(index) {
        var max = 0;
        var height = $(this).find('.tt').outerHeight();
        if(max < height){
            max = height;
        }
        
       $('.secret-slider .item .tt').css("min-height", max);

             
  });
         $('.container-4 .item').each(function(index) {
        
        var max = 0;
        var height = $(this).find('.tt').outerHeight();
        //alert(height);
        if(max < height){
            max = height;
        }
        
       $('.container-4 .item .tt').css("min-height", max);

             
    });
        $('.container-8.birmanie .item').each(function(index) {
        
        var max = 0;
        var height = $(this).find('.tt').outerHeight();
        //alert(height);
        if(max < height){
            max = height;
        }
        
       $('.container-8 .item .tt').css("min-height", max);

             
    });
});
        
var swiper = new Swiper('.custom-slides-swiper', {
      slidesPerView: 3,
        slidesPerGroup: 3,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
    });            

JS;
$this->registerJs($js, yii\web\View::POS_END);
?>