<?php $this->registerCssFile('/assets/css/page2016/new-filter-testi.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<p class="title-filter">Filtrer votre recherche</p>
<div class="filter-number">
    <div class="search-form getnumber">
        <form class="form-search vertical search-testi-form">

            <div class="cs-select destination search-destination filter-type <?= Yii::$app->request->get('first') == 'destination' ? 'first-act' : ''?>">
                <span class="cs-placeholder active">Destination(s)</span>
               
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
            <div class="cs-select une-envie search-type filter-type">
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
    <div class="cs-select type-de-voyage search-theme filter-type">
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
            
             <div class="cs-select submit">
                  Afficher 737 résultats
             </div>
           
        </form>
    </div>   
</div>    