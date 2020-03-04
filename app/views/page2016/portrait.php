<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<?//php $this->registerCssFile('/assets/css/rules/spacing.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/portrait.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_temoi.jpg'>
    <?}?>
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
     
    <div class="amc-column row-2">
        
        <h1 class="title mb-txt-40">
           <?= $this->context->pageT ?>
        </h1>
        
    </div>
</div>
<div class="contain container-4">
    
    <div class="amc-column">
        
        <div class="rows row-1 mt-60">
            <div class="amc-col amc-col-1">
                <div class="ajaxfilter">
                    <div class="getcontent">
                    <?php $cnt = 0;  $count = count($portraits); foreach ($portraits as $v) { $cnt ++;?>

                        <?php 
                        if($cnt % 2 != 0){
                            if(count($portraits) > $cnt){
                                   $clas = 'mb-txt-40';
                                    
                            }if(count($portraits) - 1 > $cnt || count($portraits) - 2 > $cnt){
                                    $clas = 'mb-txt-40';
                            }else{
                                $clas = Null;
                            }
                            echo '<div class="clear-fix '.$clas.'">';
                        }
                        ?>
                        <div class="item item-<?= $cnt?> <?= $cnt % 2 != 0 ? 'it-l' : 'it-r' ?>">
                             <a href="<?=DIR.$v->slug?>">
                                 <? if(isset($v->photosArray['summary'])){
                                    $value = $v->photosArray['summary'][0];
                                    ?>
                                    <img style="" class="img-lazy img-responsive mb-25" alt="<?= $value->description?>" <?= Yii::$app->request->isAjax ? 'src="'.DIR.'timthumb.php?src='.$value->image.'&w=329&h=219"' : 'data-src="'.DIR.'timthumb.php?src='.$value->image.'&w=329&h=219"' ?>>
                                            
                                    <?
                                    }else{
                                    ?>
                                    <img style="" class="img-lazy img-responsive mb-25" alt="<?= $value->description?>" <?= Yii::$app->request->isAjax ? 'src="'.DIR.'timthumb.php?src='.DIR.'assets/img/page2016/img-new-portrait-329-219.jpg&w=329&h=219"' : 'data-src="'.DIR.'timthumb.php?src='.DIR.'assets/img/page2016/img-new-portrait-329-219.jpg&w=329&h=219"' ?>>
                                    
                                    
                                    <?    
                                    }
                                ?>
                            <? 
//                            if(!empty($v->photosMobile)){
//                                        foreach ($v->photosMobile as $value) {
//                                            if($value->model->type == 'summary'){
//                                                echo '<img style="" style="" alt="'.$value->description.'" class="img-lazy mb-25" data-src="'.DIR.'timthumb.php?src='.$value->image.'&w=329&h=219">';
//                                            }
//                                        }
//                                    }else{
//
//                                        echo '<img style="" style="" alt="'.$value->description.'" class="img-lazy mb-25" data-src="'.DIR.'timthumb.php?src='.DIR.'assets/img/page2016/img-new-portrait-329-219.jpg&w=329&h=219">';

                          //          }
                                ?>



                                <h2 class="tt mb-txt-25"><?= $v->title?></h2>
                            </a>    
                            <div class="summary">
                                <?= $v->model->summary?>
                            </div>


                        </div>
                        <?php
                            if($cnt % 2 == 0){
                                echo '</div>';
//                                if(count($portraits) > $cnt){
//                                    echo '<span class="space mb-txt-40"></span>';
//                                    
//                                }
                            }
                            if($cnt % 2 != 0 && $cnt == $count){
                                echo '</div>';
//                                if(count($portraits) - 1 > $cnt || count($portraits) - 2 > $cnt){
//                                    echo '<span class="space mb-txt-40"></span>';
//                                }
                            }
                        ?>
                    <?php }?>
                    </div> 
                    
                    <?
                         if (Yii::$app->request->get('page') == NULL) {
                            $page = $pagesize / 12;
                        } else {
                            $page = Yii::$app->request->get('page');
                        }
                        
                    ?>
                    
                    
                    <? if($totalCountPort > $pagesize && ($totalCountPort / 12) > $page ){?>    
                    <div class="see-more mt-txt-40">
                         <a class="btn-submit btn-amica-basic-1 btn-amica-basic ajax-see-more" data-get="" data-seemore="<?= ($page + 1)*12 ?>" data-value='' href="<?=DIR.URI?>?page=<?= $page + 1?>" data-page="<?= $page + 1 ?>">Plus de portrait</a>
                     </div>
                     <? } ?>
                </div>    
                <!-- BACK BUTTON -->
                <? include '_inc_back_button.php'; ?>
                <!-- End BACK BUTTON -->
                
            </div>
            <div class="amc-col amc-col-2 ml-25 d-none d-sm-none d-lg-block" style="text-align: center;">
                <a target="_blank" href="https://www.facebook.com/amicatravel">
                    <img class="mb-25" alt="" data-src="<?=DIR?>assets/img/page2016/img-fb-221-127.jpg">
                </a>
                <?
                    include '_inc_btn_devis_col_right.php';
                ?>

            </div>
        </div>
        
    </div>
</div>




<?php

$js = <<<JS
	  

		
$(window).bind("load", function() { 
        
           
          $('.clear-fix').each(function(index) {
                var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
                
                var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
                if (htleft > htright){
                    $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
                }  
                 if (htright > htleft){
                    $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
                }   
          });
       

});

JS;
$this->registerJs($js, \yii\web\View::POS_END);

?>


