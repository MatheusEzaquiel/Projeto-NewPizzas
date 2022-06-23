<?php
ob_start();
session_start();
if(isset($_SESSION['login_admin'])  &&  (isset($_SESSION['senha_admin']))){
    header("Location: admin/perfil_admin.php");
};
?>

<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <title>New Pizza's | Log in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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
  </head>
  <body>
    
    <section class="ftco-section">
      <div class="container">

      	<!--  TÍTULO E TEXTO DE APRESENTAÇÃO -->
      	<div style="margin-bottom: 100px;"  class="row justify-content-center mb-5 pb-3">
          <div class="col-md-6 heading-section ftco-animate text-center">
            <h2 class="mb-4">Login do administrador</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
          </div>
        </div>
        	
        <div class="row">


        

          <!-- COLUNA DIREITA -->
          <div style="margin-left: 50px;" class="col-md-12 appointment ftco-animate">
          
            <form action="" method="post" class="appointment-form">

              <div  class="d-me-flex">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" name="email">
                </div>
              </div>
              
              <div style="margin-top: 30px;" class="d-me-flex">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Senha" name="senha">
                </div>
              </div>

              

              <div style="margin-top: 30px;" class="form-group">
                <input type="submit" value="Entrar" name="login" class="btn btn-primary py-3 px-4 btn-block">
              </div>


             

            </form>

            <?php
              include_once('config/conexao.php');
              if (isset($_POST['login'])){
                $login = filter_input(INPUT_POST, 'email' , FILTER_DEFAULT);
                $senha = base64_encode(filter_input(INPUT_POST, 'senha' , FILTER_DEFAULT));
                $select = "SELECT * FROM tb_admin WHERE emailAdmin=:emailLogin AND senhaAdmin=:senhaLogin";

                try{
                  $resultLogin = $conect->prepare($select);
                  $resultLogin->bindParam(':emailLogin',$login, PDO::PARAM_STR);
                  $resultLogin->bindParam(':senhaLogin',$senha, PDO::PARAM_STR);
                  $resultLogin->execute();

                  $verifcar=$resultLogin->rowCount();
                  if($verifcar>0){
                    $login=$_POST['email'];
                    $senha=$_POST['senha'];

                    $_SESSION['login_admin'] = $login;
                    $_SESSION['senha_admin'] = $senha;

                    echo '<div class="container" style="margin-top: 20px;">
                                <div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i> OK!</h5>
                                  Você será redirecionado(a)!
                                </div>
                              </div>';
                    header("Refresh: 3, admin/perfil_admin.php?acao=bemvindo");
                  }else{

                     echo '<div class="container" style="margin-top: 20px;">
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> Ops!</h5>
                      [Erro] Tente novamente!
                    </div>
                  </div>';
                    
                  }

                }catch(PDOException $e){
                  echo "ERRO DE LOGIN DO PDO : ".$e->getMessage(); 
                }

              }
            ?>

		
		

    
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>