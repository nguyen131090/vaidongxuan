<?php $this->registerCssFile('/assets/css/page2016/idees-de-voyage.css?v=005',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
     <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$this->context->getWatermarkimage($value->image).'">';
                }
            }
        }else{
            
    ?>
   
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-idees-de-voyage.jpg'>
    <?php }?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="column row-2 mb-txt-40">
            <h1 class="title"><?= $this->context->pageT?></h1>

    </div>
</div>

<div class="contain container-4 pt-25 pb-25 container-z-index-2 responsive-search-form-ngang">
    
    <div class="column">
      
        <div class="search-form quick-search">
            <form class="form-search horizontal search-prog-form">
                <div class="cs-select destination search-destination">
                    <span class="cs-placeholder" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_dest"><span class="input-text ml-10">Destination(s)</span><span class="icon-right"></span></span>
                        <div class="cs-options">
                            <ul>
                                <li data-option="" data-value="vietnam" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_dest_opt_vietnam"><span class="icon-check"></span><span class="text-option">Vietnam</span></li>
                                <li data-option="" data-value="laos" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_dest_opt_laos"><span class="icon-check"></span><span class="text-option">Laos</span></li>
                                <li data-option="" data-value="cambodge" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_dest_opt_cambodge"><span class="icon-check"></span><span class="text-option">Cambodge</span></li>
                                <li data-option="" data-value="birmanie" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_dest_opt_birmanie"><span class="icon-check"></span><span class="text-option">Birmanie</span></li>
                            </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <li data-value="vietnam">Vietnam<span></span></li>
                                <li data-value="laos">Laos<span></span></li>
                                <li data-value="cambodge">Cambodge<span></span></li>
                                <li data-value="birmanie">Birmanie<span></span></li>
                            </ul>     
                        </div>

                </div>
                <div class="cs-select une-envie search-length">
                    <span class="cs-placeholder" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_duration"><span class="input-text ml-10">Durée</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                            <ul>
                                <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                    <li data-option="" data-value="<?= $key ?>" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_duration_opt_<?= $key ?>"><span class="icon-check"></span><span class="text-option"><?= $value ?></span></li>
                                <? endforeach; ?>
                                
                            </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                    <li data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>
                                <? endforeach; ?>
                                
                            </ul>  
                        </div>

                </div>
                 <div class="cs-select type-de-voyage search-type">
                     <span class="cs-placeholder" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_voyage"><span class="input-text ml-10">Type de voyage</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                                <ul>
                                     <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->orderBy('order_num desc')->all() as $key => $value) : ?>
                                               <li data-option="" data-value="<?=$value->category_id ?>" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_voyage_opt_<?= $value->category_id ?>"><span class="icon-check"></span><span class="text-option"><?=$value->title ?></span></li>
                                               <? endforeach ?>
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                             <? foreach ($type as $key => $value) : ?>
                                               <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                                            <? endforeach ?>
                            </ul>    
                        </div>

                </div>
                <div class="cs-select search-region ">
                     <span class="cs-placeholder" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_region"><span class="input-text ml-10">Région</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                                <ul>
                                    <? $selectRegion = Yii::$app->request->get('region'); ?>
                                     <? foreach (Yii::$app->params['tRegionList'] as $key => $value) : ?>
                                               <li class="<?= strpos($selectRegion, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?= $key ?>" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="select_region_opt_<?= $key ?>"><span class="icon-check"></span><span class="text-option"><?= $value ?></span></li>
                                               <? endforeach ?>
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                             <? foreach (Yii::$app->params['tRegionList'] as $key => $value) { ?>
                                <li data-option="" data-value="<?= $key ?>"><?= $value ?><span></span></li>    
                                <? } ?>
                            </ul>    
                        </div>

                </div>
                <div class="cs-select submit quick-search-submit btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="sugg_section" data-analytics-label="btn_voyage">
                     <?=$this->context->countTour ?> Voyages
                </div>
            </form>
       </div>     
    </div>
</div>    
<div class="contain container-2">
    
    <div class="column mb-txt-60 mt-txt-60">
        <?= $theEntry->model->text?>

    </div>
</div>
<div class="contain container-3 pt-60 pb-60">
    
    <div class="column">
        <span class="tt-3 mb-txt-40 mt-0 d-block"><a href="<?=DIR?>voyage/itineraire"><?= $theEntry->title?></a></span>    
         <?php
            $cnt = 0;
            foreach ($theSeven as $v) { $cnt ++;
                
        ?>
            <?php if($cnt == 1){
                        echo '<div class="rows row-1 mb-40">';
                    }
            ?>
             <div class="item item-<?= $cnt ?> img-zoom-span">
                 <a href="<?= DIR.$v->slug?>" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="inspi_section" data-analytics-label="link_inspi_<?= $v->category_id ?>">
                    <span>
                         <?php
                            if(!empty($v->photos)){
                                $icon_img = NULL;
                                $img_summary = NULL;
                                foreach ($v->photos as $value) {
                                   
                                    if($value->type == 'summary'){
                                        $img_summary = TRUE;
                                        echo '<img style="" alt="'.$value->description.'" class="img-lazy" data-src="/thumb/166/166/1/100'.$value->image.'">';
                                    }
                                     if($value->type == 'icon'){

                                        $icon_img = $value->image;
                                    }
                                }
                            }

                        ?>

                        
                         <? if($img_summary == TRUE) { ?>
                         <span class="icon" style="background-image:url(<?= $icon_img != '' ? $icon_img : '' ?>)"></span>   
                         <? } ?>
                    </span>
                    <h2 class="mt-25">
                    <?= $v->title?>
                    </h2>
                </a>
            </div>
            <?php 
                
                if($cnt == 4){
                        echo '</div><div class="rows row-2">';
                    }
                 if($cnt == 8){
                     echo '</div>';
                 }   
            ?>
        <?php
            }
        ?>

       
    </div>
</div>


<div class="contain container-6 mt-60 mb-60">
    <div class="column">
        <div class="area-col col-left">
            <p>Notre équipe à votre écoute</p>
        </div> 
        <div class="area-col col-right">
            <ul>
                <li class="mb-25"><span class="btn-link-form pugjd" data-title="<?= base64_encode(DIR.'devis') ?>" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="listen_section" data-analytics-label="link_devis">Faites-nous savoir vos attentes</span></li>
                <li><span class="btn-link-form pugjd" data-title="<?= base64_encode(DIR.'rdv-telephonique') ?>" data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="listen_section" data-analytics-label="link_rdv">Convenir d'un RDV téléphonique</span></li>
            </ul>
        </div>
    </div>
      
</div>   
<?php
$js=<<<JS
//$.noConflict();
        
    //JQuery(document).ready(function(){
        $('.slider').bxSlider({
            slideWidth: 210,
            minSlides: 1,
            maxSlides: 2,
            slideMargin: 20,
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
            randomStart: false,
            // captions: true,
            auto: false,
           // mode: 'fade',
            speed: 1000,
           onSlideBefore: function(slideElement, oldIndex, newIndex){
            var lazy = slideElement.find('.lazy');
            var load = lazy.attr('data-src');
            lazy.attr('src', load).removeClass('lazy');
        }
        
        });
   //});
   
   //$('.destination .cs-options ul li').click(function(){
    $(document).on('click','.destination .cs-options ul li',function(){
       
       var array = [];
        
        $('.destination .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
               
                
                var text = $(this).children('.text-option').text();
                array.push($(this).children('.text-option').text()); //Replace with this and it will get the text from clicked li only.

               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').text('');
               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').append(text);
            }
        });
       //console.log(array.join(', '));
        var more = '';
        if(array.join(', ').length > 16){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Destination(s)';
        }
            var text = array.join(', ').substring(0,16) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });    
    
   
    //$('.une-envie .cs-options ul li').click(function(){
    $(document).on('click','.une-envie .cs-options ul li',function(){   
       var array = [];
        
        $('.une-envie .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
                
                var text = $(this).children('.text-option').text();
                array.push($(this).children('.text-option').text()); //Replace with this and it will get the text from clicked li only.

               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').text('');
               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').append(text);
            }
        });
        //console.log(array.toString().length);
        var more = '';
        if(array.join(', ').length > 16){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Durée';
        }
            var text = array.join(', ').substring(0,14) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });        
        
    //$('.type-de-voyage .cs-options ul li').click(function(){
    $(document).on('click','.type-de-voyage .cs-options ul li',function(){      
       var array = [];
        
        $('.type-de-voyage .cs-options ul li').each(function(e){
           
            var hsClass = $(this).hasClass('active');
            if(hsClass){
                
                var text = $(this).children('.text-option').text();
                array.push($(this).children('.text-option').text()); //Replace with this and it will get the text from clicked li only.

               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').text('');
               // $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').append(text);
            }
        });
        //console.log(array.toString().length);
        var more = '';
        if(array.join(', ').length > 16){
            more = '...';
        }
        if(array.join(', ').length == 0){
            more = 'Type de voyage';
        }
            var text = array.join(', ').substring(0,16) + more;
          $(this).parent().parent().parent().children('.cs-placeholder').children('.input-text ml-10').text(text);
          //console.log(array.toString().substring(0,18) + more);  
    });    
   
JS;
$this->registerJs($js,  yii\web\View::POS_END);

?>
