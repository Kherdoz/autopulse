<?php

use App\Model\CarModel;

// verification de connection 
if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}

$flashMessage = fetchFlash();



// Pour recupêré les annonce de lutilisateur
// $usercars_id = $_SESSION['user']['id'];

$carModel = new CarModel();
$cars = $carModel-> getAllCars();

// Affichage : inclusion du template
$template = 'announcement';
include '../templates/base.phtml';
?>