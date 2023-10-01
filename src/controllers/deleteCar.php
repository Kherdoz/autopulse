<?php
use App\Model\CarModel;

if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}
// Initialisations
$errors = [];

// Récupération de l'ID de la voiture à supprimer depuis l'URL (vous devez implémenter cette partie)
$carId = $_GET['id']; // Assurez-vous que vous récupérez correctement l'ID de la voiture à supprimer depuis l'URL

// Si le formulaire est soumis...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carModel = new CarModel();
    
    // Suppression de la voiture en utilisant l'ID
    $success = $carModel->deleteCar($carId);

    if ($success) {
        // Message flash
        addFlash('L\'annonce de véhicule a bien été supprimée');

        // Redirection vers une page de confirmation ou de gestion des annonces
        header('Location: /notice.php'); 
        exit;
    } else {
        // Gestion des erreurs en cas d'échec de la suppression (vous pouvez personnaliser cette partie)
        $errors['delete'] = 'Une erreur s\'est produite lors de la suppression de l\'annonce de véhicule.';
    }
}

// Affichage : inclusion du template (vous pouvez personnaliser le message d'erreur)
$template = 'deleteCar';
include '../templates/base.phtml';
?>
