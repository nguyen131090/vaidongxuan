<?php $this->registerCssFile('/assets/css/page2016/faq.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

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
     <img alt="" style="width: 100%;" data-src='<?=DIR?>upload-images/page/a-propos-de-nous/mondulkiri-cambodge-5c55264b11.jpg'>
    <?}?>
   
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-25">
        
        <?//= $this->context->pageT;?>
        <h1 class="tt tt-40 tt-color-white tt-latolatin-bold fix-align-center tt-custom tt-responsive m-0 mb-txt-20"><?= $this->context->pageT ?></h1>
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
        
        <h2 class="tt tt-latolatin-bold tt-24 mb-txt-40">Trouvez les questions / réponses par thématique </h2>
        
        
         <? 
            $cnt = 0;
           $count = count($theEntries); 
           foreach($theEntries as $key => $v) : 

                   $cnt ++;   
           ?>
           <?php 
                   if($cnt % 3 == 1){
                           echo '<div class="clear-fix">';
                   }
           ?>
        
      
            <div class="item item-<?=$cnt?>">
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
                    
                    <h3 class="tt tt-latolatin-bold tt-18 tt-custom mt-txt-25"><?= $v->title?></h3>
                </a>
            </div>
           
        
        
        <?php
            if($cnt % 3 == 0){
                echo '</div>';
                 if($count > $cnt){
                    echo '<span class="space space-35 fix-responsive-hide"></span>';
                }
            }
            if($cnt % 3 != 0 && $cnt == $count){
                echo '</div>';
                 if($count - 1 > $cnt){
                    echo '<span class="space space-35 fix-responsive-hide"></span>';
                }
            }
        ?>
    <? endforeach; ?>
        
        <?//= $theEntry->content?>
        <?// include '_inc_back_button.php'; ?>
        <!-- End BACK BUTTON -->   
    </div>
    
</div>
   
<div class="contain container-4 fix-align-center mt-txt-40 mb-txt-60">
    <div class="amc-column">
        
        <h2 class="tt tt-latolatin-bold tt-24 tt-custom">Questions les plus fréquentes</h2>
        <span class="space space-40 fix-space-30"></span>
        
        <ul>
                <? 
                    $cnt = 0;
                   $count = count($list_item); 
                   foreach($list_item as $value) : 

                           $cnt ++;   
                           if($cnt == 1){
                               $i = 30;
                           }else if($cnt == 2){
                               $i = 30;
                           }else if($cnt == 3){
                               $i = 30;
                           }
                   ?>
                   


            <li><a href="<?=DIR.$value->slug?>"><?= $cnt?>. <?= $value->model->title?></a></li>



                <?php
                  
                         if($count > $cnt){
                            echo '<span class="space space-40 fix-space-'.$i.'"></span>';
                        }
     
                ?>
            <? endforeach; ?>

            

        </ul>
        
    </div>
    
</div>
<?php 

$js = <<<JS
 var csrfToken = $('meta[name="csrf-token"]').attr("content"); 
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
$this->registerJs($js, yii\web\View::POS_END);              
?>