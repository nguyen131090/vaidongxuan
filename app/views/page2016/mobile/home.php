
<? 
use yii\helpers\Markdown; 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('/assets/css/mobile/home.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
?>
<div class="column home">
    <div class="rows row-banner contain no-padding">

    <div id="home-banner-slider" class="slide">
            <?  $home = \yii\easyii\modules\page\api\Page::get(31); 
                   if(!empty($home->photosArray['banner-mobile'])) : 
                    $bannerImages = array_reverse($home->photosArray['banner-mobile']);
                   foreach ($bannerImages as $key => $value) : ?>
                        <? if($key) break;  ?>    
                        <div class="swiper-slide">
                            
                            <?=$key ? '<a class="fill" href="'.$value->description.'">' : '<a class="fill" href="'.$value->description.'">' ?><img alt="" class="lazyload" data-sizes= 'auto' data-src="<?= $value->image?>" data-srcset='/thumb/640/440/1/80/<?= $value->image?> 450w, <?= $value->image?>'>
                            <div class="slide-caption">
                                <?=$key==0 ? '<h1 class="mt-0 p-0 tt-fontsize-45 tt-color-white tt-latolatin-bold">' : '<h2>' ?><?=strip_tags(Markdown::process($value->model->caption));?><?=$key==0 ? '</h1>' : '</h2>' ?>
                            </div>
                            <?=$key ? '</a>' : '</a>' ?>
                        </div>
                <? endforeach; ?>
            <? endif;?>
    </div>
    <div class="groups-menu contain w-100">
            <?
                $arrDataAnalyticsLabel = ['/voyage-avec-amica-travel'=>'link_voyage','/explorateurs'=>'link_explorateurs','/formules'=>'link_secrets','/chez-habitant-indochine'=>'link_habitant','/tourisme-solidaire'=>'link_tourisme'];
            ?>
            <? 
            foreach ($bannerImages as $key => $value) : ?>
                        <? 
                        if(!$key) continue; 
                        ?>
                        <button data-role='none' class="item item-<?=$key+1 ?> pugjd" data-title="<?= base64_encode($value->description);?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="cover_section" data-analytics-label="<?= $arrDataAnalyticsLabel[$value->description] ?>">
                            <img width="" alt="" data-src="<?=$value->image?>">
                            <div class="entry-title text-left">
                                    <p><?=strip_tags(Markdown::process($value->model->caption), '<strong>'); ?></p>
                                </div>   
                        </button>
         <? endforeach; ?>  
    </div>
</div> 
<!--<div class="contain row row-link-filter full-width" data-role='none'>
    <a class="btn-to-filter" href="#search-page-voyage" data-transition="slide" data-direction="reverse">Rechercher une idée de voyage</a>
</div>-->
<div class="contain container-1">
    <div class="row-content pay-home">
        <h2 class="mb-txt-50 mt-80">Partir en Indochine</h2>
        <div class="mt-0 mb-txt-50">
            <p >
            Se situant au carrefour d’influences multiples et fécondes, l’Indochine continentale fait rêver les voyageurs grâce à ses paysages variés, sa mosaïque humaine et à sa culture typique. 
            </p>
            <p>
            Que ce soit le Vietnam, le Laos, le Cambodge ou la Birmanie,  si vous avez envie d’un voyage totalement dépaysant et en même temps un voyage fait de rencontres, d’immersions et de découvertes exotiques, laissez-vous envoûter par nos 4 destinations ! 
            </p>
        </div>
        <div class="countries-slider swiper-container full-width my-0">
                <div class="swiper-wrapper">
            
                <? foreach($desRoot as $key => $value) : ?>
                    <div class="swiper-slide item-img">
                    <a href="<?=DIR.$value->slug ?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="country_section" data-analytics-label="link_<?= $value->slug ?>">
                        <? $i = ''; ?>
                                    <? foreach ($value->photos as $kp => $vp) : ?>
                                        <? if($vp->type == 'on-home'){ $i = $kp; ?>
                        <img style="min-height: 13.6rem;" alt="<?=$value->photos[$i]->description?>" data-src="<?=$value->photos[$i]->image?>" class=""/>
                                        <? } ?>
                                    <? endforeach; ?>
                        <div class="text">
                        <p class="text-on-img tt-fontsize-28 tt-latolatin-bold"><?=$value->title?></p>
                        <p class="summary mb-0 mt-0"><?=$value->sub_title?></p>
                        </div>
                    </a>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
     <? if(!empty($theEntry->data->video)) { ?>
    <div id="video" class="row-content mt-80">
            <?= str_replace('<iframe', '<iframe data-analytics="on" data-analytics-category="homepage" data-analytics-action="video_section" data-analytics-label="control_play"', $theEntry->data->video); ?> 
    </div>
    <? } ?>
    
    <div class="row-content secret-home">
        <div class="entry-data-field">
            <?= $theEntry->data->inspirations ?>
     
        </div>
<!--        <h2 class="title-secret mt-txt-80 mb-txt-50">Nos inspirations de voyage</h2>
        <p class="content-secret mt-0 mb-txt-50"><?//=$entryVoyage->model->summary ?></p>-->
        <div class="tour-slider swiper-container full-width my-0 bullet-dynamic">
                <div class="swiper-wrapper">
                <? foreach($arrProg as $key => $value) : ?>
                    <div class="swiper-slide item-img">
                    <a href="<?=DIR.$value->slug ?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="inspirations_section" data-analytics-label="link_inspi_<?= $value->category_id ?>">
                        <? $i = ''; ?>
                                    <? if ($value->photosArray['custom-mobile']) : ?>
                                        <? $vimg = $value->photosArray['custom-mobile'][0]; ?>
                        <img style="min-height: 20rem;" class="img-lazy img-full" alt="<?=$vimg->description?>" data-src="<?=$vimg->image?>"/>
                                    <? endif; ?>
                         
                        <div class="text-on-img">
                            <p><?=$value->title?></p>
                        </div>
                    </a>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="row-content select-tours-home">
        <div class="entry-data-field">
            <?= $theEntry->data->circuits ?>
     
        </div>
<!--        <h2 class="tt mt-80 mb-txt-50">Nos circuits tendances</h2>
        <p class="summary mt-0 mb-txt-50"><?//=$listIdTours->model->summary; ?></p>-->
        <? foreach($selectTours as $key => $v) : ?>
            <? if($key > 2 ) break; ?>
            <div class="select-tour-item amc-fix-pb-25-0">
            <? if(isset($v->photosArray['summary'])) : ?>
                <a href="/<?=$v->slug; ?>" class="mb-txt-50">
<!--                    <img style="min-height: 20rem;" class="w-100  focus-center" data-src="<?//=$v->photosArray['on-home'][0]->image ?>">-->
                    <img style="min-height: 20rem;" alt="<?=$v->photosArray['on-home'][0]->description ?>" class="lazyload w-100 focus-center" data-sizes= 'auto' data-src="<?= $v->photosArray['on-home'][0]->image?>" data-srcset='/thumb/640/440/1/80<?= $v->photosArray['on-home'][0]->image?> 450w, <?= $v->photosArray['on-home'][0]->image?>' data-analytics="on" data-analytics-category="homepage" data-analytics-action="itineraries_section" data-analytics-label="itinerary_card_<?= $v->model->item_id ?>">
                </a>
            <? endif; ?>
                <div class="text">
<!--                    <span class="space space-10 space-horizontal"></span>    -->
                    <p class="tt-color-6b6b6b tt-fontsize-28 p-0 m-0 amc-fix-mt-12-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                    <p class="tt tt-latolatin-bold m-0 p-0 amc-fix-mt-15 "><a href="/<?=$v->slug; ?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="itineraries_section" data-analytics-label="itinerary_card_t_<?= $v->model->item_id ?>"><?=$v->title;?></a></p>
                    <? if($v->model->sub_title != NULL){ ?>
                        <p class="m-0 p-0 amc-fix-mt-12 tt-fontsize-28 tt-latolatin-regular tt-custom-sub-tt"><?= $v->model->sub_title ?></p>
                    <? } ?> 
                    <p class="m-0 p-0 amc-fix-mt-15"><?= $v->model->summary ?></p>
                    <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                        <p class="tt-color-6b6b6b tt-fontsize-28 m-0 p-0 amc-fix-mt-15">
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
        <? endforeach; ?>
        <a data-ajax="false" class="infos-btn vietnam ui-link mt-0 mb-80" href="/voyage/itineraire" data-analytics="on" data-analytics-category="homepage" data-analytics-action="itineraries_section" data-analytics-label="cta_itineraries">Toutes nos idées de voyage</a>
    </div>
    <div class="row-content excl-container full-width">
        <img alt="" class="w-100 focus-center my-0 lazyload" data-sizes= 'auto' data-src="/assets/img/mobile/home/bg-home-excl.jpg" data-srcset='/thumb/640/440/1/80/assets/img/mobile/home/bg-home-excl.jpg 450w, /assets/img/mobile/home/bg-home-excl.jpg'>
        <div class="contain block-excl">
        <h2 class="tt  mt-txt-50 mb-txt-50">Les<br> formules d'Amica</h2>
            <p class="mt-0 mb-txt-50 summary"><?=$entrySecret->model->summary;?></p>
            <a class="btn-excl btn-amica-basic-1 btn-amica-basic float-righ mt-0 mb-50" href="/formules/itineraire" data-analytics="on" data-analytics-category="homepage" data-analytics-action="secrets_section" data-analytics-label="cta_secrets">Piochez</a>
        </div>
    </div> 
<!--    <div class="container-flud about-container container-video-ytb">
        <div class="text-left row-video d-inline-block">
            <h2 class="tt mt-txt-80 mb-txt-50"><?//=strip_tags(Markdown::process($video->title), '<strong>'); ?></h2>
            <p class="summary mt-0 mb-50"><?//=$video->model->summary; ?></p>
            <div class="videoWrapper"  data-analytics="on" data-analytics-category="homepage" data-analytics-action="video_section" data-analytics-label="control_play">
                <iframe style="min-height: 22rem;" class="videotype videoytb my-0 w-100"  title="<?//= str_replace('**', '', $video->title) ?>" scrolling="no" data-src="<?//=$video->model->sub_title; ?>" autoplay allowfullscreen="allowfullscreen"  frameborder="0"></iframe>
            </div>
        </div>
    </div>-->
    <div class="container-about-us p-0 column d-lg-inline-block d-sm-inline-flex row">
            <div class="text col-sm-12 col-lg-auto">
                <h2 class="tt mt-txt-80 mb-txt-50"><?=$aboutUs->title ?></h2>
                <p class="mt-0 mb-txt-50"><?=$aboutUs->model->summary ?></p>
            </div>
            <div class="d-flex col-lg-auto col-sm-12 d-sm-flex d-lg-inline-block justify-content-between float-lg-right p-lg-0 mb-0">
        <? foreach ($aboutUsItems as $key => $value) :
                $arrSlug = explode('-', $value->slug);
                if($value->slug == 'mot-du-fondateur'){
                    $value->slug = 'a-propos-de-nous';
                }
            ?>
            <div class="item-img" data-analytics="on" data-analytics-category="homepage" data-analytics-action="qui_section" data-analytics-label="link_<?= $arrSlug[count($arrSlug) - 1] ?>">
                <a href="<?=DIR.$value->slug?>"  class="opc-8">
                <? if(isset($value->photosArray['on-home'][0])) : 
                    $vimg = $value->photosArray['on-home'][0];
                ?>
                <img class="focus-center" alt="<?=$vimg->description ?>" class="img-lazy"  data-src="<?=$vimg->image ?>" >
                <? endif; ?>
                    <div class="btn-on-img">
                    <span class="btn btn-amica-basic"><?=$value->title?></span>
                    </div>
                </a>
            </div>
        <? endforeach; ?>
        </div>
    </div>
    <div class="row-content portraits-container full-width mb-80 mt-80">
        <img alt="" class="w-100 focus-center my-0" data-src="/assets/img/mobile/home/bg-home-portraits.jpg">
        <div class="contain block-excl">
            <div class="entry-data-field">
                <?= $theEntry->data->portraits ?>

            </div>
<!--        <h2 class="tt mt-50 mb-txt-50 tt-custom">Nos portraits voyageurs</h2>
            <p class="mt-0 mb-0 summary">Ils ont voyagé avec nous et se sont retrouvés dans la galerie des voyageurs d’Amica. Nous les avons interviewés pour qu’ils nous partagent leurs expériences de voyage, mais surtout ce qui les as amenés à venir jusqu’en Indochine. De belles histoires qui témoignent de ces chemins qui se sont croisés...</p>-->
            <a class="amc-btn-default btn-amica-basic-1 btn-amica-basic float-righ mt-txt-50 mb-50" href="<?=DIR .'portrait-voyageur'?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="testimonies_section" data-analytics-label="cta_portrait">Voir les portraits</a>
        </div>
    </div> 
    <div class="row-content testi-home">
        <h2 class="tt mt-0 mb-txt-50">Ils nous ont fait confiance</h2>
        <p class="summary mt-0 mb-txt-50"><?=$portrain->parents(1)->summary; ?></p>
        <a href="<?= DIR.'confiance' ?>" class="tt-button-custom-confiance tt-latolatin-bold tt-fontsize-32 tt-color-e65925 float-left visible-xs-inline-block mb-txt-80" data-analytics="on" data-analytics-category="homepage" data-analytics-action="testimonies_section" data-analytics-label="link_confiance">Lire les témoignages</a>
        
        <div class="testi-slider">
            <div class="swiper-wrapper">
                <? foreach ($arrTemoignages as $k => $v) : ?>
                <div class="swiper-slide">
                    <? $countries = isset($v['data']->countries) ? $v['data']->countries : [];
                    $countries = \yii\helpers\ArrayHelper::getColumn($countries, function($e){
                                    return Yii::$app->params['tsDestinationList'][$e];    
                                 });
                    ?>
<!--                    <a href="/temoignages/<?//=$v['slug'] ?>">-->
                    <p class="summary mt-0 mb-txt-50">“<?= $v['summary'] ?>”</p>    
                        
                    <div class="img-text">
                        <? if(isset($v['photos'][0])) {  ?>
                        <img width="100" data-src="/thumb/100/100/1/80<?=$v['photos'][0]['image']?>"  alt="<?=$v['photos'][0]['description']?>">
                        <? }else{ ?>
                        <img width="100" data-src="/thumb/100/100/1/80/assets/img/tour/client-df.png"  alt="">
                        <? } ?>
                        <div class="info-testi">
                            <span class="tt-name"><?= isset($v['data']->nameclient) ? $v['data']->nameclient : ''?></span>
                            <span class="tt-info"><?=implode(', ',$countries)?>, <?//=date('M Y',$v['time']) ?> <?=ucfirst(Yii::$app->formatter->asDate($v['time'], 'php:F Y'))?> </span>
                        </div>
                    </div>
                    
                    
<!--                    </a>-->
                </div>
                <? endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        
        <div class="area-logo-recom mt-50 ">
            <p class="tt tt-custom">Ils nous ont recommandé</p>
            <div class="logo">
                <img alt="" style="max-width: 5.2rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-trip.jpg" />
                <img alt="" style="max-width: 3.4rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-rou.jpg" />
                <img alt="" style="max-width: 4.8rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-petit.jpg" />
                <img alt="" style="max-width: 6.5rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-lonely.jpg" />
            </div>
        </div>
        
        
        
    </div>  
    <div class="row-content blog-container mt-txt-0 mb-80">
            <div class="amc-column">
                <div class="entry-data-field">
                    <?= $theEntry->data->blogs ?>

                </div>
<!--                <h2 class="tt mt-0 mb-txt-50 tt-custom">Nos blogs de voyage</h2>
                <div class="text">
                    <p>Une pépite d’informations, d’anecdotes et de conseils pratiques concoctée par notre équipe !</p>

                    <p>Laissez-vous guider par 360° degrés, entièrement dédié à l’Indochine ; le blog d’Hanoï, premier en langue française dédié à la capitale vietnamienne et
                    Cuisine Vietnamienne, où recettes et anecdotes culinaires feront le bonheur des gourmands.</p>
                </div>-->
                 <?   $home = \yii\easyii\modules\page\api\Page::get(31); 
                $i = 0;
                $arr_image_blog = [];
                if(!empty($home->photos)) :  ?>
                    <? foreach ($home->photos as $key => $value) : ?>
                        <? if($value->type == 'custom') : 

                            $arr_image_blog[] = $value->image;
                            ?>


                        <? $i++; ?>
                        <?  endif;?>
                    <? endforeach; ?>
                <? endif;?>
                <div class="swiper-blog mt-txt-80">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                                <a class="d-flex justify-content-center align-items-center" rel="noopener noreferrer" target="_blank" href="https://blog.amica-travel.com"><img alt="Blog d'Amica Travel" data-src="<?= isset($arr_image_blog[0]) ? $arr_image_blog[0] : '/assets/img/new-home/logo-360-2019.jpg' ?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="blogs_section" data-analytics-label="link_blog_360"></a>

                        </div>
                         <div class="swiper-slide">
                                <a class="d-flex justify-content-center align-items-center" rel="noopener noreferrer" target="_blank" href="https://www.hanoivietnam.fr"><img alt="Blog de Hanoi" data-src="<?= isset($arr_image_blog[1]) ? $arr_image_blog[1] : '/assets/img/new-home/logo-blog-hanoi-new-2019.png' ?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="blogs_section" data-analytics-label="link_blog_hanoi"></a>

                        </div>
                         <div class="swiper-slide">
                                <a class="d-flex justify-content-center align-items-center" rel="noopener noreferrer" target="_blank" href="http://cuisinevietnamienne.blogspot.com"><img alt="Blog cuisine vietnamienne" data-src="<?= isset($arr_image_blog[2]) ? $arr_image_blog[2] : '/assets/img/new-home/logo-cuisine-2019.png' ?>" data-analytics="on" data-analytics-category="homepage" data-analytics-action="blogs_section" data-analytics-label="link_blog_cuisine"></a>

                        </div>
                    </div>
                </div>
            </div>    
        </div> 
</div>
</div>
<?
$js = <<< JS
var homeBannerSwiper = new Swiper('#home-banner-slider', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: true,
        lazyLoading: true
}); 
var tourSwiper = new Swiper('.tour-slider', {
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: false,
         pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
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
var countriesSwiper = new Swiper('.countries-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false
         
    });
var blogSwiper = new Swiper('.swiper-blog', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false
         
    });        
JS;
$this->registerJs($js);
 ?>