<?php $this->registerCssFile('/assets/css/page2016/improvisez.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?//php
  //  echo '<pre>';
  //  var_dump($theEntry->content);exit;
?>

<div class="contain container-1">
    <?php
        if(!empty($theEntry->model->photos)){
            foreach ($theEntry->model->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" class="img-lazy" alt="'.$value->description.'" data-src="'.$value->image.'">';
                }
            }
        }else{
    ?>
    <img alt="" style="width: 100%;" data-src='<?=DIR?>upload/image/banner-improvisez.jpg'>
        <?php }?>
    
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
        
        <div class="rows row-1 content p-0 mt-60">
            
           <?= str_replace(['col col-','col-11','col-22','src="'], ['amc-col amc-col-','amc-col-11','amc-col-22','data-src="'], $theEntry->model->content)?>
        </div>
        </div>   
    </div>
</div>


<div class="contain container-3">

    
    <div class="amc-column">
        
        <div class="rows row-1">
            <p class="tt">Notre équipe à votre écoute</p><span class="btn-amica-basic btn-amica-basic-1 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Faites-nous savoir vos attentes</span>
        </div>
            
    </div>
        
</div>
    
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
