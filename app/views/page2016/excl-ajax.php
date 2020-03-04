<? foreach ($exclusives as $key => $value) :?>
               <div class="item item-<?=$key+1?>">
                    <div class="left">
                        <? 
                        if($key == 4) break;
                        $hasSummary = false;
                        if(isset($value->photos)) {
                            foreach ($value->photos as $kp => $vp) {
                                if($vp->type == 'summary'){
                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'">';
                                    $hasSummary = true;
                                    break;
                                }
                            } 
                        } ?>
                        <? if(!$hasSummary) : ?>
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg">
                        <? endif; ?>
                        
                    </div>
                    <div class="right">
                        <p class="tt"><?=$value->title?></p>
                        <div class="text">
                            <p>
                                <?=$value->model->summary; ?>
                            </p>
                        </div>
                        <span class="posi"><?=isset($value->data->locations) ? \app\modules\libraries\api\Catalog::get($value->data->locations[0])->title : ''?>, <?=isset($value->data->countries[0]) ? ucfirst($value->data->countries[0]) : ''?></span>
                    </div>
                    
                </div>
<? endforeach; ?>

                    <div class="pagination-excl">
                        <? 
                        $pagi = new \yii\data\Pagination(['totalCount' => isset($totalCount) ?  $totalCount : Yii::$app->session->get('countVnExcl'), 'pageSize'=>4]);
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagi,
                        ]);
                        ?>    
                    </div>
                                