<? $this->registerCssFile(DIR . 'assets/css/mobile/inc_guide_book.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); ?>
<?
$desCountry = \app\modules\destinations\api\Catalog::cat(SEG1);
$pdf = isset($desCountry->data->pdf) && $desCountry->data->pdf ? \yii\easyii\modules\file\api\File::get($desCountry->data->pdf) : '';  
$pdfFile = isset($pdf->model->file) ? $pdf->model->file : '';

if(Yii::$app->controller->action->id == 'nos-destinations-guide-type'){
    $category = 'guide_page';
}else{
    $category = Null;
}

?>
<div class="contain container-button-guide-book mb-0 mt-0">
    <div class="amc-column column full-width">
        <div class="area-guide-book">
            <div class="area-image-book">
                <div class="img-book" data-src="<?//= (isset($theEntry->photosArray['custom-mobile'])) ? $theEntry->photosArray['custom-mobile'][0]->image : ''?>">
                    <img alt="" data-src="<?= (isset($desCountry->photosArray['custom'])) ? $desCountry->photosArray['custom'][0]->image : '' ?>">
                </div>
            </div>    
            <div class="right-guide text-center">
                <?= isset($desCountry->data->guidepdf) ? $desCountry->data->guidepdf : '' ?>
                <form id="download-guide-form-new">
                    <input class="email radius-5" data-guide = "<?= isset($pdf->model->title) ? $pdf->model->title : '' ?>" data-name = "<?= isset($pdf->model->title) ? $pdf->model->title : '' ?>" type="text" value="" placeholder="Votre adresse mail" name="frmemail" id="frmemail" style="" data-analytics="on" data-analytics-category="<?= $category ?>" data-analytics-action="pdf_section" data-analytics-label="input_email">
                    <span class="error-email" aria-live="polite"></span>
                    <label class="tt-latolatin-regular mt-25" for="exampleCheck1">
                        <input type="checkbox" class="form-checkbox-input float-left d-none" id="exampleCheck1">
                        Souhaitez-vous recevoir des informations (reportages, promotions, conseils de voyages...) de la part de Amica Travel (2 fois par mois) ?
                    </label>
                    
                    <button type="submit" class="submit-email btn-amica-basic btn-amica-basic-2 mt-0 mb-0" data-analytics="on" data-analytics-category="<?= $category ?>" data-analytics-action="pdf_section" data-analytics-label="btn_download">Télécharger</button>
                </form>
            </div>
        </div>    
    </div>
</div>    
<?
$js=<<<JS
      var guideform = '#download-guide-form-new';     
      $(guideform + ' .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($(guideform + ' .email').val())){
          $(guideform + ' .email').css({'border' : '1px solid #e65925'});
          $(guideform + ' .error-email').show();
        $(guideform + ' .error-email').text('Le format de votre email n\'e​st pas valide.');


        }else{
            $(guideform + ' .email').css({'border' : 'none', 'background-color' : 'white'});
            $(guideform + ' .error-email').hide();

        }
});         
$(guideform + ' .submit-email').click(function(e){
    e.preventDefault();
    
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var name = $(guideform + ' .email').data('name');
        var guide = $(guideform + ' .email').data('guide');
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($(guideform + ' .email').val())){
          $(guideform + ' .email').css({'border' : '1px solid #e65925'});
          $(guideform + ' .error-email').show();
          $(guideform + ' .error-email').text('Le format de votre email n\'e​st pas valide.');   
          return false;
        }
        
        $.ajax({
            type: 'post',
            url: url,
            data: { name: name, guide: guide, email: $(guideform + ' .email').val(), checknews: $(guideform + ' .form-checkbox-input').is(":checked"), pdf: '$pdfFile' , type: 'guide'},
            beforeSend: function(){
                
            },
            success: function(data){
                $(guideform + ' .submit-email').text('Merci');
                $(guideform + ' .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'});
                $(guideform + ' .submit-email').addClass('submited');
            }
            });
        
    }else{
        return false;
    }
});                  
     
JS;
$this->registerJs($js);
?>