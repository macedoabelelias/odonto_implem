<?php 
$tabela = 'orcamentos';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$id = $_POST['id'];

$pdo->query("UPDATE orcamentos SET status = 'Concluído', data_aprovacao = curDate() where id = '$id'");

echo 'Baixado com Sucesso';

?>

