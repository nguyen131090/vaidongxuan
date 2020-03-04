
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content content-page tt-fontsize-32 tt-latolatin-regular">
            <h1 class="main-title tt-latolatin-bold tt-fontsize-45 tt-color-e65925"><?= $this->context->pageT ? $this->context->pageT : $theEntry->title?></h1>
             <?=isset($theEntry->model->content) ? $theEntry->model->content :  $theEntry->description?>
        </div>
        <? if(count($theEntries) >= 1){?>
        <div class="row-content content-page">
                <span class="tt sub-title-page tt-fontsize-40 tt-latolatin-bold tt-color-e65925">Nos autres offers</span>
                <ul>
                    <?php
                        foreach ($theEntries as $v) {
                            if($v->slug == URI){
                                $color = '#e75925';
                            }else{
                                
                                $color = '';
                            }
                            echo '<li class="tt-fontsize-32 tt-latolatin-semibold"><a style="color: '.$color.'" href="'.DIR.$v->slug.'">'.$v->title.'</a></li>';
                        }
                    ?>
                </ul>
            </div>
        <? } ?>
    </div>
</div>
<!-- Start of second page -->
<?
$css = <<<CSS
.content-page{
    margin-bottom: 3.5rem;
    display: inline-block;
    position: relative;
}
.content-page h4{
    font-family: LatoLatin-Bold,sans-serif
}
.content-page ul {
    padding: 0;
    margin: 0;
}
.content-page ul li {
    list-style: none;
}
.content-page ul li a{
    color: inherit;
}
.content-page ul li::before {
    content: "• ";
    color: #e65925;
    display: inline-block;
    font-size: 2rem;
    margin-right: 1rem;
}
.sub-title-page{
    margin-top: 0;
}
CSS;
$this->registerCss($css);
?>