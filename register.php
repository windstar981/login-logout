<?php
include('config/db_connect.php');
$name = $pass = $cpass = $email = '';
$errors = [];

if (isset($_POST['register'])) {

    if (empty($_POST['email'])) {
        $errors[] = 'Please enter Email';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email';
        }
    }
    if (empty($_POST['name'])) {
        $errors[] = 'Please enter your name';
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Please enter password';
    } else {
        $pass = $_POST['password'];
    }
    if (empty($_POST['cpassword'])) {
        $errors[] = 'Please re-enter your password';
    } else {
        $cpass = $_POST['cpassword'];
        if ($cpass != $pass) {
            $errors[] = 'Password incorrect';
        }
    }
    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($conn, $query);

        $user = mysqli_num_rows($res);
        if ($user >= 1) {
            $errors['email'] = 'Email đã tồn tại';
        } else {
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$pass_hash')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // echo "<script> alert('Đăng ký thành công'); </script>";
                header("Location: login.php?status=0");
            } else {
                echo "Đăng ký thất bại";
            }
        }
    }
}


?>


<!DOCTYPE html>
<html lang="zxx">

<?php require_once("templates/header.php") ?>

<div class="site-wrapper mt-5" id="top">
    <!--==============================================Login Register page content==============================================-->
    <main class="page-section inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body ">
                            <div class="row justify-content-center">

                                <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <?php foreach ($errors as $error) : ?>
                                                <div> <?php echo $error; ?> </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form id="form-register" action="register.php" method="post">

                                        <div class="row">
                                            <div class="col-md-12 col-12 mb-3">
                                                <label for="email">Full name</label>
                                                <input Required class="mb-0 form-control"
                                                       value="<?php echo htmlspecialchars($name) ?>" name="name"
                                                       type="text" id="name" placeholder="Full name">

                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="email">Email</label>
                                                <input Required class="mb-0 form-control"
                                                       value="<?php echo htmlspecialchars($email) ?>" name="email"
                                                       type="email" id="email" placeholder="Email">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label for="password">Password</label>
                                                <input Required class="mb-0 form-control"
                                                       value="<?php echo htmlspecialchars($pass) ?>" name="password"
                                                       type="password" id="password" placeholder="Mật khẩu">
                                                <label style="font-size:10px; color:red;" class="d-none val-pass" for="password">Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</label>
                                            </div>
                                            <div class="col-lg-6 mb--20">
                                                <label for="password">Re-enter password</label>
                                                <input Required class="mb-0 form-control" name="cpassword"
                                                       type="password" value="<?php echo htmlspecialchars($cpass) ?>"
                                                       id="repeat-password" placeholder="Nhập lại mật khẩu">
                                            </div>
                                            <div class="col-md-12">
                                                <button name="register" type="button"  class="btn btn-success btn-register">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="font-weight-bold">Did you have account? <a href="login.php" class="link-info text-primary">Login here!</a></p>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png"
                                         class="img-fluid" alt="Sample image">
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