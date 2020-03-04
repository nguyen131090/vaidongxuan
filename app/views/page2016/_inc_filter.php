<?php $this->registerCssFile('/assets/css/page2016/new-filter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php
    if(URI !== 'voyage/itineraire'){
        $switch_link = 'switch-link'; // khi click vao filter type o cac trang tour thi link den trang voyage/itineraire;
        $typeId = $theEntry->model->category_id;
        $first = 'type';
    }else{
        $switch_link = '';
        $typeId = 'all';
        $first = '';
    }
    // switch link to page voyage/balneaire-mer-cocotiers
    if(URI == 'voyage/plages-animees' || URI == 'voyage/plages-intimes' || URI == 'voyage/plages-locales' || URI =='voyage/plages-sauvages'){
        $switch_link_special = 'switch-link-special'; 
    }else{
        $switch_link_special = NULL;
    }
    
$length_data_analytics_label = [
    '1-4' => 'opt_less_week',
    '5-11' => 'opt_1w',
    '12-16' => 'opt_2w',
    '17' => 'opt_more_week',
];
    
?>

<? 
    $request_country = Yii::$app->request->get('country');
    $request_length = Yii::$app->request->get('length');
    $request_type = Yii::$app->request->get('type');
    $request_region = Yii::$app->request->get('region');
    
    $selectDes = explode('-', Yii::$app->request->get('country')); 
    $selectLen = Yii::$app->request->get('length'); 
    $selectType = explode('-', Yii::$app->request->get('type'));
    $selectRegion = Yii::$app->request->get('region'); 
?>
<?php 
    if(($request_country == 'all' || $request_country == '' && $request_country == null) && ($request_type == 'all' || $request_type == '' && $request_type == null) && ($request_length == 'all' || $request_length == '' && $request_length == null) && ($request_region == 'all' || $request_region == '' || $request_region == null)){
        $classActive = null;
    }else{
        $classActive = 'active';
    }
?>
        

<?php if((Yii::$app->request->get('country') == 'all' && Yii::$app->request->get('length') == 'all' && Yii::$app->request->get('type') == 'all' && Yii::$app->request->get('region') == 'all') || (Yii::$app->request->get('country') == '' && Yii::$app->request->get('length') == '' && Yii::$app->request->get('type') == '' && Yii::$app->request->get('region') == '')){?>

<div id="fix-scroll-switch-link" class="result-filter">
    <p class="fix-text getcount-tour mb-25">
        
        <span class="gettext"><span class="number" style="margin-top: 15px;"><?= $totalCount ?> voyage<?= $totalCount > 1 ? 's' : '' ?></span></span>
        
    </p>
    
</div>    
<?php }else{ ?>
<div id="fix-scroll-switch-link" class="result-filter">
    <p class="fix-text getcount-tour">
        
        <span class="gettext"><span class="text-auto">Résultat de votre recherche :</span><span class="number"><?= $totalCount ?> voyage<?= $totalCount > 1 ? 's' : '' ?></span></span>
        
    </p>
    
</div>  
<?php }?>

<div class="area-votre-selection">
    <div class="votre-selection <?= $classActive ?>">
        <p class="title-votre-selection tt-latolatin-bold tt-fontsize-18 tt-color-white">Votre sélection</p>
        <p class="remove-result-filter mt-20 mb-20 <?= $classActive ?>" data-get="country=all&length=all&type=<?= $typeId ?>&region=all">Effacer vos filtres</p>
        <div class="area-un-select">    
            <div class="list-un-select">    
                <div class="un-select un-select-destination">
                    <div class="un-option">
                        <ul>
                            <? foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) : ?>
                            <li class="<?= in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>"><span class="x-del"></span><?= $value ?></li>
                            <? endforeach; ?>   
                        </ul>    
                    </div>
                </div>
                
                <div class="un-select un-select-type">
                    <div class="un-option">
                        <ul>
                            <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                <li class="<?= $switch_link ?> <?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?= $value->category_id ?>"><span class="x-del"></span><?= $value->title ?></li>

                            <? endforeach ?>

                        </ul>    
                    </div>
                </div>
                <div class="un-select un-select-length">
                    <div class="un-option">
                        <ul>
                            <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                <li class="<?= strpos($selectLen, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>"><span class="x-del"></span><?= $value ?></li>
                            <? endforeach; ?>
                        </ul>    
                    </div>
                </div>
                <div class="un-select un-select-region">
                    <div class="un-option">
                        <ul>
                            <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                                <li class="<?= strpos($selectRegion, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>"><span class="x-del"></span><?= $value ?></li>
                            <? endforeach; ?>
                        </ul>    
                    </div>
                </div>
            </div>    
        </div>    
    </div>        
</div>

<div class="area-cs-select">
<p class="title-filter">Filtrer votre recherche</p>
<div class="filter-number">
    <div class="search-form getnumber">
        <form class="form-search vertical search-prog-form">

            <div class="cs-select destination search-destination filter-type <?= Yii::$app->request->get('first') == 'destination' ? 'first-act' : ''?>">
                <span class="cs-placeholder active">Destination(s)</span>
               
                <div class="cs-options">
                    <ul>
                        
                        <? foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) : ?>
                            <li class="<?=$switch_link_special?> <?= in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" style="<?= $numberFilter['countCountry'][$key] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="filter_section" data-analytics-label="opt_<?= $key ?>"><?= $value ?><span class="nb"> (<?= $numberFilter['countCountry'][$key] ?>)</span></li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <div class="list-option">
                    <ul>
                        <? foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) : ?>
                            <li class="<?= in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>
                        <? endforeach; ?>   
                    </ul>    
                </div>

            </div>
            <hr />
            
            <?
                if(URI !== 'voyage/itineraire'){
                    $first_act = 'first-act';
                }else{
                    if(Yii::$app->request->get('first') == 'type'){
                        $first_act = 'first-act';
                    }else{
                        $first_act = '';
                    }
                }
            ?>
            
            <div class="cs-select type-de-voyage single search-type filter-type <?= $first_act ?>">
                <span class="cs-placeholder active">Type de voyage</span>
                <div class="cs-options">
                    <ul>
                        
                        <? if($selectType[0] == NULL){
                            if(URI !== 'voyage/itineraire'){
                                $category_id = $theEntry->model->category_id;
                                if($category_id == 8 || $category_id == 9 || $category_id == 10 || $category_id == 11 ){
                                    $category_id = 4;
                                }
                            $selectType = [$category_id];
                            }
                        } 
                           
                        ?>
                        <?// var_dump(\app\modules\programmes\models\Category::find()->all());exit;?>
                        <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->orderBy('order_num desc')->all() as $key => $value) : ?>
                           
                            <li class="<?= $switch_link ?> <?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?= $value->category_id ?>" style="<?= $numberFilter['countType'][$value->category_id] == 0 ? 'display: none;' : ''?>" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="filter_section" data-analytics-label="opt_inspi_<?= $value->category_id ?>"><?= $value->title ?><span class="nb"> (<?= $numberFilter['countType'][$value->category_id] ?>)</span></li>
                        <? endforeach ?>
                    </ul>
                </div>
                <div class="list-option">
                    <ul>
                        <? foreach ($type as $key => $value) : ?>
                            <li class="<?= $switch_link ?> <?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?= $value->category_id ?>"><?= $value->title ?><span></span></li>
                                
                        <? endforeach ?>
                            
                    </ul>    
                </div>

            </div>
            <hr />
            <div class="cs-select une-envie single search-length filter-type <?= Yii::$app->request->get('first') == 'length' ? 'first-act' : ''?>">
                <span class="cs-placeholder active">Durée</span>
                <div class="cs-options">
                    <ul>
                        
                        <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : 
     
                            ?>
                            <li class="<?= $switch_link_special ?> <?= strpos($selectLen, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" style="<?= $numberFilter['countLength'][$key] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="filter_section" data-analytics-label="<?= $length_data_analytics_label[$key] ?>"><?= $value ?><span class="nb"> (<?= $numberFilter['countLength'][$key] ?>)</span></li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <div class="list-option">

                    <ul>
                        <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                            <li class="<?= strpos($selectLen, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>
                        <? endforeach; ?>
                    </ul>    
                </div>


            </div>
           
             <? if(array_keys(array_filter($numberFilter['countRegion'], function($item){ return $item !== 0;}))) : ?>
             <hr />
            <div class="cs-select une-envie single search-region filter-type <?= Yii::$app->request->get('first') == 'region' ? 'first-act' : ''?>">
                <span class="cs-placeholder active">Région</span>
                <div class="cs-options">
                    <ul>
                        
                        <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                        <li class="<?= strpos($selectRegion, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" style="<?= $numberFilter['countRegion'][$key] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="filter_section" data-analytics-label="opt_<?= str_replace(['-'], ['_'], $key) ?>"><?= $value ?><span class="nb"> (<?= $numberFilter['countRegion'][$key] ?>)</span></li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <div class="list-option">

                    <ul>
                        <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                            <li class="<?= strpos($selectRegion, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>
                        <? endforeach; ?>
                    </ul>    
                </div>


            </div>
            <? endif; ?>
        </form>
    </div>   
</div>    
</div>