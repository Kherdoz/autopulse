<?php 

/**
 * On définit dans le tableau associatif $routes la liste de nos routes.
 * Pour chaque route, on définit : 
 * - son nom 
 * - path (qui apparaît dans l'URL)
 * - controller : fichier à appeler 
 */

$routes = [

    // Page d'accueil
    'home' => [
        'path' => '/',
        'controller' => 'home.php'
    ],

    // Création de compte
    'signup' => [
        'path' => '/signup',
        'controller' => 'signup.php'
    ],

    // Connexion utilisateur
    'login' => [
        'path' => '/login',
        'controller' => 'login.php'
    ],

    // Déconnexion
    'logout' => [
        'path' => '/logout',
        'controller' => 'logout.php'
    ],
    // ajouter une annonce
    'placeAnAd' => [
        'path' => '/placeAnAd',
        'controller' => 'placeAnAd.php'
    ],
    
    'css' => [
        'path' => 'css/style.css'],
];

return $routes;