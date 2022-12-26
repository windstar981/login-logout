<?php
session_start();
if(isset($_SESSION['id']))
{
    if(isset($_POST['id_department']))
    {
        include('../config/db_connect.php');
        $id = $_POST['id_department'];
        $sql = "DELETE FROM departments WHERE id = $id";
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