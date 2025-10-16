<?php 
require_once("../../../conexao.php");
$tabela = 'agendamentos';
$data_hoje = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id'];

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_sala = @$res2[0]['sala'];
$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$status = '%'.@$_POST['status'].'%';
$funcionario = $id_usuario;
$hora_atual = date('H:i:s');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_func2 = $res2[0]['nome'];
		}else{
			$nome_func2 = 'Sem Referência!';
		}

$agendados = 0;
$confirmados = 0;
$finalizados = 0;

if($status == "%%"){
	$query = $pdo->query("SELECT * FROM $tabela where data >= '$dataInicial' and data <= '$dataFinal' and status != 'Finalizado' and funcionario = '$funcionario' ORDER BY data asc, hora asc");
}else{
	$query = $pdo->query("SELECT * FROM $tabela where data >= '$dataInicial' and data <= '$dataFinal' and status LIKE '$status' and funcionario = '$funcionario' ORDER BY data asc, hora asc");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<small>
	<table class="table table-striped table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr> 
	<th>Procedimento</th>	
	<th class="">Paciente</th> 	
	<th class="esc">Data</th>		
	<th class="">Hora</th>	
	<th class="esc">Status</th>
	
	<th class="esc">Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
$funcionario = $res[$i]['funcionario'];
$cliente = $res[$i]['paciente'];
$hora = $res[$i]['hora'];
$data = $res[$i]['data'];
$usuario = $res[$i]['usuario'];
$data_lanc = $res[$i]['data_lanc'];
$obs = $res[$i]['obs'];
$status = $res[$i]['status'];
$servico = $res[$i]['servico'];
$pago = $res[$i]['pago'];
$tipo_pagamento = $res[$i]['tipo_pagamento'];
$retorno = $res[$i]['retorno'];
$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));
if($status == 'Concluído'){		
	$classe_linha = '';
}else{		
	$classe_linha = 'text-muted';
}
$ocultar_confirmacao = '';
if($status == 'Agendado'){
	$imagem = 'text-danger';
	$classe_status = '';
	$imagemClasse = 'red';	
	$ocultar_confirmacao = '';
}else if($status == 'Finalizado'){
	$imagem = 'verde';
	$imagemClasse = 'green';
	$classe_status = 'ocultar';
	$ocultar_confirmacao = 'ocultar';
}else if($status == 'Confirmado'){
	$imagem = 'text-primary';
	$imagemClasse = 'blue';
	$classe_status = 'ocultar';
	$ocultar_confirmacao = '';
}
if($tipo_pagamento != ''){
	$classe_pago = 'icone-money.png';
	$ocultar_pago = 'ocultar';
}else{
	$classe_pago = 'icone-money-red.png';
	$ocultar_pago = '';
}
$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu = $res2[0]['nome'];
}else{
	$nome_usu = 'Sem Usuário';
}
$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_medico = $res2[0]['nome'];
}else{
	$nome_medico = 'Sem Usuário';
}
$query2 = $pdo->query("SELECT * FROM procedimentos where id = '$servico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_serv = $res2[0]['nome'];
	$valor_serv = $res2[0]['valor'];
	$aceita_convenio = $res2[0]['convenio'];
}else{
	$nome_serv = 'Não Lançado';
	$valor_serv = '';
	$aceita_convenio = $res2[0]['convenio'];
}
$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_paciente = @$res2[0]['nome'];
	$telefone_paciente = @$res2[0]['telefone'];	
	$nome_paciente = @$res2[0]['nome'];
	$endereco_paciente = @$res2[0]['endereco'];
	$data_nasc = @$res2[0]['data_nasc'];
	$tipo_sanguineo = @$res2[0]['tipo_sanguineo'];
	$nome_responsavel = @$res2[0]['nome_responsavel'];
	$convenio = @$res2[0]['convenio'];
	$sexo = @$res2[0]['sexo'];
	$obs_paciente = @$res2[0]['obs'];
	$profissao = @$res2[0]['profissao'];
	$estado_civil = @$res2[0]['estado_civil'];
	//idade do paciente
	// separando yyyy, mm, ddd
    list($ano, $mes, $dia) = explode('-', $data_nasc);
    // data atual
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    // cálculo
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    
	$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
	
	$query2 = $pdo->query("SELECT * from convenios where id = '$convenio'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$linhas2 = @count($res2);
if($linhas2 > 0){
	$nome_convenio = $res2[0]['nome'];
}else{
	$nome_convenio = 'Particular';
}
}
$classe_hora = '';
if(strtotime($hora_atual) > strtotime($hora) and $status != 'Finalizado' and strtotime($data_hoje) == strtotime($data)){
	$classe_hora = 'text-danger';
}
$classe_obs = '';
if($obs == ""){
	$classe_obs = 'ocultar';
}
$classe_retorno = 'ocultar';
if($retorno == "Sim"){
	$classe_retorno = '';
}


//buscar o odontograma evolutivo do paciente
$query2 = $pdo->query("SELECT * from odontograma where paciente = '$cliente' and evolutivo = 'Sim' ");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$linhas2 = @count($res2);
if($linhas2 > 0){
	$id_odo = @$res2[0]['id'];
	$descricao_odo = @$res2[0]['descricao'];	
	$evolutivo_odo = @$res2[0]['evolutivo'];
	$funcionario_odo = @$res2[0]['funcionario'];
}else{
	$id_odo = 0;
	$descricao_odo = "";
	$evolutivo_odo = "Sim";
	$funcionario_odo = $id_usuario;
}


//trazer ultimo relatorio medico dessa consulta
$query2 = $pdo->query("SELECT * FROM relatorios where agendamento = '$id' order by id desc limit 1");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$texto_rel = @$res2[0]['texto'];

$texto_relF = @rawurlencode($texto_rel);


echo <<<HTML
<tr class="">
<td><i class="fa fa-square {$imagem}"></i> {$nome_serv} <span class="{$classe_retorno}" style="color:blue">(Retorno)</span></td>
<td class="">
<a style="color:blue" title="Dados do Paciente" href="#" onclick="mostrar('{$nome_paciente}','{$telefone_paciente}','{$endereco_paciente}','{$data_nascF}','{$tipo_sanguineo}','{$nome_responsavel}','{$nome_convenio}', '{$sexo}','{$obs_paciente}','{$idade}','{$id}','{$cliente}','{$profissao}','{$estado_civil}')" title="Mostrar Dados">
<u>{$nome_paciente}</u>
</a>
</td>
<td class="esc">{$dataF}</td>
<td class=" {$classe_hora}">{$horaF}</td>
<td class="esc"><div style="color:#FFF; background:{$imagemClasse}; padding:0px; width:75px; text-align: center; font-size: 12px; ">{$status}</div></td>
<td class="esc">
		
	<big><a href="#" class="btn btn-danger-light btn-sm" onclick="excluir('{$id}')" title="Excluir"><i class="fa fa-trash-can"></i></a></big>

		<big><a href="#" class="btn btn-success-light btn-sm" onclick="baixar('{$id}')" title="Finalizar Consulta"><i class="fa fa-check-square"></i></a></big>

		<big><a href="#" class="btn btn-warning-light btn-sm {$classe_obs}" onclick="obs('{$obs}')" title="Mostrar Observações"><i class="fa fa-info-circle"></i></a></big>

		<big><a class="btn btn-primary-light btn-sm " href="#" onclick="anamnese('{$cliente}', '{$nome_paciente}')" title="Editar Anamnese"><i class="fa fa-stethoscope "></i></a></big>

		<big><a class="btn btn-success-light btn-sm " href="#" onclick="exames('{$cliente}', '{$nome_paciente}')" title="Solicitar Raio X"><i class="fa fa-files-o"></i></a></big>
	
		<big><a class="btn btn-danger-light btn-sm " href="#" onclick="atestado('{$cliente}', '{$nome_paciente}')" title="Gerar Atestado"><i class="fa fa-file-pdf-o"></i></a></big>

		<big><a class="btn btn-dark-light btn-sm " href="#" onclick="odontograma('{$cliente}', '{$nome_paciente}', '{$id_odo}', '{$descricao_odo}','{$evolutivo_odo}')" title="Editar Odontograma"><i class="fa fa-file-o"></i></a></big>

		<big><a class="btn btn-primary-light btn-sm" href="#" onclick="mostrar('{$nome_paciente}','{$telefone_paciente}','{$endereco_paciente}','{$data_nascF}','{$tipo_sanguineo}','{$nome_responsavel}','{$nome_convenio}', '{$sexo}','{$obs_paciente}','{$idade}','{$id}','{$cliente}','{$profissao}','{$estado_civil}')" title="Mostrar Dados" title="Mostrar Dados"><i class="fa fa-info-circle "></i></a></big>


		<form   method="POST" action="rel/prontuario_class.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$cliente}">
					<big><button class="btn btn-info-light btn-sm" title="Prontuário"><i class="fa fa-file-pdf-o "></i></button></big>
					</form>

		<big><a class="btn btn-success btn-sm" href="#" onclick="relatorioMedico('{$id}', '{$cliente}', '{$nome_paciente}', '{$texto_relF}')" title="Relatório Dentista"><i class="fa fa-file-o"></i></a></big>
		
	
		</td>
</tr>
HTML;
}
echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
	
<div align="right" style="float:right;">
<span style="margin-right: 20px">Agendadas: <span class="text-danger">{$agendados}</span> </span>
<span style="margin-right: 20px">Confirmadas: <span class="text-primary">{$confirmados}</span></span> 
<span>
Finalizadas: <span class="verde">{$finalizados}</span> </span>
</div>
<br>
</small>
HTML;
}else{
	echo '<small>Não possui nenhum registro Cadastrado!</small>';
}
?>


<script src="../dist/trumbowyg.min.js"></script>

<script type="text/javascript" src="../dist/langs/pt_br.min.js"></script>

<script src="../dist/plugins/emoji/trumbowyg.emoji.min.js"></script>

<script src="../dist/plugins/colors/trumbowyg.colors.min.js"></script>
<script src="../dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
<script src="../dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>





<script type="text/javascript">
	$(document).ready( function () {

	$('#trumbowyg-editor').trumbowyg({
			lang: 'pt_br',
			btns: [
				['viewHTML'],
				['undo', 'redo'], // Only supported in Blink browsers
				['formatting'],
				['strong', 'em', 'del'],
				['link'],
				['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
				['unorderedList', 'orderedList'],
				['horizontalRule'],
				['removeformat'],
				['fullscreen'],
				['emoji'],
				['foreColor', 'backColor'],
				['fontfamily'],
				['fontsize'],
				['removeformat']
			],
			autogrow: true
		});

		
    $('#tabela').DataTable({
    		"ordering": false,
			"stateSave": true
    	});
    $('#tabela_filter label input').focus();
} );
</script>
<script type="text/javascript">
	function mostrar(paciente, telefone, endereco, data_nasc, tipo_sanguineo, nome_responsavel, nome_convenio, sexo, obs_paciente, idade, id, id_paciente, profissao, estado_civil){
		if(nome_responsavel == ""){
			$('#responsavel_div').hide();
		}else{
			$('#responsavel_div').show();
		}
		if(obs_paciente == ""){
			$('#obs_div').hide();
		}else{
			$('#obs_div').show();
		}
		if(profissao == ""){
			profissao = 'Nenhuma!';
		}
		
		$('#nome_dados').text(paciente);
		$('#idade_dados').text(idade + ' anos');
		$('#telefone_dados').text(telefone);	
		$('#data_nasc_dados').text(data_nasc);
		$('#tipo_dados').text(tipo_sanguineo);
		$('#sexo_dados').text(sexo);
		$('#convenio_dados').text(nome_convenio);
		$('#endereco_dados').text(endereco);
		$('#responsavel_dados').text(nome_responsavel);	
		$('#obs_dados').text(obs_paciente);
		$('#profissao_dados').text(profissao);
		$('#estado_civil_dados').text(estado_civil);
		$('#id_con').val(id);
		$('#id_pac').val(id_paciente);
		$('#modalDados').modal('show');
		listarHistorico(id_paciente);
		listarAnaPac(id_paciente);
	}

function listarHistorico(id){
	$.ajax({
        url: 'paginas/' + pag + "/listar_historico.php",
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(result){
            $("#historico_div").html(result);
            
        }
    });
}
function anamnese(paciente, nome){
		$('#id_pac_ana').val(paciente);	
		$('#nome_permissoes').text(nome);	
		$('#modalAnamnese').modal('show');
		listarAnamnese(paciente);
}

function atestado(paciente, nome){
		$('#id_atestado').val(paciente);	
		$('#nome_atestado').text(nome);	
		$('#modalAtestado').modal('show');
		
}
function exames(paciente, nome){
		$('#id_exame').val(paciente);	
		$('#nome_exame').text(nome);	
		$('#modalExames').modal('show');
		listarExames(paciente);
}





function baixar(id){
    $('#mensagem-excluir').text('Baixando...')


    $('body').removeClass('timer-alert');
		swal({
		  title: "Deseja Finalizar a Consulta?",
		  text: "Você não conseguirá voltar novamente o status dela!",
		  type: "success",
		  showCancelButton: true,
		  confirmButtonClass: "btn btn-success",
		  confirmButtonText: "Sim, Finalizar!",
		  closeOnConfirm: true
			
		},
		function(){
			
		  //swal("Excluído(a)!", "Seu arquivo imaginário foi excluído.", "success");

		  $.ajax({
        url: 'paginas/' + pag + "/baixar.php",
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(mensagem){
            if (mensagem.trim() == "Baixado com Sucesso") {
                listar();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });

		});

}




function obs(obs){
  
    $('body').removeClass('timer-alert');
		swal({
		  title: "Observações",
		  text: obs,
		  type: "info",
		  showCancelButton: true,
		  showConfirmButton: false,
		  confirmButtonClass: "btn btn-primary",
		  cancelButtonText: "Fechar!",
		  closeOnConfirm: false,

			
		},
		function(){
			
		  //swal("Excluído(a)!", "Seu arquivo imaginário foi excluído.", "success");


		});

}



function odontograma(paciente, nome, id_odo, descricao_odo, evolutivo_odo){

		$('#id').val(id_odo);
		$('#cliente').val(paciente).change();	
		$('#nome_odontograma').text(nome);
		$('#descricao').val(descricao_odo);
		$('#evolutivo').val(evolutivo_odo);	
		$('#modalOdontograma').modal('show');
		listarClientes(paciente);

		setTimeout(function() {
		 listarPermanentes();
			           listarDeciduos();		           
			           limparCamposItens();   
			           limparEstilos();
			           listarItens();	  
		}, 600)
}


function relatorioMedico(id, paciente, nome, texto){
		$('#id_relatorio').val(id);
		$('#id_pac_relatorio').val(paciente);
		$('#nome_relatorio').text(nome);
		$('#trumbowyg-editor').trumbowyg('html', decodeURIComponent(texto));
		
		$('#modalRelatorio').modal('show');		

}
</script>
