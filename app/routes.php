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
    // mes annonces
    'notice' => [
        'path' => '/notice',
        'controller' => 'notice.php'
    ],

    'editCar' => [
        'path' => '/editCar',
        'controller' => 'editCar.php'
    ],

    'announcement' => [
        'path' => '/announcement',
        'controller' => 'announcement.php'
    ],
];

return $routes;