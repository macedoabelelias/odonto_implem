<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'consultas';


$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual."-".$mes_atual."-01";
if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
	$dia_final_mes = '30';
}else if($mes_atual == '2'){
	$dia_final_mes = '28';
}else{
	$dia_final_mes = '31';
}
$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;
$id_func = $_SESSION['id'];


//verificar se ele tem a permissão de estar nessa página
if(@$consultas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}


?>
<div class="bs-example widget-shadow margem_mobile_top" style="padding:15px">
	<div class="row">
		<div class="col-md-5" style="">
			<div style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span></div>
			<div  style="float:left; margin-right:20px">
				<input type="date" class="form-control " name="data-inicial"  id="data-inicial-caixa" value="<?php echo $data_hoje ?>" required>
			</div>
			<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
			<div  style="float:left; margin-right:30px">
				<input type="date" class="form-control " name="data-final"  id="data-final-caixa" value="<?php echo $data_hoje ?>" required>
			</div>
		</div>
	
	<div class="col-md-5"  align="center" style="margin-top: 5px">	
			<div > 
				<small >
					<a title="Status das Consultas" class="text-muted" href="#" onclick="buscarContas('')"><span>Todas</span></a> / 
					<a title="Agendado" class="text-danger" href="#" onclick="buscarContas('Agendado')"><span>Agendadas</span></a> / 
					<a title="Confirmado" class="text-primary" href="#" onclick="buscarContas('Confirmado')"><span>Confirmadas</span></a> / 
					<a title="Finalizado" class="verde" href="#" onclick="buscarContas('Finalizado')"><span>Finalizadas</span></a>
				</small>
			</div>
		</div>	
				
		<input type="hidden" id="buscar-contas">
	</div>
	
	<hr>
	<div id="listar">
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





<!-- Modal Atestado -->
<div class="modal fade" id="modalAtestado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_atestado"></span></h4>
				<button id="btn-fechar-atestado" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="rel/atestado_class.php" target="_blank">
			<div class="modal-body">
				<div class="row">
						<div class="col-md-6">	
								<label>Data Inicial</label>
								<input type="date" name="dataInicial" class="form-control" placeholder="" value="<?php echo $data_atual ?>">			
							</div>
							<div class="col-md-6">	
								<label>Data Final</label>
								<input type="date" name="dataFinal" class="form-control" placeholder="" value="<?php echo $data_atual ?>" >			
							</div>															
				
						</div>
						<div class="row">
							<div class="col-md-12">	
								<label>Motivo</label>
								<input type="text" name="motivo" class="form-control" placeholder="Motivo do Afastamento" >	
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">	
								<label>Informações Relevantes</label>
								<input type="text" name="obs" class="form-control" placeholder="Demais Informações" >	
							</div>
						</div>
			
				<br>
				<input type="hidden" name="id" id="id_atestado">
				<small><div id="mensagem_atestado" align="center" class="mt-3"></div></small>		
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Gerar Atestado</button>
			</div>
			</form>		
		</div>
	</div>
</div>



<!-- Modal RaioX -->
<div class="modal fade" id="modalExames" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_exame"></span></h4>
				<button id="btn-fechar-exame" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
						class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="rel/exame_class.php" target="_blank">
			<div class="modal-body">
				<div class="row">
						<div class="col-md-6">	
								<label>Procedimento</label>
								<select class="selExame" id="exame" name="exame" style="width:100%" onchange="trocarExame()">
									<option value="">Outro</option>
								 <?php 
									$query = $pdo->query("SELECT * from procedimentos order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								 ?>
								  <option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>
								<?php } } ?>
								</select>				
							</div>
							<div class="col-md-6" style="margin-top: 27px;">	
								
								<input type="text" id="exame2" name="exame2" class="form-control" placeholder="Digite o nome do exame">			
							</div>						
				
					
				</div>

				<div class="row">
					<div class="col-md-10">	
								<label>Descrição para o Pedido Raio X</label>
								<input type="text" id="descricao_raiox" name="descricao_raiox" class="form-control" placeholder="Texto do pedido de raio X">			
							</div>						
				
				
							<div class="col-md-2" style="margin-top: 27px">
								
								<button onclick="inserirItemExame()" type="button" class="btn btn-success"><i class="fa fa-check"></i></button>	
							</div>	
				</div>


				<div class="row" style="margin-top: 20px; border-top: 1px solid #595858">
					<div id="listar_exames">
						
					</div>
				</div>
				<br>
				<input type="hidden" name="id" id="id_exame">
				<small><div id="mensagem_exame" align="center" class="mt-3"></div></small>		
			</div>
			<div class="modal-footer"> 
			<a onclick="limparExame()" class="btn btn-danger">Limpar Exame</a>
				<button type="submit" class="btn btn-primary">Solicitar Exames</button>
			</div>
			</form>		
		</div>
	</div>
</div>








<div class="modal fade" id="modalOdontograma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">Odontograma Evolutivo <span id="nome_odontograma"></span></h4>
				<button id="btn-fechar-odontograma" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
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



<div style="display:none">
	<form action="rel/odontograma_class.php" method="POST" target="_blank">
		<input type="hidden" name="id" id="id_relatorio">
		<button type="submit" id="btn_relatorio"></button>
	</form>
</div>





<!-- Modal Relatorio -->
<div class="modal fade" id="modalRelatorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_relatorio"></span>		

				</h4>
				<button id="btn-fechar-relatorio" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>			
			<form id="form_relatorio">
			<div class="modal-body">

				<div class="row">
					<label>Título do Relatório de Consulta</label>
                    <div class="col-md-12 mb-2">
                    	<input class="form-control" type="text" name="titulo" id="titulo_relatorio" placeholder="Ex: Atestado de Comparecimento, Relatório de Consulta, etc">
                    </div>
                </div>

				<div class="row">
                    <div class="col-md-12 mb-2" style="font-weight: normal !important">
                        <label>Descrição do Relatório Médico</label>
                        <textarea class="form-control" id="trumbowyg-editor" name="texto" style="font-weight: normal !important; width:100%; ">
                        </textarea>
                    </div>
                </div>
				
				<input type="hidden" id="id_relatorio" name="id_relatorio">
				<input type="hidden" id="id_pac_relatorio" name="id_pac_relatorio">

			</div>	

			<div class="modal-footer">
					<button id="btn_salvar_relatorio" type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>

		</div>
	</div>
</div>




<form method="post" action="rel/relatorio_medico_class.php" style="display:none" target="_blank">
	<input type="hidden" name="id" id="id_do_relatorio">
	<button type="submit" id="botao_do_relatorio"></button>
</form>


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
    	
	});
</script>
<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];
		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);
		if(resultado[1] === 'pdf'){
			$('#target').attr('src', "img/pdf.png");
			return;
		}
		if(resultado[1] === 'rar' || resultado[1] === 'zip'){
			$('#target').attr('src', "img/rar.png");
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
	function valorData(dataInicio, dataFinal){
	 $('#data-inicial-caixa').val(dataInicio);
	 $('#data-final-caixa').val(dataFinal);	
	listar();
}
</script>
<script type="text/javascript">
	$('#data-inicial-caixa').change(function(){
			//$('#tipo-busca').val('');
			listar();
		});
		$('#data-final-caixa').change(function(){						
			//$('#tipo-busca').val('');
			listar();
		});	
</script>
<script type="text/javascript">
	function listar(){
	var dataInicial = $('#data-inicial-caixa').val();
	var dataFinal = $('#data-final-caixa').val();	
	var status = $('#buscar-contas').val();	
	$('#dataInicial').val(dataInicial);
	$('#dataFinal').val(dataFinal);
	$('#pago_rel').val(status);
	
    $.ajax({
        url: 'paginas/' + pag + "/listar.php",
        method: 'POST',
        data: {dataInicial, dataFinal, status},
        dataType: "html",
        success:function(result){
            $("#listar").html(result);
            $('#mensagem-excluir').text('');
        }
    });
}
</script>
<script type="text/javascript">
	function buscarContas(status){
	 $('#buscar-contas').val(status);
	 listar();
	}
</script>
<script>
	$("#form-historico").submit(function () {
		event.preventDefault();
		var id_pac = $('#id_pac').val();
		var formData = new FormData(this);		
		$.ajax({
			url: 'paginas/' + pag +  "/inserir_historico.php",
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


	
	function ficha(){
		var id_pac = $('#id_pac').val();
		window.open("rel/ficha_class.php?id="+id_pac);
	}
	function listarAnamnese(id){
		 $.ajax({
        url: 'paginas/' + pag + "/listar_anamnese.php",
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
        url: 'paginas/' + pag + "/add_item.php",
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
        url: 'paginas/' + pag + "/editar_item.php",
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
        url: 'paginas/' + pag + "/listar_ana_pac.php",
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(result){        	
            $("#listar_ana_pac").html(result);
           
        }
    });
	}





function trocarExame(){	
	var exame = $("#exame").val();
	
	if(exame == ""){
		$("#exame2").show();
	}else{
		$("#exame2").hide();
	}
	
}
function inserirItemExame(){
	var exame = $("#exame").val();
	var exame2 = $("#exame2").val();
	var descricao = $("#descricao_raiox").val();

	if(descricao == ""){
		alert("Prencha a descrição!");
		return;
	}

	var id_paciente = $("#id_exame").val();
	if(exame == "" && exame2 == ""){
		alert('Selecione um Exame ou escreva o nome do exame!');
		return;
	}
	$('#mensagem_exame').text('');
	 $.ajax({
        url: 'paginas/' + pag + "/inserir_exame.php",
        method: 'POST',
        data: {id_paciente, exame, exame2, descricao},
        dataType: "html",
        success:function(result){        	
            if(result.trim() === 'Inserindo com Sucesso'){
            	listarExames(id_paciente);
            	limparCamposExame()
            }else{
            	$('#mensagem_receita').text(result);
            }
           
        }
    });
}
function listarExames(id){
		 $.ajax({
        url: 'paginas/' + pag + "/listar_exames.php",
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(result){        	
            $("#listar_exames").html(result);
            $('#mensagem_exame').text('');
        }
    });
	}
function limparCamposExame(){
	$("#exame").val('').change();
	$("#exame2").val('');
	$("#descricao_raiox").val('');
	
}
function limparExame(){
	var id_paciente = $("#id_exame").val();
	 $.ajax({
        url: 'paginas/' + pag + "/limpar_exame.php",
        method: 'POST',
        data: {id_paciente},
        dataType: "html",
        success:function(result){        	
            listarExames(id_paciente);
            limparCamposExame();
        }
    });
}
</script>


<script type="text/javascript">
		function listarClientes(id){
	$.ajax({
         url: 'paginas/' + pag + "/listar_clientes.php",
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
		var id =  $('#id').val();
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
		var id =  $('#id').val();
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
		var id =  $('#id').val();

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


				$('#mensagem').text('Salvando...')
   				 $('#btn_salvar').hide();

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








<script type="text/javascript">
	$(document).ready(function () {

		
		
	});
</script>




<script>
	$("#form_relatorio").submit(function () {		
		$('#btn_salvar_relatorio').hide();
		event.preventDefault();		

		var formData = new FormData(this);
		$.ajax({
			url: 'paginas/' + pag + "/salvar_relatorio.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {	
				var msg = mensagem.split("*");
				if (msg[0].trim() == "Salvo com Sucesso") {                   

					$('#btn-fechar-relatorio').click();
					//chamarda do pdf  
					$('#id_do_relatorio').val(msg[1]);
					$('#botao_do_relatorio').click();      
					//alertInformativo(msg[1])   	

				} else {
					alertInformativo(msg[0])
				}
				$('#btn_salvar_relatorio').show();
			},
			cache: false,
			contentType: false,
			processData: false,
		});
		});



</script>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/ui/trumbowyg.min.css">
<script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/trumbowyg.min.js"></script>

<script>
  $(document).ready(function () {
    $('#historico').trumbowyg();
  });


</script>

<style type="text/css">
	.trumbowyg-editor {
  font-weight: normal !important;
}
</style>
