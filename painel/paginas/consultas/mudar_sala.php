<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
require_once("../../../conexao.php");
$tabela = 'usuarios';

$sala = $_POST['sala'];



$pdo->query("UPDATE $tabela SET sala = '$sala' where id = '$id_usuario'");


 ?>