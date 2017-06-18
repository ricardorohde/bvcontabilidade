<?php
include("../../conexao.php");
include("../../funcaoform.php");

$op = seguranca($_GET['op']);

$form = @$_POST;

if($op == "novo")
{
	
	$form["aliquota9-string"] = implode("|",str_replace(",",".",str_replace(".","",$form['aliquota9-cond'])));
	$form["aliquota11-string"] = implode("|",str_replace(",",".",str_replace(".","",$form['aliquota11-cond'])));
	
	$sql = executa($form, "aliquotas_inss", "edita", "id = '1'");

	if($sql)
		header("Location: ../../index.php?pag=cad_aliquota_inss");
	else
		echo "Erro";
}

else if($op == "novoirpf")
{
	$form["aliquota0-string"] = implode("|",str_replace(",",".",str_replace(".","",$form['aliquota0-cond'])));
	$form["aliquota7_5-string"] = implode("|",str_replace(",",".",str_replace(".","",$form['aliquota7_5-cond'])));
	$form["aliquota15-string"] = implode("|",str_replace(",",".",str_replace(".","",$form['aliquota15-cond'])));
	$form["aliquota22_5-string"] = implode("|",str_replace(",",".",str_replace(".","",$form['aliquota22_5-cond'])));
	$form["aliquota27_5-string"] = implode("|",str_replace(",",".",str_replace(".","",$form['aliquota27_5-cond'])));
	
	$sql = executa($form, "aliquotas_irpf", "edita", "id = '1'");

	if($sql)
		header("Location: ../../index.php?pag=cad_aliquota_irpf");
	else
		echo "Erro";
}

?>