<?php
session_abort();
session_start();
if(isset($_SESSION['id']))
{
    if(empty($_POST['id_user']))
    {
        //tra ve loi 1
        echo "No id";
        exit();
    }
    else
    {
        include('../config/db_connect.php');
        $id = $_POST['id_user'];
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                echo "success";
                exit();
            }
            else
            {
                echo "No user exists";
                exit();
            }
        }
        else
        {
            echo "No user exists";
            exit();
        }
    }
}
?>