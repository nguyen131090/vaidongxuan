
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
 <? $this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox-thumbs.css');
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox-thumbs.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner full-width">
            <? if(isset($theEntry->photosArray['banner'])){
                    $v = $theEntry->photosArray['banner'][0];
                    
             ?>
             <img
                 alt=""
    data-src="<?= $v->image?>" 
    data-srcset="/thumb/600/400/1/80<?= $v->image?> 450w, /thumb/900/0/1/80<?= $v->image?>"
    data-sizes="auto"
    class="banner-img lazyload" />
                <? } ?>
            <div class="text-on-banner">
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white"><?= $this->context->pageT; ?></h1>
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32">
             <?= $theEntry->content?>
             <? $cnt = 0;
                    foreach ($theEntries as $v) :
                        $cnt++;
                ?>
                     <div class="item item-<?=$cnt?>">
                             <?php
                                $fancy = Null;
                                $class_video = 'fancybox';
                                if(!empty($v->data->video)){
                                    $fancy = $v->data->video;
                                    $class_video = 'fancybox-video';
                                }
                                 if(!empty($v->data->pdf)){
                                    $fancy = $v->data->pdf;
                                    $file_data = new SplFileInfo($v->data->pdf);
                                  
                                    if($file_data->getExtension() == 'pdf'){
                                        $class_video = 'fancybox-pdf';
                                    }
                                    if($file_data->getExtension() == 'jpg'){
                                        $class_video = 'fancybox';
                                    }
                                }
                                if(isset($v->photosArray['summary'])){
                                        $vp = $v->photosArray['summary'][0];
                                        
                                 echo '<a data-role="none" target="_blank" class="'.$class_video.'" href="'.$fancy.'">';?>
                                        <img
                                            alt=""
                                            data-src="<?= $vp->image?>" 
                                            data-srcset="/thumb/600/400/1/80<?= $vp->image?> 450w, /thumb/900/0/1/80<?= $vp->image?>"
                                            data-sizes="auto" alt="<?=$vp->description?>"
                                            class="banner-img lazyload" />    
                                           <? echo '</a>';
                                }else{

                            ?>
                            
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>upload/image/img_items_espace_presse.jpg">
                            <?php } ?>
                            <h2 class="title-item tt-fontsize-40 tt-latolatin-bold tt-color-000000"><?= $v->model->title?></h2>
                            <div class="f-text tt-latolatin-regular tt-fontsize-32">
                                <?=$v->model->sub_title?>
                            </div>
                            <?php 
                                if(!empty($v->data->video)){
                            ?>
                            <a target="_blank" class="btn-download tt-fontsize-32 tt-latolatin-bold view-video <?= $class_video ?>" href="<?= !empty($v->data->video) ? $v->data->video : '' ?>">Afficher</a>
                            <?php }else{?>
                            <a target="_blank" class="btn-download tt-fontsize-32 tt-latolatin-bold down-pdf <?= $class_video ?>" href="<?= !empty($v->data->pdf) ? $v->data->pdf : '' ?>">
                                Afficher
                                <?
                                }
                                ?>
                            </a>    
                    </div> 
            
                <? endforeach; ?>
        </div>
        
    </div>
</div>
<!-- Start of second page -->

<? 
$country = SEG1;
$uri = URI;

$js = <<< JS
$('a.fancybox').click(function(){
    $.fancybox({
        titlePosition: 'over', 
        centerOnScroll: true,
        padding: 0,
        margin: 0,
        openEffect: 'elastic',
        closeEffect: 'elastic',
        'href'          : this.href,
        autoSize: true,
        showCloseButton: false,
    });
    return false;
});
        
    /*fancybox yt video*/
$(".fancybox-video").click(function() {
    $.fancybox({
        padding: 0,
        margin: 0,
        'autoScale'     : true,
        'transitionIn'  : 'none',
        'transitionOut' : 'none',
        'title'         : this.title,
        'href'          : this.href.replace(new RegExp("watch.*v=","i"), "v/"),
        'type'          : 'swf',
        'swf'           : {
            'wmode'             : 'transparent',
            'allowfullscreen'   : 'true',
            
        },
        closeBtn    : false, // hide close button
            closeClick  : false, 
        showCloseButton: false,
        height: 'auto'
    });
    return false;
});   
    
//$('a.fancybox-pdf').click(function(){
//    $.fancybox({
//        openEffect: 'elastic',
//        closeEffect: 'elastic',
//        autoSize: true,
//        type: 'iframe',
//        iframe: {
//            preload: false // fixes issue with iframe and IE
//        }
//    });
//    return false;
//});        
           
        
JS;
$this->registerJs($js); 
$css = <<<CSS
.banner .text-on-banner h1{
    margin:0;
}
.banner{
    margin-bottom: 3rem;
}
.content-page{
    margin-bottom: 4rem;
    display: inline-block;
}
.content-page p{
    text-align: left !important;
}
.content-page .item{
    margin-top: 4rem;
}
.content-page .item .title-item{
    margin: 2.5rem 0 1.5rem;
}
.content-page .item .btn-download{
    height: 5rem;
    display: flex;
    width: 100%;
    border-radius: 2.5rem;
    background: #e65925;
    color: #fff;
    align-items: center;
    justify-content: center;
    margin-top: 2.5rem;
}
//.fancybox-wrap{
//    bottom: 50px !important;
//    top: 50px !important;
//}
//.fancybox-overlay-fixed{
//    position: fixed !important;
//    top: 0;
//    left: 0;
//    bottom: 0;
//    right: 0;    
//}
a.fancybox-pdf.download-pdf{
    background: none;
    padding: 0;    
}
@media only screen and (orientation:landscape){
    .content-page .item{
        width: 48%;
        margin-right: 4%;
        float: left;
    }
    .content-page .item:nth-child(odd){
        margin-right: 0;
    }
    .content-page .item .f-text{
        min-height: 3.3rem
    }
}
CSS;
$this->registerCss($css);
?>