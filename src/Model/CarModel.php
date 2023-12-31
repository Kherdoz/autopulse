<?php
// Définition du namespace
namespace App\Model;

// Import des classes
use App\Core\AbstractModel;


class CarModel extends AbstractModel
{

    /**
     * Insère les informations d'une voiture en base de données
     */

    public function insertCar(
        string $make,
        string $accounte,
        string $fuel,
        int $mileage,
        int $years,
        int $price,
        string $originalFileName,
        int $usercars_id
    ) {
        // Insertion des données de la voiture
        $sql = 'INSERT INTO cars (make, accounte, fuel, mileage, years , price, originalFileName, usercars_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête d'insertion
        $success = $pdoStatement->execute([$make, $accounte, $fuel, $mileage, $years, $price, $originalFileName, $usercars_id]);

        // Renvoyer true si l'insertion a réussi, sinon false
        return $success;
    }

    // recuperation de toute les données
    public function getAllCars()
    {
        // Requête SQL pour sélectionner toutes les annonces de voitures
        $sql = 'SELECT * FROM cars';

        // Exécution de la requête de sélection
        $pdoStatement = self::$pdo->query($sql);

        // Récupération des résultats sous forme de tableau d'objets
        $cars = $pdoStatement->fetchAll(\PDO::FETCH_OBJ);

        return $cars;
    }


    public function updateCar(
        int $carId,
        string $make,
        string $accounte,
        string $fuel,
        int $mileage,
        int $years,
        int $price,
        string $originalFileName
    ) {
        // Requête SQL pour la mise à jour des données de la voiture
        $sql = 'UPDATE cars
            SET make = ?, accounte = ?, fuel = ?, mileage = ?, years = ?, price = ?, originalFileName = ?
            WHERE id = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête de mise à jour
        $success = $pdoStatement->execute([$make, $accounte, $fuel, $mileage, $years, $price, $originalFileName, $carId]);

        return $success;
    }

    public function deleteCar(int $carId)
    {
        // Requête SQL pour la suppression de la voiture
        $sql = 'DELETE FROM cars WHERE id = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête de suppression
        $success = $pdoStatement->execute([$carId]);

        return $success;
    }
    
    public function getCarById(int $carId)
    {
        // Requête SQL pour sélectionner une voiture en fonction de son ID
        $sql = 'SELECT * FROM cars WHERE id = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête de sélection
        $pdoStatement->execute([$carId]);

        // Récupération du résultat sous forme d'objet
        $car = $pdoStatement->fetch();

        return $car;
    }
    public function getCarsByUserId(int $usercars_id)
    {
        // Requête SQL pour sélectionner les annonces de voitures associées à un utilisateur spécifique
        $sql = 'SELECT * FROM cars WHERE usercars_id = ?';

        $pdoStatement = self::$pdo->prepare($sql);

        // Exécution de la requête de sélection en utilisant l'identifiant de l'utilisateur
        $pdoStatement->execute([$usercars_id]);

        // Récupération des résultats sous forme de tableau d'objets
        $cars = $pdoStatement->fetchAll(\PDO::FETCH_OBJ);

        return $cars;
    }
}
