<?php 
use \yii\helpers\ArrayHelper;
use app\helpers\Text;
$datacategory = '';
$this->registerCssFile('/assets/css/page2016/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerCssFile('/assets/css/page2016/idees-de-voyage-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END])
 ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

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
    <div class="amc-column d-flex row py-40">
        <div class="col-4 col-sm-4">
        <? if(!empty($theEntry->photosArray['custom'][1])) : 
            $v = $theEntry->photosArray['custom'][1];
            ?>
            <img alt="" class="banner img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
        <? endif; ?>
        </div>
        <div class="intro px-20 col text-left">
            <h1 class="title text-transform-none my-0"><?= str_replace('|', '<br>',$this->context->pageT)?></h1>
            <p class="tt-s mt-txt-25 mb-txt-40">
                <?= $theEntry->model->summary?>
            </p>
            <span data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="intro_section" data-analytics-label="cta_devis" data-title="<?= base64_encode('/devis') ?>" class="target-scroll-for-tablet pugjd btn-contact btn-amica-basic btn-amica-basic-2">Demander un devis personnalisé</span>
        </div>
    </div>
</div>

<? include_once '_inc_video_page.php'; ?>

<div class="container-fluid tours bg-f7">
    <div class="container amica-column col-tours pl-0 pr-0 pb-40">
        <h2 class="tt mt-txt-40 text-center d-inline-block w-100 mb-0"><?=!empty($toursCon) ? $toursCon->title : '' ?></h2>
        <div class="mt-txt-25 mb-txt-25  width-700 mx-auto text-center"><?=!empty($toursCon) ? $toursCon->description : '' ?></div>
        <div class="swiper-slider area-slider-swiper">
        <div class="custom-bxslider swiper-container">
            <div class="swiper-wrapper row-content">
            <? foreach ($theEntries as $key => $v) : ?>
            <div class="swiper-slide img-zoom-span item text-left">
                    <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                    <div class="img topopup" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$v->model->item_id ?>">
                        
                            <? if(isset($v->photosArray['summary'])) : ?>
                        <img style="min-height: 200px; max-width: 299px;" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/299/200/1/100<?=$v->photosArray['summary'][0]->image ?>">                           
                          <? endif; ?>
                        </div>
                        </span>
                        <div class="text pl-20 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block mb-0 amc-fix-pb-25-0">
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0">
                                <?= $v->parents()[0]->title ?>  / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                                
                            <p class="tt tt-1 m-0 p-0 amc-fix-mt-25 topopup " name="pop-<?=$key+1 ?>">
                                <a class="tt-fontsize-18" href="/<?=$v->slug?>"  data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t__<?=$v->model->item_id ?>"><?=$v->title;?></a>
                            </p>
                            <p class="sub-title m-0 p-0 amc-fix-mt-20"><?=\app\helpers\Text::limit_text($v->model->summary, 100); ?></p>
                            <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-25 amc-fix-pb-25-0 m-0 p-0">
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
        <!-- If we need pagination -->
            <div class="swiper-pagination swiper-pagination-custom-bxslider"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-custom-bxslider"></div>
            <div class="swiper-button-next swiper-button-next-custom-bxslider"></div>  
        </div>
         <? if(count($theEntries) > 2) : ?>
        <div class="text-center">
        <a href="/voyage/itineraire?country=all&type=<?=$theEntry->model->category_id ?>&length=all" class="d-block btn-amica-basic-1 btn-amica-basic mx-auto mt-40" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="cta_inspi_tours">Plus de circuits</a>
        </div>
         <? endif; ?>
    </div>
</div>
<?
$imgContent = ''; 
if(!empty($theEntry->photosArray['banner'][1])){
    $imgContent = $theEntry->photosArray['banner'][1]->image;
} ?>
<div class="container-fluid content-fluid mt-txt-40 mb-60 d-inline-flex row p-0 justify-content-end align-items-center mx-0" >
        <div class=" col-12 col-sm-12 col-lg-7 float-left p-0 position-absolute  image-left">
            <div class="position-relative w-100 d-inline-block">
                <img data-src="<?=$imgContent ?>" class="float-left w-100 focus-center">
<!--            <img data-src="/assets/img/tour/bg-content-image.png" class="position-absolute bg-image-content w-100">
            <img data-src="/assets/img/tour/bg-content-image-bt.png" class="position-absolute bg-image-content bg-image-content-bt w-100">-->
                <div class="amc-fix-bg-image lazy-background visible"></div>
        </div>
        </div>

        <div class="col-content col-12 col-sm-12 col-lg-7 col-xl-7 float-right p-0">
            <h2 class="tt mt-txt-60"><?=!empty($theEntry->data->contenttitle) ? explode('|', $theEntry->data->contenttitle)[0] : '' ?> <br class="d-sm-none d-lg-inline"><span class="text-uppercase"><?=!empty(explode('|', $theEntry->data->contenttitle)[1]) ? explode('|', $theEntry->data->contenttitle)[1] : '' ?>...</span></h2>
            <div class="text">
                <?=$theEntry->model->content ?>
            </div>
            <div class="icons row mx-0 justify-content-center justify-content-lg-start">
                <? foreach($icons as $k => $v) : ?>
                    <div class="col col-sm-auto col-lg px-4 text-center">
                    <? if(!empty($v->photos)) : 
                        $img = $v->photos[0];
                        ?>
                        <img class="mb-2" data-src="<?=$img->image ?>">
                    <? endif; ?>
                    <p><?=$v->title; ?></p>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        
</div>
<? if(!empty($exclCon)) : ?>
<div class="container-fluid tours excl bg-f7 pb-40">
    <div class="container amica-column col-tours">
        <h2 class="tt mt-txt-40 text-center d-inline-block w-100"><?=!empty($exclCon) ? $exclCon->title : '' ?></h2>
        <div class="mt-txt-25 mb-txt-40  width-700 mx-auto text-center"><?=!empty($exclCon) ? $exclCon->description  : '' ?></div>
        <div class="swiper-slider area-slider-swiper secret-swiper">
            <div class="secret-bxslider  swiper-container">
                <div class="swiper-wrapper">
                <? foreach ($excl as $key => $v) : ?>
                <div class="swiper-slide img-zoom-span item text-left">
                        <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                        <div class="img topopup position-relative" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_<?=$v->model->item_id ?>">
                            
                                <? if(isset($v->photosArray['summary'])) : ?>
                                <img class="w-100" style="min-height: 200px; max-width: 299px;" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/299/200/1/100<?=$v->photosArray['summary'][0]->image ?>">
                                <? endif; ?>
                            
                            </div>
                            </span>
                            <div class="text px-0 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block">
                            <p class="tt tt-1 mt-txt-25 mb-0 topopup " name="pop-<?=$key+1 ?>" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_t_<?=$v->model->item_id ?>">
                                <a href="/<?=$v->slug?>"><?=$v->title;?></a>
                            </p>
                        </div>
                  </div>
                <? endforeach; ?>
                </div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination swiper-pagination-excl"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-excl"  data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="control_left"></div>
            <div class="swiper-button-next swiper-button-next-excl" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="control_right"></div>
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
<div class="container-fluid excl-container mt-60" <?=$imgPort ? "style='background-image: url($imgPort->image)'" : ''?>>
    <div class="container column text-left">
        <div class="block-excl p-25 d-inline-block">
            <h2 class="tt mb-20 mt-0"><?=!empty($portCon) ? $portCon->title : '' ?></h2>
            <p class="mt-0 mb-20"><?=!empty($portCon) ? $portCon->description : '' ?></p>
            <a class="btn-amica-basic-1 btn-amica-basic float-right" href="/<?=$port[0]->slug ?>" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="cta_portrait_<?=$port[0]->model->item_id ?>">Lire le portrait</a>
        </div>
    </div>
</div>
<? endif;?>
<? if(!empty($testiCon)) : ?>
<div class="container-fluid fluid-testi mt-60">
    <div class="amc-column row container">
        <div class="col-12 col-sm-12 col-lg-4 pr-25 pl-0">
            <p class="tt"><?=!empty($testiCon) ? $testiCon->title : '' ?></p>
            <div class="mt-25"><?=!empty($testiCon) ? $testiCon->description : '' ?> </div>
        </div>
        <div class="col-12 col-sm-12 col-lg-8 p-0 position-relative">
            <? Yii::$app->formatter->locale = 'fr-FR'; ?>
            <div class="swiper-slider">    
                <div class="swiper-container custom-slides-swiper-testi custom-slides-swiper-3-item">
                    <div class="swiper-wrapper testi-bxslider row-content">
                    <? $i = 0; foreach ($testi as $k => $v) { $i++;?>
                    <div class="swiper-slide item text-left px-40">
                        <p class="summary mt-40 mb-2">"<?=$v->model->summary; ?>" </p>
                        <div class="detail text-center d-flex justify-content-center align-items-center mb-40">

                            <img class=" mr-2" alt="" data-src="/assets/img/tour/client-df.png">

                            <div class="text d-inline-block text-left">

                                <p class="client my-0"><?= isset($v->data->nameclient) ? $v->data->nameclient : ''?></p>
                                <p class="my-0"><?=date('M Y',$v->time) ?></p>

                            </div>
                        </div>
                    </div>

                    <? } ?>    


                    </div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev swiper-button-prev-testi" data-analytics="on" data-analytics-category="homepage" data-analytics-action="testimonies_section" data-analytics-label="control_left"></div>
                <div class="swiper-button-next swiper-button-next-testi" data-analytics="on" data-analytics-category="homepage" data-analytics-action="testimonies_section" data-analytics-label="control_right"></div>  
                <div class="swiper-pagination swiper-pagination-testi"></div>
            </div>
        </div>
    </div>
</div>
<? endif; ?>
<? if(!empty($arrBlog)) : ?>
<div class="container-fluid tours guide d-inline-block">
    <div class="container container-blogs amica-column col-tours pl-0 pr-0">
        <h2 class="tt mt-txt-60 text-center d-inline-block w-100"><?=!empty($blogsCon) ? $blogsCon->title : '' ?></h2>
        <div class="mt-txt-25 mb-txt-40  width-700 mx-auto text-center"><?=!empty($blogsCon) ? $blogsCon->description : '' ?></div>
        <div class="blogs row no-guitters">
            <?php
                $cnt = 0;
                if(!empty($arrBlog)){
                foreach ($arrBlog as $value) {
                    
                $cnt++;    
               
                   
            ?>
            <div class="item-img item item-<?=$cnt?> mb-25 col col-sm mx-0 px-10">
                <a href="<?= $value['link']?>" target="_blank" rel="noopener" >
                    <div class="img position-relative">
                        <img width="300" height="200" class="img-lazy img-responsive" alt="" data-src="<?= $value['src'] ?>" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="blog_section" data-analytics-label="blog_card_<?= $value['id'] ?>">
                        <p><?= $value['cat_name'] ?></p>
                    </div>
                     </a>
                    <div class="text py-3 px-25 bg-f7" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="blog_section" data-analytics-label="blog_card_t_<?= $value['id'] ?>">
                        <a href="<?= $value['link']?>" target="_blank" rel="noopener" >
                        <p class="tt title-item <?= SEG1 == 'birmanie' ? 'mt-25' : '' ?> mb-txt-25"><?= $value['title']['rendered']?></p>
                    </a>
                        <p class="summary-blog"><?=$value['excerpt']['rendered']?></p>
                    </div>
               
            </div> 
                <? }} ?>
        </div>
    
    </div>
</div>
<? endif; ?>
<div class="contain container-4 text-center">
    <div class="amc-column container text-left">
         <div class="d-block devis-btn-block mt-60  container-fluid d-flex justify-content-center align-items-center py-20">
            <div class="text text-center mr-40 ">
                Cette expérience vous intéresse ?
            </div>
            <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
            <button data-title="<?= base64_encode('/devis') ?>" class="ml-60 btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Contactez-nous pour plus de détails</button>
        </div>
    </div>
    
</div>
<div class="contain text-center mb-60">
    <? include_once('_inc_swiper_slider_bottom.php'); ?>
</div>
<?php
$js= <<<JS
        
var slide1 =  new Swiper('.custom-bxslider', {
    slidesPerView: 3,
    slidesPerGroup: 3,
    watchOverflow: true,
    centerInsufficientSlides: true,
    spaceBetween: 20,
    loop: false,     
    navigation: {
        nextEl: '.swiper-button-next-custom-bxslider',
        prevEl: '.swiper-button-prev-custom-bxslider',
      },
    pagination: {
        el: '.swiper-pagination-custom-bxslider',
        clickable: true,
        renderBullet: function (index, className) {
            if(index == 0){
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-custom-bxslider').addClass(disablepagi);
            }else{
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-custom-bxslider').removeClass(disablepagi);
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
var slide1 =  new Swiper('.secret-bxslider', {
     slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 20,
    loop: false,     
    navigation: {
        nextEl: '.swiper-button-next-excl',
        prevEl: '.swiper-button-prev-excl',
      },
    pagination: {
        el: '.swiper-pagination-excl',
        clickable: true,
        renderBullet: function (index, className) {
            if(index == 0){
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-excl').addClass(disablepagi);
            }else{
                var disablepagi = 'swiper-pagination-disable';
                $('.swiper-pagination-excl').removeClass(disablepagi);
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

var swiper = new Swiper('.custom-slides-swiper-testi', {
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 0,
        loop: false,
        watchOverflow: true,
        centeredSlides: true,
        navigation: {
            nextEl: '.swiper-button-next-testi',
            prevEl: '.swiper-button-prev-testi',
        },
        pagination: {
            el: '.swiper-pagination-testi',
            clickable: true,
        },
    });   

JS;

$css=<<<CSS
.bx-wrapper .bx-loading{
    display: none !important;
}     
.bx-viewport .row-content{
    padding: 0 !important;
}        
CSS;
$this->registerCss($css);
$this->registerJs($js,  yii\web\View::POS_END);
?>
