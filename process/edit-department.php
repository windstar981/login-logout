<?php
session_start();
if(isset($_SESSION['id']))
{


    if(empty($_POST['id_department']))
    {
        //tra ve loi 1
        echo "No department";
    }
    else
    {
        include('../config/db_connect.php');
        $id = $_POST['id_department'];
        $sql = "SELECT * FROM departments WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $department = mysqli_fetch_assoc($result);
            $arrKey = ['id', 'name'];
            $arrValue = [];
            $arrValue = [$department['id'], $department['name']];
            $arrRes = array_combine($arrKey, $arrValue);
            echo json_encode($arrRes);
        }
        else
        {
            echo "Edit department failed";
        }
    }
}
?>