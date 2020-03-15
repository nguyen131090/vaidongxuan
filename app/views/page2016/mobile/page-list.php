<? 
use yii\helpers\Markdown; 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('/assets/css/mobile/home.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
?>

<div class="contain m-0 mt-80">
    <div class="amc-column">
        <h1 class="tt tt-fontsize-24 tt-latolatin-bold m-0 mb-50 text-center"><?= $theEntry->model->seo != null ? $theEntry->model->seo->h1 : $theEntry->title ?></h1>
        <div class="summary m-0 mb-50 text-center">
            <?= $theEntry->model->content ?>
        </div>
        
        <div class="list-item mb-80">
            
            <?
                $j = 0;
                foreach ($listItem as $v) {
                   // var_dump($v->photosArray);exit;
                    $j++;
                
                    
            ?>
            
                <div class="item item-<?= $j ?> pb-10 mb-50">
                    <a href="<?= DIR.$v->slug ?>">
                        <div class="image">
                            <img alt="" data-src="<?= isset($v->photosArray['summary']) ? $v->photosArray['summary'][0]->image : '' ?>">
                            <?
                                if(isset($v->data->offer)){
                                    echo '<span class="offer"> -'.$v->data->offer.'</span>';
                                }
                            ?>
                            
                        </div>
                        <p class="tt-item m-0 amc-fix-mt-25-0 tt-fontsize-18 tt-latolatin-bold"><?= isset(explode('-', $v->title)[0]) ? trim(explode('-', $v->title)[0]) : '' ?></p>
                        <p class="tt-item m-0 amc-fix-mt-12 tt-fontsize-16 tt-latolatin-regular">Mã sp : <?= isset(explode('-', $v->title)[1]) ? trim(explode('-', $v->title)[1]) : '' ?></p>
                        
                        <?
                            if(isset($v->data->price)){
                        ?>       
                            <p class="gia-item m-0 amc-fix-mt-12">Giá: 
                                <span class="tt-fontsize-18"><?= $v->data->price ?> đ/m</span>
                            </p>
                        <?        
                            }
                        ?>
                        
                            <p class="mt-0 amc-fix-mt-12">SĐT : 1900 1000</p>
                    </a>

                </div>
            <?
               
                
            
                }
            ?>
            
            
            
           
            
            
        </div>
        
    </div>
</div>