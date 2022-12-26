$(document).ready(function () {

    $('.edit-department').click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "./process/edit-department.php",
            type: "POST",
            dataType: "html",
            data: {'id_department': id},
            success: function (data) {
                const obj = JSON.parse(data);
                console.log(obj);
                $('.user-name').val(obj.name);
                $('.user-id').attr('data-id', obj.id);
            },
        });
    });

    $('.save-department').click(function () {
        event.preventDefault()
        var id = $(this).attr('data-id');
        var name = $('.user-name').val();
        if (name == '') {
            alert('Name is required');
        } else {
            $.ajax({
                url: "./process/save-department.php",
                type: "POST",
                dataType: "html",
                data: {'id_department': id, 'name': name},
                success: function (data) {
                    if (data == "success") {
                        alert('Department updated successfully');
                        window.location.reload();
                    } else {
                        alert(data);
                        window.location.reload();
                    }
                }
            });

        }

    });

    $('.delete-department').click(function () {
        var id = $(this).attr('data-id');

        $.ajax({
            url: "./process/delete-department.php",
            type: "POST",
            dataType: "html",
            data: {'id_department': id},
            success: function (data) {
                if (data == "success") {
                    alert('Department deleted successfully');
                    window.location.reload();
                } else {
                    alert(data);
                    window.location.reload();
                }
            }
        });
    });

    $('.btn-add-department-submit').click(function () {
        let name = $('.add-department-name').val();

        if (name == '') {
            alert('Name is required');
        } else {
            $.ajax({
                url: "./process/add-department.php",
                type: "POST",
                dataType: "html",
                data: {'name': name},
                success: function (data) {
                    if (data == "success") {
                        alert('Department added successfully');
                        window.location.reload();
                    } else {
                        alert(data);
                        window.location.reload();
                    }
                }
            });
        }
    });

});