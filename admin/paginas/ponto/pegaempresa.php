<?php
include("../../conexao.php");
include("../../funcaoform.php");

$id_empresa = seguranca($_POST['id_empresa']);
$sql = mysql_query("SELECT * FROM empresas_ponto WHERE id = '".$id_empresa."'");

$reg = mysql_fetch_row($sql);

foreach($reg as $indice => $info)
{
	$regs[$indice] = html_entity_decode($info);	
}
echo implode("|",$regs);
?>
