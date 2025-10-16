<?php
@session_start();
$mostrar_registros = @$_SESSION['registros'];
$id_usuario = @$_SESSION['id'];

$tabela = 'clientes';
require_once("../../../conexao.php");

if ($mostrar_registros == 'Não') {
	$query = $pdo->query("SELECT * from $tabela where usuario = '$id_usuario' order by id desc");
} else {
	$query = $pdo->query("SELECT * from $tabela order by id desc");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if ($linhas > 0) {
	echo <<<HTML
<small>
	<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr> 
	<th align="center" width="5%" class="text-center">Selecionar</th>
	<th>Nome</th>
	<th >Telefone</th>	
	<th >Convênio</th>			
	<th >Idade</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

	for ($i = 0; $i < $linhas; $i++) {
		$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$telefone = $res[$i]['telefone'];
		$email = $res[$i]['email'];
		$endereco = $res[$i]['endereco'];
		$tipo_pessoa = $res[$i]['tipo_pessoa'];
		$cpf = $res[$i]['cpf'];
		$numero = $res[$i]['numero'];
		$bairro = $res[$i]['bairro'];
		$cidade = $res[$i]['cidade'];
		$estado = $res[$i]['estado'];
		$cep = $res[$i]['cep'];
		$data_cad = $res[$i]['data_cad'];
		$data_nasc = $res[$i]['data_nasc'];
		$complemento = $res[$i]['complemento'];

		$tipo_sanguineo = $res[$i]['tipo_sanguineo'];
		$sexo = $res[$i]['sexo'];
		$profissao = $res[$i]['profissao'];
		$estado_civil = $res[$i]['estado_civil'];
		$convenio = $res[$i]['convenio'];
		$nome_responsavel = $res[$i]['nome_responsavel'];
		$cpf_responsavel = $res[$i]['cpf_responsavel'];
		$telefone2 = $res[$i]['telefone2'];
		$obs = $res[$i]['obs'];
		$marketing = $res[$i]['marketing'];

		if ($marketing == 'Não') {
			$ocultar_mark = 'ocultar';
		} else {
			$ocultar_mark = '';
		}

		$data_cadF = implode('/', array_reverse(@explode('-', $data_cad)));
		$data_nascF = implode('/', array_reverse(@explode('-', $data_nasc)));

		$tel_whatsF = '55' . preg_replace('/[ ()-]+/', '', $telefone);

		$query2 = $pdo->query("SELECT * from convenios where id = '$convenio' ");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome_convenio = @$res2[0]['nome'];

		//verificar débitos cliente
		$query2 = $pdo->query("SELECT * from receber where cliente = '$id' and vencimento < curDate() and pago != 'Sim'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$linhas2 = @count($res2);
		if ($linhas2 > 0) {
			$debito2 = 'table-danger';
			$debito = 'text-danger';
		} else {
			$debito2 = '';
			$debito = '';
		}

		if ($telefone == '' || $telefone == "Sem Registro") {
			$ocultar_whats = 'ocultar';
		} else {
			$ocultar_whats = '';
		}


		if ($tipo_pessoa == 'Física') {
			$cor_adm = 'bg-success-transparent text-primary';
		} else {
			$cor_adm = 'bg-danger-transparent text-danger';
		}


		$nomeF = mb_strimwidth($nome, 0, 40, "...");

	$idade = '';	

		//idade do paciente
	if($data_nasc != ""){
			// separando yyyy, mm, ddd
    list($ano, $mes, $dia) = explode('-', $data_nasc);
    // data atual
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    // cálculo
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
	}



	//buscar o odontograma evolutivo do paciente
$query2 = $pdo->query("SELECT * from odontograma where paciente = '$id' and evolutivo = 'Sim' ");
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


		echo <<<HTML
<tr class="{$debito2}">
<td align="center">
<div class="custom-checkbox custom-control">
<input type="checkbox" class="custom-control-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
<label for="seletor-{$id}" class="custom-control-label mt-1 text-dark"></label>
</div>
</td>
<td class="{$debito}"> {$nomeF}</td>
<td>{$telefone}</td>
<td>{$nome_convenio}</td>		
<td>{$idade}</td>
<td>
	<big><a class="btn btn-info-light btn-sm" class="" href="#" onclick="editar('{$id}','{$nome}','{$email}','{$telefone}','{$endereco}','{$cpf}','{$tipo_pessoa}','{$data_nasc}','{$numero}','{$bairro}','{$cidade}','{$estado}','{$cep}','{$complemento}','{$tipo_sanguineo}','{$sexo}','{$profissao}','{$estado_civil}','{$convenio}','{$nome_responsavel}','{$cpf_responsavel}','{$telefone2}','{$obs}')" title="Editar Dados"><i class="fa fa-edit text-info"></i></a></big>


		<big><a class="btn btn-danger-light btn-sm" href="#" onclick="excluir('{$id}')" title="Excluir"><i class="fa fa-trash-can"></i></a></big>
		

	<big><a class="btn btn-primary-light btn-sm" href="#" onclick="mostrar('{$nome}','{$telefone}','{$endereco}','{$data_nascF}','{$tipo_sanguineo}','{$nome_responsavel}','{$nome_convenio}', '{$sexo}','{$obs}','{$idade}','{$id}','{$id}','{$profissao}','{$estado_civil}')" title="Mostrar Dados" title="Mostrar Dados"><i class="fa fa-info-circle "></i></a></big>

		<big><a class="btn btn-primary-light btn-sm " href="#" onclick="anamnese('{$id}', '{$nome}')" title="Editar Anamnese"><i class="fa fa-stethoscope "></i></a></big>

		<big><a class="btn btn-dark-light btn-sm " href="#" onclick="consultas('{$id}', '{$nome}')" title="Últimas Consultas"><i class="fa fa-stethoscope "></i></a></big>


				<big><a class="btn btn-dark-light btn-sm " href="#" onclick="odontograma('{$id}', '{$nome}', '{$id_odo}', '{$descricao_odo}','{$evolutivo_odo}')" title="Editar Odontograma"><i class="fa fa-file-o"></i></a></big>



<big><a class="btn btn-success-light btn-sm" href="#" onclick="mostrarContas('{$nome}','{$id}')" title="Mostrar Contas"><i style="color: green" class="fa fa-hand-holding-dollar"></i></a></big>

		<big><a class="btn btn-dark-light btn-sm" href="#" onclick="arquivo('{$id}', '{$nome}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o taxt-secondary"></i></a></big>




				<big><a class="btn btn-danger-light btn-sm" href="#" onclick="fichaPersonalizada('{$id}', '{$nome}')" title="Ficha Personalizada"><i class="fa fa-file-pdf-o taxt-secondary"></i></a></big>


<form   method="POST" action="rel/prontuario_class.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$id}">
					<big><button class="btn btn-info-light btn-sm" title="Prontuário"><i class="fa fa-file-pdf-o "></i></button></big>
					</form>


		<big><a class="{$ocultar_whats} btn btn-success-light btn-sm" class="" href="http://api.whatsapp.com/send?1=pt_BR&phone={$tel_whatsF}" title="Whatsapp" target="_blank"><i style="color: green" class="bi bi-whatsapp"></i></i></a></big>


		<big><a class="btn btn-danger-light btn-sm {$ocultar_mark}" href="#" onclick="excluirMarketing('{$id}')" title="Remover do Marketing Whatsapp"><i class="fa fa-close text-danger"></i></a></big>


</td>
</tr>
HTML;

	}

} else {
	echo 'Não possui nenhum cadastro!';
}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
HTML;
?>



<script type="text/javascript">
	$(document).ready(function () {
		$('#tabela').DataTable({
			"language": {
				//"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
			},
			"ordering": false,
			"stateSave": true
		});
	});
</script>

<script type="text/javascript">
	function editar(id, nome, email, telefone, endereco, cpf, tipo_pessoa, data_nasc, numero, bairro, cidade, estado, cep, complemento, tipo_sanguineo, sexo, profissao, estado_civil, convenio, nome_responsavel, cpf_responsavel, telefone2, obs) {
		$('#mensagem').text('');
		$('#titulo_inserir').text('Editar Registro');

		$('#id').val(id);
		$('#nome').val(nome);
		$('#email').val(email);
		$('#telefone').val(telefone);
		$('#endereco').val(endereco);
		$('#cpf').val(cpf);
		$('#tipo_pessoa').val(tipo_pessoa).change();
		$('#data_nasc').val(data_nasc);

		$('#numero').val(numero);
		$('#bairro').val(bairro);
		$('#cidade').val(cidade);
		$('#estado').val(estado).change();
		$('#cep').val(cep);
		$('#complemento').val(complemento);

		$('#tipo_sanguineo').val(tipo_sanguineo);
		$('#sexo').val(sexo).change();
		$('#profissao').val(profissao);
		$('#estado_civil').val(estado_civil).change();
		$('#convenio').val(convenio).change();
		$('#nome_responsavel').val(nome_responsavel);
		$('#cpf_responsavel').val(cpf_responsavel);
		$('#telefone2').val(telefone2);
		$('#obs').val(obs);

		$('#modalForm').modal('show');
	}


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


	function limparCampos() {
		$('#id').val('');
		$('#nome').val('');
		$('#email').val('');
		$('#telefone').val('');
		$('#endereco').val('');
		$('#cpf').val('');
		$('#tipo_pessoa').val('Física').change();
		$('#data_nasc').val('');

		$('#numero').val('');
		$('#bairro').val('');
		$('#cidade').val('');
		$('#estado').val('').change();
		$('#cep').val('');
		$('#complemento').val('');


		$('#tipo_sanguineo').val('');
		$('#sexo').val('M').change();
		$('#profissao').val('');
		$('#estado_civil').val('Solteiro').change();
		
		$('#nome_responsavel').val('');
		$('#cpf_responsavel').val('');
		$('#telefone2').val('');
		$('#obs').val('');

		$('#ids').val('');
		$('#btn-deletar').hide();
	}





	function arquivo(id, nome) {
		$('#id-arquivo').val(id);
		$('#nome-arquivo').text(nome);
		$('#modalArquivos').modal('show');
		$('#mensagem-arquivo').text('');
		$('#arquivo_conta').val('');
		listarArquivos();
	}



	function mostrarContas(nome, id) {

		$('#titulo_contas').text(nome);
		$('#id_contas').val(id);

		$('#modalContas').modal('show');
		listarDebitos(id);

	}


	function listarDebitos(id) {

		$.ajax({
			url: 'paginas/' + pag + "/listar_debitos.php",
			method: 'POST',
			data: { id },
			dataType: "html",

			success: function (result) {
				$("#listar_debitos").html(result);
			}
		});
	}

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


	function listarHistorico(id){
	$.ajax({
        url: 'paginas/consultas/listar_historico.php',
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

function fichaPersonalizada(paciente, nome){
		$('#id_ficha').val(paciente);	
		$('#nome_ficha').text(nome);	
		$('#modalFicha').modal('show');	
		listarOdontogramas(paciente);

}


function consultas(paciente, nome){
		$('#nome_consulta').text(nome);	
		$('#modalConsultas').modal('show');
		listarConsultas(paciente)
}

function listarConsultas(id){	
	$.ajax({
        url: 'paginas/' + pag + "/listar_consultas.php",
        method: 'POST',
        data: {id},
        dataType: "html",
        success:function(result){
            $("#listar_consultas").html(result);        
        }
    });
}




function odontograma(paciente, nome, id_odo, descricao_odo, evolutivo_odo){

		$('#id_odo').val(id_odo);
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





function excluirMarketing(id) {
    //$('#mensagem-excluir').text('Excluindo...')

    $('body').removeClass('timer-alert');
    Swal.fire({
        title: "Excluir do Marketing?",
        text: "Ele não receberá mais mensagens!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33', // Cor do botão de confirmação (vermelho)
        cancelButtonColor: '#3085d6', // Cor do botão de cancelamento (azul)
        confirmButtonText: "Sim, Excluir!",
        cancelButtonText: "Cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {


            $.ajax({
                url: 'paginas/' + pag + "/excluir_marketing.php",
                method: 'POST',
                data: { id },
                dataType: "html",

                success: function (mensagem) {
                    if (mensagem.trim() == "Excluído com Sucesso") {

                        // Ação de exclusão aqui
                        Swal.fire({
                            title: 'Excluido com Sucesso!',
                            text: 'Fecharei em 1 segundo.',
                            icon: "success",
                            timer: 1000
                        })
                        //excluido();
                        listar();
                        limparCampos();


                    } else {
                        $('#mensagem-excluir').addClass('text-danger')
                        $('#mensagem-excluir').text(mensagem)
                    }
                }
            });

        }
    });


};

</script>