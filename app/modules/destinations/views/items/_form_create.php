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

use yii\easyii\widgets\Redactor;

use yii\easyii\widgets\SeoForm;

$this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]); 

$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]); 

$settings = $this->context->module->settings;

$module = $this->context->module->id;
?>



<?php $form = ActiveForm::begin([

    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']

]); ?>

<?= $form->field($model, 'title') ?>



<?= $form->field($model, 'time')->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'slug') ?>
<?php if(IS_ROOT) : ?>
    <?= SeoForm::widget(['model' => $model]) ?>

<?php endif; ?>



<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
<?  $js = <<< JS
$('#item-title').change(function(){
    var slug = removeSpecial($(this).val().toLowerCase()).replace(/ +/g,'-').replace(/[0-9]/g,'').replace(/[^a-z0-9-_]/g,'').trim();
    var oldSlug = $('#item-slug').val();
    $('#item-slug').val(oldSlug + slug);
}); 

function removeSpecial(str = ''){
       str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,'a');
       str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ.+/g,"e");
       str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
       str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ.+/g,"o");
       str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
       str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
       str = str.replace(/đ/g,"d");
       
       /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
       //str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
       //str= str.replace(/^\-+|\-+$/g,""); 
       
       return str;
}
JS;
$this->registerJs($js);
 ?>