<?php 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper4/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper4/swiper.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country-ideel.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/mobile/exclusivites-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain no-padding container-2 container-filter">
    <div class="column">

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
                <h1 style="bottom: 2rem;" class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 style="bottom: 2rem;" class="tt-title tt-fontsize-45 tt-latolatin-bold  tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
        </div>
    </div>
</div>
<div class="contain top-tours">
    <p class="tt-s mt-txt-80 mb-txt-80">
                <?= $theEntry->model->content?>
            </p>
        <button data-title="<?= base64_encode('/devis') ?>" class="btn-devis devis-btn pugjd mb-txt-80" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="intro_section" data-analytics-label="cta_devis">Demander un devis personnalisé</button>
    <div class="w-100 highlights mx-0 px-0 mb-80 tt-fontsize-32 tt-latolatin-regular">
        <div class="amc-col col-sm-12 d-flex">
            <div class="icon-hl icon-hl-1 d-block d-lg-inline-block">
                <span></span>
            </div>
            <span class="content-hl content-hl-1"><?=$theEntry->data->highlight1 ?></span>
        </div>
        <div class='col-12 col-arrow  px-0'></div>
        <div class="amc-col col-sm-12  d-flex">
            <div class="icon-hl icon-hl-2 d-block d-lg-inline-block">
                <span></span>
            </div>
            <span class="content-hl content-hl-2"><?=$theEntry->data->highlight2 ?></span>
        </div>
        <div class='col-12 col-arrow px-0'></div>
        <div class="amc-col col-sm-12  d-flex">
            <div class="icon-hl icon-hl-3 d-block d-lg-inline-block">
                <span></span>
            </div>
            <span class="content-hl content-hl-3"><?=$theEntry->data->highlight3 ?></span>
        </div>
    </div>

 <? include_once '_inc_video_page.php'; ?>        
        
<div class="bg-f7 contain mt-0">
    <div class="column col-tours">

        <h2 class="tt mt-txt-50 mb-txt-50 tt-latolatin-bold  tt-fontsize-40"><?=!empty($fieldsCat['formules']) ? $fieldsCat['formules']->title : '' ?></h2>
        <div class="mt-0 mb-txt-50  width-700 mx-auto "><?=!empty($theEntry->data->formules) ? $theEntry->data->formules : '' ?></div>
    </div>
</div>
<div class="bg-f7 contain">        
    <div class="countries-slider swiper-container full-width my-0">
                <div class="swiper-wrapper">
            
                <? foreach($theEntries as $key => $v) : ?>
                    <div class="swiper-slide item-img">
                        <a href="<?=DIR.$v->slug ?>" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_<?=$v->model->item_id ?>">
                            <? if(isset($v->photosArray['summary'])) : ?>
                            <img class="w-100" style="min-height: 20rem;" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/329/219/1/80<?=$v->photosArray['summary'][0]->image ?>">
                                <? endif; ?>
                        </a>        
                        <div class="text">
                            <p class="tt-1 mt-txt-50 mb-0 topopup tt-fontsize-28 tt-line-height-1-2" name="pop-<?=$key+1 ?>">
                                <a class="line-height-1-2" href="/<?=$v->slug?>" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section"  data-analytics-label="secret_card_t__<?=$v->model->item_id ?>"><?=$v->title;?></a>
                            </p>
                        </div>
                    
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    <div class="bg-f7">
        
        <a href="/formules/itineraire?country=all&type=<?=$theEntry->model->category_id ?>&length=all" class="tt-latolatin-bold tt-color-e65925 d-block btn-amica-basic-1 btn-amica-basic mx-auto mb-50 button-devis" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section" data-analytics-label="cta_inspi_formules">Plus de formules</a>
    </div>
</div>    


<?
$imgContent = ''; 
if(!empty($theEntry->photosArray['custom'][1])){
    $imgContent = $theEntry->photosArray['custom'][1]->image;
} ?>
    <div class="column content-col mt-50" >
            <div  class="image-left">
                <img data-src="/thumb/654/355/1/80/<?=$imgContent ?>&a=l" class="float-left d-sm-block d-lg-none lazyload" data-sizes= 'auto'  data-srcset='/thumb/654/355/1/80/<?= $imgContent?>&a=l 450w, <?= $imgContent?>&a=l'>
            </div>
            <div class="col-content p-0">
                <h2 class="tt mt-txt-50 mb-txt-50  tt-fontsize-40"><?=!empty($fieldsCat['host']) ? $fieldsCat['host']->title : '' ?> </h2>
                <div class="text mb-txt-50">
                    <?=!empty($theEntry->data->host) ? $theEntry->data->host : '' ?>
                </div>
                <div class="icons">
                    <? foreach($icons as $k => $v) : ?>
                        <div class="amc-col col-sm mb-<?=$k==2 ? 80 : 50 ?> d-flex">
                        <div class="icon-img">
                            <? if(!empty($v->photos)) : 
                                $img = $v->photos[0];
                                ?>
                                <img class="mb-2" data-src="<?=$img->image ?>">
                            <? endif; ?>
                        </div>
                        <div class="text-icon">
                            <p class="mb-0 tt-latolatin-bold w-100 mt-0"><?=$v->title; ?></p>
                            <p class="icon-sum mt-0 mb-0"><?=$v->model->summary ?></p>
                        </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            
    </div>
  <? if(!empty($tours)) : ?>
    <div class="column no-padding bg-f7 formules-col pt-0 pb-80">
        <h2 class="tt mt-50 mb-txt-50 d-inline-block w-100  tt-fontsize-40"><?=!empty($fieldsCat['tourtt']) ? $fieldsCat['tourtt']->title : '' ?></h2>
        <div class="mt-0 mb-txt-50  width-700 mx-auto"><?=!empty($theEntry->data->tourtt) ? $theEntry->data->tourtt  : '' ?></div>
    <div  class="countries-slider swiper-container full-width my-0 tours-slider mb-80">
            <div class="swiper-wrapper">
            <? foreach($tours as $key => $v) : ?>
                    <div class="swiper-slide item-img bg-fff">
                        <a href="<?=DIR.$v->slug ?>" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$v->model->item_id ?>">
                            <? if(isset($v->photosArray['summary'])) : ?>
                                <img class="w-100" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="<?=$v->photosArray['summary'][0]->image ?>">
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
    </div>
<? endif; ?>
    <button data-title="<?= base64_encode('/devis') ?>" class="devis-btn  btn-amica-basic btn-amica-basic-2 pugjd mt-80" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Nous contacter pour plus de détails*</button>
        <p class="container mt-txt-80 mb-80 " align="center">
            <? if(!empty($theEntry->data->note)) :  ?>
        <i class="tt-fontsize-28"><?=$theEntry->data->note;?></i>
        <? endif; ?>
        </p>
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
        slidesPerView: 1.1,
        centeredSlides: false,
        spaceBetween: 20,
        loop: false,
    });
    var testiSwiper = new Swiper('.testi-slider', {
        slidesPerView: 1.1,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false
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