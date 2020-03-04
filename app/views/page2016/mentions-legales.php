<?php $this->registerCssFile('/assets/css/page2016/mentions-legales.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    
</div>

<div class="contain container-4">
    
    <div class="amc-column">
        
        <div class="rows row-1">
            <div class="amc-col amc-col-1 mt-40 entry-body">
                <h1 class="title"><?= $this->context->pageT; ?></h1>
               
                <?= $theEntry->model->content?>    
            <? include '_inc_back_button.php'; ?>
            <!-- End BACK BUTTON -->      
            </div>

        </div>
        
    </div>
</div>
<? $this->registerCss('.back-button{margin: 25px 0 0 0}') ?>


