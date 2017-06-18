<?php
$id = seguranca(@$_GET['id']);

if($id)
{
	$sql2 = mysql_query("SELECT * FROM clientes WHERE id = '".$id."' ORDER BY id DESC");
	$reg2 = mysql_fetch_array($sql2);
}
?>
<script type="text/javascript">
$(function(){

	$("#formcadastro").validate();
	
	$(".exclui").click(function(){
			var campo = $(this).attr("id").split("-");
			var id = campo[0];
			var imagem = campo[1];
			
			$.post("paginas/banners/acoes.php?op=exclui_imagem",{
				id : id,
				imagem : imagem
					  
				}, function(data){
					location.href = window.location;
				}
			);
									 
	});
	


});
</script>
<form action="paginas/clientes/acoes.php?op=novo<?php if(@$id){ echo "&id=".@$id; }?>" method="post" id="formcadastro" enctype="multipart/form-data">
<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
        <tr>
        	<td>
            	Nome:<br  />
            	<input type="text" name="nome-string" class="inputbox required" value="<?php echo utf8_encode(@$reg2['nome']);?>" style="width: 300px;" />
            </td>
            <td>
            	Link:<br  />
            	<input type="text" name="link-cond" class="inputbox" value="<?php echo utf8_encode(@$reg2['link']);?>" style="width: 300px;" />
            </td>
      	</tr>
        <tr>
            <td>Adicionar logo:<br />
            	<input type="file" name="imagem" id="imagem" class="<?php if(@$reg2['imagem']){ echo 'inputbox';}else{ echo 'inputbox required';}?>" style="width: 300px;" />
                <input type="hidden" value="<?php echo @$reg2['imagem'];?>" name="imagem-string" />
                <?php 
				if(@$reg2['imagem'])
				{
				?>
                <br /><br /><img src="../imagens/clientes/<?php echo @$reg2['imagem'];?>" width="200" /> <img style="cursor:pointer;" class="exclui" id="<?php echo @$reg2['id']."-".@$reg2['imagem'];?>" src="imagens/icon-32-cancel.png" title="Excluir imagem" />
                <?php
				}
				?>
            </td>
    		<td valign="top">Status:<br />
            <input type="radio" name="status-string" value="p" <?php if(!$id || @$reg2['status'] == 'p'){ echo 'checked="checked"';}?>/>Publicado<br />
            <input type="radio" name="status-string" value="d" <?php if(@$reg2['status'] == 'd'){ echo 'checked="checked"';}?>/>Despublicado
            </td>
        </tr>
        <tr>
    		<td colspan="2" class="salvar"><input type="submit" value="Salvar" class="button" /></td>
        </tr>
</table>
</form>
