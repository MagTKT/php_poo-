<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Billet simple pour l'Alaska</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/agency.css" rel="stylesheet">
  </head>
   <body>
      <!--Nav-->
      <?php include("include/nav.php"); ?>
      <!--contenu/ billet-->
      <div id="content" class="container">
        <div class="row">          
            <?= $content ?>
        </div>
      </div>
      <!--Debut footer-->
      <?php include("include/footer.php"); ?>
      <script src="public/js/jquery.min.js"></script>
      <script src="public/js/bootstrap.bundle.min.js"></script>
      <script src="public/js/agency.min.js"></script>
  </body>
</html>

