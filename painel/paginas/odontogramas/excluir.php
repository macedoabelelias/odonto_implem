<?php 
$tabela = 'odontograma';
require_once("../../../conexao.php");

$id = $_POST['id'];

$pdo->query("DELETE FROM itens_odo WHERE odontograma = '$id' ");
$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
echo 'Excluído com Sucesso';
?>