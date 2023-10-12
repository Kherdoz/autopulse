<?php

use App\Model\CarModel;

// verification de connection 
if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}

$flashMessage = fetchFlash();



// Pour recupêré les annonce de lutilisateur
$usercars_id = $_SESSION['user']['id'];

$carModel = new CarModel();
$cars = $carModel->getCarsByUserId($usercars_id);

// Affichage : inclusion du template
$template = 'notice';
include '../templates/base.phtml';
?>