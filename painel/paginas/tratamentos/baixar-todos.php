<?php 

$tabela = 'receber';

require_once("../../../conexao.php");

$data_atual = date('Y-m-d');



@session_start();

$usuario_logado = @$_SESSION['id'];
$id_usuario = @$_SESSION['id'];


$cliente = $_POST['cliente_agd'];

$data_pgto = $_POST['data_pgto'];

$id_agd = @$_POST['id_tr'];

$ag_p = @$_POST['ag_p'];

$valor_serv = $_POST['valor_serv_agd'];

$vals = $_POST['vals'];

$valor_unit = $_POST['valor_unit'];

$descricao = $_POST['descricao_serv_agd'];

$funcionario = $_POST['funcionario_agd'];

$servico = $_POST['servico_agd'];

$pgto = $_POST['pgto'];


$vals = str_replace(',', '.', $vals);
$valor_serv = str_replace(',', '.', $valor_serv);
$valor_unitF = str_replace(',', '.', $valor_unit);

$convenio = $_POST['convenio'];
$numero_convenio = $_POST['numero_convenio'];





$query = $pdo->query("SELECT * FROM procedimentos where id = '$servico'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$valor = $res[0]['valor'];

$descricao = $res[0]['nome'];

$descricao2 = 'Comissão - '.$res[0]['nome'];

$nome_servico = $res[0]['nome'];



$query = $pdo->query("SELECT * FROM convenios where id = '$convenio'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_cv = @$res[0]['nome'];


$valor_pelo_cv = 0;
$query4 = $pdo->query("SELECT * FROM agendamentos where id_tratamento = '$id_agd'");

$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

$total_agd = count($res4);


$valor_pelo_cv = '';



//verificar caixa aberto
$query1 = $pdo->query("SELECT * from caixas where operador = '$id_usuario' and data_fechamento is null order by id desc limit 1");
$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
if(@count($res1) > 0){
	$id_caixa = @$res1[0]['id'];
}else{
	$id_caixa = 0;
}





/*

$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$comissao_func = $res[0]['comissao'];



$comissao = $comissao_sistema;

if($comissao_func > 0){

	$comissao = $comissao_func;

}





$valor_comissao = ($comissao * $vals) / 100;

*/





$query = $pdo->query("SELECT * FROM procedimentos where id = '$servico'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor = $res[0]['valor'];

$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$comissao_func = $res[0]['comissao'];



$comissao = 0;

if($comissao_func > 0){

	$comissao = $comissao_func;

}

$valor_comissao = ($comissao * $valor) / 100;









$query = $pdo->query("SELECT * FROM formas_pgto where nome = '$pgto'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$valor_taxa = @$res[0]['taxa'];



if($valor_taxa > 0){

	$valor_serv = $valor_unit - $valor_unit * ($valor_taxa / 100);

}








if(strtotime($data_pgto) <=  strtotime($data_atual)){

	$pago = 'Sim';

	$data_pgto2 = $data_pgto;

	$usuario_baixa = $usuario_logado;



	if($comissao > 0){

	//lançar a conta a pagar para a comissão do funcionário

	$pdo->query("INSERT INTO pagar SET descricao = '$descricao2', referencia = 'Comissão', valor = '$valor_comissao', data_lanc = '$data_pgto', vencimento = '$data_pgto', usuario_lanc = '$usuario_logado', arquivo = 'sem-foto.png', pago = 'Não', funcionario = '$funcionario', id_ref = '$servico', subtotal = '$valor_comissao'");

	}

}else{

	$pago = 'Não';

	$data_pgto2 = '';

	$usuario_baixa = 0;

}





if($pgto != "Convênio"){

$foi_pago = 'Sim';

$convenio = 0;

$pdo->query("INSERT INTO $tabela SET descricao = '$descricao', referencia = 'Tratamento', valor = '$valor_serv', data_lanc = curDate(), vencimento = '$data_pgto', data_pgto = '$data_pgto2', usuario_lanc = '$usuario_logado', usuario_pgto = '$usuario_baixa', arquivo = 'sem-foto.png', cliente = '$cliente', pago = '$pago', id_ref = '$servico', forma_pgto = '$pgto', hora = curTime(), caixa = '$id_caixa', subtotal = '$valor_serv'");

}else{

	$foi_pago = 'Sim';

	$pdo->query("INSERT INTO $tabela SET descricao = '$nome_cv', referencia = 'Convenio', valor = '$valor_pelo_cv;', data_lanc = curDate(), vencimento = curDate(), data_pgto = curDate(), usuario_lanc = '$usuario_logado', usuario_pgto = '$usuario_baixa', arquivo = 'sem-foto.png', cliente = '$cliente', pago = 'Não', id_ref = '$servico', forma_pgto = '$pgto', hora = curTime(), caixa = '$id_caixa', subtotal = '$valor_serv'");




}



$pdo->query("UPDATE agendamentos SET pago = 'Sim', tipo_pagamento = '$pgto', valor = '$valor_unit', convenio = '$convenio', numero_convenio = '$numero_convenio' where id_tratamento = '$id_agd'");

$pdo->query("UPDATE tratamentos SET quitado = 'Sim' where id = '$id_agd'");




echo 'Salvo com Sucesso'; 





?>