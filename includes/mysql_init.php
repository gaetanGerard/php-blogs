<?php

/*
*
* 1. Inclure le fichier de configuration et se connecter à la base de données
* Tester si la connexion à la DB en local fonctionne ou en utilisant le nom de domaine car ma
* DB est sur un serveur privé
*
*/

function db_connect()
{
    // Obtenir le chemin du répertoire parent
    $parent_dir = dirname(__DIR__);

    // Inclure le fichier de configuration
    $config_file = $parent_dir . '/conf/config.ini';

    // Charger les informations du fichier de configuration
    $config = parse_ini_file($config_file);

    // Récupérer les informations de connexion
    $db_server = $config['db_server'];
    $db_user = $config['db_user'];
    $db_password = $config['db_password'];
    $db_name = $config['db_name'];

    // Créer une connexion à la base de données en utilisant l'adresse IP locale
    $connection = new mysqli($db_server, $db_user, $db_password, $db_name);

    return $connection;
}
