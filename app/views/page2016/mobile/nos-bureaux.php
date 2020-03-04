<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/nos-bureaux.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



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
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
                
        </div>
    </div>
    
       
</div>
<div class="contain container-1">
    <div class="row-content">
        
        
       
        <span class="space space-80"></span>
        
        <div class="all-tour ajaxfilter">
            <div class="getcontent">
               
            <?php
                $cnt = 0;
                $count = count($theEntries);
                foreach ($theEntries as $v) {
                    $cnt ++;
            ?>
            
            <div class="item item-<?= $cnt ?>">
                <div class="amc-col col-left">
                    <h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-000000 tt-custom"><?= $v->title ?></h2>
                    <span class="space space-40"></span>
                    <a href="<?= DIR.$v->slug ?>">
                        
                        <?php
                            if(isset($v->photos) && !empty($v->photos)) {

                                foreach ($v->photos as $value) {

                                    if ($value->model->type == 'summary') {
                                        ?>
                                        <img style="" class="img-lazy img-responsive" alt="<?= $value->description ?>" data-src="<?= $value->image ?>">
                                        <?php
                                    break;
                                    }
                                }
                            } ?>

                        <span class="fil-background"></span>
                        
                    </a>
                </div>
                <div class="amc-col col-right">
                    
                    <span class="space space-20"></span>
                    

                    <div class="summary">
                        <p>
                        <?= $v->data->adresse?>
                        <br>
                         Tél : <?= $v->data->tel?>
                        </p>  
                    </div>
                    <span class="space space-20"></span>
                    <a href="<?= DIR.$v->slug ?>" data-transition="slide" data-direction="reverse" class="area-filter custom-btn-filter">
                        <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-custom-btn-filter">En savoir plus</span>
                    </a>    
                    
                </div>
            </div>
            <? if($cnt < $count){ ?>
            <span class="space space-80 <?= ($cnt % 2) != 0 ? 'space-horizontal' : ''?>"></span>
            <? } ?>
            
            <? } ?>
            
            
            
            
            
            </div>
            
        
        </div>
        
        <span class="space space-50"></span>
    </div>
</div>    
<div class="contain container-6 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        <p class="tt-custom">Pour aller plus loin</p>
        <span class="space space-50"></span>
        <a href="<?=DIR?>explorateurs" class="btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925"><span>Parcourez le pays avec ceux qui y sont nés</span></a>
        <span class="space space-50"></span>
        <a href="<?=DIR?>voyage" class="btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925"><span>Bougez selon votre humeur du moment</span></a>
        <span class="space space-80"></span>
        
    </div>
</div> 
