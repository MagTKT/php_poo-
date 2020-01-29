<!-- manager les articles -->
<?php ob_start(); ?>

<div class="row">
  <div class="col-lg-8">
    <h2 style="text-align: center"> Editions de vos Articles</h2>
    
    <table class="table table-striped column-post">
        <tr class="column-border">
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Publié le</th>
            <th scope="col">Editer</th>
            <th scope="col">Supprimer</th>
        </tr>

        <tr>
            <?php
            while ($data = $posts->fetch()) {
                ?>
            <th scope="row"><?php echo nl2br(htmlspecialchars($data['id'])); ?></th>
            <td><?php echo htmlspecialchars($data['title']); ?></td>
            <td><?php echo htmlspecialchars($data['author']); ?></td>
            <td><?php echo htmlspecialchars($data['creation_date_fr']); ?></td>
            <td><a href="index.php?action=editPostView&amp;id=<?php echo $data['id']; ?>"><button type="button" class="btn btn-primary">Editer</button></a></td>
            <td><a href="index.php?action=deletePost&amp;id=<?php echo $data['id']; ?>" onclick="return confirm('Etes vous sur de vouloir supprimer cet article ?')">
                <button type="button" class="btn btn-warning">Supprimer</button></a></td>
        </tr>

            <?php
            }
            $posts->closeCursor();
            ?>

    </table>


<?php $content = ob_get_clean(); ?>


<?php require('view/backend/template.php'); ?>
    
</div>
</div>