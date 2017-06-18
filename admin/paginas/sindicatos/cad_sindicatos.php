<?php
$id = seguranca(@$_GET['id']);

if($id)
{
	$sql2 = mysql_query("SELECT * FROM sindicatos WHERE id = '".$id."' ORDER BY id DESC");
	$reg2 = mysql_fetch_array($sql2);
}
?>
<script type="text/javascript">
$(function(){

	$("#formcadastro").validate();
	
	$( ".data" ).datepicker({
		dateFormat: "dd/mm",
		changeMonth: true,
		changeYear: false
    });

});
</script>
<form action="paginas/sindicatos/acoes.php?op=novo<?php if(@$id){ echo "&id=".@$id; }?>" method="post" id="formcadastro" enctype="multipart/form-data">
<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
        <tr>
        	<td>
            	Nome:<br  />
            	<input type="text" name="sindicato-string" class="inputbox required" value="<?php echo utf8_encode(@$reg2['sindicato']);?>" style="width: 300px;" />
            </td>           
            <td valign="top">Status:<br />
            	<input type="radio" name="status-string" value="p" <?php if(!$id || @$reg2['status'] == 'p'){ echo 'checked="checked"';}?>/>Publicado<br />
            	<input type="radio" name="status-string" value="d" <?php if(@$reg2['status'] == 'd'){ echo 'checked="checked"';}?>/>Despublicado
            </td>
      	</tr>
        <tr>
    		<td colspan="2">
            	Data:<br  />
            	<input type="text" name="data-cond" class="inputbox data required" readonly value="<?php echo @$reg2['data'] ? date("d/m",strtotime(@$reg2['data'])) : "";?>" />
            </td>
        </tr>
        <tr>
    		<td colspan="2" class="salvar"><input type="submit" value="Salvar" class="button" /></td>
        </tr>
</table>
</form>
