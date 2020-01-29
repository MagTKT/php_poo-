<?php ob_start(); ?>
    <?php
    //recupération des informations des posts ecrit.
        while ($data = $posts->fetch())
        {
    ?>
    <!-- // affiche les posts ecrit -->
    
    <div class="new col-md-6">
        <div class="card-header">
            <img class="card-img-top size-view" src=" <?php echo $data['img_posting']?> " alt="illustration article">
            <div class="card-body">
                <h3><?= htmlspecialchars($data['title']) ?></h3>
                <p class="card-text"><?= nl2br($data['content'])?>...</p>
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary">Lire la suite</a>
            </div>
            <div class="card-footer text-muted">
                Le <?= $data['creation_date_fr'] ?> par <?= $data['author'] ?>
            </div>
        </div>
    </div>
    <?php
    }
    $posts->closeCursor();
    ?>

    <?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>