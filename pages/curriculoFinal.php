


<?php
require_once 'header.php';

require_once '../classes/curriculo.class.php';

$c = new Curriculo();

if(isset($_POST['nome']) && !empty($_POST['nome'])){
  $nome = addslashes($_POST['nome']);
  $nacionalidade = addslashes($_POST['nacionalidade']);
  $idade= addslashes($_POST['idade']);
  $endereco= addslashes($_POST['endereco']);
  $estado= addslashes($_POST['estado']);
  $email= addslashes($_POST['email']);
  $objetivo= addslashes($_POST['objetivo']);
  $formacao1= addslashes($_POST['formacao1']);
  $formacao2= addslashes($_POST['formacao2']);
  $formacao3= addslashes($_POST['formacao3']);
  $tempo1= addslashes($_POST['tempo1']);
  $cargo1= addslashes($_POST['cargo1']);
  $tempo2= addslashes($_POST['tempo2']);
  $cargo2= addslashes($_POST['cargo2']);
  $tempo3= addslashes($_POST['tempo3']);
  $cargo3= addslashes($_POST['cargo3']);
  $quali1= addslashes($_POST['quali1']);
  $quali2= addslashes($_POST['quali2']);
  $quali3= addslashes($_POST['quali3']);
if( isset($_FILES['fotos'])){
  $fotos = $_FILES['fotos'];
}else{
  $fotos  = array();
}

  $est = $c->addCurriculo($nome,$nacionalidade,$idade,$endereco,$estado,$email,$objetivo,$formacao1,$formacao2,
  $formacao3,$tempo1,$cargo1,$tempo2,$cargo2,$tempo3,$cargo3,$quali1,$quali2,$quali3,$fotos);
}
?>

<?php





$curriculo = $c->getCurriculo();



?>

<div class="container">
<div class="conteudo">
<?php foreach($curriculo as $cu):?>
  <img src="../assets/images/<?php echo $cu['url']; ?>" heigth="10"
width="50" border="0"/>
<h1><strong><?php echo $cu['nome'];  ?></strong></h1>
<p><?php echo $cu['nacionalidade'] ?>  ,  <?php echo $cu['idade'] ?></p>
<p><?php echo $cu['endereco'] ?> </p>
<p><?php echo $cu['email'] ?></p></br>

<h3>Objetivo</h3>
<p><?php echo $cu['objetivo'] ?></p></br>

<h3>Formação</h3>

<p><?php echo $cu['formacao1'] ?></p><p><?php echo $cu['formacao2'] ?></p><p><?php echo $cu['formacao3'] ?></p></br>

<h3>Experiência Profissional</h3>

<p></strong><?php echo $cu['tempo1'] ?> - <?php echo $cu['cargo1'] ?></p><p><?php echo $cu['tempo2'] ?> -
<?php echo $cu['cargo2'] ?></p><p><?php echo $cu['tempo3'] ?> - <?php echo $cu['cargo3'] ?>
</strong></br></p></br>

<h3>Qualificações e atividades complementares</h3>

<p><?php echo $cu['quali1'] ?></p><p><?php echo $cu['quali2'] ?> - <?php echo $cu['quali3'] ?></p>


<?php endforeach;?>
</div>
</div>
<?php
require_once 'footer.php';

?>
