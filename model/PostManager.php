<?php
require_once("model/Manager.php"); 

class PostManager extends Manager 
{
    //Retourne tous les billet de la BDD
    public function getPosts()
    {
        $db = $this->dbConnect();
        //apelle la base de données
        $req = $db->query('SELECT id, title, author, content, img_posting, LEFT(content, 250) AS content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
        // il execute la requete sql en selectionnant l'id le titre l'autheur le contenu l'image dans dans le db post et les affiches par ordre decroissant.
        return $req;

    }
    //retourne un billet en fonction de l'id
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, author, content, img_posting, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;

    }
    //ECRITURE D ARTICLE
    public function writePost($title, $author, $content)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, author, content, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $post->execute(array($title, $author, $content));
        return $affectedLines;
    }
    //SUUPRESSION ARTICLES
    public function postDelete($postId) 
    {
        $db = $this->dbConnect();
        $post = $db->prepare("DELETE FROM posts WHERE id=".$postId);
        $affectedLines = $post->execute(array($postId));
        return $affectedLines;
    }
    //editer une image pour l'article
    public function postEditImg($id, $title, $author, $content, $imgUrl) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, author = ?, content = ?, img_posting = ? WHERE id = ?');
        $post = $req->execute(array($title, $author, $content, $imgUrl, $id ));
        return $post;
    }
    //editer un article
    public function postEdit($id, $title, $author, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, author = ?, content = ? WHERE id = ?');
        $post = $req->execute(array($title, $author, $content, $id ));
        return $post;
    }
}