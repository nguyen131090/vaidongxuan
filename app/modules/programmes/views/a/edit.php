<?php
$this->title = Yii::t('easyii', 'Edit category');
?>
<?= $this->render('_menu') ?>
<? echo $this->render('_submenu', ['model' => $model], $this->context); ?>

<?= $this->render('_form', ['model' => $model, 'dataForm' => $dataForm]) ?>