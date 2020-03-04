<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/fondation.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain container-1">
     <?php
		
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
     <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-exclusi.jpg'>
    <?}?>
   
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        <h1 class="title m-0"><?= $this->context->pageT; ?></h1>
        <h2 class="sub-title <?= $theEntry->sub_title != NULL ? 'mt-20' : '' ?> mb-0"><?=$theEntry->sub_title ?></h2>
    </div>
</div>
<div class="contain container-2">
    
    <div class="amc-column">
     <?= $theEntry->content?>
    </div>
</div>

<div class="contain container-3 lazy-background">
    
    <div class="amc-column">
        <div class="rows row-1">
            <div class="amc-col amc-col-1">
                <?= str_replace(['<h3>','</h3>'], ['<h2>','</h2>'], $theProjets->model->content)?>
            </div>
            <div class="amc-col amc-col-2">
                <p class="title"><a href="<?=DIR?>tourisme-solidaire/projets"><?= $theProjets->title?></a></p>
                <div class="info">
                    <?php
                            $cnt = 0;
                            foreach ($theProjets_list as $v) { 
                                $cnt ++;
                                $active='';
                                if($cnt == 1){ $active = 'active';}else{ $active;}
                                
                                if(!empty($v->photos)){
                                    foreach ($v->photos as $value){
                                        if($value->type == 'icon'){
                                            echo '<img width="" id="img-'.$cnt.'" class="'.$active.' img-lazy" alt="'.$value->description.'" data-src="'.$value->image.'">';
                                        }
                                    
                                    }
                                }else{
                                    
                                }
                            }
                    ?>
                    <ul>
                        <?php
                            $cnt = 0;
                            foreach ($theProjets_list as $v) { $cnt ++;
                               $title = explode(',',$v->sub_title);
                            
                                echo '<li name="img-'.$cnt.'"><a href="'.DIR.$v->slug.'">'.$title[0].'<br>'.$title[1].'</a></li>';
                            }
                            if(count($theProjets_list) > 6){
                                echo '<li class="last"><a class="btn-down" href="#">down</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="contain container-4">
    
    <div class="amc-column">
        <div class="rows row-1">
            <div class="amc-col amc-col-1">
                <h2 class="title"><a href="<?=DIR?>tourisme-solidaire/partenaires"><?= $theLeft->title?></a></h2>
                <ul>
                    <?php
                   
                        foreach ($theLeft_list as $v) {
                            
                           echo '<li><a href="'.DIR.$v->slug.'">'.$v->title.'</a></li>';     
                        }
                    ?>
                </ul>
            </div>
            <div class="amc-col amc-col-2">
                <h2 class="title"><a href="<?=DIR?>tourisme-solidaire/associations"><?= $theRight->title?></a></h2>
                <ul>
                    <?php
                        foreach ($theRight_list as $v) {
                           echo '<li><a href="'.DIR.$v->slug.'">'.$v->title.'</a></li>';     
                        }
                    ?>
                </ul>
            </div>
        </div>
            
    </div>
        
</div>

<div class="contain container-5 lazy-background fix-space-vs-back-button">
    
    <div class="amc-column">
        <div class="rows row-1">
            <h2 style="display: block;" class="tt"><?= !empty($theHost->data->host) ? $theHost->data->host : ''?></h2>
            <div class="area-swiper area-slider-swiper swiper-slider">
             <div class="swiper-container custom-slides-swiper">
                 <div class="swiper-wrapper">
                 <?php
                    foreach ($theEntries as $k=>$v) :
                 ?>
                 
                    <div class="swiper-slide slide">
                        <a href="<?=DIR.$v->slug?>">
                            <? if(!empty($v->photosArray['summary'])) :
                                $img = $v->photosArray['summary'][0];
                             ?>
                            <img alt="<?= $img->description?>" class="" data-src="<?=DIR?>thumb/140/140/1/80<?= $img->image?>">
                            <? endif; ?>

                                <p class="title"><?= !empty($v->model->sub_title) ? $v->model->sub_title : $v->title;?></p>
                                <p class="destination">
                               <? if(!empty($v->data->location)) : 
                                $des = \app\modules\destinations\api\Catalog::get($v->data->location[0]);
                                if($des){
                                ?>
                                <?=!empty($des->model->summary_title) ? $des->model->summary_title : $des->title; ?></br><?=ucfirst(explode('/',$des->slug)[0])?>
                                <? } ?>
                            <? endif; ?></p>
                         </a>


                   </div>
                    <? endforeach; ?>
                </div>    
             </div>        
                 <!-- If we need navigation buttons -->
            <div class="swiper-button-prev" style="top: 25%;"></div>
            <div class="swiper-button-next" style="top: 25%;"></div>   
            <div class="swiper-pagination"></div>
           </div>
            <a class="link-btn btn-amica-basic mt-txt-40" href="/formules/chez-habitant">Voir toutes les formules</a>
        </div>
            
    </div>
        
</div>
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
<?php
//$this->registerCssFile('/assets/js/bxslider/jquery.bxslider.css');
//$this->registerJsFile('/assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$js=<<<JS
    $(document).ready(function(){
        $('.slider').bxSlider({
            slideWidth: 140,
            startSlide: 1,
            minSlides: 1,
            maxSlides: 6,
            moveSlides: 1,
            slideMargin: 20,
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
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
    });
        
   $('.info ul li a').hover(function(){
       var name = $(this).parent().attr("name");
        $('.info img').removeClass('active');
        $('.info #' + name).toggleClass('active');
   });     
    
  var swiper = new Swiper('.custom-slides-swiper', {
        slidesPerView: 6,
        slidesPerGroup: 6,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination', 
            clickable: true
        },
        breakpoints: {
            960: {
              slidesPerView: 4,
              slidesPerGroup: 4,
            },
           
          }
    }); 
        
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$this->registerCss('.swiper-button-next.swiper-button-disabled, .swiper-button-prev.swiper-button-disabled{
  display: none;
}');
?>