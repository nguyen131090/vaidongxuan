<?php use yii\easyii\modules\file\api\File; ?>
<?php $this->registerCssFile('/assets/css/page2016/club-ami.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php
$fileUrl = '';
$file = File::get(4);
$fileUrl = $file->model->file;
?>
<div class="contain container-1">
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_club_ami.jpg'>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0">
            <?= $this->context->pageT ?>
        </h1>
    </div>
</div>
<div class="contain container-2">
    <?= str_replace(['class="column','<h3','</h2>','src="'], ['class="amc-column','<h2','</h2>','data-src="'], $theEntry->model->content) ?>
        <div class="rows row-4">
            <p>
                <span>Pour bénéficier des avantages ou connaitre vos crédits actuels</span>
                <b class="pugjd btn-link-contact" data-title="<?= base64_encode(DIR.'nous-contacter') ?>">Contactez-nous !</b>
            </p>
        </div>
    </div>
</div>
<div class="contain container-3 ">
    
    <div class="amc-column">
        <div class="rows row-1">
            <p class="tt">Plus encore</p><a class="btn-amica-basic btn-amica-basic-1" href="/temoignages">Témoignages de nos anciens clients</a>
        </div>    
    </div>
</div>

<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->

<? $this->registerCss('.container-2 .row-4{background: none;}'); ?>