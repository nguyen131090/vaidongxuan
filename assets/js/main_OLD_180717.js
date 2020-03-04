// Auto height left right submenu
//    $(window).bind('load',function() {
//        $('.mn-panel-2 .col-left').css("height",$('.mn-panel-2').outerHeight());
//    });
// End auto        
        
	  if ($(window).width() == 768) {
            $('meta[name=viewport]').attr('content','width=device-width, initial-scale=0.75, maximum-scale=1'); 
        }
		
// Slider Main        
   $(window).bind('load', function(){
      $('.carousel').carousel({
        interval: 4000, //changes the speed
        pause: false,
    });
        $('#myCarousel .item').each(function(i) {
            (function(self) {
                setTimeout(function() {
                    $(self).next().addClass('next');
                },1500);
            })(this);
        });
        $('#myCarousel .carousel-control').click(function(){
            var hClass = $('#myCarousel .item').hasClass('next');
            if(hClass){
             $('#myCarousel .item').removeClass('next');
            }
        });
		
		$('img').each(function(i){
            var alt = $(this).attr('alt');
            var src = $(this).attr('src');
            var datasrc = $(this).attr('data-src');
            if(src == '/assets/img/back-button.png'){
               
                $(this).attr('alt','Retour');
            }else if(datasrc == '/assets/img/page2016/hot_gon_thao_100_100.jpg' || src == '/assets/img/page2016/hot_gon_thao_100_100.jpg'){
                $(this).attr('alt','Conseillere Amica Travel');
            }
            
        });

   });      
      
        
    $('.slide-main-1').carousel({
        interval: 5000, //changes the speed
        pause: false,
    })    
// End Slider Main    
// Bxslider page Explorateurs
//$(document).ready(function(){
	
       $('#slidertwo').bxSlider({
            slideWidth: 205,
            minSlides: 1,
            maxSlides: 3,
            moveSlides: 1,
            slideMargin: 50,
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
            randomStart: false,
           
            auto: false,
          
            speed: 1000,
       
        
        });
        
  


   $('#sliderone').bxSlider({
            slideWidth: 271,
            minSlides: 1,
            maxSlides: 3,
			 moveSlides: 1,
            slideMargin: 20,
           
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
            randomStart: false,
            infiniteLoop: false,
            auto: false,
          
            speed: 1000,
			onSliderLoad: function(currIndex){
              
                 var el = $(".slider-2 .slide:nth-child(" + (currIndex + 1) + ")");
               
               el.css('width','348px');
               var cha = el.parent().parent().parent();
               cha.css({'max-width':'990px'});
           
            },
       });
	
//});

//END bxslider Explorateurs    
// Jquery LazyLoad Image
   
  $(function() {
      $("body").on("contextmenu", "img", function(e) {
        return false;
    });
        $('.img-lazy').lazy({
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            effectTime: 1000,
            visibleOnly: true,
            onError: function(element) {
                console.log('error loading ' + element.data('src'));
            }
            
        });
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
     $('.group-btn a')
        .mouseenter(function() {
          var name = $(this).attr('data-name');
//                $('.group-btn a').removeClass('active');
//                $(this).addClass('active');
//                $('.mn-panel').removeClass('active');
//               // $('#' + name).addClass('active');
//                $('#group-sub-mn').show();
//                $('.mn-panel').hide();
//                $('#' + name).fadeIn(600);
                $('.group-btn a').removeClass('active');
                $(this).addClass('active');
                $('.mn-panel').removeClass('active');
                $('#group-sub-mn').show();
                $('.mn-panel').hide();
                $('.mn-panel').removeClass('show-mn');
                $('#' + name).addClass('show-mn');
                $('#' + name).show();
        })
        .mouseleave(function() {
            $('.group-btn a').removeClass('active');
          //  var name = $(this).attr('data-name');
         // $('.mn-panel').removeClass('active');
          // $('#' + name).hide();
            //$('.mn-panel').css('display','none');
              //$('.mn-panel').hide(); 
                $('.mn-panel').hide();  
                $('.mn-panel').removeClass('show-mn'); 
        });
        $('.mn-panel').hover(
            function() {
                $(this).show();
                var id = $(this).attr('id');  
                $('.group-btn > li > a.' + id).addClass('active');
                $('.mn-panel').removeClass('show-mn');
                $(this).addClass('active');
            },
            function() {
                $(this).removeClass('active');
               //$(this).hide();
               $('.mn-panel').hide();
               $('.group-btn > li > a').removeClass('active');
            }
        );
// End Hover Menu
    
// Jquery Fixed Menu 
 
        var iScrollPos = 0;
        var positionMenu = $('.area-btn-list-menu').position();
        $(window).scroll(function () {
            
            
            if ($(this).scrollTop() > positionMenu.top) {
                var iCurScrollPos = $(this).scrollTop();
                if (iCurScrollPos > iScrollPos) {
                     $('.area-btn-list-menu').addClass('opacity');
                    $('.area-btn-list-menu').removeClass('fixed');
                    $('.text-sologan').removeClass('fix-margin-bottom');
					$('.container-1 .row-1').hide();
                } else {
                    $('.area-btn-list-menu').addClass('opacity');
                    $('.area-btn-list-menu').addClass('fixed');
                    
                    $('.text-sologan').addClass('fix-margin-bottom');
					$('.container-1 .row-1').show();
                }
                iScrollPos = iCurScrollPos;
           
            } else {
                $('.area-btn-list-menu').removeClass('opacity');
                $('.area-btn-list-menu').removeClass('fixed');
                $('.text-sologan').removeClass('fix-margin-bottom')
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
     
    $('.cs-select .cs-placeholder').click('toggle',function(){
        $('.cs-select').removeClass('active');
        $('.cs-select .cs-options').hide();
        $(this).parent().toggleClass('active');
        $(this).parent().children('.cs-options').toggle();
        $(this).parent().children('.cs-options').toggleClass('cs-options-active');
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
            parent.find('.submit').text('AFFICHER '+data+ ' RÉSULTAT'+ext);
        })
    }


        $('.cs-options ul li').on('click',function(){
          var target = $(this);
          target.toggleClass('active');
          var parent = target.closest('form');
          var index = $(this).index();
          $(this).closest('.cs-select').find('.list-option ul li:eq('+index+')').toggleClass('active');
          var des = pr = url = '';
          var desText = typeText = '';
          
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
          if(!type) type= 'all';

          if($(this).closest('.search-excl-form-home').length){
              if(!desText) desText = 'Destination';
              $('.search-excl-form-home .search-destination .cs-placeholder').text(desText);
              if(!typeText) typeText = 'Votre envie';
              $('.search-excl-form-home .search-type .cs-placeholder').text(typeText);
              pr = {'country': des, 'type': type, 'length': 'all'};
              var url2 = $.param( pr );
              url = '/amica-fr/get-number-prog';
              url = url + '?'+url2;
              searchProgHome($(this), url);
              return false;
            }
            
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

          if(parent.hasClass('search-prog-form') || parent.hasClass('search-excl-form-home')){
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

    $('.cs-select').mouseleave(function(){
        $(this).find('.cs-options').removeClass('cs-options-active');
        $(this).removeClass('active');
    });    
        
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
          $('#newsletter-form .error-email').show();
          
        }else{
            $('#newsletter-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#newsletter-form .error-email').hide();
            
        } 
});     	
$('#newsletter-form .submit-email').click(function(){
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#newsletter-form .email').val())){
          $('#newsletter-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#newsletter-form .error-email').show();
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