<?php
require_once "vendor/Mobile_Detect_New/Mobile_Detect.php";

ini_set('display_errors', 1);
error_reporting(-1);
define('MAILGUN_API_KEY', 'key-41qs3pbnff7i2k42jmsh9v6ch059jf76');
define('MAILGUN_API_DOMAIN', 'amicatravel.com');
define('NOW', date('Y-m-d H:i:s'));
define('SITE_ID', 1);
define('DIR', '/');
define('BASE_PATH',__DIR__.'/');
//  if(ip_country() == 'NG'){ 
//    echo "<h3>404, Oops! Cette page existe pas.</h3>";
//    exit;
// }
$ip = get_client_ip();
if($ip == '117.6.3.222' || $ip == '::1'){
	defined('YII_DEBUG') or define('YII_DEBUG', true);
	defined('YII_ENV') or define('YII_ENV', 'dev');
} else {
	defined('YII_DEBUG') or define('YII_DEBUG', false);
	defined('YII_ENV') or define('YII_ENV', false);
}
// Detect mobile
if (!defined('IS_MOBILE')) {
  $detect = new Mobile_Detect;
            //$detect = Yii::$app->mobileDetect;
  if ($detect->isMobile() && !$detect->isTablet()) {
    define('IS_MOBILE', true);
        }else{
    define('IS_MOBILE', false);
  }
        if($detect->isTablet()){
            define('IS_TABLET', true);
        }else{
            define('IS_TABLET', false);
        }
}

// URI, SEGS, SEGn
$_REQUEST_URI = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'); define('URI', DIR == '/' ? $_REQUEST_URI : substr($_REQUEST_URI, strlen(trim(DIR, '/').'/'))); $_URI_SEGMENTS = explode('/', URI); define('SEGS', empty($_URI_SEGMENTS) ? 0 : count($_URI_SEGMENTS)); for ($i = 1; $i <= 9; $i ++) define('SEG'.$i, isset($_URI_SEGMENTS[$i - 1]) ? $_URI_SEGMENTS[$i - 1] : '');

if ($_REQUEST_URI != '' && substr($_SERVER['REQUEST_URI'], -1) == '/') {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /' . trim($_REQUEST_URI, '/'));
    exit;
}

// Redirect 301
include('redirect.php');

foreach ($oldLink as $i=>$link) {
	if ($link == '/'.URI) {
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: " . $newLink[$i]);
		exit;
	}
}
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
$config = require(__DIR__ . '/app/config/web.php');
(new yii\web\Application($config))->run();

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

 function ip_country($IPaddress=''){
      $json       = file_get_contents("http://apinotes.com/ipaddress/ip.php?ip=".getUserIP());
      $details    = json_decode($json);
      return !empty($details->country_code) ? $details->country_code : '';
  }
function getUserIP(){
      // Get real visitor IP behind CloudFlare network
      if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      }
      $client  = @$_SERVER['HTTP_CLIENT_IP'];
      $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
      $remote  = $_SERVER['REMOTE_ADDR'];

      if(filter_var($client, FILTER_VALIDATE_IP))
      {
          $ip = $client;
      }
      elseif(filter_var($forward, FILTER_VALIDATE_IP))
      {
          $ip = $forward;
      }
      else
      {
          $ip = $remote;
      }

      return $ip;
  }