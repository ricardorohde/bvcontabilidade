<?php
$sql = mysql_query("SELECT * FROM mensagem_emails WHERE form = 'cartao_ponto'");
$reg = mysql_fetch_array($sql);


?>

<link type="text/css" rel="stylesheet" href="js/redactor.css" />
<script src="js/redactor.min.js"></script>

<script type="text/javascript">

$(function(){
	
	  // Init redactor
  $('#texto').redactor({
	  	cleanup: true,
    	buttons: [ 'bold', 'italic', '|', 'unorderedlist', 'orderedlist', '|', 'alignment']
  });


	
	$("#formcadastro").validate();
});
</script>


<form action="paginas/ponto/acoes.php?op=mensagem&id=<?php echo $reg["id"];?>" method="post" id="formcadastro" enctype="multipart/form-data">
	<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
        <tr>
        	<td>
            	Mensagem do e-mail:<br />
            	<textarea id="texto" name="mensagem-string" class="inputbox" style="width: 450px; height:300px;"><?php echo html_entity_decode(@$reg['mensagem']);?></textarea>
            </td>
            
        </tr>
        
        <tr>
    		<td class="salvar" colspan="2"><input type="submit" value="Salvar" class="button" /></td>
        </tr>
        
</table>
</form>
