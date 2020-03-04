<?php
namespace app\modules\widgets;

class WidgetsModule extends \yii\easyii\components\Module
{
    public static $installConfig = [
        'title' => [
            'en' => 'Text blocks',
            'ru' => 'Текстовые блоки',
        ],
        'icon' => 'font',
        'order_num' => 20,
    ];
}