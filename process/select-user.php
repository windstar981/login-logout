<?php

if(isset($_POST['id_department']))
{
    include('../config/db_connect.php');
    $id_department = $_POST['id_department'];
    if($id_department == 0)
    {
        $query = "SELECT * FROM users";
    }
    else
    {
        $query = "SELECT * FROM users WHERE dep_id = '$id_department'";
    }
    $res = mysqli_query($conn, $query);
    $html = '';
    $i = 0;
    while($row = mysqli_fetch_assoc($res)){
        $html .='<tr>
                    <th scope="row">'.++$i.'</th>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['role'].'</td>
                    <td><button class="edit-user btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="fa-solid fa-user-pen"></i></button></td>
                    <td><button class="delete-user btn btn-danger" data-id="'.$row['id'].'"><i class="fa-solid fa-trash"></i></button></td>
                    <td><button class="reset-password btn btn-info" data-id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#exampleModal-reset-password"><i class="fa-solid fa-gear"></i></button></td>
                </tr>';
    }
    echo $html;
}
?>