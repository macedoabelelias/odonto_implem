<?php 

require_once("../../../conexao.php");

$tabela = 'pagar';

@session_start();

$id_usuario = $_SESSION['id'];

$id = $_POST['id-baixar'];
$valor = $_POST['valor-baixar'];
$valor = str_replace(',', '.', $valor);
$saida = $_POST['saida-baixar'];
$data_baixar = $_POST['data-baixar'];

//verificar caixa aberto
$query1 = $pdo->query("SELECT * from caixas where operador = '$id_usuario' and data_fechamento is null order by id desc limit 1");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if(@count($res1) > 0){
	$id_caixa = @$res1[0]['id'];
}else{
	$id_caixa = 0;
}


$pdo->query("UPDATE $tabela SET pago = 'Sim', usuario_pgto = '$id_usuario', forma_pgto = '$saida', data_pgto = '$data_baixar', valor = '$valor', hora = curTime(), caixa = '$id_caixa', subtotal = '$valor' where id = '$id'");



echo 'Baixado com Sucesso';

 ?>