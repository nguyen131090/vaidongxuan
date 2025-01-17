<?php

use yii\easyii\helpers\Image;

use yii\helpers\Html;

use yii\helpers\Url;

use yii\widgets\ActiveForm;

use yii\easyii\widgets\SeoForm;
use wadeshuler\ckeditor\widgets\CKEditor;
use kartik\datetime\DateTimePicker;

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
<?php if(IS_ROOT) : ?>

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