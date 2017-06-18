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
<link type="text/css" rel="stylesheet" href="estilosimpressao.css" />

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

</head>

<body>

	<div id="site_interno">
    	<div class="imprimir"><button class="button" onclick="print();"><i class="fa fa-print"></i> Clique aqui para imprimir</button></div>
    	<table width="100%" cellpadding="0" cellspacing="0">
        <thead> 
          <tr> 
             <th width=100% id="cabecalho"><img src="imagens/logo.png" border="0" height="100" /></th>
          </tr>
        </thead> 
        
        <tfoot> 
          <tr> 
             <td width=100% id="rodape">BV Contabilidade - Travessa Piraj&aacute;, 1298 - sala 02, Marco - Bel&eacute;m, PA - CEP 66095-631<br />
            Impresso em <?php echo date("d/m/Y");?></td>
          </tr>
        </tfoot> 
        
        <tbody> 
         <tr> 
           <td width="100%" class="texto" valign="top">               
        
                    <?php
                    $idfaq = seguranca(@$_GET['idfaq']);
                    
                    $sql = mysql_query("SELECT * FROM noticias WHERE id = '".$idfaq."'");
        
                    $reg = mysql_fetch_array($sql);
                    ?>
                    
                    <h2><?php echo html_entity_decode($reg['titulo']);?></h2>
                    <?php if($reg['imagem_1']){?>
                    <div class="imagem">
                        <img src="imagens/noticias/large/<?php echo $reg['imagem_1'];?>" /><br />
                        <small><?php echo html_entity_decode($reg['legenda_imagem_1']);?></small>
                    </div>
                    <?php }?>
                    <?php echo html_entity_decode($reg['texto']);?>
        
           </td>
         </tr> 
        </tbody> 
        </table>
        
        
        
        
    </div>



</body>
</html>
