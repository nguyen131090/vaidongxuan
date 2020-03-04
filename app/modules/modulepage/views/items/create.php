<?php
$this->title = Yii::t('easyii/modulepage', 'Create item');
?>
<?= $this->render('_menu', ['category' => $category]) ?>
<?= $this->render('_form', ['model' => $model, 'cat' => $category, 'dataForm' => $dataForm]) ?>