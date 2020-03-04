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

<?php if($settings['itemThumb']) : ?>

    <?php if($model->image) : ?>

        <img src="<?= Image::thumb($model->image, 240) ?>">

        <a href="<?= Url::to(['/admin/'.$module.'/items/clear-image', 'id' => $model->primaryKey]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>

    <?php endif; ?>

<?php endif; ?>



<?= $dataForm ?>

<?php if($settings['itemDescription']) : ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()); ?>

<?php endif; ?>



<?= $form->field($model, 'time', ['options' => ['class' => 'form-group invisible']])->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'pulished_date')->widget(DateTimePicker::className()); ?>


<?php if(IS_ROOT) : ?>

    <?= $form->field($model, 'slug') ?>

    <?= SeoForm::widget(['model' => $model]) ?>

<?php endif; ?>



<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<?
$dir = DIR;
$arrData = [];
foreach ($cat->fields as $field) {
  $name = $field->name;
  $arrData[$name] = !empty($model->data->$name) ? $model->data->$name : '';
}
$arrData = json_encode($arrData);
$js = <<<JS
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