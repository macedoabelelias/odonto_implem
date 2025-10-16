<?php
require_once('../conexao.php');
$token = $token_whatsapp;
$instancia = $instancia_whatsapp;

function sendWhats($authkey, $appkey, $WhatsPaciente, $mensagem){
   $data = json_encode([
        'appkey' => $appkey,
        'authkey' => $authkey,
        'to' => $WhatsPaciente,
        'message' => $mensagem,
        'licence' => 'hugocursos'
    ]);

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://chatbot.menuia.com/api/create-message',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    return  $response;
}

$rawInput = file_get_contents('php://input');
$decoded = json_decode($rawInput, true);

// Adiciona metadados como data e hora
$logEntry = [
    'timestamp' => date('Y-m-d H:i:s'),
    'payload' => $decoded
];

$logLine = json_encode($logEntry, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
$logLine = "\n-----\n" . $logLine . "\n";
file_put_contents('payloads.txt', $logLine, FILE_APPEND);

// Retorna resposta como JSON
header('Content-Type: application/json');
$tipo = $decoded['tipo'] ?? false;
$mensagem = $decoded['mensagem'] ?? false;
$WhatsPaciente = $tipo == 'Sistema' ? ($decoded['destinatario'] ?? null) : ($decoded['remetente'] ?? null);
$hash = $decoded['idAgendamento'] ?? false;

// Sistema informando que enviou a mensagem
if ($hash && $tipo == 'Sistema') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM agendamentos WHERE hash = :hash and status = 'Agendado' order by id asc LIMIT 1");
        $stmt->bindParam(':hash', $hash);
        $stmt->execute();

        $agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($agendamento) {
            $data = json_encode([
                'appkey' => $token,
                'authkey' => $instancia,
                'checkDevice' => $WhatsPaciente,
                'licence' => 'hugocursos',
                'message' => 'false'
            ]);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://chatbot.menuia.com/api/settings',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response, true);
            $jid = $result['message']['jid'] ?? false;

            if (!empty($jid) && strpos($jid, '@') !== false) {
                $parts = explode('@', $jid);
                $novoHash = $parts[0];

                // Atualiza o hash no banco de dados
                $updateStmt = $pdo->prepare("UPDATE agendamentos SET hash = :novoHash WHERE id = :id");
                $updateStmt->bindParam(':novoHash', $novoHash);
                $updateStmt->bindParam(':id', $agendamento['id']);
                $updateStmt->execute();
            } else {
                echo json_encode([
                    'status' => 'erro',
                    'mensagem' => 'JID inválido ou não encontrado'.$response
                ]);
                exit();
            }

            echo json_encode([
                'status' => 'ok',
                'mensagem' => 'Agendamento encontrado e hash atualizado',
                'agendamento' => $agendamento,
                'novo_hash' => $novoHash
            ]);
        } else {
            echo json_encode([
                'status' => 'erro',
                'mensagem' => 'Agendamento não encontrado'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Erro no banco de dados: ' . $e->getMessage()
        ]);
    }
}elseif($tipo == 'Chat'){
    
    $hash = $WhatsPaciente;
    
    //Capturando agendamentos que ainda estão pendentes e 
    $stmt = $pdo->prepare("
        SELECT * FROM agendamentos 
        WHERE hash = :hash 
          AND status = 'Agendado' 
          AND CONCAT(data, ' ', hora) > NOW()
        LIMIT 1
    ");
    $stmt->bindParam(':hash', $hash);
    $stmt->execute();
    $agendamento = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($agendamento){
        
        $id = $agendamento['id'];
        
        if($mensagem == 1){
            $update = $pdo->prepare("UPDATE agendamentos SET status = 'Confirmado' WHERE id = :id");
            $update->bindParam(':id', $id);
            $update->execute();
            
            $mensagem = "Agendamento Confirmado com sucesso!";
            echo sendWhats($instancia, $token, $WhatsPaciente, $mensagem);
            
        }elseif($mensagem == 2){
            $deleteHorarios = $pdo->prepare("DELETE FROM horarios_agd WHERE agendamento = :id");
            $deleteHorarios->bindParam(':id', $id);
            $deleteHorarios->execute();
        
            $deleteAgendamento = $pdo->prepare("DELETE FROM agendamentos WHERE id = :id");
            $deleteAgendamento->bindParam(':id', $id);
            $deleteAgendamento->execute();
            
            $mensagem = "Agendamento Cancelado com sucesso!";
            echo sendWhats($instancia, $token, $WhatsPaciente, $mensagem);
        }
        
        
    }else{
        echo 'Nenhum agendamento encontrado';
        exit();
    }
    
    
}
else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Hash não fornecido'
    ]);
}
