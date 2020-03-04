<?php $this->registerCssFile('/assets/css/page2016/idees-de-voyage-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php
$iconBanner = $iconCaption = $limitWidth = 'limitWidth-51';
?>


<div class="contain container-1">
     <?php
      
        if(!empty($theEntry->model->photos)){
            
            foreach ($theEntry->model->photos as $v) {
                if($v->type == 'icon-banner'){
                    $iconBanner = $v->image;
                    $iconCaption = $v->caption;
                }
                if($v->type == 'banner'){
            
     ?>
    <img style="width: 100%" class="img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
        <?php
                }
            }
        
         }else{
       ?>
    <img alt="" class="img-lazy" style="width: 100%;" data-src='<?=DIR?>upload/image/banner-idees-de-voyage-single.jpg'>
         <?php } ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title"><?= $this->context->pageT?></h1>
    </div>
</div>
<div class="contain container-2">
    
    <div class="amc-column mt-txt-60 mb-txt-60">
        <?= $theEntry->model->content?>

    </div>
</div>
<div class="contain container-3 lazy-background">
    
    <div class="amc-column pt-txt-25 pb-txt-25">
        
        <p class="tt-1">Toutes les idées de voyage</p>
        <p class="tt-2"><?= $theEntry->title?></p>
    </div>
</div>
<div class="contain container-4 container-filter fix-space-vs-back-button">
    
    <div class="amc-column amc-column-fixpadding">
        <div class="rows row-1 mt-60">
            
            <!-- Start Col 2 Filter -->
            <div class="amc-col amc-col-2 mr-10">
                
                <?php include '_inc_filter.php';?>
				
				   
                <div class="area-1 fix-area mt-25 mb-0">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;"></li>
                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                    </ul>
                    <a href="/devis" class="btn-contact btn-amica-basic btn-amica-basic-2">Demander un devis</a>
                </div>

            </div>
			<!-- End Col Filter -->

            <div id='page-list' class="amc-col amc-col-1 ml-5 ajaxfilter">
                <div id='load-more' class="getcontent">
                    <?php
                    $cnt = 0;
                    $count = count($theEntries);
                    foreach ($theEntries as $v) {
                        $cnt ++;


                        ?>
                        <?php
                        if($cnt % 2 != 0){
                            if(count($theEntries) > $cnt){
                                   $clas = 'mb-txt-40';
                                    
                            }if(count($theEntries) - 1 > $cnt || count($theEntries) - 2 > $cnt){
                                    $clas = 'mb-txt-40';
                            }else{
                                $clas = Null;
                            }
                            echo '<div class="clear-fix '.$clas.'">';
                        }
                        ?>
                        <div id="<?=$cnt?>" class="item item-<?= $cnt ?> <?= $cnt % 2 != 0 ? 'it-l ml-0' : 'it-r mr-0' ?>">
                            <a href="<?= DIR.$v->slug?>">
                                <?php

                                if(!empty($v->photos)){

                                    foreach ($v->photos as $value) {

                                        if($value->model->type == 'summary'){

                                            ?>
                                            <img style="width: 100%" class="banner img-lazy" alt="<?= $value->model->description?>" <?= Yii::$app->request->isAjax ? 'src="'.$value->image.'"' : 'data-src="'.$value->image.'"' ?>>
                                            <?php
                                        }
                                    }

                                }else{
                                    ?>
                                    <img class="img-lazy img-responsive" alt="" data-src="<?=DIR?>upload/image/img_exclusi_type.jpg">
                                <?php } ?>
                                <h2 class="tt"><?= $v->title ?></h2>
                                <p class="sub-tt"><?=$v->model->sub_title?></p>
                            </a>
                            <div class="summary">
                                <p><?= $v->model->summary?></p>
                            </div>
                            <ul>
                                <?php if(isset($v->model->data->countries)){?>
                                    <li class="posi">
                                        <p class="posi-title">
                                            <img data-src="/assets/img/page2016/posi.png" alt="">
                                            <?php
                                            $i= 0;
                                            if(is_array($v->model->data->countries)){
                                                foreach ($v->model->data->countries as $value) {
                                                    $i ++;
                                                    echo ucfirst($value);
                                                    if($i < count($v->model->data->countries)){
                                                        echo ', ';
                                                    }
                                                }
                                            }else{
                                                echo $v->model->data->countries;
                                            }
                                            ?>
                                        </p>
                                    </li>
                                <?php }?>


                                <?php if($v->model->days != ''){ $limitWidth = 'limitWidth-41'; ?>
                                    <li class="calendar">
                                        <p class="calendar-title">
                                            <img data-src="/assets/img/page2016/icon_time.png" alt="">
                                            <?= $v->model->days?> jours, <br /><?= $v->model->nights?> nuits
                                        </p>
                                    </li>
                                <?php } ?>

                                <li class="type-de-voyage <?php echo $limitWidth; ?>">
                                    <p class="type-de-voyage-title">
                                        <img data-src="<?php echo $iconBanner; ?>" alt="">
                                        <span style="float: right; padding-left: 7px;"><?= $iconCaption; ?></span>
                                    </p>
                                </li>

                            </ul>
                        </div>
                        <?php
                        if($cnt % 2 == 0){
                            echo '</div>';
                          //  if($count > $cnt){
                          //      echo '<span class="space space-30"></span>';
                           // }
                        }
                        if($cnt % 2 != 0 && $cnt == $count){
                            echo '</div>';
                          //  if($count - 1 > $cnt){
                          //      echo '<span class="space space-30"></span>';
                          //  }
                        }
                        ?>
                    <?php } ?>

                    <?
                    if(Yii::$app->request->get('country') == NULL){
                        $country = 'all';
                    }else{
                        $country = Yii::$app->request->get('country');
                    }
                    if(Yii::$app->request->get('type') == NULL){
                        $type = $theEntry->model->category_id;
                        // $type = '9';
                    }else{
                        $type = Yii::$app->request->get('type');
                    }
                    if(Yii::$app->request->get('length') == NULL){
                        $length = 'all';
                    }else{
                        $length = Yii::$app->request->get('length');
                    }
                    if(Yii::$app->request->get('see-more') == NULL){
                        $seemore = 12;
                    }else{
                        $seemore = Yii::$app->request->get('see-more');
                    }


                    if($this->context->countTour > $seemore){?>
                        <div class="see-more">
                            <span class="btn-submit ajax-see-more btn-amica-basic-1 btn-amica-basic" data-get="<?= 'country='.$country.'&type='.$type.'&length='.$length.'&see-more='.(12 + $seemore) ?>" data-value='<?= count($theEntries) ?>'>Plus de circuits </span>
                        </div>
                    <? } ?>


                </div>

            </div>

            <? if($this->context->seoContent != NULL) : ?>
            <div id="text-content" class="iti p-0">
                    <span class="tt tt-seo <?= SEG2 ?> p-0">En savoir plus sur "<?= $theEntry->title?>"</span>
                    <div><?=$this->context->seoContent;?></div>
            </div>
            <? endif; ?>

        </div>
        
        <div class="rows row-2 pt-60 pb-txt-60">
            <h3 class="title-tt mt-0 mb-txt-40"><a href="<?=DIR?>10-raisons-de-partir-avec-amica-travel"><?= $theRaisons->title?></a></h3>
            <?php
              
                
                $cnt = 0;
                $j = 0;
                foreach ($theRaisons_list as $v) {
                 
                    $cnt ++; 
                    $j ++;
                    if($cnt == 1){
                        echo '<div class="rr r1 p-0 mb-40">';
                    }
                    $id = explode('.', $v->title);
            ?>
                <div class="item item-<?= $j?>">
                    
                    <?php
                                
                        if(!empty($v->photos)){
                            $j = 0;
                            foreach ($v->photos as $value) {
                                $j++;
                                if($value->model->type == 'summary'){

                     ?>
                            <img class="img-lazy" alt="<?= $value->model->description?>" data-src='<?=DIR?>timthumb.php?src=<?= $value->model->image?>&w=132&h=132&zc=1'>
                                <?php
                                        }
                                    }

                                 }else{
                               ?>
                            <img alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img-qui-sommes-nous-2.png">
                         <?php } ?>
                    
                     <?php
                        
                        if($v->model->sub_title != ''){
                            $tt = explode('-', $v->model->sub_title);
                           
                            
                             echo '<p class="tt-1">'.$tt[0].'</p>';
                             echo '<p class="tt-2">'.$tt[1].'</p>';
                        }
                     ?>
                        
                    
                </div>
                
            <?php 
                    if($j == 5){
                        $j = 0;
                    }
                    if($cnt == 5){
                        echo '</div><div class="rr r2 p-0">';
                    }
                    if($cnt == 10){
                        echo '</div>';
                    }
                }
            ?>

        </div>
        
    </div>
</div>
<!-- BACK BUTTON -->
<div style="clear: both;height: 40px;"><? include '_inc_back_button.php'; ?></div>
<!-- End BACK BUTTON -->
<?php
$dir_uri = DIR.URI;
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

$('.quick-search .submit').click(function(){
         var url = '/voyage/itineraire';
        var des = '';
        $('.search-destination .list-option .active').each(function(index){
            des += $(this).data('value');
            if(index != $('.search-destination .list-option .active').length -1)
                des += '-';
        })
        if(!des) des = 'all';
        var type = $('.search-type .list-option .active').data('value');
        if(!type) type= 'all';
         var length = $('.search-length .list-option .active').data('value');
        if(!length) length= 'all';
        var pr = {'country': des, 'type': type, 'length' : length};
        var url2 = $.param( pr );
        url = url + '?'+url2;
        window.location = url;
    })          

//$('.btn-submit').on("click",function(){
//      var value = $(this).attr("data-value");  
//    $('#load-more').load('$dir_uri?see-more=' + value + ' #load-more'); 
//});        
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>