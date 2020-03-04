<?php 
use yii\helpers\Markdown;
use app\helpers\Text;
$this->registerCssFile(DIR . 'assets/css/page2016/home.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-2 m-0 mt-40">
    <div class="amc-column">
        <h1 class="tt tt-fontsize-24 tt-latolatin-bold m-0 mb-25"><?= $theEntry->model->seo != null ? $theEntry->model->seo->h1 : $theEntry->title ?></h1>
        <div class="summary m-0 mb-25">
            <?= $theEntry->model->content ?>
        </div>
        
        <div class="list-item mb-25">
            
            <?
                $j = 0;
                foreach ($listItem as $v) {
                   // var_dump($v->photosArray);exit;
                    $j++;
                if($j % 3 == 1){
                    echo '<div class="clear-fix">';
                }    
                    
            ?>
            
                <div class="item item-<?= $j ?> pb-10 mb-40">
                    <a href="#">
                        <div class="image">
                            <img alt="" data-src="<?= isset($v->photosArray['summary']) ? $v->photosArray['summary'][0]->image : '' ?>">
                            <?
                                if(isset($v->data->offer)){
                                    echo '<span class="offer"> -'.$v->data->offer.'</span>';
                                }
                            ?>
                            
                        </div>
                        <p class="tt-item m-0 mt-10 tt-fontsize-18 tt-latolatin-bold"><?= isset(explode('-', $v->title)[0]) ? trim(explode('-', $v->title)[0]) : '' ?></p>
                        <p class="tt-item m-0 tt-fontsize-16 tt-latolatin-regular">Mã sp : <?= isset(explode('-', $v->title)[1]) ? trim(explode('-', $v->title)[1]) : '' ?></p>
                        
                        <?
                            if(isset($v->data->price)){
                        ?>       
                            <p class="gia-item">Giá: 
                                <span class="tt-fontsize-18"><?= $v->data->price ?> đ/m</span>
                            </p>
                        <?        
                            }
                        ?>
                        
                        <p>SĐT : 1900 1000</p>
                    </a>

                </div>
            <?
                if($j % 3 == 0 || $j == count($listItem)){
                    echo '</div>';
                }
                
            
                }
            ?>
            
            
            
           
            
            
        </div>
        
    </div>
</div>

<?php
$css=<<<CSS
body .text-sologan{
    position: unset;
}        
.fix-scroll-menu{
    position: unset;  
}       
body{
    text-align: center;
}

CSS;
$this->registerCss($css);
?>