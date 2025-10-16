<?php 
require_once("../../../conexao.php");
$pagina = 'clientes';

$id = @$_POST['id'];

echo '<select class="form-select" name="cliente" id="cliente" style="width:100%;" required readonly>';

$query = $pdo->query("SELECT * FROM clientes where id = '$id' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){}
	$id_cliente = $res[0]['id'];
	echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].' - '.$res[$i]['cpf'].'</option>';

}

echo '</select>';

?>

