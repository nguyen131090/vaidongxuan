$(function() {
    var $window           = $(window),
        win_height_padded = $window.height() * 1.1;
    $window.on('scroll', revealOnScroll);
    function revealOnScroll() {
        var scrolled = $window.scrollTop(),
            win_height_padded = $window.height() * 1.1;

        // Showed...
        $(".revealOnScroll").each(function () {
            var $this     = $(this),
                offsetTop = $this.offset().top;

            if (scrolled + win_height_padded > offsetTop) {
                if ($this.data('timeout')) {
                    window.setTimeout(function(){
                        $this.addClass($this.data('animation'));
                    }, parseInt($this.data('timeout'),10));
                } else {
                    $this.addClass($this.data('animation'));
                }

                // ANIMATE COUNTER UP
                if($this.data('counter')) {
                    $('.counter').each(function() {
                        var $this = $(this),
                            countTo = $this.attr('data-count');

                        $({ countNum: $this.text()}).animate({
                                countNum: countTo
                            },
                            {
                                duration: 3000,
                                easing:'linear',
                                step: function() {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function() {
                                    $this.text(this.countNum);
                                    //alert('finished');
                                }
                            });
                    });
                    $('.counter-2').each(function() {
                        var $this = $(this),
                            countTo = $this.attr('data-count');

                        $({ countNum: $this.text()}).animate({
                                countNum: countTo
                            },
                            {
                                duration: 4000,
                                easing:'linear',
                                step: function() {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function() {
                                    $this.text(this.countNum);
                                    //alert('finished');
                                }
                            });
                    });
                }
                // FINISH COUNTER UP
            }
        });
        // Hidden...
        // $(".revealOnScroll.animated").each(function (index) {
        //     var $this     = $(this),
        //         offsetTop = $this.offset().top;
        //     if (scrolled + win_height_padded < offsetTop) {
        //         $(this).removeClass('fadeInUp flipInX lightSpeedIn')
        //     }
        // });
    }
    revealOnScroll();
});
// FINISH ANIMATE