<?php
include("../../conexao.php");
include("../../funcaoform.php");


$op = seguranca($_GET['op']);

$form = @$_POST;

if($op == "novo")
{
	$id = seguranca(@$_GET['id']);
		
	if($_FILES["imagem_1-string"]["name"])
	{
		$largura 	= array("1"=>400);
		$altura 	= array("1"=>300);
		$caminho 	= array("1"=>"../../../imagens/paginas/large/");
		$crop 		= array("1"=>array("400","300"));

		$imagem = array("tmp_name"=>$_FILES["imagem_1-string"]["tmp_name"], "name"=>$_FILES["imagem_1-string"]["name"]);
		$foto1 = salvaimagem($imagem, 1, $largura, $altura, $caminho, $crop);
		
		$form['imagem_1-string'] = $foto1;
		$form['legenda_imagem_1-string'] = $form['legenda_imagem_1-string'];	
		
	}

	
	if($id)
	{
		$condicao = "id = '".$id."'";
		$sql = executa($form, "paginas", "edita", $condicao);
	}

		header("Location: ../../index.php?pag=lis_paginas");

}



else if($op == "exclui_imagem")
{
	$id = seguranca($_POST['id']);
	$foto = seguranca($_POST['foto']);
	$posicao = seguranca($_POST['posicao']);
	
	unlink("../../../imagens/paginas/large/".$foto);
		
	$sql = mysql_query("UPDATE paginas SET imagem_1 = '', legenda_imagem_1 = '' WHERE id = '".$id."'");
	
}

?>