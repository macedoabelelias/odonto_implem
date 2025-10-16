<?php 
$tabela = 'odontograma';
require_once("../../../conexao.php");


$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr> 
	<th align="center" width="5%" class="text-center">Selecionar</th>
	<th >Paciente</th>	
	<th >Descrição</th>	
	<th >Data</th>	
	<th >Evolutivo</th>	
	<th >Profissional</th>		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$descricao = $res[$i]['descricao'];
	$paciente = $res[$i]['paciente'];
	$data = $res[$i]['data'];
	$evolutivo = $res[$i]['evolutivo'];
	$funcionario = $res[$i]['funcionario'];

	$dataF = implode('/', array_reverse(@explode('-', $data)));

	$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_funcionario = $res2[0]['nome'];
}else{
	$nome_funcionario = 'Sem Usuário';
}

$query2 = $pdo->query("SELECT * FROM clientes where id = '$paciente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];
}else{
	$nome_cliente = 'Sem Registro';
}


if($evolutivo == 'Sim'){
	$classe_pago = 'bg-primary';	
	
}else{
	$classe_pago = 'bg-danger';
		
}	

		
echo <<<HTML
<tr>
<td align="center">
<div class="custom-checkbox custom-control">
<input type="checkbox" class="custom-control-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
<label for="seletor-{$id}" class="custom-control-label mt-1 text-dark"></label>
</div>
</td>
<td>{$nome_cliente}</td>
<td>{$descricao}</td>
<td>{$dataF}</td>
<td><span class="badge {$classe_pago} me-1 my-2 p-1"><big>{$evolutivo}</big></span></td>
<td>{$nome_funcionario}</td>


<td>
	<big><a class="btn btn-primary-light btn-sm" href="#" onclick="editar('{$id}','{$paciente}', '{$descricao}','{$evolutivo}')" title="Editar Dados"><i class="fa fa-edit "></i></a></big>

	<big><a href="#" class="btn btn-danger-light btn-sm" onclick="excluir('{$id}')" title="Excluir"><i class="fa fa-trash-can "></i></a></big>

		<form   method="POST" action="rel/odontograma_class.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$id}">
					<big><button class="btn btn-danger btn-sm" title="PDF"><i class="fa fa-file-pdf-o "></i></button></big>
					</form>
	
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
	$(document).ready( function () {		
    $('#tabela').DataTable({
    	"language" : {
            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
        "ordering": false,
		"stateSave": true
    });
} );
</script>

<script type="text/javascript">
	function editar(id, paciente, descricao, evolutivo){
		
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#descricao').val(descricao);
    	$('#evolutivo').val(evolutivo).change();
    	$('#cliente').val(paciente).change();

    	setTimeout(function() {
		 listarPermanentes();
			           listarDeciduos();		           
			           limparCamposItens();   
			           limparEstilos();
			           listarItens();	  
		}, 600)

    	
    
    	$('#modalForm').modal('show');
	}



	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#descricao').val('');
    	$('#evolutivo').val('Sim').change();

    	listarClientes();
		listarPermanentes();
		listarDeciduos();	
    

    	$('#ids').val('');
    	$('#btn-deletar').hide();	
	}


	function limparCamposItens(){
		$('#obs').val('');
    	$('#procedimento').val('');    
	}


</script>


<script>
	function selecionar(id) {

		var ids = $('#ids').val();

		if ($('#seletor-' + id).is(":checked") == true) {
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		} else {
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();
		if (ids_final == "") {
			$('#btn-deletar').hide();
		} else {
			$('#btn-deletar').show();
		}
	}



	function deletarSel() {
		//$('#mensagem-excluir').text('Excluindo...')


		$('body').removeClass('timer-alert');
		swal({
			title: "Deseja Excluir?",
			text: "Você não conseguirá recuperá-lo novamente!",
			type: "error",
			showCancelButton: true,
			confirmButtonClass: "btn btn-danger",
			confirmButtonText: "Sim, Excluir!",
			closeOnConfirm: true

		},
			function () {

				//swal("Excluído(a)!", "Seu arquivo imaginário foi excluído.", "success");

				var ids = $('#ids').val();
				var id = ids.split("-");

				for (i = 0; i < id.length - 1; i++) {
					excluirMultiplos(id[i]);
				}

				setTimeout(() => {
                    excluido();
                    listar();
                }, 1000);

				limparCampos();



			});

	}
</script>