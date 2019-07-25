<?php
require 'connect.php';
if(empty($_SESSION['cLogin'])){
  header("Location: login.php");
  exit;
}

require '../classes/anuncios.class.php';

$a = new Anuncios();

if(isset($_GET['id'])&& !empty($_GET['id'])){
  $idanuncio = $a->excluirFoto($_GET['id']);
  $id = $_GET['id'];

}
if(isset($id)){
  header("Location: editar-anuncio.php?id=".$id);

}else{
  header("Location: meus-anuncios.php");
}


?>
