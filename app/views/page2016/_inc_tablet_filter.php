<? $this->registerCssFile(DIR . 'assets/css/page2016/tablet_filter.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile(DIR . 'assets/js/tablet_filter.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?
if (Yii::$app->request->get('country') == NULL) {
    $country = [$this->context->arr_option_filter_voyage_mobile['country']];
} else {
    $country = Yii::$app->request->get('country');
    $country = explode('-', $country);
}
if (Yii::$app->request->get('type') == NULL) {
    $type = [$this->context->arr_option_filter_voyage_mobile['type']];
} else {
    $type = Yii::$app->request->get('type');
    $type = explode('-', $type);
}
if (Yii::$app->request->get('length') == NULL) {
    $length = ['all'];
} else {
    $length = Yii::$app->request->get('length');
    $length = explode('-', $length);
}
if (Yii::$app->request->get('region') == NULL) {
    $region = ['all'];
} else {
    $region = Yii::$app->request->get('region');
    $region = explode('-', $region);
}
if (Yii::$app->request->get('see-more') == NULL) {
    $seemore = 8;
} else {
    $seemore = Yii::$app->request->get('see-more');
}

if (isset($this->context->arr_option_filter_voyage_mobile['switch_link']) && $this->context->arr_option_filter_voyage_mobile['country'] == SEG1) {
    $switch_link = $this->context->arr_option_filter_voyage_mobile['switch_link'];
} else if (isset($this->context->arr_option_filter_voyage_mobile['switch_link']) && $this->context->arr_option_filter_voyage_mobile['country'] == 'all') {
    $switch_link = $this->context->arr_option_filter_voyage_mobile['switch_link'];
} else {
    $switch_link = NULL;
}

$arr_country = ['vietnam', 'laos', 'cambodge', 'birmanie'];

if(Yii::$app->controller->action->id == 'landing-page'){
    $classhide = 'd-none';
}else{
    $classhide = '';
}

?>
<!--        <span class="space fix-space-9-3rem"></span>-->
<div data-role="header" class="">
    <div class="custom-header">
        

        <p class="tt-text-filter tt-title tt-latolatin-semibold m-0">
            Filtrer les résultats de recherche
            <a href="javascript:void(0);" data-transition="slidedown" data-direction="" class='btn-close tt-title tt-latolatin-bold'>
                <!-- Voyage au <? //= ucfirst(SEG1) ?> -->
                x

                <? //= $this->context->arr_option_filter_voyage_mobile['title_filter']  ?>
                <? //= $theEntry->model->seo->h1 ?>
<!--				<img src="/assets/img/mobile/close-icon.png">-->
            </a>
        </p>    
         
<!--            <div class="area-reset-filter">
                <span class="reset-filter tt-title tt-latolatin-bold" data-get="country=all&type=all&length=all&region=all">Effacer vos filtres</span>
            </div>-->
    </div>        
</div><!-- /header -->
<div class="updatefilter" data-url="<?= $this->context->arr_option_filter_voyage_mobile['uri'] ?>">
    <div role="main" class="ui-content form-filter-voyage gettoolfilter">
        <?
        $hide = 0;
        foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) {
            if ($this->context->arr_option_filter_voyage_mobile['numberFilter']['countCountry'][$key] == 0) {
                $hide = 1;
            } else {
                $hide = 0;
                break;
            }
        }
        ?>    
        <p class="tt-title tt-latolatin-bold tt-color-black tt-custom <?= $classhide ?>" style="<?= $hide == 1 ? 'display: none;' : '' ?>">Destination(s)</p>
        <ul class="options destination <?= $classhide ?>">
            <? foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) { ?>
                <li data-option="" class="<?= in_array($key, $country) ? 'selected ' : ($this->context->arr_option_filter_voyage_mobile['country'] == SEG1 ? $switch_link : '') ?>" data-value="<?= $key ?>" style="<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countCountry'][$key] == 0 ? 'display: none;' : '' ?>"><?= $value ?><span class="nb">&nbsp;(<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countCountry'][$key] ?>)</span></li>                   
            <? } ?>

        </ul>
        <div class="clearfix"></div> 
        <?
        $hide = 0;
        foreach (Yii::$app->params['tsDurationListNewMobile'] as $key => $value) {
            if ($this->context->arr_option_filter_voyage_mobile['numberFilter']['countLength'][$key] == 0) {
                $hide = 1;
            } else {
                $hide = 0;
                break;
            }
        }
        ?>
        <p class="tt-title tt-latolatin-bold tt-color-black tt-custom" style="<?= $hide == 1 ? 'display: none;' : '' ?>">Durée</p>
        <ul class="options tour-length">
            <? foreach (Yii::$app->params['tsDurationListNewMobile'] as $key => $value) : ?>
                <li data-option="" class="<?= in_array(explode('-', $key)[0], $length) ? 'selected' : '' ?>" data-value="<?= $key ?>" style="<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countLength'][$key] == 0 ? 'display: none;' : '' ?>"><?= $value ?><span class="nb">&nbsp;(<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countLength'][$key] ?>)</span></li>
            <? endforeach; ?>

        </ul> 
        <div class="clearfix"></div> 
        <?
        $hide = 0;
        foreach (\app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) {
            if ($this->context->arr_option_filter_voyage_mobile['numberFilter']['countType'][$value->category_id] == 0) {
                $hide = 1;
            } else {
                $hide = 0;
                break;
            }
        }
        ?>
        <p class="tt-title tt-latolatin-bold tt-color-black tt-custom" style="<?= $hide == 1 ? 'display: none;' : '' ?>">Type de voyage</p>
        <ul class="options  voyage">
            <? foreach (\app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                <li data-option="" class="<?= in_array($value->category_id, $type) ? 'selected ' : ($this->context->arr_option_filter_voyage_mobile['country'] == SEG1 ? '' : $switch_link) ?>" data-value="<?= $value->category_id ?>" style="<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countType'][$value->category_id] == 0 ? 'display: none;' : '' ?>"><?= $value->title ?><span class="nb">&nbsp;(<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countType'][$value->category_id] ?>)</span></li>
            <? endforeach; ?>
        </ul>
        <div class="clearfix"></div> 
        <?
        $hide = 0;
        foreach (Yii::$app->params['tRegionList'] as $key => $value) {
            if ($this->context->arr_option_filter_voyage_mobile['numberFilter']['countRegion'][$key] == 0) {
                $hide = 1;
            } else {
                $hide = 0;
                break;
            }
        }
        ?>

        <p class="tt-title tt-latolatin-bold tt-color-black tt-custom" style="<?= $hide == 1 ? 'display: none;' : '' ?>">Région</p>
        <ul class="options tour-region">
            <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                <li data-option="" class="<?= in_array(explode('-', $key)[0], $region) ? 'selected' : '' ?>" data-value="<?= $key ?>" style="<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countRegion'][$key] == 0 ? 'display: none;' : '' ?>"><?= $value ?><span class="nb">&nbsp;(<?= $this->context->arr_option_filter_voyage_mobile['numberFilter']['countRegion'][$key] ?>)</span></li>
            <? endforeach; ?>

        </ul> 
        <div class="clearfix"></div> 
        
        <div class="area-reset-filter">
            <span class="reset-filter tt-title" data-get="country=all&type=all&length=all&region=all">Effacer vos filtres</span>
        </div>
        
        <div class="clearfix"></div> 

        <div data-role="footer"  data-position="fixed" data-tap-toggle="false" class="fix-button-filter ui-footer ui-bar-inherit ui-footer-fixed slideup">
            <span class="cs-select submit <?= $this->context->arr_option_filter_voyage_mobile['totalCount'] == 0 ? 'disable' : '' ?>">
                <? if ($this->context->arr_option_filter_voyage_mobile['totalCount'] == 0) { ?>
                    Aucun résultat
                <? } else { ?>
                    Afficher <?= ($this->context->arr_option_filter_voyage_mobile['totalCount'] < 10 && $this->context->arr_option_filter_voyage_mobile['totalCount'] > 0) ? '0' . $this->context->arr_option_filter_voyage_mobile['totalCount'] : $this->context->arr_option_filter_voyage_mobile['totalCount'] ?> résultat<?= $this->context->arr_option_filter_voyage_mobile['totalCount'] > 1 ? 's' : '' ?>  
                <? } ?>
            </span>    
        </div>                  
    </div><!-- /content -->
</div>
