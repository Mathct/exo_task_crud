<?php

//logique de connexion à la base de données



//fonction qui crée et renvoi une connexion à la bd

function dbConnexion() {

    //information pour se connecter
    $host = "localhost";
    $port = 3306;
    $username = "root";
    $password = "";
    $dbname = "task_crud_db";

    $charset = "utf8mb4"; // encodage

    
    try {

        //parametres de connexion
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";

        //creation objet connexion
        $pdo = new PDO($dsn, $username, $password);

        //comment recuperer des exceptions
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //comment me renvoyer les données
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;

    } catch (PDOException $e) {
       die("Erreur durant la connexion à la bd: ".$e->getMessage());
    }

}
