<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['originalFileName'])) {
    $targetDirectory = "uploads/"; // Dossier de destination où les images seront stockées sur le serveur

    // Parcourir les fichiers téléchargés
    foreach ($_FILES['originalFileName']['tmp_name'] as $key => $tempFilePath) {
        $originalFileName = $_FILES['originalFileName']['name'][$key];
        $targetFilePath = $targetDirectory . $originalFileName;

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
            // Le fichier a été téléchargé avec succès
            echo "Le fichier $originalFileName a été téléchargé avec succès.";
        } else {
            // Une erreur s'est produite lors du téléchargement du fichier
            echo "Erreur lors du téléchargement du fichier $originalFileName.";
        }
    }
} else {
    // Aucun fichier n'a été téléchargé ou une autre erreur s'est produite
    echo "Aucun fichier n'a été téléchargé ou une erreur s'est produite.";
}
?>
