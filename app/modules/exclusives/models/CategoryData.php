<?php
namespace app\modules\exclusives\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\easyii\behaviors\SeoBehavior;
use yii\easyii\behaviors\SortableModel;
use yii\easyii\models\Photo;

class CategoryData extends \yii\easyii\components\ActiveRecord
{

    public static function tableName()
    {
        return 'app_exclusives_category_data';
    }
}