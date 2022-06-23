<?php
include_once('../config/conexao.php');
if(isset($_GET['idDel'])){
	$id = $_GET['idDel'];
	$delete = "DELETE FROM tb_produto WHERE idProduto=:id";

	try{

		$result = $conect->prepare($delete);
		$result->bindValue(':id',$id,PDO::PARAM_INT);
		$result->execute();

		//Retorno dinâmico a página de relatório
		$contar = $result->rowCount();
		if($contar>0){
			header("Location: relatorio_produto.php");
		}else{
			header("Location: relatorio_produto.php");
		}
	}catch(PDOException $erro){
        echo "<strong>ERRO DE DELETE: </strong>".$erro->getMessage();
    }
}
