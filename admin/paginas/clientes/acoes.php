<?php
include("../../conexao.php");
include("../../funcaoform.php");

$op = seguranca($_GET['op']);

$form = @$_POST;

if($op == "novo")
{
	$id = seguranca(@$_GET['id']);
	
	$form['link-string'] = "http://".seguranca(str_replace("http://","",@$form['link-cond']));
		
	if($_FILES["imagem"]["name"])
	{
		
			$largura = array("1"=>120);
			$altura = array("1"=>120);
			$caminho = array("1"=>"../../../imagens/clientes/");
			$crop = "";

		
		$imagem = array("tmp_name"=>$_FILES["imagem"]["tmp_name"], "name"=>$_FILES["imagem"]["name"]);
		$foto = salvaimagem($imagem, 1, $largura, $altura, $caminho, $crop);
		
		$form['imagem-string'] = $foto;
	}
		
		if($id)
		{
			$condicao = "id = ".$id;
			$sql = executa($form, "clientes", "edita", $condicao);
		}
		else
		{
			$form['data-date'] = date("d/m/Y H:i");
			$sql = executa($form, "clientes", "inserir", "");
		}

	if($sql)
		header("Location: ../../index.php?pag=lis_clientes");
	else
		echo "Erro";
}

else if($op == "exclui_cliente")
{
	$id = seguranca($_GET['id']);
	
	$sql = mysql_query("SELECT imagem FROM clientes WHERE id = '".$id."'");
	if(mysql_num_rows($sql) > 0){
		$reg = mysql_fetch_array($sql);
		unlink("../../../imagens/clientes/".$reg['imagem']);
	}
	
	$sql = mysql_query("DELETE FROM clientes WHERE id = '".$id."'");

	if($sql)
		header("Location: ../../index.php?pag=lis_clientes");
	else
		echo "Erro";
}

else if($op == "exclui_imagem")
{
	unlink("../../../imagens/clientes/".$reg['imagem']);
		
	$delete = "UPDATE clientes SET imagem = '' WHERE id = '".seguranca($_POST['id'])."'";
	$delete = mysql_query($delete);
	
}

else if($op == "ordem")
{
	$sql = mysql_query("UPDATE clientes SET ordem = '".seguranca($_POST['ordem'])."' WHERE id = '".seguranca($_POST['id'])."'");	
}

else if($op == "publi_cliente")
{
	$sql = mysql_query("UPDATE clientes SET status = '".seguranca($_POST['status'])."' WHERE id = '".seguranca($_POST['id'])."'");	
}

?>