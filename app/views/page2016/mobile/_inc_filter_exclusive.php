<?
    if(Yii::$app->request->get('country') == NULL){
       $country = [$this->context->arr_option_filter_exclusives_mobile['country']];
   }else{
       $country = Yii::$app->request->get('country');
       $country = explode('-', $country);
   }
   if(Yii::$app->request->get('type') == NULL){
       $type = [$this->context->arr_option_filter_exclusives_mobile['type']];
   }else{
       $type = Yii::$app->request->get('type');
       $type = explode('-', $type);
   }
   
   if (Yii::$app->request->get('see-more') == NULL) {
       $seemore = 8;
   } else {
       $seemore = Yii::$app->request->get('see-more');
   }
   
    if(isset($this->context->arr_option_filter_exclusives_mobile['switch_link']) && $this->context->arr_option_filter_exclusives_mobile['country'] == SEG1){
        $switch_link = $this->context->arr_option_filter_exclusives_mobile['switch_link'];
    }else if(isset($this->context->arr_option_filter_exclusives_mobile['switch_link']) && $this->context->arr_option_filter_exclusives_mobile['country'] == 'all'){
        $switch_link = $this->context->arr_option_filter_exclusives_mobile['switch_link'];
    }else{
        $switch_link = NULL;
    }
   
    $arr_country = ['vietnam','laos','cambodge','birmanie'];
    
?>
<!--        <span class="space fix-space-9-3rem"></span>-->
        <div data-role="header" class="" style="min-height: 5rem;">
            <div class="custom-header">
		<?php 
                    if(in_array(SEG1, $arr_country)){
                ?>
                <nav class="navbar navbar-default navbar-fixed-top filter-top-page" style="background-image: url(<?=DIR?>assets/img/mobile/filter_<?=SEG1?>.png);">
                <? }else{?>      
                  <nav class="navbar navbar-default navbar-fixed-top filter-top-page">  
                <? } ?>    
                      
			<p class="tt-text-filter tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white">
                        Filtrer les résultats de recherche    
                            <a href="<?=DIR?>#page1" data-transition="fade" data-direction="" class='btn-close tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white'>
                                <?//= $this->context->arr_option_filter_exclusives_mobile['title_filter'] ?>
                                x
                                <!--   Nos secrets d'ailleurs au <?//= ucfirst(SEG1)?> -->
    <!--				<img src="/assets/img/mobile/close-icon.png">-->
                            </a>
                        </p>    
		</nav>
                <div class="area-reset-filter">
                    <span class="reset-filter tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white" data-get="country=all&type=all&region=all">Effacer vos filtres</span>
                </div>
            </div>        
	</div><!-- /header -->
        <div class="updatefilter-exclusive" data-url="<?=$this->context->arr_option_filter_exclusives_mobile['uri']?>">
	<div role="main" class="ui-content form-filter-exclusive gettoolfilter-exclusive">
        <? 
            $hide = 0;
            foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) {
                if($this->context->arr_option_filter_exclusives_mobile['numberFilter']['countCountry'][$key] == 0){
                    $hide = 1;
                }else{
                    $hide = 0;
                    break;
                }
            }
        ?>        
        <p class="tt-title tt-latolatin-regular tt-fontsize-40 tt-color-black tt-custom" style="<?= $hide == 1 ? 'display: none;' : '' ?>">Destination(s)</p>
            <ul class="options destination">
                <? foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) { ?>
                <li data-option="" class="<?= in_array($key, $country) ? 'selected ' : ($this->context->arr_option_filter_exclusives_mobile['country'] == SEG1 ? $switch_link : '') ?>" data-value="<?= $key ?>" style="<?= $this->context->arr_option_filter_exclusives_mobile['numberFilter']['countCountry'][$key] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="formule_page" data-analytics-action="sugg_section" data-analytics-label="select_dest_opt_<?= $key ?>"><?= $value?><span class="nb">&nbsp;(<?= $this->context->arr_option_filter_exclusives_mobile['numberFilter']['countCountry'][$key] ?>)</span></li>                   
                <? } ?>
            </ul>
        
        <div class="clearfix"></div>    
        <? 
            $hide = 0;
            foreach (\app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) {
                if($this->context->arr_option_filter_exclusives_mobile['numberFilter']['countType'][$value->category_id] == 0){
                    $hide = 1;
                }else{
                    $hide = 0;
                    break;
                }
            }
        ?>
        <p class="tt-title tt-latolatin-regular tt-fontsize-40 tt-color-black tt-custom" style="<?= $hide == 1 ? 'display: none;' : '' ?>">Votre envie</p>
        <ul class="options  voyage">
            <? foreach (\app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) : ?>
                <li data-option="" class="<?= in_array($value->category_id, $type) ? 'selected' : ($this->context->arr_option_filter_exclusives_mobile['country'] == SEG1 ? '' : $switch_link) ?>" data-value="<?=$value->category_id ?>" style="<?= $this->context->arr_option_filter_exclusives_mobile['numberFilter']['countType'][$value->category_id] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="formule_page" data-analytics-action="sugg_section" data-analytics-label="select_envy_opt_<?= $value->category_id ?>"><?=$value->title ?><span class="nb">&nbsp;(<?= $this->context->arr_option_filter_exclusives_mobile['numberFilter']['countType'][$value->category_id] ?>)</span></li>
            <? endforeach; ?>
        </ul>
		
        <div class="clearfix"></div>  
        <? 
            $hide = 0;
             foreach (Yii::$app->params['tRegionList'] as $key => $value) {
                if($this->context->arr_option_filter_exclusives_mobile['numberFilter']['countRegion'][$key] == 0){
                    $hide = 1;
                }else{
                    $hide = 0;
                    break;
                }
            }
        ?>            
        <p class="tt-title tt-latolatin-regular tt-fontsize-40 tt-color-black tt-custom" style="<?= $hide == 1 ? 'display: none;' : '' ?>">Région</p>
        <ul class="options tour-region">
            <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                <li data-option="" class="<?= in_array(explode('-', $key)[0], $region) ? 'selected' : '' ?>" data-value="<?= $key ?>" style="<?= $this->context->arr_option_filter_exclusives_mobile['numberFilter']['countRegion'][$key] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="formule_page" data-analytics-action="sugg_section" data-analytics-label="select_region_opt_<?= $key ?>"><?= $value ?><span class="nb">&nbsp;(<?= $this->context->arr_option_filter_exclusives_mobile['numberFilter']['countRegion'][$key] ?>)</span></li>
            <? endforeach; ?>

        </ul> 
        <div class="clearfix space space-160"></div>
        
        
        <div data-role="footer"  data-position="fixed" data-tap-toggle="false" class="fix-button-filter ui-footer ui-bar-inherit ui-footer-fixed slideup">
            <span class="cs-select submit <?= $this->context->arr_option_filter_exclusives_mobile['totalCount'] == 0 ? 'disable' : '' ?>" data-analytics="on" data-analytics-category="formule_page" data-analytics-action="sugg_section" data-analytics-label="btn_formules">
                <? if($this->context->arr_option_filter_exclusives_mobile['totalCount'] == 0){?>
                    Aucun résultat
               <?}else{?>
                Afficher <?= ($this->context->arr_option_filter_exclusives_mobile['totalCount'] < 10 && $this->context->arr_option_filter_exclusives_mobile['totalCount'] > 0) ? '0' . $this->context->arr_option_filter_exclusives_mobile['totalCount'] : $this->context->arr_option_filter_exclusives_mobile['totalCount'] ?> résultat<?= $this->context->arr_option_filter_exclusives_mobile['totalCount'] > 1 ? 's' : '' ?>  
               <? } ?>
            </span>    
        </div>    
	</div><!-- /content -->
        </div>