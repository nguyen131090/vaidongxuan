<?php 
use yii\widgets\LinkPager;
use yii\data\Pagination;
$this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_END]); 

$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'yii\easyii\assets\AdminAsset', 'position' => $this::POS_HEAD]); 
$this->registerCssFile(DIR.'assets/css/page2016/nos-destinations.css?v=4',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]) ?>
<?php $this->registerCssFile(DIR.'assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR.'assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>


<div class="contain container-1">
     <? if(isset($theEntry->model->photos[0])) : ?>
    <img style="width: 100%;" alt="<?=$theEntry->model->photos[0]->description; ?>" class="img-lazy" data-src='<?=$theEntry->model->photos[0]->image; ?>'>
    <? endif; ?>
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
     <div class="column row-2">
        
        <h1 class="title"><?=$theEntry->title ?></h1>
        
    </div>
     
    
</div>
<div class="contain container-2">
    <div class="column">
        <div class="rows row-1">
        <? if($countries) : ?>
            <? foreach ($countries as $key => $value) : ?>
                
            <div class="item country-item item-<?=$key+1?>">
                <div class="left">
                    <? 
                        $hasSummary = false;
                        if(isset($value->photos)) {
                            foreach ($value->photos as $kp => $vp) {
                                if($vp->type == 'summary'){
                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'"/>';
                                    $hasSummary = true;
                                    break;
                                }
                            } 
                        } ?>
                        <? if(!$hasSummary) : ?>
                            <img alt="Amica Travel" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/vietnam.png">
                        <? endif; ?>
                </div>
                <div class="right">
                    <h2 class="tt"><?=$value->title?></h2>
                    <p class="summary">
                        <?=$value->summary?>
                    </p>
                    <a href="<?=DIR.$value->slug ?>">en savoir plus</a>
                </div>
            </div>
            <? endforeach; ?>
        <? endif; ?>
        
        </div>
        
        <div class="rows row-2">
             <?
                            $voyage = \app\modules\destinations\api\Catalog::get('vietnam/idees-de-voyage');
                            if(isset($voyage)) {
                                $modDes = $voyage->data->moduledes[0];
                                    $modDes = \app\modules\modulepage\api\Catalog::get($modDes);
                                 ?>    
                    
                            <h3 class="tt"><?=$modDes->model->sub_title ?></h3>
                            <? foreach ($modDes->data->destinations as $key => $value) : ?>
                                <? $desItem =  \app\modules\destinations\api\Catalog::get($value);?>
                                <div class="item item-<?=$key+1 ?>">
                                <a href="<?=$desItem->slug?>">
                                <img alt="<?=$modDes->photos[$key]->description ?>" class="img-lazy" src="<?=$modDes->photos[$key]->image ?>" style="display: inline;">
                                </a>
                                <div class="text">
                                    <h4><a href="<?=$desItem->slug?>"><?=$desItem->title ?></a></h4>
                                    <p>
                                       <?=$modDes->photos[$key]->model->caption ?>
                                    </p>
                                </div>
                                </div>
                            <? endforeach; ?>
                            <?  } ?>
        </div>
        
        <div class="rows row-3">
            <hr class="hr" />
            <form>
                <label for="">Une destination ?</label>
                    <? $allRoot =  \app\modules\destinations\models\Category::find()->where(['slug' => ['vietnam/visiter', 'laos/visiter', 'cambodge/visiter', 'birmanie/visiter']])->with('items')->asArray()->all(); 
                    $optDes = [];
                    foreach ($allRoot as $key => $value) {
                        $optDes[$value['title']] = \yii\helpers\ArrayHelper::map($value['items'], 'slug', 'title');
                    }
                    ?>
                    <?= \yii\helpers\Html::dropDownList('search_destination', null, $optDes,[
                        'class' => 'chosen',
                        'multiple' => 'multiple', 
                        'data-placeholder' => 'Tapez un nom',
                        'id' => 'search_destination'
                    ]) ?>
            </form>
        </div>
        
        <div class="rows row-4">
            <div class="col col-left">
                <p class="fix-tt"> Nos secrets d’ailleurs :</p>
                <div id="exclusives-load">
                <? foreach ($exclusives as $key => $value) : ?>
                <div class="item item-<?=$key+1?>">
                    <div class="left">
                        <a href="<?=DIR.$value->slug?>">
                        <? 
                        $hasSummary = false;
                        if(isset($value->photos)) {
                            foreach ($value->photos as $kp => $vp) {
                                if($vp->type == 'summary'){
                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'"/>';
                                    $hasSummary = true;
                                    break;
                                }
                            } 
                        } ?>
                        <? if(!$hasSummary) : ?>
                            <img alt="Amica Travel" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                        <? endif; ?>
                        </a>
                    </div>
                    <div class="right">
                        <p class="tt"> <a href="<?=DIR.$value->slug?>"><?= str_replace('|','',$value->title)?></a></p>
                        <div class="text">
                            <p>
                                <?=$value->model->summary?>
                            </p>
                        </div>
                        <span class="posi">
                        <? if(isset($value->data->locations[0])) {
                            if(\app\modules\libraries\api\Catalog::get($value->data->locations[0]))
                                echo \app\modules\libraries\api\Catalog::get($value->data->locations[0])->title;
                         }   ?>
                        , <?=isset($value->data->countries[0]) ? ucfirst($value->data->countries[0]) : ''?>
                        </span>
                    </div>
                     
                </div>
                <? endforeach; ?>
                    <div class="pagination-excl">
                        <? 
                        echo LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount'=>5,
                            'firstPageLabel'=>'&lt;&lt;',
                            'lastPageLabel'=>'&gt;&gt;',
                            'prevPageLabel'=>'&lt;',
                            'nextPageLabel'=>'&gt;',
                        ]);
                        ?>
                        <? if($pages->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=DIR.URI?>?view=all">Voir tout</a>
                            <? endif; ?>       
                    </div>
                </div>
            </div>
            <div class="col col-right">
                <div class="area-1">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img alt="Amica Travel" class="img-lazy" src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline;"></li>
                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                    </ul>
                    <a href="/devis" class="btn-contact">demander un devis</a>
                </div>    
            </div>
        </div>
        
    </div>
</div>


<?
$js=<<<JS
$('.chosen').chosen();
$('#search_destination').on('change', function(evt, params) {
    window.location = params.selected;
    return false;
  });
  
    $(document).on("click",".pagination-excl .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-des .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        $.post(url, { type: 'excl' }, function(data){ 
            $('#exclusives-load').html(data);
            $('html, body').animate({scrollTop: $('#exclusives-load').offset().top - 200}, 200);
            return false;
        });
        return false;
     });
        
   $('.chosen-choices input').keyup(function(){
        if(!$(this).val()){
            $('.chosen-drop .chosen-results').hide();
            return false;
        }
        $('.chosen-drop .chosen-results').show();
    })        
        
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$css = <<<CSS
.chosen-drop .chosen-results{
    display: none;
}
CSS;
$this->registerCss($css);
?>
