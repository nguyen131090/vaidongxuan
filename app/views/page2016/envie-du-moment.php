<?php $this->registerCssFile('/assets/css/page2016/envie-du-moment.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?//php
  //  echo '<pre>';
  //  var_dump($theSix_Exclu);exit;
?>
<div class="contain container-1">
     <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-exclusi.jpg'>
    <?}?>
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="column row-2">
        
        <h1 class="title"><?= $this->context->pageT?></h1>
    </div>
</div>
<div class="contain container-2">
    
    <div class="column">
        <?= $theEntry->content?>
    </div>
    <div class="back-button-center back-button">

      <div class="line"></div>
      <a href="<?= DIR.$root->slug?>"><img alt="" data-src="<?=DIR?>assets/img/back-button.png"/> <?=$root->title ?></a>
      <div class="line"></div>
  </div>
</div>
<div class="contain container-4 background img-lazy" data-src="<?=DIR?>assets/img/page2016/bg_special.jpg">
    
    <div class="column">
         <h2 class="tt-3"><?= $theParent_Exclu->title?></h2>    
        <?php
            $cnt = 0;
            foreach ($theSix_Exclu as $v) { $cnt ++;
                
        ?>
            <?php if($cnt == 1){
                        echo '<div class="rows row-1">';
                    }
            ?>
             <div class="item item-<?= $cnt ?>">
                 <a href="<?= DIR.$v->slug?>">
                    <span>
                        <?php
                            if(!empty($v->photos)){
								$icon_img = NULL;
                                foreach ($v->photos as $value) {
                                    if($value->type == 'summary'){
                                        echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                                    }
									if($value->type == 'icon'){

                                        $icon_img = $value->image;
                                    }
                                }
                            }else{

                        ?>

                        <img alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img-round.png">
                        <?}?>
                        <span class="icon" style="background-image:url(<?= $icon_img != '' ? $icon_img : '' ?>)"></span>   
                    </span>
                    <h4>
                    <?= $v->title?>
                    </h4>
                </a>
            </div>
            <?php 
                
                if($cnt == 3){
                        echo '</div><div class="rows row-2">';
                    }
                 if($cnt == 6){
                     echo '</div>';
                 }   
            ?>
        <?php
            }
        ?>

    </div>
</div>
<div class="contain container-5">
    
    <div class="column">
        <div class="search-form quick-search">
            <form>
				<span class="tt-text">UNE ENVIE ? </span>
                <div class="cs-select destination search-destination">
                    <span class="cs-placeholder active">Destination(s)</span>
                        <div class="cs-options">
                                <ul>
                                            <li data-option="" data-value="vietnam">Vietnam</li>
                                            <li data-option="" data-value="laos">Laos</li>
                                            <li data-option="" data-value="cambodge">Cambodge</li>
                                            <li data-option="" data-value="birmanie">Birmanie</li>
                                </ul>
                        </div>
                    <div class="list-option">
                        <ul></ul>
                    </div>

                </div>
                <div class="cs-select une-envie single search-type">
                    <span class="cs-placeholder active">Votre envie du moment</span>
                        <div class="cs-options">
                                <ul>
                                     <? foreach ($type = \app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) : ?>
                                               <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                                            <? endforeach ?>
                                </ul>
                        </div>
                     <div class="list-option">
                        <ul></ul>
                    </div>

                </div>
                <div class="cs-select submit">
                    RETROUVEZ UNE IDÉE
                </div>
            </form>
       </div>     
       
    </div>
</div>
<div class="contain container-6 background img-lazy" data-src="<?=DIR?>assets/img/page2016/bg_special_1.jpg">
    
    <div class="column">
        <p><span class="tt">Pour aller   plus loin</span><a class="" href="/explorateurs">PARCOUREZ LE PAYS AVEC CEUX QUI Y SONT NÉS</a></p>
    </div>
</div>    
<?php
$js = <<<'JS'
$('.quick-search .submit').click(function(){
        var url = '/formules/itineraire';
        var des = '';
        $('.search-destination .list-option .active').each(function(index){
            des += $(this).data('value');
            if(index != $('.search-destination .list-option .active').length -1)
                des += '-';
        })
        if(!des) des = 'all';
        var type = $('.search-type .list-option .active').data('value');
        if(!type) type= 'all';
        var pr = {'country': des, 'type': type};
        var url2 = $.param( pr );
        url = url + '?'+url2;
        window.location = url;
})
JS;
$this->registerJs($js);
?>