$(document).ready(function () {

    $('#btn_submit').html('Add Kategori');
    $('#icon_').attr('class', 'fa fa-plus');

    $('#btn_cancel').click(function () {
        window.location.reload();
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
            url: 'application/kategori/ajax.php',
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
                    $('#btn_submit').html('Edit Kategori');
                    $('#icon_').attr('class', 'fa fa-pencil-square-o');
                    $('#btn_add').attr('class', 'btn btn-sm btn-success');
                    $('#action').val('edit');
                    $('#edit_id').val(id);

                    v_edit = $.ajax({
                        url: 'application/kategori/edit.php?id=' + id,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function () {
                            $('#err-loading').css('display', 'inline', 'important');
                            $('#err-loading').html("<img src='theme/asset/images/loading.gif' height='20px' /> Loading...");
                        },
                        success: function (data) {
                            $('#err-loading').hide(1300);
                            $('#kode').val(data.kode_kategori);
                            $('#kategori').val(data.nama_kategori);
                        }
                    });

                } else if (com == 'Delete') {
                    var conf = confirm('Delete this items ?');
                    var url = 'application/kaegori/data.php';

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

    $('#form_kategori').validate({
        rules: {
            kode: {
                required: true
            },
            kategori: {
                required: true
            }
        },
        messages: {
            kode: {
                required: ' *) field is required'
            },
            kategori: {
                required: ' *) field is required'
            }
        },
        submitHandler: function (form) {
            var com_action = $('#action').val();
            if (com_action == 'add') {
                ajaxAction('add');
            } else if (com_action == 'edit') {
                ajaxAction('edit');
            }

            $('#form_kategori').trigger('reset');
        }
    });
});

function ajaxAction(action) {
    data = $('#form_kategori').serializeArray();
    var table = $('#lookup').DataTable();

    v_dump = $.ajax({
        url: 'application/kategori/data.php',
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
            table.ajax.reload();

            $('#btn_add').attr('class', 'btn btn-sm btn-primary');
            $('#btn_submit').html('Add Kategori');
            $('#icon_').attr('class', 'fa fa-plus');
            $('#action').val('add');
            $('#edit_id').val('0');
        },
        error: function (response) {
            $.Notification.notify(
                    'error', 'top center',
                    'Warning',
                    'Error to process'
                    );
        }
    });
}