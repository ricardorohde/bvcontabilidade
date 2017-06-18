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
		$caminho 	= array("1"=>"../../../imagens/noticias/large/");
		$crop 		= "";

		$imagem = array("tmp_name"=>$_FILES["imagem_1-string"]["tmp_name"], "name"=>$_FILES["imagem_1-string"]["name"]);
		$foto1 = salvaimagem($imagem, 1, $largura, $altura, $caminho, $crop);
		
		$form['imagem_1-string'] = $foto1;
		$form['legenda_imagem_1-string'] = $form['legenda_imagem_1-string'];	
		
	}

	
	if($id)
	{
		$condicao = "id = '".$id."'";
		$sql = executa($form, "noticias", "edita", $condicao);
	}
	else
	{
		$form['data-date'] = date("d/m/Y H:i");
		$sql = executa($form, "noticias", "inserir", "");
	}
	if($form["tipo-string"] == "noticias")
		header("Location: ../../index.php?pag=lis_noticias");
	else if($form["tipo-string"] == "documentos")
		header("Location: ../../index.php?pag=lis_documentos");
	else
		header("Location: ../../index.php?pag=lis_produto");

}

else if($op == "publi_produto")
{
	$status = seguranca($_POST['status']);
	$id = seguranca($_POST['id']);
	
	$sql = mysql_query("UPDATE noticias SET status = '".$status."' WHERE id = '".$id."'");	
}

else if($op == "exclui_produto")
{
	$id = seguranca($_GET['id']);
	$op2 = seguranca($_GET['op2']);

	
	$sql = mysql_query("SELECT imagem_1 FROM noticias WHERE id = '".$id."'");
	$num = mysql_num_rows($sql);
	
	$reg = mysql_fetch_array($sql);
	if($num > 0)
	{
		if($sql['imagem_1'])
		{
			unlink("../../../imagens/noticias/large/".$reg['imagem_1']);
			unlink("../../../imagens/noticias/thumb/".$reg['imagem_1']);
		}
	}
	$sql2 = mysql_query("DELETE FROM noticias WHERE id = '".$id."'");

	if($sql2)
		header("Location: ../../index.php?pag=lis_produto");
	else
		echo "Erro";
}

else if($op == "exclui_imagem")
{
	$id = seguranca($_POST['id']);
	$foto = seguranca($_POST['foto']);
	$posicao = seguranca($_POST['posicao']);
	
	unlink("../../../imagens/noticias/large/".$foto);
	unlink("../../../imagens/noticias/thumb/".$foto);
		
	$sql = mysql_query("UPDATE noticias SET imagem_".$posicao." = '', legenda_imagem_".$posicao." = '' WHERE id = '".$id."'");
	
}

else if($op == "criacategoria")
{
	$sql = executa($form, "categorias", "inserir", "");	
	if($sql)
		header("Location: ../../index.php?pag=cad_categoria");
	else
		echo "Erro";
}

else if($op == "criasubcategoria")
{
	$sql = executa($form, "subcategorias", "inserir", "");
	if($sql)
		header("Location: ../../index.php?pag=cad_categoria");
	else
		echo "Erro";
}

else if($op == "criasubsubcategoria")
{
	$sql = executa($form, "subsubcategorias", "inserir", "");
	if($sql)
		header("Location: ../../index.php?pag=cad_categoria");
	else
		echo "Erro";
}

else if($op == "editacategoria")
{
	$tipo = seguranca(@$_POST['tipo']);
	$campo = seguranca(@$_POST['campo']);
	$valor = seguranca(@$_POST['valor']);
	
	$id = seguranca($_GET['id']);
	
	if($tipo == "cat")
	{
		$condicao = "id = ".$id;
		$form2['nome_cat-string'] = $valor;
		$sql = executa($form2, "categorias", "edita", $condicao);	
	}
	else if($tipo == "subcat")
	{
		$condicao = "id_subcat = ".$id;
		$form2['nome_subcat-string'] = $valor;
		$sql = executa($form2, "subcategorias", "edita", $condicao);
	}
	else if($tipo == "subsubcat")
	{
		$condicao = "id_subsubcat = ".$id;
		$form2['nome_subsubcat-string'] = $valor;
		$sql = executa($form2, "subsubcategorias", "edita", $condicao);
	}
}

else if($op == "publicat")
{
	$tipo = seguranca($_POST['tipo']);
	$id = seguranca($_POST['id']);
	$status = seguranca($_POST['status']);
		
	if($tipo == "cat")
	{
		$condicao = "id = ".$id;
		$form2['status-string'] = $status;
		$sql = executa($form2, "categorias", "edita", $condicao);
		
		if($status == "n")
		{
			$condicao = "id_categoria = ".$id;
			$form2['status-string'] = $status;
			$sql = executa($form2, "subcategorias", "edita", $condicao);
			
			$condicao = "id_categoria = ".$id;
			$form2['status-string'] = $status;
			$sql = executa($form2, "subsubcategorias", "edita", $condicao);
		}
	}
		
	else if($tipo == "subcat")
	{
		$condicao = "id_subcat = ".$id;
		$form2['status-string'] = $status;
		$sql = executa($form2, "subcategorias", "edita", $condicao);
		if($status == "n")
		{
			$condicao = "id_subcategoria = ".$id;
			$form2['status-string'] = $status;
			$sql = executa($form2, "subsubcategorias", "edita", $condicao);
		}
	}
		
	else if($tipo == "subsubcat")
	{
		$condicao = "id_subsubcat = ".$id;
		$form2['status-string'] = $status;
		$sql = executa($form2, "subsubcategorias", "edita", $condicao);
	}
}

else if($op == "excluicat")
{
	$op2 = seguranca($_GET['op2']);
	$id = seguranca($_GET['id']);
	
	if($op2 == "cat")
	{
		$sql = mysql_query("SELECT * FROM noticias WHERE id_categoria = '".$id."'");
		$tem = mysql_num_rows($sql);
		if($tem > 0)
		{
			echo "<script type='text/javascript'>alert('Ha ".$tem." noticia(s) nessa categoria. Voce deve exclui-la(s) primeiro.');</script>";
			echo "<meta http-equiv='refresh' content='0; url=../../index.php?pag=cad_categoria'>";
		}
		else
		{
			$sql2 = mysql_query("DELETE FROM subsubcategorias WHERE id_categoria = '".$id."'");
			$sql2 = mysql_query("DELETE FROM subcategorias WHERE id_categoria = '".$id."'");
			$sql2 = mysql_query("DELETE FROM categorias WHERE id = '".$id."'");
			header("Location: ../../index.php?pag=cad_categoria");
		}
	}
	else if($op2 == "subcat")
	{
		$sql = mysql_query("SELECT * FROM noticias WHERE id_subcategoria = '".$id."'");
		$tem = mysql_num_rows($sql);
		if($tem > 0)
		{
			echo "<script type='text/javascript'>alert('Ha ".$tem." noticia(s) nessa categoria. Voce deve exclui-la(s) primeiro.');</script>";
			echo "<meta http-equiv='refresh' content='0; url=../../index.php?pag=cad_categoria'>";
		}
		else
		{
			$sql2 = mysql_query("DELETE FROM subsubcategorias WHERE id_subcategoria = '".$id."'");
			$sql2 = mysql_query("DELETE FROM subcategorias WHERE id_subcat = '".$id."'");
			header("Location: ../../index.php?pag=cad_categoria");
		}
	}
	else if($op2 == "subsubcat")
	{
		$sql = mysql_query("SELECT * FROM noticias WHERE id_subsubcategoria = '".$id."'");
		$tem = mysql_num_rows($sql);
		if($tem > 0)
		{
			echo "<script type='text/javascript'>alert('Ha ".$tem." noticia(s) nessa categoria. Voce deve exclui-la(s) primeiro.');</script>";
			echo "<meta http-equiv='refresh' content='0; url=../../index.php?pag=cad_categoria'>";
		}
		else
		{
			$sql2 = mysql_query("DELETE FROM subsubcategorias WHERE id_subsubcat = '".$id."'");
			header("Location: ../../index.php?pag=cad_categoria");
		}
	}
}
?>