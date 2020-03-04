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
<? $this->registerCssFile('/assets/css/page2016/host.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <? if(!empty($theEntry->photosArray['banner'])) :
            $v = $theEntry->photosArray['banner'][0]; ?>
    <img alt="" style="width: 100%" class="banner img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
    <? else: ?>
    <img alt="" class="img-lazy" style="width: 100%;" src='<?=DIR?>upload/image/banner-idees-de-voyage-single.jpg'>
    <? endif; ?>
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
</div>

<div class="contain container-2 non-area-form container-fluid row-content-1 px-0">
    <div class="amc-column d-flex row pb-40 px-0">
        <div class="p-0 img">
        <? if(!empty($theEntry->photosArray['custom'][0])) : 
            $v = $theEntry->photosArray['custom'][0];
            ?>
            <img alt="" class="banner img-lazy w-100" alt="<?= $v->description?>" data-src='<?= $v->image?>'/>
        <? endif; ?>
        </div>
        <div class="intro pr-20 px-0 col text-left float-right w-540 col-lg-auto pt-40">
            <h1 class="title text-transform-none my-0"><?= str_replace('|', '<br>',$theEntry->title)?></h1>
            <p class="tt-s mt-txt-25 mb-txt-40">
                <?= $theEntry->model->summary?>
            </p>
            <div class="des-icon row no-gutters">
                <div class="col col-sm location text-center">
                    <img class="mb-1" data-src="/assets/img/page2016/posi-big.png" alt="" src="/assets/img/page2016/posi-big.png">
                    <p class="d-block w-100 tt-latolatin-bold mb-0"><?=$fields['location']->title ?></p>
                    <div class="posi-link">
                            <? if(!empty($theEntry->data->location)) : 
                                $des = \app\modules\destinations\api\Catalog::get($theEntry->data->location[0]);
                                ?>
                                <a class="color-6b" href="/<?=$des->slug ?>"><?=$des->title; ?></a>
                            <? endif; ?>
                    </div>
                </div>
                <div class="col col-sm timebegin  text-center">
                    <img class="mb-1" data-src="/assets/img/page2016/house-icon.png" alt="" src="/assets/img/page2016/posi-big.png">
                    <p class="d-block w-100 tt-latolatin-bold mb-0"><?=$fields['timebegin']->title ?></p>
                    <span class="text color-6b">
                        <?=!empty($theEntry->data->timebegin) ? $theEntry->data->timebegin : ''?>
                    </span>
                </div>
                <div class="col col-sm when  text-center">
                    <img class="mb-1" data-src="/assets/img/page2016/icon_time_big.png" alt="" src="/assets/img/page2016/posi-big.png">
                    <p class="d-block w-100 tt-latolatin-bold mb-0"><?=$fields['when']->title ?></p>
                    <span class="text color-6b">
                        <?=!empty($theEntry->data->when) ? $theEntry->data->when : ''?>
                    </span>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-0 story-fluid d-flex justify-content-end mb-60">
    <div class="img  d-flex align-items-center justify-content-center">
      <? if(!empty($theEntry->photosArray['icon'])) :
        $illu = $theEntry->photosArray['icon'][0];
       ?>
       <img data-src="<?=$illu->image ?>" alt="<?=$illu->description?>">
     <? endif; ?>
    </div>
    <div class="float-right story">
      <div class="text">
        <h2 class="tt tt-fontsize-24 tt-latolatin-bold mt-0 mb-txt-25"><?=$fields['story']->title ?></h2>
        <?=!empty($theEntry->data->story) ?  $theEntry->data->story : '' ?>
      </div>
    </div>
    
</div>
<? if(!empty($theEntry->data->spirit)) : 
  ?>
<div class="container-fluid des-fluid contain text-center p-0">
  <? if(!empty($theEntry->data->video)) : ?>
    <div class="video-fluid">
        <div class="amc-column text-left p-0 mb-txt-0">

            <div class="video-col container position-relative p-0" data-analytics="on" data-analytics-category="host_page" data-analytics-action="video_section" data-analytics-label="control_play"><?=$theEntry->data->video;?></div>

        </div>
    </div>    
      <? endif; ?>
    <div class="text-row mb-txt-40">
        <div class="main-content amc-column p-0 mt-0 mb-0 text-justify">
            <? if(!empty($theEntry->photosArray['custom'][1])) :
              $img = $theEntry->photosArray['custom'][1];?>
              <img class="float-right ml-40 mt-10 mb-sm-2 mb-lg-0" data-src="<?=$img->image ?>" alt="<?=$img->description ?>">
              <? endif; ?>
            <div class="text">

              <h2 class="tt-latolatin-bold tt-fontsize-24 tt mb-txt-25 mt-0"><?=$fields['spirit']->title?></h2>
              <?=$theEntry->data->spirit; ?>
            </div>
        </div>
    </div>
    <? if(!empty($theEntry->data->des)) : ?>
    <div class="amc-column text-center p-0 ">
        <h2 class="tt-fontsize-24 tt-latolatin-bold mb-txt-25 mt-0"><?=$fields['des']->title ?></h2>
        <div class="content-des  w-720 mx-auto mb-txt-60">
          <?=$theEntry->data->des  ?>
        </div>
    </div>
    <? endif; ?>
</div>
<? endif; ?>
<div class="container-fluid p-0 mx-0 mb-60">
    <? $galeriesBf =  array_reverse($theEntry->photos);
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
                <? $galeriesBf =  array_reverse($theEntry->photos);
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
      <? if($galeries)  : ?>
        <? include('_inc_galeries_tour.php') ?>
      <? endif; ?>
</div>
<? if(!empty($theEntry->data->activity)) : ?>
<div class="container-fluid mx-0 contain text-center mb-60">
    <div class="amc-column mx-auto text-left">
      <h2 class="tt tt-fontsize-24 tt-latolatin-bold text-center mt-0 mb-txt-25"><?=$fields['activity']->title ?></h2>
      <div class="content-acti w-720 mx-auto text-center mb-txt-40">
        <?=$theEntry->data->activity ?>
      </div>
      <? if($icons) : ?>
      <div class="icon-acti row mx-0 px-0">
        <? foreach ($icons as $key => $v) : ?>
         <div class="col col-sm d-flex align-items-start">
            <? if(!empty($v->photosArray['icon'])) : 
              $icon = $v->photosArray['icon'][0];
              ?>
              <img class="mr-20" data-src="<?=$icon->image ?>" alt="<?=$icon->description ?>"/>
            <? endif; ?>
            <div class="d-flex align-items-center flex-wrap">
              <p class=" tt-latolatin-bold mb-1 w-100"><?=$v->title; ?></p>
              <p class="m-0"><?=$v->model->summary; ?></p>
            </div>
          </div>
        <? endforeach; ?>
      </div>
      <? endif;?>
    </div>
</div>
<? endif; ?>
<div class="contain container-4 text-center">
    <div class="amc-column container text-left">
         <div class="d-block devis-btn-block mt-0  container-fluid d-flex justify-content-center align-items-center py-20">
            <div class="text text-center mr-40 ">
                Cette expérience vous intéresse ?
            </div>
            <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
            <button  data-analytics="on" data-analytics-category="host_page" data-analytics-action="quote_section" data-analytics-label='
cta_contact'  data-title="<?= base64_encode('/nous-contacter ') ?>" class="ml-60 btn-amica-basic btn-amica-basic-2 pugjd" >Contactez-nous</button>
        </div>
    </div>
    <? if(!empty($theEntry->data->excl)) : ?>
    <div class="amc-column container text-left d-flex justify-content-center mt-40 mb-60">
        <a href="/<?=$excl[0]->slug ?>" class="tt-latolatin-bold" data-analytics="on" data-analytics-category="host_page" data-analytics-action="quote_section" data-analytics-label='link_secret'><img class="mr-2" data-src="/assets/img/eye-icon.png">En savoir plus sur la formule</a>
    </div>
    <? endif; ?>
</div> 

<?php
$js= <<<JS
var slide1 = $('.custom-bxslider').bxSlider({
      minSlides: 2,
      maxSlides: 3,
      moveSlides: 1,
      slideWidth: 299,
      slideMargin: 21.5,
      pager: false,
      infiniteLoop: false,
      responsive: false,
      autoControls: true,
      hideControlOnEnd: true,
      nextText: '<span style="left: 0; right: 0; top: 0; bottom: 0; width: 100%; height: auto;" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="control_right">Next</span>',
      prevText: '<span style="left: 0; right: 0; top: 0; bottom: 0; width: 100%; height: auto;" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="tours_section" data-analytics-label="control_left">Prev</span>'
    });
var slide2 = $('.secret-bxslider').bxSlider({
      minSlides: 2,
      maxSlides: 3,
      moveSlides: 1,
      slideWidth: 299,
      slideMargin: 21.5,
      pager: false,
      infiniteLoop: false,
      responsive: false,
      autoControls: true,
      hideControlOnEnd: true,
      nextText: '<span style="left: 0; right: 0; top: 0; bottom: 0; width: 100%; height: auto;" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="control_right">Next</span>',
      prevText: '<span style="left: 0; right: 0; top: 0; bottom: 0; width: 100%; height: auto;" data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="secrets_section" data-analytics-label="control_left">Prev</span>'
    });
var slide3 = $('.testi-bxslider').bxSlider({
      minSlides: 1,
      maxSlides: 2,
      moveSlides: 1,
      pager: false,
      infiniteLoop: false,
      responsive: true,
      autoControls: true,
      hideControlOnEnd: true,
});
JS;

$this->registerJs($js);
?>
