<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
require_once("../../../conexao.php");
$tabela = 'raiox';
$data_hoje = date('Y-m-d');
$id_pac = @$_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where paciente = '$id_pac' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){	
		$id = $res[$i]['id'];
		$descricao = $res[$i]['descricao'];
		$clinica = $res[$i]['clinica'];
		if($clinica == 'Sim'){
			$classe = '';
		}else{
			$classe = '(Fora da Clínica)';
		}


echo <<<HTML
		<div style="margin-top: 10px">
		<span style="font-size: 13px"><i class="fa fa-check text-success"></i> {$descricao} <span style="font-size: 12px; color:#400303">{$classe}</span>


		<div class="dropdown" style="display: inline-block;">                      
		<a href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
		<div  class="dropdown-menu tx-13">
		<div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
		<p>Confirmar Exclusão? <a href="#" onclick="excluirExame('{$id}', '{$id_pac}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</div>
		</div>



		<br>

		</div>
HTML;
	}
}else{
	echo '<small>Nenhum Exame Lançado!</small>';
}
?>
<script type="text/javascript">
	function excluirExame(id, paciente){	

		$.ajax({
			url: 'paginas/' + pag + "/excluir_exame.php",
			method: 'POST',
			data: {id},
			dataType: "html",
			success:function(mensagem){

				if (mensagem.trim() == "Excluído com Sucesso") {  
					listarExames(paciente);
					limparCamposExame();
				} 
			}
		});
	}
</script>