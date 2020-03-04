<?php $this->registerCssFile('/assets/css/page2016/faq-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
    <?php
        if(!empty($theParent->photos)){
            foreach ($theParent->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
    ?>
     <img alt="" style="width: 100%;" data-src='<?=DIR?>upload-images/page/a-propos-de-nous/mondulkiri-cambodge-5c55264b11.jpg'>
    <?}?>
   
    <?php 
        $imageBanner = $theParent;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-40">
        
        <?//= $this->context->pageT;?>
        <p class="tt tt-40 tt-color-white tt-latolatin-bold tt-custom fix-align-center tt-responsive m-0 mb-10"><?= $theParent->title?></p>
        <div class="search-question">
            <div class="area-query-search">
                <input id="input-search" class="input-question" data-url='<?=DIR?>aide/search' value="" placeholder="Tapez un mot clé ou une question ..." name="question" type="text">
                <div class="result-search">
                    
                    <ul id="search-result">
                        
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="contain container-2 fix-space-vs-back-button fix-align-center mt-60">
    <div class="amc-column">
        <div class="rows row-1">
            
            <div class="amc-col amc-col-left">
                <div class="r r1 entry-body">
                    <?if($theEntry->slug == $thechildren->slug){?>
                        <h1 class="tt tt-24 tt-latolatin-bold tt-align-left"><?= $theEntry->model->title?></h1>
                    <?}else{?>
                        <p class="tt tt-24 tt-latolatin-bold tt-align-left"><?= $theEntry->model->title?></p>
                    <? } ?>
                    
                    
                    <div class="text-content">
                            <? 
                               $cnt = 0;
                               $count = count($theItems); 
                               foreach($theItems as $value) { 
                                   //var_dump($value);exit;
                                    $cnt ++;   
                                    if($cnt == 1){
                                        $i = 30;
                                    }else if($cnt == 2){
                                        $i = 31;
                                    }else if($cnt == 3){
                                        $i = 33;
                                    }
                            ?>



                        <div class="entry entry-<?= $cnt?>" id="<?//= explode('/', $value->slug)[2]?>">
                                
                                <?if($theEntry->slug == $thechildren->slug){?>
                                    <p class="title-content <?= URI == $value->slug ? 'fix-scroll' : '' ?> <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'active' : ''?>" data-url="<?= $value->slug?>"><span><?= $cnt ?>. <?= $value->model->title?></span></p>
                                
                                <?}else if($theEntry->slug != $thechildren->slug && URI == $value->slug){?>
                                    <h1 class="title-content <?= URI == $value->slug ? 'fix-scroll' : '' ?> <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'active' : ''?>" data-url="<?= $value->slug?>"><span><?= $cnt ?>. <?= $value->model->title?></span></h1>
                                
                                <?}else{?>    
                                    <p class="title-content <?= URI == $value->slug ? 'fix-scroll' : '' ?> <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'active' : ''?>" data-url="<?= $value->slug?>"><span><?= $cnt ?>. <?= $value->model->title?></span></p>
                                
                                <? } ?>
                            
                                <div class="text ajaxloadanswer <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'loaded active' : ''?>">
                                    <div class="getanswer">
                                        <?php 
                                            if(Yii::$app->request->post('slug') != NULL){
                                               echo $value->model->answer;
                                            }else if(URI == $value->slug){
                                               echo $value->model->answer; 
                                            }else if(URI == $theEntry->slug && $cnt == 1){
                                                 echo $value->model->answer; 
                                            }else{
                                                echo '';
                                            }
                               
                                
                                        ?>
                                        
                                    </div>    
                                </div>
                            </div>
                            <?php
                                if($count > $cnt){
                                   echo '<span class="space space-36"></span>';
                                }
                            ?>
                        <? } ?>
                        

                    </div>
                </div>
                
                
                <!-- Border -->
                <div class="fix-border">
                    <div class="">
                        
                        <span class="space space-40 fix-space-42"></span>
                    </div>
                </div>   
                <!-- end Border -->
                
                
                <div class="r r2">
                    <h2 class="tt tt-latolatin-bold tt-24 tt-custom">Voir d’autres thématiques questions/réponses</h2>
                    <span class="space space-35"></span>
                    
                    <? 
                        $cnt = 0;
                       $count = count($theFive); 
                       foreach($theFive as $key => $v) : 

                               $cnt ++;   
                       ?>
                       <?php 
                               if($cnt % 3 == 1){
                                       echo '<div class="clear-fix">';
                               }
                       ?>


                        <div class="item item-<?=$cnt % 3 == 0 ? 3 : $cnt % 3?>">
                            <a href="<?=DIR.$v->slug?>">
                                 <?php
                                    if(!empty($v->photos)){
                                        foreach ($v->photos as $value) {
                                            if($value->type == 'icon'){
                                 ?>
                                <img style="" class="img-lazy" alt="<?= $value->description?>" data-src="<?= $value->image?>">
                                    <?php
                                            }
                                        }

                                     }else{
                                   ?>
                                <img class="img-lazy" alt="" data-src="<?= DIR?>assets/img/page2016/img_item_icon_faq.png">

                              <?php } ?>
                                
                               
                                <h3 class="tt tt-latolatin-bold tt-18 tt-custom mt-25"><?= $v->title?></h3>
                            </a>
                        </div>



                    <?php
                        if($cnt % 3 == 0){
                            echo '</div>';
                             if($count > $cnt){
                                echo '<span class="space space-40 fix-responsive-hide"></span>';
                            }
                        }
                        if($cnt % 3 != 0 && $cnt == $count){
                            echo '</div>';
                             if($count - 1 > $cnt){
                                echo '<span class="space space-40 fix-responsive-hide"></span>';
                            }
                        }
                    ?>
                <? endforeach; ?>
                    
                    
                   
                   
                </div>
                
                 <!-- End BACK BUTTON -->   
                <? include '_inc_back_button.php'; ?>
                <!-- End BACK BUTTON -->  
            </div>
            <div class="amc-col amc-col-right">
                <div class="area-1 button-right-devis">
                    <p class="tt">Vous ne trouvez pas la réponse à votre question ?
                   </p>
                    <ul>
                    <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline;"></li>
                    <li>Le Service Client Amica Travel est toujours prêt à vous aider</li>
                    </ul>
                   <span class="pugjd btn-contact pointer btn-amica-basic btn-amica-basic-2" data-title="<?= base64_encode(DIR.'nous-contacter') ?>">Contactez-nous</span>
                </div>
                
                <div class="area-2">
                    <p class=""><span>en France</span>
                        du lundi au vendredi<br>
                        (9h-12h & 14h-18h)<br>
                        Tél. (+33) 6 19 08 15 72<br>
                        ou (+33) 6 28 22 72 86</p>
                    <p ><span>AU VIETNAM</span>
                        du lundi au vendredi (8h-17h30)<br>
                        Tél. (+84) 984 56 66 76</p>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php
$js=<<<JS
var csrfToken = $('meta[name="csrf-token"]').attr("content");         
    $('.title-content').click(function(){
        var hClass = $(this).hasClass('active');
        if(hClass){
            $(this).removeClass('active');
            $(this).parent().children('.text').removeClass('active');
        }else{
        
            $(this).addClass('active');
            $(this).parent().children('.text').addClass('active');
            var slug = $(this).data('url');
        
            var loaded = $(this).parent().children('.text').hasClass('loaded');
            if(!loaded){
                $.ajax({
                        type: "POST",
                        url: '',
                        data: { slug : slug, _csrf : csrfToken},
                        dataType: 'html',
                        context: this,
                        success: function(data){
                            $(this).parent().children('.ajaxloadanswer').addClass('loaded');   
                            var datanew = $($.parseHTML(data)).find(".getanswer");
                             
                            $(this).parent().children('.ajaxloadanswer').html(datanew);

                        },
                         error: function (errormessage) {

                            //do something else
                           // alert(data);

                        }
                });
            }    
        }
        
        
    });    
     // $(window).bind("load", function(){
            var hasClass = $('.title-content').hasClass('fix-scroll');
            if(hasClass){
                $('html, body').animate({
                    scrollTop: $(".title-content.fix-scroll").offset().top
                }, 500);
            }
            
      //  });    
        
        
        
        
	$('#input-search').keyup(function(event) {
		var target = $(this);
		var specialKey = [37, 39];
		var code = event.keyCode || event.which;
		if($.inArray(code, specialKey) > -1 ){
			return false;
		}
                var keyarrowdown = target.parent().children('.result-search').children('#search-result');
                var liSelected = keyarrowdown.children('li.selected');
                if(event.which === 40){ //ARROW DOWN
                    
                    if(liSelected.length === 1 && liSelected.next().length === 1){
                        liSelected.removeClass('selected').next().addClass('selected');
                    }
                    if(liSelected.length === 0){
                        keyarrowdown.children('li:first-child').addClass('selected');
                    }
                    return false;
                }   
		
                if(event.which === 38){ //ARROW UP
                    
                    if(liSelected.length === 1 && liSelected.prev().length === 1){
                        liSelected.removeClass('selected').prev().addClass('selected');
                    }
                    if(liSelected.length === 0){
                        keyarrowdown.children('li:last-child').addClass('selected');
                    }
                    return false;
                }   
        
                if(event.which === 13){ //KEY ENTER
                    
                    var switchlink = liSelected.children().attr('href');
                    window.location.href = switchlink;
                    return false;
                }   
        
		var url = target.data('url');
		$.ajax({
			type: "POST",
			url: url,
                        data: { search : target.val(), _csrf : csrfToken},
			dataType: 'html',
			success: function(data){
				$('#search-result').html(data);
				$('.area-query-search').addClass('active');
                                $('.result-search').addClass('active');
                                
			},
                         error: function (errormessage) {

                            //do something else
                           // alert(data);

                        }
		});
       
	});
    $("html").click(function() {
        $('.area-query-search').removeClass('active');
        $('.result-search').removeClass('active');
        
    });

        
       
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
 
