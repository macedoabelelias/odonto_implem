<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
require_once("../../../conexao.php");
$tabela = 'receita';
$data_hoje = date('Y-m-d');
$id_pac = @$_POST['id'];


$query = $pdo->query("SELECT * FROM $tabela where paciente = '$id_pac' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){	
	$id = $res[$i]['id'];
	$remedio = $res[$i]['remedio'];
	$quantidade = $res[$i]['quantidade'];
	$uso = $res[$i]['uso'];
	
echo <<<HTML
	<div style="margin-top:10px">
	<span style="color:#096385; font-size: 15px"><i class="fa fa-check text-success"></i><b>{$remedio}</b>  --------------- {$quantidade} / <i> 
    <span style="color:#360202; font-size: 15px">({$uso})</span></i></span>

        <div class="dropdown head-dpdn2" style="display: inline-block;">                      
            <a tittle="Remover Descrição" href="#"  class="dropdown-toggle"  data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-times text-danger"></i> </a>

            <div  class="dropdown-menu tx-13">
                <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                    <p>Confirmar Exclusão? <a href="#" onclick="excluirRemedio('{$id}', '{$id_pac}')">
                        <span class="text-danger">Sim</span></a></p>
                </div>
            </div>
        </div>       
        
	
	</div>
HTML;
	}
}else{
	echo '<small>Nenhum Medicamento Lançado!</small>';
}
?>
<script type="text/javascript">
	function excluirRemedio(id, paciente){	
        
    $.ajax({
        url: 'paginas/consultas/excluir_remedio.php',
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(mensagem){
             
            if (mensagem.trim() == "Excluído com Sucesso") {  
                listarRemedios(paciente);
                limparCamposRemedio();
            } 
        }
    });
}
</script>