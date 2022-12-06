$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.remove-image').click(function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        let id_delete = $('.image_delete').val();
        let r = confirm('Bạn có muốn xóa ảnh này')
        if(r){
            $('.image-'+id).attr('src','/assets/img/department.jpg');
            $('.remove-'+id).css('display', 'none');
            $('.image-value-'+id).val('');

            if(!id_delete){
                id_delete = id;
                $('.image_delete').val(id_delete)
            }else{
                id_delete = id_delete+','+id;
                $('.image_delete').val(id_delete)
            }
        }
    });
    $('.upload_image_general').change(function(){
        let id = $(this).data('id');
        readURL(this, id);
    });
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-'+id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
});
$("[name='my-checkbox']").on('change', function () {
    $.ajax({
        url: $(this).data('api'),
        type: 'post',
        data: {
            id: $(this).data('id'),
            table: $(this).data('table'),
            column: $(this).data('column'),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response);
            if (response.success) {
                'use strict';
                var notify = $.notify('Chuyển trạng thái thành công', 'success', {
                    type: 'theme',
                    allow_dismiss: true,
                    delay: 30000,
                    showProgressbar: true,
                    timer: 30000,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });

            }
        }
    });
});
