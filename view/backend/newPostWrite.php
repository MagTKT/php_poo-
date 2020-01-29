
<!-- créer un nouvel articles -->

<?php ob_start(); ?>

<div id="adminCards">
  <div class="col-lg-6">

 <h2>Ecrire un nouvel article </h2>
<form action="index.php?action=newPost" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label for="author">Auteur</label>
      <input type="text" class="form-control" id="author"  placeholder="Votre peudo" name="author" value="" required>
  </div>
  <div class="form-group">
      <label for="title">Titre</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article"  required>
  </div>
  <div class="form-group">
      <label for="postContent">Contenu de l'article</label>
      <textarea id="postContent" name="content" rows="15"></textarea>
  </div>
  <div class="custom-file">
    <label class="custom-file-label" for="imageToUpload">Selectionnez une image</label>
    <input type="file" class="custom-file-input" id="imageToUpload" name="image">
  </div>

  <button type="submit" class="btn btn-primary">Publier</button>
</form>



<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>