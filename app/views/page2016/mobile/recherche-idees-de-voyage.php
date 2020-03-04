<?
    use yii\helpers\ArrayHelper;
?>
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country-ideel.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>




<div class="contain container-1 container-filter">
    <div class="row-content">
        <span class="space space-50"></span>
         <? if($theEntry->model->seo != NULL){ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925 tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925 tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
           
        <span class="space space-50"></span>
        <div class="text-sumary">
             <?=
            // $theEntry->model->content;
            //isset($theEntry->model->contentsMobile) ? $theEntry->model->contentsMobile[0]['description'] : '';
           $theEntry->model->text
            ?>
        </div>
<!--        <span class="space space-50"></span>
        <a href="#search-page" data-transition="slide" data-direction="reverse" class="custom-btn-filter custom-btn-filter-fix-posi">
                <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-custom-btn-filter">Afficher les filtres</span>
        </a>
        <span class="space space-50"></span>-->
        <span class="space space-70"></span>
        <div class="all-tour ajaxfilter">
            <div class="getcontent">
                <? if(Yii::$app->request->get('country') != NULL){ ?>
                <span class="space space-30"></span>
                <p data-top="10" id="focus-totalcount" class="tt-totalcount focus-totalcount tt-title tt-fontsize-32 tt-latolatin-bold tt-color-black">Résultat de votre recherche : <br><?= $totalCount ?> voyage<?= $totalCount > 1 ? 's' : ''?></p>
                <span class="space space-50"></span>
                <? } ?>
                
                
                    <?
                    
                        if(Yii::$app->request->get('region') == NULL){
                            $region = 'all';
                        }else{
                            $region = Yii::$app->request->get('region');
                        }
                    
                        if(Yii::$app->request->get('country') == NULL){
                            $country = 'all';
                        }else{
                            $country = Yii::$app->request->get('country');
                        }
                        if(Yii::$app->request->get('type') == NULL){
                            $type = 'all';
                        }else{
                            $type = Yii::$app->request->get('type');
                        }
                        if(Yii::$app->request->get('length') == NULL){
                            $length = 'all';
                        }else{
                            $length = Yii::$app->request->get('length');
                        }
                        if (Yii::$app->request->get('see-more') == NULL) {
                            if (Yii::$app->request->get('page') != NULL) {
                                $seemore = Yii::$app->request->get('page') * 12;
                            }else{
                                $seemore = 12;
                            }

                        } else {
                            $seemore = Yii::$app->request->get('see-more');
                        }

                        if (Yii::$app->request->get('page') == NULL) {
                             $page = $seemore / 12;
                         } else {
                             $page = Yii::$app->request->get('page');
                         }
                         
                        if (Yii::$app->request->get('before-page') == NULL) {
                            $page = $seemore / 12;
                        } else {
                            $page = Yii::$app->request->get('before-page');
                        } 
                         
                        if(Yii::$app->request->get('orderby') == NULL){
                             $orderby = 'def';
                         }else{
                             $orderby = Yii::$app->request->get('orderby');
                         }
                        $amc_text_opt = [
                            'def' => 'Popularité',
                            'newest-date' => 'Dernières nouveautés',
                            'budget-asc' => 'Prix : par ordre croissant',
                            'budget-desc' => 'Prix : par ordre décroissant',
                            'day-asc' => 'Durée : par ordre croissant',
                            'day-desc' => 'Durée : par ordre décroissant',
                        ];
                    ?>
                <div class="amc-row-order-by">
                    <span class="amc-text-title-filter">Trier par :</span>
                    <div class="amc-opt-filter amc-ajax-order-by">
                        <span class="amc-text"><?= Yii::$app->request->get('orderby') == Null ? 'Popularité' : $amc_text_opt[Yii::$app->request->get('orderby')] ?></span>
                        <ul class="amc-list-opt">
                            <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_def" data-opt="def" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'def' ? 'active' : '' ?>">Popularité</li>
                            <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_newest" data-opt="newest-date" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'newest-date' ? 'active' : '' ?>">Dernières nouveautés</li>
                            <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_price_asc" data-opt="budget-asc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'budget-asc' ? 'active' : '' ?>">Prix : par ordre croissant</li>
                            <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_price_desc" data-opt="budget-desc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'budget-desc' ? 'active' : '' ?>">Prix : par ordre décroissant</li>

                            <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_asc" data-opt="day-asc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'day-asc' ? 'active' : '' ?>">Durée : par ordre croissant</li>
                            <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_desc" data-opt="day-desc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'day-desc' ? 'active' : '' ?>">Durée : par ordre décroissant</li>
                        </ul>
                    </div>
                </div>    
                <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                <div class="text-center see-more-prev mb-80 mt-0">
                    <span class="btn-see-more-prev tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white tt-custom ajax-see-more-prev" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='<?= count($voyage) ?>' data-page="<?= $page - 1 ?>">Circuits précédents</span>
                </div>
                <? } ?>
            <?php
                $cnt = 0;
                $count = count($voyage);
                foreach ($voyage as $v) {
                    if(empty($voyage)){
                            echo '<p class="text-center">Aucune offre n\'est disponible pour le moment</p>';
                            break;
                        }
                    $cnt ++;
            ?>
        <div class="clear-fix">
            <div class="item item-<?= $cnt ?>">
                <div class="amc-col col-left">
                    <a href="<?= DIR.$v->slug ?>">
                        <?php
                            if(isset($v->photos) && !empty($v->photos)) {

                                foreach ($v->photos as $value) {

                                    if ($value->model->type == 'summary') {
                                        ?>
                                        <img style="min-height: 15rem;" class="img-lazy img-responsive" alt="<?= $value->model->description ?>" data-src="<?= $value->image ?>">
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <img alt="" style="min-height: 15rem;" class="img-responsive" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                        <?php } ?>

                        <span class="fil-background"></span>
                        
                    </a>                   
                </div>
                <div class="amc-col col-right">
<!--                    <span class="space space-24 space-horizontal"></span>-->
                    <p class="tt-color-6b6b6b tt-fontsize-28 p-0 m-0 amc-fix-mt-12-0">
                        <?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
<!--                    <span class="space space-50 space-horizontal"></span>-->
                    <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-custom p-0 m-0 amc-fix-mt-15"><a href="<?= DIR.$v->slug ?>"><?= str_replace('|', '', $v->title) ?></a></h2>
                     <? if($v->model->sub_title != NULL){?>
<!--                        <span class="space space-24"></span>-->
                        <p class="m-0 p-0 amc-fix-mt-12 tt-fontsize-28 tt-latolatin-regular tt-custom-sub-tt"><?= $v->model->sub_title ?></p>
                    <? } ?> 
<!--                    <span class="space space-40 space-horizontal"></span>-->
                    <p class="w-100 m-0 p-0 amc-fix-mt-15">
                       
                        <?= $v->model->summary ?>
                       
                    </p>
<!--                    <span class="space space-50 space-horizontal"></span>-->
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
<!--                    <ul class="list-info">
                        <?//php if(isset($v->data->countries)){?>
                        <li class="country"><span><?//= str_replace(',','<br>',ucwords(implode(', ', $v->data->countries))) ?></span></li>
                        <?//php }?>
                        <?//php 
                          //  $width_loaitour = Null;
                          //  if($v->model->days != ''){ 

                            ?>
                           <li class="time"><span><?//= $v->model->days?> jours <br><?//= $v->model->nights?> nuits</span></li>
                        <?//php }else{ $width_loaitour = 'width: 60%;'; } ?>

                        <?//php

//                            $wr = Yii::getAlias('@webroot');
//                            $img_icon = NULL;
//                            $w = '2.25rem';
//                            $h = '2.3rem';
//
//                            $data = $v->parents();
//                            $last = end($data);
//
//                            if(isset($last->photos)) {
//                                foreach ($last->photos as $image) {
//                                    if($image['type'] == 'icon-banner'){
//                                        $img_icon = $image['image'];
//                                        if(file_exists($wr.$img_icon)){
//                                            $img_size = getimagesize($wr.$img_icon);
//                                            $w = $img_size[0] / 10;
//                                            $h = $img_size[1] / 10;
//                                        }else{
//                                            $w = 2.8;
//                                            $h = 2.8;
//                                        }
//    //                                    $w = $img_size[0] / 20;
//    //                                    $h = $img_size[1] / 20;
//                                    }
//                                }
//                            }else{
//                                $img_icon = '/assets/img/mobile/icon-tour-45-46.png';
//                            }
                        ?>
                        <li class="loaitour" style="<?//= $width_loaitour ?>">
                            <span class="icon" style="width: <?//= $w.'rem'?>; height: <?//= $h.'rem'?>; background-image: url(<?//= $img_icon?>);"></span>
                            <span class="text"><?//= $last->title ?></span>
                        </li>
                    </ul>-->
<!--                     <span class="space space-30 space-horizontal"></span>-->
                   
                </div>
            </div>
           
        </div>
             <? if($cnt < $count){ ?>
            <span class="space space-txt-80"></span>
            <? } ?>    
            <? } ?>
            
                
            <?
            if($totalCount == 13 || $totalCount == 14){
                $seemore = $totalCount;
            }        
            if ($totalCount > $seemore && ($totalCount / 12) > $page) {
            ?>    
            <div class="amc-area-detaile-number-items">
                <span class="space space-txt-80"></span>        
                <? if($totalCount < 2){ ?>
                    <span class="amc-text">Vous avez vu le seul circuit <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
                <? }else{ ?>
                    <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> circuits sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
                <? } ?>
                <span class="space space-40"></span>
                <div class="amc-progress mt-txt-25">
                    <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
                </div>
                <span class="space space-20"></span>
            </div>
            
           
            <span class="space space-30"></span>
               <div class="see-more">
                <span class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='' data-page="<?= $page + 1 ?>">Plus de circuits</span>
            </div>
            <span class="space space-20"></span>
           <? } ?>
            
            </div>
            
        
        </div>
        
        <span class="space space-60"></span>
    </div>
</div>    


<? 
$uri = '/'.URI;
$js = <<< JS
$(function() {

 
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
        
        
        
    $(window).on('orientationchange resize', function(event) {

        if(event.orientation == 'portrait') {
            
            // alert('portrait');
             $('.all-tour .item').each(function() {
                $(this).children('.col-left').children('a').removeClass('fix-xoay-ngang');
               // var image = $(this).children('.col-left').children('a').children('img').attr('src');
               // var heightcolright = $(this).children('.col-right').height();
                $(this).children('.col-left').children('a').removeAttr("style");
                $(this).children('.col-left').children('a').children('img').show();

            });
            
        }
        else if(event.orientation == 'landscape') {
            // alert('landscape');
            $('.all-tour .item').each(function() {
                $(this).children('.col-left').children('a').addClass('fix-xoay-ngang');
                var image = $(this).children('.col-left').children('a').children('img').attr('src');
                var heightcolright = $(this).children('.col-right').height();
                $(this).children('.col-left').children('a').css({'height' : heightcolright + 'px','background-image' : 'url('+image+')'});
                $(this).children('.col-left').children('a').children('img').hide();

            });

        }
    });    
        
    
        
    // Fixed btn Filter
        
 
//$(window).bind('load',function(){
//    var iScrollPos_filter = 0;
//var positionMenu_filter = $('.custom-btn-filter').position();
//
////$(document).on('scrollstart', function(event) {
//  
//  $(document).on('scroll', function(event) {
//    
//    if ($(document).scrollTop() > positionMenu_filter.top) {
//        var iCurScrollPos_filter = $(document).scrollTop();
//
//        if (iCurScrollPos_filter > iScrollPos_filter) {
//           
//            
//            $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
//       
//
//        } else {
//          
//            $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
//
//       
//        }
//        iScrollPos_filter = iCurScrollPos_filter;
//        
//
//    } else {
//        
//        $('.custom-btn-filter').removeClass('btn-filter-fixed-bottom');
//       
//    }
//  });
////});
//});
// End Fixed btn Filter    
   
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>