$(document).ready(function () {
    
    $('#btn_submit').html('Add Kandidat');

    $('#btn_add').click(function (e) {
        e.preventDefault();

        $('#add_model').modal({backdrop: 'static', keyboard: false});
        $('.modal-title').html('Add new kandidat');
        $('#action').val('add');
        $('#edit_id').val(0);
    });

    $('#btn_cancel').click(function () {
        var $form = $('#form_kandidat');
        $form.trigger('reset');
        $form.validate().resetForm();
        $form.find('.error').removeClass('error');
        $('#xView').attr('src', '#');
    });

    $('#xUpload').change(function () {
        readURL(this);
    });

    var dataTable = $('#lookup').DataTable({
        'autoWidth': false,
        'aoColumnDefs': [
            {'bSortable': false, 'aTargets': ['nosort']}
        ],
        'processing': true,
        'serverSide': true,
        'ajax': {
            type: 'POST',
            dataType: 'JSON',
            url: 'application/pemilih/ajax.php',
            error: function () {
                $.Notification.notify(
                        'error', 'top center',
                        'Warning',
                        'Data tidak tersedia'
                        );
            }
        },
        fnDrawCallback: function (oSettings) {

            $('.act_btn').each(function () {
                $(this).tooltip({
                    html: true
                });
            });

            $('.act_btn').on('click', function (e) {
                e.preventDefault();
                var com = $(this).attr('data-original-title');
                var id = $(this).attr('id');

                if (com == 'Edit') {
                    $('#add_model').modal({backdrop: 'static', keyboard: false});
                    $('.modal-title').html('Edit kandidat');
                    $('#action').val('edit');
                    $('#edit_id').val(id);

                    v_edit = $.ajax({
                        url: 'application/crud/edit.php?id=' + id + '&tb_name=data_pemilih',
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (data) {
                            $('#ketua').val(data.nama_ketua);
                            $('#wakil').val(data.nama_wakil);
                            $('#xView').attr('src', '../' + data.photo);
                        }
                    });

                } else if (com == 'Delete') {
                    var conf = confirm('Delete this items ?');
                    var url = 'application/kandidat/data.php';

                    if (conf) {
                        $.post(url, {id: id, action: com.toLowerCase()}, function () {
                            var table = $('#lookup').DataTable();
                            table.ajax.reload();
                        });
                    }
                }
            });
        }
    });//end datatable

    $('#form_kandidat').validate({
        rules: {
            ketua: {
                required: true
            },
            wakil: {
                required: true
            },
            password: {
                required: true,
                pwcheck: /^[A-Za-z0-9\d=!\-@._*]+$/,
                minlength: 6
            }
        },
        messages: {
            ketua: {
                required: ' *) field is required'
            },
            wakil: {
                required: ' *) field is required'
            },
            password: {
                required: '*) Password is required',
                pwcheck: 'at least capital, lower and numeric allowed',
                minlength: 'min 6 characters'
            }
        },
        submitHandler: function (form) {
            var com_action = $('#action').val();
            if (com_action == 'add') {
                ajaxAction('add');
            } else if (com_action == 'edit') {
                ajaxAction('edit');
            }

            $('#form_kandidat').trigger('reset');
        }
    });//end validate
    $.validator.addMethod("pwcheck", function (value, element, regexpr) {
        return regexpr.test(value);
    });

});

function ajaxAction(action) {
//    data = $('#form_kandidat').serializeArray();    
//    var table = $('#lookup').DataTable();
//
//    v_dump = $.ajax({
//        url: 'application/kandidat/data.php',
//        type: 'POST',
//        dataType: 'JSON',
//        data: data,
//        success: function (response) {
//            if (response == 1) {
//                $.Notification.notify(
//                        'error', 'top center',
//                        'Warning',
//                        'Data sudah tersedia'
//                        );
//            } else {
//                $.Notification.notify(
//                        'success', 'top center',
//                        'Success',
//                        'Data berhasil diproses'
//                        );
//            }
//            table.ajax.reload();
//
//            $('#btn_add').attr('class', 'btn btn-sm btn-primary');
//            $('#btn_submit').html('Add Kandidat');
//            $('#action').val('add');
//            $('#edit_id').val('0');
//        }
//    });

    var data = new formData();
    var form_data = $('#form_kandidat').serializeArray();
    $.each(form_data, function (key, input) {
        data.append(input.name, input.value);
    });

    var file_data = $('input[name="xUpload"]')[0].files;
    for (var i = 0; i < file_data.length; i++) {
        data.append("xUpload[]", file_data[i]);
    }

    data.append('key', 'value');

    var formDataLog = $.ajax({
        url: 'application/kandidat/data.php',
        method: 'POST',
        processData: false,
        contentType: false,
        data: data,
        success: function (data, textStatus, jqXHR) {
            //success
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //error
        }
    });

}

function readURL(input) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#xView').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        $('#xView').attr('src', '../assets/no_preview.png');
    }
}