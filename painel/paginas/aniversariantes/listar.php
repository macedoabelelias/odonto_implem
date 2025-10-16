<?php 
$tabela = 'clientes';
require_once("../../../conexao.php");

$pagina = 'aniversariantes';
$dataMes = Date('m');
$dataDia = Date('d');

$filtrar = @$_POST['p1'];

if(@$filtrar == "dia"){
	$classe_dia = 'text-primary';
	$classe_mes = 'text-dark';

	$query = $pdo->query("SELECT * FROM $tabela where month(data_nasc) = '$dataMes' and day(data_nasc) = '$dataDia' order by data_nasc asc, id desc");
		
}else{
	$classe_mes = 'text-primary';
	$classe_dia = 'text-dark';

	$query = $pdo->query("SELECT * FROM $tabela where month(data_nasc) = '$dataMes' order by data_nasc asc, id desc");
	
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$linhas = @count($res);

if($linhas > 0){

echo <<<HTML

<small>

	<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">

	<thead> 

	<tr> 

	<th>Nome</th>	
	<th class="esc">Telefone</th>	
	<th class="esc">Idade</th>	
	<th class="esc">Profissão</th>	
	<th class="esc">Nascimento</th>
	<th class="esc">Convênio</th>

	<th>Whatsapp</th>

	</tr> 

	</thead> 

	<tbody>	

HTML;





for($i=0; $i<$linhas; $i++){

	$id = $res[$i]['id'];

	$nome = $res[$i]['nome'];

	$telefone = $res[$i]['telefone'];

	$cpf = $res[$i]['cpf'];	

	$endereco = $res[$i]['endereco'];	

	$data_cad = $res[$i]['data_cad'];

	$data_nasc = $res[$i]['data_nasc'];	

	$convenio = $res[$i]['convenio'];

	$tipo_sanguineo = $res[$i]['tipo_sanguineo'];

	$nome_responsavel = $res[$i]['nome_responsavel'];

	$cpf_responsavel = $res[$i]['cpf_responsavel'];

	$sexo = $res[$i]['sexo'];

	$obs = $res[$i]['obs'];

	$estado_civil = $res[$i]['estado_civil'];

	$profissao = $res[$i]['profissao'];
	$telefone2 = @$res[$i]['telefone2'];


	$tel_pessoaF = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);



	$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

	$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));



	$query2 = $pdo->query("SELECT * from convenios where id = '$convenio'");

$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

$linhas2 = @count($res2);

if($linhas2 > 0){

	$nome_convenio = $res2[0]['nome'];

}else{

	$nome_convenio = 'Nenhum';

}



//idade do paciente

	// separando yyyy, mm, ddd

    list($ano, $mes, $dia) = explode('-', $data_nasc);

    // data atual

    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

    // Descobre a unix timestamp da data de nascimento do fulano

    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

    // cálculo

    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);





echo <<<HTML

<tr>

<td>
{$nome} <span style="display:none;">{$cpf}</span>

</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$idade} anos</td>

<td class="esc">{$profissao}</td>

<td class="esc">{$data_nascF}</td>

<td class="esc">{$nome_convenio}</td>


<td>
			<big><a class="btn btn-success-light btn-sm" href="http://api.whatsapp.com/send?1=pt_BR&phone={$tel_pessoaF}" title="Whatsapp" target="_blank"><i class="bi bi-whatsapp " style="color:green"></i></a></big>


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

	$(document).ready( function () {		

    $('#tabela').DataTable({

    	"language" : {

            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'

        },

        "ordering": false,

		"stateSave": true

    });

} );

</script>


