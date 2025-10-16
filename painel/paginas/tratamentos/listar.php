<?php 

$tabela = 'tratamentos';

require_once("../../../conexao.php");

$dataInicial = @$_POST['p1'];
$dataFinal = @$_POST['p2'];
$prof = @$_POST['p3'];



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

if($dataInicial == ""){
	$dataInicial = $data_inicio_mes;
}

if($dataFinal == ""){
	$dataFinal = $data_final_mes;
}

if($prof == ""){
	$sql_prof = '';
}else{
	$sql_prof = " and profissional = '$prof' ";
}

$query = $pdo->query("SELECT * from $tabela where data >= '$dataInicial' and data <= '$dataFinal' $sql_prof order by id desc");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$linhas = @count($res);

if($linhas > 0){

echo <<<HTML

<small>

	<table class="table table-striped table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">

	<thead> 

	<tr>

	<th>Paciente</th>	

	<th>Procedimento</th>

	<th>Profissional</th>

	<th>Data Inicial</th>

	<th>Data Final</th>

	<th>Frequencia</th>

	<th>Falta Pagar</th>

	<th>açoes</th>

	</tr> 

	</thead> 

	<tbody>	

HTML;





for($i=0; $i<$linhas; $i++){

	$id = $res[$i]['id'];

	$paciente = $res[$i]['paciente'];

	$procedimento = $res[$i]['procedimento'];

	$profissional = $res[$i]['profissional'];

	$quitado = $res[$i]['quitado'];

	$data_inicio = $res[$i]['data_inicial'];

	$data_fim = $res[$i]['data_final'];

	$frequencia = $res[$i]['frequencia'];

	$data_inicioF = @implode('/', array_reverse(explode('-', $data_inicio)));
$data_fimF = @implode('/', array_reverse(explode('-', $data_fim)));


	$hora1 = @$res[$i]['hora1'];

	$hora2 = @$res[$i]['hora2'];

	$hora3 = @$res[$i]['hora3'];

	$hora4 = @$res[$i]['hora4'];

	$hora5 = @$res[$i]['hora5'];

	$hora6 = @$res[$i]['hora6'];
	$hora7 = @$res[$i]['hora7'];


	if ($hora1 == '00:00:00') {
		$hora1 = '';
	}
	if ($hora2 == '00:00:00') {
		$hora2 = '';
	}
	if ($hora3 == '00:00:00') {
		$hora3 = '';
	}
	if ($hora4 == '00:00:00') {
		$hora4 = '';
	}
	if ($hora5 == '00:00:00') {
		$hora5 = '';
	}
	if ($hora6 == '00:00:00') {
		$hora6 = '';
	}

	if ($hora7 == '00:00:00') {
		$hora7 = '';
	}


if ($quitado == 'Sim') {
	$ocul = 'ocultar';
}else{
	$ocul = '';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$paciente'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);



$nome_cliente = @$res2[0]['nome'];





$query2 = $pdo->query("SELECT * FROM usuarios where id = '$profissional'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);



$nome_func = $res2[0]['nome'];







$query2 = $pdo->query("SELECT * FROM procedimentos where id = '$procedimento'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);


$nome_serv = $res2[0]['nome'];

$valor_serv = $res2[0]['valor'];





$query7 = $pdo->query("SELECT * FROM agendamentos where id_tratamento = '$id' and pago = 'Não'");

$res7 = $query7->fetchAll(PDO::FETCH_ASSOC);
$valor_t = 0;
$agendamentos_nao_pagos = 0;
$valor_tF = 0;

$valor_servF = 0;


if ( @count($res7) > 0) {




for($i7=0; $i7 < @count($res7); $i7++){
$valor_s = $res7[$i7]['valor'];

$valor_t += $valor_s;
	
}
$valor_tF = number_format($valor_t, 2, ',', '.');



$valor_todos = 0;
$agendamentos_nao_pagos = count($res7);

$valor_todos = $valor_serv * $agendamentos_nao_pagos;

$valor_todosF = number_format(@$valor_todos, 2, ',', '.');

$valor_servF = number_format(@$valor_serv, 2, ',', '.');




}



if($valor_tF == 0){
	$valor_tF = 'Pago';
	$classe_valor = 'verde';
}else{
	$classe_valor = 'text-danger';
}
		

echo <<<HTML

<tr>

<td>



{$nome_cliente}

</td>

<td class="esc">{$nome_serv}</td>
<td class="esc">{$nome_func}</td>
<td class="esc">{$data_inicioF}</td>
<td class="esc">{$data_fimF}</td>
<td class="esc">{$frequencia} X Semana</td>
<td class="esc {$classe_valor}">R$ {$valor_tF}</td>

<td>



<big><a href="#" class="btn btn-danger-light btn-sm" onclick="excluir('{$id}')" title="Excluir"><i class="fa fa-trash-can"></i></a></big>



<a class="btn btn-success-light btn-sm {$ocul}"  href="#" onclick="baixar1('{$id}','{$valor_tF}','{$valor_servF}','{$agendamentos_nao_pagos}','{$paciente}','{$procedimento}','{$valor_t}','{$profissional}')" title="Baixa no Pagamento"><big><i class="fa fa-check-square"></i></a>


<a class="btn btn-primary-light btn-sm" title="Editar Agendamentos" href="#" onclick="mostrar('{$id}', '{$data_inicioF}', '{$data_fimF}', '{$nome_serv}','{$nome_func}','{$valor_tF}')" title="Ver Dados"><i class="fa fa-edit "></i></a>







</td>

</tr>

HTML;



}





echo <<<HTML

</tbody>

<small><div align="center" id="mensagem-excluir"></div></small>

</table>

HTML;



}else{

	echo '<small>Nenhum Registro Encontrado!</small>';

}



?>







<script type="text/javascript">

		

    $('#tabela').DataTable({

    	"language" : {

            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'

        },

        "ordering": false,

		"stateSave": true

    });



</script>



<script type="text/javascript">

	function editar(id, paciente, procedimento, profissional, data_inicial, data_final, frequencia, hora1, hora2, hora3, hora4, hora5, hora6, hora7){
		

		aparecer();

		$('#mensagem').text('');

    	$('#titulo_inserir').text('Editar Registro');



    	$('#id-tratamento').val(id);

    	$('#paciente').val(paciente).change();

    	$('#procedimento').val(procedimento);


    	$('#profissional').val(profissional);

    	$('#data-inicial').val(data_inicial);

    	$('#data-final').val(data_final);

    	$('#frequencia').val(frequencia);

    	$('#hora1').val(hora1);

    	$('#hora2').val(hora2);

    	$('#hora3').val(hora3);

    	$('#hora4').val(hora4);

    	$('#hora5').val(hora5);

    	$('#hora6').val(hora6);
    	$('#hora7').val(hora7);
    

    

    	$('#modalForm').modal('show');

    	

	}



	function mostrar(id, data_i, data_f, servico, func, valor){



		


		$('#data_i_dados').text(data_i);

		$('#data_f_dados').text(data_f);





		$('#nome_serv_dados').text(servico);

		$('#nome_func_dados').text(func);

		$('#valor_dados').text(valor);

		$('#id_trt').val(id);

		$('#modalDados').modal('show');

		listar_agd();

	}



	function baixar1(id, valor, valor_serv, pendentes, paciente, servico, vals, profissional){


		$('#funcionario_agd').val(profissional).change();

		$('#valor_serv_agd').val(vals);

		$('#id_tr').val(id);

		$('#cliente_agd').val(paciente);


		$('#vals').val(vals);


		$('#servico_agd').val(servico);


		$('#ag_p').val(pendentes);

		$('#valor_unit').val(valor_serv);

		$('#modalServico').modal('show');

	}













	function limparCampos(){

		$('#id').val('');

    	$('#id-tratamento').val('');

    	$('#paciente').val('').change();

    	$('#procedimento').val('');


    	$('#profissional').val('');

    	$('#data-inicial').val('');

    	$('#data-final').val('');

    	$('#frequencia').val('');

    	$('#hora1').val('');

    	$('#hora2').val('');

    	$('#hora3').val('');

    	$('#hora4').val('');

    	$('#hora5').val('');

    	$('#hora6').val('');
    	$('#hora7').val('');

	}



	function selecionar(id){



		var ids = $('#ids').val();



		if($('#seletor-'+id).is(":checked") == true){

			var novo_id = ids + id + '-';

			$('#ids').val(novo_id);

		}else{

			var retirar = ids.replace(id + '-', '');

			$('#ids').val(retirar);

		}



		var ids_final = $('#ids').val();

		if(ids_final == ""){

			$('#btn-deletar').hide();

		}else{

			$('#btn-deletar').show();

		}

	}



	function deletarSel(){

		var ids = $('#ids').val();

		var id = ids.split("-");

		

		for(i=0; i<id.length-1; i++){

			excluir(id[i]);			

		}



		limparCampos();

	}

</script>