<?php $title ?>

<?php ob_start(); ?>
<!--affiche l'articles -->
<main class="articles">
  <div class="container">
    <div class="row">
      <div class="col-12 news">
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p>Par <?= $post['author'] ?> Le <?= $post['creation_date_fr'] ?></p>
        <img class="card-img-top" src="<?php echo $post['img_posting']?>" alt="illustration article">
        <p><?= nl2br($post['content']) ?></p>
      </div>
  <?php

  //Mode edition depuis l'article si connecter en Admin
  if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
  ?>
  <div class= "col-3 offset-3">
    <a href="index.php?action=editPostView&amp;id=<?php echo $post['id'];?>"><button class="btn btn-secondary" type="button">Éditer</button></a>
  </div>
  <div class= "col-6">
    <a href="index.php?action=deletePost&amp;id=<?php echo $post['id']; ?>"><button class="btn btn-danger" type="button" onclick="return confirm('Etes vous sur de vouloir supprimer cet article ?')">Supprimer</button></a>
  </div>
  <?php
  }
  ?>
<!-- redaction d'un commentaire -->
<div class="col-lg-12">
  <h2 class="comment-title">Vos Commentaires</h2>
  <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post" class="border-form">
      <div class="col-lg-12">
        <label for="author">Auteur</label><br>
        <input type="text" id="author" name="author">
      </div>
      <div class="col-lg-12">
        <label for="comment">Commentaire</label>
        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
      </div>
      <div class="col-lg-12">
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
  </form>
</div>

<!--affiche les commentaires-->
<div class="col-lg-12">
<div class="comment-comment">
<?php
while ($comment = $comments->fetch())
{
  if($comment['status'] != 'warning')
  {
  ?>
    
      <div class="col-lg-12 info-author">
        <p><strong>Auteur : </strong><?= htmlspecialchars($comment['author']) ?></p>
        <p>Le <?= $comment['comment_date_fr'] ?></p>
      </div>
      <div class="complet-info">
        <div class="col-lg-12">
          <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        </div>
      <div class="col-lg-12">
        <a href="index.php?action=signal&amp;id=<?php echo $comment['id'];?>">
        <button type="submit" class="btn btn-primary">Signaler</button></a>
      </div>
    </div>

  <?php
  }
  else{

  ?>
    <div class="col-lg-12 info-author">
      <p><strong>Auteur : </strong><?= htmlspecialchars($comment['author']) ?></p>
      <p>le <?= htmlspecialchars($comment['comment_date_fr']) ?></p>
    </div>
    <div class="complet-info">
    <div class="col-lg-12">
      <p>Ce commentaire est en attente d'une vérification par l'administrateur</p>
    </div>
    </div>
  
  <?php
  }
}
?>
</div>
</div>
</div>
</div>

<!-- signalement d'un message -->
<span id="signalMessage">
<p><?php
if(isset($message)){
echo $message;
}
?>
</p>
</span>
</section>
<!--On insert dans la variable content le contenu ci dessus-->
<?php $content = ob_get_clean(); ?>


<?php require('view/frontend/template.php'); ?>