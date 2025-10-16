<?php 
require_once("../../../conexao.php");

$id = @$_POST['id_remedio'];

$query = $pdo->query("SELECT * FROM receitas where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$quantidade = @$res[0]['quantidade'];
$uso = @$res[0]['uso'];

echo $quantidade.'*'.$uso;

?>

