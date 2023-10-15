<?php

use App\Model\CarModel;

// Vérification de la connexion
if (!isConnected()) {
    header('Location: ' . buildUrl('login'));
    exit;
}

$flashMessage = fetchFlash();

$perPage = 6; // Nombre de cartes par page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Page actuelle

// Pour récupérer les annonces de l'utilisateur
// $usercars_id = $_SESSION['user']['id'];

$carModel = new CarModel();
$cars = $carModel->getAllCars(); // Déplacez cette ligne ici pour obtenir les annonces

// Calculez l'index de début et de fin pour les cartes à afficher
$start = ($page - 1) * $perPage;
$end = $start + $perPage;

$totalPages = ceil(count($cars) / $perPage);

// Affichage : inclusion du template
$template = 'announcement';
include '../templates/base.phtml';
?>
