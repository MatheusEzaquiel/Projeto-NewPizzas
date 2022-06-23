<?php
ob_start();
session_start();
if(!isset($_SESSION['login_admin'])  &&  (!isset($_SESSION['senha_admin']))){
  header("Location: ../login_admin.php?acao=negado");
  exit;
}
include_once('exit.php');
?>

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
    	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  	    <div class="container">
  		      <a class="navbar-brand" href="index.html"><span class="flaticon-pizza-1 mr-1"></span>New<br><small>Pizza's</small></a>
  		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
  		        <span class="oi oi-menu"></span> Menu
  		      </button>
  	      <div class="collapse navbar-collapse" id="ftco-nav">
  	        <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a href="relatorio_produto.php" class="nav-link">Lista de produtos</a></li>
              <li class="nav-item"><a href="cadastro_produto.php" class="nav-link">Adicionar produto</a></li>
              <li class="nav-item"><a href="perfil_admin.php" class="nav-link">ADM</a></li>
              <li class="nav-item"><a href="monitoramento.php" class="nav-link">Monitorar pedidos</a></li>
              <li class="nav-item"><a href="?sair" class="nav-link">Sair da conta</a></li>



            </ul>
  	      </div>
  		  </div>
  	  </nav>
      <!-- END nav -->
    </header>

