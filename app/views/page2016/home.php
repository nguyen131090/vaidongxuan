<?php 
use yii\helpers\Markdown;
use app\helpers\Text;
$this->registerCssFile(DIR . 'assets/css/page2016/home.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/animate.css/animate.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/custom/custom.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>


<? 
$cnt = 0;
foreach ($programes as $value) {
    $cnt++;
    //var_dump($value->content);exit;

?>


<div class="contain container-2 <?= $cnt == 1 ? 'mt-40' : '' ?> mb-60">
    <div class="amc-column">
        <h2 class="tt tt-fontsize-24 tt-latolatin-bold m-0 mb-25"><?= $value->seo != null ? $value->seo->h1 : $value->title ?></h2>
        <p class="summary m-0 mb-25"><?= $value->content ?></p>
        
        <div class="list-item">
            
            <?
                $listItem = \app\modules\programmes\api\Catalog::items([
                    //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                      'where'=>['category_id' => $value->category_id],
                     // 'where' => ['like','title','%'.$search.'%', false],
                      //'filters' => $fil_countries,    
                      'pagination' => ['pageSize' => 6]

                    ]);
                    
            ?>
            
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
                    <a href="<?= $v->slug ?>">
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
            
          
            <div class="dtn-btn-link">
               <a href="<?= $value->slug ?>">Xem thêm</a>
            </div>
              
            
        </div>
        
    </div>
</div>
<? } ?>