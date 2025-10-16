<?php
$pag = 'odontogramas';

if (@$odontogramas == 'ocultar') {
	echo "<script>window.location='index'</script>";
	exit();
}

?>

<div class="breadcrumb-header justify-content-between">
	<div class="left-content mt-2">
		<a class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-1"></i>
			Novo Odontograma</a>



<a class="btn btn-danger" href="#" onclick="deletarSel()" title="Excluir" id="btn-deletar" style="display:none"><i class="fe fe-trash-2"></i> Deletar</a>

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

<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
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
						<div class="col-md-1" style="margin-top: 27px; padding:0">
							<button onclick="$('#btn-fechar').click();" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCliente" > <i class="fa fa-plus"></i> </button>	
						</div>

						<div class="col-md-4 col-6">
							<label>Descrição</label>
							<input maxlength="100" type="text" class="form-control" id="descricao" name="descricao" placeholder="Odontograma Evolutivo, Orçamento CLiente, etc" required="">
						</div>


							<div class="col-md-2 mb-2 col-6">
							<label>Evolutivo</label>
							<select name="evolutivo" id="evolutivo" class="form-select">
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
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






<!-- Modal Cliente -->
<div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" style="overflow: scroll; max-height:600px; scrollbar-width: thin;">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">Adicionar Cliente</h4>
				<button id="btn-fechar-cliente" aria-label="Close" class="btn-close" data-bs-toggle="modal" data-bs-target="#modalForm" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form-cliente">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-6 mb-2 col-6 needs-validation was-validated">
							<label>Nome <span class="text-danger" style="font-size: 9px">(Obrigatório)</span></label>
							<div class="form-group has-success mg-b-0">
								<input class="form-control" id="nome" name="nome" placeholder="Digite o Nome" required type="text"
									value="">
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
				<small><div id="mensagem_cliente" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" id="btn_salvar_cliente" class="btn btn-primary">Salvar</button>
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



<script type="text/javascript">var pag = "<?= $pag ?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
		$(document).ready(function() {

			listarClientes();
			listarPermanentes();
			listarDeciduos();
			listarItens()
			
			$('.sel2').select2({
				dropdownParent: $('#modalForm')
			});		

			$(document).on('select2:open', () => {
					document.querySelector('.select2-search__field').focus();
				});

			
			
		});
	</script>


<script type="text/javascript">
		function listarClientes(){
	$.ajax({
         url: 'paginas/' + pag + "/listar_clientes.php",
        method: 'POST',
        data: {},
        dataType: "html",

        success:function(result){
            $("#listar_clientes").html(result);           
        }
    });
}
</script>


<script type="text/javascript">
	$("#form-cliente").submit(function () { 

    $('#mensagem_cliente').text('Salvando!!');
    $('#btn_salvar_cliente').hide();

    event.preventDefault();
    var formData = new FormData(this);
    var nova_pag = 'clientes';

    $.ajax({
        url: 'paginas/' + nova_pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem_cliente').text('');
            $('#mensagem_cliente').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar-cliente').click();
                listar();
                listarClientes('1'); 


            } else {

                $('#mensagem_cliente').addClass('text-danger')
                $('#mensagem_cliente').text(mensagem)
            }

             $('#btn_salvar_cliente').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>


<script type="text/javascript">
	function listarPermanentes(){
		listarItens()
		var id =  $('#id').val();
	$.ajax({
         url: 'paginas/' + pag + "/listar_permanentes.php",
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
		var id =  $('#id').val();
	$.ajax({
         url: 'paginas/' + pag + "/listar_deciduos.php",
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
		var id =  $('#id').val();
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
	         url: 'paginas/' + pag + "/inserir_item.php",
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
		var id =  $('#id').val();

		$.ajax({
	         url: 'paginas/' + pag + "/listar_itens.php",
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


				$('#mensagem').text('Salvando...')
   				 $('#btn_salvar').hide();

				$.ajax({
					url: 'paginas/' + pag + "/salvar.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {  

						var msg = mensagem.split("-");        	
						
						$('#mensagem').text('');
						$('#mensagem').removeClass()
						if (msg[0].trim() == "Salvo com Sucesso") {	
							listar();
							sucesso();							
							$("#btn-fechar").click();
							$("#id_relatorio").val(msg[1]);
							$("#btn_relatorio").click();

							
						} else {
							alert(msg[0]);               
							
						}

						 $('#btn_salvar').show();					

					},

					cache: false,
					contentType: false,
					processData: false,

				});

			});
		</script>