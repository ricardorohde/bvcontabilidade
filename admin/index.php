<?php
session_start();
include("conexao.php");
include("adm_paginas.php");
include("funcaoform.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADM - BV Contabilidade</title>

<link type="text/css" rel="stylesheet" href="estilos.css" />
<link type="text/css" rel="stylesheet" href="js/themes/base/jquery.ui.all.css" />
<link type="text/css" rel="stylesheet" href="jquery.datepick.css" />
<link type="text/css" rel="stylesheet" href="floaty.css" />

<?php
$op = @$_GET['op'];
$passo = @$_GET['passo'];

if(($pag != "cad_galeria" && $passo != "2") || ($pag == "cad_galeria" && $passo != "2") || ($pag != "cad_galeria" && $passo == "2"))
{
	if(($pag != "cad_material" && $passo != "2") || ($pag == "cad_material" && $passo != "2") || $pag != "cad_material" && $passo == "2")
	{
?>
<script	type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/jquery.meiomask.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.js"></script>
<script type="text/javascript" src="js/jquery.limit-1.2.source.js"></script>
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script type="text/javascript" src="js/highslide-with-html.min.js"></script>
<script type="text/javascript" src="js/jquery.dragsort-0.5.1.min.js"></script>
<script type="text/javascript" src="js/Floaty.js"></script>
<script type="text/javascript">
hs.graphicsDir = 'imagens/graphics/';
hs.wrapperClassName = 'draggable-header';
hs.showCredits = false;
hs.preserveContent = false;
$(function(){
	$(".inputbox").focus(function(){
		$(this).css({"background" : "#FFF;"})							  
	});
	$(".inputbox").blur(function(){
		$(this).css({"background" : "#EEE;"})							  
	});
});
</script>
<?php
	}
}
?>
</head>

<body>

<div id="login">
	Ol&aacute; <strong><?php echo @$_SESSION['usuario'];?></strong> | <a href="paginas/usuarios/acoes.php?op=logout">Logout</a>
</div>
<div id="banner_topo" style="height: 130px;">
	<div style="width: 100%; margin: 10px 0 10px 0;">
    		<img style="float: left; margin: 0 20px 10px 20px;" src="../imagens/logo.png" width="120" />
	    	<h1 style="padding: 0 0 0 90px; width: 500px;float: left;">Administra&ccedil;&atilde;o do Site</h1>
        <br style="clear: both;" />
    </div>
</div>
    
    
<div id="pagina">
	<?php if(@$_SESSION['id_usuario']){ ?>
    <div id="barra_menu" class="print">
    	
    		<?php include("menu_adm.php");?>
		
    </div>
    <?php }?>
            
    <div id="conteudo">
    	<h2><?php echo $tit;?></h2>
    	<?php
				include($arq);
		?>
        <br style="clear:both;" />
        <?php if(@$_GET['pag'] != ""){?>
    	<div align="center" style="clear:both; margin-top: 30px;"><input type="button" onclick="JavaScript: window.history.back();" value="Voltar" /></div>
        <?php }?>
    </div>
    
    <br style="clear:both;" />
    
</div>

<div id="rodape" class="print">&copy; Copyright <?php echo date("Y");?> - BV Contabilidade</div>

</body>
</html>