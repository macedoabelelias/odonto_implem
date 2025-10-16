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


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 18");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao18 = @$res[0]['acao'];
}else{
	$acao18 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 17");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao17 = @$res[0]['acao'];
}else{
	$acao17 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 16");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao16 = @$res[0]['acao'];
}else{
	$acao16 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 15");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao15 = @$res[0]['acao'];
}else{
	$acao15 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 14");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao14 = @$res[0]['acao'];
}else{
	$acao14 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 13");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao13 = @$res[0]['acao'];
}else{
	$acao13 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 12");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao12 = @$res[0]['acao'];
}else{
	$acao12 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 11");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao11 = @$res[0]['acao'];
}else{
	$acao11 = "normais";
}




$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 21");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao21 = @$res[0]['acao'];
}else{
	$acao21 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 22");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao22 = @$res[0]['acao'];
}else{
	$acao22 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 23");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao23 = @$res[0]['acao'];
}else{
	$acao23 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 24");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao24 = @$res[0]['acao'];
}else{
	$acao24 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 25");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao25 = @$res[0]['acao'];
}else{
	$acao25 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 26");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao26 = @$res[0]['acao'];
}else{
	$acao26 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 27");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao27 = @$res[0]['acao'];
}else{
	$acao27 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 28");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao28 = @$res[0]['acao'];
}else{
	$acao28 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 48");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao48 = @$res[0]['acao'];
}else{
	$acao48 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 47");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao47 = @$res[0]['acao'];
}else{
	$acao47 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 46");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao46 = @$res[0]['acao'];
}else{
	$acao46 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 45");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao45 = @$res[0]['acao'];
}else{
	$acao45 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 44");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao44 = @$res[0]['acao'];
}else{
	$acao44 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 43");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao43 = @$res[0]['acao'];
}else{
	$acao43 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 42");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao42 = @$res[0]['acao'];
}else{
	$acao42 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 41");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao41 = @$res[0]['acao'];
}else{
	$acao41 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 31");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao31 = @$res[0]['acao'];
}else{
	$acao31 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 32");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao32 = @$res[0]['acao'];
}else{
	$acao32 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 33");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao33 = @$res[0]['acao'];
}else{
	$acao33 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 34");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao34 = @$res[0]['acao'];
}else{
	$acao34 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 35");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao35 = @$res[0]['acao'];
}else{
	$acao35 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 36");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao36 = @$res[0]['acao'];
}else{
	$acao36 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 37");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao37 = @$res[0]['acao'];
}else{
	$acao37 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id' $sql_func and dente = 38");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao38 = @$res[0]['acao'];
}else{
	$acao38 = "normais";
}


echo <<<HTML
	
<table id="Table_01" width="700" height="300" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(18)"><img id="img_18" src="img/permanentes/{$acao18}/18.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(17)"><img id="img_17" src="img/permanentes/{$acao17}/17.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(16)"><img id="img_16" src="img/permanentes/{$acao16}/16.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(15)"><img id="img_15" src="img/permanentes/{$acao15}/15.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(14)"><img id="img_14" src="img/permanentes/{$acao14}/14.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(13)"><img id="img_13" src="img/permanentes/{$acao13}/13.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(12)"><img id="img_12" src="img/permanentes/{$acao12}/12.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(11)"><img id="img_11" src="img/permanentes/{$acao11}/11.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(21)"><img id="img_21" src="img/permanentes/{$acao21}/21.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(22)"><img id="img_22" src="img/permanentes/{$acao22}/22.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(23)"><img id="img_23" src="img/permanentes/{$acao23}/23.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(24)"><img id="img_24" src="img/permanentes/{$acao24}/24.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(25)"><img id="img_25" src="img/permanentes/{$acao25}/25.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(26)"><img id="img_26" src="img/permanentes/{$acao26}/26.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(27)"><img id="img_27" src="img/permanentes/{$acao27}/27.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(28)"><img id="img_28" src="img/permanentes/{$acao28}/28.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<img  width="1" height="100" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
		<a title="Selecionar Dente" href="#" onclick="selecionarDente(48)"><img id="img_48" src="img/permanentes/{$acao48}/48.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(47)"><img id="img_47" src="img/permanentes/{$acao47}/47.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(46)"><img id="img_46" src="img/permanentes/{$acao46}/46.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(45)"><img id="img_45" src="img/permanentes/{$acao45}/45.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(44)"><img id="img_44" src="img/permanentes/{$acao44}/44.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(43)"><img id="img_43" src="img/permanentes/{$acao43}/43.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(42)"><img id="img_42" src="img/permanentes/{$acao42}/42.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(41)"><img id="img_41" src="img/permanentes/{$acao41}/41.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(31)"><img id="img_31" src="img/permanentes/{$acao31}/31.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(32)"><img id="img_32" src="img/permanentes/{$acao32}/32.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(33)"><img id="img_33" src="img/permanentes/{$acao33}/33.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(34)"><img id="img_34" src="img/permanentes/{$acao34}/34.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(35)"><img id="img_35" src="img/permanentes/{$acao35}/35.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(36)"><img id="img_36" src="img/permanentes/{$acao36}/36.jpg" style="width:{$largura}"  alt=""></td></a>
		<td colspan="2">
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(37)"><img id="img_37" src="img/permanentes/{$acao37}/37.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<a title="Selecionar Dente" href="#" onclick="selecionarDente(38)"><img id="img_38" src="img/permanentes/{$acao38}/38.jpg" style="width:{$largura}"  alt=""></td></a>
		<td>
			<img  width="1" height="100" alt=""></td>
	</tr>
	<tr>
		<td>
			<img  width="80" height="1" alt=""></td>
		<td>
			<img  width="6" height="1" alt=""></td>
		<td>
			<img  width="76" height="1" alt=""></td>
		<td>
			<img  width="12" height="1" alt=""></td>
		<td>
			<img  width="62" height="1" alt=""></td>
		<td>
			<img  width="23" height="1" alt=""></td>
		<td>
			<img  width="37" height="1" alt=""></td>
		<td>
			<img  width="33" height="1" alt=""></td>
		<td>
			<img  width="35" height="1" alt=""></td>
		<td>
			<img  width="26" height="1" alt=""></td>
		<td>
			<img  width="53" height="1" alt=""></td>
		<td>
			<img  width="15" height="1" alt=""></td>
		<td>
			<img  width="40" height="1" alt=""></td>
		<td>
			<img  width="15" height="1" alt=""></td>
		<td>
			<img  width="64" height="1" alt=""></td>
		<td>
			<img  width="58" height="1" alt=""></td>
		<td>
			<img  width="18" height="1" alt=""></td>
		<td>
			<img  width="39" height="1" alt=""></td>
		<td>
			<img  width="22" height="1" alt=""></td>
		<td>
			<img  width="44" height="1" alt=""></td>
		<td>
			<img  width="22" height="1" alt=""></td>
		<td>
			<img  width="40" height="1" alt=""></td>
		<td>
			<img  width="30" height="1" alt=""></td>
		<td>
			<img  width="41" height="1" alt=""></td>
		<td>
			<img  width="18" height="1" alt=""></td>
		<td>
			<img  width="68" height="1" alt=""></td>
		<td>
			<img  width="8" height="1" alt=""></td>
		<td>
			<img  width="78" height="1" alt=""></td>
		<td>
			<img  width="97" height="1" alt=""></td>
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