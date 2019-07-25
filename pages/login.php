<?php require 'header.php';  ?>
  <div class="container">
    <div class="jumbotron">
      <h1>Login</h1>

          <?php

            require_once '../classes/usuarios.class.php';

          $u = new Usuarios();
              if(isset($_POST['email']) && !empty($_POST['email'])){
                  $email = addslashes($_POST['email']);
                  $senha = $_POST['senha'];

                  if($u->login($email,$senha)){
                      ?>
                      <script type="text/javascript">window.location.href="./";</script>

                      <?php
                  }else{
                    ?>
                      <div class="alert alert-danger">
                        Usuário e/ou senha Errados!
                      </div>
                    <?php
                  }

          }
          ?>
        <form method="POST" >

        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="senha">Senha: </label>
            <input type="password" name="senha" class="form-control"/>
        </div>

        <input type="submit" value="ENTRAR" class="btn btn-default"/>
        </form>
    </div>
  </div>
<?php
  require 'footer2.php';
?>
