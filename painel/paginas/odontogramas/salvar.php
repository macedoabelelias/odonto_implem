<?php 
@session_start();
$id_usuario = $_SESSION['id'];

$tabela = 'odontograma';
require_once("../../../conexao.php");

$data_atual = date('Y-m-d');



$descricao = $_POST['descricao'];
$cliente = $_POST['cliente'];
$evolutivo = $_POST['evolutivo'];
$id = $_POST['id'];

if($id == ""){
	$id = 0;
}

if($evolutivo == 'Sim' and $id == 0){
	$query = $pdo->query("SELECT * from $tabela where paciente = '$cliente' and evolutivo = 'Sim' order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$linhas = @count($res);
	if($linhas > 0){
		echo 'Este paciente já tem um Odontograma evolutivo!';
		exit();
	}	
}



if($id == 0){
$pdo->query("INSERT INTO odontograma SET paciente = '$cliente', data = curDate(), descricao = '$descricao', evolutivo = '$evolutivo', funcionario = '$id_usuario'");
	$id_item = $pdo->lastInsertId();

	$pdo->query("UPDATE itens_odo SET odontograma = '$id_item' WHERE odontograma = 0 and funcionario = '$id_usuario'");

	echo 'Salvo com Sucesso-'.$id_item;
}else{
	
	$pdo->query("UPDATE odontograma SET paciente = '$cliente', descricao = '$descricao', evolutivo = '$evolutivo' WHERE id = '$id'");
	$id_item = $id;	
	
	echo 'Salvo com Sucesso-'.$id_item;
}





 ?>