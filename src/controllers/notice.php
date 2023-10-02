<?php

use App\Model\CarModel;
// verification de connection 
if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}



$flashMessage = fetchFlash();



$carModel = new CarModel();
$cars = $carModel->getAllCars();

// Affichage : inclusion du template
$template = 'notice';
include '../templates/base.phtml';
?>