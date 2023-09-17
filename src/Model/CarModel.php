<?php 

// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;

class CarModel extends AbstractModel {

    /**
     * Insère les informations d'une voiture en base de données
     */
    public function insertCar(string $make, string $model, string $fuel, int $mileage, string $vehicleCondition, int $year, int $price, string $originalFileName)
    {
        // Insertion des données de la voiture
        $sql = 'INSERT INTO cars (make, model, fuel, mileage, vehicle_condition, year, price, image)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute([$make, $model, $fuel, $mileage, $vehicleCondition, $year, $price, $originalFileName]);
    }
}
