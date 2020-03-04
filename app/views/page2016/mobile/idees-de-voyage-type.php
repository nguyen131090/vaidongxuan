<?php 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country-ideel.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2 container-filter">
    <div class="column">

        <div class="area-filter fix-banner-top no-padding">
          <? if(!empty($theEntry->photosArray['banner'])) :
            $v = $theEntry->photosArray['banner'][0]; ?>
                    <img class="image-banner img-responsive lazyload" alt="<?= $v->description; ?>" data-sizes="auto" data-src='<?= $v->image ?>' data-srcset="/thumb/600/400/1/80<?= $v->image?> 450w, /thumb/900/0/1/80<?= $v->image?>">
                
                <? else : ?>
                    <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
                <? endif; ?>    
            
            
            <span class="fil-background"></span>
             <? if($theEntry->model->seo != NULL){ ?>
                <h1 style="bottom: 2rem;" class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 style="bottom: 2rem;" class="tt-title tt-fontsize-45 tt-latolatin-bold  tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
        </div>
    </div>
</div>
<div class="contain  top-tours">
    <p class="tt-s mt-txt-80 mb-txt-80">
                <?= $theEntry->model->summary?>
            </p>
        <button data-title="<?= base64_encode('/devis') ?>" class="btn-devis devis-btn pugjd mb-txt-80" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="intro_section" data-analytics-label="cta_devis">Demander un devis personnalisé</button>
    
    <? include_once '_inc_video_page.php'; ?>    
        
    <div class="column col-tours">

        <h2 class="tt mt-0 d-inline-block w-100 mb-txt-50 tt-fontsize-40"><?=!empty($toursCon) ? $toursCon->title : '' ?></h2>
        <div class="mt-0 mb-txt-50  width-700 mx-auto "><?=!empty($toursCon) ? $toursCon->description : '' ?></div>
    <div class=" countries-slider my-0">
                <div class="swiper-wrapper">
            
                <? foreach($theEntries as $key => $v) : ?>
                    <div class="swiper-slide item-img p-0">
                    <a href="<?=DIR.$v->slug ?>" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$v->model->item_id ?>">
                        <? if(isset($v->photosArray['summary'])) : ?>
                            <img class="w-100 " alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="<?=$v->photosArray['summary'][0]->image ?>">
                            <? endif; ?>
                    </a>        
                       <div class="text pl-15 col col-sm col-lg-12 d-sm-flex amc-fix-pb-25-0 flex-sm-column d-lg-block">
<!--                            <span class="space space-10 space-horizontal"></span>    -->
                            <p class="tt-color-6b6b6b tt-fontsize-28 p-0 m-0 amc-fix-mt-12-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                            <p class="m-0 p-0 amc-fix-mt-15 tt tt-1 tt-fontsize-40 tt-latolatin-bold tt-line-height-1-2" name="pop-<?=$key+1 ?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $v->model->item_id ?>">
                                <a class="tt-line-height-1-2 tt-latolatin-bold" href="/<?=$v->slug?>"><?=$v->title;?></a>
                            </p>
                            <p class="sub-title m-0 p-0 amc-fix-mt-15"><?=\app\helpers\Text::limit_text($v->model->summary, 100); ?></p>
                            <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                <p class="tt-color-6b6b6b tt-fontsize-28 m-0 p-0 amc-fix-mt-15">
                                    <?= (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0) ? $v->model->days.' jours ' : ''; ?> 
                                    <?   
                                        if((isset($v->data->budget) && $v->data->budget != '')){
                                            if(isset($v->model->days) && $v->model->days != '' && $v->model->days > 0){
                                                echo 'à partir de '.$v->data->budget.'€'; 
                                            }else{
                                                echo 'À partir de '.$v->data->budget.'€'; 
                                            }
                                        }    

                                    ?>
                                </p>
                            <? } ?>
                            
                        </div>
                    
                    </div>
                <? endforeach; ?>
            </div>
        </div>

        <? if(count($theEntries) > 2) : ?>
        <a href="/voyage/itineraire?country=all&type=<?=$theEntry->model->category_id ?>&length=all" class="tt-latolatin-bold tt-color-e65925 d-block btn-amica-basic-1 btn-amica-basic mx-auto mt-50 button-devis" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="cta_inspi_tours">Plus de circuits</a>
        <? endif; ?>
    </div>

    <? $imgContent = ''; 
    if(!empty($theEntry->photosArray['banner'][1])){
        $imgContent = $theEntry->photosArray['banner'][1]->image;
    } ?>
    <div class="column content-col mt-80" >
            <div  class="image-left">
                <img data-sizes= 'auto' data-src="<?= $imgContent?>" data-srcset='/thumb/640/440/1/80<?= $imgContent?> 450w, <?= $imgContent?>' class="float-left d-sm-block d-lg-none lazyload">
<!--                <img data-src="/assets/img/tour/bg-content-image.png" class="position-absolute bg-image-content  w-100">-->
                <div class="fill-bg"></div>
            </div>
            <div class="col-content p-0">
                <h2 class="tt mt-txt-50 mb-txt-50  tt-fontsize-40"><?=!empty($theEntry->data->contenttitle) ? explode('|', $theEntry->data->contenttitle)[0] : '' ?><br class="d-sm-none d-lg-inline"><span class=""><?=!empty(explode('|', $theEntry->data->contenttitle)[1]) ? explode('|', $theEntry->data->contenttitle)[1] : '' ?>...</span></h2>
                <div class="text mb-txt-50">
                    <?=$theEntry->model->content ?>
                </div>
                <div class="icons">
                    <? foreach($icons as $k => $v) : ?>
                        <div class="amc-col col-sm text-center mb-50">
                        <? if(!empty($v->photos)) : 
                            $img = $v->photos[0];
                            ?>
                            <img class="mb-2" data-src="<?=$img->image ?>">
                        <? endif; ?>
                        <p class="m-0 tt-latolatin-bold"><?=$v->title; ?></p>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            
    </div>
    <? if(!empty($exclCon)) : ?>
    <div class="column no-padding bg-f7 formules-col pt-0">
        <h2 class="tt mt-txt-50 mb-txt-50 d-inline-block w-100  tt-fontsize-40"><?=!empty($exclCon) ? $exclCon->title : '' ?></h2>
        <div class="mt-0 mb-txt-50  width-700 mx-auto"><?=!empty($exclCon) ? $exclCon->description  : '' ?></div>
    <div  class="countries-slider swiper-container full-width my-0">
            <div class="swiper-wrapper">
            <? foreach ($excl as $key => $v) : ?>
            <div  class="swiper-slide swiper-slide-80">
                    <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                    <div class="img topopup" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_<?=$v->model->item_id ?>">
                        
                            <? if(isset($v->photosArray['summary'])) : ?>
                            <img class="w-100" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/299/200/1/100<?=$v->photosArray['summary'][0]->image ?>">
                            <? endif; ?>
                        
                        </div>
                        </span>
                        <div class="text ">
                        <p class="tt tt-1 mb-0 topopup mt-txt-50" name="pop-<?=$key+1 ?>" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_t_<?=$v->model->item_id ?>">
                            <a class=" tt-fontsize-28 tt-latolatin-regular" href="/<?=$v->slug?>"><?=$v->title;?></a>
                        </p>
                    </div>
              </div>
            <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>
<? if(!empty($portCon)) : ?>
<? 
$imgPort = '';
if(!empty($theEntry->photosArray['custom'][2])){
    $imgPort = $theEntry->photosArray['custom'][2];
}
?>
    <div class="column portrait bg-f7 no-padding mt-50">
        <img class="w-100 focus-center my-0 no-padding focus-center" data-src="<?=$imgPort ? "/thumb/1100/440/1/80$imgPort->image" : '/thumb/1100/440/1/80/assets/img/tour/bg-portrait.jpg'?>">
        <div class="block-excl p-25 d-inline-block">
            <h2 class="tt mb-20 mt-40  tt-fontsize-40"><?=!empty($portCon) ? $portCon->title : '' ?></h2>
            <div class="mt-0 mb-20"><?=!empty($portCon) ? strip_tags($portCon->description) : '' ?></div>
            <a class="btn-amica-basic-1 btn-amica-basic float-right button-devis mb-50" href="/<?=$port[0]->slug ?>" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="cta_portrait_<?=$port[0]->model->item_id ?>">Lire le portrait</a>
        </div>
    </div>
<? endif;?>
<? if(!empty($testiCon)) : ?>
    <div class="column p-0 testi-column">
            <p class="tt mt-50 mb-50 tt-fontsize-40 tt-custom"><?=!empty($testiCon) ? $testiCon->title : '' ?></p>
            <div class="mt-0 mb-50"><?=!empty($testiCon) ? $testiCon->description : '' ?></div>
            <div class="testi-slider">
                <div class="swiper-wrapper">
                <? Yii::$app->formatter->locale = 'fr-FR'; ?>    
                <? foreach ($testi as $key => $v) : ?>
                <div class="swiper-slide bg-f7">
                        <p class="summary mt-40 mb-2"><?=$v->model->summary; ?></p>
                        <div class="detail text-center d-inline-flex justify-content-center align-items-center mb-40">
                                <? if(!empty($v->photos)) : 
                                    $img = $v->photos[0];
                                    ?>
                                    <img class="d-inline-block mr-2" data-src="/thumb/48/48/1/80<?=$img->image ?>" alt="">
                                <? else: ?>
                                <img class=" mr-2" data-src="/assets/img/tour/client-df.png">
                                <? endif; ?>
                            <div class="text d-inline-block text-left ">
                                <p class="client my-0 tt-fontsize-28 tt-latolatin-bold"><?=$v->data->nameclient; ?></p>
                                <p class="my-0 tt-fontsize-28"><? if(isset($v->data->countries)) : ?>
                            <? $countries = $v->data->countries; ?>
                            <? foreach ($countries as $key => $value) {
                                echo Yii::$app->params['tsDestinationList'][$value];
                                echo ", ";
                                if($key==count($countries)-1) break;
                            } ?>
                        <? endif;?>
                        <?=ucfirst(Yii::$app->formatter->asDate($v->data->from, 'php:F Y'))?>    
                        </p>
                            </div>
                        </div>
                  </div>
                <? endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
    </div>
    <? endif; ?>
<? if(!empty($arrBlog)) : ?>
    <div class="column col-tours ">
        <h2 class="tt mt-txt-50 d-inline-block w-100 mb-txt-50 tt-fontsize-40"><?=!empty($blogsCon) ? $blogsCon->title : '' ?></h2>
        <div class="mt-0 mb-txt-50  width-700 mx-auto"><?=!empty($blogsCon) ? $blogsCon->description : '' ?></div>
        <div class="blogs countries-slider mb-50">
            <div class="swiper-wrapper">
            <?php
                $cnt = 0;
                if(!empty($arrBlog)){
                foreach ($arrBlog as $value) {
                    
                $cnt++;    
               
                   
            ?>
            <div class="item-img item swiper-slide">
                <a href="<?= $value['link']?>" target="_blank" rel="noopener" >
                    <div class="img position-relative" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="blog_section" data-analytics-label="blog_card_<?= $value['id'] ?>">
                        <img width="300" height="200" class="img-lazy img-responsive" alt="" data-src="<?= $value['src'] ?>" >
                        <p><?= $value['cat_name'] ?></p>
                    </div>
                    <div class="text p-3  bg-f7" >
                        <p class="mt-txt-50 tt title-item mb-txt-25 tt-fontsize-40 tt-line-height-1-2" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="blog_section" data-analytics-label="blog_card_t_<?= $value['id'] ?>"><?= $value['title']['rendered']?></p>
                        <p class="summary-blog"><?=strip_tags($value['excerpt']['rendered'])?></p>
                    </div>
                </a>
            </div> 
                <? }} ?>
            </div>
        </div>
    </div>
<? endif; ?>
    <button data-title="<?= base64_encode('/devis') ?>" class="devis-btn  btn-amica-basic btn-amica-basic-2 pugjd mb-80 mt-80" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Contactez-nous pour plus de détails</button>
    <? include('_inc_slider_bottom.php') ?>
</div>

<button class="btn-devis tt-latolatin-bold tt-fontsize-32 ui-link ui-footer-fixed" data-position='fixed' data-ajax="false">
    <span data-title="<?= base64_encode('/devis') ?>" class="btn-bottom-form-call pugjd" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_devis">Demander un devis personnalisé</span>
    <a href="tel:+33619081572" class="btn-bottom-form-call btn-phone" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_call">Call</a>
</button>

<? 
$uri = '/'.URI;
$js = <<< JS
$(function() {
var tourSwiper = new Swiper('.countries-slider', {
       slidesPerView: 2.1,
        centeredSlides: false,
        spaceBetween: 20,
        loop: false,
        breakpoints: {
            640: {
              slidesPerView: 1.1,
            }
          }
    });
var testiSwiper = new Swiper('.testi-slider', {
        pagination: '.swiper-pagination',
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 30,
        lazyLoading: true,
        loop: false,
         pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
        
        
    var curPage = $.mobile.activePage.attr("id");
    var lastScrollTop = 0;
    scrollMenu();

    function scrollMenu(){
        $(window).on('scroll', function() {

            var st = $(this).scrollTop();

            if(curPage == 'page1'){


                if(st > ($('.top-tours .btn-devis').offset().top + 50)){
                    $('.btn-devis.ui-footer-fixed').addClass('active');  
                } else $('.btn-devis.ui-footer-fixed').removeClass('active');  
            }


            lastScrollTop = st;
        }); 
    }

    $(document).on("pagechange", function(toPage) {
        scrollMenu();
    });        
        
});

JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>