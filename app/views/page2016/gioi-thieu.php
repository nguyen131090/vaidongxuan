<?php 
use yii\helpers\Markdown;
$this->registerCssFile('/assets/css/page2016/gioi-thieu.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
    <?php
            
        if(isset($theEntry->photosArray['banner'])){
               $value = $theEntry->photosArray['banner'][0];
                echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
        }       
            
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"> <?= isset($theEntry->model->seo->h1) && $theEntry->model->seo->h1 != '' ? $theEntry->model->seo->h1 : $theEntry->title ?> </h1>
    </div>
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        <div class="rows row-0">
            <?= $theEntry->model->content ?>
        </div>
    </div>    
</div>

   
<?php
$css = <<<CSS


CSS;
$this->registerCss($css);
?>
