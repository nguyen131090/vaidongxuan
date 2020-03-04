<?php
use yii\helpers\FileHelper;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Markdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html lang="fr">
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <?php $this->registerMetaTag(['charset' => 'utf-8']) ?> 
    <?php $this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']) ?>
    <?//php $this->registerMetaTag(['name' => 'viewport', 'content' => 'initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;']); ?>
    <?//php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=0.8, minimum-scale=0.5']); ?>
    <?//php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width,initial-scale=1']); ?>
    <?php $this->registerMetaTag(['name' => 'theme-color', 'content' => '#e0643e']) ?>
    <?php
            $result = '';
            $isIndex = ($this->context->metaIndex == 1) ? 'INDEX' : 'NOINDEX';
            $isFollow = ($this->context->metaFollow == 1) ? 'FOLLOW' : 'NOFOLLOW';
            $result = $isIndex . ', ' . $isFollow;
        ?>
        <? $this->registerMetaTag(['name' => 'ROBOTS', 'content' => $result]); ?>

    <?php $this->registerMetaTag(['name' => 'google-site-verification', 'content' => '5RPgaIZ9TROjN3QeaK_d7YwlSzL8O0GPZRIqVfYVZ-k']); ?>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="icon" href="/favicon.ico?v=1" type="image/x-icon" />
    <?php $this->head() ?>
    <!-- BEGIN SEO -->
    
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
            $this->registerLinkTag(['rel' => 'canonical', 'href' => str_replace('http://', 'http://', Yii::$app->urlManager->getHostInfo())]);    
        }else{     
           // $isspage = Yii::$app->request->get('page') ? '?page='.Yii::$app->request->get('page') : '';
            
            $this->registerLinkTag(['rel' => 'canonical', 'href' => str_replace('http://', 'http://', Yii::$app->urlManager->getHostInfo()).'/'.URI.$isspage]);
        }           
    ?>
    <? if($this->context->pagination  && SEG2 != 'visiter') : ?>
        <?// $numPage = Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 1; ?>
        <? if($numPage > 1) : ?>
<!--            <link rel="prev" href="<?//=Yii::$app->urlManager->createAbsoluteUrl(URI)?><?//=$numPage != 2 ? '?page='.($numPage-1) : '' ?>" />-->
        <? endif;?>
        <? if($numPage < $this->context->pagination) : ?>
<!--            <link rel="next" href="<?//=Yii::$app->urlManager->createAbsoluteUrl(URI)?>?page=<?//=$numPage+1?>" />-->
        <? endif;?>
    <? endif ?>
    <!-- TWITTER -->
    <? 
    $mainImg = $summaryImg = '/assets/img/page2016/logo_amica_travel.png';
    if($this->context->entry){
       if(isset($this->context->entry->model)){
           $photos = $this->context->entry->model->photos;
       }else{
           $photos = $this->context->entry->photos;
       }
        if(isset($photos)){
            
            foreach ($photos as $key => $value) {
                if($value->type == 'banner'){
                    $mainImg = $value->image;
                }
                if($value->type == 'summary'){
                    $summaryImg = $value->image;
                }
            }
        }
    }
    ?>
    
    <?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width,initial-scale=1' ]); ?>
    <?php $this->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary' ]); ?>
    <?php $this->registerMetaTag(['name' => 'twitter:site', 'content' => '@amicatravel' ]); ?>
    <?php $this->registerMetaTag(['name' => 'twitter:title', 'content' => $this->context->metaT ]); ?>
    <?php $this->registerMetaTag(['name' => 'twitter:description', 'content' => $this->context->metaD ]); ?>
    <?php $this->registerMetaTag(['name' => 'twitter:image', 'content' => str_replace('http://', 'https://',Yii::$app->urlManager->getHostInfo()). $mainImg ]); ?>

        <!--
        <meta name="twitter:card" content="<?//=Yii::$app->urlManager->getHostInfo(). $summaryImg ?>">
        <meta name="twitter:site" content="@amicatravel">
        <meta name="twitter:title" content="<?//=$this->context->metaT?>">
        <meta name="twitter:description" content="<?//=$this->context->metaD?>">
        <meta name="twitter:image" content="<?//=Yii::$app->urlManager->getHostInfo(). $mainImg ?>">
    -->
    <!-- FACEBOOK -->

    <?php $this->registerMetaTag(['property' => 'og:title', 'content' => $this->context->metaT ]); ?>
    <?php $this->registerMetaTag(['property' => 'og:url', 'content' => str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.URI.$isspage ]); ?>
    <?php $this->registerMetaTag(['property' => 'og:type', 'content' => 'website' ]); ?>
    <?php $this->registerMetaTag(['property' => 'og:description', 'content' => $this->context->metaD ]); ?>
    <?php $this->registerMetaTag(['property' => 'og:image', 'content' => str_replace('http://', 'https://',Yii::$app->urlManager->getHostInfo()). $mainImg ]); ?>
    <?php $this->registerMetaTag(['property' => 'og:site_name', 'content' => 'Amica Travel' ]); ?>
    <?php $this->registerMetaTag(['property' => 'og:locale:alternate', 'content' => 'fr' ]); ?>

    

    <?php $this->registerMetaTag(['name' => 'msvalidate.01', 'content' => '5C6F64A6A7B214785E10DB2D2BFD9C92' ]); ?>
    <?php
       // $this->context->pageT != '' ? $this->title = $this->context->pageT : $this->title = $this->context->metaT;
    
   // $this->registerMetaTag(['name' => 'description', 'content' => yii::$app->request->get('page') ? $this->context->metaD.' - Page '.yii::$app->request->get('page') : $this->context->metaD]);
        // $this->registerMetaTag(['name' => 'title', 'content' => $this->context->metaT]);
    $this->registerMetaTag(['name' => 'keywords', 'content' => '']);
    ?>
    <?php $description = ($this->context->metaD) ? ($this->context->metaD) : ''; ?>
    <meta name="description" content="<?= $description ?><?= isset($this->context->update_meta['dataCountry']) ? $this->context->update_meta['dataCountry'] : '' ?><?= isset($this->context->update_meta['dataLength']) ? $this->context->update_meta['dataLength'] : '' ?><?= isset($this->context->update_meta['dataType']) ? $this->context->update_meta['dataType'] : '' ?><?= $getajaxpage ?>">
    <title><?= Html::encode($this->title = $this->context->metaT) ?><?= isset($this->context->update_meta['dataCountry']) ? $this->context->update_meta['dataCountry'] : '' ?><?= isset($this->context->update_meta['dataLength']) ? $this->context->update_meta['dataLength'] : '' ?><?= isset($this->context->update_meta['dataType']) ? $this->context->update_meta['dataType'] : '' ?><?= $getajaxpage ?></title>
            
    <?= Html::csrfMetaTags() ?>
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
    <style>.async-hide { opacity: 0 !important} </style>
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
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCX7426" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php $this->beginBody() ?>
    <div data-role="page" id="page1" data-theme="a">
        <div data-role="header">
            <nav style="" class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="btn-header">
                            <li class="logo"><a class="" href="<?=DIR?>" data-ajax="false"><img alt="Amica Travel" data-src="<?= DIR ?>assets/img/mobile/logo-amica.png" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica"></a></li>
                            
                            <li class="navigation"> 
                                <a href="<?=DIR ?>#page2" aria-label="Menu" data-transition="slide" data-direction=""  class="btn-hum" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="icon_menu">
                                   
                                </a>
                            </li>
                            <li class="search">
                                <a href="#infomation" aria-label="Information" data-transition="slidedown" data-direction="" class="btn-testi" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="icon_infobox">
<!--                                    <img src="<?=DIR ?>assets/img/mobile/rdv-icon-header.png">-->
                                </a>
                            </li>
                            
                           <!--  <a class="btn-search" href="#search-page" data-transition="slide"><img src="<?=DIR ?>assets/img/mobile/search-icon.png"></a></li> -->
                        </ul>

                    </div>
                </div><!-- /.container-fluid -->
            </nav>
        </div><!-- /header -->

        <!-- Include Breadcrumd -->
        <?
        if(SEG1 != ''){
            include(dirname(dirname(__FILE__)).'/page2016/mobile/_inc_breadcrumb.php');
        }
        ?>
        <!-- End Include Breadcrumd -->
        
        <div role="main" class="ui-content">
            <div id="wrapper">

<?= $content?>
<!-- test lazy image -->                
 
<!-- end test lazy image -->
<div class="rows row-footer" data-role="none">
    <div class="newsletter">
        <p class="tt-1 tt-fontsize-40 tt-latolatin-bold">Restez en contact avec l'indochine</p>
        <form id="newsletter-form" data-role="none">
            <label class="tt-2 tt-fontsize-32 tt-latolatin-regular" for="frmemail">Nouveautés, offres spéciales, vie de l’équipe... tissons un lien !</label>
            <input class="email" value="" id="frmemail" placeholder="Votre adresse mail" name="frmemail" type="text" data-role="none" data-analytics="on" data-analytics-category="footer" data-analytics-action="newsletter" data-analytics-label="input_email">
            <span class="error-email" aria-live="polite"></span>
            
            <button type="submit" class="submit-email"  data-role="none" data-analytics="on" data-analytics-category="footer" data-analytics-action="newsletter" data-analytics-label="cta_inscription" >Inscription</button>
        </form>
    </div>
     <ul class="group-social">
            <li class="facebook"><a href="https://www.facebook.com/amicatravel/" aria-label="Facebook"><img alt="" data-src="/assets/img/mobile/fb-icons.png" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_fb"></a></li>
            <li class="twitter"><a href="https://twitter.com/AmicaTravel" aria-label="Twitter"><img alt="" data-src="/assets/img/mobile/tw-icon.png" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_tw"></a></li>
            <li class="instagram"><a href="https://www.instagram.com/amicatravel/" aria-label="Instagram"><img alt="" data-src="/assets/img/mobile/insta-icon.png" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_ig"></a></li>
            <li class="youtube"><a href="https://www.youtube.com/c/AmicaTravelAgency" aria-label="Pinterest"><img alt="" data-src="/assets/img/mobile/youtube-icon.png" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_yt"></a></li>
            <li class="pinterest"><a href="https://www.pinterest.com/amicatravel/" aria-label="Pinterest"><img alt="" data-src="/assets/img/mobile/pin-icon.png" data-analytics="on" data-analytics-category="footer" data-analytics-action="social" data-analytics-label="icon_pt"></a></li>
    </ul>
    <a href="<?=DIR.URI ?>#bureaux" class="link-bureaux" data-transition="slide" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="cta_bureaux">Nos bureaux</a>

    <div class="footer-links">
        <? if(SEG1 == ''){ ?>
        <a class="item" href="<?=DIR?>actualites" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_actualites">Actualités</a>
        <a class="item" href="https://blog.amica-travel.com/" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_blog">Blog</a>
        <a class="item" href="<?=DIR?>club-ami-amica" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_club">Club Ami Amica</a>
        <a class="item" href="<?=DIR?>chez-habitant-indochine" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_habitant">Chez l'habitant</a>
        <a class="item" href="<?=DIR?>tourisme-solidaire" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_tourisme">Tourisme responsable</a>
        <a class="item" href="<?=DIR?>aide" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_faq">Aide</a>
        <a class="item" href="<?=DIR?>mentions-legales" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_mentions">Mentions légales</a>
        <a class="item" href="<?=DIR?>recrutement" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_recrut">Recrutement</a>
        <a class="item" href="<?=DIR?>conditions-generales-de-vente" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_cgv">Conditions générales de vente</a>
        <a class="item" href="<?=DIR?>politique-de-confidentialite" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_confidentialite">Politique de confidentialité</a>
                                    
        <!--        <a class="item" href="/promotion-basse-saison">Promotion en cours</a>-->
        <? }else{ ?>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'actualites') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_actualites">Actualités</span>
        <span class="item"><a class="item" href="https://blog.amica-travel.com/" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_blog">Blog</a></span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'club-ami-amica') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_club">Club Ami Amica</span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'chez-habitant-indochine') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_habitant">Chez l'habitant</span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'tourisme-solidaire') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="decouvrir" data-analytics-label="link_tourisme">Tourisme responsable</span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'aide') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_faq">Aide</span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'mentions-legales') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_mentions">Mentions légales</span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'recrutement') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_recrut">Recrutement</span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'conditions-generales-de-vente') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_cgv">Conditions générales de vente</span>
        <span class="item pugjd" data-title="<?= base64_encode(DIR.'politique-de-confidentialite') ?>" data-analytics="on" data-analytics-category="footer" data-analytics-action="bottom" data-analytics-label="link_confidentialite">Politique de confidentialité</span>
        
<!--        <span class="item pugjd" data-title="<?//= base64_encode(DIR.'promotion-basse-saison') ?>">Promotion en cours</span>-->
        <? } ?>
        <div class="clearfix"></div>
       
    </div>
</div>
</div>   
</div>
<!--<div data-role="footer" class="btn-show-footer" data-position="fixed" data-tap-toggle="false"></div>-->
<?
    if(Yii::$app->controller->action->id == 'exclusivites-type' || Yii::$app->controller->action->id == 'exclusivites-single' || Yii::$app->controller->action->id == 'idees-de-voyage-type' || Yii::$app->controller->action->id == 'idees-de-voyage-single'){
        $hide_button_footer = 'opc-0';
    }else{
        $hide_button_footer = Null;
    }
?>


<div id="footer" class="active fix-hide-pages <?= $hide_button_footer ?>" data-role="footer" data-position="fixed" data-tap-toggle="false">
    <div class="links-footer">
       <? if(SEG1 == ''){ ?>
        <a class="btn-cont-devis devis" href="<?= DIR.'devis' ?>" data-ajax="false" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_devis">
<!--           <img alt="" src="/assets/img/mobile/devis-icon.png">-->           
            Demander un devis   
       </a>
       <? }else{ ?>
       <button class="btn-cont-devis devis pugjd" data-title="<?= base64_encode(DIR.'devis') ?>" data-ajax="false" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_devis">
<!--           <img alt="" src="/assets/img/mobile/devis-icon.png">-->
           Demander un devis   
       </button>
       <? } ?>
        <?// if(SEG1 == ''){ ?>
<!--        <span class="b-der">border</span>-->
        <a href="#search-page-voyage" data-transition="slideup" data-direction="" class="btn-cont-devis contact" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_search">    
<!--           <img alt="" src="/assets/img/mobile/contact-icon.png">-->
           Rechercher un circuit</a>
        <?// }else{ ?>
<!--        <button class="btn-cont-devis contact pugjd" data-title="<?//= base64_encode(DIR.'nous-contacter') ?>" data-ajax="false">
           <img alt="" src="/assets/img/mobile/contact-icon.png">
           Rechercher un circuit</button>-->
        <?// } ?>
<!--       <span class="close-links-footer"></span>-->
    </div>
</div>


</div> 
    
<div id="infomation" data-role="page" data-theme="b" class="ui-content" data-transition="slidedown">
    <div class="close-popup-info">
        <a class="btn-testi" href="<?=DIR ?>#page1" data-transition="slideup" data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="icon_close">
fdsfd
        </a>
    </div>
    <div class="area-info">
        <ul>
            <li class="active">
                <? if(SEG1 == ''){?>
                <a data-ajax="false" class="btn-link-contact-info" href="<?= DIR.'nous-contacter' ?>" data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="cta_contact">Contactez-nous</a>
                <? }else{ ?>
                <span data-ajax="false" class="pugjd btn-link-contact-info" data-title="<?= base64_encode(DIR.'nous-contacter') ?>" data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="cta_contact">Contactez-nous</span>
                <? } ?>
            </li>
            <li class="hotline">
                <p class="title-row">Hotline</p>
                <div class="info-phone tt-r1">
                    <p class="first-par">EN FRANCE</p>
                    <p class="text-tt-2">du lundi au vendredi (09h-12h &amp; 14h-18h)</p>   
                    <div data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="number_fr">
                    <p><a href="tel:+33619081572">(+33) 6 19 08 15 72</a></p>
<!--                    <p><a href="tel:+33628227286">(+33) 6 28 22 72 86</a></p>-->
                    </div>
                </div>
                <div class="info-phone tt-r2">
                    <p class="first-par">AU VIETNAM</p>
                    <p class="text-tt-2">du lundi au vendredi (8h-17h30)</p>
                    <p><a href="tel:+84984566676" data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="number_vn">(+84) 9 84 56 66 76</a></p>
                </div>    
            </li>
            <li class="address-mail">
                <a class="btn-link-mail" href="mailto:info@amica-travel.com" data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="link_email">info@amica-travel.com</a>
                <a class="btn-link-other" data-ajax="false" href="<?= DIR.'aide' ?>" data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="link_faq">Centre d'aide</a>
            </li>
        </ul>
    </div>    
</div>
<!-- end popup info -->    
    
<? include "pages.php"; ?>
<? 
  //  if(isset($this->context->arr_option_filter_mobile['namefilter']) && $this->context->arr_option_filter_mobile['namefilter'] != NULL){
        include(dirname(dirname(__FILE__)).'/page2016/mobile/_page-search.php');
   // }
?>
     
<!---->       
<?php $this->endBody() ?>    
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
      
        
        
            
     

</script>
</html>
<?php $this->endPage() ?>
