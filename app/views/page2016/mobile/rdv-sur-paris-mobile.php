<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.theme-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.icons-1.4.5.min.css'); 

//$this->registerCssFile('/assets/css/mobile/bootstrap-datetimepicker.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile(DIR . 'assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile(DIR. 'assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
?>
<? $this->registerCssFile('/assets/css/mobile/form_contact.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?  

$js=<<<TXT
     var currentdate = new Date();
    $(function() {
        $("#contactform-verificationcode").parent().css("border", "none");
        $("#btn-valider-form").click(function() {
            var submitTime = new Date();
            var duraTime = Math.abs(submitTime - currentdate);
            duraTime = Math.floor((duraTime/1000));
            duraTime = parseInt(duraTime/60) + ":"+ ((duraTime%60) < 10 ? "0"+(duraTime%60) : (duraTime%60));
            $(".dura-time").val(duraTime);
            $("form#contact-form").submit();
            return false;
        });
        
        $("form#contact-form").on("beforeSubmit", function (event) {
            $("#btn-valider-form").prepend('<span class="spinner"></span>');
            $("#btn-valider-form").addClass('ok-valid');     
        });

    });   
TXT;
$this->registerJs($js,  yii\web\View::POS_END);

?>
<?
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>


<div class="form-tour text-top">
    <div class="column row-2">
        
        <h1 class="title"><?= $theEntry->title?></h1>
    </div>
    <div class="text-form-rdv">
        <?= $theEntry->model->text ?>
    </div>
    <div class="text-arnaud">
           
        <div class="rr rr-1">
            <p class="tt tt-latolatin-bold tt-fontsize-40 m-0">Laissez-lui vos coordonnées en remplissant ce formulaire !</p>
        </div>
        <div class="rr rr-2">
            <img class="sale-image" alt="" src="<?= DIR ?>assets/img/page2016/arnaud.jpg" style="border-radius: 100%;">
            <div class="text-r">
                <p class="">Arnaud vous contactera sous 24h pour fixer un RDV </p>
            </div>
        </div>
    </div>
</div>

<div class="form-tour area-form content-tour-single active">
       
        <?
$form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'action' => '',
                    'fieldConfig' => [
                        'options' => [
                            'tag' => 'span',
                        ],
                        'template' => '{input}{error}',
                    ],
        ]);
        ?>
        <div class="field-form">
            <?=$form->errorSummary($model);?>
        </div>
        <div class="field-form">
            <table id="tbl-form-tour" class="tbl-form">
            
           
            <tr>
                <td class="" colspan="2">
                    <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50">Civilité <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="amc-fix-arrow">
                    <?= $form->field($model, 'prefix',[
                'inputOptions'=>['class'=>'input_xxlarge'],
                ])->radioList(['Madame' => 'Madame', 'Monsieur' => 'Monsieur']) ?>
                </td>
            </tr>
            <tr>
                <td class="" colspan="2">
                     <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Prénom <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $form->field($model, 'fname') ?>
                </td>
            </tr>
            <tr>
                <td class="" colspan="2">
                     <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Nom <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $form->field($model, 'lname') ?>
                </td>
            </tr>
            <tr>
                <td class="" colspan="2">
                     <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Email <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $form->field($model, 'email', ['inputOptions' =>['class'=>'email', 'placeholder' => 'email@domain.com']]) ?>
                </td>
            </tr>
            
            
             <tr>
                <td class="" colspan="2">
                     <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Lieu de RDV souhaité sur Paris <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="amc-fix-arrow">
                    <?php
                            $code_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';
                            ?>
                            <?=
                            $form->field(
                                $model,
                                'period',
                                [
                                    'inputOptions' => ['style' => 'width: 280px', 'class' => 'amc-iput-focus not-blank', 'data-value' => 'shortcode', 'data-default-value' => $code_country, 'data-arrondissement-id' => 'contactform-arrondissement'],
                                ]
                            )
                                ->dropDownList($listData, ['prompt' => '- Sélectionez -']); ?>
                </td>
            </tr>
            <tr>
                <td class="" colspan="2">
                     <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Votre numéro de téléphone <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="">
                    <div class="area_dial_code_country" style="display: none;">
                    <?=$form->field($model, 'dialcodeCountry', ['inputOptions'=>['class'=>'input_dial_code_country']]);?>
                    </div>   
                    <?=$form->field($model, 'phone', ['inputOptions'=>['class'=>'dial-code-country','type'=>'tel', 'pattern'=>'[0-9]*','placeholder'=>'201-555-0123']]) ?>
                </td>
            </tr>
             <tr>
                <td class="" colspan="2">
                    <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Date pour le RDV <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="amc-fix-arrow">
                    <?= $form->field($model, 'callDate', ['inputOptions' => ['class' => 'input_small datepicker', 'placeholder' => 'Choisissez la date', 'data-clear-btn' => "false", 'readonly' => 'readonly', 'data-role' => 'date']]) ?> </div>

                </td>
            </tr>
            
            <tr>
                <td class="" colspan="2">
                    <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Votre message <span class="amc-color-e75925">*</span></p>
                </td>
            </tr>
           
            <tr>
                <td colspan="2" class="">
                    <?= $form->field($model, 'message', [
                        'inputOptions' => ['class' => 'input_full', 'rows' => 6],
                    ])->textArea()
                    ?>

                </td>
            </tr>
            
            <tr>
                <td class="" colspan="2">
                    <p style="padding-top: 1rem;" class="amc-text-label amc-tt-latolatin-semibold m-0 pt-25">Si vous êtes recommandé(e) par un ancien client d'Amica, merci de préciser son nom et prénom :</p>

                </td>
            </tr>
            <tr>
                <td colspan="2"><?=
                    $form->field($model, 'reference', [
                        'inputOptions' => ['class' => '', 'rows' => 1,'style'=>'min-height: 4.5rem;'],
                    ])->textArea()
                    ?></td>
            </tr>
            
            <tr>
                <td colspan="2">

                    <?=$form->field($model, 'newsletter')->checkbox(
                            ['label'=>'Oui, j\'aimerais recevoir par e-mail des infos (reportages, promotions, conseils de voyages...) de la part de Amica Travel. (2 fois par mois)']
                    ) ?>

                </td>
            </tr>   
            
            <?=$form->field($model, 'duraTime', ['inputOptions'=>['class'=>'dura-time hidden d-none']]);?>    
             <tr>
                <td class="" colspan="2">
                    <div id="btn-valider-form" class="next-steps mt-25 mb-50" style="margin-left: 0; margin-right: 0;">
                        Envoyer la demande
                    </div>
                </td>

            </tr>
        </table>
        </div>    
         <div class="">
            <p class="m-0 pt-50 pb-0" style=" padding-left: 1.6rem;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>
            <p class="text-private mt-txt-25 mb-50" style="padding-left: 1.6rem;">En validant ce formulaire, vous acceptez notre <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité et de collecte.</a></p>        

        </div>
        <?php ActiveForm::end(); ?>

    </div>


<? $this->registerCss('
#contactform-subjet-button > span{
    text-align: left;
    font-weight: normal;
}
') ?>

<?
$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/jquery.mobile-1.4.5.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);


$js=<<<JS
        $(window).bind('load', function(){
    $('select[name="ContactForm[region]"] option[value=""]').text('Sélectionner');
    
    $('.required').each(function(){
        var clas = $(this).attr('class');
        $(this).parent().parent().children('.fix-error-label').addClass(clas);
    });  
}); 
        
             
 
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
 ?>

<?
//$this->registerCssFile('/assets/js/mobile/selectize/selectize.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile('/assets/js/mobile/selectize/selectize.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$js=<<<JS
//$(window).bind('load', function(){
//    $('#select-country').selectize({
//        allowEmptyOption : false,
//        onChange: function(value) {
//           //     console.log(value);
//        $("#contactformmobile-country").val(value).change();
//                    },
//    });
//        
////    var tt = $('#test').val();
////       alert(tt);
////      $('#test').on('change',function(){
////            var dd = $(this).val();
////        alert(dd);
////        $('#contactformmobile-country').val(dd).prop("selected", true);
////        $("#contactformmobile-country").val(dd).change();
////        var aaa = $('#contactformmobile-country').children(":selected").attr("value");
////        alert(aaa);
////        });  
////        
////      var uu =  $('.selectize-input').val();
////        alert(uu);
////         $('#select-country-selectized').on('change',function(){
////              var ddd = $(this).val();
////        alert(ddd);
////        });
//        
//        
//});        
//$(document).on('load', '.fix-text', function(){
//    $(this).find('#select-country-button').hide();
//});       
// 
//JS;
//$this->registerJs($js,  \yii\web\View::POS_END);
 ?>

<?
$this->registerCssFile('/assets/css/page2016/intlTelInput.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/intlTelInput.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$js =<<<JS
           
//var input = document.querySelectorAll(".dial-code-country");
       // console.log(input);
 $('.dial-code-country').each(function(){ 
        
    var target = $(this);    
     //   console.log(target.context);
   
  window.intlTelInput(target.context, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["vn"],
      // formatOnDisplay: false,
       geoIpLookup: function(callback) {
         $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
           var countryCode = (resp && resp.country) ? resp.country : "";
           callback(countryCode.toLowerCase());
         });
       },
      // hiddenInput: "full_number",
       initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       separateDialCode: true,
     // utilsScript: "build/js/utils.js",
    });   
});              
//  var iti = intlTelInput(input); 
//  iti.destroy();    
//  var countryData = iti.getSelectedCountryData();
//console.log(countryData);    

//$(window).bind('load',function(){
//    var dialcode = $('.selected-flag').attr('title');
//        var nb = dialcode.split('+');
//        $('.input_dial_code_country').val(nb[1]);
//       // console.log(dialcode);
//});        
//$('#country-listbox li').click(function(){
//    var dia = $(this).data('dial-code');
//         $('.input_dial_code_country').val(dia);
//      //  console.log(dia);
//});     
    
//$(document).on("click", "#country-listbox li", function(event){
//     var dia = $(this).data('dial-code');
//         $('.input_dial_code_country').val(dia);
//       // console.log(dia);
//});
        
$('.datepicker').datepicker({
	//beforeShowDay: $(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null,
	// beforeShowDay: function(date){
    //	$(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null;
    //    var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
    //    return [ array.indexOf(string) == -1 ]
   // },
    beforeShowDay: $.datepicker.noWeekends,
	changeYear: true,
	changeMonth: true,
	yearRange: '-0y-0m_:+5y',
	monthNamesShort: ['janvier','fèvrier','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'],
	dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
	closeText: 'fermer',
	minDate: '+1 d',
	currentText: 'aujourd\'hui',
	showOtherMonths: true,
	showButtonPanel: true,
	firstDay: 1,
	duration: 0,
	dateFormat: 'dd-mm-yy',
       
	});                  
        
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
?>  



