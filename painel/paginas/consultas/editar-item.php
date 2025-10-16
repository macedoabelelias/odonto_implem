<?php 
$tabela = 'itens_odo';
require_once("../../../conexao.php");

$id = $_POST['id'];
$descricao = $_POST['descricao'];
$obs = $_POST['obs'];
$acao = @$_POST['acao'];

if($acao == ""){
	$sql_acao = " ";
}else{
	$sql_acao = " , acao = '$acao' ";
}

$pdo->query("UPDATE $tabela SET descricao = '$descricao', obs = '$obs' $sql_acao WHERE id = '$id' ");
echo 'Editado com Sucesso';

?>