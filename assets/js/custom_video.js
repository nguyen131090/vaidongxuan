/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(window).on("load", function(){

    var tag = document.createElement('script');
    tag.id = 'iframe-demo';
    tag.src = 'https://www.youtube.com/iframe_api';
    tag.allowfullscreen = 'allowfullscreen';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    $('iframe').each(function(index) {
         var idiframe = $(this).attr('id');
         var nameiframe = $(this).attr('name');
         if(nameiframe != 'no-autoplay'){
         if(idiframe == undefined || idiframe == null){
            $(this).attr('id','video-ytb-'+(index+1));
            $(this).attr('data-name','video-ytb');
          //  $(this).addClass('videoytb');
            $(this).attr('allowfullscreen','allowfullscreen');

           if($(this).attr('src') != undefined){

               var src = $(this).attr('src').split('?');
               $(this).attr('src', src[0] + '?enablejsapi=1&rel=0');
           }else{
               var src = $(this).attr('data-src').split('?');

                $(this).attr('data-src', src[0] + '?enablejsapi=1&rel=0');
                $(this).attr('src', src[0] + '?enablejsapi=1&rel=0');
              // console.log('ok-2');

           }

         }
        }
    }); 

});
  
var players = {};
    
function onYouTubeIframeAPIReady() {

    $("iframe[data-name='video-ytb']").each(function() {
        var frameID = this.id;
       // var frameID = getFrameID(identifier);
        if (frameID) { //If the frame exists
            players[frameID] = new YT.Player(frameID, {
                playerVars: {
              autoplay: 0,        // Auto-play khi load video, tức mở trang web
              controls: 1,        // Hiển thị nút pause/play
              showinfo: 0,        // Ẩn tiêu đề (title)
              modestbranding: 1,  // Ẩn logo YouTube
              loop: 1,            // Chạy video với chế độ Lặp
              fs: 1,              // Ẩn nút Full Screen
              cc_load_policty: 0, // Ẩn mục Closed Captions
              iv_load_policy: 3,  // Ẩn Annotations của video
              autohide: 0         // Ẩn các nút điều khiển khi video đang chạy
            },
          events: {
           
                'onReady': function(event){
                        var $player = $('#'+frameID) // jQuery ref to Youtube iframe
                        var playerTop = $player.offset().top
                        var player = players[frameID];
                        
                       
                        $(window).on('scroll', function(){
                                var playerState = player.getPlayerState() // get player state
                              
                                
                                if($(window).scrollTop() < ($player.offset().top + $player.height()) && ($(window).scrollTop() + $(window).height()) > $player.offset().top){ //view explaination in `In brief` section above
                                    // if (playerState != 1) // if video is NOT playing
                                                player.playVideo();

                                } else {
                                   // if (playerState == 1) // if video is playing
                                                player.pauseVideo();
                                }
                                

                        });
                        event.target.mute();
                },
                'onStateChange': function(event){}
            }
        
            });
        }
    });
  
}   

