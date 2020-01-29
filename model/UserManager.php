<?php
require_once("model/Manager.php");

class UserManager extends Manager
{
    //passage en parametre du nouveau mdp 
    public function pushMember($password){
      $db = $this->dbConnect();
      $sql = "UPDATE members SET password=? WHERE id=?";
      $db->prepare($sql)->execute([$password, 1]);
    }
}