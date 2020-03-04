<?//php $this->registerCssFile('/assets/css/page2016/new-filter-testi.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?
    $country = Yii::$app->request->get('country');
    $type = Yii::$app->request->get('type');   
    $theme = Yii::$app->request->get('theme');
?>

<form class="form-search vertical search-testi-form">
    <div class="cs-select destination search-destination">
        <span class="cs-placeholder">Destination(s)</span>
            <div class="cs-options">
                    <ul>
                        <? $selectDes = explode('-',Yii::$app->request->get('country')); ?>
                        <? foreach(Yii::$app->params['tsDestinationList'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
                        <? endforeach; ?>
                    </ul>
            </div>
            <div class="list-option">
                <ul>
                <? foreach(Yii::$app->params['tsDestinationList'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                        <? endforeach; ?>
                </ul>
            </div>
    </div>
    <hr />
    <div class="cs-select une-envie search-type">
        <span class="cs-placeholder">Type de groupe</span>
            <div class="cs-options">
                    <ul>
                        <? $selectType = explode(',',Yii::$app->request->get('type')); ?>
                        <? foreach(Yii::$app->params['tTourTypes'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
                        <? endforeach; ?>
                    </ul>
            </div>
            <div class="list-option">
                <ul>
                <? foreach(Yii::$app->params['tTourTypes'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectType) ? 'active' : '' ?>"  data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                        <? endforeach; ?>

                </ul>
            </div>

    </div>
    <hr />
    <div class="cs-select type-de-voyage search-theme">
        <span class="cs-placeholder active">Thématique du voyage</span>
            <div class="cs-options">
                    <ul>
                        <? $selectTheme = explode(',',Yii::$app->request->get('theme')); ?>
                        <? foreach(Yii::$app->params['tTourThemes'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectTheme) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
                        <? endforeach; ?>
                    </ul>
            </div>
            <div class="list-option">
                <ul>
                <? foreach(Yii::$app->params['tTourThemes'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectTheme) ? 'active' : '' ?>"  data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                        <? endforeach; ?>
                </ul>
            </div>

    </div>
    <!-- <div id="option-3" class="cs-select search-length single">
        <span class="cs-placeholder active">Durée du séjour</span>
            <div class="cs-options">
                    <ul>
                        <li data-option="" data-value="1-7">1-7 jours</li>
                        <li data-option="" data-value="8-14">8-14 jours</li>
                        <li data-option="" data-value="15">Plus de 14 jours</li>
                    </ul>
            </div>
            <div class="list-option">
                <ul>

                </ul>
            </div>

    </div> -->
    <div class="cs-select submit seach-submit gettotalnumbertesti">
        <span class="text">
        <?
        //var_dump($totalCountTesti);exit;
            if($country != null || $type != null || $theme != null){
                $is_get = true;
            }else{
                $is_get = false;
            }
           // if(Yii::$app->request->isAjax){
                if($totalCountTesti > 1){
                    $ext = 's';
                }else{
                    $ext = NULL;
                }
           // }
            if($is_get == true ){
                echo $totalCountTesti .' témoignage'.$ext;
            }else{
                echo 'Filtrer';
            }
        ?>    
        <?//= Yii::$app->request->isAjax ? $totalCountTesti .' témoignage'.$ext : 'Filtrer' ?> 
        </span>    
    </div>
</form>