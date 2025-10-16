<?php 
include('data_formatada.php');

if ($token_rel != 'AGRTOJH1258') {
	echo '<script>window.location="../../"</script>';
	exit();
}

$query2 = $pdo->query("SELECT * FROM relatorios where id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$paciente = $res2[0]['paciente'];
$medico = $res2[0]['medico'];
$agendamento = $res2[0]['agendamento'];
$data = $res2[0]['data'];
$texto = $res2[0]['texto'];
$titulo = @$res2[0]['titulo'];

if($titulo == ""){
	$titulo = 'RELATÓRIO DE CONSULTA';
}

$dataF = implode('/', array_reverse(explode('-', $data)));

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$medico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_medico = $res2[0]['nome'];
$crm_medico = $res2[0]['cro'];

$query2 = $pdo->query("SELECT * FROM clientes where id = '$paciente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_paciente = $res2[0]['nome'];
	$telefone_paciente = $res2[0]['telefone'];	
	$nome_paciente = $res2[0]['nome'];
	$endereco_paciente = $res2[0]['endereco'];
	$data_nasc = $res2[0]['data_nasc'];
	$tipo_sanguineo = $res2[0]['tipo_sanguineo'];
	$nome_responsavel = $res2[0]['nome_responsavel'];
	$convenio = $res2[0]['convenio'];
	$sexo = $res2[0]['sexo'];
	$obs_paciente = $res2[0]['obs'];
	$cpf_paciente = $res2[0]['cpf'];
	$cpf_responsavel = $res2[0]['cpf_responsavel'];
	$profissao = $res2[0]['profissao'];
	$estado_civil = $res2[0]['estado_civil'];

	//idade do paciente
	// separando yyyy, mm, ddd
    if (!empty($data_nasc)) {
    $nascimento = DateTime::createFromFormat('Y-m-d', $data_nasc);
    $hoje = new DateTime();

    if ($nascimento) {
        $intervalo = $nascimento->diff($hoje);
        $idade_formatada = $intervalo->y . ' anos, ' . $intervalo->m . ' meses e ' . $intervalo->d . ' dias';
        $data_nascF = $nascimento->format('d/m/Y');
    } else {
        $idade_formatada = 'Data inválida';
        $data_nascF = '';
    }
} else {
    $idade_formatada = 'Data não informada';
    $data_nascF = '';
}

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

						<b><big>RELATÓRIO DE CONSULTA</big></b><br>

						PACIENTE: <?php echo mb_strtoupper($nome_paciente) ?>

						<br>

						 <?php echo mb_strtoupper($data_hoje) ?>

				</td>

			</tr>		

		</table>

	</div>



<br>



		<div style="font-size: 12px; line-height: 1.6; padding: 10px; border: 1px solid #000; border-radius: 5px; width: 97%; box-sizing: border-box;">
    <strong>Paciente:</strong> <?php echo mb_strtoupper($nome_paciente) ?><br>
    <strong>CPF:</strong> <?php echo mb_strtoupper($cpf_paciente) ?> 
    <?php if($cpf_responsavel != ""){ ?> 
        &nbsp;&nbsp;&nbsp;<strong>CPF Responsável:</strong> <?php echo mb_strtoupper($cpf_responsavel) ?> 
    <?php } ?><br>
    <strong>Nascimento:</strong> <?php echo mb_strtoupper($data_nascF) ?> 
    &nbsp;&nbsp;&nbsp;<strong>Idade:</strong> <?php echo mb_strtoupper($idade_formatada) ?>
</div>

<!-- Título do Relatório -->
<div style="text-align: center; margin-top: 30px; margin-bottom: 15px; font-size: 16px; font-weight: bold; border-bottom: 1px solid #333; padding-bottom: 5px;">
    <?php echo mb_strtoupper($titulo) ?>
</div>





</div>



<div id="footer" class="row">

<hr style="margin-bottom: 0;">

	<table style="width:100%;">

		<tr style="width:100%;">

			<td style="width:80%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> / Telefone: <?php echo $telefone_sistema ?> / Email: <?php echo $email_sistema ?> / Este documento é confidencial!</td>

			<td style="width:40%; font-size: 10px; text-align: right;"><p class="">  </p></td>

		</tr>

	</table>

</div>



<div id="content" style="margin-top: 120px;">



<div style="font-size: 12px; margin:25px">

	<?php echo $texto ?>

</div>




 <div style="margin-top: 80px; font-size:13px" align="center">

 	__________________________________________________

 	<br>Dr <?php echo $nome_medico ?><br>
 	<?php if($crm_medico != ""){ echo 'CRO '.$crm_medico; } ?>

 </div>

</div>

	



</body>



</html>





