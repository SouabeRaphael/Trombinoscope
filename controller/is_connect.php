<?php 

// @@@
// fonction qui verifie si l'utilisateur et deja connecter au pas
// @@@
function is_logged(){
    if(session_status() === 2) {
        return header("Location: http://localhost:8888/trombinoscope/vue/home_page.php");
    }
    if(session_status() == 1){
        return header("Location: http://localhost:8888/trombinoscope/vue/login.php");
    }
}

function if_is_connect(){
    if(session_status() == 1) {
        return header("Location: http://localhost:8888/trombinoscope/vue/login.php");
    }
}

?>