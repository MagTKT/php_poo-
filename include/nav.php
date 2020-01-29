<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container nav-container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php">Accueil</a>
            </li>
          </ul>
          
            <?php
            if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
            ?>
              <li class="nav-item"> 
                <a class="nav-link" href="index.php?action=admin">Acces administration </a>
              </li>
              <button type="submit" class="btn btn-primary">
                <a href="index.php?action=logout">Se déconnecter</a>
              </button>
              <?php
             }
             else{
               ?>
              <li class="nav-item">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" class="button-connect">Connexion</button>
            </li> 
           <?php
             }
            ?>
          </ul>
        </div>
      </div>
    </nav>
     <!-- Header -->
     <?php
            if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
            ?>
            <header class="masthead admin">
                <div class="container">
                  <div class="intro-text">
                    <div class="intro-lead-in">Bienvenue sur votre base d'administration!</div>
                    <div class="intro-heading text-uppercase">Mr Forteroche</div>
                </div>
                </div>
              </header>
              <?php
             }
             else{
               ?>
              <header class="masthead">
                <div class="container">
                  <div class="intro-text">
                    <div class="intro-lead-in">Welcome to my blog!</div>
                    <div class="intro-heading text-uppercase">Billet simple pour l'Alaska</div>
                </div>
             </div>
              </header>
           <?php
             }
            ?>
    



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="input-group">
          <?php include("include/login.php"); ?>
      </div>
      </div>
    </div>
  </div>
 





