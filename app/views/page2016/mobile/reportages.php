<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/reportages.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain no-padding container-2 container-filter">
    <div class="column">
       

        
        
        
        <div class="area-filter fix-banner-top">
            <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
               
                <img class="image-banner img-responsive lazyload" alt="<?= $banner->description; ?>" data-sizes="auto" data-src='<?= $banner->image ?>' data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>">
                
            <?php }else{ ?>
                <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
            <?php } ?>    
    
            
            
            <span class="fil-background"></span>
             <? if($theEntry->model->seo != NULL){ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $this->context->pageT; ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
<!--                <a href="<?//=DIR?>nous-contacter" data-transition="slide" data-direction="reverse" class="custom-btn-filter">
            <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-custom-btn-filter">Contactez-nous</span>
            </a>  -->
        </div>
    </div>
    
       
</div>

<div class="contain container-3 tt-latolatin-regular tt-fontsize-32">
    <div class="column">
        <span class="space space-60"></span>
        <?=  preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $theEntry->model->content, -1 ) ?>
        <span class="space space-40"></span>
        
        <div class="all-tour ajaxfilter">
            <div class="getcontent">
                
            <?php
                $cnt = 0;
                $count = count($theEntries);
                foreach ($theEntries as $v) {
                    $cnt ++;
                    
            ?>
            
            <div class="item item-<?= $cnt ?>">
                <div class="amc-col col-left">
                <a href="<?= DIR.$v->slug ?>">
                    <?php
                        if(isset($v->model->photos) && !empty($v->model->photos)) {

                            foreach ($v->model->photos as $value) {

                                if ($value->type == 'summary') {
                                    ?>
                                    <img style="" class="img-lazy img-responsive" alt="<?= $value->description ?>" data-src="<?= $value->image ?>">
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <img alt="" class="img-responsive" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                    <?php } ?>
                    
                    <span class="fil-background"></span>
                     <div class="title">
                        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-white tt-custom"><?= str_replace('|', '', $v->title) ?></h2>
                       
                    </div>
                </a>
                </div>
                <div class="amc-col col-right">
                   
                <span class="space space-30 space-horizontal"></span>
                
                
                <div class="summary">
                   
                    <?= $v->model->summary ?>
                       
                    
                </div>
                </div>
            </div>
            <? if($cnt < $count){ ?>
            <span class="space space-50 <?= ($cnt % 2) != 0 ? 'space-horizontal' : ''?>"></span>
            <? } ?>
            
            <? } ?>
            
            
            
            <?
            
          

           if ($totalCount > $pagesize) {
               ?>
                <span class="space space-80"></span>
               <div class="see-more">
                <span class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="<?= 'see-more='.(8 + $pagesize) ?>" data-value='<?= count($theEntries) ?>'>Afficher la suite </span>
            </div>
               
           <? } ?>
            
            </div>
            
        
        </div>
        <span class="space space-60"></span>
    </div>
</div>    

<?php
    include(dirname(__FILE__).'/_inc_back_button.php');
?>
<? 
$uri = '/'.URI;
$js = <<< JS

        
        // xu ly Ajax nut see-more
        $(document).on("click", ".ajax-see-more", function(event){    
           
            var pr = $(this).data('get');
            
            var pagesize = $(this).data('value');
            var url = window.location.pathname + '?' + pr;

               $.ajax({
                    type: "GET",
                    url: window.location.pathname,
                    data: pr,
                    beforeSend: function() {
                        $('.getcontent').append('<div class="backgroundwhite"></div>');
                        $('.getcontent').css({'position':'relative'});
                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                    },
                    success: function(data){
                       
                    var datanew = $($.parseHTML(data)).find(".getcontent");
                    $('.ajaxfilter').html(datanew);
                    
                    
                    
        
                    },
                    complete: function(data) {
                       
                    },
               }); 
                  
        });
        
    // end ajax see-more
        
    
        
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>