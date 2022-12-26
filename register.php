<?php
include('config/db_connect.php');
$name = $pass = $cpass = $email = '';
$errors = [];

if (isset($_POST['register'])) {

    if (empty($_POST['email'])) {
        $errors[] = 'Hãy nhập Email';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ';
        }
    }
    if (empty($_POST['name'])) {
        $errors[] = 'Hãy nhập tên của bạn';
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Hãy nhập mật khẩu';
    } else {
        $pass = $_POST['password'];
    }
    if (empty($_POST['cpassword'])) {
        $errors[] = 'Hãy nhập lại mật khẩu';
    } else {
        $cpass = $_POST['cpassword'];
        if ($cpass != $pass) {
            $errors[] = 'Mật khẩu không khớp';
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
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng ký</p>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <?php foreach ($errors as $error) : ?>
                                                <div> <?php echo $error; ?> </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="register.php" method="post">

                                        <div class="row">
                                            <div class="col-md-12 col-12 mb-3">
                                                <label for="email">Họ và tên</label>
                                                <input Required class="mb-0 form-control"
                                                       value="<?php echo htmlspecialchars($name) ?>" name="name"
                                                       type="text" id="name" placeholder="Họ và tên">

                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="email">Email</label>
                                                <input Required class="mb-0 form-control"
                                                       value="<?php echo htmlspecialchars($email) ?>" name="email"
                                                       type="email" id="email" placeholder="Email">
                                            </div>

                                            <div class="col-lg-6 mb-3">
                                                <label for="password">Mật khẩu</label>
                                                <input Required class="mb-0 form-control"
                                                       value="<?php echo htmlspecialchars($pass) ?>" name="password"
                                                       type="password" id="password" placeholder="Mật khẩu">
                                            </div>
                                            <div class="col-lg-6 mb--20">
                                                <label for="password">Nhập lại mật khẩu</label>
                                                <input Required class="mb-0 form-control" name="cpassword"
                                                       type="password" value="<?php echo htmlspecialchars($cpass) ?>"
                                                       id="repeat-password" placeholder="Nhập lại mật khẩu">
                                            </div>
                                            <div class="col-md-12">
                                                <button name="register" class="btn btn-success">Đăng ký</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="font-weight-bold">Bạn đã có tài khoản? <a href="login.php" class="link-info text-primary">Đăng nhập tại đây</a></p>

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