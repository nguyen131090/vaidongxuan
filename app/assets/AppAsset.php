<?php
namespace app\assets;

class AppAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $sourcePath = '@app/media';
    public $css = [
       '/assets/css/normalize.css',
       '/assets/css/rules/spacing.css',
       '/assets/css/page2016/fonts.css',
       '/assets/js/bootstrap/full-slider.css',
       '/assets/js/bxslider/jquery.bxslider.css',
       '/assets/css/page2016/main.css',
       '/assets/js/browser/weather.css'
    ];
    public $js = [
      '/assets/plugins/polyfill.min.js?features=IntersectionObserver',
      '/assets/plugins/jquery.lazy/jquery.lazy.min.js',
      '/assets/plugins/jquery.lazy/jquery.lazy.plugins.min.js',
      '/assets/js/bxslider/jquery.bxslider.min.js',
      '/assets/js/main.js',
      '/assets/js/lazysizes.min.js',
      '/assets/js/custom_video.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\YiiAsset'
    ];
     public function init() {
        parent::init();
        if(IS_MOBILE){
             $this->css = [
                '/assets/css/mobile/jquery.mobile.structure-1.4.4.min.css',
                '/assets/css/normalize.css?v=001',
                '/assets/css/page2016/fonts.css',
                '/assets/css/mobile/format_style.css',
                '/assets/css/mobile/main-mobile.css',
                '/assets/js/browser/weather.css'
            ];
            $this->js = [
              // '/assets/js/mobile/jquery.mobile-1.4.4.min.js',
                'https://polyfill.io/v2/polyfill.min.js?features=IntersectionObserver',
                '/assets/js/lazysizes.min.js',
                '/assets/js/mobile/main-mobile.js',
            ];
        }
        if(\Yii::$app->controller->layout == 'mobile'){
            
            array_unshift($this->js, '/assets/js/mobile/jquery.mobile-1.4.4.min.js');
            array_unshift($this->js, '/assets/js/jquery.crs.min.js');
        }
        if(\Yii::$app->controller->layout == 'mobile-landing-page'){
            
            array_unshift($this->js, '/assets/js/mobile/jquery.mobile-1.4.4.min.js');
            array_unshift($this->js, '/assets/js/jquery.crs.min.js');
        }
        if(\Yii::$app->controller->layout == 'main-form'){
          $this->css[] = '/assets/css/main-form.css';
          $this->js[] = '/assets/js/form/main-form.js';
        }
    }
}
