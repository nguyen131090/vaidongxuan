<?php $this->registerCssFile('/assets/css/page2016/nos-destinations-detaile-infos.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);?>

<?php $this->registerCssFile(DIR . 'assets/css/page2016/fix-banner-top.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR . 'assets/js/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);?>

<? $data_analytics_category = SEG2 == 'guide' ? 'guide_single' : 'info_single'; ?>

<div class="contain container-1">
    <?php
        if(!empty($parent->photos)){
            foreach ($parent->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
   
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-idees-de-voyage.jpg'>
    <?php }?>
    
    <?php 
        $imageBanner = $parent;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    <div class="amc-column row-2 mb-txt-40">
        <? if($parent->model->seo != NULL){?>
            <span class="title m-0"><?= $parent->model->seo->h1 ?></span>
        <? } ?>
    </div>
</div>
<div class="container-2 amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="amc-column column">
            <ul>
                <li class="<?= !SEG2 ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="submenu_section" data-analytics-label="link_country" href="<?=DIR.SEG1 ?>"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries" href="<?=DIR.SEG1 ?>/itineraire">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets" href="<?=DIR.SEG1 ?>/formules">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="submenu_section" data-analytics-label="link_c_cities" href="<?=DIR.SEG1.'/visiter' ?>">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="submenu_section" data-analytics-label="link_c_infos" href="<?=DIR.SEG1 ?>/informations-pratiques">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="submenu_section" data-analytics-label="link_c_guide" href="<?=DIR.SEG1 ?>/guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>
<div class="contain container-4 mt-40 pt-5">
    
    <div class="amc-column amc-column-fixpadding">
        <div class="rows row-1">
            <!-- subMenu on tablet -->
                <div class="responsive-submenu area area-1 menu-right <?= SEG1?> mb-40 d-none d-sm-block d-lg-none">
                    <span class="text-def-select">Sélectionner</span>
                    <ul>
                        <?
                        if(Yii::$app->request->get('url') != NULL){
                            $uri = Yii::$app->request->get('url');
                            $hClass = 'get-ajax-submenu';
                        }else{
                            if(SEG4){
                                $uri = DIR.SEG1.'/'.SEG2.'/'.SEG3;
                            }else{
                               $uri = DIR.URI; 
                            }
                            
                            $hClass = NULL;
                        } 
                        ?>
                        <? foreach ($children as $key => $value) { ?>
                            <? if($value->depth == 2 && ($value->rgt - $value->lft) == 1){ ?>
                                <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent ' : ''?> <?= DIR.$value->slug == $uri ? $hClass : '' ?> <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                    <a href="<?=DIR.$value->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $value->category_id ?>"><?=$value->title?></a><span class="arrow-down-up <?=$value->slug == URI ? 'active' : ''?>">arrow</span>
                                <? 


                                if($value->items && DIR.$value->slug == $uri) { ?>
                                    <ul class="items <?= DIR.$value->slug == $uri ? 'active' : ''?>">
                                        <? foreach ($value->items as $ki => $vi) : ?>
                                            <? if($vi['status'] == 1) {?>
                                            <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a href="<?=DIR.$vi->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $vi->item_id ?>"><?=$vi->title?></a></li>
                                            <? } ?>
                                        <? endforeach; ?>
                                    </ul>
                                <? } ?>
                                </li>
                            <? }else if($value->depth == 2 && ($value->rgt - $value->lft) > 1){ ?>
                                <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent ' : 'parent'?> <?= DIR.$value->slug == $uri ? $hClass : '' ?> <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                    <a href="<?=DIR.$value->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $value->category_id ?>"><?=$value->title?></a><span class="arrow-down-up <?=$value->slug == URI ? 'active' : ''?>">arrow</span>
                                <? 


                                if(DIR.$value->slug == $uri) { ?>
                                    <ul class="items <?= DIR.$value->slug == $uri ? 'active' : ''?>">
                                        <? 
                                        $j = 0;
                                        foreach ($children as $klist => $vlist) {
                                           $j++;  
                                           if($value->lft < $vlist->lft && $value->rgt > $vlist->rgt){                                     
                                            echo '<li class="name-group">'.$vlist->title.'</li>';                                
                                            foreach ($vlist->items as $ki => $vi) { ?>
                                               
                                                <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a href="<?=DIR.$vi->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $vi->item_id ?>"><?=$vi->title?></a></li>
                                            <?  } ?>
                                        <? }} ?>
                                    </ul>
                                <? } ?>
                                </li>
                            <? } ?>
                        <? } ?>
                    </ul>
                </div>
                <!-- End subMenu on tablet -->
            <h1 class="tt tt-title tt-24 mb-txt-40"><?= $this->context->pageT;?></h1>
            
        </div>
        <div class="rows row-2">
            <!-- Col-1 -->
            <div class="amc-col amc-col-1 mr-0">
                <div class="text-content entry-body mb-txt-60">
                <?= isset($theEntry->model->content) ? str_replace('src="', 'data-src="', $theEntry->model->content) : str_replace('src="', 'data-src="', $theEntry->model->description) ?>
                </div> 
                
                <!-- -->
                
                
                <div class="group-btn img-lazy mt-0 mb-60 lazy-background" data-src="<?=DIR?>assets/img/page2016/img-infos-detail-group.png">
                    <div class="text">
                        <p class="tt tt-1">Besoin de conseil pour votre voyage ?</p>
                        <p class="tt tt-2">Notre conseiller(ère) vous répondra sous 48H</p>
                        <span class="pugjd btn-link btn-amica-basic btn-amica-basic-2" data-title="<?= base64_encode(DIR.'nous-contacter') ?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="cta_contact">Contactez-nous</span>
                    </div>
                </div>
                
                
                <!-- -->
                
                <div class="top-3 mb-txt-60">
                    <h3 class="tt tt-title tt-24 mb-txt-40">Vous aimeriez peut-être également lire</h3>
                    
                    
                    <?
                        $cnt = 0;
                        foreach ($top3 as $value) {
                            $cnt++;
                            $image_summary = [];
                            if(!empty($value->photos)){
                                foreach ($value->photos as $image) {
                                    if($image->type == 'summary'){
                                        $image_summary = [
                                            'image' => $image->image,
                                            'description' => $image->description,
                                           //'caption' => $image->caption,
                                        ];
                                    }
                                }
                            }
                        
                    ?>
                    
                    <div class="item item-<?= $cnt ?>">
                        <a href="<?=DIR.$value->slug ?>">
                            <? if(!empty($image_summary)){?>
                            <img width="100%" height="" style="" alt="<?= $image_summary['description']?>" class="img-lazy img-responsive" data-src="<?= $image_summary['image'] ?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_card_<?= $value->category_id ?>">
                            
                            <?}else{?>
                            <img width="100%" height="" alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-infos-detail-top-3.jpg">
                            
                            <? }?>
                            
                            
                            <h4 class="tt tt-title tt-18 mt-25 mb-txt-25" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_card_t_<?= $value->category_id ?>"><?= $value->title ?></h4>
                            
                        </a>
                        <div class="summary">
                            <?= isset($value->summary) ? $value->summary : $value->model->summary ?>
                            
                        </div>
                    </div>
                    <? } ?>
                    
                </div>
                
                <!-- -->
                
                <div class="top-4 mb-0">
                    
                    <h3 class="tt tt-title tt-24 mt-0 mb-txt-40">Pour découvrir le <?=SEG1?></h3>
                    
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
                        <div id="<?=$cnt?>" class="item item-<?= $cnt ?> <?= $cnt % 2 != 0 ? 'it-l mr-10' : 'it-r ml-10' ?>">
                             <a href="<?= DIR.$v->slug?>">
                                 <div class="amc-image" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="tours_section" data-analytics-label="tour_card_<?= $v->model->item_id ?>">
                                <?php

                                    if(!empty($v->photos)){

                                        foreach ($v->photos as $value) {

                                            if($value->model->type == 'summary'){

                                 ?>
                                    <img width="100%" height="219" style="height: 219px;" class="img-lazy img-responsive" alt="<?= $value->model->description?>" <?= Yii::$app->request->isAjax ? 'src="'.$value->image.'"' : 'data-src="'.$value->image.'"' ?>>
                                    <?php
                                            }
                                        }

                                     }else{
                                   ?>
                                <img class="img-lazy" alt="" data-src="<?=DIR?>upload/image/img_exclusi_type.jpg">
                                     <?php } ?>
                               </div>
                            </a>    
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                            <h4 class="tt tt-title tt-18 m-0 p-0 amc-fix-mt-25" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $v->model->item_id ?>">
                                <a class="" href="<?= DIR.$v->slug?>"><?= str_replace('|', '', $v->title) ?></a>
                            </h4>
                            <p class="m-0 p-0 amc-fix-mt-20"><?=$v->model->summary?></p>
                             <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                    <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-25 m-0 p-0">
                                        <?= (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0) ? $v->model->days.' jours ' : ''; ?> 
                                        <?   
                                            if((isset($v->data->budget) && $v->data->budget != '')){
                                                if(isset($v->model->days) && $v->model->days != '' && $v->model->days > 0){
                                                    echo 'à partir de '.$v->data->budget.'€'; 
                                                }else{
                                                    echo 'À partir de '.$v->data->budget.'€'; 
                                                }
                                            }    

                                        ?>
                                    </p>
                                <? } ?>
<!--                            <div class="summary">
                                <p><?//= $v->model->summary?></p>
                            </div>-->
                            
                           
                            
                        </div>
                        <?php
                            if($cnt % 2 == 0){
                                echo '</div>';
//                                if($count > $cnt){
//                                    echo '<span class="space space-40"></span>';
//                                }
                            }
                            if($cnt % 2 != 0 && $cnt == $count){
                                echo '</div>';
//                                if($count - 1 > $cnt){
//                                    echo '<span class="space space-40"></span>';
//                                }
                            }
                        ?>
                    <?php } ?>
                </div>
                <!-- BACK BUTTON -->
                <? include '_inc_back_button.php'; ?>
                <!-- End BACK BUTTON -->
            </div>
            <!-- End Col-1 -->
            
            
            
             <!-- Col-2 -->
            <div class="amc-col amc-col-2 ml-40 d-none d-sm-none d-lg-block">
                <div class="area area-1 menu-right <?= SEG1?> mb-0">
                    <ul>
                        <?
                        if(Yii::$app->request->get('url') != NULL){
                            $uri = Yii::$app->request->get('url');
                            $hClass = 'get-ajax-submenu';
                        }else{
                            if(SEG4){
                                $uri = DIR.SEG1.'/'.SEG2.'/'.SEG3;
                            }else{
                               $uri = DIR.URI; 
                            }
                            
                            $hClass = NULL;
                        } 
                        ?>
                        <? foreach ($children as $key => $value) { ?>
                            <? if($value->depth == 2 && ($value->rgt - $value->lft) == 1){ ?>
                                <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent ' : ''?> <?= DIR.$value->slug == $uri ? $hClass : '' ?> <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                    <a href="<?=DIR.$value->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $value->category_id ?>"><?=$value->title?></a><span class="arrow-down-up <?=$value->slug == URI ? 'active' : ''?>">arrow</span>
                                <? 


                                if($value->items && DIR.$value->slug == $uri) { ?>
                                    <ul class="items <?= DIR.$value->slug == $uri ? 'active' : ''?>">
                                        <? foreach ($value->items as $ki => $vi) : ?>
                                            <? if($vi['status'] == 1) {?>
                                            <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a href="<?=DIR.$vi->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $vi->item_id ?>"><?=$vi->title?></a></li>
                                            <? } ?>
                                        <? endforeach; ?>
                                    </ul>
                                <? } ?>
                                </li>
                            <? }else if($value->depth == 2 && ($value->rgt - $value->lft) > 1){ ?>
                                <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent ' : 'parent'?> <?= DIR.$value->slug == $uri ? $hClass : '' ?> <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                    <a href="<?=DIR.$value->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $value->category_id ?>"><?=$value->title?></a><span class="arrow-down-up <?=$value->slug == URI ? 'active' : ''?>">arrow</span>
                                <? 


                                if(DIR.$value->slug == $uri) { ?>
                                    <ul class="items <?= DIR.$value->slug == $uri ? 'active' : ''?>">
                                        <? 
                                        $j = 0;
                                        foreach ($children as $klist => $vlist) {
                                           $j++;  
                                           if($value->lft < $vlist->lft && $value->rgt > $vlist->rgt){                                     
                                            echo '<li class="name-group">'.$vlist->title.'</li>';                                
                                            foreach ($vlist->items as $ki => $vi) { ?>
                                               
                                                <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a href="<?=DIR.$vi->slug?>" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="<?= SEG2 == 'guide' ? 'guide' : 'info' ?>_link_<?= $vi->item_id ?>"><?=$vi->title?></a></li>
                                            <?  } ?>
                                        <? }} ?>
                                    </ul>
                                <? } ?>
                                </li>
                            <? } ?>
                        <? } ?>
                    </ul>
                </div>
                
                <?
                if(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie'){
                    $desCountry = \app\modules\destinations\api\Catalog::cat(SEG1);

                    $pdf = isset($desCountry->data->pdf) && $desCountry->data->pdf ? \yii\easyii\modules\file\api\File::get($desCountry->data->pdf) : '';  
                    $pdfFile = $pdf->model->file;
                }else{
                    $pdfFile = '';
                }

                ?>
                
                <?// if(SEG1 != 'birmanie'){?>
                <div class="area area-2">
                                    <p class="tt tt-title tt-18 tt-center mt-txt-40 mb-txt-25">Guide <?= SEG1 == 'birmanie' ? 'de la' : 'du' ?>  <?= ucwords(SEG1) ?> <!--<span>Gratuit</span>--></p>
                    <img width="100%" height="" alt="guide <?=SEG1?>" class="img-lazy img-responsive mt-0 mb-25" alt="" data-src="/timthumb.php?src=/assets/img/new-pays/<?=SEG1?>/guide-<?=SEG1?>-new.jpg&w=220&h=279&zc=1">
            
<!--                    <img alt="" data-src="<?=DIR?>assets/img/page2016/img-infos-detail-guide.jpg">-->
                    <div class="text">
                        <p class="tt tt-18 tt-lower">Quand partir </p>
                        <p class="tt tt-18 tt-lower">Comment </p>
                        <p class="tt tt-18 tt-lower">Combien...</p>
                        <p class="tt tt-normal mt-txt-20 mb-0">Vous trouverez toutes les réponses à vos questions pour préparer votre voyage <?= SEG1 == 'birmanie' ? 'en' : 'au' ?> <?= ucfirst(SEG1) ?></p>
                        <form id="download-guide-form">
                            <input class="email mt-20 mb-25 radius-5" data-guide = "<?= isset($pdf->model->title) ? $pdf->model->title : '' ?>" data-name = "<?= isset($pdf->model->title) ? $pdf->model->title : '' ?>" data-pdf="" type="text" value="" placeholder="Votre adresse mail" name="email" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="input_email">
                            <p class="error-email">
                                Le format de votre email n'est pas valide.
                            </p>
                            <span class="submit-email btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="<?= $data_analytics_category ?>" data-analytics-action="sidebar_section" data-analytics-label="btn_download">Télécharger</span>
                        </form>
                    </div>
                </div>
                <?// } ?>
            </div>
            <!-- End col-2 -->
        </div>
    </div>
    
</div>    
<?php
$js=<<<JS
       
 $('.menu-right .parent > .arrow-down-up').click(function(){
        $(this).parent().find('.items').toggleClass('active');
		$(this).toggleClass('active');
	var target = $(this);
        var hItem = $(this).parent().find('.items');
        
        var hclassact = $(this).hasClass('get-sub-ajax');
        
        
        if(!hclassact){
            $(this).addClass('get-sub-ajax');
            if(hItem.length == 0){
                var url = $(this).parent().children('a').attr('href');

                $.ajax({
                    type: "GET",
                    url: window.location.pathname,
                    data: "url=" + url,
                    beforeSend: function() {
                    },
                    success: function(data){

                        var datanew = $($.parseHTML(data)).find(".row-2 .menu-right .get-ajax-submenu").children('.items');
                        target.parent().append(datanew);
                        

                    },
                    complete: function(data) {
                        target.addClass('active');
                    },
               });
            }
        }else{
            
        }
        
        
    return false;      
    });
$('.text-def-select').click(function(){
    $(this).toggleClass('active');
    $(this).parent().children('ul').toggleClass('active');    
});        
        
$('#download-guide-form .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          
        }else{
            $('#download-guide-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#download-guide-form .error-email').hide();
        } 
});         
$('#download-guide-form .submit-email').click(function(){
    var target = $('#download-guide-form .email');
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          return false;
        } 
        $('#download-guide-form .submit-email').text('Merci'); 
        $('#download-guide-form .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'}); 
        $('#download-guide-form .submit-email').addClass('submited'); 
        $.post(url, { 
            email: target.val(), 
            pdf: '$pdfFile', 
            name: target.data('name'),
            guide: target.data('guide'),
            type: 'guide'
            }, function(data){ 
                
            });
    }else{
        return false;
    }
}); 
        
        
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
        
$(window).bind("load", function() { 


  $('.top-3 .item').each(function(index) {
        var max = 0;
        var height = $(this).find('.tt').outerHeight();
        if(max < height){
            max = height;
        }
        
       $('.top-3 .item .tt').css("min-height", max);

             
  });
        
        
       // alert($(window).width());
        
});
        
   
        $(window).bind("load", function() { 
            if($(window).width() <= 1920 && $(window).width() >= 1500){
                var wdscreen = $(window).width();
                var fix = (1920 - wdscreen)/2;
                $('body').css({'overflow-x':'hidden'});
                $('.fix-img-bottom-left').css({'left' : '-'+fix+'px' }); 
                $('.fix-img-middle-right').css({'right' : '-'+fix+'px' }); 
            }   
        });
    
        
    $(window).bind("resize", function() {
        if($(window).width() >= 1500){
            var windowscreen = window.screen.width;
            var widthresize = $(window).width(); 
            var fix = (windowscreen - widthresize)/2;

           $('body').css({'overflow-x':'hidden'});
           $('.fix-img-bottom-left').css({'left' : '-'+fix+'px' }); 
            $('.fix-img-middle-right').css({'right' : '-'+fix+'px' }); 
        }
        if($(window).width() < 1000){
            $('body').css({'overflow-x':'auto'});
        }
   });
 
JS;
$this->registerJs($js,  yii\web\View::POS_END);
?>