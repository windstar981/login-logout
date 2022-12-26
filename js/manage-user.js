$(document).ready(function () {
    $('.edit-user').click(function () {
        var id = $(this).attr('data-id');

        $.ajax({
            url: "./process/edit-user.php",
            type: "POST",
            dataType: "html",
            data: {'id_user': id},
            success: function (data) {
                const obj = JSON.parse(data);
                $('.user-name').val(obj.name);
                $('.user-email').val(obj.email);
                $('.user-id').attr('data-id', obj.id);
            },
        });
    });

    $('.save-user').click(function() {
        event.preventDefault()
        var id = $(this).attr('data-id');
        var name = $('.user-name').val();
        var email = $('.user-email').val();

        if(name == '') {
            alert('Name is required');
        }
        else{
            if(email == '') {
                alert('Email is required');
            }
            else{
                $.ajax({
                    url: "./process/save-user.php",
                    type: "POST",
                    dataType: "html",
                    data: {'id_user': id, 'name': name, 'email': email},
                    success: function (data) {
                        if(data=="success"){
                            alert('User updated successfully');
                            window.location.reload();
                        }
                        else{
                            alert(data);
                            window.location.reload();
                        }
                    }
                });
            }
        }

    });

    $('.delete-user').click(function() {
        var id = $(this).attr('data-id');

        $.ajax({
            url: "./process/delete-user.php",
            type: "POST",
            dataType: "html",
            data: {'id_user': id},
            success: function (data) {
                if(data=="success"){
                    alert('User deleted successfully');
                    window.location.reload();
                }
                else{
                    alert(data);
                    window.location.reload();
                }
            }
        });
    });
    $('.reset-password').click(function() {
        var id = $(this).attr('data-id');
        $('.save-reset-password').attr('data-id', id);

    });
    $('.save-reset-password').click(function() {
        var id = $(this).attr('data-id');
        let pass = $('.user-reset-password').val();
        $.ajax({
            url: "./process/reset-password.php",
            type: "POST",
            dataType: "html",
            data: {'id_user': id, 'password': pass},
            success: function (data) {
                if(data=="success"){
                    alert('Password reset successfully');
                    window.location.reload();
                }
                else{
                    alert(data);
                    window.location.reload();
                }
            }
        });
    });
    $('.btn-add-user-submit').click(function() {
        let name = $('.add-user-name').val();
        let email = $('.add-user-email').val();
        let pass = $('.add-user-password').val();
        if(name == '') {
            alert('Name is required');
        }
        else{
            if(email == '') {
                alert('Email is required');
            }
            else{
                if(pass == '') {
                    alert('Password is required');
                }
                else{
                    $.ajax({
                        url: "./process/add-user.php",
                        type: "POST",
                        dataType: "html",
                        data: {'name': name, 'email': email, 'password': pass},
                        success: function (data) {
                            if(data=="success"){
                                alert('User added successfully');
                                window.location.reload();
                            }
                            else{
                                alert(data);
                                window.location.reload();
                            }
                        }
                    });
                }
            }
        }

    });
});