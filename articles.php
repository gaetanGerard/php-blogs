<?php
require __DIR__.'/vendor/autoload.php';

include 'includes/functions.php';

// dump(update_article_object());
?>

<div class="container">
    <h1 class="text-center mt-5 mb-5">Articles</h1>
    <div class="row">
        <?php
        $articles = update_article_object();
        foreach($articles as $article) {
            ?>
            <div class="col-4">
                <div class="card mb-3">
                    <?php foreach($article['images'] as $image) { ?>
                        <?php if($image['position'] === 'header') { ?>
                            <img src="assets/img/<?= $image['filename'] ?>" class="card-img-top custom-card-img" alt="<?= $image['image_alt'] ?>">
                        <?php } ?>
                    <?php } ?>
                    <div class="card-body custom-card-body">
                        <h5 class="card-title"><?= $article['title'] ?></h5>
                        <p class="card-text">
                            <small class="text-muted">Posted at <?= $article['created_at'] ?></small>
                        </p>
                        <p class="card-text">
                            <small class="text-muted text-end">Author: <?= $article['author']['username'] ?></small>
                        </p>
                        <a href="article.php?id=<?= $article['id'] ?>" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            <?php } ?>


</div>