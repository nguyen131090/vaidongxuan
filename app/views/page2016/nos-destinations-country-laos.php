<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/animate.css/animate.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);  ?>
<? $this->registerJsFile(DIR . 'assets/js/scroll-animated.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 

$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); ?>

<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<?php $this->registerCssFile(DIR . 'assets/css/page2016/_inc_data_blogs.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <? if(isset($theEntry->model->photos)) : ?>
    <? 
    $banner = '';
    foreach ($theEntry->model->photos as $key => $value) {
        if($value->type == 'banner') $banner = $value; 
    } ?>
    <img style="width: 100%;" alt="<?=$banner->description; ?>" class="img-lazy" data-src='<?=$banner->image ?>'>
    <? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    <div class="column amc-column row-2 mb-0">
        <h1 class="title m-0 amc-fix-mb-40-0"><?=$theEntry->model->seo->h1 ?></h1>
    </div>
</div>
<div class="area-search-menu container-flud pt-25 pb-25 responsive-search-menu">
    <div class="column">    
        <div class="group-search m-0">
            <form class="search-form search-form search-prog-form">
            <div style="display: none;" class="cs-select destination search-destination filter-type">
               <span class="cs-placeholder active">Destination(s)</span>
                <div class="cs-options">
                </div>
                <div class="list-option">
                    <ul>
                    <li class="active" data-option="" data-value="<?=SEG1?>"><?=ucfirst(SEG1) ?><span></span></li>
                    </ul>    
                </div>

            </div>
            <div class="cs-select search-envies search-type une-envie type-de-voyage">
                    <div class="icon-envies"></div>
                    <span class="cs-placeholder" data-analytics="on" data-analytics-category="country_page" data-analytics-action="sugg_section" data-analytics-label="select_dest">Type de voyage<b></b></span>
                    <div class="cs-options">
                        <ul>
                            <? foreach ($activeSearch['tour'] as $key => $value) : ?>
                            <li data-option="" data-value="<?=$key?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="sugg_section" data-analytics-label="select_voyage_opt_<?= $key ?>"><?=$value?></li>
                        
                        <? endforeach ?>
                    </ul>

                </div>
                <div class="list-option">
                    <ul>
                       <? foreach ($activeSearch['tour']  as $key => $value) : ?>
                       <li data-value="<?=$key ?>"><?=$value?><span></span></li>
                        <? endforeach ?>
                    </ul>    
                </div>

           </div>
           <div class="cs-select search-form une-envie search-length duree">
                        <div class="icon-length"></div>
                        <span class="cs-placeholder" data-analytics="on" data-analytics-category="country_page" data-analytics-action="sugg_section" data-analytics-label="select_voyage">Durée<b></b></span>
                        <div class="cs-options">
                                <ul>
                                    <? foreach ($activeSearch['length'] as $key => $value) : ?>
                                         <li data-option="" data-value="<?=$key?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="sugg_section" data-analytics-label="select_duration_opt_<?= $key ?>"><?=$value ?></li>
                                    
                                    <? endforeach; ?>
                                     
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <? foreach ($activeSearch['length'] as $key => $value) : ?>
                                       <li data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                                    <? endforeach; ?>
                            </ul>    
                        </div>

                </div>

           <div class="cs-select submit btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="country_page" data-analytics-action="sugg_section" data-analytics-label="btn_voyage">
            <?=$countVnTours ?> <?=$countVnTours > 1 ? 'Voyages' : 'Voyage' ?>
        </div>
        </form>
        </div>  
    </div>  
</div>
<div class="container-flud amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="column">
            <ul>
                <li  class="<?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_country"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></li>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></li>
                <li  class="<?= SEG2 == 'visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="country_page" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>
<div class="entry-body-entry container-flud mb-60 responsive-entry-body">
    <div class="contain container-3 column country-tours pt-40 mt-5">
        <?=$theEntry->model->content; ?>
        <div class="mt-txt-60">
            <ul class="tous-slider">
                <li>
                <? foreach($tourType->items() as $key=> $value) : ?>
                    <? 
                    $class = '';
                    if($key < 3) {
                        if($key < 1) $class = 'slideInLeft'; else  $class = 'slideInRight';
                    }
                    ?>
                    <div class="item-img" data-animation="<?=$class?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="cats_section" data-analytics-label="cat_card_<?= $value->model->item_id ?>">
                    <a href="<?=DIR.$value->slug ?>">
                        <? $i = ''; ?>
                                    <? foreach ($value->photos as $kp => $vp) : ?>
                                        <? if($vp->type == 'summary')
                                                    $i = $kp; ?>
                                    <? endforeach; ?>
                            <img width="460" height="<?=$key == 0 || $key == 3 ? '587' : '281'?>" alt="<?=$value->photos[$i]->description?>" data-src="<?=$value->photos[$i]->image?>" class="img-lazy lazyload"/>
                        <div class="text-on-img">
                            <h3><?=$value->title?></h3>
                            <? if($value->model->sub_title != ''){ ?>
                                <p class="amc-text"><?=$value->model->sub_title?></p>
                            <? } ?>
                        </div>
<!--                        <div class="text-slide">
                            <div class="bottom-block">
                                <span class="title-hover"><?//=strip_tags($value->title)?></span>
                                <p><?//=strip_tags($value->description)?></p>
                                <span class="btn radius-5">En savoir plus</span>
                            </div>
                        </div>            -->
                    </a>
                    </div>
                <? if($key == 2) echo "</li><li>"; ?>

                <? endforeach; ?>
                </li>
            </ul>
        </div>    
    </div>
    
</div>

<? include '_inc_video_page.php'; ?>

<div class="entry-body-entry container-flud mb-60 responsive-entry-body">    
    
    <div class="column pourquoi laos mt-0">
        <h2 class="title-pourquoi mt-txt-0 mb-txt-40">Pourquoi nous choisir pour votre voyage au <?= ucwords(SEG1)?></h2>   
        <p class="text">Depuis 2007, nous organisons et créons des voyages sur mesure au Laos. Notre cœur de métier : Création des circuits hors de sentiers battus, authentiques, axés sur la découverte des paysages exceptionnels et caractéristiques, sur l’immersion à l’intérieur de la vie locale, sur les rencontres avec les locaux.</p> 
        <div class="detail mt-25">
            <div class="item-detail">
                <img alt="" class="img-lazy" data-src='/assets/img/new-pays/pourquoi-1.png'/>
                <span>Équipe locale &<br>passionnée au <?=SEG1 ?></span>
            </div>
            <div class="item-detail">
                <img alt="" class="img-lazy" data-src='/assets/img/new-pays/pourquoi-2.png'/>
                <span>Créativité &<br>originalité</span>
            </div>
            <div class="item-detail">
                <img alt="" class="img-lazy" data-src='/assets/img/new-pays/pourquoi-3.png'/>
                <span>Engagement vers<br>un tourisme solidaire</span>
            </div>
        </div>
        <div class="btn-pourquoi mt-25">
            <p>
                <span>Notre conseiller(ère) vous répondra sous 48H</span>
                <b class="btn-amica-basic btn-amica-basic-2 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</b>
            </p>
        </div>
    </div>
    <div class="column secrets responsive-swiper-slider-3-item">
        <h2 class="mb-txt-40"><?=$secretType->title; ?></h2>
        <?=$secretType->model->content; ?>
        <!-- Include file slide 3 item -->
        <?
            include '_inc_swiper_slider_3_item.php';
        ?>
        <!-- End Include file slide 3 item -->
        
    </div>     
    
    <div class="column preparer-voyage mt-60">
        <h2 class="mt-0 mb-txt-40">Préparer votre voyage au <?= ucwords(SEG1) ?></h2>
        <p class="text">De multiples questions peuvent en effet se poser concernant le choix de la meilleure formule, de la meilleure période, du meilleur itinéraire...</p>
        <? foreach ($infos as $kif => $if): ?>
             <a class="link-item-preparer" href="<?=DIR.$if->slug; ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="info_section" data-analytics-label="info_iconbig_<?= $if->category_id ?>">
                <div class="item-preparer">
                    <div class="img" data-analytics="on" data-analytics-category="country_page" data-analytics-action="info_section" data-analytics-label="info_iconbig_<?= $if->category_id ?>">
                        <img class="img-lazy" alt="" data-src="/assets/img/new-pays/preparer-item-<?=$kif+1 ?>.png">
                    </div>
                    <h3 class="big-text mt-25 mb-txt-25" data-analytics="on" data-analytics-category="country_page" data-analytics-action="info_section" data-analytics-label="info_iconbig_<?= $if->category_id ?>"><?=$if->title; ?></h3>
                    <p><?=$if->summary ?></p>
                </div>
            </a>
        <? endforeach; ?>
        <div class="clearfix"></div>
        <a href="https://www.amica-travel.com/laos/informations-pratiques" style="color: #e35429;" class="btn-amica-basic btn-amica-basic-1 mt-txt-40 mb-0" data-analytics="on" data-analytics-category="country_page" data-analytics-action="info_section" data-analytics-label="cta_c_infos">Voir toutes nos informations pratiques sur le Laos</a>
        <div class="btn-preparer mt-60">
            <div>
                <span>Découvrir les sites à visiter</span>
                 <? $allRoot =  \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->items(['pagination' => ['pageSize' => 0]]);
                    $optDes = \yii\helpers\ArrayHelper::map($allRoot, 'slug', 'title');
                    ?>
                <?= \yii\helpers\Html::dropDownList('search_destination', null, $optDes,[
                        'class' => 'chosen',
                        'multiple' => 'multiple', 
                        'data-placeholder' => 'Tapez le nom d’un site (Vientiane, Paksé...)',
                        'id' => 'search_destination',
                        'style' => 'width: 345px; height: 33px;'
                    ]) ?>
            </div>
        </div>
    </div>
    <div class="container-flud fluid-testi mt-60">
        <div class="column row container">
            <div class="col-12 col-sm-12 col-lg-4 pr-25 pl-0">
                <h2 class="tt">Ils nous ont fait confiance</h2>
                <div class="text-col-left"><?=$testiModule->model->summary; ?></div>
            </div>
            <div class="col-12 col-sm-12 col-lg-8 p-0 position-relative fix-mt-40-respnsive">
                 <!-- Slider main container -->
                <div class="area-slider-swiper">    
                    <div class="swiper-container custom-slides-swiper-testi custom-slides-swiper-3-item">
                        <div class="swiper-wrapper testi-bxslider row-content">

                        <? $i = 0; foreach ($arrTemoignages as $k => $v) { $i++;?>


                        <div class="swiper-slide item text-left px-40">
                            <p class="summary mt-40 mb-2">"<?=$v['summary']; ?>" </p>
                            <div class="detail text-center d-flex justify-content-center align-items-center mb-40">

                                <img class=" mr-2" alt="" data-src="/assets/img/tour/client-df.png">

                                <div class="text d-inline-block text-left">

                                    <p class="client my-0"><?= isset($v['data']->nameclient) ? $v['data']->nameclient : ''?></p>
                                    <p class="my-0"><?//=date('M Y',$v['time']) ?> <?=ucfirst(Yii::$app->formatter->asDate($v['time'], 'php:F Y'))?></p>

                                </div>
                            </div>
                        </div>

                        <? } ?>    


                        </div>
                    </div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev swiper-button-prev-testi" data-analytics="on" data-analytics-category="country_page" data-analytics-action="testimonies_section" data-analytics-label="control_left"></div>
                    <div class="swiper-button-next swiper-button-next-testi" data-analytics="on" data-analytics-category="country_page" data-analytics-action="testimonies_section" data-analytics-label="control_right"></div>  
                    <div class="swiper-pagination swiper-pagination-testi"></div>
                </div>    
            </div>
        </div>
    </div>
    <div class="container column  mt-60 p-0">
        <div class="logo-pages mb-0 row  no-gutters d-flex align-items-center mt-0">
            <div class="col-12 col-sm-4 col-lg-3 mb-sm-0 mb-lg-0">
            <span>Ils nous ont recommandé</span>
            </div>
            <div class="logos col-12 col-sm-8 col-lg-8 d-flex justify-content-between">
                <span class="trip"><img alt="Tripadvisor" class="img-lazy" data-src="/assets/img/new-home/trip-logo-new-2019.png"></span>
                <span class="trip"><img alt="Petit Futé "  class="img-lazy" data-src="/assets/img/new-home/petit-fute-new-2019.png"></span>
                <span href="#" class="trip"><img alt="Le Routard "  class="img-lazy" data-src="/assets/img/new-home/routard-logo-new-2019.png"></span>
                <span class="trip"><img alt="Lonely Planet "  class="img-lazy" data-src="/assets/img/new-home/lonely-planet-new-2019.png"></span>
            </div>
        </div>
    </div>
</div>

<!--  Include Blogs -->
<?
        include '_inc_data_blogs.php';
?>
<!-- End Include Blogs -->
<!-- BACK BUTTON -->
<!-- End BACK BUTTON -->   
<?
$js=<<<JS

$('.search-form .cs-options').off().on('mouseleave', function(){
        return false;
    }); 
$(document).on('click', '.group-search .cs-select.active .cs-placeholder b', function(){
    $('.search-form .cs-select').removeClass('active');  
}); 
$('.chosen').chosen({ search_contains: true});
 $('.chosen-choices input').keyup(function(){
        if(!$(this).val()){
            $('.chosen-drop .chosen-results').hide();
            return false;
        }
        $('.chosen-drop .chosen-results').show();
    });
$('.tous-slider ').bxSlider({
      minSlides: 1,
      maxSlides: 1,
      moveSlides: 1,
      slideWidth: 940,
      pager: false,
      infiniteLoop: false,
      hideControlOnEnd: true,
    });
$('.secret-slider').bxSlider({
      minSlides: 3,
      maxSlides: 3,
      moveSlides: 1,
      slideWidth: 299,
        pager: true,
      slideMargin: 21.5,
      infiniteLoop: false,
      hideControlOnEnd: true,
    });
$('.amc-testi-slider').bxSlider({
      minSlides: 3,
      maxSlides: 3,
      moveSlides: 3,
      slideWidth: 313,
      slideMargin: 0,
      pager: false,
      responsive: true,
      infiniteLoop: false,
      hideControlOnEnd: true,
    });  

$('#search_destination').on('change', function(evt, params) {
    window.location = '/'+params.selected;
    return false;
  }); 
$(document).on('mouseover', '.bx-wrapper li .item-img', function(){
        $('.bx-wrapper li .item-img .text-slide').removeClass('active');
      //  $(this).find('img').addClass('active');    
        $(this).find('.text-slide').addClass('active');
        $(this).find('.text-on-img').hide();
    });
$(document).on('mouseleave', '.bx-wrapper li .item-img', function(){
    $('.bx-wrapper li .item-img img').removeClass('active');  
    $('.bx-wrapper li .item-img .text-slide').removeClass('active');  
     $(this).find('.text-on-img').fadeIn(500);  
});
        
        // Js get text Filter    
    $(document).on('click','.type-de-voyage .cs-options ul li',function(){      
       var array = [];
        
        $('.type-de-voyage .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
                
                var text = $(this).text();
                array.push($(this).text());
            }
        });
        
        var more = '';
        if(array.join(', ').length > 33){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Type de voyage';
        }
            var text = array.join(', ').substring(0,33) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });    
        
       $(document).on('click','.duree .cs-options ul li',function(){   
       var array = [];
        
        $('.search-length .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
                
                var text = $(this).text();
                array.push($(this).text()); 
            }
        });
        var more = '';
        if(array.join(', ').length > 33){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Durée';
        }
            var text = array.join(', ').substring(0,33) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });        
        
    // End Js get text Filter    
        
   
$(window).bind("load", function() { 


  $('.link-item-preparer').each(function(index) {
        var max = 0;
        var height = $(this).find('.big-text').outerHeight();
        if(max < height){
            max = height;
        }
        
       $('.link-item-preparer .item-preparer .big-text').css("min-height", max);

             
  });
         
});
var swiper = new Swiper('.custom-slides-swiper-testi', {
      slidesPerView: 1,
        
        paginationClickable: true,
        spaceBetween: 0,
        loop: false,
        autoHeight: true,
        navigation: {
            nextEl: '.swiper-button-next-testi',
            prevEl: '.swiper-button-prev-testi',
          },
        pagination: {
            el: '.swiper-pagination-testi', // use version 4.x.x
            clickable: true, // use version 4.x.x
        },
    }); 
        
$('.country-tours .bx-prev').attr({
        'data-analytics': "on", 
        'data-analytics-category': "country_page",
        'data-analytics-action': "cats_section",
        'data-analytics-label': "control_left"
    });         
 $('.country-tours .bx-next').attr({
        'data-analytics': "on", 
        'data-analytics-category': "country_page",
        'data-analytics-action': "cats_section",
        'data-analytics-label': "control_right"
    });     
        
$(window).bind('load', function(){
    
    $('.chosen-container input').attr({ 'data-analytics':'on', 'data-analytics-category':'country_page', 'data-analytics-action':'cities_section', 'data-analytics-label':'search_city' });  
    
});         
JS;
$this->registerJs($js);
$css = <<<CSS
    .bx-wrapper .text-slide{
        background-color: rgba(231,89,37,0.5);
    }
    .tous-slider .item-img{
        height: auto;
    }
    .responsive-entry-body .tous-slider li .item-img:nth-of-type(3n){
        margin-right: 0;
        float: right: 
    }
.container-flud .pourquoi img, .item-preparer img{
    background-color: #e65925;
}
CSS;
$this->registerCss($css);
?>