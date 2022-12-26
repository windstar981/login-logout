<?php
session_start();
include('../config/db_connect.php');
if(isset($_SESSION['id']))
{
    if(empty($_POST['name']))
    {
        echo "Please enter full information";
    }
    else
    {
        $name = $_POST['name'];
        $sql = "INSERT INTO departments (name) VALUES ('$name')";
        if(mysqli_query($conn, $sql))
        {
            echo "success";
        }
        else
        {
            echo "Add department failed";
        }
    }
}