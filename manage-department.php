<?php
session_start();
include('config/db_connect.php');
if(isset($_SESSION['id']))
{
    $id = $_SESSION['id'];

    $query = "SELECT * FROM users WHERE id = '$id'";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($res);
    $name = $user['name'];
    $email = $user['email'];
    $password = $user['password'];
    $role = $user['role'];
    if($role<1){
        header("Location: index.php");
    }
}
else{
    header("Location: index.php");
}
$query = "SELECT * FROM departments";
$res = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="zxx">
<?php require_once("templates/header.php");?>
<div class="container mt-5">
    <button class="btn btn-info btn-add-user" data-bs-toggle="modal" data-bs-target="#exampleModal-add-user">Add department</button>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; while($user = mysqli_fetch_assoc($res)){ ?>
            <tr>
                <th scope="row"><?php echo ++$i; ?></th>
                <td><?php echo $user['name'] ?></td>
                <td><button class="edit-department btn btn-primary" data-id="<?php echo $user['id'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="fa-solid fa-user-pen"></i></button></td>
                <td><button  class="delete-department btn btn-danger" data-id="<?php echo $user['id'] ?>"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
<!-- Modal edit user-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text ">Name</span>
                    <input type="text" aria-label="First name" class="form-control user-name">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary user-id save-department" data-id="">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal add user-->
<div class="modal fade" id="exampleModal-add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-2">
                    <span class="input-group-text ">Name</span>
                    <input type="text" aria-label="First name" class="form-control add-department-name">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-add-department-submit" >Submit</button>
            </div>
        </div>
    </div>
</div>
<?php require_once("templates/footer.php"); ?>
<script src="js/manage-department.js"></script>
</html>
