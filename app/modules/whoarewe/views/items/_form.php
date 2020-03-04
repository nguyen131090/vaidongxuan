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

use yii\easyii\widgets\SeoForm;
use yii\helpers\ArrayHelper;
use app\modules\whoarewe\models\Category;

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

<?= $form->field($model, 'sub_title') ?>
<?= $form->field($model, 'summary')->textArea() ?>





<?= $dataForm ?>

<?php if($settings['itemDescription']) : ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()); ?>

<?php endif; ?>


<?= $form->field($model, 'on_top')->dropDownList(range(0, 30)) ?>

<?= $form->field($model, 'time', ['options' => ['class' => 'form-group invisible']])->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'pulished_date')->widget(DateTimePicker::className()); ?>


<?= SeoForm::widget(['model' => $model]) ?>
<?php if(IS_ROOT || IS_SEO) : ?>
    <? $listData = \app\modules\whoarewe\api\Catalog::cats();?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($listData, 'category_id', 'title'), ['class' => 'chosen', 'style' => 'width: 100%;']); ?>
    

<?php endif; ?>

<?= $form->field($model, 'slug') ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<? 

$dir = DIR;
$arrData = [];
foreach ($cat->fields as $field) {
	if(strpos('string|text', $field->type) === false) {
		$name = $field->name;
  		$arrData[$name] = !empty($model->data->$name) ? $model->data->$name : '';
	}
}
$arrData = json_encode($arrData);
$js = <<<JS
$('.chosen').chosen({search_contains: true});

$(function(){
  $('.selectTags').each(function(){
      var type = $(this).data('type');

      var arrData = JSON.parse('$arrData');

      $('#list-exts-'+type).setSelectionOrder(arrData[type]);
    })
    
});
$('.tagsInput').chosen();

$('.selectTags').chosen();
// $('.datetimepicker').datetimepicker();
$('button.btn-primary').click(function(){
    // Object-oriented flavor, example for jQuery plugin
    $('.selectTags').each(function(){
        var selection = $(this).getSelectionOrder();
        var json = JSON.stringify(selection);
        $('#exts-order-'+$(this).data('type')).val(json);
    });
});


JS;

$this->registerJs($js);

$this->registerCss('#redactor-modal-box > div {

    margin-top: 200px !important;

}');

 ?>