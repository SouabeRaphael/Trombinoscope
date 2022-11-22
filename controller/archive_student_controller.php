<?php
require_once __DIR__ . '/../libraries/db.php';


function get_name_id($id){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `grades`
    WHERE grade_id = $id
    EOD;
    $GradeIdStmt = $db->query($sql);
    $GradeIdStmt->execute();
    $GradeId = $GradeIdStmt->fetchAll(PDO::FETCH_ASSOC);

    return $GradeId;
}

function get_students($id){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `users`
    NATURAL JOIN `infos_users`
    WHERE users_id = $id
    EOD;
    $userStmt = $db->query($sql);
    $userStmt->execute();
    $users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
} 

function get_students_grade($id){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `users`
    NATURAL JOIN `infos_users`
    WHERE grade_id = $id
    EOD;
    $userStmt = $db->query($sql);
    $userStmt->execute();
    $users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

function get_spe($spe_id){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `specialities`
    where spe_id = $spe_id
    EOD;
    $speStmt = $db->query($sql);
    $speStmt->execute();
    $spe = $speStmt->fetchAll(PDO::FETCH_ASSOC);

    return $spe;
}

function get_img($img_id){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `images`
    WHERE image_id = $img_id
    EOD;
    $userStmt = $db->query($sql);
    $userStmt->execute();
    $users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}


?>