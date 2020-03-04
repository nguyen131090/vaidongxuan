
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content content-page tt-fontsize-32 tt-latolatin-regular">
            <h1 class="main-title tt-latolatin-bold tt-fontsize-45 tt-color-000000"><?= $this->context->pageT ? $this->context->pageT : $theEntry->title?></h1>
             <?=isset($theEntry->model->content) ? $theEntry->model->content :  $theEntry->description?>
        </div>
    </div>
</div>
<!-- Start of second page -->
<?
$css = <<<CSS
.content-page{
    margin-bottom: 4rem;
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
    padding: 0.5rem 0;
}
.content-page ul li::before {
    content: "• ";
    color: #e65925;
    display: inline-block;
    font-size: 2rem;
    margin-right: 1rem;
}
.content-page h2, .content-page h4, .content-page h3 {
    font-size: 2rem;
    font-family: LatoLatin-Bold;
}
CSS;
$this->registerCss($css);
?>