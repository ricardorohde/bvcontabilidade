<?php
$id = seguranca(@$_GET['id']);

if($id){
	$sql_usu = mysql_query("SELECT * FROM usuarios WHERE id = '".$id."'");
	$reg_usu = mysql_fetch_array($sql_usu);
}

?>
<script type="text/javascript">	
$(function(){
		   
	$("#formcadastro").validate();	 
});
</script>

<form name="form1" method="post" action="paginas/usuarios/acoes.php?op=novo&id=<?php echo $reg_usu['id'];?>" id="formcadastro">
<table cellpadding="0" cellspacing="2" width="100%" class="tblcadastro">
	<tr>
		<td>Nome:<br />
		<input type="text" name="nome-string" value="<?php echo utf8_encode(@$reg_usu['nome']);?>" class="inputbox required" style="width: 250px;" /></td>
		<td colspan="2">Email:<br />
			<input type="text" name="email-string" value="<?php echo $reg_usu['email'];?>" class="inputbox" style="width: 300px;" /></td>
	</tr>
    <tr>            
		<td>Nome de Usu&aacute;rio:<br />
			<input type="text" name="usuario-string" value="<?php echo $reg_usu['usuario'];?>" <?php if($id){ echo "readonly='readonly'";}?> class="inputbox required" style="width: 250px;" /></td>

		<td>Senha:<br />
			<input type="password" name="senha-string" value="<?php echo $reg_usu['senha'];?>"	class="inputbox required" style="width: 150px;" /></td>
        <td>N&iacute;vel de Acesso:<br />
        	<select name="nivel_acesso-num" id="id_nivel" class="inputbox required" >
			<option value="">Selecione...</option>
				<?php
                $sql = mysql_query("SELECT * FROM nivel_acesso ORDER BY id ASC");
                while($reg = mysql_fetch_array($sql))
                {
                    if(@$reg_usu['nivel_acesso'] == $reg['id'])
                        $seleciona = "selected='selected'";
                    else
                        $seleciona = "";
                    echo "<option $seleciona value='".$reg['id']."'>".utf8_encode($reg['nome'])."</option>";
                }
                ?>
		</select>
        </td>

	</tr>
	<tr>
		<td colspan="3" class="salvar"><input type="submit" value="Salvar" class="button" /></td>
	</tr>
</table>
</form>

