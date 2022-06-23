<?php
ob_start();
session_start();
if(!isset($_SESSION['login_cliente'])  &&  (!isset($_SESSION['senha_cliente']))){
  header("Location: log.php?acao=negado");
  exit;
}
include_once('sair.php');
?>

<?php

include_once('config/conexao.php');
  $ClienteLogado = $_SESSION['login_cliente']; //captura email do cliente que está logado na seção atual
  $senhaClienteLogado = base64_encode($_SESSION['senha_cliente']);//captura senha do cliente que está logado na seção atual.
  //se no BD a senha está criptografada, aqui também deve estar

  $selectCliente = "SELECT * FROM tb_cliente WHERE emailCliente=:emailClienteLogado AND senhaCliente=:senhaClienteLogado";

  try{
    $resultadoCliente = $conect->prepare($selectCliente);
    $resultadoCliente->bindParam(':emailClienteLogado',$ClienteLogado,PDO::PARAM_STR);
    $resultadoCliente->bindParam(':senhaClienteLogado',$senhaClienteLogado,PDO::PARAM_STR);
    $resultadoCliente->execute();

    $contar = $resultadoCliente->rowCount();
    if ($contar > 0) {
      while($show = $resultadoCliente->FETCH(PDO::FETCH_OBJ)){
        $idCliente = $show->idCliente;
        $nomeCliente = $show->nomeCliente;
        $emailCliente = $show->emailCliente;
        $enderecoCliente = $show->enderecoCliente;
        $telefoneCliente = $show->telefoneCliente;
        $senhaCliente = base64_decode($show->senhaCliente);

      }
    }else{
      echo "<strong>Não há dados deste cliente</strong>";
    }

  }catch(PDOException $erro){
    echo "ERRO DE SELECT [PDO] = ".$erro->getMessage();
  }


?>

<link rel="stylesheet" href="css/carrinho.css">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
<link rel="stylesheet" href="css/animate.css">

<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="css/magnific-popup.css">

<link rel="stylesheet" href="css/aos.css">

<link rel="stylesheet" href="css/ionicons.min.css">

<link rel="stylesheet" href="css/bootstrap-datepicker.css">
<link rel="stylesheet" href="css/jquery.timepicker.css">


<link rel="stylesheet" href="css/flaticon.css">
<link rel="stylesheet" href="css/icomoon.css">
<link rel="stylesheet" href="css/style.css">

<header>
  <nav  class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html"><span class="flaticon-pizza-1 mr-1"></span>New<br><small>Pizza's</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="pizzas.php" class="nav-link">Pizzas</a></li>
          <li class="nav-item"><a href="bebidas_sobremesas.php" class="nav-link">Bebidas e sobremesas</a></li>

          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Sua conta
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">

                  <li>  <a class="dropdown-item" href="perfil_cliente.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  </svg>  Usuário</a></li>
                  <li><a class="dropdown-item" href="carrinho.php"><svg xmlns="http://www.w3.org/2000/svg"  width="20" height="20" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                  </svg>  Carrinho</a></li>

                  <li>  <a class="dropdown-item" href="?sair"> Sair da conta</a></li>

                </ul>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
</header>
