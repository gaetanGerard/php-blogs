<?php
include 'includes/mysql_init.php';

// Fonction pour obtenir tous les articles
function get_all_articles() {
    $conn = db_connect();
    $sql = "SELECT * FROM articles";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Erreur: " . mysqli_error($conn);
        $articles = [];
    }

    mysqli_close($conn);

    return $articles;
}

// Fonction pour obtenir toutes les images
function get_all_images() {
    $conn = db_connect();
    $sql = "SELECT * FROM images";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Erreur: " . mysqli_error($conn);
        $images = [];
    }

    mysqli_close($conn);

    return $images;
}

// Fonction pour récupérer les auteurs
function get_all_authors() {
    $conn = db_connect();
    $sql = "SELECT * FROM users WHERE usertype = 'author'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $authors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Erreur: " . mysqli_error($conn);
        $authors = [];
    }

    mysqli_close($conn);

    return $authors;

}

// Fonction pour créer un nouvel objet qui associera les images et l'auteur avec les bons articles
function update_article_object() {
    $articles = get_all_articles();
    $images = get_all_images();
    $authors = get_all_authors();
    $articles_with_images = [];

    // Boucler à travers les articles et ajouter un tableau images vide
    foreach ($articles as $article) {
        $article_with_images = [
            'id' => $article['id'],
            'title' => $article['title'],
            'author' => '',
            'content' => $article['content'],
            'created_at' => $article['created_at'],
            'updated_at' => $article['updated_at'],
            'images' => []
        ];

        // Boucler à travers les images et ajouter chaque image à l'article approprié
        foreach($images as $image) {
            if($image['article_id'] == $article['id']) {
                $article_with_images['images'][] = [
                    'filename' => $image['image_url'],
                    'position' => $image['image_position'],
                    'image_alt' => $image['img_alt'],
                    'added_at' => $image['added_at']
                ];
            }
        }

        // Boucler à travers les auteurs et ajouter l'auteur approprié à l'article
        foreach($authors as $author) {
            if($author['id'] == $article['author']) {
                $article_with_images['author'] = [
                    'username' => $author['username'],
                    'email' => $author['email'],
                    'firstname' => $author['firstname'],
                    'lastname' => $author['lastname'],
                    'avatar' => $author['img_url']
                ];
            }
        }

        $articles_with_images[] = $article_with_images;
    }



    return $articles_with_images;
}