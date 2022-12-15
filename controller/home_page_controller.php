<?php 
require_once __DIR__ . '/../libraries/db.php';

// function if_is_connect() {
//     if(session_status() == PHP_SESSION_NONE) {
//         session_start();
//     }
//     return !empty($_SESSION['id']);
// }

// @@@
// fonction qui va chercher tout les elements de la tables grades
// @@@
function get_grade(){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `grades`
    EOD;
    $GradeStmt = $db->query($sql);
    $GradeStmt->execute();
    $Grade = $GradeStmt->fetchAll(PDO::FETCH_ASSOC);

    return $Grade;
}
$array_grade = get_grade();
// var_dump($array_grade);

// fonction qui verifi si les champs sont bien defini et pas vide
function get_verify(){
    return(isset($_POST['grade']) and !empty($_POST['grade']));
}

// @@@
// fonction qui ajoute l'utilisateur à la table `user`
// @@@
function get_verify_grade(){
    if(get_verify()){
        $grade = $_POST['grade'];
        $db = db_connect();
        
        $addGrade = "INSERT INTO grades (grade_name) VALUES ('$grade')";
        $db->exec($addGrade);
        // echo "bon";

        header('Location: /Trombinoscope/vue/home_page.php');
    }
}
get_verify_grade();


?>