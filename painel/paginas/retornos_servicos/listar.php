<?php
@session_start();
$id_usuario = @$_SESSION['id'];
$tabela = 'agendamentos';
require_once("../../../conexao.php");


$data_hoje = date('Y-m-d');
$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual . "-" . $mes_atual . "-01";
$data_inicio_ano = $ano_atual . "-01-01";


$data_ontem = date('Y-m-d', @strtotime("-1 days", @strtotime($data_atual)));
$data_amanha = date('Y-m-d', @strtotime("+1 days", @strtotime($data_atual)));


if ($mes_atual == '04' || $mes_atual == '06' || $mes_atual == '07' || $mes_atual == '09') {
	$data_final_mes = $ano_atual . '-' . $mes_atual . '-30';
} else if ($mes_atual == '02') {
	$bissexto = date('L', @mktime(0, 0, 0, 1, 1, $ano_atual));
	if ($bissexto == 1) {
		$data_final_mes = $ano_atual . '-' . $mes_atual . '-29';
	} else {
		$data_final_mes = $ano_atual . '-' . $mes_atual . '-28';
	}
} else {
	$data_final_mes = $ano_atual . '-' . $mes_atual . '-31';
}


$dataInicial = @$_POST['p1'];
$dataFinal = @$_POST['p2'];


if ($dataInicial == "") {
	$dataInicial = $data_inicio_mes;
}

if ($dataFinal == "") {
	$dataFinal = $data_final_mes;
}




$query = $pdo->query("SELECT * from $tabela WHERE data_retorno_alerta >= '$dataInicial' and data_retorno_alerta <= '$dataFinal' and alertado is null order by data_retorno_alerta asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if ($linhas > 0) {
	echo <<<HTML
<small>
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead>
	<tr>
			
				<th>Serviço</th>
                <th class="esc">Paciente</th> 
                <th class="esc">Telefone</th> 
				<th class="esc">Total</th>	
                <th class="esc">Data</th>  			
                <th class="esc">Profissional</th>  
                <th class="">Retorno</th> 
                <th class="">Mensagem</th> 
	</tr>
	</thead>
	<tbody>
	<small>
HTML;

	$total_produtos = 0;
	$total_valor = 0;
	for ($i = 0; $i < $linhas; $i++) {
			
$id = $res[$i]['id'];
    $servico = $res[$i]['servico'];    
    $valor = $res[$i]['valor'];    
    $data = $res[$i]['data'];   
    $funcionario = $res[$i]['funcionario'];
    $cliente = $res[$i]['paciente'];    
    $data_retorno = $res[$i]['data_retorno_alerta'];
    
    $valorF = number_format($valor, 2, ',', '.');   
   
    $query2 = $pdo->query("SELECT * from procedimentos where id = '$servico'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    @$nome_servico = $res2[0]['nome'];

    $query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    @$nome_func = $res2[0]['nome'];
    
    $query2 = $pdo->query("SELECT * from clientes where id = '$cliente'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    @$nome_cliente = $res2[0]['nome'];
    @$telefone_cliente = $res2[0]['telefone'];
    @$email = $res2[0]['email'];

   	

$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_retornoF = implode('/', array_reverse(@explode('-', $data_retorno)));

if(strtotime($data_retorno) > strtotime($data_hoje)){
	$classe_retorno = 'green';
}else{
$classe_retorno = 'red';
}

		echo <<<HTML
<tr>

<td>{$nome_servico}</td>
<td class="esc">{$nome_cliente}</td>
<td class="esc">{$telefone_cliente}</td>
<td class="esc">R$ {$valorF}</td>
<td class="esc">{$dataF}</td>
<td class="esc">{$nome_func}</td>
<td class="" style="color:{$classe_retorno}">{$data_retornoF}</td>
<td>
	<a href="#" class="btn btn-success-light btn-sm " onclick="modalWhats('{$cliente}','Cliente', '{$email}')" title="Enviar Mensagem para o Cliente"><i class="fa-solid fa-paper-plane"></i></a>

	<a href="#" class="btn btn-info btn-sm " onclick="confirmarRetorno('{$id}')" title="Confirmar alerta de Retorno"><i class="fa fa-check"></i></a>
</td>

</tr>
HTML;
	}

echo <<<HTML
</small>
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>

</table>
</small>
<br>
HTML;
} else {
	echo '<small>Nenhum Registro Encontrado!</small>';
}
?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();
	    
	} );

</script>


	<script type="text/javascript">
		function modalWhats(id, tipo, email) {
		$('#id_whats').val(id);
		$('#tipo_whats').val(tipo);		
		$('#email_whats').val(email);
		$('#mensagem_whatsapp').val('');
		$('#modalWhats').modal('show');
	}




function confirmarRetorno(id){
    $('#mensagem-excluir').text('Confirmando...')


    $('body').removeClass('timer-alert');
		swal({
		  title: "Deseja Confirmar?",
		  text: "Esse retorno não aparecerá mais aqui!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn btn-primary",
		  confirmButtonText: "Sim, Confirmar!",
          container: 'swal-whatsapp-container',
		  closeOnConfirm: true
			
		},
		function(){
			
		  //swal("Excluído(a)!", "Seu arquivo imaginário foi excluído.", "success");


           $.ajax({
        url: 'paginas/' + pag + "/confimar.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {                              
                buscar();                
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
		});

}

	</script>