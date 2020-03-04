<? foreach ($envies as $key => $value) : ?>
                <div class="item item-1">
                    <div class="left">
                        <a href="<?=DIR.$value->slug ?>">    
                     <? 
                        $hasSummary = false;
                        if(isset($value->photos)) {
                            foreach ($value->photos as $kp => $vp) {
                                if($vp->type == 'summary'){
                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" src="'.$vp->image.'" data-src="'.$vp->image.'"/>';
                                    $hasSummary = true;
                                    break;
                                }
                            } 
                        } ?>
                        <? if(!$hasSummary) : ?>
                           <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg">
                        <? endif; ?>
                        </a>
                    </div>
                    <div class="right">
                        <p class="tt"><a href="<?=DIR.$value->slug ?>">    <?=$value->title?></a></p>
                        <div class="text">
                           <p>
                                <?=$value->model->summary; ?>
                            </p>
                        </div>
                       <span class="posi"><?
                                         if(isset($value->data->envies)){
                                            $visiterEnvies = $value->data->envies;
                                            foreach ($visiterEnvies as $kve => $vve) {
                                                if(isset($dataEnvies['envies-'.SEG1][$vve])) echo '<a href="'.DIR.$dataEnvies['envies-'.SEG1][$vve]['slug'].'">'.$dataEnvies['envies-'.SEG1][$vve]['title'].'</a>'; else continue;
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
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagi,
                        ]);
                        ?>
                         <? if($pagi->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=DIR.URI?>?view=all">Voir tout</a>
                            <? endif; ?>          
                    </div>