<?php 
include('data_formatada.php');

if ($token_rel != 'AGRTOJH1258') {
	echo '<script>window.location="../../"</script>';
	exit();
}

$query = $pdo->query("SELECT * from odontograma where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cliente = $res[0]['paciente'];
$descricao = $res[0]['descricao'];
$data = $res[0]['data'];
$evolutivo = $res[0]['evolutivo'];	
$funcionario = $res[0]['funcionario'];


$dataF = implode('/', array_reverse(@explode('-', $data)));


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}



$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];	
	$tel_cliente = $res2[0]['telefone'];
	$email_cliente = $res2[0]['email'];
	$endereco_cliente = $res2[0]['endereco'];
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
	top:100;
	width:80%;
	opacity:10%;
	transform: rotate(-30deg);
}

</style>

</head>
<body>


<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 55px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr>
				<td style="border: 1px; solid #000; width: 25%; text-align: left;">
					<img style="margin-top: 0px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="180px">
				</td>
		
				<td style="text-align: center; font-size: 10px;">
				
                   <b><?php echo @mb_strtoupper($nome_sistema) ?></b><br>
                   	<?php echo @mb_strtoupper($cnpj_sistema) ?><br>
                   	INSTAGRAM: <b><?php echo @mb_strtoupper($instagram_sistema) ?></b><br>
                   	<?php echo @mb_strtoupper($endereco_sistema) ?>

				</td>
				<td style="width: 28%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>ODONTOGRAMA</big></b><br>CONTATO: <?php echo $telefone_sistema ?><br> <?php echo @mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

</div>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top: -20px">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td style="width:14%"><b>DATA: <?php echo $dataF ?></b> </td>
					<td style="width:51%"><b>DESCRIÇÃO: <?php echo $descricao ?> </b></td>					
					<td style="width:35%"><b>PROFISSIONAL: <?php echo mb_strtoupper($nome_usu_lanc) ?></b></td>	
				</tr>
		
			</thead>
		</table>




		<table id="cabecalhotabela" style="border-style: solid; font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td colspan="4" style="width:100%; font-size: 10px"><b>DADOS DO PACIENTE</b> </td>					
				</tr>
				<tr >
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">NOME: </td>
					<td style="width:40%; border-right: : 1px solid #000; border-bottom: : 1px solid #000;">
						<?php echo @mb_strtoupper($nome_cliente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">ENDEREÇO: </td>
					<td style="width:40%; border-bottom: : 1px solid #000;">
						<?php echo @mb_strtoupper($endereco_cliente) ?>

					</td>
    			</tr>
    			<tr >
					<td style="width:10%; border-right: 1px solid #000;">TELEFONE: </td>
					<td style="width:40%; border-right: : 1px solid #000; ">
						<?php echo @mb_strtoupper($tel_cliente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;">EMAIL: </td>
					<td style="width:40%; ">
						<?php echo @mb_strtoupper($email_cliente) ?>
					</td>
    			</tr>
			</thead>
		</table>





<?php 
$id_odontograma = $id;
include('script_odontograma.php');
 ?>









<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%;">
			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?></td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
		</tr>
	</table>
</div>


	
</body>

</html>


