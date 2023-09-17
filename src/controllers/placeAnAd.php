
<?php

// Import de classes
use App\Model\carModel; // Assurez-vous d'importer la classe appropriée pour gérer les annonces de véhicules

// Initialisations
$errors = []; // Tableau qui contiendra les erreurs

$picture = '';
$make = '';
$model = '';
$fuel = '';
$mileage = '';
$vehicleCondition = '';
$year = '';
$price = '';

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // 1. Récupération des champs du formulaire dans des variables
    $make = trim($_POST['make']);
    $model = trim($_POST['model']);
    $fuel = trim($_POST['fuel']);
    $mileage = trim($_POST['mileage']);
    $vehicleCondition = trim($_POST['vehicleCondition']);
    $year = trim($_POST['year']);
    $price = trim($_POST['price']);

    // 2. Validation des données du formulaire
    if (!$make) {
        $errors['make'] = 'Le champ "Marque" est obligatoire';
    }

    if (!$model) {
        $errors['model'] = 'Le champ "Modèle" est obligatoire';
    }
    if (!$fuel) {
        $errors['fuel'] = 'Le champs "carburant" est obligatoire';
    }
    if (!$mileage) {
        $errors['mileage'] = 'Le champs "kilometrage" est obligatoire';
    }
    if (!$vehicleCondition ) {
        $errors['vehicleCondition '] = 'Le champs "Etat du vehicule" est obligatoire';
    }
    // Assurez-vous que l'année est un nombre valide
    if (!is_numeric($year) || strlen($year) !== 4) {
        $errors['year'] = 'Le champ "Année" doit être une année valide (ex. 2023)';
    }

    // Assurez-vous que le prix est un nombre positif
    if (!is_numeric($price) || $price <= 0) {
        $errors['price'] = 'Le champ "Prix" doit être un nombre positif';
    }

    // Si aucune erreur... 
    if (empty($errors)) {

        // Gérez le téléchargement de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $_FILES['photo']['tmp_name'];
            $originalFileName = $_FILES['photo']['name'];
            // Vous pouvez déplacer ou traiter la photo ici selon vos besoins
        }

        // Créez une instance du modèle de voiture et insérez l'annonce en base de données
        $carModel = new CarModel();
        $carModel->insertCar($make, $model, $fuel, $mileage, $vehicleCondition, $year, $price, $originalFileName);

        // Message flash
        addFlash('Votre annonce de véhicule a bien été déposée');

        // Redirection vers une page de confirmation ou d'accueil
        
        header('Location: /placeAnAd.phtml'); 
        exit;
    }
}

// Affichage : inclusion du template
$template = 'placeAnAd.phtml'; // Remplacez "create_car_ad" par le nom du template approprié
include '../templates/placeAnAd.phtml'; // Assurez-vous d'inclure le template correct
