<?php 


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma' and deciduo = 'Não'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_permanentes = @count($res);


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma' and deciduo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_deciduos = @count($res);


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 18");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao18 = @$res[0]['acao'];
}else{
	$acao18 = "normais";
}



$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 17");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao17 = @$res[0]['acao'];
}else{
	$acao17 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 16");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao16 = @$res[0]['acao'];
}else{
	$acao16 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 15");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao15 = @$res[0]['acao'];
}else{
	$acao15 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 14");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao14 = @$res[0]['acao'];
}else{
	$acao14 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 13");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao13 = @$res[0]['acao'];
}else{
	$acao13 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 12");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao12 = @$res[0]['acao'];
}else{
	$acao12 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 11");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao11 = @$res[0]['acao'];
}else{
	$acao11 = "normais";
}




$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 21");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao21 = @$res[0]['acao'];
}else{
	$acao21 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 22");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao22 = @$res[0]['acao'];
}else{
	$acao22 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 23");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao23 = @$res[0]['acao'];
}else{
	$acao23 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 24");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao24 = @$res[0]['acao'];
}else{
	$acao24 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 25");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao25 = @$res[0]['acao'];
}else{
	$acao25 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 26");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao26 = @$res[0]['acao'];
}else{
	$acao26 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 27");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao27 = @$res[0]['acao'];
}else{
	$acao27 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 28");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao28 = @$res[0]['acao'];
}else{
	$acao28 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 48");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao48 = @$res[0]['acao'];
}else{
	$acao48 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 47");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao47 = @$res[0]['acao'];
}else{
	$acao47 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 46");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao46 = @$res[0]['acao'];
}else{
	$acao46 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 45");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao45 = @$res[0]['acao'];
}else{
	$acao45 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 44");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao44 = @$res[0]['acao'];
}else{
	$acao44 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 43");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao43 = @$res[0]['acao'];
}else{
	$acao43 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 42");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao42 = @$res[0]['acao'];
}else{
	$acao42 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 41");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao41 = @$res[0]['acao'];
}else{
	$acao41 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 31");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao31 = @$res[0]['acao'];
}else{
	$acao31 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 32");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao32 = @$res[0]['acao'];
}else{
	$acao32 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 33");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao33 = @$res[0]['acao'];
}else{
	$acao33 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 34");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao34 = @$res[0]['acao'];
}else{
	$acao34 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 35");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao35 = @$res[0]['acao'];
}else{
	$acao35 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 36");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao36 = @$res[0]['acao'];
}else{
	$acao36 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 37");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao37 = @$res[0]['acao'];
}else{
	$acao37 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 38");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao38 = @$res[0]['acao'];
}else{
	$acao38 = "normais";
}









$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 55");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao55 = @$res[0]['acao'];
}else{
	$acao55 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 54");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao54 = @$res[0]['acao'];
}else{
	$acao54 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 53");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao53 = @$res[0]['acao'];
}else{
	$acao53 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 52");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao52 = @$res[0]['acao'];
}else{
	$acao52 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 51");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao51 = @$res[0]['acao'];
}else{
	$acao51 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 61");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao61 = @$res[0]['acao'];
}else{
	$acao61 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 62");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao62 = @$res[0]['acao'];
}else{
	$acao62 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 63");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao63 = @$res[0]['acao'];
}else{
	$acao63 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 64");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao64 = @$res[0]['acao'];
}else{
	$acao64 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 65");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao65 = @$res[0]['acao'];
}else{
	$acao65 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 85");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao85 = @$res[0]['acao'];
}else{
	$acao85 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 84");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao84 = @$res[0]['acao'];
}else{
	$acao84 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 83");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao83 = @$res[0]['acao'];
}else{
	$acao83 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 82");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao82 = @$res[0]['acao'];
}else{
	$acao82 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 81");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao81 = @$res[0]['acao'];
}else{
	$acao81 = "normais";
}






$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 71");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao71 = @$res[0]['acao'];
}else{
	$acao71 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 72");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao72 = @$res[0]['acao'];
}else{
	$acao72 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 73");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao73 = @$res[0]['acao'];
}else{
	$acao73 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 74");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao74 = @$res[0]['acao'];
}else{
	$acao74 = "normais";
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odontograma'  and dente = 75");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){	
	$acao75 = @$res[0]['acao'];
}else{
	$acao75 = "normais";
}

 ?>




 
<?php if($total_permanentes > 0){ ?>
<br>
<div align="center" style="font-size: 11px">Permanentes</div>

<table id="Table_01" width="407" height="214" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao18 ?>/18.jpg" width="28" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao17 ?>/17.jpg" width="29" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao16 ?>/16.jpg" width="26" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao15 ?>/15.jpg" width="21" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao14 ?>/14.jpg" width="23" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao13 ?>/13.jpg" width="28" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao12 ?>/12.jpg" width="19" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao11 ?>/11.jpg" width="28" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao21 ?>/21.jpg" width="27" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao22 ?>/22.jpg" width="21" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao23 ?>/23.jpg" width="23" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao24 ?>/24.jpg" width="25" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao25 ?>/25.jpg" width="20" height="116" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao26 ?>/26.jpg" width="27" height="116" alt=""></td>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao27 ?>/27.jpg" width="27" height="116" alt=""></td>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao28 ?>/28.jpg" width="34" height="116" alt=""></td>
		<td>
			<img  width="1" height="116" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao48 ?>/48.jpg" width="30" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao47 ?>/47.jpg" width="31" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao46 ?>/46.jpg" width="30" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao45 ?>/45.jpg" width="24" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao44 ?>/44.jpg" width="22" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao43 ?>/43.jpg" width="23" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao42 ?>/42.jpg" width="20" height="97" alt=""></td>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao41 ?>/41.jpg" width="22" height="97" alt=""></td>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao31 ?>/31.jpg" width="20" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao32 ?>/32.jpg" width="20" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao33 ?>/33.jpg" width="23" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao34 ?>/34.jpg" width="22" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao35 ?>/35.jpg" width="25" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao36 ?>/36.jpg" width="30" height="97" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao37 ?>/37.jpg" width="30" height="97" alt=""></td>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/permanentes/<?php echo $acao38 ?>/38.jpg" width="34" height="97" alt=""></td>
		<td>
			<img  width="1" height="97" alt=""></td>
	</tr>
	<tr>
		<td>
			<img  width="28" height="1" alt=""></td>
		<td>
			<img  width="2" height="1" alt=""></td>
		<td>
			<img  width="27" height="1" alt=""></td>
		<td>
			<img  width="4" height="1" alt=""></td>
		<td>
			<img  width="22" height="1" alt=""></td>
		<td>
			<img  width="8" height="1" alt=""></td>
		<td>
			<img  width="13" height="1" alt=""></td>
		<td>
			<img  width="11" height="1" alt=""></td>
		<td>
			<img  width="12" height="1" alt=""></td>
		<td>
			<img  width="10" height="1" alt=""></td>
		<td>
			<img  width="18" height="1" alt=""></td>
		<td>
			<img  width="5" height="1" alt=""></td>
		<td>
			<img  width="14" height="1" alt=""></td>
		<td>
			<img  width="6" height="1" alt=""></td>
		<td>
			<img  width="22" height="1" alt=""></td>
		<td>
			<img  width="20" height="1" alt=""></td>
		<td>
			<img  width="7" height="1" alt=""></td>
		<td>
			<img  width="13" height="1" alt=""></td>
		<td>
			<img  width="8" height="1" alt=""></td>
		<td>
			<img  width="15" height="1" alt=""></td>
		<td>
			<img  width="8" height="1" alt=""></td>
		<td>
			<img  width="14" height="1" alt=""></td>
		<td>
			<img  width="11" height="1" alt=""></td>
		<td>
			<img  width="14" height="1" alt=""></td>
		<td>
			<img  width="6" height="1" alt=""></td>
		<td>
			<img  width="24" height="1" alt=""></td>
		<td>
			<img  width="3" height="1" alt=""></td>
		<td>
			<img  width="27" height="1" alt=""></td>
		<td>
			<img  width="34" height="1" alt=""></td>
		<td></td>
	</tr>
</table>

<?php } ?>



<?php if($total_deciduos > 0){ ?>
<br>
<div align="center" style="font-size: 11px">Decíduos (Leite)</div>

<table id="Table_01" width="370" height="284" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao55 ?>/55.jpg" width="46" height="151" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao54 ?>/54.jpg" width="40" height="151" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao53 ?>/53.jpg" width="34" height="151" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao52 ?>/52.jpg" width="29" height="151" alt=""></td>
		<td colspan="3">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao51 ?>/51.jpg" width="38" height="151" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao61 ?>/61.jpg" width="40" height="151" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao62 ?>/62.jpg" width="27" height="151" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao63 ?>/63.jpg" width="34" height="151" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao64 ?>/64.jpg" width="40" height="151" alt=""></td>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao65 ?>/65.jpg" width="41" height="151" alt=""></td>
		<td>
			<img  width="1" height="151" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao85 ?>/85.jpg" width="50" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao84 ?>/84.jpg" width="42" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao83 ?>/83.jpg" width="32" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao82 ?>/82.jpg" width="28" height="132" alt=""></td>
		<td>
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao81 ?>/81.jpg" width="29" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao71 ?>/71.jpg" width="31" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao72 ?>/72.jpg" width="28" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao73 ?>/73.jpg" width="33" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao74 ?>/74.jpg" width="41" height="132" alt=""></td>
		<td colspan="2">
			<img src="<?php echo $url_sistema ?>painel/img/deciduos/<?php echo $acao75 ?>/75.jpg" width="55" height="132" alt=""></td>
		<td>
			<img  width="1" height="132" alt=""></td>
	</tr>
	<tr>
		<td>
			<img  width="46" height="1" alt=""></td>
		<td>
			<img  width="4" height="1" alt=""></td>
		<td>
			<img  width="36" height="1" alt=""></td>
		<td>
			<img  width="6" height="1" alt=""></td>
		<td>
			<img  width="28" height="1" alt=""></td>
		<td>
			<img  width="4" height="1" alt=""></td>
		<td>
			<img  width="25" height="1" alt=""></td>
		<td>
			<img  width="3" height="1" alt=""></td>
		<td>
			<img  width="29" height="1" alt=""></td>
		<td>
			<img  width="6" height="1" alt=""></td>
		<td>
			<img  width="25" height="1" alt=""></td>
		<td>
			<img  width="15" height="1" alt=""></td>
		<td>
			<img  width="13" height="1" alt=""></td>
		<td>
			<img  width="14" height="1" alt=""></td>
		<td>
			<img  width="19" height="1" alt=""></td>
		<td>
			<img  width="15" height="1" alt=""></td>
		<td>
			<img  width="26" height="1" alt=""></td>
		<td>
			<img  width="14" height="1" alt=""></td>
		<td>
			<img  width="41" height="1" alt=""></td>
		<td></td>
	</tr>
</table>

<?php } ?>

<br>

<div align="center" style="font-size: 10px; font-weight: 400; margin-bottom: 20px" >
        <span style="margin-right: 15px"><img style="margin-top: 0px" src="<?php echo $url_sistema ?>painel/images/carie.jpg" width="10px"> Procedimentos</span>
        <span style="margin-right: 15px"><img style="margin-top: 0px" src="<?php echo $url_sistema ?>painel/images/tratados.jpg" width="10px"> Já Tratados</span>
         <span style="margin-right: 15px"><img style="margin-top: 0px" src="<?php echo $url_sistema ?>painel/images/extraidos.jpg" width="10px"> Extraídos</span>
          <span style="margin-right: 15px"><img style="margin-top: 0px" src="<?php echo $url_sistema ?>painel/images/extrair.jpg" width="10px"> Para Extrair</span>
</div>







<?php 
$total_produtos = 0;
$total_produtosF = 0;
$query = $pdo->query("SELECT * from itens_odo where odontograma = '$id_odontograma' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
 ?>
		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top: 10px">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:8%">DENTE</td>
					<td style="width:92%">DESCRIÇÃO E OBSERVAÇÕES</td>
											
					
				</tr>
			</thead>
		</table>

		


		<table style="width: 100%; table-layout: fixed; font-size:10px;  margin-top: -5px">
			<thead>
				<tbody>
					<?php 
					$total_final = 0;
for($i=0; $i<$linhas; $i++){
	
	$id = $res[$i]['id'];
	$paciente = $res[$i]['paciente'];
	$data = $res[$i]['data'];
	$dente = $res[$i]['dente'];
	$acao = $res[$i]['acao'];
	$descricao = $res[$i]['descricao'];
	if($res[$i]['obs'] == ""){
		$obs = "";
	}else{
		$obs = '('.$res[$i]['obs'].')';
	}
	
	
	
  	 ?>

  	 
<tr>
	<td style="width:8%; font-size: 10px">
		<img style="margin-top: 0px" src="<?php echo $url_sistema ?>painel/images/<?php echo $acao ?>.jpg" width="10px">
	 <?php echo $dente ?></td>
	<td style="width:92%"><b><?php echo $descricao ?></b> <span style="font-size: 9px"><?php echo $obs ?></span></td>
	
	
 </tr>

<?php } ?>
				</tbody>
	
			</thead>
		</table>

		<?php
		
		 } 

		 ?>

		