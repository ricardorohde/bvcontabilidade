<?php
include("../../conexao.php");
include("../../funcaoform.php");

$id = seguranca($_POST['id']);
$sql = mysql_query("SELECT * FROM subsubcategorias WHERE id_subcategoria = '".$id."' ORDER BY nome_subsubcat");
$numsubcat = mysql_num_rows($sql);
if($numsubcat > 0)
{
	echo "<option value=''>Selecione...</option>";
	while($reg = mysql_fetch_array($sql))
	{
	?>
		<option value="<?php echo $reg['id_subsubcat'];?>"><?php echo $reg['nome_subsubcat'];?></option>
	<?php
	}
}
else
	echo "<option value=''>Selecione...</option>";
?>
