<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
require_once("../../../conexao.php");
$tabela = 'historico_paciente';
$data_hoje = date('Y-m-d');
$id_pac = @$_POST['id'];


$query = $pdo->query("SELECT * FROM $tabela where paciente = '$id_pac' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){	
	$id = $res[$i]['id'];
	$descricao = $res[$i]['descricao'];
	$data = $res[$i]['data'];
	$consulta = $res[$i]['consulta'];
	$funcionario = $res[$i]['funcionario'];
	$nome_funcionario = $res[$i]['nome_funcionario'];
	$dataF = implode('/', array_reverse(explode('-', $data)));
	$ocultar_excluir = '';
	if($funcionario != $id_usuario){
		$ocultar_excluir = 'ocultar';
	}
echo <<<HTML
	<div style="border-bottom:1px solid #919191; padding-bottom: 5px">
	<span style="color:#096385; font-size: 13px"><i>Dr {$nome_funcionario}</i> <span style="color:#360202; font-size: 11px">({$dataF})</span></span>

	<div class="dropdown" style="display: inline-block;">                      
                        <a href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
                        <div  class="dropdown-menu tx-13">
                        <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                        <p>Confirmar Exclusão? <a href="#" onclick="excluirHistorico('{$id}', '{$id_pac}')"><span class="text-danger">Sim</span></a></p>
                        </div>
                        </div>
                        </div>


	<br>
	<span style="color:#363636; font-size: 12px">
	<i>"{$descricao}"</i>
	</span>
	</div>
HTML;
	}
}else{
	echo '<small>Nenhum Histórico Lançado!</small>';
}
?>
<script type="text/javascript">
	function excluirHistorico(id, paciente){	
        
    $.ajax({
        url: 'paginas/consultas/excluir_historico.php',
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(mensagem){
             
            if (mensagem.trim() == "Excluído com Sucesso") {  
                listarHistorico(paciente);
            } 
        }
    });
}
</script>