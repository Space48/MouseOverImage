define(['jquery'], function($) {

    return function (config, element) {
        var $el = $(element);
        var altSrc = $el.data('alt-src');
        var src = $el.prop('src');

        if (altSrc !== '') {
            $el.on('mouseenter', function () {
                $el.prop({
                    src: altSrc
                });
            });

            $el.on('mouseleave', function () {
                $el.prop({
                    src: src
                });
            });
        }
    }

});
