<?php $this->registerCssFile('/assets/css/page2016/qui-sommes-nous.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?//php
//echo '<pre>';
//var_dump($theEntry->photos);exit;
?>
<div class="contain container-1">
    <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-qui-sommes-nous.jpg'>
    <?}?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"><?= $this->context->pageT ?></h1>
    </div>
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        
        <div class="rows row-1">
			
           <div class="two-col">
               <?= str_replace(['class="col col-','src="'], ['class="amc-col amc-col-','data-src="'], $theEntry['content']);?>

            </div>
        </div>
            
    </div>
            
</div>
<div class="contain container-5">
    
    <div class="amc-column">
        <div class="rows row-1">
            <p class="tt">Pour aller plus loin</p>
            <a class="link-btn link-btn-left btn-amica-basic btn-amica-basic-1" href="<?=DIR?>notre-equipe">Notre équipe</a>
            
        </div>
        
    </div>
</div>
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
    



<? $this->registerCss('.container-4 .row-3{background: none;}') ?>