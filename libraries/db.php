<?php 

require_once __DIR__ . '/../config/config.php';

function db_connect(){
    try {
        $options = [
            // Permet à PDO de lever des exceptions en cas d'erreur SQL
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        // data source name
        $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        // $dsn = 'mysql:host=localhost;dbname=Trombinoscope;charset=utf8';

        // instance de la base de données (pdo)
        $dbh = new PDO(
            $dsn, 
            USER, 
            PWD,
            $options
        );
    
        return $dbh;
    } catch (PDOException $ex) {
        // message d'erreur si la basse de donnée n'est pas connecter
        printf('La connexion à la base de donnée a échouée avec le code "%s"', $ex->getCode());
        // arrêter l'exécution du script
        die();
    }
} 
// var_dump(db_connect());


?>