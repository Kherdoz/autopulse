<?php 
// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;


class CarModel extends AbstractModel {

    /**
     * Insère les informations d'une voiture en base de données
     */
    public function insertCar(string $make, string $accounte, string $fuel, int $mileage, int $years, int $price,  string $originalFileName)
    {
        // Insertion des données de la voiture
        $sql = 'INSERT INTO cars (make, accounte, fuel, mileage, years , price, originalFileName)
                VALUES (?, ?, ?, ?, ?, ?, ?)';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête d'insertion
        $success = $pdoStatement->execute([$make, $accounte, $fuel, $mileage, $years, $price, $originalFileName]);

    }
}
