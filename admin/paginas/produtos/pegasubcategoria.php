<?php
include("../../conexao.php");
include("../../funcaoform.php");

$id = seguranca($_POST['id']);
$sql = mysql_query("SELECT * FROM subcategorias WHERE id_categoria = '".$id."' ORDER BY nome_subcat");
$numsubcat = mysql_num_rows($sql);
if($numsubcat > 0)
{
	echo "<option value=''>Selecione...</option>";
	while($reg = mysql_fetch_array($sql))
	{
	?>
		<option value="<?php echo $reg['id_subcat'];?>"><?php echo $reg['nome_subcat'];?></option>
	<?php
	}
}
else
	echo "<option value=''>Selecione...</option>";
?>
