
<?php

class Usuarios{

  public function cadastrar($nome, $email, $senha, $telefone, $regiao){
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindValue(":email",$email);
        $sql->execute();



        if($sql->rowCount() == 0){

            $sql = $pdo->prepare("INSERT INTO usuarios SET nome=:nome,email=:email,senha=:senha,telefone=:telefone,regiao=:regiao");
            $sql->bindValue(":nome",$nome);
            $sql->bindValue(":email",$email);
            $sql->bindValue(":senha",md5($senha));
            $sql->bindValue(":telefone",$telefone);
            $sql->bindValue(":regiao",$regiao);
            $sql->execute();


            return true;
        }else{
          return false;
        }
  }

      public function login($email, $senha){
        global $pdo;
        $sql = $pdo->prepare("SELECT id,nome FROM usuarios WHERE email =:email AND senha = :senha");
        $sql->bindValue(":email",$email);
        $sql->bindValue(":senha",md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0 ){
          $dado = $sql->fetch();
          echo $dado['id'];
          echo $dado['nome'];
          $_SESSION['cLogin'] = $dado['id'];
          $_SESSION['username'] = $dado['nome'];
          return true;
        }else{
          return false;
        }

      }

      


}



?>
