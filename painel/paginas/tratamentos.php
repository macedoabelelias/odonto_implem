<?php 
$pag = 'tratamentos';
if(@$tratamentos == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual."-".$mes_atual."-01";
if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
	$dia_final_mes = '30';
}else if($mes_atual == '2'){
	$bissexto = date('L', @mktime(0, 0, 0, 1, 1, $ano_atual));
	if($bissexto == 1){
		$dia_final_mes = '29';
	}else{
		$dia_final_mes = '28';
	}
}else{
	$dia_final_mes = '31';
}
$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;
?>


<form action="rel/tratamentos_class.php" method="post" target="_blank" style="margin-top: 15px">
		<div style="float:left; margin-right:35px">
			 <a style="margin-bottom: 10px; margin-top: 5px" class="btn ripple btn-primary text-white <?php echo $inserir_orcamentos ?>" onclick="inserir()" type="button"><i class="fe fe-plus me-2"></i>Tratamento</a>
		</div>
		 <div style="display: inline-block; position:absolute; right:50px; margin-bottom: 10px">
			<button style="width:130px" type="submit" class="btn btn-success ocultar_mobile_app" title="Gerar Relatório"><i class="fa fa-file-pdf-o"></i> Relatório</button>
		</div>
		<div class="esc ocultar_mobile" style="float:left; margin-right:10px"><span><small><i title="Data Inicial" class="fa fa-calendar-o"></i></small></span>
		</div>
		<div class="esc ocultar_mobile" style="float:left; margin-right:20px">
			<input type="date" class="form-control " name="dataInicial"  id="data-ini" value="<?php echo $data_inicio_mes ?>" required onchange="buscar()">
		</div>
		<div class="esc ocultar_mobile" style="float:left; margin-right:10px"><span><small><i title="Data  Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc ocultar_mobile" style="float:left; margin-right:30px">
			<input type="date" class="form-control " name="dataFinal"  id="data-fin" value="<?php echo $data_final_mes ?>" required onchange="buscar()">
		</div>
		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar Operador" class="bi bi-search"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<select class="form-select sel50" aria-label="Default select example" name="prof" id="prof" style="width:200px" onchange="buscar()">
			

				<?php 
				if($nivel_usuario == 'Administrador' || $nivel_usuario == 'Gerente'){
					$query = $pdo->query("SELECT * FROM usuarios where atendimento = 'Sim' order by nome asc");
					echo '<option value="">Selecionar Profissional</option>';
				}else{
					$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' ");
				}
				
				$res = $query->fetchAll(PDO::FETCH_ASSOC);
				for($i=0; $i < @count($res); $i++){
					foreach ($res[$i] as $key => $value){}
						?>	
					<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> </option>
				<?php } ?>			
				
			</select>
		</div>
</form>

<br><br>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
</div>
<input type="hidden" id="ids">




<!-- Modal Perfil -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				 <button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form-tratamento">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">	
							<label>Paciente</label>						
							<select class="form-control sel3" id="paciente" name="paciente" style="width:100%;" onchange="listar()" required> 
								<option value="">Selecione um Paciente</option>
								<?php 
								$query = $pdo->query("SELECT * FROM clientes ORDER BY id desc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$total_reg = @count($res);
								if($total_reg > 0){
									for($i=0; $i < $total_reg; $i++){
										foreach ($res[$i] as $key => $value){}
											echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
									}
								}
								?>
							</select>   
						</div>
						
						
						<div class="col-md-4">							
							<label>Profissional</label>
							<select class="form-control sel3" id="profissional" name="profissional" style="width:100%;" onchange="listar(); mudarFuncionarioModal2();" required=""> 
								<option value="">Selecione um Profissional</option>
								<?php 
								$query = $pdo->query("SELECT * FROM usuarios where atendimento = 'Sim' ORDER BY id desc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$total_reg = @count($res);
								if($total_reg > 0){
									for($i=0; $i < $total_reg; $i++){
										foreach ($res[$i] as $key => $value){}
											echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
									}
								}
								?>
							</select>   						
						</div>
						<div class="col-md-4">							
							<label>Procedimento</label>
							<select class="form-control sel3" id="procedimento" name="procedimento" style="width:100%;" required> 									
									</select>    						
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">							
							<label>Data Inicial</label>
							<input type="date" class="form-control " name="data-inicial"  id="data-inicial" value="<?php echo date('Y-m-d') ?>" >					
						</div>
						<div class="col-md-4">							
							<label>Data Final</label>
							<input type="date" class="form-control " name="data-final"  id="data-final" value="<?php echo date('Y-m-d') ?>">
						</div>
						<div class="col-md-4">							
							<label>Frequencia</label>
							<select class="form-select" name="vezes" id="vezes" onchange="aparecer();">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						
					</div>
					<div  id="listar-vezes">
						
						
					</div>
					
					
					
					<div class="row">
						<div class="col-md-6" style="margin-top: 22px">							
							<button type="submit" class="btn btn-primary">Salvar</button>					
						</div>
						
					</div>
					<input type="hidden" class="form-control" id="id" name="id-tratamento">					
					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalForm2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir_editar"></span></h4>
				 <button id="btn-fechar-5" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<form method="post" id="form-text">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3" id="nasc">						
								<div class="form-group"> 
									<label>Data </label> 
									<input type="date" class="form-control" name="data" id="data-modal" onchange="mudarData()"> 
								</div>						
							</div>
			
							<div class="col-md-4 ">
								<div class="form-group">
									<label>Profissional </label> 			
									<select class="form-control sel18" id="funcionario_modal" name="funcionario" style="width:100%;" onchange="mudarFuncionarioModal()"> 
										<?php if($id_func == ""){ ?>
											<option value="">Selecione um Profissional</option>
											<?php 
											$query = $pdo->query("SELECT * FROM usuarios where atendimento = 'Sim' ORDER BY id desc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){
												for($i=0; $i < $total_reg; $i++){
													foreach ($res[$i] as $key => $value){}
														echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
												}
											}
										}else{
											echo '<option value="'.$id_usuario.'">'.$nome_usuario.'</option>';
										}
										?>
									</select>   
								</div> 	
							</div>
							<div class="col-md-5">						
								<div class="form-group"> 
									<label>OBS <small>(Máx 100 Caracteres)</small></label> 
									<input maxlength="100" type="text" class="form-control" name="obs" id="obs">
								</div>						
							</div>
							
						</div>
						<div class="row" style="display:none">	
							<div class="col-md-3">						
								<div class="form-group"> 
									<label>Procedimento</label> 
									<select class="form-control sel3" id="servico" name="servico" style="width:100%;" required> 									
									</select>    
								</div>						
							</div>
							<div class="col-md-4">						
							<div class="form-group"> 
								<label>Paciente</label> 
								<select class="form-select sel2" name="cliente" id="cliente" style="width:100%;" required>';
									<option value="">Selecionar Paciente</option>
									<?php  
									$query = $pdo->query("SELECT * FROM clientes order by id desc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
									}
									echo '</select>'
									?>
								</div>		
								
							</div>						
							
							<div class="col-md-2 ">
								<div class="form-group">
									<label>Retorno</label> 			
									<select class="form-control" id="retorno" name="retorno"  >
										<option value="Não">Não</option>
										<option value="Sim">Sim</option>
									</select>   
								</div> 	
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12" id="nasc">						
								<div class="form-group"> 								
									<div id="listar-horarios">
										<small>Selecione um Profissional ou um Procedimento</small>
									</div>
								</div>						
							</div>					
						</div>
						<hr>
						<br>
						<input type="hidden" name="id" id="idd">
						<input type="hidden" name="id_trat" id="id_trat">
						<input type="hidden" name="pago_agd" id="pago_agd">
						<input type="hidden" name="tipo_pago_agd" id="tipo_pago_agd">
						<input type="hidden" name="val_agg" id="val_agg">
						<input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo $id_func ?>"> 
						<small><div id="mensagem_editar" align="center" class="mt-3"></div></small>					
					</div>
					<div class="modal-footer">
						<button id="btn_salvar_editar" type="submit" class="btn btn-primary">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>




	<!-- Modal -->
	<div class="modal fade" id="modalServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="procedimento">Baixa no Valor</span></h4>
				 <button id="btn-fechar-servico" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
				
				<form method="post" id="form-servico">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">						
								<div class="form-group"> 
									<label>Funcionário</label> 
									<select class="form-select sel4" id="funcionario_agd" name="funcionario_agd" style="width:100%;" required> 
										<?php 
										$query = $pdo->query("SELECT * FROM usuarios where atendimento = 'Sim' ORDER BY nome asc");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										$total_reg = @count($res);
										if($total_reg > 0){
											for($i=0; $i < $total_reg; $i++){
												foreach ($res[$i] as $key => $value){}
													echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
											}
										}
										?>
									</select>    
								</div>						
							</div>
							<div class="col-md-6" id="nasc">						
								<div class="form-group"> 
									<label>Data PGTO</label> 
									<input type="date" class="form-control" name="data_pgto" id="data_pgto" value="<?php echo $data_atual ?>"> 
								</div>						
							</div>	
						</div>
						<div class="row">
							<div class="col-md-6" id="nasc">						
								<div class="form-group"> 
									<label>Agendamentos Pendentes</label> 
									<input type="text" class="form-control" name="ag_p" id="ag_p" readonly=""> 
								</div>						
							</div>
							<div class="col-md-3" id="nasc">						
								<div class="form-group"> 
									<label>Valor do Serviço </label> 
									<input type="text" class="form-control" name="valor_unit" id="valor_unit"> 
								</div>						
							</div>
							<div class="col-md-3" id="nasc">						
								<div class="form-group"> 
									<label>Valor Total </label> 
									<input type="text" class="form-control" name="valor_serv_agd" id="valor_serv_agd"> 
								</div>						
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Forma PGTO</label> 
									<select class="form-select" id="pgto" name="pgto" style="width:100%;"> 
										<option value="Convênio">Convênio</option>
										<?php 
										$query = $pdo->query("SELECT * FROM formas_pgto");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										$total_reg = @count($res);
										if($total_reg > 0){
											for($i=0; $i < $total_reg; $i++){
												foreach ($res[$i] as $key => $value){}
													echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
											}
										}
										?>
									</select>    
								</div>						
							</div>
							<div class="col-md-8" id="div_convenio">						
								<div class="form-group"> 
									<label>Convênio </label> 
									<select class="form-select" id="convenio" name="convenio" style="width:100%;" onchange="calcularValor()">
										<option value="">Selecione um Convênio</option> 
										<?php 
										$query = $pdo->query("SELECT * FROM convenios");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										$total_reg = @count($res);
										if($total_reg > 0){
											for($i=0; $i < $total_reg; $i++){
												foreach ($res[$i] as $key => $value){}
													echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
											}
										}
										?>
									</select>  
								</div>						
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group"> 
									<label>Número do Convênio</label> 
									<input type="text" class="form-control" name="numero_convenio" id="numero_convenio" placeholder="Número do convênio"> 
								</div>		
							</div>
						</div>
						
						<br>
						<input type="hidden" name="id_tr" id="id_tr"> 
						<input type="hidden" name="vals" id="vals"> 
						<input type="hidden" name="cliente_agd" id="cliente_agd"> 
						<input type="hidden" name="servico_agd" id="servico_agd">
						<input type="hidden" name="descricao_serv_agd" id="descricao_serv_agd">
						<small><div id="mensagem-servico" align="center" class="mt-3"></div></small>					
					</div>
					<div class="modal-footer">
						<button id="btn_salvar_servico" type="submit" class="btn btn-primary">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>



	<!-- Modal Dados-->
	<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content ">
				<div class="modal-content">
				<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">Editar Agendamentos <span style="margin-left: 25px; font-size: 15px"><a title="Dados do Tratamento"></a></span></h4>
				 <button id="btn-fechar-perfil" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
				
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="font-size:13px; font-weight: 400">
							<div style="margin-bottom: 5px; border-bottom:1px solid #cecece; padding-bottom:3px">		
								<span style="margin-right: 20px"><b>Data Inicial</b> <span id="data_i_dados"></span></span>			
								<span style="margin-right: 20px"><b>Data Final</b> <span id="data_f_dados"></span></span>
								<span style=""><b>Procedimento</b> <span id="nome_serv_dados"></span></span>
							</div>
							<div style="margin-bottom: 5px; border-bottom:1px solid #cecece; padding-bottom:3px">	
								<span style="margin-right: 20px"><b>Profissional</b> <span id="nome_func_dados"></span></span>
								<span style="margin-right: 20px"><b>Valor</b> <span id="valor_dados"></span></span>			
							</div>
						</div>
					</div>
							<div id="listar_agd" style="overflow: scroll; max-height:400px; scrollbar-width: thin;">
							</div>
							<input type="hidden" name="id_tr" id="id_trt">
							<input type="hidden" name="id_con" id="id_con">
						
					
					<small><div id="mensagem-historico"></div></small>		
				
			</div>
		</div>
	</div>
</div>
</div>
<input type="hidden" name="data_agenda" id="data_agenda" value="<?php echo date('Y-m-d') ?>"> 




<script type="text/javascript">
	$(document).ready(function() {
		aparecer()
		
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});
		$('.sel50').select2({
			//dropdownParent: $('#modalForm')
		});
		$('.sel18').select2({
			dropdownParent: $('#modalForm2')
		});
	});
</script>
<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>
<script type="text/javascript">
	
	function mudarFuncionarioModal(){	
		var func = $('#funcionario_modal').val();	
		buscar();
		listarHorarios();
		listarServicos(func);
	}
</script>
<script type="text/javascript">
	function listarHorarios(hora){
		var funcionario = $('#funcionario_modal').val();		
		var data = $('#data_agenda').val();	
		$.ajax({
			url: 'paginas/' + pag + "/listar-horarios.php",
			method: 'POST',
			data: {funcionario, data, hora},
			dataType: "html",
			success:function(result){
				
				$("#listar-horarios").html(result);
			}
		});
	}
	function listarServicos(func){	
		var serv = $("#servico").val();
		
		$.ajax({
			url: 'paginas/' + pag +  "/listar-servicos.php",
			method: 'POST',
			data: {func},
			dataType: "text",
			success:function(result){
				$("#servico").html(result);
			}
		});
	}
</script>
<script type="text/javascript">
	
	function mudarData(){
		var data = $('#data-modal').val();			
		$('#data_agenda').val(data).change();
		buscar();
		listarHorarios();
	}
</script>
<script type="text/javascript">
	function listarPacientes(valor){
		$.ajax({
			url: 'paginas/' + pag + "/listar_pacientes.php",
			method: 'POST',
			data: {valor},
			dataType: "html",
			success:function(result){
				$("#listar_pacientes").html(result);           
			}
		});
	}
	function abrirModal(hora){
		listarHorarios(hora);
		inserir();
	}
</script>
<script type="text/javascript">
	function inserir2(){   
		$('#mensagem').text('');
		$('#titulo_inserir').text('Inserir Registro');
		$('#modalForm').modal('show');
		limparCampos();
		aparecer();
	}
	$("#form-servico").submit(function () {
		event.preventDefault();
		
		var formData = new FormData(this);
		var convenio = $('#convenio').val();
		var pgto = $('#pgto').val();
		var comi = $('#comi').val();
		if (convenio != '' && comi != '' ) {
			alert('Comissao so pode ser selecionada se nao houver Convenio');
			exit();
		}
		if(pgto == "Convênio" && convenio == ""){
			alert("Selecione um Convênio ou uma forma de pagamento");
			return;
		}
		$.ajax({
			url: 'paginas/' + pag +  "/baixar-todos.php",
			type: 'POST',
			data: formData,
			success: function (mensagem) {
				$('#mensagem-servico').text('');
				$('#mensagem-servico').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {                    
					$('#btn-fechar-servico').click();
					buscar();
				} else {
					$('#mensagem-servico').addClass('text-danger')
					$('#mensagem-servico').text(mensagem)
				}
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	});
	function aparecer(){
		var vezes =  $("#vezes").val();
		$.ajax({
			url: 'paginas/' + pag + "/aparecer.php",
			method: 'POST',
			data: {vezes},
			dataType: "html",
			success:function(result){
				$("#listar-vezes").html(result);
			}
		});
	}
	function listar_agd(){
		
		var id_tr = $("#id_trt").val();
		$.ajax({
			url: 'paginas/' + pag + "/listar-agd.php",
			method: 'POST',
			data: {id_tr},
			dataType: "html",
			success:function(result){
				$("#listar_agd").html(result);
			}
		});
	}
</script>
<script>
	$("#form-tratamento").submit(function () {
		event.preventDefault();
		
		var formData = new FormData(this);
		$.ajax({
			url: 'paginas/' + pag +  "/inserir-tratamento.php",
			type: 'POST',
			data: formData,
			success: function (mensagem) {
				//alert(mensagem)
				
				$('#mensagem').text('');
				$('#mensagem').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {                    
					$('#btn-fechar').click();
					sucesso();
					buscar();
					listarHorarios();
				} else {
					$('#mensagem').addClass('text-danger')
					$('#mensagem').text(mensagem)
				}
				$('#btn_salvar').show();
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	});
</script>
<script>
	$("#form-text").submit(function () {
		$('#mensagem_editar').text('Carregando...');
		$('#btn_salvar_editar').hide();
		event.preventDefault();	
		var formData = new FormData(this);
		$.ajax({
			url: 'paginas/agendamentos/inserir.php',
			type: 'POST',
			data: formData,
			success: function (mensagem) {				
				$('#mensagem_editar').text('');
				$('#mensagem_editar').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {  
					$('#btn-fechar-5').click();					
					buscar();
					listarHorarios();
				} else {
					$('#mensagem_editar').addClass('text-danger')
					$('#mensagem_editar').text(mensagem)
				}
				$('#btn_salvar_editar').show();
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	});
</script>
<script type="text/javascript">
	
	function mudarFuncionarioModal2(){	
		var func = $('#profissional').val();		
		listarServicos2(func);
	}
	function listarServicos2(func){					
		$.ajax({
			url: 'paginas/' + pag +  "/listar-servicos.php",
			method: 'POST',
			data: {func},
			dataType: "text",
			success:function(result){
				
				$("#procedimento").html(result);
			}
		});
	}
	function buscar(){
		var dataInicial = $('#data-ini').val();
		var dataFinal = $('#data-fin').val();
		var prof = $('#prof').val();
		listar(dataInicial, dataFinal, prof);
	}
</script>
