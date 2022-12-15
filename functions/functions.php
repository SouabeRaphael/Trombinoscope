<?php 
require_once __DIR__ . '/../libraries/db.php';

// rendre un belle affichage sur les tableaux
function pretty_print_r($var): void{
    echo '<pre>'.print_r($var, true).'</pre>';
}

// @@@
// function qui va chercher tout les elements de la table ’infos_users’
// @@@
function get_info_users(){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `infos_users`
    EOD;
    $usersStmt = $db->query($sql);
    $usersStmt->execute();
    $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}
$array_users = get_info_users();

?>