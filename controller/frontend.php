<?php
error_reporting(E_ALL);

session_start();
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AuthManager.php');
/*
* AFFICHE LES ARTICLES
*
* @param listPosts
*
* @require envoie sur la page des articles
*/
function listPosts()
{
    $postManager = new PostManager();
    //créer une instance de postmanager
    $posts = $postManager->getPosts();
    //appel mon model post manager et la function getpost
    //affichage de la liste des billets
    require('view/frontend/listPostsView.php');
}

/*
* affiche un article
*
* @param post
*
* @require envoie sur la page de l'article en question
*/
function post($postId = null, $message = null)
//Passage en option de l'id de l'article et du message pour le signalement de commentaire
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    //Dans le cas ou un commentaire a été signalé $postId contient l'id de l'article
    if(isset($postId)){
        $_GET['id'] = $postId;
    }
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('view/frontend/postView.php');
}
/*
* ajout d'un commentaire
*
* @param addComment
*
* @renvoie sur la page de l'article en question avec prise en charge du nouveau com
*/
function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    if ($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
/*
* Verification connexion d'un membre
*
* @param verifyMember
*
* @redirection vers la pages d'acceuil avec connexion etabli
*/
function verifyMember($userPassword, $userNickname)
{
    $authManager = new AuthManager();
    $member = $authManager->getMember($userNickname);
    //comparaison du mdp saisie avec le mdp hash de la bdd
    $isPasswordCorrect = password_verify($userPassword, $member['password']);
    //Si $member=false le membre n'est pas existant en bdd

   try{
        if (!$member)
        {
            throw new Exception('Mauvais utilisateur ou mot de passe!');
        }
        else
        //L'admin' existe 
        {
            if ($isPasswordCorrect)  {
                $_SESSION['id'] = $member['id'];
                $_SESSION['nickname'] = $member['nickname'];
                $_SESSION['password'] = $member['password'];
                $_SESSION['mail'] = $member['mail'];
                $_SESSION['userLevel'] = $member['userLevel'];
                //on redirige vers la page d'accueil qui prendra en compte les variable de session
                header('Location: index.php');
               
            }
        //Le mdp corresponds pas
            else {
                throw new Exception('Mauvais utilisateur ou mot de passe');
            }
        }
    }
    catch(Exception $e){
         $authInfo = $e->getMessage();
         ob_start();
         ?>
         <div id="wrongPass">
            <p><?php  echo 'Erreur : ' . $e->getMessage(); ?></p>
            <?php include('include/login.php');?>
        </div>
        <?php
        $content = ob_get_clean();
        require('view/frontend/template.php');
    }
}
/*
* Deconnection a l'admin
*
* @param logout
*
* @redirection vers la pages d'acceuil avec deconnexion etabli
*/
function logout()
{
    session_destroy ();
    header('Location: index.php');
}
?>