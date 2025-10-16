<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
$tabela = 'itens_odo';
require_once("../../../conexao.php");

$id_odo = @$_POST['id'];

if($id_odo == ""){
	$sql_func = " and funcionario = '$id_usuario '";
	
}else{
	$sql_func = " ";	
}

if($id_odo == ""){
	$id_odo = 0;
}


$query = $pdo->query("SELECT * from itens_odo  where odontograma = '$id_odo' $sql_func order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="" >
	<thead> 
	<tr> 	
	<th width="8%">Dente</th>	
	<th>Descrição</th>
	<th>Observações</th>		
	<th width="8%">Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$paciente = $res[$i]['paciente'];
	$data = $res[$i]['data'];
	$dente = $res[$i]['dente'];
	$acao = $res[$i]['acao'];
	$descricao = $res[$i]['descricao'];
	$obs = $res[$i]['obs'];

	if($acao == "carie"){
		$icone_acao = '<i class="fa fa-circle text-danger"></i>';
	}else if($acao == "extraidos"){
		$icone_acao = '<i class="fa fa-square text-dark"></i>';
	}else if($acao == "extrair"){
		$icone_acao = ' <i class="fa fa-close text-dark"></i>';
	}else if($acao == "tratados"){
		$icone_acao = '<i class="fa fa-square text-success"></i>';
	}

		
echo <<<HTML
<tr >

<td style="font-size: 12px !important">
<span>{$icone_acao} {$dente}</span>

<div class="dropdown" style="display: inline-block; margin-left: 10px">                      
                        <a class="" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><img class="icon-rounded-vermelho" src="img/editar.png" width="15px" height="15px"> </a>
                        <div  class="dropdown-menu tx-13">
                        <div style="width: 240px; padding:15px 5px 0 10px; background: #fcfcf2" class="dropdown-item-text">
                        <p>
                        <big><b>Alterar Procedimento:</b></big> <br>

                        <br><a title="Em espera" href="#" onclick="editarItem({$id}, 'carie')"><span style="color:#2a2b29"><i class="fa fa-circle text-danger"></i> Cárie, Canal, outros...</span></a>

                        <br><a title="Em espera" href="#" onclick="editarItem({$id}, 'extraidos')"><span style="color:#2a2b29"><i class="fa fa-square text-dark"></i> Extraído</span></a>

                        <br><a title="Em espera" href="#" onclick="editarItem({$id}, 'extrair')"><span style="color:#2a2b29"><i class="fa fa-close text-dark"></i> Para Extrair</span></a>

                        <br><a title="Em espera" href="#" onclick="editarItem({$id}, 'tratados')"><span style="color:#2a2b29"><i class="fa fa-square text-success"></i> Tratado / Finalizado<</span></a><br>

		
                        </p>
                        </div>
                        </div>
                        </div>

</td>

<td style="font-size: 12px !important">
<input style="border:none; border-bottom:1px solid #000; outline:none; background:transparent; width:100%; " id="descricao_{$id}" value="{$descricao}" onblur="editarItem({$id})">
</td>

<td style="font-size: 12px !important">
<input style="border:none; border-bottom:1px solid #000; outline:none; background:transparent; width:100%; " id="obs_{$id}" value="{$obs}" onblur="editarItem({$id})">
</td>
<td>

<div class="dropdown" style="display: inline-block;">                      
                        <a href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
                        <div  class="dropdown-menu tx-13">
                        <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                        <p>Confirmar Exclusão? <a href="#" onclick="excluirProcedimento('{$id}')"><span class="text-danger">Sim</span></a></p>
                        </div>
                        </div>
                        </div>
	
</td>
</tr>
HTML;

}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
</small>
HTML;

}else{
	echo '<small>Nenhum Registro Encontrado!</small>';
}

?>




<script type="text/javascript">



	function limparCamposItens(){
		$('#obs').val('');
    	$('#procedimento').val('');    
	}


</script>


<script>
	

	function editarItem(id, acao){

		var descricao = $('#descricao_'+id).val();
		var obs = $('#obs_'+id).val();
		
		 $.ajax({
        url: 'paginas/' + pag + "/editar-item.php",
        method: 'POST',
        data: {id, descricao, obs, acao},
        dataType: "html",

        success:function(mensagem){
        	
            if (mensagem.trim() == "Editado com Sucesso") {  
            	 listarPermanentes();
		           listarDeciduos();
                listarItens();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
	}


	function excluirProcedimento(id){
		 $.ajax({
        url: 'paginas/' + pag + "/excluir-item.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {   
             listarPermanentes();
		           listarDeciduos();        	
                listarItens();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
	}
</script>