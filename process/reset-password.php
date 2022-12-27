<?php
session_start();
if(isset($_SESSION['id'])) {
    if(empty($_POST['id_user'] && empty($_POST['password'])) ){
        $id = $_POST['id_user'];
        include('../config/db_connect.php');
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result))
        {
            $pass = $_POST['password'];
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$pass_hash' WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "Update successfully";
            }
            else{
                echo "Update failed";
            }
        }
        else{
            echo "No exist user";
        }
    }
    else{
        echo "Password is Required";
    }
}

?>