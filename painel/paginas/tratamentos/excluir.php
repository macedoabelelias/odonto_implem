<?php 

$tabela = 'cargos';

require_once("../../../conexao.php");



$id = $_POST['id'];




$pdo->query("DELETE FROM tratamentos WHERE id = '$id' ");

$pdo->query("DELETE FROM agendamentos WHERE id_tratamento = '$id' and pago = 'Não' ");

$pdo->query("DELETE FROM horarios_agd WHERE id_tratamento = '$id' ");

echo 'Excluído com Sucesso';

?>