<?php 
$tabela = 'tratamentos';
require_once("../../../conexao.php");

$vezes = $_POST['vezes'];

echo '
<style>
.col-7-custom {
  width: 14.2857%;
  padding: 0 5px;
  float: left;
}
.row-clear::after {
  content: "";
  display: table;
  clear: both;
}
</style>

<div class="row-clear" style="margin-bottom: 10px; margin-top:15px">
  <div class="col-7-custom"><label>Segunda</label></div>
  <div class="col-7-custom"><label>Terça</label></div>
  <div class="col-7-custom"><label>Quarta</label></div>
  <div class="col-7-custom"><label>Quinta</label></div>
  <div class="col-7-custom"><label>Sexta</label></div>
  <div class="col-7-custom"><label>Sábado</label></div>
  <div class="col-7-custom"><label>Domingo</label></div>
</div>

<div class="row-clear">
  <div class="col-7-custom"><input type="time" class="form-control form-control-sm" name="hora1" id="hora1"></div>
  <div class="col-7-custom"><input type="time" class="form-control form-control-sm" name="hora2" id="hora2"></div>
  <div class="col-7-custom"><input type="time" class="form-control form-control-sm" name="hora3" id="hora3"></div>
  <div class="col-7-custom"><input type="time" class="form-control form-control-sm" name="hora4" id="hora4"></div>
  <div class="col-7-custom"><input type="time" class="form-control form-control-sm" name="hora5" id="hora5"></div>
  <div class="col-7-custom"><input type="time" class="form-control form-control-sm" name="hora6" id="hora6"></div>
  <div class="col-7-custom"><input type="time" class="form-control form-control-sm" name="hora7" id="hora7"></div>
</div>
';

	


?>