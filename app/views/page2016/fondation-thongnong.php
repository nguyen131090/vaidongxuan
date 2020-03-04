<?php $this->registerCssFile('/assets/css/page2016/fondation-thongnong.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?//php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?//php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<div class="contain container-1">
     <?
//        if(!empty($theEntry->model->photos)){
//            foreach ($theEntry->model->photos as $value) {
//                if($value->type == 'banner'){
//                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
//                }
//            }
//        }else{
            
    ?>
    
<!--    <img style="width: 100%;" alt="" data-src='<?//=DIR?>upload/image/banner-thongnong.jpg'>-->
    <?//php }?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
<!--     <div class="amc-column row-2">
        
        <h1 class="title"><?= $this->context->pageT; ?></h1>
        
    </div>-->
    
</div>
<div class="contain container-2 mt-60">
    
    <div class="amc-column">
        <div class="rows row-1">
            <h1 class="title">
            <?php if(SEG3 == 'thong-nong-vietnam'){ ?>
            <img class="logo-projets" alt=""  data-src="<?=DIR?>assets/img/page2016/logo_thongnong_new_66_64.png" />
            <?php } ?>
            <?= $this->context->pageT; ?>
            </h1>
            <ul>
                <?//php
                  //     $data = $theEntry_info->data;
                  //     var_dump($data);exit;
                ?>
                <li><span>Location</span><?= $theEntry_info->data->adresse?></li>
                <li><span>Début du projet</span><?= $theEntry_info->data->date?></li>
            </ul>
        </div>
        <div class="rows row-2 entry-content entry-body mt-40">
             <?//= $theEntry->content?>
             <?php 
                            $points = [];
                            if(isset($theEntry->model->content)){
                                $points = explode('<hr />', str_replace('src="', 'data-src="', $theEntry->model->content));
                            }  
                            $i = 0;
                                foreach ($points as $key => $value) {
                                    if($key == $i){
                                    $points_cont[$i] = $value;
                               }
                               $i++;
                            }
                            
                            if(isset($points_cont[0])){
                                echo $points_cont[0];
                            }
                            
                           
                        ?>

        </div>
    </div>
</div>

<?php
    if(isset($points_cont[1])){
?>

<div class="contain container-5 lazy-background mb-20">
    
    <div class="amc-column">
        <div class="rows row-1">
            <table class="tb tb-1">
                <tr>
                    <td>
                        <?= $points_cont[1]; ?>
                    </td>
                </tr>
            </table>
            <table class="tb tb-2">
                <tr>
                    <td>
                        <?php
                             if(isset($points_cont[2])){
                                 echo $points_cont[2];
                             }
                        ?>
                    </td>
                </tr>
            </table>
        
      </div>    
            
    </div>
        
</div>

<?php } ?>

<?php
    if(isset($theEntries) && !empty($theEntries)){
?>

  


<div class="contain container-7 lazy-background">
    
    <div class="amc-column">
        <div class="rows row-1">
				<h3 class="tt">Pour aller plus loin</h3>
                <?php
                    foreach ($theEntries as $v) {
                        echo '<a class="" href="'.DIR.$v->slug.'">'.$v->title.'</a>';
                    }
                ?>
       
<!--                <a class="" href="#">Avancement du projet en 2013</a>
                <a class="" href="#">Avancement du projet en 2014</a>
                <a class="" href="#">Avancement du projet en 2016</a>-->
            
           
        </div>
     </div>
</div>

<?php } ?>
<?php
    if(isset($theList_tour) && $theList_tour != NULL){
?>

<div class="contain container-8 fix-space-vs-back-button mt-40">
    
    <div class="amc-column">
        <div class="rows row-1">
           
            <h3 class="m-0 tt tt-fontsize-24 tt-latolatin-bold mb-txt-40">Les voyages incluant <?= $location[$theEntry_info->data->location[0]]?></h3>
            
            <div class="amc-col amc-col-2">
                <?php
                    $cnt = 0;
                    foreach ($theList_tour as $v) {
                        $cnt++;
                ?>
                 <div class="amc-custom-hover-block-image item item-<?=$cnt?>">
                    <a href="<?= DIR.$v->slug ?>">
                        <div class="amc-image">
                            <?php
                                if(!empty($v->photos)){
                                    foreach ($v->photos as $value) {
                                        if($value->model->type == 'summary'){
                                            echo '<img style="" alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.DIR.'thumb/300/200/1/80'.$value->image.'">';
                                        }
                                    }
                                }

                            ?>
                        </div>    
                    </a>     
                    <div class="amc-text">
                        <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                                
                        <p class="tt tt-1 m-0 p-0 amc-fix-mt-25" name="pop-<?=$key+1 ?>">
                            <a class="tt-line-height-1-2" href="<?= DIR.$v->slug ?>"><?=$v->title;?></a>
                        </p>
                        <? if($v->model->sub_title != ''){ ?>
                        <p class="m-0 p-0 amc-fix-mt-12 tt-color-6b6b6b tt-fontsize-13-5"><?= $v->model->sub_title ?></p>
                        <? } ?>
                        
                        <p class="m-0 p-0 amc-fix-mt-20"><?//=\app\helpers\Text::limit_text($v->model->summary, 100); ?><?= $v->model->summary ?></p>
                        <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-25 m-0 p-0">
                                <?= (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0) ? $v->model->days.' jours ' : ''; ?> 
                                <?   
                                    if((isset($v->data->budget) && $v->data->budget != '')){
                                        if(isset($v->model->days) && $v->model->days != '' && $v->model->days > 0){
                                            echo 'à partir de '.$v->data->budget.'€'; 
                                        }else{
                                            echo 'À partir de '.$v->data->budget.'€'; 
                                        }
                                    }    

                                ?>
                            </p>
                        <? } ?>
                    </div>
                    
<!--                    <span class="posi"><?//= $location[$theEntry_info->data->location[0]]?></span>-->
                </div>
                <?php
                    }
                ?>

            </div>
        </div>
    </div>
</div>   
 
<?php } ?>
 <!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->  
<?php
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox-thumbs.css');
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox-thumbs.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$js=<<<JS
$(window).bind("load", function() { 


  $('.container-8 .item').each(function(index) {
        var max = 0;
        var height = $(this).children('span.amica-91-suggest').outerHeight();
        if(max < height){
            max = height;
        }
        
       $('.container-8 .item span.amica-91-suggest').css("min-height", max);

             
  });
});
        
        
  //  $(document).ready(function(){
        $('.slider').bxSlider({
            slideWidth: 175,
            minSlides: 1,
            maxSlides: 4,
            slideMargin: 40,
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
  //  });
        
        
        $('.fancybox-thumbs').fancybox({
               
               loop              : true,
          //  autoPlay          : 'flag',
            playSpeed         : 2000,
            nextSpeed         : 500,
            prevSpeed         : 500,
            openSpeed        : 500,
            speedOut         : 500,
            openEffect        : 'fade', 
            closeEffect       : 'fade',
            nextEffect        : 'fade',
            prevEffect        : 'fade',
  							padding: 0,
                closeBtn  : true,
                arrows    : false,
                nextClick : true,
                //parent: "#test",
       
                helpers : {
                   // title   : { type : 'outside' },
                    thumbs : {
                        width  : 100,
                        height : 100
                    },
                    buttons : {}, // add the buttons bar
//                     overlay: {
//                        locked: false
//                    }
                },
//                afterLoad: function () {
//                    if (this.group.length > 1) {
//                        this.title = '<div id="fancybox-buttons"><ul><li><a class="btnPrev" onClick="javascript:$.fancybox.prev();"></a></li><li><a class="btnPlay" onClick="javascript:$.fancybox.play();"></a></li><li><a class="btnNext" onClick="javascript:$.fancybox.next();"></a></li><li><a class="btnToggle" onClick="javascript:$.fancybox.toggle();"></a></li><li><a class="btnClose" onClick="javascript:$.fancybox.close();"></a></li></ul></div> Ри�?унок ' + (this.index + 1) + " из " + this.group.length + (this.title ? " - " + this.title : "")
//                    }
//                    if (this.group.length < 2) {
//                        $.extend(this, {
//                            loop: false
//                        });
//                        this.title = '<div id="fancybox-buttons"><ul><li><a class="btnPrev btnDisabled"></a></li><li><a class="btnPlay btnDisabled"></a></li><li><a class="btnNext btnDisabled"></a></li><li><a class="btnToggle" onClick="javascript:$.fancybox.toggle();"></a></li><li><a class="btnClose" onClick="javascript:$.fancybox.close();"></a></li></ul></div> Ри�?унок ' + (this.index + 1) + " из " + this.group.length + (this.title ? " - " + this.title : "")
//                    }
//                },
               
                  onPlayStart: function () {
                    $("#fancybox-buttons").find(".btnPlay").addClass("btnPlayOn")
                },
                onPlayEnd: function () {
                    $("#fancybox-buttons").find(".btnPlay").removeClass("btnPlayOn")
                },
                onUpdate: function () {
                    var e;
                    e = $("#fancybox-buttons").find(".btnToggle").removeClass("btnDisabled btnToggleOn");
                    if (this.canShrink) {
                        e.addClass("btnToggleOn")
                    } else if (!this.canExpand) {
                        e.addClass("btnDisabled")
                    };
                    var bottom = $(window).height() - ($('.fancybox-skin').outerHeight() + $('.fancybox-wrap').position().top);
                    var left = $('.fancybox-wrap').position().left;
                    var right = $(window).width() - ($('.fancybox-skin').outerWidth() + $('.fancybox-wrap').position().left);
                    $(".mythumbswrap").css({bottom: bottom, left: left, right: right});
        
        
                    
                },
                afterShow: function () {
                    var bottom = $(window).height() - ($('.fancybox-skin').outerHeight() + $('.fancybox-wrap').position().top);
                    var left = $('.fancybox-wrap').position().left;
                    var right = $(window).width() - ($('.fancybox-skin').outerWidth() + $('.fancybox-wrap').position().left);
                  
                    if ($(".mythumbswrap").length == 0) {
                        setTimeout(function () {
                            $("body").find("#fancybox-thumbs").css({
                                position: "relative"
                            }).wrap("<div class='mythumbswrap' />").parent().css({bottom: bottom, left: left, right: right});
                           
                        }, 100);
                    };
                  

                    
                },
               
                afterClose: function () {
                    $(".mythumbswrap").remove();
                },
            });
                    
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$this->registerCss('.back-button{margin-top: 35px;} .container-5{margin-bottom: 0;}');
?>
