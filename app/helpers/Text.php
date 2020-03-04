<?php
namespace app\helpers;
use yii\base\Component;
use Yii;
/**
 * Mailjet Public API
 *
 * @package     API v0.3
 * @author      Mailjet
 * @link        http://api.mailjet.com/
 *
 * For PHP v >= 5.3
 *
 */

class Text
{
    public static function limit_text($text, $length) {
       $length = abs((int)$length);
	   if(strlen($text) > $length) {
	      $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
	   }
	   return($text);
    }
}
   