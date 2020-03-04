// Auto height left right submenu
//    $(window).bind('load',function() {
//        $('.mn-panel-2 .col-left').css("height",$('.mn-panel-2').outerHeight());
//    });
// End auto        



// Slider Main        
   $(window).bind('load', function(){
      $('.carousel').carousel({
        interval: 4000, //changes the speed
        pause: false,
    });
   });
$('.slider-menu-icon .items').hover(function(){
         $('#myCarousel').carousel($(this).index());
   })

    $('.slide-main-1').carousel({
        interval: 5000, //changes the speed
        pause: false,
    });
     $('.slide-page-country').carousel({
        interval: 5600, //changes the speed
        
    });
// End Slider Main    
// Bxslider page Explorateurs
//$(document).ready(function(){

//       $('#slidertwo').bxSlider({
//            slideWidth: 205,
//            minSlides: 1,
//            maxSlides: 3,
//            moveSlides: 1,
//            slideMargin: 50,
//            responsive: true,
//            nextText: 'Next',
//            prevText: 'Prev',
//            randomStart: false,
//
//            auto: false,
//
//            speed: 1000,
//
//
//        });




//   $('#sliderone').bxSlider({
//            slideWidth: 271,
//            minSlides: 1,
//            maxSlides: 3,
//			 moveSlides: 1,
//            slideMargin: 20,
//
//            responsive: true,
//            nextText: 'Next',
//            prevText: 'Prev',
//            randomStart: false,
//            infiniteLoop: false,
//            auto: false,
//
//            speed: 1000,
//			onSliderLoad: function(currIndex){
//
//                 var el = $(".slider-2 .slide:nth-child(" + (currIndex + 1) + ")");
//
//               el.css('width','348px');
//               var cha = el.parent().parent().parent();
//               cha.css({'max-width':'990px'});
//
//            },
//       });

//});

//END bxslider Explorateurs    
// Jquery LazyLoad Image

  $(function() {
      $("body").on("contextmenu", "img", function(e) {
        return false;
    });
//        $('.img-lazy').lazy({
//            scrollDirection: 'vertical',
//            effect: 'fadeIn',
//            effectTime: 1000,
//            visibleOnly: true,
//            onError: function(element) {
//                console.log('error loading ' + element.data('src'));
//            }
//
//        });
        if (window.location.search.indexOf('view=all') > -1) {
            $('.pagination li').removeClass('active');
        }

    });

// End LazyLoad Image        

// Jquery LazyLoad Background Image

    var ll = $('div.lazy-background');
    var lh = []
    var wscroll = 0;
    var wh = $(window).height();

    function update_offsets(){
      $('div.lazy-background').each(function(){
        var x = $(this).offset().top;
        lh.push(x);
      });
    };

    function lazy() {
      var wscroll = $(window).scrollTop();
      for(i = 0; i < lh.length; i++){
        if(lh[i] <= wscroll + (wh)){
          $('div.lazy-background').eq(i).addClass('loaded');
        };
      };
    };

    // Page Load
    update_offsets();
    lazy();

    $(window).on('scroll',function(){
      lazy();
    });

// End JqueryLoad Background Image        


    $('.btn-menu').click('toggle',function(){
        $(this).toggleClass('active');
        $('.list-menu').slideToggle();
   });

// Jquey Menu Hover Main
        var delay = 400, setTimeoutConst,
            delay2 = 200, setTimeoutConst2;
//        $('.group-btn a').mouseenter(function(){
//            
//            var hClass = $('.ajax-result-menu').hasClass('ajax-loaded');
//            if(!hClass){
//                $.ajax({
//                    type: 'post',
//                    url: '/amica-fr/ajax-result-menu',
//                    data: {
//                        flag: 'ok'
//                    },
//                    dataType: 'html',
//                    success: function(data) {
//                        $('.ajax-result-menu').html(data);
//                        $('.ajax-result-menu').addClass('ajax-loaded');
//
//                    }
//
//                });
//            }
//            
//            var name = $(this).attr('data-name');
//            $('.mn-panel').css('animation-duration', '100ms');
//            $('.mn-panel').css('animation-delay', '0ms');
//            $(this).addClass('active');
//            var self = this;
//
//            setTimeoutConst = setTimeout(function(){
//                $(self).addClass('active');
//                $('#group-sub-mn').show();
//                $('#' + name).addClass('show-mn');
//                $('#' + name).show();
//            },delay);
//        }).mouseleave(function(){
//            $(this).removeClass('active');
//            $('.group-btn a').removeClass('active');
//            $('.mn-panel').hide();
//            $('.mn-panel').removeClass('show-mn');
//            clearTimeout(setTimeoutConst );
//            setTimeoutConst2 = setTimeout(function(){
//                // $('.group-btn a').removeClass('active');
//                // $('.mn-panel').hide();
//                // $('.mn-panel').removeClass('show-mn');
//            },delay2);
//        });
          
        $(document).on({
            mouseenter: function () {
                //stuff to do on mouse enter
               // $('.ajax-result-menu').show();
                var hClass = $('.ajax-result-menu').hasClass('ajax-loaded');
                var name = $(this).attr('data-name');
                $(this).addClass('active');
                if(!hClass){
                    $('.ajax-result-menu').addClass('ajax-loaded');
                    $.ajax({
                        type: 'post',
                        url: '/amica-fr/ajax-result-menu',
                        data: {
                            flag: 'ok'
                        },
                        dataType: 'html',
                        success: function(data) {
                            $('.ajax-result-menu').html(data);
                            $('.ajax-result-menu').addClass('ajax-loaded');
                            //var name = $(this).attr('data-name');
                            $('.mn-panel').css('animation-duration', '100ms');
                            $('.mn-panel').css('animation-delay', '0ms');
                            //$(this).addClass('active');
                            var self = this;
                            $(self).addClass('active');
                                $('#group-sub-mn').show();
                                $('#' + name).addClass('show-mn');
                                $('#' + name).show();
//                            setTimeoutConst = setTimeout(function(){
//                                $(self).addClass('active');
//                                $('#group-sub-mn').show();
//                                $('#' + name).addClass('show-mn');
//                                $('#' + name).show();
//                            },200);
                        }

                    });
                }else{
                  //   $('.mn-panel').hide();
                  //   $('.mn-panel').removeClass('show-mn');
                    var name = $(this).attr('data-name');
                    $('.mn-panel').css('animation-duration', '100ms');
                    $('.mn-panel').css('animation-delay', '0ms');
                    //$(this).addClass('active');
                    var self = this;

                    setTimeoutConst = setTimeout(function(){
                        $(self).addClass('active');
                        $('#group-sub-mn').show();
                        $('#' + name).addClass('show-mn');
                        $('#' + name).show();
                    },delay);
                
                }
            },
            mouseleave: function () {
                //stuff to do on mouse leave
                //alert('ok');
                $(document).ajaxSuccess(function(event,request,settings){
                    if(settings.url == "/amica-fr/ajax-result-menu"){
                        $('.mn-panel').hide();
                        $('.mn-panel').removeClass('show-mn');
                    }
                });
                $(this).removeClass('active');
                $('.group-btn .btn-mn').removeClass('active');
                $('.mn-panel').hide();
                $('.mn-panel').removeClass('show-mn');
                clearTimeout(setTimeoutConst );
                setTimeoutConst2 = setTimeout(function(){
                    // $('.group-btn a').removeClass('active');
                    // $('.mn-panel').hide();
                    // $('.mn-panel').removeClass('show-mn');
                   // $('.ajax-result-menu').hide();
                },delay2);
            }
        }, ".group-btn .btn-mn"); //pass the element as an argument to .on
        
        $(document).on({
            mouseenter: function () {
                //stuff to do on mouse enter
                
                
                $(this).show();
                var id = $(this).attr('id');  
                $('.group-btn > li > .btn-mn.' + id).addClass('active');
                $('.mn-panel').removeClass('show-mn');
                $(this).addClass('active');
            },
            mouseleave: function () {
                //stuff to do on mouse leave
                $(this).removeClass('active');
                //$(this).hide();
                $('.mn-panel').hide();
                $('.group-btn > li > .btn-mn').removeClass('active');
            }
        }, ".mn-panel"); //pass the element as an argument to .on
        
//        $('.mn-panel').hover(
//            function() {
//                $(this).show();
//                var id = $(this).attr('id');
//                $('.group-btn > li > a.' + id).addClass('active');
//                $('.mn-panel').removeClass('show-mn');
//                $(this).addClass('active');
//            },
//            function() {
//                $(this).removeClass('active');
//               //$(this).hide();
//               $('.mn-panel').hide();
//               $('.group-btn > li > a').removeClass('active');
//            }
//        );
// End Hover Menu

// Jquery Fixed Menu 
        var scroll_menu_tab = document.getElementsByClassName("scroll-menu-tab");
        var scroll_button_bottom_tablet = document.getElementsByClassName("btn-only-tablet-bottom-fixed");
        var iScrollPos = 0;
       
        var positionMenu = $('.fix-scroll-menu').position();
        if(scroll_menu_tab.length === 1){
             var iScrollPoss = 0;   
             var positionMenuTabDestination = $('.scroll-menu-tab').position();
        }
        
        if(scroll_button_bottom_tablet.length === 1){
             var iScrollForButtonTablet = 0;   
             var positionButtonForTablet = $('.target-scroll-for-tablet').position();
             var target_scroll_for_tablet = document.getElementsByClassName("target-scroll-for-tablet");
        }
        
        $(window).scroll(function () {
            
            var target = $(this);
            if(document.getElementsByClassName("fix-scroll-menu").length === 1){
                if ($(this).scrollTop() > positionMenu.top) {
                    var iCurScrollPos = $(this).scrollTop();
                    if (iCurScrollPos >= iScrollPos) {
                         $('.area-btn-list-menu').addClass('opacity');
                        $('.area-btn-list-menu').addClass('fixed');
                        $('.text-sologan').addClass('fix-margin-bottom');
                        $('.container-1 .row-1').hide();
                    } else {
                        $('.area-btn-list-menu').addClass('opacity');
                        $('.area-btn-list-menu').addClass('fixed');

                        $('.text-sologan').addClass('fix-margin-bottom');
                        $('.container-1 .row-1').show();

                    }
                    iScrollPos = iCurScrollPos;
                } else if($(this).scrollTop() <= positionMenu.top){
                    $('.area-btn-list-menu').removeClass('opacity');
                    $('.area-btn-list-menu').removeClass('fixed');
                    $('.text-sologan').removeClass('fix-margin-bottom');
                    iScrollPos = 0;

                }
            }
            if(scroll_menu_tab.length === 1){
                
                
                if (target.scrollTop() > positionMenuTabDestination.top) {
                    var iCurScrollPoss = target.scrollTop();
                    if (iCurScrollPoss >= iScrollPoss) {
                        $('.scroll-menu-tab').addClass('opacity');
                        $('.scroll-menu-tab').addClass('fix-scroll-menu-tab');

                    } else {
                        $('.scroll-menu-tab').addClass('opacity');
                    //  $('.scroll-menu-tab').addClass('fix-scroll-menu-tab');
                        $('.area-btn-list-menu, .nav-fixed-responsive').removeClass('fixed');

                    }
                    iScrollPoss = iCurScrollPoss;

                } else{
                    $('.area-btn-list-menu, .nav-fixed-responsive').removeClass('opacity');
                    $('.area-btn-list-menu, .nav-fixed-responsive').removeClass('fixed');
                    $('.scroll-menu-tab').removeClass('opacity');
                  $('.scroll-menu-tab').removeClass('fix-scroll-menu-tab');

                }
            }
            
            if(scroll_button_bottom_tablet.length === 1 && target_scroll_for_tablet.length === 1){
               
                 if (target.scrollTop() > $('.target-scroll-for-tablet').offset().top + 50) {
                    $('.btn-only-tablet-bottom-fixed').addClass('active');

                } else{
                   
                   $('.btn-only-tablet-bottom-fixed').removeClass('active');
                }
                 
            }


    });

// End Fixed Menu

// Jquery Hover LazyLoad Image 4 button on Slider Main
   $('.group-menu .items').mouseover(function() {
        var src = $(this).children().children().attr('data-src');
       $(this).children().children('.lazy-img').attr('src', src);

  });
//end

// click form search
// Fix JS Click Filter 17-07-17     

//    $('.cs-select .cs-placeholder').click('toggle',function(){
//        $('.cs-select').removeClass('active');
//        $('.cs-select .cs-options').hide();
//        $(this).parent().toggleClass('active');
//        $(this).parent().children('.cs-options').toggle();
//        $(this).parent().children('.cs-options').toggleClass('cs-options-active');
//    });

$('.cs-select .cs-placeholder').click(function(){
		var hClass = $(this).parent().hasClass('active');
		 $('.cs-select').removeClass('active');
		 $('.cs-select .cs-options').removeClass('cs-options-active');
		if(hClass){
			$(this).parent().removeClass('active');
			$(this).parent().children('.cs-options').removeClass('cs-options-active');
		}else{
			$(this).parent().addClass('active');
			$(this).parent().children('.cs-options').addClass('cs-options-active');
		}


});
// End JS    

// Js Fix Height Item Tour two column

function fixHeightColumnsItems(){
//    $('.clear-fix').each(function(index) {
//        var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
//        var subttleft = $(this).children('.it-l').children('a').children('.sub-tt').outerHeight();
//
//        var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
//        var subttright = $(this).children('.it-r').children('a').children('.sub-tt').outerHeight();
//        if (htleft > htright){
//            $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
//        }
//        if (htright > htleft){
//            $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
//        }
//
//                         if (subttleft > subttright){
//            $(this).children('.it-r').children('a').children('.sub-tt').css('min-height', subttleft);
//        }
//        if (subttright > subttleft){
//            $(this).children('.it-l').children('a').children('.sub-tt').css('min-height', subttright);
//        }
//
//
//        // fix height summary
//
//        var summaryleft = $(this).children('.it-l').children('.summary').outerHeight();
//        var summaryright = $(this).children('.it-r').children('.summary').outerHeight();
//
//        if (summaryleft > summaryright){
//            $(this).children('.it-r').children('.summary').css('min-height', summaryleft);
//        }
//         if (summaryright > summaryleft){
//            $(this).children('.it-l').children('.summary').css('min-height', summaryright);
//        }
//  });
}
$(window).bind("load", function() { 
       fixHeightColumnsItems(); 
});
// End Js            

    function searchExcl(target, url){
        var parent = target.closest('form');
       $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $.get(url, function(data){
            
            if(window.location.pathname != '/formules'){
                
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

                $('head').append(metadescription);
                $('head').append(title);
                $('head').append(metarobotupdate);
                $('head').append(canonicalupdate);
                $('head').append(linkprev);
                $('head').append(linknext);
                $('head').append(propertyog);
                
                var datanew = $($.parseHTML(data)).find(".getcontent"); 
                $('.ajaxfilter').html(datanew);

                
                var datanumber = $($.parseHTML(data)).find(".getnumber"); 
                $('.filter-number').html(datanumber);
                
                var votreselection = $($.parseHTML(data)).find(".votre-selection"); 
                $('.area-votre-selection').html(votreselection);
                
                //$('.nb').load(window.location.pathname + '?country=vietnam&type=all&length=all .nb');
                var totaltour = $($.parseHTML(data)).find(".getcount-tour .gettext"); 
                $('.getcount-tour').html(totaltour);
                var restotaltour = $($.parseHTML(data)).find(".responsive-result span"); 
                $('.responsive-result').html(restotaltour);
                //  xu ly an hien ket qua filter
                var hCla = $('.cs-options ul li').hasClass('active');
                if(hCla){
                    
                    $('.remove-result-filter').addClass('active');
                    //$('.text-auto').addClass('active');
                }else{
                    $('.remove-result-filter').removeClass('active');
                    
                }
                // end
                
                
//                $('.img-lazy').lazy({
//                        scrollDirection: 'vertical',
//                        effect: 'fadeIn',
//                        effectTime: 1000,
//                        visibleOnly: true,
//                        onError: function(element) {
//                            console.log('error loading ' + element.data('src'));
//                        }
//
//                    });
                fixHeightColumnsItems();  
                
            }else{
                var ext = data > 1 ? 's' : ''; 
                            var firsttext = data > 0 ? 'Afficher ' : '';
                if(data==0){
                  parent.find('.submit').addClass('disable');
                } else{
                  parent.find('.submit').removeClass('disable');
                  if(data < 10 && data > 0) data = '0' + data;
                }
                if(parent.hasClass('horizontal') || parent.hasClass('vertical')){
                    //parent.find('.submit').text(data+' formule'+ext);
                                     parent.find('.submit').text(firsttext+data+' résultat'+ext);
                  } 
                 parent.find('#count-tour-search').text(data);
            }
        })
    }
    
    
    function searchTesti(target, url){
        var parent = target.closest('form');
        $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $.get(url, function(data){          
//            var ext = data > 1 ? 's' : '';
//            if(data==0){
//              parent.find('.submit').addClass('disable');
//            } else{
//              parent.find('.submit').removeClass('disable');
//              if(data < 10 && data > 0) data = '0' + data;
//            }
//            if(parent.hasClass('horizontal') || parent.hasClass('vertical')){
//                parent.find('.submit').text(data+' témoignage'+ext);
//              }

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

            $('head').append(metadescription);
            $('head').append(title);
            $('head').append(metarobotupdate);
            $('head').append(canonicalupdate);
            $('head').append(linkprev);
            $('head').append(linknext);
            $('head').append(propertyog);
            
            var datanumber = $($.parseHTML(data)).find(".gettotalnumbertesti .text");            
            $('.gettotalnumbertesti').html(datanumber[0]);
            
            var datanew = $($.parseHTML(data)).find(".getcontent"); 
            $('.ajaxfilter').html(datanew);
        })
    }

    function searchProg(target, url){
        var parent = target.closest('form');
         $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $.get(url, function(data){
            
           //if(window.location.pathname != '/voyage'){
            if(window.location.pathname !== '/voyage' && window.location.pathname !== '/vietnam' && window.location.pathname !== '/laos' && window.location.pathname !== '/cambodge' && window.location.pathname !== '/birmanie'){
                
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

                $('head').append(metadescription);
                $('head').append(title);
                $('head').append(metarobotupdate);
                $('head').append(canonicalupdate);
                $('head').append(linkprev);
                $('head').append(linknext);
                $('head').append(propertyog);
                
                var datanew = $($.parseHTML(data)).find(".getcontent"); 
                $('.ajaxfilter').html(datanew);

                
                var datanumber = $($.parseHTML(data)).find(".getnumber"); 
                $('.filter-number').html(datanumber);
                //$('.nb').load(window.location.pathname + '?country=vietnam&type=all&length=all .nb');
                
                var votreselection = $($.parseHTML(data)).find(".votre-selection"); 
                $('.area-votre-selection').html(votreselection);
                
                var totaltour = $($.parseHTML(data)).find(".getcount-tour .gettext"); 
                $('.getcount-tour').html(totaltour);
                
                var restotaltour = $($.parseHTML(data)).find(".responsive-result span"); 
                $('.responsive-result').html(restotaltour);
                
                //  xu ly an hien ket qua filter
                var hCla = $('.cs-options ul li').hasClass('active');
                if(hCla){
                    
                    $('.remove-result-filter').addClass('active');
                 //   $('.votre-selection').addClass('active');
                    //$('.text-auto').addClass('active');
                }else{
                    $('.remove-result-filter').removeClass('active');
                   // $('.votre-selection').removeClass('active');
                    
                }
                // end
                
               
//                $('.img-lazy').lazy({
//                        scrollDirection: 'vertical',
//                        effect: 'fadeIn',
//                        effectTime: 1000,
//                        visibleOnly: true,
//                        onError: function(element) {
//                            console.log('error loading ' + element.data('src'));
//                        }
//
//                    });               
                fixHeightColumnsItems();  
                
            }
                
                var submit_responsive = parent.find('.submit').hasClass('responsive-result');
                if(submit_responsive){
                    var restotaltour = $($.parseHTML(data)).find(".responsive-result span"); 
                    $('.responsive-result').html(restotaltour);
                }else{
                    
                    
                    var ext = data > 1 ? 's' : ''; 
                    var firsttext = data > 0 ? 'Afficher ' : '';
                    if(data==0){
                      parent.find('.submit').addClass('disable');
                    } else{
                      parent.find('.submit').removeClass('disable');
                      if(data < 10 && data > 0) data = '0' + data;
                    }
                    if(parent.hasClass('itineraire')){
                     parent.find('#count-prog-search').text(data);
                      parent.find('.submit').text(firsttext+data+' résultat'+ext);
                    } else {
                    //  parent.find('.submit').text(data+' Voyage'+ext);
                      parent.find('.submit').text(firsttext+data+' résultat'+ext);
                    }
                }
        })
    }

    function searchProgHome(target, url){
        var parent = target.closest('form');
        $.get(url, function(data){
            var ext = data > 1 ? 's' : '';
            if(data==0){
              parent.find('.submit').addClass('disable');
            } else{
              parent.find('.submit').removeClass('disable');
              if(data < 10 && data > 0) data = '0' + data;
            }
            parent.find('.submit').text('Afficher '+data+ ' résultat'+ext);
        })
    }


    // xu ly Ajax nut see-more
        $(document).on("click", ".ajax-see-more", function(event){    
           
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
           
            if(pr == ''){
                var data = 'see-more=' + seemore + '&data-page=' + page;
              //  var data = 'see-more=' + seemore;
                
                history.pushState('', '', window.location.pathname + '?page=' + page);
            }else{
                var data = pr + '&see-more=' + seemore + '&data-page=' + page;
               // var data = pr + '&see-more=' + seemore;
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
                    // $('meta[name=ROBOTS]').attr('content', 'NOINDEX, NOFOLLOW'); 
                  //  var metarobotupdate = $($.parseHTML(data)).filter('meta[name="ROBOTS"]').attr("content");
                  //  var canonicalupdate = $($.parseHTML(data)).filter('link[rel="canonical"]').attr("href");
                    //$('meta[name="ROBOTS"]').attr("content",metarobotupdate);
                    //$('link[rel="canonical"]').attr("href",canonicalupdate);
                    
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

                    $('head').append(metadescription);
                    $('head').append(title);
                    $('head').append(metarobotupdate);
                    $('head').append(canonicalupdate);
                    $('head').append(linkprev);
                    $('head').append(linknext);
                    $('head').append(propertyog);
                    
                    //console.log(metarobotupdate);
                    var datanew = $($.parseHTML(data)).find(".getcontent");
                   // console.log(datanew);
                    $('.ajaxfilter').html(datanew);
                    
//                    $('.img-lazy').lazy({
//                        scrollDirection: 'vertical',
//                        effect: 'fadeIn',
//                        effectTime: 1000,
//                        visibleOnly: true,
//                        onError: function(element) {
//                            console.log('error loading ' + element.data('src'));
//                        }
//                    });     
                        
                   
                    fixHeightColumnsItems();     
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

                    $('head').append(metadescription);
                    $('head').append(title);
                    $('head').append(metarobotupdate);
                    $('head').append(canonicalupdate);
                    $('head').append(linkprev);
                    $('head').append(linknext);
                    $('head').append(propertyog);    
                        
                        
                    var datanew = $($.parseHTML(data)).find(".clear-fix").addClass('mb-txt-40');
                    var btnajaxseemoreprev = $($.parseHTML(data)).find(".ajax-see-more-prev");
                    $('.see-more-prev').after(datanew);
                    $('.see-more-prev').html(btnajaxseemoreprev);
                    $( ".backgroundwhite" ).remove();
                    
//                    $('.img-lazy').lazy({
//                        scrollDirection: 'vertical',
//                        effect: 'fadeIn',
//                        effectTime: 1000,
//                        visibleOnly: true,
//                        onError: function(element) {
//                            console.log('error loading ' + element.data('src'));
//                        }
//                    });     
                    
                    var totalitemtour = $(document).find('.getcontent .item').length;    
                    var tourseen = $(document).find('.amc-nb-seen');
                    var tourtotal = $(document).find('.amc-nb-total');
                    
                    tourseen.text(totalitemtour);
                    $('.amc-progress div').css({'width' : (totalitemtour/tourtotal.data('value'))*100 + '%'});
                   
                   
                    fixHeightColumnsItems();     
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
                    
//                    var metarobotupdate = $($.parseHTML(data)).filter('meta[name="ROBOTS"]').attr("content");
//                    var canonicalupdate = $($.parseHTML(data)).filter('link[rel="canonical"]').attr("href");
//                    $('meta[name="ROBOTS"]').attr("content",metarobotupdate);
//                    $('link[rel="canonical"]').attr("href",canonicalupdate);

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

                    $('head').append(metadescription);
                    $('head').append(title);
                    $('head').append(metarobotupdate);
                    $('head').append(canonicalupdate);
                    $('head').append(linkprev);
                    $('head').append(linknext);    
                    $('head').append(propertyog);    
                        
                    
                    var datanew = $($.parseHTML(data)).find(".getcontent");
                    $('.ajaxfilter').html(datanew);

                     fixHeightColumnsItems();     
                },
                complete: function(data) {

                },
            }); 
        }
        
        
       
    });
   
//    $(document).on( "mouseenter", '.amc-ajax-order-by .amc-list-opt', function() {
//     
//    })
//    .on( "mouseleave", '.amc-ajax-order-by .amc-list-opt', function() {
//        $('.amc-ajax-order-by').removeClass('active');
//        $('.amc-text').removeClass('active');
//        $('.amc-list-opt').removeClass('active');
//    });

    
    // End Xu ly Ajax option Trier par
    
    
    // xu ly Ajax nut remove all result filter
        $(document).on("click", ".remove-result-filter", function(event){    
           
            var pr = $(this).data('get');
            var url = window.location.pathname + '?' + pr;
            history.pushState('', '', url);
               $.ajax({
                    type: "GET",
                    url: window.location.pathname,
                    data: pr,
                    beforeSend: function() {
                        $('.getcontent').append('<div class="backgroundwhite"></div>');
                        $('.getcontent').css({'position':'relative'});
                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                    },
                    success: function(data){
                       
                    var datanew = $($.parseHTML(data)).find(".getcontent");
                    $('.ajaxfilter').html(datanew);
                    
                    var datanumber = $($.parseHTML(data)).find(".getnumber"); 
                    $('.filter-number').html(datanumber);
                    
                    var totaltour = $($.parseHTML(data)).find(".getcount-tour .gettext"); 
                    $('.getcount-tour').html(totaltour);
                   
                    var votreselection = $($.parseHTML(data)).find(".votre-selection"); 
                    $('.area-votre-selection').html(votreselection);
                   
                    fixHeightColumnsItems();     
                    
                    $('.remove-result-filter').removeClass('active');
                    
                    },
                    complete: function(data) {
                       
                    },
               }); 
                  
        });
        
        // end remove all result filter

        $(document).on('click', '.un-select .un-option ul li .x-del',function(){
            var datavalue = $(this).parent().data('value');
          //  console.log(datavalue);
//            $(document).on('click', '.cs-options ul li',function(){
//               
//            });
          //  var target = $(this);
            $('.cs-options ul li.active[data-value="'+datavalue+'"]').trigger('click');
         
        });

        //$('.cs-options ul li').on('click',function(){
         $(document).on('click', '.cs-options ul li',function(){     
          //   console.log('ok');
            $('.cs-select.submit').removeClass('submited');  
          var target = $(this);
          target.toggleClass('active');
          var parent = target.closest('form');
          var index = $(this).index();
          $(this).closest('.cs-select').find('.list-option ul li:eq('+index+')').toggleClass('active');
          var des = pr = url = '';
          var desText = typeText = regionText = '';
          
          parent.find('.search-destination .list-option .active').each(function(index){
              des += $(this).data('value');
              desText += $(this).text();
              if(index != parent.find('.search-destination .list-option .active').length -1){
                  des += '-';
                  desText += ', ';
              }
                  
          })
          if(!des) des = 'all';
          var type = '';
          parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              typeText += $(this).text();
              if(index != parent.find('.search-type .list-option .active').length -1){
                type += '-';
                typeText += ', ';
              }
                  
          })
          if(!type) type = 'all';
          var region = '';
          parent.find('.search-region .list-option .active').each(function(index){
              region += $(this).data('value');
              regionText += $(this).text();
              if(index != parent.find('.search-region .list-option .active').length -1){
                region += '-';
                regionText += ', ';
              }
                  
          })
          if(!region) region = 'all';

          if($(this).closest('.search-excl-form-home').length){
              if(!desText) desText = 'Destination';
              $('.search-excl-form-home .search-destination .cs-placeholder').text(desText);
              if(!typeText) typeText = 'Votre envie';
              $('.search-excl-form-home .search-type .cs-placeholder').text(typeText);
              pr = {'country': des, 'type': type, 'region': region, 'length': 'all'};
              var url2 = $.param( pr );
              url = '/amica-fr/get-number-prog';
              url = url + '?'+url2;
              searchProgHome($(this), url);
              return false;
            }
            
            if($(this).closest('.search-excl-form').length){
                
             
            // end kiem tra filter dc lua chon truoc
                
              pr = {'country': des, 'type': type, 'region': region};
              var url2 = $.param( pr );
              
              // redirect về trang itineraire khi click vào lựa chọn tour type (only page tour)
                var hClass = $(this).hasClass('switch-link');
                if(hClass){
                    var hs = $('.switch-link').hasClass('active');
                    if(hs){
                        pr = {'country': des, 'type': type};
                        var url2 = $.param( pr );
                    }else{
                        pr = {'country': des, 'type': type};
                        var url2 = $.param( pr );
                    }
                    window.location.href = "/formules/itineraire?"+url2;

                }
                // end redirect
              
             // url = '/amica-fr/get-number-excl';
                if(window.location.pathname == '/formules'){
                     url = '/amica-fr/get-number-excl';
                }else{
                    // get URI
                    url = window.location.pathname;
                }
              url = url + '?'+url2;
              history.pushState('', '', window.location.pathname + '?' +url2);
              searchExcl($(this), url);
            }

            if($(this).closest('.search-testi-form').length){               
                var testiTarget = $(this);
              type = '';
              parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += ',';
              })
              if(!type){ type = 'all'; }
              
              var theme = themeText = '';
              parent.find('.search-theme .list-option .active').each(function(index){
                  theme += $(this).data('value');
                  themeText += $(this).text();
                  if(index != parent.find('.search-theme .list-option .active').length -1){
                      theme += ',';
                      themeText +=  ',';
                  }
              })
              if(!theme) theme = 'all';
              if(testiTarget.closest('.horizontal').length){
                    if(!desText) desText = 'Destination(s)';
                  testiTarget.closest('.horizontal').find('.search-destination .cs-placeholder .input-text').text(desText);
                  if(!typeText) typeText = 'Type de groupe';
                  testiTarget.closest('.horizontal').find('.search-type .cs-placeholder .input-text').text(typeText);
                  if(!themeText) themeText = 'Thématique du voyage';
                  testiTarget.closest('.horizontal').find('.search-theme .cs-placeholder .input-text').text(themeText);
              }
              

              pr = {'country': des, 'type': type, 'theme': theme};
              var url2 = $.param( pr );
             // url = '/amica-fr/get-number-testi';
             // url = url + '?'+url2;
              
              url = window.location.pathname + '?'+url2;
              history.pushState('', '', window.location.pathname + '?' +url2);
              
              searchTesti($(this), url);
              return false;
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
           // if(!length || i ==3){ length= 'all';}
            if(!length){ length= 'all';}
           
            
            pr = {'country': des, 'type': type, 'length': length, 'region': region};
            var url2 = $.param( pr );
            
            
            // redirect về trang itineraire khi click vào lựa chọn tour type (only page tour)
            var hClass = $(this).hasClass('switch-link');
            if(hClass){
                var hs = $('.switch-link').hasClass('active');
                if(hs){
                    pr = {'country': des, 'type': type, 'length': length, 'region': region};
                    var url2 = $.param( pr );
                }else{
                    pr = {'country': des, 'type': type, 'length': length, 'region': region};
                    var url2 = $.param( pr );
                }
                window.location.href = "/voyage/itineraire?"+url2;
              
            }
            // end redirect
            
            // redirect về trang voyage/balneaire-mer-cocotiers khi click vào lựa chọn destination va duree 
            // (chi 4 loai tour nay : voyage/plages-animees , voyage/plages-intimes, voyage/plages-locales, voyage/plages-sauvages)
            
            var hClass = $(this).hasClass('switch-link-special');
            if(hClass){
                var hs = $('.switch-link-special').hasClass('active');
                if(hs){
                    pr = {'country': des, 'type': type, 'length': length, 'region': region};
                    var url2 = $.param( pr );
                }else{
                    pr = {'country': des, 'type': type, 'length': length, 'region': region};
                    var url2 = $.param( pr );
                }
                window.location.href = "/voyage/balneaire-mer-cocotiers?"+url2+'#fix-scroll-switch-link';
              
            }
            
            // end redirect
            
            
            if(window.location.pathname == '/voyage' || window.location.pathname == '/vietnam' || window.location.pathname == '/laos' || window.location.pathname == '/cambodge' || window.location.pathname == '/birmanie'){
                url = '/amica-fr/get-number-prog';
            }else{
                // get URI
                url = window.location.pathname;
            }
           
           //   url = '/amica-fr/get-number-prog';
             // url = '/amica-fr/idees-de-voyage-type';  
             
              url = url + '?'+url2;
              history.pushState('', '', window.location.pathname + '?' +url2);
              searchProg($(this), url);
            }
        });
		

// JS new Filter map 17-07-17
   $('.search-destination .cs-options ul li').click(function(){
        var hClass = $(this).hasClass('active');
         var dataName = $(this).data('value');
        if(hClass){
            $('.img-filter .map-'+dataName).addClass('active');
        }else{
            $('.img-filter .map-'+dataName).removeClass('active');
        }
   });
// End JS		

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
            //  url = '/amica-fr/get-number-testi';
            //  url = url + '?'+url2;
              
              url = window.location.pathname + '?'+url2;
              history.pushState('', '', window.location.pathname + '?' +url2);
              
              searchTesti($(this), url);
              return false;
            }

//           if ($(this).closest('.search-testi-form').length) {
//              var theme = '';
//              parent.find('.search-theme .list-option .active').each(function(index){
//                theme += $(this).data('value');
//                if(index != parent.find('.search-theme .list-option .active').length -1)
//                  theme += '-';
//              })
//              if(!theme) theme = 'all';
//              pr = { 'country': des, 'type': type, 'theme': theme };
//              var url2 = $.param(pr);
//              url = '/amica-fr/get-number-testi';
//              url = url + '?' + url2;
//
//              searchTesti($(this), url);
//              return false;
//          }

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
              var geturl = window.location.href;
            var param = geturl.split('?');
            if(param[1] == null){
                window.location.href = '/formules/itineraire';
            }else{
                window.location.href = '/formules/itineraire?'+param[1];
            }
            
            return false;
              
              pr = {'country': des, 'type': type};
              url = '/formules/itineraire';
          }

          if(parent.hasClass('search-prog-form')){
              var geturl = window.location.href;
            var param = geturl.split('?');
            if(param[1] == null){
                if($('.search-form .destination .list-option li.active').length == 1 && window.location.pathname != '/voyage'){
                   // window.location = '/'+$('.search-form .destination .list-option li.active').data('value')+'/itineraire?'+url2;
                   // window.location.href = '/'+$('.search-form .destination .list-option li.active').data('value')+'/itineraire?'+'country='+$('.search-form .destination .list-option li.active').data('value')+'&type=all&length=all';
                    window.location.href = '/'+$('.search-form .destination .list-option li.active').data('value')+'/itineraire';
                    
                    return false;
                }else{
                    window.location.href = '/voyage/itineraire';
                }
                
            }else{
                if($('.search-form .destination .list-option li.active').length == 1 && window.location.pathname != '/voyage'){
                   // window.location = '/'+$('.search-form .destination .list-option li.active').data('value')+'/itineraire?'+url2;
                    window.location.href = '/'+$('.search-form .destination .list-option li.active').data('value')+'/itineraire?'+param[1];
                    return false;
                }
                window.location.href = '/voyage/itineraire?'+param[1];
            }
            return false;
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

          if(parent.hasClass('search-excl-form-home')){
              pr = {'country': des, 'type': type, 'length': 'all'};
              var url2 = $.param( pr );
              url = '/voyage/itineraire';
              url = url + '?'+url2;
              window.location.href = url;
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
              url = '/temoignages/recherche';
          }
          var url2 = decodeURIComponent($.param( pr ));
          url = url + '?'+url2;
          window.location = url;
        })         

		// Fix JS Click Filter 17-07-17

   // $('.cs-select').mouseleave(function(){
   //     $(this).find('.cs-options').removeClass('cs-options-active');
   //     $(this).removeClass('active');
   // });

		// End JS

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

//Jquery Tab Menu Image Map 4 country
        $('.mn-panel-1 .col-left .tab-img-map > span').click(function(){
          var index = $(this).data('tab');
          $('#sub-mn-1 #tabs li[data="'+'tab-panel-'+index+'"] a').trigger('mouseenter');
        })

       $('#sub-mn-1 #tabs li a').hover(function(){
            var name = $(this).data('tab');
            var cname = name;
            var src = $('#sub-mn-1 .img-map-' + cname).children('img').data('src');
            $('#sub-mn-1 .img-map-' + cname).children('img').attr('src', src);
            $('.tab-img-map').removeClass('active');
            $('.img-map-'+cname).addClass('active');

            $('#sub-mn-1 #tabs li').removeClass('active');
            $(this).parent().addClass('active');
            $('#my-tab-content .tab-pane').removeClass('active');
            $('#'+$(this).data('tab')).addClass('active');
        });

        $('.group-btn a.sub-mn-1').mouseover(function(){
            var src = $('#sub-mn-1 .tab-img-map.active').children('img').attr('data-src');
            $('#sub-mn-1 .tab-img-map.active').children('img').attr('src', src);
        });

//End Tab Menu Image Map 4 country        

//Jquery GET MAP 

    $('.redirect-map li').click(function(){
        var position = $(this).attr('data-position');
        var name = $(this).attr("name");
        $('.redirect-map li').removeClass('active');
        $('.map .info-office').removeClass('active');
        $(this).addClass('active');
        $('.map .' + name).addClass('active');
        $('iframe#get-map').attr('src', 'https://www.google.com/maps/embed/v1/place?q=' + position + '&key=AIzaSyAHEAW4xHCcY8aG90qhqusQwNNPvWLPwI8');
    });


//    var wh = $(window).height();
//    var x = $('iframe#get-map').offset().top;

//    $(window).on('scroll',function(){
//        var wscroll = $(window).scrollTop();
//        var datasrc = $('iframe#get-map').attr('data-src');
 //       if(x <= wscroll + (wh - 200) && datasrc != 'null'){
 //           var src = $('iframe#get-map').attr('data-src');
//            $('iframe#get-map').attr('data-src','null');
//        };


 //   });

//END get map        

// Jquery Slider Main on Mobile
    //        $(document).ready(function(){
    //          $('.slide-main-1').bxSlider({
    //              slideWidth: 1920,
    //              minSlides: 1,
    //              maxSlides: 1,
    //              slideMargin: 0,
    //              responsive: true,
    //              randomStart: false,
    //              // captions: true,
    //              auto: false,
    //              mode: 'fade',
    //              speed: 1000,
    //             onSlideBefore: function(slideElement, oldIndex, newIndex){
    //              var lazy = slideElement.find('.lazy');
    //              var load = lazy.attr('data-src');
    //              lazy.attr('src', load).removeClass('lazy');
    //          },


     //         });
     //     });
// END   Jquery Slider Main on Mobile      

   var width = window.innerWidth;

   if(width <= 568){
       $(window).on('scroll',function(){
           $('.sologan-text').hide();
            $('.container-1').addClass('fix-top');
            $('.fix-top').css('margin-top','50px');
        });
   }

    // Js back to top

    if ($('#back-to-top').length) {
    var scrollTrigger = 1000, // px
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
          $('#newsletter-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
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
          $('#newsletter-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
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


//$(document).mouseup(function (e)
//{
//    var container = $('#newsletter-form .error-email');
//
//    if (!container.is(e.target) // if the target of the click isn't the container...
//        && container.has(e.target).length === 0) // ... nor a descendant of the container
//    {
//        container.hide();
//    }
//});

// $('.votre-project > a').click(function(){
//   if(parseInt($('#numb-tour').html())){
//     window.location = '/votre-liste-envies';
//   }
//   else{
//     window.location = '/devis';
//   }
//   return false;
// })

$( document ).ready(function() {
  $('a[href$="pdf"]').addClass('download-link download-pdf');
  
  $('a[href$="doc"]').addClass('download-link download-doc');
  $('a[href$="docx"]').addClass('download-link download-docx');
  $('a[href$="xls"]').addClass('download-link download-xls');
  $('a[href$="xlsx"]').addClass('download-link download-xlsx');
  $('.content-fix-color-link-e65925 a[href]').css({'color' : '#e65925'});
  
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
  
  
  $(document).on({
            mouseenter: function () {
                //stuff to do on mouse enter
                $(this).parent().children('.tx').addClass('tx-act');
            },
            mouseleave: function () {
                //stuff to do on mouse leave
                $(this).parent().children('.tx').removeClass('tx-act');
            }
        }, ".btn-link-devis .item-btn"); //pass the element as an argument to .on
        
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
    
});
$('button.navbar-toggle').on('click', function(){
    var hClass = $('.nav-fixed-responsive').hasClass('show-mn');
    if(!hClass){
        $('.nav-fixed-responsive').addClass('show-mn');
    }else{
        $('.nav-fixed-responsive').removeClass('show-mn');
    }
    
});
$('button.navbar-toggle').one('click', function(){
    $.post('/amica-fr/load-menu-responsive', { type: 'menu-responsive'}, function(data){
        $('#myNavbar').html(data);
    })
});
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
        
        $('.amc-fix-mt-40').each(function(){
            var fs = $(this).css('font-size');
            var lh = $(this).css('line-height');
            var elementbefore = $(this).prev().css('font-size');
            var elementbefore_lineheight = $(this).prev().css('line-height');
            var mt = 40 - (((parseFloat(lh) - parseFloat(fs)) / 2) + ((parseFloat(elementbefore_lineheight) - parseFloat(elementbefore)) / 2)) - 2;
           // var mt = 25 - ((parseFloat(fs) * 0.5) / 2 + (parseFloat(elementbefore) * 0.5) / 2) ;
            //alert(mt);
           // $(this).attr("style", "margin-top: "+mt+"px !important");
            $(this).css("cssText", "margin-top: "+mt+"px !important;");
        });
        $('.amc-fix-mb-40').each(function(){
           var fs = $(this).css('font-size');
            var lh = $(this).css('line-height');
            var elementbefore = $(this).next().css('font-size');
            var elementbefore_lineheight = $(this).next().css('line-height');
            var mt = 40 - (((parseFloat(lh) - parseFloat(fs)) / 2) + ((parseFloat(elementbefore_lineheight) - parseFloat(elementbefore)) / 2)) - 2;
            var style = $(this).attr('style');
            $(this).css("cssText", "margin-bottom: "+mt+"px !important;" + style);
        });
        
        $('.amc-fix-mt-40-0').each(function(){
            var fs = $(this).css('font-size');
            var lineheight = $(this).css('line-height');
            var mt = 40 - ((parseFloat(lineheight) - parseFloat(fs)) / 2) ;
            //alert(mt);
           // $(this).attr("style", "padding-top: "+mt+"px !important");
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
  fixHeightColumnsItems();
});

// Js load iframe 

//function init() {
//    var vidDefer = document.getElementsByTagName('iframe');
//    //var vidDefer = document.getElementsByClassName('videoytb');
//    for (var i=0; i < vidDefer.length; i++) {
//    if(vidDefer[i].getAttribute('data-src')) {
//    vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
//    } } 
//}
//window.onload = init;

// End Js load iframe 

function imgLazy(){
    
   // const imagess = document.querySelectorAll('img[data-src]');
    var images = Array.prototype.slice.call(document.querySelectorAll('img[data-src]'));
   // console.log(images);
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

    images.forEach(function(image){
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
    //console.log(settings.url);
   // if(settings.url == "/amica-fr/ajax-result-menu"){
       imgLazy();
  //  }
});


/* Fixed click double element on tablet */

;(function(){
    var isTouch = false //var to indicate current input type (is touch versus no touch) 
    var isTouchTimer 
    var curRootClass = '' //var indicating current document root class ("can-touch" or "")
    
    function addtouchclass(e){
        clearTimeout(isTouchTimer)
        isTouch = true
        if (curRootClass != 'can-touch'){ //add "can-touch' class if it's not already present
            curRootClass = 'can-touch'
            document.documentElement.classList.add(curRootClass)
        }
        isTouchTimer = setTimeout(function(){isTouch = false}, 500) //maintain "istouch" state for 500ms so removetouchclass doesn't get fired immediately following a touch event
    }
    
    function removetouchclass(e){
        if (!isTouch && curRootClass == 'can-touch'){ //remove 'can-touch' class if not triggered by a touch event and class is present
            isTouch = false
            curRootClass = ''
            document.documentElement.classList.remove('can-touch')
        }
    }
    
    document.addEventListener('touchstart', addtouchclass, false) //this event only gets called when input type is touch
    document.addEventListener('mouseover', removetouchclass, false) //this event gets called when input type is everything from touch to mouse/ trackpad
})();


$('body').on('touchstart','*',function(e){   //listen to touch
      
        var jQueryElement=$(this);  
        var element = jQueryElement.get(0); // find tapped HTML element
        if(!element.click){
            var eventObj = document.createEvent('MouseEvents');
            eventObj.initEvent('click',true,true);
            element.dispatchEvent(eventObj);
        }
    });
/* Fixed click double element on tablet */
// Fix Js for tablet when click Menu
$(document).on("click", ".fix-menu-tablet", function(event){
    var top = $(window).scrollTop();
   // console.log(top);
    var hClass = $(this).hasClass('selected');
    if(!hClass){
        $('html, body').addClass('overlay-lock');
        $(this).addClass('selected');
        
        $(this).attr('data-scroll',top);
    }else{
        $('html, body').removeClass('overlay-lock');
        $(this).removeClass('selected');
        var topscroll = $(this).attr('data-scroll');
      //  console.log(topscroll);
      //  $(window).scrollTop(topscroll);
//        $('html,body').animate({
//            scrollTop: topscroll
//        }, 1000);
        setTimeout((function() {
            $('html,body').animate({scrollTop: topscroll} ,{duration:0});
         }), 0);
    }
	
 
});


// End Fix Js for tablet when click Menu

// show info warning input email all form on website
$("#devisform-email, input.email").keyup(function(){     
        var arr = ["wanadoo.fr", "neuf.fr", "live.fr", "laposte.net", "yahoo.fr", "yahoo.com", "free.fr", "hotmail.com", "hotmail.fr", "outlook.fr", "algam.net"];
        el = $(this);
        var email = el.val();
        var domain_email = email.split("@")[1];
         var mbel = parseInt(el.css('margin-bottom'));
         
         
         console.log(mbel);
    if($.inArray($.trim(domain_email), arr) > -1){
        //console.log($.inArray($.trim(domain_email), arr));
        var hClass = el.parent().find('.info-inbox-spam');
        if(hClass.length == 1){
        
        }else{
            el.parent().css({'position' : 'relative', 'margin-bottom' : '0px', 'display' : 'block'});
            var style = el.attr('style');
            el.css("cssText", "margin-bottom: 0px !important;" + style);
         //   el.parent().append('<div class="info-inbox-spam" style="font-size: 13px; max-width: 320px; line-height: 1.2; position: absolute; left: 0; top: 110%; bottom: 0;">Merci de vérifier votre dossier de courriers indésirables afin de vous assurer de la bonne réception.</div>');
         el.after('<div class="info-inbox-spam" style="font-size: 13px; max-width: 340px; line-height: 1.2; margin-top: 2px;">Merci de vérifier votre dossier de courriers indésirables afin de vous assurer de la bonne réception.</div>');
        }
        
   }else{
       $('.info-inbox-spam').remove();
        el.parent().css({'position' : 'relative', 'margin-bottom' : '0px', 'display' : 'block'});
        el.css("cssText", '');
    }  
       
    
});         
// End info warning input email all form on website
