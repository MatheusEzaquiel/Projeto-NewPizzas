<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <title>Admin | Cadastro produtos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">

    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/ionicons.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../css/jquery.timepicker.css">


    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
  	<?php
      include_once('header_produtos.php');
    ?>

    <section class="ftco-section">
      <div class="container">

      	<!--  TÍTULO E TEXTO DE APRESENTAÇÃO -->
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-6 heading-section ftco-animate text-center">
            <h2 class="mb-4">Cadastro de produtos</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
          </div>

        </div>


        <div class="row">

        	<!-- FORMULÁRIO -->
        	<!-- COLUNA 1 -->
        	<div class="col-md-2 appointment ftco-animate"></div>
        	<!-- COLUNA 2 -->
        	<div class="col-md-8 appointment ftco-animate">
	    			<h3 style="text-align:center">Cadastro de Produto</h3>

	    			<form action="" method="post" enctype="multipart/form-data" class="appointment-form">
              <div class="d-md-flex">
                <div class="form-group">
                  <label>Tipo do produto</label>
                  <select id="tipoDoProduto" name="tipoDoProduto">
                    <option value="PIZZA" >Pizza</option>
                    <option value="BORDA">Borda p/ pizza </option>
                    <option value="BEBIDA">Bebida</option>
                    <option value="SOBREMESA">Sobremesa </option>
                  </select>
                </div>
              </div>
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="text" class="form-control" placeholder="Nome / Sabor da pizza" name="nomeProduto">
		    				</div>
	    				</div>
	    				<div class="d-me-flex">
	    					<div class="form-group">
		    					<input type="text" class="form-control" placeholder="P | M | G | 1g  | 1mL" name="tamanhoProduto">
		    				</div>
	    				</div>
              <div class="d-me-flex">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Descrição" name="descricaoProduto">
                </div>
              </div>
              <div class="d-me-flex">
                <div class="form-group">
                  <input type="text" class="form-control"  placeholder="Preço 0,00" name="precoProduto">
                </div>
              </div>
              <div class="d-me-flex">
                <div class="form-group">
                  <input type="file" name="fotoProduto">
                </div>
              </div>

	            <div class="form-group">
	              <input style="margin-left:420px;" type="submit" value="Cadastrar produto" name="btnCadastroProduto" class="btn btn-primary py-3 px-4">
	            </div>

	    			</form>

              <?php
                include_once('../config/conexao.php');
                  if(isset($_POST['btnCadastroProduto'])){
                      $tipoProduto = $_POST['tipoDoProduto'];
                      $nomeProduto = $_POST['nomeProduto'];
                      $tamanhoProduto = $_POST['tamanhoProduto']; //strtoupper() função p/ maiúsculo
                      $descricaoProduto = $_POST['descricaoProduto'];
                      $precoProduto = $_POST['precoProduto'];
                      $formatP = array("png","jpg","jpeg","JPG","gif");
                      $extensao = pathinfo($_FILES['fotoProduto']['name'], PATHINFO_EXTENSION);

                      if(in_array($extensao, $formatP)){
                          $pasta = "../img/produtos/";
                          $temporario = $_FILES['fotoProduto']['tmp_name'];
                          $novoNome = uniqid().".$extensao";

                          if(move_uploaded_file($temporario, $pasta.$novoNome)){
                              $cadastroProduto = "INSERT INTO tb_produto (tipoProduto, nomeProduto, tamanhoProduto, descricaoProduto, precoProduto, fotoProduto) VALUES (:tipo, :nome, :tamanho, :descricao, :preco, :foto)";
                      try{
                        $result = $conect->prepare($cadastroProduto);
                        $result->bindParam(':tipo',$tipoProduto,PDO::PARAM_STR);
                        $result->bindParam(':nome',$nomeProduto,PDO::PARAM_STR);
                        $result->bindParam(':tamanho',$tamanhoProduto,PDO::PARAM_STR);
                        $result->bindParam(':descricao',$descricaoProduto,PDO::PARAM_STR);
                        $result->bindParam(':preco',$precoProduto,PDO::PARAM_STR);
                        $result->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                        $result->execute();

                        $contar = $result->rowCount();
                        if($contar > 0){
                          echo '<div class="container">
                                    <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                                    Produto cadastrado com sucesso!
                                  </div>
                                </div>';
                        }else{
                          echo '<div class="container">
                                    <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Ops!</h5>
                                    cadastrado não efetuado!
                                  </div>
                                </div>';
                        }
                      }catch(PDOException $erro){
                        echo "<strong>ERRO DE CADASTRO PDO = </strong>".$erro->getMessage();
                      }
                          }else{
                            echo "Erro, não foi possível fazer o upload do arquivo!";
                          }

                      }else{
                        echo "Formato Inválido";
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


  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/jquery.animateNumber.min.js"></script>
  <script src="../js/bootstrap-datepicker.js"></script>
  <script src="../js/jquery.timepicker.min.js"></script>
  <script src="../js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../js/google-map.js"></script>
  <script src="../js/main.js"></script>

  </body>
</html>
