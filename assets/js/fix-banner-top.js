/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(window).bind('load', function(){
    var img = $('.container-1 > img').attr('data-src');
    
    $('.container-1').css('background-image', 'url('+img+')');
    $('.container-1').css('background-size', 'cover');
	$('.container-1 > img').remove();
});
