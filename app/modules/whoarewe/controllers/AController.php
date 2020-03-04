<?php
namespace app\modules\whoarewe\controllers;

use Yii;
use yii\easyii\components\CategoryController;
use app\modules\whoarewe\models\Category;
use yii\easyii\behaviors\SortableModel;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\easyii\helpers\Image;
use yii\httpclient\Client;

class AController extends CategoryController
{
    public $categoryClass = 'app\modules\whoarewe\models\Category';
    public $moduleName = 'whoarewe';

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
                if($temp->type == 'select' || $temp->type == 'checkbox'){
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

                $this->flash('success', Yii::t('easyii/whoarewe', 'Category updated'));
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
                $this->flash('success', Yii::t('easyii/whoarewe', 'Category updated'));
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

    private function generateForm($fields, $data = null)
    {
        $result = '';
        foreach((array)$fields as $field)
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
                foreach($model->fields_category as $field){
                    if(!empty(Yii::$app->request->post('exts-order')[$field->name])){
                        $exts = json_decode(Yii::$app->request->post('exts-order')[$field->name]);
                        $request[$field->name] = $exts;
                    } else continue;
                        
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
        $slug = '';
        if($parent){
            
            $cat = Category::findOne($parent);
            $parentSlug = $cat->parents()->select('slug')->all();
            foreach ($parentSlug as $key => $ps) {
                $slug .= $ps->slug.'/';
            }
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
            return $this->render('create', [
                'model' => $model,
                'parent' => $parent
            ]);
        }
    }


    public function actionPhotos($id)
    {
        $model = Category::findOne($id);
        if(!($model = Category::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('photos', [
            'model' => $model,
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