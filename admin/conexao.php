<?php
$msg[0] = "Conex&atilde;o com o banco falhou!";
$msg[1] = "N&atilde;o foi poss&iacute;vel selecionar o banco de dados!";
$conexao = @mysql_pconnect("localhost","root","") or die($msg[0]);
mysql_select_db("bvcontabilidade",$conexao) or die($msg[1]);
?>