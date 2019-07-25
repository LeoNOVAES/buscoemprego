<?php

  class Anuncios{

      public function getUltimosAnuncios($page,$perPage,$filtros){
        global $pdo;
        $offset = ($page-1)*$perPage;
        $array = array();

        $filtrostring = array('1=1');
        if(!empty($filtros['categoria'])){
          $filtrostring[] = 'anuncios.id_categorias = :id_categoria';
        }
        if(!empty($filtros['regiao'])){
          $filtrostring[] = 'anuncios.id_regiao = :id_regiao';
        }



        $sql=$pdo->prepare("SELECT
          *,
          (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1 )as url,
          (select categorias.nome from categorias where categorias.id = anuncios.id_categorias )as categoria,
          (select regiao.cidade from regiao where id = anuncios.id_regiao )as regiao
          FROM anuncios WHERE ".implode(' AND ', $filtrostring)." ORDER BY id DESC limit $offset,$perPage ");


          if(!empty($filtros['categoria'])){
            $sql->bindValue(':id_categoria',$filtros['categoria']);
          }
          if(!empty($filtros['regiao'])){
            $sql->bindValue(':id_regiao',$filtros['regiao']);
          }


        $sql->execute();

        if($sql->rowCount() > 0 ){
            $array = $sql->fetchAll();
        }

          return $array;

      }


      public function getMeusAnuncios(){
            global $pdo;
            $array = array();
            $sql=$pdo->prepare("SELECT *,
              (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1 )
            as url FROM anuncios WHERE id_usuario = :id_usuario");
            $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
            $sql->execute();

            if($sql->rowCount() > 0 ){
                $array = $sql->fetchAll();
            }

              return $array;

      }

      public function getAnuncio($id){

          $array=array();
          global $pdo;
          $sql = $pdo->prepare("SELECT
            *,
            (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1 )as url,
            (select categorias.nome from categorias where id = anuncios.id_categorias )as categoria,
            (select regiao.cidade from regiao where id = anuncios.id_regiao )as regiao,
            (select usuarios.email from usuarios where id = anuncios.id_usuario )as email
             FROM anuncios WHERE id = :id");
          $sql->bindValue(":id",$id);
          $sql->execute();

          if($sql->rowCount() > 0){

              $array = $sql->fetch();
              $array['fotos'] = array();

              $sql = $pdo->prepare("SELECT url,id FROM anuncios_imagens WHERE id_anuncio = :id_anuncio ");
              $sql->bindValue(":id_anuncio",$id);
              $sql->execute();

              if($sql->rowCount() > 0){
                $array['fotos'] = $sql->fetchAll();

              }



          }
          return $array;

      }

      public function getTotalAnuncios($filtros){
          global $pdo;
          $filtrostring = array('1=1');
          if(!empty($filtros['categoria'])){
            $filtrostring[] = 'anuncios.id_categorias = :id_categoria';
          }
          if(!empty($filtros['regiao'])){
            $filtrostring[] = 'anuncios.id_regiao = :id_regiao';
          }
          $sql = $pdo->prepare("SELECT COUNT(*) as c FROM anuncios WHERE ".implode(' AND ',$filtrostring));

          if(!empty($filtros['categoria'])){
            $sql->bindValue(':id_categoria',$filtros['categoria']);
          }
          if(!empty($filtros['regiao'])){
            $sql->bindValue(':id_regiao',$filtros['regiao']);
          }
          $sql->execute();
          $row = $sql->fetch();

          return $row['c'];

      }



      public function addAnuncios($categoria,$regiao,$titulo,$email_empresa,$empresa,$descricao,$salario){
          global $pdo;

          $sql = $pdo->prepare("INSERT INTO anuncios SET id_usuario = :id_usuario,id_categorias = :id_categoria,id_regiao =
        :id_regiao,titulo =:titulo,email_empresa = :email_empresa,nome_empresa = :nome_empresa,descricao = :descricao,salario = :salario,data = date(NOW())");

          $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
          $sql->bindValue(":id_categoria",$categoria);
          $sql->bindValue(":id_regiao",$regiao);
          $sql->bindValue(":titulo",$titulo);
          $sql->bindValue(":email_empresa",$email_empresa);
          $sql->bindValue(":nome_empresa",$empresa);
          $sql->bindValue(":descricao",$descricao);
          $sql->bindValue(":salario",$salario);
    

          $sql->execute();




      }

      public function excluirAnuncio($id){
        global $pdo;
        $sql = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio ");
        $sql->bindValue(":id_anuncio",$id);
        $sql->execute();

        $sql = $pdo->prepare("DELETE FROM anuncios WHERE id = :id ");
        $sql->bindValue(":id",$id);
        $sql->execute();

      }

      public function excluirFoto($id){
        global $pdo;
        $idanuncio = 0;
        $sql = $pdo->prepare("SELECT id_anuncio FROM anuncios_imagens WHERE id = :id ");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount()>0){
          $row = $sql->fetch();
          $idanuncio = $row['id_anuncio'];
        }

        $sql = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id = :id ");
        $sql->bindValue(":id",$id);
        $sql->execute();


      }



            public function editAnuncios($titulo,$categoria,$email_empresa,$empresa,$salario,$descricao,$regiao,$fotos,$id){
                global $pdo;

                $sql = $pdo->prepare("UPDATE anuncios SET id_usuario = :id_usuario,id_categorias = :id_categoria,id_regiao =
              :id_regiao,titulo =:titulo,nome_empresa = :nome_empresa,descricao = :descricao,salario = :salario WHERE id =:id" );

                $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
                $sql->bindValue(":id_categoria",$categoria);
                $sql->bindValue(":id_regiao",$regiao);
                $sql->bindValue(":titulo",$titulo);
                $sql->bindValue(":nome_empresa",$empresa);
                $sql->bindValue(":descricao",$descricao);
                $sql->bindValue(":salario",$salario);
                $sql->bindValue(":id",$id);
                $sql->execute();
             

                if(count($fotos)>0){
                  for($q=0;$q<count($fotos['tmp_name']);$q++){
                    $tipo = $fotos['type'][$q];
                    if(in_array($tipo,array('image/jpeg','image/png'))){
                        $tmpname = md5(time().rand(0,999)).'.jpg';
                        move_uploaded_file($fotos['tmp_name'][$q],'../assets/images/anuncios/'.$tmpname);

                        list($width_ori,$height_ori ) = getimagesize('../assets/images/anuncios/'.$tmpname);
                        $ratio = $width_ori/$height_ori;

                        $width = 500;
                        $height = 500;
                        if($width/$height > $ratio){
                          $width = $height*$ratio;
                        }else{
                            $height = $width/$ratio;
                        }

                        $img = imagecreatetruecolor($width, $height);
                        if($tipo == 'image/jpeg'){
                            $origi = imagecreatefromjpeg('../assets/images/anuncios/'.$tmpname);
                        }elseif($tipo == 'image/png'){
                          $origi = imagecreatefrompng('../assets/images/anuncios/'.$tmpname);
                        }

                        imagecopyresampled($img,$origi,0,0,0,0,$width,$height,$width_ori,$height_ori);

                        imagejpeg($img,'../assets/images/anuncios/'.$tmpname, 80);

                        $sql = $pdo->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url");
                        $sql->bindValue(":id_anuncio",$id);
                        $sql->bindValue(":url",$tmpname);
                        $sql->execute();



                    }
                  }
                }
}

  }



?>
