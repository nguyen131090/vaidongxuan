
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?// $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?// $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/exclusivites.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain container-2">
    <div class="column">
        <span class="space space-50"></span>
        <? if($theEntry->model->seo != NULL){ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925 tt-align-left tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-e65925 tt-align-left tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
               
       <span class="space space-20"></span>
    </div>
    
       
</div>
<div class="contain container-1 container-filter">
    <div class="row-content">
        <div class="text-sumary">
            <div class="sub-text">
             <?php
            $subtext = explode('</p>', $theEntry->model->text);
         
           echo $subtext[0].'</p>';
           echo $subtext[1]. ' <span class="view-more tt-color-e65925">Lire la suite</span></p>';
           
            ?>
             </div>
            <div class="full-text">
                <?= $theEntry->model->text . '<p><span class="close-text tt-color-e65925">Réduire</span></p>' ?>
            </div>
            <span class="space space-50"></span>
            <span class="space fix-space-4-7rem"></span>
             <a href="#search-page" data-transition="slide" data-direction="reverse"><!-- class="custom-btn-filter" -->
                <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-custom-btn-filter" data-analytics="on" data-analytics-category="formule_page" data-analytics-action="sugg_section" data-analytics-label="btn_search_formules">Rechercher une formule</span>
            </a>
        </div>
        <span class="space space-80"></span>
        
        <div class="all-tour ajaxfilter">
            <div class="getcontent">
            <?php
                $cnt = 0;
                $count = count($theSix);
                foreach ($theSix as $v) {
                    $cnt ++;
                $class_xoayngang = NULL;
                
                if($cnt % 2 != 0){    
                   $class_xoayngang = 'space-horizontal'; 
                   echo '<div class="clearfix">' ;
                }
            ?>
            
            <div class="item item-<?= $cnt ?>">
                
                <a href="<?= DIR.$v->slug ?>" data-analytics="on" data-analytics-category="formule_page" data-analytics-action="inspi_section" data-analytics-label="link_formule_cat_<?= $v->category_id ?>">
                    <?php
                        if(isset($v->photos) && !empty($v->photos)) {

                            foreach ($v->photos as $value) {

                                if ($value->type == 'summary') {
                                    ?>
<!--                                    <img style="" class="img-lazy img-responsive" alt="<?//= $value->description ?>" data-src="<?//= $value->image ?>">-->
                                    <img alt="<?= $value->description?>"
                                    data-src="<?=$value->image?>" 
                                    data-srcset="/thumb/660/440/1/100<?=$value->image?> 450w"
                                    data-sizes="auto"
                                    class="lazyload img-responsive" />
                                    <?php
                                }
                            }
                        } 
                            ?>
                           
                    
                    <span class="fil-background"></span>
                    <div class="title">
                        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-white tt-align-center tt-custom"><?= str_replace('|', '', $v->title) ?></h2>
                        
                    </div>
                </a>
                
                    
                
                
               
            </div>
            <? if($cnt < $count){ ?>
            <span class="space space-50 <?= $class_xoayngang ?>"></span>
            <? } ?>
            <?
                if($cnt % 2 == 0 || $count == $cnt){    
                   echo '</div>' ;
                }
            ?>
            
            <? } ?>
            
           
           
            
            </div>
            
        
        </div>
        
        <span class="space space-80"></span>
    </div>
</div>    


<? 
$uri = '/'.URI;
$js = <<< JS

        
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
        
    $('.view-more').click(function(){
        $('.sub-text').hide();
        $('.full-text').show();
   });    
        
    $('.close-text').click(function(){
        $('.sub-text').show();
        $('.full-text').hide();
   });   
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>