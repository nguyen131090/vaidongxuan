<?php $this->registerCssFile('/assets/css/page2016/fondation-thongnong.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
    
    <img alt="" style="width: 100%;" class="img-lazy" data-alt="" data-src='<?=DIR?>upload/image/banner-thongnong.jpg'>
    <?php }?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
     <div class="column row-2">
        
        <h1 class="title"><?= $this->context->pageT; ?></h1>
        
    </div>
    
</div>
<div class="contain container-2">
    
    <div class="column">
        <div class="rows row-1 lazy-background">
            <?php if(SEG3 == 'thong-nong-vietnam'){ ?>
            <img class="logo-projets" alt=""  data-src="<?=DIR?>assets/img/page2016/logo_thongnong.png" />
            <?php } ?>
            <ul>
                
                <li><span>Location</span><?= $theEntry->data->adresse?></li>
                <li><span>début du projet</span><?= $theEntry->data->date?></li>
            </ul>
        </div>
        <div class="rows row-2 entry-body">
             <?//= $theEntry->content?>
             <?php 
                            $points = [];
                            if(isset($theEntry->description)){
                                $points = explode('<hr />', str_replace('src="', 'data-src="', $theEntry->description));
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

<div class="contain container-5 lazy-background">
    
    <div class="column">
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

<?php }else{ ?>
<?php } ?>
<?php
    if(isset($theEntries) && !empty($theEntries)){
?>
<div class="contain container-6">
    
    <div class="column">
        <div class="rows row-1">
            <h3 class="tt">Pour aller plus loin</h3>
        </div>
    </div>
</div>    


<div class="contain container-7 lazy-background">
    
    <div class="column">
        <div class="rows row-1">
                <?php
                    foreach ($theEntries as $v) {
                        echo '<a class="" href="'.DIR.$theEntry->slug.'/'.$v->slug.'">'.$v->title.'</a>';
                    }
                ?>
        </div>
     </div>
</div>

<?php } ?>
<?php
    if(isset($theList_tour) && $theList_tour != NULL){
?>
<div class="contain container-8 fix-space-vs-back-button">
    
    <div class="column">
        <div class="rows row-1">
            <div class="col col-1">
                <h3>rendre visite cette region</h3>
            </div>
            <div class="col col-2">
                <?php
                    
                    $cnt = 0;
                    foreach ($theList_tour as $v) {
                        $cnt++;
                ?>
                 <div class="item item-<?=$cnt?>">
                     <?php
                        if(!empty($v->photos)){
                            foreach ($v->photos as $value) {
                                if($value->type == 'summary'){
                                    echo '<img style="" alt="'.$value->description.'" class="img-lazy" data-src="'.DIR.'thumb/194/129/1/80'.$value->image.'">';
                                }
                            }
                        }else{

                    ?>

                   <img alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img_2_thongnong.jpg">
                    <?php }?>
                    
                    <h5>
                        <a href="<?=DIR.$v->slug?>"><?= $v->title ?></a>
                    </h5>
                    <span class="posi"><?= $location[$theEntry->data->location[0]]?></span>
                </div>
                <?php
                    }
                ?>

                
            </div>
        </div>
    </div>
</div>   
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->  
<?php } ?>
  
<?php
//$this->registerCssFile('/assets/js/bxslider/jquery.bxslider.css');
//$this->registerJsFile('/assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox-thumbs.css');
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox-thumbs.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);



$js=<<<JS
        
$(window).bind("load", function() { 


  $('.container-8 .item').each(function(index) {
        var max = 0;
        var height = $(this).children('h5').outerHeight();
        if(max < height){
            max = height;
        }
        
       $('.container-8 .item h5').css("min-height", max);

             
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
$this->registerCss(".back-button {
        margin-top: 45px;
    margin-bottom: 35px;
}");
?>
