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
$query = "SELECT * FROM users";
$res = mysqli_query($conn, $query);
$total_records = mysqli_num_rows($res);
$total_page = ceil($total_records / 10);
$sql_department = "SELECT * FROM departments";
$result_department = mysqli_query($conn, $sql_department);
$users = mysqli_fetch_all($res, MYSQLI_ASSOC);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * 10;
$end = $start + 10;
if($end > $total_records)
{
    $end = $total_records;
}
?>
<!DOCTYPE html>
<html lang="zxx">
<?php require_once("templates/header.php");?>
<div class="container mt-5">
    <div class="row">
        <div class="mb-5 d-block col-6">
            <select class="form-select" id="select-department" aria-label="Default select example">
                <option value="0" selected>All department</option>
                <?php
                while($row = mysqli_fetch_assoc($result_department)){
                    echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-6 ">
            <form class="d-flex">
                <input class="form-control me-2 search-user" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success btn-search-user" type="button">Search</button>
            </form>
        </div>
    </div>

    <div class="d-flex">
        <button class="btn btn-info btn-add-user" style="width: 110px; margin-right: 15px" data-bs-toggle="modal" data-bs-target="#exampleModal-add-user">Add user</button>
        <select class="form-select select-number-row-user" aria-label="Default select " style="width: 80px">
            <option value="0">All</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>

        </select>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            <th scope="col">Reset password</th>
        </tr>
        </thead>
        <tbody id="tb-user">
        <?php $i = 0; for($i=$start; $i<$end ; $i++){ ?>
            <tr>
                <th scope="row"><?php echo $i+1; ?></th>
                <td><?php echo $users[$i]['name'] ?></td>
                <td><?php echo $users[$i]['email'] ?></td>
                <td><?php echo $users[$i]['role'] < 1 ?  'member' :   'admin';?></td>
                <td><button class="edit-user btn btn-primary" data-id="<?php echo $users[$i]['id'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="fa-solid fa-user-pen"></i></button></td>
                <td><button  class="delete-user btn btn-danger" data-id="<?php echo $users[$i]['id'] ?>"><i class="fa-solid fa-trash"></i></button></td>
                <td><button class="reset-password btn btn-info" data-id="<?php echo $users[$i]['id'] ?>"data-bs-toggle="modal" data-bs-target="#exampleModal-reset-password"><i class="fa-solid fa-gear"></i></button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="manage-users.php?page=<?php echo $page > 1 ? $page-1 : 1 ?>">Previous</a></li>
            <?php
            for($i = 1; $i <= $total_page; $i++){
                if($i == $page){
                    echo "<li class='page-item active'><a class='page-link' href='manage-users.php?page=$i'>$i</a></li>";
                }
                else{
                    echo "<li class='page-item'><a class='page-link' href='manage-users.php?page=$i'>$i</a></li>";
                }
            }
            ?>
            <li class="page-item"><a class="page-link" href="manage-users.php?page=<?php echo $page <  $total_page ? $page+1 : $total_page ?>">Next</a></li>
        </ul>
    </nav>

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
                <div class="input-group mb-3">
                    <span class="input-group-text ">Email</span>
                    <input type="text" aria-label="First name" class="form-control user-email">
                </div>
                <select class="form-select edit-user-select-role" aria-label="Default select example">

                </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary user-id save-user" data-id="">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal reset password-->
<div class="modal fade" id="exampleModal-reset-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text ">Password</span>
                    <input type="text" aria-label="First name" id="password" class="form-control user-reset-password">
                    <label style="font-size:10px; color:red;" class="d-none val-pass" for="password">Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-reset-password" data-id="">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal add user-->
<div class="modal fade" id="exampleModal-add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-2">
                    <span class="input-group-text ">Name</span>
                    <input type="text" aria-label="First name" class="form-control add-user-name">
                </div>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-text ">Email</span>
                    <input type="text" aria-label="First name" class="form-control add-user-email">
                </div>
                <div class="input-group">
                    <label style="font-size:10px; color:red; margin-top:10px;" class="d-none val-email" for="email">Email already exists</label>
                </div>

            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-text ">Password</span>
                    <input type="text" aria-label="First name" id="password" class="form-control add-user-password">
                    <label style="font-size:10px; color:red;" class="d-none val-pass" for="password">Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</label>
                </div>
            </div>
            <div class="modal-body">
                <select class="form-select add-user-select-role" aria-label="Default select example">
                    <option value="1">Admin</option>
                    <option value="0" selected>User</option>
                </select>
            </div>
            <?php $sql_department = "SELECT * FROM departments";
            $result_department = mysqli_query($conn, $sql_department); ?>
            <div class="modal-body">
                <select class="form-select select-department-add"  aria-label="Default select example">
                    <?php
                    while($row = mysqli_fetch_assoc($result_department)){
                        echo "<option selected value='".$row['id']."'>".$row['name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-add-user-submit" >Submit</button>
            </div>
        </div>
    </div>
</div>
<?php require_once("templates/footer.php"); ?>
<script src="js/manage-user.js"></script>
</html>
