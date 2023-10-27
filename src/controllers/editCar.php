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

        $originalFileName = "";
        if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] === UPLOAD_ERR_OK) {
            $originalFileName = $_FILES['newImage']['name'];
            // Obtenir la taille du fichier
            $filesize = filesize($_FILES['newImage']['tmp_name']);

            // Vérifier si la taille du fichier dépasse la limite
            if ($filesize > MAX_UPLOAD_SIZE) {
                $errors["newImage"] = 'Votre fichier excède 500 Ko (limite de taille autorisée).';
            }
            // verifier le type de fichier 
            $filetype = getFileMimeType($_FILES['newImage']['tmp_name']);
            if (!in_array($filetype, ALLOWED_MIME_TYPES_IMAGE)) {
                $errors["newImage"] = 'le fichier doit etre de type : jpeg, gif, webp, png.';
            }
        }
        // Si aucune erreur n'est détectée...
        if (empty($errors)) {
            if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] === UPLOAD_ERR_OK) {
                // Si la taille est valide, supprimer l'ancienne image
                $originalFileName = $_FILES['newImage']['name'];
                // Construire le chemin de l'ancienne image
                $oldImagePath = "./images/" . $car['originalFileName'];
                // Vérifier si le fichier de l'ancienne image existe
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Supprimer l'ancienne image
                }
                // Déplacer la nouvelle image si elle est valide
                $tempFilePath = $_FILES['newImage']['tmp_name'];
                $extension = pathinfo($_FILES['newImage']['name'], PATHINFO_EXTENSION);
                $basename = pathinfo($_FILES['newImage']['name'], PATHINFO_FILENAME);
                $basename = slugify($basename);
                $originalFileName = $basename . sha1(uniqid(rand(), true)) . '.' . $extension;
                // Déplacer le fichier temporaire vers le répertoire des images
                move_uploaded_file($tempFilePath, "./images/" . $originalFileName);
            }

            $carModel = new CarModel();
            $carModel->updateCar($carId, $make, $accounte, $fuel, $mileage, $years, $price, $originalFileName);

            // Message flash
            addFlash('Votre annonce de véhicule a bien été mise à jour');

            // Redirection vers une page de confirmation ou de gestion des annonces
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

    $carModel = new CarModel();
    $car = $carModel->getCarById($carId);

    $oldImagePath = "images/" . $car['originalFileName'];
    // Vérifier si le fichier de l'ancienne image existe
    if (file_exists($oldImagePath)) {
        unlink($oldImagePath); // Supprimer l'ancienne image
    }
    $carModel->deleteCar($carId);


    // Message flash
    addFlash('L\'annonce de véhicule a bien été supprimée');

    echo json_encode([
        'id' => $carId,
    ]);
    exit;
}

if (!isConnected()) {
    header('Location: ' . buildUrl('login'));
    exit;
}


$action = "edit";
if (array_key_exists('operation', $_POST) && $_POST['operation'] == 'deleteCar') {
    $action = "delete";
}
$carId = $_POST["editCar"] ?? $_POST["deleteCar"];

// todo verifier que l'annonce appratient bien au user

switch ($action) {
    case "edit":
        editCar($carId);
        break;
    case "delete";
        deleteCar($carId);
        break;
}
