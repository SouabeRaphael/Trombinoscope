<?php 



use LDAP\Result;
// @@@
// function qui deconnecte l'utilisateur en supprimer ça session
// @@@
session_start();
unset($_SESSION['id']);
unset($_SESSION['username']);
session_destroy();
header('Location: ../vue/login.php');


?>