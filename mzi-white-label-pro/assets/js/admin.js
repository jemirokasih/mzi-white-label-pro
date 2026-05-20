(function($) {
    'use strict';

    $(function() {
        $('.mzi-upload-button').on('click', function(e) {
            e.preventDefault();

            var target = $(this).data('target');
            var mediaUploader = wp.media({
                title: mziWlpMedia.title,
                button: {
                    text: mziWlpMedia.buttonText
                },
                multiple: false
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();

                $('#' + target).val(attachment.url);
                $('#' + target + '_preview').attr('src', attachment.url);
            });

            mediaUploader.open();
        });

        $('.mzi-remove-button').on('click', function() {
            var target = $(this).data('target');

            $('#' + target).val('');
            $('#' + target + '_preview').attr('src', '');
        });
    });
})(jQuery);
