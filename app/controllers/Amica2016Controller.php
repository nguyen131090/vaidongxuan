<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use yii\web\HttpException;
use yii\data\Pagination;
use yii\helpers\Security;
//use app\vendor\Mobile_Detect\Mobile_Detect;
use app\vendor\Mobile_Detect\Mobile_Detect;




class Amica2016Controller extends Controller {

    public $hotelMenu = [];
    public $pageT = '';
    public $metaT = '';
    public $metaD = '';
    public $canonical = '';
    public $site;
    public $countTour = 0;

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);

        
        
      //  if (!$this->site) throw new HttpException(404, 'Web site could not be found.');


        // Original http referrer
        if (!Yii::$app->session->get('ref')) {
            Yii::$app->session->set('ref', Yii::$app->request->getReferrer());
        }

        // Detect mobile

//        if (!defined('IS_MOBILE')) {
//            //$detect = new Mobile_Detect;
//            $detect = new Mobile_Detect;
//            //$detect = Yii::$app->mobileDetect;
//            if ($detect->isMobile() && !$detect->isTablet()) {
//                define('IS_MOBILE', true);
//            } else {
//                define('IS_MOBILE', false);
//            }
//        }
//
//        // Mobile layout
//        if (IS_MOBILE) {
//            $this->layout = 'mobile';
//        }
//        //hotel menu
//        if (!IS_MOBILE) {
//            $this->hotelMenu = $this->getHotelmenu();
//        }
        
     
    }

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'width' => 100,
                'height' => 34,
                'foreColor' => 0xC74CA3,
                'minLength' => 4,
                'maxLength' => 4,
                'offset' => 2,
                'transparent' => true,
            ],
        ];
    }

    
        
      
             
       
    

    // TODO page cache

    public function actionError() {
        $this->metaT = 'Oops! Cette page n\'existe pas';
        return $this->render('//error');
    }
    

    
   
   

    public function actionIndex() {
        
        
        return $this->render('//page2016/home');
    }

   
   
}
