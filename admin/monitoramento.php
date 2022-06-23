  <!DOCTYPE html>
<html lang="pt_br">
  <head>
    <?php
    include('header_produtos.php');
    ?>
    <title>Admin | Relatório pedidos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/carrinho.css">

    <link rel="stylesheet" type="text/css" href="../css/style1.css"> <!-- nav-bar-produtos -->

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
    <h1 style="text-align: center; margin-top: 40px;">MONITORAMENTO DE PEDIDOS</h1>

  <?php
    include_once('../config/conexao.php');
    $select = "SELECT * FROM tb_carrinho WHERE estadoPedido = 1 ORDER BY identificadorCliente";
    // 0 - não pago | 1 - pago
    try{
      $resultado = $conect->prepare($select);
      //$resultado->bindParam(':id',$idCliente,PDO::PARAM_STR);
      $resultado->execute();

      $contar = $resultado->rowCount();
      if($contar > 0){
        while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
            $idPedido = $show->idPedido;
            $idCliente = $show->identificadorCliente;
            $idProduto = $show->identificadorProduto;
            $nomeProduto = $show->nomeProduto;
            $tamanhoProduto = $show->tamanhoPizza;
            $bordaPizza = $show->bordaPizza;
            $precoBorda = $show->precoBorda;
            $qtdProduto = $show->quantidadeProduto;
            $precoProduto = $show->precoProduto;
            $total = $show->precoPedido;
            $fotoProduto = $show->fotoProduto;
  ?>


  <div class="pedido containerPedido">
    <div>
      <img src="../img/produtos/<?php echo $fotoProduto;?>" class="fotoProduto">
      <h2><?php echo $nomeProduto;?> R$<?php echo $precoProduto;?></h2>
      <p>Tamanho: <?php echo $tamanhoProduto;?></p>
      <p>borda: <?php echo $bordaPizza;?> | R$<?php echo $precoBorda;?></p>
    </div>

    <form action="" method="post">
      <div>
        <h2>Id do Cliente: <?php echo $idCliente?></h2>
        <h4>quantidade: <?php echo $qtdProduto;?></h4>
        <h4>Total do pedido: R$<?php echo $total;?></h4>
      </div>
    </form>

    <form action="" method="post">
      <div>
        <input type="submit" class="btnRemove" value="Fechar Pedido" onclick="return confirm('Deseja remover o produto <?php echo $show->nomeProduto;?>?')" name="btnRemover<?php echo $idPedido;?>"> <!--pega o id do pedido-->
      </div>
    </form>

  </div>

  <?php
    //REMOVER PEDIDO
    if(isset($_POST["btnRemover$idPedido"])){
            $esvaziarCarrinho = "DELETE FROM tb_carrinho WHERE identificadorCliente=:id AND idPedido=:idDoPedido";
              try{
                $resultEsvaziar = $conect->prepare($esvaziarCarrinho);
                $resultEsvaziar->bindParam(':id',$idCliente,PDO::PARAM_STR);//INSERE VALOR DA VARIÁVEL NO ÁLIAS :id
                $resultEsvaziar->bindParam(':idDoPedido',$idPedido,PDO::PARAM_STR);
                $resultEsvaziar->execute();

                $contarEsvaziamento = $resultEsvaziar->rowCount();
                if ($contarEsvaziamento > 0) {
                  header("Refresh: 0 monitoramento.php");

                }else{
                  echo "<script>window.alert('[ERRO] um pedido pago não foi excluído')</script>";
                }
              }catch(PDOException $erro){
                echo "ERRO DE PDO [DELETE]".$erro->getMessage();
              }
          }

          //REMOVER PEDIDO

      }
      }else{
        echo '<div class="carrinhoVazio"><h4>Nenhum pedido no momento</h4></div>';
      }
    }catch(PDOException $erro){
      echo '<strong>ERRO DE PDO= </strong>'.$erro->getMessage();
    }
  ?>

  <?php
    $selectSomaTotal = "SELECT SUM(precoPedido) AS total FROM tb_carrinho WHERE identificadorCliente=:id";
    try {
      $resultSelectSoma = $conect->prepare($selectSomaTotal);
      $resultSelectSoma->bindParam(':id',$idCliente,PDO::PARAM_STR);
      $resultSelectSoma->execute();

      $contarSelectSoma = $resultSelectSoma->rowCount();
      if ($contarSelectSoma>0) {
        while($show2 = $resultSelectSoma->FETCH(PDO::FETCH_OBJ)){
          $totalCarrinho = $show2->total;
        }

      }
    }catch (PDOException $erro) {
      echo "ERRO DE PDO [SELECT] = ".$erro->getMessage();
    }

  ?>


  </form>



    <footer style="margin-top: 70px; " class="ftco-footer ftco-section img">

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
