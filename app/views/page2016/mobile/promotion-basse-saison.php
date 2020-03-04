<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2">
    <div class="column tt-fontsize-32 tt-latolatin-regular"> 
        <span class="space space-50"></span>
        <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-e65925"><?= $theEntry->title?></h1>
        <span class="space space-30"></span>
        <?= $theEntry->model->text; ?>
        
    </div>
    
</div>
<span class="space space-60"></span>
<?
$css=<<<CSS
    p > img{
        width: auto !important;
        max-width: 100% !important;
        height: auto !important;
        margin-bottom: 2rem;
    }
        
    .container-2 ul{
        list-style: none;
        margin: 0;
        padding: 0;
        text-align: center;
    }
    .container-2 ul li{
        
        margin: 0.5rem 0;
        
    }
    .container-2 h2{
        font-family: 'LatoLatin-Bold', sans-serif;
        text-align: center;
        font-size: inherit;
        line-height: inherit;
        padding: 0;
        margin: 3rem 0 1rem;
    }
    .container-2 .column ul:last-child li{
        text-align: left;    
        padding-left: 2rem;
        background: url(/assets/img/mobile/tich.jpg) 0 0.2rem no-repeat ;
        background-size: 1.2rem auto;
    }
    
CSS;
$this->registerCss($css); 
?>