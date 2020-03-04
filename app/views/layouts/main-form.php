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
        $isIndex = ($this->context->metaIndex == 1) ? 'INDEX' : 'NOINDEX';
        $isFollow = ($this->context->metaFollow == 1) ? 'FOLLOW' : 'NOFOLLOW';
        $result = $isIndex . ', ' . $isFollow;
    ?>
    <? $this->registerMetaTag(['name' => 'ROBOTS', 'content' => $result]); ?>
    <?php $this->registerMetaTag(['name' => 'google-site-verification', 'content' => '5RPgaIZ9TROjN3QeaK_d7YwlSzL8O0GPZRIqVfYVZ-k']); ?>
    <? $this->registerLinkTag(['rel' => 'icon', 'href' => '/favicon.ico?v=1', 'type' => 'image/x-icon']);?>
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
<?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width,initial-scale=1' ]); ?>

<?php $this->registerMetaTag(['name' => 'msvalidate.01', 'content' => '64C6247A095AEDF078755244B0562B56' ]); ?>
<?php
$title = $this->context->metaT;
$description = ($this->context->metaD) ? ($this->context->metaD) : 'Demandez un devis gratuit pour le circuit sur-mesure';

if (preg_match('/form$/', URI)) {
    if(isset($this->context->entry->title)) {
        $tmpTitle = $this->context->entry->title;
        $mystring = $tmpTitle;
        $findme   = '|';
        $pos = strpos($mystring, $findme);

        if ($pos !== false) {
            $tmpTitle = str_replace(" | "," ",$mystring);
        }
        $description = 'Demandez un devis gratuit pour le circuit sur-mesure : ' . $tmpTitle;
        $title = 'Devis - ' . $tmpTitle . ' | Amica Travel';

    }
}
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
?>
<title><?= Html::encode($this->title = $title) ?></title>
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
<meta property="og:url" content="<?= str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.URI ?>" />
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
</head>

<body>
 <!-- Google Tag Manager (noscript) -->
 <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCX7426"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php $this->beginBody() ?>
    <div class="container-fluid contain header">
        <div class="amc-column">
            <div class="logo float-left">
                <a href="<?=DIR?>"><img data-src="/assets/img/form/logo.png" alt="Amica Travel"></a>
            </div>
            <?php if($this->context->action->id == 'rdv-sur-paris'): ?>
                <div class="info-header float-right">
                    <p>Vous pouvez contacter directement Arnaud par :</p>
<!--                    <p>Tél : (+33) 6 28 22 72 86</p>-->
                    <p>Mail : arnaud.l@amicatravel.com</p>
                </div>
            <?php else: ?>
                <div class="info-header float-right">
                    <? if(Yii::$app->controller->action->id == 'devis' || Yii::$app->controller->action->id == 'devis-personnalisation'){
                       echo '<p>Si vous n\'arrivez pas à remplir le formulaire, contactez nous : info@amica-travel.com</p>';
                    }else{ ?>
                    <p>info@amica-travel.com</p>
                    <? } ?>
                    <p>FR : (+33) 6 19 08 15 72</p>
                    <p>VN : (+84) 984 56 66 76</p>
                </div>
            <?php endif;?>
        </div>
    </div>
    <!-- Content -->
        <?=$content?>
        <!-- End content-->
    <?php $this->endBody() ?>    
    <? switch (SEG1) {
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
                default:
                    $srcR = '';
                    $srcL = '/assets/img/illus/famer-left.png';
                    break;
            }
            if(isset($this->context->entry->category_id) && $this->context->entry->category_id == 7){
                 $srcL = '/assets/img/illus/solider.png';
                 $srcR = '/assets/img/illus/boat-right.png';
            }
            if($srcR && strpos('contact-booking', Yii::$app->controller->action->id) === false) :?>
            <img alt="" class="img-lazy fix-img-middle-right" data-src="<?= $srcR?>">
            <? endif; ?>  
</body>

<? if(URI != 'newsletter'){ ?>
<div class="footer contain amica-travel-notification">
    <? if($srcL) :?>
                <img alt="" class="img-lazy fix-img-bottom-left" data-src="<?= $srcL?>">
            <? endif; ?>
    <div class="amc-column center">
        <table class="amica-table-bottom">
            <tr class="amica-tr-bottom">
                <td class="amica-td-bottom">
                    <img data-src="/upload/image/noti-left.png" alt="Programme 100% personnalisé">
                    <span class="amica-span-title">Programme <br>100% personnalisé</span>
                </td>
                <td class="amica-td-bottom">
                    <img data-src="/upload/image/noti-middle.png" alt="Réponse <br>sous 48H">
                    <span class="amica-span-title">Réponse <br>sous 48H</span>
                </td>
                <td class="amica-td-bottom" style="border-right: none;">
                    <img data-src="/upload/image/noti-right.png" alt="Des experts à votre service">
                    <span class="amica-span-title">Des experts <br>à votre service</span>
                </td>
            </tr>
        </table>
    </div>
</div>
<? } ?>
<div class="footer contain">
    <div class="amc-column">
        <p>© Amica Travel 2016</p>
    </div>
</div>
</html>
<?php $this->endPage() ?>
