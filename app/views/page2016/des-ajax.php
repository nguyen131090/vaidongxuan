<? foreach ($locations->items(['pagination' => ['pageSize' => 4]]) as $key => $value) :?>
                                    <div class="item item-<?=$key+1?>">
                                    <div class="left">
                                       <a href="<?=DIR.$value->slug?>">
                                        <? 
                                        if($key == 4) break;
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
                                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                        <? endif; ?>
                                        </a>
                                    </div>
                                    <div class="right">
                                        <p class="tt"><?=$value->title?></p>
                                        <div class="text">
                                            <p>
                                                <?=$value->model->summary?>
                                            </p>
                                        </div>
                                        
                                        <span class="posi"><?
                                            $visiterEnvies = $value->data->envies;
                                         if(isset($visiterEnvies)){
                                            foreach ($visiterEnvies as $kve => $vve) {
                                                if(isset($enviesLib['envies-'.SEG1][$vve])) echo $enviesLib['envies-'.SEG1][$vve]; else continue;
                                                if($kve==count($visiterEnvies) - 1) break;
                                                echo ", ";
                                         } 
                                         }      
                                         ?></span>
                                    </div>
                                </div>
<? endforeach; ?>

                                <div class="pagination-des">
                                <?  $pagi = new \yii\data\Pagination(['totalCount' => count($locations->items()), 'defaultPageSize'=>4, 'params' => ['page' => Yii::$app->request->get('page')], 'route' => URI]);
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagi,
                        ]); ?>
                                </div>