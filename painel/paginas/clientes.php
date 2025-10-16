<?php
$pag = 'clientes';

//verificar se ele tem a permissão de estar nessa página
if (@$clientes == 'ocultar') {
	echo "<script>window.location='index'</script>";
	exit();
}
?>



<div class="breadcrumb-header justify-content-between">
	<div class="left-content mt-2">
		<a class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-user-plus me-1"></i>
			Adicionar Pacientes</a>


<a style="position:absolute; right:40px;" href="rel/excel_clientes.php" type="button"
			class="btn btn-success ocultar_mobile_app" target="_blank"><span class="fa fa-file-excel-o"></span> Exportar</a>

<a class="btn btn-danger" href="#" onclick="deletarSel()" title="Excluir" id="btn-deletar"
				style="display:none"><i class="fe fe-trash-2"></i> Deletar</a>

		

	</div>

</div>


<div class="row row-sm">
	<div class="col-lg-12">
		<div class="card custom-card">
			<div class="card-body" id="listar">

			</div>
		</div>
	</div>
</div>


<input type="hidden" id="ids">

<!-- Modal Cliente -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form">
				<div class="modal-body ">


					<div class="row">
						<div class="col-md-6 mb-2 col-6 needs-validation was-validated">
							<label>Nome <span class="text-danger" style="font-size: 9px">(Obrigatório)</span></label>
							<div class="form-group has-success mg-b-0">
								<input class="form-control" id="nome" name="nome" placeholder="Digite o Nome" required type="text"
									value="This is input">
							</div>
						</div>

						<div class="col-md-3 col-6">
							<label>Telefone</label>
							<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone">
						</div>

						<div class="col-md-3 mb-2">
							<label>Nascimento</label>
							<input type="date" class="form-control" id="data_nasc" name="data_nasc" placeholder="">
						</div>


					</div>



					<div class="row">

						<div class="col-md-3 mb-2 col-6">
							<label>Pessoa</label>
							<select name="tipo_pessoa" id="tipo_pessoa" class="form-select" onchange="mudarPessoa()">
								<option value="Física">Física</option>
								<option value="Jurídica">Jurídica</option>
							</select>
						</div>

						<div class="col-md-3 mb-2 col-6">
							<label>CPF / CNPJ</label>
							<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
						</div>

						<div class="col-md-1 col-1" style="margin-top: 28px; margin-left: -10px">
							<a title="Buscar CNPJ" class="btn btn-primary" href="#" onclick="buscarCNPJ()" class="btn btn-primary"> <i
									class="bi bi-search"></i> </a>
						</div>



						<div class="col-md-5">
							<label>Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Digite o Email">
						</div>


					</div>

					<div class="row">

						<div class="col-md-2 mb-2">
							<label>CEP</label>
							<input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP"
								onblur="pesquisacep(this.value);">
						</div>



						<div class="col-md-5 mb-2">
							<label>Rua</label>
							<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Ex. Rua Central">
						</div>

						<div class="col-md-2 mb-2">
							<label>Número</label>
							<input type="text" class="form-control" id="numero" name="numero" placeholder="1500">
						</div>

						<div class="col-md-3 mb-2">
							<label>Complemento</label>
							<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Bloco B AP 104">
						</div>


					</div>


					<div class="row">

						<div class="col-md-4 mb-2">
							<label>Bairro</label>
							<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
						</div>

						<div class="col-md-5 mb-2">
							<label>Cidade</label>
							<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
						</div>

						<div class="col-md-3 mb-2">
							<label>Estado</label>
							<select class="form-select" id="estado" name="estado">
								<option value="">Selecionar</option>
								<option value="AC">Acre</option>
								<option value="AL">Alagoas</option>
								<option value="AP">Amapá</option>
								<option value="AM">Amazonas</option>
								<option value="BA">Bahia</option>
								<option value="CE">Ceará</option>
								<option value="DF">Distrito Federal</option>
								<option value="ES">Espírito Santo</option>
								<option value="GO">Goiás</option>
								<option value="MA">Maranhão</option>
								<option value="MT">Mato Grosso</option>
								<option value="MS">Mato Grosso do Sul</option>
								<option value="MG">Minas Gerais</option>
								<option value="PA">Pará</option>
								<option value="PB">Paraíba</option>
								<option value="PR">Paraná</option>
								<option value="PE">Pernambuco</option>
								<option value="PI">Piauí</option>
								<option value="RJ">Rio de Janeiro</option>
								<option value="RN">Rio Grande do Norte</option>
								<option value="RS">Rio Grande do Sul</option>
								<option value="RO">Rondônia</option>
								<option value="RR">Roraima</option>
								<option value="SC">Santa Catarina</option>
								<option value="SP">São Paulo</option>
								<option value="SE">Sergipe</option>
								<option value="TO">Tocantins</option>
								<option value="EX">Estrangeiro</option>
							</select>
						</div>


					</div>


					<div class="row">
						<div class="col-md-3 mb-2">
							<label>Tipo Sanguíneo</label>
							<input type="text" class="form-control" id="tipo_sanguineo" name="tipo_sanguineo" placeholder="Tipo Sanguineo">
						</div>

						<div class="col-md-2 mb-2">
							<label>Sexo</label>
							<select class="form-select" id="sexo" name="sexo">
								<option value="M">Masculino</option>
								<option value="F">Feminino</option>								
							</select>
						</div>

						<div class="col-md-4 mb-2">
							<label>Profissão</label>
							<input type="text" class="form-control" id="profissao" name="profissao" placeholder="Tipo Sanguineo">
						</div>

						<div class="col-md-3 mb-2">
							<label>Estado Civil</label>
							<select class="form-select" id="estado_civil" name="estado_civil">
								<option value="Solteiro(a)">Solteiro(a)</option>
								<option value="Casado(a)">Casado(a)</option>		
								<option value="Divorciado(a)">Divorciado(a)</option>		
								<option value="Viúvo(a)">Viúvo(a)</option>								
							</select>
						</div>
					</div>


					<div class="row">
						<div class="col-md-2 mb-2">
							<label>Convênio</label>
							<select class="form-select" name="convenio" id="convenio">
									<option value="0">Nenhum</option>
									<?php 
									$query = $pdo->query("SELECT * from convenios order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
										for($i=0; $i<$linhas; $i++){
											?>
											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
										<?php } } ?>
									</select>	
						</div>

							<div class="col-md-4 mb-2">
							<label>Responsável</label>
							<input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel" placeholder="Se Houver preencha">
						</div>


						<div class="col-md-3 mb-2">
							<label>CPF Responsável</label>
							<input type="text" class="form-control" id="cpf_responsavel" name="cpf_responsavel" placeholder="CPF Resposnável">
						</div>

						<div class="col-md-3 mb-2">
							<label>Telefone 2</label>
							<input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="Outro Telefone">
						</div>
					</div>



					<div class="row">						
						<div class="col-md-12 mb-2">
							<label>Observações</label>
							<input type="text" class="form-control" id="obs" name="obs" placeholder="Observações">
						</div>
					</div>


					<input type="hidden" class="form-control" id="id" name="id">

					<br>
					<small>
						<div id="mensagem" align="center"></div>
					</small>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btn_salvar" class="btn btn-primary" value="">Salvar<i
							class="fa fa-check ms-2"></i></button>

					<button class="btn btn-primary" type="button" id="btn_carregando">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...
					</button>

				</div>
			</form>
		</div>
	</div>
</div>






<!-- Modal Dados-->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document" style="width:85%">
		<div class="modal-content ">
			<div class="modal-header ">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_dados"></span>
					<span style="margin-left: 25px; font-size: 15px"><a title="PDF da Ficha Paciente" href="" onclick="ficha()"><i class="fa fa-file-pdf-o text-danger"></i> Imprimir Ficha</a></span>
				</h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			
			
			<div class="modal-body">
				<div class="row">
					<div class="col-md-7" style="font-size:13px; font-weight: 400">
						<div style="margin-bottom: 5px; border-bottom:1px solid #cecece; padding-bottom:3px">		
							<span style="margin-right: 20px"><b>Idade</b> <span id="idade_dados"></span></span>			
						<span style="margin-right: 20px"><b>Telefone</b> <span id="telefone_dados"></span></span>
						<span style=""><b>Nascimento</b> <span id="data_nasc_dados"></span></span>
						</div>
						<div style="margin-bottom: 5px; border-bottom:1px solid #cecece; padding-bottom:3px">			
							<span style="margin-right: 20px"><b>Tipo Sanguíneo</b> <span id="tipo_dados"></span></span>			
						<span style="margin-right: 20px"><b>Sexo</b> <span id="sexo_dados"></span></span>
						<span style=""><b>Convênio</b> <span id="convenio_dados"></span></span>
						</div>
						<div style="margin-bottom: 5px; border-bottom:1px solid #cecece; padding-bottom:3px">			
							<span id="responsavel_div" style="margin-right: 20px"><b>Responsável</b> <span id="responsavel_dados"></span></span>							
						<span id="obs_div" style="margin-right: 20px"><b>OBS</b> <span id="obs_dados"></span></span>
						
						</div>
						<div style="margin-bottom: 5px; border-bottom:1px solid #cecece; padding-bottom:3px">		
							<span style="margin-right: 20px"><b>Endereço</b> <span id="endereco_dados"></span></span>
						
						</div>
							<div style="margin-bottom: 5px; border-bottom:1px solid #cecece; padding-bottom:3px">		
							<span style="margin-right: 20px"><b>Estado Cívil</b> <span id="estado_civil_dados"></span></span>
							<span style="margin-right: 20px"><b>Profissão</b> <span id="profissao_dados"></span></span>
						
						</div>
						<div style="margin-top: 15px; margin-bottom: 5px; border-bottom: 1px solid #000"><b>ANAMNESE</b></div>
						<div id="listar_ana_pac" style="margin-top:5px">
							
						</div>
					</div>	
					<div class="col-md-5" style="border-left: 1px solid #242323; font-size:13px; font-weight: 400" >							
						<b>Histório Clínico</b>	
						<div id="historico_div" style="overflow: scroll; max-height:300px; scrollbar-width: thin; padding:2px">
						</div>
						<form id="form-historico">
						<div class="row">
							
							<div class="col-md-10">
							<textarea maxlength="2000" name="historico" id="historico" class="form-control" required></textarea>
							</div>
							<div class="col-md-2" style="margin-top: 40px">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></button>
							</div>
							<input type="hidden" name="id_pac" id="id_pac">
							<input type="hidden" name="id_con" id="id_con">
							
						</div>
						</form>
						<small><div id="mensagem-historico"></div></small>		
					</div>
				</div>

				

			</div>
			
		</div>
	</div>
</div>




<!-- Modal Arquivos -->
<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
				<button id="btn-fechar-arquivos" aria-label="Close" class="btn-close" data-bs-dismiss="modal"
					type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form-arquivos" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Arquivo</label>
								<input class="form-control" type="file" name="arquivo_conta" onChange="carregarImgArquivos();"
									id="arquivo_conta">
							</div>
						</div>
						<div class="col-md-4">
							<div id="divImgArquivos">
								<img src="images/arquivos/sem-foto.png" width="60px" id="target-arquivos">
							</div>
						</div>




					</div>

					<div class="row">
						<div class="col-md-8">
							<input type="text" class="form-control" name="nome-arq" id="nome-arq" placeholder="Nome do Arquivo * "
								required>
						</div>

						<div class="col-md-4">
							<button type="submit" class="btn btn-primary">Inserir</button>
						</div>
					</div>

					<hr>

					<small>
						<div id="listar-arquivos"></div>
					</small>

					<br>
					<small>
						<div align="center" id="mensagem-arquivo"></div>
					</small>

					<input type="hidden" class="form-control" name="id-arquivo" id="id-arquivo">


				</div>
			</form>
		</div>
	</div>
</div>







<!-- Modal Contas -->
<div class="modal fade" id="modalContas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_contas"></span></h4>
				<button id="btn-fechar-contas" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">
				<div id="listar_debitos" style="margin-top: 15px">

				</div>
				<input type="hidden" id="id_contas">
			</div>

		</div>
	</div>
</div>






<!-- Modal Baixar-->
<div class="modal fade" id="modalBaixar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal">Baixar Conta: <span id="descricao-baixar"> </span></h4>
				<button id="btn-fechar-baixar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form-baixar" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label>Valor <small class="text-muted">(Total ou Parcial)</small></label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-baixar" id="valor-baixar"
									required>
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label>Forma PGTO</label>
								<select class="form-select" name="saida-baixar" id="saida-baixar" required onchange="calcularTaxa()">
									<?php
									$query = $pdo->query("SELECT * FROM formas_pgto order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for ($i = 0; $i < @count($res); $i++) {
										foreach ($res[$i] as $key => $value) {
										}

										?>
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
							</div>
						</div>

					</div>


					<div class="row">


						<div class="col-md-3">
							<div class="mb-3">
								<label>Multa em R$</label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-multa" id="valor-multa"
									placeholder="Ex 15.00" value="0">
							</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
								<label>Júros em R$</label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-juros" id="valor-juros"
									placeholder="Ex 0.15" value="0">
							</div>
						</div>

						<div class="col-md-3">
							<div class="mb-3">
								<label>Desconto R$</label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-desconto" id="valor-desconto"
									placeholder="Ex 15.00" value="0">
							</div>
						</div>



						<div class="col-md-3">
							<div class="mb-3">
								<label>Taxa PGTO</label>
								<input onkeyup="totalizar()" type="text" class="form-control" name="valor-taxa" id="valor-taxa"
									placeholder="" value="">
							</div>
						</div>

					</div>


					<div class="row">

						<div class="col-md-6">
							<div class="mb-3">
								<label>Data da Baixa</label>
								<input type="date" class="form-control" name="data-baixar" id="data-baixar"
									value="<?php echo date('Y-m-d') ?>">
							</div>
						</div>


						<div class="col-md-6">
							<div class="mb-3">
								<label>SubTotal</label>
								<input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
							</div>
						</div>
					</div>




					<small>
						<div id="mensagem-baixar" align="center"></div>
					</small>

					<input type="hidden" class="form-control" name="id-baixar" id="id-baixar">


				</div>
				<div class="modal-footer">

					<button type="submit" class="btn btn-success" id="btn_salvar_baixar">Baixar</button>

					<button class="btn btn-success" type="button" id="btn_carregando_baixar" style="display: none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...
					</button>
				</div>
			</form>
		</div>
	</div>
</div>





<!-- Modal ficha -->
<div class="modal fade" id="modalFicha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal"> <span id="nome_ficha"> </span></h4>
				<button id="btn-fechar-ficha" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="rel/ficha_class.php" target="_blank">
			<div class="modal-body">
				<div class="row">
						<div class="col-md-6">	
								<label>Mostrar Histórico</label>
								<select class="form-select" name="historico">
									<option value="1000">Tudo</option>
									<option value="5">5 Últimos</option>
									<option value="10">10 Últimos</option>
									<option value="20">20 Últimos</option>
									<option value="Não">Nenhum</option>
								</select>						
							</div>	
							<div class="col-md-6">	
								<label>Mostrar Anamnese</label>
								<select class="form-select" name="anamnese">
									<option value="">Mostrar em duas Colunas</option>
									<option value="1">Mostrar em uma Coluna</option>
									<option value="Não">Não Mostrar</option>
								</select>						
							</div>	
				</div>

				<div class="row">
					<div class="col-md-12 col-5" id="">							
							<label>Odontograma</label>
							<div id="listar_odontogramas">
								
							</div>
														
						</div>					
						
				</div>

				<br>
				<input type="hidden" name="id" id="id_ficha">
				<small><div id="mensagem_ficha" align="center" class="mt-3"></div></small>		
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Gerar Ficha</button>
			</div>
			</form>		
		</div>
	</div>
</div>





<!-- Modal Anamnese -->
<div class="modal fade" id="modalAnamnese" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_permissoes"></span></h4>
				<button id="btn-fechar-ana" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">
				<div class="" id="listar_ana" style="margin-left: 10px; font-family: Red/Black, sans-serif; font-weight: 400">
					
				</div>
				<br>
				<input type="hidden" name="id" id="id_pac_ana">
				<small><div id="mensagem_ana" align="center" class="mt-3"></div></small>		
			</div>
			<div class="modal-footer">       
				<button data-dismiss="modal" type="" class="btn btn-primary">Salvar</button>
			</div>
					
		</div>
	</div>
</div>




<!-- Modal consultas -->
<div class="modal fade" id="modalConsultas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_consulta"></span></h4>
				<button id="btn-fechar-consulta" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">
				<div id="listar_consultas"></div>
			</div>
			
		</div>
	</div>
</div>


<script type="text/javascript">var pag = "<?= $pag ?>"</script>
<script src="js/ajax.js"></script>




<script type="text/javascript">
	function mudarPessoa() {
		var pessoa = $('#tipo_pessoa').val();
		if (pessoa == 'Física') {
			$('#cpf').mask('000.000.000-00');
			$('#cpf').attr("placeholder", "Insira CPF");
		} else {
			$('#cpf').mask('00.000.000/0000-00');
			$('#cpf').attr("placeholder", "Insira CNPJ");
		}
	}
</script>







<div class="modal fade" id="modalOdontograma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">Odontograma Evolutivo <span id="nome_odontograma"></span></h4>
				<button id="btn-fechar_odo" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form_odo">
				<div class="modal-body">

					<div class="row" style="margin-top: 20px">
						
						<div class="col-md-5">							
							<label>Paciente</label>
							<div id="listar_clientes">

							</div>							
						</div>
					

						<div class="col-md-5 col-6">
							<label>Descrição</label>
							<input maxlength="100" type="text" class="form-control" id="descricao" name="descricao" placeholder="Odontograma Evolutivo, Orçamento CLiente, etc" required="">
						</div>


							<div class="col-md-2 mb-2 col-6">
							<label>Evolutivo</label>
							<select name="evolutivo" id="evolutivo" class="form-select">
								<option value="Sim">Sim</option>
								
							</select>
						</div>

					

					</div>


					<div class="row">

						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item" role="presentation">
						    <button onclick="listarPermanentes()" class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Permanentes</button>
						  </li>
						  <li class="nav-item" role="presentation">
						    <button onclick="listarDeciduos()" class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Decíduos</button>
						  </li>
						 
						</ul>

						<div class="tab-content" id="myTabContent">

						  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						  	<div id="listar_permanentes">
						  		
						  	</div>
						  </div>

						  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						 <div id="listar_deciduos">
						  		
						  	</div>
						</div>
						  

						</div>



						


	
					</div>


					<div class="row">

						<div class="col-md-1 mb-2 col-6">
							<label>Dente</label>
							<select name="dente" id="dente" class="form-select">
								<option value="18">18</option>
								<option value="17">17</option>
								<option value="16">16</option>
								<option value="15">15</option>
								<option value="14">14</option>
								<option value="13">13</option>
								<option value="12">12</option>
								<option value="11">11</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="48">48</option>
								<option value="47">47</option>
								<option value="46">46</option>
								<option value="45">45</option>
								<option value="44">44</option>
								<option value="43">43</option>
								<option value="42">42</option>
								<option value="41">41</option>
								<option value="31">31</option>
								<option value="32">32</option>
								<option value="33">33</option>
								<option value="34">34</option>
								<option value="35">35</option>
								<option value="36">36</option>
								<option value="37">37</option>
								<option value="38">38</option>
								<hr>

								<option value="55">55</option>
								<option value="54">54</option>
								<option value="53">53</option>
								<option value="52">52</option>
								<option value="51">51</option>
								<option value="61">61</option>
								<option value="62">62</option>
								<option value="63">63</option>
								<option value="64">64</option>
								<option value="65">65</option>
								<option value="85">85</option>
								<option value="84">84</option>
								<option value="83">83</option>
								<option value="82">82</option>
								<option value="81">81</option>
								<option value="71">71</option>
								<option value="72">72</option>
								<option value="73">73</option>
								<option value="74">74</option>
								<option value="75">75</option>
							</select>
						</div>

						<div class="col-md-2 mb-2 col-6">
							<label>Ação</label>
							<select name="acao" id="acao" class="form-select">								
								<option value="carie">Cárie, Canal, outros...</option>
								<option value="extraidos">Extraído</option>
								<option value="extrair">Para Extrair</option>
								<option value="tratados">Tratado / Finalizado</option>
							</select>
						</div>


						<div class="col-md-4 col-6">
							<label>Descrever Procedimento</label>
							<input maxlength="100" type="text" class="form-control" id="procedimento" name="procedimento" placeholder="Restauração dente Face Mesial e Face Oclusal">
						</div>

						<div class="col-md-4 col-6">
							<label>Observação Procedimento</label>
							<input maxlength="255" type="text" class="form-control" id="obs" name="obs" placeholder="Alguma observação adicional">
						</div>

						<div class="col-md-1" style="margin-top: 27px; padding:0">
							<button title="Inserir" onclick="inserirItem()" type="button" class="btn btn-success"> <i class="fa fa-check"></i> </button>	
						</div>


					</div>


					<div id="listar_itens">
						
					</div>

					


					<input type="hidden" class="form-control" id="id_odo" name="id">


					<br>
					<small>
						<div id="mensagem_odo" align="center"></div>
					</small>
				</div>


				<div class="modal-footer">
					<button type="submit" id="btn_salvar_odo" class="btn btn-primary" value="">Salvar<i
							class="fa fa-check ms-2"></i></button>

				

				</div>

			</form>
		</div>
	</div>
</div>



<div style="display:none">
	<form action="rel/odontograma_class.php" method="POST" target="_blank">
		<input type="hidden" name="id" id="id_relatorio">
		<button type="submit" id="btn_relatorio"></button>
	</form>
</div>





<script type="text/javascript">
	$("#form-arquivos").submit(function () {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/arquivos.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-arquivo').text('');
				$('#mensagem-arquivo').removeClass()
				if (mensagem.trim() == "Inserido com Sucesso") {
					//$('#btn-fechar-arquivos').click();
					$('#nome-arq').val('');
					$('#arquivo_conta').val('');
					$('#target-arquivos').attr('src', 'images/arquivos/sem-foto.png');
					listarArquivos();
				} else {
					$('#mensagem-arquivo').addClass('text-danger')
					$('#mensagem-arquivo').text(mensagem)
				}

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>

<script type="text/javascript">
	function listarArquivos() {
		var id = $('#id-arquivo').val();
		$.ajax({
			url: 'paginas/' + pag + "/listar-arquivos.php",
			method: 'POST',
			data: { id },
			dataType: "text",

			success: function (result) {
				$("#listar-arquivos").html(result);
			}
		});
	}

</script>




<script type="text/javascript">
	function carregarImgArquivos() {
		var target = document.getElementById('target-arquivos');
		var file = document.querySelector("#arquivo_conta").files[0];

		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);

		if (resultado[1] === 'pdf') {
			$('#target-arquivos').attr('src', "images/pdf.png");
			return;
		}

		if (resultado[1] === 'rar' || resultado[1] === 'zip') {
			$('#target-arquivos').attr('src', "images/rar.png");
			return;
		}

		if (resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt') {
			$('#target-arquivos').attr('src', "images/word.png");
			return;
		}


		if (resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls') {
			$('#target-arquivos').attr('src', "images/excel.png");
			return;
		}


		if (resultado[1] === 'xml') {
			$('#target-arquivos').attr('src', "images/xml.png");
			return;
		}



		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>


<script type="text/javascript">
	function totalizar() {
		valor = $('#valor-baixar').val();
		desconto = $('#valor-desconto').val();
		juros = $('#valor-juros').val();
		multa = $('#valor-multa').val();
		taxa = $('#valor-taxa').val();

		valor = valor.replace(",", ".");
		desconto = desconto.replace(",", ".");
		juros = juros.replace(",", ".");
		multa = multa.replace(",", ".");
		taxa = taxa.replace(",", ".");

		if (valor == "") {
			valor = 0;
		}

		if (desconto == "") {
			desconto = 0;
		}

		if (juros == "") {
			juros = 0;
		}

		if (multa == "") {
			multa = 0;
		}

		if (taxa == "") {
			taxa = 0;
		}

		subtotal = parseFloat(valor) + parseFloat(juros) + parseFloat(taxa) + parseFloat(multa) - parseFloat(desconto);


		console.log(subtotal)

		$('#subtotal').val(subtotal);

	}

	function calcularTaxa() {
		pgto = $('#saida-baixar').val();
		valor = $('#valor-baixar').val();
		$.ajax({
			url: 'paginas/receber/calcular_taxa.php',
			method: 'POST',
			data: { valor, pgto },
			dataType: "html",

			success: function (result) {
				$('#valor-taxa').val(result);
				totalizar();
			}
		});


	}
</script>




<script type="text/javascript">
	$("#form-baixar").submit(function () {

		$('#btn_salvar_baixar').hide();
		$('#btn_carregando_baixar').show();

		event.preventDefault();
		var formData = new FormData(this);

		var id = $('#id_contas').val();

		$.ajax({
			url: 'paginas/receber/baixar.php',
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem-baixar').text('');
				$('#mensagem-baixar').removeClass()
				if (mensagem.trim() == "Baixado com Sucesso") {
					$('#btn-fechar-baixar').click();
					listarDebitos(id);

				} else {
					$('#mensagem-baixar').addClass('text-danger')
					$('#mensagem-baixar').text(mensagem)
				}

				$('#btn_salvar_baixar').show();
				$('#btn_carregando_baixar').hide();

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>





<script>

	function limpa_formulário_cep() {
		//Limpa valores do formulário de cep.
		document.getElementById('endereco').value = ("");
		document.getElementById('bairro').value = ("");
		document.getElementById('cidade').value = ("");
		document.getElementById('estado').value = ("");
		//document.getElementById('ibge').value=("");
	}

	function meu_callback(conteudo) {
		if (!("erro" in conteudo)) {
			//Atualiza os campos com os valores.
			document.getElementById('endereco').value = (conteudo.logradouro);
			document.getElementById('bairro').value = (conteudo.bairro);
			document.getElementById('cidade').value = (conteudo.localidade);
			document.getElementById('estado').value = (conteudo.uf);
			//document.getElementById('ibge').value=(conteudo.ibge);
		} //end if.
		else {
			//CEP não Encontrado.
			limpa_formulário_cep();
			alert("CEP não encontrado.");
		}
	}

	function pesquisacep(valor) {

		//Nova variável "cep" somente com dígitos.
		var cep = valor.replace(/\D/g, '');

		//Verifica se campo cep possui valor informado.
		if (cep != "") {

			//Expressão regular para validar o CEP.
			var validacep = /^[0-9]{8}$/;

			//Valida o formato do CEP.
			if (validacep.test(cep)) {

				//Preenche os campos com "..." enquanto consulta webservice.
				document.getElementById('endereco').value = "...";
				document.getElementById('bairro').value = "...";
				document.getElementById('cidade').value = "...";
				document.getElementById('estado').value = "...";
				//document.getElementById('ibge').value="...";

				//Cria um elemento javascript.
				var script = document.createElement('script');

				//Sincroniza com o callback.
				script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

				//Insere script no documento e carrega o conteúdo.
				document.body.appendChild(script);

			} //end if.
			else {
				//cep é inválido.
				limpa_formulário_cep();
				alert("Formato de CEP inválido.");
			}
		} //end if.
		else {
			//cep sem valor, limpa formulário.
			limpa_formulário_cep();
		}
	};

</script>



<script>
	function buscarCNPJ() {

		var cnpj = $('#cpf').val().replace(/\D/g, ''); // Remover tudo que não for número
		if (cnpj.length === 14) { // Verifica se o CNPJ tem 14 dígitos
			$.ajax({
				url: 'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
				type: 'GET',
				dataType: 'jsonp', // A API retorna um JSONP para evitar CORS
				success: function (dados) {
					if (dados.status === "ERROR") {
						alert("CNPJ inválido ou não encontrado!");
					} else {
						$('#nome').val(dados.nome);
						//$('#atividade_principal').html("Atividade Principal: " + dados.atividade_principal[0].text);
						$('#cep').val(dados.cep);
						$('#telefone').val(dados.telefone);
						$('#email').val(dados.email);
						$('#endereco').val(dados.logradouro);
						$('#bairro').val(dados.bairro);
						$('#numero').val(dados.numero);
						$('#cidade').val(dados.municipio);
						$('#complemento').val(dados.complemento);
						$('#estado').val(dados.uf);
					}
				},
				error: function () {
					alert("Erro ao buscar os dados do CNPJ.");
				}
			});
		} else {
			alert("Por favor, insira um CNPJ válido com 14 dígitos.");
		}
	}
</script>



<script type="text/javascript">
	

	function ficha(){
		var id_pac = $('#id_pac').val();
		window.open("rel/ficha_class.php?id="+id_pac);
	}


	$("#form-historico").submit(function () {
		event.preventDefault();
		var id_pac = $('#id_pac').val();
		var formData = new FormData(this);		
		$.ajax({
			url: 'paginas/consultas/inserir_historico.php',
			type: 'POST',
			data: formData,
			success: function (mensagem) {
				$('#mensagem-historico').text('');
				$('#mensagem-historico').removeClass()
				if (mensagem.trim() == "Salvo com Sucesso") {    
					listarHistorico(id_pac);
					$('#historico').val('');
				} else {
					$('#mensagem-historico').addClass('text-danger')
					$('#mensagem-historico').text(mensagem)
				}
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	});



	function listarAnamnese(id){
		 $.ajax({
        url: 'paginas/consultas/listar_anamnese.php',
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(result){        	
            $("#listar_ana").html(result);
            $('#mensagem_ana').text('');
        }
    });
	}
	function adicionarItem(id, paciente){
		
		$.ajax({
        url: 'paginas/consultas/add_item.php',
        method: 'POST',
        data: {id, paciente},
        dataType: "html",
        success:function(result){        	
           listarAnamnese(paciente);
        }
    });
	}
	function adicionarDesc(id, paciente){
		var desc = $('#desc_'+id).val();
		$.ajax({
        url: 'paginas/consultas/editar_item.php',
        method: 'POST',
        data: {id, paciente, desc},
        dataType: "html",
        success:function(result){        	
          listarAnamnese(paciente);
        }
    });
	}
	function listarAnaPac(id){
		 $.ajax({
        url: 'paginas/consultas/listar_ana_pac.php',
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(result){        	
            $("#listar_ana_pac").html(result);
           
        }
    });
	}

</script>


<script type="text/javascript">
	function listarOdontogramas(paciente){
	
	$.ajax({
       url: 'paginas/' + pag + "/listar_odontogramas.php",
        method: 'POST',
        data: {paciente},
        dataType: "html",

        success:function(result){        	
            $("#listar_odontogramas").html(result);           
        }
    });
}
</script>




<script type="text/javascript">
		function listarClientes(id){
	$.ajax({
         url: 'paginas/consultas/listar_clientes.php',
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar_clientes").html(result);           
        }
    });
}
</script>




<script type="text/javascript">
	function listarPermanentes(){
		listarItens()
		var id =  $('#id_odo').val();
	$.ajax({
         url: 'paginas/odontogramas/listar_permanentes.php',
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){        	
            $("#listar_permanentes").html(result);           
        }
    });
}

function listarDeciduos(){
	listarItens()
		var id =  $('#id_odo').val();
	$.ajax({
         url: 'paginas/odontogramas/listar_deciduos.php',
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){        	
            $("#listar_deciduos").html(result);           
        }
    });
}
</script>


<script type="text/javascript">
	function inserirItem(){
		var dente =  $('#dente').val();
		var acao =  $('#acao').val();
		var descricao =  $('#procedimento').val();
		var obs =  $('#obs').val();
		var id =  $('#id_odo').val();
		var paciente =  $('#cliente').val();

		if(descricao == ""){
			alert("Preencha uma Descrição");
			return;
		}

		if(paciente == ""){
			alert("Selecione um Paciente");
			return;
		}


		$.ajax({
	         url: 'paginas/odontogramas/inserir_item.php',
	        method: 'POST',
	        data: {dente, acao, descricao, obs, id, paciente},
	        dataType: "html",

	        success:function(result){   
	        	if(result.trim() == "Salvo com Sucesso"){
	        		 listarPermanentes();
		           listarDeciduos();		           
		           limparCamposItens();   
		           limparEstilos();
		           listarItens();
		       }else{
		       	alert(result)
		       }	
	             
	        }
	    });


	}


	function listarItens(){
		var id =  $('#id_odo').val();

		$.ajax({
	         url: 'paginas/odontogramas/listar_itens.php',
	        method: 'POST',
	        data: {id},
	        dataType: "html",

	        success:function(result){ 
	             $("#listar_itens").html(result); 
	        }
	    });

	}


	function limparEstilos(){
		$('#img_18').removeClass();
		$('#img_17').removeClass();
		$('#img_16').removeClass();
		$('#img_15').removeClass();
		$('#img_14').removeClass();
		$('#img_13').removeClass();
		$('#img_12').removeClass();
		$('#img_11').removeClass();
		$('#img_21').removeClass();
		$('#img_22').removeClass();
		$('#img_23').removeClass();
		$('#img_24').removeClass();
		$('#img_25').removeClass();
		$('#img_26').removeClass();
		$('#img_27').removeClass();
		$('#img_28').removeClass();

		$('#img_48').removeClass();
		$('#img_47').removeClass();
		$('#img_46').removeClass();
		$('#img_45').removeClass();
		$('#img_44').removeClass();
		$('#img_43').removeClass();
		$('#img_42').removeClass();
		$('#img_41').removeClass();

		$('#img_31').removeClass();
		$('#img_32').removeClass();
		$('#img_33').removeClass();
		$('#img_34').removeClass();
		$('#img_35').removeClass();
		$('#img_36').removeClass();
		$('#img_37').removeClass();
		$('#img_38').removeClass();


		$('#img_55').removeClass();
		$('#img_54').removeClass();
		$('#img_53').removeClass();
		$('#img_52').removeClass();
		$('#img_51').removeClass();

		$('#img_61').removeClass();
		$('#img_62').removeClass();
		$('#img_63').removeClass();
		$('#img_64').removeClass();
		$('#img_65').removeClass();

		$('#img_85').removeClass();
		$('#img_84').removeClass();
		$('#img_83').removeClass();
		$('#img_82').removeClass();
		$('#img_81').removeClass();

		$('#img_71').removeClass();
		$('#img_72').removeClass();
		$('#img_73').removeClass();
		$('#img_74').removeClass();
		$('#img_75').removeClass();
		
	}
</script>



<script type="text/javascript">	

			$("#form_odo").submit(function () {	

				event.preventDefault();				
				var formData = new FormData(this);


				$('#mensagem_odo').text('Salvando...')
   				 $('#btn_salvar_odo').hide();

				$.ajax({
					url: 'paginas/odontogramas/salvar.php',
					type: 'POST',
					data: formData,

					success: function (mensagem) {  

						var msg = mensagem.split("-");        	
						
						$('#mensagem').text('');
						$('#mensagem').removeClass()
						if (msg[0].trim() == "Salvo com Sucesso") {	
							listar();
							sucesso();							
							$("#btn-fechar_odo").click();
							$("#id_relatorio").val(msg[1]);
							$("#btn_relatorio").click();

							
						} else {
							alert(msg[0]);               
							
						}

						 $('#btn_salvar_odo').show();					

					},

					cache: false,
					contentType: false,
					processData: false,

				});

			});
		</script>