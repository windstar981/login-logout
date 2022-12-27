$(document).ready(function (){
    function changeStyleRedirect(){
        let url = $(location).attr('href');
        let urlArr = url.split('?');
        let urlSplit = urlArr[0].split('/');
        let urlLast = urlSplit[urlSplit.length-1];
        $('.url-redirect-manage-user').removeClass("btn-success");
        $('.url-redirect-manage-department').removeClass("btn-success");
        $('.url-redirect-home').removeClass("btn-success");
        $('.url-redirect-manage-user').removeClass("color-btn-redirect");
        $('.url-redirect-manage-department').removeClass("color-btn-redirect");
        $('.url-redirect-home').removeClass("color-btn-redirect");
        console.log(urlLast);
        if(urlLast == 'manage-users.php'){
            $('.url-redirect-manage-user').addClass("btn-success");
            $('.url-redirect-manage-user').addClass("color-btn-redirect");
        }
        else if(urlLast == 'manage-department.php'){
            $('.url-redirect-manage-department').addClass("btn-success");
            $('.url-redirect-manage-department').addClass("color-btn-redirect");
        }
        else {
            $('.url-redirect-home').addClass("btn-success");
            $('.url-redirect-home').addClass("color-btn-redirect");
        }
    }
    changeStyleRedirect();
    $('#password').change(function (){

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