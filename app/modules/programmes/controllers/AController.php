<?php
namespace app\modules\programmes\controllers;

use Yii;
use yii\easyii\components\CategoryController;
use app\modules\programmes\models\Category;
use yii\easyii\behaviors\SortableModel;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\easyii\helpers\Image;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;

class AController extends CategoryController
{
    public $categoryClass = 'app\modules\programmes\models\Category';
    public $moduleName = 'programmes';

    public $rootActions = ['fields'];
   
    public function actionFields($id)
    {
        if(!($model = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        if (Yii::$app->request->post('save'))
        {
            $fields = Yii::$app->request->post('Field') ?: [];
            $result = [];

            foreach($fields as $field){
                $temp = json_decode($field);
                if( $temp === null && json_last_error() !== JSON_ERROR_NONE ||
                    empty($temp->name) ||
                    empty($temp->title) ||
                    empty($temp->type) ||
                    !($temp->name = trim($temp->name)) ||
                    !($temp->title = trim($temp->title)) ||
                    !array_key_exists($temp->type, Category::$fieldTypes)
                ){
                    continue;
                }
                $options = '';
                if($temp->type == 'select' || $temp->type == 'checkbox' || $temp->type == 'selectTags'){
                    if(empty($temp->options) || !($temp->options = trim($temp->options))){
                        continue;
                    }
                    $options = [];
                    foreach(explode(',', $temp->options) as $option){
                        $options[] = trim($option);
                    }
                }

                $result[] = [
                    'name' => \yii\helpers\Inflector::slug($temp->name),
                    'title' => $temp->title,
                    'type' => $temp->type,
                    'options' => $options
                ];
            }

            $model->fields = $result;

            if($model->save()){
                $ids = [];
                foreach($model->children()->all() as $child){
                    $ids[] = $child->primaryKey;
                }
                if(count($ids)){
                    Category::updateAll(['fields' => json_encode($model->fields)], ['in', 'category_id', $ids]);
                }

                $this->flash('success', Yii::t('easyii/programmes', 'Category updated'));
            }
            else{
                $this->flash('error', Yii::t('easyii','Update error. {0}', $model->formatErrors()));
            }
            return $this->refresh();
        }
        else {
            return $this->render('fields', [
                'model' => $model
            ]);
        }
    }


    public function actionFieldsCategory($id)
    {
        if(!($model = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }
        if (Yii::$app->request->post('save'))
        {
            $fields = Yii::$app->request->post('Field') ?: [];
            $result = [];

            foreach($fields as $field){
                $temp = json_decode($field);
                if( $temp === null && json_last_error() !== JSON_ERROR_NONE ||
                    empty($temp->name) ||
                    empty($temp->title) ||
                    empty($temp->type) ||
                    !($temp->name = trim($temp->name)) ||
                    !($temp->title = trim($temp->title)) ||
                    !array_key_exists($temp->type, Category::$fieldTypes)
                ){
                    continue;
                }
                $options = '';
                if($temp->type == 'select' || $temp->type == 'checkbox' || $temp->type == 'selectTags'){
                    if(empty($temp->options) || !($temp->options = trim($temp->options))){
                        continue;
                    }
                    $options = [];
                    foreach(explode(',', $temp->options) as $option){
                        $options[] = trim($option);
                    }
                }

                $result[] = [
                    'name' => \yii\helpers\Inflector::slug($temp->name),
                    'title' => $temp->title,
                    'type' => $temp->type,
                    'options' => $options
                ];
            }
            $model->fields_category = $result;

            if($model->save()){
                $this->flash('success', Yii::t('easyii/programmes', 'Category updated'));
            }
            else{
                $this->flash('error', Yii::t('easyii','Update error. {0}', $model->formatErrors()));
            }
            return $this->refresh();
        }
        else {
            return $this->render('fields-category', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
         if(!($model = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }
        //get parent slug
        $parentSlug = Category::findOne($id)->parents(1)->select('slug')->one();
        $prSlug = '';
        if($parentSlug)
            $prSlug = $parentSlug->slug.'/';
        else $prSlug = Yii::$app->session->get('moduleUrl').'/';
        $path = explode("/", $model->slug);
        Yii::$app->session->set('uploadFolder', Yii::$app->session->get('moduleName').'/'.end($path));
        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else {
                $dir = Yii::getAlias('@webroot').'/uploads/';
                if (isset($_FILES) && $this->module->settings['itemThumb']) {
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if ($model->image && $model->validate(['image'])) {
                        $model->image = Image::upload($model->image, $dir.'photos');
                    } else {
                        $model->image = $model->oldAttributes['image'];
                    }
                }
                $model->content = Yii::$app->request->post()['Category']['content'];
                $request = Yii::$app->request->post('Data');
                if($model->fields_category){
                foreach($model->fields_category as $field){
                    if(!empty(Yii::$app->request->post('exts-order')[$field->name])){
                        $exts = json_decode(Yii::$app->request->post('exts-order')[$field->name]);
                        $request[$field->name] = $exts;
                    } else continue;
                        
                }
                }
                $model->data = $request;
                if ($model->save()) {
                    $this->flash('success', 'Category updated');
                    return $this->redirect(['/admin/'.$this->module->id.'/a/edit', 'id' => $model->primaryKey]);
                } else {
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model,'prSlug' => $prSlug,
                'dataForm' => $this->generateForm($model->fields_category, $model->data),
            ]);
        }
    }

    public function actionCreate($parent = null)
    {
        $class = $this->categoryClass;
        $model = new $class;
        $slug = Yii::$app->session->get('moduleUrl').'/';
        if($parent){
            $cat = Category::findOne($parent);
            $slug = $cat->slug.'/';
        }
        $model->slug = $slug;
        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES) && $this->module->settings['categoryThumb']){
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if($model->image && $model->validate(['image'])){
                        $model->image = Image::upload($model->image, $this->moduleName);
                    } else {
                        $model->image = '';
                    }
                }

                $model->status = $class::STATUS_ON;
                $parent = (int)Yii::$app->request->post('parent', null);
                if($parent > 0 && ($parentCategory = $class::findOne($parent))){
                    $model->order_num = $parentCategory->order_num;
                    $model->appendTo($parentCategory);
                } else {
                    $model->attachBehavior('sortable', SortableModel::className());
                    $model->makeRoot();
                }

                if(!$model->hasErrors()){
                    $this->flash('success', Yii::t('easyii', 'Category created'));
                    return $this->redirect(['/admin/'.$this->moduleName, 'id' => $model->primaryKey]);
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('@easyii/views/category/create', [
                'model' => $model,
                'parent' => $parent
            ]);
        }
    }

    private function generateForm($fields, $data = null)
    {
        $result = '';
       if($fields){
        foreach($fields as $field)
        {
            $value = !empty($data->{$field->name}) ? $data->{$field->name} : null;
            if ($field->type === 'string') {
                $result .= '<div class="form-group"><label>'. $field->title .'</label>'. Html::textarea("Data[{$field->name}]", $value, ['class' => 'form-control', 'id' => $field->name]) .'</div>';
            }
            elseif ($field->type === 'text') {
                $result .= '<div class="form-group"><label>'. $field->title .'</label>'. Html::textarea("Data[{$field->name}]", $value, ['class' => 'form-control ckeditor', 'id' => $field->name]) .'</div>';
            }
            elseif ($field->type === 'boolean') {
                $result .= '<div class="checkbox"><label>'. Html::checkbox("Data[{$field->name}]", $value, ['uncheck' => 0]) .' '. $field->title .'</label></div>';
            }
            elseif ($field->type === 'select') {
                $options = ['' => 'Select'];
                foreach($field->options as $option){
                    $options[$option] = $option;
                }
                $result .= '<div class="form-group"><label>'. $field->title .'</label><select name="Data['.$field->name.']" class="form-control">'. Html::renderSelectOptions($value, $options) .'</select></div>';
            }
            elseif ($field->type === 'selectTags') {
                $options = ['' => 'Select'];
                foreach($field->options as $option){
                    $options[$option] = $option;
                }
                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $options) .'</select>
                </div>';
                
            }
             elseif ($field->type === 'selectLocations') {
                $locations = $this->getLibraries()['locations'];
               
                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $locations) .'</select>
                </div>';
                
            }
            elseif ($field->type === 'countries') {
                $countries = $this->getLibraries()['countries'];

                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $countries) .'</select>
                </div>';
                
            }
            elseif ($field->type === 'modulepage') {
                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select id="list-exts-'.$field->name.'" data-type = "'.$field->name.'" name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $this->getPostModule()) .'</select>
                </div>';
                $result .= '<input style="display: none;" id="exts-order-'.$field->name.'" name="exts-order['.$field->name.']" />';
                
            }
            elseif ($field->type === 'checkbox') {
                $options = '';
                foreach($field->options as $option){
                    $checked = $value && in_array($option, $value);
                    $options .= '<br><label>'. Html::checkbox("Data[{$field->name}][]", $checked, ['value' => $option]) .' '. $option .'</label>';
                }
                $result .= '<div class="checkbox well well-sm"><b>'. $field->title .'</b>'. $options .'</div>';
            }
            elseif ($field->type === 'tags') {
                $result .= '<div class="form-group"><label>'. $field->title .'</label>'. Html::input('text', "Data[{$field->name}]", $value, ['class' => 'form-control tagsInput']) .'</div>';
            }
            elseif ($field->type === 'tagsDate') {
                $result .= '<div class="form-group"><label>'. $field->title .'</label>'. Html::input('text', "Data[{$field->name}]", $value, ['class' => 'form-control tagsInput datetimepicker']) .'</div>';
               
            }
            elseif ($field->type === 'exclusives') {
                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select id="list-exts-'.$field->name.'" data-type = "'.$field->name.'" name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $this->getModulesPage()['exclusives']) .'</select>
                </div>';
                $result .= '<input style="display: none;" id="exts-order-'.$field->name.'" name="exts-order['.$field->name.']" />';

            }
            elseif ($field->type === 'extension') {
                $extensionSlug = Catalog::cat('extensions-list')->model;
                $options = Category::find()->where(['depth' => 1])->andWhere('lft > '.$extensionSlug->lft.' and rgt < '.$extensionSlug->rgt)->orderBy('lft ASC')->asArray()->all();
                $options = ArrayHelper::map($options, 'slug', 'title');
                $options = ArrayHelper::merge([''=> 'Select'], $options);
                $result .= '<div class="form-group"><label>'. $field->title .'</label><select name="Data['.$field->name.']" class="form-control">'. Html::renderSelectOptions($value, $options) .'</select></div>';
            }
             elseif ($field->type === 'aboutus') {

                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select id="list-exts-'.$field->name.'" data-type = "'.$field->name.'" name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $this->getAboutUs()) .'</select>
                </div>';
                $result .= '<input style="display: none;" id="exts-order-'.$field->name.'" name="exts-order['.$field->name.']" />';

            }
            elseif ($field->type === 'libraries') {

                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select id="list-exts-'.$field->name.'" data-type = "'.$field->name.'" name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $this->getLibraries()) .'</select>
                </div>';
                $result .= '<input style="display: none;" id="exts-order-'.$field->name.'" name="exts-order['.$field->name.']" />';

            }
            elseif ($field->type === 'blogs') {
                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select id="list-exts-'.$field->name.'" data-type = "'.$field->name.'" name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $this->getDataFromBlogAmica()['posts']) .'</select>
                </div>';
                $result .= '<input style="display: none;" id="exts-order-'.$field->name.'" name="exts-order['.$field->name.']" />';
            }
           elseif ($field->type === 'file') {
                $options = ['' => 'Select'];
               
                $result .= '<div class="form-group"><label>'. $field->title .'</label><select name="Data['.$field->name.']" class="form-control chosen">'. Html::renderSelectOptions($value, ['' => 'Select']+ $this->getFile()) .'</select></div>';
            } 
            elseif($field->type === 'date') {
                $result .= '<label>'.$field->title .'</label>'.
                DateTimePicker::widget([
                    'name' => $field->name, 
                    'value' => date('d-m-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true
                    ]
                ]);
            }
            elseif ($field->type === 'destinations') {
                $result .= '<div class="control-group">
                    <label for="select-beast">'.$field->title.'</label>
                   <select id="list-exts-'.$field->name.'" data-type = "'.$field->name.'" name="'."Data[{$field->name}][]".'" multiple class="form-control selectTags">'. Html::renderSelectOptions($value, $this->getModulesPage()['destinations']) .'</select>
                </div>';
                $result .= '<input style="display: none;" id="exts-order-'.$field->name.'" name="exts-order['.$field->name.']" />';

            }
            elseif (in_array($field->type, ['tourTypes', 'tTourThemes', 'tTourJours'])) {
                switch ($field->type) {
                    case 'tourTypes':
                        $options = Yii::$app->params['tTourTypes'];
                        break;
                    case 'tTourThemes':
                        $options = Yii::$app->params['tTourThemes'];
                        break;
                    case 'tTourJours':
                        $options = Yii::$app->params['tTourJours'];
                        break;
                };
                $options = ['' => 'Select'] + $options;
                $result .= '<div class="form-group"><label>'. $field->title .'</label><select name="Data['.$field->name.']" class="form-control">'. Html::renderSelectOptions($value, $options) .'</select></div>';
            } 
        }
        return $result;
       }
    }

    public function getModulesPage(){
        $programes = $aboutus = $exclusives = $destinations = $temoignages = $blogs = [];
        $exl = Yii::$app->db->createCommand("SELECT item.item_id as 'id', item.title as 'text', cat.title as 'group' FROM app_exclusives_items
 as item JOIN app_exclusives_categories as cat ON cat.category_id = item.category_id
WHERE item.category_id
ORDER BY 'id', 'group'")->queryAll();
        foreach ($exl as $kl => $vl) {
            $exclusives[$vl['group']][$vl['id']] = $vl['text'];
        }

        $prog = Yii::$app->db->createCommand("SELECT item.item_id as 'id', item.title as 'text', cat.title as 'group' FROM app_programmes_items
 as item JOIN app_programmes_categories as cat ON cat.category_id = item.category_id
WHERE item.category_id
ORDER BY 'id', 'group'")->queryAll();
            foreach ($prog as $kl => $vl) {
                $programes[$vl['group']][$vl['id']] = $vl['text'];
            }

        $dataDes = \app\modules\destinations\models\Category::find()->with('items')->asArray()->all();
            $destinations = [];
            foreach ($dataDes as $key => $value) {
                $destinations[$value['sub_title']] = ArrayHelper::map($value['items'], 'item_id', 'title');
            }

        $temoignages = \app\modules\whoarewe\api\Catalog::cat(13)->items(['pagination' => ['pageSize' => 0]]);
        $temoignages = ArrayHelper::map($temoignages, function ($element) {
            return $element->model->item_id;
        }, 'title');


        return [
            'exclusives' => $exclusives,
            'programes' => $programes,
            'destinations' => $destinations,
            'temoignages' => $temoignages,
            'aboutus' => $aboutus
        ];
    }

    protected function getPostModule(){
        $arr = [];
        $modulepage = Yii::$app->db->createCommand("SELECT item.item_id as 'id', item.title as 'text', cat.title as 'group' FROM app_modulepage_items
 as item JOIN app_modulepage_categories as cat ON cat.category_id = item.category_id
WHERE item.category_id
ORDER BY 'id', 'group'")->queryAll();
            foreach ($modulepage as $kl => $vl) {
                $arr[$vl['group']][$vl['id']] = $vl['text'];
            }
            return $arr;
    }

    protected function getLibraries(){
        $arr = [];
        $libraries = Yii::$app->db->createCommand("SELECT item.item_id as 'id', item.title as 'text', cat.title as 'group' FROM app_libraries_items
 as item JOIN app_libraries_categories as cat ON cat.category_id = item.category_id
WHERE item.category_id
ORDER BY 'id', 'group'")->queryAll();
            foreach ($libraries as $kl => $vl) {
                $arr[$vl['group']][$vl['id']] = $vl['text'];
            }
            return $arr;
    }

    protected function getDataFromBlogAmica()
    {
        $dataPosts = array();
        $dataPosts['posts'] = $this->getDataAllPostFromBlogAmica();

        return $dataPosts;
    }

    protected function getDataAllPostFromBlogAmica()
    {
        $key_cache = 'data-cache-all-blog-modified-from-2016';
        $cache = Yii::$app->cache;

        // try retrieving $data from cache
        $data = $cache->get($key_cache);

        if (empty($data)) {
            $hostName = 'https://blog.amica-travel.com';
            $arrData = array();
            // $data is not found in cache, calculate it from scratch
            $url1 = $hostName . '/wp-json/wp/v2/posts?per_page=90&page=1&post_modified_gmt=2016-01-01T00:00:01';
            $data1 = $this->sendRequestToBlogAmica($url1);
            foreach ($data1 as $key => $value) {
                if(isset($value['id'])) {
                    $arrData[$value['id']] = $value['title']['rendered'];
                }
            }

            $url1 = $hostName . '/wp-json/wp/v2/posts?per_page=90&page=1&post_modified_gmt=2016-01-01T00:00:01';
            $data1 = $this->sendRequestToBlogAmica($url1);
            foreach ($data1 as $key => $value) {
                if(isset($value['id'])) {
                    $arrData[$value['id']] = $value['title']['rendered'];
                }
            }

            $url1 = $hostName . '/wp-json/wp/v2/posts?per_page=90&page=2&post_modified_gmt=2016-01-01T00:00:01';
            $data1 = $this->sendRequestToBlogAmica($url1);
            foreach ($data1 as $key => $value) {
                if(isset($value['id'])) {
                    $arrData[$value['id']] = $value['title']['rendered'];
                }
            }

            $url1 = $hostName . '/wp-json/wp/v2/posts?per_page=90&page=3&post_modified_gmt=2016-01-01T00:00:01';
            $data1 = $this->sendRequestToBlogAmica($url1);
            foreach ($data1 as $key => $value) {
                if(isset($value['id'])) {
                    $arrData[$value['id']] = $value['title']['rendered'];
                }
            }

            $url1 = $hostName . '/wp-json/wp/v2/posts?per_page=90&page=4&post_modified_gmt=2016-01-01T00:00:01';
            $data1 = $this->sendRequestToBlogAmica($url1);
            foreach ($data1 as $key => $value) {
                if(isset($value['id'])) {
                    $arrData[$value['id']] = $value['title']['rendered'];
                }
            }

            $url1 = $hostName . '/wp-json/wp/v2/posts?per_page=90&page=5&post_modified_gmt=2016-01-01T00:00:01';
            $data1 = $this->sendRequestToBlogAmica($url1);
            foreach ($data1 as $key => $value) {
                if(isset($value['id'])) {
                    $arrData[$value['id']] = $value['title']['rendered'];
                }
            }

            $data = $arrData;

            // store $data in cache so that it can be retrieved next time
            $cache->set($key_cache, $data);
        }
        // $data is available here
        return $data;
    }

    protected function sendRequestToBlogAmica($url)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->send();
        return $response->getData();
    }

    public function getAboutUs(){
        if(Yii::$app->cache->get('aboutus-all-data')){
            $aboutus = Yii::$app->cache->get('aboutus-all-data');
        } else{

         $about = Yii::$app->db->createCommand("SELECT item.item_id as 'id', item.title as 'text', cat.title as 'group' FROM app_whoarewe_items 
 as item JOIN app_whoarewe_categories as cat ON cat.category_id = item.category_id
WHERE item.category_id
ORDER BY 'id', 'group'")->queryAll();
            foreach ($about as $kl => $vl) {
                $aboutus[$vl['group']][$vl['id']] = $vl['text'];
            }
           Yii::$app->cache->set('aboutus-all-data', $aboutus); 
        }
        return $aboutus;
    }


    public function actionPhotos($id)
    {
        $model = Category::findOne($id);
        if(!($model = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('photos', [
            'model' => $model, 'moduleName' => $this->moduleName
        ]);
    }

    public function actionContentsMobile($id)
    {
        $model = Category::findOne($id);
        if(!($model = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('contents_mobile', [
            'model' => $model,
        ]);
    }

    public function actionPhotosMobile($id)
    {
        $model = Category::findOne($id);
        if(!$model){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('photos_mobile', [
            'model' => $model,
        ]);
    }
   
}