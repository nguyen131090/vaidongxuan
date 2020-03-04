<?php 
use \yii\helpers\ArrayHelper;
$this->registerCssFile('/assets/css/page2016/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/exclusivites-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $fields = $theEntry->model->category->fields; 
$fields = ArrayHelper::map($fields, 'name', function($e){
    return $e;
});
?>
<div class="container-fluid sub-header-fixed text-center <?= IS_TABLET === true ? 'sub-header-fixed-tablet' : ''?>">
    <div class="amc-column container text-left row px-0">
        <div class="col-auto col-sm-auto max-width-25 d-none d-sm-none d-lg-flex justify-content-start align-items-center px-0">
            <p class="tt m-0"><?=$theEntry->title ?></p>
        </div>
        <div class="col group-icon col-sm d-inline-flex justify-content-center align-items-center text-center pr-0 pl-0">
            <? if(isset($theEntry->data->rate) && $theEntry->data->rate) : ?>
            <div class="pl-0 pr-20 col-sm mr-0 text-center calendar flex d-inline-flex justify-content-center align-items-center list-unstyled no-gutters">
                        <div class="rate-icon position-relative">
                        <img data-src="/assets/img/classement_new_1.png" alt="">
<!--                        <span class="number-rate"><?//=array_keys($fields['rate']->options, $theEntry->data->rate)[0] + 1?></span>-->
                    </div>
                    <div class="col col-sm text-left pl-2">
                    <p class=" d-inline-block rate-title mb-0"><?=$theEntry->data->rate ?></p>
                    </div>
                </div>
                   <? endif; ?>     

                    <?php if(isset($theEntry->data->city)){?>
                        <div class="px-0 col col-sm text-center posi countries flex d-inline-flex justify-content-center align-items-center list-unstyled">
                            <img data-src="/assets/img/page2016/posi-big.png" alt="">
                            <div class="posi-link text-left pl-2">
                             <? if(isset($theEntry->data->city)) : ?>
                                    <? $city  = json_decode($theEntry->data->city); ?>
                                    <? if($city) :?>
                                    <? foreach ($city as $key => $value){
                                        $title = $value->stitle ? $value->stitle : $value->title;
                                       if($value->status == 1){
                                        echo "<a data-analytics
='on' data-analytics-category='secret_single' data-analytics-action
='navintro_section' data-analytics-label
='link_city'  href='/".$value->slug."'>".$title."</a>, ";
                                       } else{
                                            echo $title.', ';   
                                       } 
                                    } ?>
                                    <? else: ?>
                                    <? echo  $theEntry->data->city.', ';?>
                                    <? endif; ?>
                                <? endif; ?>
                                <a data-analytics
='on' data-analytics-category='secret_single
' data-analytics-action='navintro_section' data-analytics-label
='link_country' href="/<?=SEG1 ?>"><?=ucfirst(SEG1)?></a>
                            </div>
                        </div>
                    <?php }?>    
                    <div class="pl-0 pr-10 col col-sm text-center tt-<?= $theEntry->cat->category_id?> flex d-inline-flex justify-content-center align-items-center list-unstyled">
                        <? if($theEntry->cat->photosArray['icon-banner']) : 
                            $iconCat = $theEntry->cat->photosArray['icon-banner'][0];    
                            ?>
                        <img data-src="<?=$iconCat->image?>" alt="">
                        <? endif ?>
                         <a  data-analytics
='on' data-analytics-category='secret_single
' data-analytics-action
='navintro_section' data-analytics-label='link_secrets_inspi_itineraries' class="pl-2 text-left" href="<?=DIR.SEG1.'/'.$theParent->slug?>">
                            <?= $theParent->title?>
                        </a>
                    </div>
        
                    <div class="col-5 col-sm-4 px-0 col-lg-5 text-center btn-devis flex-wrap d-inline-flex justify-content-end align-items-center list-unstyled">
                        <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-booking-top btn-amica-basic btn-amica-basic-2 pugjd"  data-analytics
='on' data-analytics-category='secret_single
' data-analytics-action ='navintro_section' data-analytics-label
='cta_devis'>Contactez-nous pour plus de détails*</button>
                    </div>
        </div>
    </div>
</div> 

<div class="contain container-1">
    <?php
      
        if(!empty($theEntry->photos)){
            
            foreach ($theEntry->photos as $v) {
               
                if($v->model->type == 'banner'){
            
     ?>
    <img alt="" style="width: 100%" class="banner img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
        <?php
                }
            }
        
         }else{
       ?>
    <img alt="" class="img-lazy" style="width: 100%;" data-src='<?=DIR?>upload/image/banner-idees-de-voyage-single.jpg'>
         <?php } ?>
     <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
        <div class="breadcrumb">
          <div class="item">
            <a href="/"><span data-analytics="on" data-analytics-category="secret_single" data-analytics-action="breadcrumb_section" data-analytics-label="home_page">Accueil</span></a> <span> &gt; </span> 
            
          </div>
          <div class="item">
            <a href="<?=DIR.SEG1 ?>"><span data-analytics="on" data-analytics-category="secret_single" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"> <?=ucfirst(SEG1)?></span></a> <span> &gt; </span> 
            
          </div>
           <div class="item">
            <a data-analytics="on" data-analytics-category="secret_single" data-analytics-action="breadcrumb_section" data-analytics-label="secrets_itineraries" href="<?=DIR.SEG1 ?>/formules"><span> Formules</span></a> <span> &gt; </span> 
            
          </div>
            
            <div class="item">
            <span><span><?= isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title?></span></span>
            
          </div>
        </div>
<?
$id_2 = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.SEG1;
$name_2 = ucfirst(SEG1);
$id_3 = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.SEG1.'/formules';
$name_4 = isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title;
$id_4 = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->entry->slug;
$txt_first =<<<TXT
{
"@context": "http://schema.org",
"@type": "BreadcrumbList",
"itemListElement": [{
"@type": "ListItem",
"position": 1,
"item": {
"@id": "https://www.amica-travel.com/",
"name": "Accueil"
}
},{
"@type": "ListItem",
"position": 2,
"item": {
"@id": "$id_2",
"name": "$name_2"
}
},{
"@type": "ListItem",
"position": 3,
"item": {
"@id": "$id_3",
"name": "Formules"
}
},{
"@type": "ListItem",
"position": 4,
"item": {
"@id": "$id_4",        
"name": "$name_4"
}
}]
}
TXT;

$this->context->json_ld_breadcrumd = $txt_first;

?>     
    </div>
</div>

<div class="contain container-2 non-area-form container row-content-1 px-0">
    
    <div class="amc-column d-table">
        <div class="intro mt-txt-40 text-center px-20">
            <h1 class="title mt-0 mb-10"><?= str_replace('|', '<br>',$this->context->pageT)?></h1>
            <p class="tt-s mt-txt-5 mb-txt-25">
                <?= $theEntry->model->sub_title?>
            </p>
            <p class="spirit my-0">
                <?= $theEntry->model->spirit?>
            </p>
        </div>
        <div class="sub-intro my-txt-40 row no-gutters ">
                <? if(isset($theEntry->data->rate) && $theEntry->data->rate) : ?>
                    <div class="col col-sm text-center calendar flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                        <div class="rate-icon position-relative">
                        <img data-src="/assets/img/classement_new_1.png" alt="">
<!--                         <span class="number-rate"><?//=array_keys($fields['rate']->options, $theEntry->data->rate)[0] + 1 ?></span>-->
                    </div>
                    <p class=" w-100"><?=$fields['rate']->title ?></p>
                    <p class="rate-title amc-fontsize-14-2"><?=$theEntry->data->rate?></p>
                        </div>
                    <? endif; ?>
                    <?php if(isset($theEntry->data->city)){?>
                        <div class="col col-sm text-center posi countries flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                            <img data-src="/assets/img/page2016/posi-big.png" alt="">
                            <p class="d-block w-100">Localisation</p>
                            <div class="posi-link amc-fontsize-14-2">
                                <? if(isset($theEntry->data->city)) : ?>
                                    <? $city  = json_decode($theEntry->data->city); ?>
                                    <? if($city) :?>
                                    <? foreach ($city as $key => $value){
                                        $title = $value->stitle ? $value->stitle : $value->title;
                                       if($value->status == 1){
                                        echo "<a  data-analytics='on' data-analytics-category='secret_single' data-analytics-action='subintro_section' data-analytics-label='link_city' href='/".$value->slug."'>".$title."</a>, ";
                                       } else{
                                            echo $title.', ';   
                                       } 
                                    } ?>
                                    <? else: ?>
                                    <? echo  $theEntry->data->city.', ';?>
                                    <? endif; ?>
                                <? endif; ?>
                                <a  data-analytics='on' data-analytics-category='secret_single' data-analytics-action='subintro_section' data-analytics-label='link_country'  href="/<?=SEG1 ?>"><?=ucfirst(SEG1)?></a>
                            </div>
                        </div>
                    <?php }?>    
                    <div class="col col-sm text-center tt-<?= $theEntry->cat->category_id?> flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                        <? if($theEntry->cat->photosArray['icon-banner']) : 
                            $iconCat = $theEntry->cat->photosArray['icon-banner'][0];    
                            ?>
                        <img data-src="<?=$iconCat->image?>" alt="">
                        <? endif ?>
                        <p class="d-block w-100">Type de voyage</p>
                         <a class="amc-fontsize-14-2" data-analytics='on' data-analytics-category='secret_single' data-analytics-action='subintro_section' data-analytics-label='link_secrets_inspi_itineraries
'  href="<?=DIR.SEG1.'/'.$theParent->slug?>">
                            <?= $theParent->title?>
                        </a>
                    </div>
                    <div class="col-3 col-sm-4 px-0 pt-20 col-lg-5 text-center btn-devis flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                        <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-booking-top btn-amica-basic btn-amica-basic-2 pugjd"  data-analytics='on' data-analytics-category='secret_single' data-analytics-action='subintro_section' data-analytics-label='cta_devis'>Contactez-nous pour plus de détails*</button>
                    </div>
        </div>
    </div>
</div>

<? if(!empty($theEntry->data->hostdes)) : ?>
<div class="container-fluid  host-container d-inline-block mb-60">
    <div class="container amc-column d-flex flex-wrap align-items-center">
        
        <div class="host-content d-flex align-items-center pt-40 pb-40">
            <?= '<div>' ?>
            <p class="host-tt mt-0 mb-txt-25 d-inline-block"><?=$fields['hostdes']->title;?></p>    
            <?= str_replace(['</div>'], ['</div></div>'], $theEntry->data->hostdes);?>
        </div>
    </div>
</div>
<? endif; ?>

<? include_once '_inc_video_page.php'; ?>

<div class="content-fluid container-fluid px-0 d-table">
   
    <div class="container amc-column pt-0 mt-40 pb-40 position-relative">
        <div class="map">
                    <img alt="" data-src="<?=isset($theEntry->photosArray['map']) ? $theEntry->photosArray['map'][0]->image : ''?>"/>
                </div>
        <div class="content-col entry-body">
        <?=$theEntry->description; ?>
        </div>
        
    </div>
</div>

<div class="container-fluid mt-60 mb-60">
    <? $galeriesBf =  array_reverse($theEntry->photos);
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
                <? $galeriesBf =  array_reverse($theEntry->photos);
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
            <div class="row">
                <? include('_inc_galeries_tour.php') ?>
            </div>
        </div> 
<div class="contain container-4 text-center">
    <div class="amc-column container text-left">
         <div class="d-block devis-btn-block mt-0  container-fluid d-flex justify-content-center align-items-center py-20">
            <div class="text text-center mr-40 ">
                Cette formule vous intéresse ? 
            </div>
            <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
            <button  data-analytics="on" data-analytics-category="secret_single" data-analytics-action="quote_section" data-analytics-label='
cta_devis'  data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="ml-60 btn-amica-basic btn-amica-basic-2 pugjd" >Contactez-nous pour plus de détails*</button>
        </div>
        <p class="des-button text-center my-60 mx-auto" style="clear: both;">
            <? if(isset($theEntry->data->note) && $theEntry->data->note) : ?>
            <i class="">
            <?=$theEntry->data->note ?>
            </i>
        <? endif; ?></p>
    </div>
    
</div>  
    
<div class="contain container-6 fix-space-vs-back-button mt-txt-0 text-center">
    <div class="amc-column text-left">
        <? if($theProgram) : ?>  
        <p class="tt p-0 mr-0 mb-txt-40">Les voyages pouvant inclure cette formule</p>
        <div class="related-articles mt-0 mb-20 row">
        <?php
                    function is_array_empty($a){
                        foreach($a as $elm)
                        if(!empty($elm)) return false;
                        return true;
                    }
                    if(is_array_empty($theProgram) == false){
                        
                ?>
                
                    <?php
                        $cnt = 0;
                        $count = count($theProgram);
                        foreach ($theProgram as $v) {
                           $cnt ++; 
                    ?>
                        
                            <div class="mb-0 item col-sm-4 item-<?= $cnt ?> <?= $cnt % 3 != 0 ? 'it-l' : 'it-r' ?> mt-0 mb-0">
                                <a href="<?=DIR.$v->slug?>">
                                 <?php
                                    if(!empty($v->photos)){
                                        foreach ($v->photos as $value) {
                                            if($value->model->type == 'summary'){
                                                echo '<img data-analytics="on" data-analytics-category="secret_single" data-analytics-action="tours_section" data-analytics-label="tour_card_'.$v->model->item_id.'" style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                                            }
                                        }
                                    }else{

                                ?>

                               <img  data-analytics="on" data-analytics-category="secret_single" data-analytics-action="tours_section" data-analytics-label='tour_card_<?=$v->model->item_id ?>'  alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img-exclusi-single-2.jpg">
                                <?php }?>
                                </a>
                                <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                                
                                <p class="tt pt-0 m-0 p-0 amc-fix-mt-25 tt-hover-color-e65925" data-analytics="on" data-analytics-category="secret_single" data-analytics-action="tours_section" data-analytics-label='tour_card_t_<?=$v->model->item_id ?>'>
                                    <a class="tt-line-height-1-2" href="<?=DIR.$v->slug?>">
                                        <?= str_replace('|','',$v->model->title) ?>
                                    </a>   
                                   
                                </p>
                                
                                <div class="summary m-0 p-0 amc-fix-mt-20">
                                    <?= $v->model->summary?>
                                </div>
                                <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                    <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-25 m-0 p-0">
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
                            </div>
                    <?php } ?>

                  
                    <?php }else{
$css = <<<CSS
    .container-back .border-line{
        display: none !important;
   }    
CSS;
$this->registerCss($css);
                    } ?>
                <? endif; ?>
              
        </div>         

    </div>
</div>
 <!-- BACK BUTTON -->
            <? include '_inc_back_button.php'; ?>
            <!-- End BACK BUTTON -->      
<?php

      $img = NULL;                     // var_dump($theEntry->photos);exit;
foreach ($theEntry->photos as $v) {
   if($v->type == 'summary'){
       $img = $v->image;
   }
}


$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');

$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$this->registerJsFile('/assets/js/image-gallery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$seg1 = SEG1;
$dir_uri = DIR.URI;
$dir = DIR;
$uri = URI;
$id = $theEntry->model->item_id;
$title = $theEntry->title;
$image = $img;
$get = Yii::$app->request->get('tab');
$js=<<<JS
var devisTop = $('.sub-intro .btn-devis').offset().top + $('.sub-intro').height();
var map = $('.map');
var mapTop = map.offset().top;
var proTop = $('.content-col').offset().top + $('.content-col').height() + 100;

$(window).scroll(function(){
    
    var scroll = $(window).scrollTop();
    var scrollBot = scroll + $(window).height();
 
    if(scroll > devisTop){ 
            $('.sub-header-fixed').addClass('show'); 
           
        }else{ 
            $('.sub-header-fixed').removeClass('show'); 
            $('.area-btn-list-menu').removeClass('fixed');
            $('.area-btn-list-menu').removeClass('opacity');
            //$('.container-1 .row-1').show();
              
        }
    if (scroll >= mapTop && scrollBot <=proTop){
        map.addClass('sticky');
        $('.content-col').addClass('after-sticky');
    } 
  else{
        map.removeClass('sticky');
        $('.content-col').removeClass('after-sticky');
    } 
});
    
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$css = <<<CSS

   

.form .extension .col-1 .tt{
    margin-top: 30px;
}
.back-button-center-content{
    width: 674px;
    margin-top: 4px;
}
CSS;
$this->registerCss($css);
?>