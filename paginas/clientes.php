<script type="text/javascript">
$(function(){
	$(".texto .clientes").mbScrollable({
        dir:"horizontal",
        width:670,
        height:180,
        elementsInPage:4,
        elementMargin:0,
        controls:"#controle",
        slideTimer:600,
        autoscroll:true,
        scrollTimer:5000
    });	
});
</script>
<?php
$sql = mysql_query("SELECT * FROM clientes WHERE status = 'p' ORDER BY RAND()");
?>
<h1><?php echo $titulo;?></h1>

<div id="controle">
        	<a class="prev"><img src="imagens/arrow-prev.png" /></a>
            <a class="next"><img src="imagens/arrow-next.png" /></a>
</div>

<ul class="clientes">
<?php
while($reg = mysql_fetch_array($sql))
{
	$imagem = getimagesize("imagens/clientes/".$reg['imagem']);
	$altura = $imagem[1];
	$margem = (150 - $altura)/2;
?>
	<li><a href="<?php if($reg['link'] == "http://"){ echo "";}else{echo $reg['link'];}?>" target="_blank"><img border="0" style="margin-top: <?php echo $margem;?>px;" src="imagens/clientes/<?php echo $reg['imagem'];?>" title="<?php echo $reg['nome'];?>" /></a></li>
<?php
}
?>
</ul>
