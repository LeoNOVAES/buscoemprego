<?php require 'header.php'?>
  <?php
  if(empty($_SESSION['cLogin'])){
        ?>
          <script type="text/javascript">window.location.href="login.php";</script>
    <?php
    exit;
  }
?>
<div class="container">
  <h2>Meus Anúncios</h2>
  <a href="add-anuncio.php" class="btn btn-default">Adicionar Anúncio</a>
  <table class="table table=striped">

    <thead>
        <tr>
            <th>Foto</th>
            <th>Titulo</th>
            <th>Empresa</th>
            <th>Salário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <?php
          require '../classes/anuncios.class.php';
          $a = new Anuncios();
          $anuncios = $a->getMeusAnuncios();

          foreach($anuncios as $anuncio ):
      ?>
      <tr>


        <td>
          <?php
              if(!empty($anuncio['url'])):
          ?>
          <img src="../assets/images/anuncios/<?php echo $anuncio['url']; ?>" heigth="10"
          width="50" border="0"/>
        <?php else:  ?>
          <img src="../assets/images/default.jpg" heigth="10" width="50" border="0" />
        <?php endif; ?>
        </td>
        <td><?php echo $anuncio['titulo']; ?></td>
        <td><?php echo $anuncio['nome_empresa']; ?></td>
        <td>R$<?php echo $anuncio['salario']; ?></td>
        <td>
            <a href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-default">EDITAR</a>
            <a href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>"class="btn btn-danger">EXCLUIR</a>
        </td>

      </tr>
      <?php
        endforeach;
      ?>

  </table>


</div>



<?php require_once 'footer2.php'?>
