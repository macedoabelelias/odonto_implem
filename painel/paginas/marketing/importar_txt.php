<?php 	
$id_empresa = 0;
// Verifica se o arquivo foi enviado
if (isset($_FILES['arquivo_texto']) && $_FILES['arquivo_texto']['error'] == 0) {
	$arquivo_tmp = $_FILES['arquivo_texto']['tmp_name'];

    $linhas = file($arquivo_tmp); // Lê todas as linhas do txt

    foreach ($linhas as $linha) {
        $dados = explode(';', trim($linha)); // Divide por ;

        if (count($dados) >= 2) {
        	$nome = trim($dados[0]);
        	$telefone = trim($dados[1]);

        	if($hora_disparo == "agora"){
        		$hora = date('H:i:s');
        	}else{
        		$hora_array = explode(':', $hora_disparo);
        		$hora_formatada = $hora_array[0];
        		$minuto_randomico = rand(0, 59);
        		$hora = $hora_formatada . ':' . str_pad($minuto_randomico, 2, '0', STR_PAD_LEFT);
        	}

        	if ($nome != '' && $telefone != '') {	
		            // Insere no banco de dados
			        	$stmt = $pdo->prepare("INSERT INTO disparos (campanha, cliente, nome, telefone, hora, empresa, data_disparo) VALUES (:campanha, :cliente, :nome, :telefone, :hora, :empresa, :data)");
			        	$stmt->execute([
			        		':campanha' => $id,
			        		':cliente' => 0,
			        		':nome' => $nome,
			        		':telefone' => $telefone,
			        		':hora' => $hora,
			        		':empresa' => $id_empresa,
			        		':data' => $data_disparo
			        	]);
        		}



        		if($frequencia > 0){
					for ($if = 2; $if <= $quantidade; $if++) {
						$dias_frequencia = $frequencia;
						$dias_parcela = $if - 1;
						$dias_parcela_2 = ($if - 1) * $dias_frequencia;
						
						if ($dias_frequencia == 30 || $dias_frequencia == 31) {

							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else if ($dias_frequencia == 90) {
							$dias_parcela = $dias_parcela * 3;
							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else if ($dias_frequencia == 180) {

							$dias_parcela = $dias_parcela * 6;
							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else if ($dias_frequencia == 360 || $dias_frequencia == 365) {

							$dias_parcela = $dias_parcela * 12;
							$nova_data = date('Y/m/d', strtotime("+$dias_parcela month", strtotime($data_disparo)));

						} else {

							$nova_data = date('Y/m/d', strtotime("+$dias_parcela_2 days", strtotime($data_disparo)));
						}

						if ($nome != '' && $telefone != '') {	
		            // Insere no banco de dados
			        	$stmt = $pdo->prepare("INSERT INTO disparos (campanha, cliente, nome, telefone, hora, empresa, data_disparo) VALUES (:campanha, :cliente, :nome, :telefone, :hora, :empresa, :data)");
			        	$stmt->execute([
			        		':campanha' => $id,
			        		':cliente' => 0,
			        		':nome' => $nome,
			        		':telefone' => $telefone,
			        		':hora' => $hora,
			        		':empresa' => $id_empresa,
			        		':data' => $nova_data
			        	]);
        		}

					}
				}
        }
    }   

    
}
 ?>