<?
    use yii\helpers\ArrayHelper;
?>

<?php $this->registerCssFile(DIR . 'assets/css/page2016/fix-banner-top.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR . 'assets/js/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/nos-destinations-country-ideel.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php
$iconBanner = $iconCaption = $limitWidth = '';
?>
<div class="contain container-1">
    <? if (isset($theEntry->model->photos)) : ?>
        <?
        $banner = '';
        foreach ($theEntry->model->photos as $key => $value) {
            if ($value->type == 'banner')
                $banner = $value;
        }
        ?>
        <img style="width: 100%;" alt="<?= $banner->description; ?>" class="img-lazy" data-src='<?= $banner->image ?>'>
    <? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    <div class="amc-column row-2 mb-0">
        <? if($theEntry->model->seo != NULL){?>
            <h1 class="title m-0 amc-fix-mb-40-0"><?= $theEntry->model->seo->h1 ?></h1>
        <? } ?>
    </div>
</div>
<div class="container-2 amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="amc-column column">
            <ul>
                <li  class="<?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="submenu_section" data-analytics-label="link_country"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>
<div class="contain container-3">

    <div class="amc-column">
        <div class="text-summary mt-40 pt-0 mb-txt-40">
            
                <?= $theEntry->model->content; ?>
            
        </div>
    </div>
</div>


<!-- when responsive tablet , include filter responsive -->
<? include '_inc_responsive_filter_recherche_itineraire.php' ?>
<!-- End -->


<div class="contain container-4 container-filter fix-space-vs-back-button">
    <div class="amc-column amc-column-fixpadding">
        <div class="rows row-1 mt-0">
            <!-- Col 2 -->
            <div class="amc-col amc-col-2 <?=SEG1?> mr-10 d-none d-sm-none d-lg-block">
                <?php include '_inc_filter_recherche_itineraire.php'; ?>
                <div class="area-1 fix-area mt-25 mb-0">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;"></li>
                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                    </ul>
                    <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-contact btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</span>
                </div>
               

            </div>
            <!-- end col 2 -->

            <div class="amc-col amc-col-1 ajaxfilter ml-5">
                <div id="programes-load" class="getcontent">
                    
                        <?
                        
                            if(Yii::$app->request->get('region') == NULL){
                                $region = 'all';
                            }else{
                                $region = Yii::$app->request->get('region');
                            }
                        
                            if(Yii::$app->request->get('country') == NULL){
                            $country = SEG1;
                            }else{
                            $country = Yii::$app->request->get('country');
                            }
                            if(Yii::$app->request->get('length') == NULL){
                            $length = 'all';
                            }else{
                            $length = Yii::$app->request->get('length');
                            }
                            if(Yii::$app->request->get('type') == NULL){
                            $type = 'all';
                            }else{
                            $type = Yii::$app->request->get('type');
                            }

                            if (Yii::$app->request->get('see-more') == NULL) {
                                if (Yii::$app->request->get('page') != NULL) {
                                    $seemore = Yii::$app->request->get('page') * 12;
                                }else{
                                    $seemore = 12;
                                }

                            } else {
                                $seemore = Yii::$app->request->get('see-more');
                            }
                            if (Yii::$app->request->get('page') == NULL) {
                                $page = $seemore / 12;
                            } else {
                                $page = Yii::$app->request->get('page');
                            }
                            
                            if (Yii::$app->request->get('before-page') == NULL) {
                                $page = $seemore / 12;
                            } else {
                                $page = Yii::$app->request->get('before-page');
                            }
                            
                            if(Yii::$app->request->get('orderby') == NULL){
                                $orderby = 'def';
                            }else{
                                $orderby = Yii::$app->request->get('orderby');
                            }
                            $amc_text_opt = [
                                'def' => 'Popularité',
                                'newest-date' => 'Dernières nouveautés',
                                'budget-asc' => 'Prix : par ordre croissant',
                                'budget-desc' => 'Prix : par ordre décroissant',
                                'day-asc' => 'Durée : par ordre croissant',
                                'day-desc' => 'Durée : par ordre décroissant',
                            ];
                        ?>
                    <div class="amc-row-order-by">    
                        <span class="amc-text-title-filter">Trier par :</span>
                        <div class="amc-opt-filter amc-ajax-order-by">
                            <span class="amc-text" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_sortby"><?= Yii::$app->request->get('orderby') == Null ? 'Popularité' : $amc_text_opt[Yii::$app->request->get('orderby')] ?></span>
                            <ul class="amc-list-opt">
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_def" data-opt="def" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'def' ? 'active' : '' ?>">Popularité</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_newest" data-opt="newest-date" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'newest-date' ? 'active' : '' ?>">Dernières nouveautés</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_price_asc" data-opt="budget-asc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'budget-asc' ? 'active' : '' ?>">Prix : par ordre croissant</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_price_desc" data-opt="budget-desc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'budget-desc' ? 'active' : '' ?>">Prix : par ordre décroissant</li>
                                
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_asc" data-opt="day-asc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'day-asc' ? 'active' : '' ?>">Durée : par ordre croissant</li>
                                <li data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="sortby_section" data-analytics-label="select_desc" data-opt="day-desc" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region ?>" class="<?= Yii::$app->request->get('orderby') == 'day-desc' ? 'active' : '' ?>">Durée : par ordre décroissant</li>
                            </ul>
                        </div>
                    </div>
                    <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                    <div class="text-center see-more-prev mb-40 mt-0">
                        <span class="btn-submit ajax-see-more-prev btn-amica-basic btn-amica-basic-1" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='<?= count($theEntries) ?>' data-page="<?= $page - 1 ?>">Circuits précédents</span>
                    </div>
                    <? } ?>
                    <?
                            $category_destination_itineraire =  \app\modules\destinations\api\Catalog::cat(SEG1.'/itineraire');
                            //var_dump($category_destination_formules->model->category_id);exit;
                            $items_destination_itineraire = \app\modules\destinations\api\Catalog::items([
                                     //  'orderBy' => ['order_num'=> SORT_ASC, 'time' => SORT_DESC],
                                       'where' => ['category_id'=>$category_destination_itineraire->model->category_id],
                                       //'filters' => $fil_countries,
                                      // 'pagination' => ['pageSize' => 0]
                                   ]);
                             
                            $arr_category_programmes = [];
                            foreach ($items_destination_itineraire as $value) {
                               
                                $exp_slug = explode('/', $value->slug);
                                $valArr = \app\modules\programmes\api\Catalog::cat('voyage/' . $exp_slug[2]);
                                if($valArr)
                                $arr_category_programmes[] = $valArr;
                            }
                            $start_page = 0;
                             if (Yii::$app->request->get('see-more') == NULL) {
                                if (Yii::$app->request->get('page') != NULL) {
                                    $seemore = Yii::$app->request->get('page') * 12;
                                    $start_page = $seemore - 12;
                                }else{
                                    $seemore = 12;
                                }
                               // $seemore = 12;
                            } else {
                                $seemore = Yii::$app->request->get('see-more');
                            }
                            
                            if(Yii::$app->request->get('orderby') !== NULL){
            
                                if(Yii::$app->request->get('orderby') == 'newest-date'){
                                   $flag = TRUE;
                                }else if(Yii::$app->request->get('orderby') == 'day-asc'){
                                    $flag = TRUE;
                                }else if(Yii::$app->request->get('orderby') == 'day-desc'){
                                     $flag = TRUE;
                                }
                                else if(Yii::$app->request->get('orderby') == 'budget-asc'){
                                    $flag = TRUE;
                                }else if(Yii::$app->request->get('orderby') == 'budget-desc'){
                                     $flag = TRUE;
                                }else{
                                    $flag = FALSE;
                                }
                            }else{
                                $flag = FALSE;
                            }
                            
                       ?>
                    
                    <? if($flag == FALSE){ ?>
                    
                    <?php
                        
                    $cnt = 0;
                    if(count($theEntries) <= $seemore){
                        $count = count($theEntries);
                    }else{
                        $count = $seemore;
                    }
                    if($totalCount == 13 || $totalCount == 14){
                        $count = $totalCount;
                    }
                    foreach ($arr_category_programmes as $value_progammes){
                    
                    if(empty($theEntries)){
                            echo '<p class="text-center">Aucune offre n\'est disponible pour le moment</p>';
                            break;
                        }    
                    foreach ($theEntries as $v) {
                       // var_dump($v->parents()[0]->title);exit;
                         if($v->category_id == $value_progammes->model->category_id ){
                        $cnt ++;
                        if($cnt > $start_page && $cnt <= $count){
                        ?>
                        <?php
                        if($cnt % 2 != 0){
                           if(count($theEntries) > $cnt){
                                   $clas = 'mb-txt-40';
                                    
                            }if(count($theEntries) - 1 > $cnt || count($theEntries) - 2 > $cnt){
                                    $clas = 'mb-txt-40';
                            }else{
                                $clas = Null;
                            }
                            echo '<div class="clear-fix '.$clas.'">';
                        }
                        
                       
                        ?>
                        <div id="<?= $cnt ?>" class="item item-<?= $cnt ?> <?= $cnt % 2 != 0 ? 'it-l ml-0' : 'it-r mr-0' ?>">
                            
                            <a href="<?=DIR.$v->slug?>">
                                <div class="amc-image" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="list_section" data-analytics-label="itinerary_card_<?= $v->model->item_id ?>">
                                <?
                                $hasSummary = false;
                                if(isset($v->photos)) {
                                    foreach ($v->photos as $kp => $vp) {
                                        if($vp->model->type == 'summary'){
                                            echo '<img style="min-height: 219px;" alt="'.$vp->description.'" class="lazytest img-responsive" data-src="'.$vp->image.'"/>';
                                            $hasSummary = true;
                                            break;
                                        }
                                    }
                                } ?>
                                <? if(!$hasSummary) : ?>
                                    <img alt="" class="img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                <? endif; ?>
                                </div>   
                            </a>    
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0">
                                <?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                            <p class="tt m-0 p-0 amc-fix-mt-25" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="list_section" data-analytics-label="itinerary_card_t_<?= $v->model->item_id ?>">
                                <a href="<?=DIR.$v->slug?>"><?= str_replace('|','',$v->title) ?></a>
                            </p>
                            <p class="sub-tt amc-fix-mt-12 p-0 m-0"><?=$v->model->sub_title?></p>
                           
                            <div class="summary m-0 p-0 amc-fix-mt-20">
                                 <p><?= $v->model->summary ?></p>
                                
                            </div>
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
<!--                            <ul class="amc-fix-mt-25">
                                <?//php
                               // $value = $v;
                               // $limitWidth = 'limitWidth-51';
                                ?>
                                <?//php if(isset($value->data->countries)){?>
                                    <li class="posi">
                                        <p class="posi-title">
                                            <img data-src="/assets/img/page2016/posi.png" alt="">
                                            <?//=ucwords(implode(', ', $value->data->countries)) ?>
                                        </p>
                                    </li>
                                <?//php }?>


                                <?//php if($v->model->days != ''){ $limitWidth = 'limitWidth-41'; ?>
                                    <li class="calendar">
                                        <p class="calendar-title">
                                            <img data-src="/assets/img/page2016/icon_time.png" alt="">
                                            <?//= $value->model->days?> jours <br /><?//= $value->model->nights?> nuits
                                        </p>
                                    </li>
                                <?//php } ?>
                                Tony - get tour type
                                <?//php
//                                    $data = $value->parents();
//                                    $last = end($data);
//                                    foreach ($last->photos as $value2) {
//                                        if($value2['type'] == 'icon-banner'){
//                                            $iconBanner = $value2['image'];
//                                            $iconCaption = $value2['caption'];
//                                        }
//                                    }
                                ?>
                                <li class="type-de-voyage <?//php echo $limitWidth; ?>">
                                    <p class="type-de-voyage-title">
                                        <img data-src="<?//php echo $iconBanner; ?>" alt="">
                                        <span style="float: right; padding-left: 7px;"><?//= $iconCaption; ?></span>
                                    </p>
                                </li>
                            </ul>-->
                        </div>
                         
                        <?php
                        if ($cnt % 2 == 0) {
                            echo '</div>';
//                            if($count > $cnt){
//                                echo '<span class="space space-40"></span>';
//                            }
                        }
                        if ($cnt % 2 != 0 && $cnt == $count) {
                            echo '</div>';
//                            if($count - 1 > $cnt){
//                                echo '<span class="space space-40"></span>';
//                            }
                        }
                        ?>
                    <? }} ?>   
                    
                    <?php }} ?>
                    
                    <? }else{ ?>
                    
                    
                    <?php
                    $cnt = 0;
                    if(count($theEntries) <= $seemore){
                        $count = count($theEntries);
                    }else{
                        $count = $seemore;
                    }
                    if($totalCount == 13 || $totalCount == 14){
                        $count = $totalCount;
                    }
                       
                    foreach ($theEntries as $v) {
                        if(empty($theEntries)){
                            echo '<p class="text-center">Aucune offre n\'est disponible pour le moment</p>';
                            break;
                        }
                        $cnt ++;
                        if($cnt <= $count){
                        ?>
                        <?php
                        if($cnt % 2 != 0){
                           if(count($theEntries) > $cnt){
                                   $clas = 'mb-txt-40';
                                    
                            }if(count($theEntries) - 1 > $cnt || count($theEntries) - 2 > $cnt){
                                    $clas = 'mb-txt-40';
                            }else{
                                $clas = Null;
                            }
                            echo '<div class="clear-fix '.$clas.'">';
                        }
                        
                       
                        ?>
                        <div id="<?= $cnt ?>" class="item item-<?= $cnt ?> <?= $cnt % 2 != 0 ? 'it-l ml-0' : 'it-r mr-0' ?>">
                            
                            <a href="<?=DIR.$v->slug?>">
                                <div class="amc-image" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="list_section" data-analytics-label="itinerary_card_<?= $v->model->item_id ?>">
                                <?
                                $hasSummary = false;
                                if(isset($v->photos)) {
                                    foreach ($v->photos as $kp => $vp) {
                                        if($vp->model->type == 'summary'){
                                            echo '<img style="min-height: 219px;" alt="'.$vp->description.'" class="lazytest img-responsive" data-src="'.$vp->image.'"/>';
                                            $hasSummary = true;
                                            break;
                                        }
                                    }
                                } ?>
                                <? if(!$hasSummary) : ?>
                                    <img alt="" class="img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                <? endif; ?>
                                </div>   
                            </a>    
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0">
                                <?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                            <p class="tt m-0 p-0 amc-fix-mt-25" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="list_section" data-analytics-label="itinerary_card_t_<?= $v->model->item_id ?>">
                                <a href="<?=DIR.$v->slug?>"><?= str_replace('|','',$v->title) ?></a>
                            </p>
                            <p class="sub-tt amc-fix-mt-12 p-0 m-0"><?=$v->model->sub_title?></p>
                           
                            <div class="summary m-0 p-0 amc-fix-mt-20">
                                 <p><?= $v->model->summary ?></p>
                                
                            </div>
                            
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
                         
                        <?php
                        if ($cnt % 2 == 0) {
                            echo '</div>';
//                            if($count > $cnt){
//                                echo '<span class="space space-40"></span>';
//                            }
                        }
                        if ($cnt % 2 != 0 && $cnt == $count) {
                            echo '</div>';
//                            if($count - 1 > $cnt){
//                                echo '<span class="space space-40"></span>';
//                            }
                        }
                        ?>
                    <? } ?>   
                    <?php } ?>
                    
                    
                    <? } ?>
                    
                    <!--
                    <?// if (!Yii::$app->request->isAjax || Yii::$app->request->get('page') !== NULL) { ?>
                        <div class="pagination-prog">
                            <?
                    // $pagi = new \yii\data\Pagination(['totalCount' => $totalCount, 'defaultPageSize' => 8]);
                    // echo \yii\widgets\LinkPager::widget([
                    //     'pagination' => $pagi,
                    //  ]);
                    ?>
                            <?// if ($pagi->pageCount > 1) : ?>
                                <a class="<?//= Yii::$app->request->get('view') == 'all' ? 'active' : '' ?>view-all-link" href="<?//= DIR . URI ?>?view=all">Voir tout</a>
                            <?// endif; ?>
                        </div>
                    <?// }else { ?>
                    -->
                    
                    <?    
                    if($totalCount == 13 || $totalCount == 14){
                        $seemore = $totalCount;
                    } 
                    if ($totalCount > $seemore && ($totalCount / 12) > $page) {
                    ?>
                    <div class="amc-area-detaile-number-items <?= $clas == Null ? 'mt-txt-40' : 'mt-0' ?>">
                        <div>
                            <? if($totalCount < 2){ ?>
                                <span class="amc-text">Vous avez vu le seul circuit <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
                            <? }else{ ?>
                                <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> circuits sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
                            <? } ?>
                            <div class="amc-area-prog-btn">
                                <div>
                                    <div class="amc-progress mt-txt-25" <?= ($totalCount > $seemore && ($totalCount / 12) > $page) ? '' : 'style="width: 175px;"' ?>>
                                        <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
                                    </div>
                               
                                     <div class="see-more mt-25">
                                        <span class="btn-submit ajax-see-more btn-amica-basic btn-amica-basic-1" data-get="<?= 'country=' . $country . '&type=' . $type . '&length=' . $length . '&region=' . $region . '&orderby=' . $orderby ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='<?= count($theEntries) ?>' data-page="<?= $page + 1 ?>" data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="list_section" data-analytics-label="cta_more">Plus de circuits</span>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                    <?// } ?>

                </div>
            </div>
             <? if($this->context->seoContent != NULL) : ?>
            <div id="text-content" class="iti p-0 mr-xl-2 mr-lg-2 mr-sm-0 mb-60 entry-content">
                    <span class="tt tt-seo <?=SEG2?> p-0">En savoir plus sur "<?= $theEntry->model->seo->h1 ?>"</span>
                    <div><?=$this->context->seoContent;?></div>
            </div>
            <? endif; ?>
        </div>
    </div>
</div>
<div class="contain mb-0 pt-25 pb-25 mt-0 responsive-area-devis-col-left d-none d-lg-none d-sm-block">
    <div class="amc-column column">
        <div class="item item-1">
            <span class="tt tt-1">Besoin de conseil d’un expert ?</span>
            <span class="tt tt-2">Notre conseiller(ère) vous répondra sous 48H</span>
        </div>
        <div class="item item-2">
            <img alt="" class="img-lazy lazyload" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
        </div>
        <div class="item item-3">
            <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-amica-basic btn-amica-basic-2">Demander un devis</span>
        </div>
    </div>
</div>


<!-- BACK BUTTON -->
<?// include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
<?php
$url = DIR . URI;
$js = <<<JS
//function fixContent(){
//    $('.clear-fix').each(function(index) {
//        var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
//        var subttleft = $(this).children('.it-l').children('a').children('.sub-tt').outerHeight();
//
//        var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
//        var subttright = $(this).children('.it-r').children('a').children('.sub-tt').outerHeight();
//        if (htleft > htright){
//            $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
//        }  
//        if (htright > htleft){
//            $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
//        }
//
//        if (subttleft > subttright){
//            $(this).children('.it-r').children('a').children('.sub-tt').css('min-height', subttleft);
//        }  
//        if (subttright > subttleft){
//            $(this).children('.it-l').children('a').children('.sub-tt').css('min-height', subttright);
//        }
//
//
//        // fix height summary
//
//        var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
//        var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
//
//        if (summaryleft > summaryright){
//            $(this).children('.it-r').children('.summary').css('min-height', summaryleft);
//        }  
//         if (summaryright > summaryleft){
//            $(this).children('.it-l').children('.summary').css('min-height', summaryright);
//        }       
//  });
//}	  
//
//$(window).bind("load", function() { 
//       fixContent(); 
//});
        
// JS Load page phan trang        

    $(document).on("click",".pagination-prog .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $('html, body').animate({scrollTop: $('.getcontent').offset().top - 200}, 1000);
        $.post(url, { pagi: 'prog' }, function(data){ 
           //$('#programes-load').html(data);
		   
			var datanew = $($.parseHTML(data)).find(".getcontent"); 
			$('.ajaxfilter').html(datanew);
			
           // fixContent(); 
            return false;

        });
        return false;
     });

        
// End load page phan trang

JS;
$this->registerJs($js, yii\web\View::POS_END);
?>