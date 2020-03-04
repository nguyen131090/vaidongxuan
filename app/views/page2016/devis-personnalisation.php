<?php $this->registerCssFile('/assets/css/page2016/devis.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/all-form.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<a class="btn-contactez-nous d-none d-sm-none d-lg-block" href="/rdv-telephonique">RDV téléphonique</a>

<div class="contain container-1">
     <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_contact.jpg'>
    <?php }?>
   
    
    
<!--   <div class="amc-column row-2 pb-txt-40">
        
        <h1 class="title amc-fontsize-32 amc-latolatin-bold text-center text-uppercase"><?//= $this->context->pageT?></h1>
    </div>-->
    
</div>
<div class="contain container-2 amc-fix-title-text">
    <div class="amc-column row-2 pt-txt-40">
        
        <h1 class="title amc-fontsize-32 amc-latolatin-bold text-center amc-color-e75925 m-0"><?= $this->context->pageT?></h1>
    </div>
    <div class="amc-column pt-0 pt-txt-40 pb-txt-40">
        <div class="text text-top-form">
            <?= $theEntry->model->text ?>
               <!-- <p class="tt">DEMANDER UN DEVIS SUR MESURE</p>
                <p>Nos conseillères étudieront votre demande et vous répondra sous 48h !</p>
				-->

         
        </div>
        <?//php include_once '_form_devis.php';?>
    </div>
</div>
<div class="contain container-form">
<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\captcha\Captcha;

$form = ActiveForm::begin([
        'id'=>'devis-form',
        'action'=>'',
        'fieldConfig'=>[
                'options'=>[
                        'tag'=>'span',
                ],
                'template'=>'{input}{error}',
        ],
      'enableClientValidation'=>TRUE,
]);
?>
    
    <div class="area-2 pb-40">
        <table id="" class="form">
            <td colspan="2" class="info-error">
                    
                    <div class="float-left w-100">
                        <?=$form->errorSummary($model);?>
                    </div>    
                </td>
            
            <tr>
                <td colspan="2">
                    <h2 class="amc-tt-area amc-tt-area-2 amc-fontsize-22 amc-latolatin-bold mt-40 mb-0" style=""><?= Yii::$app->params['questions_form']['title_decrivez'][0] ?></h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['mealsIncluded'][0] ?><span class="amc-color-e75925"> *</span></p>
                    <div class="float-left w-100">
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
                                ]) . '<p class="amc-color-b1b1b1"> - '. $txt_1 .'</p></div>';
                        },]) ?>
                    </div>    
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-25 mb-10">
                            <?= Yii::$app->params['questions_form']['de_liberte'][0] ?>
                            <span class="amc-color-e75925"> *</span>
                        </p>
                        <?=$form->field($model, 'de_liberte')->radioList(Yii::$app->params['de_liberte']);?>
                    </div>  
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['message'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['message'][2] ?></span></p>
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['message'][1] ?></p>
                        <?=$form->field($model, 'message', [
                            'inputOptions'=>['class'=>'input_full amc-count-characters', 'maxlength'=>1000, 'rows'=>4,'style'=>'height: 140px;'],
                            ])->textArea()?>
<!--                         <p class="amc-color-b1b1b1 charNum" id="charNum">1000 caractères restants</p>
 -->                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">
                            <?= Yii::$app->params['questions_form']['des_devis'][0] ?>
                            <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['des_devis'][2] ?></span>
                        </p>
                        <?=$form->field($model, 'des_devis')->radioList(Yii::$app->params['des_devis']);?>
                    </div>  
                </td>
            </tr>
             <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40"><?= Yii::$app->params['questions_form']['se_baseront'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['se_baseront'][2] ?></span></p>
                       
                        <?=$form->field($model, 'se_baseront', [
                            'inputOptions'=>['class'=>'input_full', 'maxlength'=>1000, 'rows'=>4,'style'=>'height: 60px;'],
                            ])->textArea()?>
<!--                         <p class="amc-color-b1b1b1 charNum" id="charNum">1000 caractères restants</p>
 -->                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    
                    <div class="float-left">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['hotelTypes'][0] ?><span class="amc-color-e75925"> *</span></p>
                        
                        <?=$form->field($model, 'hotelTypes')->checkboxList(Yii::$app->params['formHotelTypeList'])?>
                    </div>    
                </td>
            </tr>
            
            
           
            
            
            <tr>
                <td colspan="2">
                    <div class="float-left col-12 p-0">
                        <p class="amc-text-question amc-latolatin-semibold mt-25 mb-5"><?= Yii::$app->params['questions_form']['budget'][0] ?><span class="amc-color-e75925"> *</span></p> 
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['budget'][1] ?></p>
                        <div class="p-0 col-12 d-flex">
                            <div class="col-lg-4 col-sm-5 p-0">
                            <?=$form->field($model, 'budget', ['inputOptions'=>['class'=>'text-placeholder-right input-width-210', 'type'=>'number', 'pattern'=>'[0-9]*', 'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57', 'placeholder'=>'€ par personne']]) ?>
                            </div>
                            <div class="col-6 p-0 pt-5 d-flex align-items-center">
                            <?=$form->field($model, 'budgetPlafond')->checkbox(
                                    ['label'=> Yii::$app->params['questions_form']['budgetPlafond'][0]]
                            ) ?>
                            </div> 
                        </div>    
                        <p class="amc-text-warning amc-fontsize-13 amc-color-e75925 amc-latolatin-medium mb-0 mt-10 amc-opt-budget" style="display: none;">
                             À titre de prévention, le budget que vous avez estimé, risque de ne pas correspondre au montant moyen d’un voyage sur-mesure. Votre conseiller en voyage vous le précisera sûrement.
                        </p>
                    </div>  
                </td>
            </tr>
        </table>    
    </div>
    <div class="amc-bg-color-f7f7f7 area-3 pb-0">
        <table id="" class="form">
            <tr>
                <td colspan="2">
                    <h2 class="amc-tt-area amc-tt-area-3 amc-fontsize-22 amc-latolatin-bold mt-40 mb-0" style=""><?= Yii::$app->params['questions_form']['title_pour_mieux'][0] ?> <span class="amc-color-b1b1b1">&nbsp;<?= Yii::$app->params['questions_form']['title_pour_mieux'][1] ?></span></h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <div class="d-flex justify-content-between align-items-end">
                            <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5">
                                <?= Yii::$app->params['questions_form']['howMessage'][0] ?>
                            </p>    
                            <span class="premierVoyage amc-latolatin-semibold" style="margin-right: -15px;">
                                <?=$form->field($model, 'premierVoyage')->checkbox(
                                   ['label'=>Yii::$app->params['questions_form']['premierVoyage'][0]]
                            ) ?>
                           </span>
                            
                        </div>
                        
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['howMessage'][1] ?></p>
                         <?=$form->field($model, 'howMessage', [
                            'inputOptions'=>['class'=>'input_full amc-count-characters', 'maxlength'=>1000, 'rows'=>3,'style'=>'height: 140px;'],
                            ])->textArea()?>
                        <!-- <p class="amc-color-b1b1b1 charNum amc-fix-disable yes" id="charNum">1000 caractères restants</p> -->
                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['howHobby'][0] ?></p>
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['howHobby'][1] ?></p>
                         <?=$form->field($model, 'howHobby', [
                            'inputOptions'=>['class'=>'input_full amc-count-characters', 'maxlength'=>1000, 'rows'=>1,'style'=>'height: 140px;'],
                            ])->textArea()?>
                        <!-- <p class="amc-color-b1b1b1 charNum amc-fix-disable yes" id="charNum">1000 caractères restants</p> -->
                    </div>  
                </td>
            </tr>
        </table>    
    </div>
    
    <div class="amc-bg-color-f7f7f7 area-5 pb-40">
        <table id="" class="form">
            
            
            
           
            
           
           
            <tr>
                <td colspan="2">
<!--                    <p class="mb-0" style="margin-top: 25px;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>-->
                    <div class="float-left w-100 text-center" style="">

                        <a id="btn-valider-big" class="btn-amica-basic btn-amica-basic-2 mt-txt-40 mb-0" href="javascript:void(0)">Envoyer votre demande de projet                                    
                        </a>
                    </div>
                </td>
            </tr>
            <?=$form->field($model, 'duraTime', ['inputOptions'=>['class'=>'dura-time hidden d-none']]);?>
        </table>    
    </div>
        <p class="mb-0 text-center text-champ" style="margin-top: 25px;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>
        <p class="text-private mt-txt-25">En validant ce formulaire, vous acceptez notre <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité et de collecte.</a></p>        
                
<?php ActiveForm::end();?>
   
</div>    
<?php

$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');


$this->registerJsFile('/assets/js/jquery.crs.min.js?v=001',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);


$this->registerCssFile('/assets/js/intl-tel-input/build/css/intlTelInput.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/intl-tel-input/build/js/intlTelInput.min.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);


$dir = DIR;
$dir_uri = DIR.URI;

$css=<<<CSS
    .btn-contactez-nous {
        right: 0;
        left: 100%;
        transform: rotate(90deg);
        background: #e75925 url(/assets/img/icon-phone.png) 14px center no-repeat;
        width: 230px;
        height: 50px;
        padding-left: 48px;
        /* display: flex; */
        padding-top: 5px;
    }
    .contain.container-1{
        height: 475px !important;
    }       
CSS;
$this->registerCss($css);

$js_rdv3 =<<<JS
        
$('#devisform-prefix label').click(function(){
    $('#devisform-prefix label').removeClass('active');
    $(this).addClass('active');    
});        
        
var currentdate = new Date();        
$(window).on("load resize",function(e){
        var sw = $(window).width();
        
        var wimage = $('.fix-img-bottom-left').width();
        var wimageright = $('.fix-img-middle-right').width();
        var dd = (sw - 900)/2;
        if(wimage > dd){
            
            $('.fix-img-bottom-left').css({'left': '-'+(wimage - dd)+'px'});
        }
        if(wimageright > dd){
            
            $('.fix-img-middle-right').css({'right': '-'+(wimageright - dd)+'px'});
        }
        
});        
        
        
$(window).bind('load', function(){
    $('select[name="DevisForm[region]"] option[value=""]').text('Sélectionner');
	
	 $('.required').each(function(){
        var clas = $(this).attr('class');
        $(this).parent().parent().children('.fix-error-label').addClass(clas);
    }); 
        
    $("select").change(function () {
        if($(this).val() == "" || $(this).val() == "0") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("select").change();     
    
   
    var count_click = 0;    
        
    if(/^((?!chrome|android).)*safari/i.test(navigator.userAgent)){     
        
        $("select.amc-iput-focus").parent()
        .mouseup(function() {
                  $(this).removeClass('amc-effect-arrow');
                  $(this).children('.amc-iput-focus').focus();
        })
        .mousedown(function() {
         $(this).addClass('amc-effect-arrow');
          $(this).children('.amc-iput-focus').focus();
        });

    }else{
        $("select.amc-iput-focus").parent().click(function() {
            count_click += 1;
            if (count_click%2 == 0) {
                $(this).removeClass('amc-effect-arrow');
                $(this).children('.amc-iput-focus').focus();
            }else{
                $(this).addClass('amc-effect-arrow');
                $(this).children('.amc-iput-focus').focus();
            }

            //$(this).addClass('amc-effect-arrow');
            //$(this).children('.amc-iput-focus').focus();

        });
    }
        
     $("input.amc-iput-focus").parent().click(function() {
            

            $(this).addClass('amc-effect-arrow');
            $(this).children('.amc-iput-focus').focus();

        });   

    $('.amc-iput-focus').blur(function(){
        count_click = 0;
        $('.amc-effect-arrow').removeClass('amc-effect-arrow');
    });    
    
    $('.amc-iput-focus').each(function(){
        var w = $(this).outerWidth();
        
        $(this).css({'background-position' : (w-27) +'px center'});
    });
});  
        
$('select[name="DevisForm[tourLength]"]').change(function(){
    $('input[name="DevisForm[budget]"]').change();
});
$('input[name="DevisForm[countriesToVisit][]"]').change(function(){
    $('input[name="DevisForm[budget]"]').change();
});
$('input[name="DevisForm[budget]"]').on("change keyup keydown",function(){
    var budget = $(this).val();
    var length = $('select[name="DevisForm[tourLength]"]').val();
    var destination = $('input[name="DevisForm[countriesToVisit][]"]').is(':checked');
       
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
        $('input[name="DevisForm[countriesToVisit][]"]:checked').each(function(i){
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
        
$('input[name="DevisForm[howTicket]"]').click(function(){
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
   
$('input[name="DevisForm[vouspartez]"]').click(function(){
    var val = $(this).val();
        
    if (val == 'Seul(e)') {
            $('.amc-opt-1').show();
            $('.amc-opt-2').hide();
             $('.amc-opt-3').hide();
            $('.amc-opt-3-4').show();
            $('.text-opt-1').show();
            $('.text-opt-2').hide();
            
    } else if(val == 'En couple'){
        $('.amc-opt-1').hide();
        $('.amc-opt-2').hide();
        $('.amc-opt-3-4').show();
        $('.amc-opt-3').hide();
         $('.text-opt-1').hide();
            $('.text-opt-2').show();
    }else{
            $('.amc-opt-2').show();
             $('.amc-opt-3').show();
            $('.amc-opt-1').hide();
            $('.amc-opt-3-4').show();
        $('.text-opt-1').hide();
            $('.text-opt-2').show();
    }
});   
        
     
$("input[type=radio], input[type=checkbox], input[type=text], select").after('<span class="amc-arrow-fix"></span>');    
        
       
        
 $(function(){
	$('input[type="submit"]').hide();
	$('#btn-valider-big').removeClass('hidden').bind('click', function(){
            var submitTime = new Date();
            var duraTime = Math.abs(submitTime - currentdate);
            duraTime = Math.floor((duraTime/1000));
            duraTime = parseInt(duraTime/60) + ':'+ ((duraTime%60) < 10 ? '0'+(duraTime%60) : (duraTime%60));
            $('.dura-time').val(duraTime);
            $('form#devis-form').submit(); 
//            $('html, body').animate({
//                scrollTop: $('form table').offset().top - 250
//            }, 300);
            return false;
        });
        $(".datepicker").parent().click(function() {
            $(this).children('input').focus();
           
        });

        $("form#devis-form").on("beforeSubmit", function (event) {
            $('#btn-valider-big').prepend('<span class="spinner"></span>');
            $('#btn-valider-big').addClass('ok-valid');     
        });
        
        
        
        
        $('input[name="DevisForm[callback]"]').click(function(){
		var val = $(this).val();
		if (val == 'Oui') {
			$('.rdv').show();
                        $('.telephone').hide();
		} else {
			$('.rdv').hide();
                        $('.telephone').show();
		}
	});
        
        $('.times-to-call .time').click(function(){
            if($(this).hasClass('selected'))
                $(this).removeClass('selected');    
            else 
                $(this).addClass('selected');
            var time = '';
            $('.times-to-call .time.selected').each(function(){
                if(time){
                   time += ', '+$(this).text();
               }
               else{
                   time += $(this).text();
               }
           })
           $('#devisform-calltime').val(time);
           $('#devisform-calltime').change();

        })
        $('#prevWeek').click(function(){
                return false;
        });
        
        // JS EXTENSION BTN

        $('.entry a.btn-extension').click(function(){
            console.log('a');
           
            //$('.program a.active').removeClass('active');
            //$(this).addClass('active');
            
           // $(this).addClass('active').siblings().removeClass('active');

            $(this).toggleClass("active");
             if($(this).hasClass('active')){
                $(this).text('AJOUTÉ AU PROGRAMME');
                
            } else{
                $(this).text('AJOUTEZ AU PROGRAMME');
            }

            var name = $(this).attr("name");
            var radio =  $('#devisform-extension').find('input[name="DevisForm[extension][]"][value="'+ name +'"]');
            if(radio.is(':checked')){
                radio.prop('checked', false);
             }
             else{
                 radio.prop('checked', true);
                
             }
                
            
        });
        
       
        $('#devisform-extension input[name="DevisForm[extension][]"]').change(function(){
            $('.entry a.btn-extension').removeClass('active');
            var value = $(this).val().replace(' ','-').toLowerCase();
            $('#popup_content .'+value+' .entry a.btn-extension').toggleClass('active');
           
        }); 
        
        
});       
   

//    $('.input_xxlarge').bind("cut copy paste",function(e) {
//         e.preventDefault();
//         });
$('#devisform-departuredate').datepicker({
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
            $("#devisform-deretourdate").datepicker("option", "minDate", dateObject);
        }
    }
});
$('#devisform-deretourdate').datepicker({
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
            $("#devisform-departuredate").datepicker("option", "maxDate", dateObject);
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
               // console.log(countryCode.toLowerCase());
                   callback(countryCode.toLowerCase());
                 });
               },
              // hiddenInput: "full_number",
               initialCountry: "auto",
              // localizedCountries: { 'de': 'Deutschland' },
        //       nationalMode: false,
              // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
             // placeholderNumberType: "MOBILE",
              // preferredCountries: ['cn', 'jp'],
              separateDialCode: true,
             utilsScript: "/assets/js/intl-tel-input/build/js/utils.js?1562189064761"
        });   
        
        var input = target.context,
          errorMsg = document.querySelector("#error-msg"),
          validMsg = document.querySelector("#valid-msg");

        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        //var iti = window.intlTelInput(input, {
        //   
        //    separateDialCode: true,    
        //    initialCountry: "auto",    
        //    geoIpLookup: function(callback) {
        //      $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //        var countryCode = (resp && resp.country) ? resp.country : "";
        //    // console.log(countryCode.toLowerCase());
        //        callback(countryCode.toLowerCase());
        //      });
        //    },      
        //    utilsScript: "/assets/js/intl-tel-input/build/js/utils.js?1562189064761"
        //});

        var reset = function() {
          input.classList.remove("error");
          errorMsg.innerHTML = "";
          errorMsg.classList.add("hide");
          validMsg.classList.add("hide");
        };

        // on blur: validate
        input.addEventListener('blur', function() {
          reset();
          if (input.value.trim()) {
            if (iti.isValidNumber()) {
              validMsg.classList.remove("hide");
            } else {
              input.classList.add("error");
              var errorCode = iti.getValidationError();
              errorMsg.innerHTML = errorMap[errorCode];
              errorMsg.classList.remove("hide");
            }
          }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);        
           
        
        input.addEventListener('countrychange', function(e) {
            var dialcode = iti.getSelectedCountryData().dialCode;
            $('.input_dial_code_country').val(dialcode);
          });
      
});              
//  var iti = intlTelInput(input); 
//  iti.destroy();    
//  var countryData = iti.getSelectedCountryData();
//console.log(countryData);    

//$(window).bind('load',function(){
//    var dialcode = $('#country-listbox li[aria-selected="true"]').data('dial-code');
//        $('.input_dial_code_country').val(dialcode);
//      
//        
//});        
//$('#country-listbox li').click(function(){
//    var dia = $(this).data('dial-code');   
//         $('.input_dial_code_country').val(dia);
//});  
//        

$(".amc-count-characters").keyup(function(){
    var maxLength = $(this).attr('maxlength');   
    
    el = $(this);
        
    var hClass = el.parent().parent().children('.charNum').hasClass('amc-fix-disable');    
    if(el.val().length === 0){
        
        if(hClass){
            el.parent().parent().children('.charNum').addClass('yes');
        }
    }else if(el.val().length > maxLength){
        el.val( el.val().substr(0, maxLength) );
    } else {
        if(hClass){
            el.parent().parent().children('.charNum').removeClass('yes');
        }
        el.parent().parent().children('.charNum').text(maxLength - el.val().length + ' caractères restants');
    }
});   
                
JS;
$this->registerJs($js_rdv3,  yii\web\View::POS_END);
?>
