<?php $this->registerCssFile('/assets/css/page2016/nos-bureaux-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
                if($value->model->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-qui-sommes-nous.jpg'>
    <?}?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="m-0 tt tt-40 tt-color-white tt-latolatin-bold fix-align-center tt-custom tt-responsive"><?= $this->context->pageT ?></h1>
        
    </div>
</div>
<div class="contain container-2 mt-60">
    
    <div class="amc-column">
        
        <div class="amc-col col-left">
            <div class="entry-content">
<!--                <h2>AMICA TRAVEL A HANO�?, VIETNAM.</h2>-->
                <?= $theEntry->model->description?>
                
            </div>    
            <div class="responsive-map d-none d-sm-block d-lg-none mb-10 mt-txt-40">
                    <?php
                     $q = '27 Nguyen Truong To, Ba Dinh, Hanoi, Vietnam';
                     
                    if(SEG2 == 'hanoi'){
                        $q = '27 Nguyen Truong To, Ba Dinh, Hanoi, Vietnam';
                     
                    }else if(SEG2 == 'saigon'){
                        $q = '96, 94 Nguyen Du, Ben Nghe, Ho Chi Minh, Vietnam';
                    }else if(SEG2 == 'siem-reap'){
                        $q = 'Phum Kruos, Sangkat Svay Dangkum, Siem Reap, Province de Siem Reap, Cambodge';
                    }else if(SEG2 == 'luang-prabang'){
                        $q = 'Ban Pakham Luang Prabang Laos';
                    }
                       
                    
                    ?>
                <iframe id="get-map" class="img-lazy" width="" height="" frameborder="0" style="border:0; width: 100%;" data-src="https://www.google.com/maps/embed/v1/place?q=<?= $theEntry->data->googlemap ?>&key=AIzaSyC_ywNEeFiqs9YVlH9WhpSBa7GfyAk1LI8" allowfullscreen></iframe> 
           
            </div>
            
            
            <div class="info-office mb-txt-40">
                <div class="item item-1">
                    <img alt="" data-src="<?=DIR?>assets/img/page2016/add_nos_burea.png">
                    <p class="it-1 tt-latolatin-bold">Adresse</p>
                    <p class="it-2"><?= $theEntry->data->adresse?></p>
                </div>
                <div class="item item-2">
                    <img alt="" data-src="<?=DIR?>assets/img/page2016/tel_nos_burea.png">
                    <p class="it-1 tt-latolatin-bold">Tél</p>
                    <p class="it-2"><?= $theEntry->data->tel?></p>
                </div>
                <div class="item item-3">
                    <img alt="" data-src="<?=DIR?>assets/img/page2016/cal_nos_burea.png">
                    <p class="it-1 tt-latolatin-bold">Horaires d’ouverture </p>
                    <p class="it-2"><?= str_replace('|', '<br>', $theEntry->data->time)?></p>
                </div>
            </div>
            
            <!-- GALLERY IMAGE -->
            <? $galeriesBf =  $theEntry->photos;
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
                <?php
                     if($galeries){
                 ?>
                    
                    <div class="collection-image">
                        
                        <div class="col-left mr-25">
                         
                            <a data-thumb="0" href="#galeries-photos" class="fancybox-thumbs m-0">
                                <img alt="<?= $galeries[0]->description?>" class="img-lazy img-responsive" data-src="<?=DIR?>timthumb.php?src=<?= $galeries[0]->image?>&w=313&h=483&zc=1">
                                <span class="caption"><?= $galeries[0]->model->caption?></span>
                            </a>
                    </div>
                                
                    <div class="col-right">
                                <a data-thumb="1" href="#galeries-photos" class="fancybox-thumbs m-0 mb-25">
                                    <img alt="<?= $galeries[1]->description?>" class="img-lazy img-responsive" data-src="<?=DIR?>timthumb.php?src=<?= $galeries[1]->image?>&w=331&h=229&zc=1">
                                    <span class="caption"><?= $galeries[1]->model->caption?></span>
                                </a>
                                 <a data-thumb="2" href="#galeries-photos" class="fancybox-thumbs m-0">
                                    <img alt="<?= $galeries[2]->description?>" class="img-lazy img-responsive" data-src="<?=DIR?>timthumb.php?src=<?= $galeries[2]->image?>&w=331&h=229&zc=1">
                                    <span class="caption"><?= $galeries[2]->model->caption?></span>
                                </a>
                    </div>
                    
                        <a class="float-right fancybox-thumbs btn-amica-basic btn-amica-basic-1 mt-25 mb-40" data-thumb="3" data-fancybox="#galeries-photos" href="#galeries-photos" >Plus de photos</a>
                    <div id="galeries-photos" style="display: none;" class="colllection-image">
                        <? include('_inc_galeries.php') ?>
                    </div>   
                        
                    </div> 
                    <?php } ?>  
            <!-- End Gallery image -->
            
            
            <div class="other-office mt-20">
                <h2 class="tt tt-24 tt-latolatin-bold tt-custom tt-responsive m-0 mb-txt-40">Découvrir nos bureaux à :</h2>
                
                 <? 
                    $cnt = 0;
                    foreach ($otherOffice as $value) { $cnt ++;
                    
                    if($cnt % 3 == 1){
                        if(count($otherOffice) - 3 >= $cnt){
                            $clas = 'mb-txt-40';
                        }else{
                            $clas = Null;
                        }
                        echo '<div class="clear-fix d-table w-100 '. $clas .'">';
                    }
                    ?>
                    <div class="item item-<?=$cnt?>">
                        <a href="<?= DIR.$value->slug?>">    
                        <?
                            //var_dump($value->title);exit;
                                $hasSummary = false;
                                if (!empty($value->photos)) {
                                    foreach ($value->photos as $kp => $vp) {
                                        if ($vp->model->type == 'summary') {
                                            echo '<img height="" alt="' . $vp->description . '" class="img-responsive" data-src="/thumb/210/142/1/80'.$vp->image.'"/>';
                                            $hasSummary = true;
                                            break;
                                        }
                                    }
                                }
                            ?>
<!--                            <img style="" class="img-lazy" data-src='/timthumb.php?src=<?//=DIR?>upload/image/banner-qui-sommes-nous.jpg&w=210&h=142&zc=1'>-->
                            
                        <h3 class="tt tt-18 tt-latolatin-regular tt-custom tt-responsive mt-25"><?= $value->model->sub_title?></h3>
                        
                        </a>
                    </div>
                    <?
                    if($cnt % 3 == 0 || count($otherOffice) == $cnt){
                        echo '</div>';
                    }
                    }
                    ?>
            </div>
        </div>
        <div class="amc-col col-right d-none d-sm-none d-lg-block">
            <div class="area area-2 mb-25">
                    <?php
                     $q = '27 Nguyen Truong To, Ba Dinh, Hanoi, Vietnam';
                     
                    if(SEG2 == 'hanoi'){
                        $q = '27 Nguyen Truong To, Ba Dinh, Hanoi, Vietnam';
                     
                    }else if(SEG2 == 'saigon'){
                        $q = '96, 94 Nguyen Du, Ben Nghe, Ho Chi Minh, Vietnam';
                    }else if(SEG2 == 'siem-reap'){
                        $q = 'Phum Kruos, Sangkat Svay Dangkum, Siem Reap, Province de Siem Reap, Cambodge';
                    }else if(SEG2 == 'luang-prabang'){
                        $q = 'Ban Pakham Luang Prabang Laos';
                    }
                       
                    
                    ?>
                <iframe id="get-map" class="img-lazy" width="" height="" frameborder="0" style="border:0" data-src="https://www.google.com/maps/embed/v1/place?q=<?= $theEntry->data->googlemap ?>&key=AIzaSyC_ywNEeFiqs9YVlH9WhpSBa7GfyAk1LI8" allowfullscreen></iframe> 
           
            </div>
<!--            <img data-src="<?//=DIR?>assets/img/page2016/img-map-nos-burea.jpg">-->
            
            <div class="area area-1 fix-area">
                <p class="tt">Besoin de conseil<br>d’un expert ?</p>
                <ul>
                    <li><img alt="" class="img-lazy" data-src="<?= DIR ?>assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%;"></li>
                    <li>Notre conseiller(ère) vous répondra sous 48H</li>
                </ul>
                <span data-title="<?= base64_encode(DIR.'nous-contacter') ?>" class="pugjd btn-contact btn-amica-basic btn-amica-basic-2">Contactez-nous</span>
            </div>
        </div>
    </div>
</div>        
<div class="contain mb-0 pt-25 pb-25 mt-60 responsive-area-devis-col-left d-none d-lg-none d-sm-block">
     <div class="amc-column column">
         <div class="item item-1">
             <span class="tt tt-1">Besoin de conseil d’un expert ?</span>
             <span class="tt tt-2">Notre conseiller(ère) vous répondra sous 48H</span>
         </div>
         <div class="item item-2">
             <img alt="" class="img-lazy lazyload" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
         </div>
         <div class="item item-3">
             <span data-title="<?= base64_encode(DIR.'nous-contacter') ?>" class="pugjd btn-fix-hover btn-amica-basic btn-amica-basic-2">Contactez-nous</span>
         </div>
     </div>
 </div>
 <div class="contain container-2">
    
    <div class="amc-column">  
        <div class="amc-col col-left">
            <div class="contact-team img-lazy mt-txt-60 lazy-background" data-src="<?=DIR?>assets/img/page2016/img_team_nos_burea.png">
                <div class="info-text">
                    <p class="text-sumary">
                        Vietnamiens, Laotiens, Cambodgiens, Français ou Belges, nous sommes tous unis par l’usage de la langue française et par la même passion des voyages.
                    </p>
                    <a class="btn-button tt-latolatin-bold tt-color-white tt-custom radius-5 mt-10 mb-5" href="<?=DIR?>notre-equipe">Découvrez-nous !</a>
                </div>
            </div>
            
            
             <!-- BACK BUTTON -->
            <? include '_inc_back_button.php'; ?>
            <!-- End BACK BUTTON -->
            
        </div>
    </div>    
    
</div>
<?php
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');


$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$js=<<<JS
        
// Js load iframe 

function init() {
    var vidDefer = document.getElementsByTagName('iframe');
    //var vidDefer = document.getElementsByClassName('videoytb');
    for (var i=0; i < vidDefer.length; i++) {
    if(vidDefer[i].getAttribute('data-src')) {
    vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
    } } 
}
window.onload = init;

// End Js load iframe         
        
jQuery(document).ready(function () {
     $('a.fancybox').fancybox({
           titlePosition: 'over', 
            centerOnScroll: true,
            padding: 2,
     });
     
     $('.fancybox-thumbs').click(function(){
        var slider = jQuery("#wowslider-container1").get(0);
        slider.wsStart($(this).data('thumb'), false, 0);
        $('.fancybox-thumbs').fancybox({
        centerOnScroll: true,
        padding: 1,
        width: 1024,
        height: 680, 
        scrolling: 'no',
        titleShow: false
     });

     });
     var target = $('.container-2 .program .tab-children:first-of-type > h3');
     target.parent().parent().find(".tab-children").not($(this).parent()).removeClass("active");
        target.parent().toggleClass("active");
        
          target.parent().children('.entry-content').css('min-height',  target.parent().children('.entry-content').children('ul').outerHeight());
});     
            
JS;
$this->registerJs($js,  yii\web\View::POS_END);
?>
