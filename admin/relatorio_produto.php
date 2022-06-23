  <!DOCTYPE html>
<html lang="pt_br">
  <head>
    <title>Admin | Relatório de produtos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <style>
      .containerBtn{
        display: flex;
      }
    </style>

  </head>
  <body>
  <?php
    include_once('header_produtos.php');
  ?>


      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped tabela">
          <thead>
          <tr>
            <th>Foto</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Tamanho</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
          </thead>
          <tbody>
          <?php
            include_once('../config/conexao.php');
              $select = "SELECT * FROM tb_produto ORDER BY idProduto DESC";
              try{
                $resultado = $conect->prepare($select);
                $resultado->execute();
                $contar = $resultado->rowCount();
                if($contar > 0){
                  while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
            ?>
          <tr>
            <td style="text-align: center">
              <img style="width:55px; border-radius:100%" src="../img/produtos/<?php echo $show->fotoProduto;?>">
            </td>
             <td style="vertical-align:middle;"><?php echo $show->tipoProduto;?></td>
            <td style="vertical-align:middle;"><?php echo $show->nomeProduto;?></td>
            <td style="vertical-align:middle;"><?php echo $show->tamanhoProduto;?></td>
            <td style="vertical-align:middle;"><?php echo $show->descricaoProduto;?></td>
            <td style="vertical-align:middle;"><?php echo $show->precoProduto;?></td>
            <td class="containerBtn" style="vertical-align:middle; text-align:center">
              <a href="editar_produto.php?idUp=<?php echo $show->idProduto;?>" class="btn btn-success" title="Editar" id="btnEditar" name="btnEditar"><img style="width: 16px" src="../images/svg/editar.png"></a>
              <a href="deletar.php?idDel=<?php echo $show->idProduto;?>" class="btn btn-danger" title="Remover" onclick="return confirm('Deseja remover o produto <?php echo $show->nomeProduto;?>?')"><img style="width: 14px" src="../images/svg/remover.png"></a>
            </td>
          </tr>
          <?php
              }
            }else{
              echo '<div class="container">
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Ops!</h5>
                        Não há contatos cadastrados !!!
                      </div>
                    </div>';
            }
          }catch(PDOException $erro){
            echo '<strong>ERRO DE PDO= </strong>'.$erro->getMessage();
          }
            ?>


          </tbody>
          <tfoot>
          <tr>
            <th>Foto</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Tamanho</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
          </tfoot>
        </table>
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
