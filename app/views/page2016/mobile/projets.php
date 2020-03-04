<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/projets.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain no-padding container-2 container-filter">
    <div class="column">
       

        
        
        
        <div class="area-filter banner fix-banner-top">
           <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
                
                <img class="image-banner img-responsive lazyload" alt="<?= $banner->description; ?>" data-sizes="auto" data-src='<?= $banner->image ?>' data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>">
                
            <?php }else{ ?>
                <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
            <?php } ?>    
       
            
            
            <span class="fil-background"></span>
             <div class="text-on-banner m-0 p-0">
                <? if($theEntry->model->seo != NULL){ ?>
                    <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom mb-50"><?= $theEntry->model->seo->h1 ?></h1>
                <? }else{ ?>
                    <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom mb-50"><?= $theEntry->title ?></h1>
                <? } ?>    
            </div>   
            
<!--                <a href="<?//=DIR?>nous-contacter" data-transition="slide" data-direction="reverse" class="custom-btn-filter">
            <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-custom-btn-filter">Contactez-nous</span>
            </a>-->
        </div>
    </div>
    
       
</div>
<div class="contain container-1">
    <div class="row-content">
        
        
       
        <span class="space space-80"></span>
        
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
                            if(isset($v->photos) && !empty($v->photos)) {

                                foreach ($v->photos as $value) {

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
                        
                    </a>
                </div>
                <div class="amc-col col-right">
                    <div class="title">
                        <a href="<?= DIR.$v->slug ?>">
                            <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-white tt-custom"><?= str_replace('|', '', $v->title) ?></h2>
                             <?// if($v->sub_title != NULL){?>
<!--                                <span class="space space-10"></span>
                                <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-custom-sub-tt"><?//= $v->sub_title ?></p>-->
                            <?// } ?> 
                        </a>
                    </div>
                    <span class="space space-30 space-horizontal"></span>
                    

                    <div class="summary">
                        <p>
                        <?= $v->summary ?>
                        </p>    
                    </div>
                </div>
            </div>
            <? if($cnt < $count){ ?>
            <span class="space space-60"></span>
            <? } ?>
            
            <? } ?>
            
            
            
            <?

           if ($totalCount > $pagesize) {
               ?>
            <span class="space space-30"></span>
               <div class="see-more">
                <span class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="<?= 'see-more=' . (8 + $pagesize) ?>" data-value='<?= count($theEntries) ?>'>Afficher la suite</span>
            </div>
            <span class="space space-20"></span>
           <? } ?>
            
            </div>
            
        
        </div>
        
        <span class="space space-40"></span>
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
                    
                    
                    if(window.innerHeight > window.innerWidth){
                       
                    }else{
                        $('.all-tour .item').each(function() {
                            $(this).children('.col-left').children('a').addClass('fix-xoay-ngang');
                            var image = $(this).children('.col-left').children('a').children('img').attr('src');
                            var heightcolright = $(this).children('.col-right').height();
                            $(this).children('.col-left').children('a').css({'height' : heightcolright + 'px','background-image' : 'url('+image+')'});
                            $(this).children('.col-left').children('a').children('img').hide();

                        });
                    }
                    

                      
                   
                   
                    },
                    complete: function(data) {
                       
                    },
               }); 
                  
        });
        
    // end ajax see-more
        
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
        
   
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>