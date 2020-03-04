<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? use \yii\imagine\BaseImage; ?>
    

    <div class="swiper-container galeries-swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?
                $emptyImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=';
                            
            ?>
            
            <? 
            $cnt = 0;
            $img = null;
            $width = 0;
            $height = 0;
            foreach ($galeries as $key=> $v) : ?>
                    <? if($v->model->type == 'galery') : $cnt++; ?>
                        <? 
                        if(file_exists(BASE_PATH.$v->image)){
                        list($width, $height) = getimagesize(BASE_PATH.$v->image);
                        if($height > $width){
                          
                            // xu ly image doc

                            $wr = Yii::getAlias('@webroot');
                            $image = $wr.$v->image;
                            $arr = explode('/', $image);
                            $nameimage = $arr[count($arr) - 1];
                            
                            $image_black = $wr.'/assets/img/9.jpg';

                            $image_crop = Yii::$app->easyimage->getUrl($image,['crop'=>['width'=>500,'height'=>680,'offset_x'=>0,'offset_y'=>35]], $absolute = false);

                            if(SEG3 == 'memoire-indochine'){
                                // unlink($wr.'/upload/watermark_gallery/b/potrait-du-general-giap-aee9fbdf96.jpg') ;

                                $img_complete = Yii::$app->easyimage->getUrl($image_black,['watermark'=>['image'=>$wr.$image_crop,'offset_x'=>262,'offset_y'=>0]], $absolute = false);

                            }else{
                                $img_add_logo = $this->context->getWatermarkimage($image_crop);
                                $img_complete = Yii::$app->easyimage->getUrl($image_black,['watermark'=>['image'=>$wr.$img_add_logo,'offset_x'=>262,'offset_y'=>0]], $absolute = false);

                            }
                            if($img_complete != $emptyImage && file_exists($wr.$img_complete)){
                                
                                $img_temp = str_replace('\\', '/', $img_complete);
                                $img = explode('/', $img_temp);
                                $img[count($img) - 1] = $nameimage;
                                $img = implode('/', $img);
                                rename($wr.$img_temp, $wr.$img);
//                                if (!copy($wr.$img_temp, $wr.$img)) {
//                                    echo "failed to copy";
//                                }
//                                unlink($wr.$img_temp);
                            }else{
                                $img = $img_complete;
                            }
                            // end
                        }else{
                            if(SEG3 == 'memoire-indochine'){
                                $img =  $v->image;
                            }else{
                                $img =  $this->context->getWatermarkimage($v->image);
                            }
                        }
                        }
                        ?>
                        <?
                            if($img != $emptyImage){
                        ?>
                        <div class="swiper-slide">
                            <img class="lazyload"  data-src="<?=$img?>" alt="<?= $v->description?>" title="<?= $v->model->caption?>" />
                            <p class='caption'><?= $v->model->caption?></p>
                        </div>
                        <? } ?>
<?
$json_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).$v->image;
$json_alt = $v->description;
$json_width = $width.'px';
$json_height = $height.'px';
$json_image[$cnt] =<<<TXT
{
    "@type": "ImageObject",
    "url": "$json_url",
    "description": "$json_alt",
    "width": "$json_width",
    "height": "$json_height",
    "copyrightHolder": [
        {
        "@type": "Organization",
        "name": "Amica Travel"
        }
    ]
}
TXT;

?>               
                    <? endif; ?>
                <? endforeach; ?>
            </div>
    </div>   
<?php
    if(isset($json_image)){
?>
<script type="application/ld+json">
{"@context" : "http://schema.org",
"@type": "ImageGallery",
"image": [
    <? foreach ($json_image as $k => $it){ 
        echo $it;
        if($k <= count($json_image) - 1){
        echo ',';  
        }
    }?>
]
}
</script>
<?php
    }
?>
<?
if(Yii::$app->controller->action->id == 'exclusivites-single'){
    $analyPage = 'secret_single';
} else {
    $analyPage = 'tour_page';

}
if(Yii::$app->controller->action->id == 'fondation-single-about-us'){
    if(SEG2 == 'partenaires'){
        $analyPage = 'partenaire_single';
    }
    if(SEG2 == 'associations'){
        $analyPage = 'association_single';
    }
}
$newJs = <<<JS
 $(window).bind("load", function(event){     
 var galeriesSwiper = new Swiper ('.galeries-swiper', {
    slidesPerView: 2,
    spaceBetween: 25,
    loop: true,
    centeredSlides: true,
    breakpoints: {
        // when window width is <= 1100px
        1100: {
          slidesPerView: 1.2,
          spaceBetween: 25
        }
    }
    // navigation: {
    //   nextEl: '.swiper-slide-next',
    //   prevEl: '.swiper-slide-prev',
    // }
  });	
        
$('.galeries-swiper').on('click','.swiper-slide-next',function(){
    
    $('.swiper-slide-next').removeAttr('data-analytics data-analytics-category data-analytics-action data-analytics-label');
    $('.swiper-slide-prev').removeAttr('data-analytics data-analytics-category data-analytics-action data-analytics-label');
//    $('.swiper-slide-next').removeAttr('data-analytics-category');
//    $('.swiper-slide-next').removeAttr('data-analytics-action');
//    $('.swiper-slide-next').removeAttr('data-analytics-label');
    
//    $('.swiper-slide-prev').removeAttr('data-analytics');
//    $('.swiper-slide-prev').removeAttr('data-analytics-category');
//    $('.swiper-slide-prev').removeAttr('data-analytics-action');
//    $('.swiper-slide-prev').removeAttr('data-analytics-label');
        
    galeriesSwiper.slideNext();    
    $('.swiper-slide-next').attr({ 'data-analytics':'on', 'data-analytics-category':'$analyPage', 'data-analytics-action':'gallery_section', 'data-analytics-label':'control_right' });  
    $('.swiper-slide-prev').attr({ 'data-analytics':'on', 'data-analytics-category':'$analyPage', 'data-analytics-action':'gallery_section', 'data-analytics-label':'control_left' });  
    
//    $('.swiper-slide-next').attr('data-analytics','on');
//    $('.swiper-slide-next').attr('data-analytics-category','$analyPage');
//    $('.swiper-slide-next').attr('data-analytics-action','gallery_section');
//    $('.swiper-slide-next').attr('data-analytics-label','control_right');  
//        
//    $('.swiper-slide-prev').attr('data-analytics','on');
//    $('.swiper-slide-prev').attr('data-analytics-category','$analyPage');
//    $('.swiper-slide-prev').attr('data-analytics-action','gallery_section');
//    $('.swiper-slide-prev').attr('data-analytics-label','control_left');        
        
});
$('.galeries-swiper ').on('click', '.swiper-slide-prev',function(){
    $('.swiper-slide-next').removeAttr('data-analytics data-analytics-category data-analytics-action data-analytics-label');
    $('.swiper-slide-prev').removeAttr('data-analytics data-analytics-category data-analytics-action data-analytics-label');
    galeriesSwiper.slidePrev();
        
    $('.swiper-slide-next').attr({ 'data-analytics':'on', 'data-analytics-category':'$analyPage', 'data-analytics-action':'gallery_section', 'data-analytics-label':'control_right' });  
    $('.swiper-slide-prev').attr({ 'data-analytics':'on', 'data-analytics-category':'$analyPage', 'data-analytics-action':'gallery_section', 'data-analytics-label':'control_left' });  
    
});


     $('.swiper-slide-next').attr({ 'data-analytics':'on', 'data-analytics-category':'$analyPage', 'data-analytics-action':'gallery_section', 'data-analytics-label':'control_right' });  
    $('.swiper-slide-prev').attr({ 'data-analytics':'on', 'data-analytics-category':'$analyPage', 'data-analytics-action':'gallery_section', 'data-analytics-label':'control_left' });  
    
});   
        
JS;
$this->registerJS($newJs, yii\web\View::POS_END);
$this->registerCss('
.galeries-swiper .swiper-slide img{width: 100%;} .galeries-swiper{max-width: 1920px;}
.galeries-swiper .swiper-slide-prev:after, .galeries-swiper  .swiper-slide-next:after{
    content:"";
    width: 100%;
    height: 100%;
    background: rgba(255,255,255, 0.7);
    position: absolute;
    left: 0;
    top: 0;
}
.galeries-swiper .swiper-slide-prev, .galeries-swiper .swiper-slide-next{
    cursor: pointer;
}
.galeries-swiper .swiper-slide-prev:before, .galeries-swiper  .swiper-slide-next:before{
        content: "";
    width: 51px;
    height: 51px;
    background: url(/assets/img/page2016/button-galeries.png) left top no-repeat rgba(255,255,255,0.7);
    border-radius: 100%;
    
    z-index: 9999;
    display: inline-block;
    position: absolute;
    right: 25%;
    top: 50%;
    margin-right: -25.5px;
    margin-top: -25.5px;

}
.galeries-swiper  .swiper-slide-next:before{
    left: 25%;
    margin-left: -25.5px;
    transform: rotate(180deg);
}
.galeries-swiper .swiper-slide:hover:after{
    display: none;
}
.galeries-swiper .swiper-slide-prev:hover:before, .galeries-swiper  .swiper-slide-next:hover:before{
    background-color: rgba(230,89,37,0.8); 
    background-position-x: -51px;
    transform: rotate(0deg);
}
.galeries-swiper .swiper-slide-prev:hover:before{
    transform: rotate(180deg);
}
.galeries-swiper .swiper-slide .caption{
    font: 18px LatoLatin-Bold,sans-serif;
    text-shadow: 1px 1px 1px #000;
    position: absolute;
    bottom: 35px;
    left: 30px;
    color: #fff;
    margin: 0;
} 
@media(max-width: 960px){
    .galeries-swiper .swiper-slide-prev:after, .galeries-swiper .swiper-slide-next:after{
        display: none;
    }
}
')
?>