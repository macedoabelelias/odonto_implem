<?php
$pag = 'home';

if ($mostrar_registros == 'Não') {
	$sql_usuario = " and usuario = '$id_usuario '";
	$sql_usuario_lanc = " and usuario_lanc = '$id_usuario '";
} else {
	$sql_usuario = " ";
	$sql_usuario_lanc = " ";
}

//total clientes
if ($mostrar_registros == 'Não') {
	$query = $pdo->query("SELECT * from clientes where usuario = '$id_usuario'");
} else {
	$query = $pdo->query("SELECT * from clientes");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_clientes = @count($res);

//total clientes mes
$query = $pdo->query("SELECT * from clientes where data_cad >= '$data_inicio_mes' and data_cad <= '$data_final_mes' $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_clientes_mes = @count($res);

$total_pagar_vencidas = 0;
$query = $pdo->query("SELECT * from pagar where vencimento < curDate() and pago != 'Sim' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagar_vencidas = @count($res);
for ($i = 0; $i < $contas_pagar_vencidas; $i++) {
	$valor_1 = $res[$i]['valor'];
	$total_pagar_vencidas += $valor_1;
}
$total_pagar_vencidasF = @number_format($total_pagar_vencidas, 2, ',', '.');



$total_receber_vencidas = 0;
$query = $pdo->query("SELECT * from receber where vencimento < curDate() and pago != 'Sim' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_receber_vencidas = @count($res);
for ($i = 0; $i < $contas_receber_vencidas; $i++) {
	$valor_2 = $res[$i]['valor'];
	$total_receber_vencidas += $valor_2;
}
$total_receber_vencidasF = @number_format($total_receber_vencidas, 2, ',', '.');


//total recebidas mes
$total_recebidas_mes = 0;
$query = $pdo->query("SELECT * from receber where data_pgto >= '$data_inicio_mes' and data_pgto <= '$data_final_mes' and pago = 'Sim' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_recebidas_mes = @count($res);
for ($i = 0; $i < $contas_recebidas_mes; $i++) {
	$valor_3 = $res[$i]['valor'];
	$total_recebidas_mes += $valor_3;
}
$total_recebidas_mesF = @number_format($total_recebidas_mes, 2, ',', '.');

//total contas pagas mes
$total_pagas_mes = 0;
$query = $pdo->query("SELECT * from pagar where data_pgto >= '$data_inicio_mes' and data_pgto <= '$data_final_mes' and pago = 'Sim' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagas_mes = @count($res);
for ($i = 0; $i < $contas_pagas_mes; $i++) {
	$valor_4 = $res[$i]['valor'];
	$total_pagas_mes += $valor_4;
}
$total_pagas_mesF = @number_format($total_pagas_mes, 2, ',', '.');


$total_saldo_mes = $total_recebidas_mes - $total_pagas_mes;
$total_saldo_mesF = @number_format($total_saldo_mes, 2, ',', '.');
if ($total_saldo_mes >= 0) {
	$classe_saldo = 'iconSusses';
	$classe_saldo2 = 'iconBgSusses';
	$classe_icon_dia = 'fa fa-caret-up text-success';
} else {
	$classe_saldo = 'iconDanger';
	$classe_saldo2 = 'iconBgDanger';
	$classe_icon_dia = 'fa fa-caret-down text-danger';
}




//total recebidas dia
$total_recebidas_dia = 0;
$query = $pdo->query("SELECT * from receber where data_pgto = curDate() and pago = 'Sim' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_recebidas_dia = @count($res);
for ($i = 0; $i < $contas_recebidas_dia; $i++) {
	$valor_3 = $res[$i]['valor'];
	$total_recebidas_dia += $valor_3;
}
$total_recebidas_diaF = @number_format($total_recebidas_dia, 2, ',', '.');

//total contas pagas dia
$total_pagas_dia = 0;
$query = $pdo->query("SELECT * from pagar where data_pgto = curDate() and pago = 'Sim' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagas_dia = @count($res);
for ($i = 0; $i < $contas_pagas_dia; $i++) {
	$valor_4 = $res[$i]['valor'];
	$total_pagas_dia += $valor_4;
}
$total_pagas_diaF = @number_format($total_pagas_dia, 2, ',', '.');


$total_saldo_dia = $total_recebidas_dia - $total_pagas_dia;
$total_saldo_diaF = @number_format($total_saldo_dia, 2, ',', '.');
if ($total_saldo_dia >= 0) {
	$classe_saldo_dia = 'bg-success';
} else {
	$classe_saldo_dia = 'bg-danger';
}




//valores para o grafico de linhas (ano atual, despesas e recebimentos)
$total_meses_pagar_grafico = '';
$total_meses_receber_grafico = '';

for ($i = 1; $i <= 12; $i++) {
	if ($i < 10) {
		$mes_verificado = '0' . $i;
	} else {
		$mes_verificado = $i;
	}


	$data_inicio_mes_grafico = $ano_atual . "-" . $mes_verificado . "-01";

	if ($mes_verificado == '04' || $mes_verificado == '06' || $mes_verificado == '09' || $mes_verificado == '11') {
		$data_final_mes_grafico = $ano_atual . '-' . $mes_verificado . '-30';
	} else if ($mes_verificado == '02') {
		$bissexto = date('L', @mktime(0, 0, 0, 1, 1, $mes_verificado));
		if ($bissexto == 1) {
			$data_final_mes_grafico = $ano_atual . '-' . $mes_verificado . '-29';
		} else {
			$data_final_mes_grafico = $ano_atual . '-' . $mes_verificado . '-28';
		}

	} else {
		$data_final_mes_grafico = $ano_atual . '-' . $mes_verificado . '-31';
	}




	//total recebidas mes
	$total_recebidas_mes_grafico = 0;
	$query2 = $pdo->query("SELECT * from receber where data_pgto >= '$data_inicio_mes_grafico' and data_pgto <= '$data_final_mes_grafico' and pago = 'Sim' $sql_usuario_lanc");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$contas_recebidas_mes_grafico = @count($res2);
	for ($i2 = 0; $i2 < $contas_recebidas_mes_grafico; $i2++) {
		$valor_3 = $res2[$i2]['valor'];
		$total_recebidas_mes_grafico += $valor_3;
	}


	//total contas pagas mes
	$total_pagas_mes_grafico = 0;
	$query2 = $pdo->query("SELECT * from pagar where data_pgto >= '$data_inicio_mes_grafico' and data_pgto <= '$data_final_mes_grafico' and pago = 'Sim' $sql_usuario_lanc");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$contas_pagas_mes_grafico = @count($res2);
	for ($i2 = 0; $i2 < $contas_pagas_mes_grafico; $i2++) {
		$valor_4 = $res2[$i2]['valor'];
		$total_pagas_mes_grafico += $valor_4;
	}


	$total_meses_pagar_grafico .= $total_pagas_mes_grafico . '-';
	$total_meses_receber_grafico .= $total_recebidas_mes_grafico . '-';

}





//tarefas
$query = $pdo->query("SELECT * from tarefas where usuario = '$id_usuario' and status = 'Agendada' and data <= curDate() and hora < curTime() order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$tarefas_atrasadas = @count($res);

$query = $pdo->query("SELECT * from tarefas where usuario = '$id_usuario' and status = 'Agendada' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_tarefas = @count($res);


$query = $pdo->query("SELECT * from tarefas where usuario = '$id_usuario' and status = 'Agendada' and data = curDate() order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$tarefas_agendadas_hoje = @count($res);

#####ANOTAÇÕES#####################################
$query = $pdo->query("SELECT * from anotacoes");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
for ($i5 = 0; $i5 < $linhas; $i5++) {
	$msg = $res[$i5]['msg'];
	$titulo = $res[$i5]['titulo'];
}





//total agendamentos hoje
$query = $pdo->query("SELECT * from agendamentos where data = curdate() $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$agendamentos_hoje = @count($res);


//total agendametnos mes
$query = $pdo->query("SELECT * from agendamentos where data >= '$data_inicio_mes' and data <= '$data_final_mes' $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$agendamentos_mes = @count($res);


//total agendamentos confirmados
$query = $pdo->query("SELECT * from agendamentos where data = curdate() and status = 'Confirmado' $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$agendamentos_confirmados = @count($res);


//total agendamentos finalizados
$query = $pdo->query("SELECT * from agendamentos where data = curdate() and status = 'Finalizado' $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$agendamentos_finalizados = @count($res);




//total consultas recebidas mes
$recebidos_consultas_mes = 0;
$query = $pdo->query("SELECT * from receber where data_pgto >= '$data_inicio_mes' and data_pgto <= '$data_final_mes' and pago = 'Sim' and referencia = 'Procedimento' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagas_mes = @count($res);
for ($i = 0; $i < $contas_pagas_mes; $i++) {
	$valor_4 = $res[$i]['valor'];
	$recebidos_consultas_mes += $valor_4;
}
$recebidos_consultas_mesF = @number_format($recebidos_consultas_mes, 2, ',', '.');


//total consultas recebidas hoje
$recebidos_consultas_hoje = 0;
$query = $pdo->query("SELECT * from receber where data_pgto = curDate() and pago = 'Sim' and referencia = 'Procedimento' $sql_usuario_lanc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagas_mes = @count($res);
for ($i = 0; $i < $contas_pagas_mes; $i++) {
	$valor_4 = $res[$i]['valor'];
	$recebidos_consultas_hoje += $valor_4;
}
$recebidos_consultas_hojeF = @number_format($recebidos_consultas_hoje, 2, ',', '.');



//orcamentos hoje
$query = $pdo->query("SELECT * from orcamentos where data = curdate() $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$orcamentos_hoje = @count($res);


//orcamentos pendentes
$query = $pdo->query("SELECT * from orcamentos where status = 'Pendente' $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$orcamentos_pendentes = @count($res);


//consultas finalizadas mes
$query = $pdo->query("SELECT * from agendamentos where status = 'Finalizado' and  data >= '$data_inicio_mes' and data <= '$data_final_mes' $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$consultas_finalizadas_mes = @count($res);


//consultas finalizadas hoje
$query = $pdo->query("SELECT * from agendamentos where status = 'Finalizado' and  data = curDate() $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$consultas_finalizadas_hoje = @count($res);


//consultas finalizadas ontem
$query = $pdo->query("SELECT * from agendamentos where status = 'Finalizado' and  data = '$data_ontem' $sql_usuario");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$consultas_finalizadas_ontem = @count($res);


//verificar se ele tem a permissão de estar nessa página
if (@$home == 'ocultar') {
	echo "<script>window.location='index'</script>";
	exit();
}
?>


<div class="mt-4 justify-content-between">


	<?php if ($ativo_sistema == '') { ?>

		<div style="background: #ffc341; color:#3e3e3e; padding:10px; font-size:14px; margin-bottom:10px">

			<div><i class="fa fa-info-circle"></i> <b>Aviso: </b> Prezado Cliente, não identificamos o pagamento de sua última
				mensalidade, entre em contato conosco o mais rápido possivel para regularizar o pagamento, caso contário seu
				acesso ao sistema será desativado.</div>

		</div>

	<?php } ?>




	<div class="row" style="font-weight: 400">

		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px;">
				<a href="clientes">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class="mb-1">Total Pacientes</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2"><?php echo $total_clientes ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Este Mês<i class="fa fa-caret-up mx-1 text-success"></i>
										<span class="text-primary tx-11" style="font-size: 16px"><?php echo $total_clientes_mes ?></span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-4">

							<div class=" zoom circle-icon iconBgSusses text-center align-self-center overflow-hidden">
								<i class="fe fe-user tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>


		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px">
				<a href="pagar">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class=" mb-1">Despesas Vencidas</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2">R$ <?php echo $total_pagar_vencidasF ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Pagar Vencidas<i class="fa fa-caret-down mx-1 text-danger"></i>
										<span class="iconDanger tx-11" style="font-size: 16px"><?php echo $contas_pagar_vencidas ?></span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-4">

							<div class="zoom circle-icon iconBgDanger text-center align-self-center overflow-hidden">
								<i class="bi bi-currency-dollar tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px">
				<a href="receber">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class=" mb-1">Receber Vencidas</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2">R$ <?php echo $total_receber_vencidasF ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Receb. Vencidas<i class="fa fa-caret-up mx-1 text-success"></i>
										<span class="text-primary  tx-11" style="font-size: 16px"><?php echo $contas_receber_vencidas ?></span>
									</p>

								</div>
							</div>
						</div>
						<div class="col-4">

							<div class=" zoom circle-icon iconBgSusses text-center align-self-center overflow-hidden">
								<i class="bi bi-currency-dollar tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px">
				<a href="receber">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class=" mb-1">Saldo no Mês</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2 <?php echo $classe_saldo ?>">R$
											<?php echo $total_saldo_mesF ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Saldo Hoje<i class="mx-1 <?php echo $classe_icon_dia ?>"></i>
										<span class="iconHome tx-11 <?php echo $classe_saldo ?> tx-11" style="font-size: 16px">R$
											<?php echo $total_saldo_diaF ?></span>
									</p>

								</div>
							</div>
						</div>
						<div class="col-4">

							<div class=" zoom circle-icon text-center align-self-center overflow-hidden <?php echo $classe_saldo2 ?>">
								<i class="bi bi-currency-dollar tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>
	</div>





	<div class="row" style="font-weight: 400">

		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px;">
				<a href="agendamentos">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class="mb-1">Agendamentos Hoje</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2"><?php echo $agendamentos_hoje ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Este Mês<i class="fa fa-caret-up mx-1 text-success"></i>
										<span class="text-primary  tx-11" style="font-size: 16px"><?php echo $agendamentos_mes ?></span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-4">

							<div class=" zoom circle-icon iconBgDanger text-center align-self-center overflow-hidden">
								<i class="fe fe-calendar tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>


		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px">
				<a href="agendamentos">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class=" mb-1">Agendamentos Confirmados</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2"><?php echo $agendamentos_confirmados ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Finalizados<i class="fa fa-caret-down mx-1 text-danger"></i>
										<span class="iconDanger tx-11" style="font-size: 16px"><?php echo $agendamentos_finalizados ?></span>
									</p>
								</div>
							</div>
						</div>
						<div class="col-4">

							<div class="zoom circle-icon iconBgSusses text-center align-self-center overflow-hidden">
								<i class="bi bi-calendar tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px">
				<a href="receber">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class=" mb-1">Consultas Hoje R$</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2">R$ <?php echo $recebidos_consultas_hojeF ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Mês R$<i class="fa fa-caret-up mx-1 text-success"></i>
										<span class="text-primary  tx-11" style="font-size: 16px">R$ <?php echo $recebidos_consultas_mesF ?></span>
									</p>

								</div>
							</div>
						</div>
						<div class="col-4">

							<div class=" zoom circle-icon iconBgSusses text-center align-self-center overflow-hidden">
								<i class="bi bi-currency-dollar tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-xl-3 col-lg-12 col-md-6 col-xs-12">
			<div class="card sales-card"
				style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1); height:130px; border-radius: 10px">
				<a href="orcamentos">
					<div class="row">
						<div class="col-8">
							<div class="ps-4 pt-4 pe-3 pb-4">
								<div class="">
									<p class=" mb-1">Orçamentos Pendentes</p>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<h4 class="tx-20 font-weight-semibold mb-2 ">
											<?php echo $orcamentos_pendentes ?></h4>
									</div>
									<p class="mb-0 tx-12 text-muted">Orçamentos Hoje<i class="mx-1 <?php echo $classe_icon_dia ?>"></i>
										<span class="iconHome tx-11 text-primary  tx-11" style="font-size: 16px">
											<?php echo $orcamentos_hoje ?></span>
									</p>

								</div>
							</div>
						</div>
						<div class="col-4">

							<div class=" zoom circle-icon text-center align-self-center overflow-hidden iconBgDanger">
								<i class="bi bi-calendar tx-16 text-white"></i>
							</div>

						</div>
					</div>
				</a>
			</div>
		</div>
	</div>


	<div id="statistics2"></div>


	<!-- ################################ FIM PAINEL DE INFORMAÇÕES ###################################### -->
	<?php

	$query = $pdo->query("SELECT * from anotacoes where mostrar_home = 'Sim' order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$linhas = @count($res);
	if ($linhas > 0) {

		echo <<<HTML
<small>

<div class='row'>
	
	<thead style="margin-bottom: 50px"> 
		
		
			<div class="col-xl-12" style="margin-bottom: -17px">
			<div class="card sales-card border border-dark" style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.2);">
			

<div  style="text-align:center; font-size: 20px; padding: 4px"><strong>PAINEL DE INFORMAÇÕES</strong> </div>
				
			</div>


	</div>


	</thead> 
	<tbody>	


		
HTML;

		for ($i = 0; $i < $linhas; $i++) {
			$id = $res[$i]['id'];
			$titulo = $res[$i]['titulo'];
			$msg = $res[$i]['msg'];
			$usuario = $res[$i]['usuario'];
			$data = $res[$i]['data'];


			$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
			if (@count($res2) > 0) {
				$nome_usuario = $res2[0]['nome'];
			} else {
				$nome_usuario = 'Sem Usuário';
			}

			$dataF = implode('/', array_reverse(@explode('-', $data)));


			$msgF = mb_strimwidth($msg, 0, 250, "...");

			echo <<<HTML
<tr>

			<div class="col-xl-12" style="margin-bottom: -18px;">
			<div class="card sales-card border border-white" style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1);">
			

<div style="font-size: 12px; padding: 4px"><b>{$titulo}:</b> {$msg}</div>
				
			</div>


	</div>


</tr>
HTML;

		}

	}




	echo <<<HTML
</tbody>
</div>

HTML;
	?>
	
	
	<!-- ################################ FIM PAINEL DE INFORMAÇÕES ###################################### -->




	<div class="card custom-card overflow-hidden ocultar_mobile">
		<div class="card-header border-bottom-0">
			<div>
				<h3 class="card-title mb-2 ">Recebimentos / Despesas <?php echo $ano_atual ?></h3> <span
					class="d-block tx-12 mb-0 text-muted"></span>
			</div>
		</div>
		<div class="card-body">
			<div id="statistics1"></div>
		</div>
	</div>


</div>




<div class="row">


	<div class="col-xl-6 col-lg-12 col-md-6 col-xs-12">
		<a href="tarefas">
			<div class="card sales-card " style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1);">
				<div class="row">

					<div class="col-8">
						<div class="ps-4 pt-4 pe-3 pb-4">
							<div class="">
								<h6 class="mb-2 tx-12 ">Total de Tarefas Pendentes</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<h4 class="tx-20 font-weight-semibold mb-2 text-danger"><?php echo $total_tarefas ?></h4>
								</div>
								<p class="mb-0 tx-12 text-muted">Pendentes Hoje<i class="fa fa-caret-up mx-2 text-success"></i>
									<span class="text-success font-weight-semibold"> <?php echo $tarefas_agendadas_hoje ?></span>

									<span style="margin-left: 20px">Tarefas Atrasadas<i class="fa fa-caret-down mx-2 text-danger"></i>
										<span class="text-danger font-weight-semibold"> <?php echo $tarefas_atrasadas ?></span></span>
								</p>

							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="circle-icon bg-primary-transparent text-center align-self-center overflow-hidden">
							<i class="fe fe-shopping-bag tx-16 text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>



	<div class="col-xl-6 col-lg-12 col-md-6 col-xs-12">
		<a href="tarefas">
			<div class="card sales-card " style="box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.1);">
				<div class="row">

					<div class="col-8">
						<div class="ps-4 pt-4 pe-3 pb-4">
							<div class="">
								<h6 class="mb-2 tx-12 ">Consultas Finalizadas Hoje</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<h4 class="tx-20 font-weight-semibold mb-2 text-primary"><?php echo $consultas_finalizadas_hoje ?></h4>
								</div>
								<p class="mb-0 tx-12 text-muted">Este Mês<i class="fa fa-caret-up mx-2 text-success"></i>
									<span class="text-success font-weight-semibold"> <?php echo $consultas_finalizadas_mes ?></span>

									<span style="margin-left: 20px">Ontem<i class="fa fa-caret-down mx-2 text-danger"></i>
										<span class="text-danger font-weight-semibold"> <?php echo $consultas_finalizadas_ontem ?></span></span>
								</p>

							</div>
						</div>
					</div>

					<div class="col-4">
						<div class="circle-icon bg-primary-transparent text-center align-self-center overflow-hidden">
							<i class="fe fe-shopping-bag tx-16 text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>



</div>







<script type="text/javascript">
	// GRAFICO DE BARRAS
	function statistics1() {
		var total_pagar = "<?= $total_meses_pagar_grafico ?>";
		var total_receber = "<?= $total_meses_receber_grafico ?>";

		var split_pagar = total_pagar.split("-");
		var split_receber = total_receber.split("-");


		setTimeout(() => {
			var options1 = {
				series: [{
					name: 'Contas à Receber',
					data: [split_receber[0], split_receber[1], split_receber[2], split_receber[3], split_receber[4], split_receber[5], split_receber[6], split_receber[7], split_receber[8], split_receber[9], split_receber[10], split_receber[11]],
				}, {
					name: 'Contas à Pagar',
					data: [split_pagar[0], split_pagar[1], split_pagar[2], split_pagar[3], split_pagar[4], split_pagar[5], split_pagar[6], split_pagar[7], split_pagar[8], split_pagar[9], split_pagar[10], split_pagar[11]],
				}],
				chart: {
					type: 'bar',
					height: 280
				},
				grid: {
					borderColor: '#f2f6f7',
				},
				colors: ["#098522", "#bf281d"],
				plotOptions: {
					bar: {
						colors: {
							ranges: [{
								from: -100,
								to: -46,
								color: '#098522'
							}, {
								from: -45,
								to: 0,
								color: '#bf281d'
							}]
						},
						columnWidth: '40%',
					}
				},
				dataLabels: {
					enabled: false,
				},
				stroke: {
					show: true,
					width: 4,
					colors: ['transparent']
				},
				legend: {
					show: true,
					position: 'top',
				},
				yaxis: {
					title: {
						text: 'Valores',
						style: {
							color: '#adb5be',
							fontSize: '14px',
							fontFamily: 'poppins, sans-serif',
							fontWeight: 600,
							cssClass: 'apexcharts-yaxis-label',
						},
					},
					labels: {
						formatter: function (y) {
							return y.toFixed(0) + "";
						}
					}
				},
				xaxis: {
					type: 'month',
					categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
					axisBorder: {
						show: true,
						color: 'rgba(119, 119, 142, 0.05)',
						offsetX: 0,
						offsetY: 0,
					},
					axisTicks: {
						show: true,
						borderType: 'solid',
						color: 'rgba(119, 119, 142, 0.05)',
						width: 6,
						offsetX: 0,
						offsetY: 0
					},
					labels: {
						rotate: -90
					}
				}
			};
			document.getElementById('statistics1').innerHTML = '';
			var chart1 = new ApexCharts(document.querySelector("#statistics1"), options1);
			chart1.render();
		}, 300);
	}

</script>