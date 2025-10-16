<?php 
$pag = 'grupos_ana';
if(@$grupos_ana == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
    exit();
}
 ?>



<div class="breadcrumb-header justify-content-between">
	<div class="left-content mt-2">
		<a class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-1"></i>
			Adicionar Grupos Anamnese</a>




<big><a class="btn btn-danger" href="#" onclick="deletarSel()" title="Excluir" id="btn-deletar" style="display:none"><i class="fe fe-trash-2"></i> Deletar</a></big>

	</div>

</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
</div>
<input type="hidden" id="ids">


<!-- Modal Perfil -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form">
			<div class="modal-body">
				
					<div class="row">
						<div class="col-md-12">							
								<label>Nome</label>
								<input maxlength="255" type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Grupo" required>	
						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">							
							
								<label>Descrição</label>
								<input maxlength="2000" type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição se Houver" >							
						</div>
						
						
					</div>
			
					<input type="hidden" class="form-control" id="id" name="id">					
				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>
