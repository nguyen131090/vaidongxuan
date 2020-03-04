<?php $this->registerCssFile('/assets/css/mobile/filter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div data-role = "page" id="search-testi"  data-theme="b" class="menu-page search-page">
  <div data-role="header" class="custom-header">
		<nav class="navbar navbar-default navbar-fixed-top filter-top-page">
                      <p class="tt-text-filter tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white">
                          Rechercher un avis de nos voyageurs
			<a href="<?=DIR.URI?>#page1" data-transition="slidedown" data-direction="" class='btn-close tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white'>
                            <!-- Voyage au <?//= ucfirst(SEG1)?> -->
                            x
                            
                            <?//= $this->context->arr_option_filter_voyage_mobile['title_filter'] ?>
                            <?//= $theEntry->model->seo->h1 ?>
<!--				<img src="/assets/img/mobile/close-icon.png">-->
			</a>
                      </p>    
			
<!--			<a href="<?//=DIR.URI?>" data-transition="slide" data-direction="reverse" class='btn-close tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white'>
                            Rechercher un avis de nos voyageurs
			</a>-->
		</nav>
                <div class="area-reset-filter">
                    <span class="reset-filter tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white" data-get="/amica-fr/get-number-testi?country=all&type=all&theme=all">Effacer vos filtres</span>
                </div>
	</div><!-- /header -->

	<div role="main" class="ui-content form-filter-testi">
        <p class="tt-title tt-latolatin-regular tt-fontsize-40 tt-color-black tt-custom">Pays visité(s)</p>
            <ul class="options destination">
              <? foreach(Yii::$app->params['tsDestinationList'] as $key => $value) : ?>
                        <li class="<? if(strpos(Yii::$app->request->get('country'), $key) !== false) echo 'selected'; ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
              <? endforeach; ?>
               
            </ul>
        
        <div class="clearfix"></div>              
            <p class="tt-title tt-latolatin-regular tt-fontsize-40 tt-color-black tt-custom">Type de groupe</p>
            <ul class="options  type">
                <? foreach(Yii::$app->params['tTourTypes'] as $key => $value) : ?>
                        <li class="<? if(strpos(Yii::$app->request->get('type'), $key) !== false) echo 'selected'; ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
                        <? endforeach; ?>
            </ul>
		
		  <p class="tt-title tt-latolatin-regular tt-fontsize-40 tt-color-black tt-custom">Thématique</p>
            <ul class="options  theme">
                <? foreach(Yii::$app->params['tTourThemes'] as $key => $value) : ?>
                        <li class="<? if(strpos(Yii::$app->request->get('theme'), $key) !== false) echo 'selected'; ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
                        <? endforeach; ?>
            </ul>
        <div class="clearfix"></div>
        
        <div data-role="footer"  data-position="fixed" data-tap-toggle="false" class="fix-button-filter">
            <span class="cs-select submit">Filtrer</span>    
        </div>                  
	</div><!-- /content -->
</div>
<?
$this->registerCss(".search-page .cs-select.submit{ text-transform: none;}");
?>