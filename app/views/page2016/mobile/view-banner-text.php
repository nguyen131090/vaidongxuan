<?php $this->registerCssFile('/assets/css/mobile/confiance.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white"><?= $this->context->pageT ? $this->context->pageT : $theEntry->title; ?></h1>
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32 tt-latolatin-regular">
             <?=isset($theEntry->model->content) ? $theEntry->model->content :  $theEntry->description?>
        </div>
    </div>
</div>
<!-- Start of second page -->
<?
$css = <<<CSS
.content-page{
    margin-bottom: 4rem;
    display: inline-block;
    position: relative;
}
.content-page h4{
    font-family: LatoLatin-Bold,sans-serif
}
.content-page ul {
    padding: 0;
    margin: 0;
}
.content-page ul li {
    list-style: none;
}
.content-page ul li::before {
    content: "• ";
    color: #e65925;
    display: inline-block;
    font-size: 2rem;
    margin-right: 1rem;
}
.content-page .row-1 h2{
    margin: 0 0 2.5rem;
}
.content-page h2 > span{
    font-family: LatoLatin-Bold, sans-serif;
}
.content-page h2{
    font-size: 2rem;
    font-family: LatoLatin-Bold, sans-serif;    
}
CSS;
$this->registerCss($css);
?>