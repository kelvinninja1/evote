$(document).ready(function () {
    $('#btn_submit').html('Add User');

    $('#btn_add').click(function (e) {
        e.preventDefault();

        $('#add_model').modal({backdrop: 'static', keyboard: false});
        $('.modal-title').html('Add new user');
        $('#action').val('add');
        $('#edit_id').val(0);
    });

    $('#btn_cancel').click(function () {
        var $form = $('#form_user');
        $form.trigger('reset');
        $form.validate().resetForm();
        $form.find('.error').removeClass('error');
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
            url: 'application/user/ajax.php',
            error: function () {
                $.Notification.notify(
                        'error', 'top center',
                        'Warning',
                        'Data tidak tersedia'
                        );
            }
        },
        fnDrawCallback: function (oSettings) {

            $('#lookup td.status').each(function () {
                var status = $(this).html();
                switch (status) {
                    case 'Inactive':
                        $(this).addClass('status-inactive');
                        break;
                    case 'Active':
                        $(this).addClass('status-active');
                        break;
                    default:
                        return;
                }
            });

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
                    $('.modal-title').html('Edit user');
                    $('#action').val('edit');
                    $('#edit_id').val(id);

                    v_edit = $.ajax({
                        url: 'application/crud/edit.php?id=' + id +'&tb_name=master_user',
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (data) {
                            $('#username').val(data.username);
                            $('#password').val(data.password);
                            $('#fname').val(data.fullname);
                            $('#role').val(data.role);                            
                        }
                    });

                } else if (com == 'Delete') {
                    var conf = confirm('Delete this items ?');
                    var url = 'application/user/data.php';

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

    $('#form_user').validate({
        rules: {
            username: {
                required: true,
                minlength: 4
            },
            password: {
                required: true,
                pwcheck: /^[A-Za-z0-9\d=!\-@._*]+$/,
                minlength: 6
            },
            fname: {
                required: true
            },
            role: {
                required: true
            }
        },
        messages: {
            username: {
                required: ' *) Username is required',
                minlength: 'min 4 characters'
            },
            password: {
                required: '*) Password is required',
                pwcheck: 'at least capital, lower and numeric allowed',
                minlength: 'min 6 characters'
            },
            fname: {
                required: '*) Full name is required'
            },
            role: {
                required: '*) Choose one'
            }
        },
        submitHandler: function (form) {
            var com_action = $('#action').val();
            if (com_action == 'add') {
                ajaxAction('add');
            } else if (com_action == 'edit') {
                ajaxAction('edit');
            }

            $('#form_user').trigger('reset');
        }
    });//end validate
    $.validator.addMethod("pwcheck", function (value, element, regexpr) {
        return regexpr.test(value);
    });
});

function ajaxAction(action) {
    data = $('#form_user').serializeArray();
    var table = $('#lookup').DataTable();

    v_dump = $.ajax({
        url: 'application/user/data.php',
        type: 'POST',
        dataType: 'JSON',
        data: data,
        success: function (response) {
            if (response == 1) {
                $.Notification.notify(
                        'error', 'top center',
                        'Warning',
                        'Data sudah tersedia'
                        );
            } else {
                $.Notification.notify(
                        'success', 'top center',
                        'Success',
                        'Data berhasil diproses'
                        );
            }
            $('#add_model').modal('hide');
            table.ajax.reload();

            $('#btn_add').attr('class', 'btn btn-sm btn-primary');
            $('#btn_submit').html('Add User');
            $('#action').val('add');
            $('#edit_id').val('0');
        }
    });        
}
