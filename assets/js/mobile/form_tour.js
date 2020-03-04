var currentdate = new Date();  
$(window).bind('load', function(){
    $("select").change(function () {
            if($(this).val() == "" || $(this).val() == "0") $(this).parent().addClass("empty");
            else $(this).parent().removeClass("empty")
        });
    $("select").change(); 
});   
$('input[name="DevisFormMobile[vouspartez]"]').click(function(){
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

//$('input[name="DevisFormMobile[countriesToVisit][]"]').click(function(){
//    alert('ok');
//});

//$('.next-steps-control').click(function(){
//    var name = $(this).data('name');
//    $('.area-form .steps').removeClass('active');
//    $('#' + name).addClass('active');
//    $('#progressbar .' + name).addClass('active');
//    $('html, body').animate({
//        scrollTop: $("#progressbar").offset().top
//    }, 0);
//});
$('.back-steps-control').click(function(){
    var name = $(this).data('name');
    var nameBar = $(this).data('bar');
    $('.area-form .steps').removeClass('active');
    $('#' + name).addClass('active');
    $('#progressbar .' + nameBar).removeClass('active');
    $('html, body').animate({
        scrollTop: $("#progressbar").offset().top
    }, 0);
});

$('#check-step-1').click(function () {
    $('.show-info').text(' ');
    var flag = false;
    var count =  $(document).find('.check-step-1').length;
     $('.check-step-1').each(function(index, element){
         
         
         
         
         
         var target = $(this);
         
         var vouspartez = target.find("#devisformmobile-vouspartez");
         var adulte18 = target.find("#devisformmobile-numberoftravelers18");
         var detailage = target.find("#devisformmobile-agesoftravelers12");
         var destination = target.find("#devisformmobile-countriestovisit");
         var date = target.find("#devisformmobile-departuredate");
         var tourlength = target.find("#devisformmobile-tourlength");
         
        // cho form devis-personnalisation-mobile
        var mealsincluded = target.find('#devispersionalformmobile-mealsincluded');
        var de_liberte = target.find('#devispersionalformmobile-de_liberte');
        var message = target.find('#devispersionalformmobile-message');
        var des_devis = target.find('#devispersionalformmobile-des_devis');
        var se_baseront = target.find('#devispersionalformmobile-se_baseront');
        var hotelTypes = target.find("#devispersionalformmobile-hoteltypes");
        
        var budget = target.find("#devispersionalformmobile-budget");
          
         if(message.length == 1 || se_baseront.length == 1 || budget.length == 1){
             if(message.val() == ""){
              //  target.children().children().blur();
               
                // if(message.val().length < 100){
                    target.children().addClass('has-error');
                       // var text_err = target.find(".help-block").text();
                       // console.log(text_err);
                        $('.show-info').addClass('active');
                       // $('.show-info').append('<li>'+text_err+'</li>');
                        $('.show-info').append('<li>Merci de préciser votre projet de voyage.</li>');
                        target.find(".help-block").text('Merci de préciser votre projet de voyage.');
                // }
               
            }
            if(se_baseront.val() == ""){
              //  target.children().children().blur();
               
                // if(message.val().length < 100){
                    target.children().addClass('has-error');
                       // var text_err = target.find(".help-block").text();
                       // console.log(text_err);
                        $('.show-info').addClass('active');
                       // $('.show-info').append('<li>'+text_err+'</li>');
                        $('.show-info').append('<li>Les critères de décision ne peut pas être vide.</li>');
                        target.find(".help-block").text('Les critères de décision ne peut pas être vide.');
                // }
               
            }
           // console.log(budget.val());
            if(budget.val() == ""){
               
              //  target.children().children().blur();
               
                // if(message.val().length < 100){
                    target.children().addClass('has-error');
                       // var text_err = target.find(".help-block").text();
                       // console.log(text_err);
                        $('.show-info').addClass('active');
                       // $('.show-info').append('<li>'+text_err+'</li>');
                        $('.show-info').append('<li>Votre budget ne peut pas être vide.</li>');
                        target.find(".help-block").text('Votre budget ne peut pas être vide.');
                // }
               
            }
         }
         
         if(hotelTypes.length === 1){
                var kpradio = target.find('input').is(':checked');
                if(kpradio === false){
                   target.children().addClass('has-error');
                    
                     
                        $('.show-info').addClass('active');
                        $('.show-info').append('<li>Le type d’hébergement ne peut pas être vide.</li>');
                        target.find(".help-block").text('Le type d’hébergement ne peut pas être vide.');
                     
               }

            }
           
         // End cho form devis-personnalisation-mobile
         
         if(tourlength.length == 1){
             
             target.find("select").change(function () {
                    if($(this).val() == "" || $(this).val() == "0") {
                        target.children().addClass("has-error");
                        
                        
                        if(tourlength.length == 1){
                            $('.show-info').addClass('active');
                            $('.5').remove('.5');
                            $('.show-info').append('<li class="5">Durée requise</li>');
                            target.find(".help-block").text('Durée requise');
                        }
                        
                    }
                    else {
                        target.children().removeClass("has-error");
                    }
                });
            target.find("select").change(); 
            if(adulte18.length){
                 var kkk = $('input[name="DevisFormMobile[vouspartez]"]:checked').val();
                 
                if(kkk == 'Seul(e)' || kkk == 'En couple'){
                    $('.field-devisformmobile-numberoftravelers18').removeClass('has-error');
                    $('.1').remove('.1');
                }
            }
         }
         if(vouspartez.length == 1 || destination.length == 1 || mealsincluded.length == 1 || de_liberte.length == 1 || des_devis.length == 1){
             var kpradio = target.find('input').is(':checked');
             if(kpradio == false){
                target.children().addClass('has-error');
                 if(vouspartez.length == 1){
                        $('.show-info').addClass('active');
                        $('.show-info').append('<li>Ce champs ne peut pas être vide.</li>');
                        target.find(".help-block").text('Ce champs ne peut pas être vide.');
                    }
                    if(destination.length == 1){
                        $('.show-info').addClass('active');
                        $('.show-info').append('<li>Destination(s) requise(s)</li>');
                        target.find(".help-block").text('Destination(s) requise(s)');
                    }
                 if(mealsincluded.length == 1){
                        $('.show-info').addClass('active');
                        $('.show-info').append('<li>Le rythme ne peut pas être vide.</li>');
                        target.find(".help-block").text('Le rythme ne peut pas être vide.');
                    }
                if(de_liberte.length == 1){
                        $('.show-info').addClass('active');
                        $('.show-info').append('<li>Le degré de liberté ne peut pas être vide.</li>');
                        target.find(".help-block").text('Le degré de liberté ne peut pas être vide.');
                    }    
                if(des_devis.length == 1){
                        $('.show-info').addClass('active');
                        $('.show-info').append('<li>La question sur les autres agences ne peut pas être vide.</li>');
                        target.find(".help-block").text('La question sur les autres agences ne peut pas être vide.');
                    }        
            }
            
         }
         if(detailage.length == 1 || date.length == 1 || adulte18.length == 1){
             var val = target.find('input[type=text]').val();
             if(val == '' || val == '0'){
                target.children('.required').addClass('has-error');
                if(detailage.length == 1){
                    $('.show-info').addClass('active');
                    $('.show-info').append('<li>Âge des participants requis</li>');
                    target.find(".help-block").text('Âge des participants requis');
                }
                if(date.length == 1){
                    $('.show-info').addClass('active');
                    $('.show-info').append('<li>Date d\'arrivée requise</li>');
                    target.find(".help-block").text('Date d\'arrivée requise');
                }
                if(adulte18.length == 1){
                     var kkk = $('input[name="DevisFormMobile[vouspartez]"]:checked').val();
                     $('.show-info').addClass('active');
                    
                    $('.show-info').append('<li class="1">Nombre des participants requis</li>');
                    target.find(".help-block").text('Nombre des participants requis');
                    if(kkk == 'Seul(e)' || kkk == 'En couple'){
                        $('.field-devisformmobile-numberoftravelers18').removeClass('has-error');
                        $('.1').remove('.1');
                    }
                    
                }
            }
         }
         if(index + 1 == count){
             flag = true;
         }
    
        });
        
       
        
        if(flag == true){
            
           var dddf =  $(document).find('.check-step-1 .has-error').length;
           
           if(dddf == 0){
               var name = $(this).data('name');
                $('.area-form .steps').removeClass('active');
                $('#' + name).addClass('active');
                $('#progressbar .' + name).addClass('active');
                $('html, body').animate({
                    scrollTop: $("#progressbar").offset().top
                }, 0);
                $('.text-fix').remove();
                $('.show-info').text(' ');
                $('.show-info').removeClass('active');
           }else{
               $('.text-fix').remove();
               $('.show-info').before('<p class="text-fix m-0 pt-50" style="color: #e26640;">Veuillez vérifier les erreurs suivantes :</p>');
               $('.show-info').removeClass('pt-50');
               $('.show-info').addClass('pt-25');
               $('html, body').animate({
                    scrollTop: $("#progressbar").offset().top
                }, 0);
           }
        }
});
$('#check-step-2').click(function () {
    $('.show-info').text(' ');
    var flag2 = false;
    var count =  $(document).find('.check-step-2').length;
    $('.check-step-2').each(function(index){
         
         
         var target = $(this);
         
       // target.children().children().blur();
        
            var message = target.find('#devisformmobile-message');
            var howmessage = target.find('#devisformmobile-howmessage');
            var howhobby = target.find('#devisformmobile-howhobby');
            //console.log(message.length);
            var tourthemes = target.find("#devisformmobile-tourthemes");
            if(!message.val()){
              //  target.children().children().blur();
               
                // if(message.val().length < 100){
                    target.children().addClass('has-error');
                       // var text_err = target.find(".help-block").text();
                       // console.log(text_err);
                        $('.show-info').addClass('active');
                       // $('.show-info').append('<li>'+text_err+'</li>');
                        $('.show-info').append('<li>Merci de préciser votre projet de voyage.</li>');
                        target.find(".help-block").text('Merci de préciser votre projet de voyage.');
                // }
               
            }
            if(howmessage.length == 1){
              //  target.children().children().blur();
               
                if(howmessage.val().length < 100 && howmessage.val().length > 0){
                    target.children().addClass('has-error');
                       // var text_err = target.find(".help-block").text();
                       // console.log(text_err);
                        $('.show-info').addClass('active');
                       // $('.show-info').append('<li>'+text_err+'</li>');
                        $('.show-info').append('<li>Merci d\'être plus précis en tapant au minimum 100 caractères</li>');
                        target.find(".help-block").text('Merci d\'être plus précis en tapant au minimum 100 caractères');
                }
               
            }
            if(howhobby.length == 1){
              //  target.children().children().blur();
               
                if(howhobby.val().length < 100 && howhobby.val().length > 0){
                    target.children().addClass('has-error');
                       // var text_err = target.find(".help-block").text();
                       // console.log(text_err);
                        $('.show-info').addClass('active');
                       // $('.show-info').append('<li>'+text_err+'</li>');
                        $('.show-info').append('<li>Merci d\'être plus précis en tapant au minimum 100 caractères</li>');
                        target.find(".help-block").text('Merci d\'être plus précis en tapant au minimum 100 caractères');
                }
               
            }
            
            
            if(tourthemes.length === 1){
                var kpradio = target.find('input').is(':checked');
                if(kpradio === false){
                   target.children().addClass('has-error');
                    
                     
                        $('.show-info').addClass('active');
                        $('.show-info').append('<li>Thématiques ne peut être vide.</li>');
                        target.find(".help-block").text('Thématiques ne peut être vide.');
                     
               }

            }
         
         if(index + 1 == count){
             flag2 = true;
         }
    
        });
        
       
        
        if(flag2 == true){
           var dddf =  $(document).find('.check-step-2 .has-error').length;
           if(dddf == 0){
               var name = $(this).data('name');
                $('.area-form .steps').removeClass('active');
                $('#' + name).addClass('active');
                $('#progressbar .' + name).addClass('active');
                $('html, body').animate({
                    scrollTop: $("#progressbar").offset().top
                }, 0);
                
                $('.text-fix').remove();
                $('.show-info').text(' ');
                $('.show-info').removeClass('active');
           }else{
               $('.text-fix').remove();
               $('.show-info').before('<p class="text-fix m-0 pt-50" style="color: #e26640;">Veuillez vérifier les erreurs suivantes :</p>');
               $('.show-info').removeClass('pt-50');
               $('.show-info').addClass('pt-25');
               $('html, body').animate({
                    scrollTop: $("#progressbar").offset().top
                }, 0);
           }
        }
});

 


$('#btn-valider-form').click(function() {
    var submitTime = new Date();
    var duraTime = Math.abs(submitTime - currentdate);
    duraTime = Math.floor((duraTime/1000));
    duraTime = parseInt(duraTime/60) + ':'+ ((duraTime%60) < 10 ? '0'+(duraTime%60) : (duraTime%60));
    $('.dura-time').val(duraTime);
    $('#devisform').submit();
//    $('html, body').animate({
//        scrollTop: $("#progressbar").offset().top
//    }, 500);
    return false;
})

$("form#devisform").on("beforeSubmit", function (event) {
    $("#btn-valider-form").prepend('<span class="spinner"></span>');
    $("#btn-valider-form").addClass('ok-valid');     
});

$(function() {
    $('#devisformmobile-has_date .ui-radio:first-of-type').click(function() {
        $("#tbl-form-tour .date").hide();
    })
    $('#devisformmobile-has_date .ui-radio:last-of-type').click(function() {
        $("#tbl-form-tour .date").show();
    })
})
$('.datepicker').datepicker({
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
        dateFormat: 'dd-mm-yy'
    });
