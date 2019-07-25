<?php
require_once 'header.php'; ?>

<?php
  require_once '../classes/anuncios.class.php';
  require_once '../classes/categorias.classes.php';
  $c = new Categorias();
  $a = new Anuncios();
  $filtros = array(
    'categoria'=>'',
    'regiao'=>''
  );
  if(isset($_GET['filtros'])){
      $filtros = $_GET['filtros'];
  }

  $regiao = $c->getRegiao();
  $categorias = $c->getListas();
  $total_anuncios = $a->getTotalAnuncios($filtros);
  $p = 1;
  if(isset($_GET['p']) && !empty($_GET['p'])){
      $p = addslashes($_GET['p']);
  }
  $por_pagina = 10;
  $tot_paginas = ceil($total_anuncios/$por_pagina);
  $anuncios = $a->getUltimosAnuncios($p,$por_pagina,$filtros);

?>
<div id="a">
<div class="row">        
    <div class="col-sm-4" ></div>
    <div class="col-sm-8" ></div>
    
</div>
  
</div>
<div class="container-fluid">
  <div class="jumbotron">

    <h2><strong>Confira as mais de <?php echo $total_anuncios; ?> vagas e saia já do desemprego</strong></h2>
    <h3>Faça seu curriculo online de maneira Rápida </h3>
    <img src="../assets/images/vagas.png" width="100px"/>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <h4>Pesquisa Avançada</h4>
        <form method="GET">
          <div clas="form-group">
            <label for="categoria">Categoria:</label></br>
            <select id="categoria" name="filtros[categoria]" class="form=control">
              <option></option>
              <?php foreach($categorias as $cat): ?>

                <option value="<?php echo $cat['id'] ?>"<?php echo ($cat['id'] ==  $filtros['categoria'])?'selected = "selected"':''; ?>
                  ><?php echo utf8_encode($cat['nome']); ?></option>

              <?php endforeach; ?>
            </select>
          </div>



        </br><div clas="form-group">
            <label for="regiao">Região:</label></br>
            <select id="regiao" name="filtros[regiao]" class="form=control">
              <option></option>
              <?php foreach($regiao as $re): ?>

                <option value="<?php echo $re['id'] ?>"<?php echo ($re['id'] ==  $filtros['regiao'])?'selected = "selected"':''; ?>><?php echo utf8_encode($re['cidade']); ?></option>

              <?php endforeach; ?>
            </select>
          </div></br>



          <div class="form-group">
              <input type="submit" value="Buscar" class="btn btn-info"/>
          </div>

          <div class="fb-page" data-href="https://www.facebook.com/Emprego-J%C3%A1-768678286652028/?modal=admin_todo_tour" data-tabs="timeline" data-width="200px" data-height="300px" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Emprego-J%C3%A1-768678286652028/?modal=admin_todo_tour" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Emprego-J%C3%A1-768678286652028/?modal=admin_todo_tour">Emprego Já</a></blockquote></div>


        </form>
    </div>
    <div class="col-sm-9">
      <h4>Últimas Vagas</h4>
      <table class="table table-striped">
          <tbody>
            <?php foreach($anuncios as $anuncio): ?>
              <tr>
                <td>
                  <?php
                      if(!empty($anuncio['url'])):
                  ?>
                  <img src="../assets/images/anuncios/<?php echo $anuncio['url']; ?>" heigth="180"
                  width="250" border="0"/>
                <?php else:  ?>
                  <img src="../assets/images/default.jpg" heigth="10" width="50" border="0" />
                <?php endif; ?>
                </td>

                <td><a href="produto.php?id=<?php echo $anuncio['id'];?>"><?php echo $anuncio['titulo']; ?></a></br><?php echo utf8_encode($anuncio['categoria']); ?></td>
                <td><?php echo $anuncio['nome_empresa']; ?><br><br><br><br><div class="fb-share-button" data-href="http://buscoemprego.com/pages/index.php" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fbuscoemprego.com%2Fpages%2Findex.php&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartilhar</a></div></td>
                <td>R$<?php echo $anuncio['salario']; ?></td>
                <td><?php echo utf8_encode($anuncio['regiao']); ?></td>
                <td><?php echo "DATA ".$anuncio['data']; ?></td>

              </tr>
            <?php endforeach; ?>
          <tbody/>
      </table>
      <ul class="pagination">
        <?php for($q=1; $q<=$tot_paginas; $q++): ?>
          <li class="<?php  echo($p == $q)?'active':'';?>"><a href="index.php?<?php $w = $_GET; $w['p'] = $q; echo http_build_query($w); ?>">
            <?php echo $q;?></a></li>
        <?php endfor; ?>
      </ul>
    </div>

  </div>
</div>




<?php
require_once 'footer2.php'; ?>