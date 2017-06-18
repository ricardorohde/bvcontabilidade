<?php
include("../../conexao.php");
include("../../funcaoform.php");

$op = seguranca($_GET['op']);

$form = @$_POST;

if($op == "novo")
{
	$id = seguranca(@$_GET['id']);
	
	$form['data-date'] = $form['data-cond']."/2015";
		
	if($id)
	{
		$condicao = "id = ".$id;
		$sql = executa($form, "sindicatos", "edita", $condicao);
	}
	else
	{
		$sql = executa($form, "sindicatos", "inserir", "");
	}
	
	
	if($sql)
		header("Location: ../../index.php?pag=lis_sindicatos");
	else
		echo "Erro";
}

else if($op == "exclui_sindicatos")
{
	$id = seguranca($_GET['id']);
	
	
	$sql = mysql_query("DELETE FROM sindicatos WHERE id = '".$id."'");

	if($sql)
		header("Location: ../../index.php?pag=lis_sindicatos");
	else
		echo "Erro";
}



else if($op == "publi_sindicatos")
{
	$sql = mysql_query("UPDATE sindicatos SET status = '".seguranca($_POST['status'])."' WHERE id = '".seguranca($_POST['id'])."'");	
}

?>