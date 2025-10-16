<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
require_once("../../../conexao.php");



$id_pac = $_POST['id_paciente'];

$remedio = $_POST['remedio'];

$quantidade = $_POST['quantidade'];

$uso = $_POST['uso'];


$query = $pdo->query("SELECT * FROM receitas where id = '$remedio'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_remedio = @$res[0]['remedio'];



$query = $pdo->prepare("INSERT INTO receita SET paciente = '$id_pac', medico = '$id_usuario', remedio = :remedio, quantidade = :quantidade, uso = :uso, data = curDate()");



$query->bindValue(":remedio", "$nome_remedio");

$query->bindValue(":quantidade", "$quantidade");

$query->bindValue(":uso", "$uso");

$query->execute();



echo 'Inserindo com Sucesso';



?>