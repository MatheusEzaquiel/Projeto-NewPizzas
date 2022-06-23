<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <title>New Pizza's | Pagamento</title>
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

    <section class="ftco-section">
      <div class="container">

      	<!--  TÍTULO E TEXTO DE APRESENTAÇÃO -->
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-6 heading-section ftco-animate text-center">
            <h2 class="mb-4">Pagamento</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
          </div>
        </div>
      </div>
        </div>
    <section>

        <!-- PREÇO TOTAL -->
        <h2 style="text-align:center; margin-top: 10px;"><?php echo "Total: ".base64_decode($_GET['tcr']);?></h2>

        <div style="margin-right: 890px; margin-bottom: 50px; " class="col-md-7 heading-section ftco-animate">
					<h3 style="padding-top: 100px; padding-left: 20px;" class="mb-4">Informações adicionais</h3>
	      </div>

        <form action="" method="post">
          <div style="margin-left: 40px;" class="form-group">
  	              <textarea cols="50" rows="5" class="form-control" placeholder="Ex: sem cebola, sem orégano..." name="infoAdd" id="infoAdd" ></textarea>
  	            </div>
                <div style="margin-left: 40px;" class="form-group">
  	              <textarea cols="30" rows="3" class="form-control" placeholder="Endereço: bairro /rua /nº da casa" name="endereco" required></textarea>
  	            </div>


                <div style="margin-right: 890px; margin-bottom: 50px; " class="col-md-7 heading-section ftco-animate">
  					<h3 style="padding-top: 100px; padding-left: 20px;" class="mb-4">Selecione o melhor para você</h3>
  	      </div>

          <div style="margin-left: 20px;" class="col-md-12" >
            <select class="form-select" aria-label="Default select example" name="OpcaoRetirada" required>
              <option value="Retirar no local">Retirar do local</option>
              <option value="entrega">Delivery (taxa de $6,00)</option>
            </select>
          </div>


          <div style="margin-right: 890px; margin-bottom: 50px; " class="col-md-7 heading-section ftco-animate">
					<h3 style="padding-top: 100px; padding-left: 20px;" class="mb-4">Selecione a forma de pagamento</h3>
          </div>

          <div style="margin-left: 20px;" class="col-md-12" >
            <select class="form-select" aria-label="Default select example" name="FormaPagamento" required>
              <option value="DINHEIRO">Dinheiro</option>
              <option value="CARTÃO">Cartão</option>
              <option value="PIX">Pix</option>
            </select>
          </div>

          <!-- BOTÃO EFETUAR PAGAMENTO -->
          <button type="submit" style="width: 300px; height: 70px; border-radius: 3px; margin-left:auto; margin-right:auto; margin-top: 100px; margin-left: 530px; background-color: #FAC564;"  name="btnFinalizar">Finalizar pedido</button>
        </form>




      <?php
        //CAPTURA AS INFORMAÇÕES DO PEDIDO E FAZ O CADASTRO
        include_once('config/conexao.php');
        if(isset($_POST['btnFinalizar'])){
              $inforPedido = $_POST['infoAdd'];
              $formaPgto = $_POST['FormaPagamento'];
              $retirada = $_POST['OpcaoRetirada'];
              $enderecoCliente = $_POST['endereco'];
              $totalC = base64_decode($_GET['tcr']);
              if ($retirada == 'entrega') {
                $totalC = $totalC + 6;
              }


              $cadastroPgto = "INSERT INTO tb_pagamento (informacaoAdicional,clientePagamento,totalPagamento,tipoPagamento,tipoEntrega,enderecoCliente) VALUES (:infAdd,:clientePgto,:totalPgto,:tipoPgto,:entrega,:enderecoCliente)";
              try{
                $resultPgto = $conect->prepare($cadastroPgto);
                $resultPgto->bindParam(':infAdd',$inforPedido,PDO::PARAM_STR);
                $resultPgto->bindParam(':clientePgto',$idCliente,PDO::PARAM_STR);
                $resultPgto->bindParam(':totalPgto',$totalC,PDO::PARAM_STR);
                $resultPgto->bindParam(':tipoPgto',$formaPgto,PDO::PARAM_STR);
                $resultPgto->bindParam(':entrega',$retirada,PDO::PARAM_STR);
                $resultPgto->bindParam(':enderecoCliente',$enderecoCliente,PDO::PARAM_STR);
                $resultPgto->execute();

                $contarPgto = $resultPgto->rowCount();
                if($contarPgto > 0){
                  echo  "<script>alert('Pagamento Efetuado!')</script>";



              /*ALTERA O ESTADO DO PEDIDO DE NÃO PAGO PARA PAGO */
                $pedidoPago = 1;
                $alteracaoPedidoPago = "UPDATE tb_carrinho SET estadoPedido=:pedidoPago WHERE identificadorCliente=:id";
                  $resultPedidoPago = $conect->prepare($alteracaoPedidoPago);
                  $resultPedidoPago->bindParam(':id',$idCliente,PDO::PARAM_STR);
                  $resultPedidoPago->bindParam( ':pedidoPago',$pedidoPago,PDO::PARAM_STR);
                  $resultPedidoPago->execute();
              /* FIM - ALTERA O ESTADO DO PEDIDO DE NÃO PAGO PARA PAGO*/
                  header("Refresh: 3, carrinho.php");

                }else{
                   echo  "<script>alert('[ERRO] O pagamento não foi efetuado!')</script>";
                }
              }catch(PDOException $erro){
                  echo "<strong>ERRO DE CADASTRO PDO = </strong>".$erro->getMessage();
              }


        }
      ?>

        </section>







          <!--COLUNA 3-->
          <div class="col-md-2 appointment ftco-animate"></div>
        </div>
      </div>
    </section>



    <footer style="margin-top: -50px;" class="ftco-footer ftco-section img">

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
