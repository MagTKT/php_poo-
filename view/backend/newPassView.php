
<?php ob_start(); ?>

<div id="adminCards">
  <div class="col-lg-8">

<h4>Modification de mot de passe</h4>

  <form action="index.php?action=newPass" method="post">
  
  <div class="form-group">
      <div class="form-group">
        <label for="password">Nouveau mot de passe</label>
        <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password" required>
      </div>
      <div class="form-group">
        <label for="password2">Confirmez votre nouveau mot de passe</label>
        <input type="password" class="form-control" id="password2" placeholder="Confirmation mot de passe" name="password2" required>
      </div>
      
    <button type="submit" class="btn btn-primary"><a href="index.php?action=logout"></a>Valider</button>
  </form>
</div>

<span id="formStatus">
    <p><?php if(isset($info)){
      echo $info;
      }?></p>
  </span>
  


<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>
</div>
</div>