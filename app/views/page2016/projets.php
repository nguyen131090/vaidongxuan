<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
 

?>

<?php $this->registerCssFile('/assets/css/page2016/actualites.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
    
    <img alt="" style="width: 100%;" data-src='<?=DIR?>upload/image/banner_actualites.jpg'>
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

<div class="contain container-4">
    
    <div class="amc-column amc-column-fixpadding">
        
        <div class="rows row-1 mt-60">
            <div class="amc-col amc-col-1 ajaxfilter">
                <div class="getcontent"> 
               <? 
               $cnt = 0;
               foreach ($theEntries as $key => $value) :
                $cnt++;   
                   ?>
                <?php 
                        if($cnt % 2 != 0){
                            echo '<div class="clear-fix">';
                        }
                    ?>
                <div class="item item-<?=$key+1?> <?= $cnt % 2 != 0 ? 'it-l mr-0' : 'it-r mr-0 ml-20' ?>">
                    <a href="<?=DIR.$value->slug?>">
                                        <? 
                                        $hasSummary = false;
                                        if(isset($value->photos)) {
                                            foreach ($value->photos as $kp => $vp) {
                                                if($vp->type == 'summary'){
                                                    echo '<img style="width: 329px; height: 219px;" alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'"/>';
                                                    $hasSummary = true;
                                                    break;
                                                }
                                            } 
                                        } ?>
                                        <? if(!$hasSummary) : ?>
                                            <img style="width: 329px; height: 219px;" alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                        <? endif; ?>
                                        
                    <h2 class="tt"><?=$value->title?></h2>
                    </a>
                    <div class="summary">
                        <?=$value->summary ?>
                    </div>
                </div>
                    <?php
                            if($cnt % 2 == 0){
                                echo '</div>';
                                if(count($theEntries) > $cnt){
                                    echo '<span class="space space-40"></span>';
                                }
                            }
                            if($cnt % 2 != 0 && $cnt == count($theEntries) ){
                                echo '</div>';
                                if(count($theEntries)  - 1 > $cnt){
                                    echo '<span class="space space-40"></span>';
                                }
                            }
                        ?>

                <? endforeach; ?>
                 <? if(count($theEntry->children()) > $pagesize){?>    
                <div class="see-more">
                    <span class="btn-submit ajax-see-more" data-get="<?= 'see-more='.(12 + $pagesize) ?>" data-value=''>Afficher la suite <span>arrow down</span></span>
                </div>
                <? } ?>
               </div>     
            </div>
            <div class="amc-col amc-col-2 d-none d-sm-none d-lg-block" style="text-align: center;">
				<?php
					 if(!empty($theEntry->model->photos)){
						$link_2 = 'http://360degresvietnam.com/';
						foreach ($theEntry->model->photos as $key => $value) {
							if($value->type == 'summary'){
								echo '<a style=" display: inline-block; margin: 0 0 20px 0;" class="btn-link btn-link-'.($key+1).'" href="'.$value->caption.'"><img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'"></a>';
								
							}
						}
					}
				?>
               
            </div>
        </div>
        
        
        
    </div>
</div>

<div class="contain container-5">

    
    <div class="amc-column">
        
        <div class="rows row-1">
            <p class="tt">Notre équipe à votre écoute</p><span class="btn-amica-basic btn-amica-basic-1 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Faites-nous savoir vos attentes</span>
        </div>
            
    </div>
        
</div>

<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->

<?php

$js = <<<JS
	  

		
function fixHeightColumns(){
    $('.clear-fix').each(function(index) {
                var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
                var subttleft = $(this).children('.it-l').children('a').children('.sub-tt').outerHeight();
                
                var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
                var subttright = $(this).children('.it-r').children('a').children('.sub-tt').outerHeight();
                if (htleft > htright){
                    $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
                }  
                if (htright > htleft){
                    $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
                }
                
				 if (subttleft > subttright){
                    $(this).children('.it-r').children('a').children('.sub-tt').css('min-height', subttleft);
                }  
                if (subttright > subttleft){
                    $(this).children('.it-l').children('a').children('.sub-tt').css('min-height', subttright);
                }
				
        
                // fix height summary
                
                var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
                var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
               
                if (summaryleft > summaryright){
                    $(this).children('.it-r').children('.summary').css('min-height', summaryleft);
                }  
                 if (summaryright > summaryleft){
                    $(this).children('.it-l').children('.summary').css('min-height', summaryright);
                }       
          });
}	  

		
$(window).bind("load", function() { 
           fixHeightColumns();
});

JS;
$this->registerJs($js, \yii\web\View::POS_END);
$this->registerCss('.container-4 .item .tt{margin-top: 20px;} .back-button .line:last-of-type{border: none;}');
?>

