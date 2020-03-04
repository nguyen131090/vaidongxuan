<div class="contain pb-25 mb-60 responsive-search-form-ngang d-none d-sm-block d-lg-none">
    
    <div class="column amc-column">
        <p class="tt-big tt-search-form mt-txt-25">FILTRER VOTRE RECHERCHE <?//='RETROUVEZ NOS SUGGESTIONS DE CIRCUITS '. (SEG1 == 'birmanie' ? 'EN ' : 'AU '). ucfirst(SEG1)?></p>
        <div class="search-form quick-search">
            <form class="form-search horizontal search-prog-form">
                <div class="cs-select destination search-destination" style="display: none;">
                    <span class="cs-placeholder"><span class="input-text ml-10">Destination(s)</span><span class="icon-right"></span></span>
                        <div class="cs-options">
                            <ul>
                                <li data-option="" data-value="vietnam"><span class="icon-check"></span><span class="text-option">Vietnam</span></li>
                                <li data-option="" data-value="laos"><span class="icon-check"></span><span class="text-option">Laos</span></li>
                                <li data-option="" data-value="cambodge"><span class="icon-check"></span><span class="text-option">Cambodge</span></li>
                                <li data-option="" data-value="birmanie"><span class="icon-check"></span><span class="text-option">Birmanie</span></li>
                            </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <li class="<?= SEG1 == 'vietnam' ? 'active' : ''?>" data-value="vietnam">Vietnam<span></span></li>
                                <li class="<?= SEG1 == 'laos' ? 'active' : ''?>" data-value="laos">Laos<span></span></li>
                                <li class="<?= SEG1 == 'cambodge' ? 'active' : ''?>" data-value="cambodge">Cambodge<span></span></li>
                                <li class="<?= SEG1 == 'birmanie' ? 'active' : ''?>" data-value="birmanie">Birmanie<span></span></li>
                            </ul>     
                        </div>

                </div>
               
                 <div class="cs-select type-de-voyage search-type">
                     <span class="cs-placeholder"><span class="input-text ml-10">Type de voyage</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                            <? $selectType = explode('-', Yii::$app->request->get('type'));?>
                                <? if($selectType[0] == NULL){
                                    if(URI !== SEG1.'/itineraire'){
                                        $category_id = $theEntry->model->category_id;

                                    $selectType = [$category_id];
                                    }
                                } 

                                ?>
                            
                                <ul>
                                     <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                               <li class="<?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$value->category_id ?>"><span class="icon-check"></span><span class="text-option"><?=$value->title ?></span></li>
                                               <? endforeach ?>
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                             <? foreach ($type as $key => $value) : ?>
                                               <li class="<?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                                            <? endforeach ?>
                            </ul>    
                        </div>

                </div>
                 <div class="cs-select une-envie search-length">
                    <span class="cs-placeholder"><span class="input-text ml-10">Durée</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                            <ul>
                                <? $selectLen = Yii::$app->request->get('length'); ?>
                                <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) { ?>
                                <li class="<?= strpos($selectLen, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" ><span class="icon-check"></span><span class="text-option"><?= $value ?></span></li>
                        
                                <? } ?>
                                
                            </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <? $selectLen = Yii::$app->request->get('length'); ?>
                                <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) { ?>
                                <li data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>    
                                <? } ?>
                                
                            </ul>  
                        </div>
                </div>
                <div class="cs-select une-envie search-region mr-0">
                    <span class="cs-placeholder"><span class="input-text ml-10">Région</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                            <ul>
                                <? $selectRegion = Yii::$app->request->get('region'); ?>
                                <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                                <li class="<?= strpos($selectRegion, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" ><span class="icon-check"></span><span class="text-option"><?= $value ?></span></li>
                        
                                <? endforeach; ?>
                                
                            </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <? foreach (Yii::$app->params['tRegionList'] as $key => $value) { ?>
                                <li data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>    
                                <? } ?>
                                
                            </ul>  
                        </div>
                         

                </div>

                <div class="cs-select submit quick-search-submit btn-amica-basic btn-amica-basic-2 responsive-result">
                    <span>
                        <?
                            if(Yii::$app->request->get('country') !== null || Yii::$app->request->get('type') !== null || Yii::$app->request->get('length') !== null){
                                echo 'Afficher';
                            }
                        ?> 
                        <?= $totalCount ?>
                        <?
                            if(Yii::$app->request->get('country') !== null || Yii::$app->request->get('type') !== null || Yii::$app->request->get('length') !== null){
                                if($totalCount > 1){
                                    echo 'Résultats';
                                }else{
                                   echo 'Résultat';
                                }
                            }else{
                                if($totalCount > 1){
                                    echo 'Voyages';
                                }else{
                                   echo 'Voyage';
                                }
                            }
                        ?> 
                    </span>
                </div>
            </form>
       </div>     
    </div>
</div>  