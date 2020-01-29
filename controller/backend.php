<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
/*
* Créer un nouvel article
*
* @param newPost

* @param gere le titre l'autheur et le contenu
*
* @throws gere l'exception en cas d'erreur
*
* @else renvoie sur la page management des articles
*/
function newPost($title, $author, $content)
{
  $PostManager = new PostManager();
  $affectedLines = $PostManager->writePost($title, $author, $content);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter un article');
    }
    else {
        header('Location: index.php?action=managePosts');
    }
}
/*
* Vision global des articles
*
* @param listPostBack
*/

function listPostsBack()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/backend/managePostsView.php');
}
/*
* Supprime un article
*
* @param deletePost

* @param supprime l'article par l'id
*
* @throws gere l'exception en cas d'erreur
*
* @else renvoie sur la page management des articles
*/
function deletePost($postId)
{
    $postManager = new PostManager();
    $affectedLines = $postManager->postDelete($postId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer l\'article');
    }
    else {
        header('Location: index.php?action=managePosts');
    }
}
/*
* Modifier un article 
*
* @param editPost

* @param gere le titre l'autheur et le contenu et l'image
*
* @throws gere l'exception en cas d'erreur
*
* @else renvoie sur la page de l'article en question
*
*gestion des deux cas de figure (avec changement d'image et sans)
*/
function editPost($id, $title, $author, $content, $imgUrl)
{
    //si pas d'image selectionné on ne fait pas l'update de l'image et on garde celle présente
    if($imgUrl == null){
        $postManager = new PostManager();
        $affectedLines = $postManager->postEdit($id, $title, $author, $content);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'éditer l\'article');
        }
        else {
            header('Location: index.php?action=post&id='.$id);
        }
    //Sinon on fait un update complete de l'article
     }else{
        $postManager = new PostManager();
        $affectedLines = $postManager->postEditImg($id, $title, $author, $content, $imgUrl);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'éditer l\'article');
        }
        else {
            header('Location: index.php?action=post&id='.$id);
        }
    }
}
/*
* gère la vu vers un article
*
* @param viewEditPost
*
* @require envoie sur la page de modification d'article
*/
function viewEditPost($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);
    require('view/backend/editPostView.php');
}
/*
* gere la liste des commentaires
*
* @param listCommentsBack
*
* @require envoie sur la page management des commentaires
*/
function listCommentsBack()
{
    $commentManager = new CommentManager();
    $comments = $commentManager->getAllComments();
    require('view/backend/manageCommentsView.php');
}
/*
* signaler un commentaire
*
* @param signalCom
*
* @param indique si le com a été signaler ou non
*/
function signalCom($comId)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->warnedCom($comId);
    try{
        if ($affectedLines === false) {
            throw new Exception('Impossible de signaler le commentaire');
        }
        else {
            throw new Exception('Commentaire signalé avec succès ! ');
        }
    }
    catch(Exception $e){
        $message = $e->getMessage();
        //On récupere l'id de l'article correspondant au commentaire
        $affectedLines = $commentManager->getPostByComment($comId);
        $postId = $affectedLines[0];
        //On envoi à la fonction post l'id de l'article qui récupere l'article et les com lié
        post($postId, $message);
    }
}
/*
* vers la page d'edition du commentaire
*
* @param viewEditCom
*
* @require envoie sur la page d'administration
*/
function viewEditCom($comId)
{
     $commentManager = new CommentManager();
     $comment = $commentManager->getComment($comId);
     require('view/backend/editCommentView.php');
}
/*
* gere la validation d'un commentaire
*
* @param editCom
*
* envoie sur la page d'administration
*
* @param gere le titre l'autheur et le commentaire et son status (valide ou non)
*/
function editCom($id, $author, $comment, $status)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->commentEdit($id, $author, $comment, $status);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'éditer le commentaire');
    }
    else {
        header('Location: index.php?action=manageComments');
    }
}
/*
* gere la suppression d'un commentaire
*
* @param deleteCom
*
* envoi sur la page d'administration des commentaires
*/
function deleteCom($comId)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->commentDelete($comId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le commentaires');
    }
    else {
        header('Location: index.php?action=manageComments');
    }
}

/*
* gere l'ajout et le changement d'une image 
*
* @param getImgUrl
*
* @require envoie sur la page d'administration des commentaires
*/
function getImgUrl()
{
    $target_dir = "public/img/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileType == "jpg" OR $imageFileType == "png" OR $imageFileType == "jpeg"
    OR $imageFileType == "gif" ){
        if ($_FILES["image"]["size"] <= 4000000){
             move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        }
        else{
            throw new Exception('Fichier trop volumineux, 4Mo maximum');
        }
    }
    else{
        throw new Exception('Extension d\'image incompatible, veuillez charger une image .jpg, .png, .jpeg, .gif');
    }
    return $target_file;
}

/*
* gere le changement de mot de passe
*
* @param passMember
*
* @require envoie sur la page de changement de mot de passe
*
*   password = nouveau 1
*   password2 = nouveau 2 
*/
function passMember($password, $password2 )
{
    try{ 
        $userManager = new UserManager();
            if ($password != $password2){
                throw new Exception('Les mots de passe ne correspondent pas');
            }
            $password = password_hash($password, PASSWORD_DEFAULT);
            //insert dans la bdd 
            $push = $userManager->pushMember($password);
            
            throw new Exception('Votre mot de passe à été modifier avec succès');  
        }
        catch(Exception $e){
            $info = $e->getMessage();
            require('view/backend/newPassView.php');
        }
}
?>