<?php require 'header.php';  ?>
  <div class="container">
    <div class="jumbotron">
      <h1>Cadastre-se</h1>
        <?php
          require_once '../classes/usuarios.class.php';
          ?>
          <?php



            $u = new Usuarios();


              if(isset($_POST['nome']) && !empty($_POST['nome'])){
                  $nome = addslashes($_POST['nome']);
                  $email = addslashes($_POST['email']);
                  $senha = $_POST['senha'];
                  $telefone = addslashes($_POST['telefone']);
                  $regiao = addslashes($_POST['regiao']);


            if(!empty($nome) && !empty($email) && !empty($senha) && !empty($telefone) ){
              if($u->cadastrar($nome, $email, $senha, $telefone, $regiao)){
                ?>
                <div class="alert alert-success">
                    <strong>Parabéns!</stong>Cadastrado com sucesso<a href="login.php"
                      class="alert-link">Faça o Login agora!</a>
                </div>
                <?php
              }else{
                ?>
                <div class="alert alert-warning">
                    <strong> Já  existe esse usuário  </stong><a href="login.php"
                      class="alert-link"> Faça o Login agora!</a>
                </div>
                <?php
              }
            }else{
              ?>
              <div class="alert alert-warning">
                  Preencha todos os campos corretamente!
              </div>
              <?php
            }
          }
          ?>
        <form method="POST" >
        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="senha">Senha: </label>
            <input type="password" name="senha" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="regiao">Região: </label>
            <input type="text" name="regiao" class="form-control"/>
        </div>
        <input type="submit" value="Cadastrar" class="btn btn-default"/>
        </form>
    </div>
  </div>
<?php
  require 'footer.php';
?>
