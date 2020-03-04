<? $this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]);

$this->registerCssFile('/assets/css/page2016/nos-destinations-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]) ?>

<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php
$text = '';
$cssText1 = '';
$cssText2 = '';
switch (SEG1) {
    case 'vietnam':
        $text = 'au Vietnam';
        $cssText1 = 'width-75';
        $cssText2 = 'width-62';
        break;
    case 'cambodge':
        $text = 'au Cambodge';
        $cssText1 = 'width-73';
        $cssText2 = 'width-60';
        break;
    case 'laos':
        $text = 'au Laos';
        $cssText1 = 'width-79';
        $cssText2 = 'width-66';
        break;
    case 'birmanie':
        $text = 'en Birmanie';
        $cssText1 = 'width-75';
        $cssText2 = 'width-62';
        break;
    default:
        $text = '';
        break;
}
?>
<div class="contain container-1">
    <? if(isset($theEntry->model->photos)) : ?>
    <?
    $banner = '';
    foreach ($theEntry->model->photos as $key => $value) {
        if($value->type == 'banner') $banner = $value;
    } ?>
    <img style="width: 100%;" alt="<?=$banner->description; ?>" class="img-lazy" data-src='<?=$banner->image ?>'>
    <? endif; ?>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>
     <div class="amc-column row-2 mb-txt-40">

        <h1 class="title m-0"><?=$theEntry->model->seo->h1 ?></h1>

    </div>


</div>
<div class="container-flud amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="amc-column column">
            <ul>
                <li  class="<?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_country"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>
<div class="contain container-2 mb-60 responsive-entry-body">
    <div class="amc-column">
        <div class="rows row-1">
                <div id="my-tab-content" class="tab-content mt-10">
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
                            <div class="amc-col-1 d-none d-sm-none d-lg-block">
                                <?
                                $i=0;
                                foreach ($optRegion as $key => $value) : ?>
                                    <div class="le <?=SEG1 ?> le_<?=strtolower($key)?> <?=$key?> <?=$i==0 && SEG1 !='cambodge' ? 'active' : ''?> <?=$i==2 && SEG1 =='cambodge' ? 'active' : ''?>"></div>
                                    <? $i++; ?>
                                <? endforeach; ?>
                                <? if(SEG1=='vietnam') : ?>
                                    <img alt="" class="bg-vietnam" data-src="/assets/img/maps/vietnam/bg-vietnam-visiter.png">
                                <? endif; ?>
                                <div class="clearfix"></div>
                                <a id="load-maps" class="view-all-maps btn-amica-basic btn-amica-basic-1 m-0 <?=SEG1?> fancybox" href="#big-maps" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="area_section" data-analytics-label="cta_map">Afficher la carte</a>
                            </div>
                            <div class="amc-col-2">
                                <div class="btn-form">
                                    <form class="quick-search">
                                        <h2 for="">Une destination ?</h2>
                    <? $allRoot =  \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->items(['pagination' => ['pageSize' => 0]]);
                    $optDes = \yii\helpers\ArrayHelper::map($allRoot, 'slug', 'title');
                    ?>
                    <? $txtPlaceInput = [
                        'vietnam' => 'Tapez le nom d’un site (Hanoi, Hoi An...)',
                        'laos' => 'Tapez le nom d’un site (Vientiane, Paksé...)',
                        'cambodge' => 'Tapez le nom d’un site (Sieam Reap,...)',
                        'birmanie' => 'Tapez le nom d’un site (Bagan, Yagon...)'
                    ]; ?>
                    <?= \yii\helpers\Html::dropDownList('search_destination', null, $optDes,[
                        'class' => 'chosen',
                        'multiple' => 'multiple',
                        'data-placeholder' => $txtPlaceInput[SEG1],
                        'id' => 'search_destination',
                        'style' => 'width: 345px;',
                        'data-analytics'=>"on",
                        'data-analytics-category'=>"cities_page",
                        'data-analytics-action'=>"area_section",
                        'data-analytics-label'=>"search_city"
                    ]) ?>
                                    </form>
                                </div>
                                
                                <div class="amc-col-1 d-none d-sm-block d-lg-none" style="margin: 0 auto 60px; float: none; clear: both;">
                                    <?
                                    $i=0;
                                    foreach ($optRegion as $key => $value) : ?>
                                        <div class="le <?=SEG1 ?> le_<?=strtolower($key)?> <?=$key?> <?=$i==0 ? 'active' : ''?>"></div>
                                        <? $i++; ?>
                                    <? endforeach; ?>
                                    <? if(SEG1=='vietnam') : ?>
                                        <img alt="" class="bg-vietnam" data-src="/assets/img/maps/vietnam/bg-vietnam-visiter.png">
                                    <? endif; ?>
                                    <div class="clearfix"></div>
                                    <a class="view-all-maps btn-amica-basic btn-amica-basic-1 m-0 <?=SEG1?> fancybox" href="#big-maps" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="area_section" data-analytics-label="cta_map">AFFICHER LA CARTE</a>
                                </div>
                                
                                <?
                                $i=0;
                                foreach ($optRegion as $key => $value) : ?>
                                    <div class="le le-map" data-name="<?=$key?>">
                                        <span class="tx-1" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="area_section" data-analytics-label="toggle_<?= strtolower($key) ?>"><?=$value?></span>
                                        <span class="tx-2 <?=$i==0 && SEG1 !='cambodge' ? 'active' : ''?> <?=$i==2 && SEG1 =='cambodge' ? 'active' : ''?>"></span>
                                        <div class="option <?=$i==0 && SEG1 !='cambodge' ? 'active' : ''?> <?=$i==2 && SEG1 =='cambodge' ? 'active' : ''?>">
                                            <p>
                                            <? $regionLocation = $locations->items(['filters' => ['region' => $key],'pagination' => ['pageSize' => 0]]);
                                            foreach ($regionLocation as $kl => $vl) {
                                                echo '<a href="'.DIR.$vl->slug.'" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="area_section" data-analytics-label="link_city_'.$vl->model->item_id.'">'.$vl->title.'</a>';
                                                if($kl == count($regionLocation) - 1) break;
                                                echo ' / ';
                                            } ?>
                                            </p>
                                            <span class="hide-option pointer">Raccourcir</span>
                                        </div>
                                    </div>
                                    <? $i++; ?>
                                <? endforeach; ?>
                            </div>
                            <? endif; ?>
                        </div>
                        <div class="r r2 mt-60">
                            <div class="fix-text mt-0 mb-0">
                                <h2 class="tx-1-amica-seo-92 mb-txt-40">Une envie <?= $text; ?> ?</h2>
                              
                            </div>
                            <div class="list-tour">
                                <? $envies = \app\modules\destinations\api\Catalog::cat(SEG1.'/envies')?>
                                <? if($envies) : ?>
                                <? foreach ($envies->items(['pagination'=>['pageSize' => 0]]) as $key => $value) : ?>
                                    <div class="item item-<?=$key+1?> mt-0 mb-40">
                                    <a href="<?=DIR.$value->slug ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="envy_section" data-analytics-label="envy_card_<?= $value->model->item_id ?>">
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
                        <div class="r r3 mt-txt-25">
                            <div class="fix-text mt-0 mb-0">
                                <h2 class="tx-1-amica-seo-92 mb-txt-40">Tous les sites à visiter <?= $text; ?> :</h2>
                                
                            </div>
                           <div class="amc-col col-left">
                               
                                <?
                                if (Yii::$app->request->get('see-more') == NULL) {
                                    if (Yii::$app->request->get('page') != NULL) {
                                        $seemore = Yii::$app->request->get('page') * 4;
                                    }else{
                                        $seemore = 4;
                                    }

                                } else {
                                    $seemore = Yii::$app->request->get('see-more');
                                }
                                if (Yii::$app->request->get('page') == NULL) {
                                    $page = $pagesize / 4;
                                } else {
                                    $page = Yii::$app->request->get('page');
                                }
                              
                                if (Yii::$app->request->get('before-page') == NULL) {
                                    $page = $seemore / 4;
                                } else {
                                    $page = Yii::$app->request->get('before-page');
                                }
                                //  var_dump($page);exit;
                                ?>    
                               
                               <div class="ajaxfilter">
                                <div id="des-ajax" class="getcontent">
                                    <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                                    <div class="text-center see-more-prev mb-40 mt-0">
                                        <span class="btn-submit ajax-see-more-prev btn-amica-basic btn-amica-basic-1" data-get="" data-seemore="<?= (($page + 1) * 4) ?>" data-value='' data-page="<?= $page - 1 ?>">Lieux précédents</span>
                                    </div>
                                    <? } ?>
                                <?
                                $cnt = 0;
                                $count = count($visiter);
                                foreach ($visiter as $key => $value) :
                                    $cnt++;
                                    ?>
                                    
                                    <div class="clear-fix item item-<?=$key+1?>">
                                        <div class="left" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="list_section" data-analytics-label="city_card_<?= $value->model->item_id ?>">
                                        <a href="<?=DIR.$value->slug?>">
                                        <?
                                        $hasSummary = false;
                                        if(isset($value->photos)) {
                                            foreach ($value->photos as $kp => $vp) {
                                                if($vp->type == 'summary'){

                                                    echo '<img style="width: 329px; height: 219px;" alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'"/>';
                                                    $hasSummary = true;
                                                    break;
                                                }
                                            }
                                        } ?>
                                        <?// if(!$hasSummary) : ?>
<!--                                            <img style="width: 329px; height: 219px;" alt="" class="img-lazy img-responsive" data-src="<?//=DIR?>assets/img/page2016/img-329-219.jpg"/>-->
                                        <?// endif; ?>
                                        </a>
                                    </div>
                                    <div class="right ml-25">
                                        <h3 class="tt"><a href="<?=DIR.$value->slug?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="list_section" data-analytics-label="city_card_t_<?= $value->model->item_id ?>"><?=$value->title?></a></h3>
                                        <div class="text">
                                            <p>
                                                <?=$value->model->summary?>
                                            </p>
                                        </div>

                                        <span class="posi"><?
                                         if(isset($value->data->envies)){
                                            $visiterEnvies = $value->data->envies;
                                            $envies = \app\modules\destinations\api\Catalog::items([
                                                'where' => [
                                                    'item_id' => $visiterEnvies
                                                ]
                                            ]);
                                            foreach ($envies as $kve => $vve) {
                                                 echo $vve->title;
                                                if($kve==count($envies) - 1) break;
                                                echo ", ";
                                         }
                                         }
                                         ?></span>
                                    </div>
                                </div>
                                <?
                                if(count($visiter) > $cnt){
                                    echo '<span class="space space-40"></span>';
                                }
                                ?>
                                <? endforeach; ?>
                                <?    
                                if($totalCount > $pagesize && ($totalCount / 4) > $page){
                                ?>   
                                    <div class="amc-area-detaile-number-items mt-txt-40">
                                        <div>
                                            <? if($totalCount < 2){ ?>
                                                <span class="amc-text">Vous avez vu le seul lieu <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
                                            <? }else{ ?>
                                                <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> lieux sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
                                            <? } ?>
                                            <div class="amc-area-prog-btn">
                                                <div>
                                                    <div class="amc-progress mt-txt-25" <?= ($totalCount > $pagesize && ($totalCount / 4) > $page) ? '' : 'style="width: 175px;"' ?>>
                                                        <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
                                                    </div>
                                               
                                                    <div class="see-more mt-25">
                                                        <span class="btn-submit ajax-see-more btn-amica-basic btn-amica-basic-1" data-get="" data-seemore="<?= ($page + 1)*4 ?>" data-value='' data-page="<?= $page + 1 ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="list_section" data-analytics-label="cta_more">Plus de lieux</span>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>   
                               
                                </div>
                              </div>
                                
                             <!-- BACK BUTTON -->
                            <?// include '_inc_back_button.php'; ?>
                            <!-- End BACK BUTTON -->  
                            </div>
                            <div class="amc-col col-right ml-40 d-none d-sm-none d-lg-block">
                                <div class="area-1">
                                    <div class="button-right-devis m-0">
                                        <p class="tt">Besoin de conseil<br>
                                        d’un expert ?</p>
                                        <ul>
                                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline;"></li>
                                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                                        </ul>
                                        <span class="pugjd btn-contact pointer btn-amica-basic btn-amica-basic-2" data-title="<?= base64_encode(DIR.'devis') ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</span>
                                    </div>
                                    <? if(SEG1 != 'birmanie') : ?>
                                        <div class="guide mt-40">

                                            <p class="mb-txt-25"><span>Guide <?= ucwords(SEG1)?></span> gratuit</p>
                                            <img  class="img-lazy mb-25" alt="" data-src="/timthumb.php?src=/assets/img/new-pays/<?=SEG1?>/guide-<?=SEG1?>.jpg&w=220&zc=1&q=80">
                                            <div class="text">
                                                <p class="bigger">Quand partir </p>
                                                <p class="bigger">Comment </p>
                                                <p class="bigger">Combien...</p>
                                                <p class="mt-txt-25 mb-0">Vous trouverez toutes les réponses à vos questions pour préparer votre voyage au <?=ucfirst(SEG1) ?></p>
                                                <form id="download-guide-form">
                                                    <input class="email mt-txt-25 mb-25 radius-5" data-pdf="https://www.amica-travel.com/uploads/files/amica-travel-voyage-au-<?=SEG1?>.pdf" type="text" value="" placeholder="Votre adresse mail" name="email">
                                                    <p class="error-email">
                                                        Le format de votre email n'est pas valide.
                                                    </p>
                                                    <span class="submit-email btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="pdf_section" data-analytics-label="btn_download">Télécharger</span>
                                                </form>
                                            </div>
                                        </div>
                                    <? endif; ?>

                                </div>

                            </div>

                        </div>

                        <div class="r r4 video">
                            <? $videoVisiter = \app\modules\destinations\api\Catalog::get(SEG1.'/sites-a-visiter'); ?>
                            <?=$videoVisiter ? $videoVisiter->description : '' ?>
                        </div>
                        <div id="big-maps" style="width: 600px;">
                        <?// include("maps/big-maps.php"); ?>
                        </div>    
                    </div>
                    <? endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="contain mb-60 pt-25 pb-25 mt-0 responsive-area-devis-col-left d-none d-lg-none d-sm-block">
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
<?php
$seg1 = SEG1;
$js=<<<JS
$('.chosen').chosen({ search_contains: true});
$('#search_destination').on('change', function(evt, params) {
    window.location = '/'+params.selected;
    return false;
  });
//$('.chosen-container').on('click',function(){
//    var hClass = $(this).hasClass('.chosen-container-active');
//        
//    if(!hClass){
//        $('#search_destination').click();
//    }    
//});
$(window).bind('load', function(){
    
    $('.chosen-container input').attr({ 'data-analytics':'on', 'data-analytics-category':'cities_page', 'data-analytics-action':'area_section', 'data-analytics-label':'search_city' });  
    
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
             $('html, body').animate({scrollTop: $('#des-ajax').offset().top - 200}, 1000);
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
$('#download-guide-form .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          
        }else{
            $('#download-guide-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#download-guide-form .error-email').hide();
        } 
});         
$('#download-guide-form .submit-email').click(function(){
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          return false;
        } 
        $.post(url, { email: $('#download-guide-form .email').val(), type: 'guide' }, function(data){ 
                if(data){
                $('#download-guide-form .submit-email').text('Merci'); 
                $('#download-guide-form .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'}); 
                $('#download-guide-form .submit-email').addClass('submited'); 
                window.open($('#download-guide-form input').data('pdf'),'_blank');
                }else{ 
                    return false;
                }
            });
    }else{
        return false;
    }
});  
   
   $('.view-all-maps').click(function(){
        $('html').addClass('amc-overlay-lock');
   });
   $(document).on('mouseenter','.fancybox-overlay, .fancybox-close',function(){
        
       $('html').removeClass('amc-overlay-lock');
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
        
        
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$css = <<<CSS
.chosen-drop .chosen-results{
    display: none;
}
.back-button{
    margin-top: 0;
}

.chosen-container .chosen-results li{
    text-align: left;
}
.back-button-left{
    text-align: center;
    width: 700px;
    float: left;
}
.back-button a{
    display: inline-block;
    width: auto;
}
.container-2 .tab-panel-2 .amc-col-2 .le .tx-1{
    background: #e6a85e;
}
.view-all-maps.vietnam {
    margin-top: 10px !important;
}
.view-all-maps.cambodge {
    margin-top: 60px !important;
}
.view-all-maps.laos {
    margin-top: 60px !important;
}
.view-all-maps.birmanie {
    margin-top: 55px !important;
}
.container-2 .tab-panel-2 .r3 .col-left .item .right .posi, .container-2 .tab-panel-3 .r2 .col-left .item .right .posi{
    color: #c3c2c1;
}
CSS;
if(SEG1 == 'laos')
    $css .= '.container-2 .tab-panel-2 .amc-col-2 .le .tx-1{
    background: #e65925;
}
.container-2 .tab-panel-2 .r3 .tx-2 {
    width: 68%;
    float: right;
}';
if(SEG1 == 'cambodge')
    $css .= '.container-2 .tab-panel-2 .amc-col-2 .le .tx-1{
    background: #ca8b09;
}
.container-2 .tab-panel-2 .r3 .tx-2 {
    width: 62%;
    float: right;
}';
if(SEG1 == 'birmanie')
    $css .= '.container-2 .tab-panel-2 .amc-col-2 .le .tx-1{
    background: #d64c48;
}
.container-2 .tab-panel-2 .r3 .tx-2 {

    float: right;
}
';

$this->registerCss($css);
?>
