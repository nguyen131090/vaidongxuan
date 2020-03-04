<? if(Yii::$app->request->isAjax) : ?>
    <? if($type == 'formules') : ?>
    <!-- Start of second page -->
    <div class="header" data-role="header">
        <a class="back-menu" href="<?=URI?>" data-rel="back" data-transition="fade" data-direction="reverse">Formules en option <img alt="" data-src="<?=DIR?>assets/img/mobile/icon_x_white_45_46.png" data-ajax='false'></a>
        <div class="menu-content-secret">
            <div class="menu-secret-slider">
                <div class="swiper-wrapper">
                    <? foreach ($theProgram as $key => $value) : ?>
                    <div class="swiper-slide <?=$key==0 ? 'active' : '' ?>">
                        <span class="title tt-latolatin-semibold tt-fontsize-32"><?= isset($value->model->title) ? str_replace('|','',$value->model->title) : ''?></span>
                    </div>
                    <? endforeach; ?>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div><!-- /header -->

    <div role="main" class="ui-content">
        <!-- Popup Tour Exclusivites-->
                <? foreach ($theProgram as  $key => $p) :?>
                     <div class="item  item-<?= $key ?> <?=$key==0 ? 'active' : '' ?>">
                        <div class="banner">
                        <? if(!empty($p->photosArray['banner'])) : 

                             $v = $p->photosArray['banner'][0];

                        ?>
                        <img class="lazyload" data-sizes='auto' alt='<?= $v->description?>' data-srcset='<?=DIR?>thumb/660/440/1/80<?= $v->image?> 450w, <?= $v->image?>'>
                         <? else : ?>
                        <img alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img-banner-popup.jpg">
                        <? endif; ?>
                        <p class="tt tt-latolatin-bold tt-fontsize-32"><?= $p->model->title ?></p>
                    </div>
                        <div class="entry entry-1">
                            <ul class="list">
                                <li class="posi">
                                    <img data-src="/assets/img/page2016/posi.png" alt="">
                                    <span>
                                    <?php
                                        $j = 0;
                                        
                                        foreach ($p->data->locations as $v) {
                                           $j ++;  
                                           echo $location[$v];
                                           if($j < count($p->data->locations)){
                                               echo ', ';
                                           }
                                        }
                                    ?>
                                    </span>
                                </li>
                                <li class="plus-<?=$p->category_id?>">
                                    <? if(isset($p->cat->photosArray['icon-banner'])) : 
                            $v = $p->cat->photosArray['icon-banner'][0];
                            ?>
                        <img data-src="<?=$v->image ?>" alt="" />
                        <? endif; ?>
                                    <span><?= $p->parents()[0]->title; ?></span>
                                </li>
                            </ul>
                            <div class="summary">
                                <p>
                                    <?= $p->model->summary?>
                                </p>
                            </div>
                            <span name="<?= $p->title?>" class="btn-extension tt-fontsize-32 tt-latolatin-bold <? if(Yii::$app->session->get('data_extension') && array_key_exists ($p->title, Yii::$app->session->get('data_extension'))) echo 'active'?>" name="<?= $p->title?>"><?=(Yii::$app->session->get('data_extension') && array_key_exists ($p->title, Yii::$app->session->get('data_extension'))) ? 'Ajoutée au programme' : 'Ajoutez cette formule au programme'?></span>
                            <div class="program full-width tt-fontsize-32 tt-latolatin-regular">
                                <?= $p->model->description?>

                            </div>
                        </div>

                    </div>
            
                <? endforeach; ?>

    </div><!-- /content -->
    <? endif; ?>
    <? if($type == 'combien') : ?>
        <!-- start comment and combien page -->
        <? include('_comment-combien.php') ?>
        <!-- END -->

    <? endif; ?>
<? else : ?>    
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/menu-all-page-destinations.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $tourImages = $theEntry->photosArray;  ?>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content top-tour mb-80">
            <h1 class="title main-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925"><?= str_replace('|', '',$this->context->pageT)?></h1>
            <p class="tt-s no-margin"><?= $theEntry->model->sub_title?></p>
            <ul class="features-tour">
                <? if(isset($theEntry->data->countries)) :?>
                    <li class="posi countries" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="link_country">
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
                <li class="calendar tt-latolatin-bold">
                    <img data-src="/assets/img/page2016/icon_time.png" alt="">
                    <span>
                    <?= $theEntry->model->days?> jours<br><?= $theEntry->model->nights?> nuits
                    </span>
                </li>
                <li class="tour-type tt-<?= $theEntry->cat->category_id?> tt-latolatin-bold" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="link_inspi_itineraries">
                     <a class="tt-latolatin-bold" id="tour-type" href="<?=DIR.str_replace('voyage', SEG1.'/'.SEG2, $theEntry->cat->slug)?>" style="<?= $theEntry->cat->category_id == 1 ? 'white-space: nowrap; display: inline-block;' : ''; ?>">
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
            <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-devis tt-latolatin-bold tt-fontsize-32 pugjd mb-0" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="cta_devis">Demander votre devis</button>
        
             <? if(isset($theEntry->data->budget) && $theEntry->data->budget != ''){ ?>
            <div class="btn-price mt-50">
<!--                <img data-src="/assets/img/page2016/icon-price.png" alt="">-->
                <p class="tt tt-fontsize-32"><span class="tt-latolatin-bold">Budget moyen</span> <?= 'à partir de '.$theEntry->data->budget.' €' ?></p>
            </div>
            <? } ?>
            
        </div>
        
        <? include_once '_inc_video_page.php'; ?>  
        
        <div class="row-content tour-body mt-0">
            <!-- menu for content tour -->
            <div class="mb-50" style="height: 6rem;">
                <div class="menu-content full-width mb-0">
                    <div class="menu-slider swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide active"><span data-scroll = 'itineraire' data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_itineraire">Itinéraire</span></div>
                            <div class="swiper-slide"><span data-scroll = 'esprit' data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_spirit">Esprit</span></div>
                            <div class="swiper-slide"><span data-scroll = 'budget-voyage' data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_price">Prix</span></div>
                            <div class="swiper-slide"><span data-scroll = 'tour-detail' data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_programm">Descriptif du programme</span></div>
                            <? if($theProgram) : ?>
                            <div class="swiper-slide"><span data-scroll = 'formules-options' data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_secrets">Formules en option</span></div>
                            <? endif; ?>
                            <? if(isset($theEntry->data->folder) && $theEntry->data->folder) { ?>
                            <div class="swiper-slide">
                            <span data-scroll = 'folder' data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_folder">Bibliographie</span>
                            </div>
                            <? } ?>
                            <div class="swiper-slide"><span data-scroll = 'comment-combien' data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_how">Quand comment & combien</span></div>
                        </div>
    <!--                    <div class="swiper-scrollbar"></div>-->
                        <div class="button-slider menu-swiper-button-prev swiper-button-prev"></div>
                        <div class="button-slider menu-swiper-button-next swiper-button-next"></div>
                    </div>

                </div>
            </div>    
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

                <div id="esprit" class="text points entry-body item-tour-content mb-80">
                        <?php 
                            $points = [];
                            if(isset($theEntry->data->points)){
                                $points = explode('<hr />', $theEntry->data->points);
                            }  
                            $i = 0;
                                foreach ($points as $key => $value) {
                                    if($key == $i){
                                    $points_cont[$i] = $value;
                               }
                               $i++;
                            }
                            
                            if(isset($points_cont[0])){
                                echo str_replace(['<h4>','</h4>'], ['<h3>','</h3>'], $points_cont[0]);
                            }
                        ?>
                </div>
                <? if(!empty($theEntry->data->price)) :  ?>
                <div class="price-tour mb-80 mt-0 item-tour-content" id="budget-voyage" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="price_section" data-analytics-label="acc_price">
                    <p class="title-price sub-title-page tt-latolatin-bold tt-fontsize-40 tt-color-e65925">Détails du prix</p>
                    <?=$theEntry->data->price ?>
                </div>
                <? endif; ?>
                <div id="tour-detail" class="item-tour-content">
                    <p class="title-price sub-title-page tt-latolatin-bold tt-fontsize-40 tt-color-e65925 mt-0">Descriptif du programme</p>
                    <?php
                         $body = preg_replace('/<h3>(.*?)-(.*?)<\/h3>/', '<div class="jour tab-children no-switch active"><h3 class="first-jour"><span class="fix-jour">$1</span><span class="tt">$2</span></h3><div class="entry-content">', $theEntry->description, 1);
                        
                        $body = preg_replace('/<h3>(.*?)-(.*?)<\/h3>/', '</div></div><div class="jour tab-children no-switch active"><h3 class="first-jour"><span class="fix-jour">$1</span><span class="tt">$2</span></h3><div class="entry-content">', $body);
                        $body = preg_replace('/<img[^>]+\>/i', '', $body);
                        echo $body . "</div></div>";
                    
                    ?>
                    <span class="space space-50"></span>
                </div>

                <div class="notes" style="display: none;">
                    <?php
                        $node_image = []; 
                        $node_image = \yii\helpers\ArrayHelper::map($notes, 'slug','photos');
                    
                       
                        $node_title = \yii\helpers\ArrayHelper::map($notes, 'slug','title');
                        if(isset($theEntry->model->notes) && $theEntry->model->notes != NULL){
                            foreach (json_decode($theEntry->model->notes) as $key=>$value) {

                                echo '<ul id="'.$key.'" class="note note-'.$key.'">';
                                foreach ($value as $v) {

                                    echo '<li class="'.$v.'" style="background-image: url('.$node_image[$v][0]->image.');">'.$node_title[$v].'</li>';
                                }
                                echo '</ul>';
                            }
                        }
                         
                    ?>
                </div>
                <? if($theProgram) : ?>
                <div class="item-tour-content" id="formules-options">
                    <span class="space space-40"></span>
                    <p class="sub-title-page tt-latolatin-bold tt-color-e65925 tt-fontsize-40 m-0 p-0">Formules insérables dans ce voyage</p>
                    <span class="space space-40"></span>
                    <div class="secret-slider">
                        <div class="swiper-wrapper">
                            <? foreach ($theProgram as $key => $value) : ?>
                            <div class="swiper-slide">
                            <? if(isset($value->photosArray['banner'])) : 
                            $v = $value->photosArray['banner'][0]; ?>
                                <img alt="<?= $v->description?>"
                                        data-src="<?=$v->image?>" 
                                        data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                        data-sizes="auto"
                                        class="banner-img lazyload" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_<?= $v->model->item_id ?>" />
                            <? endif; ?>
                            <p class="title tt-latolatin-bold tt-fontsize-32" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_t_<?= $v->model->item_id ?>"><?= isset($value->model->title) ? str_replace('|','',$value->model->title) : ''?></p>
                            </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <span class="space space-40"></span>
                </div>
                <? endif; ?>
            
                <? if(!empty($theEntry->data->folder)) {  ?>
               
                <div id="folder" class="text points entry-content entry-body item-tour-content mt-0">
                    <span class="space space-40"></span>
                        <p class="title-price sub-title-page tt-latolatin-bold tt-fontsize-40 tt-color-e65925 m-0 p-0">Bibliographie</p>
                        <span class="space space-40"></span>
                        <?= $theEntry->data->folder ?>
                </div>
                <? } ?>
            
                <div class="item-tour-content" id="comment-combien" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="img_how">
                    <a href="#comment-combien-page"><img alt="" data-src="/thumb/225/164/1/80/assets/img/page2016/img_special_all.png&a=t"></a>
                </div>

        </div>
        <?
        if(!empty($arrSuggest)){
        ?>
        <div class="swiper-container full-width my-0">
            <p class="sub-title-page tt-latolatin-bold tt-color-e65925 tt-fontsize-40 mt-0">Découvrez d'autres circuits</p>    
            <div class="countries-slider suggest-slider">
                    <div class="swiper-wrapper">

                    <? foreach($arrSuggest as $key => $v) : ?>
                        <div class="swiper-slide item-img swiper-slide-80">
                        <a href="<?=DIR.$v->slug ?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?= $v->model->item_id ?>">
                            <? if(isset($v->photosArray['summary'])) : ?>
                            <img class="amc-img" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/299/200/1/100<?=$v->photosArray['summary'][0]->image ?>">
                                <? endif; ?>
                        </a>    
                            <div class="text pl-15 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block">
<!--                            <span class="space space-10 space-horizontal"></span>    -->
                            <p class="tt-color-6b6b6b tt-fontsize-28 p-0 m-0 amc-fix-mt-12-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                            <p class="m-0 p-0 amc-fix-mt-15 tt tt-1 tt-fontsize-40 tt-latolatin-bold tt-line-height-1-2" name="pop-<?=$key+1 ?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $v->model->item_id ?>">
                                <a class="tt-line-height-1-2 tt-latolatin-bold" href="/<?=$v->slug?>"><?=$v->title;?></a>
                            </p>
                            <p class="sub-title m-0 p-0 amc-fix-mt-15"><?=\app\helpers\Text::limit_text($v->model->summary, 100); ?></p>
                            <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                <p class="tt-color-6b6b6b tt-fontsize-28 m-0 p-0 amc-fix-mt-15">
                                    <?= (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0) ? $v->model->days.' jours ' : ''; ?> 
                                    <?   
                                        if((isset($v->data->budget) && $v->data->budget != '')){
                                            if(isset($v->model->days) && $v->model->days != '' && $v->model->days > 0){
                                                echo 'à partir de '.$v->data->budget.'€'; 
                                            }else{
                                                echo 'À partir de '.$v->data->budget.'€'; 
                                            }
                                        }    

                                    ?>
                                </p>
                            <? } ?>
                            <span class="space space-50"></span>    
                        </div>
                        
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <span class="space space-80"></span>
        <? } ?>
    </div>
</div>
        
<button  class="btn-devis tt-latolatin-bold tt-fontsize-32 ui-link ui-footer-fixed" data-position='fixed' data-ajax="false">
    <span data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-bottom-form-call pugjd" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_devis">Demander votre devis</span>
    <a href="tel:+33619081572" class="btn-bottom-form-call btn-phone" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_call">Call</a>
</button>


<!-- load ajax for formules page -->
<div data-role="page" class="menu-page formules-page" id="formules-page" data-url="formules-page" data-theme="b">
</div>
<? endif; ?>
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
        
//        scrollbar: '.swiper-scrollbar',
//        scrollbarHide: false,
//        nextButton: '.menu-swiper-button-next',
//        prevButton: '.menu-swiper-button-prev',
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 20,
        grabCursor: true,
        initialSlide: 0,
//        scrollbar: {
//            el: '.swiper-scrollbar',
//            draggable: true,
//        }
        navigation: {
            nextEl: '.menu-swiper-button-next',
            prevEl: '.menu-swiper-button-prev',
          },
    }); 
        
        
//$('.menu-swiper-button-next').click(function(){
//    menuSwiper.slideNext();
//});
//$('.menu-swiper-button-prev').click(function(){
//    menuSwiper.slidePrev();
//});
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
        slidesPerView: 1.2,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });
        
var suggestSwiper = new Swiper('.suggest-slider', {
        slidesPerView: 2.1,
        centeredSlides: false,
        spaceBetween: 20,
        loop: false,
        breakpoints: {
            450: {
                slidesPerView: 1.1,
            }
        }
    });       

$('.menu-slider .swiper-slide span').off().click(function(){
    var id = '#'+$(this).data('scroll');
    var index = $(this).parent().index();
    var top = $(id).offset().top - 70;
    $('.menu-slider .swiper-slide').removeClass('active');
    $(this).parent().addClass('active');
   menuSwiper.slideTo(index);    
    $('html, body').animate({
        scrollTop: top
    }, 200);
})


$('.secret-slider .swiper-slide').click(function(){
    var getFormules = false;
    $.post("$url", {type : 'formules'}, function(data){
        $('#formules-page').html(data);
        getFormules = true;
    });
    var eq = $(this).index();
    var newPage = $('#formules-page');
    newPage.appendTo($.mobile.pageContainer);
    $.mobile.changePage( "#formules-page", {
        transition: "slide"
    });
    $(document).ajaxStop(function () {
        if(getFormules){
            var menuFormulesSwiper1 = new Swiper('#formules-page .menu-secret-slider', {
            scrollbar: '.swiper-scrollbar',
            scrollbarHide: false,
            slidesPerView: 'auto',
            centeredSlides: false,
            loop: false,
            spaceBetween: 20,
            freeMode: false
        });
        
        $('#formules-page  .menu-secret-slider .swiper-slide').click(function(){
                     
            var index = $(this).index();
            menuFormulesSwiper1.slideTo(index);
            $('#formules-page  .menu-secret-slider .swiper-slide').removeClass('active');
            $(this).addClass('active');
            $('#formules-page .item').removeClass('active');
            $('#formules-page .item-'+index).addClass('active');
               
        });
        $('#formules-page  .menu-secret-slider .swiper-slide').eq(eq).trigger('click');
        var curPage = $.mobile.activePage.attr("id");
        $(window).on('scroll', function() {
            if(curPage == 'formules-page'){
                    if($(document).scrollTop() > 30){
                        $('#formules-page .header').attr('data-position','').removeClass('ui-header-fixed');
                        $('.menu-content-secret').data('position', 'fixed').addClass('ui-header-fixed');
                        $('#formules-page .back-menu').data('position', '').removeClass('ui-header-fixed');
                    }
                    var st = $(this).scrollTop();
                       if (st <= lastScrollTop){
                            if($(document).scrollTop() > 30){
                                $('.menu-content-secret').data('position', '').removeClass('ui-header-fixed');
                                $('#formules-page .header').attr('data-position','fixed').addClass('ui-header-fixed');
                            } else{
                                 $('#formules-page .header').attr('data-position','').removeClass('ui-header-fixed');
                            }
                       }
                       lastScrollTop = st;
            }
        }); 
        $('#formules-page .btn-extension').click(function(){
        getFormules = false;
        var hClass = $(this).hasClass('active');
        var extension = $(this).attr('name');
        var target = $(this);
                console.log(hClass);
           
        if(hClass){
           // $(this).text('AJOUTÉ AU PROGRAMME');
            
            var url = '$dir_uri' + '/form';
            var target = $(this);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        type: 'remove-selected',
                        extension: extension,
                        
                    },
                    success: function(data) {
                       target.removeClass('active');
                       target.text('Ajoutez cette formule au programme');
                    }

                });
        return false;
        }else{
           // $(this).text('AJOUTEZ AU PROGRAMME');
           
            var url = '$dir_uri' + '/form';
            var target = $(this);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        type: 'selected',
                        extension: extension,
                        
                    },
                    success: function(data) {
                        target.addClass('active');
                        target.text('Ajoutée au programme');
                    }

                });
        return false;
        }
   }); 
        $('.header .back-menu').click(function(){
            scrollMenu();
        })
        getFormules = false;
        }
         
    });

    
})

var curPage = $.mobile.activePage.attr("id");
var lastScrollTop = 0;
scrollMenu();
var tourContent = [];
function scrollMenu(){
    $(window).on('scroll', function() {
        var curPage = $.mobile.activePage.attr("id");
        var st = $(this).scrollTop() + 40;
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
                    tourContent[$('.item-tour-content').index(this)] = $(this).offset().top - 60;
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
                } else if(st >= tourContent[4] && st < tourContent[5]){
                    menuSwiper.slideTo(4);
                    $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(4)').addClass('active');
                } else if(st >= tourContent[5] && st < tourContent[6]){
                    menuSwiper.slideTo(5);
                    $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(5)').addClass('active');
                }else if(st > tourContent[6]){
                    menuSwiper.slideTo(6);
                    $('.menu-slider .swiper-slide').removeClass('active');
                    $('.menu-slider .swiper-slide:eq(6)').addClass('active');
                }
        
        lastScrollTop = st;
    }); 
}

$(document).on("pagechange", function(toPage) {
    scrollMenu();
});

$('#comment-combien').click(function(){
    var getCombien = false;
    $.post("$url", {type : 'combien'}, function(data){
        if($('#comment-combien-page').length < 1){
            $('#page1').after(data);
            getCombien = true;
        }
    });
    
    $(document).ajaxStop(function () {
        if(getCombien){
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
    }); 
    $('#comment-combien-page .item table').each(function(){
        $(this).wrap('<div style="overflow-x:auto">');
    });
    getCombien = false;
        }
           
    });
    
});
$('.price-tour .title-price').click(function(){
    $(this).parent().toggleClass('active');
})

//Jquery select option extensions
JS;
$this->registerJs($js); 
$css = <<<CSS

CSS;
$this->registerCss($css);
?>