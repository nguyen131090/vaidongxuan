<?php $this->registerCssFile('/assets/css/page2016/exclusivites-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?//php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?//php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
     
    
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
<!--    <div class="column row-2">
        
        <h1 class="title"><?//= $theEntry->title?></h1>
    </div>-->
</div>
<div class="contain container-2">
    
    <div class="column">
        <?//= $theEntry->model->content?>
    </div>
</div>
<div class="contain container-3 lazy-background">
    
    <div class="column">
        
        <p class="tt-1">Tous les formules d'Amica</p>
        <p class="tt-2"><?= ucfirst(SEG2)?></p>
    </div>
</div>
<div class="contain container-4">
    
    <div class="column column-fixpadding">
        
        <div class="rows row-1">
            <div id='page-list' class="col col-1">
                <div id='exclusives-load'>
                        <? 
						 $cnt = 0;
						$count = count($theEntries); 
						foreach($theEntries as $key => $v) : 
							$cnt ++;   
						?>
						<?php 
							if($cnt % 2 != 0){
								echo '<div class="clear-fix">';
							}
						?>
                        <div class="item item-<?= $key+1 ?> <?= $cnt % 2 != 0 ? 'it-l' : 'it-r' ?>">
                            <a href="<?=DIR.$v->slug ?>">
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
                                <h2 class="tt"><?= str_replace('|','',$v->title); ?></h2>
                            </a>    
                            <div class="summary">
                                <p><?= $v->model->summary?></p>
                            </div>

                            <span class="posi">
                                <?php
                                     $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);
           
                                    $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');
                                    $ct = 0;
                                    foreach ($v->model->data->locations as $local) { $ct ++;
                                        echo $location[$local];
                                      // echo ucwords(str_replace('-', ' ', $local));
                                    //   if($ct < count($v->model->data->locations)){
                                            echo ', ';
                                    //   }
                                    }
                                ?>
								<?=isset($v->data->countries[0]) ? ucfirst($v->data->countries[0]) : ''?>
                            </span>
                        </div>
						<?php
                            if($cnt % 2 == 0){
                                echo '</div>';
                            }
                            if($cnt % 2 != 0 && $cnt == $count){
                                echo '</div>';
                            }
                        ?>
                    <? endforeach; ?>
                    <div class="pagination-excl">
                            <? 
                            $pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countExcl'), 'pageSize'=>12, 'defaultPageSize'=>12]);
                            echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pagi,
                            ]);
                            ?> 
                             <? if($pagi->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=Yii::$app->request->url?><?=isset($_GET) && Yii::$app->request->get('page') ? '&' : '?' ?>view=all">Voir tout</a>
                            <? endif; ?>         
                    </div>
              </div>  
              
            </div>
            
            <div class="col col-2">
                <div class="search-form">
                    <form class="form-search vertical search-excl-form">
                        <div class="cs-select search-destination destination-mn-2">
                                    <span class="cs-placeholder active">Destination(s)</span>
                                        <div class="cs-options" style="display: none;">
                                                <ul>
                                                    <? 
                                                       // $selectDes = explode('-',Yii::$app->request->get('country')); 
                                                        $selectDes = [SEG2];
                                                    ?>
                                                    <? foreach(Yii::$app->params['tsDestinationListNew'] as $key => $value) : ?>
                                                    <li class="<?=in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?></li>
                                                    <? endforeach; ?>
                                                </ul>
                                        </div>
                                    <div class="list-option">
                                        <ul>
                                          <? foreach(Yii::$app->params['tsDestinationListNew'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                        <? endforeach; ?>
                                        </ul>
                                    </div>    

                                </div>
                        <div class="cs-select search-type search-envies votre-envie-mn-2">
                                    <span class="cs-placeholder active">Votre envie du moment</span>
                                        <div class="cs-options" style="display: none;">
                                                <ul>
                                                    <? $selectType = explode('-',Yii::$app->request->get('type')); ?>
                                                   <? foreach ($type = \app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) : ?>
                                               <li class="<?=in_array($value->category_id, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                                            <? endforeach ?>
                                                </ul>
                                        </div>
                                     <div class="list-option">
                                        <ul>
                                           <? foreach ($type as $key => $value) : ?>
                                               <li  class="<?=in_array($value->category_id, $selectType) ? 'active' : '' ?>"   data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                                            <? endforeach ?>
                                        </ul>
                                    </div> 

                                </div>
                        <div class="cs-select submit">
                            RECHERCHE
                        </div>
                    </form>
               </div>   
            </div>
        </div>
        <div class="back-button-center back-button">

            <div class="line"></div>
            <a href="<?= DIR.$theParent->slug?>"><img alt="Retour" data-src="<?=DIR?>assets/img/back-button.png"/> TOUS LES formules d'Amica</a>
            <div class="line"></div>
        </div>
         <div class="rows row-2">
            <h3 class="title-tt"><?= $theRaisons->title?></h3>
            <?php
              
                
                $cnt = 0;
                $j = 0;
                foreach ($theRaisons_list as $v) {
                    
                    $cnt ++; 
                    $j ++;
                    if($cnt == 1){
                        echo '<div class="rr r1">';
                    }
                    $id = explode('.', $v->title);
            ?>
                <div class="item item-<?= $j?>">
                    <a href="<?=DIR.$theRaisons->slug.'#'.$id[0]?>">
                      <?php
                                
                        if(!empty($v->photos)){
                            $j = 0;
                            foreach ($v->photos as $value) {
                                $j++;
                                if($value->model->type == 'summary'){

                     ?>
                            <img class="img-lazy" alt="<?= $value->model->description?>" data-src='<?=DIR?>timthumb.php?src=<?= $value->model->image?>&w=132&h=132&zc=1'>
                                <?php
                                        }
                                    }

                                 }else{
                               ?>
                            <img alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img-qui-sommes-nous-2.png">
                         <?php } ?>
                    
                     <?php
                        
                        if($v->model->sub_title != ''){
                            $tt = explode('-', $v->model->sub_title);
                           
                            
                             echo '<p class="tt-1">'.$tt[0].'</p>';
                             echo '<p class="tt-2">'.$tt[1].'</p>';
                        }
                     ?>
                        
                    </a>
                </div>
                
            <?php 
                    if($j == 5){
                        $j = 0;
                    }
                    if($cnt == 5){
                        echo '</div><div class="rr r2">';
                    }
                    if($cnt == 10){
                        echo '</div>';
                    }
                }
            ?>

        </div>
        
    </div>
</div>

<?php
$dir_uri = DIR.URI;
$js = <<<JS
	
$(window).bind("load", function() { 
			//$('#exclusives-load .item-1, #exclusives-load .item-2').wrapAll('<div class="clear-fix"></div>');
			//$('#exclusives-load .item-3, #exclusives-load .item-4').wrapAll('<div class="clear-fix"></div>');
			//$('#exclusives-load .item-5, #exclusives-load .item-6').wrapAll('<div class="clear-fix"></div>');
			//$('#exclusives-load .item-7, #exclusives-load .item-8').wrapAll('<div class="clear-fix"></div>');
			//$('#exclusives-load .item').each(function(index) {
			//	if(index % 2 == 0){
			//		$(this).addClass('it-l');
			//	}
			//	if(index % 2 != 0){
			//		$(this).addClass('it-r');
			//	}
			//});
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
});

//$('.btn-submit').on("click",function(){
//      var value = $(this).attr("data-value");  
//    $('#load-more').load('$dir_uri?see-more=' + value + ' #load-more'); 
//});
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
$(document).on("click",".pagination-excl .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-des .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        $.post(url, { type: 'excl' }, function(data){ 
            $('#exclusives-load').html(data);
            $('html, body').animate({scrollTop: $('#exclusives-load').offset().top - 200}, 200);
			
			$('.img-lazy').lazy({
				scrollDirection: 'vertical',
				effect: 'fadeIn',
				effectTime: 1000,
				visibleOnly: true,
				onError: function(element) {
					console.log('error loading ' + element.data('src'));
				}
            
			});
			
		//	$('#exclusives-load .item-1, #exclusives-load .item-2').wrapAll('<div class="clear-fix"></div>');
		//	$('#exclusives-load .item-3, #exclusives-load .item-4').wrapAll('<div class="clear-fix"></div>');
		//	$('#exclusives-load .item').each(function(index) {
		//		if(index % 2 == 0){
		//			$(this).addClass('it-l');
		//		}
		//		if(index % 2 != 0){
		//			$(this).addClass('it-r');
		//		}
		//	});
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
            return false;
        });
        return false;
     });      
JS;
$this->registerJs($js, \yii\web\View::POS_END);
$css = <<<CSS
.pagination-excl{
    display: inline-block;
    float: right;
}
.hr{
    width: 100%;
    text-align: center;
}
.hr hr{
    display: inline-block;
    width: 100px;
    margin: 20px auto;
    border-top: 1px solid #cbc0a2;
}
#exclusives-load .item{
   // height: 480px;
}
CSS;
$this->registerCss($css);

?>