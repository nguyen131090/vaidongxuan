<?php 
use yii\helpers\Markdown;
$this->registerCssFile('/assets/css/page2016/a-propos-de-nous.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

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
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-qui-sommes-nous.jpg'>
    <?php  }?>
    
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
        <div class="rows row-0">
            <div class="two-col">
               <?= str_replace(['class="col col-','src="', '-2">'], ['class="amc-col amc-col-','data-src="', '-2"><h2 class="title mt-0 mb-txt-25 tt-fontsize-24 tt-latolatin-bold">'.$mot_du_fondateur['title'].'</h2>'], $mot_du_fondateur['content']);?>

            </div>
        </div>
        
        <div class="rows row-1">
            
           <?php
                $cnt = 0;
                foreach ($theMenu as $v) {
                   
                    $cnt++;
                    if($cnt <= 4){
                        $size_img = 213; 
                            
                    }else{
                        $size_img = 100;
                    }
                    if($cnt == 1){
                        echo ' <div class="rr rr-1 mb-0">';
                    }
                    
            ?>
            
                <div class="item item-<?= $cnt?>">
                    <a href="<?=DIR.$v->slug?>" data-analytics="on" data-analytics-category="qui_page" data-analytics-action="qui_section" data-analytics-label="link_qui_<?= $v->category_id ?>">
                        
                        <span>
                            <?php
                                $text_sum = NULL;
                                $title_sum = Null;
                                if(!empty($v->photos)){
                                    foreach ($v->photos as $value) {
                                        
                                        if($value->type == 'summary'){
                                            $title_sum = $value->description;
                                            $text_sum = $value->caption;
                                            echo '<img style="" alt="'.$value->description.'" class=" img-lazy" data-src="'.DIR.'timthumb.php?src='.$value->image.'&w='.$size_img.'&h='.$size_img.'&zc=1">';
                                        }
                                    }
                                }else{

                            ?>

                            <img style="" alt="" class="img-lazy" data-src="/assets/img/page2016/img-<?=$size_img?>-<?=$size_img?>.jpg"> 
                            <?php }?>
                            
                           
                        </span>
                        <h2 class="title mb-0 mt-25"><?= $v->sub_title == '' ? $v->title : $v->sub_title ?></h2>
                        
                    </a>
                    <div class="<?= $cnt <= 4 ? 'mt-txt-20' : '' ?>"><?= $cnt <= 4 ? $v->summary : '' ?></div>
                </div>
                <?php
                    if($cnt == 4){
                        echo '</div><div class="rr rr-2 mt-txt-40 mb-txt-60">';
                    }
                    if($cnt == 9){
                        echo '</div>';
                    }
                ?>
            
            <?php } ?>
            
        </div>
            
    </div>
            
</div>
<div class="container-flud about-container text-center  d-inline-block w-100">
    <div class="column container text-left row-video d-inline-block">
        <h2 class="tt my-txt-40 text-center text-uppercase"><?=strip_tags(Markdown::process($video->title), '<strong>'); ?></h2>
        <p class="summary mt-0 mb-40 text-center"><?=$video->model->summary; ?></p>
        <div class="videoWrapper">
        <iframe class="videotype videoytb my-0 w-100" scrolling="no" data-src="<?=$video->model->sub_title; ?>" autoplay allowfullscreen="allowfullscreen"  frameborder="0" data-analytics="on" data-analytics-category="qui_page" data-analytics-action="video_section" data-analytics-label="control_play"></iframe>
        </div>
    </div>
</div>
<div class="container-flud excl-container mt-60">
    <div class="container column text-left">
        <div class="block-excl p-25 d-inline-block">
            <h2 class="tt mb-20 mt-0">Chez l'habitant<br><span>en Indochine</span></h2>
            <p class="mt-0 mb-20"><?=$entryChez->model->summary;?></p>
            <a class="btn-amica-basic-1 btn-amica-basic float-right" href="/<?=$entryChez->slug;?>" data-analytics="on" data-analytics-category="qui_page" data-analytics-action="habitant_section" data-analytics-label="cta_habitant">Découvrez nos hôtes</a>
        </div>
    </div>
</div>
<div class="contain container-4 responsive-10-raisons">
    
    <div class="amc-column amc-column-fixpadding">
       <div class="rows row-4 p-0 mt-60">
            
           <h3 class="title-tt mt-0 mb-txt-40"><a href="<?=DIR?>10-raisons-de-partir-avec-amica-travel" data-analytics="on" data-analytics-category="qui_page" data-analytics-action="raisons_section" data-analytics-label="link_10raisons"><?= $theRaisons->title?></a></h3>
            <?php
              
                
                $cnt = 0;
                $j = 0;
                foreach ($theRaisons_list as $v) {
                 
                    $cnt ++; 
                    $j ++;
                    if($cnt == 1){
                        echo '<div class="rr r1 p-0 mb-txt-40">';
                    }
                    $id = explode('.', $v->title);
            ?>
                <div class="item amc-col amc-col-<?= $j?>">
                    
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
                        
                    
                </div>
                
            <?php 
                    if($j == 5){
                        $j = 0;
                    }
                    if($cnt == 5){
                        echo '</div><div class="rr r2 p-0">';
                    }
                    if($cnt == 10){
                        echo '</div>';
                    }
                }
            ?>
        </div>
        

    </div>
    
</div>

<div class="contain container-5 mb-60 responsive-area-btn-link">
    
    <div class="amc-column">
        <div class="rows row-1">
            <p class="tt mb-40">Pour aller plus loin</p>
            <div class="area-btn-link m-0">
                <a class="link-btn link-btn-left btn-amica-basic btn-amica-basic-1" href="<?=DIR?>explorateurs" data-analytics="on" data-analytics-category="qui_page" data-analytics-action="more_section" data-analytics-label="cta_explorateurs">Parcourez le pays avec ceux qui y sont nés</a>
                <a class="link-btn link-btn-right btn-amica-basic btn-amica-basic-1" href="<?=DIR?>voyage" data-analytics="on" data-analytics-category="qui_page" data-analytics-action="more_section" data-analytics-label="cta_voyage">Bougez selon votre humeur du moment</a>
            </div>    
        </div>
        
    </div>

</div>

    
   
<?php
$js=<<<JS
$(window).bind("load", function() { 


  $('.container-2 .rr-1 .item').each(function(index) {
        var max = 0;
        var height = $(this).find('.title').outerHeight();
        if(max < height){
            max = height;
        }
        
       $('.container-2 .rr-1 .item .title').css("min-height", max);
        
             
  });
});     
	 
//Jquery Video AutoPlay
    $(document).ready(function() {
            // Get media - with autoplay disabled (audio or video)
            var media = $('video').not("[autoplay='autoplay']");
            var tolerancePixel = 40;

            function checkMedia(){
                // Get current browser top and bottom
                var scrollTop = $(window).scrollTop() + tolerancePixel;
                var scrollBottom = $(window).scrollTop() + $(window).height() - tolerancePixel;

                media.each(function(index, el) {
                    var yTopMedia = $(this).offset().top;
                    var yBottomMedia = $(this).height() + yTopMedia;

                    if(scrollTop < yBottomMedia && scrollBottom > yTopMedia){ //view explaination in `In brief` section above
                        $(this).get(0).play();
                         
                    } else {
                        $(this).get(0).pause();
                    }
                });

                //}
            }
            $(document).on('scroll', checkMedia);
        });
//End Video    

JS;
$this->registerJs($js,  yii\web\View::POS_END);
$css = <<<CSS

.video .right {
    float: right;
    text-align: left;
   
}
.video .left {
    float: left;
    text-align: left;
      width: 260px;
}
.video .right h3 {
    font: 18px lato-regular,sans-serif;
    margin-top: 0;
}
.video h4 {
    background: transparent url(/assets/img/page2016/icon-video.png) no-repeat scroll left top;
    padding: 10px 40px;
}
.container-2 .row-0 .two-col .amc-col-2 p:nth-of-type(1){
    margin-bottom: 20px;
}

CSS;
$this->registerCss($css);
?>
