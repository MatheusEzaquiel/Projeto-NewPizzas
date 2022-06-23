<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <title>Admin | Editar Perfil</title>
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
            <h2 class="mb-4">Editar Informações</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
          </div>
        </div>

      <?php

              include_once('../config/conexao.php');
              $selectAdm = "SELECT * FROM tb_admin WHERE idAdmin=1";
              try{
                $resultSelAdm = $conect->prepare($selectAdm);
                $resultSelAdm->execute();

                $contarSelect = $resultSelAdm->rowCount();
                if ($contarSelect > 0) {
                  while($show = $resultSelAdm->FETCH(PDO::FETCH_OBJ)){
                    $idAdm = $show->idAdmin;
                    $nomeAdm = $show->nomeAdmin;
                    $emailAdm = $show->emailAdmin;
                    $fotoAdm = $show->fotoAdmin;
                    $senhaAdm = base64_decode($show->senhaAdmin);

                  }

                }else{
                    echo "[NÃO EXISTE USUÁRIO COM ESTE ID] ";
                  }
              }catch(PDOException $erro){
                echo "ERRO DE SELECT [PDO] =".$erro->getMessage();
              }
            ?>


        <div class="row">

          <!-- COLUNA ESQUERDA -->
          <div class="col-md-4 appointment ftco-animate">

            <div class="col-lg-6 d-flex mb-sm-4 ftco-animate">
              <div class="staff">
                <div class="img mb-4" style="background-image: url(../img/admin/<?php echo $fotoAdm;?>);"></div>
                  <div class="info text-center">
                    <h3><?php echo $nomeAdm;?></h3>
                    <p><?php echo $emailAdm;?></p>
                    <p>Senha: <?php echo $senhaAdm;?></p>
                  </div>
              </div>
            </div>

          </div>




          <!-- COLUNA DIREITA -->
          <div class="col-md-8 appointment ftco-animate">

            <form action="" method="post" enctype="multipart/form-data" class="appointment-form">
              <div class="d-me-flex">
                <div class="form-group">
                  <input type="text" class="form-control" value="<?php echo $nomeAdm;?>" name="nome">
                </div>
              </div>

              <div class="d-me-flex">
                <div class="form-group">
                  <input type="text" class="form-control" value="<?php echo $emailAdm;?>" name="email">
                </div>
              </div>

              <div class="d-me-flex">
                <div class="form-group">
                  <input type="password" class="form-control" value="<?php echo $senhaAdm;?>" name="senha">
                </div>
              </div>

              <div class="d-me-flex">
                <div class="form-group">
                  <input type="file" name="foto">
                </div>
              </div>

              <div class="form-group">
                <input type="submit" value="Finalizar edição" name="btnUpdateAdm" class="btn btn-primary py-3 px-4 btn-block">
              </div>

	    			</form>

          </div>

      	   <?php
              if(isset($_POST['btnUpdateAdm'])){
                  $nomeNovo = $_POST['nome'];
                  $emailNovo = $_POST['email'];
                  $senhaNovo = base64_encode($_POST['senha']);

                  //UPDATE IMAGEM
                  if(!empty($_FILES['foto']['name'])){
                  $formatP = array("png","jpg","jpeg","JPG","gif");
                  $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                    if(in_array($extensao, $formatP)){
                        $pasta = "../img/admin/";
                        $temporario = $_FILES['foto']['tmp_name'];
                        $novoNome = uniqid().".$extensao";
                        if(move_uploaded_file($temporario, $pasta.$novoNome)){

                        }else{
                          echo "Erro, não foi possível fazer o upload do arquivo!";
                        }

                    }else{
                      echo "Formato de imagem Inválida";
                    }
                  }else{
                    $novoNome=$fotoAdm;
                  }

                  //UPDATE INFORMAÇÕES
                  $editarAdm = "UPDATE tb_admin SET nomeAdmin=:nome,emailAdmin=:email,senhaAdmin=:senha,fotoAdmin=:foto WHERE idAdmin=1";

                  try{
                    $result = $conect->prepare($editarAdm);
                    $result->bindParam(':nome',$nomeNovo,PDO::PARAM_STR);
                    $result->bindParam(':email',$emailNovo,PDO::PARAM_STR);
                    $result->bindParam(':senha',$senhaNovo,PDO::PARAM_STR);
                    $result->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                    $result->execute();

                    $contar = $result->rowCount();
                    if($contar > 0){
                      echo '<div class="container">
                                <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> OK!</h5>
                                Edição finalizada!!!
                              </div>
                            </div>';
                      //header("Refresh: 0, perfil_admin.php");
                      header("Refresh: 0, ?sair");


                    }else{
                      echo '<div class="container">
                                <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Ops!</h5>
                                Edição incorreta!!!
                              </div>
                            </div>';

                    }
                  }catch(PDOException $erro){
                    echo "<strong>ERRO DE CADASTRO PDO = </strong>".$erro->getMessage();
                  }
                }
              ?>




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
