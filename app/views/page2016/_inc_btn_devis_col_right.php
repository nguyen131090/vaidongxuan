<?php $this->registerCssFile('/assets/css/page2016/_inc_btn_devis_col_right.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div class="area-btn-contact">
    <div class="button-right-devis">
        <p class="tt">Besoin de conseil <br>d’un expert ?</p>
        <ul>
            <li><img alt="" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/hot_gon_thao_100_100.jpg"></li>
            <li>Notre conseiller(ère) vous répondra sous 48H</li>
        </ul>
        <? if(SEG1 == 'actualites' && SEG2 != ''){ ?>
       <span class="btn-contact pointer btn-amica-basic btn-amica-basic-2 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Demander un devis</span> 
        <? }else{ ?>
       <span class="btn-contact pointer btn-amica-basic btn-amica-basic-2 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Demander un devis</span> 
        <? } ?>
    </div>
    
</div>    