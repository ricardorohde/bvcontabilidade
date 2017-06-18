<?php
$op = seguranca(@$_GET['op']);
$id = seguranca(@$_GET['id']);
if($id)
{
	$sql2 = mysql_query("SELECT *, DATE_FORMAT(data, '%d/%m/%Y %H:%i') AS data_correta FROM noticias WHERE id = '".$id."'");
	$reg2 = mysql_fetch_array($sql2);
}
?>

<link type="text/css" rel="stylesheet" href="js/redactor.css" />
<script src="js/redactor.min.js"></script>

<script type="text/javascript">
$(function(){
	
	$(".exclui").click(function(){
			var campo = $(this).attr("id").split("-");
			var id = campo[0];
			var foto = campo[1];
			var posicao = campo[2];
						
			$.post("paginas/produtos/acoes.php?op=exclui_imagem",{
				id : id,
				foto : foto,
				posicao : posicao
					  
				}, function(data){
					location.href = window.location;
				}
			);
									 
	});
	
  
  // Init redactor
  $('#texto').redactor({
	  	cleanup: true,
		minHeight: 200,
    	buttons: [ 'bold', 'italic', '|', 'unorderedlist', 'orderedlist', '|', 'alignment', '|',
					'image', 'video', 'file', 'table', 'link', 'horizontalrule']
  });




	$("#formcadastro").validate();
});
</script>


<form action="paginas/produtos/acoes.php?op=novo&id=<?php echo $id;?>" method="post" id="formcadastro" enctype="multipart/form-data">
	<input type="hidden" name="autor-string" value="<?php if($id){ echo @$reg2['autor']; }else{ echo @$_SESSION['nome']; };?>" />
	<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
        <tr>
        	<td>
            	T&iacute;tulo:<br  />
            	<input type="text" name="titulo-string" class="inputbox required" value="<?php echo html_entity_decode(@$reg2['titulo']);?>" style="width: 430px;" />
            </td>
        </tr>
        <tr>
        	<td>
            <?php
			if($pag != "cad_noticias")
			{
			?>
                Categoria:<br />
            	<select name="id_categoria-num" id="categoria" class="inputbox required">
                	<option value="">Selecione...</option>
                    <?php
					$sql = mysql_query("SELECT * FROM categorias ORDER BY nome_cat");

						while($reg = mysql_fetch_array($sql))
						{
							if(@$reg2['id_categoria'] == $reg['id'])
								$select = "selected='selected'";
							else
								$select = "";
						?>
							<option <?php echo $select;?> value="<?php echo $reg['id'];?>"><?php echo $reg['nome_cat'];?></option>
						<?php
						}
					?>
               	</select>
           	<?php
			}
			?>
            </td>
        </tr>    
        <tr>
        	<td>
            	Texto:<br />
            	<textarea id="texto" name="texto-string" class="inputbox" style="width: 450px;"><?php echo html_entity_decode(@$reg2['texto']);?></textarea>
            </td>
            
        </tr>
        <tr>
        	<td>Imagem:<br />
            	<span id="maisfoto">
            		Foto: <input type="file" name="imagem_1-string" class="inputbox" style="width: 300px;" value="" /> <br />
                    Legenda: <input type="text" name="legenda_imagem_1-string" class="inputbox" style="width: 200px;" value="" /><br />
                </span>
            </td>
       	</tr>
        <?php 
		if(@$reg2['imagem_1'])
		{
		?>
        <tr>
        	<td colspan="3">Imagens adicionadas:<br />
            <ul class="previmagens">
            	<?php 
				if(@$reg2['imagem_1'])
				{
				?>
				<li><img style="cursor:pointer; position: absolute; padding:3px; margin-left: 170px;" class="exclui" id="<?php echo @$reg2['id']."-".@$reg2['imagem_1']."-1";?>" src="imagens/icon-32-cancel.png" title="Excluir imagem" />
                	<img width="150" src="../imagens/noticias/large/<?php echo @$reg2['imagem_1'];?>" /><br /><?php echo html_entity_decode(@$reg2['legenda_imagem_1']);?>
                </li>
                <?php 
				}
				?>
            </ul>
            
	        </td>
		</tr>
        <?php 
		}
		?>
        <tr>
    		<td class="salvar"><input type="submit" value="Salvar" class="button" /></td>
        </tr>
        
</table>
</form>
