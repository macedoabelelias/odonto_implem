<?php 
$tabela = 'usuarios';
require_once("../../../conexao.php");

if($modo_teste == 'Sim'){
	echo 'Em modo de teste esse recurso fica desabilitado!';
	exit();
}

$id = $_POST['id'];
$acao = $_POST['acao'];

$pdo->query("UPDATE $tabela SET ativo = '$acao' WHERE id = '$id' ");
echo 'Alterado com Sucesso';
?>