function formSubmit(formid,route,method="POST") {
    $.ajax({
        url: route,
        type: method,
        data: $('#'+formid).serialize(),
        success: function(data) {
            if(data.status == 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: `${data.message}`,
                    button:false,
                    timer: 3000
                });
                window.location = data.redirect;
            }else{
                $.each(data['errors'], function (key, value) {
                    $('.error_'+key).html(value);
                });
            }
        }
    });
}

function removeErrors(){
    // class based loop 
    $('.field_errors').each(function(){
        $(this).html('');
    });
}