<?php

namespace app\modules\libraries\models;



use Yii;

use yii\behaviors\SluggableBehavior;

use yii\easyii\behaviors\SeoBehavior;

use yii\easyii\models\Photo;



class Item extends \yii\easyii\components\ActiveRecord

{

    const STATUS_OFF = 0;

    const STATUS_ON = 1;



    public static function tableName()

    {

        return 'app_libraries_items';

    }



    public function rules()

    {

        return [

            ['title', 'required'],

            ['title', 'trim'],

            [['title', 'sub_title'], 'string', 'max' => 128],

            ['image', 'image'],

            [['description','slug', 'summary'], 'safe'],

            [['status', 'category_id', 'time'], 'integer'],

            ['time', 'default', 'value' => time()],

            // ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],

            ['slug', 'default', 'value' => null],

            ['status', 'default', 'value' => self::STATUS_ON],

        ];

    }



    public function attributeLabels()

    {

        return [

            'title' => Yii::t('easyii', 'Title'),

            'image' => Yii::t('easyii', 'Image'),

            'description' => Yii::t('easyii', 'Description'),

            'available' => Yii::t('easyii/libraries', 'Available'),

            'price' => Yii::t('easyii/libraries', 'Price'),

            'discount' => Yii::t('easyii/libraries', 'Discount'),

            'time' => Yii::t('easyii', 'Date'),

            'slug' => Yii::t('easyii', 'Slug'),

        ];

    }



    public function behaviors()

    {

        return [

            'seoBehavior' => SeoBehavior::className(),

            'sluggable' => [

                'class' => SluggableBehavior::className(),

                'attribute' => 'title',

                'ensureUnique' => true

            ]

        ];

    }



    public function beforeSave($insert)

    {

        if (parent::beforeSave($insert)) {

            if(!$this->data || (!is_object($this->data) && !is_array($this->data))){

                $this->data = new \stdClass();

            }



            $this->data = json_encode($this->data);



            if(!$insert && $this->image != $this->oldAttributes['image'] && $this->oldAttributes['image']){

                @unlink(Yii::getAlias('@webroot').$this->oldAttributes['image']);

            }



            return true;

        } else {

            return false;

        }

    }



    public function afterSave($insert, $attributes){

        parent::afterSave($insert, $attributes);



        $this->parseData();



        ItemData::deleteAll(['item_id' => $this->primaryKey]);



        foreach($this->data as $name => $value){

            if(!is_array($value)){

                $this->insertDataValue($name, $value);

            } else {

                foreach($value as $arrayItem){

                    $this->insertDataValue($name, $arrayItem);

                }

            }

        }

    }



    private function insertDataValue($name, $value){

        Yii::$app->db->createCommand()->insert(ItemData::tableName(), [

            'item_id' => $this->primaryKey,

            'name' => $name,

            'value' => $value

        ])->execute();

    }



    public function afterFind()

    {

        parent::afterFind();

        $this->parseData();

    }



    public function getPhotos()

    {

        return $this->hasMany(Photo::className(), ['item_id' => 'item_id'])->where(['class' => self::className()])->sort();

    }



    public function getCategory()

    {

        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);

    }



    public function afterDelete()

    {

        parent::afterDelete();



        foreach($this->getPhotos()->all() as $photo){

            $photo->delete();

        }



        if($this->image) {

            @unlink(Yii::getAlias('@webroot') . $this->image);

        }



        ItemData::deleteAll(['item_id' => $this->primaryKey]);

    }



    private function parseData(){

        $this->data = $this->data !== '' ? json_decode($this->data) : [];

    }

}