<?php $this->registerCssFile(DIR . 'assets/plugins/leaflet/leaflet.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/plugins/leaflet/mapbox-gl.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/plugins/leaflet/leaflet.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/plugins/leaflet/mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/plugins/leaflet/leaflet-mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>


<?php $this->registerCssFile(DIR . 'assets/css/page2016/nos-destinations-detaile.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/fix-banner-top.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR . 'assets/js/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?
//var_dump($this->context->entry->parents()[1]);exit;
use yii\helpers\ArrayHelper; ?>
<!-- Pages /vietnam/hanoi -->
<div class="contain container-1">
    <?
    $hasBanner = false;
    foreach ($theEntry->photos as $kp => $vp) {
        if ($vp->type == 'banner') {
            echo '<img alt="' . $vp->description . '" class="img-lazy img-banner" data-src="' . $vp->image . '"/>';
            $hasBanner = true;
            break;
        }
    }
    ?>
    <? if (!$hasBanner) : ?>
        <img alt="" style="width: 100%;" class="img-lazy img-banner" data-src='<?= DIR ?>upload/image/banner-thongnong.jpg'>
<? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   

    <div class="amc-column row-2 mb-0">

        <h1 class="tt tt-40 tt-color-white tt-latolatin-bold fix-align-center tt-custom tt-responsive m-0"><?=$this->context->pageT ?></h1>
        <ul class="list-envies mt-txt-25 mb-25">
            <?
            //$envies = [];
            foreach ($theEntry->data->envies as $key => $value) {
                //var_dump($value);exit;
                $envies = \app\modules\destinations\api\Catalog::items([
                    'where' => ['item_id' => $value],
                ]);
                $img_icon = [
                    'uri' => NULL,
                    'alt' => NULL,
                    'caption' => NULL,
                ];
                if($envies){
                foreach ($envies[0]->photos as $image) {
                    if($image->model->type == 'icon'){
                        $img_icon = [
                            'uri' => $image->model->image,
                            'alt' => $image->model->description,
                            'caption' => $image->model->caption,
                        ];
                    }
                }
                //var_dump($envies->photos[0]->model);exit;
            ?>
            <li class="tt tt-latolatin-regular"><span data-analytics="on" data-analytics-category="city_single" data-analytics-action="tags_section" data-analytics-label="envy_tag_<?= $envies[0]->model->item_id ?>"><img alt="<?=$img_icon['alt'] ?>" data-src="<?=$img_icon['uri']?>"><a class="tt-hover-color-e65925" href="<?= DIR.$envies[0]->slug?>"><?= $envies[0]->title ?></a></span></li>
            
            <?
            }
            }
           
            ?>
             
<?//= implode(', ', $envies) ?></ul>
       
    </div>

</div>
<div class="amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="amc-column column">
            <ul>
                <li  class="<?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_country"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' || Yii::$app->controller->action->id == 'nos-destinations-detaile' ? 'active' : '' ?> <?= $this->context->entry->parents()[count($this->context->entry->parents()) - 1]->slug == SEG1.'/visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>
<div class="contain container-2 non-area-form">

    <div class="amc-column">
        <div class="rows row-2 mt-40 pt-0">
            <div class="amc-col amc-col-1">
                <div class="detail detail-1">

                    <div class="text entry-body p-0">
                        <?= preg_replace('/<!--(.|\s)*?-->/', '', $theEntry->description); ?>
                    </div>   
                </div>
                <? $galeriesBf =  $theEntry->photos;
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
                <?php
                     if($galeries){
                 ?>
                    <div class="collection-image mt-txt-20 pt-10">
                         
                        <div class="col-left m-0">
                         
                            <a data-thumb="0" href="#galeries-photos" class="fancybox-thumbs m-0" data-analytics="on" data-analytics-category="city_single" data-analytics-action="picture_section" data-analytics-label="pix_1">
                                <img alt="<?= $galeries[0]->description?>" class="img-lazy img-responsive" data-src="<?=DIR?>thumb/318/483/1/80<?= $galeries[0]->image?>">
                                <span class="caption"><?= $galeries[0]->model->caption?></span>
                            </a>
                    </div>
                                
                    <div class="col-right m-0 ml-25">
                                <a data-thumb="1" href="#galeries-photos" class="fancybox-thumbs m-0 mb-25" data-analytics="on" data-analytics-category="city_single" data-analytics-action="picture_section" data-analytics-label="pix_2">
                                    <img alt="<?= $galeries[1]->description?>" class="img-lazy img-responsive mb-0" data-src="<?=DIR?>thumb/335/229/1/80<?= $galeries[1]->image?>">
                                    <span class="caption"><?= $galeries[1]->model->caption?></span>
                                </a>
                                 <a data-thumb="2" href="#galeries-photos" class="fancybox-thumbs m-0" data-analytics="on" data-analytics-category="city_single" data-analytics-action="picture_section" data-analytics-label="pix_2">
                                    <img alt="<?= $galeries[2]->description?>" class="img-lazy img-responsive" data-src="<?=DIR?>thumb/335/229/1/80<?= $galeries[2]->image?>">
                                    <span class="caption"><?= $galeries[2]->model->caption?></span>
                                </a>
                    </div>
                    
                        <a class="show-album fancybox-thumbs mt-25 mb-0 mr-0 btn-amica-basic btn-amica-basic-1" data-thumb="3" data-fancybox="#galeries-photos" href="#galeries-photos" data-analytics="on" data-analytics-category="city_single" data-analytics-action="picture_section" data-analytics-label="cta_more">Plus de photos</a>
                    <div id="galeries-photos" style="display: none;" class="colllection-image">
                        <? include('_inc_galeries.php') ?>
                    </div>   
                        
                    </div> 
                    <?php } ?>  
                    
                
                
                    
                     <? 
                  //var_dump($theEntry);exit;
                     if ($theEntry->data->location) { ?>
                     <? $exclusives = $theProgram = \app\modules\programmes\api\Catalog::items(['filters' => ['locations' => $theEntry->data->location[0]],'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],'pagination' => ['pageSize' => 3]]); ?>
                   
                    <? if($exclusives != NULL){?>  
                 <?php
                     //   var_dump($exclusives);exit;
                    ?> 
				<div class="extensions">
                                
                    <div class="exclu-secret">
                    <? if ($exclusives) { ?>
                        <div class="area-2">
                            <h2 class="tt mt-60 p-0 mb-txt-40">Les idées de voyage incluant "<span><?= $theEntry->title?></span>"</h2>
                            <div class="bx-controls-slider-right">
                            </div>
                            <div class="slider-right">


                                <? foreach ($exclusives as $key => $value) : ?>
                                <div class="slide mt-0">
                                        <a href="<?= DIR . $value->slug ?>" class="topopup" name="pop-<?= $key + 1 ?>">
                                            <?
                                            $hasSummary = false;
                                            if (isset($value->photos)) {
                                                foreach ($value->photos as $kp => $vp) {
                                                    if ($vp->type == 'summary') {
                                                        echo '<img height="" alt="' . $vp->description . '" class="img-lazy" data-src="' . DIR . 'thumb/211/141/1/80' . $vp->image . '"/>';
                                                        $hasSummary = true;
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>
                            
                                                <h3 class="title pt-0 pb-0 mt-25 mb-txt-25"><?= str_replace('|','',$value->title); ?></h3>

                                            <p class="sub-title m-0" style="display: none;"><?//= $value->model->sub_title ?></p>
                                        </a>
<!--                                        <div class="summary">
                                        <?//= $value->model->summary ?>
                                        </div>-->
                                </div>
                            <? endforeach; ?>

                            </div>
                        </div>
                     </div>   
                    </div>
                <div class="hr">
                    <hr>
                </div>	
        <? } ?>
    <? }else if($exclusives == NULL){ ?>  
                 <?php
                  
                    $theList_tour = null;
                    foreach ($theEntry->data->location as $v) {

                        $theList_tour = \app\modules\programmes\api\Catalog::items([
                        'where' => ['like', 'locations', $v],
                        'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                        'pagination' => ['pageSize' => 3],
                    ]);
                    }
                    
                    //  echo print_r('<pre>');
                    //  var_dump($theList_tour_1[0]->model->locations);exit;
                 ?>
                 <?php if($theList_tour != null){ ?>   
                    <div class="extensions">
                        
                 <div class="tour-programs">
                   
                        <div class="area-2">
                            <h2 class="tt mt-txt-60 p-0 mb-txt-40">Les idées de voyage incluant "<span><?= $theEntry->title?></span>"</h2>
                            <div class="bx-controls-slider-right">
                            </div>
                            <div class="slider-right">
                                        <? 
                                        $jj = 0;
                                        foreach ($theList_tour as $key => $v) : ?>
                                <div class="amc-custom-hover-block-image slide slide-<?=$key +1 ?> pb-txt-25">
                                                <a href="<?= DIR . $v->slug ?>" class="topopup" name="pop-<?= $key + 1 ?>" data-analytics="on" data-analytics-category="city_single" data-analytics-action="itineraries_section" data-analytics-label="itinerary_card_<?= $v->model->item_id ?>">
                                                    
                                                    <div class="amc-image">
                                                            <?
                                                            $hasSummary = false;
                                                            if (isset($v->photosArray['summary'])) : 
                                                                 $vp = $v->photosArray['summary'][0];           
                                                                ?>

                                                                <img alt="<?=$vp->description ?>" class="lazy" data-src="/thumb/211/141/1/80<?=$vp->image?>&w=211&h=141&zc=1">
                                                            <? endif; ?>
                                                        
                                                    </div>
                                                </a>    
                                                <div class="" style="padding: 0 7px;">    
                                                <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                                                <h3 class="title tt-16 m-0 p-0 amc-fix-mt-25"><a class="d-block opc-8 tt-hover-color-e65925" href="<?= DIR . $v->slug ?>"><?= str_replace('|','',$v->title); ?></a></h3>
                                                <? if($v->model->sub_title != ''){ ?>
                                                <p class="sub-title amc-fix-mt-20 p-0 m-0"><?= $v->model->sub_title ?></p>
                                                <? } ?>
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
                                        
<!--                                        <div class="summary">
                                        <?//= $value->model->summary ?>
                                            
                                        </div>-->
                                        
                                    </div>
                        <? endforeach; ?>

                            </div>
                            
                        </div>
                     </div>   
				  </div>
                
                 
                 <?php } ?>  
        
    <? } ?>                
<? } ?>
               
                <div class="clearfix"></div>
                <div class="content-blogs mt-60 mb-0">

                    <?php
                    //	echo print_r('<pre>');
                    //	var_dump($theEntry->data->region[0]);exit;
                    $related_destination = \app\modules\destinations\api\Catalog::cat(SEG1 . '/visiter')->items([
                        'where' => ['and', 'app_destinations_items.item_id != ' . $theEntry->model->item_id],
                        'orderBy' => 'rand()',
                        'filters' => ['region' => $theEntry->data->region[0]],
                        'pagination' => ['pageSize' => 3],
                    ]);
					
					if(count($related_destination) < 3){
						$related_destination = \app\modules\destinations\api\Catalog::cat(SEG1 . '/visiter')->items([
                        'where' => ['and', 'app_destinations_items.item_id != ' . $theEntry->model->item_id],
                        'orderBy' => 'rand()',
                       // 'filters' => ['region' => $theEntry->data->region[0]],
                        'pagination' => ['pageSize' => 3],
						]);
					}
                    //echo print_r('<pre>');
                    //var_dump($related_destination);exit;	
                               
                           
                                        
                    ?>
        <!--<h4 class="tt">les IDÉES DE VOYAGE POUR “<span><? //=$theEntry->title; ?></span>�?</h4> -->
                <? if(!empty($arrBlog)){ ?>  
                    <div class="clear-fix amc-blog" style="display: table;">
                            
                            <p class="title-blog mb-txt-40">Les articles de blog concernant le lieu</p>
                            <div class="clearfix"></div>
                             <?php
                                    $cnt = 0;

                                    
                                    foreach ($arrBlog as $value) {
                                      //  var_dump($value);exit;
                                    $cnt++;    


                                ?>
                                <div class="item item-<?=$cnt?>">
                                    <a href="<?= $value['link']?>" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="city_single" data-analytics-action="blog_section" data-analytics-label="blog_card_<?= $value['id'] ?>">
                                        <div class="image">
                                            <img width="" height="" class="img-lazy img-responsive" alt="<?=$value['alt_text'] != '' ? $value['alt_text'] : 'Amica Travel' ?>" data-src="<?= $value['src'] ?>">
                                            <span class="tt-name"><?= $value['cat_name'] ?></span>
                                        </div>
                                        <p class="tt mt-25"><?= $value['title']['rendered']?></p>

                                    </a>
                                </div> 
                            <? } ?>
                            <div class="w-100 d-inline-block">
                            <a class="link-to-blog mr-0 mt-txt-25 opc-8" href="https://blog.amica-travel.com/<?=SEG1 ?>/" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="city_single" data-analytics-action="blog_section" data-analytics-label="link_blog_country"><?='Découvrez notre blog sur '. (SEG1 == 'birmanie' ? 'la ' : 'le '). ucfirst(SEG1)?></a>
                            </div>
                    </div>
                    <? } ?>
                        
                   
                </div>    
                
                <!-- BACK BUTTON -->
                <? include '_inc_back_button.php'; ?>
                <!-- End BACK BUTTON -->
               
            </div>    

            <div class="amc-col amc-col-2 ml-40 mb-60 d-none d-sm-none d-lg-block">
                <div class="area-3 area-map-leaflet mb-25">
<!--                    <a class="fancybox mapgm" id="load-maps" href="#big-maps" data-analytics="on" data-analytics-category="city_single" data-analytics-action="map_section" data-analytics-label="link_map"><img class="img-lazy img-responsive mb-25" alt="carte <?//= ucfirst(SEG1) ?>" data-src="<?//= DIR ?>assets/img/maps/<?//= SEG1 ?>/small-maps-<?//= SEG1 ?>.png?v=002">
                     <img alt="" class="search-ico" data-src="<?//=DIR ?>assets/img/page2016/search-icon.png"> 
                    </a>-->
                    
                     <div id="map"></div>
                    
                </div>
                       
                <div class="area-1 fix-area mt-0">
                    <p class="tt">Besoin de conseil<br>d’un expert ?</p>
                    <ul>
                        <li><img alt="" class="img-lazy" data-src="<?= DIR ?>assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%;"></li>
                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                    </ul>
                    <span data-title="<?= base64_encode(DIR.'nous-contacter') ?>" class="pugjd btn-contact btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="city_single" data-analytics-action="quote_section" data-analytics-label="cta_devis">Contactez-nous</span>
                </div>
                <div class="area-random-destionation mt-25">
                    <h2 class="tt-rand-des mt-txt-25 mb-txt-25">Découvrez d’autres destinations <?= SEG1 == 'birmanie' ? 'en' : 'au'?> <?= ucfirst(SEG1) ?></h2>
                    <? 
                    $cnt = 0;
                    foreach ($random_destination as $value) { $cnt ++;?>
                    <div class="item item-<?=$cnt?> mb-40">
                        <a href="<?= DIR.$value->slug?>">    
                        <?
                            //var_dump($value->title);exit;
                                $hasSummary = false;
                                if (isset($value->photos)) {
                                    foreach ($value->photos as $kp => $vp) {
                                        if ($vp->model->type == 'summary') {
                                            echo '<img height="" alt="' . $vp->description . '" class="img-lazy" data-src="' . DIR . 'thumb/189/128/1/80' . $vp->image . '" data-analytics="on" data-analytics-category="city_single" data-analytics-action="seemore_section" data-analytics-label="envy_card_'.$value->model->item_id.'"/>';
                                            $hasSummary = true;
                                            break;
                                        }
                                    }
                                }
                            ?>
                            <div class="amc-area-text" data-analytics="on" data-analytics-category="city_single" data-analytics-action="seemore_section" data-analytics-label="envy_card_t_<?= $value->model->item_id ?>">   
                                <h3 class="tt tt-18 tt-latolatin-bold fix-align-center tt-custom tt-responsive mt-txt-25 mb-txt-10"><?= $value->title?></h3>
                                <p class="tt-sub mb-0"><?= $value->model->sub_title?></p>
                            </div>
                        </a>
                    </div>
                    <?}?>
                </div>


            </div>


        </div>

    </div>

</div>

<!-- Form Booking Tour -->

<div class="contain container-3 area-form lazy-background loaded">

    <div class="amc-column">

        <div class="rows row-1">
<?//php
//include_once '_form_booking_tour.php';
?>
        </div>

    </div>

</div>
  
<!--<div class="back-button-center back-button">

                    <div class="line"></div>
                    <a href="<?//= DIR . $theEntry->cat->slug ?>"><img alt="Retour" data-src="<?//= DIR ?>assets/img/back-button.png"/> TOUS LES SITES À VISITER "<?//= SEG1 ?>"</a>
                </div>-->
<!--End Form Booking Tour-->

<!-- POPUP-->
<?// include("maps/big-maps.php"); ?>

<div id="big-maps" style="width: 600px;">
    
</div>

<!--END POPUP-->

<?php
$this->registerCssFile(DIR . 'assets/js/fancybox/jquery.fancybox.css');
$this->registerCssFile(DIR . 'assets/js/fancybox/jquery.fancybox-thumbs.css');
//$this->registerCssFile(DIR . 'assets/js/fancybox/helpers/jquery.fancybox-buttons.css');
$this->registerCssFile(DIR . 'assets/js/fancybox/custom-gallery.css');

$this->registerJsFile(DIR . 'assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile(DIR . 'assets/js/fancybox/jquery.fancybox-thumbs.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile(DIR . 'assets/js/fancybox/helpers/jquery.fancybox-buttons.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile(DIR . 'assets/js/image-gallery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$longitude = floatval($theEntry->data->longitude);
$latitude = floatval($theEntry->data->latitude);
$title = $theEntry->model->title;
$id_item = $theEntry->model->item_id;
$url = DIR.$theEntry->slug;
$items_json =<<<TXT
{
    "geometry": {
        "type": "Point",
        "coordinates": [
                $longitude, $latitude
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "$title",
    },
    "id": $id_item
}
TXT;

    $lgi = $longitude;
    $lat = $latitude;

//if(SEG1 == 'vietnam'){
//    $lgi = '106.200523';
//    $lat = '16.040219';
//}else if(SEG1 == 'laos'){
//    $lgi = '104.200523';
//    $lat = '18.040219';
//}else if(SEG1 == 'cambodge'){
//    $lgi = '105.200523';
//    $lat = '12.540219';
//}else if(SEG1 == 'birmanie'){
//    $lgi = '96.200523';
//    $lat = '20.040219';
//}else{
//    $lgi = '106.200523';
//    $lat = '16.040219';
//}  

$js = <<<JS
//$('.btn-contact').click(function(){
//    $('.area-form').show();
//    $('.non-area-form').hide();
//});
        
jQuery(document).ready(function () {
     $('a.fancybox').fancybox({
           titlePosition: 'over', 
            centerOnScroll: true
     });
    $('.fancybox-thumbs').click(function(){
        var slider = jQuery("#wowslider-container1").get(0);
        slider.wsStart($(this).data('thumb'), false, 0);
        $('.fancybox-thumbs').fancybox({
        centerOnScroll: true,
        padding: 1,
        width: 1024,
        height: 680, 
        scrolling: 'no',
        titleShow: false
        });
    });
});     
    

//popup-option-add-image-date-tour
        
	jQuery(function($) {

     
    /* event for close the popup */
    $("div.close").hover(
                    function() {
                        $('span.ecs_tooltip').show();
                    },
                    function () {
                        $('span.ecs_tooltip').hide();
                      }
                );
     
    $("div.close").click(function() {
        disablePopup();  // function close pop up
    });
     
    $(this).keyup(function(event) {
        if (event.which == 27) { // 27 is 'Ecs' in the keyboard
            disablePopup();  // function close pop up
        }      
    });
     
    $("div#backgroundPopup").click(function() {
        disablePopup();  // function close pop up
    });
     
    $('a.livebox').click(function() {
        alert('Hello World!');
    return false;
    });
     
 
     /************** start: functions. **************/
    function loading() {
        $("div.loader").show();  
    }
    function closeloading() {
        $("div.loader").fadeOut('normal');  
    }
     
    var popupStatus = 0; // set value
     
    function loadPopup() {
        if(popupStatus == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup").fadeIn(0500); // fadein popup div
            $("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup").fadeIn(0001);
            popupStatus = 1; // and set value to 1
        }    
    }
         
     
    function disablePopup() {
        if(popupStatus == 1) { // if value is 1, close popup
            $("#toPopup").fadeOut("normal");  
            $("#backgroundPopup").fadeOut("normal");  
            popupStatus = 0;  // and set value to 0
        }
        $('.popup').hide();
    }
    /************** end: functions. **************/
}); // jQuery End
	   
// Jquery config Content
        
    for (var i = 1; i < 30; i++) {
       // alert(i);
        $('div.program h3:contains(jour ' + i + ' -)').html(function(_, html) {
            return html.split('jour '+ i + ' -').join('<span class="fix-jour">jour '+ i +'.</span><span class="tt">');
         });
        }
        
        $('div.program .entry-content li:contains(L\'Hotel)').addClass('hotel');
        $('div.program .entry-content li:contains(Kayaking)').addClass('kayaking');
        $('div.program .entry-content li:contains(En avion)').addClass('en-avion');
        
      $(".tab-children > h3").click(function() {
        
        $(this).parent().parent().find(".tab-children").not($(this).parent()).removeClass("active");
        $(this).parent().toggleClass("active");
//        $('html, body').animate({
//            scrollTop: $(this).offset().top
//        }, 200);
         $('div.program .entry-content ul').parent().css('min-height', $('div.program .entry-content ul').height());
    })       
        
        
        $(".tab-children > h4").click(function() {
        
        $(this).parent().parent().find(".tab-children").not($(this).parent()).removeClass("active");
        $(this).parent().toggleClass("active");

       
    })    
        
    $('.popup-infos .nav-tabs li a').click(function(){
        var data = $(this).parent().attr('data');
        $('.popup-infos .btn-tabs img').removeClass('active');
        $('.popup-infos .btn-tabs img.' + data).addClass('active');
    });    
        
// End jquery config content        
 

// Jquery bxslider right
    
// $(document).ready(function(){
//        var slider = $('.slider-right').bxSlider({
//            slideWidth: 325,
//            minSlides: 1,
//            maxSlides: 2,
//            moveSlides: 1,
//            slideMargin: 20,
//            responsive: true,
//         
//            randomStart: false,
//             captions: true,
//            auto: false,
//			infiniteLoop: false,
//           // mode: 'fade',
//            speed: 1000,
//			adaptiveHeight: true,
//           onSlideBefore: function(slideElement, oldIndex, newIndex){
//            var lazy = slideElement.find('.img-lazy');
//            var load = lazy.attr('data-src');
//            lazy.attr('src', load).removeClass('img-lazy');
//        }
//        
//        });
//    });
// End Jquery bxslider right      
        
 
        
      
        
 

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
	 
	 

	 
$(window).bind("load", function() { 


  $('.related-articles .clear-fix .item').each(function(index) {
        var maxtt = 0;
        var heighttt = $(this).children().children('.tt').outerHeight();
        if(maxtt < heighttt){
            maxtt = heighttt;
        }
        var maxsum = 0;
        var heightsum = $(this).children('.summary').outerHeight();
        if(maxsum < heightsum){
            maxsum = heightsum;
        }
		
       $('.related-articles .clear-fix .item .tt').css("min-height", maxtt);
		$('.related-articles .clear-fix .item .summary').css("min-height", maxsum);
         
		 
  });
        
//  $('.extensions .slide').each(function(index) {
//        var maxtt = 0;
//        var heighttt = $(this).children().children('.title').outerHeight();
//        if(maxtt < heighttt){
//            maxtt = heighttt;
//        }
//       
//        
//        var maxsubtt = 0;
//        var heightsubtt = $(this).children().children('.sub-title').outerHeight();
//        if(maxsubtt < heightsubtt){
//            maxsubtt = heightsubtt;
//        }
//        
//        var maxsum = 0;
//        var heightsum = $(this).children('.summary').outerHeight();
//        if(maxsum < heightsum){
//            maxsum = heightsum;
//        }
//        
//         var maxul = 0;
//        var heightul = $(this).children('ul').outerHeight();
//        if(maxul < heightul){
//            maxul = heightul;
//        }
//		
//       $('.extensions .slide .title').css("min-height", maxtt);
//        $('.extensions .slide .sub-title').css("min-height", maxsubtt);
//        $('.extensions .slide .summary').css("min-height", maxsum);
//        $('.extensions .slide ul').css("min-height", maxul);
//         
//		 
//  });      
        
      

});
        
$('#load-maps').on('click',function(){
       
        var hClass =  $(this).hasClass('active');
    if(!hClass){    
        $(this).addClass('active');
        $.ajax({
            type: "POST",
            url: window.location.pathname,
            data: {
                type: 'load-big-maps'
            },
            dataType: 'html',
            success: function(data) {
               $('#big-maps').html(data);
               //$('main').append(data);
              

            }

        });
    }else{
        
    }
});        
        
     

// Js For MAP
   
var bicycleRental = {
    "type": "FeatureCollection",
    "features": [
        $items_json
    ]
};


       var map = L.map('map', {
      	scrollWheelZoom: false,
      	minZoom: 4, 
      	maxZoom: 10,
//        zoomSnap: 0.5,
//        zoomDelta: 0.5,
      	zoomControl: true
      }).setView([$lat, $lgi], 7);

      map.zoomControl.setPosition('bottomright');


      var gl = L.mapboxGL({
        accessToken: 'not-needed',
        style: 'https://api.maptiler.com/maps/8ad794d7-a13c-4520-9f39-1a34f9c078c5/style.json?key=LnX9QGkCi1lrAKH6KPtr'
      }).addTo(map);

      var baseballIcon = L.icon({
		iconUrl: 'baseball-marker.png',
		iconSize: [32, 37],
		iconAnchor: [16, 37],
		popupAnchor: [0, -28]
	});

      function onEachFeature(feature, layer) {
		var popupContent = "";

		if (feature.properties && feature.properties.popupContent) {
			popupContent += feature.properties.popupContent;
		}

		layer.bindPopup(popupContent);
	}

	L.geoJSON([bicycleRental], {

		style: function (feature) {
			return feature.properties && feature.properties.style;
		},

		onEachFeature: onEachFeature,

		pointToLayer: function (feature, latlng) {
			return L.circleMarker(latlng, {
				radius: 6.4,
				fillColor: "#ff7800",
				color: "#000",
				weight: 1,
				opacity: 1,
				fillOpacity: 0.8
			});
		}
	}).addTo(map);
      
  
// END JS FOR MAP   
        
$(document).on("mouseenter", ".leaflet-interactive", function(event){
//	$('.mybutton').addClass('mybutton-animation');
   
        var hId = $(this).attr('id');
       
        if(hId != 'fix'){
            var oldclass = $(this).attr('class');
            $(this).attr('class', oldclass + ' act-hover');
         }
             var tt = $(this).attr('d');
            var ttt = tt.split(",");
            var x = ttt[0].split("M");
            var y = ttt[1].split("a");
//            console.log(x[1]);
//            console.log(y[0]);
//            var x = $(this).offset().left;
//            var y = parseInt($(this).offset().top - $("#map").offset().top) + 10;

            var origin = x[1] + 'px' +' '+ y[0] + 'px';

            $(this).css("transform-origin", origin);
            $(this).attr('id','fix');
      //  }
       
});        

   
        
JS;
$this->registerJs($js, yii\web\View::POS_END);
?>