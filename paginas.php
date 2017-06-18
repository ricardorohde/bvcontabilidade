<?php
$pag = @$_GET['pag'];
$op = @$_GET['op'];

switch($pag)
{
	case "":
	case "home":
	case "empresa":
	$arq = "paginas/empresa.php";
	break;
	
	case "faq":
	$titulo = "Faq";
	$arq = "paginas/faq.php";
	break;
	
	case "formularios":
	$titulo = "Formul&aacute;rios";
	$arq = "paginas/formularios.php";
	break;
	
	case "clientes":
	$titulo = "Clientes";
	$arq = "paginas/clientes.php";
	break;
	
	case "contato":
	$titulo = "Contato";
	$arq = "paginas/contato.php";
	break;
	
	case "confirmacao":
	$titulo = "Confirma&ccedil;&atilde;o";
	$arq = "paginas/confirmacao.php";
	break;
	
}

?>