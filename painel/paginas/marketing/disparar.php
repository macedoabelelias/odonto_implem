<?php 
@session_start();
require_once("../../../conexao.php");

$dataMes = Date('m');
$dataDia = Date('d');
$dataAno = Date('Y');
$data_atual = date('Y-m-d');


$data_semana = date('Y/m/d', strtotime("-7 days",strtotime($data_atual)));


@session_start();
$id_usuario = $_SESSION['id'];

$id = $_POST['id'];
$clientes = $_POST['clientes'];
$data_disparo = $_POST['data_disparo'];
$hora_disparo = $_POST['hora_disparo'];
$frequencia = $_POST['frequencia'];
$quantidade = $_POST['quantidade'];
$delay = 1;

// Validar horário
$hora_atual = date('H:i');
$data_atual = date('Y-m-d');

if($frequencia > 0){
	if($quantidade == ""){
		echo 'Coloque uma quantidade de vezes que você deseja que a mensagem seja disparada!';
		exit();
	}
}

if($data_disparo == $data_atual){
	if($hora_disparo != "agora"){
		if(strtotime($hora_disparo) <= strtotime($hora_atual)){
			echo 'O horário de disparo precisa ser maior que o horário atual!';
			exit();
		}
	}    
}else if($data_disparo < $data_atual){
	echo 'A data de disparo não pode ser menor que a data atual!';
	exit();
}


if(empty($hora_disparo)){
	echo 'Selecione um horário de disparo!';
	exit();
}

if (empty($data_disparo)) {
	echo 'Selecione uma data de disparo!';
	exit();
}



require("importar_excel.php");
require("importar_txt.php");

if ($_FILES['arquivo_excel']['name'] != "" || $_FILES['arquivo_texto']['name'] != ""){
	echo 'Salvo com Sucesso';
	exit();
}


// Buscar os Contatos que serão enviados
if ($clientes == "Teste") {
	$query = $pdo->query("SELECT * FROM config where telefone != ''");

} else if ($clientes == "Clientes Mês") {
	$query = $pdo->query("SELECT * FROM clientes where month(data_cad) = '$dataMes' and year(data_cad) = '$dataAno' and telefone != '' and (marketing = '' or marketing is null)");

} else if ($clientes == "Clientes Semana") {
	$query = $pdo->query("SELECT * FROM clientes where data_cad >= '$data_semana' and telefone != '' and (marketing = '' or marketing is null)");

} else if ($clientes == "Todos") {
	$query = $pdo->query("SELECT * FROM clientes where telefone != '' and (marketing = '' or marketing is null) ");


}else if ($clientes == "Aniversariantes Mês"){
	$query = $pdo->query("SELECT * FROM clientes where month(data_nasc) = '$dataMes'  and telefone != '' and (marketing = '' or marketing is null)  ");	

}else if ($clientes == "Aniversariantes Dia"){
	$query = $pdo->query("SELECT * FROM clientes where month(data_nasc) = '$dataMes' and day(data_nasc) = '$dataDia'  and telefone != '' and (marketing = '' or marketing is null) ");	

}else if ($clientes == "Inadimplentes"){
	$query = $pdo->query("SELECT DISTINCT c.nome, c.telefone, c.id FROM clientes c JOIN receber r ON c.id = r.cliente WHERE r.vencimento < CURDATE() AND r.pago = 'Não' ");

}else{
	
}


$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_clientes = @count($res);
for ($i = 0; $i < $total_clientes; $i++) {
	$id_cliente = @$res[$i]['id'];
	$nome_cliente = @$res[$i]['nome'];
	$telefone_cliente = @$res[$i]['telefone'];

	if($hora_disparo == "agora"){
		$hora = date('H:i:s');
	}else{
		$hora_array = explode(':', $hora_disparo);
		$hora_formatada = $hora_array[0];
		$minuto_randomico = rand(0, 59);
		$hora = $hora_formatada . ':' . str_pad($minuto_randomico, 2, '0', STR_PAD_LEFT);
	}


	$pdo->query("INSERT INTO disparos set campanha = '$id', cliente = '$id_cliente', nome = '$nome_cliente', telefone = '$telefone_cliente', hora = '$hora', data_disparo = '$data_disparo'");




	if($frequencia > 0){
					for ($if = 2; $if <= $quantidade; $if++) {
						$dias_frequencia = $frequencia;
						$dias_parcela = $if - 1;
						$dias_parcela_2 = ($if - 1) * $dias_frequencia;
						
						if ($dias_frequencia == 30 || $dias_frequencia == 31) {

							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else if ($dias_frequencia == 90) {
							$dias_parcela = $dias_parcela * 3;
							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else if ($dias_frequencia == 180) {

							$dias_parcela = $dias_parcela * 6;
							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else if ($dias_frequencia == 360 || $dias_frequencia == 365) {

							$dias_parcela = $dias_parcela * 12;
							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else {

							$nova_data = date('Y/m/d', strtotime("+$dias_parcela_2 days", strtotime($data_disparo)));
						}

					$pdo->query("INSERT INTO disparos set campanha = '$id', cliente = '$id_cliente', nome = '$nome_cliente', telefone = '$telefone_cliente', hora = '$hora', data_disparo = '$nova_data'");

					}
				}



}

echo 'Salvo com Sucesso';
?>