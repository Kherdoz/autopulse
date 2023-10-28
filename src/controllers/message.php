<?php


// verification de connection 
if (!isConnected()){
    header('Location: '.buildUrl('login'));
    exit;

}




// Affichage : inclusion du template
$template = 'message';
include '../templates/base.phtml';
?>