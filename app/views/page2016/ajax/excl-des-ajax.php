<? foreach ($exclusives as $key => $value) : ?>
                <div class="item item-<?=$key+1?>">
                    <div class="left">
                        <a href="<?=DIR.$value->slug ?>">
                        <? 
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
                            <img alt="" class="img-lazy img-responsive" src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                        <? endif; ?>
                        </a>
                    </div>
                    <div class="right">
                        <p class="tt"><a href="<?=DIR.$value->slug ?>"><?= str_replace('|','',$value->title)?></a></p>
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
                        $pages = new \yii\data\Pagination([
                            'totalCount' => count(\app\modules\exclusives\api\Catalog::items(['pagination' => ['pageSize' => 0]])),
                            'defaultPageSize' => 4,
                        ]);
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount'=>5,
                                'firstPageLabel'=>'&lt;&lt;',
                            'lastPageLabel'=>'&gt;&gt;',
                            'prevPageLabel'=>'&lt;',
                            'nextPageLabel'=>'&gt;',
                        ]);
                        ?>    
                       
                    </div>