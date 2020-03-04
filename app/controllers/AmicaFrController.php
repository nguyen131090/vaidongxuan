<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\helpers\Security;
use app\modules\whoarewe\api\Catalog;
use app\models\ContactForm;
use app\models\ContactFormMobile;
use app\models\Country;
use app\models\DevisForm;
use app\models\DevisFormMobile;
use app\models\DevisPersionalForm;
use app\models\DevisPersionalFormMobile;
use app\models\NewsletterForm;
use app\models\Inquiry;
use app\models\Nlsub;
use Mailgun\Mailgun;
use app\models\ChItems;
use app\models\ChCategory;
use yii\easyii\modules\page\api\Page;
use app\helpers\Mailjet;
use Mailjet\Resources;
use Mailjet\Client;

// use yii\httpclient\Client;

class AmicaFrController extends Controller {
   
   public $destiMenu = [];
   public $ideesMenu = [];
   public $excluMenu = [];
   public $aproMenu = [];
   public $pageT = '';
   public $metaT = '';
   public $metaD = '';
   public $seoContent = '';
   public $metaK = '';
    public $metaFbT = '';
    public $metaFbD = '';
    public $metaFbImg = '';
   public $metaIndex = 1;
   public $metaFollow = 1;
   public $canonical = '';
   public $site;
   public $countTour = 0;
   public $countExcl = 0;
   public $envies = [];
   public $destination = false;
   public $exclusives = false;
   public $programes = false;
   public $aboutUs = false;
   public $id_inquiry = NULL;
   // breadcrumb
   public $root;
   public $entry;
   public $pagination = 0;
   public $iconBanner = [];
   public $notBannerRight = false;
    public $totalCount = 0;
    public $arr_option_filter_voyage_mobile = [];
    public $arr_option_filter_exclusives_mobile = [];
    public $priceSeo;
    public $json_ld_breadcrumd = Null;
    public $update_meta = NULL;


    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);

     
        
      //  if (!$this->site) throw new HttpException(404, 'Web site could not be found.');
        if(URI)
            $this->redirectUrl(URI);

        // Original http referrer
        if (!Yii::$app->session->get('ref')) {
            Yii::$app->session->set('ref', Yii::$app->request->getReferrer());
        }
        
        $this->destiMenu = $this->getDestimenu();
        $this->ideesMenu = $this->getIdeesmenu();
        $this->excluMenu = $this->getExclumenu();
        $this->aproMenu = $this->getApromenu();
        

        // Mobile layout
        if (IS_MOBILE) {
            $this->layout = 'mobile';
        }
        if(IS_MOBILE || IS_TABLET){
            $arr_country = ['vietnam','laos','cambodge','birmanie'];
            $getAjaxFilter = $this->getAjaxFilter(['country'=>in_array(SEG1, $arr_country) ? SEG1 : '', 'type'=>'']);
            $this->arr_option_filter_voyage_mobile = [
                    'title_filter' => $this->pageT,
                    'namefilter' => 'filter_voyage',
                    'uri' =>URI,
                   // 'totalCount' => count(\app\modules\programmes\api\Catalog::items(['pagination' => ['pageSize' => 0]])),
                    'totalCount' => $getAjaxFilter['totalCount'],
                    //'totalCount_exclusives' => 0,
                    'country' => in_array(SEG1, $arr_country) ? SEG1 : 'all',
                    'type' => 'all',
                    'length' => 'all',
                    'numberFilter' => $getAjaxFilter,
                ];
        }
    }
	
	// xu ly devis
	 public static function allowedDomains()
    {
        return [
            // '*',                        // star allows all domains
            'https://my.amicatravel.com',
        ];
    }

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                           => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['POST'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],
        ];
    }
	
	// end process devis
	
    public function redirectUrl($uri){
        if(substr(URI, 0, 6) == 'upload' || substr(URI, 0, 5) == 'thumb' || substr(URI, 0, 8) == 'timthumb'){
            return false;
        }
        if(preg_match('/^formules\/(.*?)\/(.*?)/', URI))
        {
            Yii::$app->response->redirect('https://www.amica-travel.com/'.explode('/', URI)[1].'/'.explode('/', URI)[0].'/'.explode('/', URI)[2], 301);
            Yii::$app->end();
        }
        
        $redirect = \app\modules\redirection\api\Page::get($uri);
        if ($redirect) {
            Yii::$app->response->redirect($redirect->model->target_url, 301);
            Yii::$app->end();
        }
        

        // REDIRECT BY REGEX
        $redirects = \app\modules\redirection\models\Page::find()->select(['source_url', 'target_url'])->where('type = 1')->orderBy('page_id DESC')->asArray()->all();
        if ($redirects) {
            foreach ($redirects as $key => $value) {
                $pattern = $value['source_url'];
                 
                if (preg_match($pattern,URI)) {
                         $targetUrl = preg_replace($value['source_url'], $value['target_url'], URI);
                   
                    Yii::$app->response->redirect($targetUrl, 301);
                    Yii::$app->end();
                }
            }
        }
    }

    public function actionChangeUrlExcl(){
        $theEntries = \app\modules\exclusives\models\Item::find()->all();
        foreach($theEntries as $key => $value){
            $model = \app\modules\exclusives\models\Item::findOne(['item_id' => $value->item_id]);
            $model-> slug = explode('/', $value->slug)[1].'/'.explode('/', $value->slug)[0].'/'.explode('/', $value->slug)[2];
            var_dump($model->save());
        }
        
    }

    public function getDestimenu() {
        $theMenu = \app\modules\destinations\models\Category::find()
                    ->where('depth IN (0,1)')
                    ->andWhere("slug NOT LIKE '%envies%'")
                   ->with(['photos']) 
                  //  ->orderBy('category_id')
                    ->all();
        return $theMenu;
    }

    public function actionMaps(){
        return $this->renderPartial('//page2016/maps/big-maps');
    }
    public function getIdeesmenu() {
        $theIdees = \app\modules\programmes\models\Category::find()
                    ->where(['depth'=>0])
                   ->with(['photos']) 
                    ->orderBy('order_num desc')
                    ->all();
        return $theIdees;
    }
    public function getExclumenu() {
        $theExclu = \app\modules\exclusives\models\Category::find()
                    ->where(['depth'=>0])
                   ->with(['photos']) 
                    ->orderBy('order_num desc')
                    ->all();
        return $theExclu;
    }
    public function getApromenu() {
		//$arr = ['1', '36', '2','18', '20','11','5','4'];
                $arr = ['36', '42', '18', '2', '20', '4', '11','5',];
        $theMenu = NULL;
        foreach ($arr as $v) {
            
        
        $theMenu[] = \app\modules\whoarewe\models\Category::find()
                    ->where(['depth'=>0])
                    ->andWhere(['category_id' => $v])
                   ->with(['photos']) 
                  //  ->orderBy('category_id')
                    ->one();
        }
        return $theMenu;
    }
    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'width' => 100,
                'height' => 34,
                'foreColor' => 0xa8a8a8,
                'minLength' => 4,
                'maxLength' => 4,
                'offset' => 2,
                'transparent' => true,
                
            ],
        ];
    }

    public function getSeo($theEntry = null){
       // $seo = $theEntry->model->seo;
        if($theEntry){
            $this->pageT = isset($theEntry->h1) ? $theEntry->h1 : '';
            $this->metaT = isset($theEntry->title) ? $theEntry->title : '';
            $this->metaD = isset($theEntry->description) ? $theEntry->description : '';
            $this->seoContent = isset($theEntry->seo_content) ? $theEntry->seo_content : '';
            $entry_socials = isset($theEntry->social) ? $entry_socials = $theEntry->social : $entry_socials = array();
            if(!empty($entry_socials)) {
                $socials = json_decode($theEntry->social, true);
                if(!empty($socials['title'])) {
                    $this->metaFbT = $socials['title'];
                } else {
                    $this->metaFbT = $this->metaT;
                }
                if(!empty($socials['description'])) {
                    $this->metaFbD = $socials['description'];
                }else {
                    $this->metaFbD = $this->metaD;
                }
                if(!empty($socials['fb_img'])) {
                    $this->metaFbImg = $socials['fb_img'];
                }
            } else {
                $this->metaFbT = $this->metaT;
                $this->metaFbD = $this->metaD;
            }
        }
    }

    protected function getDataFromMetaRobots() {
        $key= 'data-cache-meta-robots';
        $cache = Yii::$app->cache;
//Yii::$app->cache->delete($key);
        // try retrieving $data from cache
        $data = $cache->get($key);
        
        if ($data === false) {
            // $data is not found in cache, calculate it from scratch
            $data = \app\modules\metarobot\models\Page::find()->where(['status' => '1'])->orderBy(['sort_order' => SORT_ASC])->asArray()->all();

            // store $data in cache so that it can be retrieved next time
            $cache->set($key, $data);

        }
        // $data is available here
//        var_dump($data);exit;
        return $data;
    }

    public function getRootAboutUs(){
        $root = \yii\easyii\modules\page\api\Page::get(15);
        return $root;
    }

    public function beforeAction($action) {
        // if(!Yii::$app->session->get('login')  && Yii::$app->controller->action->id !='login'){
        //     $url = Yii::$app->request->url;
        //     return $this->redirect('/login?url='.$url);
        // }
        $this->enableCsrfValidation = false;

        $rootId = 0;
        if(strpos($this->action->id, 'destination') !== false){ 
            $this->destination = true;
            $rootId = 12;
        }
        if(strpos($this->action->id, 'exclusivites') !== false){
            $this->exclusives = true;
            $rootId = 14;
        } 
        if(strpos($this->action->id, 'voyage') !== false){
            $this->programes = true;
            $rootId = 13;
        }
        if(strpos($this->action->id, 'faq') !== false){
            //$this->faq = true;
            $rootId = 10;
        }
        if(strpos($this->action->id, 'about-us') !== false){
            $this->aboutUs = true;
            $rootId = 15;
        }
        if($rootId)
            $this->root = \yii\easyii\modules\page\api\Page::get($rootId);
        if(Yii::$app->session->get('projet'))
            $projet = Yii::$app->session->get('projet');
          else $projet = [
            'programes'=> ['select'=>[], 'view'=>[]],
            'exclusives' => ['select'=>[], 'view'=> []]
            ];
          Yii::$app->session->set('projet',$projet);

        // Run metarobots
        $regexMetaRobots = $this->getDataFromMetaRobots();        
        if (!empty($regexMetaRobots)) {
            $uri = Yii::$app->request->getAbsoluteUrl();      
            foreach ($regexMetaRobots as $key => $value) {
                $tmp = $value['url'];
                $index = $value['index'];
                $follow = $value['follow'];
                $pattern = '/' . $tmp . '/';
                if (preg_match($pattern, $uri)) {
                    $this->metaIndex = ($index);
                    $this->metaFollow = ($follow);
                    break;
                }
            }
        }

        return parent::beforeAction($action);
    }

    public function actionLogin(){

        if(Yii::$app->request->post()){
            if(Yii::$app->request->post('password')  == 'Amica27ntT'){
                Yii::$app->session->set('login', true);
                $url = isset(Yii::$app->request->getQueryParams()['url']) ? Yii::$app->request->getQueryParams()['url'] : '/';
                return $this->redirect($url);
            }
        }
        return $this->renderPartial('//page2016/login');
    }
    // TODO page cache

    public function actionError() {
        $this->metaT = 'Page non trouvée | Amica Travel';
        return $this->render('//page2016/error');
    }

public function actionIndex(){
    $theEntry = \yii\easyii\modules\page\api\Page::get(31);
    if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $iconBanner = [];
        foreach ($theEntry->photos as $key => $value) {
            if($value->type == 'icon-banner')
                $iconBanner[] = $value;
        }
        $this->iconBanner = $iconBanner;
        $this->getSeo($theEntry->model->seo);
    
    $programes = \app\modules\programmes\models\Category::find()->where('status = 1')->roots()->orderBy('order_num DESC')->all();

        

        return $this->render(IS_MOBILE ? '//page2016/mobile/home' : '//page2016/home', [
            'programes' => $programes,
        ]);
}

public function actionPageList(){
    
    $theEntry = \app\modules\programmes\api\Catalog::cat(URI);
    $this->entry = $theEntry;
    if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');

    $this->getSeo($theEntry->model->seo);
     
    $listItem = \app\modules\programmes\api\Catalog::items([
                    //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                      'where'=>['category_id' => $theEntry->model->category_id],
                     // 'where' => ['like','title','%'.$search.'%', false],
                      //'filters' => $fil_countries,    
                      'pagination' => ['pageSize' => 0]

                    ]);
    
    
    return $this->render(IS_MOBILE ? '//page2016/mobile/page-list' : '//page2016/page-list',[
        'theEntry' => $theEntry,
        'listItem' => $listItem,
    ]);
}

public function actionPageDetail(){
    
    $theEntry = \app\modules\programmes\api\Catalog::get(URI);
        
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        
        $parent = \app\modules\programmes\api\Catalog::cat(SEG1.'/'.SEG2);
        
        $listItem = \app\modules\programmes\api\Catalog::items([
                    //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                     // 'where'=>['category_id' => $theEntry->model->category_id],
                       'where' => ['and', ['in','category_id', $parent->model->category_id], ['!=', 'slug', URI]],
                    //  'where' => ['like','title','%'.$search.'%', false],
                      //'filters' => $fil_countries,    
                      'pagination' => ['pageSize' => 0]

                    ]);
                  
    
    return $this->render(IS_MOBILE ? '//page2016/mobile/page-detail' : '//page2016/page-detail',[
        'theEntry' => $theEntry,
        'listItem' => $listItem
    ]);
}
public function actionGioiThieu(){
    
    return $this->render(IS_MOBILE ? '//page2016/mobile/gioi-thieu' : '//page2016/gioi-thieu',[
        
    ]);
}

    protected function getDataPost($id)
    {
        return $this->sendRequestToBlogAmica('https://blog.amica-travel.com/wp-json/wp/v2/posts/' . $id);
    }
    protected function getFeatureImage($id)
    {
        $data = $this->sendRequestToBlogAmica('https://blog.amica-travel.com/wp-json/wp/v2/media/' . $id);
        if(empty($data['media_details']['sizes']['barouk_list-thumb'])){
            if(!empty($data['media_details']['sizes']['thumbnail'])){
                $data['media_details']['sizes']['barouk_list-thumb'] = $data['media_details']['sizes']['thumbnail'];
            } else {
                $data['media_details']['sizes']['barouk_list-thumb'] = ['source_url' => ''];
            }
            
        }
        return $data;
    }


    protected function getCategoryName($id)
    {
        return $this->sendRequestToBlogAmica('https://blog.amica-travel.com/wp-json/wp/v2/categories/' . $id);
    }

    protected function sendRequestToBlogAmica($url)
    {
        $client = new \yii\httpclient\Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->send();
        return $response->getData();
    }

  public function actionGetNumberExcl(){
        if(Yii::$app->request->isAjax){
        $type = Yii::$app->request->get('type');
        if(!$type || $type == 'all'){
            $filterType = [];
        } else $filterType = ['category_id' => explode('-',$type)];
        
        $country = Yii::$app->request->get('country');
        if(!$country || $country == 'all'){
            $filters = [];
        } else {
            if(strpos($country, '-') === false){
                $filters = ['countries' => $country];
            }
            else{
                $filters = ['countries' => ['IN',explode('-',$country)]];
            }
        }
        $region = Yii::$app->request->get('region');
        if($region && $region != 'all'){
            if(strpos($region, '-') === false){
                $filters = $filters + ['region' => $region];
            }
            else{
                $filters = $filters + ['region' => ['IN',explode('-',$region)]];
            }
        }
        $exclusives = \app\modules\exclusives\api\Catalog::items([
            'where' => ['and',
                $filterType
                ],
            'filters' => $filters,
            'pagination' => ['pageSize' => 0]
            ]);
        return count($exclusives);
      }
    }

    public function actionGetNumberProg($countryP = ''){
          $type = Yii::$app->request->get('type');
        $typeNoChild = $typeChild = [];
        if(!$type || $type == 'all'){
            $filterType = [];
        } else {
            foreach (explode('-',$type) as $key => $value) {
                    
                         $typeNoChild[] = intval($value);
            }
            $filterType = $typeNoChild;
        
        }
        $filterType = ['category_id' => $filterType];
        $country = Yii::$app->request->get('country');
        if($countryP) $country = $countryP;
        if(!$country || $country == 'all'){
            $filters = [];
        } else {
            if(strpos($country, '-') === false){
                $filters = ['countries' => $country];
            }
            else{
                $filters = ['countries' => ['IN',explode('-',$country)]];
            }
        }
        $region = Yii::$app->request->get('region');
        if($region && $region != 'all'){
            if(strpos($region, '-') === false){
                $filters = $filters + ['region' => $region];
            }
            else{
                $filters = $filters + ['region' => ['IN',explode('-',$region)]];
            }
        }
        $length = Yii::$app->request->get('length');
        if($length == 'all'){
            $length = '';
        }
        if(strpos($length, '-') !== false){
              $arrLen = explode('-',$length);
              asort($arrLen);
              if($arrLen[0]==1) $arrLen[0] = 0;
                if(count($arrLen) == 2 || count($arrLen) == 6 ){
                    $filterLen = ['between', 'days', $arrLen[0], end($arrLen)];
                }
                if(count($arrLen) == 4 ){
                    $filterLen = ['or',
                    ['between', 'days', $arrLen[0], $arrLen[1]],
                    ['between', 'days', $arrLen[2], $arrLen[3]] 
                    ];
                }
                if(count($arrLen) == 3 || count($arrLen) == 5 || count($arrLen) == 7){
                    $filterLen = ['or',
                    ['between', 'days', $arrLen[0], $arrLen[count($arrLen) - 2]],
                    ['>=','days', end($arrLen)]  
                    ];
                }
        } else {
            $filterLen = ['>=','days', $length];
        
        }
        $voyage = \app\modules\programmes\api\Catalog::items([
            'where' => ['and',
                $filterType,
                $length ? $filterLen : []
                ],
            'filters' => $filters,
            'pagination' => ['pageSize' => 0]
            ]);
        return count($voyage);
    }

    public function actionGetNumberTesti(){
         //data search for testi
        //for tour Type
        $type = Yii::$app->request->get('type');
        $filterType = [];
        if($type && $type != 'all')
            $filterType = ['tTourTypes' => ['IN',explode(',',$type)]];
        //for tour themes
        $theme = Yii::$app->request->get('theme');
        $filterTheme = [];
        if($theme && $theme != 'all')
            $filterTheme = ['tTourThemes' => ['IN',explode(',',$theme)]];
        //for country
        $country = Yii::$app->request->get('country');
        $filterCountry = [];
        if($country && $country != 'all'){
            if(strpos($country, '-') === false){
                $filterCountry = ['countries' => ['IN', [$country]]];
            }
            else{
                foreach (explode('-',$country) as $key => $value) {
                    $filterCountry[] = $value;
                }
                $filterCountry = ['countries' => ['IN', $filterCountry]];
            }
        }
        $filter = [];
        $filter = $filter + $filterCountry + $filterTheme + $filterType;
        
        //get data category & items testi
        //process data testi
        $theTesti = \app\modules\whoarewe\api\Catalog::cat(13);
       
        $totalCountTesti = count($theTesti->items(['pagination' => ['pageSize'=>0],
            'filters' => $filter]));
        return $totalCountTesti;
    }
      
	public function actionMentionsLegalesAboutUs() {
          $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
          $this->entry = $theEntry;
        
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvÃ©!');
         $this->getSeo($theEntry->model->seo);
        return $this->render(IS_MOBILE ? '//page2016/mobile/view-only-text' : '//page2016/mentions-legales', [
            'theEntry' => $theEntry,
            'root' => $this->getRootAboutUs()
        ]);
    }
    public function actionConditionsAboutUs() {
       //  $theEntry = Catalog::cat(22);
          $theEntry = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id'=>35])
                ->with(['photos'])
                ->one();
        $this->entry =\app\modules\whoarewe\api\Catalog::cat(35);
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvÃ©!');
        $this->getSeo($theEntry->seo);
        if(IS_MOBILE) $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        return $this->render(IS_MOBILE ? '//page2016/mobile/view-only-text' : '//page2016/conditions', [
            'theEntry' => $theEntry,
            'root' => $this->getRootAboutUs()
        ]);
    }
    public function actionProposDeNousAboutUs() {

        $theEntry = Page::get(15);
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
		$arr = ['36', '37','42', '18', '2', '20', '4', '11','5',];
        $theMenu = NULL;
        foreach ($arr as $v) {
            
        
        $theMenu[] = \app\modules\whoarewe\models\Category::find()
                    ->where(['depth'=>0])
                    ->andWhere(['category_id' => $v])
                    ->with(['photos']) 
                    ->one();
        }
        
        
        $mot_du_fondateur = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id'=>1])
                ->with(['photos'])
                ->one();
		
        $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);
        
		$theRaisons_list = $theRaisons->items(['where'=>['category_id' => $theRaisons->model->category_id],'orderBy'=>'item_id']);
        $video = \app\modules\modulepage\api\Catalog::get('home-page-video');
        $entryChez = \app\modules\whoarewe\api\Catalog::cat('chez-habitant-indochine');
        return $this->render(IS_MOBILE ? '//page2016/mobile/a-propos-de-nous' : '//page2016/a-propos-de-nous', [
            'theEntry' => $theEntry,
            'theMenu' => $theMenu,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            'video' => $video,
            'entryChez' => $entryChez,
            'mot_du_fondateur' => $mot_du_fondateur,
        ]);
    }
    public function actionRecrutementAboutUs() {
          $theEntry = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id'=>22])
                ->with(['photos'])
                ->one();
        $this->entry =\app\modules\whoarewe\api\Catalog::cat(22);
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->seo);
        if(IS_MOBILE) $theEntry = \app\modules\whoarewe\api\Catalog::cat(22);
        return $this->render(IS_MOBILE ? '//page2016/mobile/view-banner-text' : '//page2016/recrutement',[
            'theEntry' => $theEntry,
            'root' => $this->getRootAboutUs()
        ]);
    }
     public function actionRecrutementSingleAboutUs() {
        $theEntry = \app\modules\whoarewe\api\Catalog::get(URI);
        $this->entry = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
      //  $theEntries = \app\modules\whoarewe\api\Catalog::cat(SEG1)->items(['where' => ['status' => 1]]);
        
        $theEntries = \app\modules\whoarewe\api\Catalog::cat(SEG1)->items(['where' => ['!=', 'slug', URI]]);  
      //  if(IS_MOBILE)  $theEntries = \app\modules\whoarewe\api\Catalog::cat(SEG1)->items(['where' => ['!=', 'slug', URI]]);  
     //   else   $theEntries = \app\modules\whoarewe\api\Catalog::cat(SEG1)->items(['where' => ['status' => 1]]);
       return $this->render(IS_MOBILE ? '//page2016/mobile/recrutement-single' : '//page2016/recrutement-single',[
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'root' => $this->getRootAboutUs()
        ]);
    }
     public function actionFaq() {
         $theEntry = Page::get(10);
         
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        
        $this->getSeo($theEntry->model->seo);
        $theEntries = \app\modules\faq\models\Category::find()
            ->with(['photos'])
            ->orderBy('category_id')
            ->all();
        //var_dump($theEntries);exit;
        $list_item = \app\modules\faq\api\Catalog::items([
            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
            'where' => ['>','on_top',0],
            //'filters' => $fil_countries,    
            'pagination' => ['pageSize' => 0]

        ]);
         //var_dump($list_item);exit;
        
         return $this->render(IS_MOBILE ? '//page2016/mobile/faq' : '//page2016/faq', [
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'list_item' => $list_item,
            
        ]);
    }
     public function actionFaqSingle() {
         
        $theRoot = ''; 
        $theParent = Page::get(10);
        
        $theEntry = \app\modules\faq\api\Catalog::cat(URI);
        $thechildren = $theEntry;
        //var_dump($thechildren);exit;
        if(!$theEntry){
           $theRoot = Page::get(10);  
           
            $thechildren = \app\modules\faq\api\Catalog::get(URI);
            $theEntry = \app\modules\faq\api\Catalog::cat($thechildren->category_id);
            //var_dump($thechildren->parents());exit;
        }
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->entry = $thechildren;
        $this->getSeo($thechildren->model->seo);
        
        if(Yii::$app->request->post('slug') != NULL){
            $slug = Yii::$app->request->post('slug');
        }else{
            $slug = NULL;
        }
        
        $theItems = $theEntry->items([
            'where' => ['slug'=>$slug],
            'orderBy' => 'item_id'
            ]);
        //$theRaisons_list = $theRaisons->items(['where' => ['category_id' => $theRaisons->model->category_id], 'orderBy' => 'item_id']);
        //var_dump($theItem);exit;
        $theFive = \app\modules\faq\models\Category::find()
            ->where('category_id != "'.$theEntry->model->category_id.'"')    
            ->with(['photos'])
            ->orderBy('category_id')
            ->all();
        
    //var_dump($theFive);exit;
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/faq-single' : '//page2016/faq-single',[
            'theRoot' => $theRoot,
            'theParent' => $theParent,
            'theEntry' => $theEntry,
            'thechildren' => $thechildren,
            'theFive' => $theFive,
            'theItems' => $theItems,
            
        ]);
    }
    public function actionFaqSearch(){
        
       
            
            $search = Yii::$app->request->post('search');
            //var_dump($search);exit;
            if($search != NULL){
//            $data = \app\modules\faq\models\Item::find()
//           // ->where(['type'=>'journey'])        
//            ->andFilterWhere(['like', 'question', '%'.$search.'%', false])
//            ->orderBy('on_top ASC')        
//            //->limit(10)
//            //->asArray()
//            ->all();
             $data = \app\modules\faq\api\Catalog::items([
                'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                'where' => ['like','question','%'.$search.'%', false],
                //'filters' => $fil_countries,    
                'pagination' => ['pageSize' => 0]

            ]);
            }else{
                $data = NULL;
            }
    //var_dump($data);exit;
            $html = '';
            if(!$data) {$html = "<li>Pas de résultat. Tapez un autre mot-clé ou une autre question</li>";}
            else {
                foreach ($data as $key => $dt) {
                $html .= '<li><a href="'.DIR.$dt->slug.'">'.$dt->title.'</a></li>';
                }
            }
            echo $html;
        }
    
     public function actionRaisonsAboutUs() {
         $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        $this->entry = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
         $theEntries = Catalog::items(['where'=>['category_id'=>$theEntry->model->category_id],'orderBy'=>'item_id']);
          $theItem = Catalog::get(614);
         //var_dump($theItem);exit;
        $listModules = NULL;
		 
         $listModules_Exclu = NULL;
		if(isset($theItem->data->moduleexcl)){ 
        foreach ($theItem->data->moduleexcl as $v) {
		
            //foreach ($v as $value) {
				if($v != ''){
                $listModules[] = \app\modules\modulepage\models\Item::find()
                        ->where(['slug'=>$v])
                        ->with(['photos'])
                        ->one();
				}
           // }
        }
		}
        
       
        
      
       if($listModules != NULL){
        foreach ($listModules as $v) {
            
            foreach ($v->data->exclusives as $value) {
                $listModules_Exclu[] = \app\modules\exclusives\models\Item::find()
                        ->where(['slug'=>$value])
                        ->with(['photos'])
                        ->one();
            }
        }
		}
        
         
         
         return $this->render(IS_MOBILE ? '//page2016/mobile/10-raisons' : '//page2016/10-raisons', [
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'theItem' => $theItem,
            'listModules' => $listModules,
            'listModules_Exclu' => $listModules_Exclu,
            'root' => $this->getRootAboutUs()
        ]);
    }
    public function actionClubAmiAboutUs() {
         $theEntry = Catalog::cat(4);
         $this->entry = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        return $this->render(IS_MOBILE ? '//page2016/mobile/club-ami' : '//page2016/club-ami', [
            'theEntry' => $theEntry,
            'root' => $this->getRootAboutUs()
        ]);
    }
    public function actionActualitesAboutUs() {
       // $theEntry = Catalog::cat(17);
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
//        if(Yii::$app->request->isAjax){
//            //$theEntries = $theEntry->items(['pagination' => ['pageSize' =>  8]]);
//            $theEntries = \app\modules\whoarewe\api\Catalog::items([
//            'where' => [
//                'category_id' => 17
//            ],
//            'pagination' => ['pageSize' => 12],
//            //'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
//            ]);    
//            return $this->renderPartial('//page2016/mobile/actualites', ['theEntries' => $theEntries
//            ]);
//        }
        $this->entry = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->model->seo);
        if(Yii::$app->request->get('see-more')){
            $pagesize = Yii::$app->request->get('see-more');
        }else{
            $pagesize = 12;
        }         
                 
        $countQuery = clone $theEntry;
        $totalCount = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 17
            ],
            'pagination' => ['pageSize' => 0],
           // 'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
            ]);    
        
        $pages = new Pagination([
            'totalCount' => count($totalCount),
            'defaultPageSize' => 12,
            'forcePageParam' => false
        ]);
        $this->pagination = $pages->pageCount;
        if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
        $theEntries = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 17
            ],
            'pagination' => ['pageSize' => Yii::$app->request->get('view') == 'all' ? 0 : 12],
           // 'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
            ]);
        if(IS_MOBILE){
            $theEntries = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 17
            ],
            'pagination' => ['pageSize' => $pagesize],
           // 'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
            ]);
        } 

         $top5L = \app\modules\modulepage\api\Catalog::get('top-5-des-actualites');
        // var_dump($top5L->data->actualites);exit;
        $top5  = \app\modules\whoarewe\api\Catalog::items(['where' => ['IN', 'item_id', $top5L->data->actualites],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$top5L->data->actualites) . ')')]
            ]);
        return $this->render(IS_MOBILE ? '//page2016/mobile/actualites' : '//page2016/actualites', [
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'pages' => $pages,
            'root' => $this->getRootAboutUs(),
            'totalCount' => $totalCount,
            'pagesize' => $pagesize,
            'top5' => $top5,
        ]);
    }
    public function actionActualitesSingleAboutUs() {
         $theEntry = Catalog::get(SEG2);
         $this->entry = $theEntry;
         if (!$theEntry || $theEntry->cat->category_id !=17) throw new HttpException(404, 'Page ne pas trouvé!');

		$this->getSeo($theEntry->model->seo);
        
        $articles = ChItems::find()
                 ->where(['status' => 1,'category_id'=>$theEntry->cat->category_id])
                 ->orderBy('rand()')
                 ->limit(3)
                 ->asArray()
                 ->all();
         

        $this->getSeo($theEntry->model->seo);
        return $this->render(IS_MOBILE ? '//page2016/mobile/actualites-single' : '//page2016/actualites-single', [
            'theEntry' => $theEntry,
            'root' => $this->getRootAboutUs(),
            'articles' => $articles
        ]);
    }
   public function actionExclusivites()
    {
        $theEntry = Page::get(14);


        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);

        $this->countExcl = count(\app\modules\exclusives\api\Catalog::items([
            //'filters' => ['countries' => SEG1],
            'pagination' => ['pageSize' => 0]
        ]));
        $theSix = \app\modules\exclusives\models\Category::find()
            ->with(['photos'])
            ->orderBy('order_num desc')
            ->all();
          if(IS_MOBILE){
                $this->totalCount = $this->countExcl;
//                $this->arr_option_filter_voyage_mobile = [
//                        'title_filter' => $theEntry->model->seo->h1 ,
//                        'namefilter' => 'filter_voyage',
//                        'uri' =>$theEntry->slug,
//                        'totalCount' => count(\app\modules\programmes\api\Catalog::items(['pagination' => ['pageSize' => 0]])),
//                        //'totalCount_exclusives' => $this->countExcl,
//                        'country' => 'all',
//                        'type' => 'all',
//                        'length' => 'all',
//                    ];
                $this->arr_option_filter_exclusives_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_exclusivites',
                        'uri' =>$theEntry->slug,
                       // 'totalCount' => count(\app\modules\programmes\api\Catalog::items(['pagination' => ['pageSize' => 0]])),
                        'totalCount' => $this->getAjaxFilterExclusive(['country' => '', 'type' => ''])['totalCount'],
                        'country' => 'all',
                        'type' => 'all',
                        'length' => 'all',
                        'numberFilter' => $this->getAjaxFilterExclusive(['country' => '', 'type' => '']),
                    ];
            }    


        return $this->render(IS_MOBILE ? '//page2016/mobile/exclusivites' : '//page2016/exclusivites', [
            'theEntry' => $theEntry,
            'theSix' => $theSix,
        ]);
    }
	public function actionExclusivitesTypeCountry() {
       
        $theEntry = Page::get(14);

         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $theParent = Page::get(SEG1); 
		 $this->getSeo($theEntry->model->seo);
      
         $exclusives_country = \app\modules\exclusives\api\Catalog::items([
            'where' => ['status'=>1],
            'filters' => [SEG2],
           'pagination' => ['pageSize' => Yii::$app->request->get('view') == 'all' ? 0 : 12]
            ]);
          
         if (Yii::$app->request->isAjax) {
             if(Yii::$app->request->post()['type'] == 'excl'){
                return $this->renderPartial('//page2016/ajax/country-excl', ['theEntries' => $exclusives_country]);

            }
        } else{
             Yii::$app->session->set('countExcl', count(\app\modules\exclusives\api\Catalog::items([
             'where' => ['status'=>1],
            'filters' => [SEG2],
            'pagination' => ['pageSize' => 0 ]
            ])));
        }
        $pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countExcl'), 'pageSize'=>12]);
        $this->pagination = $pagi->pageCount;
       
         $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);
         $theRaisons_list = $theRaisons->items(['where'=>['category_id' => $theRaisons->model->category_id],'orderBy'=>'item_id']);
        
        return $this->render('//page2016/exclusivites-type-country',[
            'theEntry' => $theEntry,
            'theParent' => $theParent,
            'theEntries' => $exclusives_country,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            
        ]);
    }
     public function actionExclusivitesType()
    {
        $theEntry = \app\modules\exclusives\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        $icons = $tours = [];
        if(!empty($theEntry->data->attrhost)){
            $icons = \app\modules\libraries\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->attrhost],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$theEntry->data->attrhost) . ')')]
            ]);
        }
        if(!empty($theEntry->data->suggesttours)){
            $tours = \app\modules\programmes\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->suggesttours],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$theEntry->data->suggesttours) . ')')]
            ]);
        }
        $fieldsCat = ArrayHelper::map($theEntry->fields_category, function($e){ return $e->name; }, function($e){return $e;});
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="inspi_formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="formules"'
        ]; 
        $sliders = \app\modules\exclusives\models\Category::find()->roots()->andWhere(['!=','slug', URI])->all();  
        
        $getAjaxFilter = $this->getAjaxFilterExclusive(['country'=>'','type'=>$theEntry->model->category_id]);
        
            $theEntries = $getAjaxFilter['voyage'];       
            $totalCount = $getAjaxFilter['totalCount'];
            $numberFilter = $getAjaxFilter;
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/exclusivites-type' : '//page2016/exclusivites-type', [
            'theEntry' => $theEntry,
            'icons' => $icons,
            'tours' => $tours,
            'fieldsCat' => $fieldsCat, 
            'arrAnaly' => $arrAnaly,
            'sliders' => $sliders,
            'theEntries' => $theEntries
            
        ]);
    }
     public function actionExclusivitesSingle() {
         
         if(\app\modules\destinations\api\Catalog::get(URI)){
             return Yii::$app->runAction('amica-fr/nos-destinations-country-exclusive-type');
         }
         
         $theRoot = Page::get(SEG1); 
        
         
         //$theEntry = \app\modules\exclusives\api\Catalog::get(SEG3);
         $theEntry = \app\modules\exclusives\api\Catalog::get(URI);
          // $theEntry = \app\modules\exclusives\models\Item::find()
          //       ->where(['slug'=>URI,'status'=>1])
          //       ->with(['photos'])
          //       ->one();
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');        
         $this->entry = $theEntry;
         $theParent = \app\modules\exclusives\api\Catalog::cat($theEntry->category_id);
         
         $this->getSeo($theEntry->model->seo);
         
         $theProgram = [];
         
         $pro = explode(',', $theEntry->model->programes);
         
         foreach ($pro as $p) {
             $item = \app\modules\programmes\api\Catalog::get($p);
             if($item)
                $theProgram[] = \app\modules\programmes\api\Catalog::get($p);
         }
        
        
         $allCountries = Country::find()->select(['code', 'name_fr'])->orderBy('name_fr')->asArray()->all();

        $model = new ContactForm;
        if (IS_MOBILE) {
            $model = new ContactFormMobile;
            $model->scenario = 'contactce_mobile';
        } else {
            $model->scenario = 'contactce';
        }
        

        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';

        return $this->render(IS_MOBILE ? '//page2016/mobile/exclusivites-single' : '//page2016/exclusivites-single',[
                    'model' => $model,
                    'allCountries' => $allCountries,
                    'theRoot' => $theRoot,
                    'theParent' => $theParent,
                    'theEntry' => $theEntry,
                    'theProgram' => $theProgram,
        ]);
    }
     public function actionEnvieDuMomentAboutUs() {
       // $theEntry = Catalog::cat(14);
        
        $theEntry = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id'=>14])
                ->with(['photos'])
                ->one();
         $this->entry =\app\modules\whoarewe\api\Catalog::cat(14);       
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->seo);
		 
         $theParent_Exclu = Page::get(14);
         $theSix_Exclu = \app\modules\exclusives\models\Category::find()
               // ->where(['category_id'=>14])
                ->with(['photos'])
                
                ->all();
         
        return $this->render('//page2016/envie-du-moment',[
            'theEntry'=> $theEntry,
            //'item' => $item,
            'theParent_Exclu' => $theParent_Exclu,
            'theSix_Exclu' => $theSix_Exclu,
            'root' => $this->getRootAboutUs()   
            
        ]);
    }
      public function actionEspacePresseAboutUs() {
       // $theEntry = Catalog::cat(5);
         $theEntry = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id'=>5])
                ->with(['photos'])
                ->one();
         $this->entry =\app\modules\whoarewe\api\Catalog::cat(5);       

        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->seo);
       
         $theEntries = \app\modules\whoarewe\api\Catalog::items([
             'where'=>['category_id' => $theEntry->category_id],
             'orderBy'=>['order_num' => SORT_DESC,'time' => SORT_DESC]
           //  'orderBy'=> ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
             ]);
          //   var_dump($theEntries);exit;
         return $this->render(IS_MOBILE ? '//page2016/mobile/espace-presse' : '//page2016/espace-presse', [
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'root' => $this->getRootAboutUs()
        ]);
    }   
     public function actionDecouvrezLePaysAboutUs() {
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        $theReport = \app\modules\whoarewe\api\Catalog::cat(23);
		$theEntries_m = Null;
        if(IS_MOBILE){
            $theEntries_m = \app\modules\whoarewe\api\Catalog::cat(23)->items();
        }
        $countQuery = clone $theReport;
         $theEntries = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 23
            ],
            'pagination' => ['pageSize' => 0],
            'orderBy' => 'time DESC'
            ]);         
        $pages = new Pagination([
            'totalCount' => count($theEntries),
            'defaultPageSize' => 3,
            // 'pageParam' => 'reportage',
            'params' => ['page' => Yii::$app->request->get('page')],
            'route' => 'explorateurs'
        ]);
          $this->pagination = $pages->pageCount;
         $theParent_Exclu = Page::get('formules');
         $theSix_Exclu = \app\modules\exclusives\models\Category::find()
                ->with(['photos'])
                
                ->all();
//        if (Yii::$app->request->isAjax) {
//            if(Yii::$app->request->post()['type'] == 'deco'){
//                $locationAjax = \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter');
//                return $this->renderPartial('//page2016/ajax/deco-ajax', [
//            'theEntries' => $theEntries,
//            'pages' => $pages,
//            ]);
//
//            }
//             
//        }
        return $this->render(IS_MOBILE ? '//page2016/mobile/decouvrez-le-pays' : '//page2016/decouvrez-le-pays',[
            'theEntry' => $theEntry,
            'theReport' => $theReport,
            'theEntries' => $theEntries,
            'pages' => $pages,
            'theParent_Exclu' => $theParent_Exclu,
            'theSix_Exclu' => $theSix_Exclu,
            'root' => $this->getRootAboutUs(),
			'theEntries_m' => $theEntries_m,
        ]);
    }
    
    public function actionReportagesAboutUs(){
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
         $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        
        
        $countQuery = clone $theEntry;
        $totalCount = count(\app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 23
            ],
            'pagination' => ['pageSize' => 0],
            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
            ]));
       
        if(Yii::$app->request->get('see-more') != NULL){
            $pagesize = Yii::$app->request->get('see-more');
           
           
        }else{
            $pagesize = 6;
        }
        
        
         $theEntries = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 23
            ],
            'pagination' => ['pageSize' => $pagesize],
            'orderBy' => 'time DESC'
            ]);         

        return $this->render(IS_MOBILE ? '//page2016/mobile/reportages' : '//page2016/reportages',[
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'root' => $this->getRootAboutUs(),
            'pagesize' => $pagesize,
            'totalCount' => $totalCount,
        ]);
    }

    public function actionDecouvrezLePaysSingleAboutUs() {
         $theEntry = Catalog::get(URI);
         $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        $theRand_thrre = Catalog::items([
            //'where'=>['category_id'=>$theEntry->cat->category_id],
            'where' => ['and', 'category_id = '.$theEntry->cat->category_id.'', ['not', ['item_id' => $theEntry->model->item_id]]],
           // 'orderBy' => 'time ASC',
            'pagination'=>['pageSize'=>5]
            ]);
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/decouvrez-le-pays-single' : '//page2016/decouvrez-le-pays-single',[
            'root' => $this->getRootAboutUs(),    
            'theEntry' => $theEntry,
            'theRand_thrre' => $theRand_thrre,
        ]);
    }
    
     public function actionFondationAboutUs() {
        $theEntry = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id'=>20,'status'=>1])
                ->with(['photos'])
                ->one();
		if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');		
         $this->entry =\app\modules\whoarewe\api\Catalog::cat(20);
        
		$this->getSeo($theEntry->seo);
        $theHost = Catalog::cat(19);
        
        $theEntries = $theHost->items();
        $theProjets = Catalog::cat(21);
        
        
        $theProjets_list = \app\modules\whoarewe\models\Category::find()
                 ->where(['status' => 1,'tree'=>$theProjets->tree, 'depth'=>2])  
                //->asArray()
                ->with(['photos'])
                ->orderBy('category_id')
                 ->all(); 
        $theLeft = Catalog::cat(26);
        
        $theLeft_list = \app\modules\whoarewe\models\Item::find()
                 ->where(['status' => 1,'category_id'=>$theLeft->model->category_id])  
                 ->with(['photos'])
                 ->orderBy('time DESC')
                // ->asArray()
                 ->all();  
        $theRight = Catalog::cat(27);
        $theRight_list = \app\modules\whoarewe\models\Item::find()
                 ->where(['status' => 1,'category_id'=>$theRight->model->category_id])  
                 ->with(['photos'])
                 ->orderBy('time DESC')
                // ->asArray()
                 ->all(); 
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/fondation' : '//page2016/fondation',[
            'theEntry' => $theEntry,
            'theProjets' => $theProjets,
            'theProjets_list' => $theProjets_list,
            'theLeft' => $theLeft,
            'theLeft_list' => $theLeft_list,
            'theRight' => $theRight,
            'theRight_list' => $theRight_list,
            'theHost' => $theHost,
            'theEntries' => $theEntries,
            'root' =>  $this->getRootAboutUs()
        ]);
    }


    public function actionProjetsAboutUs(){
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
    //$theEntries = $theEntry->children();
        if(Yii::$app->request->get('see-more') !== NULL){
            $pagesize = Yii::$app->request->get('see-more');
           // $visiter = $locations->items(['pagination' => ['pageSize' => $pagesize]]);
        }else{
            $pagesize = 12;
        }
        $theEntries = \app\modules\whoarewe\models\Category::find()
                 ->where(['status' => 1,'tree'=>$theEntry->tree, 'depth'=>2])  
                //->asArray()
                ->with(['photos'])
                ->orderBy('category_id,order_num')
                ->limit($pagesize)
                 ->all(); 
         $totalCount = count(\app\modules\whoarewe\models\Category::find()
                 ->where(['status' => 1,'tree'=>$theEntry->tree, 'depth'=>2])  
                //->asArray()
                ->with(['photos'])
                ->orderBy('category_id,order_num')
                
                 ->all());
         $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
         
        return $this->render(IS_MOBILE ? '//page2016/mobile/projets' : '//page2016/projets', [
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'pagesize' => $pagesize,
            'totalCount' => $totalCount,
            'root' => $this->getRootAboutUs()
            ]);
    }

    public function actionAssociationsAboutUs(){
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
//        if($children = $theEntry->children()){
//            $theEntries = $children; 
//        } else
        $queryCount = clone $theEntry;
        $totalCount = $queryCount->items(['pagination'=>['pageSize' => 0]]);
        if(Yii::$app->request->get('see-more') !== NULL){
            $pagesize = Yii::$app->request->get('see-more');
           // $visiter = $locations->items(['pagination' => ['pageSize' => $pagesize]]);
        }else{
            $pagesize = 12;
            
        }
        
            $theEntries = $theEntry->items(['pagination'=>['pageSize' => $pagesize]]);
            
        $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }    
        return $this->render(IS_MOBILE ? '//page2016/mobile/associations' : '//page2016/associations', [
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'pagesize' => $pagesize,
            'totalCount' => $totalCount,
            'root' => $this->getRootAboutUs()
            ]);
    }
    
    public function actionFondationSingleAboutUs() {
        $root = Catalog::cat(20); 
        $theParent = Catalog::cat(SEG1);
        $theEntry = Catalog::get(URI);
		if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->entry = $theEntry;
        //echo '<pre>';
       // var_dump($theEntry);exit;
        $theParent_entries = Catalog::cat($theEntry->category_id);
       // echo '<pre>';
       // var_dump($theParent_entries->model);exit;
        $theEntries = \app\modules\whoarewe\models\Item::find()
                 
                 ->where(['status' => 1,'category_id'=>$theEntry->category_id])  
                 ->andWhere('slug != "'.URI.'"')
                 ->with(['photos'])
                 ->orderBy('time DESC')
                 
                 ->all();  
        
       
         
        
		$this->getSeo($theEntry->model->seo);
		
        return $this->render(IS_MOBILE ? '//page2016/mobile/associations-single' : '//page2016/fondation-single',[
            'theParent' => $theParent,
            'theEntry' => $theEntry,
            'theParent_entries' => $theParent_entries,
            'theEntries' => $theEntries,
            'root' => $this->getRootAboutUs(),
        ]);
    }
   public function actionFondationThongnongAboutUs() {
         $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
         $this->entry = $theEntry;
       
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        $theEntry_info = \app\modules\whoarewe\models\Item::find()
                ->where(['slug'=>$theEntry->slug])
                ->with(['photos'])
                ->one();
        $theEntries = \app\modules\whoarewe\models\Item::find()
                ->where(['category_id' => $theEntry->model->category_id])
                ->andWhere('slug !="'.$theEntry->slug.'"')
                ->orderBy('time ASC')
                ->with(['photos'])
                ->all();

        $theList_tour = null;
        foreach ($theEntry_info->data->location as $v) {
            //var_dump($v);exit;
//            $theList_tour = \app\modules\programmes\models\Item::find()
//                    ->where("locations LIKE '%".$v."%'")
//                    ->with(['photos'])
//                    ->orderBy('rand()')
//                    ->limit(3)
//                    ->all();
            $theList_tour = \app\modules\programmes\api\Catalog::items([
                        'where' => ['like', 'locations', $v],
                        'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                        'pagination' => ['pageSize' => 3],
                    ]);
            
        }
        $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);
           
        $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');
        
       
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/fondation-thongnong' : '//page2016/fondation-thongnong',[
            'theEntry' => $theEntry,
            'theEntry_info' => $theEntry_info,
            'theEntries' => $theEntries,
            'theList_tour' => $theList_tour,
            'location' => $location,
            'root' => $this->getRootAboutUs()
        ]);
    }
     public function actionFondationThongnongSingleAboutUs() {
          $theEntry = \app\modules\whoarewe\api\Catalog::get(URI);
          $this->entry = $theEntry;
          if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
          $this->getSeo($theEntry->model->seo);
          $theList_tour;

          if($theEntry->data->location != NULL){
            foreach ($theEntry->data->location as $v) {


                $theList_tour = \app\modules\programmes\models\Item::find()
                ->where("locations LIKE '%".$v."%'")
                ->with(['photos'])
                ->orderBy('rand()')
                ->limit(3)
                ->all();
            }
        }else{
            $theList_tour = NULL;
        }
        $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);


        $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');  

        return $this->render('//page2016/fondation-thongnong-single',[
            'theEntry' => $theEntry,
            'theList_tour' => $theList_tour,
            'location' => $location,
            'root' => $this->getRootAboutUs()

            ]);
     }
    public function actionPortraitSingleAboutUs() {
        $theEntry = \app\modules\whoarewe\api\Catalog::get(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        $theEntries = \app\modules\whoarewe\api\Catalog::cat(SEG1)->items([
            'where' => [
                '!=','item_id', $theEntry->model->item_id
            ],
            'pagination' => ['pageSize' => 5]
            ]);
        $theProgram = [];

        if(is_array($theEntry->data->tours)){
        foreach ($theEntry->data->tours as $p) {
            $item = \app\modules\programmes\api\Catalog::get($p);
            if($item)
                $theProgram[] = $item;
            }
        
        }
        return $this->render(IS_MOBILE ? '//page2016/mobile/portrait-single' : '//page2016/portrait-single',[
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'root' => $this->getRootAboutUs(),
            'theProgram' => $theProgram
        ]);
    }
     public function actionTemoignageAboutUs() {
         //data search for testi
        //for tour Type
        if(Yii::$app->request->isAjax){
            $page = Yii::$app->request->get('page');
            $testis = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 13
            ],
            'pagination' => ['pageSize' => 5, 'pageSizeLimit' => [$page, $page + 1]]
            ]);
            return $this->renderPartial(IS_MOBILE ? '//page2016/mobile/confiance' : '//page2016/temoignage',[
            'testis' => $testis,
            ]);
        }
        $type = Yii::$app->request->get('type');
        $filterType = [];
        if($type && $type != 'all')
            $filterType = ['tTourTypes' => $type];
        //for tour themes
        $theme = Yii::$app->request->get('theme');
        $filterTheme = [];
        if($theme && $theme != 'all')
            $filterTheme = ['tTourThemes' => $theme];
        //for country
        $country = Yii::$app->request->get('country');
        $filterCountry = [];
        if($country && $country != 'all'){
            if(strpos($country, '-') === false){
                $filterCountry = ['countries' => ['IN', [$country]]];
            }
            else{
                foreach (explode('-',$country) as $key => $value) {
                    $filterCountry[] = $value;
                }
                $filterCountry = ['countries' => ['IN', $filterCountry]];
            }
        }
      
        $filter = [];
        $filter = $filter + $filterCountry + $filterTheme + $filterType;
  
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        //get data category & items portrain
        $thePortrait  = \app\modules\whoarewe\api\Catalog::cat(12);
        $queryPort = clone $thePortrait;
        $queryFindLarge = clone $queryPort;
        $topPortrait = $queryFindLarge->items(['filters' => [
                'islarge' => 'on'
            ]]);
        $topPortrait = $topPortrait[0];
        $portraits = $thePortrait->items([
            'pagination'=>['pageSize' => 0],
            'where' => ['!=','item_id', $topPortrait->model->item_id],
            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
            ]);
        $totalCountPort = count($queryPort->items(['pagination' => ['pageSize'=>0],
            'where' => ['!=','item_id', $topPortrait->model->item_id]
            ]));
            
        $pagesPort = new Pagination([
            'totalCount' => $totalCountPort,
            'defaultPageSize' => 3
        ]);
        //get data category & items testi
        //process data testi
        $theTesti = \app\modules\whoarewe\api\Catalog::cat(13);
        $totalCountTesti = count($theTesti->items(['pagination' => ['pageSize'=>0],
            'filters' => $filter]));
        //$queryTesti = clone $theTesti;
        if(Yii::$app->request->get('see-more') != NULL){
            $pagesize = Yii::$app->request->get('see-more');
        }else{
            $pagesize = 5;
        }
        
        $testis = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 13
            ],
            'pagination' => ['pageSize' => $pagesize],
            'filters' => $filter
            ]);
       

//        $pageTesti = new Pagination([
//            'totalCount' => $totalCountTesti,
//            'defaultPageSize' => 5,
//        ]);
//        $this->pagination = $pageTesti->pageCount;
        return $this->render(IS_MOBILE ? '//page2016/mobile/confiance' : '//page2016/temoignage',[
            'theEntry' => $theEntry,
            'thePortrait' => $thePortrait,
            'portraits' => $portraits,
            'topPortrait' => $topPortrait,
            'pagesPort' => $pagesPort,
            'theTesti' => $theTesti,
            'testis' => $testis,
            'pagesize' => $pagesize,
            'totalCountTesti' => $totalCountTesti,
            'root' => $this->getRootAboutUs()
        ]);
    }

    public function actionTemoignageTypeAboutUs(){
        
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        
        $type = Yii::$app->request->get('type');
        $filterType = [];
        if($type && $type != 'all')
            $filterType = ['tTourTypes' => ['IN',explode(',',$type)]];
        //for tour themes
        $theme = Yii::$app->request->get('theme');
        $filterTheme = [];
        if($theme && $theme != 'all')
            $filterTheme = ['tTourThemes' => ['IN',explode(',',$theme)]];
        //for country
        $country = Yii::$app->request->get('country');
        $filterCountry = [];
        if($country && $country != 'all'){
            if(strpos($country, '-') === false){
                $filterCountry = ['countries' => ['IN', [$country]]];
            }
            else{
                foreach (explode('-',$country) as $key => $value) {
                    $filterCountry[] = $value;
                }
                $filterCountry = ['countries' => ['IN', $filterCountry]];
            }
        }
        
        $filter = [];
        $filter = $filter + $filterCountry + $filterTheme + $filterType;
        
//        if(Yii::$app->request->isAjax && IS_MOBILE){
//            $testis = $theEntry->items([
//            'where' => [
//                'category_id' => 13
//            ],
//            'pagination' => ['pageSize' => IS_MOBILE ? 12 : 12],
//            ]);            
//            return $this->renderPartial(IS_MOBILE ? '//page2016/mobile/temoignage-type' : '//page2016/temoignage-type',[
//            'testis' => $testis,
//            ]);
//        }
        
        
        if (Yii::$app->request->get('see-more') == NULL) {
            $seemore = 12;
        } else {
            $seemore = Yii::$app->request->get('see-more');
        }
        
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        $this->update_meta = $this->getDataUpdateMetaTesti();
        
        //process data testi
        $root = \yii\easyii\modules\page\api\Page::get(15);
        $queryTesti = clone $theEntry;
        $testis = $theEntry->items([
            'where' => [
                'category_id' => 13
            ],
            'pagination' => ['pageSize' => IS_MOBILE ? $seemore : 12],
            'filters' => $filter
            ]);
        $totalCountTesti = count($queryTesti->items([
            'pagination' => ['pageSize'=>0],
            'filters' => $filter
            ]));
        $pageTesti = new Pagination([
            'totalCount' => $totalCountTesti,
            'defaultPageSize' => IS_MOBILE ? 12 : 12,
            'forcePageParam' => false
        ]);
        $this->pagination = $pageTesti->pageCount;
       
       
        if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
        if (Yii::$app->request->isAjax) {
//             if(Yii::$app->request->post()['type'] == 'testi'){
//                return $this->renderPartial('//page2016/ajax/testi-ajax', ['testis' => $testis,
//                    'pageTesti' => $pageTesti]);
//
//            }
     //      $totalCountTesti = $this->actionGetNumberTesti();
          // var_dump($totalCountTesti);exit;
        }
        

         return $this->render(IS_MOBILE ? '//page2016/mobile/temoignage-type' : '//page2016/temoignage-type', [
            'theEntry' => $theEntry,
            'testis' => $testis,
            'pageTesti' => $pageTesti,
            'root' => $root,
            'totalCountTesti' => $totalCountTesti, 
        ]);
    }

    public function actionPortraitAboutUs(){
        
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
//        if(Yii::$app->request->isAjax && IS_MOBILE){
//            $page = Yii::$app->request->get('page');
//            $pagesize = 12;
//            $totalCountPort = count(\app\modules\whoarewe\api\Catalog::items([
//            'where' => [
//                'category_id' => 12
//            ],
//            'pagination' => ['pageSize' => 0],
//            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
//            ]));
//             
//            $portraitsAjax = \app\modules\whoarewe\api\Catalog::items([
//            'where' => [
//                'category_id' => 12
//            ],
//            'pagination' => ['pageSize' => $pagesize],
//            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
//            ]);
//            return $this->renderPartial('//page2016/mobile/portrait', [
//                'portraits' => $portraitsAjax,
//                'totalCountPort' => $totalCountPort,
//                ]);
//        }
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        $root = \yii\easyii\modules\page\api\Page::get(15);
        if(Yii::$app->request->get('see-more')){
            $pagesize = Yii::$app->request->get('see-more');
        }else{
            $pagesize = 12;
        }
//        if(IS_MOBILE){
//            $pagesize = 12;
//            
//        }
        //get data category & items portrain
        $thePortrait  = \app\modules\whoarewe\api\Catalog::cat(12);
        $queryPort = clone $thePortrait;
        $queryFindLarge = clone $queryPort;
        $topPortrait = $queryFindLarge->items(['filters' => [
                'islarge' => 'on'
            ]]);
        $topPortrait = $topPortrait[0];
         $portraits = \app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 12
            ],
            'pagination' => ['pageSize' => $pagesize],
            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
            ]);    
       
        $totalCountPort = count(\app\modules\whoarewe\api\Catalog::items([
            'where' => [
                'category_id' => 12
            ],
            'pagination' => ['pageSize' => 0],
            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC]
            ]));
        
        $pages = new Pagination ([ 
                'totalCount' => $totalCountPort, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;    
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
        
//        $pagesPort = new Pagination([
//            'totalCount' => $totalCountPort,
//            'defaultPageSize' => 3
//        ]);
//        $this->pagination = $pagesPort->pageCount;
//        if (Yii::$app->request->isAjax) {
//            if(Yii::$app->request->post()['type'] == 'port'){
//                return $this->renderPartial('//page2016/ajax/port-ajax', [
//                        'portraits' => $portraits,
//                        'pagesPort' => $pagesPort
//                    ]);
//            }
//        }
        return $this->render(IS_MOBILE ? '//page2016/mobile/portrait' : '//page2016/portrait',[
            'theEntry' => $theEntry,
            'portraits' => $portraits,
            'topPortrait' => $topPortrait,
            //'pagesPort' => $pagesPort,
            'totalCountPort' => $totalCountPort,
            'pagesize' => $pagesize,
            'root' => $root
        ]);
    }

    public function actionSearchTemoignageAboutUs() {
        $theEntry = \app\modules\whoarewe\api\Catalog::cat('temoignages');
        $this->entry = $theEntry;
          //data search for testi
        //for tour Type
         $type = Yii::$app->request->get('type');
        $filterType = [];
        if($type && $type != 'all')
            $filterType = ['tTourTypes' => ['IN',explode(',',$type)]];
        //for tour themes
        $theme = Yii::$app->request->get('theme');
        $filterTheme = [];
        if($theme && $theme != 'all')
            $filterTheme = ['tTourThemes' => ['IN',explode(',',$theme)]];
        //for country
        $country = Yii::$app->request->get('country');
        $filterCountry = [];
        if($country && $country != 'all'){
            if(strpos($country, '-') === false){
                $filterCountry = ['countries' => ['IN', [$country]]];
            }
            else{
                foreach (explode('-',$country) as $key => $value) {
                    $filterCountry[] = $value;
                }
                $filterCountry = ['countries' => ['IN', $filterCountry]];
            }
        }
        
        $filter = [];
        $filter = $filter + $filterCountry + $filterTheme + $filterType;
        
//        if (Yii::$app->request->isAjax) {
//            if(IS_MOBILE){
//                $theTesti = \app\modules\whoarewe\api\Catalog::cat(13);
//                $queryTesti = clone $theTesti;
//                $testis = $theTesti->items([
//                    'where' => [
//                        'category_id' => 13
//                    ],
//                    'pagination' => ['pageSize' => IS_MOBILE ? 12 : 12],
//                    'filters' => $filter
//                    ]);
//                return $this->renderPartial('//page2016/mobile/search-temoignage', ['testis' => $testis
//                ]);
//            }
//
////            if(Yii::$app->request->post()['type'] == 'testi'){
////                $theTesti = \app\modules\whoarewe\api\Catalog::cat(13);
////                $queryTesti = clone $theTesti;
////                $testis = $theTesti->items([
////                    'where' => [
////                        'category_id' => 13
////                    ],
////                    'pagination' => ['pageSize' => 5],
////                    'filters' => $filter
////                    ]);
////                
////                $totalCountTesti = count($queryTesti->items(['pagination' => ['pageSize'=>0],
////                    'filters' => $filter]));
////                $pageTesti = new Pagination([
////                    'totalCount' => $totalCountTesti,
////                    'pageSize' => 5,
////                ]);
//////                return $this->renderPartial('//page2016/ajax/testi-ajax', ['testis' => $testis,
//////                    'pageTesti' => $pageTesti]);
////
////            }
//        }
        $theEntry = \yii\easyii\modules\page\api\Page::get(URI);
        $this->getSeo($theEntry->model->seo);
        $this->update_meta = $this->getDataUpdateMetaTesti();
        
        
        //get data category & items testi
        //process data testi
        $theTesti = \app\modules\whoarewe\api\Catalog::cat(13);
        $queryTesti = clone $theTesti;
        $testis = $theTesti->items([
            'where' => [
                'category_id' => 13
            ],
            'pagination' => ['pageSize' => IS_MOBILE ? 12 : 12],
            'filters' => $filter
            ]);
        $totalCountTesti = count($queryTesti->items(['pagination' => ['pageSize'=>0],
            'filters' => $filter]));
        $pageTesti = new Pagination([
            'totalCount' => $totalCountTesti,
            'pageSize' => IS_MOBILE ? 12 : 12,
        ]);
        $this->pagination = $pageTesti->pageCount;
        return $this->render(IS_MOBILE ? '//page2016/mobile/search-temoignage' : '//page2016/search-temoignage',[
            'theEntry' => $theEntry,
            'theTesti' => $theTesti,
            'testis' => $testis,
            'pageTesti' => $pageTesti,
            'totalCountTesti' => $totalCountTesti
        ]);
    }
     public function actionTemoignageSingleAboutUs() {
        $theEntry = Catalog::get(SEG2);
        $this->entry = $theEntry;
         $allCountries = Country::find()->select(['code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
         $allCountries = ArrayHelper::map($allCountries,'code','name_fr');
        
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
         $this->getSeo($theEntry->model->seo);
        return $this->render(IS_MOBILE ? '//page2016/mobile/temoignage-single' : '//page2016/temoignage-single',[
            'allCountries' => $allCountries,
            'theEntry' => $theEntry,
            'root' => $this->getRootAboutUs() 
        ]);
    }
    
     public function actionNosSecret() {
        
        // $theEntry = Catalog::cat(19);
         $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
         $this->entry = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->model->seo);
        // var_dump($theEntry->model);exit;
         $theEntries = $theEntry->items();
         
         return $this->render(IS_MOBILE ? '//page2016/mobile/nos-secret-dailleurs' : '//page2016/nos-secret-dailleurs',[
            'theEntry' => $theEntry,
            'theEntries' => $theEntries
        ]);
    }

    public function actionHost(){
         $theEntry = \app\modules\whoarewe\api\Catalog::get(URI);
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
         $this->entry = $theEntry;
         
         $this->getSeo($theEntry->model->seo);
         $fields = ArrayHelper::map($theEntry->model->category->fields, 'name', function($e){
            return $e;
        });
         $icons = [];
        if(!empty($theEntry->data->acticons)){
            $icons = \app\modules\libraries\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->acticons],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$theEntry->data->acticons) . ')')]
            ]);
        }
        $excl = [];
        if(!empty($theEntry->data->excl)){
            $excl = \app\modules\exclusives\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->excl],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$theEntry->data->excl) . ')')]
            ]);
        }
         return $this->render(IS_MOBILE ? '//page2016/mobile/host-single' : '//page2016/host-single', [
            'theEntry' => $theEntry,
            'fields' => $fields,
            'icons' => $icons,
            'excl' => $excl
         ]);
    }


    public function actionResultNosSecretDailleursExclusivites()
    {

        $theEntry = \yii\easyii\modules\page\api\Page::get(URI);
        
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        $this->update_meta = $this->getDataUpdateMeta();
        $process = $this->getAjaxFilterExclusive();
        
        $theEntries = $process['voyage'];
        $totalCount = $process['totalCount'];
        $numberFilter = $process;
        
        $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
        
        if(IS_MOBILE){
            $this->totalCount = $totalCount;
            $numberFilterVoyage = $this->getAjaxFilter();
            $this->arr_option_filter_voyage_mobile = [
                    'title_filter' => $theEntry->model->seo->h1 ,
                    'namefilter' => 'filter_voyage',
                    'uri' =>$theEntry->slug,
                    'totalCount' => $numberFilterVoyage['totalCount'],
                   // 'totalCount_exclusives' => $totalCount,
                    'country' => 'all',
                    'type' => 'all',
                    'length' => 'all',
                    'numberFilter' => $numberFilterVoyage,
                ];
            $this->arr_option_filter_exclusives_mobile = [
                    'title_filter' => $theEntry->model->seo->h1 ,
                    'namefilter' => 'filter_exclusivites',
                    'uri' =>$theEntry->slug,
                   // 'totalCount_voyage' => count(\app\modules\programmes\api\Catalog::items(['pagination' => ['pageSize' => 0]])),
                    'totalCount' => $totalCount,
                    'country' => 'all',
                    'type' => 'all',
                    'length' => 'all',
                    'numberFilter' => $numberFilter,
                ];
        }
        
       // $theEntries = $this->getAjaxFilterExclusive()['voyage'];
       // $totalCount = $this->getAjaxFilterExclusive()['totalCount'];
       // $numberFilter = $this->getAjaxFilterExclusive();
        

        $dataLoc = \app\modules\libraries\models\Category::findOne(['slug' => 'locations'])->children()->with('items')->asArray()->all();
        $locationsLib = [];
        foreach ($dataLoc as $key => $value) {
            $locationsLib += ArrayHelper::map($value['items'], 'slug', 'title');
        }

        $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);
        $theRaisons_list = $theRaisons->items(['category_id' => $theRaisons->model->category_id]);

        return $this->render(IS_MOBILE ? '//page2016/mobile/result-nos-secret-dailleurs' : '//page2016/result-nos-secret-dailleurs', [
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'locationsLib' => $locationsLib,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            //'theEntry' => $theEntry,
            'totalCount' => $totalCount,
            'numberFilter' => $numberFilter,
        ]);
    }
    
     public function actionImprovisezAboutUs() {
       // $theEntry = Catalog::cat(18);
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		$this->getSeo($theEntry->model->seo);
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/improvisez' : '//page2016/improvisez',[
            'theEntry' => $theEntry,
            'root' => $this->getRootAboutUs()
        ]);
    }
   
    public function actionQuiSommesNousAboutUs() {
        //$theEntry = Catalog::cat(1);
        $theEntry = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id'=>1])
                ->with(['photos'])
                ->one();
        $this->entry =\app\modules\whoarewe\api\Catalog::cat(1);
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		$this->getSeo($theEntry->seo);
         $theItem_1 = Catalog::get(1);
         $theItem_2 = Catalog::get(572);
		 $theItem_3 = Catalog::get(640);
        
         $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);
        
    $theRaisons_list = $theRaisons->items(['where'=>['category_id' => $theRaisons->model->category_id],'orderBy'=>'item_id']);
        return $this->render(IS_MOBILE ? '//page2016/mobile/qui-sommes-nous' : '//page2016/qui-sommes-nous',[
            'theEntry' => $theEntry,
            'theItem_1' => $theItem_1,
            'theItem_2' => $theItem_2,
			'theItem_3' => $theItem_3,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            'root' => $this->getRootAboutUs()
        ]);
    }

    public function actionOfficeAboutUs()
    {

//        $theEntry = \app\modules\whoarewe\models\Category::find()
//            ->where(['category_id' => 36])
//            ->with(['photos'])
//            ->one();
   // var_dump($theEntry);exit;
        //$theEntries = NULL;
       // if(IS_MOBILE){
            $theEntry = \app\modules\whoarewe\api\Catalog::cat(36);
           // var_dump($theEntry);exit;     
            $theEntries = \app\modules\whoarewe\api\Catalog::items([
                //'where' => ['and', 'category_id = '.$theEntry->category_id.'', ['not', ['item_id' => $theEntry->model->item_id]]],
                'where' => ['category_id'=>$theEntry->model->category_id],
                'orderBy' =>'item_id ASC',
                'pagination' =>['pagesize'=>0],
            ]);
       // }
        $this->entry = \app\modules\whoarewe\api\Catalog::cat(36);
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        
        if(IS_MOBILE){
            $this->getSeo($theEntry->model->seo);
        }else{
            $this->getSeo($theEntry->model->seo);
        }
        $theItem_1 = Catalog::get(1);
        $theItem_2 = Catalog::get(572);
        $theItem_3 = \app\modules\whoarewe\api\Catalog::cat(36);


        $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);

        $theRaisons_list = $theRaisons->items(['where' => ['category_id' => $theRaisons->model->category_id], 'orderBy' => 'item_id']);
        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-bureaux' : '//page2016/nos-bureaux', [
            'theEntry' => $theEntry,
            'theItem_1' => $theItem_1,
            'theItem_2' => $theItem_2,
            'theItem_3' => $theItem_3,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            'theEntries' => $theEntries,
            'root' => $this->getRootAboutUs()
        ]);
    }

    public function actionOfficeSingleAboutUs() {

        $theEntry = \app\modules\whoarewe\api\Catalog::get(URI);
        $this->entry = $theEntry;       
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        
        $otherOffice = \app\modules\whoarewe\api\Catalog::items([
            'where' => ['and', 'category_id = '.$theEntry->category_id.'', ['not', ['item_id' => $theEntry->model->item_id]]],
            'orderBy' =>'rand()',
            'pagination' =>['pagesize'=>0],
        ]);
        
       
        

        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-bureaux-single' : '//page2016/nos-bureaux-single',[
            'theEntry' => $theEntry,
            'otherOffice' => $otherOffice,

            'root' => $this->getRootAboutUs()
        ]);
    }
	public function actionNotreEquipeAboutUs() {

        if(IS_MOBILE){
            $theEntry = \app\modules\whoarewe\api\Catalog::cat(37);
        }else{
        
            $theEntry = \app\modules\whoarewe\models\Category::find()
                ->where(['category_id' => 37])
                ->with(['photos'])
                ->one();
        }
         $this->entry =\app\modules\whoarewe\api\Catalog::cat(37);       
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($this->entry->model->seo);
         
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/notre-equipe' : '//page2016/notre-equipe',[
            'theEntry' => $theEntry,
            
            'root' => $this->getRootAboutUs()
        ]);
    }
    public function actionFranCoPhonie() {
        $theEntry = \app\modules\whoarewe\api\Catalog::cat(URI);
       // var_dump($theEntry);exit;
        $this->entry = $theEntry;       
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/fran-co-phonie' : '//page2016/fran-co-phonie',[
            'theEntry' => $theEntry,
            
        ]);
    }
	
     public function actionIdeesDeVoyage()
    {
        $theEntry = Page::get(13);

        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');

        $this->getSeo($theEntry->model->seo);

        $this->countTour = count(\app\modules\programmes\api\Catalog::items([
            //'filters' => ['countries' => SEG1],
            'pagination' => ['pageSize' => 0]
        ]));
       // $this->countTour = $this->getAjaxFilter()['totalCount'];
        // $theSeven = \app\modules\programmes\models\Category::tree();
        $theSeven = \app\modules\programmes\models\Category::find()
            ->where(['depth' => 0])
            ->with(['photos'])
            ->orderBy('order_num desc')
            ->all();
         if(IS_MOBILE){
//            $this->totalCount = $this->countTour;
//            $this->arr_option_filter_voyage_mobile = [
//                    'title_filter' => $theEntry->model->seo->h1 ,
//                    'namefilter' => 'filter_voyage',
//                    'uri' =>$theEntry->slug,
//                    'totalCount' => $this->countTour,
//                   // 'totalCount_exclusives' => 0,
//                    'country' => 'all',
//                    'type' => 'all',
//                    'length' => 'all',
//                ];
        }    
        return $this->render(IS_MOBILE ? '//page2016/mobile/idees-de-voyage' : '//page2016/idees-de-voyage', [
            'theEntry' => $theEntry,
            'theSeven' => $theSeven,
        ]);
    }
     
    public function actionIdeesDeVoyageType()
    {
        $theParent = Page::get(13);
        $theEntry = \app\modules\programmes\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');

        if ($theEntry->parents()) {
            return Yii::$app->runAction('amica-fr/idees-de-voyage-list-entre-ocean');
        }
        $this->getSeo($theEntry->model->seo);
        if(!Yii::$app->cache->get(URI)){
            $icons = [];
        if(!empty($theEntry->data->attrtour)){
            $icons = \app\modules\libraries\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->attrtour],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$theEntry->data->attrtour) . ')')]
            ]);
        }

        $toursCon = [];
        if(!empty($theEntry->data->tours)){
            $toursCon = \app\modules\modulepage\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->tours],
                'limit' => 1
            ])[0];
        }

        $excl = $exclCon = [];
        if(!empty($theEntry->data->formules)){
            $exclCon = \app\modules\modulepage\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->formules],
                'limit' => 1
            ])[0];
            if(!empty($exclCon->data->exclusives)){
                $excl = \app\modules\exclusives\api\Catalog::items(['where' => ['IN', 'item_id', $exclCon->data->exclusives],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$exclCon->data->exclusives) . ')')]
            ]);
            }
        }
        
         $port = $portCon = [];
        if(!empty($theEntry->data->portrait)){
            $portCon = \app\modules\modulepage\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->portrait],
                'limit' => 1
            ])[0];
            $port = \app\modules\whoarewe\api\Catalog::items(['where' => ['IN', 'item_id', $portCon->data->aboutuspost],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$portCon->data->aboutuspost) . ')')]
            ]);
        }

        $testi = $testiCon = [];
        if(!empty($theEntry->data->testi)){
            $testiCon = \app\modules\modulepage\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->testi],
                'limit' => 1
            ])[0];
            $testi = \app\modules\whoarewe\api\Catalog::items(['where' => ['IN', 'item_id', $testiCon->data->temoignages],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$testiCon->data->temoignages) . ')')]
            ]);
        }

        $blogs = $blogsCon = [];
        if(!empty($theEntry->data->blogs)){
            $blogsCon = \app\modules\modulepage\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->blogs],
                'limit' => 1
            ])[0];
        }

        // BLOGS
            $arrBlog = [];
            if(!empty($blogsCon->data->blogs)) {
                $dataBlogSelected = $blogsCon->data->blogs;
                foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                    $arrBlog[$keyBlog] = $this->getDataPost($valueBlog);
                    $titleCategory = $this->getCategoryName($arrBlog[$keyBlog]['categories'][0])['name'];
                    $arrBlog[$keyBlog]['cat_name'] = $titleCategory;


                    $featuredMediaData = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['media_details']['sizes']['barouk_list-thumb'];
                    $arrBlog[$keyBlog]['alt_text'] = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['alt_text'];
                    $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=300&h=200&zc=1&q=80';
                }
            } 
            $sliders = \app\modules\programmes\models\Category::find()->roots()->andWhere(['!=','slug', URI])->all();  
            $dataAll = [];
            $dataAll['icons'] = $icons;
            $dataAll['excl'] = $excl; 
            $dataAll['exclCon'] = $exclCon; 
            $dataAll['arrBlog'] = $arrBlog;
            $dataAll['blogsCon'] = $blogsCon;
            $dataAll['testi'] = $testi;
            $dataAll['testiCon'] = $testiCon;
            $dataAll['port'] = $port;
            $dataAll['portCon'] = $portCon;
            $dataAll['toursCon'] = $toursCon;
            $dataAll['sliders'] = $sliders;
            Yii::$app->cache->set(URI, $dataAll);
        } else{
            $dataAll = Yii::$app->cache->get(URI);
        }
         

        // xy ly Filter Ajax
        
            $getAjaxFilter = $this->getAjaxFilter(['country'=>'','type'=>$theEntry->model->category_id]);
        
            $theEntries = $getAjaxFilter['voyage'];       
            $totalCount = $getAjaxFilter['totalCount'];
            $numberFilter = $getAjaxFilter;
            
            $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }

        // end Filter
            if(IS_MOBILE){
                $this->totalCount = $totalCount;
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theEntry->slug,
                        'totalCount' => $totalCount,
                        'country' => 'all',
                        'type' => $theEntry->model->category_id,
                        'length' => 'all',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $numberFilter,
                    ];
            }
        return $this->render(IS_MOBILE ? '//page2016/mobile/idees-de-voyage-type' : '//page2016/idees-de-voyage-type', [
            'theParent' => $theParent,
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'totalCount' => $totalCount,
            'numberFilter' => $numberFilter,
            'icons' => $dataAll['icons'],
            'excl' => $dataAll['excl'],
            'exclCon' => $dataAll['exclCon'],
            'testi' => $dataAll['testi'],
            'testiCon' => $dataAll['testiCon'],
            'arrBlog' => $dataAll['arrBlog'],
            'blogsCon' => $dataAll['blogsCon'],
            'port' => $dataAll['port'],
            'portCon' => $dataAll['portCon'],
            'toursCon' => $dataAll['toursCon'],
            'sliders' => $dataAll['sliders'],
        ]);
    }

    
    public function getAjaxFilter($input = []){
        
        
        if(Yii::$app->request->get('country') == NULL && Yii::$app->request->get('length') == Null && Yii::$app->request->get('type') == Null && Yii::$app->request->get('region') == Null){

            if(!empty($input)){
                $category_id = ['category_id' => $input['type']];
                $category_id_total = ['category_id' => $input['type']];
                
                if($input['type'] != ''){
                    $fil_type = ['multitour' => $input['type']];
                }else{
                    $fil_type = [];
                }
                
                if($input['country'] != ''){
                    $fil_countries = ['countries'=>$input['country']];
                }else{
                    $fil_countries = [];
                }
                
                
                
            }else{
                $category_id = ['category_id' => ''];
                $category_id_total = ['category_id' => ''];
                $fil_countries = [];
                $fil_type = [];
            }

            
            
            $voyage_total = \app\modules\programmes\api\Catalog::items([
                  //  'where' => $category_id_total,
                    'filters' => $fil_countries + $fil_type,    
                    'pagination' => ['pageSize' => 0]

                ]);
              
            if(count($voyage_total) == 13 || count($voyage_total) == 14){
                $pagesize = count($voyage_total);
            }else{
                $pagesize = 12;
            }
            
            
            if(SEG1.'/'.SEG2 =='voyage/itineraire'){
                $voyage = \app\modules\programmes\api\Catalog::items([
                    'orderBy' => ['order_num' => SORT_DESC ,'time' => SORT_DESC],
                  //  'where' => $category_id,
                    'filters' => $fil_countries + $fil_type,    
                    'pagination' => ['pageSize' => $pagesize],
                    
                ]);
            }else if(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie'){
                $voyage = \app\modules\programmes\api\Catalog::items([
                    'orderBy' => ['order_num' => SORT_DESC ,'time' => SORT_DESC],
                  //  'where' => $category_id,
                    'filters' => $fil_countries + $fil_type,    
                    'pagination' => ['pageSize' => 0],
                    
                ]);
              // var_dump($voyage);exit;
            } else{ // ex: voyage/famille, voyage/combine  ... etc
               // var_dump(implode(',', array($input['type'])));exit;
                if(isset($input['type'])){
                    if($input['type'] == ''){
                        $input['type'] = 0;
                    }
                }else{
                    $input['type'] = 0;
                }
                $voyage = \app\modules\programmes\api\Catalog::items([
                  //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                    'orderByCustom' => [new \yii\db\Expression('FIELD (`app_programmes_items`.`category_id`, '. implode(',', array($input['type'])) .') DESC'), 'order_num' => SORT_DESC ,'time' => SORT_DESC],
                  //  'where' => $category_id,
                    'filters' => $fil_countries + $fil_type,    
                    'pagination' => ['pageSize' => $pagesize]

                ]);
            }   
            
            
            // var_dump($voyage);exit;
            $totalCount = count($voyage_total);
        
        // get number option filter
            // option destionation
                $countCountry = $this->getNumberFilterCountry($voyage_total);
                // option region

                $countRegion = $this->getNumberFilterRegion($voyage_total);
            // option Length
                $countLength = $this->getNumberFilterLength($voyage_total);
                
            
                
            // option Type
            if(isset($input['country']) == ''){    
                 $totaltour_first = \app\modules\programmes\api\Catalog::items([
                   // 'where' => $category_id,
                    'filters' => $fil_countries + $fil_type,  
                    'pagination' => ['pageSize' => 0]
                    ]);
                
                $countType = $this->getNumberFilterTypeIdeel($totaltour_first); 
                 
                
            }else if(isset($input['country']) == SEG1){
                $totaltour_first = \app\modules\programmes\api\Catalog::items([
                   // 'where' => $category_id,
                    'filters' => $fil_countries,  
                    'pagination' => ['pageSize' => 0]
                    ]);
                
                $countType = $this->getNumberFilterTypeIdeel($totaltour_first); 
            }else{       
                $countType = $this->getNumberFilterTypeIdeel($voyage_total); 
                
            }            
        // end
        }else{
        //xu ly see more
        
        
        if(Yii::$app->request->get('see-more') !== NULL){
            $pagesize = Yii::$app->request->get('see-more');
//        }else if(Yii::$app->request->get('page') !== NULL){
//            $pagesize = Yii::$app->request->get('page') * 12;
//        }else if(Yii::$app->request->get('data-page') !== NULL){
//            $pagesize = Yii::$app->request->get('data-page') * 12;
        }else{
            $pagesize = 12;
        }
        
        
        
        
        // xu ly order by
        
        if(Yii::$app->request->get('orderby') !== NULL){
            
            if(Yii::$app->request->get('orderby') == 'newest-date'){
               $orderby = ['item_id' => SORT_DESC]; 
            }else if(Yii::$app->request->get('orderby') == 'day-asc'){
                $orderby = ['days' => SORT_ASC]; 
            }else if(Yii::$app->request->get('orderby') == 'day-desc'){
                $orderby = ['days' => SORT_DESC]; 
            }else if(Yii::$app->request->get('orderby') == 'budget-asc'){
                $orderby = ['CONVERT(substr(budget,2), UNSIGNED INTEGER)' => SORT_ASC]; 
            }else if(Yii::$app->request->get('orderby') == 'budget-desc'){
                $orderby = ['CONVERT(substr(budget,2), UNSIGNED INTEGER)' => SORT_DESC]; 
            }else{
                $orderby = ['order_num' => SORT_DESC,'time' => SORT_DESC]; 
            }
        }else{
            if(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie' || SEG1.'/'.SEG2 =='voyage/itineraire'){
                $orderby = ['order_num'=> SORT_DESC ,'time' => SORT_DESC]; 
            }else{
                $orderby = ['order_num' => SORT_DESC ];
            }
        }
       
        // xu ly ajax type
        
        
        
        $type = Yii::$app->request->get('type');
        $typeNoChild = $typeChild = [];
        
        if(!$type || $type == 'all'){
            $filterType = [];
            
        } else {
            foreach (explode('-',$type) as $key => $value) {
                         $typeNoChild[] = intval($value);
            }
            $filterType = $typeNoChild;
            
        }
     //   $filterType = ['category_id' => $filterType];
        $filterType = ['category_id' => ''];    // Fix filter theo multitour
         // xu ly ajax country
        
        $country = Yii::$app->request->get('country');
        $filters_country = [];
        if(!$country || $country == 'all' || count(explode('-', $country)) == 4){
            $filters_country = [];
        } else {
            if(strpos($country, '-') === false){
                $filters_country = ['countries' => $country];
            }
            else{
                $filters_country = ['countries' => ['IN',explode('-',$country)]];
            }
        }
        // xu ly ajax region
        
        $region = Yii::$app->request->get('region');
        $filters_region = [];
        if($region && $region != 'all' && count(explode('-', $region)) != 6){
            if(strpos($region, '-') === false){
                $filters_region = ['region' => $region];
            }
            else{
                $filters_region = ['region' => ['IN',explode('-',$region)]];
            }
        }
        
        $filters_type = [];
        if($type && $type != 'all'){
            if(strpos($type, '-') === false){
                $filters_type = ['multitour' => $type];
            }
            else{
                $filters_type = ['multitour' => ['IN',explode('-',$type)]];
            }
        }
        $filters = $filters_country + $filters_region + $filters_type;
        
          // xu ly ajax length
        
        $length = Yii::$app->request->get('length');
        if($length == 'all'){
            $length = '';
        }
        $filterLen = [];
        if(strpos($length, '-') !== false){
              $arrLen = explode('-',$length);
              asort($arrLen);
              if($arrLen[0]==1) $arrLen[0] = 0;
                 if(count($arrLen) == 2 || count($arrLen) == 6 ){
                    $filterLen = ['between', 'days', $arrLen[0], end($arrLen)];
                }
                if(count($arrLen) == 4 ){
                    $filterLen = ['or',
                    ['between', 'days', $arrLen[0], $arrLen[1]],
                    ['between', 'days', $arrLen[2], $arrLen[3]] 
                    ];
                }
                if(count($arrLen) == 3 || count($arrLen) == 5 || count($arrLen) == 7){
                    $filterLen = ['or',
                    ['between', 'days', $arrLen[0], $arrLen[count($arrLen) - 2]],
                    ['>=','days', end($arrLen)]  
                    ];
                }
                
//              if(count($arrLen) == 4){
//                $filterLen = ['between', 'days', $arrLen[0], end($arrLen)];
//              }
//              if(count($arrLen) == 3){
//                $filterLen = ['or',
//                ['between', 'days', $arrLen[0], $arrLen[1]],
//                ['>=','days', end($arrLen)]  
//                ];
//              }
//              if(count($arrLen) == 2){
//                $filterLen = ['between', 'days', $arrLen[0], $arrLen[1]];
//              }
        } else {
            $filterLen = ['>=','days', $length];
        
        }
        
        // get TotalTour
         $totaltour = \app\modules\programmes\api\Catalog::items([
                    'where' => ['and',
                        $filterType,
                        $length ? $filterLen : []
                        ],
                    'filters' => $filters,
                    'pagination' => ['pageSize' => 0]
                    ]);
        if(count($totaltour) == 13 || count($totaltour) == 14){
            $pagesize = count($totaltour);
        } 
        
        // xu ly nut xem them  trang truoc see-more-prev
        
        if(Yii::$app->request->get('before-page') !== NULL){
            $before_page = Yii::$app->request->get('before-page') - 1;
            $pagi = ['pageSize' => $pagesize, 'page' => $before_page ];
        }else{
            $pagi = ['pageSize' => $pagesize];
        }
        
        
        if(SEG1.'/'.SEG2 =='voyage/itineraire'){
                 $voyage = \app\modules\programmes\api\Catalog::items([
                       // 'orderBy' => ['time' => SORT_DESC],
                        'orderBy' => $orderby,
                        'where' => ['and',
                            $filterType,
                            $length ? $filterLen : []
                            ],
                        'filters' => $filters,
                       // 'pagination' => ['pageSize' => $pagesize]
                        'pagination' => $pagi
                        ]);
        }else if(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie'){
            
            if(Yii::$app->request->get('before-page') !== NULL){
                $before_page = Yii::$app->request->get('before-page') - 1;
                $pagi = ['pageSize' => 12, 'page' => $before_page ];
            }else{
                $pagi = ['pageSize' => 0];
            }
            
             $voyage = \app\modules\programmes\api\Catalog::items([
                       // 'orderBy' => ['time' => SORT_DESC],
                        'orderBy' => $orderby,
                        'where' => ['and',
                            $filterType,
                            $length ? $filterLen : []
                            ],
                        'filters' => $filters,
                       // 'pagination' => ['pageSize' => $pagesize]
                      //  'pagination' => ['pageSize' => 0]
                        'pagination' => $pagi
                        ]);
        } else{
            $voyage = \app\modules\programmes\api\Catalog::items([
             //   'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                'orderBy' => $orderby,
                'where' => ['and',
                    $filterType,
                    $length ? $filterLen : []
                    ],
                'filters' => $filters,
               // 'pagination' => ['pageSize' => $pagesize]
                'pagination' => $pagi
                ]);
        }   
       
        
        
//        foreach ($voyage as $value) {
//            echo '<br>';
//            var_dump($value->data->multitour);
//        }
//        exit;
//        var_dump($voyage);exit;    
           
        // get number option filter
        
                    
            // option destionation
         //   if(Yii::$app->request->get('first') == 'destination' || Yii::$app->request->get('first') == 'length' || Yii::$app->request->get('first') == 'type'){
                $totaltour_filter_country = \app\modules\programmes\api\Catalog::items([
                    'where' => ['and',
                        $filterType,
                        $length ? $filterLen : []
                        ],
                    'filters' => $filters_region + $filters_type,
                    'pagination' => ['pageSize' => 0]
                    ]);
                
                $countCountry = $this->getNumberFilterCountry($totaltour_filter_country);
                
                $totaltour_filter_region = \app\modules\programmes\api\Catalog::items([
                    'where' => ['and',
                        $filterType,
                        $length ? $filterLen : []
                        ],
                    'filters' => $filters_country + $filters_type,
                    'pagination' => ['pageSize' => 0]
                    ]);
                
                $countRegion = $this->getNumberFilterRegion($totaltour_filter_region);
                
                $totaltour_filter_length = \app\modules\programmes\api\Catalog::items([
                    'where' => ['and',
                        $filterType,
                     //   $length ? $filterLen : []
                        ],
                    'filters' => $filters,
                    'pagination' => ['pageSize' => 0]
                    ]);
                
                $countLength = $this->getNumberFilterLength($totaltour_filter_length);
               
                    
                $totaltour_filter_type = \app\modules\programmes\api\Catalog::items([
                    'where' => ['and',
                     //   $filterType,
                        $length ? $filterLen : []
                        ],
                    'filters' => $filters_country + $filters_region,
                    'pagination' => ['pageSize' => 0]
                    ]);
                
                $countType = $this->getNumberFilterTypeIdeel($totaltour_filter_type);
                
                
                 
//            }else{
//                
//                $countCountry = $this->getNumberFilterCountry($totaltour);
//                
//                $countLength = $this->getNumberFilterLength($totaltour);   
//                 
//                $countType = $this->getNumberFilterTypeIdeel($totaltour);
//                    
//               
//            }     
            // option Length
            
           

        // end
        
        
                $totalCount = count($totaltour);
                }

            return ['voyage'=>$voyage,
                    'totalCount'=>$totalCount,
                    'countCountry' => $countCountry,
                    'countLength' => $countLength,
                    'countType' => $countType,
                    'countRegion' => $countRegion
                    ];
       

    }

    // Xu ly thong so cua bo loc - FILTERS
        
    public function getNumberFilterCountry($input){
        $countCountry = ArrayHelper::getColumn(ArrayHelper::map(ArrayHelper::map($input, 'slug', 'model'), 'item_id', 'data'), 'countries');
             
            $vietnam = 0;
            $laos = 0;
            $cambodge = 0;
            $birmanie = 0;
            foreach ($countCountry as $value) {
                foreach ($value as $v) {
                    if($v == 'vietnam'){
                        $vietnam++;
                    }
                    if($v == 'laos'){
                        $laos++;
                    }
                    if($v == 'cambodge'){
                        $cambodge++;
                    }
                    if($v == 'birmanie'){
                        $birmanie++;
                    }
                }
            }
             $countCountry = [
                'vietnam' => $vietnam,
                'laos' => $laos,
                'cambodge' => $cambodge,
                'birmanie' => $birmanie
            ];
        return $countCountry;    
    }
    
    public function getNumberFilterTypeIdeel($input){
        
        $countType = ArrayHelper::getColumn(ArrayHelper::map(ArrayHelper::map($input, 'slug', 'model'), 'item_id', 'data'), function($e){ return !empty($e->multitour) ? $e->multitour : [];});

         $countType_arr = array(1 => 0, 2 => 0, 3 => 0, 4 => 0,5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);          
            
            foreach ($countType as $value) {
                foreach ($value as $v) {
                    if($v === '1'){
                        $countType_arr[1]++;
                    }
                    if($v === '2'){
                        $countType_arr[2]++;
                    }
                    if($v === '3'){
                        $countType_arr[3]++;
                    }
                    if($v === '4'){
                        $countType_arr[4]++;
                    }
                    if($v === '5'){
                        $countType_arr[5]++;
                    }
                    if($v === '6'){
                        $countType_arr[6]++;
                    }
                    if($v === '7'){
                        $countType_arr[7]++;
                    }
                    if($v === '8'){
                        $countType_arr[8]++;
                    }
                    if($v === '9'){
                        $countType_arr[9]++;
                    }
                    if($v === '10'){
                        $countType_arr[10]++;
                    }
                    if($v === '11'){
                        $countType_arr[11]++;
                    }
                    if($v === '12'){
                        $countType_arr[12]++;
                    }
                    
                    
                }
            }
            $countType = $countType_arr;
            
        return $countType;    
    }
    public function getNumberFilterType($input){
        
        $countType = ArrayHelper::getColumn(ArrayHelper::map(ArrayHelper::map($input, 'slug', 'model'), 'item_id', 'data'), function($e){ return !empty($e->multitour) ? $e->multitour : [];});

         $countType_arr = array(1 => 0, 2 => 0, 3 => 0, 4 => 0,5 => 0, 6 => 0);          
            
            foreach ($countType as $value) {
                foreach ($value as $v) {
                    if($v === '1'){
                        $countType_arr[1]++;
                    }
                    if($v === '2'){
                        $countType_arr[2]++;
                    }
                    if($v === '3'){
                        $countType_arr[3]++;
                    }
                    if($v === '4'){
                        $countType_arr[4]++;
                    }
                    if($v === '5'){
                        $countType_arr[5]++;
                    }
                    if($v === '6'){
                        $countType_arr[6]++;
                    }
                   
                    
                }
            }
            $countType = $countType_arr;
            
        return $countType;    
    }

     public function getNumberFilterRegion($input){
        $countRegion = ArrayHelper::getColumn(ArrayHelper::map(ArrayHelper::map($input, 'slug', 'model'), 'item_id', 'data'), function($e){ return !empty($e->region) ? $e->region : [];});
            $nord = 0;
            $centre = 0;
            $sud = 0;
            $est = $littoral = $ouest = 0;
            foreach ($countRegion as $value) {
                foreach ($value as $v) {
                    if(strtolower($v) == 'nord'){
                        $nord++;
                    }
                    if(strtolower($v) == 'centre'){
                        $centre++;
                    }
                    if(strtolower($v) == 'sud'){
                        $sud++;
                    }
                    if(strtolower($v) == 'est'){
                        $est++;
                    }
                    if(strtolower($v) == 'littoral'){
                        $littoral++;
                    }
                    if(strtolower($v) == 'ouest'){
                        $ouest++;
                    }
                }
            }
             $countRegion = [
                'Nord' => $nord,
                'Centre' => $centre,
                'Sud' => $sud,
                'Est' => $est,
                'Littoral' => $littoral, 
                'Ouest' => $ouest
            ];
        return $countRegion;    
    }


    public function getNumberFilterLength($input){
        $countLength = ArrayHelper::map(ArrayHelper::map($input, 'slug', 'model'), 'item_id','days');
        $day0_4 = 0;
        $day5_11 = 0;
        $day12_16 = 0;
        $day17 = 0;

        foreach ($countLength as $v) {
            if($v <= 4){
                $day0_4++;
            }else if($v >= 5 && $v <= 11){
                $day5_11++;
            }else if($v >= 12 && $v <= 16){
                $day12_16++;
            }else{
                $day17++;
            }
        }
        $countLength = [
            '1-4' => $day0_4,
            '5-11' => $day5_11,
            '12-16' => $day12_16,
            '17' => $day17
        ];  
        return $countLength;
    }
    
//    public function getNumberFilterType($input){
//        $countType = array_count_values(ArrayHelper::map(ArrayHelper::map($input, 'slug', 'model'), 'item_id','category_id'));
//        $countType_null = array(1 => 0, 2 => 0, 3 => 0, 4 => 0,5 => 0, 6 => 0);
//        $countType = $countType + $countType_null;
//        return $countType;    
//    }
//    public function getNumberFilterTypeIdeel($input){
//        $countType = array_count_values(ArrayHelper::map(ArrayHelper::map($input, 'slug', 'model'), 'item_id','category_id'));
//        $countType_null = array(1 => 0, 2 => 0, 3 => 0, 4 => 0,5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);
//        $countType = $countType + $countType_null;
//        // $countType[4] = $countType[8] + $countType[9] + $countType[10] + $countType[11];    
//        return $countType;    
//    }


    // End thong so.
    

    public function getAjaxFilterExclusive($input = []){
        
        
        if(Yii::$app->request->get('country') == NULL && Yii::$app->request->get('type') == Null  && Yii::$app->request->get('region') == Null){
            //var_dump($input);exit;
            if(!empty($input)){
              
                $category_id = ['category_id' => $input['type']];
                if($input['type'] != ''){
                    $fil_type = ['multitour' => $input['type']];
                }else{
                    $fil_type = [];
                }
                
                if($input['country'] != ''){
                    $fil_countries = ['countries'=>$input['country']];
                }else{
                    $fil_countries = [];
                }
            }else{
                $category_id = ['category_id' => ''];
                $fil_countries = [];
                $fil_type = [];
            }
            
            
            $voyage_total = \app\modules\exclusives\api\Catalog::items([
               // 'where' => $category_id,
                'filters' => $fil_countries + $fil_type,
                'pagination' => ['pageSize' => 0]
            ]);
            
            if(count($voyage_total) == 13 || count($voyage_total) == 14){
                $pagesize = count($voyage_total);
            }else{
                $pagesize = 12;
            }
            
           // var_dump($voyage_total);exit;
            if(SEG1.'/'.SEG2 =='formules/itineraire'){
                $voyage = \app\modules\exclusives\api\Catalog::items([
                    'orderBy' => ['order_num'=> SORT_DESC, 'time' => SORT_DESC],
                  //  'where' => $category_id,
                    'filters' => $fil_countries + $fil_type,
                    'pagination' => ['pageSize' => $pagesize]
                ]);
            }elseif(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie'){
                $voyage = \app\modules\exclusives\api\Catalog::items([
                    'orderBy' => ['order_num'=> SORT_DESC, 'time' => SORT_DESC],
                  //  'where' => $category_id,
                    'filters' => $fil_countries + $fil_type,
                    'pagination' => ['pageSize' => 0]
                ]);
            }else{
                if(isset($input['type'])){
                    if($input['type'] == ''){
                        $input['type'] = 0;
                    }
                }else{
                    $input['type'] = 0;
                }
                $voyage = \app\modules\exclusives\api\Catalog::items([
                   // 'orderBy' => ['order_num'=> SORT_DESC, 'time' => SORT_DESC],
                    'orderByCustom' => [new \yii\db\Expression('FIELD (`app_exclusives_items`.`category_id`, '. implode(',', array($input['type'])) .') DESC'), 'order_num' => SORT_DESC ,'time' => SORT_DESC],
                    //'where' => $category_id,
                    'filters' => $fil_countries + $fil_type,
                    'pagination' => ['pageSize' => $pagesize]
                ]);
            }
            
            $totalCount = count($voyage_total);
             
           
             
             
        
        // get number option filter
            // option destionation
                $countCountry = $this->getNumberFilterCountry($voyage_total);
            // option region
                $countRegion = $this->getNumberFilterRegion($voyage_total);
            // end option destination
            
            // option Type
                 
            if(URI == 'formules/itineraire' || $input['country'] == ''){
                //echo 'ok';exit;
                 $totaltour_first = \app\modules\exclusives\api\Catalog::items([
                    
                    'pagination' => ['pageSize' => 0]
                    ]);
                 
                $countType = $this->getNumberFilterType($totaltour_first);
                
            }else if($input['type'] !== ''){
                $totaltour_first = \app\modules\exclusives\api\Catalog::items([
                    'filters' => ['countries'=>$input['country']],
                    'pagination' => ['pageSize' => 0]
                    ]);
                 $countType = $this->getNumberFilterType($totaltour_first);

            }else{     
                $countType = $this->getNumberFilterType($voyage_total);
            }            
        // end
        }else{ 
        
            // Xy ly khi bat dau ton tai ajax get
            
            // xu ly order by
        
            if(Yii::$app->request->get('orderby') !== NULL){

                if(Yii::$app->request->get('orderby') == 'newest-date'){
                   $orderby = ['item_id' => SORT_DESC]; 
                }else{
                    $orderby = ['order_num' => SORT_DESC,'time' => SORT_DESC]; 
                }
            }else{
                
                $orderby = ['order_num' => SORT_DESC,'time' => SORT_DESC ];
                
            }
            
        //xu ly see more
            if(Yii::$app->request->get('see-more') !== NULL){
                $pagesize = Yii::$app->request->get('see-more');
//            }else if(Yii::$app->request->get('page') !== NULL){
//                $pagesize = Yii::$app->request->get('page') * 12;
//            }else if(Yii::$app->request->get('data-page') !== NULL){
//                $pagesize = Yii::$app->request->get('data-page') * 12;
            }else{
                $pagesize = 12;
            }
                
           
                
            // xu ly ajax type
        
        
        
        $type = Yii::$app->request->get('type');
        $typeNoChild = $typeChild = [];
        
        if(!$type || $type == 'all'){
            $filterType = [];
            
        } else {
            foreach (explode('-',$type) as $key => $value) {
               
                if($value <= 6){
                    if( $childrenType = \app\modules\exclusives\models\Category::findOne($value)->children(1)->all()){
                        
                        $typeChild = ArrayHelper::getColumn($childrenType, 'category_id');
                        
                    }else {
                         $typeNoChild[] = intval($value);
                    }
                }    
            }
            $filterType = array_merge($typeChild, $typeNoChild);
            
        }
      //  $filterType = ['category_id' => $filterType];
         $filterType = ['category_id' => '']; // fix filter field multi category
        
        
        $filters_type = [];
        if($type && $type != 'all'){
            if(strpos($type, '-') === false){
                $filters_type = ['multitour' => $type];
            }
            else{
                $filters_type = ['multitour' => ['IN',explode('-',$type)]];
            }
        }
       // var_dump($filters_type);exit;
       
        //$filters = [];
         // xu ly ajax country
        $country = Yii::$app->request->get('country');
        if(!$country || $country == 'all' || count(explode('-', $country)) == 4){
            $filters_country = [];
        } else {
            if(strpos($country, '-') === false){
                $filters_country = ['countries' => $country];
            }
            else{
                $filters_country = ['countries' => ['IN',explode('-',$country)]];
            }
        }

        // xu ly ajax region
        $region = Yii::$app->request->get('region');
        $filters_region = [];
        if($region && $region != 'all' && count(explode('-', $region)) != 6){
            if(strpos($country, '-') === false){
                $filters_region = ['region' => $region];
            }
            else{
                $filters_region = ['region' => ['IN',explode('-',$region)]];
            }
        }
        
         $filters = $filters_country + $filters_region + $filters_type;
        
        // xu ly ajax length
        
//        $length = Yii::$app->request->get('length');
//        if($length == 'all'){
//            $length = '';
//        }
//        if(strpos($length, '-') !== false){
//              $arrLen = explode('-',$length);
//              asort($arrLen);
//              if($arrLen[0]==1) $arrLen[0] = 0;
//              if(count($arrLen) == 4){
//                $filterLen = ['between', 'days', $arrLen[0], end($arrLen)];
//              }
//              if(count($arrLen) == 3){
//                $filterLen = ['or',
//                ['between', 'days', $arrLen[0], $arrLen[1]],
//                ['>=','days', end($arrLen)]  
//                ];
//              }
//              if(count($arrLen) == 2){
//                $filterLen = ['between', 'days', $arrLen[0], $arrLen[1]];
//              }
//        } else {
//            $filterLen = ['>=','days', $length];
//        
//        }
        
        // get TotalTour 
        $totaltour = \app\modules\exclusives\api\Catalog::items([
//                    'where' => ['and',
//                        $filterType,
//                        ],
                    'filters' => $filters,
                    'pagination' => ['pageSize' => 0]
                    ]);
       if(count($totaltour) == 13 || count($totaltour) == 14){
           $pagesize = count($totaltour);
       } 
        
        // xu ly nut xem them  trang truoc see-more-prev
        
            if(Yii::$app->request->get('before-page') !== NULL){
                $before_page = Yii::$app->request->get('before-page') - 1;
                $pagi = ['pageSize' => $pagesize, 'page' => $before_page ];
            }else{
                $pagi = ['pageSize' => $pagesize];
            }    
       
        
        if(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie'){
            
            if(Yii::$app->request->get('before-page') !== NULL){
                $before_page = Yii::$app->request->get('before-page') - 1;
                $pagi = ['pageSize' => 12, 'page' => $before_page ];
            }else{
                $pagi = ['pageSize' => 0];
            }    
            
            $voyage = \app\modules\exclusives\api\Catalog::items([
            //   'orderBy' => ['time' => SORT_DESC],
               'orderBy' => $orderby,
//               'where' => ['and',
//                   $filterType,
//                   ],
               'filters' => $filters,
              //'pagination' => ['pageSize' => $pagesize]
               // 'pagination' => ['pageSize' => 0]    
                'pagination' => $pagi

           ]);
        }else{
            $voyage = \app\modules\exclusives\api\Catalog::items([
            //   'orderBy' => ['time' => SORT_DESC],
               'orderBy' => $orderby,
//               'where' => ['and',
//                   $filterType,
//                   ],
               'filters' => $filters,
              // 'pagination' => ['pageSize' => $pagesize]
                'pagination' => $pagi

           ]);
        }

        
        // get number option filter
            
        
            // option destionation
            
           // if(Yii::$app->request->get('first') !== 'type'){
           //     if(Yii::$app->request->get('first') == 'destination'){
                    $totaltour_country = \app\modules\exclusives\api\Catalog::items([
//                        'where' => ['and',
//                            $filterType,
//                            ],
                        'filters' => $filters_region + $filters_type,
                        'pagination' => ['pageSize' => 0]
                        ]);
                    
                    $countCountry = $this->getNumberFilterCountry($totaltour_country);
                    
                    
                    $totaltour_region = \app\modules\exclusives\api\Catalog::items([
//                        'where' => ['and',
//                            $filterType,
//                            ],
                        'filters' => $filters_country + $filters_type,
                        'pagination' => ['pageSize' => 0]
                        ]);
                    $countRegion = $this->getNumberFilterRegion($totaltour_region);
                    
                    $totaltour_type = \app\modules\exclusives\api\Catalog::items([

                         'filters' => $filters_country + $filters_region,
                        'pagination' => ['pageSize' => 0]
                        ]);
                    
                    $countType = $this->getNumberFilterType($totaltour_type);
        
                $totalCount = count($totaltour);
        }
        
            return ['voyage'=>$voyage,
                    'totalCount'=>$totalCount,
                    'countCountry' => $countCountry,
                    'countLength' => '',
                    'countType' => $countType,
                    'countRegion' => $countRegion
                    ];
       

    }
    
    
  
    
    public function actionIdeesDeVoyageEntreOcean()
    {

        $theParent = Page::get(13);
        $theEntry = \app\modules\programmes\api\Catalog::cat(URI);
        $this->entry = $theEntry;

        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');


        $this->getSeo($theEntry->model->seo);

        $limi = 8;
        
         if(Yii::$app->request->get('type') !== NULL && Yii::$app->request->get('country') !== NULL && Yii::$app->request->get('length') !== NULL){
            $theEntries = $this->getAjaxFilter(['country'=>'','type'=>$theEntry->model->category_id])['voyage'];
           
            $totalCount = $this->getAjaxFilter(['country'=>'','type'=>$theEntry->model->category_id])['totalCount'];
            $numberFilter = $this->getAjaxFilter(['country'=>'','type'=>$theEntry->model->category_id]);
              
        }else{ 
            
            $theEntries = \app\modules\programmes\models\Category::find()
                ->where(['tree' => $theEntry->model->category_id, 'depth' => 1, 'status'=> 1])
                ->limit($limi)
                ->all();
            $totalCount = $this->getAjaxFilter(['country'=>'','type'=>$theEntry->model->category_id])['totalCount'];
            $numberFilter = $this->getAjaxFilter(['country'=>'','type'=>$theEntry->model->category_id]);
        }

        $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);
        $theRaisons_list = $theRaisons->items(['where' => ['category_id' => $theRaisons->model->category_id], 'orderBy' => 'item_id']);
        if(IS_MOBILE){
                $this->totalCount = $totalCount;
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theEntry->slug,
                        'totalCount' => $totalCount,
                        'country' => 'all',
                        'type' => $theEntry->model->category_id,
                        'length' => 'all',
                        'numberFilter' => $numberFilter,
                    ];
            }
        return $this->render(IS_MOBILE ? '//page2016/mobile/idees-de-voyage-entre-ocean' : '//page2016/idees-de-voyage-entre-ocean', [
            'theParent' => $theParent,
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            'limi' => $limi,
            'totalCount' => $totalCount,
            'numberFilter' => $numberFilter,
        ]);
    }

    public function actionIdeesDeVoyageListEntreOcean()
    {

        $theRoot = Page::get(13);
        
        $theEntry = \app\modules\programmes\api\Catalog::cat(URI);
        
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');


        $this->countTour = count(\app\modules\programmes\api\Catalog::items([
            //'filters' => ['category_id' => $theEntry->model->category_id],
            'where' => ['category_id' => $theEntry->model->category_id, 'status' => 1],
            'pagination' => ['pageSize' => 0],

        ]));
         $this->getSeo($theEntry->model->seo);
       
            $process = $this->getAjaxFilter(['country'=>'', 'type'=>$theEntry->model->category_id]);
         
            $theEntries = $process['voyage'];
            $totalCount = $this->countTour;
            $numberFilter = $process;
        
        $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 8, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;    
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
            
        if(IS_MOBILE){
                $this->totalCount = $totalCount;
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theEntry->slug,
                        'totalCount' => $totalCount,
                        'country' => 'all',
                        'type' => 4,
                        'length' => 'all',
                        'numberFilter' => $numberFilter,
                    ];
            }
        $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);
        $theRaisons_list = $theRaisons->items(['where' => ['category_id' => $theRaisons->model->category_id], 'orderBy' => 'item_id']);

        return $this->render(IS_MOBILE ? '//page2016/mobile/idees-de-voyage-list-entre-ocean' : '//page2016/idees-de-voyage-list-entre-ocean', [
            'theRoot' => $theRoot,
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            //'limi' => $limi,
            'totalCount' => $totalCount,
            'numberFilter' => $numberFilter,
        ]);
    }

    public function actionExtensionExclusivesTourSingle(){
    $theProgram = Yii::$app->session->get('the-programes-tours-single');
    return $this->renderPartial('//page2016/extension-exclusives-tour-single', ['theProgram' => $theProgram, 'location' => Yii::$app->session->get('location')]);

}
   
    public function actionIdeesDeVoyageSingle() {
        
        if(\app\modules\destinations\api\Catalog::get(URI)){
            return Yii::$app->runAction('amica-fr/nos-destinations-country-ideel-type');
        }
        
        if(Yii::$app->request->isAjax && IS_MOBILE){
            if(Yii::$app->request->post('type') == 'formules'){
                $theProgram = Yii::$app->session->get('the-programes-tours-single');
                $location = Yii::$app->session->get('location');  
                return $this->renderPartial('//page2016/mobile/idees-de-voyage-single',[
                    'theProgram' => $theProgram,
                    'location' => $location ,
                    'type' => 'formules'
                ]);
            }

            if(Yii::$app->request->post('type') == 'combien'){
                $infos_pratiques = Yii::$app->session->get('infos_pratiques');
                return $this->renderPartial('//page2016/mobile/idees-de-voyage-single',[
                    'infos_pratiques' => $infos_pratiques,
                    'type' => 'combien'
                ]);
            }
        }
    Yii::$app->cache->delete('cache-tour-'.SEG1.'-'.SEG3);    
    if(!Yii::$app->cache->get('cache-tour-'.SEG1.'-'.SEG3)){
        $theEntry = \app\modules\programmes\api\Catalog::get(URI);
        
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        if(isset( $theEntry->data->price)){
            $mainImg = 'https://www.amica-travel.com'.$theEntry->photosArray['banner'][0]->image;
            $title = $theEntry->title;
            $subTt = $theEntry->model->sub_title;
            $catName  = $theEntry->cat->title;
            $price = $theEntry->data->price;
            preg_match('/([\d\.]+)(?:€|\&euro;)/', $price, $matches);
            $price = isset($matches[1]) ? $matches[1] : '';

            $jsSeoPrice = '
            <script type="application/ld+json">
            {
              "@context": "http://schema.org",
              "@type": "Product",
              "image": "{{mainImg}}",
              "name": "{{title}}",
              "description": "{{subTt}}",
              "category": "{{catName}}",
              "brand": "Amica Travel",
              "offers": {
                 "@type": "AggregateOffer",
                 "lowPrice": "{{price}}",
                 "availability": "InStock",
                 "priceCurrency": "EUR"
             }
         }
         </script>
         ';
         $jsSeoPrice = str_replace(['{{mainImg}}', '{{title}}', '{{subTt}}', '{{catName}}', '{{price}}'], [$mainImg, $title, $subTt, $catName, $price], $jsSeoPrice);
         $this->priceSeo = $jsSeoPrice;
     }    
     if($theEntry->category_id == 7) $this->notBannerRight = true;
     $theRoot = Page::get(13); 
     $theParent = \app\modules\programmes\api\Catalog::cat($theEntry->category_id);

     $theParent_parent = \app\modules\programmes\models\Category::find()
     ->where(['category_id'=>$theParent->tree])
     ->one();
     if($theParent_parent->category_id == 4){
        $view = '//page2016/idees-de-voyage-entre-ocean-single';
       // return Yii::$app->runAction('amica-fr/idees-de-voyage-entre-ocean-single');

    }elseif($theParent_parent->category_id == 5){

        $view = '//page2016/idees-de-voyage-croisiere-single';

    }else{

        $view = '//page2016/idees-de-voyage-single';
    }
    if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');

    
         //add a view program to projet
    if(Yii::$app->session->get('projet'))
        $projet = Yii::$app->session->get('projet');
    else $projet = [
        'programes'=> ['select'=>[], 'view'=>[]],
        'exclusives' => ['select'=>[], 'view'=> []]
    ];
    if(!in_array($theEntry->model->item_id, $projet['programes']['view']) && !in_array($theEntry->model->item_id, $projet['programes']['select']))
      $projet['programes']['view'][] = $theEntry->model->item_id;
  Yii::$app->session->set('projet',$projet);

  $theProgram = [];

  $pro = '';
  if($theEntry->model->exclusives != ''){
    $pro = explode(',', $theEntry->model->exclusives);

    foreach ($pro as $p) {
     $item = \app\modules\exclusives\api\Catalog::get($p);
     if($item)
        $theProgram[] = $item;
    }
    }
    $arrSuggest = [];
    //var_dump(\app\modules\programmes\api\Catalog::get(5));exit;
    //var_dump($theEntry->data->suggest);exit;
    if(!empty($theEntry->data->suggest)){
        foreach ($theEntry->data->suggest as $i){
           // var_dump($i);exit;
            $item_suggest = \app\modules\programmes\api\Catalog::get(floatval($i));
            if($item_suggest){
                $arrSuggest[] = $item_suggest;
            }
        }
    }
    //var_dump($arrSuggest);exit;
    
    $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
    $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();

    $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);

    $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');
    $dataNotes = \app\modules\libraries\api\Catalog::items(['where' => ['category_id' => [14,15,16]], 'pagination' => ['pageSize' => 0]]);
    $listParent_exclusivites = \app\modules\exclusives\api\Catalog::cats();
    $listParent_exclusivites = \yii\helpers\ArrayHelper::map($listParent_exclusivites, 'category_id','title');

    $infos_pratiques = \app\modules\libraries\api\Catalog::items(['where'=>['category_id'=>18],'pagination' => ['pageSize'=>0],'orderBy'=>'item_id']);
    
    $illus = \app\modules\libraries\api\Catalog::get('ilus-voyage/'.SEG1.'/'.explode('/',$theEntry->cat->slug)[1]);
    $cmcb = \app\modules\libraries\api\Catalog::cat('infos_pratiques')->items();

    $dataAll = ['allCountries' => $allCountries,
    'allDialCodes' => $allDialCodes,
    'theEntry'=> $theEntry,
    'theRoot'=> $theRoot,
    'theParent_parent' => $theParent_parent,
    'theParent'=> $theParent,
    'theProgram' => $theProgram,
    'listParent_exclusivites' => $listParent_exclusivites,
    'location' => $location,
    'notes' =>$dataNotes,
    'data' =>$theEntry,
    'infos_pratiques' => $infos_pratiques,
    'destination' => $this->getBreadCrumb('destination'),
    'breadcrumb_3' => $this->getBreadCrumb('breadcrumb-3'),
    'breadcrumb_4' => $this->getBreadCrumb('breadcrumb-4'),
    'cmcb' => $cmcb,
    'illus' => $illus->photosArray['icon'],
    'view' => $view,
    'arrSuggest' => $arrSuggest,    
    ];
    Yii::$app->cache->set('cache-tour-'.SEG1.'-'.SEG3, $dataAll); 
    } else{
        $dataAll = Yii::$app->cache->get('cache-tour-'.SEG1.'-'.SEG3);     
    } 
    if(Yii::$app->request->isAjax){
            if(Yii::$app->request->post('type') == 'combien'){
                $cmcb = $dataAll['cmcb'];
                return $this->renderPartial('//page2016/idees-de-voyage-single',[
                    'cmcb' => $cmcb,
                    'theEntry' => $dataAll['theEntry'],
                    'type' => 'combien'
                ]);
            }
    }
    Yii::$app->session->set('the-programes-tours-single', $dataAll['theProgram']); 
    Yii::$app->session->set('location',  $dataAll['location']);    
    Yii::$app->session->set('infos_pratiques', $dataAll['infos_pratiques']);
    $view = IS_MOBILE ? str_replace('//page2016/', '//page2016/mobile/', $dataAll['view']) : $dataAll['view'];
    $this->getSeo($dataAll['theEntry']->model->seo);
    $this->entry = $dataAll['theEntry'];
    return $this->render($view, $dataAll);
}
    
    public function actionIdeesDeVoyageEntreOceanSingle() {

 $root = Page::get(13); 

 $theEntry = \app\modules\programmes\api\Catalog::get(URI);
 $this->entry = $theEntry;
 if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
 $this->getSeo($theEntry->model->seo);
    $cmcb = \app\modules\libraries\api\Catalog::cat('infos_pratiques')->items();
    if(Yii::$app->request->isAjax){
            if(Yii::$app->request->post('type') == 'combien'){
                return $this->renderPartial('//page2016/idees-de-voyage-single',[
                    'cmcb' => $cmcb,
                    'theEntry' => $theEntry,
                    'type' => 'combien'
                ]);
            }
    }
            //$countries = \app\modules\destinations\models\Category::find()->roots()->all();
 $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);

 $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');

 $listParent_exclusivites = \app\modules\exclusives\api\Catalog::cats();
 $listParent_exclusivites = \yii\helpers\ArrayHelper::map($listParent_exclusivites, 'category_id','title');

 $theProgram = [];

 $pro = '';
 if($theEntry->model->exclusives != ''){
    $pro = explode(',', $theEntry->model->exclusives);

    foreach ($pro as $p) {
                   // $p = explode('/', $p);
        $theProgram[] = \app\modules\exclusives\api\Catalog::get($p);
    }
}


$allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
$allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();

$model = new ContactForm;
if (IS_MOBILE) {
    $model = new ContactFormMobile;
    $model->scenario = 'contactce_mobile';
} else {
    $model->scenario = 'contactce';
}


$model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
$model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
$rootTour  = \app\modules\programmes\api\Catalog::cat(4);
$illus = \app\modules\libraries\api\Catalog::get('ilus-voyage/'.SEG1.'/'.explode('/',$rootTour->slug)[1]);

return $this->render(IS_MOBILE ? '//page2016/mobile/idees-de-voyage-entre-ocean-single' : '//page2016/idees-de-voyage-entre-ocean-single',[
    'model' => $model,
    'allCountries' => $allCountries,
    'allDialCodes' => $allDialCodes,
    'root'=> $root,
    'theEntry'=> $theEntry,
    'location' => $location,
    'theProgram' => $theProgram,
    'listParent_exclusivites' => $listParent_exclusivites,
    'infos_pratiques' => [],
    'destination' => $this->getBreadCrumb('destination'),
    'breadcrumb_3' => $this->getBreadCrumb('breadcrumb-3'),
    'breadcrumb_4' => $this->getBreadCrumb('breadcrumb-4'),
    'cmcb' => $cmcb,
    'illus' => $illus->photosArray['icon']
]);
}
    
    public function actionRechercheIdeesDeVoyage()
    {
        $theEntry = \yii\easyii\modules\page\api\Page::get(URI);
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        $this->update_meta = $this->getDataUpdateMeta();
        
        $getAjaxFilter = $this->getAjaxFilter();
        
        $voyage = $getAjaxFilter['voyage'];
        $totalCount = $getAjaxFilter['totalCount'];
        $numberFilter = $getAjaxFilter;
        
        $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
        
        if(IS_MOBILE){
            $this->totalCount = $totalCount;
            $this->arr_option_filter_voyage_mobile = [
                    'title_filter' => $theEntry->model->seo->h1 ,
                    'namefilter' => 'filter_voyage',
                    'uri' =>$theEntry->slug,
                    'totalCount' => $totalCount,
                    'country' => 'all',
                    'type' => 'all',


                    'length' => 'all',
                    'numberFilter' => $numberFilter,
                ];
        }
        $dataLoc = \app\modules\libraries\models\Category::findOne(['slug' => 'locations'])->children()->with('items')->asArray()->all();
        $locationsLib = [];
        foreach ($dataLoc as $key => $value) {
            $locationsLib += ArrayHelper::map($value['items'], 'slug', 'title');
        }
        $theRaisons = \app\modules\whoarewe\api\Catalog::cat(2);
        $theRaisons_list = $theRaisons->items(['category_id' => $theRaisons->model->category_id]);

        return $this->render(IS_MOBILE ? '//page2016/mobile/recherche-idees-de-voyage' : '//page2016/recherche-idees-de-voyage', [
            'theEntry' => $theEntry,
            'voyage' => $voyage,
            'totalCount' => $totalCount,
            'locationsLib' => $locationsLib,
            'theRaisons' => $theRaisons,
            'theRaisons_list' => $theRaisons_list,
            'numberFilter' => $numberFilter,
        ]);
    }



    public function actionDevisBooking(){
        if(!$_POST){
            Yii::$app->session->set('backUrl', Yii::$app->request->referrer);
        }
        $this->layout = 'main-form';
        if(IS_MOBILE){
            $this->layout = 'mobile-form';
        }
        $theEntry = \app\modules\programmes\api\Catalog::get(preg_replace('/\/form$/', '', URI));
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        $parents = $theEntry->parents();
        if($parents){
            if($parents[0]->category_id == 5 || $parents[0]->category_id == 4){
                     return Yii::$app->runAction('amica-fr/contact-booking');
            }
        }

        if (Yii::$app->request->isAjax) {
        // select option extension
            if(Yii::$app->request->post()['type'] == 'selected'){
              $name = Yii::$app->request->post()['extension'];
              
              if(Yii::$app->session->get('data_extension'))
                $data_extension = Yii::$app->session->get('data_extension');
              else $data_extension = [];
              if(!in_array($name, $data_extension))
                  $data_extension[$name] = $name;
//              if(($key = array_search($progId, $projet['programes']['view'])) !== false) {
//                      unset($projet['programes']['view'][$key]);
//              }
              Yii::$app->session->set('data_extension',$data_extension);
              
            }
            //remove select option extension
            if(Yii::$app->request->post()['type'] == 'remove-selected'){
              $name = Yii::$app->request->post()['extension'];
              
              if(Yii::$app->session->get('data_extension'))
                $data_extension = Yii::$app->session->get('data_extension');
              //else $data_extension = [];
                unset($data_extension[$name]);

              Yii::$app->session->set('data_extension',$data_extension);
              
            }
        }
        
            

        
        
        $theProgram = [];
        $pro = '';
        if($theEntry->model->exclusives != ''){
            $pro = explode(',', $theEntry->model->exclusives);
            
            foreach ($pro as $p) {
                if(\app\modules\exclusives\api\Catalog::get($p))
                    $theProgram[] = \app\modules\exclusives\api\Catalog::get($p);
            }
        }
        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();
        $model = new DevisForm;
        $model->scenario = 'booking';
        if(IS_MOBILE){
            $model = new DevisFormMobile;
            $model->scenario = 'mobileBooking';
        }
        $model->extension = Yii::$app->session->get('data_extension');
        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        if ($model->load($_POST) && $model->validate()) {
            
                $model->tourName = $theEntry->title;
                $model->tourUrl = 'https://www.amica-travel.com/'.$theEntry->slug;
                
                $data2 = $this->processingDataAllForm($model);

                $data = [
                            // 'firstname' => $model->fname,
                           // 'lastname' => $model->lname,
                            'fullName' => $model->fullName,
                            'codecontry' => $model->country,
                            'sex' => $model->prefix
                        ];
            if($model->newsletter)
                    $data = [
                    // 'firstname' => $model->fname,
                    // 'lastname' => $model->lname,
                     'fullName' => $model->fullName,
                    'codecontry' => $model->country,
                    'source' => 'newsletter',
                    'sex' => $model->prefix,
                    'newsletter_insc' => date('d/m/Y'),
                    'statut' => 'prospect',
                    'birmanie' => false,
                    'vietnam' => false,
                    'cambodia' => false,
                    'laos' => false
                ];
                $listID = $model->newsletter ? 1688900 : 1711181;
                $this->addContactToMailjet($model->email, $listID, $data);
            // Email me
            
            $this->notifyAmica('Devis from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
            $this->confirmAmicaDevis($model->email, ['reasonEmail' => 'contact', 'name' => $model->prefix.' '.$model->fullName, 'data' => $model, 'tourName' => $theEntry->title, 'entry' => $theEntry]);
                
                if(IS_MOBILE){
                

                    

//                $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//                $model->lname = '';
//                if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                    $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//                }
                if (!$model->has_date) {
                    $model->departureDate = null;
                    $model->tourLength = null;
                }
                $contact = '';
                if ($model->contactEmail) $contact .= $model->email;
                if ($model->contactEmail && $model->contactPhone) $contact .= ' ,';
                if ($model->contactPhone) $contact .= $model->phone;
                
        

                $this->saveInquiry($model, 'Form-booking-mobile', $data2);
            }else{
               
         
                $this->saveInquiry($model, 'Form-booking', $data2);
            }
            
            Yii::$app->session->set('sex', $model->prefix);
            Yii::$app->session->set('name', $model->fullName);
            return Yii::$app->response->redirect(DIR.'merci?from=booking&id='.$this->id_inquiry);
        }
        $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);
           
        $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');
        Yii::$app->session->set('the-programes-tours-single', $theProgram); 
        Yii::$app->session->set('location', $location);    
        return $this->render(IS_MOBILE ? '//page2016/mobile/devis-booking-mobile' : '//page2016/devis-booking',[
                    'model' => $model,
                    'allCountries' => $allCountries,
                    'allDialCodes' => $allDialCodes,
                    'theEntry'=> $theEntry,
                    'theProgram' => $theProgram,
        ]);
    }

//    public function actionContactBooking(){
//        $this->layout = 'main-form';
//        if (IS_MOBILE){
//            $this->layout = 'mobile-form';
//        }
//        $formName = 'Form-contactbc';
//        $from = 'contact_bc';
//        if(SEG2=='formules'){
//            $theEntry = \app\modules\exclusives\api\Catalog::get(preg_replace('/\/form$/', '', URI));
//            $formName = 'Form-contactsa';
//            $from = 'contact_sa';
//        } else 
//            $theEntry = \app\modules\programmes\api\Catalog::get(preg_replace('/\/form$/', '', URI));
//        $this->entry = $theEntry;
//        $this->getSeo($theEntry->model->seo);
//        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
//        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
//        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();
//
//        $model = new ContactForm;
//        $model->scenario = 'contactce';
//        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
//        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
//
//        if ($model->load($_POST) && $model->validate()) {
//            if(IS_MOBILE){
//                    $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//                    $model->lname = '';
//                    if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                        $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//                    }
//$data2 =<<<'TXT'
//Tour name: {{ tourUrl : $tourUrl }}    
//Votre nom & prénom: {{ fullname : $fullName }}
//Votre adresse mail: {{ email : $email }}
//Votre pays: {{ country : $country }}
//Département, Votre ville: {{ region : $region }} {{ ville : $ville }}
//Votre message: {{ message : $message }}
//Souhaitez-vous recevoir une proposition de programme avec devis personnalisé sur d'autres régions du pays ?: {{ question : $question }}
//Si vous êtes recommandé(e) par un ancien client d'Amica, merci de préciser son nom et prénom: {{ reference : $reference }}  
//Newsletter: {{ newsletter : $newsletter }}
//TXT;
//                    $data2 = str_replace([
//                    '$tourUrl', '$prefix', '$fullName', '$email', '$country', '$region', '$ville','$message', '$reference', '$newsletter'
//                    ], [
//                    '<a href="https://www.amica-travel.com/' . $theEntry->slug . '">' . $theEntry->title . '</a>', $model->prefix, $model->fullName, $model->email, $model->country, $model->region, $model->ville, $model->message, $model->reference, $model->newsletter
//                    ], $data2);
//                    // Save db
//                    $this->saveInquiry($model, 'Form-contact-mobile', $data2);    
//                    
//                    if ($model->newsletter) {
//                $data = [
//                    'fname' => $model->fname,
//                    'lname' => $model->lname,
//                    'codecontry' => $model->country,
//                    'source' => 'newsletter',
//                    'sex' => $model->prefix,
//                    'newsletter_insc' => date('d/m/Y'),
//                    'statut' => 'prospect',
//                    'birmanie' => false,
//                    'vietnam' => false,
//                    'cambodia' => false,
//                    'laos' => false
//                ];
//
//                $this->addContactToMailjet($model->email, '1688900', $data);
//            }
//
//
//                } else {
//            $data2 = <<<'TXT'
//Tour name: {{ tourUrl : $tourUrl }}   
//Votre nom et prénom: {{ prefix : $prefix }} {{ fname : $fname }} {{ lname : $lname }}
//Votre adresse mail: {{ email : $email }}
//Votre pays: {{ country : $country }}
//Département, Votre ville: {{ region : $region }} {{ ville : $ville }}
//Votre message: {{ message : $message }}
//Souhaitez-vous recevoir une proposition de programme avec devis personnalisé sur d'autres régions du pays ?: {{ question : $question }}
//Si vous êtes recommandé(e) par un ancien client d'Amica, merci de préciser son nom et prénom: {{ reference : $reference }}
//TXT;
//                $data2 = str_replace([
//                    '$tourUrl', '$prefix', '$fname', '$lname', '$email', '$country', '$region', '$ville', '$message', '$question', '$reference'
//                    ], [
//                    '<a href="https://www.amica-travel.com/'.$theEntry->slug.'">'.$theEntry->title.'</a>', $model->prefix, $model->fname, $model->lname, $model->email, $model->country, $model->region, $model->ville, $model->message, $model->question, $model->reference
//                    ], $data2);
//                // Save db
//                $this->saveInquiry($model, $formName, $data2);
//            if($model->newsletter){
//                $data = [
//                        'firstname' => $model->fname,
//                        'lastname' => $model->lname,
//                        'codecontry' => $model->country,
//                        'source' => 'newsletter',
//                        'sex' => $model->prefix,
//                        'newsletter_insc' => date('d/m/Y'),
//                        'statut' => 'prospect',
//                        'birmanie' => false,
//                        'vietnam' => false,
//                        'cambodia' => false,
//                        'laos' => false
//                    ];
//                $this->addContactToMailjet($model->email, '1688900', $data);
//             }
//         }
//            // Email me
//            $this->notifyAmica('Contact from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
//            $this->confirmAmica($model->email);
//            // Redir
//
//            return Yii::$app->response->redirect(DIR.'merci?from='.$from.'&id='.$this->id_inquiry);
//        }
//        return $this->render(IS_MOBILE ? '//page2016/mobile/contact-booking-mobile' : '//page2016/contact-booking',[
//                    'model' => $model,
//                    'allCountries' => $allCountries,
//                    'allDialCodes' => $allDialCodes,
//                    'theEntry'=> $theEntry,
//        ]);
//    }
    
    public function actionContactBooking()
    {
        if(!$_POST){
            Yii::$app->session->set('backUrl', Yii::$app->request->referrer);
        }
        $this->layout = 'main-form';
        if (IS_MOBILE){
            $this->layout = 'mobile-form';
        }
        
        
        $formName = 'Form-contactbc';
        $from = 'contact_bc';
        if (SEG2 == 'formules') {
            $theEntry = \app\modules\exclusives\api\Catalog::get(preg_replace('/\/form$/', '', URI));
            $formName = 'Form-contactsa';
            $from = 'contact_sa';
        } else
            $theEntry = \app\modules\programmes\api\Catalog::get(preg_replace('/\/form$/', '', URI));
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();

        $model = new DevisForm;
        $model->scenario = 'contact_booking';
        if(IS_MOBILE){
            $model = new DevisFormMobile;
            $model->scenario = 'mobile_contact_booking';
        }
        
        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';

        if ($model->load($_POST) && $model->validate()) {
            
            $model->tourName = $theEntry->title;
            $model->tourUrl = 'https://www.amica-travel.com/'.$theEntry->slug;

            $data2 = $this->processingDataAllForm($model);

            $data = [
                           // 'firstname' => $model->fname,
                           // 'lastname' => $model->lname,
                            'fullName' => $model->fullName,
                            'codecontry' => $model->country,
                            'sex' => $model->prefix
                        ];
            if($model->newsletter)
            $data = [
               // 'firstname' => $model->fname,
              //  'lastname' => $model->lname,
                'fullName' => $model->fullName,
                'codecontry' => $model->country,
                'source' => 'newsletter',
                'sex' => $model->prefix,
                'newsletter_insc' => date('d/m/Y'),
                'statut' => 'prospect',
                'birmanie' => false,
                'vietnam' => false,
                'cambodia' => false,
                'laos' => false
            ];
            $listID = $model->newsletter ? 1688900 : 1711181;
            $this->addContactToMailjet($model->email, $listID, $data);
            // Email me
            $this->notifyAmica('Contact from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
            $this->confirmAmicaDevis($model->email, ['reasonEmail' => 'contact', 'name' => $model->prefix.' '.$model->fullName, 'data' => $model, 'tourName' => $theEntry->title, 'entry' => $theEntry]);
            
            if(IS_MOBILE){
//                $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//                $model->lname = '';
//                if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                    $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//                }
                if (!$model->has_date) {
                    $model->departureDate = null;
                    $model->tourLength = null;
                }
                $contact = '';
                if ($model->contactEmail) $contact .= $model->email;
                if ($model->contactEmail && $model->contactPhone) $contact .= ' ,';
                if ($model->contactPhone) $contact .= $model->phone;
                
       

                    // Save db
                    $this->saveInquiry($model, 'Form-contact-mobile', $data2);    
                } else {

                // Save db
                $this->saveInquiry($model, $formName, $data2);
                }
            
            // redirect
             Yii::$app->session->set('sex', $model->prefix);
            Yii::$app->session->set('name', $model->fullName);
            return Yii::$app->response->redirect(DIR . 'merci?from=' . $from . '&id=' . $this->id_inquiry);
        }
        return $this->render(IS_MOBILE ? '//page2016/mobile/contact-booking-mobile' : '//page2016/contact-booking', [
            'model' => $model,
            'allCountries' => $allCountries,
            'allDialCodes' => $allDialCodes,
            'theEntry' => $theEntry,
        ]);
    }
    
    
      public function actionNosDestinations() {
        $theEntry = \yii\easyii\modules\page\api\Page::get('destinations');
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        
      
        $countries = \app\modules\destinations\models\Category::find()->roots()->orderBy('order_num DESC')->all();
        
        // 3 tour secrets on top
        $modules_exclusive = \app\modules\modulepage\api\Catalog::get('decouvrir-nos-secrets-dailleurs'); // id 22
                    
        $voyage = \app\modules\programmes\models\Category::find()->roots()->orderBy('order_num ASC')->all();
        
        
        // BLOGS
        $arrBlog = array();
        if(!Yii::$app->cache->get('cache-blog-destinations-002')){
            if(isset(\app\modules\modulepage\api\Catalog::get('destinations/blog')->data->blogs)) {
                $dataBlogSelected = \app\modules\modulepage\api\Catalog::get('destinations/blog')->data->blogs;
                foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                    $arrBlog[] = $this->getDataPost($valueBlog);
                    
                    foreach ($arrBlog as $key2 => $value2) {
                        $categoryId = $value2['categories'][0];
                        $featuredMediaId = $value2['featured_media'];

                        $titleCategory = $this->getCategoryName($categoryId)['name'];
                        $arrBlog[$keyBlog]['cat_name'] = $titleCategory;
                        $arrBlog[$keyBlog]['alt_text'] = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['alt_text'];
                        $featuredMediaData = $this->getFeatureImage($featuredMediaId)['media_details']['sizes']['barouk_list-thumb'];
                        $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=300&h=200&zc=1&q=80';
                    }
                }
            }
            Yii::$app->cache->set('cache-blog-destinations-002', $arrBlog);
        }else{
            $arrBlog = Yii::$app->cache->get('cache-blog-destinations-002');
            
        }    

        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations' : '//page2016/nos-destinations', [
            'theEntry' => $theEntry,
            'countries' => $countries,
            'modules_exclusive' => $modules_exclusive,
            'voyage' => $voyage,
            'arrBlog' => $arrBlog,
                ]);
    }

    public function getMoreVisiterMobile($locations, $totalCount){
        $visiter = $locations->items(['pagination' => ['pageSize' => 4]]);
            $showMore = true;
            if(($totalCount/4) <= Yii::$app->request->get('page') ) $showMore = false;
            $html = '<div class="clear-fix tour-item"><a data-ajax="false" href="{{slug}}"><img alt="{{description-img}}" src="/thumb/660/440/1/80{{image}}" data-srcset="/thumb/660/440/1/80{{image}}" data-sizes="auto" class="banner-img lazyload" /><div class="text-on-image"><h3 class="tt-title tt-fontsize-32 tt-latolatin-semibold tt-color-white tt-uppercase">{{title}}</h3><p class="tt-fontsize-28 tt-latolatin-regular tt-color-white">{{sub-title}}</p></div></a></div>';
            $content = '';
            foreach ($visiter as $key => $value) :
                $v = '';
                if(isset($value->photosArray['banner'])){
                    $v = $value->photosArray['banner'][0];
                } 
                $sumT =  $value->model->sub_title ? $value->model->sub_title : $value->title;
                $content .= str_replace(['{{slug}}', '{{description-img}}', '{{image}}', '{{sub-title}}', '{{title}}'], [DIR.$value->slug, $v->description, $v->image, $sumT, $value->model->title], $html);  
            endforeach;
            return \yii\helpers\Json::encode(['content' => $content, 'showMore' => $showMore ]);
    }

    public function actionNosDestinationsType() {

        $checkItem = \app\modules\destinations\api\Catalog::get(URI);
        if($checkItem){
            if(strpos($checkItem->cat->slug, 'visiter' ) !== false){
                return Yii::$app->runAction('amica-fr/nos-destinations-detaile');
            }
            if(strpos($checkItem->cat->slug, 'envies')){
                return Yii::$app->runAction('amica-fr/nos-destinations-envies');
            }
        }
        if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->post()['type'] == 'des'){
                $locationAjax = \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter');
                return $this->renderPartial('//page2016/ajax/des-ajax', ['locations' => $locationAjax, 'enviesLib' => $this->getEnviesLib()]);

            }
             if(Yii::$app->request->post()['type'] == 'prog'){
                 $programes = \app\modules\programmes\api\Catalog::items(['filters' => ['country' => 'Vietnam']]);
                return $this->renderPartial('//page2016/ajax/prog-ajax', ['programes' => $programes]);

            }
        }
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        $this->entry = $theEntry;
         // var_dump($theEntry->model->photos);exit;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        //get data info-pratiques VN
        $infos = \app\modules\destinations\models\Category::findOne(['slug'=>SEG1.'/informations-pratiques']);
        //lay cac muc lon info-pratic
        if($infos) {
            $infosChild = $infos->children()->all();
        } else $infosChild = [];
        //get data guide
        $guide = \app\modules\destinations\models\Category::findOne(['slug'=>SEG1.'/guide']);
        //lay cac muc lon guide
        $guideChild  = [];
        if($guide)
             $guideChild = $guide->children(1)->andWhere(['status' => 1])->all();
        // lay du lieu cua site a visiter VN
        $locations = \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter');
         $pagi = new \yii\data\Pagination(['totalCount' => count($locations->items(['pagination' => ['pageSize' => 0]])), 'defaultPageSize' => 4]);
        if(SEG2 == 'visiter') $this->pagination = $pagi->pageCount;
        // lay du lieu cua cac exclusives VN
        //array tat ca cac dia danh o VN
        $locationVietnam = \app\modules\libraries\api\Catalog::cat(SEG1)->items();

        $locationVietnam = \yii\helpers\ArrayHelper::getColumn($locationVietnam, 'slug');
        // exclusives Viet Nam
        $exclusives = \app\modules\exclusives\api\Catalog::items(['filters' => ['locations' => ['IN', $locationVietnam]]]);
        //programes viet nam

        $programes = \app\modules\programmes\api\Catalog::items(['filters' => ['country' => ucfirst(SEG1)]]);
        Yii::$app->session->set('countVnProg', count($programes));
        $itemVoyage =  \app\modules\destinations\api\Catalog::get('idees-de-voyage-'.SEG2);

       
        return $this->render('//page2016/nos-destinations-type',
                [
                    'theEntry' => $theEntry,
                    'infos' => $infos,
                    'infosChild' => $infosChild,
                    'guide' => $guide,
                    'guideChild' => $guideChild,
                    'locations' => $locations, 
                    'exclusives' => $exclusives, 
                    'programes' => $programes,
                    'itemVoyage' => $itemVoyage,
                    'enviesLib' => $this->getEnviesLib()
                ]
            );
    }

    public function actionNosDestinationsCountry(){
        
        $timecountdown = strtotime("2019-02-01 12:20:00"); // UTC vn - 7
        $current = strtotime('now');
        
        if($timecountdown > $current){
            Yii::$app->cache->delete('activeSearch-'.SEG1);
        }
        if(!Yii::$app->cache->get('activeSearch-'.SEG1)){
            $typeTour = [];

            $lenghTour = [];
            $type = \app\modules\programmes\api\Catalog::items([
                'filters' => ['countries' => SEG1],
                'pagination' => ['pageSize' => 0]
            ]);           
            foreach($type as $key => $value){
                $parent = $value->cat->parents()->all();
                if($parent){
                    $typeTour[$parent[0]->category_id] =  $parent[0]->title;
                } else 
                    $typeTour[$value->cat->category_id] = $value->cat->title;

                if($value->model->days <= 4){
                    $lenghTour['1-4'] = 'Moins d\'une semaine';
                } else if($value->model->days >= 5 && $value->model->days <= 11 ){
                    $lenghTour['5-11'] = '1 semaine';
                } else if($value->model->days >= 12 && $value->model->days <= 16 ){
                    $lenghTour['12-16'] = '2 semaines';
                    
                } else if($value->model->days >= 17){
                    $lenghTour['17'] = '3 semaines';
                }
            }
            ksort($lenghTour);
            $activeSearch = ['tour' => $typeTour, 'length' => $lenghTour];
            Yii::$app->cache->set('activeSearch-'.SEG1, $activeSearch);
        } else $activeSearch = Yii::$app->cache->get('activeSearch-'.SEG1);

        // Yii::$app->cache->flush();
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        $countVnTours =  $this->actionGetNumberProg(SEG1);
        $tourType = \app\modules\destinations\api\Catalog::cat(SEG1.'/itineraire');
        $infos = \app\modules\destinations\models\Category::findOne(['slug' => SEG1.'/informations-pratiques'])->children(1)->andWhere('on_top != "" AND on_top != "0"')->orderBy('on_top ASC')->all();
        $secretType = \app\modules\destinations\api\Catalog::cat(SEG1.'/formules');

        $dataTemoignageItems = array();
        $arrBlog = array();

        // Temoignages
        
        
        $timecountdown = strtotime("2018-09-11 7:20:00"); // UTC vn - 7
        $current = strtotime('now');
        
        if($timecountdown > $current){
            Yii::$app->cache->delete('cache-testi-'.SEG1);
            Yii::$app->cache->delete('cache-blog-'.SEG1);
        }
        $dataTemoignageSelected = \app\modules\modulepage\api\Catalog::get(SEG1.'/temoignage');
            $testiModule = $dataTemoignageSelected;
        if(!Yii::$app->cache->get('cache-testi-'.SEG1)) {
            if(isset($dataTemoignageSelected->data->temoignages)) {
                $dataTemoignageSelected = $dataTemoignageSelected->data->temoignages;
                $dataTemoignageItems = \app\modules\whoarewe\models\Item::find()->where(['in', 'item_id', $dataTemoignageSelected])->with(['photos'=> function (\yii\db\ActiveQuery $query) {
            $query->andWhere(['type' => 'summary']);
        }])->asArray()->all();
                $dataTemoignageItems = ArrayHelper::map($dataTemoignageItems, 'item_id', function($element){
                    $element['data'] = json_decode($element['data']);
                    return $element;
                });
                uksort($dataTemoignageItems, function($key1, $key2) use ($dataTemoignageSelected) {
                    return (array_search($key1, $dataTemoignageSelected) > array_search($key2, $dataTemoignageSelected));
                });
                Yii::$app->cache->set('cache-testi-'.SEG1, $dataTemoignageItems);
            }
        } else{
            $dataTemoignageItems = Yii::$app->cache->get('cache-testi-'.SEG1);
        }    
        // BLOGS
        
//        if(!Yii::$app->cache->get('cache-blog-'.SEG1)){
//            if(isset(\app\modules\destinations\api\Catalog::get(SEG1.'/blog')->data->moduleblog[0])) {
//                $rs = \app\modules\modulepage\api\Catalog::get(\app\modules\destinations\api\Catalog::get(SEG1.'/blog')->data->moduleblog[0]);
//                $dataBlogSelected = $rs->data->blogs;
//
//                foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
//                    $arrBlog[] = $this->getDataPost($valueBlog);
//                    foreach ($arrBlog as $key2 => $value2) {
//                        $categoryId = $value2['categories'][0];
//                        $featuredMediaId = $value2['featured_media'];
//
//                        $titleCategory = $this->getCategoryName($categoryId)['name'];
//                        $arrBlog[$keyBlog]['cat_name'] = $titleCategory;
//                        $featuredMediaData = $this->getFeatureImage($featuredMediaId)['media_details']['sizes']['barouk_list-thumb'];
//                        $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=300&h=200&zc=1&q=80';
//                    }
//                }
//            }
//        }else{
//            $arrBlog = Yii::$app->cache->get('cache-blog-'.SEG1);
//        }
        if(!Yii::$app->cache->get('cache-blog-'.SEG1)){
            if(isset(\app\modules\modulepage\api\Catalog::get('blog-'.SEG1)->data->blogs)) {
                $dataBlogSelected = \app\modules\modulepage\api\Catalog::get('blog-'.SEG1)->data->blogs;
                foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                    $arrBlog[] = $this->getDataPost($valueBlog);
                    foreach ($arrBlog as $key2 => $value2) {
                        $categoryId = $value2['categories'][0];
                        $featuredMediaId = $value2['featured_media'];

                        $titleCategory = $this->getCategoryName($categoryId)['name'];
                        $arrBlog[$keyBlog]['cat_name'] = $titleCategory;
                        $featuredMediaData = $this->getFeatureImage($featuredMediaId)['media_details']['sizes']['barouk_list-thumb'];
                        $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=300&h=200&zc=1&q=80';
                    }
                }
            }
            Yii::$app->cache->set('cache-blog-'.SEG1, $arrBlog);
        }else{
            $arrBlog = Yii::$app->cache->get('cache-blog-'.SEG1);
            
        }    
        
        
      //  var_dump($arrBlog);exit;
        
        if(IS_MOBILE){
                $this->totalCount = $countVnTours;
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theEntry->slug,
                        'totalCount' => $countVnTours,
                        'country' => SEG1,
                        'type' => 'all',
                        'length' => '',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $this->getAjaxFilter(['country' => SEG1, 'type' => '']),
                    ];
            }
        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-country' : '//page2016/nos-destinations-country-'.SEG1,
            [
                'theEntry' => $theEntry,
                'countVnTours' => $countVnTours,
                'tourType' => $tourType,
                'secretType' => $secretType,
                'arrTemoignages' => $dataTemoignageItems,
                'arrBlog' => $arrBlog,
                'infos' => $infos,
                'activeSearch' => $activeSearch,
                'testiModule' => $testiModule
            ]
        );
    }

    public function actionNosDestinationsGuideType() {
       
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        $guides = $theEntry->children();
//        $test = \app\modules\destinations\api\Catalog::cat('vietnam/guide/culture');  
//        var_dump($test->children());exit;
        $envies = \app\modules\destinations\api\Catalog::cat(SEG1.'/envies')->items(['pagination' => ['pageSize' => 3]]);
       
        $countTours =  $this->actionGetNumberProg(SEG1);
        $this->countTour = $this->getAjaxFilter(['country'=>SEG1,'type'=>'','length'=>''])['totalCount'];
        if (Yii::$app->request->isAjax  && !IS_MOBILE) {
           
            $this->countTour = $this->getAjaxFilter(['country'=>SEG1,'type'=>'','length'=>''])['totalCount'];
            return $this->countTour;
            
        }  
         $arrBlog = [];
        $timecountdown = strtotime("2019-08-21 03:37:00"); // UTC vn - 7
        $current=strtotime('now');
        if($timecountdown > $current){
            Yii::$app->cache->delete('cache-blog-guide-'.SEG1);
            
        }
        if(!Yii::$app->cache->get('cache-blog-guide-'.SEG1)) {
            $data = \app\modules\modulepage\api\Catalog::get(SEG1.'/guide/blog');
            if(isset($data->data->blogs)) {
                $dataBlogSelected = $data->data->blogs;
                foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                    $arrBlog[$keyBlog] = $this->getDataPost($valueBlog);
                    $titleCategory = $this->getCategoryName($arrBlog[$keyBlog]['categories'][0])['name'];
                    $arrBlog[$keyBlog]['cat_name'] = $titleCategory;


                    $featuredMediaData = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['media_details']['sizes']['barouk_list-thumb'];
                    $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=299&h=199&zc=1&q=80';
                }
                Yii::$app->cache->set('cache-blog-guide-'.SEG1, $arrBlog);
            }    
        } else{
            $arrBlog = Yii::$app->cache->get('cache-blog-guide-'.SEG1);
        }
        $progs = [];
        if(!empty($theEntry->data->tours)){
            $progs = \app\modules\programmes\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->tours],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$theEntry->data->tours) . ')')]
            ]);
        }       
        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-guide-type' : '//page2016/nos-destinations-guide-type',
                [
                    'theEntry' => $theEntry,
                    'guides' => $guides, 
                    'envies' => $envies,
                    'progs' => $progs,
                    'countTours' => $countTours,
                    'arrBlog' => $arrBlog
                ]
            );
    }

    public function actionNosDestinationsVisiter() {
        
      //  $this->layout = 'test';
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
       
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->entry = $theEntry;
        $this->getSeo($theEntry->model->seo);
        
       
        $getNordCenterSub = $theEntry->children();
        
        $arr = [];
            foreach ($getNordCenterSub as $v){
                $arr[] = $v->category_id;

            }
       // var_dump($arr);exit;
        $allItemVisiter = null;    
        if(!empty($arr)){
            $allItemVisiter = \app\modules\destinations\api\Catalog::items([
                    //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                      'where'=>['and',['in','category_id', $arr]],
                     // 'where' => ['like','title','%'.$search.'%', false],
                      //'filters' => $fil_countries,    
                      'pagination' => ['pageSize' => 0]

                    ]);
        }
            //    var_dump($allItemVisiter);exit;
        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-visiter' : '//page2016/nos-destinations-visiter',
                [
                    'theEntry' => $theEntry,
                    'getNordCenterSub' => $getNordCenterSub,
                    'allItemVisiter' => $allItemVisiter,
                ]
            );
    }
    public function actionVisiterSearch(){
        
       
            
            $search = Yii::$app->request->post('search');
            $pageurl = Yii::$app->request->post('pageurl');
            //var_dump($search);exit;
            if($search != NULL){
  
            $theEntry = \app\modules\destinations\api\Catalog::cat($pageurl);  
          //  var_dump($theEntry);exit;
            $getNordCenterSub = $theEntry->children();
            $arr = [];
            foreach ($getNordCenterSub as $v){
                $arr[] = $v->category_id;

            }
        
           // $listDestinations = \app\modules\destinations\api\Catalog::items(['where'=>['in','category_id',[165, 166, 167]],'pagination' => ['pageSize'=>0]]);
           // var_dump($listDestinations);exit;    
                $data = \app\modules\destinations\api\Catalog::items([
                //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                  'where'=>['and',['in','category_id', $arr],['like','title','%'.$search.'%', false]],
                 // 'where' => ['like','title','%'.$search.'%', false],
                  //'filters' => $fil_countries,    
                  'pagination' => ['pageSize' => 0]

                ]);
            }else{
                $data = \app\modules\destinations\api\Catalog::items([
                //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                  'where'=>['in','category_id', $arr],
                 // 'where' => ['like','title','%'.$search.'%', false],
                  //'filters' => $fil_countries,    
                  'pagination' => ['pageSize' => 0]

                ]);
            }
    
            $html = '';
            if(!$data) {$html = "<li>Pas de résultat. Tapez un autre mot-clé ou une autre question</li>";}
            else {
                foreach ($data as $key => $dt) {
                    if($dt->model->summary_title != ''){
                        $code = $dt->model->summary_title;
                    }else{
                        $code = $dt->title;
                    }
                $html .= '<li><a href="'.DIR.$dt->slug.'" class="it" data-code="'.$code.'">'.$dt->title.'</a></li>';
                }
            }
            echo $html;
        }

    public function actionNosDestinationsRecherche() {
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        $this->countTour = count(\app\modules\programmes\api\Catalog::items([
            'filters' => ['countries' => SEG1],
            'pagination' => ['pageSize' => 0]
            ]));
        //for tour Type
        $type = Yii::$app->request->get('type');
        $typeNoChild = $typeChild = [];
        if(!$type || $type == 'all'){
            $filterType = [];
        } else {
            foreach (explode('-',$type) as $key => $value) {
                    if( $childrenType = \app\modules\programmes\models\Category::findOne($value)->children(1)->all())
                    $typeChild = ArrayHelper::getColumn($childrenType, 'category_id');
                    else {
                         $typeNoChild[] = intval($value);
                    }
            }
            $filterType = array_merge($typeChild, $typeNoChild);
        
        }
        $filterType = ['category_id' => $filterType];
        //for tour length
         $length = Yii::$app->request->get('length');
        if($length == 'all'){
            $length = '';
        }
        if(strpos($length, '-') !== false){
              $arrLen = explode('-',$length);
              asort($arrLen);
              if($arrLen[0]==1) $arrLen[0] = 0;
              if(count($arrLen) == 4){
                $filterLen = ['between', 'days', $arrLen[0], end($arrLen)];
              }
              if(count($arrLen) == 3){
                $filterLen = ['or',
                ['between', 'days', $arrLen[0], $arrLen[1]],
                ['>=','days', end($arrLen)]  
                ];
              }
              if(count($arrLen) == 2){
                $filterLen = ['between', 'days', $arrLen[0], $arrLen[1]];
              }
        } else $filterLen = ['>=','days', $length];
        //for country
        $filters = ['countries' => SEG1];
        
        $voyage = \app\modules\programmes\api\Catalog::items([
            'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
            'where' => ['and',
                $filterType,
                $length ? $filterLen : []
                ],
            'filters' => $filters,
            'pagination' => ['pageSize' => Yii::$app->request->get('view') == 'all' ? 0 : 12]
            ]);
            $allVoyage = \app\modules\programmes\api\Catalog::items([
                'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
            'where' => ['and',
                $filterType,
                $length ? $filterLen : []
                ],
            'filters' => $filters,
            'pagination' => ['pageSize' => 0]
            ]);
            $totalPage = count($allVoyage);
            $pagi = new \yii\data\Pagination(['totalCount' => $totalPage, 'defaultPageSize'=>12 ]);
            $this->pagination = $pagi->pageCount;
            Yii::$app->session->set('countVnProg', $totalPage);
        if (Yii::$app->request->isAjax) {
            
             if(Yii::$app->request->post()['type'] == 'prog'){
                return $this->renderPartial('//page2016/ajax/itineraire-ajax', ['programes' => $voyage, 'totalPage' => $totalPage]);
            }
        }

        return $this->render('//page2016/recherche-itineraire',
            ['theEntry' => $theEntry, 
            'programes' => $voyage,
            'totalPage' => $totalPage,
            'allVoyage' => $allVoyage
            ]);
    }
    
    // cac trang destination Ideel de voyage, Fomules exclusive, Info
   public function actionNosDestinationsCountryInfo(){
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        // var_dump($theEntry->model->photos);exit;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
      
        $infos_all_childrent = $theEntry->children();
     
        
        // 6 tour On Top
        
        $voyage = [];
        if(!empty($theEntry->data->tours)){
            $voyage = \app\modules\programmes\api\Catalog::items(['where' => ['IN', 'item_id', $theEntry->data->tours],
                'orderByCustom' => [new \yii\db\Expression('FIELD (item_id, ' . implode(',',$theEntry->data->tours) . ')')]
            ]);
        } 
        
        
        $this->countTour = $this->getAjaxFilter(['country'=>SEG1,'type'=>'','length'=>''])['totalCount'];
        if (Yii::$app->request->isAjax  && !IS_MOBILE) {
           
            $this->countTour = $this->getAjaxFilter(['country'=>SEG1,'type'=>'','length'=>''])['totalCount'];
            return $this->countTour;
            
        }  
        
        // BLOGS
        $arrBlog = array();
        if(!Yii::$app->cache->get('cache-blog-'.SEG1)){
            if(isset(\app\modules\modulepage\api\Catalog::get(SEG1.'/informations-pratiques/blog')->data->blogs)) {
                $dataBlogSelected = \app\modules\modulepage\api\Catalog::get(SEG1.'/informations-pratiques/blog')->data->blogs;
                foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                    $arrBlog[] = $this->getDataPost($valueBlog);
                    foreach ($arrBlog as $key2 => $value2) {
                        $categoryId = $value2['categories'][0];
                        $featuredMediaId = $value2['featured_media'];

                        $titleCategory = $this->getCategoryName($categoryId)['name'];
                        $arrBlog[$keyBlog]['cat_name'] = $titleCategory;
                        $featuredMediaData = $this->getFeatureImage($featuredMediaId)['media_details']['sizes']['barouk_list-thumb'];
                        $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=300&h=200&zc=1&q=80';
                    }
                }
            }
            Yii::$app->cache->set('cache-blog-'.SEG1, $arrBlog);
        }else{
            $arrBlog = Yii::$app->cache->get('cache-blog-'.SEG1);
            
        }    
        
       // var_dump($arrBlog[0]);exit;
        
         return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-country-informations-pratiques' : '//page2016/nos-destinations-country-informations-pratiques',
            [
                'theEntry' => $theEntry,

                'voyage' => $voyage,
                'arrBlog' => $arrBlog,
                'infos_all_childrent' => $infos_all_childrent,
            ]);
    }
    public function actionNosDestinationsCountryIdeel(){
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        $this->update_meta = $this->getDataUpdateMeta();

            $theEntries = $this->getAjaxFilter(['country'=>SEG1,'type'=>'', 'region'=> ''])['voyage'];
            $totalCount = $this->getAjaxFilter(['country'=>SEG1,'type'=>'', 'region'=> ''])['totalCount'];
            
            $numberFilter = $this->getAjaxFilter(['country'=>SEG1,'type'=>'', 'region'=> '']);
            $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this->pagination = $pages->pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
         
            //var_dump($this->pagination);exit;
            if(IS_MOBILE){
                $this->totalCount = $totalCount;
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theEntry->slug,
                        'totalCount' => $totalCount,
                        'country' => SEG1,
                        'type' => 'all',
                        'length' => '',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $this->getAjaxFilter(['country'=>SEG1,'type'=>'']),
                    ];
            }



        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-country-ideel' : '//page2016/nos-destinations-country-ideel',

            [
                'theEntry' => $theEntry,
                'theEntries' => $theEntries,
                'totalCount' => $totalCount,
                'numberFilter' => $numberFilter,
            ]);
    }
    
    public function actionNosDestinationsCountryIdeelType(){
        $theCountryType = \app\modules\destinations\api\Catalog::items([
            'where' =>['slug'=>URI],
            
        ]);
        if (!$theCountryType) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        
         $theEntry = \app\modules\programmes\api\Catalog::cat('voyage/'.SEG3);
        
      //  $this->entry = $theEntry;
         $this->entry = $theCountryType[0];
        
       // $this->getSeo($theEntry->model->seo);
        $this->getSeo($theCountryType[0]->model->seo);
        $this->update_meta = $this->getDataUpdateMeta();
        
       

            $theEntries = $this->getAjaxFilter(['country'=>SEG1,'type'=>$theEntry->model->category_id])['voyage'];
            $totalCount = $this->getAjaxFilter(['country'=>SEG1,'type'=>$theEntry->model->category_id])['totalCount'];
            
            $numberFilter = $this->getAjaxFilter(['country'=>SEG1,'type'=>$theEntry->model->category_id]);
            
            $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
            
            if(IS_MOBILE){
                $this->totalCount = $totalCount;
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theCountryType[0]->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theCountryType[0]->slug,
                        'totalCount' => $totalCount,
                        'country' => SEG1,
                        'type' => $theEntry->model->category_id,
                        'length' => '',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $numberFilter,
                    ];
            }
        $sliders = \app\modules\destinations\api\Catalog::items([
            'where' => ['and', ['category_id' => $theCountryType[0]->model->category_id], ['!=', 'slug', URI]],
        ]);   
        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-country-ideel-type' : '//page2016/nos-destinations-country-ideel-type',
            [
                'theCountryType' => $theCountryType,
                'theEntry' => $theEntry,
                'theEntries' => $theEntries,
                'totalCount' => $totalCount,
                'numberFilter' => $numberFilter,
                'sliders' => $sliders
            ]);
    }
    
    public function actionNosDestinationsCountryExclusive(){
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');

        $this->getSeo($theEntry->model->seo);
        $this->update_meta = $this->getDataUpdateMeta();

            $theEntries = $this->getAjaxFilterExclusive(['country'=>SEG1,'type'=>'', 'region' => ''])['voyage'];
            
            $totalCount = $this->getAjaxFilterExclusive(['country'=>SEG1,'type'=>'', 'region' => ''])['totalCount'];
            
            //$numberFilter = $this->getAjaxFilterExclusive();
            $numberFilter = $this->getAjaxFilterExclusive(['country'=>SEG1,'type'=>'', 'region' => '']);
            
            $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
            
            if(IS_MOBILE){
                $this->totalCount = $totalCount;
                $numberFilterVoyage = $this->getAjaxFilter(['country'=>SEG1,'type'=>'', 'region' => '']);
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theEntry->slug,
                        'totalCount' => $numberFilterVoyage['totalCount'],
                        'country' => SEG1,
                        'type' => 'all',
                        'length' => '',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $numberFilterVoyage,
                    ];
                $this->arr_option_filter_exclusives_mobile = [
                        'title_filter' => $theEntry->model->seo->h1 ,
                        'namefilter' => 'filter_exclusivites',
                        'uri' =>$theEntry->slug,
                        'totalCount' => $totalCount,
                        'country' => SEG1,
                        'type' => 'all',
                        'length' => '',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $numberFilter,
                    ];
            }



       
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-country-exclusive' : '//page2016/nos-destinations-country-exclusive',

            [
                'theEntry' => $theEntry,
                'theEntries' => $theEntries,
                'totalCount' => $totalCount,
                'numberFilter' => $numberFilter,
            ]);
    }
    
     public function actionNosDestinationsCountryExclusiveType(){
        
        $theCountryType = \app\modules\destinations\api\Catalog::items([
            'where' =>['slug'=>URI],
            
        ]);
        if (!$theCountryType) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $theEntry = \app\modules\exclusives\api\Catalog::cat('formules/'.SEG3);
        //$this->entry = $theEntry;
         $this->entry = $theCountryType[0];
        
        //$this->getSeo($theEntry->model->seo);
        $this->getSeo($theCountryType[0]->model->seo);
        $this->update_meta = $this->getDataUpdateMeta();
        
      
            $theEntries = $this->getAjaxFilterExclusive(['country'=>SEG1,'type'=>$theEntry->model->category_id])['voyage'];
            $totalCount = $this->getAjaxFilterExclusive(['country'=>SEG1,'type'=>$theEntry->model->category_id])['totalCount'];

           // $numberFilter = $this->getAjaxFilterExclusive();
            $numberFilter = $this->getAjaxFilterExclusive(['country'=>SEG1,'type'=>$theEntry->model->category_id]);
            
            $pages = new Pagination ([ 
                'totalCount' => $totalCount, 
                'defaultPageSize' => 12, 
                'forcePageParam' => false, 
                'pageParam' => 'page' 
                ]); 
            $this-> pagination = $pages-> pageCount;
            if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }

            if(IS_MOBILE){
                $this->totalCount = $totalCount;
                $numberFilterVoyage = $this->getAjaxFilter(['country'=>SEG1,'type'=>'']);
                $this->arr_option_filter_voyage_mobile = [
                        'title_filter' => $theCountryType[0]->model->seo->h1 ,
                        'namefilter' => 'filter_voyage',
                        'uri' =>$theCountryType[0]->slug,
                        'totalCount' => $numberFilterVoyage['totalCount'],
                        'country' => SEG1,
                        'type' => 'all',
                        'length' => '',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $numberFilterVoyage,
                    ];
                $this->arr_option_filter_exclusives_mobile = [
                        'title_filter' => $theCountryType[0]->model->seo->h1 ,
                        'namefilter' => 'filter_exclusivites',
                        'uri' =>$theCountryType[0]->slug,
                        'totalCount' => $totalCount,
                        'country' => SEG1,
                        'type' => $theEntry->model->category_id,
                        'length' => '',
                        'switch_link' => 'filter_type_active',
                        'numberFilter' => $numberFilter,
                    ];
            }
        $sliders = \app\modules\destinations\api\Catalog::items([
            'where' => ['and', ['category_id' => $theCountryType[0]->model->category_id], ['!=', 'slug', URI]],
        ]); 
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-country-exclusive-type' : '//page2016/nos-destinations-country-exclusive-type',
            [
                'theCountryType' => $theCountryType,
                'theEntry' => $theEntry,
                'theEntries' => $theEntries,
                'totalCount' => $totalCount,
                'numberFilter' => $numberFilter,
                'sliders' => $sliders
            ]);
    }
    
    // End destination Ideel de voyage, Fomules exclusive, Info
    
    
    

    public function getEnviesLib(){
         $dataEnvies = \app\modules\libraries\models\Category::findOne(['slug' => 'envies'])->children()->with('items')->asArray()->all();
            $enviesLib = [];
            foreach ($dataEnvies as $key => $value) {
                $enviesLib[$value['slug']] = ArrayHelper::map($value['items'], 'item_id', function ($element) {
                    return ['slug'=>$element['slug'], 'title' => $element['title']];
                });
            }
            return $enviesLib;
    }

     public function actionNosDestinationsEnvies() {
            $theEntry = \app\modules\destinations\api\Catalog::get(URI);
            $this->entry = $theEntry;
            if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            $this->getSeo($theEntry->model->seo);
            $enviesId = \app\modules\destinations\api\Catalog::get(URI)->model->item_id;
            $totalCount = count(\app\modules\destinations\api\Catalog::Items(['filters' => ['envies' => $enviesId],
                'pagination' => 0]));
            
            if(Yii::$app->request->get('see-more') !== NULL){
                $pagesize = Yii::$app->request->get('see-more');
                
            }else{
                $pagesize = 12;
            }
            if($totalCount == 13 || $totalCount == 14){
                $pagesize = $totalCount;
            }
            
            if(Yii::$app->request->get('before-page') !== NULL){
                $before_page = Yii::$app->request->get('before-page') - 1;
                $pagi = ['pageSize' => 12, 'page' => $before_page];
            }else{
                $pagi = ['pageSize' => $pagesize];
            }
                       
            $envies = \app\modules\destinations\api\Catalog::Items(['filters' => ['envies' => $enviesId],
                'pagination' => $pagi]);
            
            $pages = new Pagination([
            'totalCount' => $totalCount,
            'defaultPageSize' => 12,
            'forcePageParam' => false, 
            'pageParam' => 'page'
            ]);
            $this->pagination = $pages->pageCount;
             if(Yii::$app->request->get('page') > $this->pagination ){
                throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
            }
         // Get Blogs
         $params = SEG1 . '-' . SEG2;
         $arrBlog = array();
    if(!Yii::$app->cache->get('cache-blog-'.URI)){
            $dataBlogSelected = $theEntry->data->blogs;
            foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                $arrBlog[] = $this->getDataPost($valueBlog);

                foreach ($arrBlog as $key2 => $value2) {
                    $categoryId = $value2['categories'][0];
                    $featuredMediaId = $value2['featured_media'];

                    $titleCategory = $this->getCategoryName($categoryId)['name'];
                    $arrBlog[$keyBlog]['cat_name'] = $titleCategory;
                    $arrBlog[$keyBlog]['alt_text'] = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['alt_text'];
                  //  $featuredMediaData = $this->getFeatureImage($featuredMediaId)['media_details']['sizes']['barouk_list-thumb'];
                  //  $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=40&h=40&zc=1&q=80';
                }
            }
        Yii::$app->cache->set('cache-blog-'.URI, $arrBlog);
    }else{
        $arrBlog = Yii::$app->cache->get('cache-blog-'.URI);

    }

         // Set title for filter
         $titleBanner = 'Le ' ;
         switch (SEG1) {
             case 'vietnam':
                 $titleBanner .= 'Vietnam';
                 break;
             case 'cambodge':
                 $titleBanner .= 'Cambodge';
                 break;
             case 'laos':
                 $titleBanner .= 'Laos';
                 break;
             case 'birmanie':
                 $titleBanner = 'La Birmanie';
                 break;
             default:
                 $theEntry = Page::get('destinations');
                 break;
         }

         $titleBanner .=  ' selon vos envies';

         return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-envies' : '//page2016/nos-destinations-list',
             [
                 'theEntry' => $theEntry,
                 'envies' => $envies,
                 'dataEnvies' => $this->getEnviesLib(),
                 'totalCount' => $totalCount,
                 'pagesize' => $pagesize,
                 'arrBlog' => $arrBlog,
                 'titleBanner' => $titleBanner
             ]
         );
    }

    public function actionNosDestinationsDetaile() {
       // echo 'ok';exit
    if (Yii::$app->request->isAjax && Yii::$app->request->post('type') != null) {
    
        if(Yii::$app->request->post()['type'] == 'prog'){
         
            return $this->renderPartial('//page2016/ajax/prog-des-ajax');
        }
        
        if(Yii::$app->request->post()['type'] == 'load-big-maps'){
          
            return $this->renderPartial('//page2016/maps/big-maps');
        }
    }
    
  
    $theEntry = \app\modules\destinations\api\Catalog::get(URI);
    $this->entry = $theEntry;
          //   var_dump($theEntry);exit;
    $this->getSeo($theEntry->model->seo);
    if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
    $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
    $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();
            // 2 dia danh bat ky thuoc cung mot region
    $random_destination = \app\modules\destinations\api\Catalog::items([
                //'where' => ['not', ['slug' => URI]],
        'where' => ['and', 'category_id = '.$theEntry->category_id.'', ['not', ['slug' => URI]]],
        'orderBy' =>'rand()',
        'filters' => ['region'=>$theEntry->data->region[0]],
        'pagination' =>['pagesize'=>2],
    ]);
             // BLOGS
    $arrBlog = array();
    if(!Yii::$app->cache->get('cache-blog-lieu-'.SEG2)){
            $dataBlogSelected = $theEntry->data->blogs;
            foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                $arrBlog[] = $this->getDataPost($valueBlog);

                foreach ($arrBlog as $key2 => $value2) {
                    $categoryId = $value2['categories'][0];
                    $featuredMediaId = $value2['featured_media'];

                    $titleCategory = $this->getCategoryName($categoryId)['name'];
                    $arrBlog[$keyBlog]['cat_name'] = $titleCategory;
                    $arrBlog[$keyBlog]['alt_text'] = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['alt_text'];
                    $featuredMediaData = $this->getFeatureImage($featuredMediaId)['media_details']['sizes']['barouk_list-thumb'];
                    $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=211&h=141&zc=1&q=80';
                }
            }
        Yii::$app->cache->set('cache-blog-lieu-'.SEG2, $arrBlog);
    }else{
        $arrBlog = Yii::$app->cache->get('cache-blog-lieu-'.SEG2);

    }    
    
    return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-single' : '//page2016/nos-destinations-detaile',[
        'theEntry' => $theEntry, 
        'allCountries' => $allCountries,
        'allDialCodes' => $allDialCodes,
        'arrBlog' => $arrBlog,
        'random_destination' => $random_destination,
    ]);
}
        

    public function actionNosDestinationsDetaileInfos()
    {
        $theEntry = \app\modules\destinations\api\Catalog::cat(URI);
        
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $parents = \app\modules\destinations\models\Category::findOne(['slug' => URI])->parents()->all();
        
        $this->getSeo($theEntry->model->seo);
        //$aaa = \app\modules\destinations\models\Category::findOne(['slug' => SEG1 . '/' . SEG2]);
        $parent = \app\modules\destinations\api\Catalog::cat(SEG1 . '/' . SEG2);
        //lay menus
        $children = [];
        if ($parent){
           // $children = $parent->children(1)->andWhere(['status' => 1])->all();
            $children = $parent->children();
        }  
             
        
        
        $top3 = \app\modules\destinations\models\Category::findOne(['slug' => SEG1 . '/' . SEG2])->children(1)
                ->andWhere(['status' => 1])
                ->andWhere(['!=', 'slug', URI])
                ->orderBy('rand()')
                ->limit(3)
                ->all();
        
        
        if(SEG1 == 'birmanie'){
            $theEntries = \app\modules\programmes\api\Catalog::items([
                    
                    'orderBy' => 'on_top ASC',
                    'filters' => ['countries' => SEG1],
                    'pagination' => ['pageSize' => 4]
                ]);
        }else{
            $theEntries = \app\modules\programmes\api\Catalog::items([
                'where' => ['and', ['>=', 'on_top', '1'], ['!=', 'slug', URI]],
                'orderBy' => 'rand()',
                'filters' => ['countries' => SEG1],
                'pagination' => ['pageSize' => 4]
            ]); 
        }    
        
       
        
           return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-detaile-infos' : '//page2016/nos-destinations-detaile-infos', [
            'theEntry' => $theEntry, 
            'theEntries' => $theEntries,
            'parent' => $parent, 
            'children' => $children, 
            'parents' => $parents,
            'top3' => $top3,
                ]);
    }

    public function actionNosDestinationsDetaileInfosSingle()
    {
        $theEntry = \app\modules\destinations\api\Catalog::get(URI);
        
        $this->entry = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        //$parent = \app\modules\destinations\models\Category::findOne(['slug' => SEG1 . '/' . SEG2]);
        $parent = \app\modules\destinations\api\Catalog::cat(SEG1 . '/' . SEG2);
        //lay menus
        $children = [];
        if ($parent){
           // $children = $parent->children(1)->andWhere(['status' => 1])->all();
            $children = $parent->children();
        }    
        
        $top3 = \app\modules\destinations\api\Catalog::items([
                'where' => ['and', ['category_id'=> $theEntry->category_id], ['!=', 'slug', URI]],
                'orderBy' => 'rand()',
               
                'pagination' => ['pageSize' => 3]
            ]); 
        
        if(count($top3) < 2){
           // $top3 = $parent->children(1)->andWhere(['status' => 1])->andWhere(['!=', 'slug', URI])->orderBy('rand()')->limit(3)->all();
            
            $ar = [];
            foreach ($children as $value) {
                $ar[] = $value->category_id; 
            }
            
           // $top3 = $parent->children(1)->andWhere(['status' => 1])->andWhere(['!=', 'slug', URI])->orderBy('rand()')->limit(3)->all();
            $top3 = \app\modules\destinations\api\Catalog::items([
                'where' => ['and', ['in','category_id', $ar], ['!=', 'slug', URI]],
                'orderBy' => 'rand()',
               
                'pagination' => ['pageSize' => 3]
            ]); 
        }
        //    var_dump($top3);exit;
        
        
        
       if(SEG1 == 'birmanie'){
            $theEntries = \app\modules\programmes\api\Catalog::items([
                    
                    'orderBy' => 'on_top ASC',
                    'filters' => ['countries' => SEG1],
                    'pagination' => ['pageSize' => 4]
                ]);
        }else{
            $theEntries = \app\modules\programmes\api\Catalog::items([
                'where' => ['and', ['>=', 'on_top', '1'], ['!=', 'slug', URI]],
                'orderBy' => 'rand()',
                'filters' => ['countries' => SEG1],
                'pagination' => ['pageSize' => 4]
            ]); 
        }    
       // return $this->render('//page2016/nos-destinations-detaile-infos-single', [
          return $this->render(IS_MOBILE ? '//page2016/mobile/nos-destinations-detaile-infos' : '//page2016/nos-destinations-detaile-infos', [
       
            'theEntry' => $theEntry,
            'parent' => $parent,
            'children' => $children,
            'top3' => $top3,
            'theEntries' => $theEntries,
                ]);
    }
    
     public function actionThanks() {
         $theEntry = Page::get(24);
         $this->root = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
         $this->getSeo($theEntry->model->seo);
        //$this->metaT = 'Merci';
        $from = Yii::$app->request->get('from', 'contact');
        $countries = \app\modules\destinations\models\Category::find()->roots()->orderBy('order_num DESC')->all();
        $fields = ArrayHelper::map($theEntry->model->fields_category, 'name', function($e){
            return $e;
        });
        return $this->render(IS_MOBILE ? '//page2016/mobile/thanks' : '//page2016/thanks', [
            'theEntry'=> $theEntry,
            'from' => $from,
            'countries' => $countries,
            'fields' => $fields
        ]);
    }

    public function addContactToMailjet($email, $listID, $data=[]){
         $mj = new Mailjet('35d34aefe4ca059fc1dcc6329ae595e4', '52540d6e2c0b3108a0a810935731b11b');
                if(isset($data['sex'])){
                    $data['sex'] = str_replace('.', '', $data['sex']);
                    if($data['sex'] == 'Madame')
                        $data['sex'] = 'MME';
                    if($data['sex'] == 'Monsieur')
                        $data['sex'] = 'M';
                    $data['sex'] = strtoupper($data['sex']);
                }
                 $contact = array(
                     'Email'         =>  $email, 
                     'Properties' => $data
             );
                 $params = array(
                    "method" => "POST",
                    "ID" => $listID,
                    "Action"    =>  "addforce"
                 );
                 $params = array_merge($params, $contact);
                 $result = $mj->contactslistManageContact($params);
    }

    public function actionNewsletter() {
        if(!$_POST){
            Yii::$app->session->set('backUrl', Yii::$app->request->referrer);
        }
        $this->layout = 'main-form';
        if(IS_MOBILE){
            $this->layout = 'mobile-form';
        }
        $theEntry = Page::get(29);
            //    var_dump($theEntry);exit;
        $this->root = $theEntry;
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        $this->getSeo($theEntry->model->seo);
        if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->post()['email']){
                $data = [
                    'source' => 'newsletter',
                    'newsletter_insc' => date('d/m/Y'),
                    'statut' => 'prospect',
                    'birmanie' => false,
                    'vietnam' => false,
                    'cambodia' => false,
                    'laos' => false
                ];
                $listID = 1688900;
                 if(Yii::$app->request->post('type') == 'guide'){
                    $isNews = Yii::$app->request->post('checknews'); 
                    $data = [];
                        if($isNews == 'true'){
                            $data = [
                                'source' => 'PDF',
                                'newsletter_insc' => date('d/m/Y'),
                                'statut' => 'prospect',
                                'birmanie' => false,
                                'vietnam' => false,
                                'cambodia' => false,
                                'laos' => false
                            ];
                        }
                    $pdf = BASE_PATH.substr(Yii::$app->request->post('pdf'), 1);
                    $this->confirmAmica(Yii::$app->request->post('email'), [
                        'reasonEmail' => 'guide', 
                       // 'subject' => 'Télécharger le '.Yii::$app->request->post('name'), 
                        'subject' => 'Télécharger le '.Yii::$app->request->post('guide'), 
                        'guideName' => ucfirst(Yii::$app->request->post('guide')),
                        'attachment' => $pdf
                    ]);
                    $listID = $isNews == 'true' ? 1688900 : 1711181;
                }
               
                $this->addContactToMailjet(Yii::$app->request->post()['email'], $listID, $data);
                return true;
            }
        }
      //  $this->metaT = 'Abonnement newsletters';
      //  $this->metaD = 'Bénéficiez de nos informations de voyages (promotions, conseils, avis) en vous abonnant à notre newsletter. Nous vous aidons à réaliser votre voyage.';

        $allCountries = Country::find()->select(['code', 'name_fr'])->orderBy('name_fr')->asArray()->all();

//        $model = new NewsletterForm;
        if (IS_MOBILE) {
            $model = new ContactFormMobile;
            $model->scenario = 'newsletter_mobile';
        } else {
            $model = new ContactForm;
            $model->scenario = 'newsletter';
        }
        if ($model->load($_POST) && $model->validate()) {
            //\yii\easyii\modules\subscribe\api\Subscribe::save( $model->email );
            $data = [
                    'source' => 'newsletter',
                    'newsletter_insc' => date('d/m/Y'),
                    'statut' => 'prospect',
                    'birmanie' => false,
                    'vietnam' => false,
                    'cambodia' => false,
                    'laos' => false
                ];
            $listID = 1688900;
            $this->addContactToMailjet($model->email, $listID, $data);
            // Redir
          //   Yii::$app->session->set('sex', $model->prefix);
          //  Yii::$app->session->set('name', $model->lname);
            return Yii::$app->response->redirect(DIR.'newsletter?m='.$model->email);
        } else {
            return $this->render(IS_MOBILE ? '//page2016/mobile/newsletter_mobile' : '//page2016/newsletter', [
                        'theEntry'=> $theEntry,	
                        'model' => $model,
                        'allCountries' => $allCountries,
            ]);
        }
    }
    public function actionContact() {
        if(!$_POST){
            Yii::$app->session->set('backUrl', Yii::$app->request->referrer);
        }
        $this->layout = 'main-form';
        if(IS_MOBILE)
            $this->layout = 'mobile-form';
        $theEntry = Page::get(21);
        $this->root = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->model->seo);
		$allCountries = Country::find()->select(['code', 'name_fr'])->orderBy('name_fr')->asArray()->all();

         if (IS_MOBILE) {
            $model = new ContactFormMobile;
            $model->scenario = 'contact_mobile';
        } else {
            $model = new ContactForm;
            $model->scenario = 'contact';
        }
       

        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';

        if ($model->load($_POST) && $model->validate()) {
            $toEmail = 'Amica FR <inquiry-fr@amicatravel.com>';
            
            $data2 = $this->processingDataAllForm($model);
            
            if($model->subjet == 'pdv') {
                if(IS_MOBILE){
//                    $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//                    $model->lname = '';
//                    if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                        $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//                    }

                                       
                    // Save db
                    $this->saveInquiry($model, 'Form-contact-mobile', $data2);                     
                } else {
                    // Save db
                    $this->saveInquiry($model, 'Form-contact', $data2);

                }

            } else{
               
                if($model->subjet == 'dec' || $model->subjet == 'qd') {
                    $this->saveInquiry($model, 'Form-contact', $data2);
                }
                switch ($model->subjet) {
                    case 'pami':
                    $toEmail = 'relation.voyageur@amica-travel.com';
                    break;
                    case 'sc':
                    $toEmail = 'relation.voyageur@amica-travel.com';
                    break;
                    case 'hr':
                    $toEmail = 'hr@amica-travel.com';
                    break;
                    case 'mkt':
                    $toEmail = 'phuong.anh@amicatravel.com';
                    break;
                }
            }
                $data = [
                   // 'firstname' => $model->fname,
                   // 'lastname' => $model->lname,
                    'fullName' => $model->fullName,
                    'codecontry' => $model->country,
                    'sex' => $model->prefix,
                    ];
                $listID = $model->newsletter ? 1688900 : 1711181;
                $this->addContactToMailjet($model->email, $listID, $data);

            // Email me
            $this->notifyAmica('[Contact] '.Yii::$app->params['subjet'][$model->subjet].' from ' . $model->email, '//page2016/email_template', ['data2' => $data2],  $toEmail);
            $this->confirmAmica($model->email, ['reasonEmail' => 'contact', 'name' => $model->prefix.' '.$model->fullName]);
             Yii::$app->session->set('sex', $model->prefix);
            Yii::$app->session->set('name', $model->fullName);
            return Yii::$app->response->redirect(DIR.'merci?from=contact&id='.$this->id_inquiry);
        }


        return $this->render(IS_MOBILE ? '//page2016/mobile/contact_mobile' : '//page2016/contact', [
                    'theEntry' => $theEntry,
                    'model' => $model,
                    'allCountries' => $allCountries,
        ]);
    }
    
    public function actionRdv()
    {
        if(!$_POST){
            Yii::$app->session->set('backUrl', Yii::$app->request->referrer);
        }
        $this->layout = 'main-form';
        if(IS_MOBILE)
            $this->layout = 'mobile-form';
		$theEntry = Page::get(23);
        $this->root = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->model->seo);
		
        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();
      
        $model = new ContactForm;
        if (IS_MOBILE) {
             $model = new ContactFormMobile;
            $model->scenario = 'rdv_mobile';
        } else {
            $model->scenario = 'rdv';
        }
       

        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';

        if ($model->load($_POST) && $model->validate()) {
           // var_dump($model);exit;
            $data2 = $this->processingDataAllForm($model);
            
            
            if (IS_MOBILE) {
//            $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//            $model->lname = '';
//            if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//            }
            

                $this->saveInquiry($model, 'Form-rdv-mobile', $data2);
            } else {
            // Save db
                $this->saveInquiry($model, 'Form-rdv', $data2);
            }
            $data = [
                         //   'firstname' => $model->fname,
                         //   'lastname' => $model->lname,
                            'fullName' => $model->fullName,
                            'codecontry' => $model->country,
                            'sex' => $model->prefix
                        ];
            if($model->newsletter)
            $data = [
                   // 'firstname' => $model->fname,
                   // 'lastname' => $model->lname,
                    'fullName' => $model->fullName,
                    'codecontry' => $model->country,
                    'source' => 'newsletter',
                    'sex' => $model->prefix,
                    'newsletter_insc' => date('d/m/Y'),
                    'statut' => 'prospect',
                    'birmanie' => false,
                    'vietnam' => false,
                    'cambodia' => false,
                    'laos' => false
                ];
            $listID = $model->newsletter ? 1688900 : 1711181;
            $this->addContactToMailjet($model->email, $listID, $data);
            // Email me
            $this->notifyAmica('RDV from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
            $this->confirmAmica($model->email, ['reasonEmail' => 'contact', 'name' => $model->prefix.' '.$model->fullName]);
            // Redir
             Yii::$app->session->set('sex', $model->prefix);
            Yii::$app->session->set('name', $model->fullName);
            return Yii::$app->response->redirect(DIR.'merci?from=rdv&id='.$this->id_inquiry);
        }
            return $this->render(IS_MOBILE ? '//page2016/mobile/rdv_mobile' : '//page2016/rdv', [
                        'theEntry' => $theEntry,
                        'model' => $model,
                        'allCountries' => $allCountries,
                        'allDialCodes' => $allDialCodes,
            ]);
        
    }

    
    public function actionDevis() {
        
       // $this->metaT = 'Devis sur mesure pour un voyage sur mesure au Vietnam, Laos, Cambodge';
       // $this->metaD = 'Demandez un devis et votre conseiller personnel vous répondra sous 48h et vous aidera à construire le circuit le mieux adapté à votre demande.';
        if(!$_POST){
            Yii::$app->session->set('backUrl', Yii::$app->request->referrer);
        }
        $this->layout = 'main-form';
        if(IS_MOBILE)
            $this->layout = 'mobile-form';
		 $theEntry = Page::get(20);
        $this->root = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->model->seo);
		 
        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();

        $model = new DevisForm;
        
        $model->scenario = 'devis_short';
        if(IS_MOBILE) {
            $model = new DevisFormMobile;
            $model->scenario = 'devis_short_mobile';
            
        }
        

        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        
       
        if ($model->load($_POST) && $model->validate()) {
            
//            $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//            $model->lname = '';
//            if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//            }
       
            $data2 = $this->processingDataAllForm($model);  

            $data = [
                           // 'firstname' => $model->fname,
                           // 'lastname' => $model->lname,
                            'fullName' => $model->fullName,
                            'codecontry' => $model->country,
                            'sex' => $model->prefix
                        ];
            if($model->newsletter)
                 $data = [
                           // 'firstname' => $model->fname,
                           // 'lastname' => $model->lname,
                            'fullName' => $model->fullName,
                            'codecontry' => $model->country,
                            'source' => 'newsletter',
                            'newsletter_insc' => date('d/m/Y'),
                            'statut' => 'prospect',
                            'birmanie' => false,
                            'vietnam' => false,
                            'cambodia' => false,
                            'laos' => false
                        ];
                $listID = $model->newsletter ? 1688900 : 1711181;
                $this->addContactToMailjet($model->email, $listID, $data);     
            // Email me
            $this->notifyAmica('Devis from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
            $this->confirmAmicaDevis($model->email, ['reasonEmail' => 'contact', 'name' => $model->prefix.' '.$model->fullName, 'data' => $model]);
            
           if (IS_MOBILE) {
               
//                $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//                $model->lname = '';
//                if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                    $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//                }
                if (!$model->has_date) {
                    $model->departureDate = null;
                    $model->tourLength = null;
                }
                $contact = '';
               if($model->contactEmail) $contact .= $model->email;
               if($model->contactEmail && $model->contactPhone) $contact .= ' ,';
               if($model->contactPhone) $contact .= $model->phone;
            
              
            
                $this->saveInquiry($model, 'Form-devis-mobile', $data2);
            } else {    
            //    var_dump($model);exit;    


                $this->saveInquiry($model, 'Form-devis', $data2);
                // If he subscribes to our newsletter
              //  if ($model->newsletter == 1) $this->saveNlsub($model, 'Form-devis');
            
            }
            
            Yii::$app->session->set('sex', $model->prefix);
            Yii::$app->session->set('name', $model->fullName);
            return Yii::$app->response->redirect(DIR.'merci?from=devis&id='.$this->id_inquiry);
        }

        return $this->render(IS_MOBILE ? '//page2016/mobile/devis_short_mobile' : '//page2016/devis-short', [
					'theEntry' => $theEntry,
                    'model' => $model,
                    'allCountries' => $allCountries,
                    'allDialCodes' => $allDialCodes,
        ]);
    }
    
    
    public function actionDevisPersonnalisation() {
        
        if(isset($_GET['uid']) && trim(Yii::$app->request->get('uid')) != ''){
            $uid = Yii::$app->request->get('uid');
        }else{
            $uid = NULL;
        }
        if($uid){
            $id_inquiry = floatval(explode('-', $uid)[0]);
            $id_saler = isset(explode('-', $uid)[2]) ? floatval(explode('-', $uid)[2]) : NULL;
        }else{
            $id_inquiry = Null;
            $id_saler = NULL;
        }
        
        $item = Inquiry::find()
                ->where(['id'=>$id_inquiry])
                ->one();
       
        if(!$item){
            throw new HttpException(404, 'Page ne pas trouvé!');
        }
        

        $data = unserialize($item->data);
        $name = str_replace(['Monsieur', 'Madame'], ['M', 'Mme'], $data['prefix']). ' '.$item->name;
        
        if($item){
            $code_check = $item->id .'-'. substr(sha1(strtolower($item->email)), 0, 6).'-'.$id_saler;
        }else{
            $code_check = Null;
        }
        //var_dump($code_check);exit;
       
        if($uid == NULL || $code_check == NULL || $code_check != $uid){
            throw new HttpException(404, 'Page ne pas trouvé!');
        }
        
        
        $this->layout = 'main-form';
        if(IS_MOBILE)
            $this->layout = 'mobile-form';
		 $theEntry = Page::get('devis-personnalisation');
        $this->root = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->model->seo);
		 
        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();

        $model = new DevisPersionalForm;
        $model->scenario = 'devis_long';
        if(IS_MOBILE) {
            $model = new DevisPersionalFormMobile;
            $model->scenario = 'devis_long_mobile';
            
        }
        

        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        
        
        if ($model->load($_POST) && $model->validate()) {
            $model->email = $item->email;
            $model->fullName = $item->name;
            $data2 = $this->processingDataAllForm($model);  

            $this->notifyAmica('Devis personnalisé from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
            $this->confirmAmicaDevis2($model->email, ['reasonEmail' => 'contact', 'name' => $name, 'data' => $model]);
            
           if (IS_MOBILE) {
               
//                $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//                $model->lname = '';
//                if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                    $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//                }
//                if (!$model->has_date) {
//                    $model->departureDate = null;
//                    $model->tourLength = null;
//                }
//                $contact = '';
//               if($model->contactEmail) $contact .= $model->email;
//               if($model->contactEmail && $model->contactPhone) $contact .= ' ,';
//               if($model->contactPhone) $contact .= $model->phone;
//            
              
            
                $this->saveInquiry($model, 'Form-devis-mobile-2', $data2);
            } else {    
            

                $this->saveInquiry($model, 'Form-devis-2', $data2);
              
            }
            
            Yii::$app->session->set('sex', $data['prefix']);
            Yii::$app->session->set('name', $model->fullName);
            
            // notify for saler
            
            $sellerList = [
                ["46806", "Hồng Phúc", "hongphuc.vu@amicatravel.com"],
                ["36244", "Lê Minh", "minh.tl@amicatravel.com"],
                ["11723", "Liên", "phung.lien@amicatravel.com"],
                ["5046", "Lý", "nguyen.ly@amicatravel.com"],
                ["1677", "Mai Phương", "mai.phuong@amicatravel.com"],
                ["4432", "Ngô Hằng", "ngo.hang@amicatravel.com"],
                ["6", "Ngọc Linh", "ngoc.linh@amicatravel.com"],
                ["43847", "Ngọc Thư", "ngocthu.vu@amicatravel.com"],
                ["4829", "Nguyễn Hà", "nguyen.ha@amicatravel.com"],
                ["28319", "Nguyễn Nhung", "nhung.nh@amicatravel.com"],
                ["10068", "Nhàn", "nhan.dt@amicatravel.com"],
                ["695", "Phương Anh", "phuong.anh@amicatravel.com"],
                ["55551", "Sébastien", "sebastien.houssin@amicatravel.com"],
                ["40756", "Thanh Nga", "thanh.nga@amicatravel.com"],
                ["17090", "Thơ", "anh.tho@amicatravel.com"],
                ["35887", "Thu Hòa", "hoa.ntt@amicatravel.com"],
                ["52400", "Thu Phương", "thuphuong.nguyen@amicatravel.com"],
                ["18519", "Thương Huyền", "dinh.huyen@amicatravel.com"],
                ["35888", "Trần Hằng", "hang.tt@amicatravel.com"],
                ["53979", "Trọng Huy", "tronghuy.lenguyen@amicatravel.com"],
                ["59672", "Vương Yến Nhi", "yennhi.vuong@amicatravel.com"],
                ["33415", "Yến Như", "ntyennhu@amicatravel.com"],
            ];
            $info_saler = NULL;
            foreach ($sellerList as $i => $value) {
                foreach ($value as $j => $sale) {
                    
                    if($id_saler == $sale){
                        $info_saler = $sellerList[$i];
                        break;
                    }
                   
                }
                
            }
            
            if($info_saler == NULL){
                $email_saler = ['Ngô Hằng <ngo.hang@amica-travel.com>', 'Huân Hoàng <huan@amica-travel.com >'];
            }else{
                $email_saler = [$info_saler[1].' <'.$info_saler[2].'>'];
            }
            
            $txt =  '<b>'. Yii::$app->session->get('sex').' '.$model->fullName.'</b> submitted additional information as below: <br><br>';
            $txt .= $data2;
            $txt .= '<br><b>Click here to see information in IMS</b> : (<a href="'.'https://my.amicatravel.com/inquiries/'.$id_inquiry.'/form2/'.$this->id_inquiry.'">'.'link'.'</a>)';
            
//            echo '<pre>';
//            print_r($txt);
//            echo '</pre>';exit;
            
            $this->notifySaler('Devis personnalisé from ' . $model->email, '//page2016/email_template', ['data2' => $txt], $email_saler, '');
            
            // end notify for saler
            
            return Yii::$app->response->redirect(DIR.'merci?from=personnalisation&id='.$this->id_inquiry);
        }

        return $this->render(IS_MOBILE ? '//page2016/mobile/devis-personnalisation-mobile' : '//page2016/devis-personnalisation', [
                    'theEntry' => $theEntry,
                    'model' => $model,
                    'allCountries' => $allCountries,
                    'allDialCodes' => $allDialCodes,
        ]);
    }
    
    public function actionVotreProjet() {
        $this->layout = 'main-form';
		$theEntry = Page::get(22);
        $this->root = $theEntry;
         if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
		 $this->getSeo($theEntry->model->seo);
       // $this->metaT = 'Devis sur mesure pour un voyage sur mesure au Vietnam, Laos, Cambodge';
       // $this->metaD = 'Demandez un devis et votre conseiller personnel vous répondra sous 48h et vous aidera à construire le circuit le mieux adapté à votre demande.';
if (Yii::$app->request->isAjax) {
            //add exclusives to Projet
            if(Yii::$app->request->post()['type'] == 'excl'){
              $exclId = Yii::$app->request->post()['tour_id'];
              if(Yii::$app->session->get('projet'))
                $projet = Yii::$app->session->get('projet');
              else $projet = [
                'programes'=> ['select'=>[], 'view'=>[]],
                'exclusives' => ['select'=>[], 'view'=> []]
                ];
              if(!in_array($exclId, $projet['exclusives']['select']))
                  $projet['exclusives']['select'][] = $exclId;
              if(($key = array_search($exclId, $projet['exclusives']['view'])) !== false) {
                      unset($projet['exclusives']['view'][$key]);
              }
              Yii::$app->session->set('projet',$projet);
            }
            //add programes to Projet
            if(Yii::$app->request->post()['type'] == 'prog'){
              $progId = Yii::$app->request->post()['tour_id'];
              if(Yii::$app->session->get('projet'))
                $projet = Yii::$app->session->get('projet');
              else $projet = [
                'programes'=> ['select'=>[], 'view'=>[]],
                'exclusives' => ['select'=>[], 'view'=> []]
                ];
              if(!in_array($progId, $projet['programes']['select']))
                  $projet['programes']['select'][] = $progId;
              if(($key = array_search($progId, $projet['programes']['view'])) !== false) {
                      unset($projet['programes']['view'][$key]);
              }
              Yii::$app->session->set('projet',$projet);
            }
            //remove exclusives from Projet
            if (Yii::$app->request->post()['type'] == 'remove-excl') {
                $exclId = Yii::$app->request->post()['remove_id'];
                if(Yii::$app->session->get('projet'))
                  $projet = Yii::$app->session->get('projet');
                else $projet = [
                  'programes'=> ['select'=>[], 'view'=>[]],
                  'exclusives' => ['select'=>[], 'view'=> []]
                  ];
                if(($key = array_search($exclId, $projet['exclusives']['select'])) !== false) {
                        unset($projet['exclusives']['select'][$key]);
                }
                Yii::$app->session->set('projet',$projet);
            }
             //remove program from Projet
            if (Yii::$app->request->post()['type'] == 'remove-prog') {
                $progId = Yii::$app->request->post()['remove_id'];
                if(Yii::$app->session->get('projet'))
                  $projet = Yii::$app->session->get('projet');
                else $projet = [
                  'programes'=> ['select'=>[], 'view'=>[]],
                  'exclusives' => ['select'=>[], 'view'=> []]
                  ];
                if(($key = array_search($progId, $projet['programes']['select'])) !== false) {
                        unset($projet['programes']['select'][$key]);
                }
                Yii::$app->session->set('projet',$projet);
            }
            $html =  $this->renderPartial('//page2016/ajax/votre-ajax');
            return json_encode(['prog'=>count($projet['programes']['select']), 'excl' => count($projet['exclusives']['select']), 'html' => $html]);
        }
        
        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();

        $model = new DevisForm;
        $model->scenario = 'devis';
        

        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';

        if ($model->load($_POST) && $model->validate()) {
            $wishlist = Yii::$app->session->get('projet');
        $listProg = '0';
        if($wishlist['programes']['select']){
            $listProg = '<br>';
            $where = $wishlist['programes']['select'];
            // var_dump($where);exit;
            $progData= \app\modules\programmes\api\Catalog::items(['where' => ['IN', 'item_id',  $where]]);
            foreach ($progData as $key => $value) {
                $listProg .= '<a href="https://www.amica-travel.com/'.$value->slug.'">'.$value->title.'</a><br>';
            }
        }
        $listExcl = '0';
        if($wishlist['exclusives']['select']){
            $listExcl = '<br>';
            $where = $wishlist['programes']['select'];
            // var_dump($where);exit;
            $exclData= \app\modules\exclusives\api\Catalog::items(['where' => ['IN', 'item_id',  $where]]);
            foreach ($exclData as $key => $value) {
                $listExcl .= '<a href="https://www.amica-travel.com/'.$value->slug.'">'.$value->title.'</a><br>';
            }
        }       
               
            // Save db
            
         
           $data2 = <<<'TXT'
Vos coordonnées:

Voyage Selected: {{ voyage : $voyage }}
Exclusives Selected : {{ excl : $excl }} 
Votre Nom et Prénom: {{ prefix : $prefix }} {{ fname : $fname }} {{ lname : $lname }} 
Votre adresse mail: {{ email : $email }}
Votre pays: {{ country : $country }}
Département, Votre ville: {{ region : $region }} {{ ville : $ville }}

votre projet:

Date d'arrivée approximative: {{ departureDate : $departureDate }}
Date de retour: {{ deretourDate : $deretourDate }}
Durée du voyage: {{ tourLength : $tourLength }}
Destinations: {{ countriesToVisit : $countriesToVisit }} {{ multipays : $multipays }}
Avez-vous déjà acheté votre (vos) billet(s) d’avion internationaux aller-retour ?: {{ howTicket : $howTicket }}
En savoir plus : {{ ticketDetail : $ticketDetail }}
Souhaitez-vous être accompagné pour l'achat de vos billets internationnaux ? {{ helpTicket : $helpTicket }}
Les participants: + de 12 ans {{ numberOfTravelers12 : $numberOfTravelers12 }} Détails d'âges: {{ agesOfTravelers12 : $agesOfTravelers12 }}
- de 12 ans {{ numberOfTravelers2 : $numberOfTravelers2 }} 
- de 2 ans {{ numberOfTravelers0 : $numberOfTravelers0 }}
La forme physique des participants : {{ howTraveler : $howTraveler }}
Quel(s) type(s) d’hébergement aimeriez-vous pour ce voyage ? : {{ hotelTypes : $hotelTypes }}
Combien de chambres souhaitez-vous:
Chambre double avec un grand lit: {{ hotelRoomDbl : $hotelRoomDbl }}
Chambre double avec 2 petit lits: {{ hotelRoomTwn : $hotelRoomTwn }}
Chambre pour 3 personnes: {{ hotelRoomTrp : $hotelRoomTrp }}
Chambre individuelle: {{ hotelRoomSgl : $hotelRoomSgl }}
Repas: {{ mealsIncluded : $mealsIncluded }}
Budget par personne: {{ budget : $budget }}

pour mieux vous connaitre:

Décrivez votre projet, votre vision du voyage et de quelle façon vous souhaitez découvrir vous souhaitez découvrir la ou les destinations choisie(s): {{ message : $message }}

Thématiques: {{ tourThemes : $tourThemes }}
Pouvez-vous nous raconter votre dernier voyage long-courrier ? (destination, type de voyage, expériences, ce que vous avez aimé, ...) {{ howMessage : $howMessage }}
Vos loisirs et passe-temps préférés (ce que vous aimez, ce que vous n’aimez pas…) : {{ howHobby : $howHobby }}
Nous vous rappelons gratuitement pour mieux comprendre votre projet: {{ callback : $callback }}

TXT;
               $datacallback = <<<'TXT'
Votre numéro de téléphone: {{ countryCallingCode : $CallingCode }} {{ phone : $phone }}
Date / heure pour le RDV: {{ callDate : $callDate }} {{ callTime : $callTime }}

TXT;
               $datalast = <<<'TXT'
Si vous êtes recommandé(e) par un ancien client d'Amica, merci de préciser son nom et prénom: {{ reference : $reference }}   
Newsletters: {{ newsletter : $newsletter }}    
TXT;
       if($model->countriesToVisit != 'Multi-pays'){
          $model->multipays = '';
      }else{
          $model->multipays = ': '.$model->multipays;
      }         
               
      if($model->callback == 'Oui'){
                $data2 .= $datacallback;
                $data2 .= $datalast;
                $data2 = str_replace([
                   '$prefix', '$fname', '$lname', '$email', '$country', '$region', '$ville', '$departureDate', '$deretourDate', '$tourLength', '$countriesToVisit', '$multipays', '$numberOfTravelers12', '$numberOfTravelers2', '$numberOfTravelers0', '$agesOfTravelers12', '$message', '$tourThemes', '$hotelTypes', '$hotelRoomDbl', '$hotelRoomTwn', '$hotelRoomTrp', '$hotelRoomSgl', '$mealsIncluded', '$budget', '$callback', '$CallingCode', '$phone', '$callDate', '$callTime','$newsletter', '$whyCountry', '$howTraveler', '$howMessage', '$howHobby', '$howTicket', '$ticketDetail', '$helpTicket', '$job', '$voyage', '$excl', '$reference'
                    ], [
                    $model->prefix, $model->fname, $model->lname, $model->email, $model->country, $model->region, $model->ville, $model->departureDate, $model->deretourDate, $model->tourLength, implode(', ', (array)$model->countriesToVisit), $model->multipays, $model->numberOfTravelers12, $model->numberOfTravelers2, $model->numberOfTravelers0, $model->agesOfTravelers12, $model->message, implode(', ',(array)$model->tourThemes),  implode(', ', (array)$model->hotelTypes), $model->hotelRoomDbl, $model->hotelRoomTwn, $model->hotelRoomTrp, $model->hotelRoomSgl, $model->mealsIncluded, $model->budget, $model->callback, $model->countryCallingCode, $model->phone, $model->callDate, $model->callTime, $model->newsletter == 1 ? 'Oui' : 'Non', $model->whyCountry, $model->howTraveler, $model->howMessage, $model->howHobby, $model->howTicket, $model->ticketDetail, $model->helpTicket, $model->job, $listProg, $listExcl, $model->reference
                    ], $data2);
                }else{
                    
                 $data2 .= $datalast;
                 
                 $data2 = str_replace([
                    '$prefix', '$fname', '$lname', '$email', '$country', '$region', '$ville', '$departureDate', '$deretourDate', '$tourLength', '$countriesToVisit', '$multipays', '$numberOfTravelers12', '$numberOfTravelers2', '$numberOfTravelers0', '$agesOfTravelers12', '$message', '$tourThemes', '$hotelTypes', '$hotelRoomDbl', '$hotelRoomTwn', '$hotelRoomTrp', '$hotelRoomSgl', '$mealsIncluded', '$budget', '$callback', '$newsletter', '$whyCountry', '$howTraveler', '$howMessage', '$howHobby', '$howTicket', '$ticketDetail', '$helpTicket', '$job', '$voyage', '$excl', '$reference'
                    ], [
                    $model->prefix, $model->fname, $model->lname, $model->email, $model->country, $model->region, $model->ville, $model->departureDate, $model->deretourDate, $model->tourLength, implode(', ', (array)$model->countriesToVisit), $model->multipays, $model->numberOfTravelers12, $model->numberOfTravelers2, $model->numberOfTravelers0, $model->agesOfTravelers12, $model->message, implode(', ',(array)$model->tourThemes),  implode(', ', (array)$model->hotelTypes), $model->hotelRoomDbl, $model->hotelRoomTwn, $model->hotelRoomTrp, $model->hotelRoomSgl, $model->mealsIncluded, $model->budget, $model->callback, $model->newsletter == 1 ? 'Oui' : 'Non', $model->whyCountry, $model->howTraveler, $model->howMessage, $model->howHobby, $model->howTicket, $model->ticketDetail, $model->helpTicket, $model->job, $listProg, $listExcl, $model->reference
                    ], $data2);
                }
         
                $this->saveInquiry($model, 'Form-liste-envies', $data2);
            $data = [
                    'firstname' => $model->fname,
                    'lastname' => $model->lname,
                    'codecontry' => $model->country,
                    'source' => 'newsletter',
                    'sex' => $model->prefix,
                    'newsletter_insc' => date('d/m/Y'),
                    'statut' => 'prospect',
                    'birmanie' => false,
                    'vietnam' => false,
                    'cambodia' => false,
                    'laos' => false
                ];
            $listID = $model->newsletter ? 1688900 : 1711181;
            $this->addContactToMailjet($model->email, $listID, $data);
                // If he subscribes to our newsletter
              //  if ($model->newsletter == 1) $this->saveNlsub($model, 'Form-devis');
            

            // Email me
            $this->notifyAmica('Devis from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
            $this->confirmAmica($model->email, ['reasonEmail' => 'contact', 'name' => $model->prefix.' '.$model->lname]);
             Yii::$app->session->set('sex', $model->prefix);
            Yii::$app->session->set('name', $model->lname);
            return Yii::$app->response->redirect(DIR.'merci?from=liste-d-envies&id='.$this->id_inquiry);
        }

        return $this->render('//page2016/votre-projet', [
                    'model' => $model,
					'theEntry' => $theEntry,	
                    'allCountries' => $allCountries,
                    'allDialCodes' => $allDialCodes,
        ]);
    }
    
    public function actionQuandCommentCombienAboutUs(){
        $this->layout = 'main-quand-comment-combien';
        $this->metaIndex = 0;
        $this->metaFollow = 0;
        $theEntry = \yii\easyii\modules\page\api\Page::get('quand-comment-combien');
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        $infos_pratiques = \app\modules\libraries\api\Catalog::items(['where'=>['category_id'=>18],'pagination' => ['pageSize'=>0],'orderBy'=>'item_id']);
        
        return $this->render('//page2016/quand-comment-combien', [
                    'theEntry' => $theEntry,
                    'infos_pratiques' => $infos_pratiques,	
                    
        ]);
    }

    

    public function saveInquiry($model, $form, $data2 = '') {
        // Do not save test
        if ($model->email == 'huan@huanh.com') return false;
        $inquiry = new Inquiry;
        $inquiry->ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : Yii::$app->request->getUserIP();
        $inquiry->ua = Yii::$app->request->getUserAgent();
        $inquiry->ref = Yii::$app->session->get('ref', '-');
        $inquiry->name =  $model->fullName != Null ? trim($model->fullName) : trim($model->fname) . ' ' . trim($model->lname);
        $inquiry->email = $model->email;
        $inquiry->data = serialize($model->getAttributes(null, ['verificationCode']));
        if ($data2 != '') {
            $inquiry->data2 = $data2;
            //$inquiry->data2 = $data2. '</br>Derniere page web visitée : {{ backUrl : '.Yii::$app->session->get('backUrl').' }}';
        }
        $inquiry->site_id = SITE_ID;
        $inquiry->form_id = 0;
        $inquiry->form_name = $form;
        $inquiry->created_at = NOW;
        $inquiry->updated_at = NOW;
        $inquiry->status = 'on';
        $inquiry->save();
		
		// get id_inquiry
		$this->id_inquiry = $inquiry->id;
    }
    
    public function saveNlsub($model, $form) {
        // Do not save test
        if ($model->email == 'huan@huanh.com') return false;
        $nlsub = new Nlsub;
        $nlsub->ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : Yii::$app->request->getUserIP();
        $nlsub->ua = Yii::$app->request->getUserAgent();
        $nlsub->ref = Yii::$app->session->get('ref', '-');
        $nlsub->prefix = $model->prefix;
        $nlsub->fname = $model->fname;
        $nlsub->lname = $model->lname;
        $nlsub->email = $model->email;
        $nlsub->country = $model->country;
        $nlsub->site_id = SITE_ID;
        $nlsub->form = $form;
        $nlsub->created_at = NOW;
        $nlsub->updated_at = NOW;
        $nlsub->status = 'on';
        $nlsub->save();
    }
    
     public function notifyAmica($subject = '', $template = '', $params = [], $email='Amica FR <inquiry-fr@amicatravel.com>') {
        $mgClient = new Mailgun(MAILGUN_API_KEY);
        $result = $mgClient->sendMessage(MAILGUN_API_DOMAIN, [
            'from' => 'Amica-FR <noreply-fr@amicatravel.com>',
            'to' =>  $email,
            'bcc' => ['Nguyen Linh. <nguyen.linh@amicatravel.com>', 'Info Arnaud. <arnaud.l@amicatravel.com>'],
             'subject' => $subject,
            'text' => '',
            'html' => $this->renderPartial($template, $params),
                ]
        );
    }
    
    public function notifySaler($subject = '', $template = '', $params = [], $email='Amica FR <inquiry-fr@amicatravel.com>', $text = '') {
        $mgClient = new Mailgun(MAILGUN_API_KEY);
        $result = $mgClient->sendMessage(MAILGUN_API_DOMAIN, [
            'from' => 'Amica-FR <noreply-fr@amicatravel.com>',
            'to' =>  $email,
            'bcc' => ['NguyenDT <nguyen.dt@amica-travel.com>'],
             'subject' => $subject,
            'text' => $text,
            'html' => $this->renderPartial($template, $params),
                ]
        );
    }

    public function actionSendPdfToEmail($subject = '', $template = '', $params = [], $email='Amica FR <inquiry-fr@amicatravel.com>') {
    // $files['attachment']
    $url = 'https://www.amica-travel.com/'.Yii::$app->request->post('tourUrl').'/form';
    $files = BASE_PATH.substr(Yii::$app->request->post('pdf'), 1);
    $email = Yii::$app->request->post('email');
    $isNews = Yii::$app->request->post('checknews');
    $tourName = Yii::$app->request->post('tourName');

    $this->confirmAmica($email, ['tourName' => $tourName, 'reasonEmail' => 'tour', 'subject' => 'Télécharger le PDF du circuit : '.$tourName, 'attachment' => $files]);
        $data = [];
        if($isNews != 'false'){
            $data = [
            'source' => 'PDF',
            'newsletter_insc' => date('d/m/Y'),
            'statut' => 'prospect',
            'birmanie' => false,
            'vietnam' => false,
            'cambodia' => false,
            'laos' => false
        ];
        }
        $listID = $isNews != 'false' ? 1688900 : 1711181;
        $this->addContactToMailjet($email, $listID, $data);
    
    return true;
}


    public function getWatermarkimage($image)
    {

        //  $img = DIR.'upload/home/lolo-noir-cao-bang-vietnam.jpg';
        // var_dump(Yii::getAlias('@webroot'));exit;
        $wr = Yii::getAlias('@webroot');
        // $img = $wr.'/upload/home/baie-dalong-vietnam.jpg';
        $img = $wr . $image;
        $img_size = getimagesize($img);
        $w = $img_size[0] - 110;
        $h = $img_size[1] - 74;
        $img_w = $wr . '/assets/img/page2016/logo_watermark_new.png';
        // $img_w = DIR.'assets/img/page2016/watermark_logo.jpg';
        $src = Yii::$app->easyimage->getUrl($img, ['watermark' => ['image' => $img_w, 'offset_x' => $w, 'offset_y' => 7]], $absolute = false);
        //var_dump($src);exit;

        return str_replace('\\', '/', $src);


    }

    public function confirmAmica($email = '', $params = []){

            $mj = new Client('35d34aefe4ca059fc1dcc6329ae595e4', '52540d6e2c0b3108a0a810935731b11b',true,['version' => 'v3.1']);
            $mj->setTimeout(30);
            $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "relation.voyageur@amica-travel.com",
                  'Name' => "Amica Travel"
                ],
                'To' => [
                  [
                    'Email' => $email,
                    'Name' => ""
                  ]
                ],
                'TemplateID' => 552860,
                'TemplateLanguage' => true,
                'Subject' => empty($params['subject']) ? "Votre demande a été envoyée !" : $params['subject'],
                'Variables' => [
                    'reasonEmail' => empty($params['reasonEmail']) ? '' : $params['reasonEmail'],
                    'name' =>  empty($params['name']) ? '' : str_replace(['Monsieur', 'Madame'], ['M.', 'Mme.'], $params['name']),
                    'tourName' => empty($params['tourName']) ? '' : $params['tourName'],
                    'guideName' => empty($params['guideName']) ? '' : $params['guideName'],
                ],
              ]
            ]
          ];
          if(!empty($params['attachment'])){
                $b64Pdf = chunk_split(base64_encode(file_get_contents($params['attachment'])));
                $body['Messages'][0]['Attachments'] =  [
                [
                    'Filename' => empty($params['tourName']) ? $params['guideName'].'.pdf' : $params['tourName'].'.pdf',
                    'ContentType' => "application/pdf",
                    'Base64Content' => $b64Pdf
                ]
            ];
          }

          $response = $mj->post(Resources::$Email, ['body' => $body]);
          $response->success() && var_dump($response->getData());
    }

    public function confirmAmicaDevis($email = '', $params = []){

            $mj = new Client('35d34aefe4ca059fc1dcc6329ae595e4', '52540d6e2c0b3108a0a810935731b11b',true,['version' => 'v3.1']);
            $mj->setTimeout(30);
            if(isset($params['name'])){
                    $params['name'] = str_replace(['Monsieur', 'Madame'], ['M', 'Mme'], $params['name']);
            }
            $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "relation.voyageur@amica-travel.com",
                  'Name' => "Amica Travel"
                ],
                'To' => [
                  [
                    'Email' => $email,
                    'Name' => ""
                  ]
                ],
                'TemplateID' => 927213,
                'TemplateLanguage' => true,
                'Subject' => empty($params['subject']) ? "Votre demande a été envoyée !" : $params['subject'],
                'Variables' => [
                    'name' =>  empty($params['name']) ? '' : str_replace(['Monsieur', 'Madame'], ['M.', 'Mme.'], $params['name']),
                    "f_countriestovisit" => !empty($params['data']->countriesToVisit) ? implode(', ',$params['data']->countriesToVisit) : ucwords(implode(', ', !empty($params['entry']->data->countries) ? $params['entry']->data->countries : [])),
                    "f_departuredate" => !empty($params['data']->departureDate) ? $params['data']->departureDate : 'N/A',
                    "f_tourlength" => !empty($params['data']->tourLength) ? $params['data']->tourLength : 'N/A',
                    "f_tour" => !empty($params['data']->tourName) ? $params['data']->tourName : 'N/A',
                    "f_message" =>  !empty($params['data']->message) ? $params['data']->message : 'N/A',
                    "f_pourceprojet" =>  !empty($params['data']->pourCeProjet) ? $params['data']->pourCeProjet : 'N/A',
                    "f_budget" => !empty($params['data']->budget) ? $params['data']->budget : 'N/A'
                ],
              ]
            ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);
          $response->success() && var_dump($response->getData());
    }

    public function confirmAmicaDevis2($email = '', $params = []){

            $mj = new Client('35d34aefe4ca059fc1dcc6329ae595e4', '52540d6e2c0b3108a0a810935731b11b',true,['version' => 'v3.1']);
            $mj->setTimeout(30);
            if(isset($params['name'])){
                    $params['name'] = str_replace(['Monsieur', 'Madame'], ['M', 'Mme'], $params['name']);
            }
            $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "relation.voyageur@amica-travel.com",
                  'Name' => "Amica Travel"
                ],
                'To' => [
                  [
                    'Email' => $email,
                    'Name' => ""
                  ]
                ],
                'TemplateID' => 1212117,
                'TemplateLanguage' => true,
                'Subject' => empty($params['subject']) ? "Votre demande de personnalisation a été envoyée !" : $params['subject'],
                'Variables' => [
                    "name" => !empty($params['name']) ? $params['name'] : '',
                    "f_rythme" => !empty($params['data']->mealsIncluded) ? $params['data']->mealsIncluded : 'N/A',
                    "f_liberte" => !empty($params['data']->de_liberte) ? $params['data']->de_liberte : 'N/A',
                    "f_message" =>  !empty($params['data']->message) ? $params['data']->message : 'N/A',
                    "f_des_devis" => !empty($params['data']->des_devis) ? $params['data']->des_devis : 'N/A',
                    "f_se_baseront" => !empty($params['data']->se_baseront) ? $params['data']->se_baseront : 'N/A',
                    "f_hoteltypes" => !empty($params['data']->hotelTypes) ? implode(', ',$params['data']->hotelTypes) : ucwords(implode(', ', !empty($params['entry']->data->hotelTypes) ? $params['entry']->data->hotelTypes : [])),
                    "f_budget" => !empty($params['data']->budget) ? $params['data']->budget : 'N/A',
                    "f_howmessage" => !empty($params['data']->howMessage) ? $params['data']->howMessage : 'N/A',
                    "f_howhobby" => !empty($params['data']->howHobby) ? $params['data']->howHobby : 'N/A',
                ],
              ]
            ]
          ];
          
          $response = $mj->post(Resources::$Email, ['body' => $body]);
          $response->success() && var_dump($response->getData());
    }


    public function isSubscribed(string $email){
        // $mj = new Mailjet('35d34aefe4ca059fc1dcc6329ae595e4', '52540d6e2c0b3108a0a810935731b11b');
        // $params = array(
        //             "method" => "VIEW",
        //             "ID" => $email,
        //          );
        $response = false;
        // $result = $mj->contact($params);
        // if($result) $response = true;
        return $response;
    }

    public function actionImsprint($id = 0, $code = 0) {
        $key = 'hu4n12bb';
        if ($id == 0) {
            die('NOT OK');
        }
        $handle = fopen('https://my.amicatravel.com/products/x/' . $id, 'r');
        //$handle = fopen('http://www.etourhome.com/products/x/' . $id, 'r');
        //$handle = fopen('http://www.w3schools.com/php/func_filesystem_fopen.asp', 'r');
        $data = stream_get_contents($handle);
        //$data = Security::decrypt($rawData, $key);

        $theProduct = unserialize($data);
        if ($code != md5($theProduct['created_at'])) {
            die('NOT OK');
        }
        $theProduct['createdBy']['fname'] = $this->vn_str_filter($theProduct['createdBy']['fname']);
        $theProduct['createdBy']['lname'] = $this->vn_str_filter($theProduct['createdBy']['lname']);
        $data = unserialize($data);
        
        
      //  var_dump($data['days'][0]['body']);exit;
       // echo "<pre>";
       // print_r($data['days'][0]['body']);
       // exit;

        return $this->renderPartial('//page2016/imsPrint', [
                    'theProduct' => $theProduct
        ]);
    }

    public function actionImsprintB2b($id = 0, $code = 0) {
        $key = 'hu4n12bb';
        if ($id == 0) {
            die('NOT OK');
        }

        $handle = fopen('https://my.amicatravel.com/products/x/' . $id, 'r');
        $data = stream_get_contents($handle);

        $theProduct = unserialize($data);
        if ($code != md5($theProduct['created_at'])) {
            die('NOT OK');
        }
        $theProduct['createdBy']['fname'] = $this->vn_str_filter($theProduct['createdBy']['fname']);
        $theProduct['createdBy']['lname'] = $this->vn_str_filter($theProduct['createdBy']['lname']);
        $data = unserialize($data);


        return $this->renderPartial('//page2016/imsPrintB2b', [
                    'theProduct' => $theProduct
        ]);
    }
     public function actionImsprintB2bEn($id = 0, $code = 0) {
        $key = 'hu4n12bb';
        if ($id == 0) {
            die('NOT OK');
        }

        $handle = fopen('https://my.amicatravel.com/products/x/' . $id, 'r');
        $data = stream_get_contents($handle);

        $theProduct = unserialize($data);
        if ($code != md5($theProduct['created_at'])) {
            die('NOT OK');
        }
        $theProduct['createdBy']['fname'] = $this->vn_str_filter($theProduct['createdBy']['fname']);
        $theProduct['createdBy']['lname'] = $this->vn_str_filter($theProduct['createdBy']['lname']);
        $data = unserialize($data);
       // print_r($data['conditions']);exit;
       //var_dump($data);exit;
        return $this->renderPartial('//page2016/imsPrintB2b_en', [
                    'theProduct' => $theProduct
        ]);
    }

    function vn_str_filter($str) {

        $unicode = array(
            'a' => 'á|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|�?|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|�?|õ|�?|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|�?|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => '�?|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => '�?',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => '�?|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|�?|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => '�?|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach ($unicode as $nonUnicode => $uni) {

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        return $str;
    }

    public function actionRdvSurParis()
    {

//        if(IS_MOBILE){
//            throw new HttpException(404, 'Page ne pas trouvé!');
//        }
        if(!$_POST){
            Yii::$app->session->set('backUrl', Yii::$app->request->referrer);
        }
        $this->layout = 'main-form';
        if(IS_MOBILE){
            $this->layout = 'mobile-form';
        }
        $theEntry = Page::get(32);
        $this->root = $theEntry;
        $this->entry = $theEntry;
        
        $allCountries = Country::find()->select(['code', 'dial_code', 'name_fr'])->orderBy('name_fr')->asArray()->all();
        $allDialCodes = Country::find()->select(['code', 'CONCAT(name_fr, " (+", dial_code, ")") AS xcode'])->where('dial_code!=""')->orderBy('name_fr')->asArray()->all();
      
        
        if (!$theEntry) throw new HttpException(404, 'Page ne pas trouvé!');
        
        $this->getSeo($theEntry->model->seo);
        $model = new ContactForm;
        if(IS_MOBILE){
            $model = new ContactFormMobile;
            $model->scenario = 'rdv-surparis-mobile';
        } else {
            $model->scenario = 'rdv-surparis';
        }
        
        
        $model->country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        $model->countryCallingCode = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : 'fr';
        
        if ($model->load($_POST) && $model->validate()) {
            
            $data2 = $this->processingDataAllForm($model);
            
            if (IS_MOBILE) {
//            $model->fname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[0];
//            $model->lname = '';
//            if (isset(preg_split("/\s+(?=\S*+$)/", $model->fullName)[1])) {
//                $model->lname = preg_split("/\s+(?=\S*+$)/", $model->fullName)[1];
//            }
            
           

            $this->saveInquiry($model, 'Form-rdv-paris-mobile', $data2);
            } else {
                
            
            
            

            $this->saveInquiry($model, 'Form-rdv-paris', $data2);
            
           
            }
            $data = [
                            'firstname' => $model->fname,
                            'lastname' => $model->lname,
                            'codecontry' => $model->country,
                            'sex' => $model->prefix
                        ];
            if($model->newsletter)
            $data = [
                'firstname' => $model->fname,
                'lastname' => $model->lname,
                'codecontry' => $model->country,
                'source' => 'newsletter',
                'sex' => $model->prefix,
                'newsletter_insc' => date('d/m/Y'),
                'statut' => 'prospect',
                'birmanie' => false,
                'vietnam' => false,
                'cambodia' => false,
                'laos' => false
            ];
            $listID = $model->newsletter ? 1688900 : 1711181;
            $this->addContactToMailjet($model->email, $listID, $data);
            $this->notifyAmica('RDV sur Paris from ' . $model->email, '//page2016/email_template', ['data2' => $data2]);
            $this->confirmAmica($model->email, ['reasonEmail' => 'contact', 'name' => $model->prefix.' '.$model->lname]);
             Yii::$app->session->set('sex', $model->prefix);
            Yii::$app->session->set('name', $model->lname);
            return Yii::$app->response->redirect(DIR . 'merci?from=rdv-paris&id=' . $this->id_inquiry);
        }

        $listData = array();
        for ($i = 1; $i <= 20; $i++) {
            $key = $i . 'er arrondissement';
            $listData[$key] = $i . 'er arrondissement';
        }

        return $this->render(IS_MOBILE ? '//page2016/mobile/rdv-sur-paris-mobile' : '//page2016/rdv-sur-paris', [
            'theEntry' => $theEntry,
            'model' => $model,
            'listData' => $listData,
            'allCountries' => $allCountries,
            'allDialCodes' => $allDialCodes,
        ]);
    }

    // Function get breadcrumb
    protected function getBreadCrumb($params = '') {
        $arr = array();
        $theEntry = array();

        switch ($params) {
            case 'destination':
                $theEntry = Page::get('destinations');
                break;
            case 'breadcrumb-3':
                $theEntry = \app\modules\destinations\api\Catalog::cat(SEG1);
                break;
            case 'breadcrumb-4':
                $theEntry = \app\modules\destinations\api\Catalog::cat(SEG1 . '/' . SEG2);
                break;
            default:
                $theEntry = Page::get('destinations');
                break;
        }

        $arr['title'] = $theEntry->model->seo->breadcrumb ?: '';
        $arr['url'] = $theEntry->model->slug ?: '#';
        return $arr;
    }

    protected function setCacheForBlogs($theEntry, $params) {

        $key= 'data-cache-' . $params . '-blogs';
        $cache = Yii::$app->cache;

        // try retrieving $data from cache
        $data = $cache->get($key);
        if (empty($data)) {
            $arrBlog = $dataBlogSelected = array();

            /* $dataBlogSelected get data default blog */
            if(!empty($theEntry->data->blogs)) {
                $dataBlogSelected = $theEntry->data->blogs;
            } else {
                $dataBlogSelected = ["13749", "13849", "13502"];
                switch (SEG1) {
                    case 'vietnam':
                        // LOCAL: 13
                        // DEMO SITE: 20
                        // ON SITE: 29
                        if(!empty(\app\modules\modulepage\api\Catalog::get(29)->data->blogs)) {
                            $dataBlogSelected = \app\modules\modulepage\api\Catalog::get(29)->data->blogs;
                        }
                        break;
                    case 'cambodge':
                        // LOCAL: 17
                        // DEMO SITE: 22
                        // ON SITE: 27
                        if(!empty(\app\modules\modulepage\api\Catalog::get(27)->data->blogs)) {
                            $dataBlogSelected = \app\modules\modulepage\api\Catalog::get(27)->data->blogs;
                        }
                        break;
                    case 'laos':
                        // LOCAL: 15
                        // DEMO SITE: 24
                        // ON SITE: 28
                        if(!empty(\app\modules\modulepage\api\Catalog::get(28)->data->blogs)) {
                            $dataBlogSelected = \app\modules\modulepage\api\Catalog::get(28)->data->blogs;
                        }
                        break;
                    case 'birmanie':
                        // LOCAL: 16
                        // DEMO SITE: 26
                        // ON SITE: 30
                        if(!empty(\app\modules\modulepage\api\Catalog::get(30)->data->blogs)) {
                            $dataBlogSelected = \app\modules\modulepage\api\Catalog::get(30)->data->blogs;
                        }
                        break;
                    default:
                        $dataBlogSelected = ["13749", "13849", "13502"];
                        break;
                }
            }

            /* $arrBlog contain data for frontend */
            foreach ($dataBlogSelected as $keyBlog => $valueBlog) {
                // Get all blogs
                if(!isset($arrBlog[$keyBlog])) continue;
                $arrBlog[$keyBlog] = $this->getDataPost($valueBlog);
                $arrBlog[$keyBlog]['cat_name'] = $this->getCategoryName($arrBlog[$keyBlog]['categories'][0])['name'];
                $featuredMediaData = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media']);
                if(isset($featuredMediaData['data']['status']) == 404) {
                    $arrBlog[$keyBlog]['alt_text'] = '';
                    $arrBlog[$keyBlog]['src'] = '';
                } else {
                    $featuredMediaData = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['media_details']['sizes']['barouk_list-thumb'];
                    $arrBlog[$keyBlog]['alt_text'] = $this->getFeatureImage($arrBlog[$keyBlog]['featured_media'])['alt_text'];
                    $arrBlog[$keyBlog]['src'] = '/timthumb.php?src=' . $featuredMediaData['source_url'] . '&w=300&h=200&zc=1&q=80';
                }
            }
            // $data is not found in cache, calculate it from scratch
            $data = $arrBlog;

            // store $data in cache so that it can be retrieved next time
            $cache->set($key, $data);
        }

        // $data is available here
        return $data;
    }

    protected function deleteAllCache(){
        Yii::$app->cache->flush();
    }

    public function actionForIms($id = 0)
    {
        $key = 'hu4n12bb';
        $result = '';
        $theInquiries = Yii::$app->db->createCommand('SELECT * FROM at_inquiries WHERE id>:id ORDER BY id LIMIT 10', [':id'=>$id])->queryAll();

        $str = serialize($theInquiries);
        $arr = str_split($str);
        foreach ($arr as $chr) {
            $result .= '-'.ord($chr);
        }
        echo $result;
    }
    public function actionAjaxResultMenu(){
        
        $key= 'data-cache-menu-021';
        $cache = Yii::$app->cache;

        // try retrieving $data from cache
        $cache->delete($key);
        $data = $cache->get($key);
        if(empty($data)){
            
            if(Yii::$app->request->post('flag') == 'ok'){
                $data = $this->renderPartial('//page2016/_inc_sub_menu');
                $cache->set($key, $data);
                //return $this->renderPartial('//page2016/_inc_sub_menu');
            }
        }
        
        return $data;
    }
    public function actionPromotionBasseSaisonAboutUs(){
        
        $this->metaIndex = 0;
        $this->metaFollow = 0;
        $theEntry = \yii\easyii\modules\page\api\Page::get('promotion-basse-saison');
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        $this->getSeo($theEntry->model->seo);
        
        return $this->render(IS_MOBILE ? '//page2016/mobile/promotion-basse-saison' : '//page2016/promotion-basse-saison', [
                    'theEntry' => $theEntry,
        ]);
    }

    public function actionLoadMenuResponsive(){
        if(Yii::$app->request->isAjax && Yii::$app->request->post('type') == 'menu-responsive'){
            return $this->renderPartial('//layouts/menu-responsive');
        }
    }
    public function getDataUpdateMeta(){
       
            // get data country
            $datacountry = NULL;
            if(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie'){
                $datacountry = NULL;
            }else{
                if(yii::$app->request->get('country') && yii::$app->request->get('country') != 'all'){
                    $datacountry = yii::$app->request->get('country');
                    $datacountry = ' - ' . ucwords(implode(', ', explode('-', $datacountry)));
                }else{
                    $datacountry = NULL;
                }
            }

            // get data length
            $datalength = NULL;
            
            if(yii::$app->request->get('length') && yii::$app->request->get('length') != 'all'){
               // $datalength = yii::$app->request->get('length');
               // $datalength = explode('-', $datalength);
                $tmp = [];
               
                foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) {
                    if(strpos(yii::$app->request->get('length'), strval($key)) !== false){
                        
                        $tmp[] = $value;
                        $datalength = ' - Durée : '.implode(', ', $tmp);
                    }
                }
                
            }else{
                $datalength = NULL;
            }
            
            //get data type
           // var_dump(Yii::$app->controller->action->id);exit;
            $datatype = NULL;
            if(yii::$app->request->get('type') && yii::$app->request->get('type') != 'all'){
                $datatype = yii::$app->request->get('type');
                $tmp = [];
                if(URI == 'voyage/itineraire' || URI == SEG1.'/itineraire' || URI == SEG1.'/itineraire/'.SEG3){
                    $type = \app\modules\programmes\models\Category::find()->roots()->orderBy('order_num desc')->all();
                }
                if(URI == 'formules/itineraire' || URI == SEG1.'/formules' || URI == SEG1.'/formules/'.SEG3  || URI == 'formules/'.SEG2){
                    $type = \app\modules\exclusives\models\Category::find()->roots()->orderBy('order_num desc')->all();
                }
                
                foreach (explode('-', $datatype) as $v){
                    foreach ($type as $key => $value) {
                        if($v == $value->category_id){
                            $tmp[] = $value->title;
                        }
                    }
                }
                $datatype = ' - '.implode(', ', $tmp);
            }else{
                $datatype = NULL;
            }
        
        return [
            'dataCountry' => $datacountry,
            'dataLength' => $datalength,
            'dataType' => $datatype
        ];    
    }
    public function getDataUpdateMetaTesti(){
        
        $datacountry = NULL;
        if(yii::$app->request->get('country') && yii::$app->request->get('country') != 'all'){
            $datacountry = yii::$app->request->get('country');
            $selectDes = explode('-',Yii::$app->request->get('country'));
            $tmp = [];
            foreach(Yii::$app->params['tsDestinationList'] as $key => $value) {
                if(in_array($key, $selectDes)){
                    $tmp[] = $value;
                }
            }
            $datacountry = ' - ' . ucwords(implode(', ', $tmp));
        }else{
            $datacountry = NULL;
        }
        
        
        $datatype = NULL;
        if(yii::$app->request->get('type') && yii::$app->request->get('type') != ''){
            $datatype = yii::$app->request->get('type');
            $tmp = [];
            
            $selectType = explode(',',Yii::$app->request->get('type'));
            foreach(Yii::$app->params['tTourTypes'] as $key => $value) {
                if(in_array($key, $selectType)){
                    $tmp[] = $value;
                }
            }
               
            $datatype = ' - '.implode(', ', $tmp);
        }else{
            $datatype = NULL;
        }
        
        
        $datatheme = NULL;
        if(yii::$app->request->get('theme') && yii::$app->request->get('theme') != 'all'){
            $datatheme = yii::$app->request->get('theme');
            $tmp = [];
            $selectTheme = explode(',',Yii::$app->request->get('theme'));
            foreach(Yii::$app->params['tTourThemes'] as $key => $value) {
                 if(in_array($key, $selectTheme)){
                    $tmp[] = $value;
                }
            }
            $datatheme = ' - '.implode(', ', $tmp);
        }else{
            $datatheme = NULL;
        }
        return [
            'dataCountry' => $datacountry,
            'dataLength' => $datatheme,
            'dataType' => $datatype
        ];    
    }
    
    public function processingDataAllForm($model){

        $dataonform = [
            'tourName' => isset($model->tourName) ? $model->tourName : '',
            'tourUrl' => isset($model->tourUrl) ? $model->tourUrl : '',
            'vouspartez' => isset($model->vouspartez) ? $model->vouspartez : '',
            'numberOfTravelers18' => (isset($model->numberOfTravelers18) && isset($model->vouspartez) && $model->vouspartez != 'En couple') ? $model->numberOfTravelers18 : '2',
            'numberOfTravelers12' => isset($model->numberOfTravelers12) ? $model->numberOfTravelers12 : '',
            'numberOfTravelers2' => isset($model->numberOfTravelers2) ? $model->numberOfTravelers2 : '',
            'numberOfTravelers0' => isset($model->numberOfTravelers0) ? $model->numberOfTravelers0 : '',
            'agesOfTravelers12' => isset($model->agesOfTravelers12) ? $model->agesOfTravelers12 : '',
            'howTraveler' => isset($model->howTraveler) ? $model->howTraveler : '',
            'countriesToVisit' => isset($model->countriesToVisit) ? implode(', ', (array)$model->countriesToVisit) : '',
            'departureDate' => isset($model->departureDate) ? $model->departureDate : '',
            'deretourDate' => isset($model->deretourDate) ? $model->deretourDate : '',
            'tourLength' => isset($model->tourLength) ? $model->tourLength : '',
            'howTicket' => isset($model->howTicket) ? $model->howTicket : '',
            'ticketDetail' => isset($model->ticketDetail) ? $model->ticketDetail : '',
            'helpTicket' => isset($model->helpTicket) ? $model->helpTicket : '',
            'tourThemes' => isset($model->tourThemes) ? implode(', ',(array)$model->tourThemes) : '',
            'hotelTypes' => isset($model->hotelTypes) ? implode(', ', (array)$model->hotelTypes) : '',
            'hotelRoomDbl' => isset($model->hotelRoomDbl) ? $model->hotelRoomDbl : '',
            'hotelRoomTwn' => isset($model->hotelRoomTwn) ? $model->hotelRoomTwn : '',
            'hotelRoomTrp' => isset($model->hotelRoomTrp) ? $model->hotelRoomTrp : '',
            'hotelRoomSgl' => isset($model->hotelRoomSgl) ? $model->hotelRoomSgl : '',
            'message' => isset($model->message) ? $model->message : '',
            'desSites' => isset($model->desSites) ? $model->desSites : '',
            'extension' => isset($model->extension) ? implode(', ', (array)$model->extension) : '',
            'mealsIncluded' => isset($model->mealsIncluded) ? $model->mealsIncluded : '',
            'de_liberte' => isset($model->de_liberte) ? $model->de_liberte : '',
            'des_devis' => isset($model->des_devis) ? $model->des_devis : '',
            'se_baseront' => isset($model->se_baseront) ? $model->se_baseront : '',
            'pourCeProjet' => isset($model->pourCeProjet) ? $model->pourCeProjet : '',
            'budget' => isset($model->budget) ? $model->budget : '',
            'budgetPlafond' => isset($model->budgetPlafond) && $model->budgetPlafond == 1 ? 'Oui' : 'Non',
            'premierVoyage' => isset($model->premierVoyage) && $model->premierVoyage == 1 ? 'Oui' : 'Non',
            'howMessage' => isset($model->howMessage) ? $model->howMessage : '',
            'howHobby' => isset($model->howHobby) ? $model->howHobby : '',
            'callback' => isset($model->callback) && $model->callback == 'Oui' ? $model->callback : 'Non, pas dans l\'immédiat',
            'countryCallingCode' => isset($model->countryCallingCode) ? $model->countryCallingCode : '',
            'phone' => isset($model->phone) ? $model->phone : '',
            'callDate' => isset($model->callDate) ? $model->callDate : '',
            'callTime' => isset($model->callTime) ? implode(', ',(array)$model->callTime) : '',
            'prefix' => isset($model->prefix) ? $model->prefix : '',
            'lname' => isset($model->lname) ? strtoupper($model->lname) : '',
            'fname' => isset($model->fname) ? $model->fname : '',
            'fullName' => isset($model->fullName) ? strtoupper($model->fullName) : '',
            'email' => isset($model->email) ? $model->email : '',
            'code_postal' => isset($model->code_postal) ? $model->code_postal : '',
            'age' => isset($model->age) ? $model->age : '',
            'period' => isset($model->period) ? $model->period : '',
            'subjet' => isset($model->subjet) ? $model->subjet : '',
            'country' => isset($model->country) ? $model->country : '',
            'region' => isset($model->region) ? $model->region : '',
            'ville' => isset($model->ville) ? strtoupper($model->ville) : '',
            'telephone' => isset($model->telephone) ? $model->telephone : '',
            'reference' => isset($model->reference) ? $model->reference : '',
            'newsletter' => isset($model->newsletter) && $model->newsletter == 1 ? 'Oui' : 'Non',
            'dialcodeCountry' => isset($model->dialcodeCountry) ? $model->dialcodeCountry : '',
            'duraTime' => isset($model->duraTime) ? $model->duraTime : ''
        ];

        $arr_data = [
            'tourName' => '<b>Dernier circuit lu</b> : {{ tourUrl : <a href="'.$dataonform["tourUrl"].'">'.$dataonform["tourName"].'</a> }}',
            
            'vouspartez' => chr(10).'<b>PARTICIPANTS</b>'.chr(10).chr(10).'Vous partez : {{ vouspartez : '.$dataonform['vouspartez'].' }}'.chr(10),
      
            'numberOfTravelers18' => 'Adulte(s) (>18 ans) : {{ numberOfTravelers18 : '.$dataonform['numberOfTravelers18'].' }}',
            'numberOfTravelers12' => 'Ado(s) (12-17 ans) : {{ numberOfTravelers12 : '.$dataonform['numberOfTravelers12'].' }}',
            'numberOfTravelers2' => 'Enfant(s) (2-11 ans) : {{ numberOfTravelers2 : '.$dataonform['numberOfTravelers2'].' }}',
            'numberOfTravelers0' => 'Bébé(s) (<2 ans) : {{ numberOfTravelers0 : '.$dataonform['numberOfTravelers0'].' }}',
            'agesOfTravelers12' => 'Détails d’âges de tous les participants : {{ agesOfTravelers12 : '.$dataonform['agesOfTravelers12'].' }}',
            'howTraveler' =>  $dataonform['vouspartez'] == 'Seul(e)' ? 'Le niveau d\'activité physique du participant :' .' {{ howTraveler : '.$dataonform['howTraveler'].' }}'.chr(10) : 'Le niveau d\'activité physique des participants :' .' {{ howTraveler : '.$dataonform['howTraveler'].' }}'.chr(10),
            
            'countriesToVisit' => 'Destination(s) (Plusieurs choix possible) : {{ countriesToVisit : '.$dataonform['countriesToVisit'].' }}',
            'departureDate' => 'Date d’arrivée approximative : {{ departureDate : '.$dataonform['departureDate'].' }}',
            'deretourDate' => 'Date de retour approximative : {{ deretourDate : '.$dataonform['deretourDate'].' }}',
            'tourLength' => Yii::$app->params['questions_form']['tourLength'][0] . ' : {{ tourLength : '.$dataonform['tourLength'].' }}'.chr(10),
            
            'howTicket' => 'Avez-vous déjà acheté votre (vos) billet(s) d’avion internationaux aller-retour ? : {{ howTicket : '.$dataonform['howTicket'].' }}',
            'ticketDetail' => 'Détaillez votre plan de vol : {{ ticketDetail : '.$dataonform['ticketDetail'].' }}',
            
            'tourThemes' => chr(10).'<b>DECRIVEZ VOTRE PROJET</b>'.chr(10).chr(10).'Thématiques du voyage (plusieurs choix possible) : {{ tourThemes : '.$dataonform['tourThemes'].' }}',
            'hotelTypes' => 'Quel(s) type(s) d’hébergement aimeriez-vous pour ce voyage ? : {{ hotelTypes : '.$dataonform['hotelTypes'].' }}'.chr(10),
            
            'hotelRoomDbl' => 'Combien de chambres souhaitez-vous ?' .chr(10). 'Chambre double avec un grand lit : {{ hotelRoomDbl : '.$dataonform['hotelRoomDbl'].' }}',
            'hotelRoomTwn' => 'Chambre double avec 2 lits : {{ hotelRoomTwn : '.$dataonform['hotelRoomTwn'].' }}',
            'hotelRoomTrp' => 'Chambre pour 3 personnes : {{ hotelRoomTrp : '.$dataonform['hotelRoomTrp'].' }}',
            'hotelRoomSgl' => 'Chambre individuelle : {{ hotelRoomSgl : '.$dataonform['hotelRoomSgl'].' }}'.chr(10),
            
            'message' => '<b>Décrivez votre projet</b> : {{ message : '.$dataonform['message'].' }}'.chr(10),
            'desSites' => ' Avez-vous une raison bien particulière d’effectuer ce voyage ? Des lieux à visiter absolument ? : {{ desSites : '.$dataonform['desSites'].' }}',
            'extension' => 'Souhaitez-vous ajouter des formules exclusives à votre programme ? (plusieurs choix possible) : {{ extension : '.$dataonform['extension'].' }}',
            'mealsIncluded' => 'A quel rythme souhaiteriez-vous voyager ? : {{ mealsIncluded : '.$dataonform['mealsIncluded'].' }}',
            'de_liberte' => 'A quel degré de liberté souhaiteriez-vous voyager ? : {{ de_liberte : '.$dataonform['de_liberte'].' }}'.chr(10),
            'des_devis' => 'Avez-vous réalisé des devis auprès d’autres agences ? : {{ des_devis : '.$dataonform['des_devis'].' }}'.chr(10),
            'se_baseront' => 'Mes critères de décision se baseront sur... : {{ se_baseront : '.$dataonform['se_baseront'].' }}'.chr(10),
            'pourCeProjet' => 'Pour ce projet, j\'en suis à : {{ pourCeProjet : '.$dataonform['pourCeProjet'].' }}'.chr(10),
            
            'budget' => '<b>De quel budget approximatif disposez-vous par personne ? (Hors vols internationaux depuis votre pays)</b> : {{ budget : '.$dataonform['budget'].' }}',
            'budgetPlafond' => 'Il s\'agit de mon budget plafond : {{ budgetPlafond : '.$dataonform['budgetPlafond'].' }}',
            
            'premierVoyage' => chr(10).'<b>POUR MIEUX VOUS CONNAÎTRE (FACULTATIF)</b>'.chr(10).chr(10).'Il s\'agit de mon premier voyage : {{ premierVoyage : '.$dataonform['premierVoyage'].' }}',
            'howMessage' => 'Pouvez-vous nous raconter votre dernier voyage long-courrier ? : {{ howMessage : '.$dataonform['howMessage'].' }}',
            'howHobby' => 'Vos loisirs et passe-temps préférés : {{ howHobby : '.$dataonform['howHobby'].' }}',
            
            'callback' => chr(10).'<b>CONVENIR D’UN RDV TELEPHONIQUE</b>'.chr(10).chr(10).'Sollicitez-nous un rendez-vous téléphonique : {{ callback : '.$dataonform['callback'].' }}',
            'phone' => 'Votre numéro de téléphone : {{ dialcodeCountry : +'.$dataonform['dialcodeCountry'].' }} {{ phone : '.$dataonform['phone'].' }}',
            'callDate' => 'Date / heure pour le RDV : {{ callDate : '.$dataonform['callDate'].' }} / {{ callTime : '.$dataonform['callTime'].' }}',
            
            'prefix' => chr(10).'<b>VOS COORDONNEES</b>' .chr(10).chr(10). 'Votre nom et prénom : {{ prefix : '.$dataonform['prefix'].' }} {{ lname : '.$dataonform['lname'].' }} {{ fname : '.$dataonform['fname'].' }}',
            'fullName' => chr(10).'<b>VOS COORDONNEES</b>' .chr(10).chr(10). 'Votre nom complet : {{ prefix : '.$dataonform['prefix'].' }} {{ fullName : '.$dataonform['fullName'].' }}',
            'email' => 'Email : {{ email : '.$dataonform['email'].' }}',
            'code_postal' => 'Code postal : {{ code_postal : '.$dataonform['code_postal'].' }}',
            'age' => 'Année de naissance : {{ age : '.$dataonform['age'].' }}'.chr(10),
            
            'period' => 'Votre RDV souhaité sur Paris : {{ period : '.$dataonform['period'].' }}'.chr(10),
            
            'country' => 'Pays: {{ country : '.$dataonform['country'].' }}',
            'region' => 'Département, Votre ville : {{ region : '.$dataonform['region'].' }} , {{ ville : '.$dataonform['ville'].' }}'.chr(10),
            
            'telephone' => '<b>Téléphone</b> : {{ dialcodeCountry : +'.$dataonform['dialcodeCountry'].' }} {{ telephone : '.$dataonform['telephone'].' }}'.chr(10),
            
            'reference' => 'Si vous êtes recommandé(e) par un ancien client d\'Amica, merci de préciser son nom et prénom : {{ reference : '.$dataonform['reference'].' }}',
            'newsletter' => 'Je souhaite recevoir les newsletters (reportages, promotions, conseils de voyages, etc). : {{ newsletter : '.$dataonform['newsletter'].' }}',
            'duraTime' => '<br><b>Temps sur le page : {{ duraTime : '.$dataonform['duraTime'].' }}</b>'
        ];
      
$data2 = <<<'TXT'

TXT;

$source_to_page = '<b>Dernière page visitée</b> : <a href="'.Yii::$app->session->get('ref', '-').'">'.Yii::$app->session->get('ref', '-').'</a>';

        $scenario = isset($model->scenario) ? $model->scenario : '';
        foreach ($model as $key => $value) {
            if($scenario == 'devis' || $scenario == 'devis_short' || $scenario == 'devis_long' || $scenario == 'devis_mobile' || $scenario == 'devis_short_mobile' || $scenario == 'booking' || $scenario == 'mobileBooking' || $scenario == 'contact_booking' || $scenario == 'mobile_contact_booking'){
                if($dataonform['vouspartez'] == 'Seul(e)'){
                    unset($arr_data['numberOfTravelers18']);
                    unset($arr_data['numberOfTravelers12']);
                    unset($arr_data['numberOfTravelers2']);
                    unset($arr_data['numberOfTravelers0']);
                }
                if($dataonform['vouspartez'] == 'En couple'){
                    unset($arr_data['numberOfTravelers12']);
                    unset($arr_data['numberOfTravelers2']);
                    unset($arr_data['numberOfTravelers0']);
                }
                if($dataonform['howTicket'] != 'Oui'){
                    unset($arr_data['ticketDetail']);
                }
            }
            
            if($scenario == 'devis' || $scenario == 'devis_short' || $scenario == 'devis_short_mobile' || $scenario == 'devis_mobile' || $scenario == 'booking' || $scenario == 'mobileBooking' || $scenario == 'contact_booking' || $scenario == 'mobile_contact_booking'){
               unset($arr_data['des_devis']);
               unset($arr_data['se_baseront']);

            }
            if($scenario == 'devis' || $scenario == 'devis_short' || $scenario == 'devis_long' || $scenario == 'booking' || $scenario == 'contact_booking'){
                if($dataonform['callback'] != 'Oui'){
                    unset($arr_data['phone']);
                    unset($arr_data['callDate']);
                }else{
                    unset($arr_data['telephone']);
                }
            }
            if($scenario == 'devis' || $scenario == 'devis_short' || $scenario == 'devis_long' || $scenario == 'devis_mobile'){
                unset($arr_data['tourName']);
                unset($arr_data['extension']);
            }
            if($scenario == 'contact_booking' || $scenario == 'mobile_contact_booking'){
                unset($arr_data['extension']);
                 
            }
            if($scenario == 'booking' || $scenario == 'mobileBooking' || $scenario == 'contact_booking' || $scenario == 'mobile_contact_booking'){
            
                unset($arr_data['countriesToVisit']);
               
            }
            if($scenario == 'devis_mobile' || $scenario == 'devis_short_mobile' || $scenario == 'mobileBooking' || $scenario == 'mobile_contact_booking'){
            
              //  unset($arr_data['howMessage']);
              // unset($arr_data['howHobby']);
                unset($arr_data['phone']);
            }
            
            // xu ly cho form nous-contacter
            if($scenario == 'contact' || $scenario == 'contact_mobile'){
                unset($arr_data['tourName']);
                unset($arr_data['callback']);
                unset($arr_data['phone']);
                unset($arr_data['callDate']);
                unset($arr_data['reference']);
                unset($arr_data['newsletter']);
                unset($arr_data['period']);
                unset($arr_data['prefix']);
                if($dataonform['subjet'] != 'pdv'){
                   
                    unset($arr_data['country']);
                    unset($arr_data['region']);
                    unset($arr_data['age']);
                   
                }
                
                  unset($arr_data['code_postal']);
            }
            // END xu ly cho form nous-contacter
            
            // xu ly cho form rdv-telephonique
            if($scenario == 'rdv' || $scenario == 'rdv_mobile'){
                unset($arr_data['tourName']);
               unset($arr_data['telephone']);
               unset($arr_data['period']);
               unset($arr_data['prefix']);
               unset($arr_data['age']);
               unset($arr_data['region']);
               unset($arr_data['ville']);
            }
            // END xu ly cho form rdv-telephonique
            
            // xu ly cho form rdv-sur-paris
            if($scenario == 'rdv-surparis' || $scenario == 'rdv-surparis-mobile'){
                unset($arr_data['tourName']);
                unset($arr_data['country']);
                unset($arr_data['region']);
                unset($arr_data['telephone']);
            }
            // END xu ly cho form rdv-sur-paris
            
            
            // xu ly cho form devis_short
            if($scenario == 'devis_short' || $scenario == 'devis_short_mobile'){
                unset($arr_data['extension']); 
            }
            if($scenario == 'devis_short' || $scenario == 'devis_short_mobile' || $scenario == 'booking' || $scenario == 'mobileBooking' || $scenario == 'contact_booking' || $scenario == 'mobile_contact_booking'){
                unset($arr_data['deretourDate']);      
                unset($arr_data['howTicket']);     
                unset($arr_data['ticketDetail']);    
                unset($arr_data['hotelTypes']);  
                unset($arr_data['hotelRoomDbl']);   
                unset($arr_data['hotelRoomTwn']);   
                unset($arr_data['hotelRoomTrp']);   
                unset($arr_data['hotelRoomSgl']);    
                unset($arr_data['desSites']); 
                unset($arr_data['mealsIncluded']); 
                unset($arr_data['de_liberte']);  
                unset($arr_data['premierVoyage']);  
                unset($arr_data['howMessage']);
                unset($arr_data['howHobby']);
                unset($arr_data['age']); 
                unset($arr_data['region']); 
                unset($arr_data['ville ']); 
                unset($arr_data['prefix']);
                
            }
            // End xu ly cho form devis_short
            
            // xu ly cho form devis_long
            if($scenario == 'devis_long' || $scenario == 'devis_long_mobile'){
               
                if($key =='mealsIncluded' ){
                    $data2 .= '<b>DECRIVEZ VOTRE PROJET</b>'.chr(10).chr(10);
                }
            //    $data2 .= '<b>DECRIVEZ VOTRE PROJET</b>'.chr(10).chr(10);
                
                unset($arr_data['vouspartez']);
                unset($arr_data['numberOfTravelers18']);
                unset($arr_data['numberOfTravelers12']);
                unset($arr_data['numberOfTravelers2']);
                unset($arr_data['numberOfTravelers0']);
                unset($arr_data['agesOfTravelers12']);
                unset($arr_data['howTraveler']);
                unset($arr_data['countriesToVisit']);
                unset($arr_data['departureDate']);
                unset($arr_data['deretourDate']);
                unset($arr_data['tourLength']);
                unset($arr_data['howTicket']);
                
                unset($arr_data['tourThemes']);
                unset($arr_data['hotelRoomDbl']);
                unset($arr_data['hotelRoomTwn']);
                unset($arr_data['hotelRoomTrp']);
                unset($arr_data['hotelRoomSgl']); 
                unset($arr_data['desSites']);  
                unset($arr_data['pourCeProjet']);   
                
                unset($arr_data['callback']); 
                
                unset($arr_data['prefix']); 
                unset($arr_data['lname']); 
                unset($arr_data['fname']); 
                unset($arr_data['fullName']); 
                unset($arr_data['email']); 
                unset($arr_data['age']); 
                unset($arr_data['country']); 
                unset($arr_data['region']); 
                unset($arr_data['ville']); 
                unset($arr_data['dialcodeCountry']); 
                unset($arr_data['telephone']); 
                unset($arr_data['reference']);
                unset($arr_data['newsletter']);
            }
            
            if($scenario == 'devis_long_mobile'){
                unset($arr_data['ticketDetail']);
                unset($arr_data['extension']);
                unset($arr_data['dialcodeCountry']);
                unset($arr_data['phone']); 
                unset($arr_data['tourName']); 
            }
            //End xu ly cho form devis_long
            
            if($key == 'tourName'){
               
                $txt_tourName = isset($arr_data[$key]) ? $arr_data[$key].chr(10) : '';
                
            }else{
                $data2 .= isset($arr_data[$key]) ? $arr_data[$key].chr(10) : '';
            }
        }
        $data2 .= $source_to_page . chr(10);
        $data2 .= isset($txt_tourName) ? $txt_tourName : '' ;
//        echo '<pre>';
//        print_r($data2);
//        echo '</pre>';exit;
        
        return $data2;
        
    }

    public function actionImportCity(){
        // var_dump(BASE_PATH.'uploads/files/location.csv');exit;
        $file = fopen(BASE_PATH.'uploads/files/location.csv', "r");
        while(!feof($file))
          {
            $ifile = fgetcsv($file);
            $model = \app\modules\destinations\models\Item::findOne((int)$ifile[0]);
            if($model){
                    $model->data->latitude = $ifile[1];
                    $model->data->longitude = $ifile[2];
                    var_dump($model->save());
                    
            }
           
          }

        fclose($file);
    }

    public function actionWidgetContent(){
        $widgets = \app\modules\widgets\models\Text::find()->all();
        return $this->renderPartial('//browser', ['widgets' => $widgets]);
    }
    
    public function actionLandingPage(){
        
        $theEntry = \yii\easyii\modules\page\api\Page::get('vietnam/circuit-vietnam');
    
        if (!$theEntry) throw new HttpException(404, 'Oops! Cette page n\'existe pas.');
        
        $this->getSeo($theEntry->model->seo);
        
        $this->layout = 'landing-page';
        if(IS_MOBILE){
            $this->layout = 'mobile-landing-page';
        }
        
        
        
        $getAjaxFilter = $this->getAjaxFilter(['country'=>SEG1, 'type'=>'','length'=>'']);
        
        //$theEntries = $getAjaxFilter['voyage'];    
        
        $totalCount = $getAjaxFilter['totalCount'];
        
       
        $arrSuggest = [];
    //var_dump(\app\modules\programmes\api\Catalog::get(5));exit;
    //var_dump($theEntry->data->programes);exit;
    if(!empty($theEntry->data->programes)){
        foreach ($theEntry->data->programes as $i){
           // var_dump($i);exit;
            $item_suggest = \app\modules\programmes\api\Catalog::get(floatval($i));
            if($item_suggest){
                $arrSuggest[] = $item_suggest;
            }
        }
    }
    
    $theEntries = $arrSuggest;
    //var_dump($arrSuggest);exit;
        
        
//        if (Yii::$app->request->isAjax  && !IS_MOBILE) {
//           
//            $this->countTour = $this->getAjaxFilter(['country'=>'vietnam','type'=>'','length'=>''])['totalCount'];
//           
//            return $this->countTour;
//            
//        }  
         // Temoignages
            $dataTemoignageItems = [];
            // Yii::$app->cache->delete('cache-testi-home');
            $dataTemoignageSelected = \app\modules\modulepage\api\Catalog::get('temoignages-adwords-circuit-vietnam');
            if(isset($dataTemoignageSelected->data->temoignages)) {
                $dataTemoignageSelected = $dataTemoignageSelected->data->temoignages;
                $dataTemoignageItems = \app\modules\whoarewe\models\Item::find()->where(['in', 'item_id', $dataTemoignageSelected])->with(['photos'=> function (\yii\db\ActiveQuery $query) {
                    $query->andWhere(['type' => 'on-home']);
                }])->asArray()->all();
                $dataTemoignageItems = ArrayHelper::map($dataTemoignageItems, 'item_id', function($element){
                    $element['data'] = json_decode($element['data']);
                    return $element;
                });
                uksort($dataTemoignageItems, function($key1, $key2) use ($dataTemoignageSelected) {
                    return (array_search($key1, $dataTemoignageSelected) > array_search($key2, $dataTemoignageSelected));
                });
            }
        
        $portrain = \app\modules\whoarewe\api\Catalog::get(1391);
        return $this->render(IS_MOBILE ? '//page2016/mobile/landing-page-090120' : '//page2016/landing-page-090120', [
            'totalCount' => $totalCount,
            'theEntry' => $theEntry,
            'theEntries' => $theEntries,
            'portrain' => $portrain,
            'arrTemoignages' => $dataTemoignageItems,
        ]);
    }
    
}
