<?php $this->registerCssFile('/assets/css/mobile/devis.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
     <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.DIR.'timthumb.php?src='.$value->image.'&w=640&h=275&zc=1">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy img-responsive" data-src='<?=DIR?>timthumb.php?src=upload/image/banner_contact.jpg&w=640&h=275&zc=1'>
    <?php }?>
   
    
    
   <div class="column row-2">
        
        <h1 class="title"><?= $theEntry->title?></h1>
    </div>
    
</div>
<div class="contain container-2">
    
    <div class="column">
        <a class="btn-prev" href="<?= DIR ?>">Retour</a>
        <div class="text text-top-form">
            <h2 class="text-title"><?= $theEntry->title?></h2>
            <?= $theEntry->model->text ?>
               <!-- <p class="tt">DEMANDER UN DEVIS SUR MESURE</p>
                <p>Nos conseillères étudieront votre demande et vous répondra sous 48h !</p>
				-->

         
        </div>
        <?php include_once '/var/www/www.amica-travel.com/app/views/page2016/_form_devis.php';?>
        <?//php include_once '/../_form_devis.php';?>
    </div>
</div>

