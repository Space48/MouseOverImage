define(['jquery'], function($) {

    return function (config, element) {
        var $img = $(element);
        var altSrc = $img.data('alt-src');
        var origSrc = $img.prop('src');

        if (altSrc !== '') {
            $img.on('mouseenter', function () {
                origSrc = $img.prop('src');

                $img.prop({
                    src: altSrc
                });
            });

            $img.on('mouseleave', function () {
                $img.prop({
                    src: origSrc
                });
            });
        }
    }

});
