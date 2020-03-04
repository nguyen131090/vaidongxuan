<? $this->registerJsFile(DIR . 'assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerCssFile(DIR . 'assets/js/bxslider/jquery.bxslider.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 

$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); 

$this->registerCssFile('/assets/css/page2016/nos-destinations-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]) ?>

<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>


<div class="contain container-1">
    <? if(isset($theEntry->model->photos)) : ?>
    <? 
    $banner = '';
    foreach ($theEntry->model->photos as $key => $value) {
        if($value->type == 'banner') $banner = $value; 
    } ?>
    <img style="width: 100%;" alt="<?=$banner->description; ?>" class="img-lazy" data-src='<?=$banner->image ?>'>
    <? endif; ?>
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
     <div class="column row-2">
        
        <h1 class="title"><?=$theEntry->title ?></h1>
        
    </div>
     
    
</div>
<div class="contain container-2">
    
    <div class="column">
        <div class="rows row-1">
           <div class="btn-tabs">
                    
                    <img alt="" class="tab-panel-1 img-tabs img-lazy <?=!SEG2 ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_1.jpg">
                   
                   
                    <img alt="" class="tab-panel-2 img-tabs img-lazy <?=SEG2=='visiter' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_2.jpg">
                   
                   
                    <img alt="" class="tab-panel-3 img-tabs img-lazy <?=SEG2=='itineraire' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_3.jpg">
                    
                    
                    <img alt="" class="tab-panel-4 img-tabs img-lazy <?=SEG2=='informations-pratiques' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_4.jpg">
                   
                    <img alt="" class="tab-panel-5 img-tabs img-lazy <?=SEG2=='guide' ? 'active' : ''?>" data-src="<?=DIR?>assets/img/page2016/bg_tab_5.jpg">
                </div> 
                <ul id="tabs" class="nav nav-tabs tab-content-direct" data-tabs="tabs">
                        <li class="<?=!SEG2 ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1?>" data-toggle="tab" aria-expanded="true">Présentation <br>générale</a>
                            </h2>
                        </li>
                        <li data="tab-panel-2" class="<?=SEG2=='visiter' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/visiter'?>" data-toggle="tab">Sites à <br>visiter</a>
                            </h2>
                        </li>
                        <li data="tab-panel-3" class="<?=SEG2=='itineraire' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/itineraire'?>" data-toggle="tab" >Idées de <br>voyage</a>
                            </h2>
                        </li>

                        <li data="tab-panel-4" class="<?=SEG2=='informations-pratiques' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/informations-pratiques'?>" data-toggle="tab">Infos <br>pratiques</a>
                            </h2>
                        </li>
                         <li data="tab-panel-5" class="<?=SEG2=='guide' ? 'active' : ''?>">
                            <h2>
                            <a href="<?=DIR.SEG1.'/guide'?>" data-toggle="tab">Guide <br>culturel</a>
                            </h2>
                        </li>
                    </ul>
                <div id="my-tab-content" class="tab-content">
                    <? $voyage = \app\modules\destinations\api\Catalog::get('presentation-generale-'.SEG1);
                            $pdf = isset($voyage->data->pdf) && $voyage->data->pdf ? \yii\easyii\modules\file\api\File::get($voyage->data->pdf)->model->file : [];
                            $pdfImage = isset($voyage->photos) && $voyage->photos ? $voyage->photos[0]->image : '';?>
                    <div id="tab-3" class="tab-pane tab-panel-3 <?=SEG2 == 'itineraire' ? 'active' : '' ?>">
                        <? $voyage = \app\modules\destinations\api\Catalog::cat(URI); ?>
                        <div class="r r1">
                            <div class="text">
                                <p>
                                    <?=$voyage->model->content; ?>
                                </p>
                            </div>
                            <div class="search-form">
                               <!-- <p class="fix-tt">Résultat de votre recherche</p> -->
                                <form class="form-search horizontal search-prog-form itineraire">
                                    <div class="cs-select destination search-destination" style="display: none;">
                                        <span class="cs-placeholder active">Destination(s)</span>
                                        <div class="cs-options">
                                        </div>
                                        <div class="list-option">
                                            <ul>
                                            <li class="active" data-option="" data-value="<?=SEG1?>"><?=ucfirst(SEG1) ?><span></span></li>
                                            </ul>    
                                        </div>

                                    </div>
                                    <div class="cs-select search-length single">
                                        <span class="cs-placeholder active">Durée</span>
                                            <div class="cs-options">
                                                    <ul>
                                      <? $selectLen = Yii::$app->request->get('length'); ?>
                                                    <? foreach(Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                                    <li class="<?=strpos($selectLen, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
                                                    <? endforeach; ?>
                                </ul>
                                            </div>
                                         <div class="list-option">
                                            <ul>
                             <? foreach(Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                                    <li class="<?=strpos($selectLen, strval($key)) !== false ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                                                    <? endforeach; ?>
                            </ul>    
                                        </div>

                                    </div>
                                    <div class="cs-select search-type single">
                                        <span class="cs-placeholder">Type de voyage</span>
                                            <div class="cs-options">
                                                    <ul>
                                                        <? $selectType = explode('-',Yii::$app->request->get('type')); ?>
                                     <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                                               <li class="<?=in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                                               <? endforeach ?>
                                                    </ul>
                                            </div>
                                         <div class=" list-option">
                                            <ul>
                                              <? foreach ($type as $key => $value) : ?>
                                               <li class="<?=in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                                            <? endforeach ?>
                                            </ul>
                                        </div>

                                    </div> 
                                    <div class="cs-select search-submit submit">
                                        RECHERCHE
                                        <span id="count-prog-search"><?=count($allVoyage) ?></span>
                                    </div>
                                </form>
                            </div>
                         </div>   
                        
                        <div class="r r2">
                            <!--<p class="fix-tt"></p> -->
                           <div class="col col-left">
                                <div id="programes-load">
                                <?php
                    $cnt = 0;
                    $count = count($programes); 
                    foreach ($programes as $v) {
                    $cnt ++;    
                  
                    
                ?>
                   <?php 
                        if($cnt % 2 != 0){
                            echo '<div class="clear-fix">';
                        }
                    ?>
                        <div id="<?=$cnt?>" class="item item-<?= $cnt ?> <?= $cnt % 2 != 0 ? 'it-l' : 'it-r' ?>">
                             <a href="<?= DIR.$v->slug?>">
                             <?php
                                
                                 if(!empty($v->photos)){

                                     foreach ($v->photos as $value) {

                                         if($value->model->type == 'summary'){

                              ?>
                             <img style="" class="img-lazy img-responsive" alt="<?= $value->model->description?>" data-src='<?= $value->image?>'>
                                 <?php
                                         }
                                     }

                                  }else{
                                ?>
                             <img class="img-lazy img-responsive" alt="" data-src="<?=DIR?>upload/image/img_exclusi_type.jpg">
                                  <?php } ?>
                            
                           
                                <h3 class="tt"><?= str_replace('|','',$v->title) ?></h3>
                            </a>    
                            <div class="summary">
                                <p><?= $v->model->summary?></p>
                            </div>
                            <ul>
                                <?php
                                    if($v->model->days != ''){
                                ?>
                                <li class="calendar"><?= $v->model->days?> jours <?= $v->model->nights?> nuits</li>
                                    <?php } ?>
                                
                                
                                <?php if(isset($v->model->data->countries)){?>
                                <li class="posi">
                                    <?php
                                        $i= 0;
                                        if(is_array($v->model->data->countries)){
                                            foreach ($v->model->data->countries as $value) {
                                                $i ++;
                                                echo ucfirst($value);
                                                if($i < count($v->model->data->countries)){
                                                    echo ', ';
                                                }
                                            }
                                        }else{
                                           echo $v->model->data->countries;
                                        }
                                    ?>
                                </li>
                                <?php }?>
                            </ul>
                            
                        </div>
                        <?php
                            if($cnt % 2 == 0){
                                echo '</div>';
                            }
                            if($cnt % 2 != 0 && $cnt == $count){
                                echo '</div>';
                            }
                        ?>
                    <?php } ?>
                     <div class="pagination-prog">
                                    <? 
                                    $pagi = new \yii\data\Pagination(['totalCount' => $totalPage, 'defaultPageSize'=>12 ]);
                                    echo \yii\widgets\LinkPager::widget([
                                        'pagination' => $pagi,
                                        'maxButtonCount'=>5,
                                    ]);
                                    ?>  
                                    <? if($pagi->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=DIR.URI?>?view=all">Voir tout</a>
                            <? endif; ?>      
                                </div>
                                </div>
                            </div>
                            <div class="col col-right">
                                 <? if($pdfImage) : ?>
                                <div class="area-2">
                                    <a href="<?=$pdf ?>">
                                        <img alt="" class="img-lazy" data-src="<?=$pdfImage?>">
                                    </a>
                                    <a class="pdf-link" href="<?=$pdf ?>">Télécharger</a>
                                </div>
                                <? endif; ?>
                                <div class="area-1">
                                    <p class="tt">Besoin de conseil d’un expert ?</p>
                                    <ul>
                                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;"></li>
                                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                                    </ul>
                                    <a href="/devis" class="btn-contact">Demander un devis</a>
                                </div>    
                            </div>
                        </div>
                        
                         <?
                            $voyage = \app\modules\destinations\api\Catalog::get('idees-de-voyage-'.SEG1);?>
                        <? if(isset($voyage->data->moduleexcl[0]) || isset($voyage->data->moduleexcl)) { ?>
						
						
                        <div class="r r6">
                            <p class="module-name">NOS coupS de cœur</p>
                            <?php 
                                $mdName =  isset($voyage->data->moduleexcl[0]) ? $voyage->data->moduleexcl[0] : $voyage->data->moduleexcl;
                                $mdData = \app\modules\modulepage\api\Catalog::get($mdName);
                            ?>
                            <? if(isset($mdData->data->exclusives[0]) || isset($mdData->data->destinations[0])){ ?>
                           
                            <div id="slideCarousel" class="carousel slide carousel-fade">
                   
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#slideCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#slideCarousel" data-slide-to="1"></li>
                                    <li data-target="#slideCarousel" data-slide-to="2"></li>
                                </ol>
                            
                                <div class="carousel-inner">
                                        
                                        <? if(!empty($mdData->data->exclusives)) : ?>
                                        <?php
                                            $j = 0;
                                            foreach($mdData->data->exclusives as $key => $value){
                                                $j++;
                                                $data = \app\modules\exclusives\api\Catalog::get($value);
                                                
                                        ?>
                                            <?
                                                if($data != NULL){
                                            ?>
                                        <div class="item <?= $j == 1 ? 'active' : '' ?>">
                                            
                                            <div class="col col-left">
                                                <p class="tt"><?= str_replace('|','',$data->title) ?></p>
                                                <p class="text"><?= $data->model->summary ?></p>
                                            </div>
                                            <div class="col col-right">
                                            <a href="<?=DIR.$data->slug; ?>" class="">
                                                <div class="fill">
                                                    <?php
                                                        if(isset($mdData->photos[$j - 1])){
                                                    ?>
                                                    <img style="width: 100%;" alt="<?= $mdData->photos[$j - 1]->description ?>" data-src="<?= $mdData->photos[$j - 1]->image?>">
                                                    
                                                    <?php } ?>
                                                </div>
                                                <div class="logo">
                                                    <img alt="" style="width: 100%;" data-src="<?=DIR?>assets/img/page2016/bg_img_621_260.png">
                                                </div>
                                            </a>
                                            </div> 
                                            
                                        </div>
                                        <?php } ?>
                                        <?php
                                            }
                                        ?>
                                    <? else : ?>
                                    <?php
                                            $j = 0;
                                            foreach($mdData->data->destinations as $key => $value){
                                                $j++;
                                                $data = \app\modules\destinations\api\Catalog::get($value);
                                                
                                        ?>
                                            <?
                                                if($data != NULL){
                                            ?>
                                        <div class="item <?= $j == 1 ? 'active' : '' ?>">
                                            
                                            <div class="col col-left">
                                                <p class="tt"><?= str_replace('|','',$data->title) ?></p>
                                                <p class="text"><?= $data->model->summary ?></p>
                                            </div>
                                            <div class="col col-right">
                                            <a href="<?=DIR.$data->slug; ?>" class="">
                                                <div class="fill">
                                                    <?php
                                                        if(isset($mdData->photos[$j - 1])){
                                                    ?>
                                                    <img style="width: 100%;" alt="<?= $mdData->photos[$j - 1]->description ?>" data-src="<?= $mdData->photos[$j - 1]->image?>">
                                                    
                                                    <?php } ?>
                                                </div>
                                                <div class="logo">
                                                    <img alt="" style="width: 100%;" data-src="<?=DIR?>assets/img/page2016/bg_img_621_260.png">
                                                </div>
                                            </a>
                                            </div> 
                                            
                                        </div>
                                        <?php } ?>
                                        <?php
                                            }
                                        ?>
                                    <? endif; ?>
                                </div>

                            </div>
                            <?php } ?>
                                
                        </div>
                        <?php } ?>
						<div class="back-button-center back-button">

                            <div class="line"></div>
                            <a href="<?= DIR.'destinations'?>"><img alt="Retour" data-src="<?=DIR?>assets/img/back-button.png"/> TOUTES NOS DESTINATIONS</a>
                        </div>	
                    </div>  
                </div>  
            </div>  
            
            
           
        </div>
        
        
       
        
    </div>
</div>





  
<?php

$url = DIR.URI;
$js=<<<JS
        
$(window).bind("load", function() { 
       fixContent(); 
});

function fixContent(){
    $('.clear-fix').each(function(index) {
                var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
                
                var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
                if (htleft > htright){
                    $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
                }  
                 if (htright > htleft){
                    $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
                }   
        
                // fix height summary
                
                var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
                var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
               
                if (summaryleft > summaryright){
                    $(this).children('.it-r').children('.summary').css('min-height', summaryleft);
                }  
                 if (summaryright > summaryleft){
                    $(this).children('.it-l').children('.summary').css('min-height', summaryright);
                }       
          });
}

$('.chosen').chosen();

   
    $('.tab-content-direct li a').click(function(){
        window.location = $(this).attr('href');
        return false;
    });   
        
    $('.le .tx-1').click(function(){
        var name = $(this).parent('.le').attr('data-name');
        $(this).parent().children('.option').addClass('active');
        $(this).parent().children('.tx-2').addClass('active');
        $('.' + name).addClass('active');
    }); 

    $('.le .tx-2').click(function(){
        if(!$(this).hasClass('active')){
            $(this).parent().find('.tx-1').trigger('click');
            return false;
        }
        var name = $(this).parent('.le').attr('data-name');
        $(this).parent().children('.option').removeClass('active');
        $(this).parent().children('.tx-2').removeClass('active');
        $('.' + name).removeClass('active');
    }); 

    $('.hide-option').click(function(){
        var name = $(this).parent().parent('.le').attr('data-name');
        $(this).parent().parent().find('.option').removeClass('active');
        $(this).parent().parent().find('.tx-2').removeClass('active');
        $('.' + name).removeClass('active');
    });   

    $(document).on("click",".pagination-prog .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $.post(url, { type: 'prog' }, function(data){ 
            $('#programes-load').html(data);
            $('html, body').animate({scrollTop: $('#programes-load').offset().top - 200}, 200);
            fixContent(); 
            return false;

        });
        return false;
     });

    $('.form-search .cs-select .cs-options ul li, .form-search .cs-select .list-option ul li span').click(function(){
        var heightList = 0;
        $('.form-search .list-option').each(function(){
            if(heightList < $(this).height())
            heightList = $(this).height();
        })
        $('.r2').css('margin-top',heightList+'px');
    })

    $('#my-tab-content .cs-select.submit').click(function(){
          if($(this).hasClass('disable')) return false;
          var target = $(this);
          var des = pr = url = '';
          var parent = target.closest('form')
          parent.find('.search-destination .list-option .active').each(function(index){
              des += $(this).data('value');
              if(index != parent.find('.search-destination .list-option .active').length -1)
                  des += '-';
          })
          if(!des) des = 'all';
          var type = '';
          parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += '-';
          })
          if(!type) type= 'all';

          

          if(parent.hasClass('search-prog-form')){
            var length = '';
            var i = 0;
            parent.find('.search-length .list-option .active').each(function(index){
                length += $(this).data('value');
                if(index != parent.find('.search-length .list-option .active').length -1)
                    length += '-';
                i++;
            })
            if(!length || i ==3) length= 'all';
            pr = {'type': type, 'length': length};
            url = '/voyage/itineraire';
          }

           
          var url2 = decodeURIComponent($.param( pr ));
          url = "$url" + '?'+url2;
          window.location = url;
        })

JS;
$this->registerJs($js,  yii\web\View::POS_END);
$css = <<<CSS
.container-2 .tab-panel-3 .search-form{
    position: relative;
    border-top: none;
    border-bottom: 1px solid #919191;
}
.container-2 .tab-panel-3 .search-form form{
    position: absolute;
    bottom: -1px;
    background: #fff;
    padding-right: 10px;
}
.search-length{
    max-width: 200px;
}
.search-length .cs-placeholder{
    width: 100px;
}
.search-type{
    max-width: 250px;
}
#tab-3 .search-type .cs-placeholder{
    width: 170px;
}
.horizontal .cs-select .list-option, .vertical .cs-select .list-option{
    position: absolute;
}
.horizontal .cs-select .list-option ul li.active, .vertical .cs-select .list-option ul li.active{
    background: #3e3e3e;
    color: #e2e2e2;
    white-space: nowrap;
}
.container-2 .tab-panel-1 .search-form .cs-select .cs-options ul, .container-2 .tab-panel-3 .search-form .cs-select .cs-options ul{
    padding-right: 10px;
}
.container-2 .tab-panel-3 .r1 .text{
    margin: 0 150px 60px;
}
.container-2 .tab-panel-3 .search-form{
    margin-bottom: 35px;
}
a .fill img:hover{
    opacity: 0.7 !important;
}
#programes-load .clear-fix{
    clear: both;
    width: 100%;
    display: inline-block;
}
#programes-load .item {
    float: left;
    margin: 0 10px 40px;
    width: 330px;
    clear: none;
    height: auto;
}
#programes-load .item .tt {
    border-bottom: 1px solid #cbc0a2;
    font-family: "LatoLatin-Bold",sans-serif;
    font-size: 18px;
    margin: 0;
    padding: 25px 0 15px;
    text-transform: uppercase;
    text-align: left;
}
#programes-load .item .summary {
    margin: 15px 0 10px;
    text-align: left;
}
#programes-load .item ul {
    list-style: outside none none;
    margin: 0;
    padding: 0;
}
#programes-load .item ul li {
    float: left;
    font-size: 13.5px;
    margin: 3px 0;
    padding: 12px 0 0 28px;
}
#programes-load .item .calendar {
    background: transparent url("/assets/img/page2016/icon_time.png") no-repeat scroll 0 10px;
    margin-right: 20px;
}
#programes-load .item .posi {
    background: transparent url("/assets/img/page2016/posi.png") no-repeat scroll 0 bottom;
}
#programes-load{
    margin-top: 5px;
}
CSS;
$this->registerCss($css);
?>
