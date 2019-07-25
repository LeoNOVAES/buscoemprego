<?php require_once 'header.php'; ?>
<?php
if(empty($_SESSION['cLogin'])){
      ?>
        <script type="text/javascript">window.location.href="login.php";</script>
  <?php
  exit;
}
require_once '../classes/anuncios.class.php';
$a = new Anuncios();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
  $titulo = addslashes($_POST['titulo']);
  $categoria = addslashes($_POST['categoria']);
  $email_empresa = addslashes($_POST['email_empresa']);
  $empresa = addslashes($_POST['empresa']);
  $salario = addslashes($_POST['salario']);
  $descricao = addslashes($_POST['descricao']);
  $regiao = addslashes($_POST['regiao']);
  if(isset($_FILES['fotos'])){
  $fotos = $_FILES['fotos'];
}else{
  $fotos=array();
}

  $a->editAnuncios($titulo,$categoria,$email_empresa,$empresa,$salario,$descricao,$regiao,$fotos,$_GET['id']);


?>
<div class="alert alert-success">
  Anúncio Editado com sucesso!
</div>
<?php
}
$anuncio = new Anuncios();
if(isset($_GET['id']) && !empty($_GET['id'])){
    $dado = $anuncio->getAnuncio($_GET['id']);

}else{
  ?>
    <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
<?php
exit;

}



?>


<div class="container">
  <h2>Meus Anúncios-Editar Anúncio</h2>

  <form method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" class="form-control">
        <?php require_once '../classes/categorias.classes.php';
              $c = new Categorias();
              $cats = $c->getListas();
              foreach($cats as $cat):
        ?>
        <option value="<?php echo $cat['id'];?>"<?php echo ($dado['id_categorias'] == $cat['id'])?'selected="selected"':''; ?>><?php echo utf8_encode($cat['nome']) ; ?></option>

        <?php
          endforeach;
          ?>



      </select>
    </div>

    <div class="form-group">
      <label for="titulo">Titulo:</label>
      <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $dado['titulo']; ?>"/>
    </div>

    <div class="form-group">
      <label for="empresa">Empresa:</label>
      <input type="text" name="empresa" id="empresa" class="form-control" value="<?php echo $dado['nome_empresa']; ?>"/>
    </div>

    <div class="form-group">
      <label for="email_empresa">Email Empresa:</label>
      <input type="text" name="email_empresa" id="empresa_email" class="form-control" value="<?php echo $dado['email_empresa']; ?>"/>
    </div>


    <div class="form-group">
      <label for="salario">Salário:</label>
      <input type="text" name="salario" class="form-control" value="<?php echo $dado['salario']; ?>"/>
    </div>

    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" class="form-control"><?php echo $dado['descricao']; ?></textarea>
    </div>


    <div class="form-group">
    <label for="regiao">Região:</label>
    <select name="regiao" id="regiao" class="form-control">
      <?php require_once '../classes/categorias.classes.php';
            $c = new Categorias();
            $rs = $c->getRegiao();
            foreach($rs as $re):
      ?>
      <option value="<?php echo $re['id'];?>" <?php echo ($dado['id_regiao'] == $re['id'])?'selected="selected"':''; ?> ><?php echo utf8_encode($re['cidade']) ; ?></option>

      <?php
        endforeach;
      ?>
    </select></br>
  </div>
  <div class="form-group">
        <label for="add-foto">Fotos do Anúncio</label>
        <input type="file" name="fotos[]" multiple/></br>

        <div class="panel panel-default">
            <div class="panel-heading">Fotos Anúncios</div>
            <div class="panel-body">
                <?php foreach($dado['fotos'] as $foto):   ?>
                  <div class="foto_item">
                    <img src="../assets/images/anuncios/<?php echo $foto['url'];?>" class="img-thumbnail" border="0"/></br>
                    <a href="excluir-fotos.php?id=<?php echo $foto['id']; ?>" class="btn btn-default">Excluir Imagens</a>
                  </div>
              <?php endforeach;  ?>
            </div>
        </div>
  </div>


    <input type="submit" value="Salvar" class="btn btn-default"/>



  </form>
</div>

<?php require_once 'footer2.php'; ?>
