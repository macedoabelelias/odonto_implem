<?php 
$tabela = 'itens_orc';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];
$desconto = @$_POST['desconto'];

$tipo_desconto = @$_POST['tipo_desconto'];

$id_orc = @$_POST['id'];


if($desconto == ""){
	$desconto = 0;
}


$total_v = 0;

//buscar o total da venda
if($id_orc == ""){
	$query = $pdo->query("SELECT * from $tabela where funcionario = '$id_usuario' and id_orcamento = '0' order by id asc");	
}else{
	$query = $pdo->query("SELECT * from $tabela where id_orcamento = '$id_orc' order by id asc");	
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){	
		$total_das_vendas = $res[$i]['total'];
		$total_v += $total_das_vendas;
	}
}

if($tipo_desconto == '%'){
	if($desconto > 0 and $total_v > 0){
		$total_final = -($total_v * $desconto / 100);
	}else{
		$total_final = 0;
	}
	
}else{
	$total_final = -$desconto;
}


if($id_orc == ""){
	$query = $pdo->query("SELECT * from $tabela where funcionario = '$id_usuario' and id_orcamento = '0' order by id desc");
}else{
	$query = $pdo->query("SELECT * from $tabela where funcionario = '$id_usuario' and id_orcamento = '$id_orc' order by id desc");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
echo '<div style="overflow:auto; max-height:270px; width:100%; scrollbar-width: thin;">';
echo '<table class="table table-bordered text-nowrap border-bottom dt-responsive ">';
	echo '<small> <thead> 
	<tr> 	
	<th>Procedimento</th>	
	<th align="center" class="">Quantidade</th>	
	<th align="center" class="esc">Valor Unit</th>	
	<th align="center" class="esc">Total</th>	
	<th align="center" class="esc">Ações</th>		
	</tr> 
	</thead> 
	<tbody>	
	</small>';
	

if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$produto = $res[$i]['produto'];
	$valor = $res[$i]['valor'];
	$quantidade = $res[$i]['quantidade'];
	$total = $res[$i]['total'];
	$descricao = $res[$i]['descricao'];

	$ocultar_desc = 'ocultar';
	if($descricao != ""){
		$ocultar_desc = '';
	}


	$total_final += $total;
	$total_finalF = number_format($total_final, 2, ',', '.');
	$valorF = number_format($valor, 2, ',', '.');
	$totalF = number_format($total, 2, ',', '.');
	
		

	$query2 = $pdo->query("SELECT * from procedimentos where id = '$produto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_produto = $res2[0]['nome'];
	

	$nome_produtoF = mb_strimwidth($nome_produto, 0, 24, "...");

	echo '<tr>';
	echo '<td > '.$nome_produtoF.'

	<div class="dropdown" style="display: inline-block;">                      
                        <a class="'.$ocultar_desc.'" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fa fa-info-circle text-warning"></i> </a>
                        <div  class="dropdown-menu tx-13">
                        <div style="width: 440px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                        <p style="font-weight:400">'.$descricao.'</p>
                        </div>
                        </div>
                        </div>

	</td>';
	echo '<td align="center"> 
	<a  href="#" onclick="diminuir('.$id.', '.$quantidade.')"><big><i class="fa fa-minus-circle text-danger" ></i></big></a> <input style="border:none; border-bottom:1px solid #000; outline:none; background:transparent; width:35px; text-align:center" id="quant_'.$id.'" value="'.$quantidade.'" onblur="editarItem('.$id.')">
	
	<a  href="#" onclick="aumentar('.$id.', '.$quantidade.')"><big><i class="fa fa-plus-circle text-success" ></i></big></a>
	</td>';
	echo '<td align="center"> R$ <input style="border:none; border-bottom:1px solid #000; outline:none; background:transparent; width:70px; text-align:center" id="valor_'.$id.'" value="'.$valorF.'" onblur="editarItem('.$id.')"> </td>';
	echo '<td align="center"> R$ '.$totalF.' </td>';
	echo '<td align="center"> 



		<big><a title="Remover Item" href="#" onclick="excluirItem('.$id.')"><i class="fa fa-trash" style="color:red"></i></a></big> 

		</td>';
	echo '</tr>'; 	
	
	
	}
}


echo '</table>';

$total_finalF = number_format($total_final, 2, ',', '.');
echo '<div align="right" style="margin-top:10px; font-size:14px; border-top:1px solid #8f8f8f;" >';
echo '<br>';
echo '<span style="margin-right:40px;">Itens: <b>('.$linhas.')</b></span>';
echo '<span>Subtotal: </span>';
echo '<span style="font-weight:bold"> R$ ';
echo $total_finalF;
echo '</span>';

echo '</div>';


?>

<script type="text/javascript">
	var itens = "<?=$linhas?>";
	
	$('#subtotal_venda').val('<?=$total_final?>')
	if(itens > 0){
		$("#btn_limpar").show();
		$("#btn_venda").show();
	}else{
		$("#btn_limpar").hide();
		$("#btn_venda").hide();
	}
	function excluirItem(id){
		 $.ajax({
        url: 'paginas/' + pag + "/excluir-item.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {           	
                listarItens();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
	}



	function editarItem(id){

		var valor = $('#valor_'+id).val();
		var quantidade = $('#quant_'+id).val();
		
		 $.ajax({
        url: 'paginas/' + pag + "/editar-item.php",
        method: 'POST',
        data: {id, valor, quantidade},
        dataType: "html",

        success:function(mensagem){
        	
            if (mensagem.trim() == "Editado com Sucesso") {  

                listarItens();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
	}

	function diminuir(id, quantidade){
		 $.ajax({
        url: 'paginas/' + pag + "/diminuir.php",
        method: 'POST',
        data: {id, quantidade},
        dataType: "html",

        success:function(mensagem){

            if (mensagem.trim() == "Excluído com Sucesso") {           	
                listarItens();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
	}


	function aumentar(id, quantidade){
		 $.ajax({
        url: 'paginas/' + pag + "/aumentar.php",
        method: 'POST',
        data: {id, quantidade},
        dataType: "html",

        success:function(mensagem){
        	
            if (mensagem.trim() == "Excluído com Sucesso") {           	
                listarItens();
            } else {
            	alert(mensagem)
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
	}

	
</script>