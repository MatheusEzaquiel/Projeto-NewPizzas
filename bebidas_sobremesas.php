<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <title>New Pizza's | Cardápio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

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
	  <?php
      include_once('includes/header.php');
    ?>

	  <!-- SECTION 1 - CARROSSEL  -->
    <section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Cardápio</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 2 -->
		<section class="ftco-section">
				<!-- FAIXA DE SEPARAÇÃO ANTES DO CARDÁPIO -->
	    	<div class="container">
	    		<div class="row justify-content-center mb-5 pb-3">
	          <div class="col-md-7 heading-section ftco-animate text-center">
	            <h2 class="mb-4">Menu</h2>
	            <p style="font-size: 20px;">Faça a melhor escolha para você e sua familia</p>
	          </div>
	        </div>
	    	</div>
	    	<!-- FIM - FAIXA DE SEPARAÇÃO ANTES DO CARDÁPIO -->


	    <form action="" method="post">

				<div style="margin-right: 890px; " class="col-md-7 heading-section ftco-animate">
					<h2 style="padding-top: 100px; padding-left: 20px;" class="mb-4">Bebidas</h2>
				</div>

				<!-- BLOCO DAS BEBIDAS -->
				<div class="container-wrap">
					<div class="row no-gutters d-flex">
						<?php
		    			$selectBebida = "SELECT * FROM tb_produto WHERE `tipoProduto` = 'bebida'";
		    			try{
		    				$resultadoBebida = $conect->prepare($selectBebida);
		    				$resultadoBebida->execute();
		    				$contarBeb = $resultadoBebida->rowCount();
		    				if($contarBeb > 0){
		    					while($show = $resultadoBebida->FETCH(PDO::FETCH_OBJ)){

										$idProdBebida = $show->idProduto;
										$tipoProdBebida = $show->tipoProduto;
										$nomeProdBebida = $show->nomeProduto;
										$tamanhoProdBebida = $show->tamanhoProduto;
										$descricaoProdBebida = $show->descricaoProduto;
										$precoProdBebida =  $show->precoProduto;//TESTE DE ERRO
										$fotoProdBebida = $show->fotoProduto;

	          ?>
						<div class="col-lg-4 d-flex ftco-animate">
							<div class="services-wrap d-flex">
								<a href="#" class="img" style="background-image: url(img/produtos/<?php echo $fotoProdBebida;?>);"></a>
								<div class="text p-4">
									<h3><?php echo $nomeProdBebida;?></h3>
									<p><?php echo $descricaoProdBebida;?></p>
									<p class="price"><span><?php echo $precoProdBebida;?></span></p> <div class="form-check">
								  <!--<input class="form-check-input" type="checkbox" value="<?php echo $idProdBebida;?>" id="bebida" name="bebida">-->
								  <input type="number" name="quantidadeProduto<?php echo $idProdBebida;?>" id="quantidadeProduto" style="width:60px;">
									 <input  style="background-color: #FAC564;" type="submit" value="adicionar" name="btnEscolherProduto<?php echo $idProdBebida;?>">
								</div>
								</div>
							</div>
						</div>
						<?php

										if(isset($_POST["btnEscolherProduto$idProdBebida"])){
											$produto = $idProdBebida;
											$nomeProduto = $nomeProdBebida;
											$precoProduto = $precoProdBebida;
											$qtdProduto = $_POST["quantidadeProduto$idProdBebida"];
											$precoPed = $precoProdBebida*$qtdProduto;
                      $saborBorda = 'produto sem borda';
                      $precoBorda = '0.00';

											$cadastroProduto = "INSERT INTO tb_carrinho (identificadorCliente,identificadorProduto,nomeProduto,tamanhoPizza, bordaPizza,precoBorda,quantidadeProduto,precoProduto,precoPedido,fotoProduto) VALUES(:idCliente,:idProduto,:nomeProd,:tamanhoProduto,:saborBorda,:precoBorda,:qtdProduto,:precoIndividualProduto,:precoPedido,:fotoP)";

											try{
												$resultProduto = $conect->prepare($cadastroProduto);
												$resultProduto->bindParam(':idCliente',$idCliente,PDO::PARAM_STR);//APENAS 1
												$resultProduto->bindParam(':idProduto',$produto,PDO::PARAM_STR);//TODOS
												$resultProduto->bindParam(':nomeProd',$nomeProduto,PDO::PARAM_STR);//TODOS
												$resultProduto->bindParam(':tamanhoProduto',$tamanhoProdBebida,PDO::PARAM_STR);
                        $resultProduto->bindParam(':saborBorda',$saborBorda,PDO::PARAM_STR);
                        $resultProduto->bindParam(':precoBorda',$precoBorda,PDO::PARAM_STR);
												$resultProduto->bindParam(':qtdProduto',$qtdProduto,PDO::PARAM_STR);//TODOS
												$resultProduto->bindParam(':precoIndividualProduto',$precoProduto,PDO::PARAM_STR);//TODOS
												$resultProduto->bindParam(':precoPedido',$precoPed,PDO::PARAM_STR);//TODOS
												$resultProduto->bindParam(':fotoP',$fotoProdBebida,PDO::PARAM_STR);
												$resultProduto->execute();

		  									$contarProduto = $resultProduto->rowCount();
												if($contarProduto > 0){
													echo "<script>alert('Produto enviado para o carrinho')</script>";
												}else{
													echo "<script>alert('[Erro] Tente novamente!')</script>";
												}

											}catch(PDOException	$erro){
												echo "ERRO DE CADASTRO [PDO] = ".$erro->getMessage();
											}


										}//FIM IF BOTÃO ESCOLHER PRODUTO

				    			}// FIM - WHILE
					    	}else{
					    		echo '<div class="container">
					    		<div class="alert alert-danger alert-dismissible">
					    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					    		<h5><i class="icon fas fa-check"></i> Ops!</h5>
					    		Não há produtos cadastrados !!!
					    		</div>
					    		</div>';
					    	}

					    }catch(PDOException $erro){
					    	echo '<strong>ERRO DE PDO= </strong>'.$erro->getMessage();
					    }
			    	?>


					</div>
				</div>
				<!-- FIM - BLOCO DAS BEBIDAS -->




				<!-- BLOCO DAS SOBREMESAS - TÍTULO -->
				<div style="margin-right: 890px; " class="col-md-7 heading-section ftco-animate">
				<h2 style="padding-top: 100px; padding-left: 20px;" class="mb-4">Sobremesas</h2>

				</div>

				<!-- BLOCO DAS SOBREMESAS -->

					<div class="container-wrap">
						<div class="row no-gutters d-flex">
							<?php
			    			$select = "SELECT * FROM tb_produto WHERE `tipoProduto` = 'sobremesa'";
			    			try{
			    				$resultado = $conect->prepare($select);
			    				$resultado->execute();
			    				$contar = $resultado->rowCount();
			    				if($contar > 0){
			    					while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
											$idProdSobremesa = $show->idProduto;
											$tipoProdSobremesa = $show->tipoProduto;
											$precoProduto = $show->precoProduto;
											$nomeProdSobremesa = $show->nomeProduto;
											$tamanhoProdSobremesa = $show->tamanhoProduto;
											$descricaoProdSobremesa = $show->descricaoProduto;
											$precoProdSobremesa = $show->precoProduto;
											$fotoProdSobremesa = $show->fotoProduto;
		          ?>

							<div class="col-lg-4 d-flex ftco-animate">
								<div class="services-wrap d-flex">
									<a href="#" class="img" style="background-image: url(img/produtos/<?php echo $fotoProdSobremesa;?>);"></a>
									<div class="text p-4">
										<h3><?php echo $nomeProdSobremesa;?></h3>
										<p><?php echo $descricaoProdSobremesa;?></p>
										<p class="price"><span>R$<?php echo $precoProdSobremesa;?></span></p> <div class="form-check">
										<input type="number" name="quantidadeProduto<?php echo $idProdSobremesa;?>" id="quantidadeProduto" style="width:60px;">
									  <input  style="background-color: #FAC564;" type="submit" value="adicionar" name="btnEscolherProduto<?php echo $idProdSobremesa;?>">
									</div>
									</div>
								</div>
							</div>

							<?php

											if(isset($_POST["btnEscolherProduto$idProdSobremesa"])){
													$produto = $idProdSobremesa;
													$nomeProduto = $nomeProdSobremesa;
													$precoProduto = $precoProdSobremesa;
												  //$tamanhoProdSobremesa
													$qtdProduto = $_POST["quantidadeProduto$idProdSobremesa"];
													$precoPed = $precoProdSobremesa*$qtdProduto;
													//$fotoProdSobremesa;
                          $saborBorda = 'produto sem borda';
                          $precoBorda = '0.00';


													$cadastroProduto = "INSERT INTO tb_carrinho (identificadorCliente,identificadorProduto,nomeProduto,tamanhoPizza, bordaPizza,precoBorda,quantidadeProduto,precoProduto,precoPedido,fotoProduto) VALUES(:idCliente,:idProduto,:nomeProd,:tamanhoProduto,:saborBorda,:precoBorda,:qtdProduto,:precoIndividualProduto,:precoPedido,:fotoP)";

													try{
														$resultProduto = $conect->prepare($cadastroProduto);
														$resultProduto->bindParam(':idCliente',$idCliente,PDO::PARAM_STR);
														$resultProduto->bindParam(':idProduto',$produto,PDO::PARAM_STR);
														$resultProduto->bindParam(':nomeProd',$nomeProduto,PDO::PARAM_STR);
														$resultProduto->bindParam(':tamanhoProduto',$tamanhoProdSobremesa,PDO::PARAM_STR);
                            $resultProduto->bindParam(':saborBorda',$saborBorda,PDO::PARAM_STR);
                            $resultProduto->bindParam(':precoBorda',$precoBorda,PDO::PARAM_STR);
														$resultProduto->bindParam(':qtdProduto',$qtdProduto,PDO::PARAM_STR);
														$resultProduto->bindParam(':precoIndividualProduto',$precoProduto,PDO::PARAM_STR);
														$resultProduto->bindParam(':precoPedido',$precoPed,PDO::PARAM_STR);
														$resultProduto->bindParam(':fotoP',$fotoProdSobremesa,PDO::PARAM_STR);
														$resultProduto->execute();

				  									$contarProduto = $resultProduto->rowCount();
														if($contarProduto > 0){
															echo "<script>alert('Produto enviado para o carrinho')</script>";


														}else{
															echo "<script>alert('[Erro] Tente novamente!')</script>";
														}


													}catch(PDOException	$erro){
														echo "ERRO DE CADASTRO [PDO] = ".$erro->getMessage();
													}


											}//FIM IF BOTÃO ESCOLHER PRODUTO

					    			}//FIM WHILE

						    	}else{
						    		echo '<div class="container">
						    		<div class="alert alert-danger alert-dismissible">
						    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						    		<h5><i class="icon fas fa-check"></i> Ops!</h5>precoProd
						    		Não há produtos cadastrados !!!
						    		</div>
						    		</div>';
						    	}//FIM IF ELSE

						    }catch(PDOException $erro){
						    	echo '<strong>ERRO DE PDO= </strong>'.$erro->getMessage();
						    }
				    	?>


						</div>
					</div>



				<!-- FIM - BLOCO DAS SOBREMESAS -->







				<!-- BOTÃO DE CONTINUAR PEDIDO -->

			</form>
    </section>


    <!--RODAPÉ-->
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
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
