<?
    use yii\helpers\ArrayHelper;
?>
<?php $this->registerCssFile('/assets/css/page2016/recherche-idees-de-voyage.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain container-1">
    <div class="amc-column row-1">
        <?php include('_inc_breadcrumb.php') ?>
    </div>

</div>
<?php
$iconBanner = $iconCaption = $limitWidth = 'limitWidth-51';
?>
<div class="contain container-2">
    <div class="amc-column mt-txt-60 mb-txt-40">

         <? if($theEntry->model->seo != NULL){?>
            <h1 class="title"><?= $theEntry->model->seo->h1 ?></h1>
        <? } ?>
        <?= $theEntry->model->text?>

    </div>
</div>
<!-- when responsive tablet , include filter responsive -->
<? include '_inc_responsive_filter_recherche_itineraire.php' ?>
<!-- End -->
<div class="contain container-4 container-filter">
    
    <div class="amc-column amc-column-fixpadding">
        <div class="rows row-1 pb-60">
            
            <!-- Start Col 2 Filter -->
            <div class="amc-col amc-col-2 mr-10 d-none d-sm-none d-lg-block">
                
                <?php include '_inc_filter.php';?>


                <div class="area area-3 fix-area mt-25 mb-0">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline; border-radius: 100%;"></li>
                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                    </ul>
                    <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-contact btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</span>


                </div>

               <!-- <div class="area area-2">
                    <p class="tt">Besoin d’aide?</p>
                    <?// include "_inc_besoin.php" ?>
                </div>
               -->
            </div>
			<!-- End Filter -->

            <div class="amc-col amc-col-1 ajaxfilter ml-5">
                <div id="programes-load" class="getcontent">
                    
                    
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
                            if(Yii::$app->request->get('length') == NULL){
                            $length = 'all';
                            }else{
                            $length = Yii::$app->request->get('length');
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
                                'budget-asc' => 'Prix : par ordre croissant',
                                'budget-desc' => 'Prix : par ordre décroissant',
                                'day-asc' => 'Durée : par ordre croissant',
                                'day-desc' => 'Durée : par ordre décroissant',
                            ];
                        ?>
                    <div class="amc-row-order-by">    
                        <span class="amc-text-title-filter">Trier par :</span>
                        <div class="amc-opt-filter amc-ajax-order-by">
                            <span class="amc-text" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_sortby"
><?= Yii::$app->request->get('orderby') == Null ? 'Popularité' : $amc_text_opt[Yii::$app->request->get('orderby')] ?></span>
                            <ul class="amc-list-opt">
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_def" data-opt="def" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'def' ? 'active' : '' ?>">Popularité</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_newest" data-opt="newest-date" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'newest-date' ? 'active' : '' ?>">Dernières nouveautés</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_price_asc" data-opt="budget-asc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'budget-asc' ? 'active' : '' ?>">Prix : par ordre croissant</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_price_desc" data-opt="budget-desc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'budget-desc' ? 'active' : '' ?>">Prix : par ordre décroissant</li>
                                
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_asc" data-opt="day-asc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'day-asc' ? 'active' : '' ?>">Durée : par ordre croissant</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_desc" data-opt="day-desc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'day-desc' ? 'active' : '' ?>">Durée : par ordre décroissant</li>
                            </ul>
                        </div>
                    </div>
                    <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                    <div class="text-center see-more-prev mb-40 mt-0">
                        <span class="btn-submit ajax-see-more-prev btn-amica-basic btn-amica-basic-1" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='<?= count($voyage) ?>' data-page="<?= $page - 1 ?>">Circuits précédents</span>
                    </div>
                    <? } ?>
                    <?
                    $cnt = 0;
                    $count = count($voyage);

                    foreach ($voyage as $key => $v) :
                        if(empty($voyage)){
                            echo '<p class="text-center">Aucune offre n\'est disponible pour le moment</p>';
                            break;
                        }
                        $cnt ++;
                        ?>
                        <?php
                       if($cnt % 2 != 0){
                            if(count($voyage) > $cnt){
                                $clas = 'mb-txt-40';
                                    
                            }if(count($voyage) - 1 > $cnt || count($voyage) - 2 > $cnt){
                                $clas = 'mb-txt-40';
                            }else{
                                $clas = Null;
                            }
                            echo '<div class="clear-fix clear-fix-width '.$clas.'">';
                            
                        }
                        ?>
                        <div class="item item-<?=$key+1?> <?= ($key+1) % 2 != 0 ? 'it-l ml-0' : 'it-r mr-0' ?>">
                            <a href="<?=DIR.$v->slug?>">
                                <div class="amc-image" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="list_section" data-analytics-label="itinerary_card_<?= $v->model->item_id ?>">
                                <?
                                $hasSummary = false;
                                if(isset($v->photos)) {
                                    foreach ($v->photos as $kp => $vp) {
                                        if($vp->model->type == 'summary'){
                                            echo '<img style="min-height: 219px;" alt="'.$vp->description.'" class="lazytest img-responsive" data-src="'.$vp->image.'"/>';
                                            $hasSummary = true;
                                            break;
                                        }
                                    }
                                } ?>
                                <? if(!$hasSummary) : ?>
                                    <img alt="" class="img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                <? endif; ?>
                                </div>   
                            </a>    
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0">
                                <?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                            <p class="tt m-0 p-0 amc-fix-mt-25" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="list_section" data-analytics-label="itinerary_card_t_<?= $v->model->item_id ?>">
                                <a href="<?=DIR.$v->slug?>"><?= str_replace('|','',$v->title) ?></a>
                            </p>
                            <p class="sub-tt amc-fix-mt-12 p-0 m-0"><?=$v->model->sub_title?></p>
                           
                            <div class="summary m-0 p-0 amc-fix-mt-20">
                                 <p><?= $v->model->summary ?></p>
                                
                            </div>
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

                        </div>
                        <?php
                        if($cnt % 2 == 0){
                            echo '</div>';
//                            if($count > $cnt){
//                                echo '<span class="space space-2"></span>';
//                            }
                        }
                        if($cnt % 2 != 0 && $cnt == $count){
                            echo '</div>';
//                            if($count - 1 > $cnt){
//                                echo '<span class="space space-2"></span>';
//                            }
                        }
                        ?>
                    <? endforeach; ?>
                    <!--
                        <?// if(!Yii::$app->request->isAjax || Yii::$app->request->get('page') !== NULL){ ?>
                               <div class="pagination-prog">
                                       <?
                    //$pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countProg'), 'pageSize'=>12]);
                    // $pagi = new \yii\data\Pagination(['totalCount' => $totalCount, 'pageSize'=>8]);
                    // echo \yii\widgets\LinkPager::widget([
                    //          'pagination' => $pagi,
                    //  ]);
                    ?>
                                       <?// if($pagi->pageCount > 1) : ?>
                                       <a class="<?//=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?//=Yii::$app->request->url?><?//=isset($_GET) ? '&' : '?' ?>view=all">Voir tout</a>
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
                                <span class="amc-text">Vous avez vu le seul circuit <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
                            <? }else{ ?>
                                <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> circuits sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
                            <? } ?>
                            <div class="amc-area-prog-btn">
                                <div>
                                    <div class="amc-progress mt-txt-25" <?= ($totalCount > $seemore && ($totalCount / 12) > $page) ? '' : 'style="width: 175px;"' ?>>
                                        <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
                                    </div>
                                
                                    <div class="see-more mt-25 mb-0">
                                        <span class="btn-submit ajax-see-more btn-amica-basic btn-amica-basic-1" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='<?= count($voyage) ?>' data-page="<?= $page + 1 ?>">Plus de circuits</span>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                   
                    <?// } ?>
                   
                </div>
            </div>
            
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
<?php 
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
//				// fix height sub-title
//				
//				var hstleft = $(this).children('.it-l').children('a').children('.sub-tt').outerHeight();
//                
//                var hstright = $(this).children('.it-r').children('a').children('.sub-tt').outerHeight();
//                if (hstleft > hstright){
//                    $(this).children('.it-r').children('a').children('.sub-tt').css('min-height', hstleft);
//                }  
//                 if (hstright > hstleft){
//                    $(this).children('.it-l').children('a').children('.sub-tt').css('min-height', hstright);
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
    $(document).on("click",".pagination-prog .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-prog .pagination li').removeClass('active');
        $(this).parent().addClass('active');
		
		
        $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $('html, body').animate({scrollTop: $('#programes-load').offset().top - 200}, 1000);
        
        $.post(url, { pagi: 'prog' }, function(data){ 
            //$('#programes-load').html(data);
                
                var datanew = $($.parseHTML(data)).find(".getcontent"); 
                $('.ajaxfilter').html(datanew);
			
			$('.img-lazy').lazy({
				scrollDirection: 'vertical',
				effect: 'fadeIn',
				effectTime: 1000,
				visibleOnly: true,
				onError: function(element) {
					console.log('error loading ' + element.data('src'));
				}
            
			});
                        
			
//			  $('.clear-fix').each(function(index) {
//					var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
//					
//					var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
//					if (htleft > htright){
//						$(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
//					}  
//					 if (htright > htleft){
//						$(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
//					}   
//
//					// fix height sub-title
//				
//					var hstleft = $(this).children('.it-l').children('a').children('.sub-tt').outerHeight();
//					
//					var hstright = $(this).children('.it-r').children('a').children('.sub-tt').outerHeight();
//					if (hstleft > hstright){
//						$(this).children('.it-r').children('a').children('.sub-tt').css('min-height', htleft);
//					}  
//					 if (hstright > hstleft){
//						$(this).children('.it-l').children('a').children('.sub-tt').css('min-height', htright);
//					}   
//					
//					// fix height summary
//					
//					var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
//					var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
//				   
//					if (summaryleft > summaryright){
//						$(this).children('.it-r').children('.summary').css('min-height', summaryleft);
//					}  
//					 if (summaryright > summaryleft){
//						$(this).children('.it-l').children('.summary').css('min-height', summaryright);
//					}       
//			  });
            return false;
        });
        return false;
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

$css = <<<CSS

#monitor {
  position:fixed;
  top: 10em;
  right: 1em;
  padding-left: 1em;
  padding-right: 1em;
  background: #000;
  font-family: monospace;
  text-align: center;
  line-height: 2.8em;
}
#isIntersecting {
  color: #33ff00;
  opacity: 0;
  transition: opacity .2s linear;
}


CSS;
$this->registerCss($css);
?>