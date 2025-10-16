<?php 
include('data_formatada.php');

if ($token_rel != 'M543661') {
	echo '<script>window.location="../../"</script>';
	exit();
}

$dataInicialF = implode('/', array_reverse(@explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(@explode('-', $dataFinal)));	

$datas = "";
if($dataInicial == $dataFinal){
	$datas = $dataInicialF;
}else{
	$datas = $dataInicialF.' à '.$dataFinalF;
}

$texto_filtro = $datas;

$data_hoje_atual = date('Y-m-d');

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
	top:100;
	width:80%;
	opacity:8%;
}


tr:nth-child(odd) { /* Linhas ímpares */
    background-color: #f2f2f2;
}

tr:nth-child(even) { /* Linhas pares */
    background-color: #ffffff;
}

</style>

</head>
<body>
<?php 
if($marca_dagua == 'Sim'){ ?>
<img class="marca" src="<?php echo $url_sistema ?>img/<?php echo $icone_sistema ?>">	
<?php } ?>


<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 50px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr style="background:#FFF">
				<td style="width: 7%; text-align: left;">
					<img style="margin-top: 7px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/<?php echo $logo_rel ?>" width="140px">
				</td>
				<td style="width: 30%; text-align: left; font-size: 13px;">
					
				</td>
				<td style="width: 1%; text-align: center; font-size: 13px;">
				
				</td>
				<td style="width: 47%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>RELATÓRIO DE RETORNOS PROCEDIMENTOS</span></big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 8px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					
					<td style="width:20%">SERVIÇO</td>
					<td style="width:20%">PACIENTE</td>
					<td style="width:10%">TELEFONE</td>					
					<td style="width:10%">TOTAL</td>
					<td style="width:10%">DATA</td>
					<td style="width:20%">PROFISSIONAL</td>		
					<td style="width:10%">RETORNO</td>					
					
				</tr>
			</thead>
		</table>
</div>

<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%; background:#FFF">
			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?></td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
		</tr>
	</table>
</div>

<div id="content" style="margin-top: 0;">



		<table style="width: 100%; table-layout: fixed; font-size:8px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php
$query = $pdo->query("SELECT * from agendamentos WHERE data_retorno_alerta >= '$dataInicial' and data_retorno_alerta <= '$dataFinal' and alertado is null order by data_retorno_alerta asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
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
    @$email = $res2[0]['email'];
    @$telefone_cliente = $res2[0]['telefone'];

   	

$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_retornoF = implode('/', array_reverse(@explode('-', $data_retorno)));

if(strtotime($data_retorno) > strtotime($data_hoje_atual)){
	$classe_retorno = 'green';
}else{
$classe_retorno = 'red';
}
  	 ?>

  	 
      <tr>

<td style="width:20%"><?php echo $nome_servico ?></td>
<td style="width:20%"><?php echo @$nome_cliente ?></td>
<td style="width:10%"><?php echo @$telefone_cliente ?></td>
<td style="width:10%">R$ <?php echo @$valorF ?></td>
<td style="width:10%"><?php echo $dataF ?></td>
<td style="width:20%"><?php echo @$nome_func ?></td>
<td style="width:10%; color:<?php echo $classe_retorno ?>"><?php echo @$data_retornoF ?></td>
    </tr>

<?php } } ?>
				</tbody>
	
			</thead>
		</table>
	


</div>
<hr>
		

</body>

</html>


