<?php require_once 'connect.php'; ?>
<html>
<head>
    
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
      
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <meta charset="UTF-8">
      <link rel="stylesheet" href="../assets/css/style.css"/>
      <link rel="stylesheet" href="../assets/css/style2.css"/>
      <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script  type="text/javascript" src="assets/js/script.js"></script>

  <title>BUSCO EMPREGO</title>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6532628741070953",
    enable_page_level_ads: true
  });
</script>

</head>

<body>


  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  <div id="tudo">
    <nav class="navbar navbar-inverse">
            <img src="../assets/images/logo.png" width="40px"/>
          <div id="menu" class="container-fluid">
              <a href="index.php" class="navbar-brand">
              <img src="../assets/images/logo2.png" width="60px"/>
              <div class="navbar-header">

                <p>Busco Emprego</p></a>
              </div>
              <ul id="ul" class="nav navbar-nav navbar-right">
                <?php
                  require_once '../classes/usuarios.class.php';
                  $u = new Usuarios;
                ?>

                <?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])):  ?>

                  <li><a >Olá<?php echo" ".$_SESSION['username'];  ?></a></li>
                  <li><a href="meus-anuncios.php">Meus anúncios</a></li>
                  <li><a href="curriculo.php?id=<?php  echo $dado['id'];
          echo $dado['nome'];?>">Faça seu Curriculo</a></li>
                  <li><a href="sair.php">Sair</a></li>
                <?php else: ?>
                  <li><a href="cadastro.php">Cadastre-se</a></li>
                  <li><a href="login.php">Login</a></li>
                <?php endif;?>
              </ul>

          </div>
    </nav>
