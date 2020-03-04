<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.theme-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.icons-1.4.5.min.css'); ?>

<? $this->registerCssFile('/assets/css/mobile/form_tour.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerCssFile('/assets/css/mobile/bootstrap-datetimepicker.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<? $this->registerCssFile(DIR . 'assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? 
$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/jquery.mobile-1.4.4.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerJsFile(DIR . 'assets/js/mobile/form_tour.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
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
    <div class="">
        <?= $theEntry->model->text ?>
    </div>
</div>
<div class="area-steps-bar">
    <ul id="progressbar">
       
        <li class="step-1 active">Décrivez<br>votre projet</li>
        <li class="step-2">Pour mieux vous connaitre<br>(facultatif)</li>
    </ul>
</div>
<div class="form-tour area-form content-tour-single active">
   
    
        <?//= $theEntry->model->text ?>
        <?
        $form = ActiveForm::begin([
                    'id' => 'devisform',
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
            <ul class="show-info m-0 pt-50" style="color: #e26640; padding-left: 2rem;">
                
            </ul>
        </div>
        <div id="step-1" class="steps step-1 active">
            <div class="field-form">
                <table id="tbl-form-tour" class="tbl-form">
<!--                    <tr>
                        <td class="" colspan="2">
                            <?//=$form->errorSummary($model);?>
                        </td>
                    </tr>-->
                    
                    <tr>
                        <td class="" colspan="2">
                            <p style="" class="amc-text-label amc-tt-latolatin-semibold mt-50 mb-0 pt-0"><?= Yii::$app->params['questions_form']['mealsIncluded'][0] ?><span class="amc-color-e75925"> *</span></p>
                           
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="amc-fix-arrow check-step-1">
                            <?=$form->field($model, 'mealsIncluded')->radioList(Yii::$app->params['formIncludedMealList'], ['item' =>
                                 function ($index, $label, $name, $checked, $value) {
                                     $txt = explode('-', $label);
                                     if(isset($txt[0])){
                                         $txt_0 = $txt[0];
                                     }else{
                                        $txt_0 = ''; 
                                     }
                                     if(isset($txt[1])){
                                         $txt_1 = $txt[1];
                                     }else{
                                         $txt_1 = '';
                                     }
                                     return '<div class="fix-area-radio">'. Html::radio($name, $checked, [
                                         'value' => $value,

                                         'label' => $txt_0,
                                         //'id' => $label,
                                     ]) . '<p class="m-0 amc-color-949494 amc-tt-fontsize-28 mb-10">'. $txt_1 .'</p></div>';
                             },]) ?>
                       
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="" colspan="2">
                            <p style="padding-top: 2rem;" class="amc-text-label amc-tt-latolatin-semibold m-0 pt-25"><?= Yii::$app->params['questions_form']['de_liberte'][0] ?><span class="amc-color-e75925"> *</span></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" class="check-step-1">
                           <?=$form->field($model, 'de_liberte')->radioList(Yii::$app->params['de_liberte']);?>
                        </td>
                    </tr>
                   
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50"><?= Yii::$app->params['questions_form']['message'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['message'][2] ?></span></p>
                            <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10"><?= Yii::$app->params['questions_form']['message'][1] ?></p>
                        </td>
                    </tr>
                    
                     <tr>
                        <td colspan="2" class="">
                            <div class="check-step-1">
                                <?= $form->field($model, 'message', [
                                    'inputOptions' => ['class' => 'input_full mb-20', 'maxlength'=>1000, 'rows' => 6],
                                ])->textarea()
                                ?>
                            </div>
<!--                            <div class="text-count-down">
                                 <p class="amc-color-949494 amc-tt-fontsize-28 mt-0 mb-0 charNum" id="charNum">1000 caractères restants</p> 
                            </div>-->
                        </td>
                    </tr>
                   
                  
                    <tr>
                        <td class="" colspan="2">
                            <p style="padding-top: 2rem;" class="amc-text-label amc-tt-latolatin-semibold m-0 pt-25"><?= Yii::$app->params['questions_form']['des_devis'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['des_devis'][2] ?></span></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" class="check-step-1">
                           <?=$form->field($model, 'des_devis')->radioList(Yii::$app->params['des_devis']);?>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50"><?= Yii::$app->params['questions_form']['se_baseront'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['se_baseront'][2] ?></span></p>
                            
                        </td>
                    </tr>
                    
                     <tr>
                        <td colspan="2" class="">
                            <div class="check-step-1">
                                <?= $form->field($model, 'se_baseront', [
                                    'inputOptions' => ['class' => 'input_full mb-20', 'maxlength'=>1000, 'rows' => 3],
                                ])->textArea()
                                ?>
                            </div>
                            <div class="text-count-down">
                                <!-- <p class="amc-color-949494 amc-tt-fontsize-28 mt-0 mb-0 charNum" id="charNum">1000 caractères restants</p> -->
                            </div>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 pt-50"><?= Yii::$app->params['questions_form']['hotelTypes'][0] ?><span class="amc-color-e75925"> *</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="check-step-1">
                            <?= $form->field($model, 'hotelTypes')->checkboxList(Yii::$app->params['formHotelTypeList']) ?>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 pt-50"><?= Yii::$app->params['questions_form']['budget'][0] ?><span class="amc-color-e75925"> *</span></p>
                            <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10"><?= Yii::$app->params['questions_form']['budget'][1] ?></p>
                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="check-step-1">
                           <?= $form->field($model, 'budget', ['inputOptions' => ['class' =>'text-placeholder-right', 'type'=>'number', 'pattern'=>'[0-9]*', 'placeholder'=>'€ par personne']]) ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">

                            <?=$form->field($model, 'budgetPlafond')->checkbox(
                                    ['label'=>Yii::$app->params['questions_form']['budgetPlafond'][0]]
                            ) ?>

                        </td>
                    </tr>    
                  
                     <tr>
                        <td class="" colspan="2">
                            <div id="check-step-1" class="next-steps next-steps-control mt-50 mb-50" style="margin-left: 0; margin-right: 0;" data-name="step-2">
                                Étape suivante
                            </div>
                        </td>

                    </tr>
                </table>
            </div>   
               
           
            
        </div>
    
    
        <div id="step-2" class="steps step-2">
            <div class="field-form">
                <table id="tbl-form-tour" class="tbl-form">
                    
                    
                  
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 pt-50"><?= Yii::$app->params['questions_form']['howMessage'][0] ?></p>
                            <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10"><?= Yii::$app->params['questions_form']['howMessage'][1] ?></p>
                        
                        </td>
                    </tr>
                    
                    
                    
                    <tr>
                        <td colspan="2" class="">
                            <div class="">
                                <?=$form->field($model, 'howMessage', [
                                 'inputOptions'=>['class'=>'input_full', 'maxlength'=>1000, 'rows'=>6,'style'=>'height: 96px;'],
                                 ])->textArea()?>
                            </div>
                            <div class="text-count-down">
                                <!-- <p class="amc-color-949494 amc-tt-fontsize-28 mt-0 mb-0 charNum amc-fix-disable yes" id="charNum">1000 caractères restants</p> -->
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                             <?=$form->field($model, 'premierVoyage')->checkbox(
                                   ['label'=>Yii::$app->params['questions_form']['premierVoyage'][0]]
                            ) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 pt-50"><?= Yii::$app->params['questions_form']['howHobby'][0] ?></p>
                            <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10"><?= Yii::$app->params['questions_form']['howHobby'][1] ?></p>
                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                            <div class="">
                                <?=$form->field($model, 'howHobby', [
                                 'inputOptions'=>['class'=>'input_full', 'maxlength'=>1000, 'rows'=>6,'style'=>'height: 96px;'],
                                 ])->textArea()?>
                            </div>
                            <div class="text-count-down">
                                <!-- <p class="amc-color-949494 amc-tt-fontsize-28 mt-0 mb-0 charNum amc-fix-disable yes" id="charNum">1000 caractères restants</p> -->
                            </div>
                        </td>
                    </tr>
                    
                    
                   
                    <tr>
                        <td class="" colspan="2">
                           
                            <div id="btn-valider-form" style="padding: 0 1.6rem !important; margin-left: 0; margin-right: 0;" class=" next-steps mt-25 mb-50">
                                Envoyer votre demande de projet
                            </div>
                            <div class="back-steps back-steps-control mt-50 mb-50" style="margin-left: 0; margin-right: 0;" data-name="step-1" data-bar="step-2">
                                Étape précédente
                            </div>
                           
                        </td>

                    </tr>
                </table>
            </div>   
           
        </div>
        
        
        <div class="" style="background: white;">
            <p class="m-0 amc-lineheight-fs32 pt-50 pb-25 amc-tt-fontsize-32" style="padding-left: 1.6rem;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>
            <p class="text-private mt-25 pb-50 mb-0" style="padding-left: 1.6rem;">En validant ce formulaire, vous acceptez notre <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité et de collecte.</a></p>        
       
        </div> 

        <?php
        ActiveForm::end();
        ?>
    
</div>
<?

$css=<<<CSS
    #progressbar li{
        width: 50%;
   }
    #progressbar li.step-1.active {
        background: url(/assets/img/mobile/icon-steps-2-active-45-58.png) no-repeat center 0;
        background-size: 2.25rem;
    }
    #progressbar li.step-2 {
        background: url(/assets/img/mobile/icon-steps-2-80-76.png) no-repeat center 0;
        background-size: 3.5rem;
    }
    #progressbar li.step-2.active {
        background: url(/assets/img/mobile/icon-steps-2-active-80-76.png) no-repeat center 0;
        background-size: 3.5rem;
    }
    #tbl-form-tour textarea{
        height: 20rem !important;
   }
    #tbl-form-tour #devispersionalformmobile-se_baseront{
            height: 5rem !important;
   }
        
   #devispersionalformmobile-mealsincluded{
        margin-bottom: 10px;
   }     
CSS;
$this->registerCss($css);
$js=<<<JS
    $('#devisformmobile-departuredate').datepicker({
    beforeShowDay: $(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null,
    changeYear: true,
    changeMonth: true,
    yearRange: '-0y-0m_:+5y',
    monthNamesShort: ['janvier', 'fèvrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
    dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
    closeText: 'fermer',
    minDate: '+1 d',
    currentText: 'aujourd\'hui',
    showOtherMonths: true,
    showButtonPanel: true,
    firstDay: 1,
    duration: 0,
    dateFormat: 'dd-mm-yy',
    onClose: function(selectedDate) {
        if (selectedDate != '') {
            selectedDate = selectedDate.split('-')[2] + '-' + selectedDate.split('-')[1] + '-' + selectedDate.split('-')[0];
            var dateObject = new Date(selectedDate);
            dateObject.setDate(dateObject.getDate() + 1);
            $("#devisformmobile-deretourdate").datepicker("option", "minDate", dateObject);
        }
    }
});
$('#devisformmobile-deretourdate').datepicker({
    beforeShowDay: $(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null,
    changeYear: true,
    changeMonth: true,
    yearRange: '-0y-0m_:+5y',
    monthNamesShort: ['janvier', 'fèvrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
    dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
    closeText: 'fermer',
    minDate: '+2 d',
    currentText: 'aujourd\'hui',
    showOtherMonths: true,
    showButtonPanel: true,
    firstDay: 1,
    duration: 0,
    dateFormat: 'dd-mm-yy',
    onClose: function(selectedDate) {
        if (selectedDate != '') {
            selectedDate = selectedDate.split('-')[2] + '-' + selectedDate.split('-')[1] + '-' + selectedDate.split('-')[0];
            var dateObject = new Date(selectedDate);
            dateObject.setDate(dateObject.getDate() - 1);
            $("#devisformmobile-departuredate").datepicker("option", "maxDate", dateObject);
        }
    }
});
        
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
        
$('.tru').click(function(){
    var input = $(this).parent('.parent-cong-tru').find('.target-cong-tru').val();
    if(parseInt(input) > 0){    
        $(this).parent('.parent-cong-tru').find('.target-cong-tru').val((parseInt(input) - 1)).change();
         
    }    
});        
  $('.cong').click(function(){
    var inputcong = $(this).parent('.parent-cong-tru').find('.target-cong-tru').val();
        
    $(this).parent('.parent-cong-tru').find('.target-cong-tru').val((parseInt(inputcong) + 1)).change();    
});   
   
$('select[name="DevisFormMobile[tourLength]"]').change(function(){
    $('input[name="DevisFormMobile[budget]"]').change();
});
$('input[name="DevisFormMobile[countriesToVisit][]"]').change(function(){
    $('input[name="DevisFormMobile[budget]"]').change();
});   
$('input[name="DevisFormMobile[budget]"]').on("change keyup keydown",function(){
    var budget = $(this).val();
    var length = $('select[name="DevisFormMobile[tourLength]"]').val();
    var destination = $('input[name="DevisFormMobile[countriesToVisit][]"]').is(':checked');
       
     var xx = 80;  
     var yy = 100;   
     var zz = parseInt(length);   
     var kk = parseInt(budget);
     var budget80 = zz * xx;
     var budget100 = zz * yy;   
    // console.log(kk);
    // console.log(zz);   
    // console.log(test);   
    if(destination == true && zz > 0){
        
        var val = [];
        var cnt = 0;
        $('input[name="DevisFormMobile[countriesToVisit][]"]:checked').each(function(i){
          val[$(this).val()] = $(this).val();
           cnt++;
        });  
        
        if((val['Vietnam'] == 'Vietnam' || val['Laos'] == 'Laos' || val['Cambodge'] == 'Cambodge') && cnt < 4){
            if(kk < budget80){
                $('.amc-opt-budget').show();
            
            }else{
               $('.amc-opt-budget').hide(); 
              
            }
        }
        if((val['Birmanie'] == 'Birmanie') && cnt < 4){
            if(kk < budget100){
                $('.amc-opt-budget').show();
            
            }else{
               $('.amc-opt-budget').hide(); 
              
            }
        }
        if((val['Birmanie'] == 'Birmanie') && cnt == 4){
            if(kk < budget100){
                $('.amc-opt-budget').show();
            
            }else{
               $('.amc-opt-budget').hide(); 
              
            }
        }
   }else{
       $('.amc-opt-budget').hide(); 
    }    
        
   
});             
        
JS;
$this->registerJs($js,  yii\web\View::POS_END);
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
   
    var iti =  window.intlTelInput(target.context, {
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
      //  console.log(dialcode);
        $('.input_dial_code_country').val(dialcode);
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
        
//$(".amc-count-characters").keyup(function(){
//    var maxLength = $(this).attr('maxlength');    
//    el = $(this);
//    if(el.val().length > maxLength){
//        el.val( el.val().substr(0, maxLength) );
//    } else {
//        $("#charNum").text(maxLength - el.val().length + ' caractères restants');
//    }
//    if(el.val().length >= 100){
//        $('.txt-err').hide();      
//    }else{
//        $('.txt-err').show();      
//    }
//});         
    
        
$(".amc-count-characters").keyup(function(){
    var maxLength = $(this).attr('maxlength');   
    
    el = $(this);
        
    var hClass = el.parent().parent().parent().children('.text-count-down').children('.charNum').hasClass('amc-fix-disable');    
    if(el.val().length === 0){
        
        if(hClass){
            el.parent().parent().parent().children('.text-count-down').children('.charNum').addClass('yes');
        }
    }else if(el.val().length > maxLength){
        el.val( el.val().substr(0, maxLength) );
    } else {
        if(hClass){
            el.parent().parent().parent().children('.text-count-down').children('.charNum').removeClass('yes');
        }
        el.parent().parent().parent().children('.text-count-down').children('.charNum').text(maxLength - el.val().length + ' caractères restants');
    }
});           
        

$('input[name="DevisFormMobile[howTicket]"]').click(function(){
    var val = $(this).val();
    if (val == 'Oui') {
            $('.ticket-plus').hide();
            $('.ticketDetail').show();
            
    } else if(val == 'Non') {
            $('.ticket-plus').hide();
            $('.help-ticket').show();
           // $('.howTicket').hide();
    }else{
         $('.ticket-plus').hide();
            $('.help-ticket').hide();
           // $('.howTicket').hide();
    }
});      
        
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
?>  
