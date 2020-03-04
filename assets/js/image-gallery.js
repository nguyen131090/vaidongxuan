/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('.fancybox-thumbs').fancybox({
               
               loop              : true,
             // autuPlay: true,
                 //autoPlay          : 'flag',
                  playSpeed         : 2000,
                  nextSpeed         : 500,
                  prevSpeed         : 500,
                  openSpeed        : 500,
                  speedOut         : 500,
                  openEffect        : 'fade', 
                  closeEffect       : 'fade',
                  nextEffect        : 'fade',
                  prevEffect        : 'fade',
                padding: 0,
                closeBtn  : true,
                arrows    : false,
                nextClick : true,
                
                //parent: "#test",
       
                helpers : {
                 //   title   : { type : 'inside' },
                    thumbs : {
                        width  : 100,
                        height : 100
                    },
                    buttons : {}, // add the buttons bar

                },

                onUpdate: function () {
                    var e;
                    e = $("#fancybox-buttons").find(".btnToggle").removeClass("btnDisabled btnToggleOn");
                    if (this.canShrink) {
                        e.addClass("btnToggleOn")
                    } else if (!this.canExpand) {
                        e.addClass("btnDisabled")
                    };
                    var bottom = $(window).height() - ($('.fancybox-skin').outerHeight() + $('.fancybox-wrap').position().top);
                    var left = $('.fancybox-wrap').position().left;
                    var right = $(window).width() - ($('.fancybox-skin').outerWidth() + $('.fancybox-wrap').position().left);
                    $(".mythumbswrap").css({bottom: bottom, left: left, right: right});
        
                    $(".mybutton").css({bottom: bottom + 30, right: right});
                    //$(".fancybox-title").css({bottom: bottom, left: left, right: right});
                    $(".mytitle-wrap").css({bottom: bottom + 30, left: left + 20, right: right + 150});
                    
                },
                afterShow: function () {
                    var bottom = $(window).height() - ($('.fancybox-skin').outerHeight() + $('.fancybox-wrap').position().top);
                    var left = $('.fancybox-wrap').position().left;
                    var right = $(window).width() - ($('.fancybox-skin').outerWidth() + $('.fancybox-wrap').position().left);
                  
                    if ($(".mythumbswrap").length == 0) {
                        setTimeout(function () {
                            $("body").find("#fancybox-thumbs").css({
                                position: "relative"
                            }).wrap("<div class='mythumbswrap' />").parent().css({bottom: bottom, left: left, right: right});
                           
                        }, 100);
                    };
                     if ($(".mybutton").length == 0) {
                        setTimeout(function () {
                            $("body").find("#fancybox-buttons").css({
                                position: "relative"
                            }).wrap("<div class='mybutton' />").parent().css({bottom: bottom + 30, right: right});
                           
                        }, 100);
                    };
                        
                    if ($(".mytitle-wrap").length == 0) {
                       $("body").append('<div class="mytitle-wrap"></div>');

                    };
                     setTimeout(function () {
                            $(".mytitle-wrap .fancybox-title").remove();
                            $("body").find(".fancybox-title").css({
                                position: "relative"
                            }).clone().appendTo(".mytitle-wrap").parent().css({bottom: bottom + 30, left: left + 20,  right: right + 150});
                           
                        }, 0);
                    
                },
               
                afterClose: function () {
                    $(".mythumbswrap").remove();
                    $(".mybutton").remove();
                    $(".mytitle-wrap").remove();
                },
            });
   
        
    
$(document).on("mouseenter", ".mythumbswrap", function(event){
	$('.mybutton').addClass('mybutton-animation');
        $('.mytitle-wrap').addClass('mytitle-wrap-animation');
 
});

$(document).on("mouseleave", ".mythumbswrap", function(event){
	$('.mybutton').removeClass('mybutton-animation');
        $('.mytitle-wrap').removeClass('mytitle-wrap-animation');
  
});
        