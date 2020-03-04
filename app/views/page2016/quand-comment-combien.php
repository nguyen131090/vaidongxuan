<?php $this->registerCssFile('/assets/css/page2016/quand-comment-combien.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
     <? if(isset($theEntry->model->photos[0])) { ?>
    <img style="width: 100%;" alt="<?=$theEntry->model->photos[0]->description; ?>" class="img-lazy" data-src='<?=$theEntry->model->photos[0]->image; ?>'>
     <? }else{ ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_contact.jpg'>
    <?php }?>
   
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
   <div class="column row-2">
        
        <h1 class="title"><?= $this->context->pageT?></h1>
    </div>
    
</div>
<div class="contain container-flud menu-tab">
    <div class="column">
        <ul  class="nav nav-tabs">
            <?php
                $cnt = 0;
                foreach ($infos_pratiques as $v) {
                    $cnt++;

            ?>
                <li data="tab-panel-<?= $cnt?>">
                    <a class="nav-link <?= $cnt == 1 ? 'active' : '' ?>" href="#<?= $v->slug?>" data-toggle="tab" aria-expanded="true"><?= $v->model->title ?></a>
                </li>

            <?php } ?>
        </ul>
        
   </div>
</div>  
<div class="contain container-3 popup-infos">
    <div class="column">
        <div id="my-tab-content" class="tab-content">
            <?php
                $j = 0;
                foreach ($infos_pratiques as $v) {
                    $j++;

            ?>
             <div id="<?= $v->slug?>" class="tab-pane tab-panel-<?= $j ?> <?= $j == 1 ? 'active' : ''?>">
               <?php
                   if($v->slug == 'tarif' || $v->slug =='climat' || $v->slug =='visa'){
                        $body = preg_replace('/<h3>/', '<div class="jour tab-children active"><p class="tt-info first-jour"><span>', $v->model->description, 1);
                        $body = str_replace('<h3>', '</div></div><div class="jour tab-children no-switch"><p class="tt-info first-jour"><span>', $body);
                        $body = str_replace('</h3>', '</span></p><div class="entry-content">', $body);
                        echo $body . "</div></div>";
                    }else{

                        echo $v->model->description;
                   }         
                ?>
            </div>    
            <?php
                }
            ?>
        </div>
    </div>
</div>
<?
$js=<<<JS

	   
// Jquery config Content
        
    
     
        
        
    $(".tab-children > .tt-info").click(function() {
        
        $(this).parent().parent().find(".tab-children").not($(this).parent()).removeClass("active");
        $(this).parent().toggleClass("active");
        $('html, body').animate({
            
            scrollTop: $('.menu-tab').offset().top
            
        }, 0);
       
    })    
        
    
        
// End jquery config content        
 
$( document ).ready(function() {
  $('a[href$="pdf"]').addClass('download-link download-pdf');
  $('a[href$="pdf"]').css({'color' : '#e65925'});      
  $('a[href$="doc"]').addClass('download-link download-doc');
  $('a[href$="docx"]').addClass('download-link download-docx');
  $('a[href$="xls"]').addClass('download-link download-xls');
  $('a[href$="xlsx"]').addClass('download-link download-xlsx');
});


JS;
$this->registerJs($js,  yii\web\View::POS_END);

?>
