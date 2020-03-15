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
            $isIndex = ($this->context->metaIndex == 1) ? 'NOINDEX' : 'NOINDEX';
            $isFollow = ($this->context->metaFollow == 1) ? 'NOFOLLOW' : 'NOFOLLOW';
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
        <meta name="twitter:site" content="">
        <meta name="twitter:title" content="<?= $twitterTitle ?>">
        <meta name="twitter:description" content="<?= $twitterDescription ?>">
        <meta name="twitter:image" content="<?=str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()). $twitterImg ?>">
        <meta property="og:title" content="<?= $fbTitle ?>" />
        <meta property="og:url" content="<?= str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.URI.$isspage ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="<?= $fbDescription ?>"/>
        <meta property="og:image" content="<?=str_replace('http://', 'https://',Yii::$app->urlManager->getHostInfo()). $fbImg ?>" />
        <meta property="og:site_name" content="" />
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
<!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TCX7426');</script>-->
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
<!--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCX7426"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>-->
<!-- End Google Tag Manager (noscript) -->
        <?php $this->beginBody() ?>
        
       <!-- Nav Responsive - Banner-->
       <!-- end Nav - Banner - Responsive-->
        
       
        <?php if(Yii::$app->controller->action->id == 'index'){ ?>
<!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide carousel-fade">
        <!-- Indicators -->
      <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <?   $home = \yii\easyii\modules\page\api\Page::get(31); 
            $i = 0;
            if(!empty($home->photos)) :  ?>
                <? foreach ($home->photos as $key => $value) : ?>
                    <? if($value->type == 'banner') : ?>
                    <div class="carousel-item item item-<?=$i ?> <?=$i==0 ? 'active' : '' ?>">
                        <div class="fill" style="background-image:url('<?=$value->image?>');"></div>
                        
                    </div>
                    <? $i++; ?>
                    <?  endif;?>
                <? endforeach; ?>
            <? endif;?>
        </div>
        
        <div class="text-sologan index-page">
            <div class="">
                <div class="tt-sologan">
                    <p>Chuyên bán buôn, bán lẻ các loại vải quần áo :<span> Quầy 119 - B2 - Tầng 2- Chợ Đồng Xuân - Hà Nội - SDT : 0909 415 375 </span></p>
                </div>
            </div>
        </div>
        <div class="fix-scroll-menu index-page">   
        
                <div class="area-btn-list-menu d-xs-none  d-sm-none d-xl-block">

                    <div class="group-list">
                        <div class="btn-logo">
                            <a href="<?=DIR?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica">
                                <img alt="Amica Travel" style="width: 60px;" data-src="<?= DIR?>assets/img/dtn/dtn-logo.png">
                            </a>    
                        </div>
                        <ul class="group-btn">
                            <li><span class="btn-mn sub-mn-1 <?=$this->context->destination ? 's-active' : '' ?>" data-name="sub-mn-1" data-analytics="off" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_dest">Các loại vải</span></li>
                            <li><a class="btn-mn sub-mn-2 <?=$this->context->exclusives ? 's-active' : '' ?>" data-name="sub-mn-2" href="<?=DIR.'gioi-thieu'?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_secrets">Giới thiệu</a></li>
<!--                            <li><a class="btn-mn sub-mn-3 <?=$this->context->programes ? 's-active' : '' ?>" data-name="sub-mn-3" href="<?=DIR.'voyage'?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_voyage">Idées de voyage</a></li>
                            <li><a class="btn-mn sub-mn-4  <?=$this->context->aboutUs ? 's-active' : '' ?>" data-name="sub-mn-4" href="<?=DIR.'a-propos-de-nous'?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_qui">Qui sommes-nous</a></li>-->
                        </ul>
                        

                    </div>  
                    <div class="ajax-result-menu">
                        <?//php include_once '_inc_sub_menu.php';?>
                    </div>    

                </div> 

                <!-- menu responsive  -->
                <nav class="navbar navbar-inverse navbar-expand-xl d-xs-block  d-sm-block d-xl-none nav-fixed-responsive p-0">
                        <div class="navbar-header text-center align-center col-12 pl-0 pr-0 d-flex align-items-center justify-content-between">
                            <a class="logo float-left d-flex align-items-center justify-content-between" href="/"><img style="width: 60px;" alt="" data-src="<?= DIR?>assets/img/dtn/dtn-logo.png"></a>
                            
                            <div class="d-flex align-items-center justify-content-between">
                            
                                <button class="fix-menu-tablet navbar-toggle navbar-toggler collapsed float-right d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <!--                                <span class="icon-bar mb-1"></span>
                                    <span class="icon-bar mb-1"></span>
                                    <span class="icon-bar"></span> 
                                    <span class="text-menu">Menu</span>-->
                                    <img alt="Menu" data-src="/assets/img/page2016/menu_responsive_new_44_43.png">
                                </button>
                            </div>
                        </div>
                    <div class="collapse navbar-collapse col-12 px-20" id="myNavbar">
                </div>
            </nav>

            <!-- end menu responsive -->

        </div>    
        
        
        <div class="dtn-info">
            <p>Quầy vải DƯ HUẤN</p>
            <p>119 - B2 - Tầng 2 - chợ Đồng xuân - Hà Nội</p>
            <p>Liên Hệ : 0909 415 375</p>
        </div>

</header>
    <?php }else{ ?>    
        <div class="text-sologan">
            <div class="">
                <div class="tt-sologan">
                    <p>Chuyên bán buôn, bán lẻ các loại vải quần áo :<span> Quầy 119 - B2 - Tầng 2- Chợ Đồng Xuân - Hà Nội - SDT : 0909 415 375 </span></p>
                </div>
            </div>
        </div>
        

   <?php } ?>
        
     
        <!-- Content -->
        <main>
        <?php if(Yii::$app->controller->action->id != 'index'){ ?>    
        <div class="fix-scroll-menu">   
        
                <div class="area-btn-list-menu d-xs-none  d-sm-none d-xl-block">

                    <div class="group-list">
                        <div class="btn-logo">
                            <a href="<?=DIR?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica">
                                <img alt="Amica Travel" style="width: 60px;" data-src="<?= DIR?>assets/img/dtn/dtn-logo.png">
                            </a>    
                        </div>
                        <ul class="group-btn">
                            <li><span class="btn-mn sub-mn-1 <?=$this->context->destination ? 's-active' : '' ?>" data-name="sub-mn-1" data-analytics="off" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_dest">Các loại vải</span></li>
                            <li><a class="btn-mn sub-mn-2 <?=$this->context->exclusives ? 's-active' : '' ?>" data-name="sub-mn-2" href="<?=DIR.'gioi-thieu'?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_secrets">Giới thiệu</a></li>
<!--                            <li><a class="btn-mn sub-mn-3 <?=$this->context->programes ? 's-active' : '' ?>" data-name="sub-mn-3" href="<?=DIR.'voyage'?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_voyage">Idées de voyage</a></li>
                            <li><a class="btn-mn sub-mn-4  <?=$this->context->aboutUs ? 's-active' : '' ?>" data-name="sub-mn-4" href="<?=DIR.'a-propos-de-nous'?>" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="link_qui">Qui sommes-nous</a></li>-->
                        </ul>
                        

                    </div>  
                    <div class="ajax-result-menu">
                        <?//php include_once '_inc_sub_menu.php';?>
                    </div>    

                </div> 

                <!-- menu responsive  -->
                <nav class="navbar navbar-inverse navbar-expand-xl d-xs-block  d-sm-block d-xl-none nav-fixed-responsive p-0">
                        <div class="navbar-header text-center align-center col-12 pl-0 pr-0 d-flex align-items-center justify-content-between">
                            <a class="logo float-left d-flex align-items-center justify-content-between" href="/"><img style="width: 60px;" alt="" data-src="<?= DIR?>assets/img/dtn/dtn-logo.png"></a>
                            
                            <div class="d-flex align-items-center justify-content-between">
                            
                                <button class="fix-menu-tablet navbar-toggle navbar-toggler collapsed float-right d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <!--                                <span class="icon-bar mb-1"></span>
                                    <span class="icon-bar mb-1"></span>
                                    <span class="icon-bar"></span> 
                                    <span class="text-menu">Menu</span>-->
                                    <img alt="Menu" data-src="/assets/img/page2016/menu_responsive_new_44_43.png">
                                </button>
                            </div>
                        </div>
                    <div class="collapse navbar-collapse col-12 px-20" id="myNavbar">
                </div>
            </nav>

            <!-- end menu responsive -->

        </div>        
        <? } ?>    
            
        <?=$content?>
<!--            <div id="monitor">
              <div id="isIntersecting">
                <span class="placeholder">0</span>
                images loaded
                </div>
            </div>    -->
        </main>
        
        <!-- End content-->
        
        <div class="contain footer-bg fix-responsive-footer-sm">
            <div class="amc-column">
                <div class="row mt-40 mb-40">
                    <div class="col-sm-6">
                        <p class="tt-1 tt-fontsize-24 tt-latolatin-bold">Thông tin liên hệ</p>
                        <p>Dư Huấn</p>
                        <p>MST : 0100143770</p>
                        <p>Bán buôn - bán lẻ các loại vải</p>
                        <p>Quầy 119 - B2 Tầng 2 Bắc Qua - chợ Đồng Xuân</p>
                        <p class="tt-title">Địa chỉ Nhà</p>
                        <p>Số 5 Ngõ 139 đường La Nội - Hà Đông - Hà Nội</p>
                        <p>SĐT Cô Huấn : <a class="a-hover" href="tel:0909 415 375">0909 415 375</a></p>
                       
                    </div>
                    <div class="col-sm-6">
                        <p class="tt-1 tt-fontsize-24 tt-latolatin-bold">Thông tin tài khoản</p>
                        <p>Chủ Tài Khoản : Nguyễn Thị Giang</p>
                        <p>Số TK : 103 000 284 991</p>
                        <p>NH TMCP Công Thương - CN Hoàn Kiếm</p>
                    </div>
                    
                </div>    
            </div>
            
           
                    
                
            <div class="area-ft area-copyright">
                <span class="copytext">&copy; Quầy 119 - B2 - Tầng 2 - chợ Đồng Xuân - Hà Nội </span>
                
            </div>
        
        </div>
        <span style="display: none;" id="back-to-top" title="Back to top" class="show">
            <img alt="" data-src="<?=DIR?>assets/img/page2016/back-to-top.png" data-analytics="on" data-analytics-category="overlay" data-analytics-action="overlay" data-analytics-label="cta_top">
        </span> 

        
            
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
        
<div class="chat-online">
                <!-- Load Facebook SDK for JavaScript -->
                <div id="fb-root"></div>
                <script>
                  window.fbAsyncInit = function() {
                    FB.init({
                      xfbml            : true,
                      version          : 'v4.0'
                    });
                  };

                  (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

                <!-- Your customer chat code -->
                <div class="fb-customerchat"
                    attribution=setup_tool
                    page_id="108229580798260"
                    theme_color="">
                </div>
                <!-- chat Subiz -->       
<!--                <script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",37317]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>
                <style>
                    .sbzon, .sbzoff{
                        //   bottom: 2.3vw !important;
                        right: 0 !important;
                        //height: 2vw !important;
                    }
                    #subiz_wrapper{
                        right: 0 !important;
                    }
                </style>    -->
                <!-- End chat Subiz  -->
            </div>
               
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
