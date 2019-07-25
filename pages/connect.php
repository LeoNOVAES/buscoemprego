<?php
  session_start();
  global $pdo;
  try{
        $pdo = new PDO("mysql:dbname=jngospel_classificados; host=198.27.126.87
","jngospel","X7bpu7l6Y8");

  }catch(PDOExeception $e){
      echo "erro: ".$e->getMessage();
      exit;
  }







?>
