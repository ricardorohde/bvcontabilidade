<?php
include("admin/conexao.php");
include("admin/funcaoform.php");
include("paginas.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BV Contabilidade</title>

<link type="text/css" rel="stylesheet" href="js/themes/base/jquery.ui.all.css" />
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="estilos.css" />

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.map.js"></script>
<script type="text/javascript" src="js/jquery.meiomask.js"></script>
<script type="text/javascript" src="js/mbScrollable.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/moment-with-locales.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-79719963-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>

<div id="site">
	<div id="site_interno">
    	
        <div id="topo">
        	<div class="logo">
        		<a href="index.php"><img src="imagens/logo.png" border="0" /></a>
            </div>
            <ul class="menu">
                <li><a href="index.php?pag=empresa"><img src="imagens/ico_home.png" title="Empresa" /><span><br />Empresa</span></a></li>
                <li><a href="index.php?pag=faq"><img src="imagens/ico_faq.png" title="Faq" /><span><br />Faq</span></a></li>
                <li><a href="index.php?pag=formularios"><img src="imagens/ico_formularios.png" title="Formul&aacute;rios" /><span><br />Formul&aacute;rios</span></a></li>
                <li><a href="index.php?pag=clientes"><img src="imagens/ico_clientes.png" title="Clientes" /><span><br />Clientes</span></a></li>
                <li><a href="https://office2crm.prosoft.com.br/" target="_blank"><img src="imagens/ico_crm.png" title="CRM" /><span><br />OFFICE</span></a></li>
                <li><a href="index.php?pag=contato"><img src="imagens/ico_contato.png" title="Contato" /><span><br />Contato</span></a></li>
           	</ul>
            <hr />
        </div>
        <div class="texto">
        	<?php
			if($pag == "")
				include("paginas/empresa.php");
			else
				include($arq);
        	?>
        </div>
        
        <div id="rodape">
        	<hr />
            Travessa Piraj&aacute;, 1298 - sala 02, Marco - Bel&eacute;m, PA - CEP 66095-631<br />
            &copy; Copyright 2014 - BV Contabilidade
        </div>
    </div>
</div>

<div id="pagina">
	<div id="pagina_interna"></div>
</div>

</body>
</html>
