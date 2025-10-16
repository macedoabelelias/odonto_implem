<?php 
include('data_formatada.php');

if ($token_rel != 'AGRTOJH1258') {
	echo '<script>window.location="../../"</script>';
	exit();
}

if($prof == ""){
	$sql_prof = '';
}else{
	$sql_prof = " and profissional = '$prof' ";
}

$texto_filtro = "";


$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));

$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));	


$datas = "";

if($dataInicial == $dataFinal){

	$datas = $dataInicialF;

}else{

	$datas = $dataInicialF.' à '.$dataFinalF;

}


$texto_filtro_prof = '';

if($prof != ""){
	$query2 = $pdo->query("SELECT * FROM usuarios where id = '$prof'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func = $res2[0]['nome'];
	$texto_filtro_prof = $nome_func;
}

?>

<!DOCTYPE html>

<html>

<head>



<style>



@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');

@page { margin: 145px 20px 25px 20px; }

#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }

#content {margin-top: 0px;}

#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 80px; }

#footer .page:after {content: counter(page, my-sec-counter);}

body {font-family: 'Tw Cen MT', sans-serif;}



.marca{

	position:fixed;

	left:50;

	top:130;

	width:80%;

	opacity:10%;

}



</style>



</head>

<body>

<?php 

if($marca_dagua == 'Sim'){ ?>

<img class="marca" src="<?php echo $url_sistema ?>img/logo.jpg">	

<?php } ?>





<div id="header" >



	<div style="border-style: solid; font-size: 10px; height: 50px;">

		<table style="width: 100%; border: 0px solid #ccc;">

			<tr>

				<td style="border: 1px; solid #000; width: 20%; text-align: left;">

					<img style="margin-top: 5px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="140px">

				</td>

				<td style="width: 20%; text-align: left; font-size: 13px;">

				

				</td>

				<td style="width: 5%; text-align: center; font-size: 13px;">

				

				</td>

				<td style="width: 55%; text-align: right; font-size: 9px;padding-right: 10px;">

						<b><big>RELATÓRIO DE TRATAMENTOS <?php echo mb_strtoupper($texto_filtro_prof) ?></big></b><br>

						<?php echo $datas ?>

						<br>

						 <?php echo mb_strtoupper($data_hoje) ?>

				</td>

			</tr>		

		</table>

	</div>



<br>





		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">

			<thead>

				

				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">

					<td style="width:20%">PACIENTE</td>

					<td style="width:20%">PROCEDIMENTO</td>

					<td style="width:20%">PROFISSIONAL</td>

					<td style="width:10%">DATA INICIAL</td>

					<td style="width:10%">DATA FINAL</td>

					<td style="width:10%">FREQUÊNCIA</td>

					<td style="width:10%">RESTANTE</td>

				</tr>

			</thead>

		</table>

</div>



<div id="footer" class="row">

<hr style="margin-bottom: 0;">

	<table style="width:100%;">

		<tr style="width:100%;">

			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> / Telefone: <?php echo $telefone_sistema ?> / Email: <?php echo $email_sistema ?></td>

			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>

		</tr>

	</table>

</div>



<div id="content" style="margin-top: 0;">



		<table style="width: 100%; table-layout: fixed; font-size:9px; text-transform: uppercase;">

			<thead>

				<tbody>

					<?php 

$ativos = 0;

$inativos = 0;

$query = $pdo->query("SELECT * from tratamentos where data >= '$dataInicial' and data <= '$dataFinal' $sql_prof order by id desc");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$linhas = @count($res);

if($linhas > 0){

for($i=0; $i<$linhas; $i++){

	$id = $res[$i]['id'];

	$paciente = $res[$i]['paciente'];

	$procedimento = $res[$i]['procedimento'];

	$profissional = $res[$i]['profissional'];

	$quitado = $res[$i]['quitado'];

	$data_inicio = $res[$i]['data_inicial'];

	$data_fim = $res[$i]['data_final'];

	$frequencia = $res[$i]['frequencia'];

	$data_inicioF = @implode('/', array_reverse(explode('-', $data_inicio)));
$data_fimF = @implode('/', array_reverse(explode('-', $data_fim)));


	$hora1 = @$res[$i]['hora1'];

	$hora2 = @$res[$i]['hora2'];

	$hora3 = @$res[$i]['hora3'];

	$hora4 = @$res[$i]['hora4'];

	$hora5 = @$res[$i]['hora5'];

	$hora6 = @$res[$i]['hora6'];


	if ($hora1 == '00:00:00') {
		$hora1 = '';
	}
	if ($hora2 == '00:00:00') {
		$hora2 = '';
	}
	if ($hora3 == '00:00:00') {
		$hora3 = '';
	}
	if ($hora4 == '00:00:00') {
		$hora4 = '';
	}
	if ($hora5 == '00:00:00') {
		$hora5 = '';
	}
	if ($hora6 == '00:00:00') {
		$hora6 = '';
	}


if ($quitado == 'Sim') {
	$ocul = 'ocultar';
}else{
	$ocul = '';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$paciente'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);



$nome_cliente = $res2[0]['nome'];





$query2 = $pdo->query("SELECT * FROM usuarios where id = '$profissional'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);



$nome_func = $res2[0]['nome'];







$query2 = $pdo->query("SELECT * FROM procedimentos where id = '$procedimento'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);


$nome_serv = $res2[0]['nome'];

$valor_serv = $res2[0]['valor'];





$query7 = $pdo->query("SELECT * FROM agendamentos where id_tratamento = '$id' and pago = 'Não'");

$res7 = $query7->fetchAll(PDO::FETCH_ASSOC);
$valor_t = 0;
$agendamentos_nao_pagos = 0;
$valor_tF = 0;

$valor_servF = 0;


if ( @count($res7) > 0) {




for($i7=0; $i7 < @count($res7); $i7++){
$valor_s = $res7[$i7]['valor'];

$valor_t += $valor_s;
	
}
$valor_tF = number_format($valor_t, 2, ',', '.');



$valor_todos = 0;
$agendamentos_nao_pagos = count($res7);

$valor_todos = $valor_serv * $agendamentos_nao_pagos;

$valor_todosF = number_format(@$valor_todos, 2, ',', '.');

$valor_servF = number_format(@$valor_serv, 2, ',', '.');

}

if($valor_tF == 0){
	$valor_tF = 'Pago';
	$classe_valor = 'green';
}else{
	$classe_valor = 'red';
}
	

  	 ?>



  	 

      <tr>

<td style="width:20%;"><?php echo $nome_cliente ?></td>

<td style="width:20%"><?php echo $nome_serv ?></td>

<td style="width:20%"><?php echo $nome_func ?></td>

<td style="width:10%"><?php echo $data_inicioF ?></td>

<td style="width:10%"><?php echo $data_fimF ?></td>

<td style="width:10%"><?php echo $frequencia ?> X Semana</td>

<td style="width:10%; color:<?php echo $classe_valor ?>">R$ <?php echo $valor_tF ?></td>

    </tr>



<?php } } ?>

				</tbody>

	

			</thead>

		</table>

	





</div>

<hr>

		



</body>



</html>





