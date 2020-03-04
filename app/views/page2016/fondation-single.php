<?php $this->registerCssFile('/assets/css/page2016/fondation-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<?

if(SEG2 == 'partenaires'){
    $data_analytics_category = 'partenaire_single';
    $sidebar_lable = 'partenaire_t_';
}
if(SEG2 == 'associations'){
     $data_analytics_category = 'association_single';
     $sidebar_lable = 'association_t_';
}
?>

<div class="contain container-1">
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    
</div>
<div class="contain container-2 mt-60">
    
    <div class="amc-column pt-0">
        <div class="rows row-1 mt-0">
            <div class="r1">
             
                 <div class="icon-logo">
                 <?php
                    $img = false;
                     if(!empty($theEntry->photos) && $theEntry->photos != ''){

                         foreach ($theEntry->photos as $v) {

                             if($v->model->type == 'icon'){
                                 $img = true;
                  ?>
                     
                 <img style="" class="img-left" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
                 
                     <?php
                             }
                         }

                      }
                      
                    ?>
                
                </div>
                <div class="tt">
                    <h1 class="title"><?= $this->context->pageT; ?></h1>
                    <p><?= $theEntry->model->sub_title?></p>
                </div>
            </div>
            <ul>
                <li>Création <span><?= $theEntry->data->date?></span></li>
                <li>Adresse <span><?= $theEntry->data->adresse?></span></li>
                <?php if($theEntry->data->website != ''){ ?>
                <li>Site internet<span><a href="<?= $theEntry->data->website?>" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="subintro_section" data-analytics-label="link_siteinternet">Voir le site</a></span></li>
                <?php } ?>
            </ul>
        </div>
        <div class="rows row-2 entry-body mt-txt-40">
            <div class="amc-col-left pr-40">
            <?= str_replace('src="', 'data-src="', $theEntry->model->description)?>
            </div>
            <div class="amc-col-right mt-25">
                <div class="area area-1">
                    <p class="tt-area-1">En collaboration avec...</p>
                    <ul>
                        <?php
                            foreach ($theEntries as $v) : ?>
                                <li><a href="<?=DIR.$v->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= $sidebar_lable.$v->item_id ?>">
                                <?php
                                    $image = FALSE;
                                      if(!empty($v->photos)){
                                          foreach ($v->photos as $value) {
                                              if($value->type == 'summary'){
                                                  $image = TRUE;  
                                                  echo '<img style="" alt="'.$value->description.'" class="" data-src="'.DIR.'thumb/40/40/1/80'.$value->image.'">';
                                              }
                                          }
                                      }
                                      

                                  ?>

                                  
                                   
                                
                                <span><?=$v->title ?></span>
                            </a></li>
                            <? endforeach;?>
                        
                    </ul>
                    
                    
                </div>
                
                <div class="area area-2 mt-25 lazy-background" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="cta_tourisme">
                    <p class="tt-area-2">Tourisme solidaire et responsable par Amica</p>
                    <a href="<?= DIR.'tourisme-solidaire' ?>" class="btn">En savoir plus</a>
                </div>
            </div>
                 

        </div>
    </div>
</div>
<?php
    if($theEntry->photos != NULL){
        
?>
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
<?php
    if($galeries){
?>


 <div class="contain container-fluid mt-txt-60">
             <!-- <div class="d-inline-block d-sm-inline-block d-lg-none text-center mb-40 w-100">
                        <img alt="" data-src="/assets/img/promo-res.png">
                    </div>  -->
    <div class="row">
        <? include('_inc_galeries_tour.php') ?>
    </div>
</div> 
<?php } ?>
<?php
    }
?>
<div class="contain container-4 container-contact mt-txt-60">
    <div class="amc-column">
        <div class="area-btn-contact pt-10 pb-10">
            <p class="tt">Souhaitez-vous les contacter ?</p>
            <img class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/hot_gon_thao_100_100.jpg">
            <button data-title="<?= base64_encode(DIR.'nous-contacter') ?>" class="btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="quote_section" data-analytics-label="cta_contact">Contactez nous</button>
        </div>
    </div>
</div>

<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->   
  
<?php
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');
$this->registerCssFile('/assets/js/fancybox/helpers/jquery.fancybox-thumbs.css');
$this->registerCssFile('/assets/js/fancybox/helpers/jquery.fancybox-buttons.css');
$this->registerCssFile('/assets/js/fancybox/custom-gallery.css?v=001');


$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js?v=001', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox-thumbs.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/fancybox/helpers/jquery.fancybox-buttons.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/image-gallery.js?v=001', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$js=<<<JS
   $(window).bind("load", function() { 
            var width = $('.container-2 .row-1 .r1').outerWidth();
           $('.container-2 .row-1 .r1').css('width', width + 5);
            $('.container-2 .row-1 .r1').css('float', 'none');
         //alert(width);
       

});     
        
  //  $(document).ready(function(){
        $('.slider').bxSlider({
            slideWidth: 175,
            slideHeight: 250,
            minSlides: 4,
            
            moveSlides: 1,
           
            infiniteLoop: false,
            maxSlides: 4,
            slideMargin: 40,
            responsive: true,
          //  nextText: 'Next',
          //  prevText: 'Prev',
            randomStart: false,
            // captions: true,
            auto: false,
           // mode: 'fade',
            speed: 1000,
           onSlideBefore: function(slideElement, oldIndex, newIndex){
            var lazy = slideElement.find('.lazy');
            var load = lazy.attr('data-src');
            lazy.attr('src', load).removeClass('lazy');
        }
        
        });
  //  });
                   
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$this->registerCss('.back-button{margin-top: 35px;}');
?>
