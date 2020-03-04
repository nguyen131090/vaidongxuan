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
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
         
        <?php $this->registerMetaTag(['charset' => 'utf-8']) ?> 
        <?php $this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']) ?>
        <?//php $this->registerMetaTag(['name' => 'viewport', 'content' => 'initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;']); ?>
        <?//php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=0.8, minimum-scale=0.5']); ?>
		<?//php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width']); ?>
		<?php $this->registerMetaTag(['http-equiv' => 'content-language', 'content' => 'fr']) ?>
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
        <? $this->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->urlManager->createAbsoluteUrl(URI)]);?>
        <? if($this->context->pagination) : ?>
            <? $numPage = Yii::$app->request->get('page') ? Yii::$app->request->get('page') : 1; ?>
            <? if($numPage > 1) : ?>
            <link rel="prev" href="<?=Yii::$app->urlManager->createAbsoluteUrl(URI)?><?=$numPage != 2 ? '?page='.($numPage-1) : '' ?>" />
            <? endif;?>
             <? if($numPage < $this->context->pagination) : ?>
            <link rel="next" href="<?=Yii::$app->urlManager->createAbsoluteUrl(URI)?>?page=<?=$numPage+1?>" />
            <? endif;?>
        <? endif ?>
        <!-- TWITTER -->
        <? 
        $mainImg = $summaryImg = '/assets/img/page2016/logo_amica_travel.png';
        if($this->context->entry){
            if(isset($this->context->entry->model->photos)){
                foreach ($this->context->entry->model->photos as $key => $value) {
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
		<?php $this->registerMetaTag(['property' => 'og:url', 'content' => str_replace('http://', 'https://',Yii::$app->urlManager->createAbsoluteUrl(URI)) ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:type', 'content' => 'website' ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:description', 'content' => $this->context->metaD ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:image', 'content' => str_replace('http://', 'https://',Yii::$app->urlManager->getHostInfo()). $mainImg ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:site_name', 'content' => 'Amica Travel' ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:locale:alternate', 'content' => 'fr' ]); ?>
		
		
		
		<?php $this->registerMetaTag(['name' => 'msvalidate.01', 'content' => '64C6247A095AEDF078755244B0562B56' ]); ?>
		
       <!--
		<meta property="og:title" content="<?//=$this->context->metaT?>" />
        <meta property="og:url" content="<?//=Yii::$app->urlManager->createAbsoluteUrl(URI)?>" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="<?//=$this->context->metaD?>" />
        <meta property="og:image" content="<?//=Yii::$app->urlManager->getHostInfo(). $mainImg ?>" />
        <meta property="og:site_name" content="Amica Travel" />
        <meta property="og:locale:alternate" content="fr" />

        <link rel="publisher" href="https://plus.google.com/+AmicatravelFR" >
        
        <meta name="msvalidate.01" content="64C6247A095AEDF078755244B0562B56" />
		-->

        <!-- END SEO -->

        <?php
       // $this->context->pageT != '' ? $this->title = $this->context->pageT : $this->title = $this->context->metaT;
       $this->registerMetaTag(['name' => 'description', 'content' => $this->context->metaD]);
        // $this->registerMetaTag(['name' => 'title', 'content' => $this->context->metaT]);
         $this->registerMetaTag(['name' => 'keywords', 'content' => '']);
        ?>
        <title><?= Html::encode($this->title = $this->context->metaT) ?></title>
        <?= Html::csrfMetaTags() ?>
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
       <!--Nav when Responsive-->
    <div data-role="header">
            <nav style="" class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="btn-header">
                            <li class="logo"><a class="" href="<?=DIR?>" data-ajax="false"><img alt="" data-src="<?= DIR ?>assets/img/mobile/logo-amica.png" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica"></a></li>
                            
                            <li class="navigation"> 
                                <a href="<?=DIR ?>#page2" data-transition="slide" data-direction="reverse"  class="btn-hum" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="icon_menu">
                                   
                                </a>
                            </li>
                            <li class="search">
                                <a class="btn-testi btn-open-close-popup-main-form" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="icon_infobox">
<!--                                    <img data-src="<?=DIR ?>assets/img/mobile/rdv-icon-header.png">-->
                                </a>
                            </li>
                            
                           <!--  <a class="btn-search" href="#search-page" data-transition="slide"><img data-src="<?=DIR ?>assets/img/mobile/search-icon.png"></a></li> -->
                        </ul>

                    </div>
                </div><!-- /.container-fluid -->
            </nav>
        </div><!-- /header -->

       
       

<!---->       
 <div id="wrapper" class="<?=Yii::$app->controller->layout == 'mobile-form' ? 'wrapper-mobile' : '' ?>">
    <?php if (SEG1 == '') { ?>

        <div class="rows row-banner">

            <div id="mobileCarousel" class="carousel slide">
                <!-- Indicators -->
        <!--      <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>-->

                <!-- Wrapper for Slides -->
                <div class="carousel-inner">
                                 <?   $home = \yii\easyii\modules\page\api\Page::get(31); 
                                //  echo '<pre>';
                                //  var_dump($home->model->photos);exit;
                                  
                    if(!empty($home->model->photos)) :  ?>
                        <? foreach ($home->model->photos as $key => $value) : ?>
                            <? if($value->type == 'banner') : ?>
                            <div class="item item-<?=$key ?> <?=$key==0 ? 'active' : '' ?>">
                                <?php
                                    $img = explode('.', $value->image);
                                ?>
                                <a class="fill"><img alt="" style="width: 100%;" data-src="<?=DIR?>timthumb.php?src=<?= $img[0]?>_m.jpg&w=640&h=820&zc=1"></a>
                                <div class="carousel-caption">
                                     <h2><?=str_replace('|', '<br>', preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '$1', Markdown::process($value->caption)));?></h2>
                                    <a href="<?= $value->description?>">En savoir plus</a>
                                </div>
                            </div>
                            <?  endif;?>
                        <? endforeach; ?>
                    <? endif;?>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#mobileCarousel" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#mobileCarousel" data-slide="next">
                    <span class="icon-next"></span>
                </a>
            </div>  
        </div>   

    <?php } ?>

     
     <?= $content?>
    <div class="rows row-footer hidden" data-role="none">
        <div class="column">
            <p class="tt" data-role="none">REJOIGNEZ-NOUS !</p>
           
            <ul class="group-social">
                <li class="facebook"><a href="https://www.facebook.com/amicatravel/">facebook</a></li>
                <li class="twitter"><a href="https://twitter.com/AmicaTravel">twitter</a></li>
                <li class="instagram"><a href="https://www.instagram.com/amicatravel/">instagram</a></li>
                <li class="youtube"><a href="https://www.youtube.com/c/AmicaTravelAgency">youtube</a></li>
                <li class="pinterest"><a href="https://pinterest.com/amicatravel/">pinterest</a></li>
            </ul>
            <p class="tt">NOTRE BLOG</p>
            
            <p class="tt">Inscription Newsletter</p>
            <form id="newsletter-form"  data-role="none">
                <input class="email" value="" placeholder="Votre adresse mail" name="email" type="text"  data-role="none">
				<p class="error-email" style="display: none; color: #e65925;">
                    Le format de votre email n'est pas valide.
                </p>
                <a class="submit-email"  data-role="none">Valider</a>
            </form>
            
            <p class="fix-space"></p>
            
            <p class="tt">NOS BUREAUX</p>
            <ul class="add-offices">
                <li class="active">Hanoi
                    <div class="info-office" itemscope="" itemtype="http://schema.org/Organization">
                        
                        <p itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"> Building NIKKO, 2ème étage,
                        <span itemprop="streetAddress">27 Rue Nguyen Truong To, Ba Dinh</span>,
                        <span itemprop="addressLocality">Hanoi, Vietnam</span>
                        </p>
                        <p>
                        Téléphone : <span itemprop="telephone">(+84) 9 8456 6676</span>
                        </p>
                        <p>Email : <span itemprop="email">info@amica-travel.com</span></p>
                    </div>
                </li>
                <li class="">ho chi minh ville
                    <div class="info-office" itemscope="" itemtype="http://schema.org/Organization">
                        
                        <p itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Building Resco, 5è étage,
                        <span itemprop="streetAddress">94-96 rue Nguyen Du, 1è Disctrict, </span>
                        <span itemprop="addressLocality">Ho Chi Minh Ville, Vietnam</span>
                        </p>
                        <p>
                        Téléphone : <span itemprop="telephone">(+84) 8 6685 4079</span>
                        </p>
                        <p>Email : <span itemprop="email">info@amica-travel.com</span></p>
                    </div>
                </li>
                <li class="">Siem Reap
                    <div class="info-office" itemscope="" itemtype="http://schema.org/Organization">
                       
                        <p itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Borey Angkor Palace, Building B49 &amp; B50,
                        <span itemprop="streetAddress">Phum Kruos, Sangkat Svay Dangkum, </span>
                        <span itemprop="addressLocality">Siem Reap, Cambodge</span>
                        </p>
                        <p>
                        Téléphone : <span itemprop="telephone">(+85) 5 6396 6139</span>
                        </p>
                        <p>Email : <span itemprop="email">info@amica-travel.com</span></p>
                    </div>
                </li>
                <li class="">Luang Prabang
                    <div class="info-office" itemscope="" itemtype="http://schema.org/Organization">
                        
                        <p itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Ban Pakham, Unit 05 Maison
                        <span itemprop="streetAddress">No 64 Souvannabanlang, </span>
                        <span itemprop="addressLocality">Luang Prabang, Laos</span>
                        </p>
                        <p>
                        Téléphone : <span itemprop="telephone">(+85) 6 7121 2275</span>
                        </p>
                        <p>Email : <span itemprop="email">info@amica-travel.com</span></p>
                    </div>
                </li>
            </ul>
            
            <p class="fix-space"></p>
            
            <p class="tt"><a href="<?DIR?>/actualites">ACTUALITÉS</a></p>
            <p class="tt"><a href="<?DIR?>/recrutement">RECRUTEMENT</a></p>
            <p class="tt"><a href="<?DIR?>/mentions-legales">MENTIONS LÉGALES</a></p>
            
            
            
            <p class="tt"><a href="<?DIR?>/conditions-generales-de-vente">CONDITIONS GÉNÉRALES DE VENTE</a></p>
            
            <p class="fix-space"></p>
            <p class="copyright">© Amica Travel 2017</p>
        </div>
    </div>
     <? if(URI != 'newsletter'){ ?>
     <div class="info-bottom-form">
         <div data-role="none" class="bottom-copyright amica-tralvel-title-bottom">
             <img data-src="../../../upload/image/sticker.png" alt="Img" width="13" height="13">
             <span>Programme 100% <span style="text-transform: uppercase;">personnalisé</span></span>
         </div>
         <div data-role="none" class="bottom-copyright amica-tralvel-title-bottom">
             <img data-src="../../../upload/image/sticker.png" alt="Img" width="13" height="13">
             <span>Réponse <span style="text-transform: uppercase;">sous 48H</span></span>
         </div>
         <div data-role="none" class="bottom-copyright amica-tralvel-title-bottom">
             <img data-src="../../../upload/image/sticker.png" alt="Img" width="13" height="13">
             <span><span style="text-transform: uppercase;">Des experts</span> à votre service</span>
         </div>
     </div>
     <? } ?>
    <p data-role="none" class="bottom-copyright">© Amica Travel 2017</p>
</div>  

    <div id="infomation" data-role="popup" data-theme="a" class="ui-content popup" data-position-to="window" data-transition="slidedown">
        <div class="close-popup-info">
           <a class="btn-testi btn-open-close-popup-main-form" data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="icon_close">
fdsfd
        </a>
        </div>
        <div class="area-info">
            <ul>
                <li class="active">
                   
                </li>
                <li class="hotline">
                    <p class="title-row" style="margin-top: 0;">Hotline</p>
                    <div class="info-phone tt-r1">
                        <p class="first-par">EN FRANCE</p>
                        <p class="text-tt-2">du lundi au vendredi (09h-12h &amp; 14h-18h)</p>    
                        <div data-analytics="on" data-analytics-category="header" data-analytics-action="infobox_section" data-analytics-label="number_fr">
                        <p><a href="tel:+33619081572">(+33) 6 19 08 15 72</a></p>
<!--                        <p><a href="tel:+33628227286">(+33) 6 28 22 72 86</a></p>-->
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
</div>
        <?php $this->endBody() ?>    
       
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
