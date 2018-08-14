define(['jquery'], function($) {

    return function (config, element) {
        var $el = $(element);
        var $img = $el.find('img[data-alt-src]');
        var altSrc = $img.data('alt-src');
        var origSrc = $img.prop('src');

        if (altSrc !== '') {
            $el.on('mouseenter', function () {
                origSrc = $img.prop('src');

                $img.prop({
                    src: altSrc
                });
            });

            $el.on('mouseleave', function () {
                $img.prop({
                    src: origSrc
                });
            });
        }
    }

});
