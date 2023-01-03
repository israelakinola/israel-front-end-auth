jQuery( document ).ready( function( $ ) {
   $('#israel-front-end-auth-modal-form-login').submit(function(event){
    event.preventDefault(); //Prevent the default form submit
    //serlize the form data
    let form_data = $('#israel-front-end-auth-modal-form-login').serialize();
    //add ajax check as X-Requested-With 
    form_data += '&ajaxrequest=true&submit=Submit+Form';
    //Get admin ajax url
    ajax_url = event.target[0].value

    //Setup Ajax request
    $.ajax({
        url: ajax_url,
        type: 'POST',
        data: form_data 
    })
    .done(function (response){
        
        if(response == true){
            console.log(response)
            location.reload();
        }else{
            console.log(response)
             $('#israel-front-end-auth-modal-form-login_error').html(response)
        }
       
    })
    .fail(function (response){
        console.log("Failed");
        $('#israel-front-end-auth-modal-form-login_error').html(response)
        return;
        
    })


    })


});