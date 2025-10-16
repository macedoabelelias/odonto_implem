<?php
$pag = 'aniversariantes';

if (@$aniversariantes == 'ocultar') {
	echo "<script>window.location='index'</script>";
	exit();
}

?>


<div  style="display: inline-block; font-size: 14px; padding:5px; margin-top: 20px!important;">
			<span class="ocultar_mobile" style="">
				<button class="btn btn-primary btn-sm" href="#" onclick="buscar('mes')">Aniversáriantes do Mês</button> / 
				<button class="btn btn-success btn-sm" href="#" onclick="buscar('dia')">Aniversáriantes do Dia</button>
		</div>

<div class="row row-sm">
	<div class="col-lg-12">
		<div class="card custom-card">
			<div class="card-body" id="listar">

			</div>
		</div>
	</div>
</div>

<input type="hidden" id="ids">


<script type="text/javascript">var pag = "<?= $pag ?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">

		function buscar(tipo){	

			listar(tipo);
		}

		</script>