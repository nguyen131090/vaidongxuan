<?php $this->registerCssFile('/assets/css/page2016/nos-destinations.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?//php $this->registerCssFile(DIR . 'assets/css/page2016/animate.css/animate.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?// $this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);  ?>
<?// $this->registerJsFile(DIR . 'assets/js/scroll-animated.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 


//$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); ?>

<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/swiper-slider-3-item.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain container-1">
     <? if(isset($theEntry->model->photos[0])) : ?>
    <img style="width: 100%;" alt="<?=$theEntry->model->photos[0]->description; ?>" class="img-lazy" data-src='<?=$theEntry->model->photos[0]->image; ?>'>
    <? endif; ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
     <div class="amc-column row-2 mb-txt-40">
        
        <? if($theEntry->model->seo != NULL){?>
            <h1 class="title m-0"><?= $theEntry->model->seo->h1 ?></h1>
        <? } ?>
        
    </div>
     
    
</div>

<div class="contain container-2">
    <div class="amc-column mt-60">
        <? 
        $cnt = 0;
        foreach ($countries as $key => $value){ 
            
        $cnt++;    
          $image_summary = [];  
          $image_icon_map = [] ;
         if(isset($value->photos)) {
            foreach ($value->photos as $image) {
                
                if($image->type == 'summary'){
                    $image_summary = [
                        'image' => $image->image,
                        'description' => $image->description,
                        'caption' => $image->caption,
                    ];
                    
                }
                if($image->type == 'map'){
                    $image_icon_map = [
                        'image' => $image->image,
                        'description' => $image->description,
                        'caption' => $image->caption,
                    ];
                    
                }
                
            } 
        }
        ?>
            <div class="item item-<?=$cnt?> item-<?=$value->slug?> mt-0 mb-0">
                <a href="<?=DIR.$value->slug?>">
                    <div class="image img-zoom-span">
                        <?if(!empty($image_summary)){?>
                        <img height="" alt="<?= $image_summary['description']?>" class="img-lazy img-zoom img-responsive lazyload" data-src="<?=$image_summary['image']?>">
                        <?}else{?>
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-demo-vietnam-destination.jpg">
                        <?}?>
                        
                            <span class="effect" style="background-image: url(<?= isset($image_icon_map['image']) ? $image_icon_map['image'] : ''?>);"><?= $value->title ?></span>
                    </div>
                    <h2 class="tt mt-txt-40 mb-txt-25"><?= $value->title ?></h2>
                </a>    
                <div class="summary">
                    <?=$value->summary?>
                </div>
            </div>
        <? } ?>
        
    </div>
</div>

<div class="contain container-3 mt-60 mb-0">
    <div class="amc-column">
        <div class="rows row-1">
                <?
                   // var_dump($modules_exclusive->data->exclusives);exit;
                ?>
                <? if(isset($modules_exclusive->data->exclusives[0])){?>

                    <div id="slideCarousel" class="carousel slide carousel-fade">

                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#slideCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slideCarousel" data-slide-to="1"></li>
                            <li data-target="#slideCarousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">

                            <?
                            $cnt = 0;
                            
                            foreach ($modules_exclusive->data->exclusives as $value) {


                                $exclu = \app\modules\exclusives\api\Catalog::get($value);
                                //var_dump($exclu->photos);exit;
                                $image_summary = [];
                                if(isset($modules_exclusive->photos) && !empty($modules_exclusive->photos)) {
                                    // foreach ($modules_exclusive->photos[$cnt - 1] as $image) {
                                    $img = $modules_exclusive->photosArray['summary'];
                                    //   if($image->type == 'summary'){
                                    $image_summary = [
                                        'image' => $img[$cnt]->image,
                                        'description' => $img[$cnt]->description,
                                        // 'caption' => $image->caption,
                                    ];
                                    //    break;
                                    // }
                                    // }
                                }

                                $tt = explode('-', $modules_exclusive->model->title);

                                $cnt++;
                                ?>
                                <div class="item carousel-item <?= $cnt == 1 ? 'active' : '' ?>">

                                    <div class="amc-col col-left">
                                        <h2 class="tt-big mb-txt-25"><?= isset($tt[0]) ? $tt[0] : ''?><br><?= isset($tt[1]) ? $tt[1] : ''?></h2>
                                        <div class="text"><?= $modules_exclusive->model->description ?></div>
                                    </div>
                                    <div class="amc-col col-right">
                                        <a href="<?= DIR . $exclu->slug ?>" class="">
                                            <div class="fill">
                                                <?if(!empty($image_summary)){?>
                                                    <img height="" alt="<?= $image_summary['description']?>" class="img-lazy img-responsive lazyload" data-src="<?=$image_summary['image']?>">
                                                <?}else{?>
                                                    <img style="width: 100%;" alt="" data-src="https://demo.amica-travel.com/uploads/modulepage/for-exclusives/nos-coups-de-coeur-vietnam/chez-viet-ben-tre-5da971391f.jpg">
                                                
                                                <?}?>    
  
                                                 
                                            </div>
                                            <div class="logo">
                                               
                                                <img style="width: 100%;" alt="<?= isset($image_summary['description']) ? $image_summary['description'] : ''?>" data-src="<?= DIR ?>assets/img/page2016/bg_img_621_260.png">
                                                <h3 class="tt"><?= $exclu->model->title ?></h3>
                                                    <span class="btn-link radius-5" href="<?= $exclu->slug?>">en savoir plus</span>    
                                            </div>
                                        </a>
                                    </div> 

                                </div>
                                   
                            <? } ?>            

                        </div>    
                    </div>    
                <? } ?>    

        </div>  
    </div>
 </div>    
<div class="contain container-4 fix-img-position mt-60 pb-0">
    <div class="amc-column secrets responsive-swiper-slider-3-item">
        <img class="img-position-destination img-position-right-destination" alt="" data-src="<?=DIR?>assets/img/page2016/img-position-right-destination.png">
    
<!--        <img class="img-lazy fammer" data-src="/assets/img/new-home/img-right-fixed.png">-->
       <!-- Slider main container -->
        <div class="area-slider-swiper area-slider-swiper-3-item">    
            <div class="swiper-container custom-slides-swiper custom-slides-swiper-3-item">

                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <? foreach ($voyage as $key => $value) : ?>
                        <?
                        switch ($key) {
                            case 0:
                                $class = 'slideInLeft';
                                break;
                            case 1:
                                $class = 'slideInUp';
                                break;
                            case 2:
                                $class = 'slideInRight';
                                break;
                            default:
                                $class = '';
                        }
                        ?>
                        <div class="swiper-slide">
                            <div class="item-img revealOnScroll animated " data-animation="<?=$class?>">
                            <a href="<?=DIR.$value->slug ?>">
                                <?
                                $image_custom = [];  
                                if(isset($value->photos)) {
                                   foreach ($value->photos as $image) {

                                       if($image->type == 'custom'){
                                           $image_custom = [
                                               'image' => $image->image,
                                               'description' => $image->description,
                                              // 'caption' => $image->caption,
                                           ];
                                           break;
                                       }
                                   } 
                               }
                               ?>
                                <?if(!empty($image_custom)){?>
                                    <img height="" alt="<?= $image_custom['description']?>" class="img-lazy img-responsive lazyload" data-src="<?=$image_custom['image']?>">
                                <?}else{?>
                                    <img alt="" style="width: 100%;" data-src="https://www.amica-travel.com/upload-images/programmes/randonnees-treks/xrando-vietnam-3a83445c48.jpg.pagespeed.ic.u4Z078FU8D.jpg">

                                <?}?>    

                                <h3 class="text-on-img"><?=$value->title?></h3>
                                <div class="text-slide">
                                    <div class="bottom-block">
                                        <span class="title-hover"><?=$value->title?></span>
                                        <p><?=strip_tags($value->summary)?></p>
                                        <span class="btn radius-5">en savoir plus</span>
                                    </div>
                                </div>            
                            </a>
                            </div>
                        </div>
        <? endforeach; ?>
                </div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>   
        </div>
        
        
        <a href="<?=DIR?>voyage/itineraire " class="btn-link-ideel mt-txt-25 mb-txt-60">Voir tous nos circuits</a>
    </div>
    
</div>    
<div class="contain container-5 contain-video m-0">
    <div class="amc-column">
        <?// var_dump($theEntry);exit;?>
        <div class="amc-col col-left">
            <div class="fix-table">
                <div class="text">
                    <? $text_video = explode('<hr />', $theEntry->text); ?>
                    <?= $text_video[0]?>
<!--                    <p class="tt">L’histoire des 10 ans</p>
                    <div class="summary">
                        10 années d’existence tournées vers la promotion d’une Indochine méconnue et le désir de l’ouvrir de la meilleure façon qui soit, sur le monde.
                    </div>-->
                </div>
            </div>    
        </div>
        <div class="amc-col col-right">
             <?= str_replace(['<p>','</p>'], '', isset($text_video[1]) ? $text_video[1] : '')?>
            
        </div>
    </div>
</div>

<div class="contain container-6 mt-60">
    <div class="amc-column">
        <?
            $item_left = \app\modules\whoarewe\api\Catalog::cat(20);
            $item_right = \app\modules\whoarewe\api\Catalog::cat(11);
            $item_left_image_custom = [];  
            $item_left_tt = NULL;
            if(isset($item_left->model->photos)) {
               foreach ($item_left->model->photos as $image) {

                   if($image->type == 'custom'){
                       $item_left_image_custom = [
                           'image' => $image->image,
                           'description' => $image->description,
                           'caption' => $image->caption,
                       ];
                       $item_left_tt = explode('-', $item_left_image_custom['caption']);
                       break;
                   }
               } 
           }
           
           
           
           
           
           $item_right_image_custom = [];  
           $item_right_tt = NULL;
            if(isset($item_right->model->photos)) {
               foreach ($item_right->model->photos as $image) {

                   if($image->type == 'custom'){
                       $item_right_image_custom = [
                           'image' => $image->image,
                           'description' => $image->description,
                           'caption' => $image->caption,
                       ];
                       $item_right_tt = explode('-', $item_right_image_custom['caption']);
                       break;
                   }
               } 
           }
           
        ?>
        
        <div class="amc-col col-left">
            <div class="item">
                <a href="<?=DIR.$item_left->slug?>">
                <?if(!empty($item_left_image_custom)){?>
                <img class="img-lazy img-responsive" alt="<?=$item_left_image_custom['description']?>" data-src="<?=$item_left_image_custom['image']?>">
                <?}else{?>
                <img class="img-lazy img-responsive" alt="" data-src="<?=DIR?>assets/img/page2016/img-left-destination.jpg">
                <?}?>
                <div class="effect">
                    <p class="tt"><?= isset($item_left_tt[0]) ? trim($item_left_tt[0]) : 'notre démarche' ?><br><?= isset($item_left_tt[1]) ? trim($item_left_tt[1]) : 'du voyage solidaire' ?></p>
                    <span class="btn-link radius-5" href="<?=DIR.$item_left->slug?>">en savoir plus</span>
                </div>    
                </a>
            </div>
        </div>
        <div class="amc-col col-right">
            <div class="item">
                <a href="<?=DIR.$item_right->slug?>">
                 <?if(!empty($item_right_image_custom)){?>
                <img class="img-lazy img-responsive" alt="<?=$item_right_image_custom['description']?>" data-src="<?=$item_right_image_custom['image']?>">
                <?}else{?>
                <img class="img-lazy img-responsive" alt="" data-src="<?=DIR?>assets/img/page2016/img-right-destination.jpg">
                <?}?>
                <div class="effect">
                    <p class="tt"><?= isset($item_right_tt[0]) ? trim($item_right_tt[0]) : '' ?><br><?= isset($item_right_tt[1]) ? trim($item_right_tt[1]) : 'fait confiance' ?></p>
                    <span class="btn-link radius-5" href="<?=DIR.$item_right->slug?>">en savoir plus</span>
                </div>    
                </a>
            </div>
        </div>
    </div>
</div>

<div class="contain container-7 fix-img-position mt-60 mb-60">
    <div class="amc-column">
         <img class="img-position-destination img-position-left-destination" alt="" data-src="<?=DIR?>assets/img/page2016/img-position-left-destination.png">
    
        <p class="title-blog mb-txt-40">LES ARTICLES DU MOMENT DE NOTRE BLOG</p>
        <div class="clearfix"></div>
         <?php
                $cnt = 0;
               
                if(!empty($arrBlog)){
                foreach ($arrBlog as $value) {
                  //  var_dump($value);exit;
                $cnt++;    
                
                   
            ?>
            <div class="item item-<?=$cnt?>">
                <a href="<?= $value['link']?>" target="_blank" rel="noopener" >
                    <div class="image">
                        <img width="300" height="200" class="img-lazy img-responsive" alt="<?=$value['alt_text'] != '' ? $value['alt_text'] : 'Amica Travel' ?>" data-src="<?= $value['src'] ?>">
                        <span class="tt-name"><?= $value['cat_name'] ?></span>
                    </div>
                    <p class="tt mt-txt-25"><?= $value['title']['rendered']?></p>
                    
                </a>
            </div> 
        <? }} ?>

    </div>
   
</div>    
<?
$js=<<<JS
$('.secret-slider').bxSlider({
      minSlides: 3,
      maxSlides: 3,
      moveSlides: 1,
      slideWidth: 300,
       // pager: false,
      slideMargin: 20,
      infiniteLoop: false,
      hideControlOnEnd: true,
        responsive: true,
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
        
//        //Jquery Video AutoPlay
//    $(document).ready(function() {
//            // Get media - with autoplay disabled (audio or video)
//            var media = $('video').not("[autoplay='autoplay']");
//            var tolerancePixel = 40;
//
//            function checkMedia(){
//                // Get current browser top and bottom
//                var scrollTop = $(window).scrollTop() + tolerancePixel;
//                var scrollBottom = $(window).scrollTop() + $(window).height() - tolerancePixel;
//
//                media.each(function(index, el) {
//                    var yTopMedia = $(this).offset().top;
//                    var yBottomMedia = $(this).height() + yTopMedia;
//
//                    if(scrollTop < yBottomMedia && scrollBottom > yTopMedia){ //view explaination in `In brief` section above
//                        $(this).get(0).play();
//                         
//                    } else {
//                        $(this).get(0).pause();
//                    }
//                });
//
//                //}
//            }
//            $(document).on('scroll', checkMedia);
//        });
////End Video
        
        $(window).bind("load", function() { 


  
    
        $('.container-7 .item').each(function(index) {
        
        var max = 0;
        var height = $(this).find('.tt').outerHeight();
        //alert(height);
        if(max < height){
            max = height;
        }
        
       $('.container-7 .item .tt').css("min-height", max);

             
    });
});
        
$(document).on('mouseover', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');
    $(this).find('img').addClass('active');    
    $(this).find('.text-slide').addClass('active');
    $(this).find('.text-on-img').hide();
});
$(document).on('mouseleave', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
    $('.custom-slides-swiper-3-item .swiper-slide .item-img img').removeClass('active');  
    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');  
     $(this).find('.text-on-img').fadeIn(500);  
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
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });      
                  
        
JS;
$this->registerJs($js);
?>