<?php
$tabela = 'config';
require_once("../conexao.php");

$p = $_POST['p'];



if($p == 'Fundo'){

	$query = $pdo->query("SELECT * FROM config");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$fundo_login_antigo = @$res[0]['fundo_login'];

		if($fundo_login_antigo != "sem-foto.png"){
			@unlink('../img/'.$fundo_login_antigo);
		} 

	$pdo->query("UPDATE $tabela SET fundo_login = 'sem-foto.png'");
}

echo 'Excluído com Sucesso';

?>