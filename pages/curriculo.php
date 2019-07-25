<?php require_once 'header.php'; ?>
<?php
if(empty($_SESSION['cLogin'])){
      ?>
        <script type="text/javascript">window.location.href="login.php";</script>
  <?php
  exit;
}

require_once '../classes/curriculo.class.php';
$id = $_GET['id'];





?>
<div class="container">
  <h2>Curriculo-Adicionar Curriculo</h2>

  <form method="POST" enctype="multipart/form-data" action="curriculoFinal.php"  >

  <fieldset><legend><strong>Dados pessoais</strong></legend>
    <div class="form-group">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" class="form-control"/>

        <label for="nacionalidade">Nacionalidade: </label>
        <input type="text" name="nacionalidade" class="form-control"/>

        <label for="idade">idade: </label>
        <input type="text" name="idade" class="form-control"/>

        <label for="endereco">Endereço: </label>
        <input type="text" name="endereco" class="form-control"/>

        <label for="estado">Estado/Cidade: </label>
        <input type="text" name="estado" class="form-control"/>

        <label for="email">Telefone/email: </label>
        <input type="text" name="email" class="form-control"/>
</div>
</fieldset>

<fieldset><legend>Objetivo:</legend>
  <div class="form-group">
        <label for="objetivo">Objetivo: </label>
        <textarea type="text" name="objetivo" class="form-control"></textarea>
  </div>
</fieldset>

<fieldset><legend>Formação: </legend>
    <div class="form-group">
        <label for="formacao">Formação: </label>
        <input type="text" name="formacao1" class="form-control"/>
        <input type="text" name="formacao2" class="form-control"/>
        <input type="text" name="formacao3" class="form-control"/>
</div>
</fieldset>
<fieldset><legend>Experiência Profissional</legend>
    <div class="form-group">
        <label for="tempo">tempo/nomedaempresa: </label>
        <input type="text" name="tempo1" class="form-control"/>
        <label for="cargo">Cargo: </label>
        <input type="text" name="cargo1" class="form-control"/>
        <h4>Opcional</h4>
        <label for="tempo2">tempo/nomedaempresa: </label>
        <input type="text" name="tempo2" class="form-control"/>
        <label for="cargo2">Cargo: </label>
        <input type="text" name="cargo2" class="form-control"/>
        <h4>Opcional</h4>
        <label for="tempo3">tempo/nomedaempresa: </label>
        <input type="text" name="tempo3" class="form-control"/>
        <label for="cargo3">Cargo: </label>
        <input type="text" name="cargo3" class="form-control"/>
    </div>
</fieldset>

<fieldset><legend>qualificações e atividades complementares</legend>
  <input type="text" name="quali1" class="form-control"/>
  <input type="text" name="quali2" class="form-control"/>
  <input type="text" name="quali3" class="form-control"/>

</fieldset>

<div class="form-group">
<label for="addfoto">Sua Foto:</label>
<input type="file" name="fotos[]"/>
</div>

<input type="submit" href="curriculoFinal.php"; value="Gerar Curriculo" class="btn btn-default"/>
    </form>
</div>
</div>
<?php
require 'footer2.php';
?>
