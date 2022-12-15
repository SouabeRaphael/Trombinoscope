<?php

use LDAP\Result;

require_once __DIR__ . '/../libraries/db.php';
require_once __DIR__ . '/../functions/functions.php';

// @@@
// function qui recupere tout les element de la table grade
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

// @@@
// function qui recupere tout les element de la table specialisation
// @@@
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
    && isset($_POST['password']) && isset($_POST['description']);
}

// @@@
// fonction qui verifie si les champ son vide
// @@@
function verify_empty_post(){
    return empty($_POST['first_name']) && empty($_POST['last_name']) 
    && empty($_POST['email']) && empty($_POST['tel']) && empty($_POST['city']) 
    && empty($_POST['birth']) && empty($_POST['grade']) && empty($_POST['speciality']) 
    && empty($_POST['password']) && empty($_POST['description']);
}

// @@@
// fontion qui crée un url avec en parametre les erreur
// @@@
function redirect_error(){
    return header("Location: http://localhost:8888/trombinoscope/vue/signup.php"); 
}

// @@@
// fonction qui envoie l'utilisatieur sur le dashboard si la connection est bonne
// @@@
function redirect_home_page(){
    return header("Location: http://localhost:8888/trombinoscope/vue/home_page.php"); 
}

// @@@
// function qui formate la date pour pouvoir la changer par la suite en age
// @@@
function change_date(){
    $oldDate = new DateTime($_POST['birth']);
    $newDate = $oldDate->format('Y-m-d 00:00:00');
    
    return $newDate;
}

// @@@
// function qui calcule l'age en fonction de la date
// @@@
function calc_age($age){
    $birth = $age;
    $today = date('Y-m-d');
    $diff = date_diff(date_create($birth), date_create($today));

    return $diff->format('%y');
}

// @@@
// function qui va chercher id du users
// @@@
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

// @@@
// function qui va chercher id du de l'image
// @@@
function get_id_image($id) {

    $db = db_connect();
    $sql = <<<EOD
    SELECT
        image_id
    FROM
        `images`
    WHERE user_id = $id
    EOD;
    $imageIdStmt = $db->query($sql);
    $imageIdStmt->execute();
    $imageId = $imageIdStmt->fetchAll(PDO::FETCH_ASSOC);

    $id = $imageId[0]['image_id'];
    return $id;
}

// @@@
// function qui va permettre de verifier les champs à laide de regex
// @@@
function verify_regex($regex, $name){
    if(preg_match($regex, $name)){
        return true;
    }
    else{
        return false;
    }
}

// @@@
// function qui mes les valeur de l'image dans des variable
// @@@
function get_file_tmp_name(){
    $result = $_FILES['image']['tmp_name'];
    return $result;
}
function get_file_name(){
    $result = $_FILES['image']['name'];
    return $result;
}
function get_file_size(){
    $result= $_FILES['image']['size'];
    return $result;
}
function get_file_type(){
    $result = $_FILES['image']['type'];
    return $result;
}

// @@@
// function qui va crée les users dans la base de donner mysql
// @@@
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
    $description = $_POST['description'];

    $addusers = "INSERT INTO users (last_name, first_name, grade_id) VALUES ('$lastname', '$firstname', '$grade')";
    $db->exec($addusers);

    $user_id = get_id_users($firstname, $lastname);
    

    // print_r($_FILES);
    $image_name = get_file_name();
    $image_tmp_name = get_file_tmp_name();

    move_uploaded_file($image_tmp_name, $image_name);
    $image_content = file_get_contents($_FILES['image']['name']);
    $image_content = base64_encode($image_content);

    $addimage = "INSERT INTO images (image, user_id) VALUES ('$image_content', '$user_id')";
    $db->exec($addimage);
    
    $img_id = get_id_image($user_id);

    $addinfo = "INSERT INTO infos_users (age, email, phone, Location, image_id, users_id, spe_id, password, description) 
    VALUES ('$age', '$email', '$tel', '$city', '$img_id', '$user_id', '$speciality', '$password', '$description')";
    $db->exec($addinfo);
}

// @@@
// function qui verifie les champs des input à l'aide de regex
// @@@
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
            // redirect_home_page();
            echo 'oui';
        }
        else{
        //    $result = 'Erreur sur un ou plusieur champs';
           echo 'nan';
        }

    }
    if(verify_empty_post()){
        // $result =  'Champs non rempli';
        // header("Location: ./signup.php");
    }
}
verify_all();

?>  