<?php
namespace app\modules\programmes\api;

use yii\data\ActiveDataProvider;
use yii\easyii\components\API;
use app\modules\programmes\models\Item;
use yii\helpers\Url;
use yii\widgets\LinkPager;

class CategoryObject extends \yii\easyii\components\CategoryApiObject
{
    public $slug;
    public $image;
    public $tree;
    public $fields;
    public $depth;
    public $data;
     public $fields_category;

    private $_adp;
    private $_items;
    private $_photos;
    private $_parents;
    private $_children;

    public function getTitle(){
        return LIVE_EDIT ? API::liveEdit($this->model->title, $this->editLink) : $this->model->title;
    }

    public function pages($options = []){
        return $this->_adp ? LinkPager::widget(array_merge($options, ['pagination' => $this->_adp->pagination])) : '';
    }

    public function pagination(){
        return $this->_adp ? $this->_adp->pagination : null;
    }

    public function items($options = [])
    {
        if(!$this->_items){
            $this->_items = [];

            $query = Item::find()->with('seo')->where(['category_id' => $this->id])->status(Item::STATUS_ON);

            if(!empty($options['where'])){
                $query->andFilterWhere($options['where']);
            }
            if(!empty($options['orderBy'])){
                $query->orderBy($options['orderBy']);
            } else {
                $query->sortDate();
            }
            if(!empty($options['filters'])){
                $query = Catalog::applyFilters($options['filters'], $query);
            }

            $this->_adp = new ActiveDataProvider([
                'query' => $query,
                'pagination' => !empty($options['pagination']) ? $options['pagination'] : []
            ]);

            foreach($this->_adp->models as $model){
                $this->_items[] = new ItemObject($model);
            }
        }
        return $this->_items;
    }

    public function fieldOptions($name, $firstOption = '')
    {
        $options = [];
        if($firstOption) {
            $options[''] = $firstOption;
        }

        foreach($this->fields as $field){
            if($field->name == $name){
                foreach($field->options as $option){
                    $options[$option] = $option;
                }
                break;
            }
        }
        return $options;
    }

    public function getPhotos()
    {
        if(!$this->_photos){
            $this->_photos = [];

            foreach(Photo::find()->where(['class' => Category::className(), 'item_id' => $this->id])->sort()->all() as $model){
                $this->_photos[] = new PhotoObject($model);
            }
        }
        return $this->_photos;
    }

    public function parents(){
        if(!$this->_parents){
            $this->_parents = \app\modules\programmes\models\Category::findOne(['category_id' => $this->id])->parents()->all();
        }
        return $this->_parents; 
    }

    public function children(){
        if(!$this->_children){
            $this->_children = \app\modules\programmes\models\Category::findOne(['category_id' => $this->id])->children()->all();
        }
        return $this->_children; 
    }

    public function getEditLink(){
        return Url::to(['/admin/catalog/a/edit/', 'id' => $this->id]);
    }
}