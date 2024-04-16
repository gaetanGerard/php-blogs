<?php

// Obtenir le chemin du répertoire parent
$parent_dir = dirname(__DIR__);

// Inclure le fichier de configuration
$config_file = $parent_dir . '/conf/config.ini';

// Charger les informations du fichier de configuration
$config = parse_ini_file($config_file)

// Récupérer les informations de connexion
$db_local_addr = $config['db_local_addr'];
$db_domain_addr = $config['db_domain_addr'];
$db_user = $config['db_user'];
$db_password = $config['db_password'];
$db_name = $config['db_name'];

// Créer une connexion à la base de données en utilisant l'adresse IP locale
$connection = new mysqli($db_local_addr, $db_user, $db_password, $db_name);

// Vérifier si la connexion local à réussi
if (!$connection) {
    // Si la connexion locale a échoué, essayer de se connecter à la base de données à l'aide du nom de domaine
    $connection = new mysqli($db_domain_addr, $db_user, $db_password, $db_name);
}

// Stockage du résultat dans une variable
$connection_result = ($connection !== false) ? "Connexion réussie" : "Impossible de se connecter à la base de données";