<?php $this->registerCssFile('/assets/css/page2016/votre-projet.css?v=004',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile('https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>


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
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_contact.jpg'>
    <?php }?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
     <div class="column row-2">
        
        <h1 class="title"><?= $this->context->pageT?></h1>
    </div>
   
    
</div>
<div class="contain container-2">
    
    <div class="column">
        <div class="rows row-1 ">
    <div id="votre-load" class="text-center">
            <? if(count(Yii::$app->session['projet']['programes']['select']) + count(Yii::$app->session['projet']['exclusives']['select'])) : ?>
            <div class="col col-1">
                <div class="count-tour">
                    <p class="tt ">VOTRE LISTE D’ENVIEs</p>
                    <span class="count-numb"><?= count(Yii::$app->session['projet']['programes']['select']) + count(Yii::$app->session['projet']['exclusives']['select']) ?></span>
                </div>
            </div>
            <div class="col col-2">
                    
                    <?php
                    $selectProg = $viewProg = $progSelectObj = []; 
                    if (Yii::$app->session['projet']['programes']['select']) $selectProg = Yii::$app->session['projet']['programes']['select'];
                    if (Yii::$app->session['projet']['programes']['view']) $viewProg = Yii::$app->session['projet']['programes']['view'];
                    if($selectProg){
                        $progSelectObj = \app\modules\programmes\api\Catalog::items(['where' => ['item_id' => $selectProg]]);
                    }
                    ?>
                    <? if($progSelectObj) : ?>
                    <p class="t-1 prog-zero-text <?=!Yii::$app->session['projet']['programes']['select'] ? 'active' : '' ?>">Aucun programme sélectionné. Retrouvez nos suggestions :</p>
                    <p class="t-2 text-left">LES VOYAGES QUE VOUS AIMEZ :</p>
            <!-- Get programes select or view or hot voyage -->
                    <ul class="bxslider" id="bxslider-programes" >
                        <? foreach ($progSelectObj as $kps => $vps) : ?>
                        <li>
                            <div data-name="programes" class="item item-<?=$kps+1 ?>">
                                <a class="url-tour" href="<?=DIR.$vps->slug?>">
                                    <? foreach ($vps->photos as $kpvps => $pvps) :?>
                                        <? if($pvps->model->type == 'summary') : ?>
                                                <img width="194" height="129"  data-src="<?='/timthumb.php?src='.$pvps->image.'&w=194&zc=0'?>" alt="<?=$pvps->description?>">
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <p class="tt text-left"><?= str_replace('|','',$vps->title) ?></p>
                                </a>
                                <a href="<?=DIR.$vps->slug.'/form'?>" class="link-to-form">Personnaliser ce programme</a>
                                <?  if(in_array($vps->model->item_id, $selectProg)) : ?>
                                <span data-id="<?= $vps->model->item_id?>" data-type="prog" class="btn-add pointer" name="selected"></span>
                                <? else: ?>
                                 <a  data-id="<?= $vps->model->item_id?>" data-type="prog" class="btn-add active" name=""></a>
                                <? endif; ?>
                            </div>
                        </li>
                        <? endforeach; ?>
                        
                    </ul>
                     <div class="hr"></div>
                    <? endif; ?>
                   
                   
                    <?php
                    $selectExcl = $viewExcl = $exclSelectObj = []; 
                    if (Yii::$app->session['projet']['exclusives']['select']) $selectExcl = Yii::$app->session['projet']['exclusives']['select'];
                    if (Yii::$app->session['projet']['exclusives']['view']) $viewExcl = Yii::$app->session['projet']['exclusives']['view'];
                    if($selectExcl){
                        $exclSelectObj = \app\modules\exclusives\api\Catalog::items(['where' => ['item_id' => $selectExcl]]);
                    }
                    ?>
                    <? if($exclSelectObj) : ?>
                     <p class="t-1 excl-zero-text <?=!Yii::$app->session['projet']['exclusives']['select'] ? 'active' : '' ?>">Aucune formule sélectionnée. Retrouvez nos suggestions :</p>
                    <p class="t-2">LES SECRETS D'AILLEURS QUE VOUS AIMEZ :</p>
                    <!-- Get exclusives select or view or hot exclusives -->
                    <ul class="bxslider" id="bxslider-exclusives" >
                        <? foreach ($exclSelectObj as $kes => $ves) : ?>
                        <li>
                            <div data-name="exclusives" class="item item-<?=$kes+1 ?>">
                                <a class="url-tour" href="<?=DIR.$ves->slug?>">
                                    <? foreach ($ves->photos as $kesp => $vesp) :?>
                                        <? if($vesp->model->type == 'summary') : ?>
                                                <img   width="194" height="129"    data-src="<?='/timthumb.php?src='.$vesp->image.'&w=194&zc=0'?>" alt="<?=$vesp->description?>">
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <p class="tt text-left"><?= str_replace('|','',$ves->title) ?></p>
                                </a>
                                <a href="<?=DIR.$ves->slug.'/form'?>" class="link-to-form">Personnaliser cette formule</a>    
                                <?  if(in_array($ves->model->item_id, $selectExcl)) : ?>    
                                <span data-id="<?= $ves->model->item_id?>" data-type="excl" class="btn-add pointer" name="selected"></span>
                                <? else: ?>
                                 <a  data-id="<?= $ves->model->item_id?>" data-type="excl" class="btn-add active" name=""></a>
                                <? endif; ?>
                            </div>
                        </li>
                        <? endforeach; ?>
                    </ul>
                    <? endif; ?>
            </div>
            <? else: ?>
        <p class="text-status-0">Votre liste d'envies est vide.</p>
        <p class="text-status-0">Vous pouvez continuer à nagivuer notre site pour ajouter les idées voyages à votre liste, ou faites-nous savoir vos envies en remplissant ce formulaire de demande.</p>

        <? endif; ?>
            </div>
        </div>
        
        <div class="rows row-2 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="d-inline-block">
            <div class="item item-1">
                <p class="tt">Faites-nous part de voS ENVIES !</p>
            </div>
            <div class="item item-2">
                <img class="sale-image" alt="" data-src="<?=DIR?>assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%;">
            </div>
             <div class="item item-3">
                 <p class="text">Votre conseiller(ère) étude<br>l’ensemble de votre projet<br>& vous répondra sous 48H</p>
                 <span class="show-form pointer">Demander un devis</span>
            </div>
            </div>
        </div>
        <div class="area-form">
        <?php include_once '_form_devis.php';?>
        </div>    
    </div>
</div>

<?php

$dir = DIR;
$dir_uri = DIR.URI;
$js=<<<JS
var sliderExcl, sliderProg;
$(window).load(function(){
    sliderExcl = $('#bxslider-exclusives').bxSlider({
            slideWidth: 194,
            slideMargin: 30,
            nextText: 'Next',
            prevText: 'Prev',
            minSlides: 1,
            maxSlides: 3,
            moveSlides: 1,
            pager: false,
            infiniteLoop: false
    });
    sliderProg = $('#bxslider-programes').bxSlider({
            slideWidth: 194,
            slideMargin: 30,
            nextText: 'Next',
            prevText: 'Prev',
            minSlides: 1,
            maxSlides: 3,
            moveSlides: 1,
            speed: 1000,
            pager: false,
            infiniteLoop: false
    });
});
$(function(){
    fixHeight();
})

function fixHeight(){
    var hProg = 0;
    $('#bxslider-programes li .tt').each(function(){
        if($(this).height() >=  hProg) hProg =  $(this).height();
    })
    $('#bxslider-programes li .tt').height(hProg);
    var hExcl = 0;
    $('#bxslider-exclusives li .tt').each(function(){
        if($(this).height() >=  hExcl) hExcl =  $(this).height();
    })
    $('#bxslider-exclusives li .tt').height(hExcl);
}
        $(document).on('click', '.btn-add', function(){
            var type = $(this).data('type');
            var name = $(this).attr('name');
            if(name == "selected"){  
                $(this).attr("name","");
                $(this).addClass('active');
                $(this).text('ajouter à votre projet');
                $(this).parent().children().children('.tt').addClass('active');
        
                 var remove_id = $(this).data('id');
               
                $.ajax({
                    type: 'post',
                    url: "$dir" + 'votre-liste-envies',
                    data: {
                        type: 'remove-'+type,
                        remove_id: remove_id
                    },
                    dataType: 'json',
                    success: function(data) {
                       $('.count-numb').text(data.prog + data.excl);
                       $('#numb-tour').text(data.prog + data.excl); 
                       $('#votre-load').html(data.html);
                       $('#bxslider-exclusives').bxSlider({
                            slideWidth: 194,
                            slideMargin: 30,
                            nextText: 'Next',
                            prevText: 'Prev',
                            minSlides: 1,
                            maxSlides: 3,
                            moveSlides: 1,
                            pager: false,
                            infiniteLoop: false
                        });
                        $('#bxslider-programes').bxSlider({
                            slideWidth: 194,
                            slideMargin: 30,
                            nextText: 'Next',
                            prevText: 'Prev',
                            minSlides: 1,
                            maxSlides: 3,
                            moveSlides: 1,
                            pager: false,
                            infiniteLoop: false
                        });
                        fixHeight();
                       if(data.prog == 0){
                        $('.prog-zero-text').addClass('active');
                       } 
                       else {
                            $('.prog-zero-text').removeClass('active');
                       } 

                       if(data.excl == 0){
                            $('.excl-zero-text').addClass('active');
                       } 
                       else{
                            $('.excl-zero-text').removeClass('active');
                       }
                    }
                });
                
            }
            else {
                $(this).attr("name","selected");
                $(this).removeClass('active');
                if($(this).data('type') == 'prog'){
                    $(this).text('Personnaliser ce programme');
                } else $(this).text('Personnaliser cette formule');
                
                $(this).parent().children().children('.tt').removeClass('active');
             
        
              var tour_id = $(this).data('id');
              var tour_name = $(this).parent().children().children('.tt').text();
              var tour_url = $(this).parent().children('.url-tour').attr('href');
              var image = $(this).parent().children('.url-tour').children('img').data('src');
              var seg1 = $(this).parent().data('name');
               
                $.ajax({
                    type: 'post',
                    url: "$dir" + 'votre-liste-envies',
                    data: {
                        type: type,
                        tour_id: tour_id,
                        tour_name: tour_name,
                        tour_url: tour_url,
                        image: image,
                        seg1: seg1,
                    },
                    dataType: 'json',
                    success: function(data) {
                       $('.count-numb').text(data.prog + data.excl);
                        $('#votre-load').html(data.html);
                       $('#numb-tour').show().text(data.prog + data.excl); 
                       if(data.prog == 0){
                        $('.prog-zero-text').addClass('active');
                       } 
                       else {
                            $('.prog-zero-text').removeClass('active');
                       } 

                       if(data.excl == 0){
                            $('.excl-zero-text').addClass('active');
                       } 
                       else{
                            $('.excl-zero-text').removeClass('active');
                       }
                    }
                });
                return false;
            }
        });
        
JS;
$this->registerJs($js, \yii\web\View::POS_END);
// $this->registerCss('.bx-wrapper{max-width: 100% !important;}')
$css = <<<CSS
.text-status-0{
    margin: 0;
}
.text-status-0:first-of-type{
    margin: 0 0 25px 0;
}
.container-2 .row-2 .item-1 .tt{
    text-align: center;
}
.sale-image{
    border-radius: 100%;
    border: 2px solid #cec3a3;
}
.container-2 .row-2{
    margin: 0 0 20px 0;
}
.d-inline-block{
    display: inline-block;
}
.text-status-0{
    width: 670px;
    display: inline-block;
}
CSS;
$this->registerCss($css);
?>
