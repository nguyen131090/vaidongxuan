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
        <?php $this->registerMetaTag(['http-equiv' => 'content-language', 'content' => 'fr']) ?>
        <?php
            $result = '';
            $isIndex = ($this->context->metaIndex == 1) ? 'NOINDEX' : 'NOINDEX';
            $isFollow = ($this->context->metaFollow == 1) ? 'NOFOLLOW' : 'NOFOLLOW';
            $result = $isIndex . ', ' . $isFollow;
        ?>
        <? $this->registerMetaTag(['name' => 'ROBOTS', 'content' => $result]); ?>
        <?php $this->registerMetaTag(['name' => 'google-site-verification', 'content' => '5RPgaIZ9TROjN3QeaK_d7YwlSzL8O0GPZRIqVfYVZ-k']); ?>
       <? $this->registerLinkTag(['rel' => 'icon', 'href' => '/favicon.ico?v=1', 'type' => 'image/x-icon']);?>
        <? 
        if(Yii::$app->controller->action->id == 'index')
        $this->registerLinkTag(['rel' => 'canonical', 'href' => 'https://www.amica-travel.com/']);    
        else     
        $this->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->urlManager->createAbsoluteUrl(URI)]);?>
       <? 
       // if(Yii::$app->controller->action->id == 'index')
        // $this->registerLinkTag(['rel' => 'alternate', 'href' => 'https://www.amica-travel.com', 'hreflang' => 'fr']);
        // else
       // $this->registerLinkTag(['rel' => 'alternate', 'href' => Yii::$app->urlManager->createAbsoluteUrl(URI), 'hreflang' => 'fr']);?>
        <? if($this->context->pagination && SEG1 != 'explorateurs') : ?>
            <? $numPage = Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 1; ?>
            <? if($numPage > 1) : ?>
            <link rel="prev" href="<?=Yii::$app->urlManager->createAbsoluteUrl(URI)?><?=$numPage != 2 ? '?page='.($numPage-1) : '' ?>" />
            <? endif;?>
             <? if($numPage < $this->context->pagination) : ?>
            <link rel="next" href="<?=Yii::$app->urlManager->createAbsoluteUrl(URI)?>?page=<?=$numPage+1?>" />
            <? endif;?>
        <? endif ?>
        <?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0' ]); ?>
        <?php $this->registerLinkTag(['rel' => 'publisher', 'href' => 'https://plus.google.com/+AmicatravelFR']);?>
        <?php $this->registerMetaTag(['name' => 'msvalidate.01', 'content' => 'E0FB6D265CBED44B41E8648885ECADD3' ]); ?>
        <?php
        $description = ($this->context->metaD) ? ($this->context->metaD) : ''; ?>
        <meta name="description" content="<?= $description ?>">
        <?php $this->registerMetaTag(['name' => 'keywords', 'content' => '']);
        ?>
        <title><?= Html::encode($this->title = $this->context->metaT) ?></title>
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
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@amicatravel">
        <meta name="twitter:title" content="<?= $twitterTitle ?>">
        <meta name="twitter:description" content="<?= $twitterDescription ?>">
        <meta name="twitter:image" content="<?=Yii::$app->urlManager->getHostInfo(). $twitterImg ?>">
        <meta property="og:title" content="<?= $fbTitle ?>" />
        <meta property="og:url" content="<?=Yii::$app->urlManager->createAbsoluteUrl(URI)?>" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="<?= $fbDescription ?>"/>
        <meta property="og:image" content="<?=Yii::$app->urlManager->getHostInfo(). $fbImg ?>" />
        <meta property="og:site_name" content="Amica Travel" />
        <meta property="og:locale:alternate" content="fr" />
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
    </head>

    <body>
       <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCX7426"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        <?php $this->beginBody() ?>
        
       <!-- Nav Responsive - Banner-->
       <!-- end Nav - Banner - Responsive-->
        
        
       <div class="container-fluid contain header">
        <div class="column">
            <div class="logo float-left d-inline-block">
                <a href="<?=DIR?>"><img src="/assets/img/form/logo.png" alt="Amica Travel"></a>
            </div>
            <?php if($this->context->action->id == 'rdv-sur-paris'): ?>
                <div class="info-header pull-right">
                    <p>Vous pouvez contacter directement Arnaud par :</p>
                    <p>Tél : (+33) 6 28 22 72 86</p>
                    <p>Mail : arnaud.l@amicatravel.com</p>
                </div>
            <?php else: ?>
                <div class="info-header  d-inline-block float-right">
                    <p>info@amica-travel.com</p>
                    <p>FR : (+33) 6 19 08 15 72 ou (+33) 6 28 22 72 86</p>
                    <p>VN : (+84) 984 56 66 76</p>
                </div>
            <?php endif;?>
        </div>
    </div>

        <!-- Content -->
        <?=$content?>
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
                if(Yii::$app->controller->action->id == 'fondation-single-about-us' || URI == 'tourisme-solidaire')
                    $srcL =  $srcR = '';
                if(URI == 'a-propos-de-nous'){
                    $srcL = '/assets/img/illus/boat-right.png';
                    $srcR = '';
                }
                if(URI == 'quand-comment-combien'){
                    $srcL = '/assets/img/illus/page-quand-comment-combien-right.png';
                    $srcR = '';
                }
            } 
            if((strpos('mot-du-fondateur|nos-bureaux|tourisme-solidaire/associations|recrutement', URI ? URI : 'home') !== false) || Yii::$app->controller->action->id == 'idees-de-voyage-entre-ocean-single') 
                $srcR = '';
            if($srcR) :?>
            <img alt="" class="img-lazy fix-img-middle-right lazyload" data-src="<?= $srcR?>">
            <? endif; ?>
        <? 
        $classAreaMap = 'general';
        if($this->context->destination && SEG1 != 'destinations') {
            $classAreaMap = SEG1;
        }?>
        <div class="footer-bg <?=$this->context->destination ? $classAreaMap : '' ?>">
            <? if($srcL) :?>
                <img alt="" class="img-lazy fix-img-bottom-left" data-src="<?= $srcL?>">
            <? endif; ?>
            <div class="area-ft area-form-new">
                <div class="column form">
                    <p class="tt-1">RESTEZ EN CONTACT AVEC L'ASIE DU SUD-EST</p>
                    <p class="tt-2">Recevez les nouveautés, infos culturelles, conseils pratiques du Vietnam, Laos, Cambodge et de la Birmanie.</p>
                    <form id="newsletter-form">
                        <input class="email rounded" type="text" value="" placeholder="Votre adresse mail" name="email" />
                        <p class="error-email">
                            Le format de votre email n'est pas valide.
                        </p>
                        <span class='submit-email btn-amica-basic-2 btn-amica-basic' data-analytics="on" data-analytics-category="footer" data-analytics-action="newsletter" data-analytics-label="cta_inscription">Inscription</span>
                    </form>
                </div>    
            </div>
            <div class="area-ft area-info">
                <div class="column info info-1 row">
                     <div class="col-3 col-sm-3 col-xl-auto col-ft col-ft-1 mx-0 mx-sm-0 mx-lg-0">
                        <? if(SEG1 == ''){ ?>
                        <p class="t-title t-title-1">Découvrez...</p>
                        <p class="tt"><a href="<?=DIR?>actualites" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_actualites">Actualités</a></p>
                        <p class="tt"><a href="https://blog.amica-travel.com/" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_blog">Blog</a></p>
                        <p class="tt"><a href="<?=DIR?>club-ami-amica" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_club">Club Ami Amica</a></p>
                        <p class="tt"><a href="<?=DIR?>temoignages" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_temoignages">Témoignages</a></p>
                        <p class="tt"><a href="<?=DIR?>tourisme-solidaire" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_tourisme">Tourisme responsable</a></p>
                        <? }else{ ?>
                        <p class="t-title t-title-1">Découvrez...</p>
                        <p class="tt"><span class="pugjd" data-title="<?= base64_encode(DIR.'actualites') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_actualites">Actualités</span></p>
                        <p class="tt"><span class="pugjd" data-title="<?= base64_encode('https://blog.amica-travel.com/') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_blog">Blog</span></p>
                        <p class="tt"><span class="pugjd" data-title="<?= base64_encode(DIR.'club-ami-amica') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_club">Club Ami Amica</span></p>
                        <p class="tt"><span class="pugjd" data-title="<?= base64_encode(DIR.'temoignages') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_temoignages">Témoignages</span></p>
                        <p class="tt"><span class="pugjd" data-title="<?= base64_encode(DIR.'tourisme-solidaire') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_tourisme">Tourisme responsable</span></p>
                        <? } ?>
                    </div>
                    <div class="col-9 col-sm-9 col-xl-auto col-ft col-ft-2  mx-0 mx-sm-0 mx-lg-auto">
                        <div class="row">
                            <p class="t-title t-title-1 col-12">RELATION VOYAGEUR</p> 
                            <div class="col-6 col-sm-6 col-xl-12">

                                <p class="t-title t-title-2">en France</p>
                                <p class="tt">du lundi au vendredi (09h-12h & 14h-18h)<br><span>Tél. (+33) 6 19 08 15 72 ou (+33) 6 28 22 72 86</span></p>
                            </div>
                            <div class="col-6 col-sm-6 col-xl-12">
                                <p class="t-title t-title-2">au vietnam</p>
                                <p class="tt">du lundi au vendredi (8h-17h30) :  <br><span>Tél. (+84) 9 84 56 66 76</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12  col-xl-auto  col-ft col-ft-3 mx-0">
                        <div class="tele-rdv row d-flex align-items-center mx-0 mx-lg-auto justify-content-center">
                            <div class="col-7 col-xl-auto">
                            <p class="title-special mb-0  mb-sm-0 mb-xl-10">Notre conseiller(ère)</p>
                            <p class="tt mb-0 mb-sm-0 mb-xl-10">À l'écoute de votre projet, <br class="d-none d-lg-block">vous rappellera gratuitement.</p>
                            </div>
                            <div class="col-5 col-xl-auto">
                             <?//php if(SEG1 == ''){ ?>
<!--                            <a class="btn-link-rdv-home btn-amica-basic" href="<?//=DIR?>rdv-telephonique">Convenir d'un RDV téléphonique</a>-->
                            <?//php }else{ ?>
                            <button class="btn-rdv-page pugjd rounded" data-title="<?= base64_encode(DIR.'rdv-telephonique') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bloc" data-analytics-label="cta_rdv" title="Convenir d'un RDV téléphonique">Convenir d'un RDV téléphonique</button>
                            <?//php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column info info-2 row no-gutters my-20">
                    <div class="col-8 col-xl mt-lg-0 mb-20 mb-lg-auto mx-0 mx-lg-auto col-ft col-ft-1 mt-0">
                        <div class="info-office info-office-hanoi active">
                            <span class="pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/hanoi-vietnam') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_hanoi"><span class="name">Hanoi</span></span>
                            <p class="address"> Building NIKKO, 3e étage, 
                             <span>27 Rue Nguyen Truong To,</span>
                             <span>Ba Dinh, Hanoi, Vietnam</span>
                            </p>
                            <p class="telephone">
                             Tél. <span>(+84) 24 62 73 44 55</span>
                            </p>
                            
                        </div>
                        
                    </div>
                    <div class="col-4  mt-lg-0 mb-20 mb-lg-auto  col-xl mx-0 mx-lg-auto my-0 col-ft col-ft-2">
                       <div class="info-office info-office-saigon">
                           <span class="pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/ho-chi-minh-ville-vietnam') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_saigon"><span class="name">Ho Chi Minh</span></span>
                            <p class="address">Building Resco, 5e étage,
                             <span>94-96 rue Nguyen Du, 1er District, </span>
                             <span>Ho Chi Minh Ville, Vietnam</span>
                            </p>
                            <p class="telephone">
                             Tél. <span>(+84) 28 66 85 40 79</span>
                            </p>
                            
                       </div>
                    </div>
                    <div class="col-8 col-xl-4 pl-xl-4 mx-0 mx-lg-auto col-ft col-ft-3">
                        <div class="info-office info-office-siem">
                            <span class="pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/siem-reap-cambodge') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_siem"><span class="name">Siem Reap</span></span>
                            <p class="address">Borey Angkor Palace, Building B49 & B50,
                             <span>Phum Kruos,Sangkat Svay Dangkum,</span>
                             <span>Siem Reap, Cambodge</span>
                               </p>
                               <p class="telephone">
                             Tél. <span>(+85) 5 63 96 61 39</span>
                            </p>
                            
                        </div>
                    </div>
                     <div class="col-4 col-xl mx-0 mx-lg-auto col-ft col-ft=4">
                        <div class="info-office info-office-luong">
                            <span class="pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/luang-prabang-laos') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bureau" data-analytics-label="link_luang"><span class="name">Luang Prabang</span></span>
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
                <div class="column info info-3">
                    <ul class="social">
                        <li class="facebook"><a target="_blank" rel="noopener"  href="https://www.facebook.com/amicatravel/" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_fb">facebook</a></li>
                        <li class="youtube"><a target="_blank" rel="noopener"  href="http://www.youtube.com/c/AmicaTravelAgency" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_yt">youtube</a></li>
                        <li class="twitter"><a target="_blank" rel="noopener"  href="https://twitter.com/AmicaTravel" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_tw">twitter</a></li>
                        <li class="pinter"><a target="_blank" rel="noopener"  href="https://www.pinterest.com/amicatravel/" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_pt">pinterest</a></li>
                        <li class="insta"><a target="_blank" rel="noopener"  href="https://www.instagram.com/amicatravel/" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_ig">instagram</a></li>
                    </ul>
                    <? if(SEG1 == ''){ ?>
                    <p class="group-link">
                        <a class="ft-item" href="<?=DIR?>aide" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_faq">Aide</a>
                        <span>|</span>
                        <a class="ft-item" href="<?=DIR?>mentions-legales" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_mentions">Mentions légales</a>
                        <span>|</span>
                        <a class="ft-item" href="<?=DIR?>conditions-generales-de-vente" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_cgv">Conditions générales de vente</a>
                        <span>|</span>
                        <a class="ft-item" href="<?=DIR?>politique-de-confidentialite">Politique de confidentialité</a>
                        <span>|</span>
                        <a class="ft-item" href="<?=DIR?>recrutement" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_recrut">Recrutement</a>
                    </p>
                    <? }else{ ?>
                    <p class="group-link">
                        <span class="ft-item pugjd" data-title="<?= base64_encode(DIR.'aide') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_faq">Aide</span>
                        <span>|</span>
                        <span class="ft-item pugjd" data-title="<?= base64_encode(DIR.'mentions-legales') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_mentions">Mentions légales</span>
                        <span>|</span>
                        <span class="ft-item pugjd" data-title="<?= base64_encode(DIR.'conditions-generales-de-vente') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_cgv">Conditions générales de vente</span>
                        <span>|</span>
                        <span class="ft-item pugjd" data-title="<?= base64_encode(DIR.'politique-de-confidentialite') ?>">Politique de confidentialité</span>
                        <span>|</span>
                        <span class="ft-item pugjd" data-title="<?= base64_encode(DIR.'recrutement') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_recrut">Recrutement</span>
                    </p>
                    <? } ?>
                </div>
                <div class="column info info-4">
                    <div class="star">
                        <img class="item-star it-star-1" alt="" src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star it-star-2" alt="" src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star it-star-3" alt="" src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star it-star-4" alt="" src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                        <img class="item-star" alt="" src="<?=DIR?>assets/img/page2016/img_star_rating_new.png" />
                    </div>
                    <span class="info-rating">
                        4.6/5 selon 186 votes sur Facebook
                    </span>
                    
                </div>
            </div>
            <div class="area-ft area-copyright">
                <span class="copytext">&copy; Amica Travel 2016</span>
                
            </div>
        
        </div>
        <span style="display: none;" id="back-to-top" title="Back to top" class="show">
            <img alt="" src="<?=DIR?>assets/img/page2016/back-to-top.png">
        </span> 

        <?php $this->endBody() ?>    
       <script type="application/ld+json">
            {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Amica Travel",
            "url": "https://www.amica-travel.com/",
            "logo": "https://www.amica-travel.com/assets/img/page2016/logo_amica_travel.png",
            "aggregateRating": {
            "@type": "AggregateRating",
            "name": "Facebook",
            "bestRating": "5",
            "worstRating": "1",
            "ratingCount": "186",
            "ratingValue": "4.6"
            },
            "sameAs": [
            "https://www.facebook.com/amicatravel/",
            "https://twitter.com/AmicaTravel",
            "https://www.instagram.com/amicatravel/",
            "https://www.youtube.com/c/AmicaTravelAgency",
            "https://fr.pinterest.com/amicatravel/"
            ],
            "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "+33-619081572",
            "contactType": "customer support",
            "areaServed": "FR",
            "availableLanguage": "French"
            },{
            "@type": "ContactPoint",
            "telephone": "+33-628227286",
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
            "streetAddress": "102/3 Kounxoau Road, Phoneheuang,"
            }]
            }
        </script>
    </body>
</html>
<?php $this->endPage() ?>
