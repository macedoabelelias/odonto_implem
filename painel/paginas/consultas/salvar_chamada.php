<?php 
require_once("../../../conexao.php");
$tabela = 'chamadas';

$medico = $_POST['medico'];
$paciente = $_POST['paciente'];
$sala = $_POST['sala'];

$pdo->query("DELETE FROM $tabela WHERE paciente = '$paciente'");

$pdo->query("INSERT INTO $tabela SET paciente = '$paciente', medico = '$medico', sala = '$sala', status = 'Chamando', hora = curTime(), data = curDate()");

echo 'Paciente Chamado';

 ?>