
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner full-width">
            <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
             <img
                 alt=""
    data-src="<?= $banner->image?>" 
    data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>"
    data-sizes="auto"
    class="banner-img img-responsive lazyload" />
                <? } ?>
            <div class="text-on-banner">
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white"><?= $theEntry['title']?></h1>
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32">
             <?= $theEntry['content']?>
        </div>
        <div class="contain container-6 contain-background-ededed full-width">
                <div class="column">
                    <span class="space space-50"></span>
                    <p class="tt-custom">Pour aller plus loin</p>
                    <span class="space space-50"></span>
                    <a href="/notre-equipe" class="btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925 ui-link" data-ajax="false"><span>Notre équipe</span></a>
                    <span class="space space-80"></span>
                </div>
            </div>
    </div>
</div>
<!-- Start of second page -->

<? 
$country = SEG1;
$uri = URI;

$js = <<< JS


JS;
$this->registerJs($js); 
$css = <<<CSS
.banner {
    position: relative;
    margin: -0.3rem -4vw 0;
}
.banner .text-on-banner {
    position: absolute;
    bottom: 0;
    width: 100%;
    text-align: center;
    background: linear-gradient(to top,rgba(0,0,0,0.5),rgba(0,0,0,0));
    padding-bottom: 2rem;
}
.swiper-container-horizontal{
    position: relative;
}
.visiter-related-slider .swiper-slide{
    width: 80%;
}
.top-lieu .text-row >  h2{
    font-family: 'LatoLatin-Bold',sans-serif;
    color: #e65925;
    margin: 1.3rem 0;
    background-size: 4rem;
    font-size: 2rem;
}
.top-lieu .text-row ul{
    padding: 0;
}
.top-lieu .text-row ul li{
    list-style: none;
}
.top-lieu .text-row ul li::before {
  content: "• ";
  color: #e65925; /* or whatever color you prefer */
  display: inline-block;padding: 
  font-size: 2rem;
  margin-right: 1rem;
}
.contain-background-ededed {
    background: #ededed;
}
.container-6 .tt-custom {
    font-family: "Grand Hotel",sans-serif;
    font-size: 2.75rem;
    line-height: 3rem;
    margin: 0;
    color: black;
    text-align: center;
}
.container-6 .btn-link {
    border-radius: 3rem;
    border: 0.1rem #e65925 solid;
    margin: 0;
    width: 100%;
    clear: left;
    height: 4.7rem;
    display: table;
}
.container-6 .btn-link span {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    padding: 0 2rem;
}
.content-page .col-1{
    display: none;
}
.content-page .col-2 p:first-of-type{
    font: 2rem LatoLatin-Bold,sans-serif;
    margin: 4rem 0 2.5rem;
}
.content-page{
        margin-bottom: 2.5rem;
    display: inline-block;
    position: relative;
}
.content-page .col-2{
    position: relative;
}
.content-page .col-2:before {
    background: transparent url(/assets/img/ngoac-open.png) no-repeat scroll left top;
    top: -2.1rem;
    content: "";
    display: inline-block;
    height: 5rem;
    position: absolute;
    left: 0;
    width: 4.8rem;
    z-index: 1;
    background-size: 4.8rem;
}
.content-page .col-2:after {
    background: transparent url(/assets/img/ngoac-close.png) no-repeat scroll left top;
    bottom: -1rem;
    content: "";
    display: inline-block;
    height: 5rem;
    position: absolute;
    right: 0;
    width: 4.8rem;
    z-index: 1;
    background-size: 4.8rem;
}
.content-page p{
    z-index: 2;
    position: relative;
}
CSS;
$this->registerCss($css);
?>