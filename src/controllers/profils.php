<?php


// verification de connection 
if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}

$flashMessage = fetchFlash();




// Affichage : inclusion du template
$template = 'profils';
include '../templates/base.phtml';
?>