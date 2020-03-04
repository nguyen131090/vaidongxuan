<?php
namespace app\modules\widgets\models;

use Yii;
use yii\easyii\behaviors\CacheFlush;

class Text extends \yii\easyii\components\ActiveRecord
{
    const CACHE_KEY = 'easyii_text';

    public static function tableName()
    {
        return 'app_widgetss';
    }

    public function rules()
    {
        return [
            ['text_id', 'number', 'integerOnly' => true],
            ['title', 'required'],
            [['title', 'sub_title', 'style'], 'trim'],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['slug', 'unique'],
            [['code'],'string','min'=>23,'max'=>128],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'slug' => Yii::t('easyii', 'Slug'),
            'code' => 'Code to render the weather: ex: 3,2,1.. for 12 months'
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className()
        ];
    }
}