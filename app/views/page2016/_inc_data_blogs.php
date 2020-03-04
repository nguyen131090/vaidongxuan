<?php $this->registerCssFile(DIR . 'assets/css/page2016/_inc_data_blogs.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?
$datacategory = '';
if(SEG2 == 'informations-pratiques'){
    $datacategory = 'infos_page';
}else if(SEG2 == 'guide'){
    $datacategory = 'guide_page';
}
if(Yii::$app->controller->action->id == 'nos-destinations-country'){
    $datacategory = 'country_page';
}
?>
<?
if(SEG1 == 'vietnam' || SEG1 == 'laos' || SEG1 == 'cambodge' || SEG1 == 'birmanie'){
    $desCountry = \app\modules\destinations\api\Catalog::cat(SEG1);

    $pdf = isset($desCountry->data->pdf) && $desCountry->data->pdf ? \yii\easyii\modules\file\api\File::get($desCountry->data->pdf) : '';  
    $pdfFile = $pdf->model->file;
}else{
    $pdfFile = '';
}

?>
<div class="contain container-8 container-blogs <?//= SEG1 ?> fix-space-vs-back-button mb-60 responsive-content-blog">
    
    <div class="column guide-blogs <?//=SEG1?> res">
        <?// if(SEG1 != 'birmanie'){?>
        <div class="guide mt-0 mb-0">
            <h2 class="title-guide mb-txt-40"><span>Guide <?= SEG1 == 'birmanie' ? 'de la' : 'du' ?>  <?= ucwords(SEG1)?></span></h2>
            <img width="100%" height="" alt="guide <?=SEG1?> amica travel" class="img-lazy img-responsive mb-txt-25" alt="" data-src="/assets/img/new-pays/<?=SEG1?>/guide-<?=SEG1?>-new.jpg">
            <div class="text">
                <p class="bigger">Quand partir </p>
                <p class="bigger">Comment </p>
                <p class="bigger">Combien...</p>
                <p class="mt-txt-20 mb-0">Vous trouverez toutes les réponses à vos questions pour préparer votre voyage <?= SEG1 == 'birmanie' ? 'en' : 'au' ?> <?=ucwords(SEG1)?></p>
                <form id="download-guide-form">
                    <input class="email mb-20 mb-25 radius-5" data-guide = "guide <?= SEG1 == 'birmanie' ? 'de la' : 'du' ?>  <?= ucwords(SEG1) ?>" data-name = "<?= isset($pdf->model->title) ? $pdf->model->title : '' ?>" type="text" value="" placeholder="Votre adresse mail" name="email" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="pdf_section" data-analytics-label="input_email">
                    <p class="error-email">
                        Le format de votre email n'est pas valide.
                    </p>
                    <span class="submit-email btn-amica-basic btn-amica-basic-2" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="pdf_section" data-analytics-label="btn_download">Télécharger</span>
                </form>
            </div>
        </div>
        <?// } ?>
        <div class="blogs mt-0 mb-0">
            <h2 class="title-blog <?= SEG1 == 'birmanie' ? 'mb-txt-40' : 'mb-txt-40' ?>">Les articles du moment de notre blog</h2>
            <div class="clearfix"></div>
            <?php
                $cnt = 0;
                if(!empty($arrBlog)){
                foreach ($arrBlog as $value) {
                    
                $cnt++;    
               
                   
            ?>
            <div class="item-img item item-<?=$cnt?> mb-25">
                <a href="<?= $value['link']?>" target="_blank" rel="noopener" >
                    <div class="img" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="blog_card_<?= $value['id'] ?>">
                        <img width="300" height="200" class="img-lazy img-responsive" alt="" data-src="<?= $value['src'] ?>">
                        <p><?= $value['cat_name'] ?></p>
                    </div>
                    <div class="text">
                        <p class="tt title-item <?//= SEG1 == 'birmanie' ? 'mt-25' : '' ?> mb-txt-25" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="blog_card_t_<?= $value['id'] ?>"><?= $value['title']['rendered']?></p>
                        <div data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="blog_card_text_<?= $value['id'] ?>"><?=\app\helpers\Text::limit_text($value['excerpt']['rendered'], 200)?></div>
                    </div>
                </a>
            </div> 
                <? }} ?>
            
            <a class="link-to-blog p-0 <?= SEG1 == 'birmanie' ? 'mt-txt-25' : '' ?>" href="https://blog.amica-travel.com/<?=SEG1 ?>/" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="link_blog_country"><?='Découvrez notre blog sur '. (SEG1 == 'birmanie' ? 'la ' : 'le '). ucfirst(SEG1)?></a>
        </div>
    </div>
</div>
<? 
$js= "
$('#download-guide-form .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          
        }else{
            $('#download-guide-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#download-guide-form .error-email').hide();
        } 
});         
$('#download-guide-form .submit-email').click(function(){
    var target = $('#download-guide-form .email');
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          return false;
        } 
        $('#download-guide-form .submit-email').text('Merci'); 
        $('#download-guide-form .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'}); 
        $('#download-guide-form .submit-email').addClass('submited'); 
        $.post(url, { 
            email: target.val(), 
            pdf: '$pdfFile', 
            name: target.data('name'),
            guide: target.data('guide'),
            type: 'guide'
            }, function(data){ 
                
            });
    }else{
        return false;
    }
});
";
$this->registerJs($js); ?>
