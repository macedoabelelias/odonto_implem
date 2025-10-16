<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
require_once("../../../conexao.php");
$id_pac = $_POST['id_paciente'];
$exame = @$_POST['exame'];
$exame2 = @$_POST['exame2'];
$descricao = @$_POST['descricao'];

$clinica = 'Sim';
if($exame == ""){
	$exame = $exame2;
	$clinica = 'Não';
}
$query = $pdo->prepare("INSERT INTO raiox SET paciente = '$id_pac', dentista = '$id_usuario', procedimento = :exame, descricao = :descricao, clinica = :clinica, data = curDate()");
$query->bindValue(":exame", "$exame");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":clinica", "$clinica");
$query->execute();
echo 'Inserindo com Sucesso';
?>