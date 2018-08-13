var session = '';

$(document).ready(function () {
    session = $('#session').val();
    
    var validator = $('#form_checkin').validate({
        rules: {
            noreg: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            noreg: {
                required: '*) No. Registration is required',
                minlength: 'At least 6 Char'
            }
        },
        submitHandler: function (form) {
            ajaxLogin();
            $('#form_checkin').trigger('reset');
        }
    });
    console.log(session)
    $('#uservote').html(session);
});

function ajaxLogin() {
    data = $('#form_checkin').serializeArray();
    url = 'application/home/data.php';
    
    v_login = $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        success: function (data, textStatus, jqXHR) {
            //if data == 0, user allow to vote
            if(data == 0) {
                
            }
            //window.location.reload();
        }
    });           
}
