
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]);
?>

<div class="contain no-padding container-filter">
    <div class="column">
        <? include('_inc_menu_all_page_destinations.php'); ?>
    </div>
</div>
<div class="contain container-2 non-area-form">
    <div class="column">
            
        <div class="row-content banner">
            <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
            
                <img alt="<?= $banner->description ?>" class="lazyload img-responsive" data-sizes= 'auto' data-src="<?= $banner->image; ?>" data-srcset='/thumb/640/440/1/80<?= $banner->image?> 450w, <?= $banner->image?>'>
                
            <?
            }
            ?>
            <div class="text-on-banner">
                <h1><?= $this->context->pageT?></h1>
<!--                <a data-transition="slide" href="#search-page">Rechercher une idée de voyage</a>-->
            </div>            
        </div>
        <div class="row-content country-tours">
            <?//=$theEntry->contentsMobile[0]->description ?>
            
            <div class="text-sumary sub-text">
                <?php
                    $subtext = explode('</p>', $theEntry->model->content);
                    unset($subtext[count($subtext) - 1]);
                    
                   //echo $subtext[0]. ' <span class="view-more tt-color-e65925">Lire la suite</span></p>';
                    $cnt = 0;
                    foreach ($subtext as $sub) {
                        $cnt++;
                        if($cnt == 1 && $cnt == count($subtext)){
                            echo $sub. '</p>';
                        }else if($cnt == 1 && $cnt < count($subtext)){
                            echo $sub. ' <span class="view-more tt-color-e65925">Lire la suite</span></p>';
                            echo '<div class="full-text">';
                        }else if($cnt > 1 && $cnt < count($subtext)){
                            
                                echo $sub.'</p>';
                        }else if($cnt == count($subtext)){
                                echo $sub. '</p><p><span class="close-text tt-color-e65925">Réduire</span></p>';
                                echo '</div>';
                            
                            
                        }
                        
                    }
                ?>
            </div>
            <span class="space space-10"></span>
            <div class="tour-slider swiper-container bullet-dynamic">
                <div class="swiper-wrapper">
               
                <? foreach($tourType->items() as $key=> $value) : ?>
                    <? 
                    $class = '';
                    ?>
                    <div class="swiper-slide item-img" data-animation="<?=$class?>" >
                    <a href="<?=DIR.$value->slug ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="cats_section" data-analytics-label="cat_card_<?= $value->model->item_id ?>">
                                    <? if(isset($value->photosArray['summary'])) :
                                    $v = $value->photosArray['summary'][0];
                                    ?>
                            <img class="lazyload img-full" alt='<?= $v->description?>' data-sizes="auto"
    data-src="<?= $v->image?>"
    data-srcset="<?= $v->image?>"/>
<!--    data-srcset="/thumb/300/200/1/80<?//= $v->image?> 300w,
    /thumb/600/400/1/80<?//= $v->image?> 600w,
    /thumb/900/600/1/80<?//= $v->image?> 900w"/>-->
                        <? endif; ?>
                        <div class="text-on-img">
                        <h3><?=$value->title?></h3>
                        </div>
                    </a>
                    </div>
                <? endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <? include '_inc_video_page.php'; ?>
        <div class="row-content pourquoi <?=SEG1?>">
            <h2 class="title-row mt-0">Pourquoi nous choisir ?</h2>
            <div class="detail ">
                <? if(SEG1=='birmanie') : ?>
                    <div class="item-detail">
                        <img alt="" class="lazyload" data-src='/assets/img/new-pays/birmanie/pourquoi-1.png'/>
                        <span>Voyage sur mesure<br>en birmanie</span>
                    </div>
                    <div class="item-detail">
                        <img alt="" class="lazyload" data-src='/assets/img/new-pays/birmanie/preparer-item-2.png'/>
                        <span>Des experts à<br>votre service</span>
                    </div>
                    <div class="item-detail">
                        <img alt="" class="lazyload" data-src='/assets/img/new-pays/birmanie/preparer-item-3.png'/>
                        <span>Rapidité<br>& disponibilité</span>
                    </div>
                <? else: ?>
                    <div class="item-detail">
                    <img alt="" class="lazyload" data-src='/assets/img/mobile/pourquoi-1.png'/>
                    <span>Équipe locale<br>et passionnée</span>
                    </div>
                    <div class="item-detail">
                        <img alt="" class="lazyload" data-src='/assets/img/mobile/pourquoi-3.png'/>
                        <span>Engagement vers<br>un tourisme solidaire</span>
                    </div>
                    <div class="item-detail">
                        <img alt="" class="lazyload" data-src='/assets/img/mobile/pourquoi-2.png'/>
                        <span>Créativité<br>& Originalité</span>
                    </div>
                <? endif; ?>
            </div>
            <span data-ajax="false" data-title="<?= base64_encode(DIR.'devis') ?>" class="devis-btn pugjd" data-analytics="on" data-analytics-category="country_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis<p>Nous vous répondrons sous 48H</p></span>
        </div>
        <? if(SEG1!='birmanie') : ?>
        <div class="row-content secrets">
            <h2 class="title-row"><?=$secretType->title; ?></h2>
            <div class="text-row"><?=$secretType->model->content; ?></div>
            <div class="secrets-slider swiper-container full-width">
                    <div class="swiper-wrapper">
                
                    <? foreach($secretType->items() as $key=> $value) : ?>
                        <div class="swiper-slide item-img">
                        <a href="<?=DIR.$value->slug ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="formule_cat_card_<?= $value->model->item_id ?>">
                            <? $i = ''; ?>
                                        <? foreach ($value->photos as $kp => $vp) : ?>
                                            <? if($vp->type == 'summary')
                                                        $i = $kp; ?>
                                        <? endforeach; ?>
                                <img class="lazyload img-full" 
    data-src="<?= $value->photos[$i]->image?>"
    data-srcset="<?= $value->photos[$i]->image?>" alt="<?=$value->photos[$i]->description?>"/>
                            <h3 class="text-on-img"><?=$value->title?></h3>
                        </a>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <? endif; ?>
        <div class="row-content preparer-voyage <?=SEG1?>">
            <h2 class="title-row">Préparer votre voyage <?=SEG1=='birmanie' ? 'en' : 'au' ?> <?= ucfirst(SEG1) ?></h2>
            <? foreach ($infos as $kif => $if): ?>
             <a class="link-item-preparer" href="<?=DIR.$if->slug; ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="info_section" data-analytics-label="info_iconbig_<?= $if->category_id ?>">
                <div class="item-preparer">
                    <div class="img">
                        <img class="lazyload" alt="" data-src="/assets/img/new-pays/preparer-item-<?=$kif+1 ?>.png">
                        <h3 class="big-text"><?=$if->title; ?></h3>
                    </div>
                    
                </div>
            </a>
            <? endforeach; ?>
            <div class="clearfix"></div>
            <a data-ajax="false" class="infos-btn <?=SEG1?>" href="<?=DIR.SEG1.'/informations-pratiques'?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="info_section" data-analytics-label="cta_c_infos">Toutes les infos pratiques</a>
        </div>
        <div class="row-content testi-home mt-80">
            <h2 class="tt mt-0 mb-txt-50">Ils nous ont fait confiance</h2>
            <p class="summary mt-0 mb-txt-80"><?=$testiModule->model->summary; ?></p>
            <div class="testi-slider">
                <div class="swiper-wrapper">
                    <? foreach ($arrTemoignages as $k => $v) : ?>
                    <div class="swiper-slide">
                        <? $countries = isset($v['data']->countries) ? $v['data']->countries : [];
                        $countries = \yii\helpers\ArrayHelper::getColumn($countries, function($e){
                                        return Yii::$app->params['tsDestinationList'][$e];    
                                     });
                        ?>
<!--                        <a href="/temoignages/<?//=$v['slug'] ?>">-->
                        <p class="summary mt-0 mb-txt-50 text-center">“<?= $v['summary'] ?>”</p>    
                            
                        <div class="img-text">
                            <? if(isset($v['photos'][0])) :  ?>
                            <img width="100" data-src="/thumb/100/100/1/80<?=$v['photos'][0]['image']?>"  alt="<?=$v['photos'][0]['description']?>">
                            <? endif; ?>
                            <div class="info-testi">
                                <span class="tt-name"><?= isset($v['data']->nameclient) ? $v['data']->nameclient : ''?></span>
                                <span class="tt-info"><?=implode(', ',$countries)?>, <?//=date('M Y',$v['time']) ?>  <?=ucfirst(Yii::$app->formatter->asDate($v['time'], 'php:F Y'))?></span>
                            </div>
                        </div>
                        
                        
<!--                        </a>-->
                    </div>
                    <? endforeach; ?>
                </div>
                <div class="swiper-pagination">
                </div>
            </div>
            
            <div class="area-logo-recom mt-50 mb-80">
                <p class="tt tt-custom">Ils nous ont recommandé</p>
                <div class="logo">
                    <img alt="" style="max-width: 5.2rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-trip.jpg" />
                    <img alt="" style="max-width: 3.4rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-rou.jpg" />
                    <img alt="" style="max-width: 4.8rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-petit.jpg" />
                    <img alt="" style="max-width: 6.5rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-lonely.jpg" />
                </div>
            </div>
        </div>   
    </div>

    
</div>
<!-- Start of second page -->


<? 
$country = SEG1;
$uri = URI;
$js = <<< JS
$(window).on('scroll', function () {
        if($(window).scrollTop() > 30){
            $('.menu-slider').addClass('fixed-header');
        }
        else{
            $('.menu-slider').removeClass('fixed-header');
        }
    });

var menuSwiper = new Swiper('.menu-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 30,
        grabCursor: true
    }); 
var tourSwiper = new Swiper('.tour-slider', {
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
var secretSwiper = new Swiper('.secrets-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });
var testiSwiper = new Swiper('.testi-slider', {
    pagination: '.swiper-pagination',
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 30,
        lazyLoading: true,
        loop: false,
         pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
        
    $('.text-sumary .view-more').click(function(){
        
        $('.full-text').show();
        $(this).hide();
   });    
        
    $('.text-sumary .close-text').click(function(){
        $('.view-more').show();
        $('.full-text').hide();
   }); 
        
JS;
$this->registerJs($js); 
?>