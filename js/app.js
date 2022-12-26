
$(document).ready(function (){
    $('#password').keyup(function (){

        var password = $(this).val();
        console.log(password);
        var regExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;
        var valid = regExp.test(password);
        console.log(valid);

        if(valid){
            $('.val-pass').addClass('d-none');
            $('.btn-register').attr('type', 'submit');
        }else{
            $('.val-pass').removeClass('d-none');

        }
    });

});