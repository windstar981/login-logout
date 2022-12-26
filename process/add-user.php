<?php
session_abort();
session_start();
include('../config/db_connect.php');
if(isset($_SESSION['id']))
{
    var_dump($_POST);
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['role']) || empty($_POST['dep']))
    {
        echo "Please enter full information";
    }
    else
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $dep_id = $_POST['dep'];
        $pass_has = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (dep_id, name, email, password, role) VALUES ('$dep_id','$name', '$email', '$pass_has', '$role')";
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