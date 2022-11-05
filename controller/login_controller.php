<?php 
error_reporting( E_ALL );
require_once __DIR__ . '/../libraries/db.php';
require_once __DIR__ . '/../functions/functions.php';

// pretty_print_r($array_users);

// @@@
// fonction qui verifie sur le btn à été appuyer et si les champ son declaré
// @@@
function verify_post(){
    return isset($_POST['email']) && isset($_POST['password']);
}

// @@@
// fonction qui verifie sur le btn à été appuyer et si les champ son vide
// @@@
function verify_empty_post(){
    return isset($_POST['email']) && empty($_POST['password']);
}

// @@@
// fontion qui crée un url avec en parametre les erreur
// @@@
function redirect_error($result){
    header("Location: http://php.test/TP-upload-file/part2/index.php?error=$result"); 
}

// @@@
// fonction qui envoie l'utilisatieur sur le dashboard si la connection est bonne
// @@@
function redirect_dashboard_controller(){
    header("Location: http://php.test/TP-upload-file/part2/controllers/dashboard-controller.php"); 
}

function get_credentials() {
    $db = db_connect();
    $sql = "SELECT email, password, users_id, first_name FROM `infos_users` NATURAL JOIN `users`";
    $credentialsStmt = $db->query($sql);
    $credentials = $credentialsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $credentials;
}
$credentials = get_credentials(); 

function verify_credentials($credentials){
    $email = $_POST['email'];
    $password = $_POST['password'];
    foreach($credentials as $key => $value){
        if($email == $value['email'] && $password == $value['password'] ){
            $result = true;
            if($result){
                return $value['users_id'];
            }
            break;
        }
    }
}

function get_id($credentials){
    foreach($credentials as $key => $value){
        $email = $_POST['email'];
        if($email == $value['email']){
            return $value['users_id'];
            break;
        }
    }
}
function get_username($credentials){
    foreach($credentials as $key => $value){
        $email = $_POST['email'];
        if($email == $value['email']){
            return $value['first_name'];
            break;
        }
    }
}

function create_session($username, $id){
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $id;
}

function get_verify($credentials){
    $message = '';

    if(verify_post()){
        if(verify_credentials($credentials)){
            $username = get_username($credentials);
            $id = get_id($credentials);
            echo $id;
            create_session($username, $id);
            $message = 'ok';
        }
        else{
            $message = 'les champs sont mauvais';
        }
    }
    if(verify_empty_post()){
        $message = 'les champs sont vides';
    }
    return $message;
}
echo get_verify($credentials);


// pretty_print_r(get_credentials());
// verify_credentials($credentials);
echo session_status();

?>