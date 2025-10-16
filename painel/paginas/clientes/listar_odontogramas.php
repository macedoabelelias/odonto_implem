<?php 
require_once("../../../conexao.php");
$pagina = 'odontogramas';

$paciente = @$_POST['paciente'];


echo '<select class="sel450" name="odontograma" id="odontograma" style="width:100%;" required>';
echo '<option value="0">Selecionar Odontograma</option>';

$query = $pdo->query("SELECT * FROM odontograma where paciente = '$paciente' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){}
	$id_cliente = $res[0]['id'];
	echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['descricao'].'</option>';

}

echo '</select>';

?>



	<script type="text/javascript">
			$(document).ready(function() {	
					
				$('.sel450').select2({
				dropdownParent: $('#modalFicha')
			});
				
			});

			
	</script>