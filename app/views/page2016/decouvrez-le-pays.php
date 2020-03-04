<?php $this->registerCssFile('/assets/css/page2016/decouvrez-le-pays.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
 

?>


<div class="contain container-1">
    <? 
    if(!empty($theEntry->photosArray['banner'])) {
    $value = $theEntry->photosArray['banner'][0]; 
    ?>
        <img style="width: 100%;" alt="<?= $value->description ?>" class="img-lazy" data-src="<?= $value->image ?>">
    <?
    }else{
    ?>
        <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-decouvrez-de-pays.jpg'>
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
    </div>
</div>
<div class="contain container-2 responsive-container-2">
    
    <div class="amc-column">
        <?php
            $content = str_replace(['col col-','src="'],['amc-col amc-col-','data-src="'],explode('<hr />', $theEntry->model->content));
        ?>
        
        <div class="rows row-1">
                <?= isset($content[0]) ? $content[0] : ''?>
           


        </div>
         <div class="rows row-2">
              <?= isset($content[1]) ? str_replace(['<h3>','</h3>'], ['<h2>','</h2>'], $content[1]) : ''?>


        </div> 
        <div class="rows row-3">


            <h2 class="tt-2"><a href="<?=DIR?>explorateurs/reportages"><?= $theReport->title?></a></h2>
                <?= $theReport->model->content?>

            <div id="decouvrez-load" class="ajaxpagination">   
                 <div class="getcontent">
                     <div class="area-slider-swiper area-slider-swiper-3-item slide-1 swiper-slider">    
                        <div class="swiper-container custom-slides-swiper-1 custom-slides-swiper-3-item">
                            <div class="swiper-wrapper item-slide">
                               
                                <?php
                                    foreach ($theEntries as $k => $v) {
                                ?>

                                <div class="swiper-slide amc-col amc-col-<?= $k+1?>">
                                    <a href="<?=DIR.$v->slug?>">
                                        <?php
                                           if(!empty($v->photos)){
                                               foreach ($v->photos as $value) {
                                                   if($value->model->type == 'summary'){
                                                       echo '<img style="width: 301px; height: 325px;" alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.$value->image.'">';
                                                   }
                                               }
                                           }else{

                                       ?>

                                       <img alt="" style="width: 301px; height: 325px;" class="img-lazy img-responsive" data-src="<?=DIR?>upload/image/img-decouvrez-de-pays.jpg">
                                       <?}?>

                                        <span class="tt"><?= $v->title?></span>
                                    </a>

                                   </div>
                                <?php }?>
                                
                            </div>
                        </div>
                         <!--            If we need pagination -->
                        <div class="swiper-pagination swiper-pagination-1"></div>
                        <!--             If we need navigation buttons -->
                        <div class="swiper-button-prev swiper-button-prev-1"></div>
                        <div class="swiper-button-next swiper-button-next-1"></div>     
                    </div>  
                     
               </div>      
            </div>
            

        </div>   
    </div>
</div>



<div class="contain container-7 responsive-container-7 mb-txt-0 container-slide-2">
    <div class="amc-column">
        <div class="rows row-1">
            <?= isset($content[2]) ? $content[2] : ''?>

        </div>    
        
        <div class="rows row-2" style="clear: left;">
             <div class="area-slider-swiper area-slider-swiper-3-item slide-2 swiper-slider">    
            <div class="position-relative">
            <div class="swiper-container custom-slides-swiper-2 custom-slides-swiper-3-item">
                <div id="" class="swiper-wrapper image-slider-two slider-2">
                   <? foreach ($theEntry->photosArray['galery'] as $k=>$v) : ?>
                      <? if($k==0) :  ?>
                      <div class="swiper-slide slide">
                          <p>
                                    <a class="fancybox-image" rel="gallery" title="<?= $v->model->caption ?>" href="<?= $v->image?>">
                                        <img alt="<?= $v->description?>" class="lazy lazyload" style="min-height: 381px;" data-sizes= 'auto' data-srcset='/thumb/220/381/1/80/<?= $v->image?> 960w, <?= $v->image?>' data-src="<?=DIR?>thumb/300/421/1/80<?= $v->image?>">
                                        
                                    <span><?= $v->model->caption ?></span> 
                                    </a>
                                </p>
                      </div>
                      <? else : ?>
                        <? if($k%2 == 1) : ?>
                        <div class="swiper-slide slide">
                        <? endif; ?>
                            <p class="it-<?=$k%2 ? 1 : 2?>"><a class="fancybox-image" rel="gallery" title="<?=$v->model->caption?>" href="<?=$v->image;?>"><img alt="<?=$v->description?>" class="lazy" style="min-height: 184px;" data-src="/thumb/271/184/1/80<?=$v->image?>"><span><?=$v->model->caption ?></span></a></p>
                        <? ?>
                        <? if($k%2 == 0 || $k == (count($theEntry->photosArray['galery']) - 1)) : ?>
                          </div>
                        <? endif; ?>
                      <? endif; ?>
                   <? endforeach; ?>
                  
                    
               </div>
            </div>
           <div class="swiper-pagination swiper-pagination-2 mt-40"></div>
           <div class="swiper-button-prev swiper-button-prev-2"></div>
           <div class="swiper-button-next swiper-button-next-2"></div>  
           </div>      
        </div>
    </div>
	  
    </div>
	
</div>



<div class="contain container-5 container-7 lazy-background container-slide-3">
     
    <div class="amc-column">
        <div class="rows row-1 responsive-slide-exclu">
            <p class="tt"><?= $theParent_Exclu->title?></p>
            <div class="area-slider-swiper area-slider-swiper-3-item slide-3 swiper-slider">    
            <div class="swiper-container custom-slides-swiper custom-slides-swiper-3-item">
             <div class="swiper-wrapper slider">
                 <?php
                    $cnt = 0;
                    foreach ($theSix_Exclu as $v) {
                        $cnt++;
                    
                 ?>
                    <div class="swiper-slide slide">
                        <a href="<?=DIR.$v->slug?>">
                             <?php
                                if(!empty($v->photos)){
                                    foreach ($v->photos as $value) {
                                        if($value->type == 'summary'){
                                            echo '<img alt="'.$value->description.'" class="" data-src="/thumb/205/205/1/80/'.$value->image.'">';
                                        }
                                    }
                                }else{

                            ?>

                            <img alt="" class="lazy" data-src="<?=DIR?>upload/image/img-1.png">
                            <?}?>

                            <span class="title"><?= $v->title?></span>

                       </a>


                   </div>
                 
                <?php } ?>


           </div>
           </div>
<!--            If we need pagination -->
            <div class="swiper-pagination swiper-pagination-3"></div>
<!--             If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-3"></div>
            <div class="swiper-button-next swiper-button-next-3"></div>        
           </div>     
           
        </div>
            
    </div>
        
</div>
<!--<div class="contain container-6">
    
    <div class="amc-column">
        
        <div class="rows row-1">
            <h3 class="tt">Pour aller plus loin</h3>
            <a class="" href="<?//=DIR?>a-propos-de-nous">A PROPOS DE NOUS</a>
        </div>
            
    </div>
        
</div>-->

<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->  
<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$js=<<<JS
 
  

    
         $('.fancybox-image').fancybox({
           titlePosition: 'over', 
            centerOnScroll: true,
            padding: 2,
           // type   :'iframe',
            openEffect: 'elastic',
            closeEffect: 'elastic',
            autoSize: true,
     });
     
    $(document).on("click",".pagination-deco .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-deco .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        
         $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        
        $.post(url, { type: 'deco' }, function(data){ 
             var datanew = $($.parseHTML(data)).find(".getcontent");
            $('.ajaxpagination').html(datanew);
           // $('html, body').animate({scrollTop: $('#portrait-load').offset().top - 100}, 200);
        
            $('.img-lazy').lazy({
                        scrollDirection: 'vertical',
                        effect: 'fadeIn',
                        effectTime: 1000,
                        visibleOnly: true,
                        onError: function(element) {
                            console.log('error loading ' + element.data('src'));
                        }
                    });     
            return false;
        });
        return false;
     });
        

var swiper = new Swiper('.slide-3 .custom-slides-swiper', {
      slidesPerView: 4,
         slidesPerGroup: 4,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
         navigation: {
            nextEl: '.swiper-button-next-3',
            prevEl: '.swiper-button-prev-3',
        },
        pagination: {
            el: '.swiper-pagination-3', 
            clickable: true
        },
    });             

   var swiper = new Swiper('.custom-slides-swiper-1', {
        slidesPerView: 3,
        slidesPerGroup: 3,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
         navigation: {
            nextEl: '.swiper-button-next-1',
            prevEl: '.swiper-button-prev-1',
        },
        pagination: {
            el: '.swiper-pagination-1', 
            clickable: true
        },
    });
        
        
var swipertwo = new Swiper('.custom-slides-swiper-2', {
        slidesPerView: 3,
        slidesPerGroup: 3,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next-2',
            prevEl: '.swiper-button-prev-2',
        },
        pagination: {
            el: '.swiper-pagination-2', 
            clickable: true
        },

    });         
JS;
$this->registerJs($js,  yii\web\View::POS_END);
?>