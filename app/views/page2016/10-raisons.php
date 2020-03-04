<?php $this->registerCssFile('/assets/css/page2016/10-raisons.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain container-1">
     <?php
        if(!empty($theEntry->model->photos)){
            foreach ($theEntry->model->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" data-src='<?=DIR?>upload/image/banner-exclusi.jpg'>
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

<div class="contain container-2 mt-60">
    
    <div class="amc-column">
        <div class="rows row-1">
            <div class="amc-col amc-col-1">
               
                
                 <?php
                    
                     if(!empty($theEntries[0]->photos)){

                         foreach ($theEntries[0]->photos as $v) {

                             if($v->model->type == 'galery'){

                  ?>
                 <img style="" class="img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
                     <?php
                             }
                         }

                      }
                    ?>
              
                
            </div>
            <div class="amc-col amc-col-2">
                <h2 id="1" class="tt"><?= $theEntries[0]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[0]->description)?>

                
            </div>    
        </div>
        <div class="rows row-2">
            <div class="amc-col amc-col-1 mb-0">
                 <h2 id="2" class="tt"><?= $theEntries[1]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[1]->description)?>
            </div>
            <div class="amc-col amc-col-2 mb-0">
                 <h2 id="3" class="tt"><?= $theEntries[2]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[2]->description)?>

                
            </div>    
        </div>    
    </div>
</div>

<div class="contain container-3 lazy-background mt-txt-60">
    
    <div class="amc-column">
        <div class="rows row-1">
            <div class="amc-col amc-col-1">
                 <h2 id="4" class="tt"><?= $theEntries[3]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[3]->description)?>
            </div>
        </div>
        
    </div>
            
</div>
<div class="contain container-4 mt-60">
    
    <div class="amc-column">
        <div class="rows row-1">
            <div class="amc-col amc-col-1 mt-0 mb-txt-60">
                 <h2 id="5" class="tt"><?= $theEntries[4]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[4]->description)?>
            </div>
             <div class="amc-col amc-col-2 mt-0 mb-txt-60">
                 <h2 id="6" class="tt"><?= $theEntries[5]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[5]->description)?>
            </div>
             <div class="amc-col amc-col-3 mt-0 mb-txt-60">
                 <h2 id="7" class="tt"><?= $theEntries[6]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[6]->description)?>
            </div>
        </div>
         <div class="rows row-2">
            <div class="amc-col amc-col-1 mt-0 mb-0">
                <?= explode('<hr />', str_replace('src="', 'data-src="',$theEntries[7]->description))[1]?>
<!--              <video id="video" controls="" muted="" width="572" height="350">
                <source data-src="http://www.quirksmode.org/html5/videos/big_buck_bunny.mp4" type="video/mp4"></source>
                
                Your browser does not support the video tag.
            </video>-->
            </div>
             <div class="amc-col amc-col-2 mt-0 mb-0">
                 <h2 id="8" class="tt"><?= $theEntries[7]->title?></h2>
                <?= explode('<hr />', str_replace('src="', 'data-src="',$theEntries[7]->description))[0] ?>
            </div>
             
             
        </div>
        
    </div>
            
</div>
<?php
	if($listModules_Exclu != NULL){
?>
<div class="contain container-5 lazy-background">
    
    <div class="amc-column">
        <div class="rows row-1">
            <span style="display: block;" class="tt"><?//= $theItem->model->title?>Découvrez les étapes de nuits "CHEZ L'HABITANT"<br><?//= $theItem->model->sub_title?>facilement insérables dans votre circuit : </span>

             <div class="slider">
                 <?php
                    $count = count($listModules_Exclu) + 1;
                    foreach ($listModules_Exclu as $v) {
                        $count--;
                    
                 ?>
                    <div class="slide">
                        <a href="<?=DIR.$v->slug?>">
                            <?php
                                $j = 0;
                                foreach ($listModules as $m) {
                                    foreach ($m->photos as $img) {
                                        $j++;
                                   
                                    if($j == $count){
                                        
                                    $title = explode('-', $img->caption);
                            ?>
                            <img alt="<?= $img->description?>" class="" data-src="<?=DIR?>timthumb.php?src=<?= $img->image?>&w=140&h=140&zc=1">
                                <h3 class="title"><?= $title[0]?></h3>
                                <span class="destination"><?= $title[1]?></span>
                            <?php }}} ?>
                            
                           
                       </a>


                   </div>
                <?php } ?>

           </div>
             <a class="link-btn" href="<?= DIR.'formules/au-plus-pres-des-peuples'?>">VIVEZ l’INDOCHINE DE L’INTÉRIEUR</a>
        </div>
        
    </div>
            
</div>
<?php
	}
?>
<div class="contain container-6">
    
    <div class="amc-column">
       <div class="rows row-1">
            <div class="amc-col amc-col-1 mb-0">
                 <h2 id="9" class="tt"><?= $theEntries[8]->title?></h2>
                <?= str_replace('src="', 'data-src="',$theEntries[8]->description)?>
            </div>
            <div class="amc-col amc-col-2 mb-0">
                 <h2 id="10" class="tt"><?= $theEntries[9]->title?></h2>
                 <?
                 //var_dump($theEntries[9]->description);exit;
                 ?>
                <?= str_replace(['<p>&nbsp;</p>','src="'], [' ','data-src="'], $theEntries[9]->description ) ?>

                
            </div>    
        </div>
        
    </div>
            
</div>

 
<div class="contain container-7 mt-60">

    
    <div class="amc-column">
        <p><span class="tt">Besoin d’inspiration ?</span>
            <span class="btn-amica-basic btn-amica-basic-1 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Faites-nous savoir vos attentes</span></p>
    </div>
</div>   
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
<?php
//$this->registerJsFile('/assets/js/custom_video.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerCssFile('/assets/js/bxslider/jquery.bxslider.css');
//$this->registerJsFile('/assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$p = NULL;
if(isset($_GET['p'])){
    $p = $_GET['p'];
}
$this->registerCss("
	.tweet_iframe_widget{
		width: 71px !important;
	}
");
$js=<<<JS
   
        $('.slider').bxSlider({
            slideWidth: 140,
            minSlides: 1,
            maxSlides: 6,
            slideMargin: 20,
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
            randomStart: false,
            // captions: true,
            auto: false,
           // mode: 'fade',
            speed: 1000,
           onSlideBefore: function(slideElement, oldIndex, newIndex){
            var lazy = slideElement.find('.lazy');
            var load = lazy.attr('data-src');
            lazy.attr('src', load).removeClass('lazy');
        }
        
        });
  var target = $("#" + $p);
$('html, body').animate({
	scrollTop: target.offset().top - 250
}, 0);
                    
JS;
$this->registerJs($js,  yii\web\View::POS_END);
?>
