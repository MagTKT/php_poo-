<?php 
ob_start(); 
?>

<div id="adminCards">
    <div class="col-8">
      <h1>Ici se trouve tout se dont vous avez besoin pour géré vos articles et commentaires.</h1>
      <h2>Bon travail :)</h2>
    </div>
</div>


<?php $content = ob_get_clean(); ?>



<?php require('view/backend/template.php'); ?>