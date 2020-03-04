<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/notre-equipe.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


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
        <?php
            $string = htmlentities($theEntry->model->content, null, 'utf-8');
            $content = str_replace("&nbsp;", "", $string);
            $content = html_entity_decode($content);        
            $item_content = explode('<hr />', str_replace(['style="text-align:center"', '<h2', '<h3','<p></p>'], [' ', '<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-000000 tt-custom-h2"', '<h3 class="tt-title tt-fontsize-32 tt-latolatin-bold tt-color-000000 tt-custom-h3"', ''], preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $content, -1 )));
        ?>
        <span class="space space-80"></span>
        <div class="rows row-1">
            <?= isset($item_content[0]) ? $item_content[0] : '' ?>
        </div>
        <span class="space space-20"></span>
       
        
    </div>
</div>    
<div class="contain container-4 contain-background-ededed">
    <div class="column">
       
        <span class="space space-50"></span>
        
        <div class="rows row-1">
            <?= isset($item_content[1]) ? $item_content[1] : '' ?>
        </div>
        <div class="rows row-2">
			<?= isset($item_content[2]) ? $item_content[2]: '' ?>
        </div>
        <span class="space space-20"></span>
    </div>
</div>  
<div class="contain container-5">
    <div class="column tt-fontsize-32 tt-latolatin-regular">
        <span class="space space-50"></span>
        <div class="rows row-1">
            <?= isset($item_content[3]) ? $item_content[3]: '' ?>
        </div>
        <span class="space space-20"></span>
       <div class="rows row-2">
            <?= isset($item_content[4]) ? $item_content[4]: '' ?>
        </div>
        <span class="space space-50"></span>
        <div class="rows row-3">
            <?= isset($item_content[5]) ? $item_content[5]: '' ?>
        </div>
         <span class="space space-30"></span>
    </div>
</div> 
<div class="contain container-6 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        <p class="tt-custom">Pour aller plus loin</p>
        <span class="space space-50"></span>
        <a href="<?=DIR?>explorateurs" class="btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925"><span>Parcourez le pays avec ceux qui y sont nés</span></a>
        <span class="space space-50"></span>
        <p data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-link btn-link-2 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925"><span>Bougez selon votre humeur du moment</span></p>
        <span class="space space-80"></span>
    </div>
</div> 

