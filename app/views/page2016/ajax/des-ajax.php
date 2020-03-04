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
                                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" src="'.$vp->image.'"/>';
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
                                        <p class="tt"><a href="<?=DIR.$value->slug?>"><?= str_replace('|','',$value->title)?></a></p>
                                        <div class="text">
                                            <p>
                                                <?=$value->model->summary?>
                                            </p>
                                        </div>
                                        
                                        <span class="posi"><?
                                         if(isset($value->data->envies)){
                                            $visiterEnvies = $value->data->envies;
                                            foreach ($visiterEnvies as $kve => $vve) {
                                                if(isset($enviesLib['envies-'.SEG1][$vve])) echo '<a href="'.DIR.$enviesLib['envies-'.SEG1][$vve]['slug'].'">'.$enviesLib['envies-'.SEG1][$vve]['title'].'</a>'; else continue;
                                                if($kve==count($visiterEnvies) - 1) break;
                                                echo ", ";
                                         } 
                                         }      
                                         ?></span>
                                    </div>
                                </div>
<? endforeach; ?>

                                <div class="pagination-des">

                                <? 
                                 
                                $pagi = new \yii\data\Pagination(['totalCount' => count($locations->items(['pagination' => ['pageSize' => 0]])), 'defaultPageSize'=>4, 'params' => ['page' => Yii::$app->request->get('page')], 'route' => URI]);
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagi,
                            'maxButtonCount'=>5,
                            'firstPageLabel'=>'&lt;&lt;',
                            'lastPageLabel'=>'&gt;&gt;',
                            'prevPageLabel'=>'&lt;',
                            'nextPageLabel'=>'&gt;',
                        ]); ?>
                                </div>