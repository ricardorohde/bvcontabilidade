<?php
$pag = @$_GET['pag'];
$op = @$_GET['op'];


switch($pag)
{
	case "":
		$tit = "Login";
		$arq = "paginas/usuarios/login.php";
		break;
	
	case "loginincorreto":
		$tit = "Login";
		$arq = "paginas/erro_login.php";
		break;
	
	case "cad_usuario":
		$tit = "Usu&aacute;rios";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/usuarios/cadastra_usuarios.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_usuario":
		$tit = "Usu&aacute;rios";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/usuarios/lis_usuarios.php";
		else
		$arq = "paginas/erro_login.php";
		break;
			
	case "cad_categoria":
		$tit = "FAQ - Categorias";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/produtos/cad_categoria.php";
		else
		$arq = "paginas/erro_login.php";
		break;
	
	case "cad_produto":
		$tit = "FAQ - Cadastrar Perguntas";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/produtos/cad_produto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
	
	case "cad_paginas":
		$tit = "P&aacute;ginas";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/paginas/cad_paginas.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_paginas":
		$tit = "P&aacute;ginas";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/paginas/lis_paginas.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_produto":
		$tit = "FAQ - Perguntas";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/produtos/lis_produto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "cad_noticias":
		$tit = "Not&iacute;cias";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/produtos/cad_produto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_noticias":
		$tit = "Not&iacute;cias";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/produtos/lis_produto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "cad_documentos":
		$tit = "Documentos T&eacute;cnicos";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/produtos/cad_produto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_documentos":
		$tit = "Documentos T&eacute;cnicos";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/produtos/lis_produto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
				
	case "cad_banners":
		$tit = "Banners";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/banners/cad_banners.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_banners":
		$tit = "Banners";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/banners/lis_banners.php";
		else
		$arq = "paginas/erro_login.php";
		break;
	
	case "cad_links":
		$tit = "Links";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/links/cad_links.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_links":
		$tit = "Links";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/links/lis_links.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "cad_material":
		$tit = "Portf&oacute;lio";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/materiais/cad_material.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_material":
		$tit = "Portf&oacute;lio";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/materiais/lis_material.php";
		else
		$arq = "paginas/erro_login.php";
		break;
	
	case "cad_categoriamat":
		$tit = "Categorias de Materiais";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/materiais/cad_categoria.php";
		else
		$arq = "paginas/erro_login.php";
		break;
	
	case "cad_clientes":
		$tit = "Clientes";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/clientes/cad_clientes.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_clientes":
		$tit = "Clientes";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/clientes/lis_clientes.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "cad_aliquota_inss":
		$tit = "Al&iacute;quotas INSS";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/aliquotas/cad_aliquota.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "cad_aliquota_irpf":
		$tit = "Al&iacute;quotas IRPF";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/aliquotas/cad_aliquota_irpf.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "cad_sindicatos":
		$tit = "Sindicatos";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/sindicatos/cad_sindicatos.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "lis_sindicatos":
		$tit = "Sindicatos";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/sindicatos/lis_sindicatos.php";
		else
		$arq = "paginas/erro_login.php";
		break;
		
	case "cad_ponto":
		$tit = "Cart&atilde;o Ponto";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/ponto/cad_ponto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
	case "lis_ponto":
		$tit = "Cart&atilde;o Ponto";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/ponto/lis_ponto.php";
		else
		$arq = "paginas/erro_login.php";
		break;
	case "cad_mensagem_ponto":
		$tit = "Cart&atilde;o Ponto";
		if(@$_SESSION['id_usuario'])
		$arq = "paginas/ponto/cad_mensagem.php";
		else
		$arq = "paginas/erro_login.php";
		break;

}
?>