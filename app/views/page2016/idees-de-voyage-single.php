<? if(Yii::$app->request->isAjax && Yii::$app->request->post('type') =='combien') : ?>
    <div class="tab-pane fade cm-cb" id="climat" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="amc-column container row no-gutters pt-40">
                <? if($theEntry->model->category_id == 7) :  ?>
                    <? echo  $cmcb[4]->description;?>
                <? else: ?>
              <? $key = preg_split("/<h3>(.*?)<\/h3>/", $cmcb[4]->description, -1,  PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY); 
                if(SEG1=='vietnam') echo '<h3 class="mt-0 mb-txt-25">'.$key[0].'</h3>'.$key[1];
                if(SEG1=='cambodge') echo '<h3 class="mt-0 mb-txt-25">'.$key[2].'</h3>'.$key[3];
                if(SEG1=='laos') echo'<h3 class="mt-0 mb-txt-25">'.$key[4].'</h3>'.$key[5];
                if(SEG1=='birmanie') echo '<h3 class="mt-0 mb-txt-25">'.$key[6].'</h3>'.$key[7];
            endif; ?>
                </div>
          </div>
          <div class="tab-pane fade cm-cb" id="hebergement" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="amc-column container row no-gutters pt-40">
                <?=$cmcb[3]->description; ?>
                </div>
          </div>
            <div class="tab-pane fade cm-cb" id="transport" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="amc-column container entry-content row no-gutters pt-40">
                <?=$cmcb[2]->description; ?>
                </div>
          </div>
            <div class="tab-pane fade cm-cb" id="visa" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="amc-column container row no-gutters pt-40">
                <? if($theEntry->model->category_id == 7) :  ?>
                    <? echo  $cmcb[1]->description;?>
                <? else: ?>
                <? $key = preg_split("/<h3>(.*?)<\/h3>/", $cmcb[1]->description, -1,  PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY); 
                if(SEG1=='vietnam') echo '<h3 class="mt-0 mb-txt-25 w-100">'.$key[0].'</h3>'.$key[1];
                if(SEG1=='cambodge') echo '<h3 class="mt-0 mb-txt-25 w-100">'.$key[2].'</h3>'.$key[3];
                if(SEG1=='laos') echo'<h3 class="mt-0 mb-txt-25 w-100">'.$key[4].'</h3>'.$key[5];
                if(SEG1=='birmanie') echo '<h3 class="mt-0 mb-txt-25 w-100">'.$key[6].'</h3>'.$key[7];
            endif;
    ?>
                </div>
          </div>
          <div class="tab-pane fade cm-cb" id="tarif" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="amc-column container row no-gutters pt-40">
                <?=$cmcb[0]->description; ?>
                </div>
          </div>
<? else : ?>
<?php 
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerCssFile('/assets/css/page2016/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);?>

<div class="container-fluid sub-header-fixed text-center <?= IS_TABLET === true ? 'sub-header-fixed-tablet' : ''?>">
    <div class="amc-column container text-left row px-0 d-flex align-items-center justify-content-between">
        <div style="max-width: 30%;" class="d-sm-none d-lg-flex justify-content-start align-items-center px-0 pr-0">
            <p class="tt m-0"><?=$theEntry->title ?></p>
        </div>
       
            <div class="tt-fontsize-13-5 tt-latolatin-bold px-0 mr-0 text-center calendar flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                        <img data-src="/assets/img/page2016/icon_time_big.png" alt="">
                        <?= $theEntry->model->days?> jours <?= $theEntry->model->nights?> nuits</div>
                    <!--
                    <?//php if(isset($theEntry->data->countries)){?>
                        <div class=" text-center ml-0 mr-60 posi countries flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="link_country">
                            <img data-src="/assets/img/page2016/posi-big.png" alt="">
                            <div class="posi-link">
                             <?//php
//                                $i= 0;
//                                if(is_array($theEntry->data->countries)){
//                                    foreach ($theEntry->data->countries as $value) {
//                                        $i ++;
//                                         echo '<a href="'.DIR.$value.'">'.ucfirst($value).'</a>';
//                                        if($i < count($theEntry->data->countries)){
//                                            echo ', ';
//                                        }
//                                    }
//                                }else{
//                                   echo $theEntry->data->countries;
//                                }
                            ?>
                            </div>
                        </div>
                    <?//php }?>    
                    <div class="px-0 ml-0 tour-type-col  text-center tt-<?= $theEntry->cat->category_id?> flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="link_inspi_itineraries">
                        <?// if($theEntry->cat->photosArray['icon-banner']) : 
                          //  $iconCat = $theEntry->cat->photosArray['icon-banner'][0];    
                            ?>
                        <img data-src="<?//=$iconCat->image?>" alt="">
                        <?// endif ?>
                         <a id="tour-type" href="<?//=DIR.str_replace('voyage', SEG1.'/'.SEG2, $theEntry->cat->slug)?>">
                                <?//= $theEntry->cat->title?>
                            </a>
                    </div>
                    -->
                    <? if(isset($theEntry->data->budget) && $theEntry->data->budget != ''){ ?>
                        <div class="tt-fontsize-13-5 tt-latolatin-bold px-0 ml-0 text-center price flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                            <img data-src="/assets/img/page2016/icon-price.png" alt="">
                            <span class="target-tab-price"><?= 'À partir de '.$theEntry->data->budget.'€' ?></span>
                        </div>
                    <? } ?>
                    
       
                    <div class="px-0 text-center btn-devis flex-wrap d-inline-flex justify-content-end align-items-center list-unstyled">
                        <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-booking-top btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="cta_devis">Demander votre devis</button>
                    </div>
    </div>
</div> 

<div class="contain container-1">
    <?php
      
        if(!empty($theEntry->photos)){
            
            foreach ($theEntry->photos as $v) {
               
                if($v->model->type == 'banner'){
            
     ?>
    <img alt="" style="width: 100%" class="banner img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
        <?php
                }
            }
        
         }else{
       ?>
    <img alt="" class="img-lazy" style="width: 100%;" data-src='<?=DIR?>upload/image/banner-idees-de-voyage-single.jpg'>
         <?php } ?>
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb_specials.php') ?>

    </div>
</div>


<div class="contain container-2 non-area-form container row-content-1 px-0">
    
    <div class="amc-column">
        <div class="intro mt-txt-40 text-center px-20">
            <h1 class="title mt-0 mb-10"><?= str_replace('|', '<br>',$this->context->pageT)?></h1>
            <p class="tt-s mt-txt-5 mb-txt-25">
                <?= $theEntry->model->sub_title?>
            </p>
            <p class="t-2 itinerary mt-0 mb-txt-25">    
                <? if(isset($theEntry->data->itinerary)) : ?>
                    <? $itinerary  = json_decode($theEntry->data->itinerary); ?>
                    <? if($itinerary) :?>
                    <? foreach ($itinerary as $key => $value){
                        if($key && substr($value->title, 0, 1) != '(' && substr($value->stitle, 0, 1) != '(') echo ' - '; else echo ' ';
                        $title = $value->stitle ? $value->stitle : $value->title;
                       if($value->status == 1){
                        echo $title;
                       } else{
                            echo $title;   
                       } 
                    } ?>
                    <? else: ?>
                    <? echo  $theEntry->data->itinerary;?>
                    <? endif; ?>
                <? endif; ?>
            </p>
            <p class="spirit my-0">
                <?= $theEntry->model->spirit?>
            </p>
        </div>
        <div class="sub-intro my-txt-40 row no-gutters d-flex justify-content-around">
                    <div class="text-center calendar list-unstyled block-custom">
                        <img data-src="/assets/img/page2016/icon_time_big.png" alt="">
                        <p class="d-block w-100">Durée</p>
                        <?= $theEntry->model->days?> jours <?= $theEntry->model->nights?> nuits</div>
                    <?php if(isset($theEntry->data->countries)){?>
                        <div class="text-center posi countries list-unstyled block-custom">
                            <img data-src="/assets/img/page2016/posi-big.png" alt="">
                            <p class="d-block w-100">Pays</p>
                           <div class="posi-link">
                             <?php
                                $i= 0;
                                if(is_array($theEntry->data->countries)){
                                    foreach ($theEntry->data->countries as $value) {
                                        $i ++;
                                         echo '<a href="'.DIR.$value.'" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="link_country">'.ucfirst($value).'</a>';
                                        if($i < count($theEntry->data->countries)){
                                            echo ', ';
                                        }
                                    }
                                }else{
                                   echo $theEntry->data->countries;
                                }
                            ?>
                            </div>
                        </div>
                    <?php }?>    
                    <div class="text-center tt-<?= $theEntry->cat->category_id?> list-unstyled block-custom">
                        <? if($theEntry->cat->photosArray['icon-banner']) : 
                            $iconCat = $theEntry->cat->photosArray['icon-banner'][0];    
                            ?>
                        <img data-src="<?=$iconCat->image?>" alt="">
                        <p class="d-block w-100">Type de voyage</p>
                        <? endif ?>
                         <a id="tour-type" href="<?=DIR.str_replace('voyage', SEG1.'/'.SEG2, $theEntry->cat->slug)?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="link_inspi_itineraries">
                                <?= $theEntry->cat->title?>
                            </a>
                    </div>
            
                    <? if(isset($theEntry->data->budget) && $theEntry->data->budget != ''){ ?>
                    <div class="text-center price list-unstyled block-custom">
                        <img data-src="/assets/img/page2016/icon-price.png" alt="">
                        <p class="d-block w-100">Budget moyen</p>
                        <span class="target-tab-price"><?= 'À partir de '.$theEntry->data->budget.'€' ?></span>
                    </div>
                    <? } ?>
                    <div class="px-0 text-center btn-devis list-unstyled">
                        <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-booking-top btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="cta_devis">Demander votre devis</button>
                        <p class="mt-10 pdf-link fancybox-nolink" data-fancy="#pop-email-pdf" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="link_pdf">Télécharger le circuit</p>
                    </div>
        </div>
    </div>
</div>

<? include_once '_inc_video_page.php'; ?>

<div class="container-fluid  container-2 d-inline-block tour-content pb-40 mb-30">
    <div class="container amc-column">
        
        <div class="rows row-2">
            
           
            <div class="amc-col amc-col-1 mr-40">
                <div class="detail detail-1">
                    
                    <div class="text points entry-body mt-40">
                        <?php 
                            $points = [];
                            if(isset($theEntry->data->points)){
                                $points = explode('<hr />', $theEntry->data->points);
                            }  
                            $i = 0;
                                foreach ($points as $key => $value) {
                                    if($key == $i){
                                    $points_cont[$i] = $value;
                               }
                               $i++;
                            }
                            
                            if(isset($points_cont[0])){
                                echo str_replace(['<h4>','</h4>'], ['<h3>','</h3>'], preg_replace('/<!--(.|\s)*?-->/', '', $points_cont[0]));
                            }
                        ?>

                       
                    </div>   
                </div>
                <div class="detail detail-2 entry-body">
                    
                    <div class="text">
                        <?php
                              if(isset($points_cont[1])){
                                echo preg_replace('/<!--(.|\s)*?-->/', '', $points_cont[1]);
                            }
                        ?>
                    </div>  
                    
                </div>

                <? $galeriesBf =  array_reverse($theEntry->photos);
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
                <? $galeriesBf =  array_reverse($theEntry->photos);
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
                 
                <?php } ?>
                </div>

                <div class="amc-col amc-col-2">
                
                <div class="area-1 mt-25 d-none d-lg-block" style="width: 100% !important;">
                    <? if($illus[1]) : ?>
                        <img class="mt-25" data-src="<?=$illus[1]->image?>" alt="<?=$illus[1]->description?>">
                    <? else: ?>
                       <!--  <img class="mt-25" style="width: 100% !important;" data-src="/assets/img/banner-promo-circuit-new.jpg" alt=""> -->
                    <? endif; ?>
                </div>
                
                
            </div>

        </div>
    </div>
</div>


         <div class="container-fluid mt-20 mb-60">
             <!-- <div class="d-inline-block d-sm-inline-block d-lg-none text-center mb-40 w-100">
                        <img alt="" data-src="/assets/img/promo-res.png">
                    </div>  -->
            <div class="row">
                <? include('_inc_galeries_tour.php') ?>
            </div>
        </div> 
<div class="container-fluid container-2 px-0 ">
    <div class="amica-column container column-nav-tab-tour d-flex">
        <div class="swiper-container <?= IS_TABLET === true ? 'content-tour-nav-fixed-tablet' : '' ?>" id="<?= IS_TABLET === true ? 'menu-tab-swiper-tablet' : '' ?>">
             <?
                if($theProgram){
                    $class = NULL;
                    
                }else{
                    $class = 'fix-margin-li';
                }
            ?>
            <ul class="swiper-wrapper nav nav-tabs <?= $class ?>" id="content-tour-nav" role="tablist">
                <li class="swiper-slide active">
                <span class="nav-item nav-link active" id="program-tab" data-toggle="tab" role="tab" aria-controls="program" aria-selected="true" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_programm">Programme & carte</span>
                </li>
                <? if(isset($theEntry->data->price) && $theEntry->data->price) : ?>
                <li class="swiper-slide">
                <span  class="nav-item nav-link" id="prix-tab" data-toggle="tab" role="tab" aria-controls="prix" aria-selected="true" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_price">Prix</span>
                </li>
                <? endif; ?>
                <? if($theProgram) : ?>
                <li class="swiper-slide">
                <span class="nav-item nav-link" id="formules-tab" data-toggle="tab" role="tab" aria-controls="formules" aria-selected="true" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_secrets">Formules insérables dans ce voyage</span>
                </li>
                <? endif; ?>

                <? if(isset($theEntry->data->folder) && $theEntry->data->folder) { ?>
                <li class="swiper-slide">
                <span  class="nav-item nav-link" id="folder-tab" data-toggle="tab" role="tab" aria-controls="folder" aria-selected="true" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_folder">Bibliographie</span>
                </li>
                <? } ?>

                <li class="swiper-slide dropdown">
                <span class="nav-item dropdown-toggle cm-cb-nav" data-toggle="dropdown" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_how">Quand, comment, combien</span>
                <div class="dropdown-menu">
                  <a data-toggle="tab" role="tab" aria-controls="formules" aria-selected="true" class="dropdown-item" href="#climat" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_climat">Climat</a>
                  <a data-toggle="tab" role="tab" aria-controls="formules" aria-selected="true" class="dropdown-item" href="#hebergement" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_hebergement">Hébergement</a>
                  <a data-toggle="tab" role="tab" aria-controls="transport" aria-selected="true" class="dropdown-item" href="#transport" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_transport">Transport</a>
                  <a data-toggle="tab" role="tab" aria-controls="visa" aria-selected="true" class="dropdown-item" href="#visa" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_visa">Visa</a>
                  <a data-toggle="tab" role="tab" aria-controls="tarif" aria-selected="true" class="dropdown-item" href="#tarif" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_tarif">Tarif</a>
                </div>
                </li>
            </ul>
            <!--                    <div class="swiper-scrollbar"></div>-->
            <div class="button-slider menu-tab-swiper-tablet-button-prev swiper-button-prev"></div>
            <div class="button-slider menu-tab-swiper-tablet-button-next swiper-button-next"></div>
        </div>
    </div>
    <div class="notes">
                    <?php
                        $node_image = []; 
                        $node_image = \yii\helpers\ArrayHelper::map($notes, 'slug','photos');
                    
                       
                        $node_title = \yii\helpers\ArrayHelper::map($notes, 'slug','title');
                        if(isset($theEntry->model->notes) && $theEntry->model->notes != NULL){
                            foreach (json_decode($theEntry->model->notes) as $key=>$value) {

                                echo '<ul id="'.$key.'" class="note note-'.$key.'">';
                                foreach ($value as $v) {

                                    echo '<li class="'.$v.'" style="background-image: url('.$node_image[$v][0]->image.');">'.$node_title[$v].'</li>';
                                }
                                echo '</ul>';
                            }
                        }
                         
                    ?>
                </div>
    <div class="tab-content pb-40" id="content-tour-tab">
          <div class="tab-pane fade show active" id="program" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="amc-column container program">
                <div class="map float-right">
                    <img alt="" data-src="<?=isset($theEntry->photosArray['map']) ? $theEntry->photosArray['map'][0]->image : ''?>"/>
                </div>
                <ul class="tt-btn mt-40">
                        <li><h2 class="tt">Descriptif du programme</h2></li>
                    </ul>
                    <div id="tourContent">
                    <?php
                         $body = preg_replace('/<h3>(.*?)-(.*?)<\/h3>/', '<div class="jour tab-children no-switch"><h3 class="first-jour"><span class="fix-jour">$1</span><span class="tt">$2</span></h3><div class="entry-content">', $theEntry->description, 1);
                        
                        $body = preg_replace('/<h3>(.*?)-(.*?)<\/h3>/', '</div></div><div class="jour tab-children no-switch"><h3 class="first-jour"><span class="fix-jour">$1</span><span class="tt">$2</span></h3><div class="entry-content">', $body);
                        $body = preg_replace('/<img[^>]+\>/i', '', $body);
                        echo $body . "</div></div>";
                    
                    ?>
                    </div>
            </div>
          </div>
          <? if(isset($theEntry->data->price) && $theEntry->data->price) : ?>
          <div class="tab-pane fade"  id="prix" role="tabpanel" aria-labelledby="pills-home-tab">
               <div class="amc-column container entry-content row no-gutters pt-40">
                   <?=isset($theEntry->data->price) ?  $theEntry->data->price : '' ?>
               </div>
          </div>
        <? endif; ?>
          <div class="tab-pane fade" id="formules" role="tabpanel" aria-labelledby="pills-home-tab row no-gutters">
            <div class="amc-column container row no-gutters pt-40">
              <? foreach ($theProgram as $key => $p):?>
                <div class="col-12 col-sm-12 col-lg item-formules mb-40 row no-gutters d-block">
                        <div class="img topopup" name="pop-<?=$key+1 ?>" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_<?= $p->model->item_id ?>">
                            <? if(isset($p->photosArray['banner'])) :?>
                            <img style="width: 299px; height: 200px; display: block;" alt="<?= $p->photosArray['banner'][0]->description ?>" data-src="<?='/thumb/299/200/1/100'.$p->photosArray['banner'][0]->image ?>">
                            <? endif; ?>
                        </div>
                        <div class="text pl-10 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block">
                            <p class="tt tt-1 mt-txt-25 mb-txt-25 p-0 text-uppercase topopup amc-fix-mt-25-0" name="pop-<?=$key+1 ?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_t_<?= $p->model->item_id ?>"><?=$p->title;?></p>
                        
                        </div>
                  </div>
              <? endforeach;?>
            </div>
          </div>
        
          <? if(isset($theEntry->data->folder) && $theEntry->data->folder) { ?>
          <div class="tab-pane fade"  id="folder" role="tabpanel" aria-labelledby="pills-home-tab">
               <div class="amc-column container entry-content row no-gutters pt-40">
                   <?=isset($theEntry->data->folder) ?  $theEntry->data->folder : '' ?>                    
               </div>
          </div>
          <? } ?>  
        
    </div>
</div>
<!--End Form Booking Tour-->

<div class="contain container-4 text-center">
    <div class="amc-column container text-left">
         <div class="d-block devis-btn-block mt-60  container-fluid d-flex justify-content-center align-items-center py-20">
            <div class="text text-center mr-40 ">
                Ce circuit vous intéresse ?
            </div>
            <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
            <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="ml-60 btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</button>
        </div>
        
    </div>
    
</div>

<?
if(!empty($arrSuggest)){
?>
<div class="contain container-flud tours-selected p-0 mt-txt-60 mb-0 text-center">
    <div class="amc-column responsive-swiper-slider-3-item container">
        <span class="tt title m-0 tt-latolatin-bold tt-fontsize-24 d-block text-left mb-txt-40 amc-fix-mb-40-0">Découvrez d'autres circuits</span>
        
        <!-- Slider main container -->
        <div class="area-slider-swiper area-slider-swiper-3-item">    
            <div class="swiper-container custom-slides-swiper custom-slides-swiper-3-item <?= count($arrSuggest) > 3 ? 'suggest-slide' : '' ?>">

                <!-- Additional required wrapper -->
                <div class="swiper-wrapper custom-bxslider">
                    <!-- Slides -->
                    <? foreach ($arrSuggest as $v) { ?>

                        <div class="swiper-slide img-zoom-span item text-left">
                            <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                                <div class="img fill" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?= $v->model->item_id ?>">

                                    <? if(isset($v->photosArray['summary'])) : ?>
                                        <img class="amc-img" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/300/200/1/100<?=$v->photosArray['summary'][0]->image ?>">
                                    <? endif; ?>
                                </div>
                            </span>
                            <div class="text pl-15 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block p-0">
                                <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                                
                                <p class="tt tt-1 m-0 p-0 amc-fix-mt-25" name="pop-<?=$key+1 ?>">
                                    <a class="tt-line-height-1-2" href="/<?=$v->slug?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $v->model->item_id ?>"><?=$v->title;?></a>
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
                    <? } ?>
                </div>
            </div>
            <?
                if(count($arrSuggest) > 3){
            ?>
            <!-- If we need pagination -->
            <div class="swiper-pagination suggest-swiper-pagination"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev suggest-swiper-button-prev" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="tours_section" data-analytics-label="control_left"></div>
            <div class="swiper-button-next suggest-swiper-button-next" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="tours_section" data-analytics-label="control_right"></div>   
            <? } ?>
        </div>
    </div>
</div>
<?
}
?>
<div class="contain text-center">
    <div class="amc-column">
        <div class="" style="clear: both;"><? include '_inc_back_button.php'; ?></div>
    </div>
</div>
<div class="contain button-fix-devis img-lazy" data-src="<?=DIR?>assets/img/page2016/bg_row_link_devis_rdv.jpg">
    
    <div class="amc-column">
        <p class="text">Consultez un Expert Amica
pour obtenir un devis gratuit</p>
        <span class="button-to-devis-form"><img alt="Personnaliser ce voyage" data-src="<?=DIR?>assets/img/button/button-to-devis-fix.jpg"></span>
    </div>
    
</div>


<!-- POPUP-->
    


    

    <div id="toPopup">
        <div class="close"></div>
        <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>

        <div id="popup_content"> <!--your content start-->
            
        </div> <!--your content end-->
        
    </div> <!--toPopup end-->
    <div id="pop-email-pdf" class="popup pop-email-pdf" data-pop="pop-email-pdf">
                <div class="header-email-pdf w-100 d-inline-block">
                    <p class="small-tt mb-5">Programme complet à télécharger</p>
                    <p class="tt w-100"><?=$theEntry->title; ?></p>
                </div>
                <div class="body-email-pdf">
                    <p>Pour recevoir maintenant ce programme au format PDF, veuillez saisir votre email adresse : </p>
                    <form id="email-pdf-form">
                        <div class="form-group float-left mb-0">
                            <input name="email" type="text" class=" mb-5 rounded email form-control required" aria-describedby="emailHelp" placeholder="Votre email" required email data-validation-error-msg="demo"/>
                             <label id="emailHelp" class="form-text text-muted error"><img data-src="/assets/img/tour/icon-warning.png" class="mr-10" alt="">Cette adresse email semble ne pas exister</label>
                        </div>
                        <button type="button" class="submit btn-amica-basic btn-amica-basic-2 float-right">Télécharger</button>
                        <div class="form-check d-inline-flex w-100 p-0 mt-10 ">
                            <input type="checkbox" class="form-check-input float-left d-none" id="exampleCheck1">
                            <span class="float-left"></span>
                            <label class="form-check-label float-left" for="exampleCheck1">Souhaitez-vous recevoir des informations (reportages, promotions, conseils de voyages...)
de la part de Amica Travel (1 fois par semaine) ?</label>
                          </div>
                    </form>
                    <div class="messages d-none"><p class='mb-txt-25'>Un e-mail vient de vous être envoyé avec, en pièce jointe, le document demandé. 
Si vous n'avez rien reçu d'ici quelques minutes, regardez dans vos éléments insidérables et
ajoutez-nous à votre carnet d'adresses</p><p><b>Cordialement,<br>
L'équipe Amica Travel</b></p></div>
                </div>
            </div> 
    <div class="loader"></div>
    <div id="backgroundPopup"></div>



<!--END POPUP-->

<?php
      $img = NULL;                     // var_dump($theEntry->photos);exit;
foreach ($theEntry->photos as $v) {
   if($v->model->type == 'summary'){
       $img = $v->image;
   }
}

$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');


$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);


$pdfFile = isset($theEntry->data->pdf) && $theEntry->data->pdf ? \yii\easyii\modules\file\api\File::get($theEntry->data->pdf)->model->file : '';
$seg1 = SEG1;   
$dir_uri = DIR.URI;
$dir = DIR;
$uri = URI;
$id = $theEntry->model->item_id;
$title = $theEntry->model->title;
$catSlug = explode('/',$theEntry->cat->slug);
$temName = end($catSlug).'-'.SEG1;
$fileName = SEG1.'-'.SEG3;
$image = $img;
$sub_title = $theEntry->model->sub_title;
$points = str_replace(array("\r", "\n"), '', $theEntry->data->points);
$description = str_replace(array("\r", "\n"), '', $theEntry->description);
$data = json_encode( \yii\helpers\ArrayHelper::toArray($data));
$get = Yii::$app->request->get('tab');
$js=<<<JS
        
var menuTabSwiperTablet = new Swiper('#menu-tab-swiper-tablet', {
        
//        scrollbar: '.swiper-scrollbar',
//        scrollbarHide: false,
//        nextButton: '.menu-swiper-button-next',
//        prevButton: '.menu-swiper-button-prev',
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 20,
        grabCursor: true,
        initialSlide: 0,
//        scrollbar: {
//            el: '.swiper-scrollbar',
//            draggable: true,
//        }
        navigation: {
            nextEl: '.menu-tab-swiper-tablet-button-next',
            prevEl: '.menu-tab-swiper-tablet-button-prev',
          },
    });         
        
        
$('.row-content-1').css('margin-top', '-'+($('.intro').height()+40)+'px');
var form = $('#email-pdf-form');
form.validate({
    messages: {
        email: {
            required: '<img src="/assets/img/tour/icon-warning.png" class="mr-10" alt="">Cette adresse email semble ne pas existe',
            email: '<img src="/assets/img/tour/icon-warning.png" class="mr-10" alt="">Cette adresse email semble ne pas exister'
        }
    }
});
$('#pop-email-pdf .submit').click(function(){
        var url = '/amica-fr/send-pdf-to-email';
        if(form.valid()){
            $.ajax({
            type: 'post',
            url: url,
            data: { tourName: "$theEntry->title", tourUrl: '$theEntry->slug',email: $('#pop-email-pdf .email').val(), checknews: $('#pop-email-pdf .form-check-input').is(":checked"), pdf: '$pdfFile' },
            beforeSend: function(){
                $('#pop-email-pdf .body-email-pdf').html($('.body-email-pdf .messages').html());
            },
            success: function(data){
                $.fancybox.close();
            }
            });
        }
        
        return false;
});

$('#pop-email-pdf .body-email-pdf form .form-check > span').click(function(){
    $(this).parent().find('label').trigger('click');
});
$(document).ready(function(){ 
       $('.fancybox-nolink').fancybox({
          href: $('.fancybox-nolink').data('fancy'),
            padding: 0,
            beforeShow: function(){
              $('html').css('overflow', 'hidden')
           },
           afterClose: function(){
              $('html').css('overflow', 'auto')
           },
           tpl: {
          closeBtn: "<div title='Close'  class='fancybox-item fancybox-close close-pdf-popup'></div>"
         }
       });
});

$('.fancybox-nolink').click(function(){
    $(this).fancybox({
        href: $(this).data('fancy'),
        padding: 0,
        beforeShow: function(){
              $('html').css('overflow', 'hidden')
           },
           afterClose: function(){
              $('html').css('overflow', 'auto')
           },
           tpl: {
          closeBtn: "<div title='Close'  class='fancybox-item fancybox-close close-pdf-popup'></div>"
         }
    });
});
  $(window).bind('load', function(){
    var map = $('#program .map');
    var mapTop = map.offset().top;
    var proTop = $('#program').offset().top + $('#program').height();
    var devisTop = $('.sub-intro .btn-devis').offset().top + $('.sub-intro').height();   
               
    $(window).resize(function(){
    
         map = $('#program .map');
         mapTop = map.offset().top;
         proTop = $('#program').offset().top + $('#program').height();
         devisTop = $('.sub-intro .btn-devis').offset().top + $('.sub-intro').height();   
       
    });        
        
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        var scrollBot = scroll + $(window).height();
       
      if (scroll >= ($('#program').offset().top) && scrollBot <= proTop){
            map.addClass('sticky');
            $('#content-tour-tab #program').addClass('after-sticky');
        } 
      else{
            map.removeClass('sticky');
            $('#content-tour-tab #program').removeClass('after-sticky');
        } 
        if(scrollBot > proTop){
                map.addClass('position-bottom');
                $('#content-tour-tab #program').addClass('after-bottom');
            }   else{
                map.removeClass('position-bottom');
                $('#content-tour-tab #program').removeClass('after-bottom');
                } 

       if(scroll > devisTop){ 
            $('.sub-header-fixed').addClass('show'); 
           $('.area-btn-list-menu').removeClass('fixed');
            $('.area-btn-list-menu').removeClass('opacity');
        }else{ 
            $('.sub-header-fixed').removeClass('show'); 
            $('.area-btn-list-menu').removeClass('fixed');
            $('.area-btn-list-menu').removeClass('opacity');
           // $('.container-1 .row-1').show();
              
        }
        
        if(scroll >= ($('#content-tour-tab').offset().top - 70) && scroll <= ($('#content-tour-tab').offset().top + $('#content-tour-tab').height())){
            $('#content-tour-nav').parent().addClass('fixed-top-tablet');
          //  $('#content-tour-nav').parent().css({'height' : '70px'});
        }else{
            $('#content-tour-nav').parent().removeClass('fixed-top-tablet');
          //  $('#content-tour-nav').parent().css({'height' : 'auto'});
        }
    });
        
 });   
        
 
      
$('#content-tour-nav span.nav-link').on('click', function (e) {
  e.preventDefault()
  var idTab = '#'+$(this).attr('aria-controls');

  
  $('#content-tour-tab .tab-pane').removeClass('show active');
  $(idTab).addClass('show active');
});
        
$(document).on('click', '.fixed-top-tablet.content-tour-nav-fixed-tablet li .nav-link', function(){
    var top = $('#content-tour-tab').offset().top - 50;    
    setTimeout((function() {
            $('html,body').animate({scrollTop: top} ,{duration:0});
    }), 200);
});        
        
//Jquery Add to Wishlist  
$(function(){
    var get = "$get";
    if(get == 'form'){
        $('.btn-contact').trigger('click');
    }
});
var addcart = '.btn-votre-project';

$(addcart).on('click', function () {
        $(addcart).addClass('active');
		$(addcart).text('Ajouté');
        var name = $(addcart).attr("name");
        if(name == ""){
         $(addcart).attr("name","selected");
        var cart = $('.votre-project a');
        var imgtodrag = $('.collection-image .col-right').children('a').eq(0).find("img");
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '200px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');
            
            setTimeout(function () {
                cart.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
            
            
            
        }
        
        var url = '$dir' + 'votre-liste-envies';
        
        var tour_name = "$title";
        var tour_url = '$uri';
        var tour_id = "$id";
        var image = "$image";
        var seg1 = "$seg1";
        $.ajax({
            type: 'post',
            url: url,
            data: {
                type: 'prog',
                tour_id: tour_id,
                tour_name: tour_name,
                tour_url: tour_url,
                image: image,
                seg1: seg1,
            },
            dataType: 'html',
            success: function(data) {
               
               $('.number').load('$dir_uri #numb-tour'); 
            }

        });
        return false;
        
        }
        if(name == 'selected'){
			$('.btn-votre-project-1').html('<span>Ajouter à</span> votre liste d’envies');
            $('.btn-votre-project-2').text('Ajouter à votre liste d’envies');
            $(addcart).attr("name","");
            $(addcart).removeClass('active');
              var remove_id = "$id";
               var url = '$dir' + 'votre-liste-envies';
                var target = $(this);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        type: 'remove-prog',
                        remove_id: remove_id,
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('.number').load('$dir_uri #numb-tour'); 
                    }

                });
		return false;
        
        }
    });
 
//END Jquery add to wishlist   

        
//Jquery select option extensions
    
   var addextension = '.btn-extension';

   $('#popup_content').on('click', addextension, function(){
        var hClass = $(this).hasClass('active');
        var extension = $(this).attr('name');
        var numberPu = $(this).closest('.popup').data('pop');  
        $('#formules').find('.topopup[name='+numberPu+']').toggleClass('actived');
        if(hClass){
            $(this).text('Ajoutez au programme');
            $(this).removeClass('active');
            var url = '$dir_uri' + '/form';
            var target = $(this);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        type: 'remove-selected',
                        extension: extension,
                        
                    },
                    dataType: 'html',
                    success: function(data) {
                       
                    }

                });
		  return false;
        }else{
            
            $(this).text('Ajoutée au programme');
            $(this).addClass('active');
            if($(this).parent().find('.btn-devis-pop').length < 1){
                $(this).after('<a class="btn-devis-pop" href="/$uri/form">Voir votre devis</a>');
            }
            
            var url = '$dir_uri' + '/form';
            var target = $(this);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        type: 'selected',
                        extension: extension,
                        
                    },
                    dataType: 'html',
                    success: function(data) {
                       
                    }

                });
		return false;
        }
   });     
        
//END Jquery select option extensions
        
$(window).bind("load", function(){
    $('.program .tab-children .entry-content').each(function(index){
        $('.notes #' + (index + 1) ).clone().appendTo(this);
    });
	
	$('.back-button').clone().appendTo('.container-3 .row-1').css({'width' : '100%', 'margin' : '60px 0 0 0'});
});   


$('.btn-retour').click(function(){
    $('.area-form').hide();
    $('.entry-addthis').show();
    $('.non-area-form').show();
    $('.end-page').show();
  //  $('#devis-form').scrollTop(0); 
         $('html, body').animate({
            
            scrollTop: $('html').offset().top
            
        }, 200);
        
});    
        
jQuery(document).ready(function () {
     $('a.fancybox').fancybox({
           titlePosition: 'over', 
            centerOnScroll: true,
            padding: 2,
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
     
    var htmlExtenstion = false;

    function getExcl(target){
        if(!htmlExtenstion){
                    $.post('/amica-fr/extension-exclusives-tour-single', function(data){
                        $('#popup_content').prepend(data);
                        htmlExtenstion = true;
                        openPopup(target);
        
                        $('#popup_content iframe').each(function(index) {
                                var src = $(this).attr('src').split('?');

                                $(this).attr('src', src[0] + '?rel=0');


                        });        
        
                    });
            }  
    }

    function openPopup(target){
        var name = target.attr('name');
           loading(); // loading
           setTimeout(function(){ // then show popup, deley in .5 second
            loadPopup(); // function show popup
            $('html').css('overflow', 'hidden');
            $('.' + name).show();
            }, 500); // .5 second
    }
    
    $("div.topopup, .topopup").click(function() {
        var target = $(this);
        if(!htmlExtenstion){
            getExcl(target);
        } else openPopup(target);
        $('.sub-header-fixed').removeClass('show');
        return false;
    });
     
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
        $('html').css('overflow', 'auto');
    }
    /************** end: functions. **************/
}); // jQuery End
	   
// Jquery config Content
        
    // for (var i = 1; i < 30; i++) {
       // alert(i);
//        $('div.program h3:contains(jour ' + i + ' -)').html(function(_, html) {
//            return html.split('jour '+ i + ' -').join('<span class="fix-jour">jour '+ i +'.</span><span class="tt">');
//         });
//        }
        // $('div.program h3:contains(Jour ' + i + ' -)').html(function(_, html) {
        //     return html.split('Jour '+ i + ' -').join('<span class="fix-jour">Jour '+ i +'.</span><span class="tt">');
        //  });
        // }
        
        $('div.program .entry-content li:contains(L\'Hotel)').addClass('hotel');
        $('div.program .entry-content li:contains(Kayaking)').addClass('kayaking');
        $('div.program .entry-content li:contains(En avion)').addClass('en-avion');
        
    
        
        
        $(".tab-children > .tt-info").click(function() {
        
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
    
 $(document).ready(function(){
        $('.slider-right').bxSlider({
            slideWidth: 189,
            minSlides: 1,
            maxSlides: 1,
            slideMargin: 0,
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
            randomStart: false,
             captions: true,
            auto: false,
           // mode: 'fade',
            speed: 1000,
           onSlideBefore: function(slideElement, oldIndex, newIndex){
            var lazy = slideElement.find('.lazy');
            var load = lazy.attr('data-src');
            lazy.attr('src', load).removeClass('lazy');
        }
        
        });
    });
// End Jquery bxslider right  
$(function(){
    $('.button-to-devis-form').click(function(){
        $('.btn-contact').trigger('click');
    });
       
});
function onElementHeightChange(elm, callback){
    var lastHeight = elm.height(), newHeight;
    (function run(){
        newHeight = elm.height();
        if( lastHeight != newHeight )
            callback();
        lastHeight = newHeight;

        if( elm.onElementHeightChangeTimer )
            clearTimeout(elm.onElementHeightChangeTimer);

        elm.onElementHeightChangeTimer = setTimeout(run, 200);
    })();
}


onElementHeightChange($(document), displayFixedDevis);
function displayFixedDevis(){
        
    var btncontact = document.getElementsByClassName("btn-contact");
    if(btncontact === 1){
         
         var buttonRight = $('.area-1 .btn-contact').position();
     
        
        
        var iScrollPos = 0;

        var buttonRight = $('.area-1 .btn-contact').position();
        var lastScrollTop = 0;

        $(window).scroll(function(event){
            var posBtnBottom = $('.btn-deman').position();
           var st = $(this).scrollTop();
           if(!$('#devis-form').is(":visible")){
                if($(this).scrollTop() > (buttonRight.top + 70) && $(this).scrollTop() < (posBtnBottom.top - $(this).height())){
                    if (st < lastScrollTop){
                                    $('.button-fix-devis').addClass('active');
                            } else{
                              $('.button-fix-devis').removeClass('active');
                            } 
               } else {
                  $('.button-fix-devis').removeClass('active');
               }
               lastScrollTop = st;
           } else{
                $('.button-fix-devis').removeClass('active');
               
           }
        });
    }    
}
        
$('.download-pdf-close').click(function() {
        var url = '/ajaxphpdocx/ideas_tours_type_single_ajax.php';
        var data = {};
        var days = $('.calendar').text();
        var locations = $('.countries').text();
        var tour_type = $('#tour-type').text();
        var map = $('#maps-popup img').attr('src');
        var tourDays = '';
        $('.program .first-jour').each(function(){
            tourDays += $(this)[0].outerHTML;
        })    
        var time = new Date().getTime();
        $.ajax({
            url: url,
            type: 'post',
            data: {
               data: $data,
               days: days,
               locations: locations,
               tour_type : tour_type, 
               map: map,
               tourDays: tourDays,
               tourContent: $('#tourContent').html(),
               time: time,
               temName: '$temName',
               fileName: '$fileName'
            },
            dataType: 'html',
            success: function(data)
            {
                var win = window.open('/tour-output/'+'$fileName'+'.docx', '_blank');
                win.focus();
            },
            async: false

        });
        return false;
    });      

 $('.btn-tout').click(function(){
        var hClass = $(this).hasClass('active');
        if(hClass){
            $(this).removeClass('active');
            
            $(this).text('Tout Afficher');
            $('#tourContent .tab-children').removeClass('active');
        }else{
            $(this).addClass('active');
            
            $(this).text('Tout Réduire');
            $('#tourContent .tab-children').addClass('active');
        }
   });     
$('.cm-cb-nav').one('mouseenter', function(){
    $.post('', {type: "combien"},  function(data){
        $('#content-tour-tab').append(data);
    })
});	
$('#content-tour-nav > li.dropdown > .nav-item').click(function(){
    return false;
});
    
$("#content-tour-nav > li.dropdown").hover(function() {
   
    $("#content-tour-nav > li.dropdown > .dropdown-menu").addClass('show');
},
function() {
    
    $("#content-tour-nav > li.dropdown > .dropdown-menu").removeClass('show');
});  
        
        
var swiper = new Swiper('.suggest-slide', {
        slidesPerView: 3,
        slidesPerGroup: 3,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        nextButton: '.suggest-swiper-button-next',
        prevButton: '.suggest-swiper-button-prev',
        pagination: '.suggest-swiper-pagination',
//        navigation: {
//            nextEl: '.suggest-swiper-button-next',
//            prevEl: '.suggest-swiper-button-prev',
//        },
//        pagination: {
//            el: '.suggest-swiper-pagination',
//           
//        },
        breakpoints: {
            // when window width is <= 320px
            960: {
              slidesPerView: 3
            },
           
          }
    });           
        
$('.target-tab-price').click(function(){
    $('#prix-tab').click();
    var postionprixtab = $('#prix-tab').parent().parent().parent().position();
        console.log(postionprixtab);
    $('html,body').animate({
            scrollTop: postionprixtab.top - 137
        }, 700); 
});  
        
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$illus1 = $illus[2]->image;
$illus3 = $illus[0]->image;
$css = <<<CSS
.row-content-1{
    background: url('$illus1') 15px 15px no-repeat #fff;
}

#content-tour-tab #program.tab-pane:after{
    content: '';
    width: 421px;
    height: 618px;
    display: inline-block;
    position: absolute;
    left: 0;
    top: 120px;
    background: url($illus3) left center no-repeat #f7f7f7;
}
#content-tour-tab #program.tab-pane{
    background: #f7f7f7;
}
#content-tour-tab #program.after-sticky:after{
    position: fixed;

}
#content-tour-tab #program.after-bottom:after{
    top: auto;
    bottom: 80px;

}
#content-tour-tab .tab-pane{
    background: url($illus3) left center no-repeat #f7f7f7;
}
.tour-content {
    background: url(/assets/img/tour/bg-intro-$seg1.png) left center no-repeat #f7f7f7;
}
#content-tour-tab #folder{
    background: none;
}
CSS;
$this->registerCss($css);
?>
<? endif; ?>