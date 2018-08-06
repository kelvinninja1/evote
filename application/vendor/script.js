$(document).ready(function () {    

    $('#btn_add').click(function (e) {
        e.preventDefault();

        $('#add_model').modal({backdrop: 'static', keyboard: false});
        $('.modal-title').html('Add new vendor');
        $('#action').val('add');
        $('#edit_id').val(0);
    });
    
    $('#btn_cancel').click(function () {
        var $form = $('#form_vendor');
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
            url: 'application/vendor/ajax.php'
        },
        fnDrawCallback: function(oSettings) {                        
                                    
            $('.act_btn').each(function() {
                $(this).tooltip({
                    html: true
                });
            });

            $('.act_btn').on('click', function(e) {
                e.preventDefault();
                var com = $(this).attr('data-original-title');
                var id = $(this).attr('id');

                if(com == 'Edit') {
                    $('#add_model').modal({backdrop: 'static', keyboard: false});
                    $('.modal-title').html('Edit vendor');
                    $('#action').val('edit');
                    $('#edit_id').val(id);

                    v_edit = $.ajax({
                        url: 'application/vendor/edit.php?id='+id,
                        type: 'POST',
                        dataType: 'JSON',
                        success: function(data) {
                            $('#cname').val(data.company_name);
                            $('#caddress').val(data.company_address);
                            $('#tlp').val(data.tlp);
                            $('#email').val(data.email); 
                            $('#jdate').val(data.join_date); 
                        }
                    });
                    
                }else if(com == 'Delete') {
                    var conf = confirm('Delete this items ?');
                    var url = 'application/vendor/data.php';

                    if(conf) {
                        $.post(url, {id: id, action: com.toLowerCase()}, function() {
                            var table = $('#lookup').DataTable();
                            table.ajax.reload();
                        });
                    }
                }
            });
        }
    });//end datatable

    $('#form_vendor').validate({
        rules: {
            cname: {
                required: true,
                minlength: 4
            },
            caddress: {
                required: true,
                minlength: 4
            },
            tlp: {
                required: true, 
                number: true
            },            
            jdate: {
                required: true
            },
            email: {
                required: true,
                email: true
            }

        },
        messages: {
            cname: {
                required: ' *) Company name is required',
                minlength: 'min 4 characters'
            },
            caddress: {
                required: '*) Address is required'
            },
            tlp: {
                required: '*) Phone number is required'
            },            
            jdate: {
                required: '*) Date is required'
            },
            email: {
                required: '*) Email is required'
            }
        },
        submitHandler: function (form) {
            var com_action = $('#action').val();
            if(com_action == 'add') {
                ajaxAction('add');
            }else if(com_action == 'edit') {
                ajaxAction('edit');
            }

            $('#form_vendor').trigger('reset');
        }
    });//end validate
    $.validator.addMethod("pwcheck", function (value, element, regexpr) {
        return regexpr.test(value);
    });
    
    $('#jdate').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

});

function ajaxAction(action) {
    data = $('#form_vendor').serializeArray();      
    var table = $('#lookup').DataTable();

    v_dump = $.ajax({
        url: 'application/vendor/data.php',
        type: 'POST',
        dataType: 'JSON',
        data: data,        
        success: function(response) {
            $('#add_model').modal('hide');            
            table.ajax.reload();            
        }
    });
}
