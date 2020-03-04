<?php $this->registerCssFile('/assets/css/page2016/new-filter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php
    if(URI !== 'formules/itineraire'){
        $switch_link = 'switch-link'; // khi click vao filter type o cac trang tour thi link den trang voyage/itineraire;
        $typeId = $theEntry->model->category_id;
        $first = 'type';
    }else{
        $switch_link = '';
        $typeId = 'all';
        $first = '';
    }
?>

<? 
    $request_country = Yii::$app->request->get('country');
    $request_type = Yii::$app->request->get('type');
    $request_region = Yii::$app->request->get('region');

    $selectDes = explode('-', Yii::$app->request->get('country')); 
    $selectType = explode('-', Yii::$app->request->get('type'));    
    if($selectType[0] == NULL){
        if(URI !== SEG1.'/formules'){
            $category_id = $theEntry->model->category_id;

        $selectType = [$category_id];
        }
    } 
    $selectRegion = Yii::$app->request->get('region'); 

?>
<?php 
    if(($request_type == 'all' || $request_type == '' || $request_type == null) && ($request_region == 'all' || $request_region == '' || $request_region == null)){
        $classActive = null;
    }else{
        $classActive = 'active';
    }
    
    if($selectType[0] != NULL && $selectType[0] != 'all'){
        $classActive = 'active';
    }
?>


<?php if((Yii::$app->request->get('type') == 'all' && Yii::$app->request->get('region') == 'all') || (Yii::$app->request->get('type') == '' && Yii::$app->request->get('region') == '')){?>

<div id="fix-scroll-switch-link" class="result-filter">
    <p class="fix-text getcount-tour mb-25">
        
        <span class="gettext"><span class="number" style="margin-top: 15px;"><?= $totalCount ?> formule<?= $totalCount > 1 ? 's' : '' ?></span></span>
        
    </p>
    
</div>    
<?php }else{ ?>
<div id="fix-scroll-switch-link" class="result-filter">
    <p class="fix-text getcount-tour">
        
        <span class="gettext"><span class="text-auto">Résultat de votre recherche :</span><span class="number"><?= $totalCount ?> formule<?= $totalCount > 1 ? 's' : '' ?></span></span>
        
    </p>
    
</div>  
<?php }?>

<div class="area-votre-selection">
    <div class="votre-selection <?= $classActive ?>">
        <p class="title-votre-selection tt-latolatin-bold tt-fontsize-18 tt-color-white">Votre sélection</p>
        <p class="remove-result-filter mt-20 mb-20 <?= $classActive ?>" data-get="country=<?=SEG1?>&type=all&region=all">Effacer vos filtres</p>
        <div class="area-un-select">    
            <div class="list-un-select">    
                <div style="display: none;" class="un-select un-select-destination">
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
                            
                            <?
                                $category_destination_formules =  \app\modules\destinations\api\Catalog::cat(SEG1.'/formules');
                                //var_dump($category_destination_formules->model->category_id);exit;
                                $items_destination_formules = \app\modules\destinations\api\Catalog::items([
                                         //  'orderBy' => ['order_num'=> SORT_ASC, 'time' => SORT_DESC],
                                           'where' => ['category_id'=>$category_destination_formules->model->category_id],
                                           //'filters' => $fil_countries,
                                          // 'pagination' => ['pageSize' => 0]
                                       ]);
                                //       var_dump($items_destination_formules);exit;
                           ?>
                            <? 
                            foreach ($items_destination_formules as $key_des_formules => $value_des_formules) {
                               $exp_slug = explode('/', $value_des_formules->slug);
                            ?>
                                <? foreach ($type = \app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) : 
                                    $formules_slug = explode('/', $value->slug);
                                    if($exp_slug[2] == $formules_slug[1]){
                                    ?>
                                    <li class="<?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?= $value->category_id ?>"><span class="x-del"></span><?= $value->title ?></li>
                                    <? } ?>
                                <? endforeach ?>
                             <? } ?>    
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
        <form class="form-search vertical search-excl-form">

            <div style="display: none;" class="cs-select destination search-destination filter-type first-act">
                <span class="cs-placeholder active">Destination(s)</span>
               
                <div class="cs-options">
                    <ul>
                        <?
                            $selectDes = explode('-', Yii::$app->request->get('country'));
                           
                            if($selectDes[0] == ''){
                                $selectDes = [SEG1];
                            }
                        ?>
                        <? foreach (Yii::$app->params['tsDestinationListNew'] as $key => $value) : ?>
                            <li class="<?= in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" style="<?= $numberFilter['countCountry'][$key] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="filter_section" data-analytics-label="opt_<?= $key ?>"><?= $value ?><span class="nb"> (<?= $numberFilter['countCountry'][$key] ?>)</span></li>
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
           
            <hr style="display: none;" />
            
            <?
                if(URI !== 'formules/itineraire'){
                    $first_act = 'first-act';
                }else{
                    if(Yii::$app->request->get('first') == 'type'){
                        $first_act = 'first-act';
                    }else{
                        $first_act = '';
                    }
                }
            ?>
            
           <div class="cs-select search-type search-envies votre-envie-mn-2 filter-type ">
                <span class="cs-placeholder active">Votre envie</span>
                <div class="cs-options">
                    <ul>
                        
                        <?
                            $category_destination_formules =  \app\modules\destinations\api\Catalog::cat(SEG1.'/formules');
                            //var_dump($category_destination_formules->model->category_id);exit;
                            $items_destination_formules = \app\modules\destinations\api\Catalog::items([
                                     //  'orderBy' => ['order_num'=> SORT_ASC, 'time' => SORT_DESC],
                                       'where' => ['category_id'=>$category_destination_formules->model->category_id],
                                       //'filters' => $fil_countries,
                                      // 'pagination' => ['pageSize' => 0]
                                   ]);
                            //       var_dump($items_destination_formules);exit;
                       ?>
                        <? 
                        foreach ($items_destination_formules as $key_des_formules => $value_des_formules) {
                           $exp_slug = explode('/', $value_des_formules->slug);
                        ?>
                            <? foreach ($type = \app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) : 
                                $formules_slug = explode('/', $value->slug);
                                if($exp_slug[2] == $formules_slug[1]){
                                ?>
                                <li class="<?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?= $value->category_id ?>" style="<?= $numberFilter['countType'][$value->category_id] == 0 ? 'display: none;' : ''?>" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="filter_section" data-analytics-label="opt_inspi_secret_<?= $value->category_id ?>"><?= $value->title ?><span class="nb"> (<?= $numberFilter['countType'][$value->category_id] ?>)</span></li>
                                <? } ?>
                                <? endforeach ?>
                        <? } ?>    
                    </ul>
                </div>
                <div class="list-option">
                    <ul>
                        <? 
                        foreach ($items_destination_formules as $key_des_formules => $value_des_formules) {
                           $exp_slug = explode('/', $value_des_formules->slug);
                        ?>
                            <? foreach ($type as $key => $value) : 
                                $formules_slug = explode('/', $value->slug);
                                if($exp_slug[2] == $formules_slug[1]){
                                ?>
                                <li class="<?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?= $value->category_id ?>"><?= $value->title ?><span></span></li>
                                <? } ?>
                            <? endforeach ?>
                         <? } ?>    
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
                        <li class="<?= strpos($selectRegion, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" style="<?= $numberFilter['countRegion'][$key] == 0 ? 'display: none;' : '' ?>" data-analytics="on" data-analytics-category="formules_page" data-analytics-action="filter_section" data-analytics-label="opt_<?= str_replace(['-'], ['_'], $key) ?>"><?= $value ?><span class="nb"> (<?= $numberFilter['countRegion'][$key] ?>)</span></li>
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
