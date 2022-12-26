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

                header('location:index.php');

                exit;

            }

        }

    }
else
{
    header('location:index.php'); //chuyển qua trang đăng nhập thành công
    exit;
}
if (isset($_POST['submit-login'])) {
    $remember = ((isset($_POST['remember']) != 0) ? 1 : "");
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * From users where email = '$email'";
    $res = mysqli_query($conn, $query);
    $row = mysqli_num_rows($res);

    if ($row > 0) {
        $user_logged = mysqli_fetch_assoc($res);
        $pass_saved = $user_logged['password'];
        if (password_verify($password, $pass_saved)) {


            $_SESSION['email'] = $user_logged['email'];
            $_SESSION['name'] = $user_logged['name'];
            $_SESSION['id'] = $user_logged['id'];
            $_SESSION['password'] = $user_logged['password'];
            if ($remember == 1)
            {
                setcookie('email', $user_logged['email'],  time() + 3600 * 24 * 30);
                setcookie('password', $user_logged['password'],  time() + 3600 * 24 * 30);
            }
            header('Location: index.php');
        } else {
            $errors['all'] = "Tên đăng nhập hoặc mật khẩu không chính xác";
            $email = $password  = "";
        }
    } else {
        $errors['all'] = "Tên đăng nhập hoặc mật khẩu không chính xác";
        $email = $password  = "";
    }
}

?>


<!DOCTYPE html>
<html lang="zxx">

<?php require_once("templates/header.php") ?>

<div class="site-wrapper mt-5" id="top" >
    <!--==============================================Login Register page content==============================================-->
    <main class="page-section inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body">
                                <div class="row justify-content-center">

                                    <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">
                                        <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>

                                        <form class="mx-1 mx-md-4 form-login" method="POST">
                                            <?php if (isset($_POST['submit-login'])) : ?>
                                                <div class="alert alert-danger text-center" role="alert">
                                                    <?php echo $errors['all'] ?>
                                                </div>
                                            <?php endif; ?>
                                            <form class="mx-1 mx-md-4 form-login" method="POST">

                                                <div class="row">
                                                    <div class="col-md-12 col-12 mb--15">
                                                        <label for="email">Email</label>
                                                        <input class="mb-0 form-control" name="email" type="email" id="email1" placeholder="Enter Email...">
                                                    </div>
                                                    <div class="col-12 mb--20">
                                                        <label for="password">Password</label>
                                                        <input class="mb-0 form-control" name="password" type="password" id="login-password" placeholder="Enter password">
                                                    </div>

                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" value="" id="form2Example31" checked />
                                                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                                                </div>
                                                <p class="font-weight-bold">Do you have account? <a href="register.php" class="link-info text-primary">Register here!!</a></p>

                                                <div class="pt-1 mb-4 ">
                                                    <button class="btn btn-dark btn-lg w-100" name="submit-login" type="submit">Login</button>
                                                </div>
                                            </form>

                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">

                                        <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</div>

<?php require_once("templates/footer.php") ?>


</html>