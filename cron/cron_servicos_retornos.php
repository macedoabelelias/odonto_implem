<?php 
require_once("../conexao.php");

$query = $pdo->query("SELECT * from agendamentos where data_retorno_alerta <= curDate() and retorno_alerta is null and alertado is null ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$retornos_pendentes = @count($res);
for ($i = 0; $i < $retornos_pendentes; $i++) {
	$id = $res[$i]['id']; 
	$servico = $res[$i]['servico'];    
    $valor = $res[$i]['valor'];    
    $data = $res[$i]['data'];   
    $funcionario = $res[$i]['funcionario'];
    $cliente = $res[$i]['paciente'];    
    $data_retorno = $res[$i]['data_retorno_alerta'];
    
    $valorF = number_format($valor, 2, ',', '.');   
   
    $query2 = $pdo->query("SELECT * from procedimentos where id = '$servico'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    @$nome_servico = $res2[0]['nome'];

    $query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    @$nome_func = $res2[0]['nome'];
    
    $query2 = $pdo->query("SELECT * from clientes where id = '$cliente'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    @$nome_cliente = $res2[0]['nome'];
    @$telefone_cliente = $res2[0]['telefone'];
    @$email = $res2[0]['email'];

$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_retornoF = implode('/', array_reverse(@explode('-', $data_retorno)));



	//enviar whatsapp
		if ($api_whatsapp != 'Não' and $telefone_cliente != '') {
			$telefone_envio = '55' . preg_replace('/[ ()-]+/', '', $telefone_cliente);
			$mensagem = '🏷️ *' . $nome_sistema . '* %0A';
$mensagem .= '📅 *Lembrete de Retorno* 🦷%0A%0A';
	$mensagem .= 'Olá *' . $nome_cliente . '*! Esperamos que esteja tudo bem com você. 😊%0A%0A';
	$mensagem .= 'Estamos entrando em contato para lembrar que está se aproximando a data ideal para o retorno referente ao procedimento realizado em *' . $dataF . '* aqui na clínica. 🗓️%0A%0A';
	$mensagem .= '*Procedimento:* ' . $nome_servico . '%0A';
	$mensagem .= '*Profissional responsável:* ' . $nome_func . '%0A';
	$mensagem .= '📅 *Data Sugerida:* %0A';
	$mensagem .= '*À partir de:* ' . $data_retornoF . ' ⏳%0A%0A';
	$mensagem .= 'Se desejar agendar ou tiver alguma dúvida, nossa equipe está à disposição para te atender com carinho e atenção. 💙%0A%0A';
	$mensagem .= 'Agradecemos por confiar em nosso cuidado com seu sorriso! 😄';
					
			require('texto.php');

			if(@$status_mensagem == "Mensagem enviada com sucesso." and $api_whatsapp == 'menuia'){
				$pdo->query("UPDATE agendamentos SET retorno_alerta = 'Sim' where id = '$id'");
			}

			if($api_whatsapp != 'menuia'){
				$pdo->query("UPDATE agendamentos SET retorno_alerta = 'Sim' where id = '$id'");
			}
			
		}

}

echo $retornos_pendentes;

 ?>