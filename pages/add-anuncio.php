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


  $a->addAnuncios($categoria,$regiao,$titulo,$email_empresa,$empresa,$descricao,$salario);


?>
<div class="alert alert-success">
  Anúncio Adicionado com sucesso!
</div>
<?php
}
?>


<div class="container">
  <h2>Meus Anúncios-Adicionar Anúncio</h2>

  <form method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" class="form-control">
        <?php require_once '../classes/categorias.classes.php';
              $c = new Categorias();
              $cats = $c->getListas();
              foreach($cats as $cat):
        ?>
        <option value="<?php echo $cat['id'];?>"><?php echo utf8_encode($cat['nome']) ; ?></option>

        <?php
          endforeach;
        ?>

      </select>
    </div>

    <div class="form-group">
      <label for="titulo">Titulo:</label>
      <input type="text" name="titulo" id="titulo" class="form-control"/>
    </div>

    <div class="form-group">
      <label for="empresa">Empresa:</label>
      <input type="text" name="empresa" id="empresa" class="form-control"/>
    </div>

    <div class="form-group">
      <label for="email_empresa">Email Empresa:</label>
      <input type="text" name="email_empresa" id="empresa_email" class="form-control"/>
    </div>

    <div class="form-group">
      <label for="salario">Salário:</label>
      <input type="text" name="salario" class="form-control"/>
    </div>

    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" class="form-control"></textarea>
    </div>


    <div class="form-group">
    <label for="regiao">Região:</label>
    <select name="regiao" id="regiao" class="form-control">
      <?php require_once '../classes/categorias.classes.php';
            $c = new Categorias();
            $rs = $c->getRegiao();
            foreach($rs as $re):
      ?>
      <option value="<?php echo $re['id'];?>"><?php echo utf8_encode($re['cidade']) ; ?></option>

      <?php
        endforeach;
      ?>

    </select>
  </div>

    <input type="submit" value="Adicionar" class="btn btn-default"/>



  </form>
</div>

<?php require_once 'footer2.php'; ?>
