<?php

use yii\easyii\helpers\Image;

use yii\helpers\Html;

use yii\helpers\Url;

use yii\widgets\ActiveForm;

use yii\easyii\widgets\SeoForm;
use wadeshuler\ckeditor\widgets\CKEditor;
use kartik\datetime\DateTimePicker;

$this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]);
$this->registerJsFile(DIR . 'assets/plugins/chosen.order.jquery.min.js', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]);
$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]);

$class = $this->context->categoryClass;

$settings = $this->context->module->settings;

?>

<?php $form = ActiveForm::begin([

    'enableAjaxValidation' => true,

    'options' => ['enctype' => 'multipart/form-data']

]); ?>

<?= $form->field($model, 'title') ?>

<?= $form->field($model, 'sub_title') ?>
<?= $form->field($model, 'summary')->textArea() ?>
<?= $dataForm ?>

<?php if(!empty($parent)) : ?>

    <div class="form-group field-category-title required">

        <label for="category-parent" class="control-label"><?= Yii::t('easyii', 'Parent category') ?></label>

        <select class="form-control" id="category-parent" name="parent">

            <option value="" class="smooth"><?= Yii::t('easyii', 'No') ?></option>

            <?php foreach($class::find()->sort()->asArray()->all() as $node) : ?>

                <option

                    value="<?= $node['category_id'] ?>"

                    <?php if($parent == $node['category_id']) echo 'SELECTED' ?>

                    style="padding-left: <?= $node['depth']*20 ?>px;"

                ><?= $node['title'] ?></option>

            <?php endforeach; ?>

        </select>

    </div>

<?php endif; ?>



<?php if($settings['categoryThumb']) : ?>

    <?php if($model->image) : ?>

        <img src="<?= Image::thumb($model->image, 240) ?>">

        <a href="<?= Url::to(['/admin/'.$this->context->moduleName.'/a/clear-image', 'id' => $model->primaryKey]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>

    <?php endif; ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className());?>

<?php endif; ?>

<?= $form->field($model, 'time', ['options' => ['class' => 'form-group invisible']])->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'pulished_date')->widget(DateTimePicker::className()); ?>

<?php if(IS_ROOT || IS_SEO) : ?>

    <?= $form->field($model, 'slug') ?>

    <?= SeoForm::widget(['model' => $model]) ?>

<?php endif; ?>



<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>



<?

$this->registerCss('#redactor-modal-box > div {

    margin-top: 200px !important;

}');

 ?>
 <?
$dir = DIR;
$arrData = [];
foreach ($model->fields_category as $field) {
  $name = $field->name;
  $arrData[$name] = !empty($model->data->$name) ? $model->data->$name : '';
}
$arrData = json_encode($arrData);
$js = <<<JS

$('.chosen').chosen();
$('.tagsInput').chosen();

$('.selectTags').chosen();
$('button.btn-primary').click(function(){
    // Object-oriented flavor, example for jQuery plugin
    $('.selectTags').each(function(){
        var selection = $(this).getSelectionOrder();
        var json = JSON.stringify(selection);
        $('#exts-order-'+$(this).data('type')).val(json);
    });
    
});
$(function(){
  $('.selectTags').each(function(){
      var type = $(this).data('type');
      var arrData = JSON.parse(JSON.stringify($arrData));

      $('#list-exts-'+type).setSelectionOrder(arrData[type]);
    })
    
});
$('.ckeditor').each(function(){
    CKEDITOR.replace($(this).attr('id'));
})


function removeSpecial(str = ''){
       str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,'a');
       str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ.+/g,"e");
       str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
       str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ.+/g,"o");
       str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
       str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
       str = str.replace("'","");
       str = str.replace(/đ/g,"d");
       
       /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
       //str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
       //str= str.replace(/^\-+|\-+$/g,""); 
       
       return str;
}
JS;

$this->registerJs($js);

$this->registerCss('#redactor-modal-box > div {
    margin-top: 200px !important;
}
.chosen-itinerary .chosen-results li:hover{
    
}
');


 ?>