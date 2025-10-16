<?php 
require_once("../../../conexao.php");
$tabela = 'pagar';
@session_start();
$id_usuario = $_SESSION['id'];

$dataInicial = @$_POST['data_inicial'];
$dataFinal = @$_POST['data_final'];
$funcionario = @$_POST['id_funcionario'];
$saida = @$_POST['pgto'];
if ($funcionario == '') {
    $funcionario = 0;
}

//verificar caixa aberto
$query1 = $pdo->query("SELECT * from caixas where operador = '$id_usuario' and data_fechamento is null order by id desc limit 1");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if(@count($res1) > 0){
	$id_caixa = @$res1[0]['id'];
}else{
	$id_caixa = 0;
}

$pdo->query("UPDATE pagar SET pago = 'Sim', usuario_pgto = '$id_usuario', data_pgto = curDate(), hora = curTime(), caixa = '$id_caixa', forma_pgto = '$saida' where data_lanc >= '$dataInicial' and data_lanc <= '$dataFinal' and pago != 'Sim' and funcionario = '$funcionario' and referencia like '%Comissao%'");
echo 'Baixado com Sucesso';
 ?>