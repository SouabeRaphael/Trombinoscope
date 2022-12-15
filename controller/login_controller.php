<?php 
require_once __DIR__ . '/../libraries/db.php';
require_once __DIR__ . '/../functions/functions.php';

// pretty_print_r($array_users);

// @@@
// fonction qui verifie si les champ son declaré
// @@@
function verify_post(){
    return isset($_POST['email']) && isset($_POST['password']);
}

// @@@
// fonction qui verifie si les champ son vide
// @@@
function verify_empty_post(){
    return isset($_POST['email']) && empty($_POST['password']);
}

// @@@
// fontion qui crée un url avec en parametre les erreur
// @@@
function redirect_error($result){
    header("Location: http://localhost:8888/trombinoscope/vue/login.php?error=$result"); 
}

// @@@
// fonction qui envoie l'utilisatieur sur le dashboard si la connection est bonne
// @@@
function redirect_home_page(){
    header("Location: http://localhost:8888/trombinoscope/vue/home_page.php"); 
}

// @@@
// fonction qui va chercher email, le mot de passe, le user id et le first name de la table ’infos_users’ en la liant avec la table ’users’
// @@@
function get_credentials() {
    $db = db_connect();
    $sql = "SELECT email, password, users_id, first_name FROM `infos_users` NATURAL JOIN `users`";
    $credentialsStmt = $db->query($sql);
    $credentialsStmt->execute();
    $credentials = $credentialsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $credentials;
}
$credentials = get_credentials(); 

// @@@
// fonction qui verifie si le email et le mot de passe est bien le meme que celle de la passe de donner
// @@@
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

// @@@
// fonction qui recupère id du users
// @@@
function get_id($credentials){
    foreach($credentials as $key => $value){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($email == $value['email'] && $password == $value['password']){
            return $value['users_id'];
            break;
        }
    }
}

// @@@
// fonction qui recupère le prenom du users
// @@@
function get_username($credentials){
    foreach($credentials as $key => $value){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($email == $value['email'] && $password == $value['password']){
            return $value['first_name'];
            break;
        }
    }
}

// @@@
// fonction qui crée la session lorsqu'il ce connecte
// @@@
function create_session($username, $id){
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $id;
}

// @@@
// fonction qui regroupe toute les autres
// Elle verif l'entré des input pour la connection
// si elle est pas bonne, message d'erreur
// sinon le users est envoyer sur la page home page
// @@@
function get_verify($credentials){
    
    $result = 0;
    if(verify_post()){
        if(verify_credentials($credentials)){
            $username = get_username($credentials);
            $id = get_id($credentials);
            // echo $id;
            create_session($username, $id);
            redirect_home_page();
        }
        else{
            
            $result = -1;
            redirect_error($result);
        }
    }
    if(verify_empty_post()){

        $result = 0;
        redirect_error($result);
    }
    return $result;;
}
get_verify($credentials);


// pretty_print_r(get_credentials());
// verify_credentials($credentials);
// echo session_status();

?>