<?php $this->registerCssFile('/assets/css/page2016/espace-presse.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain container-1">
    
     <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy img-responsive" data-src='<?=DIR?>upload/image/banner-espace-presse.jpg'>
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
        <div class="rows row-1 mt-txt-60 mb-txt-20">
                <?= $theEntry->content?>

        </div>
        <div class="rows row-2">
                <?php
                    $cnt = 0;
                    foreach ($theEntries as $v) {
                        $cnt++;
                       //echo '<pre>';
                       // var_dump($v->data->pdf);exit;
                
                ?>
                     <div class="item item-<?=$cnt?>">
                        <div class="col-left">
                             <?php
                                $fancy = Null;
                                $class_video = 'fancybox';
                                if(!empty($v->data->video)){
                                    $fancy = $v->data->video;
                                    $class_video = 'fancybox-video';
                                }
                                 if(!empty($v->data->pdf)){
                                    $fancy = $v->data->pdf;
                                }
                                if(!empty($v->photos)){
                                    foreach ($v->photos as $value) {
                                        
                                        if($value->model->type == 'summary'){
                                            echo '<a class="'.$class_video.'" href="'.$fancy.'">';
                                            echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.$value->image.'">';
                                            echo '</a>';
                                        }
                                    }
                                }else{

                            ?>
                            
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>upload/image/img_items_espace_presse.jpg">
                            <?php } ?>
                            
                        </div>
                        <div class="col-right">
                            <h2 class="title-item"><?= $v->model->title?></h2>
                            <div class="f-text">
                                <?php
                                    $subtitle = explode('-', $v->model->sub_title);
                                ?>
                                <p><?= $subtitle[0]?></p>
                                <p><?= $subtitle[1]?></p>
                            </div>    
                            <?php 
                                if(!empty($v->data->video)){
                            ?>
                            <a class="view-video <?= $class_video ?>" href="<?= !empty($v->data->video) ? $v->data->video : '' ?>">Visualiser</a>
                            <?php }else{?>
                            <a class="down-pdf fancybox" href="<?= !empty($v->data->pdf) ? $v->data->pdf : '' ?>">
								<?php
                                    if(!empty($v->data->pdf)){
                                        
                                        $file_data = new SplFileInfo($v->data->pdf);
                                  
                                        if($file_data->getExtension() == 'pdf'){
                                            echo 'Fichier PDF (2mb)';
                                        }
                                        if($file_data->getExtension() == 'jpg'){
                                            echo 'Télécharger';
                                        }
                                    }
                                ?>
							</a>
                            <?php }?>
                        </div>
                    </div> 
            
                <?php } ?>
            

                
        </div>
    </div>
</div>


<div class="contain container-3">

    
    <div class="amc-column">
        <div class="rows row-1">
            <span class="tt">Plus encore</span><a class="btn-amica-basic btn-amica-basic-1" target="_blank" rel="noopener"  href="https://blog.amica-travel.com">Découvrez notre blog 360 Indochine</a>
        </div>
     </div>
</div>   

<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>

  
<?php
//$this->registerCssFile('/assets/js/bxslider/jquery.bxslider.css');
//$this->registerJsFile('/assets/js/bxslider/jquery.bxslider.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');
$this->registerCssFile('/assets/js/fancybox/jquery.fancybox-thumbs.css');
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/fancybox/jquery.fancybox-thumbs.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$js=<<<JS
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
        
        //jQuery(document).ready(function () {
     $('a.fancybox').fancybox({
           titlePosition: 'over', 
            centerOnScroll: true,
            padding: 2,
           // type   :'iframe',
            openEffect: 'elastic',
            closeEffect: 'elastic',
            autoSize: true,
     });
//});      
        
    /*fancybox yt video*/
$(".fancybox-video").click(function() {
    $.fancybox({

    padding: 0,
        'autoScale'     : false,
        'transitionIn'  : 'none',
        'transitionOut' : 'none',
        'title'         : this.title,
        'width'         : 700,
        'height'        : 400,
        'href'          : this.href.replace(new RegExp("watch.*v=","i"), "v/"),
        'type'          : 'swf',
        'swf'           : {
        'wmode'             : 'transparent',
        'allowfullscreen'   : 'true'
         }

    });
    return false;
});    
        
        
        
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

?>
