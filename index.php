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

<?php require_once("templates/footer.php"); ?>

</html>
