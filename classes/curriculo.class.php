<?php

  class Curriculo{

      public function addCurriculo($nome,$nacionalidade,$idade,$endereco,$estado,$email,$objetivo,$formacao1,$formacao2,
      $formacao3,$tempo1,$cargo1,$tempo2,$cargo2,$tempo3,$cargo3,$quali1,$quali2,$quali3,$fotos){
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO curriculo SET id_usuario = :id_usuario,nome = :nome,nacionalidade = :nacionalidade,idade = :idade,endereco = :endereco,estado = :estado,
          email = :email,objetivo = :objetivo,formacao1 = :formacao1,formacao2 = :formacao2,formacao3 = :formacao3,tempo1 = :tempo1,cargo1 = :cargo1,tempo2 = :tempo2,cargo2 = :cargo2,
          tempo3 = :tempo3,cargo3 = :cargo3,quali1 = :quali1,quali2 = :quali2,quali3 = :quali3 ");
        $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
        $sql->bindValue(":nome",$nome);
        $sql->bindValue(":nacionalidade",$nacionalidade);
        $sql->bindValue(":idade",$idade);
        $sql->bindValue(":endereco",$endereco);
        $sql->bindValue(":estado",$estado);
        $sql->bindValue(":email",$email);
        $sql->bindValue(":objetivo",$objetivo);
        $sql->bindValue(":formacao1",$formacao1);
        $sql->bindValue(":formacao2",$formacao2);
        $sql->bindValue(":formacao3",$formacao3);
        $sql->bindValue(":tempo1",$tempo1);
        $sql->bindValue(":cargo1",$cargo1);
        $sql->bindValue(":tempo2",$tempo2);
        $sql->bindValue(":cargo2",$cargo2);
        $sql->bindValue(":tempo3",$tempo3);
        $sql->bindValue(":cargo3",$cargo3);
        $sql->bindValue(":quali1",$quali1);
        $sql->bindValue(":quali2",$quali2);
        $sql->bindValue(":quali3",$quali3);
        $sql->execute();


        if(count($fotos)>0){
          for($q=0;$q<count($fotos['tmp_name']);$q++){
            $tipo = $fotos['type'][$q];
            if(in_array($tipo,array('image/jpeg','image/png'))){
                $tmpname = md5(time().rand(0,999)).'.jpg';
                move_uploaded_file($fotos['tmp_name'][$q],'../assets/images/'.$tmpname);

                list($width_ori,$height_ori ) = getimagesize('../assets/images/'.$tmpname);
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
                    $origi = imagecreatefromjpeg('../assets/images/'.$tmpname);
                }elseif($tipo == 'image/png'){
                  $origi = imagecreatefrompng('../assets/images/'.$tmpname);
                }

                imagecopyresampled($img,$origi,0,0,0,0,$width,$height,$width_ori,$height_ori);

                imagejpeg($img,'../assets/images/'.$tmpname, 80);

                $sql = $pdo->prepare("INSERT INTO curriculo_imagens SET id_usuario = :id_usuario, url = :url");
                $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
                $sql->bindValue(":url",$tmpname);
                $sql->execute();




      }}}}

      public function getCurriculo(){
        global $pdo;
        $array = array();
        $sql = $pdo->prepare("SELECT *,
          (select curriculo_imagens.url from curriculo_imagens where curriculo_imagens.id_usuario = curriculo.id )as url
           FROM curriculo WHERE id_usuario = :id limit 1");
        $sql->bindValue(":id",$_SESSION['cLogin']);
        $sql->execute();

        if($sql->rowCount()>0){
            $array = $sql->fetchAll();

        }

        return $array;


      }

  }



?>
