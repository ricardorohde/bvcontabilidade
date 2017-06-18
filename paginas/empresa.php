<?php
$sql = mysql_query("SELECT * FROM paginas WHERE id = '1'");
$reg = mysql_fetch_array($sql);
?>
<h1><?php echo html_entity_decode($reg['titulo']);?></h1>
<?php if($reg['imagem_1']){?>
    <div class="imagem">
    	<img src="imagens/paginas/large/<?php echo $reg['imagem_1'];?>" /><br />
        <small><?php echo html_entity_decode($reg['legenda_imagem_1']);?></small>
   	</div>
    <?php }?>
<?php echo html_entity_decode($reg['texto']);?>

<div class="esocial">
<a href="http://bvcontabilidade.com.br/domestico/" target="_blank">
	<img src="imagens/logo_social.png" class="logosocial"> Conheça o BV DOMÉSTICO E-SOCIAL<br>O trabalho que você não quer ter, fazemos com prazer.<br>Acesse o site!
</a>
</div>