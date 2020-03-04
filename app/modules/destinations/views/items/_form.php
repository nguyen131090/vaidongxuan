<?php

use yii\easyii\helpers\Image;

use kartik\datetime\DateTimePicker;

use yii\helpers\Html;

use yii\helpers\Url;

use yii\widgets\ActiveForm;

use yii\easyii\widgets\TagsInput;

use dosamigos\fileupload\FileUpload;

use kartik\file\FileInput;

use yii\helpers\Json;
use wadeshuler\ckeditor\widgets\CKEditor;


// use yii\easyii\widgets\Redactor;

use yii\easyii\widgets\SeoForm;
use yii\helpers\ArrayHelper;
use app\modules\destinations\models\Category;

$this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]);
$this->registerJsFile(DIR . 'assets/plugins/chosen.order.jquery.min.js', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]);
$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]);

$settings = $this->context->module->settings;

$module = $this->context->module->id;

?>



<?php $form = ActiveForm::begin([

    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']

]); ?>

<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'summary_title') ?>
<?= $form->field($model, 'sub_title') ?>
<?= $form->field($model, 'summary')->textArea() ?>
<?= $form->field($model, 'spirit')->textArea() ?>
<?php if($settings['itemThumb']) : ?>

    <?php if($model->image) : ?>

        <img src="<?= Image::thumb($model->image, 240) ?>">
	
        <a href="<?= Url::to(['/admin/'.$module.'/items/clear-image', 'id' => $model->primaryKey]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>

    <?php endif; ?>
<?php endif; ?>



<?= $dataForm ?>
    <input style="display: none;" id="exts-order" name="exts-order" />

<?php if($settings['itemDescription']) : ?>

<?= $form->field($model, 'description')->widget(CKEditor::className()); ?>

<?php endif; ?>

<?= $form->field($model, 'time', ['options' => ['class' => 'form-group invisible']])->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'pulished_date')->widget(DateTimePicker::className()); ?>
<?php if(IS_ROOT || IS_SEO) : ?>
    <? $listData = \app\modules\destinations\api\Catalog::cats();?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($listData, 'category_id', 'title'), ['class' => 'chosen', 'style' => 'width: 100%;']); ?>
    <?= $form->field($model, 'slug') ?>
	<a id='get-parent' style='float: right;' class="btn btn-success" href="javascript:void(0)">Get Parent Slug</a>
    

<?php endif; ?>
<?= SeoForm::widget(['model' => $model]) ?>



<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<?
$dir = DIR;
$excl = '';
if(isset($model->data->blogs)) {
    $excl = $model->data->blogs;
}
if($excl)
    $excl = implode(',',$excl);

$js = <<< JS
$('.chosen').chosen({search_contains: true});
$('.tagsInput').chosen();

$('.selectTags').chosen();
$('.ckeditor').each(function(){
    CKEDITOR.replace($(this).attr('id'));
})

// $('.datetimepicker').datetimepicker();

$('#get-parent').click(function(){
    var slug = '$cat->slug'+'/'+'$model->slug';
    $('#item-slug').val(slug);
}); 

// Set order for blogs
$('button.btn-primary').click(function(){
    // Object-oriented flavor, example for jQuery plugin
    var selection = $('#list-exts').getSelectionOrder();
    var json = JSON.stringify(selection);
    $('#exts-order').val(json);
});
JS;
$this->registerJs($js);

if(!empty($excl)) {
    $js2 = <<< JS
    $(function(){
        $('#list-exts').setSelectionOrder('$excl'.split(','));
    });
JS;
    $this->registerJs($js2);
}
?>