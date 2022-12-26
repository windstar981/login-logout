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
                console.log(obj);
                $('.user-name').val(obj.name);
                $('.user-email').val(obj.email);
                $('.user-id').attr('data-id', obj.id);
                let html = '';
                if (obj.role == 1) {
                    html += `<option value="1" selected>Admin</option>
                            <option value="0">User</option>`;
                }
                else
                {
                    html += `<option value="1">Admin</option>
                            <option value="0" selected>User</option>`;
                }
                $('.edit-user-select-role').html(html);
            },
        });
    });

    $('.save-user').click(function() {
        event.preventDefault()
        var id = $(this).attr('data-id');
        var name = $('.user-name').val();
        var email = $('.user-email').val();
        var role = $('.edit-user-select-role').val();
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
                    data: {'id_user': id, 'name': name, 'email': email, 'role': role},
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
        let regExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;
        if(regExp.test(pass)) {
            $.ajax({
                url: "./process/reset-password.php",
                type: "POST",
                dataType: "html",
                data: {'id_user': id, 'password': pass},
                success: function (data) {
                    if (data == "success") {
                        alert('Password reset successfully');
                        window.location.reload();
                    } else {
                        alert(data);
                        window.location.reload();
                    }
                }
            });
        }
    });
    $('.btn-add-user-submit').click(function() {
        let name = $('.add-user-name').val();
        let email = $('.add-user-email').val();
        let pass = $('.add-user-password').val();
        var regExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;

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
                    if(!regExp.test(pass)){
                        alert('Password must have at least 8 characters, 1 uppercase, 1 lowercase, 1 number and 1 special character');
                    }
                    else {
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
        }

    });
});