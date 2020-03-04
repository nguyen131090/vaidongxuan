<?php $this->registerCssFile('/assets/css/page2016/notre-equipe.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


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
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"><?= $this->context->pageT ?></h1>
    </div>
</div>


<div class="contain container-4 mt-60">
    
    <div class="amc-column">
		 <?php
			//echo '<pre>';
			//var_dump($theEntry);exit;
			$item_content = explode('<hr />',str_replace(['col col-','src="'],['amc-col amc-col-','data-src="'],$theEntry->content));
			
			//var_dump($item_content);exit;
			//echo $theEntry->content;
		   ?>
        <div class="rows row-1 mb-txt-40">
			<?= isset($item_content[0]) ? $item_content[0]: '' ?>
        </div>
        
		<div class="hr">
			<hr>
		</div>
		
		 <div class="rows row-2">
			<?= isset($item_content[1]) ? $item_content[1]: '' ?>
        </div>
		
		<div class="hr">
			<hr>
		</div>
		
		 <div class="rows row-3 mt-5">
			<?= isset($item_content[2]) ? $item_content[2]: '' ?>
        </div>
		
		<div class="hr">
			<hr>
		</div>
		
		<div class="rows row-4 mt-0">
			<?= isset($item_content[3]) ? $item_content[3]: '' ?>
                    <div class="gp-its d-flex justify-content-center">
                        <? if(isset($item_content[4])){ ?>
                            <div class="item-col item-col-1">
                            <?= isset($item_content[4]) ? $item_content[4]: '' ?>
                            </div>
                        <? } ?>
                        <? if(isset($item_content[5])){ ?>
                            <div class="item-col item-col-2">
                            <?= isset($item_content[5]) ? $item_content[5]: '' ?>
                            </div>
                        <? } ?>
                    </div>    
        </div>
		


    </div>
    
</div>


<div class="contain container-5 responsive-area-btn-link">
    
    <div class="amc-column">
        <div class="rows row-1">
            <p class="tt">Pour aller plus loin</p>
            <div class="area-btn-link mt-40">
                <a class="link-btn link-btn-left btn-amica-basic btn-amica-basic-1" href="<?=DIR?>explorateurs">Parcourez le pays avec ceux qui y sont nés</a>
                <span class="pugjd link-btn link-btn-right btn-amica-basic btn-amica-basic-1" data-title="<?= base64_encode(DIR.'devis') ?>">Bougez selon votre humeur du moment</span>
            </div>
        </div>
        
    </div>
</div>
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
<? $this->registerCss('
.container-4{margin-top: 65px; } .container-4 .row-3{background: none;} .container-5 .tt{display: block; margin-left: 0;}
.container-4 .row-2{
    margin-left: 10px;
    padding-top: 40px;
    width: 100%;
    background: none;
}
.container-4 .row-2 table{
    display: inline-block;
    margin-right: 15px;
    vertical-align: top;
}

');

$js=<<<JS
$(window).bind("load", function() { 


  $('.container-4 .row-4 .item-col').each(function(index) {
        var max = 0;
        var height = $(this).outerHeight();
        if(max < height){
            max = height;
        }
        
       $('.container-4 .row-4 .item-col').css("min-height", max);
		$('.container-4 .row-4 .item-col').css("min-height", max);
             
  });
});     
	 


JS;
$this->registerJs($js,  yii\web\View::POS_END);

 ?>