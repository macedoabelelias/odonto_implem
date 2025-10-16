<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
require_once("../../../conexao.php");
$largura = '70%';

$id = $_POST['id'];

if($id == ""){
	$sql_func = " and funcionario = '$id_usuario '";
	
}else{
	$sql_func = " ";	
}


if($id == ""){
	$id = 0;
}




$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 55");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao55 = @$res[0]['acao'];
}else{
	$acao55 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 54");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao54 = @$res[0]['acao'];
}else{
	$acao54 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 53");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao53 = @$res[0]['acao'];
}else{
	$acao53 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 52");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao52 = @$res[0]['acao'];
}else{
	$acao52 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 51");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao51 = @$res[0]['acao'];
}else{
	$acao51 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 61");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao61 = @$res[0]['acao'];
}else{
	$acao61 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 62");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao62 = @$res[0]['acao'];
}else{
	$acao62 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 63");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao63 = @$res[0]['acao'];
}else{
	$acao63 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 64");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao64 = @$res[0]['acao'];
}else{
	$acao64 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 65");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao65 = @$res[0]['acao'];
}else{
	$acao65 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 85");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao85 = @$res[0]['acao'];
}else{
	$acao85 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 84");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao84 = @$res[0]['acao'];
}else{
	$acao84 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 83");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao83 = @$res[0]['acao'];
}else{
	$acao83 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 82");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao82 = @$res[0]['acao'];
}else{
	$acao82 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 81");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao81 = @$res[0]['acao'];
}else{
	$acao81 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 71");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao71 = @$res[0]['acao'];
}else{
	$acao71 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 72");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao72 = @$res[0]['acao'];
}else{
	$acao72 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 73");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao73 = @$res[0]['acao'];
}else{
	$acao73 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 74");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao74 = @$res[0]['acao'];
}else{
	$acao74 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 75");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao75 = @$res[0]['acao'];
}else{
	$acao75 = "normais";
}


echo <<<HTML
	
<table id="Table_01" width="450" height="250" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(55)"><img id="img_55" src="img/deciduos/{$acao55}/55.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(54)"><img id="img_54" src="img/deciduos/{$acao54}/54.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(53)"><img id="img_53" src="img/deciduos/{$acao53}/53.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(52)"><img id="img_52" src="img/deciduos/{$acao52}/52.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="3">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(51)"><img id="img_51" src="img/deciduos/{$acao51}/51.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(61)"><img id="img_61" src="img/deciduos/{$acao61}/61.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(62)"><img id="img_62" src="img/deciduos/{$acao62}/62.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(63)"><img id="img_63" src="img/deciduos/{$acao63}/63.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(64)"><img id="img_64" src="img/deciduos/{$acao64}/64.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(65)"><img id="img_65" src="img/deciduos/{$acao65}/65.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<img  width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(85)"><img id="img_85" src="img/deciduos/{$acao85}/85.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(84)"><img id="img_84" src="img/deciduos/{$acao84}/84.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(83)"><img id="img_83" src="img/deciduos/{$acao83}/83.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(82)"><img id="img_82" src="img/deciduos/{$acao82}/82.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(81)"><img id="img_81" src="img/deciduos/{$acao81}/81.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(71)"><img id="img_71" src="img/deciduos/{$acao71}/71.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(72)"><img id="img_72" src="img/deciduos/{$acao72}/72.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(73)"><img id="img_73" src="img/deciduos/{$acao73}/73.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(74)"><img id="img_74" src="img/deciduos/{$acao74}/74.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(75)"><img id="img_75" src="img/deciduos/{$acao75}/75.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<img  width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td>
			<img  width="92" height="1" alt=""></td>
		<td>
			<img  width="7" height="1" alt=""></td>
		<td>
			<img  width="72" height="1" alt=""></td>
		<td>
			<img  width="13" height="1" alt=""></td>
		<td>
			<img  width="56" height="1" alt=""></td>
		<td>
			<img  width="8" height="1" alt=""></td>
		<td>
			<img  width="49" height="1" alt=""></td>
		<td>
			<img  width="7" height="1" alt=""></td>
		<td>
			<img  width="58" height="1" alt=""></td>
		<td>
			<img  width="11" height="1" alt=""></td>
		<td>
			<img  width="51" height="1" alt=""></td>
		<td>
			<img  width="29" height="1" alt=""></td>
		<td>
			<img  width="26" height="1" alt=""></td>
		<td>
			<img  width="28" height="1" alt=""></td>
		<td>
			<img  width="38" height="1" alt=""></td>
		<td>
			<img  width="30" height="1" alt=""></td>
		<td>
			<img  width="52" height="1" alt=""></td>
		<td>
			<img  width="28" height="1" alt=""></td>
		<td>
			<img  width="82" height="1" alt=""></td>
		<td></td>
	</tr>
</table>

<div align="center" style="font-size: 12px; font-weight: 400; margin-bottom: 20px" >
        <span style="margin-right: 15px"><i class="fa fa-circle text-danger"></i> Procedimentos</span>
        <span style="margin-right: 15px"><i class="fa fa-square text-success"></i> Já Tratados</span>
         <span style="margin-right: 15px"><i class="fa fa-square text-dark"></i> Extraídos</span>
          <span style="margin-right: 15px"><i class="fa fa-close text-dark"></i> Para Extrair</span>
</div>


HTML;

?>

<script type="text/javascript">
	function selecionarDente(dente){
		limparEstilos();
		$('#img_'+dente).addClass('inativo_imagem');
		$('#dente').val(dente).change();
	}
</script>