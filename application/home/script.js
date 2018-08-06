$(document).ready(function (){
    
    v_dump = $.ajax({
        url: 'application/home/data.php',
        type: 'post',
        dataType: 'json',
        success: function(data) {
            $('#kepuasan').html(data.jKepuasan);
            $('#keluhan').html(data.jKeluhan);
            $('#tClient').html(data.jClient);
        }
    });
    
    console.log(v_dump)
});