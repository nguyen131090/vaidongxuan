<?
    $data_analy = NULL;
    if(Yii::$app->controller->action->id == 'exclusivites-single'){
        $data_analy = 'data-analytics="on" data-analytics-category="secret_single" data-analytics-action="gallery_section" data-analytics-label="control_swipe"';
    }
    if(Yii::$app->controller->action->id == 'idees-de-voyage-single'){
        $data_analy = 'data-analytics="on" data-analytics-category="tour_page" data-analytics-action="gallery_section" data-analytics-label="control_swipe"';
    }
?>
<div class="galeries-slider">
    <div class="swiper-wrapper">
        <? if(!empty($theEntry->photosArray['galery'])) {
                $cnt = 0;
                foreach ($theEntry->photosArray['galery'] as $key => $v) {
                    
                    if(file_exists(BASE_PATH.$v->image)) {
                        $cnt++;  
                    
                    list($width, $height) = getimagesize(BASE_PATH.$v->image);
        ?>
        <div class="swiper-slide" <?= $data_analy ?>>
            <img alt="<?= $v->description?>"
                        data-src="<?=$v->image?>" 
                        data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                        data-sizes="auto"
                        class="banner-img lazyload" />
            <div  class="text-on-image">
                <p align="center" class="no-margin tt-color-white tt-latolatin-regular tt-fontsize-28"><?=$v->model->caption ?></p>
            </div>
        </div>
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

                             
                    }
                            }
                        
                        } 
                    ?>
    </div>
    <? 
    $analyGal = '';
    if(Yii::$app->controller->action->id == 'exclusivites-single'){
        $analyGal = 'data-analytics="on" data-analytics-category="secret_single" data-analytics-action="gallery_section"';
    } 
    ?>
    <div class="swiper-pagination"></div>
    
</div>
 
<script type="application/ld+json">
{"@context" : "http://schema.org",
"@type": "ImageGallery",
"image": [
   <? 
    if(isset($json_image) && $json_image != NULL){
        foreach ($json_image as $k => $it){ 
            echo $it;
            if($k <= count($json_image) - 1){
                echo ',';  
            }
        }    
    }
    ?>
]
}
</script>         
<?
$js =<<<JS
//    var galeriesSlider = new Swiper('.galeries-slider', {
//        slidesPerView: 1,
//        paginationClickable: true,
//        spaceBetween: 30,
//        loop: true,
//        pagination: {
//            el: '.swiper-pagination',
//            dynamicBullets: true,
//        },
//    });
JS;
$this->registerJs($js); 

$css=<<<CSS
.galeries-slider .text-on-image {
    position: absolute;
    bottom: 0;
    background: linear-gradient(to top,rgba(0,0,0,0.5),rgba(0,0,0,0));
    width: 100%;
    padding: 2rem 1.25rem;
}        
CSS;
$this->registerCss($css); 
?>