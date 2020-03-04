
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content top-lieu">
                <h1 class="title-row tt-fontsize-45 tt-latolatin-bold"><?=$theEntry->model->seo->h1 ? $theEntry->model->seo->h1 : $theEntry->title ?></h1>
            <div class="text-row tt-latolatin-regular tt-fontsize-32">
                <?=isset($theEntry->description) ? $theEntry->description : $theEntry->model->content; ?>
            </div>
        </div>

        <div class="row-content visiter-related">
            <h2 class="title-row tt-fontsize-40 tt-latolatin-bold">Articles récents</h2>
            <div class="visiter-related-slider">
                <div class="swiper-wrapper">
                             <? 
                            foreach ($theEntries as $key => $value) : ?>
                                <div class="swiper-slide">
                                    <a href="<?= DIR . $value->slug ?>"">
                                        <? 
                                        $v = '';
                                        if(isset($value->photosArray['summary'])) : 
                                            $v= $value->photosArray['summary'][0];
                                        ?>
                                        <img alt="<?= $v->description?>"
                                            data-src="<?=$v->image?>" 
                                            data-srcset="<?=$v->image?>"
                                            data-sizes="auto"
                                            class="banner-img lazyload" />
                                        <? endif; ?>
                                        <h3 class="tt-latolatin-bold tt-fontsize-32"><?= str_replace('|','',$value->title); ?></h3>
                                    </a>
                                </div>
                             <? endforeach ?>
                </div>
            </div>
        </div>
        <?php
include(dirname(__FILE__).'/_inc_back_button.php');
?>
</div>
</div>
<!-- Start of second page -->

<? 
$country = SEG1;
$uri = URI;

$js = <<< JS



var relatedSwiper = new Swiper('.visiter-related-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });



$("#search-destination").on('change', function(){
    window.location.href = '/'+this.value;
    return false;
});

JS;
$this->registerJs($js); 
$css = <<<CSS
.swiper-container-horizontal{
    position: relative;
}
.visiter-related-slider .swiper-slide{
    width: 80%;
}
.top-lieu .text-row > h2{
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
.galeries-slider{
    margin-bottom: 2.5rem;
}
.galeries-slider .swiper-button-prev{
    background-color: transparent;
    background-size: 2rem;
    left: -0.5rem;
}
.galeries-slider .swiper-button-next{
    background-color: transparent;
    background-size: 2rem;
    right: -0.5rem;
}
.tours-lieu-slider .text-on-img {
    position: absolute;
    z-index: 9999;
    bottom: 0;
    color: #fff;
    display: block;
    width: 100%;
    text-align: center;
    background: linear-gradient(to top,rgba(0,0,0,0.5),rgba(0,0,0,0));
        padding: 0 1.25rem;
}
.tours-lieu-slider .text-on-img h3 {
    font: 1.6rem LatoLatin-Semibold, sans-serif;
    margin-bottom: 2rem;
    margin: 0;
}
.tours-lieu-slider .text-on-img p{
    margin: 0.5rem 0 2rem;
}
.top-lieu .text-row p{
    margin: 0 0 1rem;
}
.top-lieu .text-row p:last-of-type{
    margin: 0;
}
.list-envies{
    margin-bottom: 2.5rem;
    margin-top: 0;
    display: inline-block;
}
.list-envies li{
    float: left;
    background: #e4e4e4;
    border-radius: 1rem;
    margin-right: 1rem;
    padding: 0.5rem 1rem;
    font: 1.3rem LatoLatin-Regular,sans-serif;
}
.list-envies li img{
    margin-right: 0.5rem;
}
.visiter-related-slider .swiper-slide:first-of-type {
      justify-content: center;
      margin: 0 auto;
    }
.tours-lieu-slider{
    margin-bottom: 4rem;
}
.top-lieu .text-row hr{
    display: none;
}
.top-lieu .text-row img{
    margin: 1rem 0;
        width: 100% !important;
    height: auto !important;
}
.visiter-related-slider  .swiper-slide h3{
    margin-bottom: 0;
}
.visiter-related{
    margin-bottom: 4rem;
}
.row-content h1.title-row{
    margin-top: 2rem;
}
@media only screen and (orientation:landscape){
    .visiter-related-slider .swiper-slide{
        width: 45%;
    }
}
CSS;
$this->registerCss($css);
?>