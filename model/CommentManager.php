<?php
require_once("model/Manager.php"); 

class CommentManager extends Manager
{
    //ecrire un commentaire
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, status, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }
    //insert un commentaire
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
        return $affectedLines;
    }
    //afficher les commentaire
    public function getAllComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT id, post_id, author, comment, status, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments  ORDER BY status DESC, comment_date_fr DESC');
        return $comments;
    }
    //signaler un commentaire
    public function warnedCom($comId)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE comments SET status="warning" WHERE id='.$comId);
        $affectedLines = $comment->execute(array($comId));
        return $affectedLines;
    }
    // gerer la modification du commntaire
   public function getComment($comId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, status FROM comments WHERE id = ?');
        $req->execute(array($comId));
        $comment = $req->fetch();
        return $comment;
    }
    //gerer un commentaire par rapport a l'id
     public function getPostByComment($comId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT post_id FROM comments WHERE id = ?');
        $req->execute(array($comId));
        $postId = $req->fetch();
        return $postId;
    }
    //valider un commentaire
    public function commentEdit($id, $author, $comment, $status)
    {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET id = ?, author = ?, comment = ?, status = ? WHERE id ='.$id);
    $affectedLines = $req->execute(array($id, $author, $comment, $status));
    return $affectedLines;
    }
    //supprimer un commentaire
    public function commentDelete($comId)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare("DELETE FROM comments WHERE id=".$comId);
        $affectedLines = $comment->execute(array($comId));
        return $affectedLines;
    }
}