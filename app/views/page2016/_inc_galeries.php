<? $this->registerCssFile('/assets/plugins/wowslider/style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/plugins/wowslider/wowslider.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/plugins/wowslider/script.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? use \yii\imagine\BaseImage; ?>
    <div id="wowslider-container1" style="">
        <div class="ws_images"><ul>
                <?
                    $emptyImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=';

                ?>
                <?
                // $galeries =  array_reverse($theEntry->photos);
                $cnt = 0;
                $img = null;
                $width = 0;
                $height = 0;
                foreach ($galeries as $key=> $v) : ?>
                    <? if($v->model->type == 'galery') : $cnt++; ?>
                        <? 
                        if(file_exists(BASE_PATH.$v->image)){   
                        list($width, $height) = getimagesize(BASE_PATH.$v->image);
                        
                        //$img =  $v->image;
                        if($height > $width){
                            
                            //$img = DIR."phpThumb/phpThumb.php?src=/assets/img/bg.jpg&fltr[]=wmi|".$this->context->getWatermarkimage($v->image)."|512x375|100&w=1024";
                            //$img = DIR."phpThumb/phpThumb.php?src=/assets/img/bg.jpg&fltr[]=wmi|".$v->image."|512x375|100&w=1024";

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
                                $img_complete = Yii::$app->easyimage->getUrl($image_black,['watermark'=>['image'=>$wr.$this->context->getWatermarkimage($image_crop),'offset_x'=>262,'offset_y'=>0]], $absolute = false);

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
                <li><img style="min-height: 680px; max-width: 1024px;" class="lazyload" <?=$height > $width ? 'data-src='.$img : 'data-src='.$img?> alt="<?= $v->description?>" title="<?= $v->model->caption?>" id="wows1_<?=$key ?>"/></li>
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
            </ul></div>
        <div class="ws_thumbs">
            <div>
                <? foreach ($galeries as $key=> $v) : ?>
                    <? if($v->model->type == 'galery') : ?>
                        <a href="#wows1_<?=$key?>" title="<?= $v->model->caption?>"><img style="width: 102px; height: 102px;" data-src="<?=DIR?>thumb/144/99/1/80<?= $v->image?>" alt="<?= $v->description?>" /></a>
                    <?  endif;?>
                <? endforeach; ?>
            </div>
        </div>
        <div class="ws_shadow"></div>
    </div>
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
<?
$newJs = <<<JS
	$('.ws_thumbs').hover(function(){
		$('.ws_thumbs').animate({
		    bottom: 106
		  }, 500);
		$('.ws_images .ws-title').animate({
		    bottom: 121
		}, 500);
	})
	$('.ws_thumbs').mouseleave(function(){
		$('.ws_thumbs').animate({
		    bottom: 33
		  }, 300);
		  $('.ws_images .ws-title').animate({
		    bottom: 55
		  }, 300);
	})
        $(window).bind("load",function(){
                var e;
                var b;                        
                e = $("#galeries-photos").find(".ws_images").children(":nth-of-type(4)").remove();
                $('#wowslider_engine').remove();
                //b = $("#galeries-photos").find(".ws_list").children("ul").children("li").children("img").attr('class');
        });
        
JS;
$this->registerJS($newJs, yii\web\View::POS_END);
$this->registerCss('.fancybox-inner{height:auto; max-height: 681px !important;}');
?>