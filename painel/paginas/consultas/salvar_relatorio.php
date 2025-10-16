<?php 
@session_start();
$id_usuario = $_SESSION['id'];
$tabela = 'relatorios';

require_once("../../../conexao.php");

$texto = $_POST['texto'];
$titulo = $_POST['titulo'];
$id_agendamento = $_POST['id_relatorio'];
$id_paciente = $_POST['id_pac_relatorio'];

//apagar relatorio antigo
$pdo->query("DELETE FROM $tabela WHERE agendamento = '$id_agendamento'");

$query = $pdo->prepare("INSERT INTO $tabela SET paciente = '$id_paciente', texto = :texto, data = curDate(), agendamento = '$id_agendamento', medico = '$id_usuario', titulo = :titulo");
$query->bindValue(":texto", "$texto");
$query->bindValue(":titulo", "$titulo");
$query->execute();
$ult_id = $pdo->lastInsertId();

echo 'Salvo com Sucesso*'.$ult_id;

?>