<?php



use App\Model\carModel;
if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}




$errors = [];
$make = '';
$fuel = '';
$mileage = '';
$accounte = '';
$years = '';
$price = '';
$originalFileName = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = trim($_POST['make']);
    $fuel = trim($_POST['fuel']);
    $mileage = trim($_POST['mileage']);
    $accounte = trim($_POST['accounte']);
    $years = trim($_POST['years']);
    $price = trim($_POST['price']);
    $originalFileName =($_FILES['originalFileName']['name']);

    if (empty($originalFileName)) {
        $errors['originalFileName'] = 'Le champ "photo" est obligatoire';
    }
    if (empty($make)) {
        $errors['make'] = 'Le champ "Marque" est obligatoire';
    }
    if (empty($accounte)) {
        $errors['accounte'] = 'Le champ "Description" est obligatoire';
    }
    if (empty($fuel)) {
        $errors['fuel'] = 'Le champ "carburant" est obligatoire';
    }
    if (empty($mileage)) {
        $errors['mileage'] = 'Le champ "kilometrage" est obligatoire';
    }
    if (empty($price)) {
        $errors['price'] = 'Le champ "Prix" est obligatoire';
    }
    if (!is_numeric($years) || strlen($years) !== 4) {
        $errors['years'] = 'Le champ "Année" doit être une année valide (ex. 2023)';
    }
    if (!is_numeric($price) || $price <= 0) {
        $errors['price'] = 'Le champ "Prix" doit être un nombre positif';
    }
    if (!is_numeric($mileage) || $mileage <= 0) {
        $errors['mileage'] = 'Le champ "kilométrage" doit être un nombre positif';
    }

    
    if (empty($errors)) {
        if (isset($_FILES['originalFileName']) && $_FILES['originalFileName']['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $_FILES['originalFileName']['tmp_name'];
            $originalFileName = $_FILES['originalFileName']['name'];
            // Vous pouvez déplacer ou traiter la photo ici selon vos besoins
        }

        $carModel = new CarModel();
        $carModel->insertCar($make, $accounte, $fuel, $mileage, $years, $price, $originalFileName);

        // Message flash
        addFlash('Votre annonce de véhicule a bien été déposée');

        // Redirection vers une page de confirmation ou d'accueil
        // header('Location: placeAnAd.php');
        exit;
    }
}

// Affichage : inclusion du template
$template = 'placeAnAd';
include '../templates/base.phtml';
?>
