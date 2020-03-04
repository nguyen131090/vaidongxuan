<?php

namespace app\modules\programmes\models;
use yii\easyii\models\Photo;
use Yii;

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

        'tourTypes' => 'Tour Types',

        'tTourThemes' => 'Tour Themes',

        'tTourJours' => 'Tour Jours',

        'selectLocations' => 'Locations',

        'exclusives' => 'Exclusives',

        'modulepage' => 'Modules Page',

        'countries' => 'Countries',

        'destinations' => 'Destinations',
        'blogs' => 'Blogs',
        'aboutus' => 'About Us',

        'libraries' => 'Libraries',
        'cattour' => 'Category Tour',
        'programes' => 'Programes'
    ];

   

    public static function tableName()

    {

        return 'app_programmes_categories';

    }



    public function rules(){
        return array_merge(parent::rules(), [
            [['summary','sub_title','summary_title', 'data', 'fields_category'], 'safe']
            ]);

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
            // add new data for category
             $this->fields_category = json_encode($this->fields_category);
            if(!$this->data || (!is_object($this->data) && !is_array($this->data))){
                $this->data = new \stdClass();
            }
            $this->data = json_encode($this->data);



            return true;

        } else {

            return false;

        }

    }



    public function afterSave($insert, $attributes)

    {

        parent::afterSave($insert, $attributes);

        $this->parseFields();
        $this->parseData();
        CategoryData::deleteAll(['category_id' => $this->primaryKey]);
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
        Yii::$app->db->createCommand()->insert(CategoryData::tableName(), [
            'category_id' => $this->primaryKey,
            'name' => $name,
            'value' => $value
        ])->execute();
    }



    public function afterFind()

    {

        parent::afterFind();

        $this->parseFields();
        $this->parseData();

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
        CategoryData::deleteAll(['category_id' => $this->primaryKey]);

    }


    private function parseFields(){

        $this->fields = $this->fields !== '' ? json_decode($this->fields) : [];
        $this->fields_category = $this->fields_category != '' ? json_decode($this->fields_category) : [];
    }
    
    private function parseData(){
        $this->data = $this->data !== '' ? json_decode($this->data) : [];
    }

}