<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/fix-banner-top.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR . 'assets/js/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/landing-page.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<div class="contain container-1">
    <? if (isset($theEntry->model->photos)) { ?>
        <?
        $banner = '';
        foreach ($theEntry->model->photos as $key => $value) {
            if ($value->type == 'banner')
                $banner = $value;
        }
        ?>
    <img style="width: 100%;" alt="<?//= $banner->description; ?>" class="img-lazy" data-src='<?= isset($banner->image) ? $banner->image : '' ?>'>
    <? } ?>
<!--    <img style="width: 100%;" alt="<?//= $banner->description; ?>" class="img-lazy" data-src='/assets/img/landing-page/img-banner-1.jpg'>-->
    <div class="ld-baner-overlay">
        
    </div>
    <div class="amc-column ld-btn-logo">
        <a href="<?=DIR?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="cover_section" data-analytics-label="logo_amica">
            <img alt="Amica Travel" data-src="<?= DIR?>assets/img/landing-page/ld-logo.png">
        </a>    
    </div>
    <div class="amc-column ld-area-text-button">
        <div class="ld-text-button">
            <p class="m-0">
                <span><?= isset($theEntry->model->seo) ? $theEntry->model->seo->h1 : '' ?></span>
            </p>    
            <h1 class="mt-0">
                <?= $theEntry->title ?>
            </h1>    
<!--                Laissez-vous tenter par <br>un circuits unique au Vietnam-->
            
            <a href="/devis" class="ld-btn-custom btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="cover_section" data-analytics-label="cta_devis">Demander un devis personnalisé</a>
        </div>
    </div>    
</div>
<div class="contain ld-container-2 responsive-search-form-ngang mb-txt-60">
    
    
        <div class="amc-column ld-column">
            <p class="tt-big tt-search-form mt-txt-25 mb-txt-25">Trouvez une idée de voyage <?//='RETROUVEZ NOS SUGGESTIONS DE CIRCUITS '. (SEG1 == 'birmanie' ? 'EN ' : 'AU '). ucfirst(SEG1)?></p>
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
                                    <li class="<?//= SEG1 == 'vietnam' ? 'active' : ''?>active" data-value="vietnam">Vietnam<span></span></li>
                                    <li class="<?= SEG1 == 'laos' ? 'active' : ''?>" data-value="laos">Laos<span></span></li>
                                    <li class="<?= SEG1 == 'cambodge' ? 'active' : ''?>" data-value="cambodge">Cambodge<span></span></li>
                                    <li class="<?= SEG1 == 'birmanie' ? 'active' : ''?>" data-value="birmanie">Birmanie<span></span></li>
                                </ul>     
                            </div>

                    </div>

                     <div class="cs-select une-envie search-length">
                        <span class="cs-placeholder" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_duration"><span class="input-text ml-10">Durée</span> <span class="icon-right"></span></span>
                            <div class="cs-options">
                                <ul>
                                    <? $selectLen = Yii::$app->request->get('length'); ?>
                                    <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) { ?>
                                    <li class="<?= strpos($selectLen, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_duration_opt_<?= $key ?>"><span class="icon-check"></span><span class="text-option"><?= $value ?></span></li>

                                    <? } ?>

                                </ul>
                            </div>
                            <div class="list-option">
                                <ul>
                                    <? $selectLen = Yii::$app->request->get('length'); ?>
                                    <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) { ?>
                                    <li data-option="" data-value="<?= $key ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_duration_opt_<?= $key ?>"><?= $value ?><span></span></li>    
                                    <? } ?>

                                </ul>  
                            </div>
                    </div>
                    
                     <div class="cs-select type-de-voyage search-type">
                         <span class="cs-placeholder" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_voyage"><span class="input-text ml-10">Type de voyage</span> <span class="icon-right"></span></span>
                            <div class="cs-options">
                                <? $selectType = explode('-', Yii::$app->request->get('type'));?>
                                    <? 
                                    //if($selectType[0] == NULL){
                                    //    if(URI !== SEG1.'/itineraire'){
                                    //        $category_id = $theEntry->model->category_id;

                                    //    $selectType = [$category_id];
                                    //    }
                                    //} 

                                    ?>

                                    <ul>
                                         <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                                   <li class="<?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$value->category_id ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_voyage_opt_<?= $value->category_id ?>"><span class="icon-check"></span><span class="text-option"><?=$value->title ?></span></li>
                                                   <? endforeach ?>
                                    </ul>
                            </div>
                            <div class="list-option">
                                <ul>
                                 <? foreach ($type as $key => $value) : ?>
                                                   <li class="<?= in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$value->category_id ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_voyage_opt_<?= $value->category_id ?>"><?=$value->title ?><span></span></li>
                                                <? endforeach ?>
                                </ul>    
                            </div>

                    </div>
                    
                    <div class="cs-select une-envie search-region">
                        <span class="cs-placeholder" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_region"><span class="input-text ml-10">Région</span> <span class="icon-right"></span></span>
                            <div class="cs-options">
                                <ul>
                                    <? $selectRegion = Yii::$app->request->get('region'); ?>
                                    <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                                    <li class="<?= strpos($selectRegion, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="select_region_opt_<?= $key ?>"><span class="icon-check"></span><span class="text-option"><?= $value ?></span></li>

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

                    <div class="cs-select submit quick-search-submit btn-amica-basic btn-amica-basic-3 responsive-result" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="sugg_section" data-analytics-label="btn_voyage">
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
<div class="contain ld-container-3 ld-entry-content mb-txt-60">
    <div class="column amc-column">
        <div class="ld-content area-text">
            <?
            
                                     //   var_dump($theEntry);exit;
            if(isset($theEntry->model->text)){
                $txt = explode('</p>', str_replace('<h2', '<h2 class="amc-fix-mb-40"', $theEntry->model->text));
                unset($txt[count($txt) - 1]);
               
            ?>
            
            <div class="substring-text">
                <?
                    if(isset($txt[0])){
                        $strlen = strlen($txt[0]); 
                        $first_text = substr($txt[0], 0, $strlen - 1);
                        $last_character = substr($txt[0], $strlen - 1, $strlen);
                        if($last_character == '.'){
                            $last_character = $last_character;
                        }else{
                            $last_character = ' '.$last_character;
                        }
                ?>
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="content_section" data-analytics-label="read_more">Lire la suite</span></p>'; ?>

                <?
                    }
                    
                ?>
               
            </div>
             <div class="fullstring-text">
                <?
                            $cnt = 0;
                            foreach ($txt as $t) {
                                $cnt++;
                                if($cnt > 1 && count($txt) > $cnt){
                                    echo $t . '</p>';
                                }else if(count($txt) == $cnt){
                                    echo $t . '<span class="amc-btn-control-text less-text"> Réduire</span></p>';
                                }
                                
                            }
                ?>
            </div>
            <? }?>
        </div>    
    </div>
</div>


<div class="contain ld-container-4 about-container lazy-background loaded visible w-100 d-inline-block" style="margin-bottom: 50px;">
    <div class="column amc-column">
        <div style="margin-top: 8px !important;" class="mb-0" id="video">
        <?
            if(isset($theEntry->data->video)){
                echo str_replace(['<iframe ', '<h2'], ['<iframe data-analytics="on" data-analytics-category="landing_page" data-analytics-action="video_section" data-analytics-label="control_play"', '<h2 class="amc-fix-mb-40"'], $theEntry->data->video);
            }
        ?>
        </div>
<!--        <h2 class="tt mt-txt-40 text-center"><strong>Amica Travel,</strong> l’âme du voyage
        </h2>
        <p class="summary mt-0 mb-40 text-center">1min30 de condensé d'Amica Travel et de notre définition du voyage. Venez visiter le Vietnam, le Laos, le Cambodge &amp; la Birmanie avec nous.&nbsp;</p>
        <div class="videoWrapper" data-analytics="on" data-analytics-category="homepage" data-analytics-action="video_section" data-analytics-label="control_play">
            <iframe class="videotype videoytb my-0 w-100" title="Amica Travel, l’âme du voyage" scrolling="no" data-src="https://www.youtube.com/embed/iUw37JEoucQ?enablejsapi=1&amp;rel=0" autoplay="" allowfullscreen="allowfullscreen" frameborder="0" id="video-ytb-1" data-name="video-ytb" src="https://www.youtube.com/embed/iUw37JEoucQ?enablejsapi=1&amp;rel=0"></iframe>
        </div>-->
    </div>
</div>

<div class="contain ld-container-5 ld-entry-content mb-60">
    <div class="column amc-column">
        
        
        <div class="ld-content mb-txt-40 area-text">
            <?
            
                                     //   var_dump($theEntry);exit;
            if(isset($theEntry->data->block3)){
                $txt = explode('</p>', str_replace('<h2', '<h2 class="amc-fix-mb-40"', $theEntry->data->block3));
                unset($txt[count($txt) - 1]);
               
            ?>
            
            <div class="substring-text">
                <?
                    if(isset($txt[0])){
                        $strlen = strlen($txt[0]); 
                        $first_text = substr($txt[0], 0, $strlen - 1);
                        $last_character = substr($txt[0], $strlen - 1, $strlen);
                        if($last_character == '.'){
                            $last_character = $last_character;
                        }else{
                            $last_character = ' '.$last_character;
                        }
                ?>
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="content_section" data-analytics-label="read_more">Lire la suite</span></p>'; ?>

                <?
                    }
                    
                ?>
               
            </div>
             <div class="fullstring-text">
                <?
                            $cnt = 0;
                            foreach ($txt as $t) {
                                $cnt++;
                                if($cnt > 1 && count($txt) > $cnt){
                                    echo $t . '</p>';
                                }else if(count($txt) == $cnt){
                                    echo $t . '<span class="amc-btn-control-text less-text"> Réduire</span></p>';
                                }
                                
                            }
                ?>
            </div>
            <? }?>
        </div>    
        
        <div class="list-icon">
            
            <?
                       //     var_dump($theEntry->photosArray['icon'][0]);exit;
                            
                if(isset($theEntry->photosArray['icon'])){
                    $cnt = 0;
                    foreach ($theEntry->photosArray['icon'] as $v) {
                        $cnt++;
                        ?>
             <div class="item item-<?= $cnt ?>">
                <div class="img"><img data-src="<?= $v->image ?>"></div>
                <div class="text">
                    <p class="one"><?= isset(explode('|', $v->model->caption)[0]) ? explode('|', $v->model->caption)[0] : '' ?></p>
                    <p class="two"><?= isset(explode('|', $v->model->caption)[1]) ? explode('|', $v->model->caption)[1] : '' ?></p>
                </div>
            </div>
            <?
                    }
                    
                }            
            ?>
            
<!--            <div class="item item-1">
                <div class="img"><img data-src="<?= DIR.'assets/img/landing-page/icon-reponsable.png' ?>"></div>
                <div class="text">
                    <p class="one">Reponsable</p>
                    <p class="two">De l’humain dans le voyage</p>
                </div>
            </div>
            <div class="item item-3">
                <div class="img"><img data-src="<?= DIR.'assets/img/landing-page/icon-2.png' ?>"></div>
                <div class="text">
                    <p class="one">L’experience</p>
                    <p class="two">Enrichissante et émouvante</p>
                </div>
            </div>
            <div class="item item-3">
                <div class="img"><img data-src="<?= DIR.'assets/img/landing-page/icon-3.png' ?>"></div>
                <div class="text">
                    <p class="one">Activités</p>
                    <p class="two">En lien avec les spécificités locales</p>
                </div>
            </div>-->
        </div>
    </div>
</div>

<div class="contain ld-container-6 ld-entry-content mb-60">
    <div class="column amc-column">
        <div class="it-left">
            
            <?
                            //var_dump($theEntry->photosArray['summary'][0]);exit;
            ?>
            <img data-src="<?= isset($theEntry->photosArray['summary']) ? $theEntry->photosArray['summary'][0]->image : ''?>">
        </div>
        <div class="it-right">
            <div class="text">
                <?
                    if(isset($theEntry->data->block4)){
                        echo $theEntry->data->block4;
                    }
                ?>
                
<!--                <p class="tt-1">Le pays du dragon est une source inépuisable de prétextes d’un voyage au Vietnam.</p>
                <p class="tt-2 m-0">HA Duc Manh - CEO Amica Travel</p>    -->
            </div>
        </div>
    </div>
</div>

<div class="contain ld-container-7  fluid-testi">
    <div class="amc-column row container ld-entry-content mb-60">
        <div class="it-left col-12 col-sm-12 col-lg-4 pr-25 pl-0">
            
            <?
                    if(isset($theEntry->data->block5)){
                        echo str_replace('<h2', '<h2 class="amc-fix-mb-40"', $theEntry->data->block5);
                    }
                ?>
<!--            <h2 class="tt">Ils nous ont fait confiance</h2>
            <div class="text-col-left"><?//=$portrain->parents(1)->summary; ?></div>-->
        </div>
        <div class="it-right col-12 col-sm-12 col-lg-8 p-0 position-relative fix-mt-40-respnsive">
             <!-- Slider main container -->
            <div class="area-slider-swiper">    
                <div class="swiper-container custom-slides-swiper-testi custom-slides-swiper-3-item">
                    <div class="swiper-wrapper testi-bxslider row-content">

                    <? $i = 0; foreach ($arrTemoignages as $k => $v) { $i++;?>


                    <div class="swiper-slide item text-left px-40">
                        <p class="summary mt-40 mb-2">“<?=$v['summary']; ?>” </p>
                        <div class="detail text-center d-flex justify-content-center align-items-center mb-40">

                            <img class=" mr-2" alt="" data-src="/assets/img/tour/client-df.png">

                            <div class="text d-inline-block text-left">

                                <p class="client my-0"><?= isset($v['data']->nameclient) ? $v['data']->nameclient : ''?></p>
                                <p class="my-0"><?//=date('M Y',$v['time']) ?>
                                    <?=ucfirst(Yii::$app->formatter->asDate($v['time'], 'php:F Y'))?>
                                </p>

                            </div>
                        </div>
                    </div>

                    <? } ?>    


                    </div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev swiper-button-prev-testi" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="testimonies_section" data-analytics-label="control_left"></div>
                <div class="swiper-button-next swiper-button-next-testi" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="testimonies_section" data-analytics-label="control_right"></div>  
                <div class="swiper-pagination swiper-pagination-testi"></div>
            </div>    
        </div>
    </div>
    <div class="column amc-column mb-60">
        <div class="mt-0 p-0">
            <div class="logo-pages row  no-gutters d-flex align-items-center m-0">
                <div class="col-12 col-sm-4 col-lg-3 mb-sm-0 mb-lg-0">
                <span>Ils nous ont recommandé</span>
                </div>
                <div class="logos col-12 col-sm-8 col-lg-8 d-flex justify-content-between">
                    <span class="trip"><img alt="Tripadvisor" class="img-lazy" data-src="/assets/img/new-home/trip-logo-new-2019.png"></span>
                    <span class="trip"><img alt="Petit Futé "  class="img-lazy" data-src="/assets/img/new-home/petit-fute-new-2019.png"></span>
                    <span href="#" class="trip"><img alt="Le Routard "  class="img-lazy" data-src="/assets/img/new-home/routard-logo-new-2019.png"></span>
                    <span class="trip"><img alt="Lonely Planet "  class="img-lazy" data-src="/assets/img/new-home/lonely-planet-new-2019.png"></span>
                </div>
            </div>
        </div>
        
    </div>
</div>


<div class="contain ld-container-8 bg-f7 ld-entry-content pb-40" style="padding-top: 38px !important;">
    <div class="column amc-column">
        <div class="ld-content mb-txt-40">
            
             <?
                    if(isset($theEntry->data->block6)){
                        echo str_replace('<h2', '<h2 class="amc-fix-mb-40"', $theEntry->data->block6);
                    }
                ?>
            
<!--            <h2>Nos idéel de voyage incontournable</h2>
            <p>Thong Nong, demandez à séjourner dans ces coins reculés d’exception, où le pouls bat lentement, au rythme de la vie quotidienne locale. Il est si bon parfois de déconnecter les esprits, des flux parfois tempétueux de la mondialisation.</p>
       -->
        </div>
        <div class="load-ajax">
        <div class="getajax">
            <div class="area-slider-swiper area-slider-swiper-3-item ">    
                <div class="swiper-container custom-slides-swiper custom-slides-swiper-3-item custom-slides-swiper-tour-voyage">

                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper custom-bxslider fix-block">
                        <!-- Slides -->
                        <? 
                        $cnt = 0;
                        foreach ($theEntries as $key => $v) {
                            $cnt++;
                            if($cnt % 3 == 1){
                                echo '<div class="clear-fix">';
                            }
                            ?>
                            <div class="swiper-slide img-zoom-span item text-left">
                                <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                                    <div class="img topopup" class="col-auto col-sm-auto col-lg-12">

                                        <? if(isset($v->photosArray['summary'])) : ?>
                                        <img alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/299/200/1/100<?=$v->photosArray['summary'][0]->image ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?= $v->model->item_id ?>">
                                        <? endif; ?>

                                    </div>
                                </span>
                                <div class="text pl-15 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block amc-fix-pb-25-0">
                                    <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                                    <p class="tt tt-1 m-0 p-0 amc-fix-mt-25 topopup " name="pop-<?=$key+1 ?>">
                                        <a href="/<?=$v->slug?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $v->model->item_id ?>"><?=$v->title;?></a>
                                    </p>
                                    <p class="sub-title m-0 p-0 amc-fix-mt-20"><?=\app\helpers\Text::limit_text($v->model->summary, 100); ?></p>
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
                            </div>
                        <?
                            if($cnt % 3 == 0 || $cnt == count($theEntries)){
                                echo '</div>';
                            }
                        ?>

                        <? } ?>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination swiper-pagination-tour-voyage"></div>
                <!-- If we need navigation buttons -->
    <!--            <div class="swiper-button-prev swiper-button-prev-tour-voyage"></div>
                <div class="swiper-button-next swiper-button-next-tour-voyage"></div>   -->
            </div>

            <div style="text-align: center;" class="d-block w-100">
            <a href="/voyage/itineraire" class="ld-btn-custom btn-amica-basic-3 btn-amica-basic mx-auto mt-txt-20" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="tours_section" data-analytics-label="cta_tours">Tous nos circuits au Vietnam (<?= $totalCount ?>)</a>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="contain container-button-contact">
    <div class="amc-column">
        <div class="d-block devis-btn-block mt-60 mb-txt-60 container-fluid d-flex justify-content-around align-items-center py-20">
            <div class="text text-center">
                Un circuit au Vietnam vous intéresserait ?
                <span class="tt-fontsize-20">Sur mesure, avec guide et chauffeur privés.</span>
            </div>
            <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;" src="/assets/img/page2016/hot_gon_thao_100_100.jpg">
            <button data-title="L2Rldmlz" class="btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</button>
        </div>
        
    </div>
</div>
<? if(isset($theEntry->data->condition) && $theEntry->data->condition != ''){ ?>
<div class="contain ld-container-9 mb-txt-60">
    <div class="amc-column">
        <?= $theEntry->data->condition ?>
    </div>
</div>   
<? } ?>  
<?
$uri = DIR.URI;
$jss=<<<JS
$(document).on('click', '.amc-btn-control-text.see-more', function(){        
   // $(this).parent().parent().hide();
    $(this).parent().parent().parent().children('.fullstring-text').show();  
    $(this).parent().children('.dot-more').hide();      
    $(this).parent().children('.last-character').show();    
    $(this).hide();
});   
//$('.amc-btn-control-text.less-text').click(function(){
$(document).on('click', '.amc-btn-control-text.less-text', function(){          
    $(this).parent().parent().hide();
    $(this).parent().parent().parent().children('.substring-text').children('p').children('.see-more').show();
    $(this).parent().parent().parent().children('.substring-text').children('p').children('.dot-more').show();   
    $(this).parent().parent().parent().children('.substring-text').children('p').children('.last-character').hide();       
});      
        
var swiper = new Swiper('.custom-slides-swiper-testi', {
      slidesPerView: 1,
        
        paginationClickable: true,
        spaceBetween: 0,
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next-testi', // use version 4.x.x
            prevEl: '.swiper-button-prev-testi', //use version 4.x.x
          },
        pagination: {
            el: '.swiper-pagination-testi', // use version 4.x.x
            clickable: true, // use version 4.x.x
        },
    });   
        
$(window).bind('load resize', function(){
  //  console.log('ok');
    //    console.log($(window).width());
        
    if($(window).width() <= 980){    
        
        var hClass = $('.custom-bxslider').hasClass('fix-block');
        if(hClass){
            $('.fix-block .item').unwrap();
            $('.custom-bxslider').removeClass('fix-block');

            var swiper = new Swiper('.custom-slides-swiper-tour-voyage', {
              slidesPerView: 3,
                slidesPerGroup: 3,
                paginationClickable: true,
                spaceBetween: 20,
                loop: false,     
                navigation: {
                    nextEl: '.swiper-button-next-tour-voyage',
                    prevEl: '.swiper-button-prev-tour-voyage',
                  },
                pagination: {
                    el: '.swiper-pagination-tour-voyage',
                    clickable: true,
                },
                breakpoints: {
                    960: {
                      slidesPerView: 2.3,
                      slidesPerGroup: 2,
                    }
                  }
            }); 
        }
     }else{
        var hClass = $('.custom-bxslider').hasClass('fix-block');
        if(!hClass){
        $('.custom-bxslider').addClass('fix-block');
            $.ajax({
                    type: 'post',
                    url: '$uri',
                    data: {
                        flag: 'ok'
                    },
                    dataType: 'html',
                    success: function(data) {
                         var gettour = $($.parseHTML(data)).find(".getajax"); 
                        $('.load-ajax').html(gettour);

                    }

                });
        }
     }   
});        
        
JS;
$this->registerJs($jss);
?>