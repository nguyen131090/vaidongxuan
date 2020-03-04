    <? foreach ($portraits as $k => $v) : ?>
        <div class="item item-<?=$k+1?>">
            <a href="<?=DIR.$v->slug?>">
                <? if(!empty($v->photos)){
                        foreach ($v->photos as $value) {
                            if($value->model->type == 'summary'){
                                echo '<img style="" alt="'.$value->description.'" class="img-lazy" src="'.$value->image.'" data-src="'.$value->image.'">';
                            }
                        }
                    }
                ?>
                <<?=SEG1 == 'portrait-voyageur' ? 'h2' : 'h3' ?> class="t">
                    <?= $v->title?>
                </<?=SEG1 == 'portrait-voyageur' ? 'h2' : 'h3' ?>>
            </a>
        </div>
   <? endforeach; ?>
    <div class="pagination pagination-centered pagination-port">
<?=\yii\widgets\LinkPager::widget([
    'pagination'=>$pagesPort,
    'maxButtonCount'=>5,
    'firstPageLabel'=>'&lt;&lt;',
    'lastPageLabel'=>'&gt;&gt;',
    'prevPageLabel'=>'&lt;',
    'nextPageLabel'=>'&gt;',
    ]
);
?>
    <? if($pagesPort->pageCount > 1 && SEG1 != 'confiance') : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=DIR.URI?>?view=all">Voir tout</a>
                            <? endif; ?>     
</div>
