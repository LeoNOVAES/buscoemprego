<?php
  class Categorias{

      public function getListas(){
        $array = array();
        global $pdo;
        $sql = $pdo->query("SELECT * FROM categorias");
        if($sql->rowCount()>0){
          $array = $sql->fetchAll();

        }
        return $array;


      }

      public function getRegiao(){
        $array = array();
        global $pdo;
        $sql = $pdo->query("SELECT * FROM regiao");
        if($sql->rowCount()>0){
          $array = $sql->fetchAll();

        }
        return $array;


      }




  }



?>
