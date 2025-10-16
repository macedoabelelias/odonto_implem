<?php 
@session_start();
$tabela = 'tratamentos';
require_once("../../../conexao.php");

$usuario_logado = @$_SESSION['id'].'';

$paciente = $_POST['paciente'];
$procedimento = $_POST['procedimento'];
$funcionario = $_POST['profissional'];
$data_inicial = $_POST['data-inicial'];
$data_final = $_POST['data-final'];

//$valor_ag = $_POST['valor'];


$inicio = strtotime($data_inicial);
$fim = strtotime($data_final);

$frequencia = $_POST['vezes'];


$hora1 = @$_POST['hora1'];
$hora2 = @$_POST['hora2'];
$hora3 = @$_POST['hora3'];
$hora4 = @$_POST['hora4'];
$hora5 = @$_POST['hora5'];
$hora6 = @$_POST['hora6'];
$hora7 = @$_POST['hora7'];



$id = $_POST['id-tratamento'];




$diasdasemana = array();

if ($hora1 != '') {
    
    array_push($diasdasemana, "1");
}

if ($hora2 != '') {
    
    array_push($diasdasemana, "2");
}

if ($hora3 != '') {
    
    array_push($diasdasemana, "3");
}


if ($hora4 != '') {
    
    array_push($diasdasemana, "4");
}

if ($hora5 != '') {
    
    array_push($diasdasemana, "5");
}

if ($hora6 != '') {
    
    array_push($diasdasemana, "6");
}

if ($hora7 != '') {
    
    array_push($diasdasemana, "7");
}


$query = $pdo->query("INSERT INTO $tabela SET paciente = '$paciente', procedimento = '$procedimento', profissional = '$funcionario', data_inicial = '$data_inicial', data_final = '$data_final', frequencia = '$frequencia', hora1 = '$hora1', hora2 = '$hora2', hora3 = '$hora3', hora4 = '$hora4', hora5 = '$hora5', hora6 = '$hora6', hora7 = '$hora7', data = curDate() ");
$ult_id = $pdo->lastInsertId();



// Itera de dataInicial até dataFinal
for ($i = $inicio; $i <= $fim; $i += 86400) { // 86400 segundos = 1 dia
    // Verifica se o dia da semana está entre os selecionados
    if (in_array(date('N', $i), $diasdasemana)) {





        // Formata a data para inserção no banco
        $dataParaInsercao = date('Y-m-d', $i);


        switch (date('N', $i)) {
            case 1: // Segunda-feira
                $horaCorrespondente = $hora1;
                break;
            case 2: // Terça-feira
                $horaCorrespondente = $hora2;
                break;
            case 3: // Quarta-feira
                $horaCorrespondente = $hora3;
                break;
            case 4: // Quinta-feira
                $horaCorrespondente = $hora4;
                break;
            case 5: // Sexta-feira
                $horaCorrespondente = $hora5;
                break;
            case 6: // Sábado
                $horaCorrespondente = $hora6;
                break;
            case 7: // Domingo
                $horaCorrespondente = $hora7;
                break;
            default:
                $horaCorrespondente = ''; // Define como vazio se o dia for domingo (7)
                break;
        }

        // Verifica se a hora correspondente não está vazia
        if ($horaCorrespondente != '') {
            // Se não estiver vazia, você pode usá-la na sua consulta SQL
            $horaParaInsercao = $horaCorrespondente;
            // Sua inserção no banco de dados aqui
        }


$hora_do_agd =  @$horaParaInsercao;

$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$intervalo = @$res[0]['intervalo'];
$nome_profissional = @$res[0]['nome'];



$query = $pdo->query("SELECT * FROM procedimentos where id = '$procedimento'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$tempo = $res[0]['tempo'];

$nome_servico = $res[0]['nome'];
$preparo = $res[0]['preparo'];

$valor_ser = $res[0]['valor'];


$hora_minutos = @strtotime("+$tempo minutes", strtotime($horaParaInsercao));			

$hora_final_servico = date('H:i:s', $hora_minutos);



$nova_hora = $horaParaInsercao;







$diasemana = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sabado");

$diasemana_numero = date('w', strtotime($dataParaInsercao));

$dia_procurado = $diasemana[$diasemana_numero];



//percorrer os dias da semana que ele trabalha

$query = $pdo->query("SELECT * FROM dias where funcionario = '$funcionario' and dia = '$dia_procurado'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) == 0){

		echo 'Este Funcionário não trabalha neste Dia!';


$pdo->query("DELETE FROM tratamentos WHERE id = '$ult_id' ");

	exit();

}else{

	$inicio = $res[0]['inicio'];

	$final = $res[0]['final'];

	$inicio_almoco = $res[0]['inicio_almoco'];

	$final_almoco = $res[0]['final_almoco'];



	if(@strtotime($nova_hora) > strtotime($final)){

		echo 'Neste Dia o profissional não trabalha este horário!';
		$pdo->query("DELETE FROM tratamentos WHERE id = '$ult_id' ");

		exit();

	}

}







$dataF = implode('/', array_reverse(explode('-', $dataParaInsercao)));

$horaF = date("H:i", @strtotime($horaParaInsercao));









while (@strtotime($nova_hora) < @strtotime($hora_final_servico)){

		

		$hora_minutos = @strtotime("+$intervalo minutes", strtotime($nova_hora));			

		$nova_hora = date('H:i:s', $hora_minutos);

		

		//VERIFICAR NA TABELA HORARIOS AGD SE TEM O HORARIO NESSA DATA

		$query_agd = $pdo->query("SELECT * FROM horarios_agd where data = '$dataParaInsercao' and funcionario = '$funcionario' and horario = '$nova_hora'");

		$res_agd = $query_agd->fetchAll(PDO::FETCH_ASSOC);

		if(@count($res_agd) > 0 and @$hora_do_post != ""){

			echo 'Este serviço demora cerca de '.$tempo.' minutos, precisa escolher outro horário, pois neste horários não temos disponibilidade devido a outros agendamentos!'.$nova_hora;
			$pdo->query("DELETE FROM tratamentos WHERE id = '$ult_id' ");

			exit();

		}





		//VERIFICAR NA TABELA AGENDAMENTOS SE TEM O HORARIO NESSA DATA e se tem um intervalo entre o horario marcado e o proximo agendado nessa tabela

		$query_agd = $pdo->query("SELECT * FROM agendamentos where data = '$dataParaInsercao' and funcionario = '$funcionario' and hora = '$nova_hora'");

		$res_agd = $query_agd->fetchAll(PDO::FETCH_ASSOC);

		if(@count($res_agd) > 0){

			if($tempo <= $intervalo){



			}else{

				if($hora_final_servico == $res_agd[0]['hora']){

					

				}else{

					echo 'Este serviço demora cerca de '.$tempo.' minutos, precisa escolher outro horário, pois neste horários não temos disponibilidade devido a outros agendamentos!';
					$pdo->query("DELETE FROM tratamentos WHERE id = '$ult_id' ");

						exit();

				}

				

			}

			

		}





		if(strtotime($nova_hora) > strtotime($inicio_almoco) and strtotime($nova_hora) < strtotime($final_almoco)){

		echo 'Este serviço demora cerca de '.$tempo.' minutos, precisa escolher outro horário, pois neste horários não temos disponibilidade devido ao horário de almoço!';
		$pdo->query("DELETE FROM tratamentos WHERE id = '$ult_id' ");

			exit();

	}



}





//validar horario

$query = $pdo->query("SELECT * FROM agendamentos where data = '$dataParaInsercao' and hora = '$horaParaInsercao' and funcionario = '$funcionario'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$total_reg = @count($res);

if($total_reg > 0 and $res[0]['id'] != $id){

	echo 'Este horário não está disponível!';
	$pdo->query("DELETE FROM tratamentos WHERE id = '$ult_id' ");

	exit();

}





//VERIFICAR NA TABELA HORARIOS AGD SE TEM O HORARIO NESSA DATA

		$query_agd = $pdo->query("SELECT * FROM horarios_agd where data = '$dataParaInsercao' and funcionario = '$funcionario' and horario = '$horaParaInsercao'");

		$res_agd = $query_agd->fetchAll(PDO::FETCH_ASSOC);

		if(@count($res_agd) > 0){

			echo 'Já possui agendamento nesse horário para este profissional!';
			$pdo->query("DELETE FROM tratamentos WHERE id = '$ult_id' ");

			exit();

		}















//pegar nome do cliente

$query = $pdo->query("SELECT * FROM clientes where id = '$paciente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cliente = @$res[0]['nome'];
$telefone = @$res[0]['telefone'];





$query = $pdo->prepare("INSERT INTO agendamentos SET funcionario = '$funcionario', paciente = '$paciente', hora = '$horaParaInsercao', data = '$dataParaInsercao', usuario = '$usuario_logado', status = 'Agendado', data_lanc = curDate(), servico = '$procedimento', pago = 'Não', convenio = '0', valor = '$valor_ser', id_tratamento = '$ult_id'");
$ult_id_2 = $pdo->lastInsertId();





$query->execute();










while (strtotime($horaParaInsercao) < strtotime($hora_final_servico)){

		

		$hora_minutos = strtotime("+$intervalo minutes", strtotime($horaParaInsercao));			

		$horaParaInsercao = date('H:i:s', $hora_minutos);



		if(strtotime($horaParaInsercao) < strtotime($hora_final_servico)){

			$query = $pdo->query("INSERT INTO horarios_agd SET agendamento = '$ult_id_2', horario = '$horaParaInsercao', funcionario = '$funcionario', data = '$dataParaInsercao', id_tratamento = '$ult_id'");

		}

	



}


}}

/*

$valor_do_ag = 0;

$query_ag = $pdo->query("SELECT * FROM agendamentos where id_tratamento = '$ult_id'");

$res_ag = $query_ag->fetchAll(PDO::FETCH_ASSOC);

$total_ag = @count($res_ag);



$valor_do_ag = $valor_ag / $total_ag;



$valor_do_ag = str_replace(',', '.', $valor_do_ag);

		


$query = $pdo->prepare("UPDATE agendamentos SET valor = '$valor_do_ag' where id_tratamento = '$ult_id'");

*/




     

	





echo 'Salvo com Sucesso';

