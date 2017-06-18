<script type="text/javascript">
$(function(){
	$("dl dd").hide();
	
	$("dl dt").click(function(){
		$("dl dd").slideUp("fast");
		if($(this).next().is(":visible"))
			$(this).next().slideUp("fast");
		else
			$(this).next().slideDown("fast");
	});
	
	$("table tr:odd").css({"background": "#0C0C0C"});
});
</script>
<h1><?php echo $titulo;?></h1>

<ul class="submenu">
	<?php
	$sqlcat = mysql_query("SELECT * FROM categorias WHERE status = 's' AND id <> '19' ORDER BY nome_cat");
	while($regcat = mysql_fetch_array($sqlcat))
	{
	?>	
		<li><a href="index.php?pag=faq&cat=<?php echo $regcat['id'];?>"><?php echo utf8_decode(html_entity_decode($regcat['nome_cat']));?></a></li>
    <?php
	}
	?>
</ul>
<dl>
<?php
$id_categoria = seguranca(@$_GET['cat']);
$filtro = "";
if($id_categoria)
{
	$filtro = "WHERE id_categoria = '".$id_categoria."'";

$sql = mysql_query("SELECT * FROM noticias $filtro ORDER BY titulo");

$count = 0;
while($reg = mysql_fetch_array($sql))
{
	$estilo = "";
	if($count == 0)
		$estilo = "style='border: none;'";
?>
	<dt <?php echo $estilo;?>><?php echo html_entity_decode($reg['titulo']);?></dt>
    <dd>
	<?php if($reg['imagem_1']){?>
    <div class="imagem">
    	<img src="imagens/noticias/large/<?php echo $reg['imagem_1'];?>" /><br />
        <small><?php echo html_entity_decode($reg['legenda_imagem_1']);?></small>
   	</div>
    <?php }?>
	<?php echo html_entity_decode($reg['texto']);?>
    
    <div align="center"><br /><br /><button onclick="location.href='versaoimpressa.php?idfaq=<?php echo $reg['id'];?>'" class="button"><i class="fa fa-print" alt="Imprimir" title="Imprimir"></i> Imprimir</button><br /><br /></div>
    </dd>
<?php
	$count++;
}
?>
</dl>
<?php
}
?>
<br style="clear: both;" />