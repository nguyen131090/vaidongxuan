<?php

namespace app\modules\modulepage\models;
use yii\easyii\models\Photo;



class Category extends \yii\easyii\components\CategoryModel

{

    static $fieldTypes = [

        'string' => 'String',

        'text' => 'Text',

        'boolean' => 'Boolean',

        'select' => 'Select',

        'selectTags' => 'Select Tags',

        'checkbox' => 'Checkbox',

        'tags' => 'Tags',

        'tagsDate' => 'Tags Datetime',

        'file' => 'File',

        'date' => 'Datetime',

        'exclusives' => 'Exclusives',

        'programes' => 'Programes',

        'destinations' => 'Destinations',

        'temoignages' => 'Temoignages',

        'blogs' => 'Blogs',
        'aboutus' => 'About Us'

    ];

   

    public static function tableName()

    {

        return 'app_modulepage_categories';

    }



    public function beforeSave($insert)

    {

        if (parent::beforeSave($insert)) {

            if($insert && ($parent = $this->parents(1)->one())){

                $this->fields = $parent->fields;

            }



            if(!$this->fields || !is_array($this->fields)){

                $this->fields = [];

            }

            $this->fields = json_encode($this->fields);



            return true;

        } else {

            return false;

        }

    }



    public function afterSave($insert, $attributes)

    {

        parent::afterSave($insert, $attributes);

        $this->parseFields();

    }



    public function afterFind()

    {

        parent::afterFind();

        $this->parseFields();

    }



    public function getItems()

    {

        return $this->hasMany(Item::className(), ['category_id' => 'category_id'])->sortDate();

    }



    public function afterDelete()

    {

        parent::afterDelete();



        foreach($this->getItems()->all() as $item){

            $item->delete();

        }

    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['item_id' => 'category_id'])->where(['class' => self::className()])->sort(['order_num' => SORT_ASC]);
    }

    private function parseFields(){

        $this->fields = $this->fields !== '' ? json_decode($this->fields) : [];

    }

}