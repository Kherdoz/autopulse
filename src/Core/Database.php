<?php 

// Définition du namespace
namespace App\Core;

// Import des classes
use PDO;
use PDOException;

class Database {
    // Ici je suis à l'intérieur de ma classe
    /**
     * Crée une connexion à la base de données avec PDO
     * @return PDO l'objet PDO créé
     */
    static function getPDOConnection(): PDO 
    {
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8;port=3306';
        $user = DB_USER;
        $password = DB_PASS;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Mode de gestion des erreurs SQL
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de récupération des résultats par défaut : tableaux associatifs
        ];
        try {
            $pdo = new PDO($dsn, $user, $password, $options);
        }
        catch(PDOException $exception) {  
            echo 'ERREUR PDO : ' . $exception->getMessage();
            exit;
        }
        return $pdo;
    }

}
