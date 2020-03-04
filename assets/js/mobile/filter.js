/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
function searchTesti(target, url){
       var parent = target.closest('#search-testi');
       $.get(url, function(data){
           var ext = data > 1 ? 's' : ''; 
           if(data==0){
             parent.find('.submit').addClass('disable');
           } else{
             parent.find('.submit').removeClass('disable');
             if(data < 10 && data > 0) data = '0' + data;
           }
           
           var formextesti = target.parent().parent('.form-filter-testi');
          
           if(formextesti){
                formextesti.find('.submit').text('Afficher ' +data+ ' résultat'+ext);
           }
          
       })
}  
function updateMetasFix(target, url){
        var parent = target.closest('form');
        $('.updatefilter').append('<div class="backgroundwhite"></div>');
        $('.updatefilter').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $.get(url, function(data){
            
            
            
            
            var datanumber = $($.parseHTML(data)).find(".gettoolfilter"); 
            $('.updatefilter').html(datanumber);
            
        })
     } 
function updateMetas(target, url){
        var parent = target.closest('form');
        $('.updatefilter').append('<div class="backgroundwhite"></div>');
        $('.updatefilter').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $.get(url, function(data){
            
             var urlbase =  $($.parseHTML(data)).filter('link[rel="canonical"]').attr("href");   
           var metadescription = $($.parseHTML(data)).filter('meta[name="description"]');
            var title = $($.parseHTML(data)).filter('title');
            var metarobotupdate = $($.parseHTML(data)).filter('meta[name="ROBOTS"]');
            var canonicalupdate = $($.parseHTML(data)).filter('link[rel="canonical"]');
            var linkprev = $($.parseHTML(data)).filter('link[rel="prev"]');
            var linknext = $($.parseHTML(data)).filter('link[rel="next"]');
            var propertyog = $($.parseHTML(data)).filter('meta[property="og:url"]');
           // var base = $($.parseHTML(data)).filter('base');
           // console.log(window.location.href);
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
            
            
            var datanumber = $($.parseHTML(data)).find(".gettoolfilter"); 
            $('.updatefilter').html(datanumber);
            
            var datanumber = $($.parseHTML(data)).find(".gettoolfilter-exclusive"); 
            $('.updatefilter-exclusive').html(datanumber);
        })
     } 
function updateMetasExclusive(target, url){
        var parent = target.closest('form');
        $('.updatefilter-exclusive').append('<div class="backgroundwhite"></div>');
        $('.updatefilter-exclusive').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $.get(url, function(data){
            
             var urlbase =  $($.parseHTML(data)).filter('link[rel="canonical"]').attr("href");   
           var metadescription = $($.parseHTML(data)).filter('meta[name="description"]');
            var title = $($.parseHTML(data)).filter('title');
            var metarobotupdate = $($.parseHTML(data)).filter('meta[name="ROBOTS"]');
            var canonicalupdate = $($.parseHTML(data)).filter('link[rel="canonical"]');
            var linkprev = $($.parseHTML(data)).filter('link[rel="prev"]');
            var linknext = $($.parseHTML(data)).filter('link[rel="next"]');
            var propertyog = $($.parseHTML(data)).filter('meta[property="og:url"]');
           // var base = $($.parseHTML(data)).filter('base');
           // console.log(window.location.href);
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
            
            
            
            var datanumber = $($.parseHTML(data)).find(".gettoolfilter-exclusive"); 
            $('.updatefilter-exclusive').html(datanumber);
        })
     }         
$(window).bind('load',function(){
   if($('#search-page-voyage .ui-content ul li.selected').length){
            $('#search-page-voyage .area-reset-filter').addClass('active');
            $('#search-page-voyage').css({'padding-top' : '8rem'});
        } else {
            $('#search-page-voyage .area-reset-filter').removeClass('active');
            $('#search-page-voyage').css({'padding-top' : '4rem'});
        }
});    
$(document).on('click','#search-page-voyage .ui-content ul li',function(){
        var hClass = $(this).hasClass('selected');
        if(hClass){
            $(this).removeClass('selected');
        }else{
            $(this).addClass('selected');
        }
        
        var issetsformsearchpageexclusive = $('#search-page').data('url');
        //console.log(issetsformsearchpageexclusive);
        
       // $(this).toggleClass('selected');
        if($('#search-page-voyage .ui-content ul li.selected').length){
            $('#search-page-voyage .area-reset-filter').addClass('active');
            $('#search-page-voyage').css({'padding-top' : '8rem'});
        } else {
            $('#search-page-voyage .area-reset-filter').removeClass('active');
            $('#search-page-voyage').css({'padding-top' : '4rem'});
        }
        
        var uri = $('.updatefilter').data('url');    
        
         var target = $(this);
         var index = $(this).index();
         var des = pr = url = '';
         var i = 0;
         $('#search-page-voyage .ui-content ul.destination li.selected').each(function(index){
             des += $(this).data('value');
             if(index != $('#search-page-voyage .ui-content ul.destination li.selected').length -1){
               des += '-';
             }
             i++;
         });
         if(!des) des = 'all';
         //if(!des || i ==4) des= 'all';
         var type = '';
         $('#search-page-voyage .ui-content ul.voyage li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-page-voyage .ui-content ul.voyage li.selected').length -1){
               type += '-';
             }
         });
         if(!type) type= 'all';
         var length = '';
         var i = 0;
           $('#search-page-voyage .ui-content ul.tour-length li.selected').each(function(index){
               length += $(this).data('value');
               if(index != $('#search-page-voyage .ui-content ul.tour-length li.selected').length -1)
               {
                   length += '-';
               }
               i++;
           })
           if(!length || i ==4) length= 'all';
          var region = '';
         var i = 0;
           $('#search-page-voyage .ui-content ul.tour-region li.selected').each(function(index){
               region += $(this).data('value');
               if(index != $('#search-page-voyage .ui-content ul.tour-region li.selected').length -1)
               {
                   region += '-';
               }
               i++;
           })
           if(!region || i ==6) region= 'all';
            
               var formfiltervoyage = $(this).parent().parent().hasClass('form-filter-voyage');
               var formfilterexclusive = $(this).parent().parent().hasClass('form-filter-exclusive');
               if(formfiltervoyage){
                   pr = {'country': des, 'type': type, 'length': length, 'region': region};
                    var url2 = $.param( pr );
                     history.pushState('', '', window.location.pathname + '?' + url2);   
                      url = '/amica-fr/get-number-prog';
                      url_1 = window.location.pathname;
                      url = url + '?'+url2;
                      url_1 = url_1 + '?'+url2;
               }
                if(formfilterexclusive){
                   pr = {'country': des, 'type': type, 'region': region};
                    var url2 = $.param( pr );
                     history.pushState('', '', window.location.pathname + '?' + url2);   
                      url = '/amica-fr/get-number-excl';
                      url_1 = window.location.pathname;
                      url = url + '?'+url2;
                      url_1 = url_1 + '?'+url2;
               }
            
               
                
           // if(window.location.pathname === '/voyage/itineraire' || window.location.pathname === '/vietnam/itineraire' || window.location.pathname === '/laos/itineraire' || window.location.pathname === '/cambodge/itineraire' || window.location.pathname === '/birmanie/itineraire'){
            if( issetsformsearchpageexclusive === 'search-page'){
                url_fix = '/voyage/itineraire';
                url_fix = url_fix + '?'+url2;
                updateMetasFix(target, url_fix);
            }else{
                if(window.location.pathname === '/' + uri){
                    updateMetas(target, url_1);
                }else{
                   searchCountryHome(target, url);  
                }
            }
            
});
$(document).on('click', '#search-page-voyage .cs-select.submit',function(){
    
    var hClassDisable = $(this).hasClass('disable');
    if(hClassDisable){
        return false;
    }
    
    $(this).toggleClass('selected');
         var target = $(this);
         var index = $(this).index();
         var des = pr = url = '';
         //if(!des) des = 'vietnam';
         var i = 0;
         $('#search-page-voyage .ui-content ul.destination li.selected').each(function(index){
             des += $(this).data('value');
             if(index != $('#search-page-voyage .ui-content ul.destination li.selected').length -1){
               des += '-';
             }
             i++;
         });
         if(!des) des= 'all';
         //if(!des || i ==4) des= 'all';
         var type = '';
         $('#search-page-voyage .ui-content ul.voyage li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-page-voyage .ui-content ul.voyage li.selected').length -1){
               type += '-';
             }
         });
         if(!type) type= 'all';
         var length = '';
         var i = 0;
           $('#search-page-voyage .ui-content ul.tour-length li.selected').each(function(index){
               length += $(this).data('value');
               if(index != $('#search-page-voyage .ui-content ul.tour-length li.selected').length -1)
               {
                   length += '-';
               }
               i++;
           })
           if(!length || i ==3) length= 'all';
               
               var region = '';
            var i = 0;
           $('#search-page-voyage .ui-content ul.tour-region li.selected').each(function(index){
               region += $(this).data('value');
               if(index != $('#search-page-voyage .ui-content ul.tour-region li.selected').length -1)
               {
                   region += '-';
               }
               i++;
           })
           if(!region || i == 6) region= 'all';

               var switchlink = $('#search-page-voyage .ui-content li.filter_type_active').hasClass('selected');
               
               var formfiltervoyage = $(this).parent().parent().hasClass('form-filter-voyage');
               var formfilterexclusive = $(this).parent().parent().hasClass('form-filter-exclusive');
               
                url = window.location.pathname;
                if(formfiltervoyage){
                   pr = {'country': des, 'type': type, 'length': length, 'region' : region};
                   if(switchlink){
                       url = '/voyage/itineraire';
                   }
               }
                if(formfilterexclusive){
                   pr = {'country': des, 'type': type, 'region' : region};
                    if(switchlink){
                       url = '/formules/itineraire';
                   }
               }
               var url2 = $.param( pr );
               if($('#search-page-voyage .destination li.selected').length == 1){
                    window.location = '/'+$('#search-page-voyage .destination li.selected').data('value')+'/itineraire?'+url2;
                    return false;
                }
               //if(window.location.pathname  == '/') url = '/voyage/itineraire'
                 
                 url = url + '?'+url2;
                 if(window.location.pathname === '/voyage' || window.location.pathname === '/formules'){
                     window.location = window.location.pathname+'/itineraire?'+url2;
                 }else{
                 window.location = '/voyage/itineraire?'+url2;
                }
});



$(window).bind('load',function(){
   if($('#search-page .ui-content ul li.selected').length){
            $('#search-page .area-reset-filter').addClass('active');
            $('#search-page').css({'padding-top' : '8rem'});
        } else {
            $('#search-page .area-reset-filter').removeClass('active');
            $('#search-page').css({'padding-top' : '4rem'});
        }
});    
$(document).on('click', '#search-page .ui-content ul li',function(){
        var hClass = $(this).hasClass('selected');
        if(hClass){
            $(this).removeClass('selected');
        }else{
            $(this).addClass('selected');
        }
       // $(this).toggleClass('selected');
        if($('#search-page .ui-content ul li.selected').length){
            $('#search-page .area-reset-filter').addClass('active');
            $('#search-page').css({'padding-top' : '8rem'});
        } else {
            $('#search-page .area-reset-filter').removeClass('active');
            $('#search-page').css({'padding-top' : '4rem'});
        }
        
        var uri = $('.updatefilter-exclusive').data('url');    
        
         var target = $(this);
         var index = $(this).index();
         var des = pr = url = '';
         var i = 0;
         $('#search-page .ui-content ul.destination li.selected').each(function(index){
             des += $(this).data('value');
             if(index != $('#search-page .ui-content ul.destination li.selected').length -1){
               des += '-';
             }
             i++;
         });
         if(!des) des = 'all';
         //if(!des || i ==4) des= 'all';
         var type = '';
         $('#search-page .ui-content ul.voyage li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-page .ui-content ul.voyage li.selected').length -1){
               type += '-';
             }
         });
         if(!type) type= 'all';
         var length = '';
         var i = 0;
           $('#search-page .ui-content ul.tour-length li.selected').each(function(index){
               length += $(this).data('value');
               if(index != $('#search-page .ui-content ul.tour-length li.selected').length -1)
               {
                   length += '-';
               }
               i++;
           })
           if(!length || i ==3) length= 'all';
            
            var region = '';
         var i = 0;
           $('#search-page .ui-content ul.tour-region li.selected').each(function(index){
               region += $(this).data('value');
               if(index != $('#search-page .ui-content ul.tour-region li.selected').length -1)
               {
                   region += '-';
               }
               i++;
           })
           if(!region || i ==6) region= 'all';
            
               var formfiltervoyage = $(this).parent().parent().hasClass('form-filter-voyage');
               var formfilterexclusive = $(this).parent().parent().hasClass('form-filter-exclusive');
               if(formfiltervoyage){
                   pr = {'country': des, 'type': type, 'length': length};
                    var url2 = $.param( pr );
                      url = '/amica-fr/get-number-prog';
                     // url = window.location.pathname;
                      url = url + '?'+url2;
               }
                if(formfilterexclusive){
                   pr = {'country': des, 'type': type, 'region': region};
                    var url2 = $.param( pr );
                     history.pushState('', '', window.location.pathname + '?' + url2);   
                      url = '/amica-fr/get-number-excl';
                      url_1 = window.location.pathname;
                      url = url + '?'+url2;
                      url_1 = url_1 + '?'+url2;
               }
            
               
                 
               //  if(window.location.pathname === '/formules/itineraire' || window.location.pathname === '/vietnam/formules' || window.location.pathname === '/laos/formules' || window.location.pathname === '/cambodge/formules' || window.location.pathname === '/birmanie/formules'){
                if(window.location.pathname === '/' + uri){
                    updateMetasExclusive(target, url_1);
                }else{
                    searchCountryHome(target, url);
                }
});
$(document).on('click', '#search-page .cs-select.submit',function(){
    
    var hClassDisable = $(this).hasClass('disable');
    if(hClassDisable){
        return false;
    }
    
    $(this).toggleClass('selected');
         var target = $(this);
         var index = $(this).index();
         var des = pr = url = '';
         //if(!des) des = 'vietnam';
         var i = 0;
         $('#search-page .ui-content ul.destination li.selected').each(function(index){
             des += $(this).data('value');
             if(index != $('#search-page .ui-content ul.destination li.selected').length -1){
               des += '-';
             }
             i++;
         });
         if(!des) des= 'all';
         //if(!des || i ==4) des= 'all';
         var type = '';
         $('#search-page .ui-content ul.voyage li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-page .ui-content ul.voyage li.selected').length -1){
               type += '-';
             }
         });
         if(!type) type= 'all';
         var length = '';
         var i = 0;
           $('#search-page .ui-content ul.tour-length li.selected').each(function(index){
               length += $(this).data('value');
               if(index != $('#search-page .ui-content ul.tour-length li.selected').length -1)
               {
                   length += '-';
               }
               i++;
           })
           if(!length || i ==3) length= 'all';
            
            var region = '';
         var i = 0;
           $('#search-page .ui-content ul.tour-region li.selected').each(function(index){
               region += $(this).data('value');
               if(index != $('#search-page .ui-content ul.tour-region li.selected').length -1)
               {
                   region += '-';
               }
               i++;
           })
           if(!region || i ==6) region= 'all';
    
               var switchlink = $('#search-page .ui-content li.filter_type_active').hasClass('selected');
               
               var formfiltervoyage = $(this).parent().parent().hasClass('form-filter-voyage');
               var formfilterexclusive = $(this).parent().parent().hasClass('form-filter-exclusive');
               
                url = window.location.pathname;
                if(formfiltervoyage){
                   pr = {'country': des, 'type': type, 'length': length};
                   if(switchlink){
                       url = '/voyage/itineraire';
                   }
               }
                if(formfilterexclusive){
                   pr = {'country': des, 'type': type, 'region': region};
                    if(switchlink){
                       url = '/formules/itineraire';
                   }
               }
               var url2 = $.param( pr );
               if($('#search-page .destination li.selected').length == 1){
                    window.location = '/'+$('#search-page .destination li.selected').data('value')+'/formules?'+url2;
                    return false;
                }
                if($('#search-page .destination li.selected').length > 1){
                    window.location = '/formules/itineraire?'+url2;
                    return false;
                }
               if(window.location.pathname  == '/') url = '/voyage/itineraire'
                 
                 url = url + '?'+url2;
                 if(window.location.pathname === '/voyage' || window.location.pathname === '/formules'){
                     window.location = window.location.pathname+'/itineraire?'+url2;
                 }else{
                 window.location = url;
                }
});


$('#search-testi .ui-content ul li').on('click',function(){
    console.log('ok');
        var hClass = $(this).hasClass('selected');
        if(!hClass){
            $(this).addClass('selected');
        }else{
            $(this).removeClass('selected');
        }
       // $(this).toggleClass('selected');
        if($('#search-testi .ui-content ul li.selected').length){
            $('#search-testi .area-reset-filter').addClass('active');
            $('#search-testi').css({'padding-top' : '8rem'});
        } else {
            $('#search-testi .area-reset-filter').removeClass('active');
            $('#search-testi').css({'padding-top' : '4rem'});
        }
         var target = $(this);
         var index = $(this).index();
         var des = pr = url = '';
         //if(!des) des = 'vietnam';
         var i = 0;
         $('#search-testi .ui-content ul.destination li.selected').each(function(index){
             des += $(this).data('value');
             if(index != $('#search-page .ui-content ul.destination li.selected').length -1){
               des += '-';
             }
             i++;
         });
         if(!des) des= 'all';
         //if(!des || i ==4) des= 'all';
         var type = '';
         $('#search-testi .ui-content ul.type li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-testi .ui-content ul.voyage li.selected').length -1){
               type += ',';
             }
         });
         if(!type) type= 'all';
         var theme = '';
         $('#search-testi .ui-content ul.theme li.selected').each(function(index){
             theme += $(this).data('value');
             if(index != $('#search-testi .ui-content ul.theme li.selected').length -1){
               theme += ',';
             }
         });
        
         
               var formfiltertesti = $(this).parent().parent().hasClass('form-filter-testi');
              
               if(formfiltertesti){
                    var pr = {'country': des, 'type': type, 'theme': theme};
                    var url2 = $.param( pr );
                    history.pushState('', '', window.location.pathname + '?' + url2);   
                      url = '/amica-fr/get-number-testi';
                      url_1 = window.location.pathname;
                      url = url + '?'+url2;
                      url_1 = url_1 + '?'+url2;
               }
            
               
                 searchTesti(target, url);
            
                 updateMetas(target, url_1);
                  
});
$('#search-testi .cs-select.submit').off().on('click',function(){
    $(this).toggleClass('selected');
         var target = $(this);
         var index = $(this).index();
          var des = pr = url = '';
         //if(!des) des = 'vietnam';
         var i = 0;
         $('#search-testi .ui-content ul.destination li.selected').each(function(index){
             des += $(this).data('value');
             if(index != $('#search-page .ui-content ul.destination li.selected').length -1){
               des += '-';
             }
             i++;
         });
         if(!des) des= 'all';
         //if(!des || i ==4) des= 'all';
         var type = '';
         $('#search-testi .ui-content ul.type li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-testi .ui-content ul.voyage li.selected').length -1){
               type += ',';
             }
         });
         if(!type) type= 'all';
         var theme = '';
         $('#search-testi .ui-content ul.theme li.selected').each(function(index){
             theme += $(this).data('value');
             if(index != $('#search-testi .ui-content ul.theme li.selected').length -1){
               theme += ',';
             }
         });
         var pr = {'country': des, 'type': type, 'theme': theme};
               
              var url2 = $.param( pr );
                 
                 url = '/temoignages/recherche?' +url2;
                 window.location = url;
});

// Fixed Menu
        
 
$(window).bind('load',function(){
var iScrollPos = 0;
var positionMenu = $('.custom-header').position();
var positionbtn_filter = $('.custom-btn-filter').position();
var iScrollPosbtn_filter = 0;

//$(document).on('scrollstart', function(event) {
  
  $(document).on('scroll', function(event) {
    
    if ($(document).scrollTop() > positionMenu.top) {
        var iCurScrollPos = $(document).scrollTop();

        if (iCurScrollPos > iScrollPos) {
           
            
            $('.custom-header').removeClass('header-fixed-top');
          //  $('.fix-space-9-3rem').removeClass('active');
         //   $('.fix-height').removeClass('active');
         //   $('.fix-space-9-3rem').attr('style','');
        } else {
          //   console.log(iScrollPos);
          // $('.custom-header').addClass('header-fixed-top');
           // $('#search-page .fix-space-9-3rem').css({'height':$('#search-page .custom-header').outerHeight()});
          //  $('#search-page-voyage .fix-space-9-3rem').css({'height':$('#search-page-voyage .custom-header').outerHeight()});
            $('.custom-header').addClass('header-fixed-top');
            $('#search-page-voyage .custom-header').parent().css({'height':$('#search-page-voyage .custom-header').outerHeight()});
            $('#search-page .custom-header').parent().css({'height':$('#search-page .custom-header').outerHeight()});
            //$('.fix-space-9-3rem').addClass('active');
            

         //   $('.fix-height').addClass('active');
        }
        iScrollPos = iCurScrollPos;
        

    } else {
        
        $('.custom-header').removeClass('header-fixed-top');
            $('#search-page-voyage .custom-header').parent().css({'height':'auto'});
            $('#search-page .custom-header').parent().css({'height':'auto'});
       // $('.fix-space-9-3rem').removeClass('active');
      //  $('#search-page-voyage .fix-space-9-3rem').attr('style','');
     //   $('#search-page .fix-space-9-3rem').attr('style','');
       // $('.fix-height').removeClass('active');
    }
    
    //***//
    if(positionbtn_filter != undefined){
        if ($(document).scrollTop() > positionbtn_filter.top + 47) {
            var iCurScrollPos_btn_filter = $(document).scrollTop();

            if (iCurScrollPos_btn_filter > iScrollPosbtn_filter) {

    //            $(".custom-btn-filter").addClass("btn-filter-fixed-bottom").delay(100).queue(function(next){
    //                $(this).addClass("active");
    //                next();
    //            });
                $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
                //window.setTimeout(function(){$(".custom-btn-filter").addClass("active");}, 0.1);
                $('.custom-btn-filter').addClass('active');
                $('.fix-space-4-7rem').addClass('active');

    //            $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
    //            
    //            $('.custom-btn-filter').addClass('active').delay(500);

           // } else {
    //             $(".custom-btn-filter").addClass("btn-filter-fixed-bottom").delay(100).queue(function(next){
    //                $(this).addClass("active");
    //                next();
    //            });
    //            $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
    //            //window.setTimeout(function(){$(".custom-btn-filter").addClass("active");}, 0.1);
    //            $('.custom-btn-filter').addClass('active');
    //            $('.fix-space-4-7rem').addClass('active');
    //            $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
    //          $('.custom-btn-filter').addClass('active').delay(500);
            }
            iScrollPosbtn_filter = iCurScrollPos_btn_filter;


        } else {
            $('.fix-space-4-7rem').removeClass('active');
           $('.custom-btn-filter').removeClass('btn-filter-fixed-bottom');
           $('.custom-btn-filter').removeClass('active');
        }
    }
    
  });
//});
});
// End Fixed Menu


//$(window).bind('load',function(){
//    var iScrollPos_filter = 0;
//var positionMenu_filter = $('.custom-btn-filter').position();
//
////$(document).on('scrollstart', function(event) {
//  
//  $(document).on('scroll', function(event) {
//    
//    if ($(document).scrollTop() > positionMenu_filter.top) {
//        var iCurScrollPos_filter = $(document).scrollTop();
//
//        if (iCurScrollPos_filter > iScrollPos_filter) {
//           
//            
//            $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
//       
//
//        } else {
//          
//            $('.custom-btn-filter').addClass('btn-filter-fixed-bottom');
//
//       
//        }
//        iScrollPos_filter = iCurScrollPos_filter;
//        
//
//    } else {
//        
//        $('.custom-btn-filter').removeClass('btn-filter-fixed-bottom');
//       
//    }
//  });
////});
//});

$(window).bind('load',function(){
      var hClass = $('#focus-totalcount').hasClass('focus-totalcount');  
      var fixtop = $('#focus-totalcount').data('top') + 15;
        if(hClass){
        
           $("html, body").delay(1000).animate({scrollTop: $('#focus-totalcount').offset().top - fixtop }, 0);
        }
   });
   
   
$('#search-page .reset-filter').click(function(){
  $(this).parent().removeClass('active');  
  var pr = $(this).data('get');
  var url_1 = window.location.pathname;
                     
    url_1 = url_1 + '?' + pr;
  $('#search-page').css({'padding-top' : '4rem'});
  $('#search-page .ui-content ul li').removeClass('selected');
  history.pushState('', '', url_1);  
   updateMetasExclusive($('#search-page .ui-content ul li'), url_1);
 // searchCountryHome($('#search-page .ui-content ul li'), pr);
  // updateMetas($('#search-page .ui-content ul li'), url_1);
});
$('#search-page-voyage .reset-filter').click(function(){
  $(this).parent().removeClass('active');  
  var pr = $(this).data('get');
  var url_1 = window.location.pathname;
                     
    url_1 = url_1 + '?' + pr;
  var issetsformsearchpageexclusive = $('#search-page').data('url');  
  $('#search-page-voyage').css({'padding-top' : '4rem'});
  $('#search-page-voyage .ui-content ul li').removeClass('selected');
  //searchCountryHome($('#search-page-voyage .ui-content ul li'), pr);
  history.pushState('', '', url_1);   
  if( issetsformsearchpageexclusive === 'search-page'){
               var url_fix = '/voyage/itineraire';
                url_fix = url_fix + '?'+ pr;
        updateMetasFix($('#search-page-voyage .ui-content ul li'), url_fix);
    }else{
       
       updateMetas($('#search-page-voyage .ui-content ul li'), url_1);
        
    }
});   