<?php 
use \yii\helpers\ArrayHelper;
use app\helpers\Text;
$datacategory = '';
$this->registerCssFile(DIR . 'assets/js/mobile/swiper4/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile(DIR . 'assets/js/mobile/swiper4/swiper.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerCssFile(DIR.'assets/css/page2016/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerCssFile(DIR.'assets/css/page2016/idees-de-voyage-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerCssFile(DIR.'assets/css/page2016/exclusivites-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END])
 ?>
<?php $this->registerCssFile(DIR.'assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR.'assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile(DIR.'assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <? if(!empty($theEntry->photosArray['banner'])) :
            $v = $theEntry->photosArray['banner'][0]; ?>
    <img alt="" style="width: 100%" class="banner img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
    <? else: ?>
    <img alt="" class="img-lazy" style="width: 100%;" data-src='<?=DIR?>upload/image/banner-idees-de-voyage-single.jpg'>
    <? endif; ?>
     <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
</div>

<div class="contain container-2 non-area-form container row-content-1 px-0">
    <div class="amc-column d-flex row pt-40 pb-60">
        <div class="col-4 col-sm-4 text-center">
        <? if(!empty($theEntry->photosArray['custom'][0])) : 
            $v = $theEntry->photosArray['custom'][0];
            ?>
            <img alt="" class="banner img-lazy mt-txt-60" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
        <? endif; ?>
        </div>
        <div class="intro px-20 col text-left">
            <h1 class="title text-transform-none my-0"><?= str_replace('|', '<br>',$this->context->pageT)?></h1>
            <div class="tt-s mt-txt-40 mb-txt-40">
                <?= $theEntry->model->content?>
            </div>
            <span data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="intro_section" data-analytics-label="cta_devis" data-title="<?= base64_encode('/devis') ?>" class="target-scroll-for-tablet pugjd btn-contact btn-amica-basic btn-amica-basic-2">Demander un devis personnalisé</span>
        </div>
    </div>
    <div class="w-100 highlights row mx-0 d-flex px-0 mb-60">
        <div class="col col-sm d-lg-flex d-block">
            <div class="icon-hl icon-hl-1 d-block d-lg-inline-block">
                <span></span>
            </div>
            <span class="content-hl content-hl-1"><?=$theEntry->data->highlight1 ?></span>
        </div>
        <div class='col-1  px-0'></div>
        <div class="col col-sm  d-lg-flex d-block">
            <div class="icon-hl icon-hl-2 d-block d-lg-inline-block">
                <span></span>
            </div>
            <span class="content-hl content-hl-2"><?=$theEntry->data->highlight2 ?></span>
        </div>
        <div class='col-1 px-0'></div>
        <div class="col col-sm  d-lg-flex d-block">
            <div class="icon-hl icon-hl-3 d-block d-lg-inline-block">
                <span></span>
            </div>
            <span class="content-hl content-hl-3"><?=$theEntry->data->highlight3 ?></span>
        </div>
    </div>
</div>

<? include_once '_inc_video_page.php'; ?>

<div class="container-fluid tours bg-f7">
    <div class="container amica-column col-tours pb-40 px-0">
        <h2 class="tt mt-txt-40 text-center d-inline-block w-100 mb-0"><?=!empty($fieldsCat['formules']) ? $fieldsCat['formules']->title : '' ?></h2>
        <div class="mt-txt-25 mb-txt-40  width-700 mx-auto text-center"><?=!empty($theEntry->data->formules) ? $theEntry->data->formules : '' ?></div>
    <div class="area-slider-swiper formules-slider-container">
            <div class="formules-slider secret-bxslider row-content swiper-container">
            <div class="swiper-wrapper">
            <? foreach ($theEntries as $key => $v) : ?>
            <div class="img-zoom-span item text-left  swiper-slide">
                    <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                    <div class="img topopup position-relative" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_<?=$v->model->item_id ?>">
                        
                            <? if(isset($v->photosArray['summary'])) : ?>
                            <img class="w-100" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/306/200/1/100<?=$v->photosArray['summary'][0]->image ?>">
                            <? endif; ?>
                        
                        </div>
                        </span>
                        <div class="text p-0 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block">
                        <p class="tt tt-1 mt-txt-25 mb-0 topopup " name="pop-<?=$key+1 ?>">
                            <a class="tt-fontsize-18" href="/<?=$v->slug?>"  data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section"  data-analytics-label="secret_card_t__<?=$v->model->item_id ?>"><?=$v->title;?></a>
                        </p>
                    </div>
              </div>
            <? endforeach; ?>
            </div>
            </div>
            <div class="swiper-button-prev swiper-button-prev-formules" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section" data-analytics-label="control_left"></div>
            <div class="swiper-button-next swiper-button-next-formules" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section" data-analytics-label="control_right"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-pagination swiper-pagination-formules"></div>
        </div>
        <div class="text-center">
        <a href="/formules/itineraire?country=all&type=<?=$theEntry->model->category_id ?>&length=all" class="d-block btn-amica-basic-1 btn-amica-basic mx-auto mt-txt-40" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="secrets_section" data-analytics-label="cta_inspi_formules">Plus de formules</a>
        </div>
    </div>
</div>
<?
$imgContent = ''; 
if(!empty($theEntry->photosArray['custom'][1])){
    $imgContent = $theEntry->photosArray['custom'][1]->image;
} ?>
<div class="contain container-fluid content-fluid mb-60  p-0 text-center mx-0 host" >
        <div class=" col-12 col-sm-12 col-lg-12 float-left p-0 position-relative text-center">
            <div class="position-relative w-100 d-inline-block">
                <img class="lazyload" data-src="<?=$imgContent ?>" data-srcset='/thumb/960/505/1/80/<?= $imgContent?>&a=l 960w, <?= $imgContent?>'>
            </div>
        </div>

        <div class=" p-0 amc-column d-lg-flex d-inline-block">
            <h2 class="tt mt-txt-40 col-lg-3 col-12 text-left pl-0 mb-0"><?=!empty($fieldsCat['host']) ? $fieldsCat['host']->title : '' ?> </h2>
            <div class="text col pr-0 pb-0">
                <div class='text-content text-justify'>
                <?=!empty($theEntry->data->host) ? $theEntry->data->host : '' ?>
                </div>
                <div class="icons row mx-0 justify-content-center justify-content-lg-start mt-txt-40">
                        <? foreach($icons as $k => $v) : ?>
                            <div class="col col-sm col-lg  text-center px-2">
                            <? if(!empty($v->photos)) : 
                                $img = $v->photos[0];
                                ?>
                                <img class="mb-2" data-src="<?=$img->image ?>">
                            <? endif; ?>
                            <p class="icon-title"><?=$v->title; ?></p>
                            <p class="icon-sum"><?=$v->model->summary ?></p>
                            </div>
                        <? endforeach; ?>
                    </div>
            </div>
        </div>
</div>
<? if(!empty($tours)) : ?>
<div class="container-fluid tours bg-f7 pb-40">
    <div class="container amica-column col-tours px-0">
        <h2 class="tt mt-txt-40 text-center d-inline-block w-100"><?=!empty($fieldsCat['tourtt']) ? $fieldsCat['tourtt']->title : '' ?></h2>
        <div class="mt-txt-25 mb-txt-40  width-700 mx-auto text-center"><?=!empty($theEntry->data->tourtt) ? $theEntry->data->tourtt  : '' ?></div>
    <div class="area-slider-swiper row-content">
        <div class="custom-bxslider swiper-container">
            <div class="swiper-wrapper">
                <? foreach ($tours as $key => $v) : ?>
                <div class="img-zoom-span item text-left  pb-0 swiper-slide">
                        <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                        <div class="img topopup" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$v->model->item_id ?>">
                            
                                <? if(isset($v->photosArray['summary'])) : ?>
                                <img class="w-100" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/306/200/1/100<?=$v->photosArray['summary'][0]->image ?>">
                                <? endif; ?>
                            
                            </div>
                            </span>
                            <div class="text pl-20 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block amc-fix-pb-25-0">
                                <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $theEntry->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                                
                                <p class="tt tt-1 m-0 p-0 amc-fix-mt-25 topopup " name="pop-<?=$key+1 ?>">
                                    <a class="tt-fontsize-18" href="/<?=$v->slug?>"  data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t__<?=$v->model->item_id ?>"><?=$v->title;?></a>
                                </p>
                                <p class="sub-title m-0 p-0 amc-fix-mt-20"><?=\app\helpers\Text::limit_text($v->model->summary, 100); ?></p>
                                <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                    <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-25 m-0 p-0">
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
            <div class="swiper-button-next swiper-button-next-tours" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="tours_section" data-analytics-label="control_left"></div>
            <div class="swiper-button-prev swiper-button-prev-tours"  data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="tours_section" data-analytics-label="control_right"></div>
            <div class="swiper-pagination swiper-pagination-tours"></div>
        </div>
    </div>
</div>
<? endif; ?>

<div class="contain container-4 text-center mb-60">
    <div class="amc-column container text-left">
         <div class="d-block devis-btn-block mt-60  container-fluid d-flex justify-content-center align-items-center py-20">
            <div class="text text-center mr-40 ">
                Ces formules « Chez l’habitant » vous intéressent ?
            </div>
            <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
            <button data-title="<?= base64_encode('/devis') ?>" class="ml-60 btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Nous contacter pour plus de détails*</button>
        </div>
         <p class="des-button text-center mt-60 mx-auto mb-0">
        <? if(!empty($theEntry->data->note)) :  ?>
        <i class=""><?=$theEntry->data->note;?></i>
        <? endif; ?>
        </p>
        <? include_once('_inc_swiper_slider_bottom.php'); ?>
    </div>
</div>
<?php
$js= <<<JS
var swiper = new Swiper('.formules-slider', {
    slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 20,
    loop: false,     
    navigation: {
        nextEl: '.swiper-button-next-formules',
        prevEl: '.swiper-button-prev-formules',
      },
    pagination: {
        el: '.swiper-pagination-formules',
        clickable: true,
        renderBullet: function (index, className) {
            if(index == 0){
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-formules').addClass(disablepagi);
            }else{
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-formules').removeClass(disablepagi);
            }
            return '<span class="' + className + '"></span>';
        }
    },
    breakpoints: {
        961: {
          slidesPerView: 2.3,
          slidesPerGroup: 2,
        }
      }
});       
var swiper = new Swiper('.custom-bxslider', {
    slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 20,
    loop: false,     
    navigation: {
        nextEl: '.swiper-button-next-tours',
        prevEl: '.swiper-button-prev-tours',
      },
    pagination: {
        el: '.swiper-pagination-tours',
        clickable: true,
        renderBullet: function (index, className) {
            if(index == 0){
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-tours').addClass(disablepagi);
            }else{
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-tours').removeClass(disablepagi);
            }
            return '<span class="' + className + '"></span>';
        }
    },
    breakpoints: {
        961: {
          slidesPerView: 2.3,
          slidesPerGroup: 2,
        }
      }
});      
JS;

$this->registerJs($js,  yii\web\View::POS_END);
?>
