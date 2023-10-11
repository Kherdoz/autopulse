<?php

use App\Model\CarModel;
// verification de connection 
if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}

$flashMessage = fetchFlash();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['originalFileName']) && $_FILES['originalFileName']['error'] === UPLOAD_ERR_OK) {
        $imageDirectory = 'images/';
        $uploadedFileName = $_FILES['originalFileName']['name'];
        $uploadedFilePath = $imageDirectory . $uploadedFileName;

        // Déplacer le fichier téléchargé vers le dossier "./images/"
        if (move_uploaded_file($_FILES['originalFileName']['tmp_name'],"./images/".$uploadedFilePath)) {
            echo 'Image téléchargée avec succès.';
           
            // Vous pouvez rediriger l'utilisateur ou effectuer d'autres actions après le téléchargement réussi.
        } else {
            echo 'Erreur lors du téléchargement de l\'image.';
        }
    } else {
        echo 'Aucun fichier n\'a été téléchargé ou une erreur s\'est produite.';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['originalFileName'])) {
        $imageFileName = $_GET['originalFileName'];
        $imageDirectory = './images/';
        $imagePath = $imageDirectory . $imageFileName;

        // Vérifier si le fichier image existe
        if (file_exists($imagePath)) {
            // Définir le type de contenu pour une image
            header('Content-Type: image/jpeg'); // Vous devrez adapter le type en fonction du type d'image

            // Afficher l'image
            readfile($imagePath);
            exit;
        } else {
            echo 'Image non trouvée';
        }
    } else {
        // Si le paramètre 'originalFileName' n'est pas défini, afficher un message d'erreur
        echo 'Paramètre "originalFileName" manquant';
    }
}










$carModel = new CarModel();
$cars = $carModel->getAllCars();

// Affichage : inclusion du template
$template = 'notice';
include '../templates/base.phtml';
?>