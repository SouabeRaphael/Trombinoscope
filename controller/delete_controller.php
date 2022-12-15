<?php 

require_once __DIR__ . '/../libraries/db.php';
require_once __DIR__ . '/../functions/functions.php';

$id = $_GET['grade_id'];
// echo $id;
$student_id = $_GET['student_id'];

function delete($grade_id, $users_id ){

    $db = db_connect();

    $deleteUserInfo = "DELETE FROM `infos_users` WHERE users_id = $users_id";
    $db->exec($deleteUserInfo);
        
    $deleteUsers = "DELETE FROM `users` WHERE users_id = $users_id";
    $db->exec($deleteUsers);

    $deleteImageUser = "DELETE FROM `images` WHERE user_id = $users_id";
    $db->exec($deleteImageUser);

    header("Location: /Trombinoscope/vue/archive_student.php?grade_id=$grade_id");
}
delete($id, $student_id)
?>