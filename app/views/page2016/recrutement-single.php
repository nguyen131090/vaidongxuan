<?php $this->registerCssFile('/assets/css/page2016/recrutement-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<div class="contain container-1">
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    
</div>
<div class="contain container-2 fix-space-vs-back-button">
    
    <div class="amc-column">
        <div class="rows row-1 mt-20 pt-40">
            <div class="amc-col amc-col-1 entry-body">
                <h1 class="title"><?= $this->context->pageT; ?></h1>
                <?= $theEntry->description?>
                <? include '_inc_back_button.php'; ?>
                <!-- End BACK BUTTON -->  
            </div> 
             <? if(count($theEntries) >= 1){?>
            <div class="amc-col amc-col-2 mb-60">
                <p class="tt">Nos autres offres</p>
                <ul>
                    <?php
                        foreach ($theEntries as $v) {
							if($v->slug == URI){
								$color = '#e75925';
							}else{
								
								$color = '';
							}
                            echo '<li><a style="color: '.$color.'" href="'.DIR.$v->slug.'">'.$v->title.'</a></li>';
                        }
                    ?>
                </ul>
            </div>
             <? } ?>
        </div>    
    </div>
</div>

