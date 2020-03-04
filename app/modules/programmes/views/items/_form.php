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
use yii\helpers\ArrayHelper;
use app\modules\programmes\models\Category;

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
<?= $form->field($model, 'spirit')->textArea() ?>
<?php if($settings['itemThumb']) : ?>

    <?php if($model->image) : ?>

        <img src="<?= Image::thumb($model->image, 240) ?>">

        <a href="<?= Url::to(['/admin/'.$module.'/items/clear-image', 'id' => $model->primaryKey]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>

    <?php endif; ?>

<?php endif; ?>
<div id="get-notes" style="display: none;" data-val="<?=$model->notes?>">
<?= $form->field($model, 'notes')->dropDownList($notes,
     [
      'multiple'=>'multiple',
      'class'=>'{{note_class}}',
      'value' => '{{value}}'              
     ]             
    )->label("{{note_title}}");  ?>
</div>
<div class="control-group">
    <label for="select-beast">Exclusives</label>
   <select name="Item[exclusives][]" multiple class="form-control selectTags"><?=Html::renderSelectOptions(explode(',',$model->exclusives), $exclusives)?></select>
</div>
<div class="control-group">
    <label for="select-beast">Locations</label>
   <select name="Item[locations][]" multiple class="form-control selectTags"><?=Html::renderSelectOptions(explode(',',$model->locations), $locations)?></select>
</div>
<?= $form->field($model, 'on_projet')->dropDownList(array_combine(range(0, 10), range(0, 10)),['prompt' => 'Select...', 'class' => 'chosen', 'style' => 'margin-top: 20px;'])->label("Display on projet");  ?>
<?= $form->field($model, 'days')->dropDownList(array_combine(range(0, 30), range(0, 30)),['prompt' => 'Select...']    )->label("Days");  ?>
<?= $form->field($model, 'nights')->dropDownList(array_combine(range(0, 30), range(0, 30)),['prompt' => 'Select...'] )->label("Nights");  ?>
<div class="control-group">
    <div id="note-template">
    </div>
</div>

<?= $dataForm ?>
<input style="display: none;" id="exts-order-destinations" name="exts-order-destinations" />
<?php if($settings['itemDescription']) : ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()); ?>

<?php endif; ?>


<?= $form->field($model, 'on_top')->dropDownList(range(0, 30)) ?>
<?= $form->field($model, 'time', ['options' => ['class' => 'form-group invisible']])->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'pulished_date')->widget(DateTimePicker::className()); ?>

<?= SeoForm::widget(['model' => $model]) ?>
<?php if(IS_ROOT || IS_SEO) : ?>
    <? $listData = Category:: find()->roots(1)->all();?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($listData, 'category_id', 'title')); ?>
    <?= $form->field($model, 'slug') ?>
    <a id='get-parent' style='float: right;' class="btn btn-success" href="javascript:void(0)">Get Parent Slug</a>
    

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
  var noteData = '$model->notes';
    if( noteData !== ''){ 
        var notes = $.parseJSON(noteData);  
        renderEditNote(notes);  
    }
  $('.selectTags').each(function(){
      var type = $(this).data('type');
      var arrData = $.parseJSON(JSON.stringify($arrData));

      $('#list-exts-'+type).setSelectionOrder(arrData[type]);
    })
    
});
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

$('.ckeditor').each(function(){
    CKEDITOR.replace($(this).attr('id'));
})
$('#item-days').change(function() {
    $('#item-nights').val($('#item-days').val()-1);
    renderNote();
});

function renderNote(){
    $('#note-template').html('');
    var note = $('#get-notes').html();
    var html = ''; 
    var i = 1;
    while(i<= $('#item-days').val()){
         html += note.replace(/\{\{note_title\}\}/g, 'Notes Jour '+i).replace('Item[notes][]', 'jourNote['+i+'][]').replace(/\{\{note_class\}\}/g, 'note_jour note-jour-'+i);
        i++;
    }
    $('#note-template').html(html);
    $('.note_jour').chosen({ width: 500});
    return false;
};
function renderEditNote(notes){
    var note = $('#get-notes').html();
    var html = ''; 
    i=1;
    while(i<= $('#item-days').val()){
        html += note.replace(/\{\{note_title\}\}/g, 'Notes Jour '+i).replace('Item[notes][]', 'jourNote['+i+'][]').replace(/\{\{note_class\}\}/g, 'note_jour note-jour-'+i);
        i++;
    }
    $('#note-template').html(html);
    i=1;
    while(i<= $('#item-days').val()){
        $('.note-jour-'+i).chosen({ width: 500 });
        $('.note-jour-'+i).val(notes[i]);
        $('.note-jour-'+i).trigger("chosen:updated");
        i++;
    }
     
}
$('#get-parent').click(function(){
    var slug = '$cat->slug'+'/'+'$model->slug';
    $('#item-slug').val(slug);
}); 
//config for chosen-itinerary
$('.chosen-itinerary').click(function(event){
    event.stopPropagation();
    $(this).addClass('chosen-with-drop chosen-container-active');
    $(this).find('.search-field input').trigger('click');
});
$(window).click(function() {
        $('.chosen-itinerary').removeClass('chosen-with-drop chosen-container-active');
});
$('.chosen-itinerary .chosen-results li').mouseover(function(){
    $('.chosen-itinerary .chosen-results li').removeClass('highlighted');
    $(this).addClass('highlighted');
})
$('.chosen-itinerary .chosen-results li').click(function(){
    var chose = [];
    $('.chosen-itinerary .search-field').before('<li data-id="'+$(this).data('id')+'" data-slug="'+$(this).data('slug')+'"  data-stitle="'+$(this).data('stitle')+'" data-status="'+$(this).data('status')+'" class="search-choice"><span>'+$(this).text()+'</span><a class="search-choice-close"></a></li>');
    $('.chosen-itinerary .search-choice').each(function(){
        chose.push({'id' : $(this).data('id'), 'title' : $(this).text(), 'slug' : $(this).data('slug'), 'status': $(this).data('status'), 'stitle' : $(this).data('stitle')});
    });
    $('#itinerary').val(JSON.stringify(chose));
    $('.chosen-itinerary .search-field input').val('');
})
$('.chosen-itinerary .search-field input').on('keydown',function(event){
    if ( event.which == 13 ) {
        event.preventDefault();
        $('.chosen-itinerary .chosen-results li.group-option.highlighted').trigger('click');
        return false;
    }
    if ( event.which == 40 ) {
        var target = $('.chosen-itinerary .chosen-results li.group-option.highlighted:not(.hidden)');
        target.removeClass('highlighted');
        target.nextAll().not('.hidden').first().addClass('highlighted');
        return false;
    }
    if ( event.which == 38 ) {
        var target = $('.chosen-itinerary .chosen-results li.group-option.highlighted:not(.hidden)');
        target.removeClass('highlighted');
        target.prevAll().not('.hidden').first().addClass('highlighted');
        return false;
    }
    var target = $(this);
    $('.chosen-itinerary .chosen-results li').removeClass('hidden').removeClass('highlighted');
    $('.chosen-itinerary .chosen-results li').each(function(){
        if (removeSpecial($(this).text().toLowerCase()).indexOf(target.val()) == -1) {
           $(this).addClass('hidden');
        }
    });
    $('.chosen-itinerary .chosen-results li:not(.hidden)').first().addClass('highlighted');
})

$('.chosen-itinerary .chosen-choices ').on('click', '.search-choice-close', function(){
    $(this).parent().remove();
    var chose = [];
     $('.chosen-itinerary .search-choice').each(function(){
        chose.push({'id' : $(this).data('id'), 'title' : $(this).text(), 'slug' : $(this).data('slug'), 'status': $(this).data('status'), 'stitle' : $(this).data('stitle')});
    });
    $('#itinerary').val(JSON.stringify(chose));
});

$('.chosen-itinerary .chosen-choices').on('click', '.search-choice span', function(){
    var text = $(this).text();
    var stt = $(this).parent().data('stitle');
    console.log(stt);
    $(this).text('('+text+')');
    if(stt)
        $(this).parent().data('stitle', '('+stt+')');
    var chose = [];
    $('.chosen-itinerary .search-choice').each(function(){
        chose.push({'id' : $(this).data('id'), 'title' : $(this).text(), 'slug' : $(this).data('slug'), 'status': $(this).data('status'), 'stitle' : $(this).data('stitle')});
    });
    $('#itinerary').val(JSON.stringify(chose));
});


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
 