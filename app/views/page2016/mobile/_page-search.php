<!-- Start of second page -->

<!--<div data-role="page" class="menu-page search-page" id="search-page" data-theme="b">-->
    <?
    //if(URI == SEG1.'/itineraire'){
   // if('filter_voyage' == $this->context->arr_option_filter_mobile['namefilter']){    
        echo '<div data-role="page" class="hide menu-page search-page" id="search-page-voyage" data-theme="b">';
        include '_inc_filter_voyage.php';
        echo '</div>';
    if(isset($this->context->arr_option_filter_exclusives_mobile['namefilter']) && $this->context->arr_option_filter_exclusives_mobile['namefilter'] != NULL){    
        if('filter_exclusivites' == $this->context->arr_option_filter_exclusives_mobile['namefilter']){
            echo '<div data-role="page" class="menu-page search-page" id="search-page" data-theme="b">';
            include '_inc_filter_exclusive.php';
            echo '</div>';
        }
    }
    if(URI == 'temoignages' || URI == 'temoignages/recherche'){
        include '_inc_filter_testi.php';
    }
//    if(URI == ''){
//        include '_inc_filter_voyage.php';
//    }
    
?>
    

<!--</div> -->
<?php $this->registerCssFile('/assets/css/mobile/filter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/filter.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
