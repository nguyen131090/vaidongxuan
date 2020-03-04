<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/mobile/confiance.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div class="contain container-2 non-area-form">
    <div class="column">
        
        <div class="row-content no-margin content-page tt-fontsize-32 tt-latolatin-regular">
            <h1 class="main-title tt-latolatin-bold tt-fontsize-45 tt-color-e65925"><?= $this->context->pageT ? $this->context->pageT : $theEntry->title; ?></h1>
            <p class="time tt-fontsize-28"><img data-src="/assets/img/mobile/icon-clock-orange.png" alt="">
                           <?php
                            $date_list = date("d.m.Y", $theEntry->time);
                            echo $date_list;
                            ?></p>
             <?=isset($theEntry->model->content) ? str_replace('src="', 'data-src="', $theEntry->model->content) : str_replace('src="', 'data-src="', $theEntry->description) ?>

        </div>
       
<!--        <div class="row-content slider">
            <h2 class="tt-latolatin-bold tt-uppercase tt-fontsize-40 tt-color-e65925">VOUS AIMERIEZ :</h2>
            <div class="related-slider">
                <div class="swiper-wrapper">
                    <?// foreach($articles as $key => $value) : ?>
                        <div class="swiper-slide">
                            <?//php if($value['image'] ==''){?>
                                <?//php
                                   // $src = DIR.'upload/image/img-194-129.jpg';

                                  //  preg_match_all('/<img[^>]+>/i', $value['description'], $result);
                                 //   foreach ($result[0] as $img_tag) {
                                 //       preg_match_all('/(src)=("[^"]*")/i', $img_tag, $src);
                                 //   }

                                 //   ?>

                                   <img class="lazyload" alt="" data-sizes='auto' data-src='<?//php if (is_array($src)) {
                                //            echo DIR.'timthumb.php?src='.str_replace('"','',$src[2][0]).'&w=600&h=400&zc=1';
                                //    } else echo DIR.'timthumb.php?src='.$src.'&w=600&h=400&zc=1'; ?>'/>
                              <?//php }else{?>
                                       <img class="lazyload" alt="" data-src="<?//=DIR?>timthumb.php?src=<?//= $value['image']?>&w=600&h=400&zc=1">   
                              <?//php }?>
                                <h3 class="tt tt-latolatin-regular tt-fontsize-32">
                                    <a href="<?//=DIR.SEG1.'/'.$value['slug']?>"><?//= $value['title']?></a>
                                </h3>
                        </div>
                    <?// endforeach; ?>
                </div>
            </div>
        </div>-->
    </div>
    <span class="space space-30"></span>
</div>
 <?php
    include(dirname(__FILE__).'/_inc_back_button.php');
?>
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
.content-page img{
    width: 100% !important;
    height: auto !important;
}
.related-slider .swiper-slide{
    width: 80%;
}
.content-page.no-margin{
    margin: 0;
}
.content-page .time{
    display: flex;
    align-items: center;
    line-height: 100%;
    margin: 0 0 2rem;
}
.content-page:first-of-type img{
    margin-bottom: 1rem;
}
.content-page .time img{
    width: 2rem !important;
    margin: 0 1rem 0 0;
}
.content-page h1{
    margin: 2.5rem 0 1.5rem;
}
.content-page h2{
    font-size: 2rem;
    font-family: 'LatoLatin-Bold';    
}
.content-page h3{
    font-size: 1.6rem;
    font-family: 'LatoLatin-Bold';    
}
        
.slider h2{
    margin: 3.5rem 0 2.5rem;
}
.slider{
    margin-bottom: 3.5rem;
}
.slider .swiper-slide .tt{
    margin: 1rem 0;
}
@media only screen and (orientation:landscape){
    .related-slider .swiper-slide{
        width: 45%;
    }
}
CSS;
$this->registerCss($css);
$js = <<<JS
var relatedSwiper = new Swiper('.related-slider', {
        slidesPerView: 'auto',
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        onReachBeginning: function(swiper){
             swiper.params.centeredSlides = false;
            swiper.params.initialSlide = 0;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
        onReachEnd: function(swiper){
             swiper.params.centeredSlides = false;
             swiper.params.initialSlide = swiper.slides.length - 1;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
    });
JS;
$this->registerJs($js)?>