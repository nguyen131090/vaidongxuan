<?php

$params = require(__DIR__ . '/params.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

$config = [
    'id' => 'app',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
   // 'language' => 'en-US',
    'language' => 'fr',
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
        ],
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ],
        'ckeditor' => [
            'class' => 'wadeshuler\ckeditor\Module',
            'preset' => 'full',    // default: basic - options: basic, standard, standard-all, full, full-all
            'customCdn' => '/assets/plugins/ckeditor/ckeditor.js?v=4', 
            'uploadDir' => '@webroot/uploads',    // must be file path (required when using filebrowser*BrowseUrl below)
            'uploadUrl' => '@web/uploads',
            'widgetClientOptions' => [
                'filebrowserBrowseUrl' => '/ckeditor/default/file-browse',
                'filebrowserUploadUrl' => '/ckeditor/default/file-upload',
                'filebrowserImageBrowseUrl' => '/ckeditor/default/image-browse',
                'filebrowserImageUploadUrl' => '/ckeditor/default/image-upload',
            ]
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pw84HBitmjLhg7eDJztj',
        ],
        'easyimage' => [
            'class' => 'yiicod\easyimage\EasyImage',
            'webrootAlias' => '@webroot',
            'cachePath' => '/upload/watermark_gallery/',
            //'cachePath' => '/'.URI.'/',
            'imageOptions' => [
                'quality' => 100,
                
            ],
        ],
        'reCaptcha' =>[
                    'name' => 'reCaptcha',
                    'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
                    'siteKey' => '6Ld9iUwUAAAAADv0INyr4yJMq9SAu7EvujcwuhNR',
                    'secret' => '6Ld9iUwUAAAAAH_6hPeKP9QL_bRUQPz4adVN3iKt',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'amica-fr/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'urlManager' => [
            'rules' => [
               '<controller:\w+>/view/<slug:[\w-]+>' => '<controller>/view',
               '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
               '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
               '/' => 'amica-fr/index',
                'login' => 'amica-fr/login',
              
                //'amica-fr/ajax-result-menu' => 'amica-fr/ajax-result-menu', // ajax get menu
                'san-pham/<x>' => 'amica-fr/page-list',
                'san-pham/<x>/<y>' => 'amica-fr/page-detail',
                'gioi-thieu' => 'amica-fr/gioi-thieu',
                
                //Landing page
                 'vietnam/circuit-vietnam' => 'amica-fr/landing-page',
                
                //Destinations
                '<x:vietnam|laos|birmanie|cambodge>/maps' => 'amica-fr/maps',
                'destinations' => 'amica-fr/nos-destinations',
                
                 // cac trang destination ideel de voyage, destination Fomules exclusive
                '<x:vietnam|laos|birmanie|cambodge>/itineraire' => 'amica-fr/nos-destinations-country-ideel',
               // '<x:vietnam|laos|birmanie|cambodge>/<y:itineraire>/<z:incontournables|ethnies-sites-insolites|randonnees-treks|famille|balneaire-mer-cocotiers|croisiere|velo|combine>' => 'amica-fr/nos-destinations-country-ideel-type',
                 
                  '<x:vietnam|laos|birmanie|cambodge>/formules' => 'amica-fr/nos-destinations-country-exclusive',
                //  '<x:vietnam|laos|birmanie|cambodge>/formules/<z:au-plus-pres-des-peuples|bouillon-histoire-art-culture|plongee-vie-locale|escales-charme|escapades-gourmandes|paradis-oublies>' => 'amica-fr/nos-destinations-country-exclusive-type',
                
                // end
                
                // informations-pratiques
                '<x:vietnam|laos|birmanie|cambodge>/informations-pratiques' => 'amica-fr/nos-destinations-country-info',
                
                //sites a visiter
                // '<x:vietnam|laos|birmanie|cambodge>/itineraire' => 'amica-fr/nos-destinations-recherche',
                 '<x:vietnam|laos|birmanie|cambodge>' => 'amica-fr/nos-destinations-country',
                 '<x:vietnam|laos|birmanie|cambodge>/visiter' => 'amica-fr/nos-destinations-visiter',   
                 '<x:vietnam|laos|birmanie|cambodge>/guide' => 'amica-fr/nos-destinations-guide-type',
                '<x:vietnam|laos|birmanie|cambodge>/<y>' => 'amica-fr/nos-destinations-type',
              //  '<x:vietnam|laos|birmanie|cambodge>/<y:informations-pratiques>' => 'amica-fr/nos-destinations-type',
                
               
                
               
                '<x:vietnam|laos|birmanie|cambodge>/visiter/<y>' => 'amica-fr/nos-destinations-detaile',
                //info pratics
                '<x:vietnam|laos|birmanie|cambodge>/<a:informations-pratiques|guide>/<y>' => 'amica-fr/nos-destinations-detaile-infos',

                '<x:vietnam|laos|birmanie|cambodge>/<a:informations-pratiques|guide>/<y>/<z>' => 'amica-fr/nos-destinations-detaile-infos-single',
                
                
                
                
                'formules' => 'amica-fr/exclusivites',
                'formules/itineraire' => 'amica-fr/result-nos-secret-dailleurs-exclusivites',
                'formules/<x:vietnam|laos|birmanie|cambodge>' => 'amica-fr/exclusivites-type-country',
                'formules/<x>' => 'amica-fr/exclusivites-type',
                '<x:vietnam|laos|birmanie|cambodge>/formules/<y>' => 'amica-fr/exclusivites-single',
                '<x:vietnam|laos|birmanie|cambodge>/formules/<y>/form' => 'amica-fr/contact-booking',
                
                  //voyage
                'voyage' => 'amica-fr/idees-de-voyage',
                'voyage/itineraire' => 'amica-fr/recherche-idees-de-voyage',
                // 'voyage/balneaire-mer-cocotiers' => 'amica-fr/idees-de-voyage-entre-ocean',
                'voyage/<x>' => 'amica-fr/idees-de-voyage-type',

                //'voyage/itineraire/entre-ocean-et-cocotiers' => 'amica-fr/idees-de-voyage-entre-ocean',
                'voyage/itineraire/entre-ocean-et-cocotiers/<x>' => 'amica-fr/idees-de-voyage-list-entre-ocean',
                'voyage/itineraire/entre-ocean-et-cocotiers/<x>/<y>' => 'amica-fr/idees-de-voyage-entre-ocean-single',
                '<x:vietnam|laos|birmanie|cambodge>/itineraire/<y>' => 'amica-fr/idees-de-voyage-single',
                '<x:vietnam|laos|birmanie|cambodge>/itineraire/<y>/form' => 'amica-fr/devis-booking',
                
               // 'recherche-idees-de-voyage' => 'amica-fr/recherche-idees-de-voyage',
                'a-propos-de-nous' => 'amica-fr/propos-de-nous-about-us',
                'temoignages/recherche' => 'amica-fr/search-temoignage-about-us',
                'portrait-voyageur' => 'amica-fr/portrait-about-us',
                'temoignages' => 'amica-fr/temoignage-type-about-us',
                
                'explorateurs' => 'amica-fr/decouvrez-le-pays-about-us',
                'explorateurs/reportages' => 'amica-fr/reportages-about-us',
                'explorateurs/<x>/<y>' => 'amica-fr/decouvrez-le-pays-single-about-us',
                
              // off page nay  'voyage-selon-envies' => 'amica-fr/envie-du-moment-about-us',
                
                'tourisme-solidaire' => 'amica-fr/fondation-about-us',
                'tourisme-solidaire/associations' => 'amica-fr/associations-about-us',
                'tourisme-solidaire/partenaires' => 'amica-fr/associations-about-us',
                
                'tourisme-solidaire/projets' => 'amica-fr/projets-about-us',
                
                'tourisme-solidaire/projets/<x>' => 'amica-fr/fondation-thongnong-about-us',
                'tourisme-solidaire/projets/<x>/<y>' => 'amica-fr/fondation-thongnong-single-about-us',
                'tourisme-solidaire/partenaires/<x>' => 'amica-fr/fondation-single-about-us',
                'tourisme-solidaire/associations/<x>' => 'amica-fr/fondation-single-about-us',
                
                'presse' => 'amica-fr/espace-presse-about-us',
                
                'chez-habitant-indochine' => 'amica-fr/nos-secret',
                'chez-habitant-indochine/<x>' => 'amica-fr/host',
                'voyage-avec-amica-travel' => 'amica-fr/improvisez-about-us',
                'mot-du-fondateur' => 'amica-fr/qui-sommes-nous-about-us',
                'nos-bureaux' => 'amica-fr/office-about-us',
                'nos-bureaux/<x>' => 'amica-fr/office-single-about-us',
                'notre-equipe' => 'amica-fr/notre-equipe-about-us',
                'francophonie' => 'amica-fr/fran-co-phonie',
                
		// page quand comment combien
                // 'quand-comment-combien' => 'amica-fr/quand-comment-combien-about-us',
                'promotion-basse-saison' => 'amica-fr/promotion-basse-saison-about-us',
                
                'portrait-voyageur/<x>' => 'amica-fr/portrait-single-about-us',
                'confiance' => 'amica-fr/temoignage-about-us',
                'temoignages/<x>' => 'amica-fr/temoignage-single-about-us',
                
                'actualites' => 'amica-fr/actualites-about-us',
                'actualites/<x>' => 'amica-fr/actualites-single-about-us',
                
                '10-raisons-de-partir-avec-amica-travel' => 'amica-fr/raisons-about-us',
                'club-ami-amica' => 'amica-fr/club-ami-about-us',
                'recrutement' => 'amica-fr/recrutement-about-us',
                'recrutement/<x>' => 'amica-fr/recrutement-single-about-us',
                
                'mentions-legales|politique-de-confidentialite' => 'amica-fr/mentions-legales-about-us',
                'conditions-generales-de-vente' => 'amica-fr/conditions-about-us',
				
               'aide' => 'amica-fr/faq',
                'aide/search' => 'amica-fr/faq-search',
                
                'aide/<x>' => 'amica-fr/faq-single',
                //'aide/<x>/<y>' => 'amica-fr/faq-single',
                
               
                
                'votre-liste-envies' => 'amica-fr/votre-projet',
                'rdv-sur-paris' => 'amica-fr/rdv-sur-paris',

                'nous-contacter' => 'amica-fr/contact',
                'devis' => 'amica-fr/devis',
                'devis-personnalisation' => 'amica-fr/devis-personnalisation',
                'rdv-telephonique' => 'amica-fr/rdv',
                'merci' => 'amica-fr/thanks',
                'newsletter' =>'amica-fr/newsletter',
                '/site/captcha' => 'amica-fr/captcha',
                 '/imsprint/<id>/<code>' => 'amica-fr/imsprint',
                '/imsprint-en/<id>/<code>' => 'amica-fr/ims-print-en',
                 '/imsprint-b2b/<id>/<code>' => 'amica-fr/imsprint-b2b',
                '/imsprint-b2b-en/<id>/<code>' => 'amica-fr/imsprint-b2b-en',
                'inquiries/<id>' => 'amica-fr/for-ims',
            ],
        ],
        'assetManager' => [
            // uncomment the following line if you want to auto update your assets (unix hosting only)
            //'linkAssets' => true,
            'bundles' => SEG1 != 'admin' && !IS_MOBILE ? [
                'yii\web\JqueryAsset' => [
                   'js' => ['/assets/js/jquery-1.11.1.min.js']
                ],
                'yii\bootstrap\BootstrapAsset' => [
                   'css' => ['/assets/css/bootstrap4.min.css'],
                   
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                  'js' => ['/assets/js/popper.min.js', '/assets/js/bootstrap.js']
                ],
            ] : ['yii\web\JqueryAsset' => [
                   'js' => ['/assets/js/jquery-1.11.1.min.js']
                ]
            ],
            'forceCopy' => YII_ENV_DEV ? true : false
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=amica_fr',
            'username' => 'amica_fr',
            'password' => '2w#E4r%T',
            'charset' => 'utf8',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['components']['assetManager']['forceCopy'] = true;
   // configuration adjustments for 'dev' environment
   // $config['bootstrap'][] = 'debug';
   // $config['modules']['debug'] = 'yii\debug\Module';

   // $config['bootstrap'][] = 'gii';
   // $config['modules']['gii'] = 'yii\gii\Module';
   
   // $config['components']['db']['enableSchemaCache'] = false;
}

return array_merge_recursive($config, require($webroot . '/vendor/noumo/easyii/config/easyii.php'));