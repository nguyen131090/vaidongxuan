<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['class' => 'model-form']
]); ?>
<?= $form->field($model, 'title')?>
<?= $form->field($model, 'sub_title') ?>
<?= $form->field($model, 'code') ?>
<?= $form->field($model, 'style') ?>
<?= $form->field($model, 'slug')?>
<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>