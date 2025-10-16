<?php 
$tabela = 'itens_orc';
require_once("../../../conexao.php");

@session_start();
$id_usuario = $_SESSION['id'];

$id_produto = $_POST['id_produto'];
$id_orc = $_POST['id'];
$descricao = $_POST['descricao'];

if($id_orc == ""){
	$id_orc = 0;
}

$query = $pdo->query("SELECT * from procedimentos where id = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor = $res[0]['valor'];

if($valor <= 0){
	echo 'O valor do produto tem que ser maior que zero';
	exit();
}


$total = $valor;

$pdo->query("INSERT INTO $tabela SET produto = '$id_produto', valor = '$valor', quantidade = '1', total = '$total', id_orcamento = '$id_orc', funcionario = '$id_usuario', descricao = '$descricao'");

echo 'Inserido com Sucesso';




?>