<?php
                foreach ($theEntries as $k => $v) {
            ?>
             <div class="col col-<?= $k+1?>">
                 <a href="<?=DIR.$v->slug?>">
                     <?php
                        if(!empty($v->model->photos)){
                            foreach ($v->model->photos as $value) {
                                if($value->type == 'summary'){
                                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy img-responsive" src="'.$value->image.'" data-src="'.$value->image.'">';
                                }
                            }
                        }else{

                    ?>

                    <img alt="" class="img-lazy img-responsive" src="" data-src="<?=DIR?>upload/image/img-decouvrez-de-pays.jpg">
                    <?}?>
                    
                    <h4 class="tt"><?= $v->title?></h4>   
                  </a>  
                    <div class="summary">
                        <p>
                            <?= $v->model->summary?>
                        </p>
                    </div>
                </div>
            <?php }?>
             <div class="pagination pagination-centered pagination-deco"><?=\yii\widgets\LinkPager::widget([
        'pagination'=>$pages,
        'maxButtonCount'=>5,
        'firstPageLabel'=>'&lt;&lt;',
        'lastPageLabel'=>'&gt;&gt;',
        'prevPageLabel'=>'&lt;',
        'nextPageLabel'=>'&gt;',
        ]
            );
            ?></div>