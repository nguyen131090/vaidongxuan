<?php $this->registerCssFile('/assets/css/page2016/decouvrez-le-pays.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
 

?>


<div class="contain container-1">
     <?php
        if(!empty($theEntry->model->photos)){
            foreach ($theEntry->model->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-decouvrez-de-pays.jpg'>
    <?}?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        <h1 class="title m-0"><?= $this->context->pageT; ?></h1>
    </div>
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        <div class="rows row-3 fix-border mt-txt-60">
               <div class=""> <?= $theEntry->model->content?></div>

               <div id="decouvrez-load" class="ajaxfilter reportages mt-25">
                   <div class="getcontent">
                        <?php
                            $cnt = 0;
                            foreach ($theEntries as $k => $v) {
                                $cnt++;
                        ?>
                       <?php 
                        if($cnt % 3 == 1){
                            echo '<div class="clear-fix">';
                        }
                    ?>
                         <div class="amc-col amc-col-<?= $k+1?>">
                             <a href="<?=DIR.$v->slug?>">
                                 <?php
                                    if(!empty($v->model->photos)){
                                        foreach ($v->model->photos as $value) {
                                            if($value->type == 'summary'){
                                                echo '<img style="width: 301px; height: 325px;" alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.$value->image.'">';
                                            }
                                        }
                                    }else{

                                ?>

                                <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>upload/image/img-decouvrez-de-pays.jpg">
                                <?}?>

                                <h2 class="tt"><?= $v->title?></h2>   
                              </a>  
                               
                            </div>
                        <?php
                            if($cnt % 3 == 0){
                                echo '</div>';
                                if(count($theEntries) > $cnt){
                                    echo '<span class="space space-40"></span>';
                                    
                                }
                            }
                            if($cnt % 3 != 0 && $cnt == count($theEntries)){
                               
                                echo '</div>';
                                
                                if(count($theEntries) - 1 > $cnt || count($theEntries) - 2 > $cnt){
                                    echo '<span class="space space-40"></span>';
                                }
                            }
                        ?>
                        <?php }?>
                       
                       <?
                       
                            if (Yii::$app->request->get('see-more') == NULL) {
                                if (Yii::$app->request->get('page') != NULL) {
                                    $seemore = Yii::$app->request->get('page') * 6;
                                }else{
                                    $seemore = 6;
                                }

                            } else {
                                $seemore = Yii::$app->request->get('see-more');
                            }
                            if (Yii::$app->request->get('page') == NULL) {
                                $page = $seemore / 6;
                            } else {
                                $page = Yii::$app->request->get('page');
                            }
                       ?>
                       
                      <? if ($totalCount > $seemore && ($totalCount / 6) > $page) { ?>
                        <div class="see-more">
                             <span class="btn-submit ajax-see-more btn-amica-basic btn-amica-basic-1" data-seemore="<?= (($page + 1) * 6) ?>" data-page="<?= $page + 1 ?>" data-get="<?= 'see-more='.(6 + $pagesize) ?>" data-value='2'>Afficher la suite</span>
                         </div>
                         <? } ?>
                    </div>
            </div>
        </div>   
    </div>
</div>

<div class="contain container-6 mt-60">
    
    <div class="amc-column">
        
        <div class="rows row-1">
            <p class="tt">Pour aller plus loin</p>
            <a class="btn-amica-basic btn-amica-basic-1" href="<?=DIR?>a-propos-de-nous">A PROPOS DE NOUS</a>
        </div>
            
    </div>
        
</div>
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON --> 
<?php
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$js=<<<JS
 
  

    
         $('.fancybox-image').fancybox({
           titlePosition: 'over', 
            centerOnScroll: true,
            padding: 2,
           // type   :'iframe',
            openEffect: 'elastic',
            closeEffect: 'elastic',
            autoSize: true,
     });
        
 
   
	
        
        
    $(document).on("click",".pagination-deco .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-deco .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        $.post(url, { type: 'deco' }, function(data){ 
            $('#decouvrez-load').html(data);
            $('html, body').animate({scrollTop: $('#decouvrez-load').offset().top - 200}, 200);
            return false;
        });
        return false;
     });
        
       
                    
JS;
$this->registerJs($js,  yii\web\View::POS_END);

?>