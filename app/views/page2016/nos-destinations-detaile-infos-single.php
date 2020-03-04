<?php 
$this->registerCssFile('/assets/css/page2016/nos-destinations-detaile-infos.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    
</div>
<div class="contain container-2">
    <div class="column">

        <div class="rows row-4">
            <div class="col col-left">
            <h1 class="title"><?= $this->context->pageT ?></h1>
            <div class="content-body entry-body">
               <?=isset($theEntry->model->content) ? $theEntry->model->content : $theEntry->description; ?>
               </div>
            </div>
            <div class="col col-right">
                <div class="area-3 menu-right">
                                    <ul>
                                        <? foreach ($children as $key => $value) : ?>
                                            <? if($value['status'] == 1){?>
                                            <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent' : ''?>  <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
											<a href="<?=DIR.$value->slug?>"><?=$value->title?></a><span class="arrow-down-up">arrow</span>
                                            <? if($value->items) : ?>
                                                <ul class="items <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                                    <? foreach ($value->items as $ki => $vi) : ?>
                                                        <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a href="<?=DIR.$vi->slug?>"><?=$vi->title?></a></li>
                                                    <? endforeach; ?>
                                                </ul>
                                            <? endif; ?>
                                            </li>
                                            <? } ?>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                <? $voyage = \app\modules\destinations\api\Catalog::get('presentation-generale-'.SEG1);
                            $pdf = isset($voyage->data->pdf) && $voyage->data->pdf ? \yii\easyii\modules\file\api\File::get($voyage->data->pdf)->model->file : [];
                            $pdfImage = isset($voyage->photos) && $voyage->photos ? $voyage->photos[0]->image : '';?>
                 <? if($pdfImage) : ?>
                                <div class="area-2">
                                    <a href="<?=$pdf ?>">
                                        <img alt="" class="img-lazy" data-src="<?=$pdfImage?>">
                                    </a>
                                    <a class="pdf-link" href="<?=$pdf ?>">Télécharger</a>
                                </div>
                <? endif; ?>
               <!-- <div class="area-2">
                    <p class="tt">Notre guide gratuit Vietnam</p>
                    <img alt="" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/img-book.png">
                    <a href="javascript:void(0);">Télécharger</a>
                </div>
				-->
            </div>
            
            
        </div>
        
        <div class="rows row-5">
            <div class="area-col col-left">
               <h3 class="tt">Notre équipe à votre écoute</h3>
           </div> 
           <div class="area-col col-right">
               <ul>
                   <li><a href="<?=DIR?>nous-contacter">Faites-nous savoir de vos attentes</a></li>
                   <li><a href="<?=DIR?>rdv-telephonique">Convenir d'un RDV téléphonique</a></li>
               </ul>
           </div>
       </div>
       <div class="back-button-center-content back-button">

          <div class="line"></div>
          <a href="<?= DIR.$theEntry->cat->slug?>"><img alt="Retour" data-src="<?=DIR?>assets/img/back-button.png"/> <?=$theEntry->cat->title ?></a>
        </div>
        
    </div>
</div>






  
<?php
//$this->registerCssFile('/assets/js/bxslider/jquery.bxslider.css');
//$this->registerJsFile('/assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$js=<<<JS
 $('.menu-right .parent > .arrow-down-up').click(function(){
        $(this).parent().find('.items').toggleClass('active');
		$(this).toggleClass('active');
		
       // $(this).parent().toggleClass('active');
        return false;
    })
      
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$css = <<<CSS
h1.title{
      font-size: 22px;
    text-transform: uppercase;
    color: #e75925;
    margin: 0px 0 25px;
}
.col-right .area-3 ul{
  padding: 0 10px 0 30px;
}
.col-left{
  padding-right: 40px;
}
.menu-right > ul > li{
	position: relative;
}
.menu-right > ul > li > a{
	padding: 10px 20px 5px 0;
	background: none;
}
.menu-right > ul > li.parent > a::before{
	display: none;
}

.menu-right > ul > li > .arrow-down-up{
	display: none;
	background: transparent url("/assets/img/drop-down.png") no-repeat scroll center center;
    cursor: pointer;
   
    height: 20px;
    position: absolute;
    right: 0;
    text-indent: -9999px;
    top: 8px;
    width: 20px;
	overflow: hidden;
}
.menu-right > ul > li.parent > .arrow-down-up{
	 display: inline-block;
}
.menu-right > ul > li > .arrow-down-up.active{
	 transform: rotate(180deg);
}
.menu-right .items.active{
	margin: 10px 0 10px;
}
.content-body img{
  margin: 10px 0;
}
CSS;
$this->registerCss($css);
?>
