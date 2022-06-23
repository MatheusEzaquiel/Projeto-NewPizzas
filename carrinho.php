<?php //session_start();?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Carrinho</title>

</head>
<body>
	<?php
		include_once('includes/header.php');
		include_once('includes/stylesheets.php');
	?>

	<h1 style="text-align: center; margin-top: 40px;">Pedidos</h1>
	<?php
		include_once('config/conexao.php');
		$select = "SELECT * FROM tb_carrinho WHERE identificadorCliente=:id and  estadoPedido = 0";
		//$select = "SELECT * FROM tb_carrinho WHERE ORDER BY identificadorCliente";
		try{
			$resultado = $conect->prepare($select);
			$resultado->bindParam(':id',$idCliente,PDO::PARAM_STR);
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
				<img src="img/produtos/<?php echo $fotoProduto;?>" class="fotoProduto">
				<h2><?php echo $nomeProduto;?> R$<?php echo $precoProduto;?></h2>
				<p>Tamanho: <?php echo $tamanhoProduto;?></p>
				<p>borda: <?php echo $bordaPizza;?> | R$<?php echo $precoBorda;?></p>
			</div>

			<form action="" method="post">
				<div>
					<h3>quantidade: <?php echo $qtdProduto;?></h3>
					<h3>Total do pedido: R$<?php echo $total;?></h3>
				</div>
			</form>

			<form action="" method="post">
				<div>
					<input type="submit" class="btnRemove" value="remover" name="btnRemover<?php echo $idPedido;?>"> <!--pega o id do pedido-->
				</div>
			</form>

		</div>


		<?php
			//REMOVER PEDIDO DO CARRINHO
			if(isset($_POST["btnRemover$idPedido"])){

	            $esvaziarCarrinho = "DELETE FROM tb_carrinho WHERE identificadorCliente=:id AND idPedido=:idDoPedido";
		            try{
		              $resultEsvaziar = $conect->prepare($esvaziarCarrinho);
		              $resultEsvaziar->bindParam(':id',$idCliente,PDO::PARAM_STR);//INSERE VALOR DA VARIÁVEL NO ÁLIAS :id
		              $resultEsvaziar->bindParam(':idDoPedido',$idPedido,PDO::PARAM_STR);
		              $resultEsvaziar->execute();

		              $contarEsvaziamento = $resultEsvaziar->rowCount();
		              if ($contarEsvaziamento > 0) {
		              	header("Refresh: 0 carrinho.php");

		              }else{
		                echo "<script>window.alert('[ERRO] O produto não foi removido')</script>";
		              }
		            }catch(PDOException $erro){
		              echo "ERRO DE PDO [DELETE]".$erro->getMessage();
		            }
            }

            //FIM - REMOVER PEDIDO DO CARRINHO

			?>




	<?php


			}
    	}else{
    		echo '<div class="carrinhoVazio"><h4>Ops! Carrinho Vazio!!!</h4></div>';
    	}
    }catch(PDOException $erro){
    	echo '<strong>ERRO DE PDO= </strong>'.$erro->getMessage();
    }
	?>






	<?php
		$selectSomaTotal = "SELECT SUM(precoPedido) AS total FROM tb_carrinho WHERE identificadorCliente=:id AND estadoPedido = 0";
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
	<form action="" method="get">
		<!-- BOX COM O VALOR INTEIRO DO CARRINHO -->
		<div id="totalFinal">
			<p>Total do carrinho:	</p>
			<input style="width: 90%; margin-left: 50px;" disabled type="number" name="valorTotal" value="<?php echo $totalCarrinho;?>">
		</div>
	</form>


		<?php
			$tcr = base64_encode($totalCarrinho); //VALOR TOTAL DO CARRINHO
		?>


		<div style="display: flex;">

			<!-- BOTÃO PARA EFETUAR PAGAMENTO -->
				<a href="pagamento.php?tcr=<?php echo$tcr;?>"><button name="btnContinuarCompra" style="margin-bottom: 40px; margin-top: 40px; width: 300px; height: 70px; margin-left: 530px; background-color: #FAC564;">Pagamento</button>



		</div>



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



</body>
</html>


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
