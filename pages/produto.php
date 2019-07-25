<?php
require_once 'header.php'; ?>
<?php
  require_once '../classes/anuncios.class.php';
  require_once '../classes/usuarios.class.php';

  $a = new Anuncios();
  $u = new Usuarios();

  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = addslashes($_GET['id']);

  }else{
    ?>
      <script type="text/javascript">window.location.href="login.php";</script>
<?php
  }

  $info = $a->getAnuncio($id);



?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-5">
    <div class="carousel slide" data-ride="carousel" id="meuCarousel">
      <div class="carousel-inner" role="listbox">
        <?php foreach($info['fotos'] as $chave => $foto ):?>
          <div class="item <?php echo ($chave == '0')?'active':''; ?>">
            <?php if(empty($foto['url'])): ?>
              <img src="../assets/images/default.jpg" />
          <?php else: ?>
            <img src="../assets/images/anuncios/<?php echo $foto['url']; ?>"/>

          <?php endif;  ?>

          </div>
        <?php endforeach;?>
      </div>
      <a class="left carousel-control" href="#meuCarousel" role="button" data-slide="prev"><span><</span></a>
      <a class="right carousel-control" href="#meuCarousel" role="button" data-slide="next"><span>></span></a>
  </div>
  </div>
  
  <div class="col-sm-7">
    <h1><strong><?php echo $info['titulo']; ?></strong></h1>
    <h4><strong>Local:</strong><?php echo utf8_encode($info['regiao']); ?></h4>
    <h5><strong>Área:</strong> <?php echo utf8_encode($info['categoria']); ?></h5>
    <div id="desc">
    <p><?php echo $info['descricao'];  ?></p>
    </div>    
    <h4><strong>Salário:</strong><?php echo $info['salario']; ?></h4>
    <h4><strong>Contato:</strong> <?php echo $info['email_empresa']; ?></h4>

</div>

</div>
</div>
<?php
require_once 'footer2.php'; ?>
