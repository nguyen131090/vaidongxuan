<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/10-raisons.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain no-padding container-2">
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
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
                
        </div>
    </div>
    
       
</div>
<div class="contain container-3">
    <div class="column">
        <span class="space space-80"></span>
    <? 
        $cnt = 0;
        foreach ($theEntries as $value) { 
        $cnt++;    
    ?>
        <div class="item item-<?= $cnt ?>">
            <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-black tt-custom-h2"><?= $value->title ?></h2>
            <div class="text-sumary">
                <?= str_replace('src="', 'data-src="', $value->description) ?>
                
            </div>
        </div>
        <span class="space space-30"></span>
    <? } ?>
           
       
        
    </div>
</div>    
<div class="contain container-6 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        <p class="tt-custom">Besoin d’inspiration</p>
        <span class="space space-50"></span>
        <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925"><span>Faites-nous savoir vos attentes</span></span>
        <span class="space space-80"></span>
        
    </div>
</div> 
