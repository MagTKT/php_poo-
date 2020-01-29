<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Billet simple pour l'Alaska</title>
      
      <!-- script incluant tinymce -->
      <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=lnp7uirbee1mvl9prt3p9romc1p2gywt7g61ozgx1w8miw79"></script>
      <script>tinymce.init({ selector:'textarea#postContent' });</script>
      <!-- script incluant tinymce -->

      <link href="public/css/bootstrap.min.css" rel="stylesheet">
      <link href="public/css/agency.css" rel="stylesheet">
    </head>

    <body>
      <?php include("include/nav.php"); ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Index</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav" >
            <li class="nav-item active" style="padding: 0px 10px;">
              <a href="index.php?action=writeNewPost">Déposé un nouvel article<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" style="padding: 0px 10px;">
              <a href="index.php?action=managePosts">Géré les articles</a>
            </li>
            <li class="nav-item" style="padding: 0px 10px;">
              <a href="index.php?action=manageComments">Géré les commentaires</a>
            </li>
            <li class="nav-item" style="padding: 0px 10px;">
              <a href="index.php?action=creationUser">Modifier votre mot de passe</a>
            </li>
          </ul>
        </div>
      </nav>
    <?= $content ?> 
    <?php include("include/footer.php"); ?>
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/agency.min.js"></script>
    
  </body>
</html>