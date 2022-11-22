<?php 
require_once __DIR__ . '/../libraries/db.php';
require_once __DIR__ . '/../functions/functions.php';


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

function get_specialities(){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `specialities`
    EOD;
    $speStmt = $db->query($sql);
    $speStmt->execute();
    $spe = $speStmt->fetchAll(PDO::FETCH_ASSOC);

    return $spe;
}

// @@@
// fonction qui verifie si les champ son declaré
// @@@
function verify_post(){
    return isset($_POST['first_name']) && isset($_POST['last_name']) 
    && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['city']) 
    && isset($_POST['birth']) && isset($_POST['grade']) && isset($_POST['speciality']) 
    && isset($_POST['password']);
}

// @@@
// fonction qui verifie si les champ son vide
// @@@
function verify_empty_post(){
    return empty($_POST['first_name']) && empty($_POST['last_name']) 
    && empty($_POST['email']) && empty($_POST['tel']) && empty($_POST['city']) 
    && empty($_POST['birth']) && empty($_POST['grade']) && empty($_POST['speciality']) 
    && empty($_POST['password']);
}

// @@@
// fontion qui crée un url avec en parametre les erreur
// @@@
function redirect_error($result){
    header("Location: http://localhost:8888/trombinoscope/vue/signup.php?error=$result"); 
}

// @@@
// fonction qui envoie l'utilisatieur sur le dashboard si la connection est bonne
// @@@
function redirect_home_page(){
    header("Location: http://localhost:8888/trombinoscope/vue/home_page.php"); 
}

function change_date(){
    $oldDate = new DateTime($_POST['birth']);
    $newDate = $oldDate->format('Y-m-d 00:00:00');
    
    return $newDate;
}

function calc_age($age){
    $birth = $age;
    $today = date('Y-m-d');
    $diff = date_diff(date_create($birth), date_create($today));

    return $diff->format('%y');
}

function get_id_users($first_name, $last_name) {

    $db = db_connect();
    $sql = <<<EOD
    SELECT
        users_id
    FROM
        `users`
    WHERE first_name = '$first_name' 
    AND last_name = '$last_name'
    EOD;
    $GradeIdStmt = $db->query($sql);
    $GradeIdStmt->execute();
    $GradeId = $GradeIdStmt->fetchAll(PDO::FETCH_ASSOC);

    $id = $GradeId[0]['users_id'];
    return $id;
}

function verify_regex($regex, $name){
    if(preg_match($regex, $name)){
        return true;
    }
    else{
        return false;
    }
}

function create_users(){

    $db = db_connect();

    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $grade = $_POST['grade'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $city = $_POST['city'];
    $age = calc_age(change_date());
    $speciality = $_POST['speciality'];
    $password = $_POST['password'];

    $addusers = "INSERT INTO users (last_name, first_name, grade_id) VALUES ('$lastname', '$firstname', '$grade')";
    $db->exec($addusers);

    $id = get_id_users($firstname, $lastname);

    $addinfo = "INSERT INTO infos_users (age, email, phone, Location, image_id, users_id, spe_id, password, description) 
    VALUES ('$age', '$email', '$tel', '$city', '1', '$id', '$speciality', '$password', 'test')";
    $db->exec($addinfo);
}

function verify_all(){
    if(verify_post()){
        $name_regex = '/^[a-zA-Z-]+$/';
        $city_regex = '/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/';
        $phone_regex = '/^(?:\+33|0)[67](?:([-. ]?)[0-9]{2}\1[0-9]{2}\1[0-9]{2}\1[0-9]{2})$/';
        $email_regex = '/[a-z0-9-_\.]+@[a-zA-z0-9]+\.[a-z]{2,3}$/';
        $password_regex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

        if(verify_regex($name_regex, $_POST['first_name']) && verify_regex($name_regex, $_POST['last_name'])
        && verify_regex($email_regex, $_POST['email']) && verify_regex($phone_regex, $_POST['tel'])
        && verify_regex($city_regex, $_POST['city']) && verify_regex($city_regex, $_POST['city'])
        && verify_regex($password_regex, $_POST['password'])) {
            create_users();
            echo 'oui';
        }
        else{
            echo 'non';
        }

    }
    if(verify_empty_post()){
        // $result = 0;
        echo 'champs vide';  
    }

}
verify_all();

?>  