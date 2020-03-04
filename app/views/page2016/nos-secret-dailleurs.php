<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/nos-secret-dailleurs.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain container-1">
    
     <?php
        if(!empty($theEntry->photosArray['banner'])){
          $value = $theEntry->photosArray['banner'][0];
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-nos-secret.jpg'>
    <?}?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"><?= $this->context->pageT; ?></h1>
    </div>
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        <?= str_replace('col col-', 'amc-col amc-col-', $theEntry->model->content)?>
        
    </div>
</div>

<div class="contain container-5 lazy-background">
    
    <div class="amc-column">
        <div class="rows row-1">
             <h2 class="tt"><?= !empty($theEntry->data->host) ? $theEntry->data->host : ''?></h2>
            <div class="area-swiper swiper-slider">
             <div class="swiper-container custom-slides-swiper">
                 <div class="swiper-wrapper">
                 <?php
                    foreach ($theEntries as $k=>$v) :
                 ?>
				 
                    <div class="swiper-slide slide">
                        <a href="<?=DIR.$v->slug?>">
                            <? if(!empty($v->photosArray['summary'])) :
                                $img = $v->photosArray['summary'][0];
                             ?>
                            <img alt="<?= $img->description?>" class="" data-src="<?=DIR?>thumb/140/140/1/80<?= $img->image?>">
                            <? endif; ?>

                                <h3 class="title"><?= !empty($v->model->sub_title) ? $v->model->sub_title : $v->title;?></h3>
                                <h4 class="destination">
                               <? if(!empty($v->data->location)) : 
                                $des = \app\modules\destinations\api\Catalog::get($v->data->location[0]);
                                ?>
                                <?=!empty($des->model->summary_title) ? $des->model->summary_title : $des->title; ?></br><?=ucfirst(explode('/',$des->slug)[0])?> 
                            <? endif; ?></h4>
                         </a>


                   </div>
					<? endforeach; ?>
                </div>    
             </div>    
                 <!-- If we need navigation buttons -->
            <div class="swiper-button-prev" style="top: 25%;"></div>
            <div class="swiper-button-next" style="top: 25%;"></div>   
            <div class="swiper-pagination"></div>
        </div>
             <a class="link-btn btn-amica-basic radius-5 mt-txt-40" href="/formules/chez-habitant">Voir tous les formules</a>
        </div>
            
    </div>
        
</div>
<div class="contain container-6 fix-space-vs-back-button">
    <div class="amc-column">
        <div class="area-col col-left">
            <p class="tt">Notre équipe à votre écoute</p>
        </div> 
        <div class="area-col col-right">
            <ul>
                <li><span class="btn-link-form pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Faites-nous savoir vos attentes</span></li>
                <li><span class="btn-link-form pugjd" data-title="<?= base64_encode(DIR.'rdv-telephonique') ?>">Convenir d'un RDV téléphonique</span></li>
            </ul>
        </div>
    </div>   
</div> 
<!-- BACK BUTTON -->
<div style="clear: both;height: 60px;"><? /*include '_inc_back_button.php';*/ ?></div>
<!-- End BACK BUTTON -->  
<?php
//$this->registerCssFile('/assets/js/bxslider/jquery.bxslider.css');
//$this->registerJsFile('/assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$js=<<<JS

      var swiper = new Swiper('.custom-slides-swiper', {
        slidesPerView: 6,
        slidesPerGroup: 6,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        breakpoints: {
            960: {
              slidesPerView: 4,
              slidesPerGroup: 4,
            },
           
          }
    });                     
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$this->registerCss('.back-button .line:last-of-type {
    border: none;
}
.swiper-button-next.swiper-button-disabled, .swiper-button-prev.swiper-button-disabled{
  display: none;
}');
?>