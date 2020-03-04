<?php
use yii\helpers\FileHelper;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Markdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="fr" class="no-js"> <!--<![endif]-->
    <head>
        <?php $this->registerMetaTag(['charset' => 'utf-8']) ?> 
        <?php $this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']) ?>
        <?php
            $result = '';
            $isIndex = ($this->context->metaIndex == 1) ? 'INDEX' : 'NOINDEX';
            $isFollow = ($this->context->metaFollow == 1) ? 'FOLLOW' : 'NOFOLLOW';
            $result = $isIndex . ', ' . $isFollow;
        ?>
        <? $this->registerMetaTag(['name' => 'ROBOTS', 'content' => $result]); ?>
        <?php $this->registerMetaTag(['name' => 'google-site-verification', 'content' => '5RPgaIZ9TROjN3QeaK_d7YwlSzL8O0GPZRIqVfYVZ-k']); ?>
       <? $this->registerLinkTag(['rel' => 'icon', 'href' => '/favicon.ico?v=1', 'type' => 'image/x-icon']);?>
        
        <?  
            $getajaxpage = NULL;
            $numPage = 1;
            $isspage = NULL;
            if(Yii::$app->request->get('page') == NULL){
                if(Yii::$app->request->get('data-page') != NULL){
                    $getajaxpage = ' - Page '. Yii::$app->request->get('data-page');
                    $numPage = Yii::$app->request->get('data-page');
                    $isspage = '?page='.Yii::$app->request->get('data-page');
                }
                if(Yii::$app->request->get('before-page') != NULL && Yii::$app->request->get('before-page') > 1){
                    $getajaxpage = ' - Page '. Yii::$app->request->get('before-page');
                    $numPage = Yii::$app->request->get('before-page');
                    $isspage = '?page='.Yii::$app->request->get('before-page');
                }
                
            }else{
                $getajaxpage = ' - Page ' . Yii::$app->request->get('page');
                $numPage = Yii::$app->request->get('page');
                $isspage = '?page='.Yii::$app->request->get('page');
            }
        ?>
        
        <? 
        if(Yii::$app->controller->action->id == 'index'){
            $this->registerLinkTag(['rel' => 'canonical', 'href' => str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo())]);    
        }else{     
           // $isspage = Yii::$app->request->get('page') ? '?page='.Yii::$app->request->get('page') : '';
            
            $this->registerLinkTag(['rel' => 'canonical', 'href' => str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.URI.$isspage]);
        }        
        ?>
       <? 
       // if(Yii::$app->controller->action->id == 'index')
        // $this->registerLinkTag(['rel' => 'alternate', 'href' => 'https://www.amica-travel.com', 'hreflang' => 'fr']);
        // else
       // $this->registerLinkTag(['rel' => 'alternate', 'href' => Yii::$app->urlManager->createAbsoluteUrl(URI), 'hreflang' => 'fr']);?>
        <? if($this->context->pagination && SEG1 != 'explorateurs' && SEG2 != 'visiter') : ?>
            <? if($numPage > 1) : ?>
<!--            <link rel="prev" href="<?//=Yii::$app->urlManager->createAbsoluteUrl(URI)?><?//=$numPage != 2 ? '?page='.($numPage-1) : '' ?>" />-->
            <? endif;?>
             <? if($numPage < $this->context->pagination) : ?>
<!--            <link rel="next" href="<?//=Yii::$app->urlManager->createAbsoluteUrl(URI)?>?page=<?//=$numPage+1?>" />-->
            <? endif;?>
        <? endif ?>
        <?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width,initial-scale=1' ]); ?>
        
        <?php $this->registerMetaTag(['name' => 'msvalidate.01', 'content' => '5C6F64A6A7B214785E10DB2D2BFD9C92' ]); ?>
        <?php
        $description = ($this->context->metaD) ? ($this->context->metaD) : ''; ?>
        <meta name="description" content="<?= $description ?><?= isset($this->context->update_meta['dataCountry']) ? $this->context->update_meta['dataCountry'] : '' ?><?= isset($this->context->update_meta['dataLength']) ? $this->context->update_meta['dataLength'] : '' ?><?= isset($this->context->update_meta['dataType']) ? $this->context->update_meta['dataType'] : '' ?><?= $getajaxpage ?>">
        <?php $this->registerMetaTag(['name' => 'keywords', 'content' => '']);
        ?>
        <title><?= Html::encode($this->title = $this->context->metaT) ?><?= isset($this->context->update_meta['dataCountry']) ? $this->context->update_meta['dataCountry'] : '' ?><?= isset($this->context->update_meta['dataLength']) ? $this->context->update_meta['dataLength'] : '' ?><?= isset($this->context->update_meta['dataType']) ? $this->context->update_meta['dataType'] : '' ?><?= $getajaxpage ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
        <!-- TWITTER -->
        <?php
        // Get data for Facebook
        $fbTitle = $this->context->metaFbT;
        $fbDescription = $this->context->metaFbD;
        $fbImg = $this->context->metaFbImg;

        // Set data for Twitter
        $twitterTitle = $fbTitle;
        $twitterDescription = $fbDescription;
        $twitterImg = $fbImg;

        if(empty($fbImg)) {

            if($this->context->entry){
                if(isset($this->context->entry->model->photos)){
                    foreach ($this->context->entry->model->photos as $key => $value) {
                        if($value->type == 'banner'){
                            $mainImg = $value->image;
                            $fbImg = $mainImg;
                            $twitterImg = $mainImg;
                            break;
                        }
                        $mainImg = '/assets/img/page2016/logo_amica_travel.png';
                        $fbImg = $mainImg;
                        $twitterImg = $mainImg;
                    }
                }
            }
        }
        ?>
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@amicatravel">
        <meta name="twitter:title" content="<?= $twitterTitle ?>">
        <meta name="twitter:description" content="<?= $twitterDescription ?>">
        <meta name="twitter:image" content="<?=str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()). $twitterImg ?>">
        <meta property="og:title" content="<?= $fbTitle ?>" />
        <meta property="og:url" content="<?= str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.URI.$isspage ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="<?= $fbDescription ?>"/>
        <meta property="og:image" content="<?=str_replace('http://', 'https://',Yii::$app->urlManager->getHostInfo()). $fbImg ?>" />
        <meta property="og:site_name" content="Amica Travel" />
        <meta property="og:locale:alternate" content="fr" />
        <link rel="dns-prefetch" href="//www.google-analytics.com">
        <link rel="dns-prefetch" href="//www.googleadservices.com">
        <link rel="dns-prefetch" href="//www.googletagmanager.com">
        <link rel="dns-prefetch" href="//www.youtube.com">
        <link rel="dns-prefetch" href="//connect.facebook.net">
        <link rel="dns-prefetch" href="//bat.bing.com">
        <link rel="dns-prefetch" href="//ajax.cloudflare.com">
        <link rel="dns-prefetch" href="//script.hotjar.com">
        <link rel="dns-prefetch" href="//static.hotjar.com">
        <link rel="dns-prefetch" href="//font.gstatic.com">
        <link rel="dns-prefetch" href="//www.google.com">
         <!-- Page hiding snippet (recommended) -->
        <!-- <style>.async-hide { opacity: 0 !important} </style>
<script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
(a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
})(window,document.documentElement,'async-hide','dataLayer',4000,
{'GTM-P3JTNZ6':true});</script> -->
         
         

         
         <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TCX7426');</script>
<!-- End Google Tag Manager -->

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-1454717-8"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-1454717-8');
</script>-->

    </head>

    <body>
       <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCX7426"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        <?php $this->beginBody() ?>
        
       <!-- Nav Responsive - Banner-->
       <!-- end Nav - Banner - Responsive-->
        
       
       
           <a class="btn-contactez-nous d-none d-sm-none d-lg-block" href="/devis" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="overlay" data-analytics-label="cta_devis">Devis sur mesure</a>
         
        
     <div class="text-sologan d-xl-block">
            <div class="column">
                <div class="tt-sologan">
                    <p>Agence locale, spécialiste des voyages sur mesure : <span>Vietnam, Laos, Cambodge & Birmanie</span></p>
                </div>
                <?
                    $countrycode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : '';
                    if($countrycode == 'fr'){
                ?>
<!--                <div class="votre-project">
                    <div class="text-devis">
                        <span data-title="<?//= base64_encode(DIR.'rdv-sur-paris') ?>" id="fix-color" class="link-btn pugjd" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_paris">RDV sur Paris</span>
                        <span class="special-border"> | </span>
                        <a href="<?//=DIR?>votre-liste-envies" id="fix-color" class="link-btn">Votre liste d’envies</a>
                    </div>
                    <div class="number">
                        <span id="numb-tour" class="count-tour <?//= isset(\Yii::$app->session['projet']) && (count(Yii::$app->session['projet']['programes']['select']) + count(Yii::$app->session['projet']['exclusives']['select'])) > 0 ? 'active' : '' ?>"><?//= count(Yii::$app->session['projet']['programes']['select']) + count(Yii::$app->session['projet']['exclusives']['select']) ?></span>
                    </div>
                </div>-->

                <? } ?>

            </div>
        </div>   
       
    
        <!-- Content -->
        <main>
            
           
            
        <?=$content?>
<!--            <div id="monitor">
              <div id="isIntersecting">
                <span class="placeholder">0</span>
                images loaded
                </div>
            </div>    -->
        </main>
        
        <!-- End content-->
        <? switch (SEG1) {
                case 'aide':
                    $srcL = '/assets/img/page2016/img-left-page-faq.png';
                    $srcR = '';
                    break;
                case 'vietnam':
                    $srcL = '/assets/img/illus/bored-woman.png';
                    $srcR = '/assets/img/illus/famer.png';
                    break;
                case 'laos':
                    $srcL = '/assets/img/illus/laos-left-fix.png';
                    $srcR = '/assets/img/illus/laos-right-fix.png';
                    break;
                case 'cambodge':
                    $srcL = '/assets/img/illus/angko-cambodge.png'; 
                    $srcR = '/assets/img/illus/banner-right-fix-cambodge.png';
                    break;
                case 'birmanie':
                    $srcL = '/assets/img/illus/birmanie-left-fix.png';
                    $srcR = '/assets/img/illus/birmanie-right-fix.png';  
                    break;
                case 'voyage':
                    $srcL = '/assets/img/illus/gui.png';
                    $srcR = '/assets/img/illus/famer-2.png';
                    if(SEG2) {
                        if(SEG2 == 'indochine-multi-pays'){
                            $srcL = '/assets/img/illus/solider.png';
                            $srcR = '/assets/img/illus/boat-right.png';
                        } 
                    } else $srcR = $srcL = '';
                    break;
                case 'formules':
                    $srcL = '/assets/img/illus/miss-classic.png';
                    $srcR = '/assets/img/illus/kid.png';
                    if(!SEG2) $srcR = $srcL = '';
                    break;
                default:
                    $srcR = '';
                    $srcL = '';
                    break;
            }
            if(isset($this->context->entry->category_id) && $this->context->entry->category_id == 7){
                 $srcL = '/assets/img/illus/solider.png';
                $srcR = '/assets/img/illus/boat-right.png';
            }
            if($this->context->aboutUs) {
                $srcL = '/assets/img/illus/boat.png';
                $srcR = '/assets/img/illus/famer-2.png';
                if(preg_match('/^tourisme-solidaire\/associations\//', URI) || preg_match('/^recrutement\//', URI))
                    $srcR = '';
                if(Yii::$app->controller->action->id == 'fondation-single-about-us' || URI == 'tourisme-solidaire' || URI == 'confiance')
                    $srcL =  $srcR = '';
                if(URI == 'a-propos-de-nous'){
                    $srcL = '/assets/img/illus/boat-right.png';
                    $srcR = '';
                }
            }
            if(SEG1 == 'vietnam' && SEG2 == ''){
                $srcR = '';
            }
            if((strpos('mot-du-fondateur|nos-bureaux|tourisme-solidaire/associations|recrutement', URI ? URI : 'home') !== false) || Yii::$app->controller->action->id == 'idees-de-voyage-entre-ocean-single') 
                $srcR = '';
            if($srcR) :?>
            <img alt="" class="img-lazy fix-img-middle-right" data-src="<?= $srcR?>">
            <? endif; ?>
        <? 
        $classAreaMap = 'general';
        if($this->context->destination && SEG1 != 'destinations') {
            $classAreaMap = SEG1;
        }?>
        <div class="footer-bg <?=$this->context->destination ? $classAreaMap : '' ?> fix-responsive-footer-sm">
            <? if($srcL) :?>
                <img alt="" class="img-lazy fix-img-bottom-left" data-src="<?= $srcL?>">
            <? endif; ?>
            <div class="area-ft area-form-new p-0">
                
                <div class="social-container w-100 d-inline-flex">
                    <div class="container">
                    <span class="suivez">SUIVEZ-NOUS</span>
                        <ul class="social">
                        <li class="facebook"><a target="_blank" rel="noopener" aria-label="Facebook" href="https://www.facebook.com/amicatravel/" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_fb">facebook</a></li>
                        <li class="twitter"><a target="_blank" rel="noopener" aria-label="Twitter" href="https://twitter.com/AmicaTravel" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_tw">twitter</a></li>
                        <li class="insta"><a target="_blank" rel="noopener" aria-label="Instagram" href="https://www.instagram.com/amicatravel/" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_ig">instagram</a></li>
                        <li class="pinter"><a target="_blank" rel="noopener" aria-label="Pinterest" href="https://www.pinterest.com/amicatravel/" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_pt">pinterest</a></li>
                        <li class="youtube"><a target="_blank" rel="noopener" aria-label="Youtube" href="http://www.youtube.com/c/AmicaTravelAgency" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_yt">youtube</a></li>
                        <li class="linkin"><a target="_blank" rel="noopener" aria-label="Linkedin" href="https://fr.linkedin.com/company/amica-travel" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_li">LinkIn</a></li>
                        </ul>
                        <span class="right-text">#amicatravel</span>
                    </div>
                </div>    
                    
            </div>
            <div class="area-ft area-info">
                <div class="column info info-1 row">
                     <div class="amc-fix-col-sm-3 col-3 col-sm-3 col-xl-auto col-ft col-ft-1 mx-0 mx-sm-0 mx-lg-0">
                        
                        <p class="t-title t-title-1 tt-latolatin-bold mb-txt-20">Service client</p>
                        <div class="col-6 col-sm-12 mt-0 col-xl-12 p-0">
                            <p class="t-title t-title-2 mt-md-0 mt-sm-0 mt-0 mb-0">au vietnam</p>
                            <p class="tt mb-0">du lundi au vendredi (8h-17h30) :  <br><span class="i-2">Tél. (+84) 9 84 56 66 76</span></p>
                        </div>
                    </div>
                    <div class="amc-fix-col-sm-5 col-5 col-sm-5 col-xl-auto col-ft col-ft-2  mx-0 mx-sm-0 mx-lg-auto">
                        <div class="row">
<!--                            <p class="t-title t-title-1 col-12">RELATION VOYAGEUR</p> -->
                            <div class="col-6 col-sm-12 col-xl-12 mt-40">

                                <p class="t-title t-title-2">en France</p>
                                <p class="tt">du lundi au vendredi <span class="i-1">(09h-12h & 14h-18h)</span><br><span class="i-2">Tél. (+33) 6 19 08 15 72</span></p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="amc-fix-col-sm-4 col-4 col-sm-4  col-xl  col-ft col-ft-3 mx-0">
                        <div class="tele-rdv row d-flex align-items-center mx-0 mx-lg-auto justify-content-center float-right pr-5 pl-5">
                            <div class="col-12 col-xl-auto">
                            <p class="title-special mb-xl-0 mb-xl-10">Notre conseiller(ère)</p>
                            <p class="tt mb-0 mb-sm-0 mb-xl-10 mt-10 p-sm-0">À l'écoute de votre projet, <br class="d-none d-lg-block">vous rappellera gratuitement.</p>
                            </div>
                            <div class="col-12 col-xl-auto">
                             <?//php if(SEG1 == ''){ ?>
<!--                            <a class="btn-link-rdv-home btn-amica-basic" href="<?//=DIR?>rdv-telephonique">Convenir d'un RDV téléphonique</a>-->
                            <?//php }else{ ?>
                            <button class="btn-rdv-page pugjd mt-xl-2 mt-lg-2 mb-xl-0" data-title="<?= base64_encode(DIR.'rdv-telephonique') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bloc" data-analytics-label="cta_rdv" title="Convenir d'un RDV téléphonique">Convenir d'un RDV téléphonique</button>
                            <?//php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column info info-2 row no-gutters my-20">
                    <div class="amc-fix-col-sm-6 col-3 col-xl-3 mt-lg-0 mb-20 pr-lg-4 pr-sm-4 mb-lg-auto mx-0 mx-lg-auto col-ft col-ft-1 mt-0">
                        <div class="info-office info-office-hanoi active">
                            <span class="" data-title="<?= base64_encode(DIR.'nos-bureaux/hanoi-vietnam') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_hanoi"><span class="name">Hanoi</span></span>
                            <p class="address"> Building NIKKO, 2ème étage, 
                             <span>27 Rue Nguyen Truong To,</span>
                             <span>Ba Dinh, Hanoi, Vietnam</span>
                            </p>
                            <p class="telephone">
                             Tél. <span>(+84) 24 62 73 44 55</span>
                            </p>
                            
                        </div>
                        
                    </div>
                    <div class="amc-fix-col-sm-6 col-3 col-xl-3 mt-lg-0 mb-20 mb-lg-auto mx-0 mx-lg-auto my-0 col-ft col-ft-2 d-inline-flex">
                       <div class="info-office info-office-saigon">
                           <span class="" data-title="<?= base64_encode(DIR.'nos-bureaux/ho-chi-minh-ville-vietnam') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_saigon"><span class="name">Ho Chi Minh</span></span>
                            <p class="address">Building Resco, 4ème étage,
                             <span>94-96 rue Nguyen Du, 1er District, </span>
                             <span>Ho Chi Minh Ville, Vietnam</span>
                            </p>
                            <p class="telephone">
                             Tél. <span>(+84) 28 66 85 40 79</span>
                            </p>
                            
                       </div>
                    </div>
                    <div class="amc-fix-col-sm-6 col-3 col-xl-3 pl-xl-2 pr-xl-2 mx-0 pr-lg-4 pr-sm-4 mx-lg-auto col-ft col-ft-3">
                        <div class="info-office info-office-siem">
                            <span class="" data-title="<?= base64_encode(DIR.'nos-bureaux/siem-reap-cambodge') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_siem"><span class="name">Siem Reap</span></span>
                            <p class="address">Borey Angkor Palace, Building B49 & B50,
                             <span>Phum Kruos,Sangkat Svay Dangkum,</span>
                             <span>Siem Reap, Cambodge</span>
                               </p>
                               <p class="telephone">
                             Tél. <span>(+85) 5 63 96 61 39</span>
                            </p>
                            
                        </div>
                    </div>
                     <div class="amc-fix-col-sm-6 col-3 col-xl-3 mx-0 pl-xl-4 mx-lg-auto col-ft col-ft-4 pr-sm-4">
                        <div class="info-office info-office-luong">
                            <span class="" data-title="<?= base64_encode(DIR.'nos-bureaux/luang-prabang-laos') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_luang"><span class="name">Luang Prabang</span></span>
                            <p class="address">102/3 Kounxoau Road, Phoneheuang
                             <span>Village, Luang Prabang, 06000, </span>
                             <span>Laos</span>
                            </p>
                            <p class="telephone">
                             Tél. <span>(+856) 71 21 22 18</span>
                             
                            </p>
                            
                        </div>
                    </div>
                </div>
                
                <div class="column info info-4">
                    <div class="star">
                        <img class="item-star it-star-1" alt="" data-src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star it-star-2" alt="" data-src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star it-star-3" alt="" data-src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star it-star-4" alt="" data-src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star" alt="" data-src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                    </div>
                    <span class="info-rating">
                        4.6/5 selon 246 votes sur Facebook
                    </span>
                    
                </div>
            </div>
            <div class="area-ft area-copyright">
                <span class="copytext">&copy; Amica Travel 2016</span>
                
            </div>
        
        </div>
        <span style="display: none;" id="back-to-top" title="Back to top" class="show">
            <img alt="" data-src="<?=DIR?>assets/img/page2016/back-to-top.png" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_top">
        </span> 

        <? if(IS_TABLET){ ?>   
            <? if(Yii::$app->controller->action->id != 'exclusivites-single' && Yii::$app->controller->action->id != 'idees-de-voyage-single'){ ?>
                <? if(Yii::$app->controller->action->id == 'exclusivites-type' || Yii::$app->controller->action->id == 'idees-de-voyage-type'){ ?>
                    <button class="btn-only-tablet-bottom-fixed tt-latolatin-bold tt-fontsize-16  btn-bottom-fixed-tablet btn-bottom-fixed-page-category-tablet" data-position='fixed' data-ajax="false">
                        <span data-title="<?= base64_encode('/devis') ?>" class="btn-item btn-bottom-form-devis pugjd w-100" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_devis">Demander un devis personnalisé</span>
                    </button>
                <? }else{ ?>

                    <button class="btn-only-tablet-bottom-fixed tt-latolatin-bold tt-fontsize-16 btn-bottom-fixed-tablet" data-position='fixed' data-ajax="false">
                        <span data-title="<?= base64_encode('/devis') ?>" class="btn-item btn-bottom-form-devis pugjd" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_devis">Demander un devis personnalisé</span>
                        <span class="btn-item btn-bottom-search btn-fixed-search" data-toggle="collapse" data-target="#tabletFilter" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-scroll="0" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_search">Search</span>
                    </button>
                    <div id="tabletFilter" class="amc-filter-tablet">
                        <div id="search-page-voyage">
                        <? include(dirname(dirname(__FILE__)).'/page2016/_inc_tablet_filter.php'); ?>
                        </div>    
                    </div>
                <? } ?>
            <? } ?>
        <? } ?>    
            
        <?php $this->endBody() ?>  
        <? if($this->context->priceSeo && (1==2)) echo  $this->context->priceSeo;?>   
       <script type="application/ld+json">
            [{
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Amica Travel",
            "description": "Que ce soit  au Vietnam, au Cambodge, au Laos ou en Birmanie, si vous avez envie d'un voyage sur mesure, authentique, axé sur les rencontres humaines, la découverte de paysages d'exception et l'immersion dans la vie locale, laissez-vous tenter par nos suggestions !",
            "url": "https://www.amica-travel.com/",
            "logo": "https://www.amica-travel.com/assets/img/page2016/logo_amica_travel.png",
            "aggregateRating": {
            "@type": "AggregateRating",
            "name": "Facebook",
            "bestRating": "5",
            "worstRating": "1",
            "ratingCount": "246",
            "ratingValue": "4.6"
            },
            "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "+33-619081572",
            "contactType": "customer support",
            "areaServed": "FR",
            "availableLanguage": "French"
            },{
            "@type": "ContactPoint",
            "telephone": "+84-984566676",
            "contactType": "customer support",
            "areaServed": "VN",
            "availableLanguage": "French"
            },{
            "@type": "ContactPoint",
            "telephone": "+855-63966139",
            "contactType": "customer support",
            "areaServed": "KH",
            "availableLanguage": "French"
            },{
            "@type": "ContactPoint",
            "telephone": "+856-71212275",
            "contactType": "customer support",
            "areaServed": "LA",
            "availableLanguage": "French"
            }],
            "address": [{
            "@type": "PostalAddress",
            "addressLocality": "Hanoi, Vietnam",
            "addressRegion": "Ba Dinh",
            "streetAddress": "Building NIKKO, 27 Rue Nguyen Truong To"
            },{
            "@type": "PostalAddress",
            "addressLocality": "Ho Chi Minh Ville, Vietnam",
            "addressRegion": "1er District",
            "streetAddress": "94-96 rue Nguyen Du"
            },{
            "@type": "PostalAddress",
            "addressLocality": "Siem Reap, Cambodge",
            "streetAddress": "Borey Angkor Palace, Building B49 & B50, Phum Kruos,Sangkat Svay Dangkum"
            },{
            "@type": "PostalAddress",
            "addressLocality": "Luang Prabang, Laos",
            "streetAddress": "102/3 Kounxoau Road, Phoneheuang"
            }]
            }
                
            <?
                if(URI == SEG1.'/informations-pratiques/'.SEG3 || URI == SEG1.'/guide/'.SEG3 || URI == SEG1.'/guide/'.SEG3.'/'.SEG4 || URI == 'actualites/'.SEG2 || URI == 'portrait-voyageur/'.SEG2){
               // $datetime = new DateTime('1484299896');
                $url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.URI;

                if(isset($this->context->entry->model->time) && $this->context->entry->model->time != NULL){
                   $time = date(DATE_ISO8601, $this->context->entry->model->time);
                }else{
                   // $time = date(DATE_ISO8601, 1389756265);
                    $time = NULL;
                }        
                //var_dump($this->context->entry->model->content);exit;
                if(isset($this->context->entry->model->pulished_date) && $this->context->entry->model->pulished_date != NULL){
                   $pulished_date  = date(DATE_ISO8601, $this->context->entry->model->pulished_date);
                }else{
                   // $time = date(DATE_ISO8601, 1389756265);
                      $timestamp = strtotime("April 2017");
                      //var_dump($timestamp);exit;
                    $pulished_date = date(DATE_ISO8601, $timestamp);
                }

                $content = NULL;
                if(isset($this->context->entry->model->content)){
                    $content = $this->context->entry->model->content;
                }else if(isset($this->context->entry->model->description)){
                    $content = $this->context->entry->model->description;
                }

                $img_first = '/assets/img/page2016/logo_amica_travel.png';

                preg_match_all('/<img[^>]+>/i', $content, $result);
                if(is_array($result) && $result != NULL){
                    foreach ($result[0] as $img_tag) {
                          //  if (strpos($img_tag, 'display-page') !== false) {
                                    preg_match_all('/(src)=("[^"]*")/i', $img_tag, $img_first);
                           // }
                    }

                }
                if(is_array($img_first)){
                   $img_first = $img_first[2][0];
                }else{
                    $img_first = $img_first;
                }
                //var_dump(str_replace('"','',$img_first));exit;
            ?>        
              
                ,{
                "@context": "http://schema.org",
                "@type": "Article",
                "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?= $url ?>"
                },
                "headline": "<?= $this->context->pageT ?>",
                "description": "<?= $this->context->metaD ?>",
                "datePublished": "<?= $pulished_date ?>",
                <? if($time != NULL){?>
                "dateModified": "<?= $time?>",
                <? } ?>        
                "image": "<?= str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()). str_replace(['"','https://www.amica-travel.com'],['',''],$img_first) ?>",
                "author": {
                "@type": "Organization",
                "name": "Amica Travel"
                },
                "publisher": {
                "@type": "Organization",
                "name": "Amica Travel",
                "logo": {
                "@type": "ImageObject",
                "url": "<?= str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/assets/img/page2016/logo_amica_travel.png'?>"
                }
                }
                }
                
        <? } ?>  

        <? if($this->context->json_ld_breadcrumd != NULL){ ?>
              
            <?= ',' . $this->context->json_ld_breadcrumd; ?>
              
        <? } ?> 

    ]        
        </script>
               
    </body>
<script type="text/javascript">

  
            var trackClickEvent = function () {
                var eventCategory = this.getAttribute("data-analytics-category");
                var eventAction = this.getAttribute("data-analytics-action");
                var eventLabel = this.getAttribute("data-analytics-label");
              //  ga('send', 'event', eventCategory, eventAction, eventLabel);
        //      gtag('event', eventAction, {
        //        'event_category': eventCategory,
        //        'event_label': eventLabel,
        //        'non_interaction': true
        //      });
               // console.log(eventLabel);
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                 'event': 'eventTracking',
                  'category': eventCategory,
                  'action': eventAction,
                  'label': eventLabel
                 });

            };
       $(window).bind("load", function() {
        //$(document).on("click", "html", function(e){  
            // Find all of the elements on the page which have the class 'ga-event'
            // var elementsToTrack = document.getElementsByClassName("ga-event");
            var elementsToTrack = $(document).find("[data-analytics='on']");
            var elementsToTrackLength = elementsToTrack.length;
            //console.log(elementsToTrack);
            for (var i = 0; i < elementsToTrackLength; i++) {
                elementsToTrack[i].addEventListener('click', trackClickEvent, false);

            }
        });    
      
        $(document).ajaxSuccess(function(event, xhr, settings) {
           // console.log(settings.url == '/amica-fr/ajax-result-menu');
            if(settings.url == "/amica-fr/ajax-result-menu"){
                var elementsToTrack = $(document).find("#group-sub-mn [data-analytics='on']");
                var elementsToTrackLength = elementsToTrack.length;
                //console.log(elementsToTrack);
                for (var i = 0; i < elementsToTrackLength; i++) {
                    elementsToTrack[i].addEventListener('click', trackClickEvent, false);

                }
            }
        });
        
            
     

        </script>
    

        

        
</html>
<!--Start of Tawk.to Script-->
<!--<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59a3c0174fe3a1168eada04c/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>-->
<!--End of Tawk.to Script-->
<?php $this->endPage() ?>
