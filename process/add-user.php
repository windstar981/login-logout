<?php
session_abort();
session_start();
include('../config/db_connect.php');
if(isset($_SESSION['id']))
{
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']))
    {
        echo "Please enter full information";
    }
    else
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pass_has = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass_has')";
        if(mysqli_query($conn, $sql))
        {
            echo "success";
        }
        else
        {
            echo "Add user failed";
        }
    }
}