<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.theme-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.icons-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/form_contact.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

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
    <div class="">
        <?= $theEntry->model->text ?>
    </div>
</div>

<div class="form-tour area-form content-tour-single active">
   
    
        <?//= $theEntry->model->text ?>
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
        
        <div id="step-3" class="">
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
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['fullName'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['fullName'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?= $form->field($model, 'fullName') ?>
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
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Téléphone</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                            <div class="area_dial_code_country" style="display: none;">
                            <?=$form->field($model, 'dialcodeCountry', ['inputOptions'=>['class'=>'input_dial_code_country']]);?>
                            </div>  
                            <?=$form->field($model, 'telephone', ['inputOptions'=>['class'=>'dial-code-country', 'type'=>'tel', 'pattern'=>'[0-9]*', 'placeholder'=>'']]) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="" colspan="2">
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Sujet de votre message <span class="amc-color-e75925">*</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="amc-fix-arrow">
                            <?=$form->field($model, 'subjet', [
                                'inputOptions'=>['class'=>''],
                                ])->dropDownList(Yii::$app->params['subjetMobile'])
                            ?>
                        </td>
                    </tr>
                    <tr class="amc-sujet-pdv">
                        <td class="" colspan="2">
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25">Pays <span class="amc-color-e75925">*</span></p>
                        </td>
                    </tr>
                    <tr class="amc-sujet-pdv">
                        <td colspan="2" class="amc-fix-arrow">
                            <?php
                                $code_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';     
                            ?>
                            <?=$form->field($model, 'country', [
                            'inputOptions'=>['class'=>'fix-arrow input-country crs-country not-blank', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'contactformmobile-region'],
                            ])->dropDownList([
                                    'prompt'=>'- Sélectionez -',

                            ])?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25 amc-sujet-default">Votre message <span class="amc-color-e75925">*</span></p>
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25 amc-sujet-pdv">Décrivez votre projet <span class="amc-color-e75925">*</span></p>
                            <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10 amc-sujet-pdv">(Votre vision du voyage et de quelle façon vous souhaitez découvrir notre pays, les étapes, les activités souhaitées (faire du vélo, randonnée dans le Nord, croisière dans la baie d’Halong, rencontre les populations locales...), ce que vous aimez, ce que vous n’aimez pas...) </p>
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
            
           
           
        </div>
    <div class="">
        <p class="m-0 pt-50 pb-0" style=" padding-left: 1.6rem;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>
        <p class="text-private mt-txt-25 mb-50" style="padding-left: 1.6rem;">En validant ce formulaire, vous acceptez notre <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité et de collecte.</a></p>        
        
    </div>

        <?php
        ActiveForm::end();
        ?>
    
</div>




<? 
$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/jquery.mobile-1.4.4.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile(DIR . 'assets/js/mobile/form_tour.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
?>

<?
//$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile('/assets/js/mobile/jquery.mobile-1.4.5.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//
//$this->registerJsFile(DIR . 'assets/js/mobile/form_tour.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 

$js=<<<JS
var currentdate = new Date();     
$(window).bind('load', function(){
    $('select[name="ContactForm[region]"] option[value=""]').text('Sélectionner');
    
//    $('.required').each(function(){
//        var clas = $(this).attr('class');
//        $(this).parent().parent().children('.fix-error-label').addClass(clas);
//    });  
}); 
 
$(window).bind('load', function(){
    $("select").change(function () {
            if($(this).val() == "" || $(this).val() == "0") $(this).parent().addClass("empty");
            else $(this).parent().removeClass("empty");
        });
    $("select").change(); 
});      

$('#contactformmobile-subjet').change(function() {
            
    var val = $(this).val();

    if (val == 'pdv') {
            $('.amc-sujet-pdv').show();
            $('.amc-sujet-default').hide();
    } else {
            $('.amc-sujet-pdv').hide();
            $('.amc-sujet-default').show();
    }
}); 
        
$(function() {
        $("#contactform-verificationcode").parent().css("border", "none");
        $("#btn-valider-form").click(function() {
            var submitTime = new Date();
            var duraTime = Math.abs(submitTime - currentdate);
            duraTime = Math.floor((duraTime/1000));
            duraTime = parseInt(duraTime/60) + ':'+ ((duraTime%60) < 10 ? '0'+(duraTime%60) : (duraTime%60));
            $('.dura-time').val(duraTime);
            $("form#contact-form").submit();
            return false;
        });
        
        $("form#contact-form").on("beforeSubmit", function (event) {
            $("#btn-valider-form").prepend('<span class="spinner"></span>');
            $("#btn-valider-form").addClass('ok-valid');     
        });
        
    });        
        
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
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
   
  var iti = window.intlTelInput(target.context, {
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
     utilsScript: "/assets/js/intl-tel-input/build/js/utils.js?1562189064761"
    });   
        
        
     var input = target.context;
    input.addEventListener('countrychange', function(e) {
        var dialcode = iti.getSelectedCountryData().dialCode;
        $('.input_dial_code_country').val(dialcode);
      });        
        
});            
 // var iti = intlTelInput(input); 
//  iti.destroy();    
// var countryData = iti.getSelectedCountryData();
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
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
?>  




