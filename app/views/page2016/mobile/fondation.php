<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/fondation.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain no-padding container-2">
    <div class="column">
       

        
        
        
        <div class="area-filter fix-banner-top">
            <? 
            if(isset($theEntry->model)){
                $theEntry_dd = $theEntry->model;
            }else{
                $theEntry_dd = $theEntry;
            }
            
            ?>
            <? 
            if(!empty($theEntry_dd->photosArray['banner'])) {
            $banner = $theEntry_dd->photosArray['banner'][0]; 
            ?>
                <img class="image-banner img-responsive lazyload" alt="<?= $banner->description; ?>" data-sizes="auto" data-src='<?= $banner->image ?>' data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>">
                
            <?php }else{ ?>
                <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
            <?php } ?>    
           
            
            
            <span class="fil-background"></span>
             <?
             
             if($theEntry_dd->seo != NULL){ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry_dd->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry_dd->title ?></h1>
            <? } ?>    
                
        </div>
    </div>
    
       
</div>
<div class="contain container-3">
    <div class="column">
        <span class="space space-60"></span>
        <div class="rows content tt-fontsize-32 tt-latolatin-regular">
             <?
             //str_replace('<p>&nbsp;</p>', ' ', preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $theEntry->model->content, -1 ));
            $item_content = explode('<hr />', str_replace(['<p>&nbsp;</p>','<h4>','</h4>'], [' ','<p>','</p>'], preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $theEntry_dd->content, -1 )));
            echo $item_content[0];
           // str_replace('<p>&nbsp;</p>',' ',$theEntry->model->content)
                    
            ?>
           <?//= $theEntry->model->content ?>
        </div>
        <span class="space space-20"></span>
        
    </div>
</div>  
<div class="contain container-4 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        <div class="rows content tt-fontsize-32 tt-latolatin-regular">
          <?= str_replace(['<h3>','</h3>'], ['<h2>','</h2>'], $theProjets->model->content)?>
        </div>
        <span class="space space-30"></span>
        
        <div class="rows row-2">
            <!-- Option Envies -->
            
            <? if(!empty($theProjets_list)){ ?>
            <div class="exclusive-slider">
                    <div class="swiper-wrapper">

                        <?
                        $cnt = 0;
                        foreach ($theProjets_list as $value) {
                            $cnt++;



                                $image_banner = null;
                                if(isset($value->photos) && !empty($value->photos)){
                                    foreach ($value->photos as $img) {

                                        if($img->type == 'summary'){
                                            $image_banner = [
                                                'image'=>$img->image,
                                                'description' => $img->description,
                                                'caption' => $img->description,
                                            ];
                                        }
                                    }
                                }


                            ?>
                           <div class="swiper-slide item-slide item-slide-<?= $cnt ?>">
                                <a href="<?=DIR.$value->slug?>">
                                    <?if(!empty($image_banner)){?>
    <!--                                   <img height="" alt="<?//= $image_banner['description']?>" data-src="<?//=$image_banner['image']?>">-->
                                        <img
                                            alt="<?= $image_banner['description']?>"
                                            data-src="<?=$image_banner['image']?>" 
                                            data-srcset="/thumb/600/400/1/80<?=$image_banner['image']?> 450w, /thumb/900/0/1/80<?=$image_banner['image']?>"
                                            data-sizes="auto"
                                            class="banner-img lazyload" />
                                    <?}else{?>
                                       <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>

                                    <?}?>    

                                    <p class="tt-title tt-fontsize-32 tt-latolatin-bold tt-color-black tt-custom"><?= $value->title ?></p>
                                </a>
                            </div>

                        <?


                        } ?>


                    </div>
                </div>
            <span class="space space-50"></span>
            <? } ?>

           <!-- End Option Envies --> 
        </div>
        
    </div>
</div> 


<div class="contain container-5">
    <div class="column">
        <span class="space space-50"></span>
        <div class="rows content tt-fontsize-32 tt-latolatin-regular">
           <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom-1">
               <a href="<?= $theLeft->slug?>"><?= $theLeft->title?></a>
           </h2>
           <span class="space space-10"></span>
                <ul>
                    <?php
                   
                        foreach ($theLeft_list as $v) {
                            
                           echo '<li><a href="'.$v->slug.'">'.$v->title.'</a></li>';     
                        }
                    ?>
                </ul>
           <span class="space space-10"></span>
           <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-e65925 tt-custom-2">
                <a href="<?= $theRight->slug?>"><?= $theRight->title?></a>
           </h2>
           <span class="space space-10"></span>
            <ul>
                <?php
                    foreach ($theRight_list as $v) {
                       echo '<li><a href="'.$v->slug.'">'.$v->title.'</a></li>';     
                    }
                ?>
            </ul>
        </div>
        <span class="space space-20"></span>
        
    </div>
</div>  

<div class="contain container-6 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        
        <h2 class="tt tt-latolatin-bold tt-fontsize-40 tt-color-000000"><?= !empty($theHost->data->host) ? $theHost->data->host : ''?></h2>
        <span class="space space-20"></span>
        <div class="rows row-2">
            <!-- Option Envies -->
            
            
            <div class="module host">
                    <div class="swiper-wrapper">
             <?php

             foreach ($theEntries as $kp => $v) {
               if($v != NULL){
                ?>

                <div class="slide swiper-slide text-center">
                 <a href="<?=DIR.$v->slug?>">
                   <? if(!empty($v->photosArray['summary'])) :
                                $img = $v->photosArray['summary'][0];
                             ?>
                         <img alt="<?= $img->description?>" class="" data-src="<?=DIR?>timthumb.php?src=<?= $img->image?>&w=140&h=140&zc=1">
                        <? endif; ?>
                         <p class="title tt-fontsize-32 tt-latolatin-bold"><?= !empty($v->model->sub_title) ? $v->model->sub_title : $v->title;?></p>
                         <p class="no-margin destination tt-fontsize-28 tt-latolatin-regular "><? if(!empty($v->data->location)) : 
                                $des = \app\modules\destinations\api\Catalog::get($v->data->location[0]);
                                if($des){
                                ?>
                                <?=!empty($des->model->summary_title) ? $des->model->summary_title : $des->title; ?></br><?=ucfirst(explode('/',$des->slug)[0])?>
                                <? } ?>
                         </p>
                       


                     
                   <? endif; ?>
                   </a>
                   </div>
                     <?php } ?>   
                     <?php } ?>
            </div>
                </div>
            <span class="space space-50"></span>
            <a class="tt-latolatin-bold tt-color-e65925 d-block btn-amica-basic-1 btn-amica-basic mx-auto mt-50 button-devis" href="/formules/chez-habitant">Voir toutes les formules</a>
            

           <!-- End Option Envies --> 
        </div>
        
    </div>
</div> 
<span class="space space-80"></span>
<? 
$uri = '/'.URI;

$js = <<< JS
$(function() {

var secreSwiper = new Swiper('.secrets-slider', {
        slidesPerView: 1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 10,
        loop: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        //preventClicks: false,
        breakpoints: {
            
            320: {
            slidesPerView: 1,
            spaceBetween: 10
            },
            414: {
            slidesPerView: 1,
            spaceBetween: 10
            },
            // when window width is <= 480px
            480: {
              slidesPerView: 2,
              spaceBetween: 10
            },
            568: {
              slidesPerView: 2,
              spaceBetween: 10,
              
            },
            // when window width is <= 640px
            667: {
              slidesPerView: 2,
              spaceBetween: 10
            },
            736: {
              slidesPerView: 2,
              spaceBetween: 10
            }
        }
    });
        
        
    var testiSwiper = new Swiper('.exclusive-slider', {
        
        slidesPerView: 1.1,
        centeredSlides: false,
        spaceBetween: 20,
        initialSlide: 0,
    });  
     var hostSwiper = new Swiper('.host', {
        
        slidesPerView: 2.1,
        centeredSlides: false,
        spaceBetween: 20,
        initialSlide: 0,
    });  
 

});


 
     
    
   function delayremoveclass(text){
      setTimeout(function()
        {
           // text.removeClass('active');
           // text.parent().removeClass('active');
            //text.addClass('active');
            text.slideDown(500);
        }, 500);
};        
        
    $('.area-text-control').click(function(){
        var hClass = $(this).hasClass('active');
        $('.area-text-control').removeClass('active');
        $('.area-text-control').parent().children('.sub-article').removeClass('active');
        //$('.area-text-control').parent().children('.sub-article').slideUp(500);
        if(hClass){
            $(this).removeClass('active');
            $(this).parent().children('.sub-article').removeClass('active');
           // $(this).parent().children('.sub-article').slideUp(500);
        }else{
            $(this).addClass('active');
           // delayremoveclass($(this).parent().children('.sub-article'));
            $(this).parent().children('.sub-article').addClass('active');
           // $(this).parent().children('.sub-article').slideDown(500);
        }
        
        $('body, html').animate({
            scrollTop: $(this).offset().top - 70
        }, 0);
        
    });    
    
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>