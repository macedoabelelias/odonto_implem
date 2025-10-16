<?php 
@session_start();
$id_usuario = @$_SESSION['id'];
$nome_usuario  = $_SESSION['nome'];

$tabela = 'dispositivos';

require_once("../../../conexao.php");

$data_atual = date('Y-m-d');

$dataAtual = date("Y-m-d");
$query = $pdo->prepare("SELECT * FROM $tabela where status_api IS NOT NULL");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);


if($res)
{

echo <<<HTML
<small>
<table class="table table-hover table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
     <thead>
        <tr>
            <th scope="col" style="padding-left: 50px !important;">ID</th>
            <th scope="col" style="padding-left: 50px !important;">Telefone</th>
            <th scope="col" style="padding-left: 190px !important; ">Appkey</th>
            <th scope="col" style="padding-left: 100px !important;">Status</th>
            <th scope="col" style="padding-left: 120px !important; p">Ações</th>
        </tr>
    </thead>
<tbody>
HTML;


$i = 0;
foreach($res as $dispositivos)
{
$i++;
$id = $dispositivos['id'];
$appkey = $dispositivos['appkey'];
$status = $dispositivos['status'];
$telefone = $dispositivos['telefone'] ?? '';
$nucleo = $dispositivos['nucleo'] ?? '';


?>

<tr style="" class="tabelaResultados">
    <td><?= $i; ?></td>
    <td><?= $telefone; ?></td>
    <td><?= $appkey;?></td>
    <td><?=$status;?></td>
    <td>
    	
<a href="#" class="btn btn-danger-light btn-sm" onclick="excluirDisp('<?= $id; ?>')" title="Excluir"><i class="fa fa-trash-can"></i></a>

<a href="#" class="btn btn-dark-light btn-sm" onclick="add('<?= $appkey; ?>'); $('#modaldispositivo').modal('show');" title="Reconectar Dispositivo">
                <i class="fa fa-wifi" ></i>
            </a>

<a href="#" class="btn btn-info-light btn-sm" onclick="testarApiDisp()" title="Testar Api"><i class="fa fa-clipboard-check"></i></a>

    </td>
</tr>



<?php



}





echo <<<HTML

</tbody>

<small><div align="center" id="mensagem-excluir"></div></small>

</table>

<br>

<div align="right">


</div>

HTML;



}else{

	echo '<small>Nenhum Registro Encontrado!</small>';

}

?>

<script>

   function alterarStatus(status, id = '')
   {
        
        if (status !== 'bloqueado') 
        {
            $.ajax({
                url: 'paginas/' + pag + '/status.php', // Verifique se 'pag' está definido corretamente
                method: 'POST',
                data: { status: status, id: id }, // Enviar status e id como objeto
                dataType: 'text',
                success: function(mensagem) {
                    listar();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição:', error);
                }
            });
        } else {
            $.ajax({
                url: 'paginas/' + pag + '/excluir.php', // Verifique se 'pag' está definido corretamente
                method: 'POST',
                data: { id: id }, // Apenas enviar id para a exclusão
                dataType: 'text',
                success: function(mensagem) {
                    listar();
                    location.reload();

                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição:', error);
                }
            });
        }
    }

</script>



<script type="text/javascript">
    function testarApiDisp() {
        var seletor_api = "<?=$api_whatsapp?>";
        var token = "<?=$token_whatsapp?>";
        var instancia = "<?=$instancia_whatsapp?>";
        var telefone_sistema = "<?=$telefone_sistema?>";

        $.ajax({
            url: 'apis/teste_whatsapp.php',
            method: 'POST',
            data: {
                seletor_api,
                token,
                instancia,
                telefone_sistema
            },
            dataType: "html",

            success: function(result) {
                alertWarning(result)
            }
        });
    }
</script>



