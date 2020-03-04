<? $this->registerJsFile(DIR . 'assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerCssFile(DIR . 'assets/js/bxslider/jquery.bxslider.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 

$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); 

$this->registerCssFile('/assets/css/page2016/nos-destinations-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]) ?>

<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>


<div class="contain container-1">
    <? if(isset($theEntry->model->photos)) : ?>
    <? 
    $banner = '';
    foreach ($theEntry->model->photos as $key => $value) {
        if($value->type == 'banner') $banner = $value; 
    } ?>
    <img style="width: 100%;" alt="<?=$banner->description; ?>" class="img-lazy" data-src='<?=$banner->image ?>'>
    <? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
     <div class="amc-column row-2">
        
        <h1 class="title"><?=$theEntry->title ?></h1>
        
    </div>
     
    
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        <div class="rows row-1">
           <div class="btn-tabs">
                    
                    <img alt="" class="tab-panel-1 img-tabs img-lazy <?=!SEG2 ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_1.jpg">
                   
                   
                    <img alt="" class="tab-panel-2 img-tabs img-lazy <?=SEG2=='visiter' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_2.jpg">
                    <img alt="" class="tab-panel-3 img-tabs img-lazy <?=SEG2=='itineraire' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_3.jpg">
                    
                    
                    <img alt="" class="tab-panel-4 img-tabs img-lazy <?=SEG2=='informations-pratiques' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_4.jpg">
                   
                    <img alt="" class="tab-panel-5 img-tabs img-lazy <?=SEG2=='guide' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_5.jpg">
                </div> 
                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="<?=!SEG2 ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1?>" data-toggle="tab" aria-expanded="true">Présentation <br>générale</a>
                            </h2>
                        </li>
                        <li data="tab-panel-2" class="<?=SEG2=='visiter' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/visiter'?>" data-toggle="tab">Sites à <br>visiter</a>
                            </h2>
                        </li>
                        <li data="tab-panel-3" class="<?=SEG2=='itineraire' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/itineraire'?>" data-toggle="tab" >Idées de <br>voyage</a>
                            </h2>
                        </li>

                        <li data="tab-panel-4" class="<?=SEG2=='informations-pratiques' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/informations-pratiques'?>" data-toggle="tab">Infos <br>pratiques</a>
                            </h2>
                        </li>
                         <li data="tab-panel-5" class="<?=SEG2=='guide' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/guide'?>" data-toggle="tab">Guide <br>culturel</a>
                            </h2>
                        </li>
                    </ul>
                <div id="my-tab-content" class="tab-content">
                    <? $voyage = \app\modules\destinations\api\Catalog::get('presentation-generale-'.SEG1);
                            $pdf = isset($voyage->data->pdf) && $voyage->data->pdf ? \yii\easyii\modules\file\api\File::get($voyage->data->pdf)->model->file : [];
                            $pdfImage = isset($voyage->photos) && $voyage->photos ? $voyage->photos[0]->image : '';?>
                    <? if(!SEG2) : ?>
                    <div id="tab-1" class="tab-pane tab-panel-1 <?=!SEG2 ? 'active' : '' ?>">
                        <div class="r r1">
                        </div>
                        <div class="r r2">
                            <div class="amc-col col-left">
                                 <? $general = \app\modules\destinations\api\Catalog::cat(SEG1) ?>
                                 <?= $general ? $general->model->content : '';?>
                            </div>
                            <div class="amc-col col-right">
                                <div class="area-1">
                                    <p class="tt">Besoin de conseil d’un expert ?</p>
                                    <ul>
                                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline;"></li>
                                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                                    </ul>
                                    <a href="/devis" class="btn-contact">Demander un devis</a>


                                </div>    
                                <? if($pdfImage) : ?>
                                <div class="area-2">
                                    <a href="<?=$pdf ?>">
                                        <img alt="" class="img-lazy" data-src="<?=$pdfImage?>">
                                    </a>
                                    <a class="pdf-link" href="<?=$pdf ?>">Télécharger</a>
                                </div>
                                <? endif; ?>
                            </div>
                        </div>
                        
                        <div class="r r3 module-des">
                             <?
                            if(isset($voyage)) {
                                $modDes = $voyage->data->moduledes[0];
                                    $modDes = \app\modules\modulepage\api\Catalog::get($modDes);
                                 ?>    
                    
                            <p class="tt"><?=$modDes->model->sub_title ?></p>
							
                            <? foreach ($modDes->data->destinations as $key => $value) : ?>
                                <?	 $desItem =  \app\modules\destinations\api\Catalog::get($value);?>
								<?
									if($desItem != NULL){
									//print_r('<pre>');
									//var_dump($desItem->slug);exit;
								?>
                                <div class="item item-<?=$key+1 ?>">
                                <a href="<?=DIR.$desItem->slug; ?>">
                                <img alt="<?=$modDes->photos[$key]->description ?>" class="img-lazy" data-src="<?=$modDes->photos[$key]->image ?>" style="display: inline;">
                                </a>
                                <div class="text">
                                    <h3><a href="<?=DIR.$desItem->slug; ?>"><?=$desItem->title ?></a></h3>
                                    <p>
                                       <?=$modDes->photos[$key]->model->caption ?>
                                    </p>
                                </div>
                                </div>
							<? } ?>
                            <? endforeach; ?>
                            <?  } ?>
                        </div>
                        <div class="r r4">
                            <form class="quick-search">
                <label for="">Une destination ?</label>
                    <? $allRoot =  \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->items(['pagination' => ['pageSize' => 0]]);
                    $optDes = \yii\helpers\ArrayHelper::map($allRoot, 'slug', 'title');
                    ?>
                    <?= \yii\helpers\Html::dropDownList('search_destination', null, $optDes,[
                        'class' => 'chosen',
                        'multiple' => 'multiple', 
                        'data-placeholder' => 'Tapez un nom',
                        'id' => 'search_destination',
                        'style' => 'width: 200px;'
                    ]) ?>
            </form>
                        </div>
                        
                        <div class="r r5 video">
                           <?=isset($voyage) ? $voyage->description : ''; ?>
                        </div>
                        <div class="back-button-center back-button"> 
                            
                            <div class="line"></div>
                            <a href="<?= DIR.'destinations'?>"><img alt="Retour" data-src="<?=DIR?>assets/img/back-button.png"/> TOUTES NOS DESTINATIONS</a>
                        </div>
    
                    </div>    
                    <? endif; ?>
                    <? if(SEG2 == 'visiter') : ?>
                    <? $this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); 
                    $this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
                     $this->registerJs("$(function(){
                        $('a.fancybox').fancybox({
                                'scrolling'     : 'auto',
                                'titleShow'     : false,
                        });

                        });",  \yii\web\View::POS_END);
    
                    ?>
                    <div id="tab-2" class="tab-pane tab-panel-2 <?=SEG2 == 'visiter' ? 'active' : '' ?>">
                        <div class="r r1">
                            <? $region = \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter'); ?>
                            <? if(isset($region)) : ?>
                            <? $optRegion =  $region->fieldOptions('region'); ?>
                            <div class="amc-col-1">
                                <? 
                                $i=0;
                                foreach ($optRegion as $key => $value) : ?>
                                    <div class="le <?=SEG1 ?> le_<?=strtolower($key)?> <?=$key?> <?=$i==0 ? 'active' : ''?>"></div>
                                    <? $i++; ?>
                                <? endforeach; ?>
                                <? if(SEG1=='vietnam') : ?>
                                    <img alt="Vietnam visiter" class="bg-vietnam" data-src="/assets/img/maps/vietnam/bg-vietnam-visiter.png">
                                <? endif; ?>
                                <a class="view-all-maps fancybox" href="#big-maps" >AFFICHER LA CARTE</a>
                            </div>
                            <div class="amc-col-2">
                                <?
                                $i=0;
                                foreach ($optRegion as $key => $value) : ?>
                                    <div class="le le-map" data-name="<?=$key?>">
                                        <span class="tx-1"><?=$value?></span><span class="tx-2 <?=$i==0 ? 'active' : ''?>""></span>
                                        <div class="option <?=$i==0 ? 'active' : ''?>"">
                                            <p>
                                            <? $regionLocation = $locations->items(['filters' => ['region' => $key]]);
                                            foreach ($regionLocation as $kl => $vl) {
                                                echo '<a href="'.DIR.$vl->slug.'">'.$vl->title.'</a>';
                                                if($kl == count($regionLocation) - 1) break;
                                                echo ' / ';
                                            } ?>
                                            </p>    
                                            <span class="hide-option pointer">Raccourcir</span>
                                        </div>
                                    </div>
                                    <? $i++; ?>
                                <? endforeach; ?>
                                

                                <div class="btn-form">
                                    <form class="quick-search">
                                        <label for="">Une destination ?</label>
                    <? $allRoot =  \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->items(['pagination' => ['pageSize' => 0]]);
                    $optDes = \yii\helpers\ArrayHelper::map($allRoot, 'slug', 'title');
                    ?>
                    <?= \yii\helpers\Html::dropDownList('search_destination', null, $optDes,[
                        'class' => 'chosen',
                        'multiple' => 'multiple', 
                        'data-placeholder' => 'Tapez un nom',
                        'id' => 'search_destination',
                        'style' => 'width: 200px;' 
                    ]) ?>
                                    </form>
                                </div>
                            </div>
                            <? endif; ?>
                        </div>
                        <div class="r r2">
                            <p class="fix-text"><span class="tx-1">UNE ENVIE ?</span><span class="tx-2"></span></p>
                            <div class="list-tour">
                                <? $envies = \app\modules\destinations\api\Catalog::cat(SEG1.'/envies')?>
                                <? if($envies) : ?>
                                <? foreach ($envies->items(['pagination'=>['pageSize' => 0]]) as $key => $value) : ?>
                                    <div class="item item-<?=$key+1?>">
                                    <a href="<?=DIR.$value->slug ?>">
                                         <? if(isset($value->photos[0])) : ?>   
                                         <img alt="<?=$value->photos[0]->description ?>" class="img-lazy" data-src="<?=$value->photos[0]->image ?>">
                                        <?  endif ?>
                                         <?=$value->title ?>
                                    </a>
                                </div>
                                <? endforeach; ?>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="r r3">
                            <p class="fix-text"><span class="tx-1">TOUS LES SITES À VISITER - <?=strtoupper(SEG1) ?> :</span><span class="tx-2"></span></p>
                           <div class="amc-col col-left">
                                <div id="des-ajax">
                                <? foreach ($locations->items(['pagination' => ['pageSize' => Yii::$app->request->get('view') == 'all' ? 0 : 4]]) as $key => $value) :?>
                                    <div class="item item-<?=$key+1?>">
                                    <div class="left">
                                        <a href="<?=DIR.$value->slug?>">
                                        <? 
                                        $hasSummary = false;
                                        if(isset($value->photos)) {
                                            foreach ($value->photos as $kp => $vp) {
                                                if($vp->type == 'summary'){
                                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'"/>';
                                                    $hasSummary = true;
                                                    break;
                                                }
                                            } 
                                        } ?>
                                        <? if(!$hasSummary) : ?>
                                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                        <? endif; ?>
                                        </a>
                                    </div>
                                    <div class="right">
                                        <h3 class="tt"><a href="<?=DIR.$value->slug?>"><?=$value->title?></a></h3>
                                        <div class="text">
                                            <p>
                                                <?=$value->model->summary?>
                                            </p>
                                        </div>
                                        
                                        <span class="posi"><?
                                         if(isset($value->data->envies)){
                                            $visiterEnvies = $value->data->envies;
                                            foreach ($visiterEnvies as $kve => $vve) {
                                                if(isset($enviesLib['envies-'.SEG1][$vve])) echo '<a href="'.DIR.$enviesLib['envies-'.SEG1][$vve]['slug'].'">'.$enviesLib['envies-'.SEG1][$vve]['title'].'</a>'; else continue;
                                                if($kve==count($visiterEnvies) - 1) break;
                                                echo ", ";
                                         } 
                                         }      
                                         ?></span>
                                    </div>
                                </div>
                                <? endforeach; ?>

                                <div class="pagination-des">
                               <? 
                        $pagi = new \yii\data\Pagination(['totalCount' => count($locations->items(['pagination' => ['pageSize' => 0]])), 'defaultPageSize'=>4, 'params' => ['page' => Yii::$app->request->get('page')], 'route' => URI]);
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagi,
                            'maxButtonCount'=>5,
                            'firstPageLabel'=>'&lt;&lt;',
                            'lastPageLabel'=>'&gt;&gt;',
                            'prevPageLabel'=>'&lt;',
                            'nextPageLabel'=>'&gt;',
                        ]);
                        ?>    
                                </div>
                                
                                </div>
                            </div>
                            <div class="amc-col col-right">
                                <div class="area-1">
                                    <p class="tt">Besoin de conseil d’un expert ?</p>
                                    <ul>
                                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline;"></li>
                                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                                    </ul>
                                    <a href="/devis" class="btn-contact">Demander un devis</a>


                                </div>    
                                <? if($pdfImage) : ?>
                                <div class="area-2">
                                    <a href="<?=$pdf ?>">
                                        <img alt="" class="img-lazy" data-src="<?=$pdfImage?>">
                                    </a>
                                    <a class="pdf-link" href="<?=$pdf ?>">Télécharger</a>
                                </div>
                                <? endif; ?>
                            </div>
                            
                        </div>
                        
                        <div class="r r4 video">
                            <? $videoVisiter = \app\modules\destinations\api\Catalog::get(SEG1.'/sites-a-visiter'); ?>
                            <?=$videoVisiter ? $videoVisiter->description : '' ?>
                        </div>    
                        <div class="back-button-left back-button"> 
                            
                            <div class="line"></div>
                            <a href="<?= DIR.'destinations'?>"><img alt="Retour" data-src="<?=DIR?>assets/img/back-button.png"/> TOUTES NOS DESTINATIONS</a>
                            <div class="line"></div>
                        </div>
                        <? include("maps/big-maps.php"); ?>
                    </div> 
                    <? endif; ?>  
                    <? if(SEG2=='recherche-itineraire') :?>
                    <div id="tab-3" class="tab-pane tab-panel-3 <?=SEG2 == 'recherche-itineraire' ? 'active' : '' ?>">
                        <? $voyage = \app\modules\destinations\api\Catalog::cat(SEG1.'/recherche-itineraire'); ?>
                        <div class="r r1">
                            <div class="text">
                                <p>
                                    <?=$voyage->model->content; ?>
                                </p>
                            </div>
                            <div class="search-form">
                                <p class="fix-tt">Tous les circuits “<span>VIETNAM</span>�?</p>
                                <form>
                                    <div class="cs-select une-envie">
                                        <span class="cs-placeholder active">Durée</span>
                                            <div class="cs-options" style="display: none;">
                                                    <ul>
                                                        <li data-option="" data-value="">1</li>
                                                        <li data-option="" data-value="">2</li>
                                                        <li data-option="" data-value="">3</li>
                                                        <li data-option="" data-value="">4</li>
                                                    </ul>
                                            </div>

                                    </div>
                                     <div class="cs-select type-voyage">
                                        <span class="cs-placeholder active">Type de voyage</span>
                                            <div class="cs-options" style="display: none;">
                                                    <ul>
                                                        <li data-option="" data-value="">Classic</li>
                                                        <li data-option="" data-value="">Trekking</li>

                                                    </ul>
                                            </div>

                                    </div>
                                    <div class="cs-select submit">
                                        RECHERCHE
                                    </div>
                                </form>
                            </div>
                         </div>   
                        
                        <div class="r r2">
                            <p class="fix-tt">Nos programmes pour mieux découvrir le Vietnam</p>
                           <div class="amc-col col-left">
                                <div id="programes-load">
                                <? foreach ($programes as $key => $vp) : ?>
                                <? if($key == 4) break; ?>
                                    <div class="item item-<?=$key+1?>">
                                    <div class="left">
                                        <a href="<?=DIR.$vp->slug?>">
                                        <? 
                        if($key == 4) break;
                        $hasSummary = false;
                        if(isset($value->photos)) {
                            foreach ($value->photos as $kp => $vp) {
                                if($vp->type == 'summary'){
                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'"/>';
                                    $hasSummary = true;
                                    break;
                                }
                            } 
                        } ?>
                        <? if(!$hasSummary) : ?>
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                        <? endif; ?>
                                        </a>
                                    </div>
                                    <div class="right">
                                        <p class="tt"><?=$vp->title;?></p>
                                        <div class="text">
                                            <p>
                                                <?=$vp->model->summary?>
                                            </p>
                                        </div>
                                        <ul>
                                            <li class="calendar"><?=$vp->model->days?> jours <?=$vp->model->nights?> nuits</li>
                                            <li class="des"><?=is_array($vp->data->country) ? $vp->data->country[0] : $vp->data->country?></li>
                                        </ul>
                                    </div>
                                </div>
                                <? endforeach; ?>
                                <div class="pagination-prog">
                                    <? 
                                    $pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countVnProg'), 'pageSize'=>4]);
                                    echo \yii\widgets\LinkPager::widget([
                                        'pagination' => $pagi,
                                    ]);
                                    ?>    
                                </div>
                                </div>
                            </div>
                            <div class="amc-col col-right">
                                 <? if($pdfImage) : ?>
                                <div class="area-2">
                                    <a href="<?=$pdf ?>">
                                        <img alt="" class="img-lazy" data-src="<?=$pdfImage?>">
                                    </a>
                                    <a class="pdf-link" href="<?=$pdf ?>">Télécharger</a>
                                </div>
                                <? endif; ?>
                                <div class="area-3">
                                    <ul>
                                    <? foreach(\app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                        <li><a href="<?=$value->slug; ?>"><?=$value->title ?></a></li>    
                                    <? endforeach ?>
                                    </ul>
                                </div>
                                <div class="area-1">
                                    <p class="tt">Besoin de conseil d’un expert ?</p>
                                    <ul>
                                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline;"></li>
                                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                                    </ul>
                                    <a href="/devis" class="btn-contact">Demander un devis</a>


                                </div>    
                               
                            </div>
                        </div>
                        <div class="hr">
                            <hr>
                        </div>
                        
                        <div class="r r3 module-des">
                             <?
                            $voyage = \app\modules\destinations\api\Catalog::get('idees-de-voyage-'.SEG1);
                            if(isset($voyage)) {
                                $modDes = $voyage->data->moduledes[0];
                                    $modDes = \app\modules\modulepage\api\Catalog::get($modDes);
                                 ?>    
                    
                            <h3 class="tt"><?=$modDes->model->sub_title ?></h3>
                            <? foreach ($modDes->data->destinations as $key => $value) : ?>
                                <? $desItem =  \app\modules\destinations\api\Catalog::get($value);?>
                                <div class="item item-<?=$key+1 ?>">
                                <img alt="<?=$modDes->photos[$key]->description ?>" class="img-lazy" data-src="<?=$modDes->photos[$key]->image ?>" style="display: inline;">
                                <div class="text">
                                    <h4><?=$desItem->title ?></h4>
                                    <p>
                                       <?=$modDes->photos[$key]->model->caption ?>
                                    </p>
                                </div>
                                </div>
                            <? endforeach; ?>
                            <?  } ?>
                        </div>
                        
                        <div class="r r4">
                            <form class="quick-search">
                                        <label for="">Une destination ?</label>
                    <? $allRoot =  \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->items(['pagination' => ['pageSize' => 0]]);
                    $optDes = \yii\helpers\ArrayHelper::map($allRoot, 'slug', 'title');
                    ?>
                    <?= \yii\helpers\Html::dropDownList('search_destination', null, $optDes,[
                        'class' => 'chosen',
                        'multiple' => 'multiple', 
                        'data-placeholder' => 'Tapez un nom',
                        'id' => 'search_destination',
                        'style' => 'width: 200px;' 
                    ]) ?>
                                    </form>
                        </div>
                        
                        <div class="r r5 video">
                            <?=$voyage->description; ?>
                        </div>
                        <div class="r r6">
                            <h3>NOS coupS de cœur</h3>
                            <? if(isset($voyage->data->moduleexcl[0])) : ?>
                            <? $mdName =  $voyage->data->moduleexcl[0];
                                $mdData = \app\modules\modulepage\api\Catalog::get($mdName);
                            ?>
                            <? if(isset($mdData->data->exclusives[0])): ?>
                            <? $itemsData =  $mdData->data->exclusives;?>
                                <div class="amc-col col-left">
                                    <ul class="bxslider bxslider-text">
                                    <? foreach ($itemsData as $key => $value) {
                                        $data = \app\modules\exclusives\api\Catalog::get($value);
                                        echo '<li><p class="tt">'.$data->title.'</p>
                                        <p class="text">'.$data->model->summary.'</p></li>';
                                    } ?>
                                    </ul>
                                </div>
                                <div class="amc-col col-right">
                                    <ul class="bxslider bxslider-image">
                                    <? 
                                    $arPhotos = $mdData->photos;
                                    // krsort( $arPhotos);
                                    foreach ($arPhotos as $key => $value) {
                                        echo '<li>
                                        <div class="bg-image"></div>
                                        <img alt="'.$value->description.'" data-src="'.$value->image.'"/></li>';
                                    } ?>
                                    </ul>
                                </div>
                            <? endif; ?>
                            <? endif; ?>
                        </div>  
                     </div>  
                    <? endif; ?>
                    <? if(SEG2== 'informations-pratiques') : ?>
                    <div id="tab-4" class="tab-pane tab-panel-4 <?=SEG2 == 'informations-pratiques' ? 'active' : '' ?>">
                      
                    <div class="r r2">
                            <div class="amc-col col-left">
                                <?=$infos->content; ?>
                            </div>
                            <div class="amc-col col-right">
                                <div class="area-3 menu-right">
                                    <ul>
                                        <? foreach ($infosChild as $key => $value) : ?>
                                            <li class="<?=$key == count($infosChild) -1 ? 'last' : ''?> <?=$value->items ? 'parent' : ''?>"><a href="<?=DIR.$value->slug?>"><?=$value->title?></a>
                                            <? if($value->items) : ?>
                                                <ul class="items">
                                                    <? foreach ($value->items as $ki => $vi) : ?>
                                                        <li><a href="<?=DIR.$vi->slug?>"><?=$vi->title?></a></li>
                                                    <? endforeach; ?>
                                                </ul>
                                            <? endif; ?>
                                            </li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                                <? if($pdfImage) : ?>
                                <div class="area-2">
                                    <a href="<?=$pdf ?>">
                                        <img alt="" class="img-lazy" data-src="<?=$pdfImage?>">
                                    </a>
                                    <a class="pdf-link" href="<?=$pdf ?>">Télécharger</a>
                                </div>
                                <? endif; ?>
                                
                            </div>
                        </div> 
                        <div class="r r3">
                             <div class="area-col col-left">
                                <h3 class="tt">Notre équipe à votre écoute</h3>
                            </div> 
                            <div class="area-col col-right">
                                <ul>
                                    <li><a href="<?=DIR?>devis">Faites-nous savoir vos attentes</a></li>
                                    <li><a href="<?=DIR?>rdv-telephonique">Convenir d'un RDV téléphonique</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="back-button-center-content back-button">
                            
                            <div class="line"></div>
                            <a href="<?= DIR.'destinations'?>"><img alt="Retour" data-src="<?=DIR?>assets/img/back-button.png"/> TOUTES NOS DESTINATIONS </a>
                        </div>
                    </div>
                    <? endif ?>
                     <? if(SEG2== 'guide') : ?>
                     <div id="tab-5" class="tab-pane tab-panel-5 <?=SEG2 == 'guide' ? 'active' : '' ?>">
                            <div class="r r2">
                            <div class="amc-col col-left">
                                  <?=$guide->content; ?>
                            </div>
                            <div class="amc-col col-right">
                                 <div class="area-3 menu-right">
                                    <ul>
                                        <? foreach ($guideChild as $key => $value) : ?>
                                            <li class="<?=$key == count($guideChild) -1 ? 'last' : ''?> <?=$value->items ? 'parent' : ''?>"><a href="<?=DIR.$value->slug?>"><?=$value->title?></a>
                                            <? if($value->items) : ?>
                                                <ul class="items">
                                                    <? foreach ($value->items as $ki => $vi) : ?>
                                                        <li><a href="<?=DIR.$vi->slug?>"><?=$vi->title?></a></li>
                                                    <? endforeach; ?>
                                                </ul>
                                            <? endif; ?>
                                            </li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                                <? if($pdfImage) : ?>
                                <div class="area-2">
                                    <a href="<?=$pdf ?>">
                                        <img alt="" class="img-lazy" data-src="<?=$pdfImage?>">
                                    </a>
                                    <a class="pdf-link" href="<?=$pdf ?>">Télécharger</a>
                                </div>
                                <? endif; ?>
                            </div>
                        </div> 
						 <div class="r r3">
                             <div class="area-col col-left">
                                <p>Notre équipe à votre écoute</p>
                            </div> 
                            <div class="area-col col-right">
                                <ul>
                                    <li><a href="<?=DIR?>devis">Faites-nous savoir vos attentes</a></li>
                                    <li><a href="<?=DIR?>rdv-telephonique">Convenir d'un RDV téléphonique</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="back-button-center back-button">
                           
                            <div class="line"></div>
                            <a href="<?= DIR.'destinations'?>"><img alt="Retour" data-src="<?=DIR?>assets/img/back-button.png"/> TOUTES NOS DESTINATIONS </a>
                        </div>    
                     </div> 
                    <? endif;?>
                
            </div>  
            
            
           
        </div>
        
        
       
        
    </div>
</div>





  
<?php
$seg1 = SEG1;
$js=<<<JS
$('.chosen').chosen({ search_contains: true});
$('#search_destination').on('change', function(evt, params) {
    window.location = '/'+params.selected;
    return false;
  });
    $('.carousel').carousel({
        interval: false
    });
   
    $('.container-2 .row-1 .nav-tabs li a').click(function(){
        window.location = $(this).attr('href');
        return false;
    });   
        
    $('.le .tx-1').click(function(){
        if($(this).parent().find('.tx-2').hasClass('active')){
            $(this).parent().find('.tx-2').trigger('click');
            return false;
        }
        var name = $(this).parent('.le').attr('data-name');
        $(this).parent().children('.option').addClass('active');
        $(this).parent().children('.tx-2').addClass('active');
        $('.' + name).addClass('active');
    }); 

    $('.le .tx-2').click(function(){
        if(!$(this).hasClass('active')){
            $(this).parent().find('.tx-1').trigger('click');
            return false;
        }
        var name = $(this).parent('.le').attr('data-name');
        $(this).parent().children('.option').removeClass('active');
        $(this).parent().children('.tx-2').removeClass('active');
        $('.' + name).removeClass('active');
    }); 

    $('.hide-option').click(function(){
        var name = $(this).parent().parent('.le').attr('data-name');
        $(this).parent().parent().find('.option').removeClass('active');
        $(this).parent().parent().find('.tx-2').removeClass('active');
        $('.' + name).removeClass('active');
    });   

    $(document).on("click",".pagination-des .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-des .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        $.post(url, { type: 'des' }, function(data){ 
            $('#des-ajax').html(data);
            $('html, body').animate({scrollTop: $('#des-ajax').offset().top - 200}, 200);
            return false;
        });
        return false;
     });

     $(document).on("click",".pagination-prog .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-prog .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        $.post(url, { type: 'prog' }, function(data){ 
            $('#programes-load').html(data);
            return false;
        });
        return false;
     });

     $(document).ready(function(){
        var totalHeight = $('.container-2 .tab-panel-2 .amc-col-1 div:last-of-type').offset().top - $(".container-2 .tab-panel-2 .amc-col-1").offset().top + $('.container-2 .tab-panel-2 .amc-col-1 div:last-of-type').height();
        
        $('.container-2 .tab-panel-2 .amc-col-1').height(totalHeight);
        var slider = $('.bxslider-text').bxSlider({
            slideWidth: 300,
            pager: false
        });
        var sliderImage= $('.bxslider-image').bxSlider({
            slideWidth: 621,
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
            randomStart: false,
            // captions: true,
            // auto: true,
            speed: 1000,
            onSlideBefore: function(slideElement, oldIndex, newIndex){
                slider.goToSlide(newIndex);
            }

        });
   });
    $('.search-submit').on('click',function(){
        var url = '/'+'$seg1'+'/recherche-itineraire';
        var type = $('.search-type .list-option .active').data('value');
        if(!type) type= 'all';

        var length = $('.search-length .list-option .active').data('value');
        if(!length) length = 'all';

        var pr = {'type': type, 'length' : length };
        var url2 = $.param( pr );
        url = url + '?'+url2;
        window.location = url;
    });
     $('.menu-right .parent > a').click(function(){
        $(this).parent().find('.items').slideToggle();
        $(this).parent().toggleClass('active');
       // return false;
    })
    $('.chosen-choices input').keyup(function(){
        if(!$(this).val()){
            $('.chosen-drop .chosen-results').hide();
            return false;
        }
        $('.chosen-drop .chosen-results').show();
    })
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$css = <<<CSS
.chosen-drop .chosen-results{
    display: none;
}
.back-button{
    margin-top: 0;
}
.view-all-maps{
    background: #e1653f url("/assets/img/page2016/search-icon.png?v=1") no-repeat scroll 10px center;
    bottom: -70px;
    color: #fff;
    display: inline-block;
    font: bold 11px/29px LatoLatin,sans-serif;
    left: 50%;
    margin-left: -60px;
    padding: 5px 10px 5px 45px;
    position: absolute;
    text-transform: uppercase;
}
.view-all-maps:hover{
    color: #fff;
    opacity: 0.7;
}
.chosen-container .chosen-results li{
    text-align: left;
}
CSS;
$this->registerCss($css);
?>
