<?php
require('controller/frontend.php');
require('controller/backend.php');

$accesdenied = 'Vous tentez d\'accéder à un espace réservé aux administrateurs !';

class router{
//ANALYSE LES ACTIONS
    public function getRoute(){
        //Routeur
        $accesdenied = 'Espace réservé à l \'administrateur';
        try {
            //AFFICHE LES ARTICLES
            if (isset($_GET['action'])) {
                //si la variable $_GET trouve l'action 
                //il l'analyse
                if ($_GET['action'] == 'listPosts') {
                        listPosts();
                        //va chercher function listPost dans le controller dedier
                }
                // AFFICHE UN ARTICLE
                elseif ($_GET['action'] == 'post') {
                        if (isset($_GET['id']) && $_GET['id'] > 0) {
                            post();
                        }
                        else {
                            throw new Exception('Aucun identifiant de billet envoyé');
                        }
                }
                //ECRIRE UN COMMENTAIRE
                elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                        }
                        else {
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    }   
                    else{
                        throw new Exception('Aucun identifiant de billet envoyé');
                        }
                }
                //CONNEXION DE LADMININISTRATEUR DANS SA BASE DE GESTION
                elseif ($_GET['action'] == 'login'){
                    if (isset($_POST['userNickname']) && !empty($_POST['userNickname']) && isset($_POST['userPassword']) && !empty($_POST['userPassword']))
                    {
                        verifyMember($_POST['userPassword'], $_POST['userNickname']);
                    }
                    else{
                        throw new Exception('Tous les champs ne sont pas remplis');
                    }
                }
                
                //acces à la zone d'administration
                elseif($_GET['action'] == 'admin'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        require('view/backend/baseAdmin.php');
                    }
                    else{
                        throw new Exception($accesdenied);
                    }
                }
                //acces a la gestion des articles
                elseif($_GET['action'] == 'managePosts'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        listPostsBack();
                    }
                    else{
                        throw new Exception($accesdenied);
                    }
                }
                //gestion de la suppression des articles 
                elseif($_GET['action'] == 'deletePost'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            deletePost($_GET['id']);

                        }
                        else{
                            throw new Exception('Aucun id d\'article');
                        }
                    }
                    else{
                        throw new Exception($accesdenied);
                    }
                }
                //vers la page d'ecriture d'un article
                elseif($_GET['action'] == 'writeNewPost'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        require('view/backend/newPostWrite.php');
                    }else{
                        throw new Exception($accesdenied);
                    }
                }

                //ECRIRE UN NOUVEL ARTICLE 
                elseif($_GET['action'] == 'newPost'){
                    if (!empty($_POST['title']) && !empty($_POST['author'])&& !empty($_POST['content']))
                    {
                        newPost($_POST['title'], $_POST['author'], $_POST['content']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis');
                    }
                }
                //acces à l'edition d'un article 
                elseif ($_GET['action'] == 'editPostView') {
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        if (isset($_GET['id']) && $_GET['id'] > 0) {
                            viewEditPost($_GET['id']);
                        }
                        else {
                            throw new Exception('Aucun article à éditer !');
                        }
                    }
                    else{
                        throw new Exception($accesdenied);
                    }
                }
                //validation de l'edition de l'article
                elseif($_GET['action'] == 'editPost'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        if (isset($_GET['id']) && $_GET['id'] > 0){
                            //Image présente dans l'input file
                            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
                                $imgUrl = getImgUrl();
                                editPost($_GET['id'], $_POST['title'], $_POST['author'], $_POST['content'], $imgUrl);
                            //si pas d'image selectionner
                            }
                            else{
                                $imgUrl = null;
                                editPost($_GET['id'], $_POST['title'], $_POST['author'], $_POST['content'], $imgUrl);
                            }
                        }
                        else{
                            throw new Exception('Aucun id d\'article');
                        }
                    }
                    else{
                        throw new Exception($accesdenied);
                    }
                }
                //vers la page de gestion des commentaires
                elseif($_GET['action'] == 'manageComments'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        listCommentsBack();
                    }
                    else{
                        throw new Exception($accesdenied);
                    }
                }
                //signalement d'un commentaire
                elseif ($_GET['action'] == 'signal') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        signalCom($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de commentaire envoyé');
                    }
                }
                //vers la vue edition de commentaire
                elseif ($_GET['action'] == 'editCommentView') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        viewEditCom($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun identifiant de commentaire envoyé');
                    }
                }
                elseif($_GET['action'] == 'editComment'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        if (isset($_GET['id']) && $_GET['id'] > 0){
                            editCom($_GET['id'], $_POST['author'], $_POST['comment'], $_POST['status']);
                        }else{
                            throw new Exception('Aucun id de commentaire');
                        }
                    }else{
                        throw new Exception($accesdenied);
                    }
                }
                //Suppression d'un commentaire
                elseif($_GET['action'] == 'deleteComment'){
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            deleteCom($_GET['id']);
                        }
                        else{
                            throw new Exception('Aucun id d\'article');
                        }
                    }
                    else{
                        throw new Exception($accesdenied);
                    }
                }
                //redirection vers la modif de mot passe
                elseif ($_GET['action'] == 'creationUser') {
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        require('view/backend/newPassView.php');
                    }
                }
                //Creation d'un nouveau mot de passe
                elseif ($_GET['action'] == 'newPass') {
                    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
                        if (isset($_POST['password']) && !empty($_POST['password'])
                            && isset($_POST['password2']) && !empty($_POST['password2']))
                        {
                            passMember($_POST['password'], $_POST['password2']);
                        }
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis');
                    }
                }
                //logout membre
                elseif ($_GET['action'] == 'logout'){
                    logout();
                }
            }
            //Affichage de la liste des billets
            else{
                listPosts();
            }
        }
        //Gestion des erreurs
        catch(Exception $e) {
            ob_start();
            ?>
            <div id="errorPage">
                <p><?php  echo 'Erreur : ' . $e->getMessage(); ?></p>
                <p>Retour à <a href="index.php">l'accueil</a></p>
            </div>
            <?php
            $content = ob_get_clean();
            require('view/frontend/template.php');
        }
    }
}