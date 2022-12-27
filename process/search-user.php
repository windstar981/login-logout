<?php
if(isset($_POST['name']) && isset($_POST['dep_id']) && isset($_POST['limit']))
{
    include('../config/db_connect.php');
    $name = $_POST['name'];
    $dep_id = $_POST['dep_id'];
    $limit = $_POST['limit'];
    if($limit == 0)
    {
        if($dep_id == 0)
        {
            $query = "SELECT * FROM users WHERE name LIKE '%$name%'";
        }
        else
        {
            $query = "SELECT * FROM users WHERE name LIKE '%$name%' AND dep_id = '$dep_id'";
        }
    }
    else
    {
        if($dep_id == 0)
        {
            $query = "SELECT * FROM users WHERE name LIKE '%$name%' LIMIT $limit";
        }
        else
        {
            $query = "SELECT * FROM users WHERE name LIKE '%$name%' AND dep_id = '$dep_id'  LIMIT $limit";
        }
    }
    $res = mysqli_query($conn, $query);
    $html = '';
    $i = 0;
    while($row = mysqli_fetch_assoc($res)){
        $role = $row['role'] > 0 ? 'admin' : 'member';
        $html .='<tr>
                    <th scope="row">'.++$i.'</th>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$role.'</td>
                    <td><button class="edit-user btn btn-primary" data-id="'.$row['id'].'" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="fa-solid fa-user-pen"></i></button></td>
                    <td><button class="delete-user btn btn-danger" data-id="'.$row['id'].'"><i class="fa-solid fa-trash"></i></button></td>
                    <td><button class="reset-password btn btn-info" data-id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#exampleModal-reset-password"><i class="fa-solid fa-gear"></i></button></td>
                </tr>';
    }
    echo $html;
}
?>