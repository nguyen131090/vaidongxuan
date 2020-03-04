<div class="contain container-2 non-area-form container-fluid row-content-1 px-0">
    <div class="amc-column d-flex row pb-40 px-0 mx-auto column container">
	<h1 class="d-inline-block w-100 tt-fontsize-28 tt-latolatin-bold tt-color-e65925 mb-40"><?=$theEntry->title; ?></h1>
	<div class="body"><?=$theEntry->text ?></div>
	</div>
</div>

<?
$this->registerCss('.amc-column{ max-width: 940px;}');
 ?>