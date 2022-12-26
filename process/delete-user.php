<?php
session_start();
if(isset($_SESSION['id']))
{
    if(isset($_POST['id_user']))
    {
        include('../config/db_connect.php');
        $id = $_POST['id_user'];
        if($id == $_SESSION['id']){
            echo  "deletetion failed";
            exit();
        }

        $sql = "DELETE FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            echo "success";
        }
        else
        {
            echo "deletetion failed";
        }
    }
}

?>