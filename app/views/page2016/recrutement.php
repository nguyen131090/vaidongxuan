<?php $this->registerCssFile('/assets/css/page2016/recrutement.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

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
     <img alt="" style="width: 100%;" data-src='<?=DIR?>upload/image/banner_recrutement.jpg'>
    <?}?>
   
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"><?= $this->context->pageT;?></h1>
    </div>
</div>
<div class="contain container-2 fix-space-vs-back-button">
    <div class="amc-column entry-body">
        <?= $theEntry->content?>
        <? include '_inc_back_button.php'; ?>
        <!-- End BACK BUTTON -->   
    </div>
    
</div>

