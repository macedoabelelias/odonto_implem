<?php
@session_start();
$id_usuario = @$_SESSION['id'];

$tabela = 'itens_odo';
require_once("../../../conexao.php");

$acao = $_POST['acao'];
$dente = $_POST['dente'];
$descricao = $_POST['descricao'];
$obs = $_POST['obs'];
$id = $_POST['id'];
$paciente = @$_POST['paciente'];

if($id == ""){
	$id = 0;
}

if($dente == "55" or $dente == "54" or $dente == "53" or $dente == "52" or $dente == "51" or $dente == "61" or $dente == "62" or $dente == "63" or $dente == "64" or $dente == "65" or $dente == "85" or $dente == "84" or $dente == "83" or $dente == "82" or $dente == "81" or $dente == "71" or $dente == "72" or $dente == "73" or $dente == "74" or $dente == "75" ){
	$deciduo = 'Sim';
}else{
	$deciduo = 'Não';
}

//validacao nome
if($id == 0){
	$query = $pdo->query("SELECT * from $tabela where dente = '$dente' and odontograma = '$id' and funcionario = '$id_usuario'");
}else{
	$query = $pdo->query("SELECT * from $tabela where dente = '$dente' and odontograma = '$id'");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if (@count($res) > 0 and $id != $id_reg) {
	echo 'Dente já Inserido no Odontograma!';
	exit();
}



$query = $pdo->prepare("INSERT INTO $tabela SET odontograma = :odontograma, paciente = :paciente, data = curDate(), dente = :dente, acao = :acao, descricao = :descricao, obs = :obs, funcionario = :funcionario, deciduo = :deciduo ");

$query->bindValue(":odontograma", "$id");
$query->bindValue(":paciente", "$paciente");
$query->bindValue(":dente", "$dente");
$query->bindValue(":acao", "$acao");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":obs", "$obs");
$query->bindValue(":funcionario", "$id_usuario");
$query->bindValue(":deciduo", "$deciduo");

$query->execute();

echo 'Salvo com Sucesso';
