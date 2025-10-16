<?php 
require_once("../../../conexao.php");

$valor = @$_POST['valor'];

echo '<select class="sel2" name="remedio" id="remedio" style="width:100%;" onchange="mudarRemedio()">';

if($valor == ""){
	echo '<option value="">Selecionar Remédio</option>';
}

$query = $pdo->query("SELECT * FROM receitas order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){}

	echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['remedio'].'</option>';

}

echo '</select>';

?>


	<script type="text/javascript">
			$(document).ready(function() {				
				$('.sel2').select2({
					dropdownParent: $('#modalReceita')
				});
			});

			
	</script>