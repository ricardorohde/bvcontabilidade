<?php
$sql = mysql_query("SELECT id, nome, usuario, email FROM usuarios ORDER BY nome ASC");
?>
<script type="text/javascript">
function confirma(id_usuario, nome)
{
	if(confirm("Deseja excluir o usu\u00e1rio " +nome+"?")) {
   		location.href = "paginas/usuarios/acoes.php?op=excluir&id="+id_usuario;
 	}
	
		$('.tblcadastro tr').mouseover(function(){
			$(this).addClass('listra2');										
		});
		$('.tblcadastro tr').mouseout(function(){
			$(this).removeClass('listra2');										
		});
		
		
		$(".tblcadastro").dataTable({
					"sPaginationType": "full_numbers",
					"aaSorting": [[ 0, "asc" ]] 
		});
}
</script>


<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
	<tr>
    	<th align="center">Nome</th>
		<th align="center">Email</th>
        <th align="center">Usu&aacute;rio</th>
		<th align="center" colspan="2">A&ccedil;&atilde;o</th>
	</tr>
	<?php

	while($reg = mysql_fetch_array($sql))
	{?>
	<tr>
		<td><?php echo utf8_encode($reg['nome']); ?></td>
		<td><?php echo $reg['email']; ?></td>
        <td><?php echo utf8_encode($reg['usuario']); ?></td>
		<td align="center" width="5%"><a href="index.php?pag=cad_usuario&id=<?php echo $reg['id']?>"><img border="0" title="Editar" alt="Editar" src="imagens/icon-32-edit.png" /></a></td>
        <td align="center" width="5%"><a onclick="confirma('<?php echo $reg['id'];?>','<?php echo utf8_encode($reg['nome']);?>')"><img style="cursor:pointer;" title="Excluir" alt="Excluir" src="imagens/icon-32-cancel.png" /></a></td>
	</tr>
	<?php } ?>
</table>

<br style="clear:both;" />
<!--
    <div class="paginacao">
    <?php
	
		if($total_paginas > 1){
				echo "P&aacute;ginas: &nbsp;";
			}else{
				echo "P&aacute;gina: &nbsp;";
			}
			
		for($i=1; $i <= $total_paginas; $i++)
		{	
			if($pagina == $i)
				echo "<span class='num'>".$i."</span>";
			else
				echo " <a href='index.php?pag=lis_usuario&npag=".$i."'>".$i."</a> "; 
		}
	
	if($resul > 0){
	?>    	
        <br /><br />Total de <strong><?php echo $resul;?></strong> cadastros.
	<?php }?>
    </div>
-->