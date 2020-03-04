/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).bind("mobileinit", function () {
    $.mobile.ajaxEnabled = false;
});
$(document).on("pagecreate","#page1", function(){ 

    $(".btn-open-close-popup-main-form").click(function(){
        if($('#infomation-popup').hasClass('ui-popup-active')){
          $("#infomation").popup("close"); 
           $('html, body').attr('style','');
      }else {
          $("#infomation").popup("open");
          $('html, body').css({'position':'absolute','width':'100%','top':'0','left':'0','overflow' : 'hidden'});
            
      } 
    });
});
 $(window).bind('load', function(){
      $('.carousel').carousel({
        interval: 0 //changes the speed
        
    });
    $(".carousel").swipe({

        swipe: function(event, direction, distance, duration, fingerCount, fingerData) {

          if (direction == 'left') $(this).carousel('next');
          if (direction == 'right') $(this).carousel('prev');

        },
        allowPageScroll:"vertical"

      });
        $('#myCarousel .item').each(function(i) {
            (function(self) {
                setTimeout(function() {
                    $(self).next().addClass('next');
                },1500);
            })(this);
        });
       
   });      
   
// Jquery LazyLoad Image
   
  $(function() {
        // $('.lazyload, .img-lazy').lazy({
        //     scrollDirection: 'vertical',
        //     effect: 'fadeIn',
        //     effectTime: 1000,
        //     visibleOnly: true,
        //     onError: function(element) {
        //         console.log('error loading ' + element.data('src'));
        //     }
            
        // });
        $("div[role=main] a").each(function(){
          if(typeof $(this).data('rel') === 'undefined' && typeof $(this).data('role') === 'undefined'){
            $(this).attr('data-ajax','false');
          }
        });

    });
        
// End LazyLoad Image           

$('.add-offices li').click(function(){
    $('.add-offices li').removeClass('active');
    $(this).addClass('active');
});


$('.plus').click(function(){
    
    var hClass = $(this).hasClass('active');
        
        if(hClass){
            $(this).removeClass('active');
            $(this).parent().children('.click-action').hide();
            $(this).parent().children('a').removeClass('act');
        }else{
            $(this).addClass('active');
            $(this).parent().children('.click-action').show();
            $(this).parent().children('a').addClass('act');
        }
   
    
});

$('.mn-search .nav-parent a').click(function(){
    
    var hClass = $(this).hasClass('act');
        
        if(hClass){
            $(this).removeClass('act');
            $(this).parent().children('.plus').removeClass('active');
            $(this).parent().children('.click-action').hide();
        }else{
            $(this).addClass('act');
            $(this).parent().children('.plus').addClass('active');
            $(this).parent().children('.click-action').show();
            
        }
   
    
});


$('#page2 .ui-content li').click(function(){
  var page = $(this).data('page');
  $.mobile.changePage(page, {
            changeHash: true,
            transition: "slide"  //if not specified used the default one or the one defined in the default settings
        });
});
// $('.btn-hum').click(function(){
//   // $( ":mobile-pagecontainer" ).pagecontainer( "change", "#page2", {transition: "slide"});
//   // $(':mobile-pagecontainer').pagecontainer('change', '#bs-example-navbar-collapse-1');
//    $.mobile.changePage('#page2', {
//             changeHash: true,
//             transition: "slide"  //if not specified used the default one or the one defined in the default settings
//         });
// });



//$('.btn-hum, .logo a').click(function(){
//    var hClass = $('.navbar-fixed-top').hasClass('enable-search');
//     if(hClass){
//       return false;
//    }
//
//});
//
$('li.search .btn-testi').click(function(){
    var hClass = $(this).hasClass('active');
     if(hClass){
        $(this).removeClass('active');
    }else{
       // $(this).addClass('active');
    }

});

$('#wrapper').click(function(){
    var hClass = $(this).hasClass('close-mn-hum');
      if(hClass){
          $('.navbar-fixed-top').removeClass('enable-btn-hum');
          $('.mn-humburger').removeClass('in');
          $('html, body').removeClass('overlay-lock');
          
          $('#wrapper').removeClass('close-mn-hum');
          return false;
      }
      
    var hClass = $(this).hasClass('close-mn-search');
      if(hClass){
           $('.btn-search').removeClass('search-active');
            $('.navbar-fixed-top').removeClass('enable-search');
          $('.mn-search').removeClass('in');
          $('html, body').removeClass('overlay-lock');
          
          $('#wrapper').removeClass('close-mn-search');
          return false;
      }  
  
   
});
$('.btn-show-footer').click(function(){
    $('#footer').addClass('active');
    $(this).toggle('active');
})

$('.close-links-footer').click(function(){
    $('#footer').removeClass('active');
    $('.btn-show-footer').toggle('active');
});
// click form search
     
    $('.cs-placeholder').click(function(){
      var hClass = $(this).hasClass('active');
      if(hClass){
          $(this).removeClass('active');
          $(this).parent().children('.cs-options').hide();
          $(this).parent().children('.cs-options').removeClass('cs-options-active');
      }else{
          $(this).addClass('active');
          $(this).parent().children('.cs-options').show();
          $(this).parent().children('.cs-options').addClass('cs-options-active');
      }
    });
        
        
   
    function searchExcl(target, url){
        var parent = target.closest('form');
       
        $.get(url, function(data){
            var ext = data > 1 ? 's' : ''; 
            if(data==0){
              parent.find('.submit').addClass('disable');
            } else{
              parent.find('.submit').removeClass('disable');
              if(data < 10 && data > 0) data = '0' + data;
            }
            if(parent.hasClass('horizontal') || parent.hasClass('vertical')){
                parent.find('.submit').text(data+' formule'+ext);
              } 
             parent.find('#count-tour-search').text(data);
             
        })
    }

    function searchTesti(target, url){
        var parent = target.closest('form');
       
        $.get(url, function(data){
            var ext = data > 1 ? 's' : ''; 
            if(data==0){
              parent.find('.submit').addClass('disable');
            } else{
              parent.find('.submit').removeClass('disable');
              if(data < 10 && data > 0) data = '0' + data;
            }
            if(parent.hasClass('horizontal') || parent.hasClass('vertical')){
                parent.find('.submit').text(data+' témoignage'+ext);
              } 
        })
    }

    function searchProg(target, url){
        var parent = target.closest('form');
        $.get(url, function(data){
            var ext = data > 1 ? 's' : ''; 
            if(data==0){
              parent.find('.submit').addClass('disable');
            } else{
              parent.find('.submit').removeClass('disable');
              if(data < 10 && data > 0) data = '0' + data;
            }
            if(parent.hasClass('itineraire')){
              parent.find('#count-prog-search').text(data);
            } else {
              parent.find('.submit').text(data+' voyage'+ext);
            }
        })
    }

        $('.cs-options ul li').on('click',function(){
          var target = $(this);
          target.toggleClass('active');
          var parent = target.closest('form');
          var index = $(this).index();
          $(this).closest('.cs-select').find('.list-option ul li:eq('+index+')').toggleClass('active');
          var des = pr = url = '';
          
          parent.find('.search-destination .list-option .active').each(function(index){
              des += $(this).data('value');
              if(index != parent.find('.search-destination .list-option .active').length -1)
                  des += '-';
          })
          if(!des) des = 'all';
          var type = '';
          parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += '-';
          })
          if(!type) type= 'all';
            
            if($(this).closest('.search-excl-form').length){
              pr = {'country': des, 'type': type};
              var url2 = $.param( pr );
              url = '/amica-fr/get-number-excl';
              url = url + '?'+url2;
              
              searchExcl($(this), url);
            }

            if($(this).closest('.search-testi-form').length){
              type = '';
              parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += ',';
              })

              var theme = '';
              parent.find('.search-theme .list-option .active').each(function(index){
                  theme += $(this).data('value');
                  if(index != parent.find('.search-theme .list-option .active').length -1)
                      theme += ',';
              })
              if(!theme) theme = 'all';
              pr = {'country': des, 'type': type, 'theme': theme};
              var url2 = $.param( pr );
              url = '/amica-fr/get-number-testi';
              url = url + '?'+url2;
              
              searchTesti($(this), url);
            }

            if($(this).closest('.search-prog-form').length){
              var length = '';
            var i = 0;
            parent.find('.search-length .list-option .active').each(function(index){
                length += $(this).data('value');
                if(index != parent.find('.search-length .list-option .active').length -1)
                    length += '-';
                i++;
            })
            if(!length || i ==3) length= 'all';
            pr = {'country': des, 'type': type, 'length': length};
            var url2 = $.param( pr );
              url = '/amica-fr/get-number-prog';
              url = url + '?'+url2;
              searchProg($(this), url);
            }
        });
     
    $('.list-option ul li span').on('click', function() {
          $(this).parent().removeClass('active');
          var index = $(this).parent().index();
          $(this).closest('.cs-select').find('.cs-options ul li:eq('+index+')').removeClass('active');  
          var target = $(this);
          var parent = target.closest('form');
          var index = $(this).index();
          var des = pr = url = '';

          parent.find('.search-destination .list-option .active').each(function(index) {
              des += $(this).data('value');
              if (index != parent.find('.search-destination .list-option .active').length - 1)
                  des += '-';
          })
          if (!des) des = 'all';
          var type = '';
          parent.find('.search-type .list-option .active').each(function(index) {
              type += $(this).data('value');
              if (index != parent.find('.search-type .list-option .active').length - 1)
                  type += '-';
          })
          if (!type) type = 'all';


          if ($(this).closest('.search-excl-form').length) {
              pr = { 'country': des, 'type': type };
              var url2 = $.param(pr);
              url = '/amica-fr/get-number-excl';
              url = url + '?' + url2;

              searchExcl($(this), url);
              return false;
          }

           if($(this).closest('.search-testi-form').length){
              type = '';
              parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += ',';
              })

              var theme = '';
              parent.find('.search-theme .list-option .active').each(function(index){
                  theme += $(this).data('value');
                  if(index != parent.find('.search-theme .list-option .active').length -1)
                      theme += ',';
              })
              if(!theme) theme = 'all';
              pr = {'country': des, 'type': type, 'theme': theme};
              var url2 = $.param( pr );
              url = '/amica-fr/get-number-testi';
              url = url + '?'+url2;
              
              searchTesti($(this), url);
            }

           if ($(this).closest('.search-testi-form').length) {
              var theme = '';
              parent.find('.search-theme .list-option .active').each(function(index){
                theme += $(this).data('value');
                if(index != parent.find('.search-theme .list-option .active').length -1)
                  theme += '-';
              })
              if(!theme) theme = 'all';
              pr = { 'country': des, 'type': type, 'theme': theme };
              var url2 = $.param(pr);
              url = '/amica-fr/get-number-testi';
              url = url + '?' + url2;

              searchTesti($(this), url);
              return false;
          }

          if ($(this).closest('.search-prog-form').length) {
              var length = '';
              var i = 0;
              parent.find('.search-length .list-option .active').each(function(index) {
                  length += $(this).data('value');
                  if (index != parent.find('.search-length .list-option .active').length - 1)
                      length += '-';
                  i++;
              })
              if (!length || i == 3) length = 'all';
              pr = { 'country': des, 'type': type, 'length': length };
              var url2 = $.param(pr);
              url = '/amica-fr/get-number-prog';
              url = url + '?' + url2;
              searchProg($(this), url);
              return false;
          }
      });


        $('.cs-select.submit').click(function(){
          if($(this).hasClass('disable')) return false;
          var target = $(this);
          var des = pr = url = '';
          var parent = target.closest('form')
          parent.find('.search-destination .list-option .active').each(function(index){
              des += $(this).data('value');
              if(index != parent.find('.search-destination .list-option .active').length -1)
                  des += '-';
          })
          if(!des) des = 'all';
          var type = '';
          parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += '-';
          })
          if(!type) type= 'all';

          if(parent.hasClass('search-excl-form')){
              pr = {'country': des, 'type': type};
              url = '/formules/itineraire';
          }

          if(parent.hasClass('search-prog-form')){
            var length = '';
            var i = 0;
            parent.find('.search-length .list-option .active').each(function(index){
                length += $(this).data('value');
                if(index != parent.find('.search-length .list-option .active').length -1)
                    length += '-';
                i++;
            })
            if(!length || i ==3) length= 'all';
            pr = {'country': des, 'type': type, 'length': length};
            url = '/voyage/itineraire';
          }

           if($(this).closest('.search-testi-form').length){
              type = '';
              parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += ',';
              })

              var theme = '';
              parent.find('.search-theme .list-option .active').each(function(index){
                  theme += $(this).data('value');
                  if(index != parent.find('.search-theme .list-option .active').length -1)
                      theme += ',';
              })
              if(!theme) theme = 'all';
              pr = {'country': des, 'type': type, 'theme': theme};
              url = '/temoignages/recherche';
          }
          var url2 = decodeURIComponent($.param( pr ));
          url = url + '?'+url2;
          window.location = url;
        })         

//    $('.cs-options').mouseleave(function(){
//        $(this).hide();
//        $(this).removeClass('cs-options-active');
//        $(this).parent('.cs-select').removeClass('active');
//    });    
        
      $('.cs-select-mb .cs-placeholder-mb').click(function(){
            var name = $(this).attr('name');  
            if(name == ''){
                $('.cs-select-mb .cs-placeholder-mb').attr('name','');
                $(this).attr('name','selected');
                $('.cs-select-mb .cs-placeholder-mb').removeClass('active');
                $(this).addClass('active');
                $('.cs-select-mb .cs-placeholder-mb').parent().children('.cs-options-mb').hide();
                $(this).parent().children('.cs-options-mb').show();
            }
            if(name == 'selected'){
                $('.cs-select-mb .cs-placeholder-mb').attr('name','');
               // $(this).attr('name','');
                $('.cs-select-mb .cs-placeholder-mb').removeClass('active');
                //$(this).addClass('active');
                $('.cs-select-mb .cs-placeholder-mb').parent().children('.cs-options-mb').hide();
            }
            
            

    });  
     
   
    $('.cs-options-mb ul li').attr("name","");    
    $('.cs-options-mb ul li').on('click',function(){
            var name = $(this).attr("name");
            if (name == ""){
                 $(this).attr("name","selected");   
                 var value = $(this).attr("data-value");
                 $(this).parent().parent().addClass('cs-options-active');
                 $(this).addClass('active');
                 var parent = $(this).parent().parent().parent().children('.list-option-mb').children('ul');
                 $(this).clone().appendTo(parent);
                 parent.children('li[data-value="' + value + '"]').append('<span></span>');
                 
                 
            }
            else {
                 $(this).attr("name","");
                  var parent = $(this).parent().parent().parent().children('.list-option-mb').children('ul');
                 var value = $(this).attr("data-value");
                 
                 $(this).removeClass('active');
                 parent.children('li[data-value="' + value + '"]').remove();
                 
                
            }
           
        });
        $(document).on('click', '.list-option-mb ul li span', function() {
             var value = $(this).parent().attr('data-value');
            //alert(value);
             $(this).parent().parent().parent().parent().children('.cs-options-mb').children('ul').children('li[data-value="' + value + '"]').attr("name","");
             $(this).parent().parent().parent().parent().children('.cs-options-mb').children('ul').children('li[data-value="' + value + '"]').removeClass("active");
             $(this).parent().remove();
        
             
            
         });
        
// end  


// Js back to top
        
    if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}    	

$('#newsletter-form .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#newsletter-form .email').val())){
          $('#newsletter-form .email').css({'border' : '1px solid #e65925'});
          $('#newsletter-form .error-email').text('Le format de votre email n\'e​st pas valide.');
          $('#newsletter-form .error-email').show();

        }else{
            $('#newsletter-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#newsletter-form .error-email').hide();

        }
});
$('#newsletter-form .submit-email').click(function(e){
    e.preventDefault();
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#newsletter-form .email').val())){
          $('#newsletter-form .email').css({'border' : '1px solid #e65925'});
          $('#newsletter-form .error-email').text('Le format de votre email n\'e​st pas valide.');
          return false;
        }
        $.post(url, { email: $('#newsletter-form .email').val() }, function(data){
                if(data){
                $('#newsletter-form .submit-email').text('Merci');
                $('#newsletter-form .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'});
                $('#newsletter-form .submit-email').addClass('submited');

                //window.location = '/merci?from=newsletter';

              
                }else{
                    return false;
                }
            });
    }else{
        return false;
    }
    
});

// js search for search page
//$('#search-page .ui-content ul li').on('click',function(){
//        $(this).toggleClass('selected');
//        if($('#search-page .ui-content ul li.selected').length){
//          $('#search-page .reset-filter').addClass('active');
//        } else $('#search-page .reset-filter').removeClass('active');
//         var target = $(this);
//         var index = $(this).index();
//         var des = pr = url = '';
//         $('#search-page .ui-content ul.destination li.selected').each(function(index){
//             des += $(this).data('value');
//             if(index != $('#search-page .ui-content ul.destination li.selected').length -1){
//               des += '-';
//             }
//         });
//         if(!des) des = 'all';
//         var type = '';
//         $('#search-page .ui-content ul.voyage li.selected').each(function(index){
//             type += $(this).data('value');
//             if(index != $('#search-page .ui-content ul.voyage li.selected').length -1){
//               type += '-';
//             }
//         });
//         if(!type) type= 'all';
//         var length = '';
//         var i = 0;
//           $('#search-page .ui-content ul.tour-length li.selected').each(function(index){
//               length += $(this).data('value');
//               if(index != $('#search-page .ui-content ul.tour-length li.selected').length -1)
//               {
//                   length += '-';
//               }
//               i++;
//           })
//           if(!length || i ==3) length= 'all';
//               pr = {'country': des, 'type': type, 'length': length};
//               var url2 = $.param( pr );
//                 url = '/amica-fr/get-number-prog';
//                 url = url + '?'+url2;
//                 searchCountryHome(target, url);
//});
//$('#search-page .cs-select.submit').off().on('click',function(){
//    $(this).toggleClass('selected');
//         var target = $(this);
//         var index = $(this).index();
//         var des = pr = url = '';
//         if(!des) des = 'vietnam';
//         var type = '';
//         $('#search-page .ui-content ul.voyage li.selected').each(function(index){
//             type += $(this).data('value');
//             if(index != $('#search-page .ui-content ul.voyage li.selected').length -1){
//               type += '-';
//             }
//         });
//         if(!type) type= 'all';
//         var length = '';
//         var i = 0;
//           $('#search-page .ui-content ul.tour-length li.selected').each(function(index){
//               length += $(this).data('value');
//               if(index != $('#search-page .ui-content ul.tour-length li.selected').length -1)
//               {
//                   length += '-';
//               }
//               i++;
//           })
//           if(!length || i ==3) length= 'all';
//               pr = {'country': des, 'type': type, 'length': length};
//               var url2 = $.param( pr );
//                 url = '$uri';
//                 url = url + '?'+url2;
//                 window.location = url;
//});
function searchCountryHome(target, url){
       var parent = target.closest('#search-page');
       $.get(url, function(data){
           var ext = data > 1 ? 's' : ''; 
           if(data==0){
             parent.find('.submit').addClass('disable');
           } else{
             parent.find('.submit').removeClass('disable');
             if(data < 10 && data > 0) data = '0' + data;
           }
           var formvoyage = target.parent().parent('.form-filter-voyage');
           var formexclusive = target.parent().parent('.form-filter-exclusive');
           var formextesti = target.parent().parent('.form-filter-testi');
           if(formvoyage){
                
                if(data == 0){
                   formvoyage.find('.submit').addClass('disable'); 
                   formvoyage.find('.submit').text('Aucun résultat');
                }else{
                  formvoyage.find('.submit').text('Afficher ' +data+ ' résultat'+ext);  
                   formvoyage.find('.submit').removeClass('disable');  
                }
           }
           if(formexclusive){
                
                if(data == 0){
                   formvoyage.find('.submit').addClass('disable'); 
                   formexclusive.find('.submit').text('Aucun résultat');
                }else{
                    formexclusive.find('.submit').text('Afficher ' +data+ ' résultat'+ext);
                   formvoyage.find('.submit').removeClass('disable');  
                }
           }
           if(formextesti){
                formexclusive.find('.submit').text('Afficher ' +data+ ' résultat'+ext);
           }
          
       })
}
$('#footer .btn-show-footer').click(function(){
  $('#footer').toolbar( "show" );
})
$('.back-to-top').click(function(){
  $.mobile.silentScroll(0);
});


$(document).on('scrollstart', function(event) {
  $('.btn-show-footer').addClass('active');
  $(document).on('scrollstop', function(event) {
    var scroll = $(document).scrollTop();
    if(scroll == 0) $('.btn-show-footer').removeClass('active');
  });
});
$(document).on('click', '.item a', function() {
   // var value = $(this).attr('href');
   window.location = url;


});  


$( document ).ready(function() {
  $('a[href$="pdf"]').addClass('download-link download-pdf');
  $('a[href$="pdf"]').attr('target','');
  $('a[href$="doc"]').addClass('download-link download-doc');
  $('a[href$="docx"]').addClass('download-link download-docx');
  $('a[href$="xls"]').addClass('download-link download-xls');
  $('a[href$="xlsx"]').addClass('download-link download-xlsx');
  $('.content-fix-color-link-e65925 a[href]').css({'color' : '#e65925'});
  setTimeout(function(){
      $('#footer').fadeTo("slow", 1);
      $('#search-page-voyage').removeClass('hide');
  }, 2000)
});

/* JS click element class 'hidden-redirect' */
  $(document).ready(function(){
  $('.pugjd').on('click', function(e){
      var datalink = $(this).data('title');
      // Create Base64 Object
        var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
        var decodedString = Base64.decode(datalink);
        // window.open(decodedString , "_blank");
         window.location.href = decodedString;
     
      return false;
  });
  });
  /* End Js click element class 'hidden-redirect' */
  
  
   
        // xu ly Ajax nut see-more
        $(document).on("click", ".ajax-see-more", function(event){    
           
            var pr = $(this).data('get');
            var page = $(this).data('page');
            var seemore = $(this).data('seemore');
            var pagesize = $(this).data('value');
            var url = window.location.pathname + '?' + pr;
            
           if(pr == ''){
                var data = 'see-more=' + seemore + '&data-page=' + page;;
                
                history.pushState('', '', window.location.pathname + '?page=' + page);
            }else{
                var data = pr + '&see-more=' + seemore + '&data-page=' + page;;
                history.pushState('', '', window.location.pathname + '?' + pr + '&page=' + page);
            }
            
            
               $.ajax({
                    type: "GET",
                    url: window.location.pathname,
                    data: data,
                    beforeSend: function() {
                        $('.getcontent').append('<div class="backgroundwhite"></div>');
                        $('.getcontent').css({'position':'relative'});
                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                    },
                    success: function(data){
                    
                    var urlbase =  $($.parseHTML(data)).filter('link[rel="canonical"]').attr("href");   
                     var metadescription = $($.parseHTML(data)).filter('meta[name="description"]');
                    var title = $($.parseHTML(data)).filter('title');
                    var metarobotupdate = $($.parseHTML(data)).filter('meta[name="ROBOTS"]');
                    var canonicalupdate = $($.parseHTML(data)).filter('link[rel="canonical"]');
                    var linkprev = $($.parseHTML(data)).filter('link[rel="prev"]');
                    var linknext = $($.parseHTML(data)).filter('link[rel="next"]');
                    var propertyog = $($.parseHTML(data)).filter('meta[property="og:url"]');

                    $('meta[name="description"]').remove();
                    $('title').remove(); 
                    $('meta[name="ROBOTS"]').remove();
                    $('link[rel="canonical"]').remove();
                    $('link[rel="prev"]').remove();
                    $('link[rel="next"]').remove();
                    $('meta[property="og:url"]').remove();
                    $('base').remove();
            
                    $('head').append('<base href="'+ urlbase +'">');
                    $('head').append(metadescription);
                    $('head').append(title);
                    $('head').append(metarobotupdate);
                    $('head').append(canonicalupdate);
                    $('head').append(linkprev);
                    $('head').append(linknext);
                    $('head').append(propertyog);   
                       
                    var datanew = $($.parseHTML(data)).find(".getcontent");
                    $('.ajaxfilter').html(datanew);
                    
                    
                    if(window.innerHeight > window.innerWidth){
                       
                    }else{
                        $('.all-tour .item').each(function() {
                            $(this).children('.col-left').children('a').addClass('fix-xoay-ngang');
                            var image = $(this).children('.col-left').children('a').children('img').attr('src');
                            var heightcolright = $(this).children('.col-right').height();
                            $(this).children('.col-left').children('a').css({'height' : heightcolright + 'px','background-image' : 'url('+image+')'});
                            $(this).children('.col-left').children('a').children('img').hide();

                        });
                    }
                    

                      
                   
                   
                    },
                    complete: function(data) {
                       
                    },
               }); 
            return false;      
        });
        
    // end ajax see-more
    
    
    // xu ly Ajax nut see-more-prev
        $(document).on("click", ".ajax-see-more-prev", function(event){    
           
            var target = $(this);
            var pr = $(this).data('get');
            var seemore = $(this).data('seemore');
            var page = $(this).data('page');
            var pagesize = $(this).data('value');
            var url = window.location.pathname + '?' + pr;
            
//            var geturl = window.location.href;
//            
//            var param = pr.split('&');
//            param.splice(3,1);
            //alert(param.join('&'));
           
            var extpage = '';
            
            if(pr == ''){
                var data = 'before-page=' + page;
                if(page > 1){
                    extpage = '?page=' + page;
                }
                history.pushState('', '', window.location.pathname + extpage);
            }else{
                var data = pr + '&before-page=' + page;
                if(page > 1){
                    extpage = '&page=' + page;
                }
                history.pushState('', '', window.location.pathname + '?' + pr + extpage);
            }
            
            
               $.ajax({
                    type: "GET",
                    url: window.location.pathname,
                    data: data,
                    beforeSend: function() {
                        $('.getcontent').append('<div class="backgroundwhite"></div>');
                        $('.getcontent').css({'position':'relative'});
                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                    },
                    success: function(data){
                    
                        
                    var urlbase =  $($.parseHTML(data)).filter('link[rel="canonical"]').attr("href");   
                     var metadescription = $($.parseHTML(data)).filter('meta[name="description"]');
                    var title = $($.parseHTML(data)).filter('title');
                    var metarobotupdate = $($.parseHTML(data)).filter('meta[name="ROBOTS"]');
                    var canonicalupdate = $($.parseHTML(data)).filter('link[rel="canonical"]');
                    var linkprev = $($.parseHTML(data)).filter('link[rel="prev"]');
                    var linknext = $($.parseHTML(data)).filter('link[rel="next"]');
                    var propertyog = $($.parseHTML(data)).filter('meta[property="og:url"]');

                    $('meta[name="description"]').remove();
                    $('title').remove(); 
                    $('meta[name="ROBOTS"]').remove();
                    $('link[rel="canonical"]').remove();
                    $('link[rel="prev"]').remove();
                    $('link[rel="next"]').remove();
                    $('meta[property="og:url"]').remove();
                    $('base').remove();
            
                    $('head').append('<base href="'+ urlbase +'">');
                    $('head').append(metadescription);
                    $('head').append(title);
                    $('head').append(metarobotupdate);
                    $('head').append(canonicalupdate);
                    $('head').append(linkprev);
                    $('head').append(linknext);
                    $('head').append(propertyog);       
                        
                        
                    var datanew = $($.parseHTML(data)).find(".getcontent .clear-fix");
                    var btnajaxseemoreprev = $($.parseHTML(data)).find(".ajax-see-more-prev");
                    $('.see-more-prev').after(datanew);
                    $('.see-more-prev').html(btnajaxseemoreprev);
                  //  $('.ajaxfilter').load();
                    $( ".backgroundwhite" ).remove();
                 
                  
                    if(window.innerHeight > window.innerWidth){
                       
                    }else{
                        $('.all-tour .item').each(function() {
                            $(this).children('.col-left').children('a').addClass('fix-xoay-ngang');
                            var image = $(this).children('.col-left').children('a').children('img').attr('src');
                            var heightcolright = $(this).children('.col-right').height();
                            $(this).children('.col-left').children('a').css({'height' : heightcolright + 'px','background-image' : 'url('+image+')'});
                            $(this).children('.col-left').children('a').children('img').hide();

                        });
                    } 
                    
                    var totalitemtour = $(document).find('.getcontent .item').length;    
                    var tourseen = $(document).find('.amc-nb-seen');
                    var tourtotal = $(document).find('.amc-nb-total');
                    
                    tourseen.text(totalitemtour);
                    $('.amc-progress div').css({'width' : (totalitemtour/tourtotal.data('value'))*100 + '%'});
                    
                    },
                    complete: function(data) {
                       
                    },
               }); 
              return false;    
        });
        
    // end ajax see-more-prev
    
    // Xu ly Ajax option Trier par
    
     $(document).on("click", "html body", function(event){
        $('.amc-ajax-order-by .amc-text').removeClass('active');
        $('.amc-ajax-order-by .amc-list-opt').removeClass('active');
    });
    $(document).on("click", ".amc-ajax-order-by .amc-text", function(event){
        var target = $(this);
        var hClass = target.hasClass('active');
        if(!hClass){
            target.addClass('active');
           // target.children('.amc-text').addClass('active');
            target.parent().children('.amc-list-opt').addClass('active');
        }else{
            target.removeClass('active');
          //  target.children('.amc-text').removeClass('active');
            target.parent().children('.amc-list-opt').removeClass('active');
        }
        event.stopPropagation(); 
    });
    
    $(document).on("click", ".amc-ajax-order-by .amc-list-opt li", function(event){
      
        var target = $(this);
        var hClass = $(this).hasClass('active');
        if(!hClass){
            var pr = $(this).data('get');
            var data = pr + '&orderby=' + $(this).data('opt');
            history.pushState('', '', window.location.pathname + '?' + data);

            var text = $(this).text();
        
            
            $('.amc-ajax-order-by .amc-list-opt li').removeClass();
            target.addClass('active');
            $('.amc-ajax-order-by').removeClass('active');
            $('.amc-text').removeClass('active');
            $('.amc-list-opt').removeClass('active');
            $('.amc-ajax-order-by .amc-text').text(text);
            $.ajax({
                type: "GET",
                url: window.location.pathname,
                data: data,
                beforeSend: function() {
                    $('.getcontent').append('<div class="backgroundwhite"></div>');
                    $('.getcontent').css({'position':'relative'});
                    $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                },
                success: function(data){
                    var datanew = $($.parseHTML(data)).find(".getcontent");
                    $('.ajaxfilter').html(datanew);

                    
                },
                complete: function(data) {

                },
            }); 
        }
        
        
       
    });
    // End Xu ly Ajax option Trier par
    
 
/* Js Fix Caption Image */    
    $('.entry-body img').parent('strong').contents().unwrap();
    $('.entry-body img').parent('em').contents().unwrap();
    $('.entry-body img').parent('p').addClass('parent-caption');
   
    $('p.parent-caption').each(function (key,value) {
       // $(this).children('em').addClass('caption-image');
       $(this).find("em").contents().unwrap();
       var str = $(this).html();
        var regex = /<br\s*[\/]?>/gi;
        //var regeximg = /<img\s*[\/]?>/gi;
        $(this).html(str.replace(regex, "<br><span class='caption-image'>"));
      
       $(this).append("</span>");
    });
    
    /* END Js Fix Caption Image */        
    
    
function fixMarginText(){
    $(document).ready(function () {
        $('.amc-fix-mt-25-0').each(function(){
            var fs = $(this).css('font-size');
            var lineheight = $(this).css('line-height');
            var mt = 25 - ((parseFloat(lineheight) - parseFloat(fs)) / 2) ;
            //alert(mt);
           // $(this).attr("style", "padding-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
        $('.amc-fix-pb-25-0').each(function(){
            var fs = $(this).css('font-size');
            var lineheight = $(this).css('line-height');
            var pb = 25 - ((parseFloat(lineheight) - parseFloat(fs)) / 2) ;
            //alert(mt);
           // $(this).attr("style", "padding-top: "+mt+"px !important");
            $(this).css("cssText", "padding-bottom: "+pb+"px !important;");
        });
        $('.amc-fix-pt-25').each(function(){
            var fs = $(this).css('font-size');
            var elementbefore = $(this).prev().css('font-size');
            var lineheight = $(this).css('line-height');
            var mt = 25 - ((parseFloat(lineheight) - parseFloat(fs)) / 2 + (parseFloat(elementbefore) * 0.5) / 2 ) ;
            //alert(mt);
           // $(this).attr("style", "padding-top: "+mt+"px !important");
            $(this).css("cssText", "padding-top: "+mt+"px !important;");
        });
        $('.amc-fix-mt-10-2').each(function(){
            var fs = $(this).css('font-size');
            var elementbefore = $(this).prev().css('font-size');
            var elementbefore_lineheight = $(this).prev().css('line-height');

            var mt = 10 - (((parseFloat(fs) * 0.5) / 2) + ((parseFloat(elementbefore_lineheight) - parseFloat(elementbefore)) / 2)) ;
            //alert(mt);
            //$(this).attr("style", "margin-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
        $('.amc-fix-mt-12').each(function(){
            var fs = $(this).css('font-size');
            var elementbefore = $(this).prev().css('font-size');
            var elementbefore_lineheight = $(this).prev().css('line-height');

            var mt = 12 - (((parseFloat(fs) * 0.5) / 2) + ((parseFloat(elementbefore_lineheight) - parseFloat(elementbefore)) / 2)) ;
            //alert(mt);
            //$(this).attr("style", "margin-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
        $('.amc-fix-mt-12-0').each(function(){
            var fs = $(this).css('font-size');
           
            var mt = 12 - ((parseFloat(fs) * 0.5) / 2);
            //alert(mt);
            //$(this).attr("style", "margin-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
        
        $('.amc-fix-mt-20').each(function(){
            var fs = $(this).css('font-size');
            var lh = $(this).css('line-height');
            var elementbefore = $(this).prev().css('font-size');
            var elementbefore_lineheight = $(this).prev().css('line-height');
            var mt = 20 - (((parseFloat(lh) - parseFloat(fs)) / 2) + ((parseFloat(elementbefore_lineheight) - parseFloat(elementbefore)) / 2));
           // var mt = 25 - ((parseFloat(fs) * 0.5) / 2 + (parseFloat(elementbefore) * 0.5) / 2) ;
            //alert(mt);
           // $(this).attr("style", "margin-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
        
        $('.amc-fix-mt-25').each(function(){
            var fs = $(this).css('font-size');
            var lh = $(this).css('line-height');
            var elementbefore = $(this).prev().css('font-size');
            var elementbefore_lineheight = $(this).prev().css('line-height');
            var mt = 25 - (((parseFloat(lh) - parseFloat(fs)) / 2) + ((parseFloat(elementbefore_lineheight) - parseFloat(elementbefore)) / 2));
           // var mt = 25 - ((parseFloat(fs) * 0.5) / 2 + (parseFloat(elementbefore) * 0.5) / 2) ;
            //alert(mt);
           // $(this).attr("style", "margin-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
        $('.amc-fix-mb-25').each(function(){
            var fs = $(this).css('font-size');
            var elementbefore = $(this).parent().next().css('font-size');
            //alert(elementbefore);
            var mt = 25 - ((parseFloat(fs) * 0.5) / 2 + (parseFloat(elementbefore) * 0.5) / 2) - 3 ;
            //alert(mt);
           // $(this).attr("style", "margin-top: "+mt+"px !important");
            var style = $(this).attr('style');
            $(this).css("cssText", "margin-bottom: "+mt+"px !important;" + style);
        });
        $('.amc-fix-mb-40-0').each(function(){
            var fs = $(this).css('font-size');
            var mb = 40 - ((parseFloat(fs) * 0.5) / 2);
            //alert(mt);
            //  $(this).attr("style", "margin-bottom: "+mb+"px !important");
            $(this).css("cssText", "margin-bottom: "+mb+"px !important;");
        });
        $('.amc-fix-mt-15').each(function(){
            var fs = $(this).css('font-size');
            var lh = $(this).css('line-height');
            var elementbefore = $(this).prev().css('font-size');
            var elementbefore_lineheight = $(this).prev().css('line-height');
            var mt = 15 - (((parseFloat(lh) - parseFloat(fs)) / 2) + ((parseFloat(elementbefore_lineheight) - parseFloat(elementbefore)) / 2));
           // var mt = 25 - ((parseFloat(fs) * 0.5) / 2 + (parseFloat(elementbefore) * 0.5) / 2) ;
            //alert(mt);
           // $(this).attr("style", "margin-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
       // var b = parseFloat(fs) / 2 ;
       // var before = $('.amc-fix-mt-25').prev().css('font-size');
       // alert(b);amc-fix-mb-40-0
    });
};
fixMarginText();
$(document).ajaxComplete(function() {
  fixMarginText();
});    
    
    
function imgLazy(){
    
 //   const images = document.querySelectorAll('img[data-src]');
    var images = Array.prototype.slice.call(document.querySelectorAll('img[data-src]'));
    const config = {
      rootMargin: '0px 0px 50px 0px',
      threshold: 0
    };
    let loaded = 0;

    let observer = new IntersectionObserver(function (entries, self) {
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
          preloadImage(entry.target);
          // Stop watching and load the image
          self.unobserve(entry.target);
        }
      });
    }, config);

    images.forEach(function(image) {
      observer.observe(image);
    });

    function preloadImage(img) {
      const src = img.getAttribute('data-src');
      if (!src) { return; }
      img.src = src;
    //  _updateMonitoring();
    }

    // Just for the monitoring purpose. Isn't needed in real projects
//    function _updateMonitoring() {
//      const container = document.getElementById('isIntersecting');
//      const placeholder = container.querySelector('.placeholder')
//      loaded += 1;
//      placeholder.innerHTML = loaded;
//      container.style.opacity = 1;
//    }
};

imgLazy();
$(window).bind('load', function(){
    imgLazy();
});
document.addEventListener("DOMContentLoaded", function() {
  var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));

  if ("IntersectionObserver" in window) {
    let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
           if(entry.target.getAttribute('data-src')){
                entry.target.style.backgroundImage = "url('"+ entry.target.getAttribute('data-src') +"')";
                // console.log(entry.target.getAttribute('data-src'));
            }
          lazyBackgroundObserver.unobserve(entry.target);
        }
      });
    });

    lazyBackgrounds.forEach(function(lazyBackground) {
      lazyBackgroundObserver.observe(lazyBackground);
    });
  }
});

$(document).ajaxSuccess(function(event, xhr, settings) {
   // console.log(settings.url);
   // if(settings.url == "/amica-fr/ajax-result-menu"){
       imgLazy();
  //  }
});    
    
    
function init() {
var vidDefer = document.getElementsByTagName('iframe');
//var vidDefer = document.getElementsByClassName('videoytb');
for (var i=0; i < vidDefer.length; i++) {
if(vidDefer[i].getAttribute('data-src')) {
vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
} } }
window.onload = init;  


// show info warning input email all form on website
$("#devisformmobile-email, input.email").keyup(function(){     
        var arr = ["wanadoo.fr", "neuf.fr", "live.fr", "laposte.net", "yahoo.fr", "yahoo.com", "free.fr", "hotmail.com", "hotmail.fr", "outlook.fr", "algam.net"];
        el = $(this);
        var email = el.val();
        var domain_email = email.split("@")[1];
    if($.inArray($.trim(domain_email), arr) > -1){
        //console.log($.inArray($.trim(domain_email), arr));
        var hClass = el.parent().find('.info-inbox-spam');
        if(hClass.length == 1){
            
        }else{
            el.parent().append('<div class="info-inbox-spam" style="font-size: 13px; max-width: 340px;">Merci de vérifier votre dossier de courriers indésirables afin de vous assurer de la bonne réception.</div>');
     
        }
        
   }else{
       $('.info-inbox-spam').remove();
    }  
       
    
});         
// End info warning input email all form on website