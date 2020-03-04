<?php $this->registerCssFile('/assets/css/page2016/result-nos-secret-dailleurs.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);?>
<?php
$iconBanner = $iconCaption ='';
?>
<div class="contain container-1">
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    
</div>
<div class="contain container-2">
    
    <div class="amc-column mt-txt-60 mb-txt-40">
        
         <? if($theEntry->model->seo != NULL){?>
            <h1 class="title"><?= $theEntry->model->seo->h1 ?></h1>
        <? } ?>
        <?= $theEntry->model->text?>
        
    </div>
</div>
<!-- when responsive tablet , include filter responsive -->
<? include '_inc_responsive_filter_country_exclusive.php' ?>
<!-- End -->
<div class="contain container-4 container-filter">
    
    <div class="amc-column amc-column-fixpadding">
        
        <div class="rows row-1 pb-60">
		
            <!-- Start col Filter -->
            <div class="amc-col amc-col-2 mr-10 d-none d-sm-none d-lg-block">
                <? include '_inc_filter_exclusive.php'; ?>
               
                 <div class="area-1 fix-area mt-25 mb-0">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;"></li>
                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                    </ul>
                    <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-contact btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</span>
                </div>
                <!--
                <div class="area area-2">
                    <p class="tt">Besoin d’aide?</p>
                    <?// include "_inc_besoin.php" ?>
                </div>
                -->
            </div>
			<!-- End Filter-->

            <div class="amc-col amc-col-1 ajaxfilter ml-5">
                <div id="exclusives-load" class="getcontent">
                    
                    
                        <?
                        
                            if(Yii::$app->request->get('region') == NULL){
                                $region = 'all';
                            }else{
                                $region = Yii::$app->request->get('region');
                            }
                        
                           if(Yii::$app->request->get('country') == NULL){
                                $country = 'all';
                            }else{
                                $country = Yii::$app->request->get('country');
                            }
                            if(Yii::$app->request->get('type') == NULL){
                                $type = 'all';
                            }else{
                                $type = Yii::$app->request->get('type');
                            }
                            if (Yii::$app->request->get('see-more') == NULL) {
                                if (Yii::$app->request->get('page') != NULL) {
                                    $seemore = Yii::$app->request->get('page') * 12;
                                }else{
                                    $seemore = 12;
                                }

                            } else {
                                $seemore = Yii::$app->request->get('see-more');
                            }
                            if (Yii::$app->request->get('page') == NULL) {
                                $page = $seemore / 12;
                            } else {
                                $page = Yii::$app->request->get('page');
                            }
                            
                            if (Yii::$app->request->get('before-page') == NULL) {
                                $page = $seemore / 12;
                            } else {
                                $page = Yii::$app->request->get('before-page');
                            }
                            
                            if(Yii::$app->request->get('orderby') == NULL){
                                $orderby = 'def';
                            }else{
                                $orderby = Yii::$app->request->get('orderby');
                            }
                            $amc_text_opt = [
                                'def' => 'Popularité',
                                'newest-date' => 'Dernières nouveautés',
                               
                            ];
                        ?>
                    <div class="amc-row-order-by">    
                        <span class="amc-text-title-filter">Trier par :</span>
                        <div class="amc-opt-filter amc-ajax-order-by">
                            <span class="amc-text" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="sortby_section" data-analytics-label="select_sortby"><?= Yii::$app->request->get('orderby') == Null ? 'Popularité' : $amc_text_opt[Yii::$app->request->get('orderby')] ?></span>
                            <ul class="amc-list-opt">
                                <li data-analytics="on" data-analytics-category="formules_page" data-analytics-action="sortby_section" data-analytics-label="select_def" data-opt="def" data-get="<?= 'country=' . $country . '&type=' . $type ?>" class="<?= Yii::$app->request->get('orderby') == 'def' ? 'active' : '' ?>">Popularité</li>
                                <li data-analytics="on" data-analytics-category="formules_page" data-analytics-action="sortby_section" data-analytics-label="select_newest" data-opt="newest-date" data-get="<?= 'country=' . $country . '&type=' . $type ?>" class="<?= Yii::$app->request->get('orderby') == 'newest-date' ? 'active' : '' ?>">Dernières nouveautés</li>
                            </ul>
                        </div>
                    </div>
                    <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                    <div class="text-center see-more-prev mb-40 mt-0">
                        <span class="btn-submit ajax-see-more-prev btn-amica-basic btn-amica-basic-1" data-get="<?= 'country=' . $country . '&type=' . $type . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='<?= count($theEntries) ?>' data-page="<?= $page - 1 ?>">Formules précédentes</span>
                    </div>
                    <? } ?>
                    <?
                    $cnt = 0;
                    $count = count($theEntries);

                    foreach($theEntries as $key => $v) :
                        if(empty($theEntries)){
                            echo '<p class="text-center">Aucune offre n\'est disponible pour le moment</p>';
                            break;
                        }
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
                            echo '<div class="clear-fix clear-fix-width '.$clas.'">';
                            
                        }
                        ?>
                        <div class="item item-<?= $key+1 ?> <?= $cnt % 2 != 0 ? 'it-l ml-0' : 'it-r mr-0' ?>">
                            <a href="<?=DIR.$v->slug ?>">
                                <div class="amc-image" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="list_section" data-analytics-label="secret_card_<?= $v->model->item_id ?>">
                                <?php
                                if(!empty($v->photos)){
                                    foreach ($v->photos as $value) {
                                        if($value->model->type == 'summary'){
                                            ?>
                                            <img style="" class="img-lazy img-responsive" alt="<?= $value->model->description?>" <?= Yii::$app->request->isAjax ? 'src="'.$value->image.'"' : 'src="'.$value->image.'"' ?>>
                                            <?php
                                        }
                                    }

                                }else{
                                    ?>
                                    <img class="img-lazy img-responsive" alt="" data-src="<?=DIR?>upload/image/img_exclusi_type.jpg">

                                <?php } ?>
                                </div> 
                            </a>    
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0">
                                <?= $v->parents()[0]->title ?> /
                                <?php
                                    $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);

                                    $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');
                                    $ct = 0;
                                    foreach ($v->model->data->locations as $local) { $ct ++;
                                        echo $location[$local];
                                        // echo ucwords(str_replace('-', ' ', $local));
                                        //   if($ct < count($v->model->data->locations)){
                                        if(count($v->model->data->locations) == 1) {
                                            echo ',';
                                        } else {
                                            echo ', ';
                                        }

                                        //   }
                                    }
                                ?>
                                <?=isset($v->data->countries[0]) ? ucfirst($v->data->countries[0]) : ''?>
                            </p>

                            <p class="tt m-0 p-0 amc-fix-mt-25" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="list_section" data-analytics-label="secret_card_t_<?= $v->model->item_id ?>">
                                <a href="<?=DIR.$v->slug ?>"><?= str_replace('|','',$v->title); ?></a>
                            </p>
                            
                            <div class="summary m-0 p-0 amc-fix-mt-20">
                                <p><?= $v->model->summary?></p>
                            </div>
                           
                        </div>
                        <?php
                        if($cnt % 2 == 0){
                            echo '</div>';
//                            if($count > $cnt){
//                                echo '<span class="space space-40"></span>';
//                            }
                        }
                        if($cnt % 2 != 0 && $cnt == $count){
                            echo '</div>';
//                            if($count - 1 > $cnt){
//                                echo '<span class="space space-40"></span>';
//                            }
                        }
                        ?>
                    <? endforeach; ?>
                    <!--
                    <?// if(!Yii::$app->request->isAjax || Yii::$app->request->get('page') !== NULL){ ?>
                        <div class="pagination-excl">
                                    <?
                    // $pagi = new \yii\data\Pagination(['totalCount' => $totalCount, 'defaultPageSize'=>8 ]);
                    //  echo \yii\widgets\LinkPager::widget([
                    //      'pagination' => $pagi,
                    //      'maxButtonCount'=>5,
                    //  ]);
                    ?>
                                     <?// if($pagi->pageCount > 1) : ?>
                            <a class="<?//=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?>view-all-link" href="<?//=DIR.URI?>?view=all">Voir tout</a>
                            <?// endif; ?>       
                        </div>
                        <?// }else{ ?>
                    -->
                    <?   
                    if($totalCount == 13 || $totalCount == 14){
                        $seemore = $totalCount;
                    }
                    if ($totalCount > $seemore && ($totalCount / 12) > $page) {
                    ?>
                    <div class="amc-area-detaile-number-items <?= $clas == Null ? 'mt-txt-40' : 'mt-0' ?>">
                        <div>
                            <? if($totalCount < 2){ ?>
                                <span class="amc-text">Vous avez vu 1a seule formule <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
                            <? }else{ ?>
                                <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> formules sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
                            <? } ?>
                            <div class="amc-area-prog-btn">
                                <div>
                                    <div class="amc-progress mt-txt-25" <?= ($totalCount > $seemore && ($totalCount / 12) > $page) ? '' : 'style="width: 175px;"' ?>>
                                        <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
                                    </div>
                               
                                    <div class="see-more mt-25 mb-0">
                                        <span class="btn-submit ajax-see-more btn-amica-basic btn-amica-basic-1" data-get="<?= 'country=' . $country . '&type=' . $type . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='<?= count($theEntries) ?>' data-page="<?= $page + 1 ?>" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="list_section" data-analytics-label="cta_more">Plus de formules</span>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                   
                    <?// } ?>
                </div>
            </div>
            <? if($this->context->seoContent != NULL) : ?>
            <div id="text-content" class="iti">
                <span class="tt tt-seo">En savoir plus sur "<?= $theEntry->model->seo->h1 ?>"</span>
                <div><?=$this->context->seoContent;?></div>
            </div>
            <? endif; ?>
        </div>
    </div>
</div>

<div class="contain mb-0 pt-25 pb-25 mt-0 mb-60 responsive-area-devis-col-left d-none d-lg-none d-sm-block">
    <div class="amc-column column">
        <div class="item item-1">
            <span class="tt tt-1">Besoin de conseil d’un expert ?</span>
            <span class="tt tt-2">Notre conseiller(ère) vous répondra sous 48H</span>
        </div>
        <div class="item item-2">
            <img alt="" class="img-lazy lazyload" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
        </div>
        <div class="item item-3">
            <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-amica-basic btn-amica-basic-2">Demander un devis</span>
        </div>
    </div>
</div>

<? 
$url = DIR.URI;
$js = <<<JS
    
//$(window).bind("load", function() { 
//          $('.clear-fix').each(function(index) {
//                var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
//                
//                var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
//                if (htleft > htright){
//                    $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
//                }  
//                 if (htright > htleft){
//                    $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
//                }   
//        
//                // fix height summary
//                
//                var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
//                var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
//               
//                if (summaryleft > summaryright){
//                    $(this).children('.it-r').children('.summary').css('min-height', summaryleft);
//                }  
//                 if (summaryright > summaryleft){
//                    $(this).children('.it-l').children('.summary').css('min-height', summaryright);
//                }       
//          });
//});
    $(document).on("click",".pagination-excl .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-excl .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        
        $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $('html, body').animate({scrollTop: $('.getcontent').offset().top - 200}, 1000);
        $.post(url, { pagi: 'excl' }, function(data){ 
//            $('#exclusives-load').html(data);
//			$('html, body').animate({scrollTop: $('#exclusives-load').offset().top - 200}, 200);
//			$('#exclusives-load .item-1, #exclusives-load .item-2').wrapAll('<div class="clear-fix"></div>');
//			$('#exclusives-load .item-3, #exclusives-load .item-4').wrapAll('<div class="clear-fix"></div>');
//			$('#exclusives-load .item').each(function(index) {
//				if(index % 2 == 0){
//					$(this).addClass('it-l');
//				}
//				if(index % 2 != 0){
//					$(this).addClass('it-r');
//				}
//			});
        
                    var datanew = $($.parseHTML(data)).find(".getcontent"); 
			$('.ajaxfilter').html(datanew);
//		  $('.clear-fix').each(function(index) {
//				var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
//				
//				var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
//				if (htleft > htright){
//					$(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
//				}  
//				 if (htright > htleft){
//					$(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
//				}   
//
//				// fix height summary
//				
//				var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
//				var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
//			   
//				if (summaryleft > summaryright){
//					$(this).children('.it-r').children('.summary').css('min-height', summaryleft);
//				}  
//				 if (summaryright > summaryleft){
//					$(this).children('.it-l').children('.summary').css('min-height', summaryright);
//				}       
//		  });
            return false;
        });
        return false;
     });
    
	$('#exclusives-load .item-1, #exclusives-load .item-2').wrapAll('<div class="clear-fix"></div>');
	$('#exclusives-load .item-3, #exclusives-load .item-4').wrapAll('<div class="clear-fix"></div>');
	$('#exclusives-load .item').each(function(index) {
		if(index % 2 == 0){
			$(this).addClass('it-l');
		}
		if(index % 2 != 0){
			$(this).addClass('it-r');
		}
	});
//  $('.clear-fix').each(function(index) {
//		var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
//		
//		var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
//		if (htleft > htright){
//			$(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
//		}  
//		 if (htright > htleft){
//			$(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
//		}   
//
//		// fix height summary
//		
//		var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
//		var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
//	   
//		if (summaryleft > summaryright){
//			$(this).children('.it-r').children('.summary').css('min-height', summaryleft);
//		}  
//		 if (summaryright > summaryleft){
//			$(this).children('.it-l').children('.summary').css('min-height', summaryright);
//		}       
//  });
JS;

$this->registerJs($js);
?>
