<?php 
use yii\helpers\Markdown;
$this->registerCssFile('/assets/css/page2016/gioi-thieu.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
    
   
    
    <div class="amc-column row-1">
        <?// include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"> dfdsf fd <?= $this->context->pageT; ?></h1>
    </div>
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        <div class="rows row-0">
            Sang đến ngày hôm nay (13/2), không khí lạnh bắt đầu suy yếu, các tỉnh miền Bắc bớt nồm ẩm, trời có mưa vài nơi vào đêm và sáng sớm, trưa chiều hửng nắng.

Tại các tỉnh Đông Bắc Bộ hôm nay trời nhiều mây, có mưa rào vài nơi, sáng sớm có sương mù và sương mù nhẹ. Nắng sẽ xuất hiện nhẹ vào trưa chiều nay, nhiệt độ cao nhất 25-27 độ C, có nơi cao hơn.

Các tỉnh Tây Bắc Bộ có mây, ngày nắng, đêm không mưa, nhiệt độ cao nhất 25-28 độ C, riêng khu tây bắc 28-30 độ C, thậm chí có nơi còn trên 30 độ C.

Riêng Thủ đô Hà Nội hôm nay nhiều mây, có mưa vài nơi, sáng sớm có sương mù và sương mù nhẹ, trưa chiều giảm mây, có lúc trời hửng nắng nhẹ, nhiệt độ thấp nhất 20-22 độ C, cao nhất 25-27 độ C. Từ ngày mai đến ngày 15/2, Hà Nội có mưa vài nơi vào đêm và sáng sớm, trưa chiều trời hửng nắng ấm.

Các tỉnh từ Thanh Hóa - Thừa Thiên Huế hôm nay nhiều mây, có mưa rào và dông vài nơi, trưa chiều giảm mây trời nắng, nhiệt độ cao nhất 26-29 độ C, có nơi trên 29 độ C.

Dự báo, hình thái thời tiết trên sẽ duy trì ở các tỉnh Bắc Bộ và Bắc Trung Bộ đến thứ Bảy (15/2). Chiều tối đến đêm 15/2, một đợt không khí lạnh mạnh tràn về sẽ gây mưa cho các tỉnh Bắc Bộ và Bắc Trung Bộ, nền nhiệt giảm mạnh khoảng 8-10 độ C, các tỉnh vùng núi có thể có rét đậm, rét hại.

Trong khi đó tại các tỉnh từ Đà Nẵng đến Bình Thuận, từ nay đến hết cuối tuần có mưa rào vài nơi vào đêm, ngày trời nắng với nhiệt độ cao nhất 29-32 độ C.

Các tỉnh Tây Nguyên và Nam Bộ trong tuần này phổ biến đêm không mưa, ngày nắng. Nhiệt độ cao nhất tại Tây Nguyên là 29-32 độ C, có nơi trên 32 độ C. Các tỉnh Nam Bộ nhiệt độ cao nhất phổ biến 32-35 độ C; riêng miền Đông Nam Bộ có nơi có nắng nóng trên 35 độ C.
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
