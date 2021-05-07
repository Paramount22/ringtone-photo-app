
(function($) {
 // only one song can play at given time
pauseOthers = (element) => {
    $('audio').not(element).each( (index, audio) => {
        audio.pause();
    });
}
})(jQuery);
