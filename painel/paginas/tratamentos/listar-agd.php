<?php 

require_once("../../../conexao.php");

@session_start();

$usuario = @$_SESSION['id'];



$id_trt = @$_POST['id_tr'];

$tabela = 'tabela';


if ($tabela != 'horarios') {

echo <<<HTML

<small>

HTML;




if ($tabela == 'card') {

	$esconder_tabela = 'ocultar';

	$esconder_card = '';

}else{

	$esconder_tabela = '';

	$esconder_card = 'ocultar';

}	

$query = $pdo->query("SELECT * FROM agendamentos where id_tratamento = '$id_trt' order by data asc, hora asc");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$total_reg = @count($res);

if($total_reg > 0){

	echo <<<HTML

<small>

	<table class="table table-hover {$esconder_tabela}" id="">

	<thead> 

	<tr>

	<th>Hora</th>

	<th>Paciente</th>	

	

	<th>Procedimento</th>

	<th>Data</th>		

	

	<th>Ações</th>

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

$valor_agg = @$res[$i]['valor'];

$id_tratamento = @$res[$i]['id_tratamento'];

$usuario = $res[$i]['usuario'];

$data_lanc = $res[$i]['data_lanc'];

$obs = $res[$i]['obs'];

$status = $res[$i]['status'];

$servico = $res[$i]['servico'];

$pago = $res[$i]['pago'];

$st = $res[$i]['status_cor'];

$tipo_pagamento = $res[$i]['tipo_pagamento'];

$retorno = $res[$i]['retorno'];

$id_tratamento = $res[$i]['id_tratamento'];



$novo_status = $res[$i]['status_cor'];



$dataF = implode('/', array_reverse(explode('-', $data)));

$horaF = date("H:i", strtotime($hora));





if($status == 'Concluído'){		

	$classe_linha = '';

}else{		

	$classe_linha = 'text-muted';

}



$ocultar_confirmacao = '';



if($status == 'Agendado'){

	$imagem = 'icone-relogio.png';

	$classe_status = '';	

}else if($status == 'Finalizado'){

	$imagem = 'icone-relogio-verde.png';

	$classe_status = 'ocultar';

	$ocultar_confirmacao = 'ocultar';

}if($status == 'Confirmado'){

	$imagem = 'icone-relogio-azul.png';

	$classe_status = 'ocultar';

	$ocultar_confirmacao = 'ocultar';

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





$query2 = $pdo->query("SELECT * FROM procedimentos where id = '$servico'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

if(@count($res2) > 0){

	$nome_serv = $res2[0]['nome'];

	$valor_serv = $res2[0]['valor'];

	$aceita_convenio = $res2[0]['convenio'];

}else{

	$nome_serv = 'Não Lançado';

	$valor_serv = '';

	$aceita_convenio = @$res2[0]['convenio'];

}





$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

if(@count($res2) > 0){

	$nome_cliente = $res2[0]['nome'];

	$telefone_pac = $res2[0]['telefone'];

	

}else{

	$nome_cliente = 'Sem Paciente';

	

}



$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

if(@count($res2) > 0){

	$nome_func = $res2[0]['nome'];

	

}else{

	$nome_func = '';

	

}

$tel_whatsF = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_pac);

 $nome_func = mb_strimwidth($nome_func, 0, 25, "...");





//retirar aspas do texto do obs

$obs = @str_replace('"', "**", $obs);



echo <<<HTML

			<div class="col-xs-12 col-md-4 widget cardTarefas {$esconder_card}">

        		<div class="r3_counter_box">




		<div class="row">

        		<div class="col-md-3">





				<li class="dropdown head-dpdn2" style="list-style-type: none;">

				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

		<img class="icon-rounded-vermelho" src="img/{$imagem}" width="45px" height="45px">

				</a>



		<ul class="dropdown-menu" style="margin-left:-30px;">

		<li>

		<div class="notification_desc2">

		<p>Observações: {$obs}</p>

		</div>

		</li>										

		</ul>

		</li>

        			 

        		</div>

        		<div class="col-md-9">

        			<h5><strong>{$horaF}</strong> 



        		

        		


        			<a class="" href="#" onclick="editar('{$id}','{$cliente}','{$funcionario}','{$servico}','{$data}','{$obs}','{$retorno}')" title="Editar Agendamento" class=""> <img class="icon-rounded-vermelho" src="img/editar.png" width="15px" height="15px"></a>



        			


        			</h5>



        			

        		</div>





        		</div>

        		

        					

        		<hr style="margin-top:-2px; margin-bottom: 3px">                    

                    <div class="stats esc" align="center">

                      <span>

                      

                        <small> {$nome_cliente}<br> (<i><span style="color:#061f9c; font-size: 12px">{$nome_serv}</span></i>)</small></span>

                    </div>

                </div>

        	</div>

HTML;

if ($st == '' and $status == 'Confirmado') {

	$st = 'Aguardando Paciente';

}else if ($st == ''){

	$st = 'Aguardando Confirmação';

}





if ($status == 'Confirmado') {

	$amarelo = 'text-primary';

	$nao_exibir = '';



}else{

	$amarelo = '';

	$nao_exibir = 'ocultar';

}

$status_atual = 'Aguardando Paciente';





if ($st == 'Em espera') {

	$amarelo = 'em-espera';

}else if ($st == 'Em atendimento') {

	$amarelo = 'em-atendimento';

}else if ($st == 'Prioridade') {

	$amarelo = 'Prioridade';

}







echo <<<HTML

<tr>



<td class="esc">{$hora}</td>

<td class="{$amarelo}" id="campoDestino">

{$nome_cliente}

</td>







<td class="esc">{$nome_serv} <span class="text-primary"><small>({$nome_func})</small></span></td>

<td class="" >

<li class="dropdown head-dpdn2  " style="list-style-type: none; display:inline-block;">

				<a  href="#" class="{$nao_exibir}" data-toggle="dropdown" aria-expanded="false">

		<img class="icon-rounded-vermelho" src="img/editar.png" width="15px" height="15px">

				</a>



	

		</li>

{$dataF}

		





</td>







<td>





	<big><a class="" href="#" onclick="editar('{$id}','{$cliente}','{$funcionario}','{$servico}','{$data}','{$obs}','{$retorno}','{$id_tratamento}','{$valor_agg}','{$horaF}','{$dataF}','{$pago}','{$tipo_pagamento}')" title="Editar Agendamento" class=""> <img class="icon-rounded-vermelho" src="img/editar.png" width="15px" height="15px"></a>

</big>











</td>

</tr>

HTML;

}



}else{

	echo 'Nenhum horário para essa Data!';

}


}else{
	//aqui vai a opcao dos horarios
	echo '<div id="listar_horarios_disp"></div>';
}


?>











<script type="text/javascript">

	function baixar(id, cliente, servico, valor_servico, convenio, funcionario, id_servico, retorno){

		//alert(valor_servico)
		


		if(convenio != "Sim"){

			$('#div_convenio').hide();

		}



		$('#procedimento').text("Procedimento");



		if(retorno == "Sim"){

			$('#valor_serv_agd').val("0");

			$('#procedimento').text("Retorno");

		}else{

			$('#valor_serv_agd').val(valor_servico);

		}





	

		$('#id_agd').val(id);

		$('#cliente_agd').val(cliente);		

		$('#servico_agd').val(id_servico);	

			

		$('#funcionario_agd').val(funcionario).change();	

		$('#titulo_servico').text(servico);

		$('#descricao_serv_agd').text(servico);

		$('#modalServico').modal('show');

	}



	function confirmar(id){

		 $.ajax({

        url: 'paginas/' + pag + "/confirmar.php",

        method: 'POST',

        data: {id},

        dataType: "html",



        success:function(mensagem){

             

            if (mensagem.trim() == "Confirmado com Sucesso") {  



                listar();

            } else {

                $('#mensagem-excluir').addClass('text-danger')

                $('#mensagem-excluir').text(mensagem)

            }

        }

    });

	}





	function editar(id, paciente, funcionario, servico, data, obs, retorno, trat, val_agg, hora, dataF, pago, tipo_pgto){



		$('#mensagem').text('');

    	$('#titulo_inserir_editar').text(dataF + ' ás ' +hora);



    	if(retorno == ""){

    		retorno = 'Não';

    	}



    	$('#idd').val(id);
    	$('#pago_agd').val(pago);
    	$('#tipo_pago_agd').val(tipo_pgto);

    	$('#cliente').val(paciente).change();



    	

    	$('#funcionario_modal').val(funcionario).change();

    	$('#data-modal').val(data).change();

    	$('#obs').val(obs);

    	$('#id_trat').val(trat);

    	$('#val_agg').val(val_agg);

    	$('#retorno').val(retorno).change();	

    	



    	setTimeout(function(){

	$('#servico').val(servico).change();	

		}, 500); 

    	

    

    	$('#modalForm2').modal('show');

    	$('#modalDados').modal('hide');
    	listarPacientes();

	}





function excluirAgendamento(id){	

    $('#mensagem-excluir').text('Excluindo...')

    

    $.ajax({

        url: 'paginas/' + pag + "/excluir.php",

        method: 'POST',

        data: {id},

        dataType: "html",



        success:function(mensagem){

             //alert(mensagem)

            if (mensagem.trim() == "Excluído com Sucesso") {  



                listar();

                listarHorarios();

            } else {

                $('#mensagem-excluir').addClass('text-danger')

                $('#mensagem-excluir').text(mensagem)

            }

        }

    });

}

</script>





<script type="text/javascript">

function alterarCorCelaDestino(cor, status, id) {



    var campoDestino = document.getElementById('campoDestino');



    campoDestino.style.backgroundColor = cor;

     campoDestino.classList.remove('amarelo');





     $.ajax({

        url: 'paginas/' + pag + "/alterar_stat.php",

        method: 'POST',

        data: {cor,status,id},

        dataType: "html",



        success:function(mensagem){

             //alert(mensagem)

            if (mensagem.trim() == "Alterado com Sucesso") {  



                listar();

                listarHorarios();

            } else {

                $('#mensagem-excluir').addClass('text-danger')

                $('#mensagem-excluir').text(mensagem)

            }

        }

    });

}





   





</script>



<script type="text/javascript">

function alterarCorCelaDestino2(cor) {

    var campoDestino = document.getElementById('campoDestino');

    campoDestino.style.backgroundColor = cor;

     campoDestino.classList.remove('amarelo');

}	





</script>



<script type="text/javascript">

function alterarCorCelaDestino3(cor) {

    var campoDestino = document.getElementById('campoDestino');

    campoDestino.style.backgroundColor = cor;

     campoDestino.classList.remove('amarelo');





}	





</script>