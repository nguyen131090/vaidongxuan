
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country-info-pratiques.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain no-padding">
    <div class="column">
       
        <!-- Menu Ngang -->
        <? include '_inc_menu_all_page_destinations.php'; ?>
        <!-- End Menu Ngang -->
    </div> 
</div>
<div class="contain no-padding">
    <div class="column ">
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
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
<!--                <a href="<?//=DIR?>nous-contacter">
            <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-custom-btn-filter">Contactez-nous</span>
            </a>-->
        </div>
    </div>
    
       
</div>
<div class="contain container-1">
    <div class="row-content">
        
        
        <span class="space space-80"></span>
        <div class="text-sumary">
             <?php
              //$content = str_replace('<h2', '<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-uppercase tt-color-e65925 tt-custom"', isset($theEntry->model->contentsMobile) ? $theEntry->model->contentsMobile[0]['description'] : ''); 
              //$content = str_replace('</h2>', '</h2><span class="space space-20"></span>', $content);
              //echo $content;
                $content = str_replace('<h2', '<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-custom"', $theEntry->model->content); 
                $content = str_replace('</h2>', '</h2>', $content);
                
                $subtext = explode('</p>', $content);
                    unset($subtext[count($subtext) - 1]);
                    
                   //echo $subtext[0]. ' <span class="view-more tt-color-e65925">Lire la suite</span></p>';
                    $cnt = 0;
                    foreach ($subtext as $sub) {
                        $cnt++;
                        if($cnt == 1 && $cnt == count($subtext)){
                            echo $sub. '</p>';
                        }else if($cnt == 1 && $cnt < count($subtext)){
                            echo $sub. ' <span class="view-more tt-color-e65925">Lire la suite</span></p>';
                            echo '<div class="full-text">';
                        }else if($cnt > 1 && $cnt < count($subtext)){
                            
                                echo $sub.'</p>';
                        }else if($cnt == count($subtext)){
                                echo $sub. '</p><p><span class="close-text tt-color-e65925">Réduire</span></p>';
                                echo '</div>';
                        }
                        
                    }
                
              ?>
        </div>
        <span class="space space-40"></span>
        <? if(!empty($infos_all_childrent)){ ?>
        <div class="exclusive-slider">
                <div class="swiper-wrapper">

                    <?
                    $cnt = 0;
                    foreach ($infos_all_childrent as $value) {
                        $cnt++;
                        if($value['on_top'] >= 1){

                            $image_icon = null;
                            $image_summary = null;
                            if(isset($value->photos) && !empty($value->photos)){
                                foreach ($value->photos as $img) {
//                                    if($img->type == 'icon'){
//                                        $image_icon = $img->image;
//                                    }
                                    if($img->type == 'custom'){
                                        $image_summary = [
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
                                <?if(!empty($image_summary)){?>
                                   <img height="" alt="<?= $image_summary['description']?>" data-src="<?=$image_summary['image']?>">
                                <?}else{?>
                                   <img alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-464-503.jpg" class=""/>
                                     
                                <?}?>    
  
                                <h3 class="tt-title tt-fontsize-32 tt-latolatin-bold tt-color-black tt-custom"><?= $value->title ?></h3>
                            </a>
                        </div>

                    <?

                        }else{

                            break;

                        }

                    } ?>


                </div>
            </div>
        <span class="space space-80"></span>
        <? } ?>
        
        <!-- Item no on_top -->
        <? if(!empty($infos_all_childrent)){ ?>
            <div class="<?=SEG1?> all-item-no-on-top ajaxfilter" id="getcontent">

                <div id="ajaxseemore" class="getcontent">
<!--                <ul class="all-aticle">-->
                        <?
                        $j = 0;
                         if (Yii::$app->request->get('see-more') == NULL) {
                            $seemore = 3;
                        } else {
                            $seemore = Yii::$app->request->get('see-more');
                           
                        }
                        $q = 0;
                        foreach ($infos_all_childrent as $value) {
                            
                            if($value['on_top'] == NULL){
                                $j++;
                                $class_xoayngang = NULL;
                                if($j % 3 != 0){
                                    $class_xoayngang = 'space-horizontal';
                                }
                                $image_icon = null;

                                if(!empty($value->photos)){
                                    foreach ($value->photos as $img) {
                                        if($img->type == 'icon'){
                                            $image_icon =['image' => $img->image,
                                                'description' => $img->description,
                                                'caption' => $img->caption,
                                            ];
                                        }

                                    }
                                }
                                if($j % 3 == 1){
                                    echo '<ul class="all-aticle">';
                                }
                                ?>
                                <li>
                                    <a href="<?= DIR.$value->slug ?>" class="tt-title tt-fontsize-32 tt-latolatin-regular tt-custom">
                                        <? if($image_icon != null){ ?>
                                            <img alt="<? $image_icon['description'] ?>" class="icon <?=SEG1?>" data-src="<?=$image_icon['image']?>">
                                        <? }else{ ?>
                                            <img alt="" class="icon <?=SEG1?>" data-src="<?=DIR?>assets/img/mobile/icon-infos-pratiques-68-68.png">
                                        <? } ?>
                                        <span class="text"><?= $value->title ?></span>
                                    </a>
                                </li>
                                <span class="space space-50 <?= $class_xoayngang ?>"></span>
                                    
                        <? 
                            if($j % 3 == 0 || count($infos_all_childrent) - $q == $j){
                                    echo '</ul>';
                                }
 
                            }else{
                                $q++;
                            } 
//                        if($cnt > $seemore){
//                            break;
//                        }
                        }?>


<!--                    </ul>-->
                
            
            
           
                <?

              

               if (count($infos_all_childrent) - 3 > $seemore) {
                   ?>
<!--                    <div class="see-more" style="">
                   <span class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="see-more=<?//= 3 + $seemore ?>" data-value=''>Afficher la suite</span>
                </div>-->
<!--                <span class="space space-50"></span>-->
                <? } ?>
                </div>
            </div>
        <? } ?>
        <!-- End item no on_top -->
        <span class="space space-30"></span>
        
        <!-- Tour Voyage -->
        <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold">Inspirez-vous <br class="hide-xoayngang"> de nos idées de voyage</h2>
        <span class="space space-40"></span>
        <div class="secret-home item-tour-voyage">
            
            <div class="secrets-slider">
                <div class="swiper-wrapper">
                    <?
                $cnt = 0;
                foreach ($voyage as $value) {

                    $cnt++;
                    $image_summary = null;

                    if(isset($value->model->photos) && !empty($value->model->photos)){
                        foreach ($value->model->photos as $img) {
                            if($img->type == 'summary'){
                                $image_summary =['image' => $img->image,
                                    'description' => $img->description,
                                    'caption' => $img->caption,
                                ];
                            }

                        }
                    }
                    ?>
                        <div class="swiper-slide item-slide item-slide-<?= $cnt ?>">
                            
                            <a href="<?=DIR.$value->slug ?>">
                                 <?if(!empty($image_summary)){?>
                                <img class="img-responsive" height="" alt="<?= $image_summary['description']?>" data-src="<?=$image_summary['image']?>">
                               
                                <? } ?>    
                                <span class="fil-background"></span>
                                <div class="text">
                                    <h3 class="tt-title tt-fontsize-32 tt-latolatin-bold tt-color-white tt-custom"><?=$value->title?></h3>
                                    <p class="tt-title tt-fontsize-28 tt-latolatin-regular tt-color-white tt-sub-custom"><?=$value->model->sub_title?></p>
                                </div>
                            </a>
                        </div>

                    <? } ?>
                    
                </div>
                
            </div>
            <!-- If we need navigation buttons -->
        </div>
        <!-- End Tour Voyage -->
         <span class="space space-80"></span>
        
    </div>
</div>    


<? 
$uri = '/'.URI;

$js =<<<JS
$(function() {

//var menuSwiper = new Swiper('.menu-slider', {
//        scrollbar: '.swiper-scrollbar',
//        scrollbarHide: false,
//        slidesPerView: 'auto',
//        centeredSlides: false,
//        spaceBetween: 30,
//        grabCursor: true,
//        initialSlide: 1
//    });         
        
var secreSwiper = new Swiper('.secrets-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });
        
        
    var testiSwiper = new Swiper('.exclusive-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        
        loop: false
         
    });       
});
        
         // xu ly Ajax nut see-more
        $(document).on("click", ".ajax-see-more", function(event){    
           
            var pr = $(this).data('get');
           // $('#getcontent').load("/vietnam/informations-pratiques?see-more=6 #ajaxseemore");
          //  $('#getcontent').load('$uri?' + pr + ' #getcontent'); 
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
                    
//                    $('.img-lazy').lazy({
//                        scrollDirection: 'vertical',
//                        effect: 'fadeIn',
//                        effectTime: 1000,
//                        visibleOnly: true,
//                        onError: function(element) {
//                            console.log('error loading ' + element.data('src'));
//                        }
//                    });  

                   
                   // fixHeightColumnsItems();     
                    },
                    complete: function(data) {
                       
                    },
               }); 
                  
        });
        
    // end ajax see-more
      $(window).on('orientationchange resize', function(event) {

        if(event.orientation == 'landscape') {
            
            $('.all-aticle').each(function(e){
                var maxheight = 0;
                var height = 0;
                $(this).children('li').each(function(index){

                    
                    height = $(this).children().children('.text').outerHeight();
                    
                    if(height > maxheight){
                        maxheight = height;
                    }
                   // alert(maxheight);
                  //  e.find('li a .text').css({'min-height' : maxheight + 'px'});
                });
                $(this).children('li').children('a').children('.text').css({'height' : (maxheight + 20) + 'px'});

            });    
        }
     });   
        
        
    $('.text-sumary .view-more').click(function(){
        
        $('.full-text').show();
        $(this).hide();
   });    
        
    $('.text-sumary .close-text').click(function(){
        $('.view-more').show();
        $('.full-text').hide();
   });     
    
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>