<?php
$pag = 'retornos_servicos';

if (@$retornos_servicos == 'ocultar') {
	echo "<script>window.location='index'</script>";
	exit();
}


?>

<div class="justify-content-between">
	<form action="rel/servicos_retornos_class.php" target="_blank" method="POST">
		<div class="left-content mt-2">
			
			<div style="display: inline-block; position:absolute; right:10px; margin-bottom: 10px">
				<button style="width:130px" type="submit" class="btn btn-primary ocultar_mobile_app" title="Gerar Relatório"><i
						class="fa fa-file-pdf-o"></i> Relatório</button>
					</div>
			
		
			<!--============================= DATA INICIAL E FINAL ===================-->
			<div style="display: inline-block; margin-bottom: 10px">
				<input style="height:35px; width:49%; font-size: 13px;" type="date" class="form-control2" name="dataInicial"
					id="dataInicial" value="<?php echo $data_inicio_mes ?>" required onchange="buscar()">
				<input style="height:35px; width:49%; font-size: 13px" type="date" name="dataFinal" id="dataFinal"
					class="form-control2" value="<?php echo $data_final_mes ?>" required onchange="buscar()">
			</div>


			
		</div>
		<input type="hidden" name="tipo_data" id="tipo_data">
		<input type="hidden" name="pago" id="pago">
		<input type="hidden" name="tipo_data_filtro" id="tipo_data_filtro">
	</form>

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



<!-- Modal Whats -->
<div class="modal fade" id="modalWhats" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">Enviar Mensagem no WhatsApp</h4>
				<button id="btn-fechar-whats" aria-label="Close" class="btn-close" data-bs-dismiss="modal"
					type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">
				<label class="form-label mt-2">Mensagem <i class="fa-brands fa-whatsapp"></i></label>

				<!-- Botões de mensagens rápidas -->
				<div class="btn-group mb-2 w-100" role="group">
					<button type="button" class="btn btn-outline-success btn-sm" onclick="inserirCobranca()">
						<i class="fa fa-money"></i> Retorno
					</button>

					<button type="button" class="btn btn-outline-success btn-sm" onclick="inserirSuporte()">
						<i class="fa fa-life-ring"></i> Retorno Programado
					</button>

					<button type="button" class="btn btn-outline-success btn-sm" onclick="inserirSaudacao()">
						<i class="fa fa-smile-o"></i> Saudação
					</button>
				
					
					
				</div>

				<textarea id="mensagem_whatsapp" name="mensagem_whatsapp" class="form-control" rows="4"
					placeholder="Digite sua mensagem..." style="background-image: url('images/whatsapp.jpg'); 
							   background-size: cover;
							   background-position: center;
							   background-repeat: no-repeat;
							   opacity: 0.9;"></textarea>
			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ Fechar</button>
				<button type="button" class="btn btn-success" id="btn_enviar_whats" onclick="enviarWhats()">Enviar<i
						class="fa fa-paper-plane ms-2"></i></button>
				<button type="button" class="btn btn-success" id="btn_carregando_whats" style="display: none">
					<span class="spinner-border spinner-border-sm" role="status"
						aria-hidden="true"></span>Enviando...</button>
			</div>
			<input type="hidden" class="form-control" id="id_whats" name="id_whats">
			<input type="hidden" class="form-control" id="tipo_whats" name="tipo_whats">			
			<input type="hidden" class="form-control" id="email_whats" name="email_whats">
		</div>
	</div>
</div>


<script type="text/javascript">
	var pag = "<?= $pag ?>"
</script>
<script src="js/ajax.js"></script>



<script type="text/javascript">
	function buscar() {		
		var dataInicial = $('#dataInicial').val();
		var dataFinal = $('#dataFinal').val();
		
		listar(dataInicial, dataFinal)
	}	


	</script>





<script>
	function inserirSaudacao() {
		var hora = new Date().getHours();
		var saudacao = "";

		if (hora >= 5 && hora < 12) {
			saudacao = "Bom dia";
		} else if (hora >= 12 && hora < 18) {
			saudacao = "Boa tarde";
		} else {
			saudacao = "Boa noite";
		}

		var mensagem = `${saudacao}! 😊\nComo posso ajudar?`;
		inserirTexto(mensagem);
	}

	function inserirCobranca() {
	var mensagem = "📆 *LEMBRETE DE RETORNO* 📆\n\n" +
  "Olá! Tudo bem com você?\n\n" +
  "Notamos que já faz algum tempo desde o seu último atendimento aqui na clínica. 😊\n" +
  "Estamos à disposição para agendar seu retorno e garantir que sua saúde bucal continue em dia! 🦷💙\n\n" +
  "Caso esteja precisando de uma avaliação, manutenção ou novo procedimento, será um prazer te atender novamente!\n\n" +
  "Fale com a gente para agendar! 📲";
	inserirTexto(mensagem);
}


	function inserirSuporte() {
	var mensagem = "🔁 *RETORNO PROGRAMADO* 🔁\n\n" +
  "Olá! Esperamos que esteja tudo bem com você. 😊\n\n" +
  "De acordo com nosso sistema, está se aproximando o período ideal para o seu retorno à clínica. 🦷\n" +
  "Esse acompanhamento é importante para manter sua saúde bucal sempre em dia!\n\n" +
  "Se desejar, podemos agendar sua consulta com todo o cuidado e atenção de sempre. 💙\n\n" +
  "Estamos à disposição! 📲";
	inserirTexto(mensagem);
}


	function inserirTexto(novoTexto) {
		var textarea = document.getElementById('mensagem_whatsapp');
		var textoAtual = textarea.value;

		if (textoAtual) {
			textarea.value = textoAtual + "\n\n" + novoTexto;
		} else {
			textarea.value = novoTexto;
		}
	}
</script>



<script type="text/javascript">
		function enviarWhats() {
		let mensagem = document.getElementById('mensagem_whatsapp').value;
		let id = document.getElementById('id_whats').value;
		let tipo = document.getElementById('tipo_whats').value;

		if (mensagem.trim() === '') {
			alertWarning('Por favor, insira uma mensagem para enviar!');
			return;
		}

		$('#btn_enviar_whats').hide();
		$('#btn_carregando_whats').show();

		$.ajax({
			url: 'apis/enviar_whatsapp.php',
			method: 'POST',
			data: {
				id: id,
				mensagem: mensagem,
				tipo: tipo
			},
			success: function (response) {
				$('#btn_enviar_whats').show();
				$('#btn_carregando_whats').hide();

				if (response == 'Mensagem enviada com sucesso!') {
					alertsucesso(response);
					$('#mensagem_whatsapp').val('');
					$('#btn-fechar-whats').click();
					
				} else {
					alertErro(response);
				}
			},
			error: function (xhr, status, error) {
				$('#btn_enviar_whats').show();
				$('#btn_carregando_whats').hide();
				alertErro('Erro ao enviar mensagem: ' + error);
			},
			complete: function () {
				$('#mensagem_whatsapp').val(''); // Limpa o campo de mensagem
			}
		});
	}
</script>
