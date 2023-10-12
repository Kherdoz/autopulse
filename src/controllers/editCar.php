<?php

use App\Model\CarModel;

// function edition
function editCar(int $carId)
{

    // tableau d'erreur
    $errors = [];

    //inst. de la classe carmodel
    $carModel = new CarModel();
    $car = $carModel->getCarById($carId);

    // Si le formulaire est soumis...
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $make = trim($_POST['make']);
        $accounte = trim($_POST['accounte']);
        $fuel = trim($_POST['fuel']);

        // Convertir la valeur de mileage en entier
        $mileage = isset($_POST['mileage']) ? (int)$_POST['mileage'] : 0;

        // Convertir la valeur de years en entier
        $years = isset($_POST['years']) ? (int)$_POST['years'] : 0;

        // Convertir la valeur de price en entier
        $price = isset($_POST['price']) ? (int)$_POST['price'] : 0;

        $originalFileName = isset($_FILES['newImage']['name']) ? $_FILES['newImage']['name'] : '';
    
       
        // Validation des données du formulaire (vous pouvez réutiliser votre code de validation existant)
        //todo
        // Si aucune erreur n'est détectée...
        if (empty($errors)) {
        
            if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] === UPLOAD_ERR_OK) {$
                //etape 1. clean l'ancienne image pour ajouter la nouvelle .
                $tempFilePath = $_FILES['newImage']['tmp_name'];
                $originalFileName = $_FILES['newImage']['name'];

                move_uploaded_file($tempFilePath,"./images/".$originalFileName);
            }

            $carModel = new CarModel();
            $carModel->updateCar($carId, $make, $accounte, $fuel, $mileage, $years, $price, $originalFileName);

            // Message flash
            addFlash('Votre annonce de véhicule a bien été mise à jour');

            // // Redirection vers une page de confirmation ou de gestion des annonces
            header('Location: ' . buildUrl('notice'));
            exit;
        }
    }
    // Affichage : inclusion du template
    $template = 'editCar';
    include '../templates/base.phtml';
}

//function delete
function deleteCar(int $carId)
{

    // Suppression de la voiture en utilisant l'ID
    $carModel = new CarModel();
    $carModel->deleteCar($carId);

    // Message flash
    addFlash('L\'annonce de véhicule a bien été supprimée');

    // Redirection vers une page de confirmation ou de gestion des annonces
    header('Location: ' . buildUrl('notice'));
    exit;
}

if (!isConnected()) {
    header('Location: ' . buildUrl('login'));
    exit;
}

$action = "edit";
if (array_key_exists("deleteCar", $_GET)) {
    $action = "delete";
}
$carId = $_GET["editCar"] ?? $_GET["deleteCar"];
// todo verifier que l'annonce appratient bien au user

switch ($action) {
    case "edit":
        editCar($carId);
        break;
    case "delete";
        deleteCar($carId);
        break;
}
