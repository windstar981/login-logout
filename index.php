<?php
session_start();

include('config/db_connect.php');
if (empty($_SESSION['email']))
{
    if (isset($_COOKIE["email"]) && isset($_COOKIE["password"]))
    {
        $email = $_COOKIE["email"];
        $password = $_COOKIE["password"];
        $sql2 = "select * from users where email='$email' and password='$password'";


        $result2 = mysqli_query($conn, $sql2);
        if ($result2)
        {
            $user_logged = mysqli_fetch_assoc($result2);
            $_SESSION['email'] = $user_logged['email'];
            $_SESSION['name'] = $user_logged['name'];
            $_SESSION['id'] = $user_logged['id'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="zxx">

<?php require_once("templates/header.php") ?>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="manage-users.php">Quản lý user</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <div>
                    <div class="dropdown">
                        <p class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                                if(isset($_SESSION['name'])) {
                                    echo $_SESSION['name'];
                                } else {
                                    echo "Tài khoản";
                                }
                            ?>
                        </p>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php
                                if(isset($_SESSION['name'])) {
                                    echo '<li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>';
                                } else {
                                    echo '<li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>';
                                    echo '<li><a class="dropdown-item" href="register.php">Đăng ký</a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</div>
<?php require_once("templates/footer.php"); ?>

</html>
