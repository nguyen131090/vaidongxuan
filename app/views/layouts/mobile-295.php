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
        <? if(Yii::$app->request->get('page') || (SEG1 == 'devis') || (SEG1 == 'votre-liste-envie') || (SEG1 == 'merci')) 
                $this->registerMetaTag(['name' => 'ROBOTS', 'content' => 'NOINDEX, FOLLOW']);
            else    
                $this->registerMetaTag(['name' => 'ROBOTS', 'content' => 'INDEX, FOLLOW']);
        ?>
        <?php $this->registerMetaTag(['name' => 'google-site-verification', 'content' => '5RPgaIZ9TROjN3QeaK_d7YwlSzL8O0GPZRIqVfYVZ-k']); ?>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		
       <link rel="icon" href="/favicon.ico?v=1" type="image/x-icon" />
		<?php $this->head() ?>
        <!-- BEGIN SEO -->
        <? $this->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->urlManager->createAbsoluteUrl(URI)]);?>
       <? $this->registerLinkTag(['rel' => 'alternate', 'href' => Yii::$app->urlManager->createAbsoluteUrl(URI), 'hreflang' => 'x-default']);?>
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
        <?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0' ]); ?>
		<?php $this->registerMetaTag(['name' => 'twitter:card', 'content' => Yii::$app->urlManager->getHostInfo(). $summaryImg ]); ?>
		<?php $this->registerMetaTag(['name' => 'twitter:site', 'content' => '@amicatravel' ]); ?>
		<?php $this->registerMetaTag(['name' => 'twitter:title', 'content' => $this->context->metaT ]); ?>
		<?php $this->registerMetaTag(['name' => 'twitter:description', 'content' => $this->context->metaD ]); ?>
		<?php $this->registerMetaTag(['name' => 'twitter:image', 'content' => Yii::$app->urlManager->getHostInfo(). $mainImg ]); ?>
        
		<!--
		<meta name="twitter:card" content="<?//=Yii::$app->urlManager->getHostInfo(). $summaryImg ?>">
        <meta name="twitter:site" content="@amicatravel">
        <meta name="twitter:title" content="<?//=$this->context->metaT?>">
        <meta name="twitter:description" content="<?//=$this->context->metaD?>">
        <meta name="twitter:image" content="<?//=Yii::$app->urlManager->getHostInfo(). $mainImg ?>">
		-->
        <!-- FACEBOOK -->
		
		<?php $this->registerMetaTag(['property' => 'og:title', 'content' => $this->context->metaT ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->urlManager->createAbsoluteUrl(URI) ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:type', 'content' => 'website' ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:description', 'content' => $this->context->metaD ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->urlManager->getHostInfo(). $mainImg ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:site_name', 'content' => 'Amica Travel' ]); ?>
		<?php $this->registerMetaTag(['property' => 'og:locale:alternate', 'content' => 'fr' ]); ?>
		
		<?php $this->registerLinkTag(['rel' => 'publisher', 'href' => 'https://plus.google.com/+AmicatravelFR']);?>
		
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
<script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
(a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
})(window,document.documentElement,'async-hide','dataLayer',4000,
{'GTM-P3JTNZ6':true});</script>

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
        
       <!--Nav when Responsive-->
<nav style="" class="navbar navbar-default navbar-fixed-top">
   
    <div class="container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">


            <ul class="btn-header">
                <li class="search"><a class="btn-search" href="javascript:void(0);" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">Search</a></li>
                <li class="logo"><a class="" href="<?=DIR?>"><img alt="Amica Travel" src="<?= DIR ?>assets/img/mobile/logo_amica_149_59.png"></a></li>
                <li class="navigation"> 
                    <a href="javascript:void(0);" class="btn-hum" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        humberger
                    </a>
                </li>
            </ul>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mn-humburger" id="bs-example-navbar-collapse-1">
            <ul class="nav-parent">
                <li class="<?= SEG1 == 'destinations' ? 'active' : ''?>"><a href="<?=DIR?>destinations">NOS DESTINATIONS </a><span class="plus">plus</span>
                    <ul class="click-action nav-sub">
                            <?php
                                $cnt = 0;
                                foreach ($this->context->destiMenu as $v) {
                                    
                                    if($v->depth == 0){
                                        $cnt++;
                            ?>
                                    <li><a href="<?= DIR.$v->slug?>" ><?= $v->title?></a></li>
                                <?php } }?>
			</ul>
                </li>
                <li class="<?= SEG1 == 'secrets-ailleurs' ? 'active' : ''?>"><a href="<?=DIR?>secrets-ailleurs">NOS SECRETS D’AILLEURS </a><span class="plus">plus</span>
                    <ul class="click-action nav-sub">    
                        <?php
                            foreach ($this->context->excluMenu as $v) {
                        ?>
                            <li><a href="<?=DIR.$v->slug?>"><?= $v->title?></a></li>
                        <?php  } ?>
                    </ul>  
                </li>
                <li class="<?= SEG1 == 'voyage' ? 'active' : ''?>"><a href="<?=DIR?>voyage">IDÉES DE VOYAGE </a><span class="plus">plus</span>
                    <ul class="click-action nav-sub">    
                        <?php
                            foreach ($this->context->ideesMenu as $v) {
                        ?>
                            <li><a href="<?=DIR.$v->slug?>"><?= $v->title?></a></li>
                        <?php  } ?>
                    </ul>  
                </li>
                <li class="<?= SEG1 == 'a-propos-de-nous' ? 'active' : ''?>"><a href="<?=DIR?>a-propos-de-nous">À PROPOS DE NOUS </a><span class="plus">plus</span>
                    <ul class="click-action nav-sub">    
                        <?php
                            foreach ($this->context->aproMenu as $v) {
                        ?>
                            <li><a href="<?=DIR.$v->slug?>"><?= $v->title?></a></li>
                        <?php  } ?>
                    </ul>  
                </li>
            </ul>
            <div class="mn-bottom">
                <ul>
                    <li class="formulaire"><a href="javascript:void(0)">Formulaire de contact</a></li>
                    <li class="info-mail"><a href="javascript:void(0)">info@amica-travel.com</a></li>
                </ul>
            </div>
            <span class="text-copyright">© AMICA TRAVEL 2017</span>
        </div><!-- /.navbar-collapse -->
        
        <!-- Area Search Form -->
        
        <div class="collapse navbar-collapse mn-humburger mn-search" id="bs-example-navbar-collapse-2">
            <p class="tt">que recherchez-vous ?</p>
            <ul class="nav-parent">
                <li class=""><a href="javascript:void(0);">une idée de voyage </a><span class="plus">plus</span>
                    <div class="click-action group-search-prog">
                        <form class="form-search horizontal search-prog-form">
                            <div class="cs-select search-destination destination-mn-3">
                                <span class="cs-placeholder">Destination (s)</span>
                                    <div class="cs-options" style="display: none;">
                                            <ul>
                                                 <li data-option="" data-value="vietnam">Vietnam</li>
                                        <li data-option="" data-value="laos">Laos</li>
                                        <li data-option="" data-value="cambodge">Cambodge</li>
                                        <li data-option="" data-value="birmanie">Birmanie</li>
                                            </ul>
                                    </div>
                                     <div class="list-option">
                                        <ul>
                                        <li data-value="vietnam">Vietnam<span></span></li>
                                        <li data-value="laos">Laos<span></span></li>
                                        <li data-value="cambodge">Cambodge<span></span></li>
                                        <li data-value="birmanie">Birmanie<span></span></li>
                                        </ul>    
                                    </div>

                            </div>
                            <div class="cs-select search-length duree-mn-3">
                                <span class="cs-placeholder">Durée</span>
                                    <div class="cs-options" style="display: none;">
                                            <ul>
                                        <li data-option="" data-value="1-7">1-7 jours</li>
                                        <li data-option="" data-value="8-14">8-14 jours</li>
                                        <li data-option="" data-value="15">Plus de 14 jours</li>
                                            </ul>
                                    </div>
                                     <div class="list-option">
                                        <ul>
                                         <li data-option="" data-value="1-7">1-7 jours<span></span></li>
                                        <li data-option="" data-value="8-14">8-14 jours<span></span></li>
                                        <li data-option="" data-value="15">Plus de 14 jours<span></span></li>
                                        </ul>    
                                    </div>

                            </div>
                             <div class="cs-select search-type type-voyage-mn-3">
                                <span class="cs-placeholder">Type de voyage</span>
                                    <div class="cs-options" style="display: none;">
                                            <ul>
                                                <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                           <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                                        <? endforeach ?>

                                            </ul>
                                    </div>
                                    <div class="list-option">
                                        <ul>
                                        <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                           <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                                        <? endforeach ?>
                                        </ul>    
                                    </div>

                            </div>
                            <div class="cs-select submit">
                                RECHERCHE
                            </div>
                        </form>
                    </div>
                </li>
                <li class=""><a href="javascript:void(0);">un secret d’ailleurs </a><span class="plus">plus</span>
                    <div class="click-action group-search-excl">
                        <form class="form-search horizontal search-excl-form">
                            <div class="cs-select search-destination destination-mn-2">
                                <span class="cs-placeholder">Destination(s)</span>
                                    <div class="cs-options" style="display: none;">
                                            <ul>
                                                <li data-option="" data-value="vietnam">Vietnam</li>
                                        <li data-option="" data-value="laos">Laos</li>
                                        <li data-option="" data-value="cambodge">Cambodge</li>
                                        <li data-option="" data-value="birmanie">Birmanie</li>
                                            </ul>
                                    </div>
                                <div class="list-option">
                                    <ul>
                                      <li  data-value="vietnam">Vietnam<span></span></li>
                                        <li  data-value="laos">Laos<span></span></li>
                                        <li  data-value="cambodge">Cambodge<span></span></li>
                                        <li  data-value="birmanie">Birmanie<span></span></li>
                                    </ul>
                                </div>    

                            </div>
                            <div class="cs-select search-type search-envies votre-envie-mn-2">
                                <span class="cs-placeholder">Votre envie du moment</span>
                                    <div class="cs-options" style="display: none;">
                                            <ul>
                                               <? foreach ($type = \app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) : ?>
                                           <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                                        <? endforeach ?>
                                            </ul>
                                    </div>
                                 <div class="list-option">
                                    <ul>
                                       <? foreach ($type as $key => $value) : ?>
                                           <li data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                                        <? endforeach ?>
                                    </ul>
                                </div> 

                            </div>
                            <div class="cs-select submit">
                                RETROUVEZ UNE IDÉE
                            </div>
                        </form>
                    </div>    
                </li>
               
            </ul>
           <span class="text-copyright">© AMICA TRAVEL 2017</span> 
        </div><!-- /.navbar-collapse -->
        
        <!-- End Search Form -->
        
    </div><!-- /.container-fluid -->
</nav>
       
       
<nav class="navbar navbar-default fix-nav-bottom navbar-fixed-bottom">
    <div class="container-fluid">

        <div class="navbar-header navbar-bottom">

            <ul class="btn-bottom">
                <li class="contact"><a href="<?=DIR?>nous-contacter"><img alt="Amica travel" src="<?=DIR?>assets/img/mobile/contact_182_33.png"></a></li>
                <li class="devis"><a href="<?=DIR?>devis"><img alt="Amica travel" src="<?=DIR?>assets/img/mobile/devis_178_47.png"></a></li>
                <li class="rdv"><a href="<?=DIR?>rdv-telephonique"><img alt="Amica travel" src="<?=DIR?>assets/img/mobile/rdv_163_50.png"></a></li>
                        
            </ul>

        </div>
    </div><!-- /.container-fluid -->
</nav>
<!---->       
 <div id="wrapper">
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
                                <a class="fill"><img alt="" style="width: 100%;" src="<?=DIR?>timthumb.php?src=<?= $img[0]?>_m.jpg&w=640&h=820&zc=1"></a>
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
    <div class="rows row-footer">
        <div class="column">
            <p class="tt">REJOIGNEZ-NOUS !</p>
           
            <ul class="group-social">
                <li class="facebook"><a href="https://www.facebook.com/amicatravel/">facebook</a></li>
                <li class="twitter"><a href="https://twitter.com/AmicaTravel">twitter</a></li>
                <li class="instagram"><a href="https://www.instagram.com/amicatravel/">instagram</a></li>
                <li class="youtube"><a href="https://www.youtube.com/c/AmicaTravelAgency">youtube</a></li>
                <li class="pinterest"><a href="https://pinterest.com/amicatravel/">pinterest</a></li>
            </ul>
             <p class="tt">NOTRE BLOG</p>
            
            
            
            <p class="tt">Inscription Newsletter</p>
            <form id="newsletter-form">
                <input class="email" value="" placeholder="Votre adresse mail" name="email" type="text">
				<p class="error-email" style="display: none; color: #e65925;">
                    Le format de votre email n'est pas valide.
                </p>
                <a class="submit-email">Valider</a>
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
</div>   
 <a style="display: none;" href="#" id="back-to-top" title="Back to top" class="show">
            <img alt="amica travel" src="<?=DIR?>assets/img/page2016/back-to-top.png">
        </a>       
       

        <?php $this->endBody() ?>    
       
    </body>
</html>
<?php $this->endPage() ?>
