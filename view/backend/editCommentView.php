<?php ob_start(); ?>
<div class="row">
  <div class="col-lg-9">
<form action="index.php?action=editComment&id=<?php echo $comment['id'] ?>" method="post">
  <div class="form-group">
    <label for="author">Auteur</label>
    <input type="text" class="form-control" id="author" name="author" value="<?php echo $comment['author']; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="comment">Commentaire</label>
    <textarea  class="form-control" id="comment" name="comment"><?php echo $comment['comment']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="status">Statut du commentaire</label>
    <select class="custom-select" name="status">
        <option selected value="valid">Non signalé</option>
        <option value="warning">Signalé</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Valider le commentaire</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('view/backend/template.php'); ?>
</div>
</div>