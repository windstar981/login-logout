<?php
session_start();
if(isset($_SESSION['id']))
{


    if(empty($_POST['id_user']))
    {
        //tra ve loi 1
        echo "err1";
    }
    else
    {
        include('../config/db_connect.php');
        $id = $_POST['id_user'];
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $user = mysqli_fetch_assoc($result);
            $arrKey = ['id', 'name', 'email', 'password','role'];
            $arrValue = [];
            $arrValue = [$user['id'], $user['name'], $user['email'], $user['password'],$user['role']];
            $arrRes = array_combine($arrKey, $arrValue);
            echo json_encode($arrRes);
        }
        else
        {
            echo "err2";
        }
    }
}
?>