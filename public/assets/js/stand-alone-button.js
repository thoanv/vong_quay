(function( $ ){

    $.fn.filemanager = function(type, options) {
        type = type || 'file';

        this.on('click', function(e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
            var target_input =  $(this).attr('data-name');
            var target_preview = $('#' + $(this).data('preview'));
            var domain = window.location.protocol + '//' + window.location.host+'/';
            console.log(domain)
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');
                var source = file_path.replace(domain, "");
                // set the value of the desired input to image url
                $('.'+target_input).val('').val(source).trigger('change');

                // clear previous preview
                target_preview.html('');

                // set or change the preview image src
                items.forEach(function (item) {
                    console.log(item)
                    $('.form-image').append('<a class="delete-image delete-image-append" data-value="cover">Xóa</a>')
                    target_preview.append(
                        $('.image-'+target_input).attr('src', item.url)
                    );
                });

                // trigger change event
                target_preview.trigger('change');
            };
            return false;
        });
    }

})(jQuery);
