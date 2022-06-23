<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <title>New Pizza's | Informações do Cliente</title>
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
  <header>
    	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  	    <div class="container">
  		      <a class="navbar-brand" href="index.html"><span class="flaticon-pizza-1 mr-1"></span>New<br><small>Pizza's</small></a>
  		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
  		        <span class="oi oi-menu"></span> Menu
  		      </button>
  	      <div class="collapse navbar-collapse" id="ftco-nav">
  	        <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="cardapio_visitante.php" class="nav-link">Cardápio</a></li>
              <li class="nav-item"><a href="cadastro_cliente.php" class="nav-link">Cadastre-se</a></li>
              <li class="nav-item"><a href="login_admin.php" class="nav-link">Administrador</a></li>
              <li class="nav-item"><a href="log.php" class="nav-link">Log-in</a></li>
             
              
            </ul>
  	      </div>
  		  </div>
  	  </nav>
      <!-- END nav -->
    </header>
    <section class="ftco-section">
      <div class="container">

      	<!--  TÍTULO E TEXTO DE APRESENTAÇÃO -->
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 heading-section ftco-animate text-center">
            <h2 class="mb-4">Informações do Cliente</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
          </div>
        </div>  

        <div class="row">

        	<!-- COLUNA 1 -->
        	<div class="col-md-2 appointment ftco-animate"></div>

        	<!-- COLUNA 2 -->
        	<div class="col-md-8 appointment ftco-animate" style="padding:0px; margin-top: -100px;" >
	    			<form action="" method="post" enctype="multipart/form-data" class="appointment-form">
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="text" class="form-control" placeholder="Nome" name="nome" required>
                  <!--required é um recurso JS que faz uma validação para que o usuário preeencha os campos-->  
		    				</div>
	    				</div>

              <div class="d-md-flex">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="E-mail" name="email" required>
                  <!--required é um recurso JS que faz uma validação para que o usuário preeencha os campos-->  
                </div>
              </div>


	    				<div class="d-me-flex">
	    					<div class="form-group">
		    					<input type="text" class="form-control" placeholder="Telefone" name="telefone" required> 
		    				</div>
	    				</div>

	    				<div class="d-me-flex">
	    					<div class="form-group">
		    					<input type="text" class="form-control" placeholder="Endereço bairro/rua/nº da casa" name="endereco" required>
		    				</div>
	    				</div>

              <div class="d-me-flex">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Senha" name="senha" required>
                </div>
              </div>

              

              <button type="submit" class="btn btn-primary btn-lg btn-block" name="btn_prosseguir">Prosseguir</button>
       
             
	    			</form>

              <?php
                  include_once('config/conexao.php');
                  if(isset($_POST['btn_prosseguir'])){
                    $nomeCliente = $_POST['nome'];
                    $emailCliente = $_POST['email'];
                    $telefoneCliente = $_POST['telefone'];
                    $enderecoCliente = $_POST['endereco'];
                    $senhaCliente = base64_encode($_POST['senha']);

                    $cadastroCliente = "INSERT INTO tb_cliente (nomeCliente,emailCliente,enderecoCliente,telefoneCliente,senhaCliente) VALUES (:nome,:email,:endereco,:telefone,:senha)";
                    try{
                      $result = $conect->prepare($cadastroCliente);
                      $result->bindParam(':nome',$nomeCliente,PDO::PARAM_STR);
                      $result->bindParam(':email',$emailCliente,PDO::PARAM_STR);
                      $result->bindParam(':endereco',$enderecoCliente,PDO::PARAM_STR);          
                      $result->bindParam(':telefone',$telefoneCliente,PDO::PARAM_STR);
                      $result->bindParam(':senha',$senhaCliente,PDO::PARAM_STR);
                      $result->execute();

                      $contar = $result->rowCount();
                      if($contar > 0){
                        echo '<div class="container" style="margin-top: 20px;">
                                <div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i> OK!</h5>
                                  Dados inseridos!
                                </div>
                              </div>';

                        }else{
                          echo '<div class="container" style="margin-top: 20px;">
                                  <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Ops!</h5>
                                    [Erro] Tente novamente!
                                  </div>
                                </div>';
                        }
                    }catch(PDOException $erro){
                        echo "<strong>ERRO DE CADASTRO PDO = </strong>".$erro->getMessage();
                    }

                  }
              ?>  
	    		</div>

	    		<!-- COLUNA 3 -->
	    		<div class="col-md-2 appointment ftco-animate"></div>

      	</div>
      </div>

    </section>


		
		

   <footer class="ftco-footer ftco-section img">
      
        <div class="row">
          <div class="col-md-12 text-center">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados ao restaurante<a href="https://colorlib.com" target="_blank"> New Pizza's</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

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